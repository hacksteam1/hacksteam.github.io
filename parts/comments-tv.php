<div id="vipchat">
    <div class="chatbox" style="padding:0px;">
        <div class="chat-message-list">
            <?php
            if (post_password_required()) {
                return;
            }

            if (have_comments()) :
                ?>
                <?php wp_list_comments(array('walker' => new tv_Walker_Comment)); ?>
                <?php
                if (get_comment_pages_count() > 1 && get_option('page_comments'))
                    basey_pagination('comments');
                ?>

            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
            <div class="logintochat">
                Comments are closed For this post
            </div>
        <?php endif; ?>
        <?php if (comments_open()) : ?>
            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <div class="logintochat">
                    Do it <b class="open-login" style="cursor:pointer;">Log In</b> to comment
                </div>
            <?php else : ?>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" data-parsley-validate>
                    <?php if (is_user_logged_in()) : ?>
                    <?php else : ?>
                    <?php endif; ?>
                    <div class="new-message">
                        <input type="text" name="comment" placeholder="Your comment..." required="">
                        <div class="submit"><button class="new-msg-btn hover">To send</button></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <?php if (!is_user_logged_in()) : ?>
                    <?php endif; ?>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>