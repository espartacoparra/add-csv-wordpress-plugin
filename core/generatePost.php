<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once('generateCards.php');

function insertPost($mark, $class, $code, $ref1, $wpdb, $description, $description2, $csv)
{
    $ref1=validateName($ref1);
    $postid = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title ='" . $mark.' '.$ref1 . "'");
    if ($postid == "") {
        $post_id = -1;
        $author_id = 1;
        $slug = $mark.'-'.$ref1;
        $title = $mark.' '.$ref1;
        $content =cardGenerator($mark.' '.$ref1, $description, $description2, $csv);
        $post_id = wp_insert_post(
            array(
                'comment_status'	=>	'closed',
                'ping_status'		=>	'closed',
                'post_author'		=>	$author_id,
                'post_name'		    =>	$slug,
                'post_title'		=>	$title,
                'post_content'      =>  $content,
                'post_status'		=>	'publish',
                'post_type'		    =>	'post',
                'post_category'		    =>array(2545)
            )
        );
        update_post_meta($post_id, '_yoast_wpseo_focuskw', $mark.'-'.$ref1);
        update_post_meta($post_id, '_yoast_wpseo_metadesc', $mark.'-'.$ref1.'s simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown print');
        //}
    }
}
