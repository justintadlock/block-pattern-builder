<?php
/**
 * Register block patterns.
 *
 * @package    BlockPatternBuilder
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  Copyright (c) 2020, Justin Tadlock
 * @link       https://github.com/justintadlock/block-pattern-builder
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace BlockPatternBuilder;

use WP_Query;

# Don't execute code if file is accessed directly.
defined( 'ABSPATH' ) || exit;

// For now, we're just going to load these up on the post editing screen so that
// we're not running a query on every page of the site. In the future, we should
// implement some caching for the patterns. There may be a more suitable hook
// to only load when the block editor is present.
add_action( 'load-post.php',     __NAMESPACE__ . '\\register_patterns' );
add_action( 'load-post-new.php', __NAMESPACE__ . '\\register_patterns' );

/**
 * Registers block patterns.
 *
 * @access public
 * @since  1.0.0
 * @return void
 */
function register_patterns() {

	$register = false;

	// Assign pattern registration function for Gutenberg 8.1.0+.
	if ( function_exists( 'register_block_pattern' ) ) {
		$register = 'register_block_pattern';

	// Old registration function pre-8.1.0.
	} elseif ( function_exists( 'register_pattern' ) ) {
		$register = 'register_pattern';
	}

	// Bail if Block Patterns API doesn't exist.
	if ( ! $register ) {
		return;
	}

	// Query all published patterns.
	$patterns = new WP_Query( [
		'post_type'    => 'bpb_pattern',
		'number_posts' => -1
	] );

	if ( $patterns->have_posts() ) {

		while ( $patterns->have_posts() ) {
			$patterns->the_post();
			global $post;

			$register(
				sprintf( 'bpb/%s', sanitize_key( $post->post_name ) ),
				[
					'title'         => wp_strip_all_tags( $post->post_title ),
					'content'       => $post->post_content,
					'description'   => $post->post_excerpt,
					'viewportWidth' => $post->bpb_viewport_width,
					'keywords'      => $post->bpb_keywords,
				]
			);
		}
	}

	wp_reset_postdata();
}
