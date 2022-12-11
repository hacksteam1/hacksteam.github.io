<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../../../../wp-load.php');
$season = $_GET['download'];
?>
<div id="download-frame">
	<div class="title"><b>Download</b> <?php echo get_the_title($season); ?></div>
	<?php

	$idts = get_post_meta($season, "dt_string", $single = true);
	$data = link_of($idts); if(!empty($data)){ ?>

	<div class="subtitle">Player</div>
	<?php 
	$dato = $data['dt_string']['all'];
	foreach($dato as $key_t=>$value_t){
		$tipo = data_of('links_type',$value_t['id']);	
		if($value_t['dt_string'] == $value_c['dt_string']){ ?>

		<?php if ($tipo =='Legenda') { ?>

		<div class="subtitle">Legenda</div>
		<a id="<?php echo data_of('dt_string',$value_t['id']); ?>" class="subtitle" href="<?php echo get_permalink( $value_t['id'] ); ?>" target="_blank"><?php echo $tipo; ?><i class="fa fa-list"></i></a><br>

		<?php }else{ ?>

		<a id="<?php echo data_of('dt_string',$value_t['id']); ?>" class="player" href="<?php echo get_permalink( $value_t['id'] ); ?>" target="_blank">Audio <?php echo data_of('links_idioma',$value_t['id']); ?><i class="fa fa-play"></i></a><br>

		<?php } }  } ?>

		<?php } else { ?>
		
		
		<?php } ?>

		<a href="#" class="closeDownload hover">Close <i class="fa fa-close"></i></a>
	</div>
