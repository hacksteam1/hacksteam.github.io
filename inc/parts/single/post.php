<?php get_header();
$my_meta = get_post_meta($post->ID, '_my_meta', TRUE);
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
	.midHead{background-image:url(<?php if ($my_meta['imagem_fundo']) {
		echo $my_meta['imagem_fundo'];
	} else {
		echo get_template_directory_uri() . '/assets/img/fundo.jpg';
	} ?>);} 
	.newComment .errorMsg{position: absolute;bottom: -30px;left: 0;width: 100%;height: 30px;font-size: 10px;letter-spacing:.5px;line-height: 30px;z-index:100;display:none;font-weight: 300;color: #FFF;text-align: center;text-transform: uppercase;background-color: rgb(222,84,73);}
	.newComment .errorMsg a{font-weight: 700;}
</style>
<script>
	function modalteste(message) {
		$(".modal").fadeOut(200, function () {
			$(this).remove()
		});
		$(".modalL").fadeOut(200, function () {
			$(this).remove()
		});
		$("body").append('<div id="download-frame" style="display: block;"><div class="title"><b>Download</b> <?php $titulo = get_the_title();
			echo ucwords($titulo); ?></div><div class="subtitle">Download</div><?php if ($my_meta['player_1']) {
				echo '<a target="_BLANK" href="' . $my_meta['player_1'] . '" class="player">HD w/ Subtitled<i class="fa fa-play"></i></a><br>';
			} ?><?php if ($my_meta['player_2']) {
				echo '<a target="_BLANK" href="' . $my_meta['player_2'] . '" class="player">Server 1<i class="fa fa-play"></i></a><br>';
			} ?><?php if ($my_meta['legenda']) {
				echo '<div class="subtitle">Legend</div><a target="_BLANK" class="subtitle" href="' . $my_meta['legenda'] . '">Legenda <i class="fa fa-list"></i></a><br>acera-options/';
			}
			?><a href="#" class="closeDownload hover">Fechar <i class="fa fa-close"></i></a></div>');
		$("body .modalL").fadeIn(200).css("display", "table")
	}
</script>
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
							DOWNLOAD THE IMAGES                           
						</div>
						<a download="<?php the_title_attribute(); ?>-POSTER" title="Download Poster <?php the_title_attribute(); ?>" target="_BLANK" href="<?php the_post_thumbnail_url(); ?>" class="down">
							<img src="<?php echo get_template_directory_uri() . '/assets/img/downPoster.png'; ?>" alt="baixar">
							<div class="txt">POSTER</div>
						</a>
						<a download="<?php the_title_attribute(); ?>-WALLPAPER" title="Download image WALLPAPER <?php the_title_attribute(); ?>" target="_BLANK" href="<?php echo $my_meta['imagem_fundo']; ?>" class="down">
							<img src="<?php echo get_template_directory_uri() . '/assets/img/downWallpaper.png'; ?>" alt="baixar">
							<div class="txt">WALLPAPER</div>
						</a>
					</div>
					<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
				</div>

				<div class="infos">
					<h2 class="title"><?php the_title(); ?></h2>
					<div class="titleEng"><b>Original Title:</b> <h2><?php echo $my_meta['torig']; ?></h2></div>

					<div class="genre">
						<?php
						if (get_the_tag_list()) {
							echo get_the_tag_list(' ', ' ');
						}
						?>
					</div>
					<div class="times"><span><b>Year:</b> <?php echo $my_meta['ano']; ?></span> <span><b>Duration:</b> <?php echo $my_meta['durat']; ?></span></div>

					<div class="director"><b>Director:</b> <?php echo $my_meta['idioma']; ?></div>
					<div class="actors"><b>Stars:</b> <?php echo $my_meta['elenco']; ?></div>
					<br>
					<div class="plot">
						<b>SYNOPSIS:</b><br>
						<span class="AllThePlot superClose"><?php echo $my_meta['sinopse']; ?></span>
						<div class="texter"></div>
					</div>
				</div>
				<div class="rightShit wow fadeInRight">
					<div class="imdb">
						<a href="<?php echo $my_meta['imdb_link']; ?>" target="_BLANK">
							<div class="vote">
								<div class="canvasAnim"></div>
								<div class="canvasBg"></div>
								<div id="imdbRatingCanvas" data-percent="<?php
								$valor = $my_meta['imdb'];
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
								<?php
								if ($my_meta['imdb']) {
									echo $my_meta['imdb'];
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
			<a id="open-trailer" class="btn iconized trailer" data-trailer="https://www.youtube.com/embed/<?php echo $my_meta['key']; ?>?rel=0&showinfo=0"><b>trailer</b> <i class="icon fa fa-play"></i></a>

			<a class="btn share-btn facebook" target="_BLANK" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>fifty-shades-darker/online"><i class="fa fa-facebook"></i></a>
			<a class="btn share-btn twitter" target="_BLANK" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
			<a class="btn share-btn google" target="_BLANK" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a>

			<div class="btn download iconized" onclick="modalteste();">
				DOWNLOAD <i class="icon fa fa-download"></i>
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
				<a href="#reportar">
					<div class="btn  opt-button reportButton">
						<i class="icon fa fa-warning"></i>
						<div class="txt">REPORT</div>
					</div>
				</a>
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

				<?php if ($my_meta['url_1']) { ?>
				<div class="item" data-row-id="7705" data-player-content='<iframe src="<?php echo $my_meta['url_1']; ?>" scrolling="no" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""></iframe>'>
					<div class="icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/openload.png'; ?>" alt=""></div>
					<?php echo $my_meta['nome_1']; ?> HD Server                                                
				</div>
				<?php } ?>
				<?php if ($my_meta['url_2']) { ?>
				<div class="item" data-row-id="7705" data-player-content='<iframe src="<?php echo $my_meta['url_2']; ?>" scrolling="no" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""></iframe>'>
					<div class="icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/openload.png'; ?>" alt=""></div>
					<?php echo $my_meta['nome_2']; ?> HD Server     
				</div>
				<?php } ?>
				<?php if ($my_meta['url_3']) { ?>
				<div class="item" data-row-id="7705" data-player-content='<iframe src="<?php echo $my_meta['url_3']; ?>" scrolling="no" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""></iframe>'>
					<div class="icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/openload.png'; ?>" alt=""></div>
					<?php echo $my_meta['nome_3']; ?> HD Server
				</div>
				<?php } ?>
				<?php if ($my_meta['url_4']) { ?>
				<div class="item" data-row-id="7705" data-player-content='<iframe src="<?php echo $my_meta['url_4']; ?>" scrolling="no" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""></iframe>'>
					<div class="icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/openload.png'; ?>" alt=""></div>
					<?php echo $my_meta['nome_4']; ?> Server 1
				</div>
				<?php } ?>
				<?php if ($my_meta['url_5']) { ?>
				<div class="item" data-row-id="7705" data-player-content='<iframe src="<?php echo $my_meta['url_5']; ?>" scrolling="no" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""></iframe>'>
					<div class="icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/openload.png'; ?>" alt=""></div>
					<?php echo $my_meta['nome_5']; ?> Server 1
				</div>
				<?php } ?>
				<?php if ($my_meta['url_6']) { ?>
				<div class="item" data-row-id="7705" data-player-content='<iframe src="<?php echo $my_meta['url_6']; ?>" scrolling="no" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""></iframe>'>
					<div class="icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/openload.png'; ?>" alt=""></div>
					<?php echo $my_meta['nome_6']; ?> Server 1
				</div>
				<?php } ?>

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
<?php get_footer(); ?>
