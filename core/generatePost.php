<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
require_once('generateCards.php');

function insertPost($mark, $class, $code, $ref1, $wpdb, $description, $description2)
{
    $ref1=validateName($ref1);
   
    $post_id = -1;
    $author_id = 1;
    $slug = $mark.'-'.$ref1;
    $title = $mark.' '.$ref1;
    $content =cardGenerator($ref1, $description, $description2);
    //$post_id = wp_insert_post(
    //INSERT INTO `wp_posts`(`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`)
    return $post= '(null,"'.$author_id.'","'.date("Y-n-j h:i:s").'","'.date("Y-n-j h:i:s").'","'.$content.'","'.$title.'"," ","publish","closed","closed","'.$slug.'"," "," ","'.date("Y-n-j h:i:s").'","'.date("Y-n-j h:i:s").'","","2545"," ","0","post","","0")';
        
    // return  array(                'comment_status'	=>	'closed', 'ping_status'		=>	'closed',
        //         'post_author'		=>	$author_id,
        //         'post_name'		    =>	,
        //         'post_title'		=>	$title,
        //         'post_content'      =>  $content,
        //         'post_status'		=>	'publish',
        //         'post_type'		    =>	'post',
        //         'post_category'		    =>array(2545)
        //     );
        // );
        //update_post_meta($post_id, '_yoast_wpseo_focuskw', $mark.'-'.$ref1);
        //update_post_meta($post_id, '_yoast_wpseo_metadesc', $mark.'-'.$ref1.'s simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown print');
}
