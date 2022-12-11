<?php
// Validar post
if ($_POST) {
	// Gestionar datos WordPress
	define('WP_USE_THEMES', false);
	require ('../../../../../wp-blog-header.php');
	status_header(200);
	nocache_headers();
	set_time_limit(30000);
	if (is_user_logged_in()) { 
		if (($_POST["dt_string"] != NULL))
			{
			$dt_string = $_POST["dt_string"];
			$dt_tipo = $_POST["tipo"];
			$dt_url = $_POST["url"];
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$dt_url)) {
			  $dt_urlErr = "Invalid URL"; 
			}
			$dt_idioma = $_POST["idioma"];
			$dt_calidad = $_POST["calidad"];
			$dt_postid = $_POST["idpost"];
			$dt_postitle = $_POST["titlepost"];
			$my_post = array(
				'post_title' => wp_strip_all_tags(html_entity_decode($dt_string)) ,
				'post_status' => get_option('dt_status_post_links', 'publish') ,
				'post_type' => 'dt_links',
				'post_author' => get_current_user_id(),
			);
			$post_id = wp_insert_post($my_post);
			add_post_meta($post_id, "links_type", ($dt_tipo) , true);
			add_post_meta($post_id, "links_url", ($dt_url) , true);
			add_post_meta($post_id, "dt_string", ($dt_string) , true);
			add_post_meta($post_id, "links_idioma", ($dt_idioma) , true);
			add_post_meta($post_id, "links_quality", ($dt_calidad) , true);
			add_post_meta($post_id, "dt_postid", ($dt_postid) , true);
			add_post_meta($post_id, "dt_postitle", ($dt_postitle) , true);
			$mensaje = __('Content published', 'mtms');
			}
		echo __('Link sent, updating page ...', 'mtms');
		exit;
	}
	// finalizar POST
}