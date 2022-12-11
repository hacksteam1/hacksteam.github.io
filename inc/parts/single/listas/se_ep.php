
<?php
$postid = $post->ID;
$tmdb = get_post_meta($post->ID, "ids", $single = true);
$ic = season_of($tmdb);
if(!empty($ic)){ ?>

<?php
$seasons = $ic['temporada']['all'];
$episodes = $ic['capitulo']['all'];
if(!empty($seasons)) { 
	echo '<div class="season">
	<div class="row wrapi series-slider movies-carousel" id="seasons" data-loader="movies">'; 
	}
	$accountant = 0; foreach($seasons as $key_t=>$value_t) { ?>
	<div class="item get_episodes changePlayer" data-row-id="<?php echo $value_t['id']; ?>">
		<?php echo $value_t['season']; ?>ª season
	</div>
	<?php
	$accountant++; 
}
if(!empty($seasons)){echo '</div></div>';
}
?>
<?php } ?>