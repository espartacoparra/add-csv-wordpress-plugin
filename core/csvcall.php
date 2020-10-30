<?php
require_once('../../../../wp-load.php');

if (!current_user_can('manage_options')) {
    exit();
}
require_once("functionhelper.php");

    $wpdb=$wpdb;
    function loadCsv($description, $description2, $ivory, $category, $page)
    {
        require_once("readCsv.php");
        require_once("generatePost.php");
        global $wpdb;
        $originalcsv=readCsv();
        $csvheader =$originalcsv['header'];
        $csv =reduceCsv($originalcsv['csv']);
        $clasifiedcsv=indexedCsv($originalcsv['csv']);
        foreach ($csv as $car) {
            insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2, $clasifiedcsv, $csvheader, $ivory, $category, $page);
        }
        $wpdb->query("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'");
        updateCsv($description, $description2, $csv, $clasifiedcsv, $csvheader, $ivory);
    }

    function updateCsv($description, $description2, $csv, $clasifiedcsv, $csvheader, $ivory)
    {
        require_once("updatePost.php");
        global $wpdb;
        $csv =$csv;
        foreach ($csv as $car) {
            updatePost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2, $clasifiedcsv, $csvheader, $ivory);
        }
        $wpdb->query("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'");
    }
