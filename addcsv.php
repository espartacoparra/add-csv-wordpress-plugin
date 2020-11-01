<?php
/*
Plugin Name: Insert csv data like a page
Plugin URI:
Description: Plugin para cargar contenido de csv como un listados de etiquetas
Version: 1.0
Author: espartaco.ing@gmail.com
Author URI:
License: GPL2
*/
define('csv_RUTA', plugin_dir_path(__FILE__));
defined('ABSPATH') or die("Bye bye");

function csv_activar()
{
}
function csv_desactivar()
{
}

register_activation_hook(__FILE__, 'csv_activar');
register_deactivation_hook(__FILE__, 'csv_desactivar');

add_action("admin_menu", "crearMenu");
function crearMenu()
{
    add_menu_page('AddCsv', 'AddCsv', 'manage_options', plugin_dir_path(__FILE__).'pagecsv.php', null, '', '5');
}
