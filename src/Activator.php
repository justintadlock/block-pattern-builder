<?php
/**
 * Plugin Activator.
 *
 * Runs the plugin activation routine.
 *
 * @package    BlockPatternBuilder
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  Copyright (c) 2020, Justin Tadlock
 * @link       https://github.com/justintadlock/block-pattern-builder
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace BlockPatternBuilder;

/**
 * Activator class.
 *
 * @since  1.0.0
 * @access public
 */
class Activator {

	/**
	 * Runs necessary code when first activating the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function activate() {

		// Get the administrator role.
		$role = get_role( 'administrator' );

		// If the administrator role exists, add required capabilities
		// for the plugin.
		if ( ! empty( $role ) ) {
			$role->add_cap( 'bpb_create_patterns'           );
			$role->add_cap( 'bpb_publish_patterns'          );
			$role->add_cap( 'bpb_read_private_patterns'     );
			$role->add_cap( 'bpb_edit_patterns'             );
			$role->add_cap( 'bpb_edit_others_patterns'      );
			$role->add_cap( 'bpb_edit_private_patterns'     );
			$role->add_cap( 'bpb_edit_published_patterns'   );
			$role->add_cap( 'bpb_delete_patterns'           );
			$role->add_cap( 'bpb_delete_private_patterns'   );
			$role->add_cap( 'bpb_delete_published_patterns' );
			$role->add_cap( 'bpb_delete_others_patterns'    );
		}
	}
}
