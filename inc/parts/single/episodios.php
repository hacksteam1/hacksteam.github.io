<?php 
// Movies Meta data
$dt_date = new DateTime(dt_get_meta('air_date'));
$name	= dt_get_meta('episode_name');
$serie = dt_get_meta('serie');
$ids = dt_get_meta('ids');
$temp = dt_get_meta('temporada');
$epis = dt_get_meta('episodio');
$poster = dt_get_meta('dt_poster');
$backdrop = dt_get_meta('dt_backdrop');
$dt_images = dt_get_meta('imagenes');
$dt_reports         = dt_get_meta('numreport');
$dt_player = get_post_meta($post->ID, 'repeatable_fields', true);
if( isset( $_GET[ 'player' ] ) ) {  
	$tabp = $_GET[ 'player' ];  
	} else {
		$tabp = '';
	}

if( isset( $_GET[ 'tab' ] ) ) {  
	$tab = $_GET[ 'tab' ];  
		} else {
			$tab = '';
        }
$dato = $_GET['tab'];
?>
<?php  if (have_posts()) :while (have_posts()) : the_post();
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); 
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
					<div class="titleEng"><b>Original Title:</b> <h2><?php if($d = $dt_title_original) { ?>
						<?php echo $d; ?>
						<?php }?></h2></div>

						<div class="genre">
							<?php echo get_the_term_list($post->ID, 'genres', ' ', ' ', ' '); ?>
						</div>
						<div class="times"><span><b>Year:</b> <?php if($d = $dt_date) { echo '', $d->format(DT_TIME), ''; } ?></span>
							<span><b>Duration:</b> <?php if($d = $dt_runtime) { echo $d, ' ', 'min'; }; ?></span>
						</div>

						<div class="director"><b>Director:</b> <?php  $terms = get_the_term_list($post->ID, 'dtdirector', ' ', ', ', ' ');
							echo $terms = strip_tags($terms); ?>
						</div>

						<div class="actors"><b>Stars:</b> <?php $terms = get_the_term_list($post->ID, 'dtcast', ' ', ', ', ' ');
							echo $terms = strip_tags($terms); ?>
						</div>
						<br>
						<div class="plot">
							<b>SYNOPSIS:</b><br>
							<span class="AllThePlot superClose"><?php the_content(); ?>
								<?php if(get_option('ads_ss_1') =="true") { if($ads = get_option('ads_spot_single')) { echo '<div class="module_single_ads">'. stripslashes($ads). '</div>'; } } ?></span>
								<div class="texter">	
								</div>
							</div>
						</div>
						<div class="rightShit wow fadeInRight">
							<div class="imdb">
								<a href="<?php if($d = $dt_apid) { echo 'http://www.imdb.com/title/', $d, ' '; }; ?>" target="_BLANK">
									<div class="vote">
										<div class="canvasAnim"></div>
										<div class="canvasBg"></div>
										<div id="imdbRatingCanvas" data-percent="<?php
										if ($dt_rating_imdb) {
											$valor = $dt_rating_imdb;
										}else{$valor =$dt_rating_tmdb;} 
										$valor = str_replace(".", "", $valor);
										if ($valor > 10) {
											echo $valor;
										} elseif ($valor = 10) {
											$texto = $valor;
											echo str_replace("0", "00", $texto);
										}
										?>"></div>
										<div class="imdbOpen">
											<i class="fa fa-external-link "></i>
											SEE NO <b>IMDB</b>
										</div>
										<?php if($d = $dt_rating_imdb) { ?>
										<?php echo '', $d, '', ' '; ?>
										<?php }else {
											echo $dt_rating_tmdb;
										}?><div class="of">/10</div>
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
					<a id="open-trailer" class="btn iconized trailer" data-trailer="<?php $trailers = get_post_meta($post->ID, "youtube_id", $single = true); mostrar_trailer_iframe($trailers) ?>"><b>trailer</b> <i class="icon fa fa-play"></i></a>

					<a class="btn share-btn facebook" target="_BLANK" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>fifty-shades-darker/online"><i class="fa fa-facebook"></i></a>
					<a class="btn share-btn twitter" target="_BLANK" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
					<a class="btn share-btn google" target="_BLANK" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a>

					<div class="btn download iconized download-button">
						Download <i class="icon fa fa-download"></i>
					</div>

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

						<?php get_template_part('inc/parts/single/report');  ?>

						<?php if(get_option('dt_permissions_post_links')=="a00") { global $user_ID; if( $user_ID ) : if( current_user_can('administrator') ) : ?>
							<a href="#dt_contenedor " class="addlink">
								<div class="btn opt-button likeButton">
									<i class="icon fa fa-unlink"></i>
									<div class="txt">ADD LINK</div>

								</div>
							</a>
						<?php endif; endif; } ?>
						<?php get_template_part('inc/parts/form_send_link'); ?>

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

			<div class="row wrapi wow fadeIn">
				<div class="fullplayer">

					<div class="superHidderCinema"></div>

					<div class="coolSeoTitle"><h1>Watch <b><?php the_title_attribute(); ?></b> Online</h1></div>

					<div class="appendAdbHere"></div>


					<div class="playerList playerListSmall">
						<div class="text">
							CHOOSE ONE <b>PLAYER</b>
						</div>  
						<?php get_template_part('inc/parts/single/listas/player-filmes'); ?>
						<div class="clearfix"></div>
					</div>
					<div class="player"></div>
				</div>
			</div>

			<div class="clearfix"></div>

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

			<div  class="clearfix"></div>

			<?php comments_template('/parts/comments.php'); ?>

			<?php get_sidebar(); ?>
			<div class="clearfix"></div><br>

		</div>

		<!-- Site Footer -->
	</div>
	<script>
		$(document).on('click', '.download-button', function () {
			var id_post= <?php echo $post->ID ?>;
			var dataS = "download="+id_post;
			$.ajax({
				type: "GET",
				url: "<?php echo get_template_directory_uri() . '/inc/parts/single/listas/links.php'; ?>",
				data: dataS, 
				cache: false,
				success: function(html){
					$('body').prepend(html);
					$('#download-frame').fadeIn();
				}
			});

		});
	</script>
<?php endwhile; endif; ?>