<div id="link_form_dt" class="link_sharing animation-3">
<h3><?php _e('Submit a link','mtms'); ?></h3>
	<form id="postlink">
		<?php if($id = dt_get_meta('dt_string')) { ?>
		<input type="hidden" name="idpost" value="<?php the_id(); ?>">
		<input type="hidden" name="titlepost" value="<?php the_title(); ?>">
		<input type="hidden" name="dt_string" value="<?php echo $id; ?>">
		<?php } ?>
		<p class="setab reloading">
			<label class="metrox tipo"><input type="radio" name="tipo" value="Baixar" checked> Download Link</label>
			<label class="metrox tipo"><input type="radio" name="tipo" value="Legenda"> Legend</label>
		</p>
		<p class="select reloading">
		<b><?php _e('Select quality','mtms'); ?></b>
		<select name="calidad">
		<?php
		$links_quality = get_option( 'dt_quality_post_link' );
		if(!empty($links_quality)){ $val = explode(",", $links_quality); foreach( $val as $valor ){ 
		echo '<option value="'.$valor.'">'.$valor.'</option>'; 
		echo "\n";
		}  } else { 
		$quality = array('SD','HD','480p','720p','1080p');
		foreach( $quality as $val ) { ?>
		<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
		<?php }  } ?>
		</select>
		</p>
		<p class="select reloading" style="float:right;">
		<b><?php _e('Select language','mtms'); ?></b>
		<select name="idioma">
		<?php
		$links_lang = get_option( 'dt_languages_post_link');
		if(!empty($links_lang)){ $val = explode(",", $links_lang); foreach( $val as $valor ){
		echo '<option value="'.$valor.'">'.$valor.'</option>'; 
		echo "\n";
		}  } else { 
		$quality = array('Dublado','Inglês');
		foreach( $quality as $val ) { ?>
		<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
		<?php }  } ?>
		</select>
		</p>

		<p>
		<input class="reloading" type="url" name="url" placeholder="http://" required>
		</p>

		<?php if(get_option('dt_permissions_post_links') =='a77') { ?>
		<?php if( current_user_can('level_10') ) : /*none*/ else : ?>
		<p class="reloading"><strong><?php _e('Security Check','mtms'); ?></strong> <small><?php _e('Copy the digits from the image into this text box','mtms'); ?></small></p>
		<div class="reloading captcha animation-3">
		<a href="#" onclick="document.getElementById('captcha').src = '<?php echo get_template_directory_uri(); ?>/inc/captcha.php?' + Math.random();document.getElementById('captcha_code').value = '';return false;"><i class="icon-refresh"></i></a>
		<img id="captcha" src="<?php echo get_template_directory_uri(); ?>/inc/captcha.php" alt="Captcha">
		<input id="captcha_code" type="text" maxlength="5" name="captcha" value="" placeholder="- - - -" required pattern="\d{5}" onkeyup="this.value = this.value.replace(/[^\d]+/g, '');">
		</div>

		<?php endif; ?>
		<?php } ?>

		<div id="linking"></div>

		<p>
		<input class="reloading" type="submit" value="<?php _e('Send Link','mtms'); ?>">
		<a class="addlink dellink"><?php _e('Cancel','mtms'); ?></a>
		</p>
	</form>
</div>
<script>
$(document).ready(function(){
    $('#postlink').submit(function(){
        $('#linking').html("<span class='loading'></span> <?php _e('Sending link..','mtms'); ?>");
        $.ajax({
            type: 'POST',
			cache: false,
            <?php if( current_user_can('administrator') ) { ?> 
			url: '<?php echo get_template_directory_uri(); ?>/inc/api/links_a00.php', 
			<?php } else { ?>
			url: '<?php echo get_template_directory_uri(); ?>/inc/api/links_<?php echo get_option('dt_permissions_post_links','a00'); ?>.php', 
			<?php } ?>
            data: $(this).serialize()
        })
        .done(function(html){
			// Agregando clase
			$( ".reloading" ).addClass( "reloading_page" );
			// agrendo mensaje
			$("#linking").html(html);
			// direccionando pagina
			setTimeout(function () { location.reload(1); }, 2000);
			
        })
        .fail(function() {
            alert( "Error" );
        });
        return false;
    });
});
// add clic  
 $('label.tipo').click(function () {
     $('label.tipo').removeClass('checked');
     $(this).addClass('checked');
 });

 $('label.idioma').click(function () {
     $('label.idioma').removeClass('checked');
     $(this).addClass('checked');
 });

  $('label.calidad').click(function () {
     $('label.calidad').removeClass('checked');
     $(this).addClass('checked');
 });

$('input:checked').parent().addClass('checked');
</script>
