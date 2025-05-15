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

// Get WooCommerce Countries
$wc_countries = new WC_Countries();
$billing_countries = $wc_countries->get_allowed_countries();
$shipping_countries = $wc_countries->get_shipping_countries();
$billing_states = $wc_countries->get_states();
$shipping_states = $wc_countries->get_states();


?>

<?php
$user_id = get_current_user_id();
$addresses = get_user_meta($user_id, 'thwma_custom_address', true);
$default_billing = !empty($addresses['billing']['address_0']) ? $addresses['billing']['address_0'] : null;


?>
    <div class="billing-address-container">
        
		<div class="address-section"> 
			<div class="billing-address-section">
            <div class="d-flx" style="margin-top:30px;">
                <h4>Billing Address</h4>
                <button type="button" class="btn btn-secondary" id="openPopupBilling">Change Billing Address</button>
            </div>
				<?php if ($default_billing) : ?>
					<div class="billing-address-box" id="billing-address-box">
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
				<?php endif; ?>
			</div>
			<div class="shipping-address-section">
                    <div class="shipping-checkbox">
                        <input type="checkbox" id="shipToDifferentAddress">
                        <label for="shipToDifferentAddress">Shipping address diffrent than billing address</label>
                    </div>
                <div class="d-flx">
                <h4>Shipping Address</h4>
                <div class="d-flxr">
                   
                    <!-- Shipping Address Box (Initially Hidden) -->
                    <div class="address-box" id="shippingAddressBox" style="display: none;">
                        <button type="button" class="btn btn-secondary" id="openPopupShipping" style="display: none;">Change Shipping Address</button>
                    </div>
                </div>
                </div>
				<?php if ($default_billing) : ?>
					<div class="billing-address-box" id="shipping-address-box">
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
				<?php endif; ?>
				
			</div>
		</div>
    </div>



<!-- <button type="button" class="btn btn-secondary" id="openPopupBilling">Change Billing Address</button>
<button type="button" class="btn btn-secondary" id="openPopupShipping">Change Shipping Address</button> -->


