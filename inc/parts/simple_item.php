 <?php //  Image
 $thumb_id = get_post_thumbnail_id();
 $thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
 $dt_date = new DateTime(dt_get_meta('release_date'));
 $dt_rating_imdb     = dt_get_meta('imdbRating');
 ?>
 <div class="owl-item active" style="width: auto; margin-right: 0px;">
 	<a href="<?php the_permalink(); ?>">
 		<div class="item item-mini wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
 			<div class="lazy inner" data-original="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w342'); } ?>" style="background-image: url(&quot;<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w342'); } ?>&quot;); display: block;">
 				<div class="img-op"></div>
 				<div class="infos">
 					<div class="title"><?php the_title(); ?></div>
 					<div class="votes"><img src="<?php echo get_template_directory_uri() . '/assets/img/imdb.png'; ?>" alt=""><?php if($d = $dt_rating_imdb) { ?>
 						<?php echo '', $d, '', ' '; ?>
 						<?php }else {echo "N/A";}?></div>
 					</div>
 				</div>
 			</div>
 		</a>
 	</div>