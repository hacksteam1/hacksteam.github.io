<?php $ativar_adb = get_option('ativar_adb');
if ($ativar_adb == 'true') { ?>
       <script>


	function appendThatThingThatYouWant(){
		$(".appendAdbHere").append('<div class="adBlockDetected">Foi detetado <b>ADBLOCK</b><br><span>Sem anúncios não podemos permanecer online!</span><span>Se você se preocupa com nosso serviço, desligue o adblock no <?php bloginfo('nome'); ?>.</span></div>');
		$(".adBlockDetected").show();
		$(".fullplayer").addClass("adblocked");
	}
	

	function setCook(cname,cvalue){
		var now = new Date();
		var expire = new Date();

		expire.setFullYear(now.getFullYear());
		expire.setMonth(now.getMonth());
		expire.setDate(now.getDate()+1);
		expire.setHours(0);
		expire.setMinutes(0);
		expire.setSeconds(0);

		var expires = "expires="+expire.toString();
		document.cookie = cname + "=" + cvalue + "; " + expires +"; path=/";
	}

	/// ADB DETECTOR
	adblockStatus = false;

	function adBDTT() {

		setCook("adBlockStatus", "false");

		if ($('.banner_ads').filter(':visible').length == 0) {
			console.log("blocking");
			adblockStatus = true;
			setCook("adBlockStatus", "true");
		} else if ($('.banner_ads').filter(':hidden').length > 0) {
			console.log("blocking");
			adblockStatus = true;
			setCook("adBlockStatus", "true");
		}
		
	}
	adBDTT();

</script>     
<?php } ?>

<script src="<?php echo $src = get_template_directory_uri() . '/assets/js/pkgd.min.js'; ?>" ></script>

<script>

	$(document).on("click",".cinemaModeButton",function(){
		if ($(this).hasClass("open")) {
			$(this).removeClass("open").html('FECHAR CINEMA <i class="icon fa fa-tv"></i>');
			$(".fullplayer, .toolBar, .superHidderCinema").addClass("cinemaMode");
		}else{
			$(this).addClass("open").html('MODO CINEMA <i class="icon fa fa-tv"></i>');
			$(".fullplayer, .toolBar, .superHidderCinema").removeClass("cinemaMode");
		}
	});

	var test = document.createElement('div');
	test.innerHTML = '&nbsp;';
	test.className = 'adsbox';
	document.body.appendChild(test);
	window.setTimeout(function() {
		if (test.offsetHeight === 0) {
			appendThatThingThatYouWant();
		}
		test.remove();
	}, 100);

		//IT ENDS

		$(function(){

			imdbRating();

			var AllThePlot = $(".AllThePlot").text();
			$('.plot .texter').append(AllThePlot);

			if ($(".plot .texter").text().length > 100) {
				var text = 	$('.plot .texter').text().substr(0, 100);
				$('.plot .texter').empty().append(text);
				$('.plot .texter').append("<span class='readMorePlot'> Ler mais...</span>");
			}

		});

		$(document).on('click', '.readMorePlot', function () {
			$('.plot .texter').empty().append($(".AllThePlot").text());
		});

		$(document).on('click', '#download-frame .closeDownload', function (e) {
			e.preventDefault();
			e.stopPropagation();
			$('#download-frame').remove();
		});

		$("div.lazy").lazyload({
			threshold : 200,
			effect : "fadeIn",
			skip_invisible : false,
			failure_limit : 10
		});

		$('.movies-carousel').owlCarousel({
			center: false,
			loop:false,
			autoWidth:true,
			responsiveClass:true,
			nav:true,
			navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			onDragged: ondragcarousel,
			responsive:{
				0:{
					items:1,
					center:true
				},
				600:{

				},
				1000:{

				}
			}
		});

		function ondragcarousel(event) {
			$(window).scroll();
		}

		$('#open-trailer').on('click', function(e) {
			var url = $(this).attr("data-trailer");
			$(".modal-trailer iframe").attr("src", url);
			$(".modal-trailer").fadeIn(200).css("display", "table");
		});


		$('.modal-trailer').on('click', function(e) {
			if($(e.target).closest('.box-in').length === 0) {
				$(".modal-trailer").fadeOut(200);
				$(".modal-trailer iframe").attr("src", $(".modal-trailer iframe").attr("src"))
				$("html").removeClass("no-scroll");
			}
		});

		$('.changePlayer').on('click', function(e) {
			$(".playerList.playerListSmall").show();
			$(".fullplayer .player").hide().empty();
		});

		$('.playerList .item').on('click', function(e) {
			$(".fullplayer .player").hide();
			$(".prepareVideo").hide();
			$(".fullplayer .playerList").hide();
			$(this).addClass("active");
			var playerData = $(this).attr("data-player-content");
			$(".fullplayer .player").append(playerData);
			$(".fullplayer .player").show();
		});

		$('.playerList .item').hover(function(e) {
			$('.playerList .item').removeClass("active");
			var rowNumber = $(this).attr("data-count-row");
			if ($.trim(rowNumber) == 1) {
				$(".videoOut").css("top", "0px");
				$("#videoAd").attr("data-player", "1");
				$('.playerList .item[data-count-row="'+rowNumber+'"]').addClass("active");
			}else if ($.trim(rowNumber) == 2) {
				$(".videoOut").css("top", "50px");
				$("#videoAd").attr("data-player", "2");
				$('.playerList .item[data-count-row="'+rowNumber+'"]').addClass("active");
			}else if ($.trim(rowNumber) == 3) {
				$(".videoOut").css("top", "100px");
				$("#videoAd").attr("data-player", "3");
				$('.playerList .item[data-count-row="'+rowNumber+'"]').addClass("active");
			}else if ($.trim(rowNumber) == 4) {
				$(".videoOut").css("top", "150px");
				$("#videoAd").attr("data-player", "4");
				$('.playerList .item[data-count-row="'+rowNumber+'"]').addClass("active");
			}
		});
	</script>