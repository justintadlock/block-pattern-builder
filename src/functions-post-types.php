<?php
/**
 * Register custom post types.
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

# Register custom post types on the 'init' hook.
add_action( 'init', __NAMESPACE__ . '\\register_post_types' );

# Filter the "enter title here" text.
add_filter( 'enter_title_here', __NAMESPACE__ . '\\enter_title_here', 10, 2 );

# Filter the bulk and post updated messages.
add_filter( 'bulk_post_updated_messages', __NAMESPACE__ . '\\bulk_post_updated_messages', 5, 2 );
add_filter( 'post_updated_messages',      __NAMESPACE__ . '\\post_updated_messages',      5    );

/**
 * Registers post types needed by the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function register_post_types() {

	$pattern_args = [
		'public'              => false,
		'publicly_queryable'  => false,
		'show_in_rest'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-screenoptions',
		'can_export'          => true,
		'delete_with_user'    => false,
		'hierarchical'        => false,
		'has_archive'         => false,
		'capability_type'     => 'bpb_pattern',
		'map_meta_cap'        => true,

		'capabilities'        => [
			// meta caps (don't assign these to roles)
			'edit_post'              => 'bpb_edit_pattern',
			'read_post'              => 'bpb_read_pattern',
			'delete_post'            => 'bpb_delete_pattern',

			// primitive/meta caps
			'create_posts'           => 'bpb_create_patterns',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'bpb_edit_patterns',
			'edit_others_posts'      => 'bpb_edit_others_patterns',
			'publish_posts'          => 'bpb_publish_patterns',
			'read_private_posts'     => 'bpb_read_private_patterns',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'bpb_delete_patterns',
			'delete_private_posts'   => 'bpb_delete_private_patterns',
			'delete_published_posts' => 'bpb_delete_published_patterns',
			'delete_others_posts'    => 'bpb_delete_others_patterns',
			'edit_private_posts'     => 'bpb_edit_private_patterns',
			'edit_published_posts'   => 'bpb_edit_published_patterns'
		],

		'labels'              => [
			'name'                     => __( 'Patterns',                   'block-pattern-builder' ),
			'singular_name'            => __( 'Pattern',                    'block-pattern-builder' ),
			'menu_name'                => __( 'Block Patterns',             'block-pattern-builder' ),
			'name_admin_bar'           => __( 'Pattern',                    'block-pattern-builder' ),
			'add_new'                  => __( 'New Pattern',                'block-pattern-builder' ),
			'add_new_item'             => __( 'Add New Pattern',            'block-pattern-builder' ),
			'edit_item'                => __( 'Edit Pattern',               'block-pattern-builder' ),
			'new_item'                 => __( 'New Pattern',                'block-pattern-builder' ),
			'view_item'                => __( 'View Pattern',               'block-pattern-builder' ),
			'view_items'               => __( 'View Patterns',              'block-pattern-builder' ),
			'search_items'             => __( 'Search Patterns',            'block-pattern-builder' ),
			'not_found'                => __( 'No patterns found',          'block-pattern-builder' ),
			'not_found_in_trash'       => __( 'No patterns found in trash', 'block-pattern-builder' ),
			'all_items'                => __( 'Patterns',                   'block-pattern-builder' ),
			'featured_image'           => __( 'Pattern Image',              'block-pattern-builder' ),
			'set_featured_image'       => __( 'Set pattern image',          'block-pattern-builder' ),
			'remove_featured_image'    => __( 'Remove pattern image',       'block-pattern-builder' ),
			'use_featured_image'       => __( 'Use as pattern image',       'block-pattern-builder' ),
			'insert_into_item'         => __( 'Insert into pattern',        'block-pattern-builder' ),
			'uploaded_to_this_item'    => __( 'Uploaded to this pattern',   'block-pattern-builder' ),
			'filter_items_list'        => __( 'Filter patterns list',       'block-pattern-builder' ),
			'items_list_navigation'    => __( 'Patterns list navigation',   'block-pattern-builder' ),
			'items_list'               => __( 'Patterns list',              'block-pattern-builder' ),
			'item_published'           => __( 'Pattern published.',            'block-pattern-builder' ),
			'item_published_privately' => __( 'Pattern published privately.',  'block-pattern-builder' ),
			'item_reverted_to_draft'   => __( 'Pattern reverted to draft.',    'block-pattern-builder' ),
			'item_scheduled'           => __( 'Pattern scheduled.',            'block-pattern-builder' ),
			'item_updated'             => __( 'Pattern updated.',              'block-pattern-builder' ),
		],

		// The rewrite handles the URL structure.
		'rewrite' => false,

		// What features the post type supports.
		'supports' => [
			'title',
			'editor',
			'excerpt',
			'custom-fields'
		]
	];

	// Register the post type.
	register_post_type( 'bpb_pattern', $pattern_args );
}

/**
 * Custom "enter title here" text.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $title
 * @param  object  $post
 * @return string
 */
