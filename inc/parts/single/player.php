<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../../../wp-load.php');
?>
<?php
$players_id = $_POST['players'];
$dt_player = get_post_meta($players_id, 'repeatable_fields', true);
$width = get_option('dt_width_layout', '1100');
$light = get_option('dt_player_luces', 'true');
$report = get_option('dt_player_report', 'true');
$ads = get_option('dt_player_ads', 'not');
$qual = get_option('dt_player_quality', 'true');
$viewsc = get_option('dt_player_views', 'true');
$clic = get_option('dt_player_ads_hide_clic', 'true');
$time = get_option('dt_player_ads_time', '20');

?>
<?php if ($dt_player) : ?>
	<script>
		$('.playerList .item').on('click', function(e) {
			$(".fullplayer .player").hide();
			$(".prepareVideo").hide();
			$(".fullplayer .playerList").hide();
			$(this).addClass("active");
			var playerData = $(this).attr("data-player-content");
			$(".fullplayer .player").append(playerData);
			$(".fullplayer .player").show();
		});
	</script>
	
	<?php $numerado = 1;
	{
		foreach ($dt_player as $field) { ?>
		<div class="item get_player_content" data-player-content='<iframe src="<?php echo $field['url']; ?>" scrolling="no" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""></iframe>'>
			<div class="icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/openload.png'; ?>" alt=""></div>
			<?php if ($field['select'] == 'iframe') { ?>
			Server 1
			<?php } if ($field['select'] == 'mp4') { ?>
			HD Server
			<?php }?>     
		</div>
		<?php $numerado++;
	}
} ?> 
<?php endif; ?>