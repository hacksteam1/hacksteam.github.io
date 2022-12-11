<?php

// Função para adicionar o script
function javascript_do_ajax() {

    // Define a variável ajaxurl
    $script  = '<script>';
    $script .= 'var ajaxurl = "' . admin_url('admin-ajax.php') . '";';
    $script .= '</script>';
    echo $script;  
}
// Adiciona no rodapé
add_action( 'wp_footer', 'javascript_do_ajax' );

// Ação de callback do Ajax
function acao_do_ajax() {

    $s = $_POST['what'];

    if ($s== "featured") {
        loop_lancamento_filmes();
    }elseif($s == 'recente'){
        recentes_filmes();
    }elseif ($s == 'recommended') {
        loop_recomendado_filmes();
    }elseif ($s == 'mostseen') {
        loop_vistos_filmes();
    }elseif ($s == 'lastEpisodes') {
        loop_recentes_series();
    }elseif ($s == 'recommendes') {
        loop_recomendado_series();
    }elseif ($s == 'mostseenn') {
        loop_vistos_series();
    }
}
add_action( 'wp_ajax_acao_do_ajax', 'acao_do_ajax' );
add_action( 'wp_ajax_nopriv_acao_do_ajax', 'acao_do_ajax' );

// Ação de callback do Ajax
function request() {
    $id= $_POST['id'];
    $args = array(
        'post_type' => 'pedido',
        'post__in' => array($id),
        'showposts' => 1
        );
    $loop = new WP_Query($args);
    if($loop->have_posts()) {
        $term = $wp_query->queried_object;
        while($loop->have_posts()) : $loop->the_post();     
        get_template_part('inc/parts/item_i');
        endwhile;
    }
    die();
}
add_action( 'wp_ajax_request', 'request' );
add_action( 'wp_ajax_nopriv_request', 'request' );

// Loops de Séries

function loop_recentes_series() {
    ?>
    <?php query_posts( array('post_type' => array('tvshows'), 'showposts' => get_option('dt_mt_number_items','20'), 'order' => 'desc' )); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('inc/parts/item_bb'); ?>
    <?php endwhile; wp_reset_query(); ?>
    <?php
    die();
}

function loop_recomendado_series() {
    ?>    
    <?php query_posts( array('post_type' => array('tvshows'), 'showposts' => get_option('dt_mt_number_items','20'), 'orderby' => 'rand')); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('inc/parts/item_b'); ?>
    <?php endwhile; wp_reset_query(); ?>
    <?php
    die();
}

function loop_vistos_series() {
    global $post, $paged, $options, $wpbd;

    $paged = get_query_var('paged');
    if ($paged < 2) {
        ?>
        <?php
        $nova_consulta = new WP_Query(
            array(
                'post_type' => array('tvshows'),
                'showposts' => get_option('dt_mt_number_items','20'),
                'no_found_rows' => true,
                'post_status' => 'publish',
                'ignore_sticky_posts' => true,
                'orderby' => 'meta_value_num',
                'meta_key' => 'tp_post_counter',
                'order' => 'DESC'
                )
            );
            ?>
            <?php if ($nova_consulta->have_posts()): ?>
                <?php while ($nova_consulta->have_posts()): ?>
                    <?php $nova_consulta->the_post(); ?>
                    <?php $tp_post_counter = get_post_meta($post->ID, 'tp_post_counter', true); $my_meta = get_post_meta($post->ID, '_my_meta', TRUE); ?>
                    <?php get_template_part('inc/parts/item_b'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            <?php
            die();
        }
    }

// Loops de Filmes
    function loop_lancamento_filmes() {

        $args = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'genres',
                    'field' => 'slug',
                    'terms' => array( 'lancamentos' )
                    ),
                ),
            'post_type' => 'movies',
            'showposts' => get_option('dt_mm_number_items','20'),
            );
        $loop = new WP_Query($args);
        if($loop->have_posts()) {
            $term = $wp_query->queried_object;
            while($loop->have_posts()) : $loop->the_post();     
            get_template_part('inc/parts/item');
            endwhile;
        }
        die();
    }

    function loop_recomendado_filmes() {
        ?>    
        <?php query_posts( array('post_type' => array('movies'), 'showposts' => get_option('dt_mm_number_items','20'), 'orderby' => 'rand')); ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part('inc/parts/item'); ?>
        <?php endwhile; wp_reset_query(); ?>
        <?php
        die();
    }

    function loop_vistos_filmes() {
        global $post, $paged, $options, $wpbd;

        $paged = get_query_var('paged');
        if ($paged < 2) {
            ?>
            <?php
            $nova_consulta = new WP_Query(
                array(
                    'post_type' => array('movies'),
                    'showposts' => get_option('dt_mm_number_items','20'),
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'meta_value_num',
                    'meta_key' => 'tp_post_counter',
                    'order' => 'DESC'
                    )
                );
                ?>
                <?php if ($nova_consulta->have_posts()): ?>
                    <?php while ($nova_consulta->have_posts()): ?>
                        <?php $nova_consulta->the_post(); ?>
                        <?php $tp_post_counter = get_post_meta($post->ID, 'tp_post_counter', true); $my_meta = get_post_meta($post->ID, '_my_meta', TRUE); ?>
                        <?php get_template_part('inc/parts/item'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
                <?php
                die();
            }
        }

        function recentes_filmes(){

            ?>    
            <?php query_posts( array('post_type' => array('movies'), 'showposts' => get_option('dt_mm_number_items','20'),'order' => 'desc' )); ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part('inc/parts/item'); ?>
            <?php endwhile; wp_reset_query(); ?>
            <?php
            die();
        }
