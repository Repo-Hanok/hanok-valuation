<?php
/**
 * Validación de teléfono con OTP y bloqueo 3 días usando transients.
 * Flujo:
 *  - /phone/init   → comprueba duplicado (3 días) y envía OTP. Crea sesión PENDIENTE (10 min).
 *  - /phone/verify → valida OTP. Si OK, guarda BLOQUEO 3 días y elimina sesión pendiente.
 */

if (!defined('ABSPATH')) exit;

// --- Ajustes rápidos ---
const HANOK_PHONE_BLOCK_TTL = 3 * DAY_IN_SECONDS;      // Bloqueo tras OTP ok
const HANOK_PHONE_PENDING_TTL = 10 * MINUTE_IN_SECONDS; // Vida de la sesión pendiente (OTP)

add_action('rest_api_init', function () {
  register_rest_route('hanok/v1', '/phone/init', [
    'methods'  => 'POST',
    'callback' => 'hanok_phone_init',
    'permission_callback' => '__return_true', // opcional: valida nonce si quieres
  ]);
});





/**
 * Endpoint INIT:
 * - Rechaza si ya existe bloqueo 3 días.
 * - Envía OTP (proveedor) y crea sesión pendiente (10 min) con otp_id.
 * Body esperado: { "telefono": "..." }
 */
function hanok_phone_init(WP_REST_Request $req) {
  $data = $req->get_json_params() ?: [];
  $tel  = isset($data['telefono']) ? hanok_norm_phone($data['telefono']) : '';
error_log('init: '.$tel);
  if (!$tel) {
    return new WP_REST_Response(['ok'=>false,'error'=>'missing_phone','message'=>'Teléfono requerido.'], 400);
  }

  // 1) Duplicado 3 días
  $final_key = hanok_phone_key_final($tel);
  if (get_transient($final_key)) {
    return new WP_REST_Response([
      'ok' => false,
      'error' => 'duplicate_phone',
      'message' => 'Este teléfono ya ha solicitado una valoración recientemente.'
    ], 200);
  }

  // 2) Enviar OTP
  $send = hanok_send_otp_sms($tel); // ← integra MiniOrange aquí
  if (empty($send['ok'])) {
    return new WP_REST_Response([
      'ok' => false,
      'error' => 'otp_send_failed',
      'message' => 'No se pudo enviar el código. Inténtalo de nuevo.'
    ], 200);
  }

  // 3) Crear sesión pendiente (no bloquea aún)
  $session = bin2hex(random_bytes(10));
  $pending_key = hanok_phone_key_pending($session);

  set_transient($pending_key, [
    'phone'   => $tel,
    'hash'    => md5($tel),
    'otp_id'  => $send['otp_id'] ?? null,
    'created' => time(),
  ], HANOK_PHONE_PENDING_TTL);

  return new WP_REST_Response([
    'ok'      => true,
    'session' => $session,
    'message' => 'Código enviado por SMS.'
  ], 200);
}


/* =========================================================================
 *  ADAPTADORES DEL PROVEEDOR OTP
 *  - Sustituye estas funciones por la integración real de MiniOrange (o Twilio).
 *  - Devuelven arrays con: ['ok'=>bool, 'otp_id'=>string|null]
 * ========================================================================= */

/**
 * Envía un OTP por SMS al teléfono indicado.
 * Debe devolver un identificador de solicitud (otp_id) para verificar después.
 */
function hanok_send_otp_sms($phone_norm) {
  $customer_key = '368964';
  $api_key = 'MZGv5AuT42LqPswmo6j8WJpYmdNSOnEt';
  $timestamp = round(microtime(true) * 1000);
  $auth = hash('sha512', $customer_key . $timestamp . $api_key);

  $body = [
    'customerKey'     => $customer_key,
    'phone'           => '+34' . $phone_norm, // formato E.164
    'authType'        => 'SMS',
    'transactionName' => 'CUSTOM-OTP-VERIFICATION',
  ];

error_log('send_otp: '.$phone_norm);

  $response = wp_remote_post('https://login.xecurify.com/moas/api/auth/challenge', [
    'headers' => [
      'Content-Type'  => 'application/json',
      'Customer-Key'  => $customer_key,
      'Timestamp'     => $timestamp,
      'Authorization' => $auth,
    ],
    'body'    => wp_json_encode($body),
    'timeout' => 15,
  ]);

  if (is_wp_error($response)) {
    error_log('OTP send error: ' . $response->get_error_message());
    return ['ok'=>false];
  }

  $data = json_decode(wp_remote_retrieve_body($response), true);

  
  if (!empty($data['status']) && $data['status'] === 'SUCCESS' && !empty($data['txId'])) {

error_log(print_r($data, true));

    return ['ok'=>true, 'otp_id'=>$data['txId']];
  }

  error_log('OTP send failed: ' . print_r($data, true));
  return ['ok'=>false];
}




/**
 * Normaliza teléfono: solo dígitos y quita +34 si procede.
 */
function hanok_norm_phone($tel_raw) {
  $t = preg_replace('/\D+/', '', (string)$tel_raw); // deja solo dígitos
  // Ejemplo España: si viene 34XXXXXXXXX (11 dígitos) → quita 34
  if (strlen($t) === 11 && str_starts_with($t, '34')) $t = substr($t, 2);
error_log('tlf -> '.$tel_raw.' -->'.$t);
  return $t;
}

/**
 * Genera clave definitiva (bloqueo 3 días) para un teléfono ya normalizado.
 */
function hanok_phone_key_final($norm_phone) {
  return 'hanok_phone_' . md5($norm_phone);
}

/**
 * Genera clave de sesión pendiente a partir del token de sesión.
 */
function hanok_phone_key_pending($session) {
  return 'hanok_phone_pending_' . sanitize_key($session);
}