<?php
/**
 * Oasis  Theme
 *
 * This file adds the landing page template to the Oasis  Theme.
 *
 * Template Name: Landing
 *
 * @package Oasis  Theme
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link
 */

add_filter( 'body_class', 'oasis_landing_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function oasis_landing_body_class( $classes ) {

	$classes[] = 'landing-page';
	return $classes;

}

// Removes Skip Links.
remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );

add_action( 'wp_enqueue_scripts', 'oasis_dequeue_skip_links' );
/**
 * Dequeues Skip Links Script.
 *
 * @since 1.1.0
 */
function oasis_dequeue_skip_links() {

	wp_dequeue_script( 'skip-links' );

}

// Removes site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Removes navigation.
remove_theme_support( 'genesis-menus' );

// Removes before footer CTA widget area.
remove_action( 'genesis_before_footer', 'oasis_before_footer_cta' );

// Removes site footer elements.
remove_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_after', 'oasis_before_footer', 8 );
remove_action( 'genesis_after', 'genesis_do_footer' );
remove_action( 'genesis_after', 'oasis_footer_menu', 12 );
remove_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

// Runs the Genesis loop.
genesis();
