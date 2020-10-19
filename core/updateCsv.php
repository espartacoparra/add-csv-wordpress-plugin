<?php
require_once("readCsv.php");
require_once("updatePost.php");
$csv =readCsv()['csv'];

$validator=[];

foreach ($csv as $car) {
    if (count($validator)==0) {
        $validator[(string)($car[1].'-'.$car[5])]=$car[1].'-'.$car[5];
        updatePost($car[1], $car[2], $car[3], $car[5], $wpdb, "");
    }
    if (!$validator[(string)($car[1].'-'.$car[5])]) {
        $validator[(string)($car[1].'-'.$car[5])]=$car[1].'-'.$car[5];
        updatePost($car[1], $car[2], $car[3], $car[5], $wpdb, "");
    }
}
$wpdb->query($wpdb->prepare("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'"));
$location = $_SERVER['HTTP_REFERER'];
    wp_safe_redirect($location);
