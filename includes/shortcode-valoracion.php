<?php







// callback para el informe de valoración

function hanok_callback_info_valoracion() {



    wp_enqueue_script(
        'hanok-map-init',
        HANOK_PLUGIN_URL . 'assets/js/hanok-map-init.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'hanok-gmaps',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyD2jcVaf_8X1ERkLEbMuCSvemnu7jZvE7k&callback=initHanokMap',
        ['hanok-map-init'], // depende del anterior
        null,
        true
    );




    /* añadimos scripts y estilos necesarios para el frontend */

    wp_enqueue_style( 'hanok-style-report', HANOK_PLUGIN_URL . 'assets/css/report-style.css' );





    // checks para el token y obtener datos

    $token = isset($_GET['t']) ? sanitize_text_field($_GET['t']) : '';

    if (!$token) {

        return '<p>No hay informe para mostrar.</p>';

    }



    $hanok_data = get_transient("hanok_report_$token");

    if (!$hanok_data) {

        return '<p>El informe no existe o ha caducado.</p>';

    }





    ob_start();

    if ($hanok_data['operation_type_id'] === 1) {
        echo hanok_render('valoracion-alquiler.php', $hanok_data);

    } else {

        echo hanok_render('valoracion.php', $hanok_data);
    }



    return ob_get_clean();

}