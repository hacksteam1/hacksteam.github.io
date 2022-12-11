<?php


add_action('after_setup_theme', 'woz0ha');

$dtstyle = get_option('dt_color_style');
if($dtstyle == 'default'){
	$color1 = "#408BEA";
	$color2 = "#F5F7FA";
} elseif($dtstyle == 'dark') {
	$color1 = "#408BEA";
	$color2 = "#32353a";
} elseif($dtstyle == 'fusion'){
	$color1 = "#408BEA";
	$color2 = "#9facc1";
}

$options = array(
// Sections
array("type" => "section","icon" => "dashicons-admin-settings","title" => __d("Configuração"),"id" => "general","expanded" => "true"),
array("type" => "section","icon" => "dashicons-welcome-widgets-menus","title" => __d("Pagina inicial"),"id" => "home","expanded" => "false"),
array("type" => "section","icon" => "dashicons-chart-bar","title" => __d("SEO"),"id" => "seo","expanded" => "false"),
array("type" => "section","icon" => "dashicons-admin-tools","title" => __d("Ferramentas"),"id" => "tools","expanded" => "false"),
array("type" => "section","icon" => "dashicons-analytics","title" => __d("Propaganda"),"id" => "ads","expanded" => "false"),
// sub sections
array("section" => "general", "type" => "heading","title" => __d("Configurações Gerais"),"id" => "general"),
array("section" => "general", "type" => "heading","title" => __d("Customizar"),"id" => "custom"),
array("section" => "general", "type" => "heading","title" => __d("TMDb API"),"id" => "api-config"),
array("section" => "custom", "type" => "heading","title" => __d("Estilo padrão"),"id" => "default-style"),
array("section" => "custom", "type" => "heading","title" => __d("Estilo escuro"),"id" => "dark-style"),
array("section" => "home", "type" => "heading","title" => __d("Filmes Módulos"),"id" => "m-movies"),
array("section" => "home", "type" => "heading","title" => __d("Séries Módulos"),"id" => "m-tvshows"),
array("section" => "tools", "type" => "heading","title" => __d("Post links"),"id" => "post-links"),
array("section" => "tools", "type" => "heading","title" => __d("Registro de usuário"),"id" => "dt_register_user_ptr"),
array("section" => "seo", "type" => "heading","title" => __d("Informação básica"),"id" => "seo-general"),
array("section" => "seo", "type" => "heading","title" => __d("Verificação do site"),"id" => "site-veri"),
array("section" => "ads", "type" => "heading","title" => __d("Local do anúncio / Redirecionando links"),"id" => "ads-2"),
array("section" => "ads", "type" => "heading","title" => __d("Local do anúncio / single(único)"),"id" => "ads-3"),


##################  Main Slider ######################


array(
	// Small heading
    "under_section" => "custom", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Personalizar logotipos'),
),


array(
	// dt_logo
    "under_section" => "custom", 
    "type" => "image", 
	"display_checkbox_id" => "toggle_checkbox_id",
    "name" => __d('Imagem do Logotipo'),
    "id" => "dt_logo", 
    "desc" => __d('Carregue o seu logotipo utilizando o botão Carregar ou insira o URL da imagem')
),array(
    // dt_logo
    "under_section" => "custom", 
    "type" => "image", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "name" => __d('Logo Superior Search'),
    "id" => "logosearch", 
    "desc" => __d('Carregue o seu logotipo utilizando o botão Carregar ou insira o URL da imagem tamanho 300x75 aconcelhável')
),array(
    // dt_touch_icon
    "under_section" => "custom", 
    "type" => "image", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "name" => __d('Imgem de Fundo'),
    "id" => "dt_touch_icon", 
    "desc" => __d('Faça o upload de uma imagem de 1920 x 1080 px')
),
array(
	// dt_favicon
    "under_section" => "custom", 
    "type" => "image", 
	"display_checkbox_id" => "toggle_checkbox_id",
    "name" => __d('Favicon'),
    "id" => "dt_favicon", 
    "desc" => __d('Faça o upload de uma imagem de 16 x 16 px que represente o favicon do seu site')
), 
 
array(
	// dt_logo_admin
    "under_section" => "custom", 
    "type" => "image", 
	"display_checkbox_id" => "toggle_checkbox_id",
    "name" => __d('Logotipo do Admin dark'),
    "id" => "dt_logo_admin", 
    "desc" => __d('Carregue o seu logótipo para o início de sessão do wp-admin, utilizando o botão Carregar ou inserir o URL da imagem')
), 

array(
    // Small heading
    "under_section" => "custom", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Customizar Textos'),
),
array(
        "under_section" => "custom",
        "type" => "text",
        "name" => "Texto Logotipo",
        "id" => "text_search",
        "placeholder" => "ASSISTA FILMES, SÉRIES, ANIMES E TV ONLINE GRÁTIS!",
        "default" => ""
        ),

array(
        "under_section" => "custom",
        "type" => "text",
        "name" => "Texto Copyright",
        "id" => "text_rodape",
        "placeholder" => "Filmes Online Grátis - Assistir Filmes e Séries online grátis em HD",
        "desc" => "Pode ser usado tag HTML <a></a> e Symbol Code (©)",
        "default" => ""
        ),
    array(
        "under_section" => "custom",
        "type" => "textarea",
        "name" => "Sub-Texto para link de parcerias",
        "id" => "sub_rodape",
        "placeholder" => "",
        "desc" => "Pode ser usado tag HTML ex:< a>parceria-1< /a>",
        "default" => ""
        ),

####################  ADS - Spots  ######################
#########################################################
array(
	// ads_spot_300
    "under_section" => "ads-2",
    "type" => "textarea", 
    "name" => __d('Anúncios 300x250 pixels'),  
    "id" => "ads_spot_300", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "desc" => __d('Usar código HTML'),
	"rows" => '10',
	"code" => "",
    "default" => ""
),
array(
	// ads_spot_468
    "under_section" => "ads-2",
    "type" => "textarea", 
    "name" => __d('Anúncios 468x60 pixels'),  
    "id" => "ads_spot_468", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "desc" => __d('Usar código HTML'),
	"rows" => '10',
	"code" => "",
    "default" => ""
),
array(
	// ads_spot_single
    "under_section" => "ads-3",
    "type" => "textarea", 
    "name" => __d('Anúncios single'),  
    "id" => "ads_spot_single", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "desc" => __d('Usar código HTML'),
	"rows" => '10',
	"code" => "",
    "default" => ""
),
array(
	// Field multi chekbox
    "under_section" => "ads-3",
    "type" => "checkbox",
    "name" => __d('Anúncio gráfico'),
    "id" => array("ads_ss_1", "ads_ss_2", "ads_ss_3", "ads_ss_4"), 
    "options" => array( __d('Filmes'), __d('Séries'), __d('Temporadas'), __d('Episódios'),), 
    "desc" => __d('Marque para ativar os anúncios'),
    "display_checkbox_id" => "toggle_checkbox_id",
    "default" => array("checked", "checked", "checked", "checked")
),


###################  USER REGISTER  #####################
#########################################################


array(
	// TIP Sconsole shortcode
    "under_section" => "dt_register_user_ptr",
    "type" => "tips",
	"text" => __d('<strong>NOTE:</strong> Você pode usar essas tags para personalizar sua mensagem de boas-vindas em inscrever-se.'),
	
),
array(
	// Field textarea
    "under_section" => "dt_register_user_ptr",
    "type" => "textarea", 
    "name" => __d('Mensagem de boas-vindas'),  
    "id" => "dt_welcome_mail_user", 
    "display_checkbox_id" => "toggle_checkbox_id",
	"rows" => "10",
	"desc" => __d('Use somente texto sem formatação.'),
	"default" => __d('Olá {first_name}, bem-vindo ao {sitename}.'),
	"code" => "{sitename}
{siteurl}
{username}
{password}
{email}
{first_name}
{last_name}	"
),








###################   SEO  GENERAL  #####################
#########################################################

array(
	// dt_site_titles
    "under_section" => "seo-general",
    "type" => "checkbox",
    "name" => __d('Recursos de SEO'),
    "id" => array("dt_site_titles"), 
    "options" => array( __d('Básico SEO') ), 
    "desc" => __d('Desmarque esta opção para desativar os recursos de SEO no tema, altamente recomendado se você usar qualquer outro plugin SEO, dessa forma as características do tema SEO não vai entrar em conflito com o plugin.'),
    "display_checkbox_id" => "toggle_checkbox_id",
    "default" => array("checked")
),
array(
	// blogname
    "under_section" => "seo-general", 
    "type" => "text",
    "name" => __d('Titulo do site'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "blogname"
),
array(
	// blogdescription
    "under_section" => "seo-general", 
    "type" => "text",
    "name" => __d('Tagline'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "blogdescription",
    "desc" => __d('Em poucas palavras, explique o que este site é sobre.')
),


array(
	// Small heading
    "under_section" => "seo-general", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Informações do site'),
),

array(
	// dt_alt_name
    "under_section" => "seo-general", 
    "type" => "text",
    "name" => __d('Nome alternativo'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_alt_name"
),

array(
	// dt_main_keywords
    "under_section" => "seo-general", 
    "type" => "text",
    "name" => __d('Principais palavras-chave'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_main_keywords",
    "desc" => __d('Adicionar palavras-chave principais para informações do site')
),


array(
	// dt_metadescription
    "under_section" => "seo-general",
    "type" => "textarea", 
    "name" => __d('Meta descrição'),  
    "id" => "dt_metadescription", 
	"rows" => "3",
    "display_checkbox_id" => "toggle_checkbox_id"
),

/* 
array(
	// Small heading
    "under_section" => "seo-general", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Your company'),
),

array(
	// dt_company_name
    "under_section" => "seo-general", 
    "type" => "text",
    "name" => __d('Company name'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_company_name"
),

array(
	// Field upload image
    "under_section" => "seo-general", 
    "type" => "image", 
	"display_checkbox_id" => "toggle_checkbox_id",
    "name" => __d('Company logo'),
    "id" => "dt_company_logo"
),  
*/


################## GENERAL SETTINGS #####################
#########################################################


array(
	// dt_google_analytics
    "under_section" => "general", 
    "type" => "text",
    "name" => __d('Google Analytics'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_google_analytics", 
    "placeholder" => __d('UA-93046995-1'),
    "desc" => __d('Inserir código de acompanhamento para usar esta função'),
    "default" => ""
),
array(
	// Small heading
    "under_section" => "general", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Integrações de código'),
), 
array(
	// dt_header_code
    "under_section" => "general",
    "type" => "textarea", 
    "name" => __d('Código de cabeçalho'),  
    "id" => "dt_header_code", 
    "display_checkbox_id" => "toggle_checkbox_id",
	"rows" => "5",
    "desc" => __d('Digite o código que você precisa colocar <strong> antes de fechar tag.</strong> (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)')
),
array(
	// dt_footer_code
    "under_section" => "general",
    "type" => "textarea", 
    "name" => __d('Código de rodapé'),  
    "id" => "dt_footer_code", 
    "display_checkbox_id" => "toggle_checkbox_id",
	"rows" => "5",
    "desc" => __d('Insira os códigos que você precisa colocar no rodapé. (ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)')
),


array(
	// Small heading Google reCAPTCHA
    "under_section" => "general", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Google reCAPTCHA'),
),
array(
	// dt_grpublic_key
    "under_section" => "general", 
    "type" => "text",
    "name" => __d('Public key'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_grpublic_key"
),
array(
	// dt_grprivate_key
    "under_section" => "general", 
    "type" => "text",
    "name" => __d('Private Key'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_grprivate_key"
),

array(
	// Small heading Google reCAPTCHA
    "under_section" => "general", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Configurações adicionais'),
),

array(
	// dt_play_trailer
    "under_section" => "general",
    "type" => "checkbox",
    "name" => __d('Ativar ou desativar'),
    "id" => array("dt_play_trailer","dt_similiar_titles","dt_register_user"), 
    "options" => array( __d("Auto-play video trailers"), __d('Ativar títulos semelhantes'), __d('Permitir registro de usuário') ), 
    "desc" => __d('Verifique se deseja ativar ou desativar'),
    "display_checkbox_id" => "toggle_checkbox_id",
    "default" => array("checked","checked","not")
),

array(
	// dt_emoji_disable
	// dt_toolbar_disable
    "under_section" => "general",
    "type" => "checkbox",
    "name" => __d('WordPress Controles'),
    "id" => array("dt_emoji_disable","dt_toolbar_disable","controle_user","ativar_adb","dt_player_report"), 
    "options" => array( __d('Desativar Emoji'), __d('Barra de ferramentas do usuário desativada'),__d('Conteúdo Privado para Usuários Registrados'),__d('Ativar Adblock'),__d('Reportar erro')), 
    "desc" => __d('Marque para desativar'),
    "display_checkbox_id" => "toggle_checkbox_id",
    "default" => array("not","checked","not","not","checked")
),


##################### API TMDB ##########################
#########################################################
array(
	// Tip API TMDB
    "under_section" => "api-config",
    "type" => "tips",
	"text" => __d('É importante configurar corretamente esses campos, a API nos permitirá gerar conteúdo rapidamente.')
),
array(
	// dt_activate_api
    "under_section" => "api-config",
    "type" => "checkbox",
    "name" => __d('Habilitar API TMDb'),
    "id" => array("dt_activate_api"), 
    "options" => array( __d('Marque para ativar a API') ), 
    "desc" => __d("Definir sua API em <a href=\"https://www.themoviedb.org/account/\" target=\"_blank\">Themoviedb.org API</a>"),
    "display_checkbox_id" => "toggle_checkbox_id",
    "default" => array("checked")
),
array(
	// dt_api_key
    "under_section" => "api-config", 
    "type" => "text",
    "name" => __d('TMDb API key'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_api_key", 
    "desc" => __d('Adicionar a chave da API na caixa de texto'),
    "default" => "f074bd61c155b47f2e9d924d320524af"
),
array(
	// dt_api_language
	"under_section" => "api-config", 
    "type" => "select", 
    "name" => __d('API Idioma'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_api_language", 
    "options" => array(
			"ar-AR" => __d('Arabic (ar-AR)'),
			"bs-BS" => __d('Bosnian (bs-BS)'),
			"bg-BG" => __d('Bulgarian (bg-BG)'),
			"hr-HR" => __d('Croatian (hr-HR)'),
			"cs-CZ" => __d('Czech (cs-CZ)'),
			"da-DK" => __d('Danish (da-DK)'),
			"nl-NL" => __d('Dutch (nl-NL)'),
			"en-US" => __d('English (en-US)'),
			"fi-FI" => __d('Finnish (fi-FI)'),
			"fr-FR" => __d('French (fr-FR)'),
			"de-DE" => __d('German (de-DE)'),
			"el-GR" => __d('Greek (el-GR)'),
			"he-IL" => __d('Hebrew (he-IL)'),
			"hu-HU" => __d('Hungarian (hu-HU)'),
			"is-IS" => __d('Icelandic (is-IS)'),
			"id-ID" => __d('Indonesian (id-ID)'),
			"it-IT" => __d('Italian (it-IT)'),
			"ko-KR" => __d('Korean (ko-KR)'),
			"lb-LB" => __d('Letzeburgesch (lb-LB)'),
			"lt-LT" => __d('Lithuanian (lt-LT)'),
			"zh-CN" => __d('Mandarin (zh-CN)'),
			"fa-IR" => __d('Persian (fa-IR)'),
			"pl-PL" => __d('Polish (pl-PL)'),
			"pt-PT" => __d('Portuguese (pt-PT)'),
			"pt-BR" => __d('Português (pt-BR)'),
			"ro-RO" => __d('Romanian (ro-RO)'),
			"ru-RU" => __d('Russian (ru-RU)'),
			"sk-SK" => __d('Slovak (sk-SK)'),
			"es-ES" => __d('Spanish (es-ES)'),
			"sv-SE" => __d('Swedish (sv-SE)'),
			"th-TH" => __d('Thai (th-TH)'),
			"tr-TR" => __d('Turkish (tr-TR)'),
			"tw-TW" => __d('Twi (tw-TW)'),
			"uk-UA" => __d('Ukrainian (uk-UA)'),
			"vi-VN" => __d('Vietnamese (vi-VN)')
		), 
    "desc" => __d('Selecione o idioma'),
    "default" => "pt-BR"
),
array(
	// Small heading
    "under_section" => "api-config", 
    "type" => "small_heading", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "title" => __d('Controlar conteúdo gerado'),
), 


array(
	// dt_api_key
    "under_section" => "api-config", 
    "type" => "text",
    "name" => __d('dbmovies private key'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dbmovies_private_key", 
    "desc" => __d('Estes dados são absolutamente privados, não partilham esta informação')
),


array(
	// dt_api_genres 
	// dt_api_upload_poster
    "under_section" => "api-config",
    "type" => "checkbox",
    "name" => __d('Controle de API'),
    "id" => array(
			"dt_api_genres", 
			"dt_api_upload_poster"
		), 
    "options" => array( 
			__d("Gerar gêneros"), 
			__d("Carregar imagem do poster")
		), 
    "desc" => __d('Marque para ativar.'),
    "display_checkbox_id" => "toggle_checkbox_id",
    "default" => array(
			"checked", 
			"checked"
		)
),



##################### HOME PAGE #########################
#########################################################

array(
	// dt_mm_title
    "under_section" => "m-movies", 
    "type" => "text",
    "name" => __d('Módulo Título'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_mm_title", 
    "placeholder" => __d('Filmes'),
    "desc" => __d('Adicionar título para mostrar'),
    "default" => __d('Filmes')
),
array(
	// dt_mm_number_items
    "under_section" => "m-movies", 
    "type" => "number",
    "name" => __d('Número de itens'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_mm_number_items", 
	"min" => "5",
	"max" => "50",
	"step" => "5",
    "placeholder" => __d('20'),
    "desc" => __d('Número de itens a mostrar'),
    "default" => "20"
),

array(
	// dt_mt_title
    "under_section" => "m-tvshows", 
    "type" => "text",
    "name" => __d('Título Modulo'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_mt_title", 
    "placeholder" => __d('Séries'),
    "desc" => __d('Adicionar título para mostrar'),
    "default" => __d('Séries')
),
array(
	// dt_mt_number_items
    "under_section" => "m-tvshows", 
    "type" => "number",
    "name" => __d('Número de itens'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_mt_number_items", 
	"min" => "5",
	"max" => "50",
	"step" => "5",
    "placeholder" => __d('20'),
    "desc" => __d('Número de itens a mostrar'),
    "default" => "20"
),

#################### POST LINKS #########################
#########################################################


array(
	// dt_activate_post_links
    "under_section" => "post-links",
    "type" => "checkbox",
    "name" => __d('Ativar links de postagem'),
    "id" => array("dt_activate_post_links"), 
    "options" => array( __d('Verificar para ativar o módulo')), 
    "desc" => __d('Marque para ativar'),
    "display_checkbox_id" => "toggle_checkbox_id",
    "default" => array("checked")
),



array(
	// dt_languages_post_link
    "under_section" => "post-links", 
    "type" => "text",
    "name" => __d('Idiomas para adicionar links'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_languages_post_link",
	"placeholder" => "English, Spanish, Russian, Italian, Portuguese",
    "desc" => __d('Adicionar valores separados por vírgula')
),
array(
	// dt_quality_post_link
    "under_section" => "post-links", 
    "type" => "text",
    "name" => __d('Qualidade das resoluções para adicionar links'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_quality_post_link",
	"placeholder" => "HD, SD, 320p, 480p, 720p, 180p",
    "desc" => __d('Adicionar valores separados por vírgula')
),

array(
	// dt_ountdown_link_redirect
    "under_section" => "post-links", 
    "type" => "number",
    "name" => __d('Contagem regressiva'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_ountdown_link_redirect", 
	"min" => "0",
	"max" => "120",
	"step" => "1",
    "desc" => __d('Definir tempo limite para links de redirecionamento'),
    "default" => "20"
),



################# SITE VERIFICATION #####################
#########################################################



array(
	// dt_veri_google
    "under_section" => "site-veri", 
    "type" => "text",
    "name" => __d('Google Search Console'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_veri_google", 
    "desc" => __d("Configurações de verificação<a href=\"https://www.google.com/webmasters/verification/\" target=\"_blank\">here</a>")
),
array(
	// dt_veri_alexa
    "under_section" => "site-veri", 
    "type" => "text",
    "name" => __d('Alexa Verification ID'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_veri_alexa", 
    "desc" => __d("Configurações de verificação<a href=\"https://www.alexa.com/siteowners/claim/\" target=\"_blank\">here</a>")
),
array(
	// dt_veri_bing
    "under_section" => "site-veri", 
    "type" => "text",
    "name" => __d('Bing Webmaster Tools'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_veri_bing", 
    "desc" => __d("Configurações de verificação<a href=\"https://www.bing.com/toolbox/webmaster/\" target=\"_blank\">here</a>")
),
array(
	// dt_veri_yandex
    "under_section" => "site-veri", 
    "type" => "text",
    "name" => __d('Yandex Webmaster Tools'), 
    "display_checkbox_id" => "toggle_checkbox_id",
    "id" => "dt_veri_yandex", 
    "desc" => __d("Configurações de verificação<a href=\"https://yandex.com/support/webmaster/service/rights.xml#how-to\" target=\"_blank\">here</a>")
),
    );
function woz0ha() {
	get_template_part('/inc/includes/static/inc/static/gindex');
}
