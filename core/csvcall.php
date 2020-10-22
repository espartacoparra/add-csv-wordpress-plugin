<?php
require_once('../../../../wp-load.php');

if (!current_user_can('manage_options')) {
    exit();
}
require_once("functionhelper.php");

    $wpdb=$wpdb;
    function loadCsv($description, $description2)
    {
        $tiempo_inicial = microtime(true);
        require_once("readCsv.php");
        require_once("generatePost.php");
        global $wpdb;
        $originalcsv=readCsv()['csv'];
        $csv =reduceCsv($originalcsv);
        $clasifiedcsv=indexedCsv($originalcsv);
        ($clasifiedcsv);
        foreach ($csv as $car) {
            insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2, $clasifiedcsv);
        }
        $wpdb->query($wpdb->prepare("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'"));
        //echo 'load <br>';
        // print_r($csv);
        // echo 'load <br>';
        $tiempo_final = microtime(true);
        $tiempo = $tiempo_final - $tiempo_inicial;
    
        echo "El tiempo de ejecución del archivo ha sido de " . $tiempo/60 . " Minutos";
        //updateCsv($description, $description2);
    }

    function updateCsv($description, $description2)
    {
        require_once("readCsv.php");
        require_once("updatePost.php");
        global $wpdb;
        $validator=[];
        $csv =readCsv()['csv'];
        foreach ($csv as $car) {
            if (count($validator)==0) {
                $validator[(string)($car[1].'-'.$car[5])]=$car[1].'-'.$car[5];
                updatePost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2);
            }
            if (!$validator[(string)($car[1].'-'.$car[5])]) {
                $validator[(string)($car[1].'-'.$car[5])]=$car[1].'-'.$car[5];
                updatePost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2);
            }
        }
        $wpdb->query($wpdb->prepare("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'"));
        echo 'update';
    }
