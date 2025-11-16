<?php



function hanok_render($template, array $vars = []) {

    $template_path = plugin_dir_path( __FILE__ ) . '../../templates/' . $template;

    if (!file_exists($template_path)) {

        return '';

    }



    extract($vars);



    ob_start();

    include $template_path;

    return ob_get_clean();

}