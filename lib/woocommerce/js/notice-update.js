/**
 * This script adds notice dismissal to the Oasis Pro theme.
 *
 * @package oasis\JS
 * @author StudioPress
 * @license GPL-2.0-or-later
 */

jQuery( document ).on( 'click', '.oasis-woocommerce-notice .notice-dismiss', function() {

	jQuery.ajax({
		url: ajaxurl,
		data: {
			action: 'oasis_dismiss_woocommerce_notice'
		}
	});

});
