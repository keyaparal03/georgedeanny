<?php 
/*** Template Redirect ***/
add_action('template_redirect', 'loobek_template_redirect');
function loobek_template_redirect(){
	global $wp_query, $post;
	
	/* Get Page Options */
	if( is_page() || is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( is_page() ){
			$page_id = $post->ID;
		}
		if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
			$page_id = get_option('woocommerce_shop_page_id', 0);
		}
		$page_options = loobek_set_global_page_options( $page_id );
		
		if( $page_options['ts_layout_fullwidth'] != 'default' ){
			loobek_change_theme_options('ts_layout_fullwidth', $page_options['ts_layout_fullwidth']);
			if( $page_options['ts_layout_fullwidth'] ){
				loobek_change_theme_options('ts_header_layout_fullwidth', $page_options['ts_header_layout_fullwidth']);
				loobek_change_theme_options('ts_main_content_layout_fullwidth', $page_options['ts_main_content_layout_fullwidth']);
				loobek_change_theme_options('ts_footer_layout_fullwidth', $page_options['ts_footer_layout_fullwidth']);
			}
		}
		
		if( $page_options['ts_layout_style'] != 'default' ){
			loobek_change_theme_options('ts_layout_style', $page_options['ts_layout_style']);
		}
		
		if( $page_options['ts_header_layout'] != 'default' ){
			loobek_change_theme_options('ts_header_layout', $page_options['ts_header_layout']);
		}
		
		if( $page_options['ts_breadcrumb_layout'] != 'default' ){
			loobek_change_theme_options('ts_breadcrumb_layout', $page_options['ts_breadcrumb_layout']);
		}
		
		if( $page_options['ts_breadcrumb_bg_parallax'] != 'default' ){
			loobek_change_theme_options('ts_breadcrumb_bg_parallax', $page_options['ts_breadcrumb_bg_parallax']);
		}
		
		if( trim($page_options['ts_bg_breadcrumbs']) != '' ){
			loobek_change_theme_options('ts_bg_breadcrumbs', $page_options['ts_bg_breadcrumbs']);
		}
		
		if( trim($page_options['ts_logo']) != '' ){
			loobek_change_theme_options('ts_logo', $page_options['ts_logo']);
		}
		
		if( trim($page_options['ts_logo_mobile']) != '' ){
			loobek_change_theme_options('ts_logo_mobile', $page_options['ts_logo_mobile']);
		}
		
		if( trim($page_options['ts_logo_sticky']) != '' ){
			loobek_change_theme_options('ts_logo_sticky', $page_options['ts_logo_sticky']);
		}
		
		if( trim($page_options['ts_logo_transparent_header']) != '' ){
			loobek_change_theme_options('ts_logo_transparent_header', $page_options['ts_logo_transparent_header']);
		}
		
		if( $page_options['ts_menu_id'] ){
			add_filter('wp_nav_menu_args', 'loobek_filter_wp_nav_menu_args');
		}
		
		if( $page_options['ts_footer_block'] ){
			loobek_change_theme_options('ts_footer_block', $page_options['ts_footer_block']);
		}
		
		if( $page_options['ts_header_transparent'] ){
			wp_cache_set('ts_is_transparent_header', true);
			add_filter('body_class', function($classes) use ($page_options){
				$classes[] = 'header-transparent header-text-' . $page_options['ts_header_text_color'];
				return $classes;
			});
		}
	}
	
	/* Archive - Category product */
	if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') || (function_exists('dokan_is_store_page') && dokan_is_store_page()) ){
		loobek_set_header_breadcrumb_layout_woocommerce_page( 'shop' );
		
		add_action('woocommerce_before_main_content', 'loobek_remove_hooks_from_shop_loop');
		
		if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
			loobek_add_extra_elements_for_list_view();
		}
		
		/* Update product category layout */
		if( is_tax('product_cat') ){
			$term = $wp_query->queried_object;
			if( !empty($term->term_id) ){
				$bg_breadcrumbs_id = get_term_meta($term->term_id, 'bg_breadcrumbs_id', true);
				$layout = get_term_meta($term->term_id, 'layout', true);
				$left_sidebar = get_term_meta($term->term_id, 'left_sidebar', true);
				$right_sidebar = get_term_meta($term->term_id, 'right_sidebar', true);
				
				if( $bg_breadcrumbs_id != '' ){
					$bg_breadcrumbs_src = wp_get_attachment_url( $bg_breadcrumbs_id );
					if( $bg_breadcrumbs_src !== false ){
						loobek_change_theme_options('ts_bg_breadcrumbs', $bg_breadcrumbs_src);
					}
				}
				if( $layout != '' ){
					loobek_change_theme_options('ts_prod_cat_layout', $layout);
				}
				if( $left_sidebar != '' ){
					loobek_change_theme_options('ts_prod_cat_left_sidebar', $left_sidebar);
				}
				if( $right_sidebar != '' ){
					loobek_change_theme_options('ts_prod_cat_right_sidebar', $right_sidebar);
				}
			}
		}
	}
	
	/* Single post */
	if( is_singular('post') ){
		$post_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$post_data[$key] = $value[0];
			}
		}
		
		if( isset($post_data['ts_post_layout']) && $post_data['ts_post_layout'] != '0' ){
			loobek_change_theme_options('ts_blog_details_layout', $post_data['ts_post_layout']);
		}
		if( isset($post_data['ts_post_left_sidebar']) && $post_data['ts_post_left_sidebar'] != '0' ){
			loobek_change_theme_options('ts_blog_details_left_sidebar', $post_data['ts_post_left_sidebar']);
		}
		if( isset($post_data['ts_post_right_sidebar']) && $post_data['ts_post_right_sidebar'] != '0' ){
			loobek_change_theme_options('ts_blog_details_right_sidebar', $post_data['ts_post_right_sidebar']);
		}
		if( isset($post_data['ts_bg_breadcrumbs']) && $post_data['ts_bg_breadcrumbs'] != '' ){
			loobek_change_theme_options('ts_bg_breadcrumbs', $post_data['ts_bg_breadcrumbs']);
		}
	}
	
	/* Single product */
	if( is_singular('product') ){
		/* Remove hooks on Related and Up-Sell products */
		add_action('woocommerce_before_main_content', 'loobek_remove_hooks_from_shop_loop');
		
		$theme_options = loobek_get_theme_options();
	
		$prod_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$prod_data[$key] = $value[0];
			}
		}
		if( isset($prod_data['ts_prod_layout']) && $prod_data['ts_prod_layout'] != '0' ){
			loobek_change_theme_options('ts_prod_layout', $prod_data['ts_prod_layout']);
		}
		if( isset($prod_data['ts_prod_left_sidebar']) && $prod_data['ts_prod_left_sidebar'] != '0' ){
			loobek_change_theme_options('ts_prod_left_sidebar', $prod_data['ts_prod_left_sidebar']);
		}
		if( isset($prod_data['ts_prod_right_sidebar']) && $prod_data['ts_prod_right_sidebar'] != '0' ){
			loobek_change_theme_options('ts_prod_right_sidebar', $prod_data['ts_prod_right_sidebar']);
		}
		
		if( !$theme_options['ts_prod_thumbnail'] ){
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
		}
		
		if( !$theme_options['ts_prod_cat'] ){
			remove_action('woocommerce_single_product_summary', 'loobek_template_single_categories', 2);
		}
		
		if( $theme_options['ts_prod_title'] && $theme_options['ts_prod_title_in_content'] ){
			loobek_change_theme_options('ts_prod_title', 0); /* remove title above breadcrumb */
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 3);
		}
		
		if( !$theme_options['ts_prod_label'] ){
			remove_action('woocommerce_product_thumbnails', 'loobek_template_loop_product_label', 99);
		}
		
		if( !$theme_options['ts_prod_rating'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
		}
		
		if( !$theme_options['ts_prod_availability'] ){
			remove_action('woocommerce_single_product_summary', 'loobek_template_single_availability', 15);
		}
		
		if( !$theme_options['ts_prod_brand'] ){
			remove_action('woocommerce_single_product_summary', 'loobek_template_single_brand', 8);
		}
		
		if( !$theme_options['ts_prod_sku'] ){
			remove_action('woocommerce_single_product_summary', 'loobek_template_single_sku', 10);
		}
		
		if( !$theme_options['ts_prod_price'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 24);
			remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
		}
		
		if( !$theme_options['ts_prod_short_desc'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 29);
		}
		elseif( $theme_options['ts_prod_short_desc_position'] == 'above-price' ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 29);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 22);
		}
		
		if( !$theme_options['ts_prod_add_to_cart'] || $theme_options['ts_enable_catalog_mode'] ){
			$terms        = get_the_terms( $post->ID, 'product_type' );
			$product_type = ! empty( $terms ) ? sanitize_title( current( $terms )->name ) : 'simple';
			if( $product_type != 'variable' ){
				remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			}
			else{
				remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
			}
		}
		
		if( $theme_options['ts_prod_tag'] && $theme_options['ts_prod_tag_color_style'] ){
			$priority = $theme_options['ts_prod_tag_position'] == 'above-price' ? 20 : 28;
			add_action('woocommerce_single_product_summary', 'loobek_template_single_product_tag_color_style', $priority);
		}
		
		if( $theme_options['ts_prod_tabs_position'] == 'inside_summary' ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
			if( $theme_options['ts_prod_summary_scrolling'] ){
				add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 2);
			}
			else{
				add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 80);
			}
		}
		
		if( !$theme_options['ts_prod_upsells'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
		}
		
		if( !$theme_options['ts_prod_related'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		}
		elseif( $theme_options['ts_prod_related_position'] == 'above-tabs' ){
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 9 );
		}
		
		/* Breadcrumb */
		if( isset($prod_data['ts_bg_breadcrumbs']) && $prod_data['ts_bg_breadcrumbs'] != '' ){
			loobek_change_theme_options('ts_bg_breadcrumbs', $prod_data['ts_bg_breadcrumbs']);
		}
		
		/* Bottom Summary Content */
		if( !empty($prod_data['ts_prod_bottom_summary_content']) ){
			loobek_change_theme_options('ts_prod_bottom_summary_content', $prod_data['ts_prod_bottom_summary_content']);
		}
		
		/* Custom Content */
		if( !empty($prod_data['ts_prod_custom_content']) ){
			loobek_change_theme_options('ts_prod_custom_content', $prod_data['ts_prod_custom_content']);
		}
		
		if( $theme_options['ts_prod_custom_content_position'] != 'above-tabs' ){
			remove_action('woocommerce_after_single_product_summary', 'loobek_product_custom_content', 9);
			
			if( $theme_options['ts_prod_custom_content_position'] == 'bottom' ){
				add_action('woocommerce_after_single_product_summary', 'loobek_product_custom_content', 99);
			}
			else{
				$priority = 11;
				if( $theme_options['ts_prod_tabs_position'] == 'inside_summary' && !$theme_options['ts_prod_image_summary_limited_width'] ){
					$priority = 2;
				}
				add_action( 'woocommerce_after_single_product_summary', 'loobek_product_custom_content', $priority );
			}
		}
		elseif( $theme_options['ts_prod_tabs_position'] == 'inside_summary' ){
			remove_action('woocommerce_after_single_product_summary', 'loobek_product_custom_content', 9);
			add_action( 'woocommerce_after_single_product_summary', 'loobek_product_custom_content', 1 );
		}
		
		/* Frequently Bought Together */
		if( ( $theme_options['ts_prod_thumbnail_layout'] == 'slider-3-col' || $theme_options['ts_prod_image_summary_limited_width'] ) && function_exists('YITH_WFBT_Frontend') ){
			$wfbt_instance = YITH_WFBT_Frontend();
			
			remove_action( 'woocommerce_after_single_product_summary', array( $wfbt_instance, 'add_bought_together_form' ), 1 );
			add_action( 'woocommerce_after_single_product_summary', array( $wfbt_instance, 'add_bought_together_form' ), 5 );
		}
		
		/* Reviews tab */
		if( $theme_options['ts_prod_separate_reviews_tab'] && comments_open() ){
			if( $theme_options['ts_prod_reviews_tab_position'] == 'after_summary' ){
				add_action('woocommerce_after_single_product_summary', 'comments_template', 12);
			}
			else{
				add_action('woocommerce_single_product_summary', 'comments_template', 76);
			}
		}
		
		/* Add extra classes to post */
		add_action('woocommerce_before_single_product', 'loobek_woocommerce_before_single_product');
	}
	
	/* WooCommerce - Other pages */
	if( class_exists('WooCommerce') ){
		if( is_cart() ){
			loobek_set_header_breadcrumb_layout_woocommerce_page( 'cart' );
			
			add_action('woocommerce_before_cart', 'loobek_remove_hooks_from_shop_loop');
		}
		
		if( is_checkout() ){
			loobek_set_header_breadcrumb_layout_woocommerce_page( 'checkout' );
		}
		
		if( is_account_page() ){
			loobek_set_header_breadcrumb_layout_woocommerce_page( 'myaccount' );
		}
	}

	/* Header Cart - Wishlist */
	if( !class_exists('WooCommerce') ){
		loobek_change_theme_options('ts_enable_tiny_shopping_cart', 0);
	}
	
	if( !class_exists('WooCommerce') || !class_exists('YITH_WCWL') ){
		loobek_change_theme_options('ts_enable_tiny_wishlist', 0);
	}
	
	/* Right to left */
	if( is_rtl() ){
		loobek_change_theme_options('ts_enable_rtl', 1);
	}
	
	/* Remove background image if not necessary */
	$load_bg = true;
	if( loobek_get_theme_options('ts_layout_fullwidth') ){
		$load_bg = false;
	}
	if( is_page() && $load_bg && $layout_style = loobek_get_page_options('ts_layout_style') ){
		if( $layout_style == 'wide' || ( $layout_style == 'default' && loobek_get_theme_options('ts_layout_style') == 'wide' ) ){
			$load_bg = false;
		}
	}
	
	if( !$load_bg ){
		add_filter('theme_mod_background_image', '__return_empty_string');
	}
}

