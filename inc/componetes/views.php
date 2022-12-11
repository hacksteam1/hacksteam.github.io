<?php

function wpmidia_set_post_views($postID) {

    $cookie = strtotime(date('Y-m-d'));
    $pv_url = 'wpmidia_' . md5($_SERVER['REQUEST_URI']);

    if (is_single() && !isset($_COOKIE[$pv_url])) {

        $count_key = '_wpmidia_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            $count = 1;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, $count);
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}

function wpmidia_track_post_views($post_id) {
    if (!is_single())
        return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    wpmidia_set_post_views($post_id);
}

add_action('wp_head', 'wpmidia_track_post_views');

function wpmidia_get_post_views($postID) {
    $count_key = '_wpmidia_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if (!empty($count)) {
        return $count;
    }
}

add_filter('manage_posts_columns', 'wpmidia_posts_column_views');

function wpmidia_posts_column_views($defaults) {
    $defaults['post_views'] = __('Views');
    return $defaults;
}

add_action('manage_posts_custom_column', 'wpmidia_custom_column_views', 5, 2);

function wpmidia_custom_column_views($column_name, $id) {
    if ($column_name === 'post_views') {
        $count = get_post_meta($id, '_wpmidia_post_views_count', true);
        if (!empty($count)) {
            echo $count . ' Views';
        }
    }
}

if (!function_exists('tp_count_post_views')) {

    function tp_count_post_views() {

        if (is_single()) {

            global $post;

            if (empty($_SESSION['tp_post_counter_' . $post->ID])) {

                $_SESSION['tp_post_counter_' . $post->ID] = true;

                $key = 'tp_post_counter';
                $key_value = get_post_meta($post->ID, $key, true);

                if (empty($key_value)) {
                    $key_value = 1;
                    update_post_meta($post->ID, $key, $key_value);
                } else {
                    $key_value += 1;
                    update_post_meta($post->ID, $key, $key_value);
                }
            }
        }
        return;
    }

    add_action('get_header', 'tp_count_post_views');
}