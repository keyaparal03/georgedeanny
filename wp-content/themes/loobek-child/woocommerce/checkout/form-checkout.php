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
<?php
$user_id = get_current_user_id();
$addresses = get_user_meta($user_id, 'thwma_custom_address', true);
$default_billing = !empty($addresses['billing']['address_0']) ? $addresses['billing']['address_0'] : null;

if ($default_billing) :
?>
    <div class="billing-address-container">
        <h4>Billing Address</h4>
        <div class="billing-address-box">
            <p><?php echo esc_html($default_billing['billing_first_name'] . " " . $default_billing['billing_last_name']); ?></p>
            <p><?php echo esc_html($default_billing['billing_address_1']); ?></p>
            <?php if (!empty($default_billing['billing_address_2'])) : ?>
                <p><?php echo esc_html($default_billing['billing_address_2']); ?></p>
            <?php endif; ?>
            <p><?php echo esc_html($default_billing['billing_city'] . ", " . $default_billing['billing_state'] . " - " . $default_billing['billing_postcode']); ?></p>
            <p><?php echo esc_html($default_billing['billing_country']); ?></p>
            <?php if (!empty($default_billing['billing_phone'])) : ?>
                <p>Phone: <?php echo esc_html($default_billing['billing_phone']); ?></p>
            <?php endif; ?>
            <?php if (!empty($default_billing['billing_email'])) : ?>
                <p>Email: <?php echo esc_html($default_billing['billing_email']); ?></p>
            <?php endif; ?>
        </div>
        
        <button type="button" class="btn btn-secondary" id="openPopupBilling">Change Billing Address</button>

		<!-- Shipping Address Checkbox -->
		<div class="shipping-checkbox">
			<input type="checkbox" id="shipToDifferentAddress">
			<label for="shipToDifferentAddress">Shipping address diffrent than billing address</label>
		</div>
		<!-- Shipping Address Box (Initially Hidden) -->
		<div class="address-box" id="shippingAddressBox" style="display: none;">
			<button type="button" class="btn btn-secondary" id="openPopupShipping" style="display: none;">Change Shipping Address</button>
		</div>
    </div>

<?php endif; ?>

<!-- <button type="button" class="btn btn-secondary" id="openPopupBilling">Change Billing Address</button>
<button type="button" class="btn btn-secondary" id="openPopupShipping">Change Shipping Address</button> -->