function loobek_filter_wp_nav_menu_args( $args ){
	global $post;
	if( is_page() && !is_admin() && !empty($args['theme_location']) ){
		if( $args['theme_location'] == 'primary' ){
			$menu = get_post_meta($post->ID, 'ts_menu_id', true);
			if( $menu ){
				$args['menu'] = $menu;
			}
		}
	}
	return $args;
}

function loobek_remove_hooks_from_shop_loop(){
	$theme_options = loobek_get_theme_options();
	
	if( ! $theme_options['ts_prod_cat_thumbnail'] ){
		remove_action('woocommerce_before_shop_loop_item_title', 'loobek_template_loop_product_thumbnail', 10);
	}
	if( ! $theme_options['ts_prod_cat_label'] ){
		remove_action('woocommerce_after_shop_loop_item_title', 'loobek_template_loop_product_label', 1);
	}
	
	if( ! $theme_options['ts_prod_cat_cat'] ){
		remove_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_categories', 10);
	}
	if( ! $theme_options['ts_prod_cat_title'] ){
		remove_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_product_title', 20);
	}
	if( ! $theme_options['ts_prod_cat_price'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 30);
	}
	if( ! $theme_options['ts_prod_cat_desc'] ){
		remove_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_short_description', 50);
	}
	if( ! $theme_options['ts_prod_cat_rating'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 60);
	}
	if( ! $theme_options['ts_prod_cat_sku'] ){
		remove_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_product_sku', 65);
	}
	if( ! $theme_options['ts_prod_cat_add_to_cart'] ){
		remove_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_add_to_cart', 70); 
		remove_action('woocommerce_after_shop_loop_item_title', 'loobek_template_loop_add_to_cart', 10004 );
	}
	
	if( $theme_options['ts_prod_cat_gallery'] ){
		$gallery_position = $theme_options['ts_prod_cat_gallery_position'] == 'bottom' ? 66 : 1;
		add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_product_gallery', $gallery_position);
		$number_galleries = (int) $theme_options['ts_prod_cat_number_gallery'];
		add_filter('loobek_loop_product_gallery_number', function() use ($number_galleries){
			return $number_galleries;
		});
	}
	
	if( $theme_options['ts_prod_cat_color_swatch'] ){
		add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_product_variable_color', 40);
		$number_color_swatch = absint( $theme_options['ts_prod_cat_number_color_swatch'] );
		add_filter('loobek_loop_product_variable_color_number', function() use ($number_color_swatch){
			return $number_color_swatch;
		});
	}
	
	if( in_array( $theme_options['ts_prod_cat_loading_type'], array('infinity-scroll', 'load-more-button') ) ){
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		loobek_change_theme_options('ts_prod_cat_per_page_dropdown', 0);
	}
}

