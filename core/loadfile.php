<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once('csvcall.php');

$uploaddir = plugin_dir_path(__FILE__);
$uploadfile = $uploaddir .'super.csv';
echo $uploadfile;
echo '<pre>';
if (move_uploaded_file($_FILES['csv']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";
loadCsv($_POST['description'], $_POST['description2']);
$message="Csv cargado y actualizado";
// $location = $_SERVER['HTTP_REFERER'].'&message='.$message;
//  wp_safe_redirect($location);
