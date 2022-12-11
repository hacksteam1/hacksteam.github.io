<div id="footer">
    <?php locate_template('parts/menu-footer.php', true, true); ?>
    <div class="credit-footer">
        <div class="row text-center">
            <?php { ?><?php
                $text_rodape = get_option('text_rodape');
                if ($text_rodape) {
                    echo '<h1>' . stripslashes($text_rodape) . '</h1>';
                } else {
                    echo '<h1><b>Free online movies</b> - Watch Free HD Movies Online</h1>';
                }
                ?>
                <?php } ?>       
                <?php { ?><?php
                    $nome = $sub_rodape = get_option('sub_rodape');
                    if ($sub_rodape) {
                        echo '<h3>' . stripslashes($sub_rodape) . '</h3>';
                    } else {
                        echo '<h3>&copy;Copyright All rights reserved ' . date('Y') . '</h3>';
                    }
                    ?>
                    <?php } ?>
					<a href="http://pinoymovie.ga">HD Movies</a>
                </div>
            </div>
        </div>
        <?php
        $footerg = get_option('footerg');
        $mostrar_footerg = get_option('mostrar_footerg');
        if ($mostrar_footerg == 'true') {
            echo stripslashes($footerg);
        }
        ?>
        <?php locate_template('assets/js/js.php', true, true); ?>
        <script>
    // MY SCRIPT
    new WOW().init();

    $("div.lazy").lazyload({
        threshold : 500,
        effect : "fadeIn",
        skip_invisible : false,
        failure_limit : 100
    });

    console.log("%c%s",
        "color: #00C3BE; font-family:helvetica,arial;font-size: 44px;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;",
        "<?php bloginfo('name'); ?> <?php bloginfo('description') ?>");

    function smartAlert(status, message) {
        $("body").prepend('<div class="smartAlert ' + status + '"><i class="fa fa-close"></i><div class="message">' + message + '</div></div>');
    }

    $(document).on("click", ".smartAlert .fa-close", function () {
        $(this).closest(".smartAlert").hide();
    });

    $(document).on('click', '.notify', function (e) {
                    // isso vai detetar se o user já abriu as notif
                    var notopen = true;
                    if ($(this).hasClass("itsopen")) {
                        notopen = false;
                    }

                    // elimina o numero de notis
                    var deleteNots = false;
                    if ($(this).hasClass("fill")) {
                        deleteNots = true;
                    }

                    var data = "notificationList&deln=" + deleteNots;
                    if (data, notopen) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo get_template_directory_uri() . '/inc/ajax/notify.php'; ?>",
                            data: data,
                            cache: false,
                            success: function (html) {
                                $(".notify").addClass("itsopen");
                                $(".notificatext").hide();
                                $(".notify .notifybox").empty().append(html);
                            }
                        });
                    }

                });
            </script>
            <?php if (is_category()) { ?>
            <script>

                function scrollEvent(event) {
                    $(window).scroll();
                }

                $("img.lazy").lazyload({
                    effect: "fadeIn"
                });

                $(document).on('keyup', '#seriename', function (e) {
                    var title = $(this).val().toLowerCase().trim();

                    setTimeout(function () {

                        if (!title) {
                            if ($("#series-list a:hidden")) {
                                $("#series-list a").show();
                            }
                        } else {

                            $('a .title:contains(' + title + ')').closest("a").show();
                            $('a .title:not(:contains(' + title + '))').closest("a").hide();

                            if ($("#series-list a:visible").length == 0) {
                                if ($(".notExistSerie:hidden")) {
                                    $(".notExistSerie").show();
                                }
                            } else {
                                $(".notExistSerie").hide();
                            }

                            scrollEvent();

                        }
                    }, 200);

                });

            </script>
            <?php } ?>
            <?php if (is_home() || is_search()) { ?>
            <?php locate_template('assets/js/scripts-ajax.php', true, true); ?>
            <?php } ?>
            <?php if (is_single()) { ?>
            <?php locate_template('assets/js/scripts-post.php', true, true); ?>

            <script>
               $(".reset").click(function(event){
                if (!confirm("<?php _e('Really you want to restart all data??','mtms'); ?>"))
                event.preventDefault();
            });
               $(".delete_notice").click(function(event){
                if (!confirm("<?php _e('Really you want to delete?','mtms'); ?>"))
                event.preventDefault();
            });

               $('#report').on('click', function(e) {
                $("#reportreason").fadeIn();
            });

               $("#reportreason .fa-close").on('click', function(e) {
                $("#reportreason").fadeOut();
            });

        </script>
        <?php } ?>
        <?php if( $c = get_option('dt_google_analytics')) { ?>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', '<?php echo $c; ?>', 'auto');
          ga('send', 'pageview');
      </script>
      <?php } ?>
      <?php wp_footer(); ?>
  </body>
  </html>
