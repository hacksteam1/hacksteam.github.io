<?php 

get_header();

if (get_post_type(get_the_ID()) == 'pedido') {

    get_template_part('inc/parts/pedidos');

}else{

    get_template_part('inc/parts/tipo_post');
}

get_footer();