<!-- Hidden Popup inside Modal -->
<div id="popupContentShipping" class="d-none position-relative">
    <!-- Close Button -->
	<div class="popBack">
        <button type="button" class="close-btn" id="closePopupShipping">&times;</button>
        <div class="addressHead">
            <div>
                <h5>Shipping Addresses</h5>
            </div>
            <div><button id="addNewShippingAddress" class="btn btn-primary">+ Add New Shipping Address</button></div>
        </div>
        <div class="shipping-address-list">
        <?php
        $user_id = get_current_user_id();
        $addresses = get_user_meta($user_id, 'thwma_custom_address', true);

        // Display Shipping Addresses
        if (!empty($addresses['shipping'])) {
            echo "<ul>";
            foreach ($addresses['shipping'] as $key => $address) {
                //$is_default = ($key === 'address_0'); // Check if it's the default address
                $address_data = json_encode($address); // Convert to JSON for JavaScript
                // $address_class = $is_default ? "default-shipping" : "select-shipping";
                $address_class = "select-shipping";
                $style = $is_default ? "background-color: #f0f0f0; cursor: not-allowed;" : "cursor: pointer;";

                echo "<li class='{$address_class} address_custom_li' data-shipping='" . esc_attr($address_data) . "' style='{$style}'>";
                //echo "<strong>" . (!empty($address['shipping_heading']) ? esc_html($address['shipping_heading']) : ucfirst($key)) . ":</strong><br>";
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
        <br/>
       
    </div>
    <div class="popBackDrop"></div>
</div>

<!-- Hidden Popup inside Modal -->
<div id="popupNewShippingForm" class="d-none position-relative">
    <!-- Close Button -->
    <div class="popBack">
        <button type="button" class="close-btn" id="closePopupShippingForm">&times;</button>

        <h5>Add Shipping Addresses</h5>
        
        <!-- Add New Address Form (Initially Hidden) -->
        <div id="newShippingForm">
        <form id="shippingAddressForm">
            <label for="shipping_first_name">First Name</label>
            <input type="text" name="shipping_first_name" required>

            <label for="shipping_last_name">Last Name</label>
            <input type="text" name="shipping_last_name" required>

            <label for="shipping_country">Country</label>
            <select id="shipping_country2" name="shipping_country">
                <?php foreach ($shipping_countries as $code => $name) : ?>
                    <option value="<?php echo esc_attr($code); ?>"><?php echo esc_html($name); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="shipping_address_1">Address Line 1</label>
            <input type="text" name="shipping_address_1" required>

            <label for="shipping_address_2">Address Line 2</label>
            <input type="text" name="shipping_address_2">

            <label for="shipping_city">City</label>
            <input type="text" name="shipping_city" required>

            <label for="shipping_state1">State</label>
            <select id="shipping_state1" name="shipping_state">
            <!-- States will be dynamically populated via JavaScript -->
            </select>

            <label for="shipping_postcode">Postcode</label>
            <input type="text" name="shipping_postcode" required>
            <!-- New Phone Field -->
            <label for="shipping_phone">Phone</label>
            <input type="text" name="shipping_phone" required>

            <!-- New Email Field -->
            <label for="shipping_email">Email</label>
            <input type="email" name="shipping_email" required>

            <button type="submit" class="btn btn-success">Save Address</button>
            </form> 
        
        
        </div>
    </div>
    <div class="popBackDrop"></div>
</div>
<!-- Hidden Popup inside Modal -->
<div id="popupContentBilling" class="d-none">
    <div class="popBack">
        <button type="button" class="close-btn" id="closePopupBilling">&times;</button>
        <div class="addressHead">
            <div>
                <h5>Billing Addresses</h5>
            </div>
            <div>
                <button id="addNewBillingAddress" class="btn btn-primary">+ Add New Billing Address</button>
            </div>
        </div>
       
        <div class="billing-address-list">
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
        
    </div>
    <div class="popBackDrop"></div>
</div>

<div id="popupNewBillingForm" class="d-none">
    <div class="popBack">
        <button type="button" class="close-btn" id="closePopupBillingForm">&times;</button>
        <h5>New Billing Addresses</h5>
        <!-- Add New Address Form (Initially Hidden) -->
        <div id="newBillingForm">
        <form id="billingAddressForm">
            <label for="billing_first_name">First Name</label>
            <input type="text" name="billing_first_name" required>

            <label for="billing_last_name">Last Name</label>
            <input type="text" name="billing_last_name" required>

            <label for="billing_country">Country</label>
            <select id="billing_country1" name="billing_country">
                <?php foreach ($billing_countries as $code => $name) : ?>
                    <option value="<?php echo esc_attr($code); ?>"><?php echo esc_html($name); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="billing_address_1">Address Line 1</label>
            <input type="text" name="billing_address_1" required>

            <label for="billing_address_2">Address Line 2</label>
            <input type="text" name="billing_address_2">

            <label for="billing_city">City</label>
            <input type="text" name="billing_city" required>

            <label for="billing_state">State</label>
            <select id="billing_state1" name="billing_state">
                <!-- States will be dynamically populated via JavaScript -->
            </select>

            <label for="billing_postcode">Postcode</label>
            <input type="text" name="billing_postcode" required>
            <!-- New Phone Field -->
            <label for="billing_phone">Phone</label>
            <input type="text" name="billing_phone" required>

            <!-- New Email Field -->
            <label for="billing_email">Email</label>
            <input type="email" name="billing_email" required>

            <button type="submit" class="btn btn-success">Save Address</button>
            </form> 
        
        
        </div>
    </div>
    <div class="popBackDrop"></div>
</div>
<!-- Popup shipping method -->
<div id="shipping-popup" class="popup-container">
    <div class="popBack">
        <button type="button" class="close-btn" id="closePopupShippingMethod">&times;</button>
        <div class="popup-content">
            <h3>Select Shipping Method</h3>
            <ul id="popup-shipping-methods">
                <!-- Shipping options will be copied here dynamically -->
            </ul>
            <!-- <button id="close-shipping-popup">Close</button> -->
        </div>
    </div>
    <div class="popBackDrop"></div>
</div>

<table class="shop_table checkout-cart-items">
    <thead>
        <tr>
            <th class="product-thumbnail">&nbsp;</th>
            <th class="product-name"><?php _e('Product', 'woocommerce'); ?></th>
            <th class="product-price"><?php _e('Price', 'woocommerce'); ?></th>
            <th class="product-quantity"><?php _e('Quantity', 'woocommerce'); ?></th>
            <th class="product-subtotal"><?php _e('Subtotal', 'woocommerce'); ?></th>
            <th class="product-remove">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = $cart_item['data'];
            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
        ?>
                <tr data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                    <td class="product-thumbnail">
                        <?php echo $_product->get_image(); ?>
                    </td>
                    <td class="product-name">
                        <?php echo $_product->get_name(); ?>
                    </td>
                    <td class="product-price">
                        <?php echo WC()->cart->get_product_price($_product); ?>
                    </td>
                    <td class="product-quantity">
                        <div class="quantity">
                            <button type="button" class="qty-decrease" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">-</button>
                            <input type="number" 
                                   class="input-text qty checkout-qty-input" 
                                   data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>"
                                   step="1" 
                                   min="1" 
                                   max="<?php echo $_product->get_max_purchase_quantity(); ?>" 
                                   value="<?php echo esc_attr($cart_item['quantity']); ?>" 
                                   size="4"
                                   pattern="[0-9]*" 
                                   inputmode="numeric" />
                            <button type="button" class="qty-increase" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">+</button>
                        </div>
                    </td>
                    <td class="product-subtotal">
                        <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                    </td>
                    <td class="product-remove">
                        <a href="#" class="remove checkout-remove-item" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">&times;</a>
                    </td>
                </tr>
        <?php }
        } ?>
        <tr><td colspan="6" class="update-cart-btn-td"><button id="update-cart-btn">Update Cart</button></td></tr>
    </tbody>
</table>

<!-- Add Update Cart Button -->



