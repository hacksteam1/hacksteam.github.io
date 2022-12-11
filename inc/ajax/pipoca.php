<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');
?>
<div class="part">
	<img src="<?php echo get_template_directory_uri() . '/assets/img/movieNight.png'; ?>" alt="">
</div>
<div class="part">
	<div class="title">Ingredients:</div>
	<ul>
		<li>1 cup corn for popcorn</li>
		<li>1 cup sugar (white or yellow)</li>
		<li>5 tablespoons of oil</li>
	</ul>
</div>
<div class="part">
	<div class="title">To make popcorn:</div>
	<ul>
		<li>Add the corn and oil in the pan over low heat.</li>
		<li>Cover and cook and wait a few minutes.</li>
		<li>Hold the lid so that it does not pop.</li>
		<li>When the corn stops bursting, turn the fire off because it is ready.</li>
		<li>Reserve the popcorn out of the pan.</li>
	</ul>
</div>
<div class="part">
	<div class="title">To make caramel:</div>
	<ul>
		<li>Add the sugar in the same pan over low heat./li>
		<li>Let the sugar melt.</li>
		<li>Stir the sugar without stopping to not burn.</li>
		<li>When the sugar becomes liquid, add the popcorn and mix very well.</li>
		<li>Now just watch a movie on the <?php bloginfo('name'); ?>, and eat popcorn!</li>
	</ul>
</div>
