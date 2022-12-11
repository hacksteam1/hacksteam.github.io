var file_frame;
var file_frame2;
var file_frame3;
var file_frame4;
var formfield;
formfield = "imagenes";
// Upload poster
jQuery('.up_images_poster').live('click', function( event ){
  event.preventDefault();
	if ( file_frame ) {
		file_frame.open();
		return;
	}
	file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
		multiple: false  
	});
	file_frame.on( 'select', function() {
		attachment = file_frame.state().get('selection').first().toJSON();
		jQuery("#dt_poster").val(attachment.url);
	});
	file_frame.open();
});
// Upload backdrop
jQuery('.up_images_backdrop').live('click', function( event ){
  event.preventDefault();
	if ( file_frame2 ) {
		file_frame2.open();
		return;
	}
	file_frame2 = wp.media.frames.file_frame2 = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
		multiple: false  
	});
	file_frame2.on( 'select', function() {
		attachment = file_frame2.state().get('selection').first().toJSON();
		jQuery("#dt_backdrop").val(attachment.url);
	});
	file_frame2.open();
});
// Upload Images
jQuery('.up_images_images').live('click', function( event ){
  event.preventDefault();
	if ( file_frame3 ) {
		file_frame3.open();
		return;
	}
	file_frame3 = wp.media.frames.file_frame3 = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
		multiple: true  
	});
	file_frame3.on( 'select', function() {
		attachment = file_frame3.state().get('selection').first().toJSON();
		if (formfield) {
		if(formfield == "imagenes"){
				acss = jQuery('#imagenes').val();
				if(acss != ""){ space = "\n"; } else { space = "";
			}
			jQuery('#'+formfield).val(acss + space + attachment.url);
		}else{
			jQuery('#'+formfield).val(attachment.url);
		}
		}
	});
	file_frame3.open();
});

jQuery('.up_images_tv').live('click', function( event ){
  event.preventDefault();
	if ( file_frame4 ) {
		file_frame4.open();
		return;
	}
	file_frame4 = wp.media.frames.file_frame4 = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
		multiple: false  
	});
	file_frame4.on( 'select', function() {
		attachment = file_frame4.state().get('selection').first().toJSON();
		jQuery("#dt_backdrop_tv").val(attachment.url);
	});
	file_frame4.open();
});
