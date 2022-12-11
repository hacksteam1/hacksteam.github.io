<?php
//  Image
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
$dt_date = new DateTime(dt_get_meta('release_date'));
$dt_rating_imdb = dt_get_meta('imdbRating');
$dt_rating_tmdb = dt_get_meta('vote_average');
?>
<a href="<?php the_permalink(); ?>" class="linker" id="post-<?php the_id(); ?>" title="Watch <?php the_title_attribute(); ?> online">
	<div class="item wow fadeIn">
		<div class="lazy inner loadingBg" data-original="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w185'); } ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
		<div class="img-op"></div>
		<div class="infos">
			<h2 class="title"><?php the_title(); ?></h2>
			<div class="cats"><?php
				$terms = get_the_term_list($post->ID, 'genres', ' ', ', ', ' ');
				$terms = strip_tags($terms);
				echo $text = str_replace(", Lançamentos", "", $terms);
				?><?php if ($d = $dt_date) {
					echo ' - ', $d->format('Y'), '';
				} ?></div>
				<div class="votes"><img src="<?php echo get_template_directory_uri() . '/assets/img/imdb.png'; ?>" alt="Paterson">
					<?php if ($d = $dt_rating_imdb) { ?>
					<?php echo str_pad($d, 3, ".0"); ?><?php
				} else {
					$d = $dt_rating_tmdb;
					echo str_pad($d, 3, ".0");
				}
				?>
			</div>
		</div>
	</div>
</div>
</a>