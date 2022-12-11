<?php //  Image
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
$dt_date1 = new DateTime(dt_get_meta('first_air_date'));
$dt_rating_imdb		= dt_get_meta('imdbRating');
?>
<div class="item category-item year-<?php if($d = $dt_date1) { ?><?php echo $d->format(DT_TIME); ?><?php } ?>">
	<a href="<?php the_permalink(); ?>" title="Watch <?php the_title_attribute(); ?> online">
		<div class="lazy inner loadingBg" data-original="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w185'); } ?>">
			<div class="img-op"></div>
			<div class="sort">
				<div class="data-sort-title"><?php the_title(); ?></div>
				<div class="data-sort-year"><?php if($d = $dt_date1) { ?><?php echo $d->format(DT_TIME); ?><?php } ?></div>
			</div>
			<div class="infos">
				<h2 class="title"><?php the_title(); ?></h2>
				<div class="cats"><?php $terms = get_the_term_list($post->ID, 'genres', ' ', ', ', ' ');
					echo $terms = strip_tags($terms); ?> <?php if($d = $dt_date) { echo ' - ', $d->format('Y'), ''; } ?></div>
					<div class="votes"><img src="<?php echo get_template_directory_uri() . '/assets/img/imdb.png'; ?>" alt="Assistir <?php the_title_attribute(); ?> online"><?php if($d = $dt_rating_imdb) { ?>
						<?php echo str_pad($d, 3, ".0"); ?>
						<?php }else {echo "N/A";}?></div>
					</div>
				</div>
			</a>
		</div>