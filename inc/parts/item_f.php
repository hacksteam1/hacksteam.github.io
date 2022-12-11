 <?php //  Image
 $thumb_id = get_post_thumbnail_id();
 $thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
 $dt_date = new DateTime(dt_get_meta('release_date'));
 $dt_rating_imdb     = dt_get_meta('imdbRating');
 ?>
 <a href="<?php the_permalink(); ?>" title="Watch <?php the_title_attribute(); ?> online">
    <div class="item item-small columns large-2 wow fadeIn left">
        <div class="lazy inner loadingBg" data-original="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w342'); } ?>">
            <div class="img-op"></div>
            <div class="infos">
                <div class="title"><?php the_title(); ?></div>
                <div class="cats"><?php
                    $terms = get_the_term_list($post->ID, 'genres', ' ', ', ', ' ');
                    $terms = strip_tags($terms);
                    echo $text = str_replace(", Lançamentos", "", $terms);
                    ?><?php if ($d = $dt_date) {
                        echo ' - ', $d->format('Y'), '';
                    } ?></div>
                    <div class="votes"><img src="<?php echo get_template_directory_uri() . '/assets/img/imdb.png'; ?>"><?php if($d = $dt_rating_imdb) { ?>
                        <?php echo '', $d, '', ' '; ?>
                        <?php }else {echo "N/A";}?></div>
                    </div>
                </div>
            </div>
        </a>