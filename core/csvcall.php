<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
    $wpdb=$wpdb;
    function loadCsv($description, $description2)
    {
        $fulldata=[];
        require_once("readCsv.php");
        require_once("generatePost.php");
        global $wpdb;
        $csv =readCsv()['csv'];
        foreach ($csv as $car) {
            //array_push($fulldata, insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2));
            wpdb::insert('wp_post', insertPost($car[1], $car[2], $car[3], $car[5], $wpdb, $description, $description2), null);
        }
        $wpdb->query($wpdb->prepare("DELETE FROM `wp_posts` WHERE post_parent > 0 AND post_type = 'revision'"));
        echo 'load';
        print_r($fulldata);
       
        //$results = $GLOBALS['wpdb']->get_results("INSERT INTO `wp_posts`(`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23])", OBJECT);
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
