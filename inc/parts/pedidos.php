<div class="wrapper" style="background:url(<?php echo get_template_directory_uri() . '/assets/img/req_bg.jpg'; ?>) no-repeat fixed center bottom / cover;">
	<div class="clearfix"></div>
	<div class="row mini" id="requestsZone">
		<div class="header">
			<img src="<?php echo get_template_directory_uri() . '/assets/img/requests.jpg'; ?>" alt="">
		</div>
		<div class="menubar">

			<div class="item hover active openGeneralItems">
				ORDER LIST
			</div>
			<?php if (is_user_logged_in()) { ?>
			<div class="item hover openMyItems">
				MY REQUESTS
			</div>
			
			<div class="item new-req hover" style="background: #e67e22;">
				MAKE NEW REQUEST
			</div>
			<?php } else{?>
			<div class="item new-req open-login hover" style="background: #e67e22;">
				MAKE A LOGIN TO REQUESTS
			</div>
			<?php } ?>
		</div>

		<div class="content">

			<div id="request-data">

			</div>

			<div id="tutorial">
				<i class="fa fa-close closeTutorial"></i>
				<div class="title">HOW TO REQUESTS</div>
				<span>Access the <a href="http://www.imdb.com" target="_BLANK">IMDB</a> and search for your movie or series in the search bar.</span><br>
				<span>Copy the ID code in the URL bar as shown in the image below.</span> <br>
				<span>Finally, return to the <b>Gostream</b>, paste the ID in the field <b>"IMDB ID"</b> and place the request.</span>

				<div class="clearfix"></div>
				<img src="<?php echo get_template_directory_uri() . '/assets/img/tutorial.png'; ?>" alt="">
			</div>


			<div id="new-request">
				<div class="loading newRequestLoad"></div>
				<div class="form">
					<form id="postdata" class="generador_form">
						<span>IMDB ID - film / serie</span>
						<input type="text" id="imdb" name="imdb" placeholder="IMDb URL" required>
						<button type="submit" id="">MAKE REQUEST</button>
					</form>
				</div>
				<div class="tutorial">
					<span>Not sure where to find the <b>IMDB ID</b>?</span>
					<div class="openTutorial">Read the tutorial here</div>
				</div>
			</div>

			<div id="request-list">

				<?php
				if (have_posts()) :while (have_posts()) : the_post();
				get_template_part('inc/parts/item_pe');
				endwhile;
				endif;
				?>


			</div>
		</div>
		<?php basey_pagination(); ?>
	</div>
</div>
<?php if (is_user_logged_in()) { ?>
<script>

	$(document).on('click', '.openMyItems', function (e) {
		requestsList("1", "user");
		$(this).addClass("active");
		$(".openGeneralItems").removeClass("active");
	});

	$(document).on('click', '.closeAlert', function (e) {
		$(".alert").fadeOut(200);
		setTimeout(function () {
			$(".alert").remove();
		}, 300);
	});

	$(document).on('click', '.openTutorial', function (e) {
		$("#tutorial").fadeIn(100);
	});
	$(document).on('click', '.closeTutorial', function (e) {
		$("#tutorial").fadeOut(100);
	});

	$(document).on('click', '.new-req', function (e) {
		$("#new-request").fadeIn();
	});

	$(document).on('click', '.openRequest', function(e) {
		e.preventDefault();
		var id = $(this).attr("data-request-id");

		var data = "action=request&Data&id="+id;

		if (id) {
			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: data,
				cache: false,
				success: function(html){
					$("#request-data").empty();
					$("#request-data").append(html);
				}
			});
		}
	});

	$(document).ready(function(){
		$('#postdata').submit(function(){
			$(".newRequestLoad").fadeIn(100);
			$( ".generador_form" ).last().addClass( "generate_ajax" );
			$.ajax({
				type: 'POST',
				url: '<?php echo get_template_directory_uri(); ?>/inc/api/requests.php', 
				data: $(this).serialize()
			})
			.done(function(data){
				location.reload();
			})
			.fail(function() {
				alert( "Error" );
			});
			return false;

		});
	});
</script>
<?php } ?>