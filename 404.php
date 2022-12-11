<?php get_header(); ?>
<section class="home-section bg-dark-alfa-30 parallax-2">
    <div class="js-height-full">
        <div class="home-content container">
            <div class="home-text">
                <div class="hs-cont">
                    <div class="hs-wrap">
                        <div class="hs-line-13 font-alt mb-10">
                            404
                        </div>

                        <div class="hs-line-4 font-alt mb-40">
                            The page you were looking for could not be found.
                        </div>
                        <div class="local-scroll">                                        
                            <a href="<?php echo home_url(); ?>" class="btn btn-mod btn-w btn-round btn-small"><i class="fa fa-angle-left"></i> Return to home page</a>                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
</section>
<?php locate_template('assets/js.php', true, true); ?>
<?php get_footer(); ?>
