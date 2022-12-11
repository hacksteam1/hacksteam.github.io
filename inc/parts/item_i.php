<?php
//  Image
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_b', true);
$dt_date = new DateTime(dt_get_meta('release_date'));
$dt_rating_imdb = dt_get_meta('imdbRating');
$dt_rating_tmdb = dt_get_meta('vote_average');
$dt_apid = dt_get_meta('ids');
?>
<div class="requestData">
    <div class="poster">
        <img src="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w300'); } ?>" alt="">
    </div>
    <div class="infos">
        <div class="title"><?php the_title(); ?></div>
        <div class="genre">
            <b>YEAR:</b> <?php if ($d = $dt_date) {echo  $d->format('Y'), '';} ?><br>
            <b>GENRE:</b>
            <?php
            $terms = get_the_term_list($post->ID, 'genres', ' ', ', ', ' ');
            $terms = strip_tags($terms);
            echo $text = str_replace(", Lançamentos", "", $terms);
            ?>
        </div>
        <div class="plot"><b>SYNOPSIS:</b> <br><?php the_content(); ?></div>
        <div class="rating">
            <a href="<?php if($d = $dt_apid) { echo 'http://www.imdb.com/title/', $d, ' '; }; ?>" target="_BLANK"><img src="<?php echo get_template_directory_uri() . '/assets/img/imdb.png'; ?>" alt=""></a>
            <span><?php if ($d = $dt_rating_imdb) { ?>
                <?php echo str_pad($d, 3, ".0"); ?><?php
            } else {
                $d = $dt_rating_tmdb;
                echo str_pad($d, 3, ".0");
            }
            ?></span>
        </div>
        <div class="trailer">
        </div>
    </div>
</div>