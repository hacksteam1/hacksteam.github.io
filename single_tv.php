<?php
/*
  Single Post Template: Modelo de TV
  Description: modelo de para post de Canais de tv!
 */
  ?>
  <?php get_header(); 
  $my_meta = get_post_meta($post->ID, '_my_meta', TRUE); ?>

  <div class="wrapper" style="background-image: url(<?php  echo $my_meta['imagem_fundo_tv']; ?>);">

  	<div id="channel" class="row mini">

  		<img class="present" src="<?php  echo $my_meta['imagem_fundo_tv_ps']; ?>" alt="">


  		<div class="playerlist">

  			<?php if ($my_meta['url_11']) { ?>
  				<div class="openplayer hover" data-player="<center><iframe src='<?php echo $my_meta['url_11'] ?>' scrolling='no' class='playerClasses' allowfullscreen frameborder='0'></iframe></center>">
  				<?php echo $my_meta['nome_11']; ?>
  				</div>
  			<?php } ?>
  			<?php if ($my_meta['url_12']) { ?>
  				<div class="openplayer hover" data-player="<center><iframe src='<?php echo $my_meta['url_12'] ?>' scrolling='no' class='playerClasses' allowfullscreen frameborder='0'></iframe></center>">
  				<?php echo $my_meta['nome_12']; ?>
  				</div>
  			<?php } ?>
  		</div>

  		<div class="player">

  			<div class="ppp" style="display:block;text-align:center;padding-left:20px;overflow:hidden;padding-top:10px;">
  				<div class="textChoose">
  					Escolha um <b>PLAYER</b>
  				</div>
  			</div>

  			<div class="clearfix"></div>
  			<div class="warn">
  				<img src="<?php echo get_template_directory_uri() . '/assets/img/player.png'; ?>" alt="">
  			</div>
  			<div class="clearfix"></div>
  		</div>
  		<?php comments_template('/parts/comments-tv.php'); ?>
  		<div class="clearfix"></div>
  		<br>
  	</div>
  </div>

  <!-- Site Footer -->
</div>
<div class="banner_ads"></div>
<script>

	$('.openplayer').on('click', function(e) {
		$('.openplayer').removeClass("active");
		$(this).addClass("active");
		var player = $(this).attr("data-player");
		$(".player .ppp").empty();
		$(".player .ppp").append(player);
	});
</script>

<?php get_footer(); ?>