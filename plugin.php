<?php
/**
 * Plugin Name:       Block Pattern Builder
 * Plugin URI:        https://github.com/justintadlock/block-pattern-builder
 * Description:       Allows users to create custom block patterns from the WordPress admin. Requires version 7.8+ of the Gutenberg plugin.
 * Version:           1.0.0-beta-1
 * Requires at least: 5.0
 * Requires PHP:      5.6
 * Author:            Justin Tadlock
 * Author URI:        https://justintadlock.com
 * Text Domain:       block-pattern-builder
 * Domain Path:       /public/lang
 *
 * @package    BlockPatternBuilder
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  Copyright (c) 2020, Justin Tadlock
 * @link       https://github.com/justintadlock/block-pattern-builder
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace BlockPatternBuilder;

# Don't execute code if file is file is accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Registers the plugin activation callback.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
register_activation_hook( __FILE__, function() {
	require_once 'src/Activator.php';
	Activator::activate();
} );

# Bootstrap plugin.
require_once 'src/functions-post-types.php';
require_once 'src/functions-patterns.php';
