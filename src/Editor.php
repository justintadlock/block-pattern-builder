<?php
/**
 * Editor Class.
 *
 * Handles block editor functionality.
 *
 * @package   BlockPatternBuilder
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2020, Justin Tadlock
 * @link      https://github.com/justintadlock/block-pattern-builder
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace BlockPatternBuilder;

/**
 * Editor component class.
 *
 * @since  1.1.0
 * @access public
 */
class Editor {

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue'] );
	}

	/**
	 * Enqueues the editor assets.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {

		wp_enqueue_script(
			'block-pattern-builder',
			plugin()->asset( 'js/editor.js' ),
			[
				'wp-api',
                                'wp-i18n',
                                'wp-blocks',
                                'wp-components',
                                'wp-data',
                                'wp-core-data',
                                'wp-edit-post',
                                'wp-element',
                                'wp-plugins'
			],
			null,
			true
		);

		wp_localize_script(
			'block-pattern-builder',
			'blockPatternBuilder',
			$this->jsonData()
		);
	}

	/**
	 * Returns an array of the data that is passed to the script via JSON.
	 *
	 * @since  1.1.0
	 * @access private
	 * @return array
	 */
	private function jsonData() {

		$labels = [
			'createSuccessNotice' => __( 'Block Pattern created.', 'block-pattern-builder' ),
                        'menuItem'            => __( 'Add to Block Patterns',  'block-pattern-builder' ),
                        'modalTitle'          => __( 'New Pattern',            'block-pattern-builder' ),
                        'modalTextControl'    => __( 'Pattern Title',          'block-pattern-builder' ),
                        'modalButton'         => __( 'Save',                   'block-pattern-builder' )
		];

		$data = [
                        'labels' => $labels
                ];

		return $data;
	}
}
