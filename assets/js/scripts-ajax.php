<script>

    $(document).on('click', '.closeMobileDetect', function(e) {
        e.preventDefault();
        $('html,body').animate({ scrollTop: $("#top-bar").offset().top}, 'slow');
    });

    $("div.lazy").lazyload({
        threshold : 500,
        effect : "fadeIn",
        skip_invisible : false,
        failure_limit : 100
    });

    $("#home-slider").owlCarousel({
        center: true,
        items:3,
        autoWidth:true,
        margin:0,
        responsive:{600:{items:3}},
        startPosition: '1'
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

    $('.owl-next, .owl-prev').on('click', function(e) {
        ondragcarousel();
    });

    function ondragcarousel(event) {
        $(window).scroll();
    }

    $('.homepage-lister .header .button').on('click', function(e) {
        $('.homepage-lister .header .button').removeClass("active");
        $(this).addClass("active");
        var what = $(this).attr("data-what");
        var type = $(this).attr("data-type");
        getItems(what, type);
    });

    $('.sidebarHome .selectSome .item').on('click', function(e) {
        $('.sidebarHome .selectSome .item').removeClass("active");
        $(this).addClass("active");
        var what = $(this).attr("data-what");
        getSideBar(what);
    });

    function getItems(what, type){

        var data = "action=acao_do_ajax&what="+what+"&type="+type;

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            cache: false,
            success: function(html){
                var thisItem = $('.movies-carousel[data-loader="'+type+'"]');
                thisItem.empty();
                thisItem.append(html);
                thisItem.trigger('destroy.owl.carousel');

                thisItem.owlCarousel({
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

                thisItem.find("div.lazy").lazyload({
                    threshold : 300,
                    effect : "fadeIn",
                    skip_invisible : false,
                    failure_limit : 10
                });
            }
        });
    }

</script>
