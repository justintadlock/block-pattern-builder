<?php
/**
 * Register scripts.
 *
 * @package    BlockPatternBuilder
 * @author     Hardeep Asrani <hardeeoasrani@gmail.com>
 * @copyright  Copyright (c) 2020, Hardeep Asrani
 * @link       https://github.com/justintadlock/block-pattern-builder
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace BlockPatternBuilder;

# Don't execute code if file is file is accessed directly.
defined( 'ABSPATH' ) || exit;

# Register scripts on the 'enqueue_block_editor_assets' hook.
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\enqueue_editor_assets' );

/**
 * Adds scripts to block-editor screen.
 *
 * @since  1.0.1
 * @access public
 * @param  array  $messages
 * @param  array  $counts
 * @return array
 */
function enqueue_editor_assets() {
	if ( BPB_DEBUG ) {
		$version = time();
	} else {
		$version = BPB_VERSION;
	}

	wp_enqueue_script(
		'bpb_pattern_scripts',
		BPB_ABSURL . 'build/index.js',
		array( 'wp-api', 'wp-i18n', 'wp-blocks', 'wp-components', 'wp-data', 'wp-edit-post', 'wp-element', 'wp-plugins' ),
		$version,
		true
	);
}
