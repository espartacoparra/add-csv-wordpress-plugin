<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once("readCsv.php");
require_once("generatePost.php");
$csv =readCsv()['csv'];
foreach ($csv as $car) {
    insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, "", "");
}
$wpdb->query($wpdb->prepare("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'"));
$location = $_SERVER['HTTP_REFERER'];
wp_safe_redirect($location);
