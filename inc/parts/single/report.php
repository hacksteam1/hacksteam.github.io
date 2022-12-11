<?php 
$dt_player = get_post_meta($post->ID, 'repeatable_fields', true); 
$width = get_option('dt_width_layout','1100'); 
$light = get_option('dt_player_luces','true');
$report = get_option('dt_player_report','true');
$ads = get_option('dt_player_ads','not');
$qual = get_option('dt_player_quality','true');
$viewsc = get_option('dt_player_views','true');
$clic = get_option('dt_player_ads_hide_clic','true');
$time = get_option('dt_player_ads_time','20');
$ads_300 = get_option('dt_player_ads_300');

?>

<?php  if ($report =='true') : ?>

	
	<div class="btn  opt-button reportButton" id="report">
		<i class="icon fa fa-warning"></i>
		<div class="txt">REPORT</div>
	</div>

	<div id="reportreason">
		<i class="close-report fa fa-close"></i>
		<span>Report <b><?php the_title(); ?></b> </span>
		<?php get_template_part('inc/parts/single/report-video');  ?>	
	</div>

<?php endif; ?>

<?php if($_GET[ 'report' ] =='send') { send_report(); } ?>

<script type='text/javascript'>
	$(document).ready(function(){
		$("#oscuridad").css("height", $(document).height()).hide();
		$(".lightSwitcher").click(function(){
			$("#oscuridad").toggle();
			if ($("#oscuridad").is(":hidden"))
				$(this).html("<i class='icon-wb_sunny'></i>").removeClass("turnedOff");
			else
				$(this).html("<i class='icon-wb_sunny'></i>").addClass("turnedOff");
		});
	});
	<?php  if ($ads =='true') : ?>
	var segundos = <?php echo $time; ?>; 
	function ads_time(){  
		var t = setTimeout("ads_time()",1000);  
		document.getElementById('contador').innerHTML = '' +segundos--+'';  
		if (segundos==0){
			$('#playerads').fadeOut('slow');
			$('#count').fadeOut('slow');
			clearInterval(setTimeout);
		}  
	}  
	ads_time();
<?php endif; ?>
<?php if ($clic =='true'): ?>
	$(".code").click(function() {
		$("#playerads").fadeOut("slow");
		$("#count").fadeOut("slow");
	});
	$(".notice").click(function() {
		$("#playerads").fadeOut("slow");
		$("#count").fadeOut("slow");
	});
<?php endif; ?>
</script>