<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

        
		<div class="col2-set" id="customer_details">
			<div class="col-1" style="display:none;">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2" style="display:none;">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<!-- <h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3> -->
	
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
    $("#closePopupBilling").click(function() {
        $("#popupContentBilling").fadeOut();
    });

    $("#closePopupShippingForm").click(function() {
        $("#popupNewShippingForm").fadeOut();
    });
    $("#closePopupBillingForm").click(function() {
        $("#popupNewBillingForm").fadeOut();
    });

	$("#openPopupBilling").click(function() {
        $("#popupContentBilling").removeClass("d-none").hide().fadeIn();
    });

    $("#closePopupShippingMethod").click(function() {
        $("#shipping-popup").fadeOut();
    });

    
	$("#addNewShippingAddress").click(function(){
        $("#popupContentShipping").fadeOut();
		$("#popupNewShippingForm").fadeIn();
	})
	$("#addNewBillingAddress").click(function(){
        $("#popupContentBilling").fadeOut();
		$("#popupNewBillingForm").fadeIn();
	})
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // function updateCartItem(cartItemKey, quantity) {
    //     let formData = new FormData();
    //     formData.append("action", "update_cart_quantity");
    //     formData.append("cart_item_key", cartItemKey);
    //     formData.append("quantity", quantity);

    //     fetch("<?php //echo admin_url('admin-ajax.php'); ?>", {
    //         method: "POST",
    //         body: formData
    //     }).then(response => response.json())
    //     .then(data => {
    //         if (data.success) {
    //             location.reload(); // Refresh cart totals
    //         }
    //     });
    // }

    function updateCartItem(cartItemKey, quantity) {
        let formData = new FormData();
        formData.append("action", "update_cart_quantity");
        formData.append("security", my_ajax_object.wc_cart_params);
        formData.append("cart_item_key", cartItemKey);
        formData.append("quantity", quantity);

        fetch(my_ajax_object.ajax_url, { // Use WooCommerce's AJAX URL
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                // Trigger WooCommerce cart update to refresh totals
                jQuery(document.body).trigger("wc_fragment_refresh");
            }
        });
    }


    document.querySelectorAll(".qty-increase").forEach(button => {
        button.addEventListener("click", function () {
            let input = this.parentNode.querySelector(".checkout-qty-input");
            let newQty = parseInt(input.value) + 1;
            input.value = newQty;
            updateCartItem(input.getAttribute("data-cart-item-key"), newQty);
        });
    });

    document.querySelectorAll(".qty-decrease").forEach(button => {
        button.addEventListener("click", function () {
            let input = this.parentNode.querySelector(".checkout-qty-input");
            let newQty = Math.max(1, parseInt(input.value) - 1);
            input.value = newQty;
            updateCartItem(input.getAttribute("data-cart-item-key"), newQty);
        });
    });

    document.querySelectorAll(".checkout-remove-item").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            let cartItemKey = this.getAttribute("data-cart-item-key");

            let formData = new FormData();
            formData.append("action", "remove_cart_item");
            formData.append("cart_item_key", cartItemKey);

            fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        });
    });
});
jQuery(document).ready(function ($) {
    $("#update-cart-btn").click(function () {
        let updatedCart = {};

        $(".checkout-qty-input").each(function () {
            let cartItemKey = $(this).data("cart-item-key");
            let quantity = $(this).val();
            updatedCart[cartItemKey] = quantity;
        });

        $.ajax({
            type: "POST",
            url: my_ajax_object.ajax_url,
            data: {
                action: "update_cart_bulk",
                cart_items: updatedCart
            },
            success: function (response) {
                if (response.success) {
                    location.reload();
                    $("#update-message").show().delay(2000).fadeOut(); // Show success message
                    jQuery(document.body).trigger("update_checkout"); // Refresh checkout totals
                }
            }
        });
    });
});

</script>

