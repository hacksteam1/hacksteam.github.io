<div class="line notme">
    <div class="image">
        <?php echo get_avatar($comment, $size = '50'); ?>
    </div>
    <div class="user"><?php echo get_comment_author_link(); ?></div>
    <div class="message"><?php comment_text(); ?></div>
</div>