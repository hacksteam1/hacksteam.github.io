<?php
define('WP_USE_THEMES', false);
require ('../../../../../wp-blog-header.php');
status_header(200);
nocache_headers();
set_time_limit(30000);
if (is_user_logged_in())
{
	if (dttp == "valid")
	{
		if (($_POST["imdb"] != NULL))
		{
			$key = get_option('dt_api_key');
			$lang = get_option('dt_api_language', 'en');
			$imdb = $_POST["imdb"];
			if (($imdb != NULL))
			{
				$api = "http://www.omdbapi.com/?i=" . $imdb . "";
				$jsonn = file_get_contents($api);
				$data1 = json_decode($jsonn, TRUE);
				// ##########################################
				$a3 = $data1['Year'];
				$a4 = $data1['imdbRating'];
				$a5 = $data1['imdbVotes'];
				$a6 = $data1['Rated'];
				$a7 = $data1['Country'];
				// ##########################################
				$api_1 = "https://api.themoviedb.org/3/movie/" . $imdb . "?append_to_response=images,trailers&language=" . $lang . "&include_image_language=" . $lang . ",null&api_key=" . $key . "";
				$json_1 = file_get_contents($api_1);
				$data = json_decode($json_1, TRUE);
				// ##########################################
				$b1 = $data['runtime'];
				$b2 = $data['tagline'];
				$b3 = $data['title'];
				$b4 = $data['overview'];
				$b9 = $data['vote_count'];
				$b10 = $data['vote_average'];
				$b11 = $data['release_date'];
				$b12 = $data['original_title'];
				$b13 = $data['poster_path'];
				if ($get_img = $data['poster_path'])
				{
					$upimg = 'https://image.tmdb.org/t/p/w396' . $get_img;
				}
				$b14 = $data['backdrop_path'];
				$b15 = $data['images']["backdrops"];
				$i = '0';
				foreach($b15 as $valor2) if ($i < 10) {
					$imgs.= $valor2['file_path'] . "\n";
					$i +=1;
				}
				$b16 = $data['genres'];
				$generos = array();
				foreach($b16 as $ci)
				{
					$generos[] = $ci['name'];
				}
				$b17 = $data['id'];
				// ##########################################
				$api_2 = "https://api.themoviedb.org/3/movie/" . $imdb . "/credits?append_to_response=images,trailers&language=" . $lang . "&include_image_language=" . $lang . ",null&api_key=" . $key . "";
				$json_2 = file_get_contents($api_2);
				$data2 = json_decode($json_2, TRUE);
				// ##########################################
				$c1 = $data2['cast'];
				$i = '0';
				foreach($c1 as $valor) if ($i < 10) {
					$actores.= $valor['name'] . ",";
					$i +=1;
				}
				$i = '0';
				foreach($c1 as $valor) if ($i < 10) {
					if ($valor['profile_path'] == NULL)
					{
						$valor['profile_path'] = "null";
					}
					$d_actores.= "[" . $valor['profile_path'] . ";" . $valor['name'] . "," . $valor['character'] . "]";
					$i +=1;
				}
				$c2 = $data2['crew'];
				foreach($c2 as $valorc)
				{
					$departamente = $valorc['department'];
					if ($valorc['profile_path'] == NULL)
					{
						$valorc['profile_path'] = "null";
					}
					if ($departamente == "Directing")
					{
						$d_dir.= "[" . $valorc['profile_path'] . ";" . $valorc['name'] . "]";
					}
					if ($departamente == "Directing")
					{
						$dir.= $valorc['name'] . ",";
					}
				}
				// ##########################################
				$api_3 = "https://api.themoviedb.org/3/movie/" . $imdb . "/videos?append_to_response=images,trailers&language=" . $lang . "&include_image_language=" . $lang . ",null&api_key=" . $key . "";
				$json_3 = file_get_contents($api_3);
				$data3 = json_decode($json_3, TRUE);
				// ##########################################
				$d1 = $data3['results'];
				foreach($d1 as $yt)
				{
					$youtube.= "[" . $yt['key'] . "]";
					break;
				}
				// ##########################################


				$my_post = array(
					'post_title' => wp_strip_all_tags(html_entity_decode($b3)) ,
					'post_content' => wp_strip_all_tags(html_entity_decode($b4)) ,
					'post_date'     => date('Y-m-d H:i:s'),
					'post_date_gmt' => date('Y-m-d H:i:s'),
					'post_status' => get_option('dt_api_post_status_pedidos', 'publish') ,
					'post_type' => 'pedido',
					'post_author' => 1
				);


				$post_id = wp_insert_post($my_post);
				wp_set_object_terms($post_id, $generos, 'genres', false);
				add_post_meta($post_id, "ids", ($imdb) , true);
				add_post_meta($post_id, "dt_poster", ($b13) , true);
				add_post_meta($post_id, "original_title", ($b12) , true);
				add_post_meta($post_id, "release_date", ($b11) , true);
				add_post_meta($post_id, "vote_average", ($b10) , true);
				add_post_meta($post_id, "vote_count", ($b9) , true);
				dt_upload_image($upimg, $post_id);
				$mensaje = __('Content published', 'mtms');
			}
			echo $mensaje;
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
		echo 'Invalid license';
		exit;
	}
}
else
{
	echo 'login';
	exit;
}