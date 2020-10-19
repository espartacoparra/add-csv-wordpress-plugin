<?php
/*
Plugin Name: addcsv
Plugin URI: https://raiolanetworks.es
Description: Plugin de ejemplo del post de como crear un plugin en WordPress
Version: 1.0
Author: Espartaco
Author URI: https://raiolanetworks.es
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
