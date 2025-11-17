<?php

// accesos
define('CASSANDRA_URL', 'https://api.cassandra-ai.com/api/valuation/avm');
define('CASSANDRA_KEY', 'IRxQYM6q1E2yH8S6L0AZAD6yaqWqxBgPiIeMbVFacSJXSTzelDv79sMiNTGO6S87l6k');
define('ACTIVE_CAMPAIGN_URL', 'https://xpxfhvfx1l.execute-api.eu-west-3.amazonaws.com/mi-etapa/mi-recurso');


// registramos la ruta
add_action('rest_api_init', function () {

  register_rest_route('hanok/v1', '/valuation', [
    'methods'  => 'POST',
    'callback' => 'hanok_rest_valuation',
    'permission_callback' => '__return_true', // verificamos nonce dentro
  ]);
});


// callback para la ruta
function hanok_rest_valuation(WP_REST_Request $req) {

    // Recoger y sanear JSON
    $data = $req->get_json_params() ?: [];
    //error_log( print_r( $data, true ) );

    // --- LOGS DIAGNÓSTICO ---
    $h = $req->get_header('x-hanok-nonce');
    $p = $req->get_param('_hanok_nonce');

    // Nonce real (header > param > json)
    $nonce = $h ?: $p ?: ($j['_hanok_nonce'] ?? null); // aquí la J es un valor residual, más adelante lo quitamos
    error_log('VERIFY:' . ( wp_verify_nonce($nonce, 'hanok_valuation_form') ? 'OK' : 'FAIL'));
    // --- FIN LOGS ---

    // verificamos el nonce, esto falla cuando estás logueado por un tema de credenciales
    if ( !$nonce || !wp_verify_nonce($nonce, 'hanok_valuation_form') ) {
        return new WP_Error('forbidden', 'Nonce inválido', ['status' => 403]);
    }


    /**
     * Verificamos el tipo de petición:
     * Si es de la API nueva montamos el informe, guardamos los datos y renderizamos.
     * Si es de la API vieja la mandamos a AWS y redirigimos a la TKP.
     * "hanok_nombre" --> api nueva   /   "client_name" --> api vieja
    */
    if (isset($data['hanok_nombre'])) {

        /******===____ API NUEVA ___====*******/

        $tipo_operacion = 2;

        if (isset($data['hanok_interes']) && $data['hanok_interes'] === 'alquilar') {
            $tipo_operacion = 1;
            error_log('alquilar');
        }

        // montamos la petición para solicitar una valoración
        $body = [
            'area' => floatval($data['hanok_superficie']),
            'latitude' => floatval($data['lat']),
            'longitude' => floatval($data['lng']),
            'property_type_id' => 4,
            'operation_type_id' => $tipo_operacion,
        ];

        // solicitamos
        $response = fetch_api_cassandra(CASSANDRA_URL, CASSANDRA_KEY, $body);


        if (!$response) {
            return new WP_Error('cassandra_error', 'No se pudo obtener la valoración', ['status' => 502]);
        }

        
        // formateamos los datos
        $vars = format_data_cassandra($response); // ['avm_valuation'=>..., 'comparables'=>...]
        
        // enviamos los datos a Active Campaign
        $data_AC = array_merge($data, [
            'avm_valuation'     => isset($vars['avm_valuation']) ? (int)$vars['avm_valuation'] : null
        ]);
        
        $res_ac = fetch_api_active_campaign(ACTIVE_CAMPAIGN_URL, $data_AC);
        // error_log(print_r($res_ac, true));

        error_log(print_r($data_AC, true));

        
        // datos extra para la plantilla del informe
        $aux_data = [
            'calle' => $data['calle'].' '. $data['num'].', '.$data['ciudad'],
            'area' => floatval($data['hanok_superficie']),
            'latitude' => floatval($data['lat']),
            'longitude' => floatval($data['lng']),
            'nombre' => $data['hanok_nombre'],
            'dormitorios' => floatval($data['hanok_dormitorios']),
            'wc' => floatval($data['hanok_wc']),
            'operation_type_id' => $tipo_operacion
        ];
        $vars = array_merge($vars, $aux_data);


//error_log(print_r($vars, true));


        // calcular métricas
        $metrics = calcular_medias($vars);


        $token = bin2hex(random_bytes(10));
        set_transient("hanok_report_$token", $metrics, 3 * DAY_IN_SECONDS);

        $url = add_query_arg('t', $token, home_url('/valoracion/'));

        return new WP_REST_Response([
            'ok'       => true,
            'redirect' => $url,
        ], 200);



    } else if (isset($data['client_name'])) {

        /******===____ API VIEJA ___====*******/

        // Preparamos body y headers
        $aws_url = "https://ne30b426id.execute-api.eu-west-3.amazonaws.com/vv-etapa-api";

        $args = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => wp_json_encode($data),
            'method' => 'POST',
            'timeout' => 20,
        ];

        $response = wp_remote_post($aws_url, $args);

        // Manejo básico de errores
        if (is_wp_error($response)) {
            error_log('(X) Error en llamada AWS: ' . $response->get_error_message());
            return new WP_Error('aws_error', 'Error al contactar con AWS', ['status' => 500]);
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        // debug --> error_log("(AWS) HTTP $code - $body");

        if ($code !== 200) {
            return new WP_Error('aws_error', 'Respuesta no válida de AWS', ['status' => $code]);
        }

        return new WP_REST_Response([
            'ok'       => true,
            'redirect' => '/gracias',
        ], 200);

    } else {
        // Error
        error_log('(X) Error en los datos: falta nombre cliente');
        return new WP_Error(
            'bad_request',
            'Faltan datos obligatorios en el formulario',
            ['status' => 400]
        );  
    }

}


// funcion auxiliar para calcular precio por m2
function calcular_medias($payload) {

    $area_inmueble = isset($payload['area']) ? (float)$payload['area'] : null;
    $area_inmueble = ($area_inmueble > 0) ? $area_inmueble : null;

    $avm_valuation = $payload['avm_valuation'] ?? null;
    $comparables   = $payload['comparables']   ?? [];


    // precio por m2 del inmueble valorado
    $precio_m2 = ($avm_valuation && $area_inmueble)
        ? round($avm_valuation / $area_inmueble, 2)
        : null;


    // precios m2 de comparables
    $precios_m2_comparables = array_filter(array_map(function ($c) {
        $local_price = $c['local_price'] ?? null;
        $area        = $c['area'] ?? null;

        return ($local_price && $area)
            ? $local_price / $area
            : null;

    }, is_array($comparables) ? $comparables : []));

    // media de precios m2 comparables
    $precio_medio_m2 = count($precios_m2_comparables)
        ? round(array_sum($precios_m2_comparables) / count($precios_m2_comparables), 2)
        : null;


    // diferencia porcentual vs media comparables
    $dif_precio_medio = ($precio_m2 && $precio_medio_m2)
        ? round((($precio_m2 - $precio_medio_m2) / $precio_medio_m2) * 100, 1)
        : null;


    $metricas = [
        'precio_m2'        => $precio_m2,
        'precio_medio_m2'  => $precio_medio_m2,
        'dif_precio_medio' => $dif_precio_medio,
    ];

    return array_merge($payload, $metricas);
}
