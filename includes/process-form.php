<?php

// field map para enviarle datos a nuestra API clasica de AWS
// que espera campos con nombres específicos
const LEGACY_API_FIELD_MAP = [
    /* datos personales */
    'hanok_nombre'    => 'client_name',
    'hanok_email'     => 'email',
    'hanok_telefono'  => 'phone_number',
    'hanok_politicas' => 'consiente',

    /* datos geográficos */
    'lat'      => 'latitude',
    'lng'      => 'longitude',
    'comunidad' => 'comunidad',
    'provincia' => 'provincia',
    'cp'        => 'codigo_postal',
    'calle'     => 'calle',
    'num'       => 'num',
    'ciudad'    => 'ciudad',

    /* datos lead */
    'hanok_interes'                => 'interes',
    'hanok_comprar'                => 'residencia',
    'hanok_hipoteca'               => 'hipoteca',
    'hanok_2_viv_vender'           => 'vender_primera',
    'hanok_gesvalt'                => 'gesvalt',
    'hanok_cuando_vender'          => 'tiempo_venta',
    'hanok_motivo_info'            => 'porque_info',
    'hanok_donde_casa_anunciada'   => 'donde_anunciada',
    'hanok_venta_exclusiva'        => 'exclusiva',
    'hanok_exclusiva_cuantos_meses'=> 'meses_exclusiva',
    'hanok_motivo_vender'          => 'motivo_vender',
    'hanok_motivo_3m'              => 'espera_3_meses',
    'hanok_mot_6m'                 => 'espera_6_meses',

    /* datos inmueble */
    'hanok_tipo_vivienda'   => 'property_type',
    'hanok_estado_inmueble' => 'estado_inmueble',
    'hanok_reforma'         => 'reforma',
    'hanok_superficie'      => 'area',
    'hanok_dormitorios'     => 'n_rooms',
    'hanok_wc'              => 'n_baths',
    'hanok_precio_esperado' => 'precio_venta_deseado',
];


// registramos la ruta REST para procesar el formulario de valoración
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

    error_log( print_r( $data, true ) );



    // --- LOGS DIAGNÓSTICO ---

    $h = $req->get_header('x-hanok-nonce');
    $p = $req->get_param('_hanok_nonce');



    // Nonce real (header > param > json)

    $nonce = $h ?: $p;

    error_log('VERIFY:' . ( wp_verify_nonce($nonce, 'hanok_valuation_form') ? 'OK' : 'FAIL'));

    // --- FIN LOGS ---



    // verificamos el nonce, esto falla cuando estás logueado por un tema de credenciales

    // TODO : ENTENDER CÓMO FUNCIONA EL NONCE Y POR QUÉ FALLA CUANDO ESTÁL LOGUEADO

    if ( !$nonce || !wp_verify_nonce($nonce, 'hanok_valuation_form') ) {

        return new WP_Error('forbidden', 'Nonce inválido', ['status' => 403]);

    }


    // Decidir qué tipo de valoración solicitar (API nueva o vieja) en función de los datos recibidos

    $interes = $data['hanok_interes'] ?? null;
    $motivo_info = $data['hanok_motivo_info'] ?? null;

    $va_api_vieja = $interes === "vender" ||
                    $motivo_info === "vender_medio_plazo" ||
                    $motivo_info === "vender_futuro";

    if ($va_api_vieja) return hanok_process_legacy_api($data);
    else return hanok_process_new_api($data);

}







function hanok_process_new_api($data) {
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

    error_log(print_r($res_ac, true));



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

    // respuesta cassandra con comparables
    //error_log(print_r($vars, true));



    // calcular métricas

    $metrics = calcular_medias($vars);



    $token = bin2hex(random_bytes(10));

    set_site_transient("hanok_report_$token", $metrics, 14 * DAY_IN_SECONDS);



    $url = add_query_arg('t', $token, home_url('/valoracion/'));



    return new WP_REST_Response([

        'ok'       => true,
        'redirect' => $url,
    ], 200);
}



function hanok_process_legacy_api($data) {

    $mapped = ['property_type_id' => 4];
    foreach ($data as $key => $value) {
        $mapped_key = LEGACY_API_FIELD_MAP[$key] ?? $key;
        $mapped[$mapped_key] = $value;
    }

    // Preparamos body y headers
    $args = [

        'headers' => [

            'Content-Type' => 'application/json',
        ],

        'body' => wp_json_encode($mapped),
        'method' => 'POST',
        'timeout' => 20,
    ];


    $response = wp_remote_post(AWS_URL_LEGACY, $args);


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
        'redirect' => 'https://valoracionvivienda.com/gracias',

    ], 200);
}


