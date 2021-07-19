<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once('generateCards.php');

function insertPost($mark, $class, $code, $ref1, $wpdb, $description, $description2, $csv, $csvheader, $ivory, $category, $page)
{
    $ref1 = validateName($ref1);
    $postid = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title ='" . $mark . ' ' . $ref1 . "' AND post_type = 'page'");
    if ($postid == "") {
        $post_id = -1;
        $author_id = 1;
        $slug = $mark . '-' . $ref1;
        $title = $mark . ' ' . $ref1;
        $content = cardGenerator($mark . ' ' . $ref1, $description, $description2, $csv, $csvheader, $ivory, 'insert');
        $post_id = wp_insert_post(
            array(
                'comment_status'    =>    'closed',
                'ping_status'        =>    'closed',
                'post_author'        =>    $author_id,
                'post_name'            =>    $slug,
                'post_title'        =>    $title,
                'post_content'      =>  $content,
                'post_status'        =>    'publish',
                'post_type'            =>    'page',
                'post_parent'           =>$page,
                'post_category'            => array($category)
            )
        );
        $ti='Conoce el precio de tu '.$mark . ' ' . $ref1.' nuevo o usado obtén valor com…';
        update_post_meta($post_id, '_yoast_wpseo_focuskw', $mark . ' ' . $ref1);
        update_post_meta($post_id, '_yoast_wpseo_title', $ti);
        update_post_meta($post_id, '_yoast_wpseo_metadesc', 'Tenemos actualizada la Lista de precios para todas las versiones de '.$mark . ' ' . $ref1 .' en todos los años.');
    }
}
