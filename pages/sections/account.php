<?php
global $current_user, $wp_roles;
get_currentuserinfo();
$user_id = get_current_user_id();
$first_name = get_user_meta($user_id, 'first_name', true);
$last_name = get_user_meta($user_id, 'last_name', true);
$display_name = $current_user->display_name;
$error = array();
if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'update-user') {
    if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
        if ($_POST['pass1'] == $_POST['pass2'])
            wp_update_user(array(
                'ID' => $current_user->ID,
                'user_pass' => esc_attr($_POST['pass1'])
                ));
        else
            $error[] = '<div class="alert error"> <i class="fa fa-lg  fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>';
    }
    if (!empty($_POST['url']))
        wp_update_user(array(
            'ID' => $current_user->ID,
            'user_url' => esc_attr($_POST['url'])
            ));
    if (!empty($_POST['email'])) {
        if (!is_email(esc_attr($_POST['email'])))
            $error[] = __('The Email you entered is not valid.  please try again.', 'mtms');
        elseif (email_exists(esc_attr($_POST['email'])) != $current_user->id)
            $error[] = __('This email is already used by another user.  try a different one.', 'mtms');
        else {
            wp_update_user(array(
                'ID' => $current_user->ID,
                'user_email' => esc_attr($_POST['email'])
                ));
        }
    }
    if (!empty($_POST['first-name']))
        update_user_meta($current_user->ID, 'first_name', esc_attr($_POST['first-name']));
    if (!empty($_POST['last-name']))
        update_user_meta($current_user->ID, 'last_name', esc_attr($_POST['last-name']));
    if (!empty($_POST['display_name']))
        wp_update_user(array(
            'ID' => $current_user->ID,
            'display_name' => esc_attr($_POST['display_name'])
            ));
    update_user_meta($current_user->ID, 'display_name', esc_attr($_POST['display_name']));
    if (!empty($_POST['description']))
        update_user_meta($current_user->ID, 'description', esc_attr($_POST['description']));
    if (count($error) == 0) {
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect(get_permalink() . '?action=edit&updated=true');
        exit;
    }
} get_header();
?>
<div id="account" class="wrapper">
    <div class="clearfix"></div>

    <div class="row mini">
        <!-- PROFILE INFO -->
        <div class="medium-4 columns">
            <div class="inner profile-bar" style="margin-bottom:10px;">
                <div class="userimg">
                    <?php echo get_avatar (get_current_user_id() , 200 ); ?>
                </div>
                <h1><?php echo ucwords($current_user->user_nicename); ?></h1>
                <span><?php the_author_meta('user_email', $current_user->ID); ?></span>
                <span></span>
                <span class="status Online">Online</span>
            </div>

            <div class="inner profile-bar change-pw">
                <h1>Change Password</h1>
                <?php if ($_GET['updated'] == 'true') : ?> 
                    <div class="alert success">
                        <i class="fa fa-lg fa-check-circle-o"></i> Password changed successfully
                    </div>
                <?php endif; ?>
                <form method="post" class="update_profile" action="<?php the_permalink(); ?>?action=edit">
                    <input type="password" id="pass1" name="pass1" placeholder="New password"/>
                    <input type="password" id="pass2" name="pass2"  placeholder="Repeat new password"/>
                    <button name="updateuser" type="submit" id="updateuser">Change Password
                    </button>
                    <?php wp_nonce_field('update-user_' . $current_user->ID) ?>
                    <input name="action" type="hidden" id="action" value="update-user" />
                </form>
            </div>
        </div>
        <!-- PROFILE INFO -->

        <!-- IMAGE CHOOSER -->
        <div class="medium-8 columns">
            <!-- PROFILE CONTENT -->
            <div class="inner profile-content">

                <div class="large-12 columns">
                    <div class="large-12 columns" style="padding:0px;">
                        <div class="title" style="background-color:#79D2B0;">
                            <div class="medium-8 columns"><h1>Come back to watch</h1></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="movies-carousel movies-list owl-carousel owl-theme owl-responsive-1000 owl-loaded">

                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 140px;"></div>
                            <?php
                            if (is_user_logged_in()) {
                                $user_id = get_current_user_id();
                                $types = get_post_types(array('public' => true));
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                $args = array(
                                    'paged' => $paged,
                                    'numberposts' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_type' => $types,
                                    'posts_per_page' => '70',
                                    'meta_query' => array(
                                        array(
                                            'key' => '_user_liked',
                                            'value' => $user_id,
                                            'compare' => 'LIKE'
                                            )
                                        ));
                                $sep = '';
                                $list_query = new WP_Query($args);
                                if ($list_query->have_posts()) : while ($list_query->have_posts()) : $list_query->the_post();
                                ?>
                                <?php get_template_part('inc/parts/simple_item'); ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                        <div class="alert notice">You have not added any movies or series yet to watch later.</div>
                        <?php
                        endif;
                        wp_reset_postdata();
                    } else {
                        echo "Not Logged In";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
    </div>
</div>
</div>
</div>
<style>

    .profile-content .movies-list .item{
        width: 140px;
        height: 200px;
    }

    .profile-content .movies-list .item .title{
        font-size: 14px!important;
    }
</style>
<?php get_footer(); ?>