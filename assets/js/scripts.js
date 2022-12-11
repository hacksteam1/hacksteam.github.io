! function(o) {
    o(window).load(function() {
        o(".scrolling").mCustomScrollbar({
            theme: "minimal-dark",
            scrollButtons: {
                enable: !0
            },
            callbacks: {
                onTotalScroll: function() {
                    addContent(this)
                },
                onTotalScrollOffset: 100,
                alwaysTriggerOffsets: !1
            }
        })
    })
}(jQuery), $(function() {
    for (var o = 0, n = $(".items .item"), l = 0; l <= n.length; l++) o > 3 ? ($(".items .item:nth-child(" + l + ") .dtinfo").addClass("right"), 5 > o ? o++ : (o--, o--, o--, o--)) : ($(".items .item:nth-child(" + l + ") .dtinfo").addClass("left"), o++)
}), 
$(".nav-resp").click(function() {
    $("#arch-menu").toggleClass("sidblock"), $(".nav-resp").toggleClass("active")
}), 


$(".nav-advc").click(function() {
    $("#advc-menu").toggleClass("advcblock"), $(".nav-advc").toggleClass("dactive")
}), 


$(".report-video").click(function() {
    $("#report-video").toggleClass("report-video-active"), $(".report-video").toggleClass("report-video-dactive")
}), 
		
$(".addlink").click(function() {
    $("#link_form_dt").toggleClass("advcblock"), $("#fondo_dt").toggleClass("advcblock"), $(".addlink").toggleClass("dellink")
}), 

$(".adduser").click(function() {
    $("#register_form").toggleClass("advcblock"), $(".form_fondo").toggleClass("advcblock"), $(".adduser").toggleClass("dellink")
}), 
		
$(".search-resp").click(function() {
    $("#form-search-resp").toggleClass("formblock"), $(".search-resp").toggleClass("active")
}), 
		
$(".content").ready(function() {
    $("#tvload").css("display", "none")
}), 
		
$(".content").load(function() {
    $("#tvload").css("display", "none")
}), 
		
$(".content").ready(function() {
    $("#movload").css("display", "none")
}), 
		
$(".content").load(function() {
    $("#movload").css("display", "none")
}), 
		
$(".content").ready(function() {
    $("#epiload").css("display", "none")
}), 
		
$(".content").load(function() {
    $("#epiload").css("display", "none")
}), 
		
$(".content").ready(function() {
    $("#seaload").css("display", "none")
}), 
		
$(".content").load(function() {
    $("#seaload").css("display", "none")
}), 
		
$(".content").ready(function() {
    $("#slallload").css("display", "none")
}), 
		
$(".content").load(function() {
    $("#slallload").css("display", "none")
}), 
		
$(".content").ready(function() {
    $("#sltvload").css("display", "none")
}), 
		
$(".content").load(function() {
    $("#sltvload").css("display", "none")
}), 
		
$(".content").ready(function() {
    $("#slmovload").css("display", "none")
}), 
		
$(".content").load(function() {
    $("#slmovload").css("display", "none")
});