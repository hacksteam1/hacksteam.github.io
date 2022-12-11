<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	
	<?php get_template_part('inc/seo');  
	locate_template('/assets/css/css.php', true, true); ?>
	
	<script src="<?php echo $src = get_template_directory_uri() . '/assets/js/jquery.min.js'; ?>" ></script>
	<?php wp_head(); ?>
</head>
<body <?php if (is_home()) {
	echo 'id="homepage"';
} ?> class="wow fadeIn">
<?php locate_template('parts/menu.php', true, true); ?>

