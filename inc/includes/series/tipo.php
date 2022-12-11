<?php

function series() {
	$labels = array(
		'name'                => _x('Séries', 'Nome do tipo de postagem','mtms'),
		'singular_name'       => _x('Séries', 'Nome Tipo Singular','mtms'),
		'menu_name'           => __d('Séries %%PENDING_COUNT_TV%%'),
		'name_admin_bar'      => __d('Séries'),
		'all_items'           => __d('Séries'),
		);
	$rewrite = array(
		'slug'                => get_option('dt_series_slug','tvshows'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
		);
	$args = array(
		'label'               => __d('Séries'),
		'description'         => __d('Gerir Séries'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor','comments','thumbnail'),
		'taxonomies'          => array('genres'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-view-site',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
		);
	register_post_type('tvshows', $args );
}
add_action('init', 'series', 0 );
# Metadatos y taxonomias
get_template_part('inc/includes/series/metabox');
add_filter('manage_tvshows_posts_columns', 'serie_table_head');
function serie_table_head( $defaults ) {
	if(get_option( DT_KEY ) == "valid"):
		$defaults['generate']    = __d('Gerar Temporadas');
	endif;
	$defaults['idtmdb']    = __d('ID TMDb');
	$defaults['seasons']    = __d('Temporadas');
	$defaults['report']  = __d('Report');
	return $defaults;
}
add_action('manage_tvshows_posts_custom_column', 'serie_table_content', 10, 2 );
function serie_table_content( $column_name, $post_id ) {

	if ($column_name == 'generate') {
		if(get_option( DT_KEY ) == "valid"):
			if(get_post_meta( $post_id, 'clgnrt', true ) =='1') { _d('pronto'); } else {
				$addlink = wp_nonce_url(admin_url('admin-ajax.php?action=seasons_ajax','relative').'&se='.get_post_meta( $post_id, 'ids', true ).'&link='. $post_id, 'add_seasons', 'seasons_nonce');
				echo '<a href="'. $addlink .'" class="dtload button button-primary">'. __d('Gerar Temporadas') .'</a>';
			}
			endif;
		}
		if ($column_name == 'idtmdb') {
			echo get_post_meta( $post_id, 'ids', true );
		}
		if ($column_name == 'seasons') {
			echo '<span class="dt_rating">'.get_post_meta( $post_id, 'number_of_seasons', true ).'</span>';
		}
		if ($column_name == 'report') {
			if($minutes = get_post_meta( $post_id, 'numreport', true )) {
				echo '<span class="dt_report_video">'. $minutes .'</div>';
			} else {
				echo "0";
			}
		}

	}

// Pendientes

	add_action('auth_redirect', 'add_pending_count_filter_tv');
	add_action('admin_menu', 'esc_attr_restore_tv');
	function add_pending_count_filter_tv() {
		add_filter('attribute_escape', 'remove_esc_attr_and_count_tv', 20, 2);
	}
	function esc_attr_restore_tv() {
		remove_filter('attribute_escape', 'remove_esc_attr_and_count_tv', 20, 2);
	}
	function remove_esc_attr_and_count_tv( $safe_text = '', $text = '') {
		if ( substr_count($text, '%%PENDING_COUNT_TV%%') ) {
			$text = trim( str_replace('%%PENDING_COUNT_TV%%', '', $text) );
			remove_filter('attribute_escape', 'remove_esc_attr_and_count_tv', 20, 2);
			$safe_text = esc_attr($text);
			$count = (int)wp_count_posts('tvshows',  'readable')->pending;
			if ( $count > 0 ) {
				$text = esc_attr($text) . '<span class="awaiting-mod count-' . $count . '" style="margin-left:7px;"><span class="pending-count">' . $count . '</span></span>';
				return $text;
			} 
		}
		return $safe_text;
	}