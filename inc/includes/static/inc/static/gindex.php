<?php


if ( !class_exists('EDD_Theme_Updater_Admin') ) {
	get_template_part('inc/includes/static/inc/static/droper');
}
$updater = new EDD_Theme_Updater_Admin(
	$config = array(
		'remote_api_url' => DT_SERVER, // Repositorio
		'item_name'		 => DT_THEME_NAME, 
		'theme_slug'	 => DT_THEME_SLUG, 
		'version'		 => DT_VERSION, // version actual 
		'author'		 => DT_AUTOR, 
		'download_id'	 => '', 
		'renew_url'		 => DT_RENOVAR 
	),
	$strings = array(
	'theme-license' => __d('Licença de tema'),
	'enter-key' => __d('Digite sua chave de licença de tema.'),
	'license-key' => __d('License Key'),
	'license-action' => __d('License Action'),
	'deactivate-license' => __d('Deactivate License'),
	'activate-license' => __d('Activate License'),
	'status-unknown' => __d('O status da licença é desconhecido.'),
	'renew' => __d('Renovar?'),
	'unlimited' => __d('ilimitado'),
	'license-key-is-active' => __d('A chave de licença está ativa.'),
	'expires%s' => __d('Expira %s.'),
	'%1$s/%2$-sites' => __d('Você tem %1$s / %2$s sites ativados.'),
	'license-key-expired-%s' => __d('Chave de licença expirada %s.'),
	'license-key-expired' => __d('A chave de licença expirou.'),
	'license-keys-do-not-match' => __d('As chaves de licença não correspondem.'),
	'license-is-inactive' => __d('A licença está inativa.'),
	'license-key-is-disabled' => __d('A chave de licença está desativada.'),
	'site-is-inactive' => __d('O site está inativo.'),
	'license-status-unknown' => __d('O status da licença é desconhecido.'),
	'update-notice' => __d("A atualização deste tema perderá as personalizações feitas. 'Cancelar' para parar, 'OK' para atualizar."),
	'update-available' => __d('<strong>%1$s %2$s</strong>está disponível.<a href="%3$s" class="thickbox" title="%4s">Confira o que é novo</a> or <a href="%5$s"%6$s>Atualizar agora</a>.')
	)
);