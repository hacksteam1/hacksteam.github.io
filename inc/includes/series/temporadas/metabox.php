<?php
function seasons_add_meta_box() {
	add_meta_box(
		'mt_metabox',
		__( 'seasons Info', 'mtms' ),
		'seasons_html',
		'seasons',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'seasons_add_meta_box' ); function seasons_html( $post) { wp_nonce_field( '_seasons_nonce', 'seasons_nonce' ); ?>
<table class="options-table-responsive dt-options-table">
	<tbody>
		<?php if(get_option( DT_KEY ) == "valid") { ?>
		<tr id="ids_box">
			<td class="label">
				<label><?php _e( 'Generate data', 'mtms' ); ?></label>
				<p class="description"><?php _e('Generate data from <strong>themoviedb.org</strong>','mtms'); ?></p>
			</td>
			<td class="field">
				<input class="extra-small-text" type="text" placeholder="1402" name="ids" id="ids" value="<?php echo dt_get_meta( 'ids' ); ?>">
				<input class="extra-small-text" type="text" placeholder="1" name="temporada" id="temporada" value="<?php echo dt_get_meta( 'temporada' ); ?>">
				<input type="button" class="button button-primary" name="generarepis" value="<?php if(dt_get_meta( 'ids' )){ _e('Update data','mtms'); } else { _e('Generate','mtms'); } ?>">
				<p class="description"><?php _e('E.g. https://www.themoviedb.org/tv/<strong>1402</strong>-the-walking-dead/season/<strong>1</strong>/','mtms'); ?></p>
			</td>
		</tr>
		<?php } ?>
		<tr id="serie_name_box">
			<td class="label">
				<label><?php _e( 'Serie name', 'mtms' ); ?></label>
			</td>
			<td class="field">
				<input class="regular-text" type="text" name="serie" id="serie" value="<?php echo dt_get_meta( 'serie' ); ?>">
			</td>
		</tr>
		<tr id="dt_poster_box">
			<td class="label">
				<label><?php _e( 'Poster', 'mtms' ); ?></label>
				<p class="description"><?php _e('Add url image','mtms'); ?></p>
			</td>
			<td class="field">
				<input class="regular-text" type="text" name="dt_poster" id="dt_poster" value="<?php echo dt_get_meta( 'dt_poster' ); ?>">
				<input class="up_images_poster button-secondary" type="button" value="<?php _e('Upload', 'mtms'); ?>" />
			</td>
		</tr>
		<tr id="air_date_box">
			<td class="label">
				<label><?php _e( 'Air date', 'mtms' ); ?></label>
			</td>
			<td class="field">
				<input class="small-text" type="date" name="air_date" id="air_date" value="<?php echo dt_get_meta( 'air_date' ); ?>">
			</td>
		</tr>
	
	</tbody>
</table>
<!-- ######################### -->
<?php if (has_post_thumbnail()): else: echo '<input type="hidden" id="url_image_upload" name="url_image_upload" value="">'; endif; ?>
<?php  }
function seasons_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['seasons_nonce'] ) || ! wp_verify_nonce( $_POST['seasons_nonce'], '_seasons_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( isset( $_POST['ids'] ) ) update_post_meta( $post_id, 'ids', esc_attr( $_POST['ids'] ) );
	if ( isset( $_POST['temporada'] ) ) update_post_meta( $post_id, 'temporada', esc_attr( $_POST['temporada'] ) );
	if ( isset( $_POST['dt_poster'] ) ) update_post_meta( $post_id, 'dt_poster', esc_attr( $_POST['dt_poster'] ) );
	if ( isset( $_POST['serie'] ) ) update_post_meta( $post_id, 'serie', esc_attr( $_POST['serie'] ) );
	if ( isset( $_POST['air_date'] ) ) update_post_meta( $post_id, 'air_date', esc_attr( $_POST['air_date'] ) );
	if (has_post_thumbnail()): else:  if($data = $_POST['url_image_upload']) {  dt_upload_image( $data,   $post_id ); } endif;
}
if(dttp == "valid") { 
	add_action( 'save_post', 'seasons_save' );
}
function custom_admin_js_seasons() { 
global $post_type; if( $post_type == 'seasons' ) {	?>
<script>
jQuery('input[name=generarepis]').click(function() {
	var input = jQuery('input[name=ids]').get(0).value;
	var temp = jQuery('input[name=temporada]').get(0).value;
	var imgplus = "?append_to_response=images";
	var dtms = '/season/' + temp;
	var url = "https://api.themoviedb.org/3/tv/";
	var idioma = "&language=<?php echo get_option('dt_api_language','en'); ?>&include_image_language=<?php echo get_option('dt_api_language','en'); ?>,null";
	var apikey = "&api_key=<?php echo get_option('dt_api_key'); ?>";
	// Send Request
	jQuery.getJSON(url + input + dtms + imgplus + idioma + apikey, function(tmdbdata) {
		var valPlo = "";
		var valImg = "";
		var valBac = "";
		var valTit = "";
		var valupimg = "";
		jQuery.each(tmdbdata, function(key, val) {
			jQuery('input[name=' + key + ']').val(val);
			<?php if(dt_get_meta( 'ids' )){ ?>
			jQuery('#message').remove();
            jQuery('#postbox-container-2').prepend('<div id=\"message\" class=\"notice rebskt updated \"><p><?php _e("The data have been updated, check please","mtms"); ?></p></div>');
			<?php } else { ?>
			jQuery('#message').remove();
            jQuery('#postbox-container-2').prepend('<div id=\"message\" class=\"notice rebskt updated \"><p><?php _e("Data were completed, check please","mtms"); ?></p></div>');
			<?php } ?>
			if (key == "overview") {
				if (typeof tinymce != "undefined") {
					var editor = tinymce.get('content');
					if (editor && editor instanceof tinymce.Editor) {
						editor.setContent(val);
						editor.save({
							no_events: true
						});
					} else {
						jQuery('textarea#content').val(val);
					}
				}					
			}
			if (key == "name") {
				valTit += "" + val + "";
			}
			jQuery.getJSON(url + input + "?" + idioma + apikey, function(tmdbdata) {
				jQuery.each(tmdbdata, function(key, item) {
					if (key == "name") {
						jQuery('#serie').val(item);
						jQuery('label#title-prompt-text').addClass('screen-reader-text');
						jQuery('input[name=post_title]').val(item + ": " + temp+"?? <?php _e('Season','mtms'); ?> ");
					}
				});
			});
			jQuery.getJSON(url + input + dtms + imgplus + idioma + apikey, function(tmdbdata) {
				jQuery.each(tmdbdata, function(key, item) {
					if (key == "poster_path") {
						jQuery('#dt_poster').val(item);
						jQuery('#url_image_upload').val("https://image.tmdb.org/t/p/w396"+item);
						<?php if( get_option( 'dt_api_upload_poster' ) == 'true' ) { if (has_post_thumbnail()): else: ?>
						jQuery('#postimagediv p').html("<ul><li><img class='dt_poster_preview' src='https://image.tmdb.org/t/p/w396"+ item +"'/> </li></ul>");
						<?php endif; } ?>
					}
				});
			});
		});
		jQuery('#img_episode').val(valImg);
	});
});
</script>
<script>
jQuery(document).ready(function() {
    jQuery(".dtload").click(function() {
        var o = jQuery(this).attr("id");
        1 == o ? (jQuery(".dtloadpage").hide(), jQuery(this).attr("id", "0")) : (jQuery(".dtloadpage").show(), jQuery(this).attr("id", "1"))
    }), jQuery(".dtloadpage").mouseup(function() {
        return !1
    }), jQuery(".dtload").mouseup(function() {
        return !1
    }), jQuery(document).mouseup(function() {
        jQuery(".dtloadpage").hide(), jQuery(".dtload").attr("id", "")
    })
})
</script>
<div class="dtloadpage">
	<div class="dtloadbox">
		<img src="<?php echo get_template_directory_uri().'/assets/img/'; ?>admin_load.gif">
		<span><?php _e('Generating episodes','mtms'); ?></span>
		<p><?php _e('not close this page to complete the upload','mtms'); ?></p>
	</div>
</div>

<?php 
  } 
}
add_action('admin_footer', 'custom_admin_js_seasons');
