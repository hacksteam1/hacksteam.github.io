<div class="pre-footer">
    <div class="row mini">
        <div class="large-12 columns large-centered">
            <ul>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-footer',
                    'container' => '',
                    'items_wrap' => '%3$s',
                    'walker' => new rc_scm_walker_footer(),
                    'depth' => '1',
                    'fallback_cb' => '',
                ));
                ?>
            </ul> 
        </div>
        <div class="clearfix"></div>
    </div>
</div>