<?php 
$name = dt_get_meta("name");
$serie = dt_get_meta("serie");
$season = dt_get_meta("temporada");
$dates = dt_get_meta("air_date");
?>
<div class="item category-item year-<?php $date = new DateTime($dates); echo $date->format('Y'); ?>">
	<a href="<?php the_permalink(); ?>" title="Assistir <?php the_title_attribute(); ?> online">
		<div class="lazy inner loadingBg" data-original="<?php if($thumb_id = get_post_thumbnail_id()) { $thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true); echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w300'); } ?>">
			<div class="img-op"></div>
			<div class="sort">
				<div class="data-sort-title"><?php the_title(); ?></div>
				<div class="data-sort-year"><?php $date = new DateTime($dates); echo $date->format('Y'); ?></div>
			</div>
			<div class="infos">
				<h2 class="title"><?php the_title(); ?></h2>
				<div class="cats"><?php $terms = get_the_term_list($post->ID, 'genres', ' ', ', ', ' ');
					echo $terms = strip_tags($terms); ?> <?php if($d = $dt_date) { echo ' - ', $d->format('Y'), ''; } ?>

				</div>
				<div class="votes"><?php $date = new DateTime($dates); echo $date->format('d, M. Y'); ?></div>
			</div>
		</div>
	</a>
</div>