<?php 
// Meta datos
$ids		= dt_get_meta('ids');
$temp		= dt_get_meta('temporada');
$airdate	= new DateTime(dt_get_meta('air_date'));
$serie		= dt_get_meta('serie');
// Imagenes
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
?>
<?php if (have_posts()) :while (have_posts()) : the_post();?>
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
		.midHead{background-image:url(<?php dt_image('dt_poster', $post->ID, 'original'); ?>);} 
		.newComment .errorMsg{position: absolute;bottom: -30px;left: 0;width: 100%;height: 30px;font-size: 10px;letter-spacing:.5px;line-height: 30px;z-index:100;display:none;font-weight: 300;color: #FFF;text-align: center;text-transform: uppercase;background-color: rgb(222,84,73);}
		.newComment .errorMsg a{font-weight: 700;}
	</style>
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
							<a download="<?php the_title_attribute(); ?>-POSTER" title="Download poster <?php the_title_attribute(); ?>" target="_BLANK" href="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w600'); } ?>" class="down">
								<img src="<?php echo get_template_directory_uri() . '/assets/img/downPoster.png'; ?>" alt="baixar">
								<div class="txt">POSTER</div>
							</a>
							<a download="<?php the_title_attribute(); ?>-WALLPAPER" title="Download image WALLPAPER <?php the_title_attribute(); ?>" target="_BLANK" href="<?php dt_get_images("original", $post->ID); ?>" class="down">
								<img src="<?php echo get_template_directory_uri() . '/assets/img/downWallpaper.png'; ?>" alt="baixar">
								<div class="txt">WALLPAPER</div>
							</a>
						</div>
						<img src="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w600'); } ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
					</div>

					<div class="infos">
						<h2 class="title"><?php the_title(); ?></h2>
						<div class="titleEng"><b>Original Title:</b> <h2><?php if($url = get_option('dt_tvshows_slug','tvshows')) { ?>
							<a href="<?php echo esc_url(home_url(). '/'.$url.'/'. sanitize_title($serie) .'/') ?>"><?php echo $serie; ?></a>
							<?php } ?></h2>
						</div>
						<div class="times">
							<span><b>Release:</b> <?php if($d = $airdate) { echo $d->format('d, M. Y'); } ?> 
							</span> 
						</div>
						<br>
						<div class="plot">
							<b>SYNOPSIS:</b><br>
							<span class="AllThePlot superClose"><?php the_content(); ?>
								<?php if(get_option('ads_ss_2') =="true") { if($ads = get_option('ads_spot_single')) { echo '<div class="module_single_ads">'. stripslashes($ads). '</div>'; } } ?></span>
								<div class="texter"></div>
							</div>
						</div>
						<div class="rightShit wow fadeInRight">
							<div class="imdb">
								<a href="#" target="_BLANK">
									<div class="vote">
										<div class="canvasAnim"></div>
										<div class="canvasBg"></div>
										<div id="imdbRatingCanvas" data-percent="0"></div>
										<div class="imdbOpen">
											<i class="fa fa-external-link "></i>
											SEE NO <b>TMDB</b>
										</div>
										N/A<div class="of">/10</div>
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

			<div class="season">
				<div class="row wrapi series-slider movies-carousel" id="seasons" data-loader="movies">
					<?php get_template_part('inc/parts/single/listas/te'); ?>
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
						<div class="text">CHOOSE ONE <b>EPISODES</b></div>         
						<div class="list">
						</div>
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

		</div>
	</div>

	<script src="<?php echo $src = get_template_directory_uri() . '/assets/js/general.js?v3.2'; ?>" ></script>
	<script>

		$('#seasons').owlCarousel({
			margin: 0,
			autoWidth: true,
			nav: true,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
	</script>
	<script>
		$(document).on('click', '.get_player', function(e) {
			$("#player_content").empty();
			var me = $(this);
			e.preventDefault();

			var iSawThis = "false";
			if ($(this).hasClass("seen")) { iSawThis = "true"; }

			var episode = $(this).attr("data-row-id");
			var dataS = 'players='+episode;

			if(episode){
				$('.get_player').removeClass("active");
				$(this).addClass("active");

				$.ajax({
					type: "POST",
					url: "<?php echo get_template_directory_uri() . '/inc/parts/single/player.php'; ?>",
					data: dataS,
					cache: false,
					success: function(html){    

						$(".playerList .text").fadeOut().empty().html("CHOOSE ONE <b>PLAYER</b>").css("margin-top", "50px").fadeIn();
						$(".playerList .list").empty();
						$(".playerList .list").append(html);
						$(".playerList").show();
						$(".coolSeoTitle").show();
						$('#episodes').owlCarousel({
							margin:0,
							autoWidth:true,
							nav:true,
							navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
						});

					}
				});
			}
		});
	</script>
<?php endwhile; endif; ?>