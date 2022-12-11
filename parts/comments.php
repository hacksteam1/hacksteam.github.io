<div class="row wrapi comments">
    <?php if (comments_open()) : ?>
        <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
            <div class="medium-6 columns gridItem" >
                <div class="newComment">

                    <div class="logged_out">
                        Do it <span class="open-login">Log In</span> to comment
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        <?php else : ?>
            <div class="medium-6 columns gridItem" >
                <div class="newComment">
                    <div class="logged_out">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <form class="uk-form uk-margin-bottom" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" data-parsley-validate>
                <?php if (is_user_logged_in()) : ?>
                <?php else : ?>
                <?php endif; ?>
                <div class="medium-6 columns gridItem" style="position: absolute; left: 0px; top: 0px;">
                    <div class="newComment">
                        <textarea name="comment" placeholder="Your comment..." required=""></textarea>
                        <div class="submit">
                            <?php if (is_user_logged_in()) {
                                ?>
                                <?php printf(__('Logado como <a href="%s/wp-admin/profile.php">%s</a>.', 'vizer'), get_option('siteurl'), $user_identity); ?>
                                <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('sair desta conta', 'vizer'); ?>"><?php _e('sair', 'vizer'); ?></a>
                            <?php } ?>
                            <button>To send</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php if (!is_user_logged_in()) : ?>
                <?php endif; ?>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID); ?>
            </form>
        <?php endif; ?>
    <?php endif; ?>
    <?php
    if (post_password_required()) {
        return;
    }

    if (have_comments()) :
        ?>
        <?php wp_list_comments(array('walker' => new Basey_Walker_Comment)); ?>
        <?php
        if (get_comment_pages_count() > 1 && get_option('page_comments'))
            basey_pagination('comments');
        ?>

    <?php endif; ?>
</div>
<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="clearfix"></div>

    <div class="row wrapi">
        <div class="load_comments">
            Comments are closed For this post
        </div>
    </div>

<?php endif; ?>