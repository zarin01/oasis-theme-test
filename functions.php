<?php
/**
 * Oasis  Theme
 *
 * This file adds functions to the Oasis  Theme.
 *
 * @package Oasis  Theme
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link  
 */
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );

//* We tell the name of our child theme
define( 'Child_Theme_Name', __( 'Genesis Child', 'genesischild' ) );
//* We tell the web address of our child theme (More info & demo)
define( 'Child_Theme_Url', 'http://gsquaredstudios.com' );
//* We tell the version of our child theme
define( 'Child_Theme_Version', '1.0' );

//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );

//* Add HTML5 responsive recognition
add_theme_support( 'genesis-responsive-viewport' );

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Setup Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'oasis_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function oasis_localization_setup() {

	load_child_theme_textdomain( 'oasis-pro', get_stylesheet_directory() . '/languages' );

}

// Adds the theme helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds Image upload and Color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Includes the Customizer CSS for the WooCommerce plugin.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Includes notice to install Genesis Connect for WooCommerce.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'oasis_theme_support', 1 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 1.3.0
 */
function oasis_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * Allows plugins to Removes support if required.
 *
 * @since 1.1.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'oasis_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function oasis_enqueue_scripts_styles() {

	wp_enqueue_style( 'oasis-fonts', '//fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i|Open+Sans+Condensed:300', [], genesis_get_theme_version() );
	wp_enqueue_style( 'oasis-ionicons', '//unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css', [], genesis_get_theme_version() );

	wp_enqueue_script( 'oasis-global-script', get_stylesheet_directory_uri() . '/js/global.js', [ 'jquery' ], '1.0.0', true );
	wp_enqueue_script( 'oasis-block-effects', get_stylesheet_directory_uri() . '/js/block-effects.js', [], '1.0.0', true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'oasis-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', [ 'jquery' ], genesis_get_theme_version(), true );
	wp_localize_script( 'oasis-responsive-menu', 'genesis_responsive_menu', oasis_responsive_menu_settings() );

}

/**
 * Defines responsive menu settings.
 *
 * @since 1.1.0
 */
function oasis_responsive_menu_settings() {

	$settings = [
		'mainMenu'         => __( 'Menu', 'oasis-pro' ),
		'menuIconClass'    => 'ionicons-before ion-ios-menu',
		'subMenu'          => __( 'Submenu', 'oasis-pro' ),
		'subMenuIconClass' => 'ionicons-before ion-ios-arrow-down',
		'menuClasses'      => [
			'combine' => [],
			'others'  => [
				'.nav-primary',
			],
		],
	];

	return $settings;

}

// Adds image sizes.
add_image_size( 'featured-blog', 600, 338, true );
add_image_size( 'sidebar-thumbnail', 80, 80, true );

add_filter( 'image_size_names_choose', 'oasis_media_library_sizes' );
/**
 * Adds featured-blog image size to Media Library.
 *
 * @since 1.0.0
 *
 * @param array $sizes Array of image sizes and their names.
 * @return array The modified list of sizes.
 */
function oasis_media_library_sizes( $sizes ) {

	$sizes['featured-blog'] = __( 'Featured Blog - 600px by 338px', 'oasis-pro' );

	return $sizes;

}

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after', 'genesis_do_subnav', 12 );

add_action( 'genesis_meta', 'oasis_add_search_icon' );
/**
 * Adds the search icon to the header if the option is set in the Customizer.
 *
 * @since 1.0.0
 */
function oasis_add_search_icon() {

	$show_icon = get_theme_mod( 'oasis_header_search', oasis_customizer_get_default_search_setting() );

	// Exit early if option set to false.
	if ( ! $show_icon ) {
		return;
	}

	add_action( 'genesis_header', 'oasis_do_header_search_form', 14 );
	add_filter( 'genesis_nav_items', 'oasis_add_search_menu_item', 10, 2 );
	add_filter( 'wp_nav_menu_items', 'oasis_add_search_menu_item', 10, 2 );

}

/**
 * Modifies the menu item output of the header menu.
 *
 * @since 1.0.0
 *
 * @param string $items The menu HTML.
 * @param array  $args The menu options.
 * @return string Updated menu HTML.
 */
function oasis_add_search_menu_item( $items, $args ) {

	$search_toggle = sprintf( '<li class="menu-item">%s</li>', oasis_get_header_search_toggle() );

	if ( 'primary' === $args->theme_location ) {
		$items .= $search_toggle;
	}

	return $items;

}

add_filter( 'wp_nav_menu_args', 'oasis_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 1.0.0
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function oasis_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'oasis_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function oasis_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'oasis_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function oasis_comments_gravatar( $args ) {

	$args['avatar_size'] = 48;
	return $args;

}

add_filter( 'get_the_content_limit', 'oasis_content_limit_read_more_markup', 10, 3 );
/**
 * Modifies the generic more link markup for posts.
 *
 * @since 1.0.0
 *
 * @param string $output The current full HTML.
 * @param string $content The content HTML.
 * @param string $link The link HTML.
 * @return string The new more link HTML.
 */
function oasis_content_limit_read_more_markup( $output, $content, $link ) {

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;

}

// Removes entry meta in entry footer.
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_action( 'genesis_before_footer', 'oasis_before_footer_cta' );
/**
 * Hooks in before footer CTA widget area.
 *
 * @since 1.0.0
 */
function oasis_before_footer_cta() {

	genesis_widget_area(
		'before-footer-cta',
		[
			'before' => '<div class="before-footer-cta"><div class="wrap">',
			'after'  => '</div></div>',
		]
	);

}

// Removes site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Adds site footer.
add_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
add_action( 'genesis_after', 'genesis_do_footer' );
add_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

add_action( 'genesis_after', 'oasis_custom_footer_logo', 7 );
/**
 * Outputs the footer logo above the footer credits.
 *
 * @since 1.2.0
 */
function oasis_custom_footer_logo() {

	$footer_logo      = get_theme_mod( 'oasis-footer-logo', oasis_get_default_footer_logo() );
	$footer_logo_link = sprintf( '<p><a class="footer-logo-link" href="%1$s"><img class="footer-logo" src="%2$s" alt="%3$s" /></a></p>', trailingslashit( home_url() ), esc_url( $footer_logo ), get_bloginfo( 'name' ) );

	if ( $footer_logo ) {
		echo $footer_logo_link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

}

// Registers widget areas.
genesis_register_sidebar(
	[
		'id'          => 'before-footer-cta',
		'name'        => __( 'Before Footer CTA', 'oasis-pro' ),
		'description' => __( 'This is the before footer CTA section.', 'oasis-pro' ),
	]
);
