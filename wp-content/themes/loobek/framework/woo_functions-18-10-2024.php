<?php 
/*** Tiny account ***/
if( !function_exists('loobek_tiny_account') ){
	function loobek_tiny_account( $show_dropdown = true ){
		$login_url = '#';
		$register_url = '#';
		$profile_url = '#';
		$logout_url = wp_logout_url(get_permalink());
		
		if( class_exists('WooCommerce') ){
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $myaccount_page_id ) {
			  $login_url = get_permalink( $myaccount_page_id );
			  $register_url = $login_url;
			  $profile_url = $login_url;
			}		
		}
		else{
			$login_url = wp_login_url();
			$register_url = wp_registration_url();
			$profile_url = admin_url( 'profile.php' );
		}
		
		$_user_logged = is_user_logged_in();
		ob_start();
		
		?>
		<div class="ts-tiny-account-wrapper">
			<div class="account-control">
				<div class="account-link">
				<?php if( !$_user_logged ): ?>
					<a class="login" href="<?php echo esc_url($login_url); ?>" title="<?php esc_attr_e('Sign in/Sign up', 'loobek'); ?>"><span><?php esc_attr_e('Sign in/Sign up', 'loobek'); ?></span></a>
				<?php else: ?>
					<a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php esc_attr_e('My Account', 'loobek'); ?>"><span><?php esc_attr_e('My Account', 'loobek'); ?></span></a>
				<?php endif; ?>
				<span class="icon-toggle"></span>
				</div>
				
				<?php if( $show_dropdown ): ?>
				<div class="account-dropdown-form dropdown-container">
					<div class="form-content">
					
						<?php if( !$_user_logged ): ?>
							<?php wp_login_form( array('form_id' => 'ts-login-form') ); ?>
							
							<a class="forget-password button-text" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('I forget the password', 'loobek'); ?></a>
							<div class="create-account-wrapper">
								<span><?php esc_html_e('I\'m new client.', 'loobek'); ?></span>
								<a class="create-account button-text" href="<?php echo esc_url($register_url); ?>"><?php esc_html_e('Create an account', 'loobek'); ?></a>
							</div>
						<?php else: ?>
						
						<ul>
							<li><a class="my-account" href="<?php echo esc_url($profile_url); ?>"><?php esc_html_e('My account', 'loobek'); ?></a></li>
							<?php
							if( function_exists('wc_get_account_endpoint_url') ){
								?>
								<li><a class="orders" href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php esc_html_e('My orders', 'loobek'); ?></a></li>
								<?php
							}
							
							$custom_links = loobek_get_theme_options('ts_tiny_account_custom_links');
							if( !empty( $custom_links ) && is_array( $custom_links ) ){
								foreach( $custom_links as $custom_link ){
									$custom_link = explode('|', $custom_link);
									if( count($custom_link) == 2 ){
										$custom_link = array_map('trim', $custom_link);
									?>
										<li><a class="custom-link" href="<?php echo esc_url($custom_link[1]); ?>"><?php echo esc_html($custom_link[0]); ?></a></li>
									<?php
									}
								}
							}
							?>
						</ul>
						<div class="link-bottom">
							<a class="log-out" href="<?php echo esc_url($logout_url); ?>"><?php esc_html_e( 'Logout', 'loobek' ); ?></a>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				
			</div>
		</div>
		
		<?php
		return ob_get_clean();
	}
}