<script>
// Shipping Address Selection
document.querySelectorAll(".select-shipping").forEach(function(element) {
        element.addEventListener("click", function() {
            let shipping = JSON.parse(this.getAttribute("data-shipping"));
            console.log(shipping.shipping_state);

            // Populate WooCommerce Shipping Fields
            document.getElementById("shipping_first_name").value = shipping.shipping_first_name;
            document.getElementById("shipping_last_name").value = shipping.shipping_last_name;
            document.getElementById("shipping_address_1").value = shipping.shipping_address_1;
            document.getElementById("shipping_address_2").value = shipping.shipping_address_2 || "";
            document.getElementById("shipping_city").value = shipping.shipping_city;
            document.getElementById("shipping_state").value = shipping.shipping_state;
            document.getElementById("shipping_postcode").value = shipping.shipping_postcode;
            document.getElementById("shipping_country").value = shipping.shipping_country;
            //alert(document.getElementById("shipping_state").value);
            // Highlight the selected shipping address

            let shippingBox = document.getElementById("shipping-address-box");
    
            if (!shippingBox) return; // Exit if element is not found

            let addressHTML = `
                <p>${shipping.shipping_first_name} ${shipping.shipping_last_name}</p>
                <p>${shipping.shipping_address_1}</p>
                ${shipping.shipping_address_2 ? `<p>${shipping.shipping_address_2}</p>` : ""}
                <p>${shipping.shipping_city}, ${shipping.shipping_state} - ${shipping.shipping_postcode}</p>
                <p>${shipping.shipping_country}</p>
                ${shipping.shipping_phone ? `<p>Phone: ${shipping.shipping_phone}</p>` : ""}
                ${shipping.shipping_email ? `<p>Email: ${shipping.shipping_email}</p>` : ""}
            `;

            shippingBox.innerHTML = addressHTML; 
            

            // Remove class from all other elements
            document.querySelectorAll(".select-shipping").forEach(el => {
                el.style.backgroundColor = ""
                el.classList.remove("selected-address-text");
            });

           
            //this.style.backgroundColor = "#f00"; // Red for selected address
            // this.style.color = "#fff";
            // Add class only to the clicked one
            this.classList.add("selected-address-text");
            // $("#popupContentShipping").fadeOut(); 
            const popupContentBilling = document.getElementById("popupContentShipping");
            popupContentBilling.style.display = "none"; 
            
        });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".select-billing").forEach(function(element) {
        
        element.addEventListener("click", function() {
            let billing = JSON.parse(this.getAttribute("data-billing"));
            console.log(billing.billing_state);
            document.getElementById("billing_state").value = billing.billing_state;

           // Manually trigger the change event
            document.getElementById("billing_state").dispatchEvent(new Event("change"));
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

            let billingBox = document.getElementById("billing-address-box");
    
            if (!billingBox) return; // Exit if element is not found

            let addressHTML = `
                <p>${billing.billing_first_name} ${billing.billing_last_name}</p>
                <p>${billing.billing_address_1}</p>
                ${billing.billing_address_2 ? `<p>${billing.billing_address_2}</p>` : ""}
                <p>${billing.billing_city}, ${billing.billing_state} - ${billing.billing_postcode}</p>
                <p>${billing.billing_country}</p>
                ${billing.billing_phone ? `<p>Phone: ${billing.billing_phone}</p>` : ""}
                ${billing.billing_email ? `<p>Email: ${billing.billing_email}</p>` : ""}
            `;

            billingBox.innerHTML = addressHTML; 

            // Highlight the selected address
            // document.querySelectorAll(".select-billing").forEach(el => el.style.backgroundColor = "");

            document.querySelectorAll(".select-billing").forEach(el => {
                //console.log('test222');
                el.style.backgroundColor = ""
                el.classList.remove("selected-address-text");
            });

            const shipToDifferentCheckbox1 = document.getElementById("shipToDifferentAddress");

            if (!shipToDifferentCheckbox1.checked) {

                document.getElementById("shipping_first_name").value = billing.billing_first_name;
                document.getElementById("shipping_last_name").value = billing.billing_last_name;
                document.getElementById("shipping_address_1").value = billing.billing_address_1;
                document.getElementById("shipping_address_2").value = billing.billing_address_2 || "";
                document.getElementById("shipping_city").value = billing.billing_city;
                document.getElementById("shipping_state").value = billing.billing_state;
                document.getElementById("shipping_postcode").value = billing.billing_postcode;
                document.getElementById("shipping_country").value = billing.billing_country;

                let shippingBox = document.getElementById("shipping-address-box");
        
                if (!shippingBox) return; // Exit if element is not found

                let addressHTML = `
                    <p>${billing.billing_first_name} ${billing.billing_last_name}</p>
                    <p>${billing.billing_address_1}</p>
                    ${billing.billing_address_2 ? `<p>${billing.billing_address_2}</p>` : ""}
                    <p>${billing.billing_city}, ${billing.billing_state} - ${billing.billing_postcode}</p>
                    <p>${billing.billing_country}</p>
                    ${billing.billing_phone ? `<p>Phone: ${billing.billing_phone}</p>` : ""}
                    ${billing.billing_email ? `<p>Email: ${billing.billing_email}</p>` : ""}
                `;

                shippingBox.innerHTML = addressHTML; 

            }

           
            // this.style.backgroundColor = "#f00"; // Red for selected address
            // this.style.color = "#fff";
            // Add class only to the clicked one
            this.classList.add("selected-address-text");
            const popupContentBilling = document.getElementById("popupContentBilling");
            popupContentBilling.style.display = "none"; 
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
    function togglePopup(popupId) {
        let popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.toggle("d-none");
        }
    }

    document.getElementById("addNewBillingAddress").addEventListener("click", function () {
        document.getElementById("newBillingForm").classList.remove("d-none");
    });

   document.addEventListener("DOMContentLoaded", function () {
    function togglePopup(popupId) {
        let popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.toggle("d-none");
        }
    }


    // Close popups when clicking outside
    document.addEventListener("click", function (event) {
        let billingPopup = document.getElementById("popupContentBilling");
        let openBillingBtn = document.getElementById("openPopupBilling");

        if (
            billingPopup &&
            !billingPopup.contains(event.target) &&
            event.target !== openBillingBtn
        ) {
            billingPopup.classList.add("d-none");
        }
    });

    // Close button functionality
    document.getElementById("closePopupBilling").addEventListener("click", function () {
        document.getElementById("popupContentBilling").classList.add("d-none");
    });
});


    // Close popups when clicking outside
    document.addEventListener("click", function (event) {
        let billingPopup = document.getElementById("popupContentBilling");
        let openBillingBtn = document.getElementById("openPopupBilling");

        if (
            billingPopup &&
            !billingPopup.contains(event.target) &&
            event.target !== openBillingBtn
        ) {
            billingPopup.classList.add("d-none");
        }
    });

    // Close button functionality
    document.getElementById("closePopupBilling").addEventListener("click", function () {
        document.getElementById("popupContentBilling").classList.add("d-none");
    });
});
jQuery(document).ready(function ($)  {
    $("#shipping_country2").change(function () {
        let countryCode = $(this).val();
        // ✅ Validate that a country is selected
        if (!countryCode) {
            alert("Please select a country before choosing a state.");
            return;
        }
        $.ajax({
            type: "POST",
            url: my_ajax_object.ajax_url,
            data: {
                action: "get_states",
                security: my_ajax_object.get_states_nonce,
                country_code: countryCode
            },
            beforeSend: function () {
                // ✅ Show a loading message (optional)
                $("#shipping_state1").html('<option value="">Loading states...</option>');
            },
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    let states = response.data;
                    let stateDropdown = $("#shipping_state1");

                    // Clear previous states
                    stateDropdown.empty();
                    stateDropdown.append('<option value="">Select State</option>');

                    // Append new state options
                    $.each(states, function (index, state) {
                        stateDropdown.append(`<option value="${state.code}">${state.name}</option>`);
                    });

                    // Trigger change event
                    stateDropdown.trigger("change");
                } else {
                    console.error("Error: No states found");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });
   
   
    $("#billing_country1").change(function () {
       
        let countryCode = $(this).val();
        // ✅ Validate that a country is selected
        if (!countryCode) {
            alert("Please select a country before choosing a state.");
            return;
        }
        $.ajax({
            type: "POST",
            url: my_ajax_object.ajax_url,
            data: {
                action: "get_states",
                security: my_ajax_object.get_states_nonce,
                country_code: countryCode
            },
            beforeSend: function () {
                // ✅ Show a loading message (optional)
                $("#billing_state1").html('<option value="">Loading states...</option>');
            },
            success: function (response) {
                if (response.success) {
                    let states = response.data;
                    let stateDropdown = $("#billing_state1");

                    // Clear previous states
                    stateDropdown.empty();
                    stateDropdown.append('<option value="">Select State</option>');

                    // Append new state options
                    $.each(states, function (index, state) {
                        stateDropdown.append(`<option value="${state.code}">${state.name}</option>`);
                    });

                    // Trigger change event
                    stateDropdown.trigger("change");
                } else {
                    console.error("Error: No states found");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });

    function handleFormSubmission(formId, action, popupId) {
        $(formId).submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                type: "POST",
                url: my_ajax_object.ajax_url, // From wp_localize_script
                data: {
                    action: action, // Dynamic action for billing or shipping
                    nonce: my_ajax_object.nonce,
                    formData: formData
                },
                success: function (response) {
                    // console.log(formData);
                    // console.log(popupId);
                    // console.log(response);
                    if (response.success) {
                        if(popupId=='#popupNewBillingForm'){
                            // Convert URL-encoded string to an object
                            let params = new URLSearchParams(formData);

                            let billingForm_1 = document.getElementById("billingAddressForm");
                           

                            // console.log(params);

                            // Get input values from the form
                            let billingFirstName_1 = params.get("billing_first_name");
                            let billingLastName_1 = params.get("billing_last_name");
                            let billingCountry_1 =  params.get("billing_country");
                            let billingAddress1_1 =  params.get("billing_address_1");
                            let billingAddress2_1 =  params.get("billing_address_2"); 
                            let billingCity_1 =  params.get("billing_city"); 
                            let billingState_1 =  params.get("billing_state");
                            let billingPostcode_1 =  params.get("billing_postcode");
                            let billingPhone_1 =  params.get("billing_phone"); 
                            let billingEmail_1 =  params.get("billing_email"); 
                            // Create new list item

                            // console.log("Keya"+billingFirstName_1);
                            // console.log(billingFirstName_1);
                            let billingData = {
                                "billing_first_name": billingFirstName_1,
                                "billing_last_name": billingLastName_1,
                                "billing_country": billingCountry_1,
                                "billing_address_1": billingAddress1_1,
                                "billing_address_2": billingAddress2_1,
                                "billing_city": billingCity_1,
                                "billing_state": billingState_1,
                                "billing_postcode": billingPostcode_1,
                                "billing_phone": billingPhone_1,
                                "billing_email": billingEmail_1
                            };
                            let listItem = `<li class='select-billing address_custom_li' data-billing='${JSON.stringify(billingData)}'>
                                ${billingFirstName_1} ${billingLastName_1}<br>
                                ${billingAddress1_1}<br>
                                ${billingAddress2_1 ? billingAddress2_1 + "<br>" : ""}
                                ${billingCity_1}, ${billingState_1} - ${billingPostcode_1}<br>
                                ${billingCountry_1}<br>
                                ${billingPhone_1 ? "Phone: " + billingPhone_1 + "<br>" : ""}
                                ${billingEmail_1 ? "Email: " + billingEmail_1 + "<br>" : ""}
                            </li>`;

                            if (billingForm_1) {
                                billingForm_1.reset();
                            }

                            $(".billing-address-list ul").append(listItem); // Append new address to the list
                            $("#popupNewBillingForm").fadeOut(); 
                            $("#popupContentBilling").fadeIn();

                            document.querySelectorAll(".select-billing").forEach(function(element) {
                                
                                element.addEventListener("click", function() {
                                    let billing = JSON.parse(this.getAttribute("data-billing"));
                                    console.log(billing.billing_state);
                                    document.getElementById("billing_state").value = billing.billing_state;

                                    // Manually trigger the change event
                                    document.getElementById("billing_state").dispatchEvent(new Event("change"));
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

                                    let billingBox = document.getElementById("billing-address-box");

                                    if (!billingBox) return; // Exit if element is not found

                                    let addressHTML = `
                                        <p>${billing.billing_first_name} ${billing.billing_last_name}</p>
                                        <p>${billing.billing_address_1}</p>
                                        ${billing.billing_address_2 ? `<p>${billing.billing_address_2}</p>` : ""}
                                        <p>${billing.billing_city}, ${billing.billing_state} - ${billing.billing_postcode}</p>
                                        <p>${billing.billing_country}</p>
                                        ${billing.billing_phone ? `<p>Phone: ${billing.billing_phone}</p>` : ""}
                                        ${billing.billing_email ? `<p>Email: ${billing.billing_email}</p>` : ""}
                                    `;

                                    billingBox.innerHTML = addressHTML; 

                                    // Highlight the selected address
                                    // document.querySelectorAll(".select-billing").forEach(el => el.style.backgroundColor = "");

                                    document.querySelectorAll(".select-billing").forEach(el => {
                                        // console.log('test222');
                                        el.style.backgroundColor = ""
                                        el.classList.remove("selected-address-text");
                                    });

                                    const shipToDifferentCheckbox2 = document.getElementById("shipToDifferentAddress");

                                    if (!shipToDifferentCheckbox2.checked) {

                                        document.getElementById("shipping_first_name").value = billing.billing_first_name;
                                        document.getElementById("shipping_last_name").value = billing.billing_last_name;
                                        document.getElementById("shipping_address_1").value = billing.billing_address_1;
                                        document.getElementById("shipping_address_2").value = billing.billing_address_2 || "";
                                        document.getElementById("shipping_city").value = billing.billing_city;
                                        document.getElementById("shipping_state").value = billing.billing_state;
                                        document.getElementById("shipping_postcode").value = billing.billing_postcode;
                                        document.getElementById("shipping_country").value = billing.billing_country;

                                        let shippingBox = document.getElementById("shipping-address-box");

                                        if (!shippingBox) return; // Exit if element is not found

                                        let addressHTML = `
                                            <p>${billing.billing_first_name} ${billing.billing_last_name}</p>
                                            <p>${billing.billing_address_1}</p>
                                            ${billing.billing_address_2 ? `<p>${billing.billing_address_2}</p>` : ""}
                                            <p>${billing.billing_city}, ${billing.billing_state} - ${billing.billing_postcode}</p>
                                            <p>${billing.billing_country}</p>
                                            ${billing.billing_phone ? `<p>Phone: ${billing.billing_phone}</p>` : ""}
                                            ${billing.billing_email ? `<p>Email: ${billing.billing_email}</p>` : ""}
                                        `;

                                        shippingBox.innerHTML = addressHTML; 

                                    }


                                    
                                    // this.style.backgroundColor = "#f00"; // Red for selected address
                                    // this.style.color = "#fff";
                                    // Add class only to the clicked one
                                    this.classList.add("selected-address-text");
                                    // $("#popupContentBilling").fadeOut(); 
                                    const popupContentBilling = document.getElementById("popupContentBilling");
                                    popupContentBilling.style.display = "none"; 
                                });
                            });
                        }else{
                            console.log("test11");
                            // Convert URL-encoded string to an object
                            let params = new URLSearchParams(formData);

                            let shippingForm_1 = document.getElementById("shippingAddressForm");
                            
                            // Get input values from the form
                            let shippingFirstName_1 = params.get("shipping_first_name");
                            let shippingLastName_1 = params.get("shipping_last_name");
                            let shippingCountry_1 = params.get("shipping_country");
                            let shippingAddress1_1 =  params.get("shipping_address_1");
                            let shippingAddress2_1 =  params.get("shipping_address_2");
                            let shippingCity_1 =  params.get("shipping_city");
                            let shippingState_1 =  params.get("shipping_state");
                            let shippingPostcode_1 =  params.get("shipping_postcode");
                            let shippingPhone_1 =  params.get("shipping_phone");
                            let shippingEmail_1 =  params.get("shipping_email");

                            let billingData = {
                                "shipping_first_name": shippingFirstName_1,
                                "shipping_last_name": shippingLastName_1,
                                "shipping_country": shippingCountry_1,
                                "shipping_address_1": shippingAddress1_1,
                                "shipping_address_2": shippingAddress2_1,
                                "shipping_city": shippingCity_1,
                                "shipping_state": shippingState_1,
                                "shipping_postcode": shippingPostcode_1,
                                "shipping_phone": shippingPhone_1,
                                "shipping_email": shippingEmail_1
                            };

                            let listItem = `<li class='select-shipping address_custom_li' data-shipping='${JSON.stringify(billingData)}'>
                                ${shippingFirstName_1} ${shippingLastName_1}<br>
                                ${shippingAddress1_1}<br>
                                ${shippingAddress2_1 ? shippingAddress2_1 + "<br>" : ""}
                                ${shippingCity_1}, ${shippingState_1} - ${shippingPostcode_1}<br>
                                ${shippingCountry_1}<br>
                                ${shippingPhone_1 ? "Phone: " + shippingPhone_1 + "<br>" : ""}
                                ${shippingEmail_1 ? "Email: " + shippingEmail_1 + "<br>" : ""}
                            </li>`;

                            if (shippingForm_1) {
                                shippingForm_1.reset();
                            }

                            $(".shipping-address-list ul").append(listItem); // Append new address to the list


                            document.querySelectorAll(".select-shipping").forEach(function(element) {
                                element.addEventListener("click", function() {
                                    let shipping = JSON.parse(this.getAttribute("data-shipping"));
                                    console.log(shipping.shipping_state);

                                    // Populate WooCommerce Shipping Fields
                                    document.getElementById("shipping_first_name").value = shipping.shipping_first_name;
                                    document.getElementById("shipping_last_name").value = shipping.shipping_last_name;
                                    document.getElementById("shipping_address_1").value = shipping.shipping_address_1;
                                    document.getElementById("shipping_address_2").value = shipping.shipping_address_2 || "";
                                    document.getElementById("shipping_city").value = shipping.shipping_city;
                                    document.getElementById("shipping_state").value = shipping.shipping_state;
                                    document.getElementById("shipping_postcode").value = shipping.shipping_postcode;
                                    document.getElementById("shipping_country").value = shipping.shipping_country;
                                    //alert(document.getElementById("shipping_state").value);
                                    // Highlight the selected shipping address

                                    let shippingBox = document.getElementById("shipping-address-box");
                            
                                    if (!shippingBox) return; // Exit if element is not found

                                    let addressHTML = `
                                        <p>${shipping.shipping_first_name} ${shipping.shipping_last_name}</p>
                                        <p>${shipping.shipping_address_1}</p>
                                        ${shipping.shipping_address_2 ? `<p>${shipping.shipping_address_2}</p>` : ""}
                                        <p>${shipping.shipping_city}, ${shipping.shipping_state} - ${shipping.shipping_postcode}</p>
                                        <p>${shipping.shipping_country}</p>
                                        ${shipping.shipping_phone ? `<p>Phone: ${shipping.shipping_phone}</p>` : ""}
                                        ${shipping.shipping_email ? `<p>Email: ${shipping.shipping_email}</p>` : ""}
                                    `;

                                    shippingBox.innerHTML = addressHTML; 
                                    

                                    // Remove class from all other elements
                                    document.querySelectorAll(".select-shipping").forEach(el => {
                                        el.style.backgroundColor = ""
                                        el.classList.remove("selected-address-text");
                                    });

                                
                                    //this.style.backgroundColor = "#f00"; // Red for selected address
                                    // this.style.color = "#fff";
                                    // Add class only to the clicked one
                                    this.classList.add("selected-address-text");
                                    // $("#popupContentShipping").fadeOut(); 
                                    const popupContentBilling = document.getElementById("popupContentShipping");
                                    popupContentBilling.style.display = "none"; 
                                    
                                });
                            });


                            //$("#popupContentShipping").fadeIn();
                            const popupContentShipping = document.getElementById("popupContentShipping");
                            popupContentShipping.style.display = "none"; 
                        }
                    

                    $(popupId).fadeOut(); // Close popup on success
                    }
                },
                error: function () {
                    alert("Error saving address. Please try again.");
                }
            });
        });
    }

    // ✅ Initialize for Shipping & Billing Forms
    handleFormSubmission("#shippingAddressForm", "save_user_shipping_address", "#popupNewShippingForm");
    handleFormSubmission("#billingAddressForm", "save_user_billing_address", "#popupNewBillingForm");


    /**
     * Shipping method
     */
    var i = 0;
    console.log("called I = "+ i);
    jQuery(document.body).on('updated_checkout', function() {
        // Call your custom function here
        console.log("called"+ i);
        i=1;
        myCustomFunction();
    });

    function myCustomFunction() {
        if(i==1){
            console.log("Checkout updated!");
            $("#shipping_method").before('<a id="open-shipping-popup">Change Shipping Method</a>');
            $("#shipping_method").after('<div id="selected-shipping-method" style="margin-top:10px; font-weight:bold;"></div>');

            // Get the checked radio button for shipping methods
            var selectedRadio = jQuery('input[name="shipping_method[0]"]:checked');
            let selectedLabel ='';
            // Find the closest <li> (or any container that holds the label) and then get the text of the label element
            selectedLabel = selectedRadio.closest("li").find("label").first().text().trim();

            //console.log("Selected shipping method label:", selectedLabel);
            // var selectedLabel = $("#shipping_method").closest("li").find("label").text().trim();
            // console.log(selectedLabel);
            $("#selected-shipping-method").html(selectedLabel);

            $("#open-shipping-popup").click(function() {
                    $("#popup-shipping-methods").html($("#shipping_method").html());
                    $("#shipping-popup").fadeIn();
            });
            // Use delegated binding on the popup container for changes to the radio button selection
            $("#popup-shipping-methods").on("change", "input[type='radio']", function() {
                //console.log("Keya");
                var selectedValue = $(this).val();
                //console.log(selectedValue);
                // Uncheck all and check the one with matching value in the main shipping methods list
                $("#shipping_method input[type='radio']").prop("checked", false);
                $("#shipping_method input[type='radio'][value='" + selectedValue + "']")
                    .prop("checked", true)
                    .trigger("change");

                var selectedLabel = $(this).closest("li").find("label").text().trim();
                //console.log(selectedLabel);
                $("#selected-shipping-method").html(selectedLabel);

                // Close the popup
                $("#shipping-popup").fadeOut();
            });
            i=0;
        }
                // Add additional logic here
    }

});


</script>
<style>
/* Styles for the popup inside the modal */


#popupContentShipping, #popupContentBilling, #popupNewBillingForm, #popupNewShippingForm,#shipping-popup {
    position: fixed;
   
    z-index: 1051; /* Ensure it appears above the modal */
    display: none; /* Initially hidden */


    
}
.popBack{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 800px;
    max-width:100%;
    z-index: 1053;
	height: 600px;
	overflow: scroll;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    text-align: center;
}
.popBackDrop{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
	height: 100%;
    background:  rgba(0, 0, 0, 0.5);
    z-index: 1052;
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
.address_custom_li {
    border: 1px solid #ccc;
    padding: 5px;
    margin-left: 10px;
    float: left;
    height: 250px;
    width: 240px;
    list-style: none;
    overflow: scroll;
    margin-bottom: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.address_custom_li:hover{
    background: #EEE;
    color: #000;
}
.billing-address-box p {
    margin: 0 0 5px 0;
}

button#closePopupShipping, button#closePopupBilling, button#closePopupShippingForm, button#closePopupBillingForm, button#closePopupShippingMethod {
    right: 0px !important;
	top: 0px !important;
    position: fixed;
    background: transparent;
    border: none;
    color: #000;
    font-size: 39px;
}
.billing-address-container {
    /* background: #ccc; */
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
    max-width: 100%;
    margin-bottom: 20px;
}

.billing-address-box {
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #000;
    font-size: 14px;
    color: #000;
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

#customer_details{
	/* display: none; */
}
.d-none{
    display: none;
}
div#newBillingForm,div##newShippingForm {
    display: inline-block;
}
.shipping-address-list,.billing-address-list{
	display:flex;
}
.address-section{
	display:flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
.billing-address-section,.shipping-address-section {
    flex: 1;
    min-width: 300px;
    margin: 10px;
}
#newShippingForm, #newBillingForm {
    text-align: left;
}
select#shipping_country ,select#billing_country{
    max-width: 100%;
    margin-bottom: 10px;
}
/* 
** shipping popup
 */
 /* Popup Styles */
/* 
.popup-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
} */

.popup-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
}
/* cart */
td.product-thumbnail {
    width: 70px;
    margin: 10px;
    margin-right: 10px;
}
#shipping_method{
    display: none;
}




