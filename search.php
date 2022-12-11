<?php get_header(); ?>

<div class="wrapper">
    <?php locate_template('parts/sidebar/sidebar-search-1.php', true, true); ?>
    <div class="row movies-list">

        <?php 
        if (have_posts()) :while (have_posts()) : the_post(); 
        $thumb_id = get_post_thumbnail_id();
        $thumb_url =  wp_get_attachment_image_src($thumb_id,'thumbnail', true);
        $dt_date = new DateTime(dt_get_meta('air_date'));
        ?>
        <?php if(get_post_type() == 'tvshows') { ?>
        <?php get_template_part('inc/parts/item_b'); ?>
        <?php } else { ?>
        <?php get_template_part('inc/parts/item'); ?>
        <?php } ?>
        
    <?php endwhile; ?>
    <?php
    else : {
        echo '<div id="search-error">Nothing was found by your search term.</div>';
    }
    ?>
<?php endif; ?>

</div>
<?php basey_pagination(); ?>
</div>

<?php get_footer(); ?>