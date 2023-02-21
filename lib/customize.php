<?php
/**
 * Oasis Pro.
 *
 * This file adds the Customizer additions to the Oasis Pro Theme.
 *
 * @package oasis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/oasis/
 */

add_action( 'customize_register', 'oasis_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function oasis_customizer_register( $wp_customize ) {

	$wp_customize->add_section(
		'oasis_theme_options',
		[
			'description' => __( 'Personalize the Oasis Pro theme with these available options.', 'oasis-pro' ),
			'title'       => __( 'Oasis Pro Settings', 'oasis-pro' ),
			'priority'    => 30,
		]
	);

	// Adds setting for link color.
	$wp_customize->add_setting(
		'oasis_link_color',
		[
			'default'           => oasis_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	// Adds control for link color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'oasis_link_color',
			[
				'description' => __( 'Change the default color for hovers for linked titles, menu links, entry meta links, and more.', 'oasis-pro' ),
				'label'       => __( 'Link Color', 'oasis-pro' ),
				'section'     => 'colors',
				'settings'    => 'oasis_link_color',
			]
		)
	);

	// Adds setting for accent color.
	$wp_customize->add_setting(
		'oasis_accent_color',
		[
			'default'           => oasis_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	// Adds control for accent color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'oasis_accent_color',
			[
				'description' => __( 'Change the color used for block-based buttons and the hover color for other buttons.', 'oasis-pro' ),
				'label'       => __( 'Accent Color', 'oasis-pro' ),
				'section'     => 'colors',
				'settings'    => 'oasis_accent_color',
			]
		)
	);

	// Adds setting for footer start color.
	$wp_customize->add_setting(
		'oasis_footer_start_color',
		[
			'default'           => oasis_customizer_get_default_footer_start_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	// Adds control for footer start color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'oasis_footer_start_color',
			[
				'description' => __( 'Change the default color for start of footer gradient.', 'oasis-pro' ),
				'label'       => __( 'Footer Start Color', 'oasis-pro' ),
				'section'     => 'colors',
				'settings'    => 'oasis_footer_start_color',
			]
		)
	);

	// Adds setting for footer end color.
	$wp_customize->add_setting(
		'oasis_footer_end_color',
		[
			'default'           => oasis_customizer_get_default_footer_end_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	// Adds control for footer end color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'oasis_footer_end_color',
			[
				'description' => __( 'Change the default color for end of footer gradient.', 'oasis-pro' ),
				'label'       => __( 'Footer End Color', 'oasis-pro' ),
				'section'     => 'colors',
				'settings'    => 'oasis_footer_end_color',
			]
		)
	);

	// Adds control for search option.
	$wp_customize->add_setting(
		'oasis_header_search',
		[
			'default'           => oasis_customizer_get_default_search_setting(),
			'sanitize_callback' => 'absint',
		]
	);

	// Adds setting for search option.
	$wp_customize->add_control(
		'oasis_header_search',
		[
			'label'       => __( 'Show Menu Search Icon?', 'oasis-pro' ),
			'description' => __( 'Check the box to show a search icon in the menu.', 'oasis-pro' ),
			'section'     => 'oasis_theme_options',
			'type'        => 'checkbox',
			'settings'    => 'oasis_header_search',
		]
	);

	// Adds control for the styled paragraph.
	$wp_customize->add_setting(
		'oasis_intro_paragraph_styling',
		[
			'default'           => 1,
			'sanitize_callback' => 'absint',
		]
	);

	$wp_customize->add_control(
		'oasis_intro_paragraph_styling',
		[
			'label'       => __( 'Enable the "intro" paragraph style on single posts?', 'oasis-pro' ),
			'description' => __( 'Check the box to automatically apply the "intro" font size and style to the first paragraph of all single posts.', 'oasis-pro' ),
			'section'     => 'oasis_theme_options',
			'settings'    => 'oasis_intro_paragraph_styling',
			'type'        => 'checkbox',
		]
	);

	// Adds control for the footer logo upload.
	$wp_customize->add_setting(
		'oasis-footer-logo',
		[
			'default'           => oasis_get_default_footer_logo(),
			'sanitize_callback' => 'esc_attr',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'oasis-footer-logo',
			[
				'description' => __( 'Select an image to display above the footer credits.', 'oasis-pro' ),
				'label'       => __( 'Footer Logo', 'oasis-pro' ),
				'section'     => 'title_tagline',
				'settings'    => 'oasis-footer-logo',
			]
		)
	);

}