ul#popup-shipping-methods li {
    margin: 0;
    padding: 0 0 8px 0;
    line-height: 18px;
    text-indent: 0;
    list-style: none;
    position: relative;
    text-align: start;
}
ul#popup-shipping-methods li input {
    position: absolute;
    top: 3px;
    margin: 0;
    left: -20px;
}
ul#popup-shipping-methods li input {
    margin: 3px .4375em 0 0;
    vertical-align: top;
}
ul#popup-shipping-methods {
    margin: 20px 100px;
}
#open-shipping-popup{
    width: 190px;
    font-size: 13px;
    padding: 0 8px;
}
.shop_table.checkout-cart-items{
    width: 70%!important;
    float: left;
}
.woocommerce > form.checkout{
    min-width: 300px;
    width: 30%!important;
}
td.product-name {
    width: 50%;
    padding: 10px;
}

input.input-text.qty.checkout-qty-input {
    padding: 0px;
    width: 50px;
    line-height: 8px;
    height: 40px;
}
button.qty-decrease, button.qty-increase {
    width: 30px;
    height: 40px;
    background: #f3f4f5;
    border:none;
    color:#000;
    padding-top:3px;
    padding-left: 10px;
    padding-right: 10px;
}
.woocommerce table.shop_table tr td {
    padding-right: 15px;
}
td.update-cart-btn-td {
    text-align: right;
}
/**Arpita */
.d-flx {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    align-items: center;
    min-height: 68px;
}
.d-flx h4{
    margin-bottom: 0;
}

button#openPopupBilling {
    background: #000;
}
.shipping-checkbox{
    display: flex;
    gap:5px;
}
.d-flxr {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    gap: 10px;
    align-items: baseline;
}
button#openPopupShipping{
    background: #000;
}
/* .select-shipping.selected {
    background-color: #000;
    color: #fff;
} */
.selected-address-text{
    background-color: #f00;
    color: #fff;
}
.selected-address-text:hover{
    background-color: #f00;
    color: #fff;
}
.billing-address-list ul {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.address_custom_li:{ float:none}
.addressHead {
    display: flex;
    gap: 220px;
}
li.wc_payment_method.payment_method_authnet label{
    font-size: 0;
}
li.wc_payment_method.payment_method_authnet img:nth-child(3) {
    margin-left: 25px !important;
}
li.wc_payment_method.payment_method_authnet img {
    width: 100px;
    margin: 5px !important;
    display: inline-block;
}
</style>