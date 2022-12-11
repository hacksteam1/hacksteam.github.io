<?php

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
 */
class rc_scm_walker_footer extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $prepend = '<div class="button open-contact"><span>';
        $append = '</span></div>';


        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' rel="nofollow">';
        $item_output .= $args->link_before . $prepend . apply_filters('the_title', $item->title, $item->ID) . $append;
        $item_output .= ' ' . $item->subtitle . '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}
