<?php
// Single Tabs
if (isset($_GET['tab'])) {
    $tab = $_GET['tab'];
} else {
    $tab = '';
}
$dato = $_GET['tab'];
// Movies Meta data
$dt_date1 = new DateTime(dt_get_meta('first_air_date'));
$dt_date2 = new DateTime(dt_get_meta('last_air_date'));
$dt_id_tvshow = dt_get_meta('ids');
$dt_episodes = dt_get_meta('number_of_episodes');
$dt_seasons = dt_get_meta('number_of_seasons');
$dt_original_title = dt_get_meta('original_name');
$dt_status = dt_get_meta('status');
$dt_tmdb_rating = dt_get_meta('imdbRating');
$dt_tmdb_votes = dt_get_meta('imdbVotes');
$dt_runtime = dt_get_meta('episode_run_time');
$dt_homepage = dt_get_meta('homepage');
$dt_popularity = dt_get_meta('popularity');
$dt_type = dt_get_meta('type');
$dt_trailer = dt_get_meta('youtube_id');
$dt_images = dt_get_meta('imagenes');
$dt_cast = dt_get_meta('dt_cast');
$dt_clgnrt = dt_get_meta('clgnrt');
// Eliminar reportes de error
if($_GET['report']=="ready") { 
    if(current_user_can('administrator')) {
        delete_post_meta($post->ID, 'numreport' );
    }
}else{
    $dt_reports = dt_get_meta('numreport');
}
if (have_posts()) :while (have_posts()) : the_post();
?>
<style>
    .movies-list .owl-controls {
        top: -60px;
        right: -20px;
    }
    #remoteUpload select option{
        color: #000 !important;
    }
    .relatedMovies .movies-list.small-list .text{padding:0px;margin-top: -10px;}
    .relatedMovies .separador{margin-top:5px;}
    .relatedMovies .separador .inner{background:rgba(0, 0, 0, 0.46);}
    .fullplayer .player{background:RGBA(3, 16, 25, 0.54);}
    .fullplayer .playerList .text{padding-top:50px;}
    .bottomHead .miniInfo span{background:rgba(0,0,0,0.2);}
    .midHead{background-image:url(<?php dt_get_images("original", $post->ID); ?>);} 
    .newComment .errorMsg{position: absolute;bottom: -30px;left: 0;width: 100%;height: 30px;font-size: 10px;letter-spacing:.5px;line-height: 30px;z-index:100;display:none;font-weight: 300;color: #FFF;text-align: center;text-transform: uppercase;background-color: rgb(222,84,73);}
    .newComment .errorMsg a{font-weight: 700;}
</style>

<div class="modal-trailer">
    <div class="box-out">
        <div class="box-in">
            <iframe width="600" height="360" src="" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div id="movie-page">
    <div class="header">
        <div class="midHead">
            <div class="img-op"></div>
            <div class="row wrapi">
                <div class="image wow fadeInLeft">
                    <div class="downloadImage">
                        <div class="title">
                            DOWNLOAD IMAGES
                        </div>
                        <a download="<?php the_title_attribute(); ?>-POSTER" title="Download poster <?php the_title_attribute(); ?>" target="_BLANK" href="<?php
                            if ($thumb_id) {
                                echo $thumb_url[0];
                            } else {
                                dt_image('dt_poster', $post->ID, 'w600');
                            }
                            ?>" class="down">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/downPoster.png'; ?>" alt="baixar">
                            <div class="txt">POSTER</div>
                        </a>
                        <a download="<?php the_title_attribute(); ?>-WALLPAPER" title="Download image WALLPAPER <?php the_title_attribute(); ?>" target="_BLANK" href="<?php dt_get_images("original", $post->ID); ?>" class="down">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/downWallpaper.png'; ?>" alt="baixar">
                            <div class="txt">WALLPAPER</div>
                        </a>
                    </div>
                    <img src="<?php
                    if ($thumb_id) {
                        echo $thumb_url[0];
                    } else {
                        dt_image('dt_poster', $post->ID, 'w600');
                    }
                    ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
                </div>

                <div class="infos">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <div class="titleEng"><b>Original Title:</b>
                        <h2>
                            <?php if ($d = $dt_original_title) { ?>
                            <?php echo $d; ?>
                            <?php } ?>

                        </h2>
                    </div>

                    <div class="genre">
                        <?php echo get_the_term_list($post->ID, 'genres', ' ', ' ', ' '); ?>
                    </div>
                    <div class="times">
                        <span>
                            <b>Year:</b>
                            <?php if ($d = $dt_date1) { ?>
                            <?php echo $d->format(DT_TIME); ?><?php } ?>
                        </span> 
                        <span><b>Seasons:</b> 
                            <?php if ($d = $dt_seasons) { ?><?php echo $d; ?> Episodes: <?php if ($d = $dt_episodes) { ?><?php echo $d; ?>
                                <?php } ?>
                                <?php } ?>
                            </span>
                        </div>

                        <div class="director"><b>Director:</b> <?php diretor($post->ID, "img", true); ?>
                            <b><?php echo get_the_term_list($post->ID, 'dtnetworks', '', '', ''); ?></b>
                        </div>
                        <div class="actors">
                            <b>Stars:</b>
                            <?php atores($post->ID, "img", true); ?>
                        </div>
                        <br>
                        <div class="plot">
                            <b>SYNOPSIS:</b><br>
                            <span class="AllThePlot superClose">
                                <?php the_content(); ?>
                                <?php
                                if (get_option('ads_ss_2') == "true") {
                                    if ($ads = get_option('ads_spot_single')) {
                                        echo '<div class="module_single_ads">' . stripslashes($ads) . '</div>';
                                    }
                                }
                                ?>
                            </span>
                            <div class="texter"></div>
                        </div>
                    </div>
                    <div class="rightShit wow fadeInRight">
                        <div class="imdb">
                            <a href="<?php
                            if ($d = $dt_id_tvshow) {
                                echo ' https://www.themoviedb.org/tv/', $d, ' ';
                            };
                            ?>" target="_BLANK">
                            <div class="vote">
                                <div class="canvasAnim"></div>
                                <div class="canvasBg"></div>
                                <div id="imdbRatingCanvas" data-percent="<?php
                                $valor = $dt_tmdb_rating;
                                $valor = str_replace(".", "", $valor);
                                $valor = str_pad($valor, 2, "0");
                                if ($valor > 10) {
                                    echo $valor;
                                } elseif ($valor = 10) {
                                    $texto = $valor;
                                    echo str_replace("0", "00", $texto);
                                }
                                ?>"></div>
                                <div class="imdbOpen">
                                    <i class="fa fa-external-link "></i>
                                    SEE NO <b>TMDB</b>
                                </div>
                                <?php if ($d = $dt_tmdb_rating) { ?>
                                <?php echo str_pad($d, 3, ".0"); ?><?php
                            } else {
                                echo "N/A";
                            }
                            ?><div class="of">/10</div>
                        </div>
                    </a>
                </div>
                <div class="info">
                    <div class="views">
                        <span>Views</span>
                        <b><?php echo wpmidia_get_post_views($post->ID); ?></b>
                    </div>
                    <div class="likes">
                        <span>Comments</span>
                        <b><?php printf(_n('%1$s &ldquo;%2$s&rdquo;', get_comments_number(), 'vizer'), number_format_i18n(get_comments_number()), get_the_title()); ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toolBar row wrapi">
    <div class="itemTools">
        <a id="open-trailer" class="btn iconized trailer" data-trailer="<?php $trailers = get_post_meta($post->ID, "youtube_id", $single = true);
            mostrar_trailer_iframe($trailers)
            ?>"><b>trailer</b> <i class="icon fa fa-play"></i>
        </a>

        <a class="btn share-btn facebook" target="_BLANK" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>fifty-shades-darker/online"><i class="fa fa-facebook"></i>
        </a>
        <a class="btn share-btn twitter" target="_BLANK" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i>
        </a>
        <a class="btn share-btn google" target="_BLANK" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i>
        </a>
        <div class="btn cinema iconized cinemaModeButton open">
            CINEMA MODE <i class="icon fa fa-tv"></i>
        </div>
        <?php if (is_user_logged_in()) { ?>
        <div class="right">

            <div class="btn opt-button players changePlayer">
                <i class="icon fa fa-list"></i>
                <div class="txt">PLAYERS</div>
            </div>
            <?php echo get_simple_likes_button(get_the_ID()); ?>
            <?php get_template_part('inc/parts/single/report'); ?>
        </div>
        <?php } else { ?>
        <div class="right">

            <div class="btn opt-button players changePlayer">
                <i class="icon fa fa-list"></i>
                <div class="txt">PLAYERS</div>
            </div>
            <div class="btn iconized login open-login">
                LOG IN <i class="icon fa fa-user"></i>
            </div>
            <a href="<?php echo esc_url(home_url('/wp-login.php?action=register')); ?>" target="_BLANK">
                <div class="btn iconized register">
                    REGISTER <i class="icon fa fa-id-card-o"></i>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>
<div class="clearfix"></div>
<?php get_template_part('inc/parts/single/listas/se_ep'); ?>
<div class="episode superClose">
    <div class="row wrapi">
        <div id="episodes" class="series-slider">
        </div>
    </div>
</div>

<div class="fullplayer">
    <div class="row wrapi">
        <div class="mov-title-bar"></div>

        <div class="appendAdbHere"></div>

        <div class="coolSeoTitle"><h1>Watch <b><?php the_title_attribute(); ?></b> Online</h1></div>

        <div class="clearfix"></div>

        <div class="playerList playerListSmall seriesPlist">
            <div class="clearfix"></div>
            <div class="text">CHOOSE ONE <b>SEASON</b></div>         
            <div class="list"></div>
        </div>

        <div class="clearfix"></div>

        <div class="player" id="player_content"></div>
    </div>
</div>

<div class="clearfix" id="reportar"></div>
<div class="row wrapi ">
    <div class="slowSpeed">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/speed.png'; ?>" alt="Filmes online">
        <div class="big">Slow loading?</div>
        <div class="sub">
            Did you know your carrier blocks the player download limit? <br>
            Internet providers have limited the speed of streaming sites such as <?php bloginfo('name'); ?>, so it seems to be super slow! 
        </div>
    </div>
</div>
<div class="clearfix"></div>

<?php comments_template('/parts/comments.php'); ?>

<?php get_sidebar(); ?>
<div class="clearfix"></div><br>
</div>
</div>
<div class="banner_ads"></div>
<script src="<?php echo $src = get_template_directory_uri() . '/assets/js/general.js?v3.2'; ?>" ></script>
<script>
    $('#seasons').owlCarousel({
        margin: 0,
        autoWidth: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });
    $(document).on('click', '.get_episodes', function (e) {
        e.preventDefault();
        $('.get_episodes').removeClass("active");
        $(this).addClass("active");
    });
</script>
<script>

    $(document).on('click', '.get_episodes', function (e) {
        e.preventDefault();
        var season = $(this).attr("data-row-id");
        var post_id = <?php echo $post->ID ?>;
        var dataS = 'post_id=' + post_id + '&episodeos=' + season;

        if (season) {

            $('.get_episodes').removeClass("active");
            $(this).addClass("active");
            $.ajax({
                type: "POST",
                url: "<?php echo get_template_directory_uri() . '/inc/parts/single/listas/se.php'; ?>",
                data: dataS,
                cache: false,
                success: function (html) {

                    var divContent = $("#episodes");
                    divContent.empty();
                    divContent.append(html);
                    divContent.append('<div class="item get_player"></div>');
                    divContent.trigger('destroy.owl.carousel');

                    $(".playerList .text").fadeOut().empty().html("CHOOSE ONE <b>EPISODES</b>").fadeIn();

                    $(".episode").show();
                    $('#episodes').trigger('destroy.owl.carousel');
                    $('#episodes').owlCarousel({
                        margin: 0,
                        autoWidth: true,
                        nav: true,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                    });

                }
            });
        }
        return false;
    });

    $(document).on('click', '.get_player', function (e) {
        $("#player_content").empty();
        var me = $(this);
        e.preventDefault();

        var iSawThis = "false";
        if ($(this).hasClass("seen")) {
            iSawThis = "true";
        }

        var episode = $(this).attr("data-row-id");
        var dataS = 'players=' + episode;

        if (episode) {
            $('.get_player').removeClass("active");
            $(this).addClass("active");

            $.ajax({
                type: "POST",
                url: "<?php echo get_template_directory_uri() . '/inc/parts/single/player.php'; ?>",
                data: dataS,
                cache: false,
                success: function (html) {

                    $(".playerList .text").fadeOut().empty().html("CHOOSE ONE <b>PLAYER</b>").css("margin-top", "50px").fadeIn();
                    $(".playerList .list").empty();
                    $(".playerList .list").append(html);
                    $(".playerList").show();
                    $(".coolSeoTitle").show();
                    $('#episodes').owlCarousel({
                        margin: 0,
                        autoWidth: true,
                        nav: true,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                    });

                }
            });
        }
    });
</script>
<?php endwhile;
endif;
?>

<?php global $user_ID;
if ($user_ID) : if (current_user_can('level_10')) : if ($dt_reports) {
    ?>
    <div class="reports_notice_admin">
        <span class="num"><?php echo $dt_reports; ?></span>
        <span class="report"><?php _e('Reports', 'mtms'); ?></span>
        <span><a href="<?php the_permalink() ?>?report=ready" class="delete_notice">
            <?php _e('Delete notice', 'mtms'); ?></a></span>
        </div>
        <?php } endif;
        endif;
        ?>