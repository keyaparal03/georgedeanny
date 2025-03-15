<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<button type="button" class="btn btn-secondary" id="openPopupShipping">Change Shipping Address</button>
<button type="button" class="btn btn-secondary" id="openPopupBilling">Change Billing Address</button>

<!-- Hidden Popup inside Modal -->
<div id="popupContentShipping" class="d-none">
    <h5>Popup Content</h5>
	<?php
	$user_id = get_current_user_id();
	$addresses = get_user_meta($user_id, 'thwma_custom_address', true);

	if (!empty($addresses) && is_array($addresses)) {
		echo "<h3>Saved Addresses</h3>";

		// Display Shipping Addresses
		if (!empty($addresses['shipping'])) {
			echo "<h4>Shipping Addresses</h4><ul>";
			foreach ($addresses['shipping'] as $key => $address) {
				echo "<li>";
				echo "<strong>" . ucfirst($key) . ":</strong><br>";
				echo esc_html($address['shipping_first_name'] . " " . $address['shipping_last_name']) . "<br>";
				echo esc_html($address['shipping_address_1']) . "<br>";
				if (!empty($address['shipping_address_2'])) {
					echo esc_html($address['shipping_address_2']) . "<br>";
				}
				echo esc_html($address['shipping_city'] . ", " . $address['shipping_state'] . " - " . $address['shipping_postcode']) . "<br>";
				echo esc_html($address['shipping_country']) . "<br>";
				echo "</li><br>";
			}
			echo "</ul>";
		}
	} else {
		echo "<p>No saved addresses found.</p>";
	}

	?>
    <button class="btn btn-danger" id="closePopupShipping">Close Popup</button>
</div>
<!-- Hidden Popup inside Modal -->
<div id="popupContentBilling" class="d-none">
    <h5>Popup Content</h5>
	<?php
	$user_id = get_current_user_id();
	$addresses = get_user_meta($user_id, 'thwma_custom_address', true);

	if (!empty($addresses) && is_array($addresses)) {
		echo "<h3>Saved Addresses</h3>";
		// Display Billing Addresses
		if (!empty($addresses['billing'])) {
			echo "<h4>Billing Addresses</h4><ul>";
			foreach ($addresses['billing'] as $key => $address) {
				echo "<li>";
				echo "<strong>" . (!empty($address['billing_heading']) ? esc_html($address['billing_heading']) : ucfirst($key)) . ":</strong><br>";
				echo esc_html($address['billing_first_name'] . " " . $address['billing_last_name']) . "<br>";
				echo esc_html($address['billing_address_1']) . "<br>";
				if (!empty($address['billing_address_2'])) {
					echo esc_html($address['billing_address_2']) . "<br>";
				}
				echo esc_html($address['billing_city'] . ", " . $address['billing_state'] . " - " . $address['billing_postcode']) . "<br>";
				echo esc_html($address['billing_country']) . "<br>";
				if (!empty($address['billing_phone'])) {
					echo "Phone: " . esc_html($address['billing_phone']) . "<br>";
				}
				if (!empty($address['billing_email'])) {
					echo "Email: " . esc_html($address['billing_email']) . "<br>";
				}
				echo "</li><br>";
			}
			echo "</ul>";
		}
	} else {
		echo "<p>No saved addresses found.</p>";
	}

	?>
    <button class="btn btn-danger" id="closePopupBilling">Close Popup</button>
</div>

<?php
$user_id = get_current_user_id();
$addresses = get_user_meta($user_id, 'thwma_custom_address', true);

if (!empty($addresses['billing']) && is_array($addresses['billing'])) {
    // Default billing address (address_0)
    $default_billing = $addresses['billing']['address_0']; 

    echo "<h3>Default Billing Address</h3>";
    echo esc_html($default_billing['billing_first_name'] . " " . $default_billing['billing_last_name']) . "<br>";
    echo esc_html($default_billing['billing_address_1']) . "<br>";
    if (!empty($default_billing['billing_address_2'])) {
        echo esc_html($default_billing['billing_address_2']) . "<br>";
    }
    echo esc_html($default_billing['billing_city'] . ", " . $default_billing['billing_state'] . " - " . $default_billing['billing_postcode']) . "<br>";
    echo esc_html($default_billing['billing_country']) . "<br>";
    if (!empty($default_billing['billing_phone'])) {
        echo "Phone: " . esc_html($default_billing['billing_phone']) . "<br>";
    }
    if (!empty($default_billing['billing_email'])) {
        echo "Email: " . esc_html($default_billing['billing_email']) . "<br>";
    }
} else {
    echo "<p>No default billing address found.</p>";
}

?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<script>
jQuery(document).ready(function($) {
    $("#openPopupShipping").click(function() {
        $("#popupContentShipping").removeClass("d-none").hide().fadeIn();
    });

    $("#closePopupShipping").click(function() {
        $("#popupContentShipping").fadeOut();
    });

	$("#openPopupBilling").click(function() {
        $("#popupContentBilling").removeClass("d-none").hide().fadeIn();
    });

    $("#closePopupBilling").click(function() {
        $("#popupContentBilling").fadeOut();
    });
});
</script>
<style>
/* Styles for the popup inside the modal */
#popupContentShipping, #popupContentBilling {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    text-align: center;
    z-index: 1051; /* Ensure it appears above the modal */
    display: none; /* Initially hidden */
}

/* Overlay to darken background when popup is open */
#popupOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1050; /* Below popup but above modal */
    display: none;
}

</style>