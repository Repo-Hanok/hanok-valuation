<?php

/**

 * Plugin Name: Hanok Valuation
 * Description: Un plugin para hacer valoraciones de precio en propiedades Real Estate en Valoración Vivienda
 * Version: 1.0.0
 * Author: Said

*/

/**
 * archivo principal del plugin:
 * - definimos las rutas de acceso a las APIs
 * - incluimos los archivos necesarios para el funcionamiento del plugin
 * - registramos los shortcodes
 */

// constantes
define( 'HANOK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); // ruta relativa para 'includes' (servidor)
define( 'HANOK_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); // ruta absoluta para 'enqueues' (navegador)

// accesos
define('CASSANDRA_URL', 'https://api.cassandra-ai.com/api/valuation/avm');
define('CASSANDRA_KEY', 'IRxQYM6q1E2yH8S6L0AZAD6yaqWqxBgPiIeMbVFacSJXSTzelDv79sMiNTGO6S87l6k');
define('ACTIVE_CAMPAIGN_URL', 'https://xpxfhvfx1l.execute-api.eu-west-3.amazonaws.com/mi-etapa/mi-recurso');
define('AWS_URL_LEGACY', 'https://ne30b426id.execute-api.eu-west-3.amazonaws.com/vv-etapa-api');

/**
 * nuevas variables para Twilio OTP
 */
define('TWILIO_API_KEY', 'SK97e2593f49f28fcbd984b28d56590db8');
define('TWILIO_API_SECRET', 'i5Bvy7AXyu0V21t5pZ7JbO468Q1lIxIS');
define('TWILIO_VERIFY_SERVICE_SID', 'VAb28f104280e4726261b1d0677298611f');

require_once HANOK_PLUGIN_PATH . 'includes/shortcode-form.php';
require_once HANOK_PLUGIN_PATH . 'includes/shortcode-valoracion.php';
require_once HANOK_PLUGIN_PATH . 'includes/process-form.php';
require_once HANOK_PLUGIN_PATH . 'includes/helpers/valuation-utils.php';
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