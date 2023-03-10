<?php
/**
 * Gutenberg theme support.
 *
 * @package Oasis 
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_action( 'wp_enqueue_scripts', 'oasis_pro_enqueue_gutenberg_frontend_styles' );
/**
 * Enqueues Gutenberg front-end styles.
 *
 * @since 2.7.0
 */
function oasis_pro_enqueue_gutenberg_frontend_styles() {

	wp_enqueue_style(
		genesis_get_theme_handle() . '-gutenberg',
		get_stylesheet_directory_uri() . '/lib/gutenberg/front-end.css',
		[ genesis_get_theme_handle() ],
		genesis_get_theme_version()
	);

}

add_action( 'enqueue_block_editor_assets', 'oasis_pro_block_editor_styles' );
/**
 * Enqueues Gutenberg admin editor fonts and styles.
 *
 * @since 2.7.0
 */
function oasis_pro_block_editor_styles() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	wp_enqueue_style(
		genesis_get_theme_version()
	);

}

// Adds support for editor styles.
add_theme_support( 'editor-styles' );

// Enqueues editor styles.
add_editor_style( '/lib/gutenberg/style-editor.css' );

// Adds support for block alignments.
add_theme_support( 'align-wide' );

// Add support for custom line heights.
add_theme_support( 'custom-line-height' );

// Add support for custom units.
add_theme_support( 'custom-units' );

// Makes media embeds responsive.
add_theme_support( 'responsive-embeds' );

$oasis_block_editor_settings = genesis_get_config( 'block-editor-settings' );






add_action( 'after_setup_theme', 'oasis_pro_content_width', 0 );
/**
 * Sets content width to match the “wide” Gutenberg block width.
 */
function oasis_pro_content_width() {

	$block_editor_settings = genesis_get_config( 'block-editor-settings' );

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- See https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/924
	$GLOBALS['content_width'] = apply_filters( 'oasis_pro_content_width', $block_editor_settings['content-width'] );

}
