<?php

/* Função Carregar Styles no site
  -------------------------------------------------------------------------------
 */
function dt_styles() 
{

	wp_enqueue_style( 'theme', DT_DIR_URI .'/assets/css/tema.css' , array(), DT_VERSION, 'all' );
	wp_enqueue_style( 'color-scheme', DT_DIR_URI .'/assets/css/scheme-'. get_option('dt_color_scheme','white') .'.css' , array(), DT_VERSION, 'all' );
	
}
add_action( 'wp_enqueue_scripts', 'dt_styles' );

/* Função Carregar Scripts no site
  -------------------------------------------------------------------------------
 */
function dt_scripts()  
{
	wp_enqueue_script( 'name', 'https://ajax.googleapis.com/ajax/libs/jquery/'. get_option('dt_jquery_version','2.2.0') .'/jquery.min.js' , '', get_option('dt_jquery_version','2.2.0'), false );
	
	wp_enqueue_script( 'scripts',  DT_DIR_URI .'/assets/js/scripts.js' , '', DT_VERSION, true  );
}  
add_action( 'wp_enqueue_scripts', 'dt_scripts' );

/* Função Carregar Styles e Scripts no Painel de admin do wordpress
  -------------------------------------------------------------------------------
 */
function styles() {

    wp_enqueue_style('webnus-admin-style', get_template_directory_uri() . '/assets/css/webnus-admin.css', array(), 'all');
}

add_action('admin_enqueue_scripts', 'styles');