function loobek_set_header_breadcrumb_layout_woocommerce_page( $page = 'shop' ){
	/* Header Layout */
	$header_layout = get_post_meta(wc_get_page_id( $page ), 'ts_header_layout', true);
	if( $header_layout != 'default' && $header_layout != '' ){
		loobek_change_theme_options('ts_header_layout', $header_layout);
	}
	
	/* Breadcrumb Layout */
	$breadcrumb_layout = get_post_meta(wc_get_page_id( $page ), 'ts_breadcrumb_layout', true);
	if( $breadcrumb_layout != 'default' && $breadcrumb_layout != '' ){
		loobek_change_theme_options('ts_breadcrumb_layout', $breadcrumb_layout);
	}
}

function loobek_add_extra_elements_for_list_view(){
	$theme_options = loobek_get_theme_options();
	
	if( !$theme_options['ts_prod_cat_columns_selector'] && !in_array( $theme_options['ts_prod_cat_columns'], array('1', '1-1', '2') ) ){
		return;
	}
	
	add_action('woocommerce_after_shop_loop_item', 'loobek_product_group_button_price_meta_start', 67);
	add_action('woocommerce_after_shop_loop_item', 'loobek_product_group_button_price_meta_end', 82);
	
	if( $theme_options['ts_prod_cat_price'] ){
		add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 68);
	}
	
	if( $theme_options['ts_prod_cat_quantity_input'] && $theme_options['ts_prod_cat_add_to_cart'] && !$theme_options['ts_enable_catalog_mode'] ){
		add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_quantity', 69);
	}
	
	$hidden_selectors = array();
	$list_1_base_selector = '.main-products.columns-1 ';
	$list_2_base_selector = '.main-products.columns-2 ';
	$grid_base_selector = '.main-products:not(.columns-1):not(.columns-2) ';
	
	$keys_selectors = array(
		'ts_prod_cat_desc'		=> '.short-description'
		,'ts_prod_cat_cat'		=> '.product-categories'
		,'ts_prod_cat_rating'	=> '.star-rating-wrapper'
	);
	
	$old_theme_options = array();
	
	foreach( $keys_selectors as $key => $selector ){
		$old_theme_options[$key] = $theme_options[$key];
		
		if( !$theme_options[$key] ){
			$hidden_selectors[] = $grid_base_selector . $selector;
		}
		
		if( $theme_options[$key.'_list_view'] ){
			loobek_change_theme_options($key, true); /* add html */
		}
		else{
			$hidden_selectors[] = $list_1_base_selector . $selector;
			$hidden_selectors[] = $list_2_base_selector . $selector;
		}
	}
	
	/* Rating */
	if( $theme_options['ts_prod_cat_rating_list_view'] ){
		add_filter('loobek_loop_rating_list_view_empty_rating', '__return_true');
		add_filter('loobek_loop_rating_list_view_html', 'loobek_loop_rating_list_view');
		
		$hidden_selectors[] = $list_1_base_selector . '.star-rating-wrapper .count-rating';
		$hidden_selectors[] = $list_2_base_selector . '.star-rating-wrapper .count-rating';
		$hidden_selectors[] = $grid_base_selector . '.star-rating-wrapper .list-view-rating';
		$hidden_selectors[] = $grid_base_selector . '.star-rating-wrapper.no-rating';
	}

	$hidden_selectors = implode(', ', $hidden_selectors);
	add_action('wp_enqueue_scripts', function() use ($hidden_selectors){
		wp_add_inline_style( 'loobek-style', $hidden_selectors . '{display: none}');
	}, 99999);
	
	add_action('woocommerce_after_main_content', function() use ($old_theme_options){ /* restore hooks */
		remove_filter('loobek_loop_rating_list_view_empty_rating', '__return_true');
		remove_filter('loobek_loop_rating_list_view_html', 'loobek_loop_rating_list_view');
		
		remove_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_quantity', 69);
		foreach( $old_theme_options as $key => $value ){
			loobek_change_theme_options($key, $value);
		}
		loobek_remove_hooks_from_shop_loop();
	});
}

