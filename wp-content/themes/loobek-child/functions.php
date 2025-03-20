<?php 
function loobek_child_register_scripts(){
    $parent_style = 'loobek-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('font-awesome-5', 'loobek-reset'), loobek_get_theme_version() );
    wp_enqueue_style( 'loobek-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'loobek_child_register_scripts', 99 );


function enqueue_custom_scripts() {
    // Make sure jQuery is loaded
    wp_enqueue_script('jquery');

    // Localize script to pass AJAX URL and nonce
    wp_localize_script('jquery', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('billing_nonce')
    ));

    // Add inline script to ensure `my_ajax_object` is available
    add_action('wp_head', function() {
        echo '<script type="text/javascript">
            var my_ajax_object = ' . json_encode(array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('billing_nonce')
            )) . ';
        </script>';
    });
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

add_action('init', function () {
    if (isset($_GET['test_ajax_action'])) {
        die('AJAX action is registered');
    }
});

add_action('wp_ajax_save_user_shipping_address', 'save_user_shipping_address');
add_action('wp_ajax_nopriv_save_user_shipping_address', 'save_user_shipping_address');

function save_user_shipping_address() {
    // Security check
    check_ajax_referer('billing_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'You must be logged in to add an address.']);
    }

    $user_id = get_current_user_id();

    // Parse the serialized data
    parse_str($_POST['formData'], $formData);

    $new_address = [
        'shipping_first_name' => sanitize_text_field($formData['shipping_first_name']),
        'shipping_last_name'  => sanitize_text_field($formData['shipping_last_name']),
        'shipping_country'    => sanitize_text_field($formData['shipping_country']),
        'shipping_address_1'  => sanitize_text_field($formData['shipping_address_1']),
        'shipping_address_2'  => sanitize_text_field($formData['shipping_address_2']),
        'shipping_city'       => sanitize_text_field($formData['shipping_city']),
        'shipping_state'      => sanitize_text_field($formData['shipping_state']),
        'shipping_postcode'   => sanitize_text_field($formData['shipping_postcode']),
    ];

    // Get existing addresses
    $addresses = get_user_meta($user_id, 'thwma_custom_address', true);
    if (!is_array($addresses)) {
        $addresses = ['shipping' => [], 'default_shipping' => ''];
    }

    // Generate a new address key
    $address_key = 'address_' . (count($addresses['shipping']) + 1);
    $addresses['shipping'][$address_key] = $new_address;

    // Save updated address list
    update_user_meta($user_id, 'thwma_custom_address', $addresses);

    wp_send_json_success(['message' => 'Shipping address added successfully!']);
}
