<?php 


if (get_option('controle_user') == 'true') {
    if (is_user_logged_in()):

   // Separando tipos de entrada
        if(get_post_type( get_the_ID() ) ==  'tvshows' || get_post_type( get_the_ID() ) ==  'pedido') {
            get_header('single');
        // resolviendo series
            get_template_part('inc/parts/single/series');
        } elseif(get_post_type( get_the_ID() ) ==  'seasons') {
            get_header();
        // resolviendo temporadas
            get_template_part('inc/parts/single/temporadas');
        } elseif(get_post_type( get_the_ID() ) ==  'episodes') {
            get_header();
        // resolviendo episodios
            get_template_part('inc/parts/single/episodios');
        } elseif(get_post_type( get_the_ID() ) ==  'movies') {
            get_header();
            get_template_part('inc/parts/single/peliculas');
        } else {
        // entradas por defecto
            get_template_part('inc/parts/single/post');
        }
        get_footer();
        else:
            get_template_part('pages/sections/login-pri'); 
        endif;
    }else{
        if(get_post_type( get_the_ID() ) ==  'tvshows' || get_post_type( get_the_ID() ) ==  'pedido') {
            get_header('single');
        // resolviendo series
            get_template_part('inc/parts/single/series');
        } elseif(get_post_type( get_the_ID() ) ==  'seasons') {
            get_header();
        // resolviendo temporadas
            get_template_part('inc/parts/single/temporadas');
        } elseif(get_post_type( get_the_ID() ) ==  'episodes') {
            get_header();
        // resolviendo episodios
            get_template_part('inc/parts/single/episodios');
        } elseif(get_post_type( get_the_ID() ) ==  'movies') {
            get_header();
        // resolviendo peliculas
            get_template_part('inc/parts/single/peliculas');
        } else {
        // entradas por defecto
            get_template_part('inc/parts/single/post');
        }
        get_footer();
    }