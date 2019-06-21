<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function wp_menus_block_cgb_block_assets() { // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style(
		'wp_menus_block-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-editor' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor script for backend.
	wp_register_script(
		'wp_menus_block-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'wp_menus_block-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'cgb/block-wp-menus-block', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'wp_menus_block-cgb-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'wp_menus_block-cgb-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'wp_menus_block-cgb-block-editor-css',
			'render_callback' => 'render_menu_select',
		)
	);
}

function render_menu_select($attributes) {
	$class = 'wp-menu-select';

	if (isset($attributes['className'])) {
		$class .= " {$attributes['className']}";
	}

	$dropdown_id = esc_attr(uniqid('wp-block-menu-select-'));
	$title = __('Menu Selection');

	$menus = get_terms('nav_menu', array('hide_empty' => true, 'fields' => 'id=>name'));
	$label = esc_attr(__('select menu...'));

	$block_content = '<label class="screen-reader-text" for="' . $dropdown_id . '">' . $title . '</label>
	<select id="' . $dropdown_id . '" name="menu-select">
	<option>' . $label . '</option>';
	foreach($menus as $id => $name) {
		$block_content .= '<option value=' . $id .'>' . $name . '</option>';
	}
	$block_content .= '</select>';

	$block_content = sprintf(
		'<div class="%1$s">%2$s</div>',
		esc_attr($class),
		$block_content
	);

	return $block_content;
}

// Hook: Block assets.
add_action( 'init', 'wp_menus_block_cgb_block_assets' );
