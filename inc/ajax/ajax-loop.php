<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
?>
<?php query_posts( array('post_type' => array('movies'), 'showposts' => 2, 'orderby' => 'rand')); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<a href="<?php the_permalink(); ?>" title="Assistir <?php the_title_attribute(); ?> online">
		<div class="movie" style="background-image: url('<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w185'); } ?>');">
			<div class="img-op"></div>
			<div class="title"><?php the_title(); ?></div>
		</div>
	</a>
<?php endwhile; wp_reset_query(); ?>
