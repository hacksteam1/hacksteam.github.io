<?php
/// META POST INFO
define('MY_WORDPRESS_FOLDER',$_SERVER['DOCUMENT_ROOT']);
add_action('admin_init','my_meta_init');

function my_meta_init() {
      // review the function reference for parameter details
      // http://codex.wordpress.org/Function_Reference/wp_enqueue_script
      // http://codex.wordpress.org/Function_Reference/wp_enqueue_style
  wp_enqueue_script('my_meta0_js', DT_DIR_URI . '/inc/custom/meta0.js', array('jquery'));
  wp_enqueue_script('my_bootstrap.min_js', DT_DIR_URI . '/inc/custom/bootstrap.min.js', array('jquery'));
   wp_enqueue_script('upload_images.js', DT_DIR_URI . '/inc/custom/upload_images.js', array('jquery'));
      // review the function reference for parameter details
      // http://codex.wordpress.org/Function_Reference/add_meta_box

      // add a meta box for each of the wordpress page types: posts and pages
  foreach (array('post') as $type) {
    add_meta_box('my_all_meta', 'INFORMAÇÕES:', 'my_meta_setup', $type, 'normal', 'high');
  }

      // add a callback function to save any data a user enters in
  add_action('save_post','my_meta_save');
}

function my_meta_setup() {
  global $post;

      // using an underscore, prevents the meta variable
      // from showing up in the custom fields section
  $meta = get_post_meta($post->ID,'_my_meta',TRUE);

      // instead of writing HTML here, lets do an include
  require_once( DT_DIR . '/inc/custom/meta.php');

      // create a custom nonce for submit verification later
  echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

function my_meta_save($post_id) {
      // authentication checks

      // make sure data came from our meta box
  if (!wp_verify_nonce($_POST['my_meta_noncename'],__FILE__)) return $post_id;

      // check user permissions
  if ($_POST['post_type'] == 'page') {
    if (!current_user_can('edit_page', $post_id)) return $post_id;
  } else {
    if (!current_user_can('edit_post', $post_id)) return $post_id;
  }

      // authentication passed, save data

      // var types
      // single: _my_meta[var]
      // array: _my_meta[var][]
      // grouped array: _my_meta[var_group][0][var_1], _my_meta[var_group][0][var_2]

  $current_data = get_post_meta($post_id, '_my_meta', TRUE);  

  $new_data = $_POST['_my_meta'];

  my_meta_clean($new_data);

  if ($current_data) {
    if (is_null($new_data)) delete_post_meta($post_id,'_my_meta');
    else update_post_meta($post_id,'_my_meta',$new_data);
  } elseif (!is_null($new_data)) {
    add_post_meta($post_id,'_my_meta',$new_data,TRUE);
  }

  return $post_id;
}

function my_meta_clean(&$arr) {
  if (is_array($arr)) {
    foreach ($arr as $i => $v) {
      if (is_array($arr[$i])) {
        my_meta_clean($arr[$i]);

        if (!count($arr[$i])) {
          unset($arr[$i]);
        }
      } else {
        if (trim($arr[$i]) == '') {
          unset($arr[$i]);
        }
      }
    }
    if (!count($arr)) {
      $arr = NULL;
    }
  }
}