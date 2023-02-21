<?php
/**
 * Oasis Pro.
 *
 * This file adds the WooCommerce styles and the custom CSS to the Oasis Pro Theme's custom WooCommerce stylesheet.
 *
 * @package oasis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/oasis/
 */

add_filter( 'woocommerce_enqueue_styles', 'oasis_woocommerce_styles' );
/**
 * Enqueues the theme's custom WooCommerce styles for the WooCommerce plugin.
 *
 * @since 1.1.0
 *
 * @param array $enqueue_styles The WooCommerce styles to enqueue.
 * @return array Styles extended with additional WooCommerce CSS from the theme.
 */
function oasis_woocommerce_styles( $enqueue_styles ) {

	$enqueue_styles['oasis-woocommerce-styles'] = [
		'src'     => get_stylesheet_directory_uri() . '/lib/woocommerce/oasis-woocommerce.css',
		'deps'    => '',
		'version' => genesis_get_theme_version(),
		'media'   => 'screen',
	];

	return $enqueue_styles;

}

add_action( 'wp_enqueue_scripts', 'oasis_woocommerce_css' );
/**
 * Adds the themes's custom CSS to the WooCommerce stylesheet.
 *
 * @since 1.1.0
 */
function oasis_woocommerce_css() {

	// If WooCommerce isn't active, exit early.
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$color_link   = get_theme_mod( 'oasis_link_color', oasis_customizer_get_default_link_color() );
	$color_accent = get_theme_mod( 'oasis_accent_color', oasis_customizer_get_default_accent_color() );

	$woo_css = '';

	$woo_css .= ( oasis_customizer_get_default_link_color() !== $color_link ) ? sprintf(
		'

		.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce ul.products li.product h3:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-breadcrumb a:focus,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce .widget_layered_nav ul li.chosen a::before,
		.woocommerce .widget_layered_nav_filters ul li a::before,
		.woocommerce .widget_rating_filter ul li.chosen a::before,
		.woocommerce .widget_rating_filter ul li.chosen a::before {
			color: %s;
		}

	',
		$color_link
	) : '';

	$woo_css .= ( oasis_customizer_get_default_accent_color() !== $color_accent ) ? sprintf(
		'

		.woocommerce-error::before,
		.woocommerce-info::before,
		.woocommerce-message::before {
			color: %1$s;
		}

		.content .wc-block-grid__product-add-to-cart .wp-block-button__link.add_to_cart_button:focus,
		.content .wc-block-grid__product-add-to-cart .wp-block-button__link.add_to_cart_button:hover,
		.woocommerce a.button:focus,
		.woocommerce a.button:hover,
		.woocommerce a.button.alt:focus,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button:focus,
		.woocommerce button.button:hover,
		.woocommerce button.button.alt:focus,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button:focus,
		.woocommerce input.button:hover,
		.woocommerce input.button.alt:focus,
		.woocommerce input.button.alt:hover,
		.woocommerce input[type="submit"]:focus,
		.woocommerce input[type="submit"]:hover,
		.woocommerce span.onsale,
		.woocommerce #respond input#submit:focus,
		.woocommerce #respond input#submit:hover,
		.woocommerce #respond input#submit.alt:focus,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-range {
			background-color: %1$s;
			color: %2$s;
		}

		ul.woocommerce-error,
		.woocommerce-error,
		.woocommerce-info,
		.woocommerce-message {
			border-top-color: %1$s;
		}

	',
		$color_accent,
		oasis_color_contrast( $color_accent )
	) : '';

	if ( $woo_css ) {
		wp_add_inline_style( 'oasis-woocommerce-styles', $woo_css );
	}

}
