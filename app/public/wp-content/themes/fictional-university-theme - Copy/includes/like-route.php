<?php

add_action('rest_api_init' , 'universityLikeRoute');

function universityLikeRoute() {
    register_rest_route('university/v1' , 'managelike' , array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));
    
    register_rest_route('university/v1' , 'managelike' , array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    ));
}

function createLike($data) {
    if(is_user_logged_in()) {
        $professor = sanitize_text_field($data['professorId']);

        $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_professor_id' ,
                    'compare' => '=',
                    'value' => $professor
                )
            )
        ));

        if($existQuery->found_posts == 0 && get_post_type($professor) == 'professor'){
            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => '2nd PHP test',
                'meta_input' => array(
                    'liked_professor_id' => $professor
                )
            ));
        }else{
            die("Invalid Professor ID");
        } 
    } else {
        die("Only Logged In Users Can Like");
    }
}

function deleteLike($data) {
    $likeID = sanitize_text_field($data['like']);
    
    if(get_current_user_id() == get_post_field('post_author' , $likeID) && get_post_type($likeID) == 'like') {
        wp_delete_post($likeID, true);
        return "Congratz, Like Deleted.";
    } else {
        die("You Do Not Have Permission To Delete That");
    }
}