<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <?php get_template_part('inc/seo'); ?>

    <?php
    if (is_user_logged_in()) {
        locate_template('/assets/css/css-single-login.php', true, true);
    } else {
        locate_template('/assets/css/css-single.php', true, true);
    }
    ?>
    <script src="<?php echo $src = get_template_directory_uri() . '/assets/js/jquery.min.js'; ?>" ></script>
    <?php
    $headerg = get_option('headerg');
    $mostrar_headerg = get_option('mostrar_headerg');
    if ($mostrar_headerg == 'true') {
        echo stripslashes($headerg);
    }
    ?>
    

    <?php wp_head(); ?>
</head>
<body <?php if (is_home()) {
    echo 'id="homepage"';
} ?> class="wow fadeIn">
<?php locate_template('parts/menu.php', true, true); ?>

