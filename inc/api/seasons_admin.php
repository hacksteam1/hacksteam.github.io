<?php
define('WP_USE_THEMES', false);
require ('../../../../../wp-blog-header.php');

status_header(200);
nocache_headers();
set_time_limit(30000);
if (current_user_can('manage_options'))
{
	if (dttp == "valid")
	{
		if (($_GET["se"] != NULL))
		{
			$key = get_option('dt_api_key');
			$lang = get_option('dt_api_language', 'en');
			$ids = $_GET["se"];
			if (($ids != NULL))
			{
				$urltname = "https://api.themoviedb.org/3/tv/" . $ids . "?&language=" . $lang . "&include_image_language=" . $lang . ",null&api_key=" . $key . "";
				$json2 = file_get_contents($urltname);
				$data2 = json_decode($json2, TRUE);
				$tituloserie = $data2['name'];
				$sdasd = $data2['number_of_seasons'];
				for ($cont = 1; $cont <= $sdasd; $cont++)
				{
					$url = 'https://api.themoviedb.org/3/tv/' . $ids . '/season/' . $cont . '?append_to_response=images&language=' . $lang . '&include_image_language=' . $lang . ',null&api_key=' . $key . '';
					$json = file_get_contents($url);
					$data = json_decode($json, TRUE);
					$name = $data['name'];
					$poster_serie = $data['poster_path'];
					if ($get_img = $data['poster_path'])
					{
						$upload_poster = 'https://image.tmdb.org/t/p/w396' . $get_img;
					}
					$overview = $data['overview'];
					$year = substr($data['air_date'], 0, 4);
					$fecha = $data['air_date'];
					$season_number = $data['season_number'];
					$my_post = array(
						'post_title' => wp_strip_all_tags(html_entity_decode(($tituloserie) . ": " .$cont. "ª Temporada")) ,
						'post_content' => wp_strip_all_tags(html_entity_decode($overview)) ,
						'post_status' => get_option('dt_api_post_status_seasons', 'publish') ,
						'post_type' => 'seasons',
						'post_author' => 1
					);
					$post_id = wp_insert_post($my_post);
					// wp_set_post_terms( $post_id, $year, 'dtyear', false );
					add_post_meta($post_id, "ids", ($ids) , true);
					add_post_meta($post_id, "temporada", ($season_number) , true);
					add_post_meta($post_id, "serie", ($tituloserie) , true);
					add_post_meta($post_id, "air_date", ($fecha) , true);
					add_post_meta($post_id, "dt_poster", ($poster_serie) , true);
					dt_upload_image($upload_poster, $post_id);
				}
			}
			update_post_meta($_GET["link"], 'clgnrt', '1');
			wp_redirect(get_admin_url() . "edit.php?post_type=seasons");
			exit;
		}
		else
		{
			echo 'error';
			exit;
		}
	}
	else
	{
		echo 'invalid license';
		exit;
	}
}
else
{
	echo 'login';
	exit;
}
