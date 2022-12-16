<?php

/**
 * Register custom post taxonomy.
 *
 * @package    BlockPatternBuilder
 * @author     Ajit Bohra <ajit@lubus.in>
 * @copyright  Copyright (c) 2020, Justin Tadlock
 * @link       https://github.com/justintadlock/block-pattern-builder
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace BlockPatternBuilder;

# Don't execute code if file is file is accessed directly.
defined('ABSPATH') || exit;

# Register custom taxonomy on the 'init' hook.
add_action('init', __NAMESPACE__ . '\\register_taxonomies');

/**
 * Registers taxonomy needed by the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function register_taxonomies()
{
	$labels = [
		'name'                       => _x('Categories', 'Taxonomy General Name', 'block-pattern-builder'),
		'singular_name'              => _x('Category', 'Taxonomy Singular Name', 'block-pattern-builder'),
		'menu_name'                  => __('Category', 'block-pattern-builder'),
		'all_items'                  => __('All Categories', 'block-pattern-builder'),
		'parent_item'                => __('Parent Category', 'block-pattern-builder'),
		'parent_item_colon'          => __('Parent category:', 'block-pattern-builder'),
		'new_item_name'              => __('New Category Name', 'block-pattern-builder'),
		'add_new_item'               => __('Add New Category', 'block-pattern-builder'),
		'edit_item'                  => __('Edit Category', 'block-pattern-builder'),
		'update_item'                => __('Update Category', 'block-pattern-builder'),
		'view_item'                  => __('View Category', 'block-pattern-builder'),
		'separate_items_with_commas' => __('Separate categories with commas', 'block-pattern-builder'),
		'add_or_remove_items'        => __('Add or remove categories', 'block-pattern-builder'),
		'choose_from_most_used'      => __('Choose from the most used', 'block-pattern-builder'),
		'popular_items'              => __('Popular Categories', 'block-pattern-builder'),
		'search_items'               => __('Search Categories', 'block-pattern-builder'),
		'not_found'                  => __('Not Found', 'block-pattern-builder'),
		'no_terms'                   => __('No categories', 'block-pattern-builder'),
		'items_list'                 => __('Categories list', 'block-pattern-builder'),
		'items_list_navigation'      => __('Categories list navigation', 'block-pattern-builder'),
	];

	$capabilities = [
		'manage_terms'               => 'bpb_manage_categories',
		'edit_terms'                 => 'bpb_manage_categories',
		'delete_terms'               => 'bpb_manage_categories',
		'assign_terms'               => 'bpb_edit_patterns',
	];

	$args = [
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'capabilities'               => $capabilities,
		'show_in_rest'               => true,
	];
	register_taxonomy('bpb_pattern_category', 'bpb_pattern', $args);
}