/*** Tiny Cart ***/
if( !function_exists('loobek_tiny_cart') ){
	function loobek_tiny_cart( $show_cart_control = true, $show_cart_dropdown = true ){
		if( !class_exists('WooCommerce') ){
			return '';
		}
		$cart_empty = WC()->cart->is_empty();
		$cart_url = wc_get_cart_url();
		$checkout_url = wc_get_checkout_url();
		$cart_number = WC()->cart->get_cart_contents_count();
		
		$quantity_input = loobek_get_theme_options('ts_shopping_cart_quantity_input');
		
		ob_start();
		?>
			<div class="ts-tiny-cart-wrapper">
				<?php if( $show_cart_control ): ?>
				<a class="cart-control" href="<?php echo esc_url($cart_url); ?>" title="<?php esc_attr_e('View your shopping cart', 'loobek'); ?>">
					<span class="ic-cart"><span class="cart-number"><?php echo esc_html($cart_number) ?></span></span><span><?php esc_attr_e('in cart', 'loobek'); ?></span>
				</a>
				<?php endif; ?>
				
				<?php if( $show_cart_dropdown ): ?>
				<div class="cart-dropdown-form dropdown-container woocommerce">
					<div class="form-content <?php echo esc_attr( $cart_empty?'cart-empty':'' ); ?>">
						<?php if( $cart_empty ): ?>
							<h2 class="dropdown-title"><?php esc_html_e('Your cart (0 items)', 'loobek'); ?></h2>
							<div class="empty-content">
								<label><?php esc_html_e('Shopping Cart is empty', 'loobek'); ?></label>
								<a class="continue-shopping-button button" href="<?php echo wc_get_page_permalink('shop'); ?>"><?php esc_html_e('Continue Shopping', 'loobek'); ?></a>
							</div>
						<?php else: ?>
							<h2 class="dropdown-title"><?php echo sprintf( _n('Your cart (%d item)', 'Your cart (%d items)', $cart_number, 'loobek'), $cart_number ); ?></h2>
							<div class="cart-wrapper">
								<div class="cart-content">
									<ul class="cart_list">
										<?php 
										foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
											$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
											if ( !( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) ){
												continue;
											}
											$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
										?>
											<li class="woocommerce-mini-cart-item">
												<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-cart_item_key="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'loobek' ), $cart_item_key ), $cart_item_key ); ?>
												<a class="thumbnail" href="<?php echo esc_url($product_permalink); ?>">
													<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
												</a>
												
												<div class="cart-group-inline">
												
													<div class="cart-item-wrapper">	
														<h3 class="product-name">
															<a href="<?php echo esc_url($product_permalink); ?>">
																<?php echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key); ?>
															</a>
														</h3>
														
														<?php
														if( $quantity_input == 'no-input' ){
															echo "<div class='no-input'>";
																$product_quantity = '<span class="quantity">'.$cart_item['quantity'].'</span><span class="icon"> x </span>';
																echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );?>
															
																<span class="price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>
															
															<?php 
															echo "</div>";
														}
														else{ 
															if( $_product->is_sold_individually() ){
																$product_quantity = '<span class="quantity">1</span>';
															}else{
																$product_quantity = woocommerce_quantity_input( array(
																	'input_name'  	=> "cart[{$cart_item_key}][qty]",
																	'input_value' 	=> $cart_item['quantity'],
																	'max_value'   	=> $_product->get_max_purchase_quantity(),
																	'min_value'   	=> '0',
																	'product_name'  => $_product->get_name()
																), $_product, false );
															}
															?>

															<span class="price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>
															
															<?php
															if( $quantity_input == 'default' ){
																echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
															}
														}
														?>
													</div>
												
													<?php 
													if( $quantity_input == 'inline' ){
														echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
													}
													?>
												
												</div>
												
											</li>
										
										<?php endforeach; ?>
									</ul>
									
									<div class="dropdown-footer">
										<div class="total"><span class="total-title"><?php esc_html_e('Subtotal : ', 'loobek');?></span><?php echo WC()->cart->get_cart_subtotal(); ?></div>
										
										<a href="<?php echo esc_url($checkout_url); ?>" class="button checkout-button"><?php esc_html_e('Checkout', 'loobek'); ?></a>
										
										<div class="dropdown-footer-bottom">
											<a href="<?php echo esc_url($cart_url); ?>" class="button-text view-cart"><?php esc_html_e('View  my cart', 'loobek'); ?></a>
											<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="button-text continue-shopping"><?php esc_html_e('Continue shopping', 'loobek'); ?></a>
										</div>	
											
									</div>
									
								</div>
								
							</div>
						<?php endif; ?>
						
					</div>
				</div>
				<?php endif; ?>
			</div>
		<?php
		return ob_get_clean();
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'loobek_tiny_cart_filter');
function loobek_tiny_cart_filter($fragments){
	$cart_sidebar = loobek_get_theme_options('ts_shopping_cart_sidebar');
	$fragments['.ts-tiny-cart-wrapper'] = loobek_tiny_cart(true, !$cart_sidebar);
	if( $cart_sidebar ){
		$fragments['#ts-shopping-cart-sidebar .ts-tiny-cart-wrapper'] = loobek_tiny_cart(false, true);
	}
	return $fragments;
}

add_action('wp_ajax_loobek_update_cart_quantity', 'loobek_update_cart_quantity');
add_action('wp_ajax_nopriv_loobek_update_cart_quantity', 'loobek_update_cart_quantity');
function loobek_update_cart_quantity(){
	if( isset($_POST['cart_item_key'], $_POST['qty']) ){
		$cart_item_key = $_POST['cart_item_key'];
		$qty = $_POST['qty'];
		$cart =  WC()->cart->get_cart();
		if( isset($cart[$cart_item_key]) ){
			$qty = apply_filters( 'woocommerce_stock_amount_cart_item', wc_stock_amount( preg_replace( '/[^0-9\.]/', '', $qty ) ), $cart_item_key );
			if( !($qty === '' || $qty === $cart[$cart_item_key]['quantity']) ){
				if( !($cart[$cart_item_key]['data']->is_sold_individually() && $qty > 1) ){
					WC()->cart->set_quantity( $cart_item_key, $qty, false );
					$cart_updated = apply_filters( 'woocommerce_update_cart_action_cart_updated', true );
					if( $cart_updated ){
						WC()->cart->calculate_totals();
					}
				}
			}
		}
	}
	WC_AJAX::get_refreshed_fragments();
}

