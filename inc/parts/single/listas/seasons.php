
<?php
$postid = $post->ID;
$tmdb = get_post_meta($post->ID, "ids", $single = true);
$ic = season_of($tmdb);
if(!empty($ic)){ ?>
<div id="seasons" class="sseasons">
<?php
$seasons = $ic['temporada']['all'];
$episodes = $ic['capitulo']['all'];
if(!empty($seasons)) { }
$accountant = 0; foreach($seasons as $key_t=>$value_t) { ?>
<a href="<?php the_permalink() ?>?tab=se-ep">
<div class="se-c">
	<div class="se-q">
		<span class="se-t"><?php echo $value_t['season']; ?></span>
		<span class="title"><?php _e('Season','mtms'); ?>  <?php echo $value_t['season']; ?> <i><?php $date = new DateTime(data_of('air_date', $value_t['id'])); echo $date->format(DT_TIME); ?></i>
			<div class="se_rating"><div class="se_rating_valor" style="width:<?php echo data_of('_starstruck_avg', $value_t['id'])*10; ?>%"></div></div>
		</span>
	</div>
</div>
</a>
<?php
$accountant++; 
} ?>
</div>
<?php } ?>
