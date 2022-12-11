
<?php
$tmdb = get_post_meta($post->ID, "ids", $single = true);
$current_season = get_post_meta($post->ID, "temporada", $single = true);
$data = season_of($tmdb);
if(!empty($data)){ ?>

<?php 
$temporada = $data['temporada']['all'];
$capitulos = $data['capitulo']['all'];
foreach($temporada as $key_t=>$value_t){
	foreach($capitulos as $key_c=>$value_c){
		if($value_t['season'] == $value_c['season']){
			if($value_c['season'] == $current_season){
				?>
				<div class="item get_player" data-row-id="<?php echo $value_c['id']; ?>"> <?php echo data_of('episodio', $value_c['id']); ?>º episode </div>
				<?php	
			} 
		} 
	} 
}
} 
?>


