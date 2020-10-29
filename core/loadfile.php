<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once('csvcall.php');
$uploaddir = plugin_dir_path(__FILE__);
$uploadfile = $uploaddir . 'super.csv';
if (move_uploaded_file($_FILES['csv']['tmp_name'], $uploadfile)) {
    loadCsv($_POST['description'], $_POST['description2'], $_POST['ivory']);
    $message = "Csv cargado y actualizado";
} else {
    $message = "Ocurrió un error al cargar el csv";
}
$location = $_SERVER['HTTP_REFERER'].'&message='.$message;
 wp_safe_redirect($location);
