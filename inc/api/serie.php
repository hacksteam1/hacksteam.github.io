<?php
define('WP_USE_THEMES', false);
require ('../../../../../wp-blog-header.php');
status_header(200);
nocache_headers();
set_time_limit(30000);
if (current_user_can('manage_options')) {
	if (dttp == "valid") {
		if (($_POST["tv"] != NULL)) {
			$key = get_option('dt_api_key');
			$lang = get_option('dt_api_language', 'en');
			$slug = "/" . get_option('dt_tvshows_slug', 'tvshows');
			$ids = url_dt_import_data($_POST["tv"]);
			if (($ids != NULL)) {
				$urla = "https://api.themoviedb.org/3/tv/" . $ids . "?append_to_response=images,trailers&language=" . $lang . "&include_image_language=" . $lang . ",null&api_key=" . $key . "";
				$json2 = file_get_contents($urla);
				$data2 = json_decode($json2, TRUE);
				// ##########################################
				$name = $data2['name'];
				$tvid = $data2['id'];
				$episodes = $data2['number_of_episodes'];
				$seasons = $data2['number_of_seasons'];
				$year = substr($data2['first_air_date'], 0, 4);
				$date1 = $data2['first_air_date'];
				$date2 = $data2['last_air_date'];
				$overview = $data2['overview'];
				$popularidad = $data2['popularity'];
				$originalname = $data2['original_name'];
				$promedio = $data2['vote_average'];
				$votos = $data2['vote_count'];
				$tipo = $data2['type'];
				$web = $data2['homepage'];
				$status = $data2['status'];
				$poster = $data2['poster_path'];
				if ($get_img = $data2['poster_path']) {
					$upload_poster = 'https://image.tmdb.org/t/p/w396' . $get_img;
				}
				$backdrop = $data2['backdrop_path'];
				// Forech!
				$i = '0';
				$images = $data2['images']["backdrops"];
				foreach($images as $valor2) if ($i < 10) {
					$imgs.= $valor2['file_path'] . "\n";
					$i +=1;
				}

				$genres = $data2['genres'];
				$generos = array();
				foreach($genres as $ci) {
					$generos[] = $ci['name'];
				}
				$networks = $data2['networks'];
				foreach($networks as $co) {
					$redes.= $co['name'];
				}
				$studio = $data2['production_companies'];
				foreach($studio as $ht) {
					$estudios.= $ht['name'] . ",";
				}
				$creator = $data2['created_by'];
				foreach($creator as $cg) {
					$creador.= $cg['name'] . ",";
				}
				foreach($creator as $ag) {
					if ($ag['profile_path'] == NULL) {
						$ag['profile_path'] = "null";
					}
					$creador_d.= "[" . $ag['profile_path'] . ";" . $ag['name'] . "]";
				}
				$runtime = $data2['episode_run_time'];
				foreach($runtime as $tm) {
					$duracion.= $tm;
					break;
				}
				// ##########################################
				$urlb = "https://api.themoviedb.org/3/tv/" . $ids . "/credits?append_to_response=images,trailers&language=" . $lang . "&include_image_language=" . $lang . ",null&api_key=" . $key . "";
				$json3 = file_get_contents($urlb);
				$data3 = json_decode($json3, TRUE);
				// ##########################################
				$cast = $data3['cast'];
				$i = '0';
				foreach($cast as $valor) if ($i < 10) {
					$actores.= $valor['name'] . ",";
					$i +=1;
				}
				$i = '0';
				foreach($cast as $valor) if ($i < 10) {
					if ($valor['profile_path'] == NULL) {
						$valor['profile_path'] = "null";
					}
					$d_actores.= "[" . $valor['profile_path'] . ";" . $valor['name'] . "," . $valor['character'] . "]";
					$i +=1;
				}
				// ##########################################
				$urlc = "https://api.themoviedb.org/3/tv/" . $ids . "/videos?append_to_response=images,trailers&language=" . $lang . "&include_image_language=" . $lang . ",null&api_key=" . $key . "";
				$json4 = file_get_contents($urlc);
				$data4 = json_decode($json4, TRUE);
				// ##########################################
				$video = $data4['results'];
				foreach($video as $yt) {
					$youtube.= "[" . $yt['key'] . "]";
					break;
				}
				// ##########################################
				if(get_option('dt_api_post_date') == 'OR_DATE'):
				$my_post = array(
					'post_title' => wp_strip_all_tags(html_entity_decode($name)) ,
					'post_content' => wp_strip_all_tags(html_entity_decode($overview)) ,
					'post_status' => get_option('dt_api_post_status_tv_shows', 'publish') ,
					'post_type' => 'tvshows',
					'post_date'     => $date1,
					'post_date_gmt' => $date1,
					'post_author' => 1
				);
				endif;
				if(get_option('dt_api_post_date') == 'PT_DATE'):
				$my_post = array(
					'post_title' => wp_strip_all_tags(html_entity_decode($name)) ,
					'post_content' => wp_strip_all_tags(html_entity_decode($overview)) ,
					'post_status' => get_option('dt_api_post_status_tv_shows', 'publish') ,
					'post_type' => 'tvshows',
					'post_date'     => date('Y-m-d H:i:s'),
					'post_date_gmt' => date('Y-m-d H:i:s'),
					'post_author' => 1
				);
				endif;

				$post_id = wp_insert_post($my_post);
				wp_set_post_terms($post_id, $year, 'dtyear', false);
				wp_set_object_terms($post_id, $generos, 'genres', false);
				wp_set_post_terms($post_id, $redes, 'dtnetworks', false);
				wp_set_post_terms($post_id, $estudios, 'dtstudio', false);
				wp_set_post_terms($post_id, $actores, 'dtcast', false);
				wp_set_post_terms($post_id, $creador, 'dtcreator', false);
				add_post_meta($post_id, "ids", ($tvid) , true);
				add_post_meta($post_id, "dt_poster", ($poster) , true);
				add_post_meta($post_id, "dt_backdrop", ($backdrop) , true);
				add_post_meta($post_id, "imagenes", ($imgs) , true);
				add_post_meta($post_id, "youtube_id", ($youtube) , true);
				add_post_meta($post_id, "first_air_date", ($date1) , true);
				add_post_meta($post_id, "last_air_date", ($date2) , true);
				add_post_meta($post_id, "number_of_episodes", ($episodes) , true);
				add_post_meta($post_id, "number_of_seasons", ($seasons) , true);
				add_post_meta($post_id, "original_name", ($originalname) , true);
				add_post_meta($post_id, "status", ($status) , true);
				add_post_meta($post_id, "imdbRating", ($promedio) , true);
				add_post_meta($post_id, "imdbVotes", ($votos) , true);
				add_post_meta($post_id, "episode_run_time", ($duracion) , true);
				add_post_meta($post_id, "dt_cast", ($d_actores) , true);
				add_post_meta($post_id, "dt_creator", ($creador_d) , true);
				dt_upload_image($upload_poster, $post_id);
				$mensaje = __('Content published', 'mtms');
			}
			echo $mensaje;
			exit;
		}
		else {
			echo 'error';
			exit;
		}
	}
	else {
		echo 'Invalid license';
		exit;
	}
}
else {
	echo 'login';
	exit;
}
