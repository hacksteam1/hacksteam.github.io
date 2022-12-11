<?php $my_meta = get_post_meta($post->ID, '_my_meta', TRUE); ?>
<div class="item category-item year-<?php echo $my_meta['ano']; ?> <?php echo ucwords(strip_tags(get_the_tag_list('<p>', ', ', '</p>'))); ?>">
    <a href="<?php the_permalink(); ?>" title="Watch <?php the_title_attribute(); ?> online">
        <div class="lazy inner loadingBg" data-original="<?php the_post_thumbnail_url(); ?>">
            <div class="img-op"></div>
            <div class="sort">
                <div class="data-sort-title"><?php the_title(); ?></div>
                <div class="data-sort-ident">4271</div>
                <div class="data-sort-year"><?php echo $my_meta['ano']; ?></div>
                <div class="data-sort-rating">55</div>
            </div>
            <div class="infos">
                <h2 class="title"><?php the_title(); ?></h2>
                <div class="cats"><?php echo ucwords(strip_tags(get_the_tag_list('<p>', ', ', '</p>'))); ?> - <?php echo $my_meta['ano']; ?></div>
                <div class="votes"><img src="<?php echo get_template_directory_uri() . '/assets/img/imdb.png'; ?>" alt="Watch <?php the_title_attribute(); ?> online"><?php
                    if ($my_meta['imdb']) {
                        echo $my_meta['imdb'];
                    } else {
                        echo "N/A";
                    }
                    ?></div>
                </div>
            </div>
        </a>
    </div>