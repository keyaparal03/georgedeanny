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


/**
 * Add cart-like functionality to WooCommerce checkout page
 * This version ensures the standard cart page works as usual
 */

// Only add our functionality if we're on the checkout page
function is_checkout_page() {
    return function_exists('is_checkout') && is_checkout() && !is_wc_endpoint_url('order-received');
}

// Add cart table to checkout page only
function add_checkout_cart_editor() {
    // Only run on checkout page
    if (!is_checkout_page()) {
        return;
    }
    
    // Get WooCommerce cart
    if (!function_exists('WC') || !WC()->cart) {
        return;
    }
    
    
}
add_action('woocommerce_checkout_before_customer_details', 'add_checkout_cart_editor');

// Add JavaScript to handle AJAX operations - only on checkout page
function checkout_cart_editor_scripts() {
    // Only load on checkout page
    if (!is_checkout_page()) {
        return;
    }
    
    ?>
    <script type="text/javascript">
    jQuery(function($) {
        // Make sure jQuery is loaded
        if (typeof $ === 'undefined') {
            console.log('jQuery not loaded');
            return;
        }
        
        // Get AJAX URL
        var ajaxurl = wc_checkout_params.ajax_url;
        
        // Update item quantity
        $(document).on('click', '.checkout-update-cart', function(e) {
            e.preventDefault();
            
            var cart_updates = {};
            var hasUpdates = false;
            
            $('.checkout-qty-input').each(function() {
                var item_key = $(this).data('cart-item-key');
                var qty = parseInt($(this).val(), 10);
                if (item_key && !isNaN(qty) && qty >= 0) {
                    cart_updates[item_key] = qty;
                    hasUpdates = true;
                }
            });
            
            if (!hasUpdates) {
                console.log('No valid updates found');
                return;
            }
            
            // Block UI
            $('.checkout-cart-editor').block({
                message: null,
                overlayCSS: {
                    background: '#fff',
                    opacity: 0.6
                }
            });
            
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'json',
                data: {
                    action: 'checkout_editor_update_cart',
                    cart_updates: cart_updates,
                    security: $('#checkout_editor_nonce').val()
                },
                success: function(response) {
                    if (response && response.success) {
                        // Refresh the page
                        window.location.reload();
                    } else {
                        console.log('Error updating cart:', response);
                        alert('Error updating cart. Please try again.');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('AJAX error:', textStatus, errorThrown);
                    alert('Error updating cart. Please try again.');
                },
                complete: function() {
                    $('.checkout-cart-editor').unblock();
                }
            });
        });
        
        // Remove item
        $(document).on('click', '.checkout-remove-item', function(e) {
            e.preventDefault();
            
            var item_key = $(this).data('cart-item-key');
            
            if (!item_key) {
                console.log('No item key found');
                return;
            }
            
            // Block UI
            $('.checkout-cart-editor').block({
                message: null,
                overlayCSS: {
                    background: '#fff',
                    opacity: 0.6
                }
            });
            
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'json',
                data: {
                    action: 'checkout_editor_remove_item',
                    cart_item_key: item_key,
                    security: $('#checkout_editor_nonce').val()
                },
                success: function(response) {
                    if (response && response.success) {
                        // Refresh the page
                        window.location.reload();
                    } else {
                        console.log('Error removing item:', response);
                        alert('Error removing item. Please try again.');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('AJAX error:', textStatus, errorThrown);
                    alert('Error removing item. Please try again.');
                },
                complete: function() {
                    $('.checkout-cart-editor').unblock();
                }
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'checkout_cart_editor_scripts');

// AJAX handler for updating cart
function checkout_editor_update_cart_handler() {
    // Check nonce
    if (!check_ajax_referer('checkout_editor_nonce', 'security', false)) {
        wp_send_json_error('Security check failed');
        wp_die();
    }
    
    // Validate input
    if (empty($_POST['cart_updates']) || !is_array($_POST['cart_updates'])) {
        wp_send_json_error('Invalid cart data');
        wp_die();
    }
    
    $cart_updated = false;
    
    // Update cart items
    foreach ($_POST['cart_updates'] as $cart_item_key => $quantity) {
        // Sanitize input
        $cart_item_key = sanitize_text_field($cart_item_key);
        $quantity = intval($quantity);
        
        // Check if item exists
        if (WC()->cart->get_cart_item($cart_item_key)) {
            if ($quantity <= 0) {
                WC()->cart->remove_cart_item($cart_item_key);
            } else {
                WC()->cart->set_quantity($cart_item_key, $quantity);
            }
            $cart_updated = true;
        }
    }
    
    // Recalculate totals if needed
    if ($cart_updated) {
        WC()->cart->calculate_totals();
    }
    
    wp_send_json_success();
}
add_action('wp_ajax_checkout_editor_update_cart', 'checkout_editor_update_cart_handler');
add_action('wp_ajax_nopriv_checkout_editor_update_cart', 'checkout_editor_update_cart_handler');

// AJAX handler for removing items
function checkout_editor_remove_item_handler() {
    // Check nonce
    if (!check_ajax_referer('checkout_editor_nonce', 'security', false)) {
        wp_send_json_error('Security check failed');
        wp_die();
    }
    
    // Validate input
    if (empty($_POST['cart_item_key'])) {
        wp_send_json_error('No item specified');
        wp_die();
    }
    
    // Sanitize input
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    
    // Check if item exists
    if (WC()->cart->get_cart_item($cart_item_key)) {
        WC()->cart->remove_cart_item($cart_item_key);
        WC()->cart->calculate_totals();
        wp_send_json_success();
    } else {
        wp_send_json_error('Item not found in cart');
    }
}
add_action('wp_ajax_checkout_editor_remove_item', 'checkout_editor_remove_item_handler');
add_action('wp_ajax_nopriv_checkout_editor_remove_item', 'checkout_editor_remove_item_handler');

// Add CSS styles for checkout cart editor
function checkout_cart_editor_styles() {
    // Only load on checkout page
    if (!is_checkout_page()) {
        return;
    }
    
    ?>
    <style>
        .checkout-cart-editor {
            margin-bottom: 30px;
        }
        .checkout-cart-items {
            width: 100%;
            border-collapse: collapse;
        }
        .checkout-cart-items th,
        .checkout-cart-items td {
            padding: 10px;
            border-bottom: 1px solid #e2e2e2;
        }
        .checkout-cart-items .product-thumbnail img {
            max-width: 50px;
            height: auto;
        }
        .checkout-qty-input {
            width: 60px;
        }
        .checkout-remove-item {
            display: block;
            font-size: 1.5em;
            height: 1em;
            width: 1em;
            text-align: center;
            line-height: 1;
            border-radius: 100%;
            color: #ff0000;
            text-decoration: none;
            font-weight: 700;
            border: 0;
        }
        .checkout-cart-actions {
            margin-top: 15px;
            text-align: right;
        }
    </style>
    <?php
}
add_action('wp_head', 'checkout_cart_editor_styles');