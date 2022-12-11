<?php
/* POST Episodes ( wp-admin ) AJAX
  -------------------------------------------------------------------------------
 */

  function dt_post_episodes_ajax() {
    if (isset($_GET['episodes_nonce']) and wp_verify_nonce($_GET['episodes_nonce'], 'add_episodes')) {
        if (current_user_can('manage_options')) {
            if (dttp == "valid") {
                if (($_GET["se"] != NULL) && ($_GET["te"] != NULL)) {
                    $dtemporada = $_GET["te"];
                    $ids = $_GET["se"];
                    if (($ids != NULL) && ($dtemporada != NULL)) {
                        $urltname = wp_remote_get(tmdburl . "tv/" . $ids . "?&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
                        $json2 = wp_remote_retrieve_body($urltname);
                        $data2 = json_decode($json2, TRUE);
                        $tituloserie = $data2['name'];
                        $urltoc = wp_remote_get(tmdburl . "tv/" . $ids . "/season/" . $dtemporada . "?append_to_response=images,trailers&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
                        $json1 = wp_remote_retrieve_body($urltoc);
                        $data1 = json_decode($json1, TRUE);
                        $sdasd = count($data1['episodes']);
                        $poster_serie = $data1['poster_path'];
                        for ($cont = 1; $cont <= $sdasd; $cont++) {
                            $url = wp_remote_get(tmdburl . 'tv/' . $ids . '/season/' . $dtemporada . '/episode/' . $cont . '?append_to_response=images&language=' . tmdblang . '&include_image_language=' . tmdblang . ',null&api_key=' . tmdbkey);
                            $json = wp_remote_retrieve_body($url);
                            $data = json_decode($json, TRUE);
                            $season = $data['season_number'];
                            $episode = $data['episode_number'];
                            $name = $data['name'];
                            $dmtid = 'tv' . DT_STRING_LINK . $data['id'];
                            $overview = $data['overview'];
                            if ($metadate = $data['air_date']) {
                                $air_date = $metadate;
                            } else {
                                $air_date = date('Y-m-d');
                            }
                            $still_path = $data['still_path'];
                            if ($get_img = $data['still_path']) {
                                $upload_img = 'https://image.tmdb.org/t/p/w600' . $get_img;
                            }
                            $crew = $data['crew'];
                            $guest_stars = $data['guest_stars'];
                            $images = $data['images']["stills"];
                            $castor = $img = $cast = $director = $writer = "";
                            foreach ($crew as $valor) {
                                $departamente = $valor['department'];
                                if ($valor['profile_path'] == NULL) {
                                    $valor['profile_path'] = "null";
                                }
                                if ($departamente == "Directing") {
                                    $director .= $valor['name'] . ",";
                                }
                                if ($departamente == "Writing") {
                                    $writer .= $valor['name'] . ",";
                                }
                            }
                            $i = '0';
                            foreach ($guest_stars as $valor1)
                                if ($i < 3) {
                                    if ($valor1['profile_path'] == NULL) {
                                        $valor1['profile_path'] = "null";
                                    }
                                    $castor .= $valor1['name'] . ",";
                                    $i += 1;
                                }
                                $i = '0';
                                foreach ($images as $valor2)
                                    if ($i < 0) {
                                        $img .= $valor2['file_path'] . "\n";
                                        $i += 1;
                                    }
                                    $dt_episodes = array(
                                        'post_title' => dt_clear($tituloserie . ": " . eseas . $season . esepart . eepisod . $episode),
                                        'post_content' => dt_clear($overview),
                                        'post_status' => 'publish',
                                        'post_type' => 'episodes',
                                        'post_author' => 1
                                        );
                                    $post_id = wp_insert_post($dt_episodes);
                                    add_post_meta($post_id, "ids", ($ids), true);
                                    add_post_meta($post_id, "temporada", ($season), true);
                                    add_post_meta($post_id, "episodio", ($episode), true);
                                    add_post_meta($post_id, "serie", ($tituloserie), true);
                                    add_post_meta($post_id, "episode_name", ($name), true);
                                    add_post_meta($post_id, "air_date", ($air_date), true);
                                    add_post_meta($post_id, "imagenes", ($img), true);
                                    add_post_meta($post_id, "dt_backdrop", ($still_path), true);
                                    add_post_meta($post_id, "dt_poster", ($poster_serie), true);
                                    add_post_meta($post_id, "dt_string", ($dmtid), true);
                                    dt_upload_image($upload_img, $post_id);
                                }
                            }
                            update_post_meta($_GET["link"], 'clgnrt', '1');
                            wp_redirect(get_admin_url() . "edit.php?post_type=seasons");
                            exit;
                        } else {
                            echo 'error';
                            exit;
                        }
                    } else {
                        echo 'invalid license';
                        exit;
                    }
                } else {
                    echo 'login';
                    exit;
                }
            }
            die();
        }

        add_action('wp_ajax_episodes_ajax', 'dt_post_episodes_ajax');
        add_action('wp_ajax_nopriv_episodes_ajax', 'dt_post_episodes_ajax');

/* POST Episodes ( front-end ) AJAX
  -------------------------------------------------------------------------------
 */

  function dt_post_episodes_front_ajax() {
    if (isset($_GET['episodes_nonce']) and wp_verify_nonce($_GET['episodes_nonce'], 'add_episodes')) {
        if (current_user_can('manage_options')) {
            if (dttp == "valid") {
                if (($_GET["se"] != NULL) && ($_GET["te"] != NULL)) {
                    $dtemporada = $_GET["te"];
                    $ids = $_GET["se"];
                    if (($ids != NULL) && ($dtemporada != NULL)) {
                        $urltname = wp_remote_get(tmdburl . "tv/" . $ids . "?&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
                        $json2 = wp_remote_retrieve_body($urltname);
                        $data2 = json_decode($json2, TRUE);
                        $tituloserie = $data2['name'];
                        $urltoc = wp_remote_get(tmdburl . "tv/" . $ids . "/season/" . $dtemporada . "?append_to_response=images,trailers&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
                        $json1 = wp_remote_retrieve_body($urltoc);
                        $data1 = json_decode($json1, TRUE);
                        $sdasd = count($data1['episodes']);
                        $poster_serie = $data1['poster_path'];
                        for ($cont = 1; $cont <= $sdasd; $cont++) {
                            $url = wp_remote_get(tmdburl . 'tv/' . $ids . '/season/' . $dtemporada . '/episode/' . $cont . '?append_to_response=images&language=' . tmdblang . '&include_image_language=' . tmdblang . ',null&api_key=' . tmdbkey);
                            $json = wp_remote_retrieve_body($url);
                            $data = json_decode($json, TRUE);
                            $season = $data['season_number'];
                            $episode = $data['episode_number'];
                            $name = $data['name'];
                            $dmtid = 'tv' . DT_STRING_LINK . $data['id'];
                            $overview = $data['overview'];
                            if ($metadate = $data['air_date']) {
                                $air_date = $metadate;
                            } else {
                                $air_date = date('Y-m-d');
                            }
                            $still_path = $data['still_path'];
                            if ($get_img = $data['still_path']) {
                                $upload_img = 'https://image.tmdb.org/t/p/w600' . $get_img;
                            }
                            $crew = $data['crew'];
                            $guest_stars = $data['guest_stars'];
                            $images = $data['images']["stills"];
                            $castor = $img = $cast = $director = $writer = "";
                            foreach ($crew as $valor) {
                                $departamente = $valor['department'];
                                if ($valor['profile_path'] == NULL) {
                                    $valor['profile_path'] = "null";
                                }
                                if ($departamente == "Directing") {
                                    $director .= $valor['name'] . ",";
                                }
                                if ($departamente == "Writing") {
                                    $writer .= $valor['name'] . ",";
                                }
                            }
                            $i = '0';
                            foreach ($guest_stars as $valor1)
                                if ($i < 3) {
                                    if ($valor1['profile_path'] == NULL) {
                                        $valor1['profile_path'] = "null";
                                    }
                                    $castor .= $valor1['name'] . ",";
                                    $i += 1;
                                }
                                $i = '0';
                                foreach ($images as $valor2)
                                    if ($i < 10) {
                                        $img .= $valor2['file_path'] . "\n";
                                        $i += 1;
                                    }
                                    $dt_episodes = array(
                                        'post_title' => dt_clear($tituloserie . ": " . eseas . $season . esepart . eepisod . $episode),
                                        'post_content' => dt_clear($overview),
                                        'post_status' => 'publish',
                                        'post_type' => 'episodes',
                                        'post_author' => 1
                                        );
                                    $post_id = wp_insert_post($dt_episodes);
                                    add_post_meta($post_id, "ids", ($ids), true);
                                    add_post_meta($post_id, "temporada", ($season), true);
                                    add_post_meta($post_id, "episodio", ($episode), true);
                                    add_post_meta($post_id, "serie", ($tituloserie), true);
                                    add_post_meta($post_id, "episode_name", ($name), true);
                                    add_post_meta($post_id, "air_date", ($air_date), true);
                                    add_post_meta($post_id, "imagenes", ($img), true);
                                    add_post_meta($post_id, "dt_backdrop", ($still_path), true);
                                    add_post_meta($post_id, "dt_poster", ($poster_serie), true);
                                    add_post_meta($post_id, "dt_string", ($dmtid), true);
                                    dt_upload_image($upload_img, $post_id);
                                }
                            }
                            update_post_meta($_GET["link"], 'clgnrt', '1');
                            wp_redirect(get_permalink($_GET["link"]));
                            exit;
                        } else {
                            echo 'error';
                            exit;
                        }
                    } else {
                        echo 'invalid license';
                        exit;
                    }
                } else {
                    echo 'login';
                    exit;
                }
            }
            die();
        }

        add_action('wp_ajax_seasonsf_ajax', 'dt_post_episodes_front_ajax');
        add_action('wp_ajax_nopriv_seasonsf_ajax', 'dt_post_episodes_front_ajax');

/* POST Seasons AJAX
  -------------------------------------------------------------------------------
 */

  function dt_post_seasons_ajax() {
    if (isset($_GET['seasons_nonce']) and wp_verify_nonce($_GET['seasons_nonce'], 'add_seasons')) {
        if (current_user_can('manage_options')) {
            if (dttp == "valid") {
                if (($_GET["se"] != NULL)) {
                    $ids = $_GET["se"];
                    if (($ids != NULL)) {
                        $urltname = wp_remote_get(tmdburl . "tv/" . $ids . "?&language=" . tmdblang . "&include_image_language=" . tmdblang . ",null&api_key=" . tmdbkey);
                        $json2 = wp_remote_retrieve_body($urltname);
                        $data2 = json_decode($json2, TRUE);
                        $tituloserie = $data2['name'];
                        $sdasd = $data2['number_of_seasons'];
                        for ($cont = 1; $cont <= $sdasd; $cont++) {
                            $url = wp_remote_get(tmdburl . 'tv/' . $ids . '/season/' . $cont . '?append_to_response=images&language=' . tmdblang . '&include_image_language=' . tmdblang . ',null&api_key=' . tmdbkey);
                            $json = wp_remote_retrieve_body($url);
                            $data = json_decode($json, TRUE);
                            $name = $data['name'];
                            $poster_serie = $data['poster_path'];
                            if ($get_img = $data['poster_path']) {
                                $upload_poster = 'https://image.tmdb.org/t/p/w396' . $get_img;
                            }
                            $overview = $data['overview'];
                            $year = substr($data['air_date'], 0, 4);
                            $fecha = $data['air_date'];
                            $season_number = $data['season_number'];
                            $my_post = array(
                                'post_title' => dt_clear($tituloserie . ": ". $cont."ª Temporada"),
                                'post_content' => dt_clear($overview),
                                'post_status' => 'publish',
                                'post_type' => 'seasons',
                                'post_author' => 1
                                );
                            $post_id = wp_insert_post($my_post);
                            add_post_meta($post_id, "ids", ($ids), true);
                            add_post_meta($post_id, "temporada", ($season_number), true);
                            add_post_meta($post_id, "serie", ($tituloserie), true);
                            add_post_meta($post_id, "air_date", ($fecha), true);
                            add_post_meta($post_id, "dt_poster", ($poster_serie), true);
                            dt_upload_image($upload_poster, $post_id);
                        }
                    }
                    update_post_meta($_GET["link"], 'clgnrt', '1');
                    wp_redirect(get_admin_url() . "edit.php?post_type=seasons");
                    exit;
                } else {
                    echo 'error';
                    exit;
                }
            } else {
                echo 'invalid license';
                exit;
            }
        } else {
            echo 'login';
            exit;
        }
    }
    die();
}

add_action('wp_ajax_seasons_ajax', 'dt_post_seasons_ajax');
add_action('wp_ajax_nopriv_seasons_ajax', 'dt_post_seasons_ajax');
