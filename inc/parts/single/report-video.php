<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<form method="post" action="<?php the_permalink() ?>?report=send">

	<textarea required name="message" placeholder="Describe your problem"></textarea>

	<button type="submit" class="hover">Report</button>

	<label><?php _e('Verification code','mtms'); ?></label>
	<div class="g-recaptcha" data-sitekey="<?php echo GRC_PUBLIC; ?>"></div>

	<input type="hidden" name="idpost" value="<?php the_id(); ?>">
	<input type="hidden" name="permalink" value="<?php the_permalink() ?>">
	<input type="hidden" name="title" value="<?php the_title(); ?>">
	<input type="hidden" name="ip" value="<?php echo get_client_ip(); ?>">
	<input type="hidden" name="send_report" value="true">
</form>
