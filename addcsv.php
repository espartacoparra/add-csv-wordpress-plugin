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
    // add_submenu_page('add-csv-menu', 'Cargar csv', 'Cargar csv', 'manage_options', 'add-csv-menu-cargar-csv', 'cargarCsvContent');
}

// function addBootstrapAddCsv()
// {
//     wp_register_style(
//         'bootstrapAddCsv', // nombre
//         'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', // URL
//     );
//     wp_enqueue_style("bootstrapAddCsv");
// }

// function loadBootstrapAddCsv($hook)
// {
//     echo $hook;
//     wp_register_style(
//         'bootstrapAddCsv', // nombre
//                 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', // URL
//     );
//     wp_enqueue_style("bootstrapAddCsv");
// }
// add_action('admin_enqueue_scripts', 'loadBootstrapAddCsv');