function enter_title_here( $title, $post ) {

	return 'bpb_pattern' === $post->post_type
	       ? esc_html__( 'Enter pattern name', 'block-pattern-builder' )
	       : $title;
}

/**
 * Adds custom post updated messages on the edit post screen.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $messages
 * @global object $post
 * @global int    $post_ID
 * @return array
 */
function post_updated_messages( $messages ) {
	global $post, $post_ID;

	$pattern_type = 'bpb_pattern';

	if ( $pattern_type !== $post->post_type ) {
		return $messages;
	}

	// Get permalink and preview URLs.
	$permalink   = get_permalink( $post_ID );
	$preview_url = get_preview_post_link( $post );

	// Translators: Scheduled pattern date format. See http://php.net/date
	$scheduled_date = date_i18n( __( 'M j, Y @ H:i', 'block-pattern-builder' ), strtotime( $post->post_date ) );

	// Set up view links.
	$preview_link   = sprintf( ' <a target="_blank" href="%1$s">%2$s</a>', esc_url( $preview_url ), esc_html__( 'Preview pattern', 'block-pattern-builder' ) );
	$scheduled_link = sprintf( ' <a target="_blank" href="%1$s">%2$s</a>', esc_url( $permalink ),   esc_html__( 'Preview pattern', 'block-pattern-builder' ) );
	$view_link      = sprintf( ' <a href="%1$s">%2$s</a>',                 esc_url( $permalink ),   esc_html__( 'View pattern',    'block-pattern-builder' ) );

	// Post updated messages.
	$messages[ $pattern_type ] = [
		 1 => esc_html__( 'Pattern updated.', 'block-pattern-builder' ) . $view_link,
		 4 => esc_html__( 'Pattern updated.', 'block-pattern-builder' ),
		 // Translators: %s is the date and time of the revision.
		 5 => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Pattern restored to revision from %s.', 'block-pattern-builder' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		 6 => esc_html__( 'Pattern published.', 'block-pattern-builder' ) . $view_link,
		 7 => esc_html__( 'Pattern saved.', 'block-pattern-builder' ),
		 8 => esc_html__( 'Pattern submitted.', 'block-pattern-builder' ) . $preview_link,
		 9 => sprintf( esc_html__( 'Pattern scheduled for: %s.', 'block-pattern-builder' ), "<strong>{$scheduled_date}</strong>" ) . $scheduled_link,
		10 => esc_html__( 'Pattern draft updated.', 'block-pattern-builder' ) . $preview_link,
	];

	return $messages;
}

/**
 * Adds custom bulk post updated messages on the manage patterns screen.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $messages
 * @param  array  $counts
 * @return array
 */
function bulk_post_updated_messages( $messages, $counts ) {

	$type = 'bpb_pattern';

	$messages[ $type ]['updated']   = _n( '%s pattern updated.',                             '%s patterns updated.',                               $counts['updated'],   'block-pattern-builder' );
	$messages[ $type ]['locked']    = _n( '%s pattern not updated, somebody is editing it.', '%s patterns not updated, somebody is editing them.', $counts['locked'],    'block-pattern-builder' );
	$messages[ $type ]['deleted']   = _n( '%s pattern permanently deleted.',                 '%s patterns permanently deleted.',                   $counts['deleted'],   'block-pattern-builder' );
	$messages[ $type ]['trashed']   = _n( '%s pattern moved to the Trash.',                  '%s patterns moved to the trash.',                    $counts['trashed'],   'block-pattern-builder' );
	$messages[ $type ]['untrashed'] = _n( '%s pattern restored from the Trash.',             '%s patterns restored from the trash.',               $counts['untrashed'], 'block-pattern-builder' );

	return $messages;
}
