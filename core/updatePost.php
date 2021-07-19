<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once('generateCards.php');

function updatePost($mark, $class, $code, $ref1, $wpdb, $description, $description2, $csv, $csvheader, $ivory)
{
    $ref1=validateName($ref1);
    $content="";
    $post = $wpdb->get_row("SELECT `ID` , `post_content` FROM $wpdb->posts WHERE post_title ='" . $mark.' '.$ref1 . "' AND post_type = 'page'", OBJECT);
    $principal= explode('<figure class="php">', $post->post_content);
    switch (count($principal)) {
        case '2':
            $content.= $principal[0];
            $oldTable= explode('</figure>', $principal[1])[0];
            $second= explode($oldTable, $principal[1]);
            $content.= cardGenerator($mark . ' ' . $ref1, $description, $description2, $csv, $csvheader, $ivory, 'update');
            $content.=$second[1];
            break;
        default:
            $content =  $post->post_content.cardGenerator($mark . ' ' . $ref1, $description, $description2, $csv, $csvheader, $ivory, 'update');
            break;
    }
    $my_post = array();
    $my_post['ID'] = $post->ID;
    $my_post['post_content'] = $content;
    wp_update_post($my_post, true);
    $ti='Conoce el precio de tu '.$mark . ' ' . $ref1.' nuevo o usado obtén valor com…';
    update_post_meta($post->ID, '_yoast_wpseo_focuskw', $mark . ' ' . $ref1);
    update_post_meta($post->ID, '_yoast_wpseo_title', $ti);
    update_post_meta($post->ID, '_yoast_wpseo_metadesc', 'Tenemos actualizada la Lista de precios para todas las versiones de '.$mark . ' ' . $ref1 .' en todos los años.');
}