/** Tini wishlist **/
function loobek_tini_wishlist(){
	if( !(class_exists('WooCommerce') && class_exists('YITH_WCWL')) ){
		return;
	}
	
	ob_start();
	
	$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
	if( function_exists( 'wpml_object_id_filter' ) ){
		$wishlist_page_id = wpml_object_id_filter( $wishlist_page_id, 'page', true );
	}
	$wishlist_page = get_permalink( $wishlist_page_id );
	$count = yith_wcwl_count_products();
	?>
	<a title="<?php esc_attr_e('Wishlist', 'loobek'); ?>" href="<?php echo esc_url($wishlist_page); ?>" class="tini-wishlist"><span class="count-number <?php echo 0 == $count ? 'hidden' : '' ?>"><?php echo esc_html($count); ?></span><span class="title"><?php esc_html_e('Wishlist', 'loobek'); ?></span></a>
	<?php
	return ob_get_clean();
}

function loobek_update_tini_wishlist() {
	die(loobek_tini_wishlist());
}

add_action('wp_ajax_loobek_update_tini_wishlist', 'loobek_update_tini_wishlist');
add_action('wp_ajax_nopriv_loobek_update_tini_wishlist', 'loobek_update_tini_wishlist');


if( !function_exists('loobek_woocommerce_multilingual_currency_switcher') ){
	function loobek_woocommerce_multilingual_currency_switcher(){
		if( class_exists('woocommerce_wpml') && class_exists('WooCommerce') && class_exists('SitePress') ){
			global $sitepress, $woocommerce_wpml;
			
			if( !isset($woocommerce_wpml->multi_currency) ){
				return;
			}
			
			$settings = $woocommerce_wpml->get_settings();
			
			$format = !empty($settings['currency_switchers']['product']['template']) ? $settings['currency_switchers']['product']['template']:'%code%';
			$wc_currencies = get_woocommerce_currencies();
			if( !isset($settings['currencies_order']) ){
				$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
			}else{
				$currencies = $settings['currencies_order'];
			}
			
			$selected_html = '';
			foreach( $currencies as $k => $currency ){
				if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
					$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
													array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
						
					if( $currency == $woocommerce_wpml->multi_currency->get_client_currency() ){
						unset($currencies[$k]);
						$selected_html = '<a href="javascript: void(0)" class="wcml-cs-active-currency">'.$currency_format.'</a>';
						break;
					}
				}
			}
			
			echo '<div class="wcml_currency_switcher">';
				echo wp_kses( $selected_html, 'loobek_link' );
				echo '<ul>';
			
				foreach( $currencies as $currency ){
					if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
						$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
														array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
						echo '<li><a rel="' . $currency . '">' . $currency_format . '</a></li>';
					}
				}
				
				echo '</ul>';
			echo '</div>';
		}
		else if( class_exists('WOOCS') && class_exists('WooCommerce') ){ /* Support WooCommerce Currency Switcher */
			global $WOOCS;
			$currencies = $WOOCS->get_currencies();
			if( !is_array($currencies) ){
				return;
			}
			?>
			<div class="wcml_currency_switcher">
				<a href="javascript: void(0)" class="wcml-cs-active-currency"><?php echo esc_html($WOOCS->current_currency); ?></a>
				<ul>
					<?php 
					foreach( $currencies as $key => $currency ){
						$link = add_query_arg('currency', $currency['name']);
						echo '<li rel="'.$currency['name'].'"><a href="'.esc_url($link).'">'.esc_html($currency['name']).'</a></li>';
					}
					?>
				</ul>
			</div>
			<?php
		}else{
			do_action('loobek_header_currency_switcher'); /* Allow use another currency switcher */
		}
	}
}

add_filter( 'wcml_multi_currency_ajax_actions', 'loobek_wcml_multi_currency_ajax_actions_filter' );
if( !function_exists('loobek_wcml_multi_currency_ajax_actions_filter') ){
	function loobek_wcml_multi_currency_ajax_actions_filter( $actions ){
		$actions[] = 'remove_from_wishlist';
		$actions[] = 'loobek_ajax_search';
		$actions[] = 'loobek_load_quickshop_content';
		$actions[] = 'loobek_update_cart_quantity';
		$actions[] = 'loobek_load_product_added_to_cart';
		$actions[] = 'ts_get_product_content_in_category_tab';
		$actions[] = 'ts_elementor_lazy_load';
		return $actions;
	}
}

if( !function_exists('loobek_wpml_language_selector') ){
	function loobek_wpml_language_selector(){
		if( class_exists('SitePress') ){
			do_action('wpml_add_language_selector');
		}
		else{
			do_action('loobek_header_language_switcher'); /* Allow use another language switcher */
		}
	}
}