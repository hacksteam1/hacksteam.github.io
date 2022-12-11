<div class="homepage-present">
    <div class="wow fadeInUp center">
        <div class="introSlide">
            <div class="intro wow fadeInUp" data-wow-duration=".5s" data-wow-delay="0s">
                <img src="<?php $logosearch = get_option('logosearch'); if($logosearch) { echo stripslashes($logosearch);} else {echo esc_url( get_template_directory_uri() ).'/assets/img/logo.png';}?>" alt="filmes">
                <?php
                    $texto = get_option('text_search');
                    if ($texto) {
                        echo $texto;
                    } else {
                        echo 'Assista filmes, séries, animes e tv online <b>GRÁTIS</b>!';
                    }
                    ?>
                </div>
                <?php locate_template('parts/sidebar/sidebar-search.php', true, true); ?>
            </div>
        </div>
        <div class="scrolldown"></div>
    </div>