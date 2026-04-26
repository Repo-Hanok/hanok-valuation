<?php

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