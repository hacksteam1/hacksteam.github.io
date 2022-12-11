<?php


function dtdirector() {
	$labels = array(
		'name'                       => __d('Diretor'),
		'singular_name'              => __d('Diretor'),
		'menu_name'                  => __d('Diretor'),
	);
	$rewrite = array(
		'slug'                       => 'director',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy('dtdirector', array('movies'), $args );
}
add_action('init', 'dtdirector', 0 );

// Creator
function dtcreator() {
	$labels = array(
		'name'                       => __d('Autor'),
		'singular_name'              => __d('Autor'),
		'menu_name'                  => __d('Autor'),
	);
	$rewrite = array(
		'slug'                       => get_option('dt_creator_slug','creator'),
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy('dtcreator', array('tvshows'), $args );
}
add_action('init', 'dtcreator', 0 );

// cast
function dtcast() {
	$labels = array(
		'name'                       => __d('Elenco'),
		'singular_name'              => __d('Elenco'),
		'menu_name'                  => __d('Elenco'),
	);
	$rewrite = array(
		'slug'                       => 'cast',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy('dtcast', array('tvshows','movies'), $args );
}
add_action('init', 'dtcast', 0 );

// Studio
function dtstudio() {
	$labels = array(
		'name'                       => __d('Estúdio'),
		'singular_name'              => __d('Estúdio'),
		'menu_name'                  => __d('Estúdio'),
	);
	$rewrite = array(
		'slug'                       => 'studio',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy('dtstudio', array('tvshows'), $args );
}
add_action('init', 'dtstudio', 0 );


// Neworks
function dtnetworks() {
	$labels = array(
		'name'                       => __d('Redes'),
		'singular_name'              => __d('Redes'),
		'menu_name'                  => __d('Redes'),
	);
	$rewrite = array(
		'slug'                       => 'network',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy('dtnetworks', array('tvshows'), $args );
}
add_action('init', 'dtnetworks', 0 );


// Year Serie
function dtyear() {
	$labels = array(
		'name'                       => __d('Ano'),
		'singular_name'              => __d('Ano'),
		'menu_name'                  => __d('Ano'),
	);
	$rewrite = array(
		'slug'                       => 'release',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy('dtyear', array('tvshows','movies'), $args );
}
add_action('init', 'dtyear', 0 );


