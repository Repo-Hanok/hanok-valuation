<?php
/**
 * Validación de teléfono con OTP y bloqueo 3 días usando transients.
 * Flujo:
 *  - /phone/init   → comprueba duplicado (3 días) y envía OTP. Crea sesión PENDIENTE (10 min).
 *  - /phone/verify → valida OTP. Si OK, guarda BLOQUEO 3 días y elimina sesión pendiente.
 */

if (!defined('ABSPATH')) exit;

add_action('rest_api_init', function () {
  register_rest_route('hanok/v1', '/phone/verify', [
    'methods'  => 'POST',
    'callback' => 'hanok_phone_verify',
    'permission_callback' => '__return_true',
  ]);
});



/**
 * Endpoint VERIFY:
 * - Comprueba sesión pendiente y re-verifica que no haya bloqueo.
 * - Valida OTP. Si OK: guarda bloqueo 3 días y elimina sesión pendiente.
 * Body esperado: { "session": "...", "code": "..." }
 */
function hanok_phone_verify(WP_REST_Request $req) {
  $data    = $req->get_json_params() ?: [];
  $session = sanitize_text_field($data['session'] ?? '');
  $code    = sanitize_text_field($data['code'] ?? '');
error_log('$step 2 '.$session);
  if (!$session || !$code) {
    return new WP_REST_Response(['ok'=>false,'error'=>'missing_params','message'=>'Faltan datos.'], 400);
  }

  $pending_key = hanok_phone_key_pending($session);
  $pending = get_transient($pending_key);
  if (!$pending || empty($pending['phone']) || empty($pending['hash'])) {
    return new WP_REST_Response(['ok'=>false,'error'=>'session_expired','message'=>'Sesión caducada. Solicita un nuevo código.'], 200);
  }

  // Carrera: otro intento pudo completar antes 
  $final_key = 'hanok_phone_' . $pending['hash'];
  if (get_transient($final_key)) {
    delete_transient($pending_key);
    return new WP_REST_Response(['ok'=>false,'error'=>'duplicate_phone','message'=>'Este número ya fue validado.'], 200);
  }

  // Verificar OTP en proveedor
  $verified = hanok_verify_otp_sms($pending['otp_id'] ?? null, $code);
  if (empty($verified['ok'])) {
    return new WP_REST_Response(['ok'=>false,'error'=>'invalid_code','message'=>'Código incorrecto.'], 200);
  }

  // Éxito: bloqueo 3 días + limpiar sesión
  set_transient($final_key, time(), HANOK_PHONE_BLOCK_TTL);
  delete_transient($pending_key);

  return new WP_REST_Response(['ok'=>true,'message'=>'Teléfono verificado.'], 200);
}

/* =========================================================================
 *  ADAPTADORES DEL PROVEEDOR OTP
 *  - Sustituye estas funciones por la integración real de MiniOrange (o Twilio).
 *  - Devuelven arrays con: ['ok'=>bool, 'otp_id'=>string|null]
 * ========================================================================= */

/**
 * Verifica el código recibido contra el otp_id retornado al enviar.
 */
function hanok_verify_otp_sms($otp_id, $code) {
  if (!$otp_id || !$code) return ['ok'=>false];

  $customer_key = '368964';
  $api_key = 'MZGv5AuT42LqPswmo6j8WJpYmdNSOnEt';
  $timestamp = round(microtime(true) * 1000);
  $auth = hash('sha512', $customer_key . $timestamp . $api_key);

  $body = [
    'txId'  => $otp_id,
    'token' => $code,
  ];
error_log('verifica otp');
  $response = wp_remote_post('https://login.xecurify.com/moas/api/auth/validate', [
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
    error_log('OTP validate error: ' . $response->get_error_message());
    return ['ok'=>false];
  }

  $data = json_decode(wp_remote_retrieve_body($response), true);
  if (!empty($data['status']) && $data['status'] === 'SUCCESS') {
    
error_log(print_r($data, true));

    return ['ok'=>true];
  }

  error_log('OTP validate failed: ' . print_r($data, true));
  return ['ok'=>false];
}
