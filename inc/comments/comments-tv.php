<?php
/**
 * Use Bootstrap's media object for listing comments
 *
 * @link http://getbootstrap.com/components/#media
 */
class tv_Walker_Comment extends Walker_Comment {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>
		<?php
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$GLOBALS['comment_depth'] = $depth + 1;
	}

	function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;

		if (!empty($args['callback'])) {
			call_user_func($args['callback'], $comment, $args, $depth);
			return;
		}

		extract($args, EXTR_SKIP); ?>
		<?php include(locate_template('parts/comment-tv.php')); ?>
		<?php
	}

	function end_el(&$output, $comment, $depth = 0, $args = array()) {
		if (!empty($args['end-callback'])) {
			call_user_func($args['end-callback'], $comment, $args, $depth);
			return;
		}
	}
}