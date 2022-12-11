<?php

function peliculas() {
	$labels = array(
		'name'                => __d('Filmes'),
		'singular_name'       => __d('Filmes'),
		'menu_name'           => __d('Filmes %%PENDING_COUNT%%'),
		'name_admin_bar'      => __d('Filmes'),
		'all_items'           => __d('Filmes'),
	);
	$rewrite = array(
		'slug'                => get_option('dt_filmes_slug','movies'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __d('Filmes'),
		'description'         => __d('Gerir Filmes'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor','comments','thumbnail'),
		'taxonomies'          => array('genres','dtquality'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-editor-video',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type('movies', $args );
}
add_action('init', 'peliculas', 0 );
get_template_part('inc/includes/peliculas/metabox'); 
add_filter('manage_movies_posts_columns', 'movie_table_head');
function movie_table_head( $defaults ) {
	$defaults['report']  = __d('Relatório');
    return $defaults;
}
add_action('manage_movies_posts_custom_column', 'movie_table_content', 10, 2 );
function movie_table_content( $column_name, $post_id ) {
	if ($column_name == 'report') {
		if($minutes = get_post_meta( $post_id, 'numreport', true )) {
			echo '<span class="dt_report_video">'. $minutes .'</div>';
		} else {
			echo "0";
		}
    }
}
// Pendientes
add_action('auth_redirect', 'add_pending_count_filter');
add_action('admin_menu', 'esc_attr_restore');
function add_pending_count_filter() {
  add_filter('attribute_escape', 'remove_esc_attr_and_count', 20, 2);
}
function esc_attr_restore() {
  remove_filter('attribute_escape', 'remove_esc_attr_and_count', 20, 2);
}
function remove_esc_attr_and_count( $safe_text = '', $text = '') {
  if ( substr_count($text, '%%PENDING_COUNT%%') ) {
    $text = trim( str_replace('%%PENDING_COUNT%%', '', $text) );
    remove_filter('attribute_escape', 'remove_esc_attr_and_count', 20, 2);
    $safe_text = esc_attr($text);
    $count = (int)wp_count_posts('movies',  'readable')->pending;
    if ( $count > 0 ) {
      $text = esc_attr($text) . '<span class="awaiting-mod count-' . $count . '" style="margin-left:7px;"><span class="pending-count">' . $count . '</span></span>';
      return $text;
    } 
  }
  return $safe_text;
}
