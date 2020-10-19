<?php
require_once('../../../../wp-load.php');
require_once('generateCards.php');
//require('somefile.php');
/**
 * @snippet       WordPress Snippet: Crear post con código
 * @author        Oscar Abad Folgueira
 * @author_url    https://www.oscarabadfolgueira.com
 * @snippet_url   https://www.oscarabadfolgueira.com/crear-post-wordpress-codigo/
 */

function insertPost($mark, $class, $code, $ref1, $wpdb, $description)
{
    $ref1=validateName($ref1);
    $postid = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title ='" . $mark.'-'.$ref1 . "'");
    // echo $postid.'<br>';
    if ($postid == "") {
        $post_id = -1;
        // Set the Author, Slug, title and content of the new post
        $author_id = 1;
        $slug = $mark.'-'.$ref1;
        $title = $mark.'-'.$ref1;
        //$content = '<div> coloca el contenido sobre este texto</div><div id="app"></div>';
        $content =tebleGenerator($ref1, $description);
        // echo tebleGenerator($ref1);
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
        //update_post_meta( $post_id, '_yoast_wpseo_title', $mark.'-'.$ref1 );
        update_post_meta($post_id, '_yoast_wpseo_focuskw', $mark.'-'.$ref1);
        update_post_meta($post_id, '_yoast_wpseo_metadesc', $mark.'-'.$ref1.'s simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown print');
    }
}
