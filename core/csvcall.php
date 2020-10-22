<?php
require_once('../../../../wp-load.php');
require_once("helpers.php");
if (!current_user_can('manage_options')) {
    exit();
}
    $wpdb=$wpdb;
    function loadCsv($description, $description2)
    {
        $fullquery="";
        require_once("readCsv.php");
        require_once("generatePost.php");
        global $wpdb;
        $csv =reduceCsv(readCsv()['csv']);
        // print_r($newcsv);
        $i=0;
        //echo count($csv);
        foreach ($csv as $car) {
            $i++;
            if (count($csv)== $i) {
                $fullquery .= insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2).";";
            } else {
                $fullquery .= insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2).",";
            }
            //wpdb::insert('wp_post', insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2), null);
        }
        print_r($csv);
        //$wpdb->query($wpdb->prepare("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'"));
       
        //echo 'load';
       
        //print_r($fullquery);
        $totalquery="INSERT INTO `wp_posts`(`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ".$fullquery;
        // echo $totalquery;
        //echo $wpdb->query($totalquery);
        
        // echo "INSERT INTO `wp_posts`(`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ".$fullquery;
       // $results = $GLOBALS['wpdb']->get_results("INSERT INTO `wp_posts`(`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ".$fullquery, OBJECT);
        //print_r($results);
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
