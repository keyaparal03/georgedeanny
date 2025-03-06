<?php 
/*** Redux Framework ***/
require_once get_template_directory().'/admin/init.php';

/*** Theme Framework ***/
require_once get_template_directory().'/framework/init.php';	
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
/** restrict shipping countries */
add_filter('woocommerce_countries', 'exclude_shipping_countries');

function exclude_shipping_countries($countries) {
    // List of country codes to exclude
    $excluded_countries = array('AF', 'RU', 'BR', 'CN', 'IR', 'IQ', 'SS', 'SD', 'KP', 'LY', 'SY', 'RS', 'NG');

    // Remove excluded countries from the countries array
    foreach ($excluded_countries as $country_code) {
        if (isset($countries[$country_code])) {
            unset($countries[$country_code]);
        }
    }

    return $countries;
}
add_filter( 'gettext', function( $translated_text, $text, $domain ) {
    if ( $text === 'No products added to the wishlist' && $domain === 'yith-woocommerce-wishlist' ) {
        return 'Oops!... Your Wish List is empty.';
    }
    return $translated_text;
}, 20, 3 );



