<?php

if (is_admin()) {
	include_once DT_DIR . '/inc/includes/static/inc/options.php';
	include_once DT_DIR . '/inc/includes/static/inc/assets.php';
	include_once DT_DIR . '/inc/includes/static/inc/image_upload.php';
	include_once DT_DIR . '/inc/includes/static/inc/page_options.php';
	new acera_theme_options($options);
	add_action('admin_head', 'dt_upload_image_editor');
}
?>
