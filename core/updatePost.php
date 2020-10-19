<?php
require_once('../../../../wp-load.php');
require_once('generateCards.php');

function updatePost($mark, $class, $code, $ref1, $wpdb, $description)
{
    $ref1=validateName($ref1);
    $content="";
    $post = $wpdb->get_row("SELECT `ID` , `post_content` FROM $wpdb->posts WHERE post_title ='" . $mark.'-'.$ref1 . "'", OBJECT);
    $principal= explode('<figure class="wp-block-table php">', $post->post_content);
    switch (count($principal)) {
        case '2':
            $content.= $principal[0];
            $oldTable= explode('</figure>', $principal[1])[0];
            $second= explode($oldTable, $principal[1]);
            $content.= tebleGenerator($ref1, $description);
            $content.=$second[1];
            break;
        
        default:
            $content =  $post->post_content.tebleGenerator($ref1, $description);
            break;
    }
    $my_post = array();
    $my_post['ID'] = $post->ID;
    $my_post['post_content'] = $content;
    wp_update_post($my_post, true);
}
