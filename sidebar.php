<?php if(get_option('dt_similiar_titles')=='true') { ?>
<div class="home-carousels relatedMovies row wrapi">
    <div class="separador columns large-12 wow fadeIn nopadding">
        <div class="inner">
            <div class="img-op"></div>
            <div class="text">Related Movies</div>
        </div>
    </div>
    <div class="large-12 columns items wow fadeIn movies-carousel movies-list small-list">
        <?php global $post;
        $tags = wp_get_post_terms($post->ID, 'genres');
        if ($tags) {
            $first_tag  = $tags[0]->term_id;
            $second_tag = $tags[1]->term_id;
            $third_tag  = $tags[2]->term_id;
            $args = array('post_type' => get_post_type($post->ID), 'post__not_in' => array($post->ID),'posts_per_page' => 12,'tax_query' => array('relation' => 'OR','ignore_sticky_posts' => 1,
                array('taxonomy' => 'genres','terms' => $second_tag,'field' => 'id','operator' => 'IN'),
                array('taxonomy' => 'genres','terms' => $first_tag,'field' => 'id','operator' => 'IN'),
                array('taxonomy' => 'genres','terms' => $third_tag,'field' => 'id','operator' => 'IN'))
            );
            $related = get_posts($args);
            $i = 0;
            if( $related ) {
                global $post;
                $temp_post = $post;
                foreach($related as $post) : setup_postdata($post); ?> 
                <?php if(get_post_type() == 'tvshows') { ?>
                <?php get_template_part('inc/parts/item_s'); ?>
                <?php } else { ?>
                <?php get_template_part('inc/parts/item_f'); ?>
                <?php } ?>
            <?php endforeach; $post = $temp_post; } } ?>
        </div>
    </div>
    <?php } ?>