<?php locate_template('/assets/css/css.php', true, true); ?>
<div class="modal-sign modal modal-signs" style="display: table;">
	<div class="box-out">
		<div class="box-in box-in-small">
			<div class="inner">
				<div class="left">
					<img src="<?php $logologin = get_option('dt_logo_admin'); if($logologin) { echo stripslashes($logologin);} else {echo esc_url( get_template_directory_uri() ).'/assets/img/logo_dark.svg';}?>">
					<div class="clearfix"></div>
					<span id="error"></span>
					<form name="loginform" id="loginform" action="<?php echo home_url('/'); ?>wp-login.php" method="post">
						<input type="text" name="log" id="user_login" class="input" value="" size="20" placeholder="Email">
						<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" placeholder="Password">
						<input type="hidden" name="redirect_to" value="<?php echo get_option('dt_account_page'); ?>">
						<div class="clearfix"></div>
						<button type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In">Log In</button>
						<a href="<?php echo home_url('/'); ?>wp-login.php?action=lostpassword" class="lostpassword">Forgot your password?</a>
					</form>
				</div>
			</div>
			<div class="clearfix"></div><br>
			<span class="register-text">Not signed up yet? <b class="pointer"><a href="<?php echo esc_url(home_url('/wp-login.php?action=register')); ?>" target="_BLANK"> Sign up now</a></b></span>
			<div class="clearfix"></div><br>
		</div>
	</div>
</div>