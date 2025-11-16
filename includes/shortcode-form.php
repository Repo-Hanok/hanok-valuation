<?php





// callback para el shortcode del formulario -> añade scripts y estilos y también la plantilla

function hanok_callback_form_valoracion() {

    /* añadimos scripts y estilos necesarios para el frontend */
    wp_enqueue_style( 'hanok-style', HANOK_PLUGIN_URL . 'assets/css/form-style.css' );

    wp_enqueue_script( 'hanok-geolocation', HANOK_PLUGIN_URL . 'assets/js/geolocation.js', [], null, true );

    // Al script que controla el formulario hay que pasarle la url del esquema donde viene la lógica
    wp_enqueue_script( 'hanok-form-control', HANOK_PLUGIN_URL . 'assets/js/form-control.js', [], null, true );
    wp_add_inline_script( 'hanok-form-control', 'const FORMDATA = { "schemaUrl" : "' .
    HANOK_PLUGIN_URL . 'assets/json/form-schema.json" }', 'before' );

    wp_enqueue_script( 'hanok-control-etapas', HANOK_PLUGIN_URL . 'assets/js/form-etapas.js', ['hanok-geolocation'], null, true );
    wp_enqueue_script( 'hanok-integration', HANOK_PLUGIN_URL . 'assets/js/form-integration.js', ['hanok-geolocation'], null, true );
    wp_enqueue_script( 'hanok-form-script', HANOK_PLUGIN_URL . 'assets/js/form-script.js', ['hanok-integration', 'hanok-form-control', 'hanok-control-etapas'], null, true );

    // generamos el nonce
    $nonce_field = wp_nonce_field( 'hanok_valuation_form', '_hanok_nonce', true, false );

    // cargamos la plantilla pasándole el nonce
    ob_start();
    echo hanok_render('form.php', [
        'nonce_field' => $nonce_field
    ]);

    return ob_get_clean();

}