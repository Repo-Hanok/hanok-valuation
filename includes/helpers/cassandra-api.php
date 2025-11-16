<?php

function fetch_api_cassandra($url, $api_key, $body = []) {
  $args = [
    'headers' => [
      'Content-Type' => 'application/json',
      'x-api-key'    => $api_key,
    ],
    'body'    => wp_json_encode($body),
    'method'  => 'POST',
    'timeout' => 20,
  ];

  $response = wp_remote_post($url, $args);

  if (is_wp_error($response)) {
    error_log('fetch_api error: ' . $response->get_error_message());
    return ['error' => $response->get_error_message()];
  }

  $code = wp_remote_retrieve_response_code($response);
  $res_body = wp_remote_retrieve_body($response);

  if ($code !== 200) {
    //error_log("fetch_api bad response: HTTP $code - $res_body");
    return null;
  }

  return $res_body;
}


function format_data_cassandra($payload) {
    // 0) Asegurar array
    if (is_string($payload)) {
        // intenta aislar el JSON por si viene texto extra
        $start = strpos($payload, '{');
        $end   = strrpos($payload, '}');
        if ($start !== false && $end !== false) {
            $payload = substr($payload, $start, $end - $start + 1);
        }
        $payload = json_decode($payload, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('format_data_cassandra: JSON inválido: ' . json_last_error_msg());
            return ['avm_valuation'=>null, 'comparables'=>[]];
        }
    } elseif ($payload instanceof stdClass) {
        $payload = json_decode(json_encode($payload), true);
    } elseif (!is_array($payload)) {
        return ['avm_valuation'=>null, 'comparables'=>[]];
    }

    // 1) AVM sin decimales
    $avm_valuation = isset($payload['avm_valuation'])
        ? (int) round((float) $payload['avm_valuation'])
        : null;

    // 2) Comparables (campos clave, con tipos fuertes)
    $rawComparables = $payload['comparables'] ?? [];
    $comparables = array_map(function ($c) {
        return [
            'full_address' => $c['full_address'] ?? null,
            'local_price'  => isset($c['local_price']) ? (int)$c['local_price'] : null,
            'area'         => isset($c['area']) ? (float)$c['area'] : null,
            'n_rooms'      => $c['n_rooms'] ?? null,
            'n_baths'      => $c['n_baths'] ?? null,
            'distance'     => $c['distance'] ?? null,
            'url'          => $c['url'] ?? null,
            'year'         => $c['year_of_construction'] ?? null,
        ];
    }, is_array($rawComparables) ? $rawComparables : []);

    
    // 3) Calcular métricas adicionales // no funciona la parte que calcula el precio por m2 del
    $area_inmueble = null;
    if (isset($payload['area'])) {
        $area_inmueble = (float)$payload['area'];
    } elseif (isset($payload['hanok_superficie'])) {
        $area_inmueble = (float)$payload['hanok_superficie'];
    } elseif (isset($payload['property_size'])) { // por si acaso
        $area_inmueble = (float)$payload['property_size'];
    }
    $area_inmueble = ($area_inmueble > 0) ? $area_inmueble : null;
    error_log('area: '.$area_inmueble);

    $precio_m2 = ($avm_valuation && $area_inmueble)
        ? round($avm_valuation / $area_inmueble, 2)
        : null;

    $precios_m2_comparables = array_filter(array_map(function ($c) {
        return ($c['local_price'] && $c['area']) ? $c['local_price'] / $c['area'] : null;
    }, $comparables));

    $precio_medio_m2 = count($precios_m2_comparables)
        ? round(array_sum($precios_m2_comparables) / count($precios_m2_comparables), 2)
        : null;

    $dif_precio_medio = ($precio_m2 && $precio_medio_m2)
        ? round((($precio_m2 - $precio_medio_m2) / $precio_medio_m2) * 100, 1)
        : null;

    return [
        'avm_valuation'     => $avm_valuation,
        'comparables'       => array_values($comparables),
        'precio_m2'         => $precio_m2,
        'precio_medio_m2'   => $precio_medio_m2,
        'dif_precio_medio'  => $dif_precio_medio,
    ];

}
