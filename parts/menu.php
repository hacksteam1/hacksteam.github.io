<!-- Top-Bar -->
<div id="top-bar">

    <div class="logoBar">

        <?php get_search_form(); ?>

        <div class="wrap">
            <div class="searchButton">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/icon_search.png'; ?>" alt="Search">
            </div>

            <h2 class="logoB pointer">
                <a href="<?php echo esc_url(home_url()); ?>">
                    <img src="<?php $logo = get_option('dt_logo');
                    if ($logo) {
                        echo stripslashes($logo);
                    } else {
                        echo esc_url(get_template_directory_uri()) . '/assets/img/logo.svg';
                    } ?>">
                </a>
            </h2>

            <div class="userbuttons">
               <?php easyweb_webnus_login(); ?>
            </div>
        </div>
    </div>
    <div class="menuItems">

        <div class="logo pointer superClose" onclick="location.href = 'home';">

        </div>

        <div class="menuTextT">NAVIGATION MENU</div>

        <div class="menuIcon">
            <i class="fa fa-list openResponsiveMenu"></i>
        </div>

        <div class="menu">
            <ul>
                <li <?php if ( is_home() ) { echo 'class="active"'; } ?>><a href="<?php echo esc_url( home_url() ); ?>"><i class="fa fa-bars"></i> Start</a></li>

                <?php if($url = get_option('dt_filmes_slug','filmes')) { ?>
                <li <?php dt_acpt('movies'); ?>>
                    <a href="<?php echo esc_url( home_url() ) .'/'. $url .'/'; ?>"><i class="fa fa-film"></i> Movies
                    </a>
                </li>
                <?php } ?>
                <?php if($url = get_option('dt_series_slug','series')) { ?>
                <li <?php dt_acpt('tvshows'); ?>>
                    <a href="<?php echo esc_url( home_url() ) .'/'. $url .'/'; ?>"><i class="fa fa-list"></i> Series
                    </a>
                </li>
                <?php } ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-header',
                    'container' => '',
                    'items_wrap' => '%3$s',
                    'walker' => new rc_scm_walker(),
                    'depth' => '1',
                    'fallback_cb' => '',
                    ));
                    ?>
                </ul>

            </div>
        </div>
    </div>