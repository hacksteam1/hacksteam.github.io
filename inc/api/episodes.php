<?php
define('WP_USE_THEMES', false);
require ('../../../../../wp-blog-header.php');
status_header(200);
nocache_headers();
set_time_limit(30000);
if (current_user_can('manage_options')) {
	if (dttp == "valid") {
		if (($_GET["se"] != NULL) && ($_GET["te"] != NULL)) {
			$api_tmdb = get_option('dt_api_key');
			$lang_tmdb = get_option('dt_api_language', 'en');
			$dtemporada = $_GET["te"];
			$ids = $_GET["se"];
			if (($ids != NULL) && ($dtemporada != NULL)) {
				$urltname = "https://api.themoviedb.org/3/tv/" . $ids . "?&language=" . $lang_tmdb . "&include_image_language=" . $lang_tmdb . ",null&api_key=" . $api_tmdb . "";
				$json2 = file_get_contents($urltname);
				$data2 = json_decode($json2, TRUE);
				$tituloserie = $data2['name'];
				$urltoc = "https://api.themoviedb.org/3/tv/" . $ids . "/season/" . $dtemporada . "?append_to_response=images,trailers&language=" . $lang_tmdb . "&include_image_language=" . $lang_tmdb . ",null&api_key=" . $api_tmdb . "";
				$json1 = file_get_contents($urltoc);
				$data1 = json_decode($json1, TRUE);
				$sdasd = count($data1['episodes']);
				$poster_serie = $data1['poster_path'];
				for ($cont = 1; $cont <= $sdasd; $cont++) {
					$url = 'https://api.themoviedb.org/3/tv/' . $ids . '/season/' . $dtemporada . '/episode/' . $cont . '?append_to_response=images&language=' . $lang_tmdb . '&include_image_language=' . $lang_tmdb . ',null&api_key=' . $api_tmdb . '';
					$json = file_get_contents($url);
					$data = json_decode($json, TRUE);
					$season = $data['season_number'];
					$episode = $data['episode_number'];
					$name = $data['name'];
					$dmtid = $data['id'];
					$overview = $data['overview'];
					$air_date = $data['air_date'];
					$still_path = $data['still_path'];
					if ($get_img = $data['still_path']) {
						$upload_img = 'https://image.tmdb.org/t/p/w500' . $get_img;
					}
					$year = substr($data['air_date'], 0, 4);
					$crew = $data['crew'];

					$guest_stars = $data['guest_stars'];
					$images = $data['images']["stills"];
					$castor = $img = $cast = $director = $writer = "";
					foreach($crew as $valor) {
						$departamente = $valor['department'];
						if ($valor['profile_path'] == NULL) {
							$valor['profile_path'] = "null";
						}
						if ($departamente == "Directing") {
							$director.= $valor['name'] . ",";
						}
						if ($departamente == "Writing") {
							$writer.= $valor['name'] . ",";
						}
					}
					$i = '0';
					foreach($guest_stars as $valor1) if ($i < 3) {
						if ($valor1['profile_path'] == NULL) {
							$valor1['profile_path'] = "null";
						}
						$castor.= $valor1['name'] . ",";
						$i +=1;
					}
					$i = '0';
					foreach($images as $valor2) if ($i < 10) {
						$img.= $valor2['file_path'] . "\n";
						$i +=1;
					}
					$dt_episodes = array(
						'post_title' => wp_strip_all_tags(html_entity_decode(($tituloserie) . " " . $season . "x" . $episode)) ,
						'post_content' => wp_strip_all_tags(html_entity_decode($overview)) ,
						'post_status' => get_option('dt_api_post_status_episodes', 'publish') ,
						'post_type' => 'episodes',
						'post_author' => 1
					);
					$post_id = wp_insert_post($dt_episodes);
					add_post_meta($post_id, "ids", ($ids) , true);
					add_post_meta($post_id, "temporada", ($season) , true);
					add_post_meta($post_id, "episodio", ($episode) , true);
					add_post_meta($post_id, "serie", ($tituloserie) , true);
					add_post_meta($post_id, "episode_name", ($name) , true);
					add_post_meta($post_id, "air_date", ($air_date) , true);
					add_post_meta($post_id, "imagenes", ($img) , true);
					add_post_meta($post_id, "dt_backdrop", ($still_path) , true);
					add_post_meta($post_id, "dt_poster", ($poster_serie) , true);
					add_post_meta($post_id, "dt_string", ($dmtid) , true);
					dt_upload_image($upload_img, $post_id);
				}
			}
			update_post_meta($_GET["link"], 'clgnrt', '1');
			wp_redirect(get_permalink( $_GET["link"] ));
			exit;
		}
		else {
			echo 'error';
			exit;
		}
	}
	else {
		echo 'invalid license';
		exit;
	}
}
else {
	echo 'login';
	exit;
}
