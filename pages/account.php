<?php 
/*
Template Name: MY Conta
*/
if (is_user_logged_in()):

	get_template_part('pages/sections/account');

else:
	get_template_part('pages/sections/login'); 
endif;
?>



