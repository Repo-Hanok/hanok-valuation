<?php

/**

 * Plugin Name: Hanok Valuation

 * Description: Un plugin para hacer valoraciones de precio en propiedades Real Estate en Valoración Vivienda

 * Version: 1.0.0

 * Author: Said

*/



// constantes

define( 'HANOK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); // ruta relativa para 'includes' (servidor)

define( 'HANOK_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); // ruta absoluta para 'enqueues' (navegador)



require_once HANOK_PLUGIN_PATH . 'includes/shortcode-form.php';

require_once HANOK_PLUGIN_PATH . 'includes/shortcode-valoracion.php';

require_once HANOK_PLUGIN_PATH . 'includes/process-form.php';

require_once HANOK_PLUGIN_PATH . 'includes/helpers/template.php';

require_once HANOK_PLUGIN_PATH . 'includes/helpers/active-campaign-api.php';

require_once HANOK_PLUGIN_PATH . 'includes/helpers/cassandra-api.php';

require_once HANOK_PLUGIN_PATH . 'includes/helpers/phone-send-otp.php';

require_once HANOK_PLUGIN_PATH . 'includes/helpers/phone-verify-otp.php';



/* registro del shortcode */

add_action( 'init', 'hanok_register_shortcodes' );



function hanok_register_shortcodes() {

    add_shortcode('hanok_formulario_valoracion', 'hanok_callback_form_valoracion');

    add_shortcode('hanok_informe_valoracion', 'hanok_callback_info_valoracion');

}



/* mensajes que mostramos al Encender/Apagar plugin */

register_activation_hook( __FILE__, 'hanok_activate' );

register_deactivation_hook( __FILE__, 'hanok_deactivate' );



// funciones de activación y desactivación del plugin

function hanok_activate() {

    error_log("Hanok plugin activated");

}

function hanok_deactivate() {

    error_log("Hanok plugin deactivated");

}