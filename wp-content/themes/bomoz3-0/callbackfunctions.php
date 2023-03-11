<?php

function getAllPosts()
{
    $posts = [];
    $args = array(
        'post_type' => 'post',
        'orderby'    => 'ID',
        'post_status' => 'publish',
        'order'    => 'DESC',
        'posts_per_page' => -1 // this will retrive all the post that is published 
    );
    $result = new WP_Query($args);
    if ($result->have_posts()) :
        while ($result->have_posts()) : $result->the_post();
            $data = [];
            $postId = get_the_ID();
            $data['id'] = $postId;
            $data['title'] = get_post_meta($postId,'post_title');
            $image = get_field('thumbnail_image');
            $thumbnailSrc  =esc_url($image['url']);
            $data['thumbnail'] = $thumbnailSrc;
            $data['description'] = get_post_meta($postId,'blog_description');
            array_push($posts, $data);
        endwhile;
        wp_reset_postdata();
    endif;
    return $posts;
}

function describePost(WP_REST_Request $request){
    $postId = $request->get_param('id');
    if($postId == '' || empty($postId)){

        $response = ['success'=> false,'message' => 'Please provide post id.','result' => [],'status'=> 200];
    }else{
        $post = get_post( $postId);
        if(empty($post)){
        $response = ['success'=> false,'message' => 'Post does not exists.','result' => [],'status'=> 200];
        }else{
            $response = ['success'=> true,'message' => 'Post data retrived successfully.','result' => $post,'status'=> 200];

        }
    }
    return $response;
}