function loobek_loop_rating_list_view(){
	global $product;
	$count = $product->get_review_count();
	echo '<div class="list-view-rating">';
	echo '<span>' . sprintf( _n('%d Review', '%d Reviews', $count, 'loobek'), $count ) . '</span>';
	
	if( comments_open( $product->get_id() ) ){
		$review_link = trailingslashit( $product->get_permalink() ) . '#reviews';
	?>
		<a href="<?php echo esc_url($review_link); ?>" class="woocommerce-review-link" rel="nofollow"><?php esc_html_e( 'Write a review', 'loobek' ); ?></a>
	<?php
	}
	echo '</div>';
}

function loobek_product_group_button_price_meta_start(){
	echo '<div class="product-group-button-price">';
}

function loobek_product_group_button_price_meta_end(){
	echo '</div>';
}

function loobek_template_loop_quantity(){
	global $product;
	if( !$product->is_sold_individually() && $product->get_type() != 'variable' && $product->is_purchasable() && $product->is_in_stock() ){
		woocommerce_quantity_input(
							array(
								'max_value'     => $product->get_max_purchase_quantity()
								,'min_value'    => '1'
								,'product_name' => ''
							)
						);
	}
}

function loobek_woocommerce_before_single_product(){
	add_filter('post_class', 'loobek_single_product_post_class_filter');
}

