<?php
/**
 * Category Template: Séries
 */
?>
<?php get_header(); ?>
<div class="wrapper">
    <div class="clearfix"></div>
    <div class="searchSerie">
        <div class="row">
            <input type="text" placeholder="What series are you researching?" id="seriename">
            <div class="searchIcon"><i class="fa fa-search"></i></div>
            <div class="notExistSerie">
                No results were found for your search.
            </div>
        </div>
    </div>
    <div class="row" id="series-list">
        <?php if (have_posts()) : ?><?php
            while (have_posts()) : the_post();
                $my_meta = get_post_meta($post->ID, '_my_meta', TRUE);
                ?>
                <a href="<?php the_permalink(); ?>" rel="canonical">
                    <div class="item">
                        <div class="title"><?php
                            $str = get_the_title();
                            $str = mb_strtolower($str, 'UTF-8');
                            print $str;
                            ?> <?php print $str; ?></div>
                        <img class="lazy" src="<?php echo get_template_directory_uri() . '/assets/img/load.gif'; ?>" data-original="<?php
                        if ($my_meta['imagem_tag']) {
                            echo $my_meta['imagem_tag'];
                        } else {
                            echo get_template_directory_uri() . '/assets/img/modelo.jpg';
                        }
                        ?>"  alt="Assistir <?php the_title_attribute(); ?> Dublado e Legendado Online">
                        <div class="hover">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/play.png'; ?>" alt="series">
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
            <?php
        else : {
                echo 'Nem um post relacionado à essa categoria ainda';
            }
            ?>
    <?php endif; ?>
    </div>
<?php basey_pagination(); ?>
</div>
</div>
<div class="banner_ads"></div>
<?php get_footer() ?>
