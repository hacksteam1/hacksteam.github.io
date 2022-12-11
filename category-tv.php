<?php
/**
 * Category Template: TV channels
 */
?>
<?php get_header(); ?>
<div class="wrapper">
	<div class="row wrapi" id="homepage-items">
		<?php if (have_posts()) : ?><?php
		while (have_posts()) : the_post();
		?>
		<a href="<?php the_permalink(); ?>" rel="canonical">
			<div class="item columns medium-4 hover channels">
			<div class="lazy inner" data-original="<?php the_post_thumbnail_url(); ?>" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/img/load.gif'; ?>');">
				</div>
			</div>
		</a>
	<?php endwhile; ?>
	<?php
	else : {
		echo 'Not a post related to this category yet';
	}
	?>
<?php endif; ?>
</div>
</div>
<?php basey_pagination(); ?>
<?php get_footer(); ?>
