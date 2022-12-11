<?php
//  Image
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
?>
<div class="item">
    <div class="inner">
        <div class="poster openRequest" data-request-id="<?php the_id(); ?>">
            <div class="imdb" title="<?php the_title_attribute(); ?>">
                <i class="fa fa-eye"></i>
                SEE <b>MORE</b>
            </div>
            <img src="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w185'); } ?>" alt="">
        </div>
        <div class="options">
            <div class="title"><?php the_title_attribute(); ?>

            </div>
            <?php if (is_user_logged_in()) {
                echo get_requests(get_the_ID());
            }else{echo get_requests_p(get_the_ID());} ?>
        </div>
    </div>
</div>