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
            $data['title'] = get_post_meta($postId, 'post_title')[0];
            $data['author']  = get_the_author_meta('nickname');
            $image = get_field('thumbnail_image');
            $thumbnailSrc  = esc_url($image['url']);
            $data['thumbnail'] = $thumbnailSrc;
            $data['description']  = [];
            if (have_rows('description_section')) :
                while (have_rows('description_section')) : the_row();
                    $details = [];
                    $details['type'] = get_sub_field('type');
                    if ($details['type'] == 'list') {
                        $details['content'] = explode('.', get_sub_field('description'));
                    } else {

                        $details['content'] = get_sub_field('description');
                    }
                    array_push($data['description'], $details);
                endwhile;
            endif;

            $data['display_images'] = [];
            if (have_rows('display_images')) :
                while (have_rows('display_images')) : the_row();
                    $image = get_sub_field('image');
                    $imageDetails = [];
                    $imageDetails['url'] = esc_url($image['url']);
                    $imageDetails['alt'] = esc_html($image['alt']);
                    $imageDetails['title'] = esc_html($image['title']);
                    array_push($data['display_images'],$imageDetails);
                endwhile;
            endif;
            
            $data['faq_details'] = [];
            $data['faq_questions'] = [];
            if (have_rows('faqs')) :
                $faqQuestions = [];
                while (have_rows('faqs')) : the_row();
                    $faqDetails = [];
                    $faqDetails['question'] = get_sub_field('question');
                    $faqDetails['answer'] = get_sub_field('answer');
                    array_push($faqQuestions,get_sub_field('question'));
                    array_push($data['faq_details'],$faqDetails);
                endwhile;
                array_push($data['faq_questions'],$faqQuestions);
            endif;
            



            array_push($posts, $data);
        endwhile;
        wp_reset_postdata();
    endif;
    return $posts;
}

function describePost(WP_REST_Request $request)
{
    $postId = $request->get_param('id');
    if ($postId == '' || empty($postId)) {

        $response = ['success' => false, 'message' => 'Please provide post id.', 'result' => [], 'status' => 200];
    } else {
        $post = get_post($postId);
        if (empty($post)) {
            $response = ['success' => false, 'message' => 'Post does not exists.', 'result' => [], 'status' => 200];
        } else {
            $response = ['success' => true, 'message' => 'Post data retrived successfully.', 'result' => $post, 'status' => 200];
        }
    }
    return $response;
}
