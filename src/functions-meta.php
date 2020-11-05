<?php

/**
 * Register pattern meta.
 *
 * @package    BlockPatternBuilder
 * @author     Ajit Bohra <ajit@lubus.in>
 * @copyright  Copyright (c) 2020, Justin Tadlock
 * @link       https://github.com/justintadlock/block-pattern-builder
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace BlockPatternBuilder;

# Don't execute code if file is accessed directly.
defined('ABSPATH') || exit;

# Register custom meta on the 'init' hook.
add_action('init', __NAMESPACE__ . '\\register_pattern_meta');

/**
 * Registers meta needed by the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function register_pattern_meta() {
	register_post_meta('bpb_pattern', 'bpb_viewport_width', [
		'show_in_rest' => [
			'schema' => [
				'type'    => 'integer',
				'default' => 800,
			],
		],
		'single'       => true,
	]);

	register_post_meta('bpb_pattern', 'bpb_keywords', [
		'show_in_rest' => [
			'schema' => [
				'type'    => 'array',
				'default' => [],
			],
		],
		'single'       => true,
	]);
}
