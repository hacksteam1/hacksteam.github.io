<?php 
/*
Template Name: DT - Posts page
*/
?>
<?php get_header(); ?>
<style>

	.owl-item a.linker{
		position: relative;
		display: block;
		padding: 0px;
		height: 300px;
	}

	.movies-list .owl-controls {
		top: -60px;
		right: -15px;
	}

	.movies-list .item.item-small {
		margin-top: 10px;
	}

	.movies-list .item .sort{
		display: none!important;
	}

	.movies-carousel .item{
		padding: 0px !important;
		margin-right: 10px!important;
		margin-top: 0px!important;
	}

	.movies-carousel .linker{
		height: auto!important;
	}

	.movies-list{

	}

</style>
<div class="wrapper">
	<div class="clearfix"></div>
	<div class="row filters theRow">
		<div class="filt butt hover active" data-filter="*">
			Show all
		</div>

		<div class="butt hover">
			Year
			<ul>
				<li class="filt" data-filter=".year-2017">2017</li>
				<li class="filt" data-filter=".year-2016">2016</li>
				<li class="filt" data-filter=".year-2015">2015</li>
				<li class="filt" data-filter=".year-2014">2014</li>
				<li class="filt" data-filter=".year-2013">2013</li>
				<li class="filt" data-filter=".year-2012">2012</li>
				<li class="filt" data-filter=".year-2011">2011</li>
				<li class="filt" data-filter=".year-2010">2010</li>
				<li class="filt" data-filter=":not(.year-2010, .year-2011, .year-2012, .year-2013, .year-2014, .year-2015, .year-2016, .year-2017)">Before 2010</li>
			</ul>
		</div>

		<div class="butt hover ord" data-sort-by="alfa">
			Alphabetical order
		</div>

		<input type="text" class="quicksearch" placeholder="Search">

	</div>

	<div class="row movies-list theRow" style="text-align: center;">

		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts(array(
			'showposts' => get_option('posts_per_page_blog','10'),
			'order' => 'DESC',
			'post_type' => 'post',
			'paged' => $paged)
			); ?>
		<?php if (have_posts()) : while ( have_posts() ) : the_post(); 
		$thumb_id = get_post_thumbnail_id();
		$thumb_url =  wp_get_attachment_image_src($thumb_id,'dt_episode_a', true);
		?>
		<?php get_template_part('inc/parts/post'); ?>
	<?php endwhile;  else: ?>
	<div class="dt-no-post"><?php _e('No posts to show','mtms'); ?></div>
<?php endif; ?>

</div>
</div>
<?php basey_pagination(); ?>
<script src="<?php echo $src = get_template_directory_uri() . '/assets/js/isotope.js'; ?>" ></script>
<script>

	$(function () {

		var qsRegex;

		var $grid = $('.movies-list').isotope({
			itemSelector: '.category-item',
			layoutMode: 'masonry',
			sortAscending: false,
			getSortData: {
				alfa: '.data-sort-title',
				recent: '.data-sort-ident parseInt',
				year: '.data-sort-year parseInt',
				rating: '.data-sort-rating parseInt'
			},
			sortAscending: {
				alfa: true,
				recent: false,
				year: false,
				rating: false
			},
			filter: function () {
				return qsRegex ? $(this).text().match(qsRegex) : true;
			}
		});

		var $quicksearch = $('.quicksearch').keyup(debounce(function () {
			qsRegex = new RegExp($quicksearch.val(), 'gi');
			$grid.isotope();
		}, 200));


		$('.filters .butt').on('click', function (e) {
			$('.filters .butt').removeClass("active");
			$(this).addClass("active");
		});

		$('.filters .filt').on('click', function (e) {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({
				filter: filterValue
			});
		});

		$('.filters .ascendente').on('click', function (e) {
			$grid.isotope({
				sortAscending: true,
			});
		});

		$('.filters .descendente').on('click', function (e) {
			$grid.isotope({
				sortAscending: false,
			});
		});

		$('.filters .ord').on('click', function (e) {
			var filterValue = $(this).attr('data-sort-by');
			$grid.isotope({
				sortBy: filterValue
			});

		});

		function debounce(fn, threshold) {
			var timeout;
			return function debounced() {
				if (timeout) {
					clearTimeout(timeout);
				}
				function delayed() {
					fn();
					timeout = null;
				}
				timeout = setTimeout(delayed, threshold || 100);
			}
		}

		var $win = $(window),
		$con = $('.movies-list'),
		$imgs = $("div.lazy");

		$con.isotope();

		$con.on('layoutComplete', function () {
			$win.trigger("scroll");
		});

		$imgs.lazyload({
			failure_limit: Math.max($imgs.length - 1, 0)
		});

	});

</script>
<?php get_footer(); ?>