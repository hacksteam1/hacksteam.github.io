<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');
?>
<p style="color:#000;"><strong>Last 5 posts</strong></p>
<?php
query_posts(
    array(
        'showposts' => 5,
        )
    );
?>
<?php global $wp_query; while ( have_posts() ) : the_post(); ?>
<a href="<?php the_permalink(); ?>"><p style="color:#000;"><?php the_title(); ?></p></a>
<?php
$i++;
endwhile;
?>
<?php
wp_reset_query();
?>