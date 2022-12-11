<?php

function pedidos() {
	$labels = array(
		'name'                => __d('Pedidos'),
		'singular_name'       => __d('Pedidos'),
		'menu_name'           => 'Pedidos',
		'name_admin_bar'      => __d('Pedidos'),
		'all_items'           => __d('Pedidos'),
	);
	$rewrite = array(
		'slug'                => get_option('dt_pedido_slug','pedido'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __d('Pedidos'),
		'description'         => __d('Gerir Pedidos'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor','comments','thumbnail'),
		'taxonomies'          => array('genres'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-status',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type('pedido', $args );
}
add_action('init', 'pedidos', 0 );

add_filter('manage_pedido_posts_columns', 'pedidos_table_head');
function pedidos_table_head( $defaults ) {
    $defaults['pedidos']  = __d('Nº de Pedidos');
    return $defaults;
}
add_action('manage_pedido_posts_custom_column', 'pedidos_table_content', 10, 2 );
function pedidos_table_content( $column_name, $post_id ) {
	if ($column_name == 'pedidos') {
		if($views = get_post_meta( $post_id, "_post_like_count", true )) {
			echo $views;
		} else {
			echo '0';
		}
	}
}

// Pendientes
add_action('auth_redirect', 'add_pending_count_filter');
add_action('admin_menu', 'esc_attr_restore');
function add_pending_count_filter_p() {
  add_filter('attribute_escape', 'remove_esc_attr_and_count', 20, 2);
}
function esc_attr_restore_p() {
  remove_filter('attribute_escape', 'remove_esc_attr_and_count', 20, 2);
}
function remove_esc_attr_and_count_p( $safe_text = '', $text = '') {
  if ( substr_count($text, '%%PENDING_COUNT%%') ) {
    $text = trim( str_replace('%%PENDING_COUNT%%', '', $text) );
    remove_filter('attribute_escape', 'remove_esc_attr_and_count', 20, 2);
    $safe_text = esc_attr($text);
    $count = (int)wp_count_posts('pedidos',  'readable')->pending;
    if ( $count > 0 ) {
      $text = esc_attr($text) . '<span class="awaiting-mod count-' . $count . '" style="margin-left:7px;"><span class="pending-count">' . $count . '</span></span>';
      return $text;
    } 
  }
  return $safe_text;
}