function loobek_single_product_post_class_filter( $classes ){
	global $product;
	
	$theme_options = loobek_get_theme_options();
	
	if( $theme_options['ts_prod_image_summary_limited_width'] ){
		$classes[] = 'image-summary-limited-width';
	}
	
	if( class_exists( 'YITH_WFBT_Frontend' ) ){
		$product_ids = get_post_meta( $product->get_id(), '_yith_wfbt_ids', true );
		if( !empty($product_ids) ){
			if( defined( 'YITH_WFBT_PREMIUM' ) ){ 
				$classes[] = 'wfbt-pro';
			}
			$classes[] = 'bought-together-style-' . $theme_options['ts_prod_bought_together_style'];
			if( $theme_options['ts_prod_bought_together_style'] == 'small' ){
				if( $theme_options['ts_prod_thumbnail_layout'] == 'slider-3-col' || $theme_options['ts_prod_image_summary_limited_width'] ){
					$classes[] = 'wfbt-loading bought-together-layout-horizontal';
				}
				else{
					$classes[] = 'wfbt-loading bought-together-layout-' . $theme_options['ts_prod_frequently_bought_together_layout'];
				}
			}
			if( $theme_options['ts_frequently_bought_together_border_style'] ){
				$classes[] = 'bought-together-border-' . $theme_options['ts_frequently_bought_together_border_style'];
			}
			if( $theme_options['ts_frequently_bought_together_items_style'] ){
				$classes[] = 'bought-together-items-style-' . $theme_options['ts_frequently_bought_together_items_style'];
			}
		}
	}
	
	if( $theme_options['ts_prod_summary_scrolling'] && $theme_options['ts_prod_thumbnail_layout'] != 'slider-3-col'){
		$classes[] = 'summary-scrolling';
		if( $theme_options['ts_prod_summary_scrolling_border'] ){
			$classes[] = 'summary-scrolling-border';
		}
	}
	
	if( $theme_options['ts_prod_heading_style'] == 'center' ){
		$classes[] = 'heading-style-center';
	}
	
	$classes[] = 'thumbnail-layout-' . $theme_options['ts_prod_thumbnail_layout'];
	
	if( $theme_options['ts_prod_tabs_show_content_default'] ){
		$classes[] = 'show-tabs-content-default';
	}
	
	if( $theme_options['ts_prod_tabs_position'] == 'inside_summary' ){
		$classes[] = 'tab-inside-summary';
	}
	
	if( !$theme_options['ts_prod_add_to_cart'] || $theme_options['ts_enable_catalog_mode'] ){
		$classes[] = 'no-addtocart';
	}
	
	if( !$theme_options['ts_prod_thumbnail'] ){
		$classes[] = 'no-product-thumbnail';
	}
	
	if( $theme_options['ts_prod_sharing'] && $theme_options['ts_prod_sharing_sticky'] && !$theme_options['ts_prod_sharing_sharethis'] ){
		$classes[] = 'social-sharing-sticky';
	}
	
	if( $product->get_type() == 'simple' ){
		$stock_quantity = $product->get_stock_quantity();
		if( is_numeric($stock_quantity) && $stock_quantity == 1 ){
			$classes[] = 'only-one-in-stock';
		}
	}
	
	if( $product->get_type() == 'grouped' && $theme_options['ts_prod_grouped_product_checkbox_style'] ){
		$classes[] = 'grouped-checkbox-style';
	}
	
	if( $theme_options['ts_prod_tabs_heading_style'] ){
		$classes[] = 'tabs-heading-' . $theme_options['ts_prod_tabs_heading_style'];
	}
	if( $theme_options['ts_prod_reviews_tab_position'] == 'inside_summary' ){
		$classes[] = 'tabs-inside-summary';
	}
	
	if( $theme_options['ts_prod_tabs_accordion'] && !$theme_options['ts_prod_tabs_show_content_default'] ){
		if( $theme_options['ts_prod_tabs_accordion'] == 'both' || 
			( $theme_options['ts_prod_tabs_accordion'] == 'desktop' && !wp_is_mobile() ) ||
			( $theme_options['ts_prod_tabs_accordion'] == 'mobile' && wp_is_mobile() )
		){
			$classes[] = 'tabs-accordion';
			loobek_change_theme_options('ts_prod_more_less_content', 0);
		}
	}
	
	if( $theme_options['ts_prod_separate_reviews_tab'] && $theme_options['ts_prod_collapse_reviews_tab'] && class_exists('VI_Woo_Photo_Reviews') ){
		$classes[] = 'collapse-reviews-tab';
		if( $theme_options['ts_prod_reviews_tab_position'] == 'inside_summary' ){
			$classes[] = 'reviews-inside-summary';
		}
	}
	
	$classes[] = 'related-up-sell-style-' . $theme_options['ts_related_up_sell_style'];
	
	if( $theme_options['ts_prod_related'] && $theme_options['ts_prod_related_position'] == 'above-tabs' ){
		$classes[] = 'related-above-tab';
	}
	
	remove_filter('post_class', 'loobek_single_product_post_class_filter');
	return $classes;
}
?>