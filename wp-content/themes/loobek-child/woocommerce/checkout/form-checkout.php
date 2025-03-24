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
        <h4>Billing Address</h4>
		<div class="address-section">
			<div class="billing-address-section">
				<?php if ($default_billing) : ?>
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
				<?php endif; ?>
				<button type="button" class="btn btn-secondary" id="openPopupBilling">Change Billing Address</button>
			</div>
			<div class="shipping-address-section">
					<!-- Shipping Address Checkbox -->
				
				<?php if ($default_billing) : ?>
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
				<?php endif; ?>
				<div class="shipping-checkbox">
					<input type="checkbox" id="shipToDifferentAddress">
					<label for="shipToDifferentAddress">Shipping address diffrent than billing address</label>
				</div>
				<!-- Shipping Address Box (Initially Hidden) -->
				<div class="address-box" id="shippingAddressBox" style="display: none;">
					<button type="button" class="btn btn-secondary" id="openPopupShipping" style="display: none;">Change Shipping Address</button>
				</div>
			</div>
		</div>
    </div>



<!-- <button type="button" class="btn btn-secondary" id="openPopupBilling">Change Billing Address</button>
<button type="button" class="btn btn-secondary" id="openPopupShipping">Change Shipping Address</button> -->


<!-- Hidden Popup inside Modal -->
<div id="popupContentShipping" class="d-none position-relative">
    <!-- Close Button -->
	
    <button type="button" class="close-btn" id="closePopupShipping">&times;</button>

    <h5>Shipping Addresses</h5>
	<div class="shipping-address-list">
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
    <br/>
	<button id="addNewShippingAddress" class="btn btn-primary">+ Add New Shipping Address</button>

</div>

<!-- Hidden Popup inside Modal -->
<div id="popupNewShippingForm" class="d-none position-relative">
    <!-- Close Button -->
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
<!-- Hidden Popup inside Modal -->
<div id="popupContentBilling" class="d-none">
	<button type="button" class="close-btn" id="closePopupBilling">&times;</button>
    <h5>Billing Addresses</h5>
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
    <button id="addNewBillingAddress" class="btn btn-primary">+ Add New Billing Address</button>
</div>

<div id="popupNewBillingForm" class="d-none">
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
            alert(document.getElementById("shipping_state").value);
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


            

            // console.log("First Name:", billingFirstName);
            // console.log("Last Name:", billingLastName);
            // console.log("Country:", billingCountry);
            // console.log("Address 1:", billingAddress1);
            // console.log("Address 2:", billingAddress2);
            // console.log("City:", billingCity);
            // console.log("State:", billingState);
            // console.log("Postcode:", billingPostcode);
            // console.log("Phone:", billingPhone);
            // console.log("Email:", billingEmail);

            $.ajax({
                type: "POST",
                url: my_ajax_object.ajax_url, // From wp_localize_script
                data: {
                    action: action, // Dynamic action for billing or shipping
                    nonce: my_ajax_object.nonce,
                    formData: formData
                },
                success: function (response) {
                    console.log(formData);
                    if (response.success) {
                        if(popupId=='popupNewBillingForm')
                        {
                            // Convert URL-encoded string to an object
                            let params = new URLSearchParams(formData);

                            // Extract values
                            let billingFirstName = params.get("billing_first_name");
                            let billingLastName = params.get("billing_last_name");
                            let billingCountry = params.get("billing_country");
                            let billingAddress1 = params.get("billing_address_1");
                            let billingAddress2 = params.get("billing_address_2");
                            let billingCity = params.get("billing_city");
                            let billingState = params.get("billing_state");
                            let billingPostcode = params.get("billing_postcode");
                            let billingPhone = params.get("billing_phone");
                            let billingEmail = params.get("billing_email");
                            // Create new list item
                            let listItem = `<li class='select-billing address_custom_li' data-billing='${JSON.stringify(params)}'>
                                ${billingFirstName} ${billingLastName}<br>
                                ${billingAddress1}<br>
                                ${billingAddress2 ? billingAddress2 + "<br>" : ""}
                                ${billingCity}, ${billingState} - ${billingPostcode}<br>
                                ${billingCountry}<br>
                                ${billingPhone ? "Phone: " + billingPhone + "<br>" : ""}
                                ${billingEmail ? "Email: " + billingEmail + "<br>" : ""}
                            </li>`;

                            $(".billing-address-list ul").append(listItem); // Append new address to the list
                            $("#popupContentShipping").fadeIn();

                        }else{
                            // Convert URL-encoded string to an object
                            let params = new URLSearchParams(formData);

                            // Extract values
                            let shippingFirstName = params.get("shipping_first_name");
                            let shippingLastName = params.get("shipping_last_name");
                            let shippingCountry = params.get("shipping_country");
                            let shippingAddress1 = params.get("shipping_address_1");
                            let shippingAddress2 = params.get("shipping_address_2");
                            let shippingCity = params.get("shipping_city");
                            let shippingState = params.get("shipping_state");
                            let shippingPostcode = params.get("shipping_postcode");
                            let shippingPhone = params.get("shipping_phone");
                            let shippingEmail = params.get("shipping_email");
                            // Create new list item
                            let listItem = `<li class='select-shipping address_custom_li' data-shipping='${JSON.stringify(params)}'>
                                ${shippingFirstName} ${shippingLastName}<br>
                                ${shippingAddress1}<br>
                                ${shippingAddress2 ? shippingAddress2 + "<br>" : ""}
                                ${shippingCity}, ${shippingState} - ${shippingPostcode}<br>
                                ${shippingCountry}<br>
                                ${shippingPhone ? "Phone: " + shippingPhone + "<br>" : ""}
                                ${shippingEmail ? "Email: " + shippingEmail + "<br>" : ""}
                            </li>`;

                            $(".shipping-address-list ul").append(listItem); // Append new address to the list
                            $("#popupContentShipping").fadeIn();
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

});

</script>
<style>
/* Styles for the popup inside the modal */
#popupContentShipping, #popupContentBilling, #popupNewBillingForm, #popupNewShippingForm {
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
button#closePopupShipping, button#closePopupBilling, button#closePopupShippingForm, button#closePopupBillingForm {
    right: 0px !important;
	top: 0px !important;
    position: fixed;
    background: #ffff !important;
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
    background: #ccc;
    padding: 10px;
    border-radius: 6px;
	
    /* border-left: 4px solid #4CAF50; */
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
}
.billing-address-section,.shipping-address-section {
    width: 43%;
    margin: 10px;
}
#newShippingForm, #newBillingForm {
    text-align: left;
}
select#shipping_country ,select#billing_country{
    max-width: 100%;
    margin-bottom: 10px;
}

</style>