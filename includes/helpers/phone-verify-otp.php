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

  //error_log('$step 2 '.$session);

  if (!$session || !$code) {

    return new WP_REST_Response(['ok'=>false,'error'=>'missing_params','message'=>'Faltan datos.'], 400);

  }



  $pending_key = hanok_phone_key_pending($session);

  $pending = get_site_transient($pending_key);

  if (!$pending || empty($pending['phone']) || empty($pending['hash'])) {

    return new WP_REST_Response(['ok'=>false,'error'=>'session_expired','message'=>'Sesión caducada. Solicita un nuevo código.'], 200);

  }



  // Carrera: otro intento pudo completar antes 

  $final_key = 'hanok_phone_' . $pending['hash'];

  if (get_site_transient($final_key)) {

    delete_site_transient($pending_key);

    return new WP_REST_Response(['ok'=>false,'error'=>'duplicate_phone','message'=>'Este número ya fue validado.'], 200);

  }



  // Verificar OTP en proveedor
  $verified = hanok_verify_otp_sms($pending['phone'] ?? null, $code);


  if (empty($verified['ok'])) {

    return new WP_REST_Response(['ok'=>false,'error'=>'invalid_code','message'=>'Código incorrecto.'], 200);

  }



  // Éxito: bloqueo 3 días + limpiar sesión

  set_site_transient($final_key, time(), HANOK_PHONE_BLOCK_TTL);

  delete_site_transient($pending_key);



  return new WP_REST_Response(['ok'=>true,'message'=>'Teléfono verificado.'], 200);

}



/* =========================================================================

 *  ADAPTADORES DEL PROVEEDOR OTP

 *  - Sustituye estas funciones por la integración real de MiniOrange (o Twilio).

 *  - Devuelven arrays con: ['ok'=>bool, 'otp_id'=>string|null]

 * ========================================================================= */



/**
 * Verifica el OTP usando Twilio Verify (VerificationCheck).
 *
 * @param string $phone Teléfono
 * @param string $code  Código OTP
 */
function hanok_verify_otp_sms($phone, $code) {
  if (!$phone || !$code) return ['ok'=>false];

  // Credenciales por variables de entorno
  $apiKey    = defined('TWILIO_API_KEY') ? TWILIO_API_KEY : null;
  $apiSecret = defined('TWILIO_API_SECRET') ? TWILIO_API_SECRET : null;
  $verifySid = defined('TWILIO_VERIFY_SERVICE_SID') ? TWILIO_VERIFY_SERVICE_SID : null;


  // añadimos +34 al teléfono si no lo tiene
  $to = (strpos($phone, '+') === 0) ? $phone : ('+34' . preg_replace('/\D+/', '', $phone));

  $url = "https://verify.twilio.com/v2/Services/{$verifySid}/VerificationCheck";

  // Preparar y enviar solicitud
  $args = [
    'headers' => [
    'Authorization' => 'Basic ' . base64_encode($apiKey . ':' . $apiSecret),
      'Content-Type'  => 'application/x-www-form-urlencoded',
    ],
    'body'    => [
      'To'   => $to,
      'Code' => $code,
    ],
    'timeout' => 15,
  ];

  $response = wp_remote_post($url, $args);

  if (is_wp_error($response)) {
    error_log('[OTP VERIFY] Twilio request error: ' . $response->get_error_message());
    return ['ok'=>false];
  }

  $http = (int) wp_remote_retrieve_response_code($response);
  $data = json_decode(wp_remote_retrieve_body($response), true);

  error_log('[OTP VERIFY] Twilio HTTP ' . $http . ' body: ' . wp_json_encode($data));

  // Si el código es correcto -> status: approved
  if ($http >= 200 && $http < 300 && !empty($data['status']) && $data['status'] === 'approved') {
    return ['ok'=>true];
  }

  // Cualquier otro caso: incorrecto / expirado / etc.
  if ($http >= 400) {
    error_log('[OTP VERIFY] Twilio HTTP error ' . $http . ': ' . print_r($data, true));
  }

  return ['ok'=>false];
}
