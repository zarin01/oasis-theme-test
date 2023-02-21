<?php
/**
 * Oasis Pro.
 *
 * This file adds the default theme settings to the Oasis Pro Theme.
 *
 * @package oasis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/oasis/
 */

add_filter( 'simple_social_default_styles', 'oasis_social_default_styles' );
/**
 * Updates Simple Social Icon settings on activation.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default social icon settings.
 * @return array Modified social styles.
 */
function oasis_social_default_styles( $defaults ) {

	$args = genesis_get_config( 'simple-social-icons-settings' );

	return wp_parse_args( $args, $defaults );

}
