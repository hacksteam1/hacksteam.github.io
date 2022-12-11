<?php if(get_option('dt_mt_random_order') == 'true') {
	$rand = 'rand';
} else {
	$rand = '';	
} ?>
<div class="clearfix"></div>
<div class="header nopadding seriesOnline">
	<div class="letter"><i class="fa fa-list"></i> <?php echo get_option('dt_mt_title','Séries'); ?></div>
	<div class="button active hover" data-type="series" data-what="lastEpisodes">Latest episodes</div>
	<div class="button hover" data-type="series" data-what="recommendes">Recommended</div>
	<div class="button hover" data-type="series" data-what="mostseenn">Most Views</div>
</div>
<div class="clearfix"></div>

<div class="items movies-carousel movies-list semMargem" data-loader="series">   
	<?php query_posts( array('post_type' => array('tvshows'), 'showposts' => get_option('dt_mt_number_items','10'), 'orderby' => $rand, 'order' => 'desc' )); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part('inc/parts/item_bb'); ?>
	<?php endwhile; wp_reset_query(); ?>
</div>