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



//thwma_custom_address

function switch_default_address() {
    // Verify nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'switch_address_nonce')) {
        wp_send_json_error(['message' => 'Invalid request.']);
        wp_die();
    }

    // Get user ID
    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['message' => 'User not logged in.']);
        wp_die();
    }

    // Get posted address key (e.g., address_1 or address_2)
    $selected_address_key = sanitize_text_field($_POST['selected_address']);

    // Get existing addresses
    $addresses = get_user_meta($user_id, 'thwma_custom_address', true);

    // Ensure data is an array
    if (!is_array($addresses) || empty($addresses['billing'][$selected_address_key])) {
        wp_send_json_error(['message' => 'Invalid address selected.']);
        wp_die();
    }

    // Swap address_0 with the selected address
    $temp = $addresses['billing']['address_0'];
    $addresses['billing']['address_0'] = $addresses['billing'][$selected_address_key];
    $addresses['billing'][$selected_address_key] = $temp;

    // Update user meta
    update_user_meta($user_id, 'thwma_custom_address', $addresses);

    // Send success response
    wp_send_json_success(['message' => 'Default address updated successfully.']);
    wp_die();
}

// Register AJAX actions
add_action('wp_ajax_switch_default_address', 'switch_default_address');
add_action('wp_ajax_nopriv_switch_default_address', '__return_false'); // Prevent non-logged-in access