<!-- Hidden Popup inside Modal -->
<div id="popupContentShipping" class="d-none position-relative">
    <!-- Close Button -->
	
    <button type="button" class="close-btn" id="closePopupShipping">&times;</button>

    <h5>Shipping Addresses</h5>
    <?php
    $user_id = get_current_user_id();
    $addresses = get_user_meta($user_id, 'thwma_custom_address', true);

    // Display Shipping Addresses
    if (!empty($addresses['shipping'])) {
        echo "<ul>";
        foreach ($addresses['shipping'] as $key => $address) {
            $is_default = ($key === 'address_0'); // Check if it's the default address
            $address_data = json_encode($address); // Convert to JSON for JavaScript
            $address_class = $is_default ? "default-shipping" : "select-shipping";
            $style = $is_default ? "background-color: #f0f0f0; cursor: not-allowed;" : "cursor: pointer;";

            echo "<li class='{$address_class} address_custom_li' data-shipping='" . esc_attr($address_data) . "' style='{$style}'>";
            echo "<strong>" . (!empty($address['shipping_heading']) ? esc_html($address['shipping_heading']) : ucfirst($key)) . ":</strong><br>";
            echo esc_html($address['shipping_first_name'] . " " . $address['shipping_last_name']) . "<br>";
            echo esc_html($address['shipping_address_1']) . "<br>";
            if (!empty($address['shipping_address_2'])) {
                echo esc_html($address['shipping_address_2']) . "<br>";
            }
            echo esc_html($address['shipping_city'] . ", " . $address['shipping_state'] . " - " . $address['shipping_postcode']) . "<br>";
            echo esc_html($address['shipping_country']) . "<br>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>
</div>

<!-- Hidden Popup inside Modal -->
<div id="popupContentBilling" class="d-none">
	<button type="button" class="close-btn" id="closePopupBilling">&times;</button>
    <h5>Billing Addresses</h5>
	<?php
		$user_id = get_current_user_id();
		$addresses = get_user_meta($user_id, 'thwma_custom_address', true);

		if (!empty($addresses) && is_array($addresses)) {
			// Display Billing Addresses
			if (!empty($addresses['billing'])) {
				echo "<ul>";

				foreach ($addresses['billing'] as $key => $address) {
					//$is_default = ($key === 'address_0'); // Check if it's the default address
					$address_data = json_encode($address); // Convert to JSON for JavaScript use
					$address_class = "select-billing";
					$style = $is_default ? "background-color: #f0f0f0; cursor: not-allowed;" : "cursor: pointer;";

					echo "<li class='{$address_class} address_custom_li' data-billing='" . esc_attr($address_data) . "' style='{$style}'>";
					echo "<strong>" . (!empty($address['billing_heading']) ? esc_html($address['billing_heading']) : '') . "</strong><br>";
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
					echo "</li>";
				}

				echo "</ul>";
			}
		}
	?>
</div>

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
<script>
// Shipping Address Selection
document.querySelectorAll(".select-shipping").forEach(function(element) {
        element.addEventListener("click", function() {
            let shipping = JSON.parse(this.getAttribute("data-shipping"));

            // Populate WooCommerce Shipping Fields
            document.getElementById("shipping_first_name").value = shipping.shipping_first_name;
            document.getElementById("shipping_last_name").value = shipping.shipping_last_name;
            document.getElementById("shipping_address_1").value = shipping.shipping_address_1;
            document.getElementById("shipping_address_2").value = shipping.shipping_address_2 || "";
            document.getElementById("shipping_city").value = shipping.shipping_city;
            document.getElementById("shipping_state").value = shipping.shipping_state;
            document.getElementById("shipping_postcode").value = shipping.shipping_postcode;
            document.getElementById("shipping_country").value = shipping.shipping_country;

            // Highlight the selected shipping address
            document.querySelectorAll(".select-shipping").forEach(el => el.style.backgroundColor = "");
            this.style.backgroundColor = "#d0f0d0"; // Light green for selected address
        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".select-billing").forEach(function(element) {
        element.addEventListener("click", function() {
            let billing = JSON.parse(this.getAttribute("data-billing"));

            // Populate WooCommerce Billing Fields
            document.getElementById("billing_first_name").value = billing.billing_first_name;
            document.getElementById("billing_last_name").value = billing.billing_last_name;
            document.getElementById("billing_address_1").value = billing.billing_address_1;
            document.getElementById("billing_address_2").value = billing.billing_address_2 || "";
            document.getElementById("billing_city").value = billing.billing_city;
            document.getElementById("billing_state").value = billing.billing_state;
            document.getElementById("billing_postcode").value = billing.billing_postcode;
            document.getElementById("billing_country").value = billing.billing_country;
            document.getElementById("billing_phone").value = billing.billing_phone || "";
            document.getElementById("billing_email").value = billing.billing_email || "";

            // Highlight the selected address
            document.querySelectorAll(".select-billing").forEach(el => el.style.backgroundColor = "");
            this.style.backgroundColor = "#d0f0d0"; // Light green for selected address
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const shipToDifferentCheckbox = document.getElementById("shipToDifferentAddress");
    const shippingAddressBox = document.getElementById("shippingAddressBox");
    const openPopupShipping = document.getElementById("openPopupShipping");

    function toggleShippingAddress() {
        if (shipToDifferentCheckbox.checked) {
            shippingAddressBox.style.display = "block"; // Show shipping section
            openPopupShipping.style.display = "inline-block"; // Show Change Shipping Address button
        } else {
            shippingAddressBox.style.display = "none"; // Hide shipping section
            openPopupShipping.style.display = "none"; // Hide Change Shipping Address button
        }
    }

    shipToDifferentCheckbox.addEventListener("change", toggleShippingAddress);

    // Run on page load
    toggleShippingAddress();
});

</script>


<style>
/* Styles for the popup inside the modal */
#popupContentShipping, #popupContentBilling {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 800px;
	height: 600px;
	overflow: scroll;
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
.address_custom_li{
	border:1px solid #ccc; 
	padding:10px; 
	margin-left:5px; 
	float: left;
	height: 300px;
	width: 200px;
	list-style: none;
}
button#closePopupShipping,button#closePopupBilling {
    right: 0px !important;
	top: 0px !important;
    position: fixed;
    background: #ffff !important;
    border: none;
    color: #000;
    font-size: 39px;
}
.billing-address-container {
    background: #f8f8f8;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
    max-width: 600px;
    margin-bottom: 20px;
}

.billing-address-box {
    background: #e8f5e9;
    padding: 10px;
    border-radius: 6px;
    border-left: 4px solid #4CAF50;
    font-size: 14px;
    color: #333;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    margin-top: 10px;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.checkout-btn {
    background-color: #28a745;
    color: white;
    padding: 12px 18px;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    font-size: 16px;
    margin-top: 15px;
}

.checkout-btn:hover {
    background-color: #218838;
}

</style>