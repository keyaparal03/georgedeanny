<?php
/*************************************************
* WooCommerce Custom Hook                        *
**************************************************/

/*** Shop - Category ***/

/* Remove hook */
function loobek_woocommerce_remove_shop_loop_default_hooks(){
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

	remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

	remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

	remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
	remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);
}
loobek_woocommerce_remove_shop_loop_default_hooks();

add_action('load-post.php', 'loobek_woocommerce_remove_shop_loop_default_hooks', 20); /* Fix: Elementor editor - WooCommerce 8.4.0 */

/* Add new hook */

add_action('woocommerce_before_shop_loop_item_title', 'loobek_template_loop_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item_title', 'loobek_template_loop_product_label', 1);

add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_brands', 5);
add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_categories', 10);
add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_product_title', 20);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 30);
add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_short_description', 50);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 60);
add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_product_sku', 65);
add_action('woocommerce_after_shop_loop_item', 'loobek_template_loop_add_to_cart', 70);

add_action('woocommerce_archive_description', 'loobek_shop_category_description', 20);

add_action('woocommerce_before_shop_loop', 'loobek_product_per_page_form', 40);
add_action('woocommerce_before_shop_loop', 'loobek_add_filter_button', 70);
add_action('woocommerce_before_shop_loop', 'loobek_product_on_sale_form', 15);
add_action('woocommerce_before_shop_loop', 'loobek_product_columns_selector', 10);
add_filter('loop_shop_per_page', 'loobek_change_products_per_page_shop' ); 

add_filter('loop_shop_post_in', 'loobek_show_only_products_on_sales');

add_action('woocommerce_after_shop_loop', 'loobek_shop_load_more_html', 20);

add_filter('woocommerce_get_stock_html', 'loobek_empty_woocommerce_stock_html', 10, 2);

add_filter('woocommerce_before_output_product_categories', 'loobek_before_output_product_categories');
add_filter('woocommerce_after_output_product_categories', 'loobek_after_output_product_categories');

add_filter('woocommerce_post_class', 'loobek_woocommerce_post_class', 10, 2);
function loobek_woocommerce_post_class( $classes, $product ){
	if( loobek_get_theme_options('ts_variable_product_quick_add_to_cart') && $product->is_type( 'variable' ) ){
		$variation_attributes = $product->get_variation_attributes();
		if( !empty($variation_attributes) && count($variation_attributes) == 1 ){
			loobek_quick_add_to_cart_add_product_id( $product->get_id() );
			$classes[] = 'variable-quick-add-to-cart';
		}
	}
	
	return $classes;
}

function loobek_quick_add_to_cart_add_product_id( $product_id ){
	global $loobek_quick_add_to_cart_product_id;
	if( !is_array( $loobek_quick_add_to_cart_product_id ) ){
		$loobek_quick_add_to_cart_product_id = array();
	}
	$loobek_quick_add_to_cart_product_id[] = $product_id;
}

function loobek_quick_add_to_cart_product_enabled( $product_id ){
	global $loobek_quick_add_to_cart_product_id;
	if( is_array($loobek_quick_add_to_cart_product_id) && in_array($product_id, $loobek_quick_add_to_cart_product_id) ){
		return true;
	}
	return false;
}

add_action('woocommerce_no_products_found', 'loobek_reset_filters_button', 20);

function loobek_reset_filters_button(){
	if( function_exists('is_filtered') && is_filtered() ){
		if( defined( 'SHOP_IS_ON_FRONT' ) ){
			$link = home_url();
		}elseif( is_shop() ){
			$link = get_permalink( wc_get_page_id( 'shop' ) );
		}elseif( is_product_category() ){
			$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
		}elseif( is_product_tag() ){
			$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
		}else{
			$queried_object = get_queried_object();
			$link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
		}
	?>
		<div class="reset-filters"><a href="<?php echo esc_url( $link ); ?>" class="button reset-filters-button"><?php esc_html_e('Reset filters', 'loobek'); ?></a></div>
	<?php
	}
}

add_filter('woocommerce_pagination_args', 'loobek_woocommerce_pagination_args');
function loobek_woocommerce_pagination_args( $args ){
	$args['prev_text'] = esc_html__('Prev page', 'loobek');
	$args['next_text'] = esc_html__('Next page', 'loobek');
	return $args;
}

/* Sort by best selling */
add_filter( 'woocommerce_default_catalog_orderby_options', 'loobek_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'loobek_woocommerce_catalog_orderby' );
function loobek_woocommerce_catalog_orderby( $sortby ){
	$sortby['best_selling'] = esc_html__('Sort by best selling', 'loobek');
	return $sortby;
}

add_filter( 'woocommerce_get_catalog_ordering_args', 'loobek_woocommerce_get_catalog_ordering_args', 10, 2 );
function loobek_woocommerce_get_catalog_ordering_args( $args, $orderby ){
	if ( 'best_selling' == $orderby ){
		$args['meta_key'] 	= 'total_sales';
		$args['orderby'] 	= 'meta_value_num';
		$args['order'] 		= 'desc';
	}
	return $args;
}

function loobek_shop_recommended_products(){
	$theme_options = loobek_get_theme_options();
	if( !$theme_options['ts_prod_cat_recommended_products'] ){
		return;
	}
	
	if( is_search() ){
		return;
	}
	
	if( !is_post_type_archive( 'product' ) && !is_product_category() ){
		return;
	}
	
	if( is_paged() && $theme_options['ts_prod_cat_loading_type'] != 'default' ){
		return;
	}
	
	$total_products = wc_get_loop_prop( 'total', 0 );
	$limit = absint($theme_options['ts_prod_cat_recommended_products_limit']);
	if( $total_products < $limit * 2 ){
		return;
	}
	
	$args = array(
		'post_type'				=> 'product'
		,'post_status' 			=> 'publish'
		,'posts_per_page' 		=> $limit
		,'meta_query' 			=> WC()->query->get_meta_query()
		,'tax_query'           	=> WC()->query->get_tax_query()
	);
	
	switch( $theme_options['ts_prod_cat_recommended_products_product_type'] ){
		case 'best_selling':
			$args['meta_key'] 	= 'total_sales';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'desc';
		break;
		case 'top_rated':
			$args['meta_key'] 	= '_wc_average_rating';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'desc';
		break;
		case 'featured':
			$args['tax_query'][] = array(
				'taxonomy' 	=> 'product_visibility'
				,'field'    => 'name'
				,'terms'    => 'featured'
				,'operator' => 'IN'
			);
		break;
		case 'sale':
			$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		break;
	}
	
	if( is_product_category() ){
		$term = get_queried_object();
		if( $term ){
			$product_cats = array( $term->term_id );
	
			$term_children = get_term_children( $term->term_id, 'product_cat' );
			if( is_array( $term_children ) && count( $term_children ) > 0 ){
				$product_cats = array_merge( $product_cats, $term_children );
			}
			
			$args['tax_query'][] = array(
								'taxonomy' 	=> 'product_cat'
								,'terms' 	=> $product_cats
								,'field' 	=> 'term_id'
							);
		}
	}
	
	$products = new WP_Query( $args );
	if( !$products->have_posts() ){
		return;
	}
	
	wc_set_loop_prop( 'is_shortcode', true );
	
	$columns = absint($theme_options['ts_prod_cat_recommended_products_columns']);
	
	?>
	<div class="ts-product-wrapper ts-shortcode ts-product rows-1 woocommerce ts-slider show-nav nav-middle middle-thumbnail shop-recommended-products columns-<?php echo esc_attr($columns); ?>" data-nav="1" data-columns="<?php echo esc_attr($columns); ?>">
		<header class="shortcode-heading-wrapper">
			<h2 class="shortcode-title"><?php esc_html_e('Recommended for you', 'loobek'); ?></h2>
		</header>
		
		<div class="content-wrapper loading">
			<?php
			woocommerce_product_loop_start();
			while( $products->have_posts() ){ 
				$products->the_post();	
				wc_get_template_part( 'content', 'product' );
			}
			woocommerce_product_loop_end();
			?>
		</div>
	</div>
	<?php
	
	wc_set_loop_prop( 'is_shortcode', false );
	
	wp_reset_postdata();
}

function loobek_shop_category_description(){
	static $is_showed_description = false;
	if( $is_showed_description ){
		return;
	}
	$is_showed_description = true;
	
	$reset_product_hooks = false;
	
	$shop_description = loobek_get_theme_options('ts_shop_description');
	
	if( $shop_description && !is_search() && is_post_type_archive( 'product' ) && in_array( absint( get_query_var( 'paged' ) ), array( 0, 1 ), true ) ){
		echo '<div class="page-description ts-custom-block-content hidden">';
			loobek_get_custom_block_content( $shop_description );
		echo '</div>';
		
		$reset_product_hooks = true;
	}
	
	if( is_product_category() && 0 === absint( get_query_var( 'paged' ) ) ){
		$term = get_queried_object();
		if( $term ){
			$category_description = get_term_meta($term->term_id, 'description_2', true);
			if( $category_description ){
				echo '<div class="term-description ts-custom-block-content hidden">';
					loobek_get_custom_block_content( $category_description );
				echo '</div>';
				
				$reset_product_hooks = true;
			}
		}
	}
	
	if( $reset_product_hooks ){
		loobek_remove_hooks_from_shop_loop();
	}
}

function loobek_shop_category_bottom_content(){
	loobek_shop_recommended_products();
	
	$shop_description = loobek_get_theme_options('ts_shop_bottom_description');
	if( $shop_description && !is_search() && is_post_type_archive( 'product' ) && in_array( absint( get_query_var( 'paged' ) ), array( 0, 1 ), true ) ){
		echo '<div class="page-description bottom-description ts-custom-block-content hidden">';
			loobek_get_custom_block_content( $shop_description );
		echo '</div>';
	}
	
	if( is_product_category() && 0 === absint( get_query_var( 'paged' ) ) ){
		$term = get_queried_object();
		if( $term ){
			$category_description = get_term_meta($term->term_id, 'bottom_description', true);
			if( $category_description ){
				echo '<div class="term-description bottom-description ts-custom-block-content hidden">';
					loobek_get_custom_block_content( $category_description );
				echo '</div>';
			}
		}
	}
}

add_action('init', 'loobek_check_product_lazy_load');
function loobek_check_product_lazy_load(){
	if( wp_doing_ajax() || ( isset($_GET['action']) && $_GET['action'] == 'elementor' ) ){
		loobek_change_theme_options('ts_prod_lazy_load', 0);
	}
}

function loobek_template_loop_product_label(){
	global $product;
	$theme_options = loobek_get_theme_options();
	?>
	<div class="product-label">
	<?php 
	if( $product->is_in_stock() ){
		/* New label */
		if( $theme_options['ts_product_show_new_label'] ){
			$now = current_time( 'timestamp', true );
			$post_date = get_post_time('U', true);
			$num_day = (int)( ( $now - $post_date ) / ( 3600*24 ) );
			$num_day_setting = absint( $theme_options['ts_product_show_new_label_time'] );
			if( $num_day <= $num_day_setting ){
				echo '<span class="new">'.esc_html($theme_options['ts_product_new_label_text']).'</span>';
			}
		}
		
		/* Sale label */
		if( $product->is_on_sale() ){
			if( $theme_options['ts_show_sale_label_as'] != 'text' ){
				if( $product->get_type() == 'variable' ){
					$regular_price = $product->get_variation_regular_price('max');
					$sale_price = $product->get_variation_sale_price('min');
				}
				else{
					$regular_price = $product->get_regular_price();
					$sale_price = $product->get_price();
				}
				if( $regular_price ){
					if( $theme_options['ts_show_sale_label_as'] == 'number' ){
						$_off_price = round($regular_price - $sale_price, wc_get_price_decimals());
						$price_display = '-' . sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $_off_price);
						echo '<span class="onsale amount" data-original="'.$price_display.'">'.$price_display.'</span>';
					}
					if( $theme_options['ts_show_sale_label_as'] == 'percent' ){
						echo '<span class="onsale percent">-'.loobek_calc_discount_percent($regular_price, $sale_price).'%</span>';
					}
				}
			}
			else{
				echo '<span class="onsale">'.esc_html($theme_options['ts_product_sale_label_text']).'</span>';
			}
		}
		
		/* Hot label */
		if( $product->is_featured() ){
			echo '<span class="featured">'.esc_html($theme_options['ts_product_feature_label_text']).'</span>';
		}
	}
	else{ /* Out of stock */
		echo '<span class="out-of-stock">'.esc_html($theme_options['ts_product_out_of_stock_label_text']).'</span>';
	}
	?>
	</div>
	<?php
}

function loobek_template_loop_product_thumbnail(){
	global $product;
	$lazy_load = loobek_get_theme_options('ts_prod_lazy_load');
	$placeholder_img_src = loobek_get_theme_options('ts_prod_placeholder_img')['url'];
	
	$prod_galleries = $product->get_gallery_image_ids();
	
	$image_size = apply_filters('loobek_loop_product_thumbnail', 'woocommerce_thumbnail');
	
	$dimensions = wc_get_image_size( $image_size );
	
	$has_back_image = loobek_get_theme_options('ts_effect_product');
	
	if( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 ) ){
		$has_back_image = false;
	}
	 
	if( wp_is_mobile() ){
		$has_back_image = false;
	}
	
	echo '<figure class="' . ($has_back_image?'has-back-image':'no-back-image') . '">';
		if( !$lazy_load ){
			echo woocommerce_get_product_thumbnail( $image_size );
			
			if( $has_back_image ){
				echo wp_get_attachment_image( $prod_galleries[0], $image_size, 0, array('class' => 'product-image-back') );
			}
		}
		else{
			$front_img_src = '';
			$alt = '';
			if( has_post_thumbnail( $product->get_id() ) ){
				$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
				$image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
				if( isset($image_obj[0]) ){
					$front_img_src = $image_obj[0];
				}
				$alt = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
			}
			else{
				$front_img_src = wc_placeholder_img_src();
			}
			
			echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($front_img_src).'" class="attachment-shop_catalog wp-post-image ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
		
			if( $has_back_image ){
				$back_img_src = '';
				$alt = '';
				$image_obj = wp_get_attachment_image_src($prod_galleries[0], $image_size, 0);
				if( isset($image_obj[0]) ){
					$back_img_src = $image_obj[0];
					$alt = trim(strip_tags( get_post_meta($prod_galleries[0], '_wp_attachment_image_alt', true) ));
				}
				else{
					$back_img_src = wc_placeholder_img_src();
				}
				
				echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($back_img_src).'" class="product-image-back ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
			}
		}
	echo '</figure>';
}

function loobek_template_loop_product_variable_color(){
	global $product;
	if( $product->get_type() == 'variable' ){
		$attribute_color = wc_attribute_taxonomy_name( 'color' ); // pa_color
		$attribute_color_name = wc_variation_attribute_name( $attribute_color ); // attribute_pa_color
		
		$color_terms = wc_get_product_terms( $product->get_id(), $attribute_color, array( 'fields' => 'all' ) );
		if( empty($color_terms) || is_wp_error($color_terms) ){
			return;
		}
		$color_term_ids = wp_list_pluck( $color_terms, 'term_id' );
		$color_term_slugs = wp_list_pluck( $color_terms, 'slug' );
		
		$color_html = array();
		$price_html = array();
		
		$added_colors = array();
		$count = 0;
		$number = apply_filters('loobek_loop_product_variable_color_number', 3);
		
		$children = $product->get_children();
		if( is_array($children) && count($children) > 0 ){
			foreach( $children as $children_id ){
				$variation_attributes = wc_get_product_variation_attributes( $children_id );
				foreach( $variation_attributes as $attribute_name => $attribute_value ){
					if( $attribute_name == $attribute_color_name ){
						if( in_array($attribute_value, $added_colors) ){
							break;
						}
						
						$term_id = 0;
						$found_slug = array_search($attribute_value, $color_term_slugs);
						if( $found_slug !== false ){
							$term_id = $color_term_ids[ $found_slug ];
						}
						
						if( $term_id !== false && absint( $term_id ) > 0 ){
							$thumbnail_id = get_post_meta( $children_id, '_thumbnail_id', true );
							if( $thumbnail_id ){
								$image_src = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail');
								if( $image_src ){
									$thumbnail = $image_src[0];
								}
								else{
									$thumbnail = wc_placeholder_img_src();
								}
							}
							else{
								$thumbnail = wc_placeholder_img_src();
							}
							
							$color_datas = get_term_meta( $term_id, 'ts_product_color_config', true );
							if( $color_datas ){
								$color_datas = unserialize( $color_datas );	
							}else{
								$color_datas = array('ts_color_color' => '#ffffff', 'ts_color_image' => 0);
							}
							$color_datas['ts_color_image'] = absint($color_datas['ts_color_image']);
							if( $color_datas['ts_color_image'] ){
								$color_html[] = '<div class="color-image" data-thumb="'.$thumbnail.'" data-term_id="'.$term_id.'"><span>'.wp_get_attachment_image( $color_datas['ts_color_image'], 'ts_prod_color_thumb', true, array('alt' => $attribute_value) ).'</span></div>';
							}
							else{
								$color_html[] = '<div class="color" data-thumb="'.$thumbnail.'" data-term_id="'.$term_id.'"><span style="background-color: '.$color_datas['ts_color_color'].' ;border-color:' . $color_datas['ts_color_color'].'"></span></div>';
							}
							$variation = wc_get_product( $children_id );
							$price_html[] = '<span class="price hidden-price" data-term_id="'.$term_id.'">' . $variation->get_price_html() . '</span>';
							$count++;
						}
						
						$added_colors[] = $attribute_value;
						break;
					}
				}
				
				if( $count == $number ){
					break;
				}
			}
		}
		
		if( $color_html ){
			echo '<div class="color-swatch"><span>' . esc_html__('Color', 'loobek') . '</span>' . implode('', $color_html) . '</div>';
			echo '<span class="variable-prices hidden">' . implode('', $price_html) . '</span>';
		}
	}
}

function loobek_template_loop_product_gallery(){
	global $product;
	$main_image_id = $product->get_image_id();
	$galleries = $product->get_gallery_image_ids();
	if( is_array($galleries) && $main_image_id ){
		array_unshift( $galleries, $main_image_id );
	}
	
	if( empty($galleries) ){
		return;
	}
	
	$number = apply_filters('loobek_loop_product_gallery_number', 4);
	
	if( $number != -1 && $number < count($galleries) ){
		$galleries = array_slice( $galleries, 0, $number );
	}
	
	$images = '';
	
	foreach( $galleries as $i => $id ){
		$img_url = wp_get_attachment_image_url( $id, 'woocommerce_thumbnail' );
		if( $img_url ){
			$images .= '<div data-thumb="' . esc_url($img_url) . '" class="' . ( $main_image_id && 0 == $i ? 'active' : '' ) . '">';
			$images .= '<img src="' . esc_url($img_url) . '" loading="lazy" alt="" />';
			$images .= '</div>';
		}
	}
	
	if( $images ){
		echo '<div class="ts-product-galleries">' . $images . '</div>';
	}
}

function loobek_template_loop_product_title(){
	global $product;
	echo '<h3 class="heading-title product-name">';
	echo '<a href="' . esc_url($product->get_permalink()) . '">' . esc_html($product->get_title()) . '</a>';
	echo '</h3>';
}

function loobek_template_loop_add_to_cart(){
	if( loobek_get_theme_options('ts_enable_catalog_mode') ){
		return;
	}
	
	global $product;
	if( loobek_quick_add_to_cart_product_enabled( $product->get_id() ) ){
		$variations = $product->get_children();
		if( !empty($variations) ){
			$count = 0;
			$limit = absint( loobek_get_theme_options('ts_variable_product_quick_add_to_cart_limit') );
			
			echo '<div class="variable-product-quick-add-to-cart">';
			echo '<span>' . esc_html__('Quick add to cart', 'loobek') . '</span>';
			foreach( $variations as $variation_id ){
				$variation    = wc_get_product_object( 'variation', $variation_id );
				$attributes = $variation->get_attributes();
				foreach( $attributes as $attr_name => $attr_value ){ /* Should have only one attribute */
					if( $attr_value == '' ){ /* Any */
						break;
					}
					if( ! ( $variation->is_purchasable() && $variation->is_in_stock() ) ){
						break;
					}
					$term  = taxonomy_exists( $attr_name ) ? get_term_by( 'slug', $attr_value, $attr_name ) : false;
					$attr_label = ! is_wp_error( $term ) && $term ? $term->name : $attr_value;
					?>
					<a 
						href="<?php echo esc_url($variation->add_to_cart_url()); ?>" 
						data-quantity="1" 
						class="add_to_cart_button product_type_variation ajax_add_to_cart" 
						data-product_id="<?php echo esc_attr($variation_id); ?>" 
						data-product_sku="<?php echo esc_attr($variation->get_sku()); ?>" 
						aria-label="<?php echo esc_attr($variation->add_to_cart_description()); ?>" 
						rel="nofollow">
						<?php echo esc_html( $attr_label ); ?>
					</a>
					<?php
					$count++;
				}
				
				if( $count == $limit ){
					break;
				}
			}
			echo '</div>';
			return;
		}
	}
	
	echo '<div class="loop-add-to-cart">';
	woocommerce_template_loop_add_to_cart();
	echo '</div>';
}

function loobek_template_loop_product_sku(){
	global $product;
	if( $product->get_sku() ){
		echo '<div class="product-sku"><span>' . esc_html__('SKU', 'loobek') . '</span>' . esc_html($product->get_sku()) . '</div>';
	}
}

function loobek_template_loop_short_description(){
	global $product;
	if( !$product->get_short_description() ){
		return;
	}
	
	$allowed_html = true;
	if( loobek_get_theme_options('ts_prod_cat_desc_html') ){
		$allowed_html = array(
			'ul' => array(
				'class' => array()
			)
			,'ol' => array(
				'class' => array()
			)
			,'li'=> array(
				'class' => array()
			)
			,'div'=> array(
				'class' => array()
			)
			,'p'=> array(
				'class' => array()
			)
			,'span'=> array(
				'class' => array()
			)
		);
	}
	
	$grid_limit_words = (int) loobek_get_theme_options('ts_prod_cat_desc_words');
	?>
	<div class="short-description">
		<?php loobek_the_excerpt_max_words($grid_limit_words, '', $allowed_html, '', true); ?>
	</div>
	<?php
}

function loobek_template_loop_brands(){
	global $product;
	if( loobek_get_theme_options('ts_prod_cat_brand') && taxonomy_exists('ts_product_brand') ){
		echo get_the_term_list($product->get_id(), 'ts_product_brand', '<div class="product-brands">', ', ', '</div>');
	}
}

function loobek_template_loop_categories(){
	global $product;
	$categories_label = esc_html__('Categories: ', 'loobek');
	echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-categories"><span>'.$categories_label.'</span>', '</div>');
}

function loobek_change_products_per_page_shop(){
    if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( isset($_GET['per_page']) && absint($_GET['per_page']) > 0 ){
			return absint($_GET['per_page']);
		}
		$per_page = absint( loobek_get_theme_options('ts_prod_cat_per_page') );
        if( $per_page ){
            return $per_page;
        }
    }
}

function loobek_product_per_page_form(){
	if( !loobek_get_theme_options('ts_prod_cat_per_page_dropdown') ){
		return;
	}
	if( function_exists('woocommerce_products_will_display') && !woocommerce_products_will_display() ){
		return;
	}
	
	$per_page = absint( loobek_get_theme_options('ts_prod_cat_per_page') );
	if( !$per_page ){
		return;
	}
	
	$options = array();
	for( $i = 1; $i <= 4; $i++ ){
		$options[] = $per_page * $i;
	}
	$selected = isset($_GET['per_page'])?absint($_GET['per_page']):$per_page;
	
	$action = '';
	$cat 	= get_queried_object();
	if( isset( $cat->term_id ) && isset( $cat->taxonomy ) ){
		$action = get_term_link( $cat->term_id, $cat->taxonomy );
	}
	else{
		$action = wc_get_page_permalink('shop');
	}
?>
	<form method="get" action="<?php echo esc_url($action) ?>" class="product-per-page-form">
		<span><?php esc_html_e('Show', 'loobek'); ?></span>
		<select name="per_page" class="perpage">
			<?php foreach( $options as $option ): ?>
			<option value="<?php echo esc_attr($option) ?>" <?php selected($selected, $option) ?>><?php echo esc_html($option) ?></option>
			<?php endforeach; ?>
		</select>
		<ul class="perpage">
			<li>
				<span class="perpage-current"><?php echo esc_html($selected) ?></span>
				<ul class="dropdown">
					<?php foreach( $options as $option ): ?>
					<li><a href="#" data-perpage="<?php echo esc_attr($option) ?>" class="<?php echo esc_attr($option == $selected?'current':''); ?>"><?php echo esc_html($option) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
		</ul>
		<?php wc_query_string_form_fields( null, array( 'per_page', 'submit', 'paged', 'product-page' ) ); ?>
	</form>
<?php
}

function loobek_show_only_products_on_sales( $array ){
	if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( isset($_GET['onsale']) && 'yes' == $_GET['onsale'] ){
			return array_merge($array, wc_get_product_ids_on_sale());
		}
	}
	return $array;
}

function loobek_product_on_sale_form(){
	if( !loobek_get_theme_options('ts_prod_cat_onsale_checkbox') ){
		return;
	}
	if( function_exists('woocommerce_products_will_display') && !woocommerce_products_will_display() ){
		return;
	}
	
	$checked = isset($_GET['onsale']) && 'yes' == $_GET['onsale'] ? true : false;
	
	$action = '';
	$cat 	= get_queried_object();
	if( isset( $cat->term_id ) && isset( $cat->taxonomy ) ){
		$action = get_term_link( $cat->term_id, $cat->taxonomy );
	}
	else{
		$action = wc_get_page_permalink('shop');
	}
	?>
	<form method="get" action="<?php echo esc_url($action); ?>" class="product-on-sale-form <?php echo esc_attr( $checked?'checked':'' ); ?>">
		<label>
			<input type="checkbox" name="onsale" value="yes" <?php echo esc_attr( $checked?'checked':'' ); ?> />
			<?php esc_html_e('Show only products on sale', 'loobek'); ?>
		</label>
		<?php wc_query_string_form_fields( null, array( 'onsale', 'submit', 'paged', 'product-page' ) ); ?>
	</form>
	<?php
}

function loobek_product_columns_selector(){
	$theme_options = loobek_get_theme_options();
	if( !$theme_options['ts_prod_cat_columns_selector'] ){
		return;
	}
	
	if( function_exists('woocommerce_products_will_display') && !woocommerce_products_will_display() ){
		return;
	}
	
	$default_column = $theme_options['ts_prod_cat_columns'];
	
	$columns = array(
		'1' 	=> 'columns-1'
		,'1-1' 	=> 'columns-1 big-thumbnail'
		,'2' 	=> 'columns-2'
		,'3' 	=> 'columns-3'
		,'4' 	=> 'columns-4'
		,'5' 	=> 'columns-5'
		);
	?>
	<div class="ts-product-columns-selector">
		<?php foreach( $columns as $column => $class ){ ?>
		<span class="column-<?php echo esc_attr($column); ?> <?php echo esc_attr($default_column == $column?'selected':''); ?>" data-class="<?php echo esc_attr($class); ?>"></span>
		<?php } ?>
	</div>
	<?php
}

function loobek_special_filter_area(){
	$theme_options = loobek_get_theme_options();
	if( !$theme_options['ts_special_filter_area'] || !woocommerce_products_will_display() ){
		return;
	}
	
	if( is_search() ){
		return;
	}
	
	if( !is_shop() && !is_product_category() ){
		return;
	}
	
	$show_on = $theme_options['ts_special_filter_area_show_on'];
	if( $show_on != 'all' ){
		if( is_shop() && $show_on != 'shop' ){
			return;
		}
		if( is_product_category() && $show_on != 'category' ){
			return;
		}
	}
	
	if( is_product_category() ){
		$current_cat_object = get_queried_object();
		if( !$current_cat_object ){
			return;
		}
	}
	
	$cache_key = 'ts_special_filter_area_html';
	$cache = wp_cache_get( $cache_key );
	if( $cache !== false ){
		return $cache;
	}
	
	$has_background = false;
	
	$html = '';
	
	if( $theme_options['ts_special_filter_area'] == 'subcategory' ){
		$include_parent = $theme_options['ts_special_filter_area_include_parent_category'];
		$current_cat = 0;
		$parent_cat = 0;
		$is_siblings = false;
		if( is_product_category() ){
			$current_cat = $current_cat_object->term_id;
			$parent_cat = $current_cat_object->parent;
		}
		
		$args = array(
				'taxonomy' 			=> 'product_cat'
				,'hierarchical'		=> 1
				,'parent'			=> $current_cat
				,'title_li'			=> ''
				,'child_of'			=> 0
			);
		$categories = get_categories($args);
		
		if( empty($categories) ){ /* no children - show siblings */
			$is_siblings = true;
			$args['parent'] = $parent_cat;
			
			$categories = get_categories($args);
		}
		
		if( !empty($categories) && is_array($categories) ){
			$html .= '<ul>';
			
			if( $include_parent ){
				$current = true;
				$parent_title = __('All products', 'loobek');
				$parent_link = get_permalink( wc_get_page_id( 'shop' ) );
				
				if( is_product_category() ){
					if( $is_siblings ){
						$current = false;
						if( $parent_cat != 0 ){ /* not shop */
							$parent_cat_object = get_term($parent_cat, 'product_cat');
							if( isset($parent_cat_object->name) ){
								$parent_title = __('All', 'loobek') . ' ' . $parent_cat_object->name;
								$parent_link = get_term_link($parent_cat, 'product_cat');
							}
						}
					}
					else{
						$parent_title = __('All', 'loobek') . ' ' . $current_cat_object->name;
						$parent_link = get_term_link($current_cat_object, 'product_cat');
					}
				}
				
				$html .= '<li><a href="' . esc_url( $parent_link ) . '" class="' . ( $current?'current':'' ) . '">' . esc_html( $parent_title ) . '</a></li>';
			}
			
			foreach( $categories as $category ){
				$html .= '<li><a href="' . esc_url( get_term_link($category, 'product_cat') ) . '" class="' . ( $current_cat == $category->term_id ? 'current' : '' ) . '">' . esc_html( $category->name ) . '</a></li>';
			}
			
			$html .= '</ul>';
		}
	}
	
	if( $theme_options['ts_special_filter_area'] == 'attribute' && $theme_options['ts_special_filter_area_attribute'] && class_exists('WC_Widget_Layered_Nav') ){
		$has_background = true;
		
		if( is_product_category() ){
			$product_attribute = get_term_meta($current_cat_object->term_id, 'product_attribute', true);
			if( $product_attribute ){
				$theme_options['ts_special_filter_area_attribute'] = $product_attribute;
			}
		}
		
		$attribute_name = wc_attribute_taxonomy_name( $theme_options['ts_special_filter_area_attribute'] );
		if( !taxonomy_exists($attribute_name) ){
			return;
		}
		
		ob_start();
		$title = __('Filter by', 'loobek') . ' ' . wc_attribute_label( $attribute_name );
		the_widget('WC_Widget_Layered_Nav', array('attribute' => $theme_options['ts_special_filter_area_attribute'], 'title' => $title));
		$html .= ob_get_clean();
		
		if( $theme_options['ts_special_filter_area_page_title'] && $html ){
			$page_title = '';
			
			if( is_shop() ){
				$page_title = get_the_title( wc_get_page_id( 'shop' ) );
			}
			
			if( is_product_category() ){
				$page_title = $current_cat_object->name;
			}
			
			if( $page_title ){
				$html = '<h1 class="heading-title page-title">' . esc_html($page_title) . '</h1>' . $html;
			}
		}
	}
	
	if( $html ){
		$html = '<div class="special-filter-area ' . ( $has_background?'has-background':'' ) . '">' . $html . '</div>';
	}
	
	wp_cache_set( $cache_key, $html );
	return $html;
}

function loobek_is_active_filter_area(){
	return is_active_sidebar('filter-widget-area') && loobek_get_theme_options('ts_filter_widget_area') && woocommerce_products_will_display();
}

function loobek_add_filter_button(){	
	if( loobek_is_active_filter_area() || loobek_get_theme_options('ts_prod_cat_layout') != '0-1-0' ){
		?>
		<div class="filter-widget-area-button">
			<a href="#" data-show_title="<?php esc_attr_e('Show filters', 'loobek') ?>" data-hide_title="<?php esc_attr_e('Hide filters', 'loobek') ?>"></a>
		</div>
		<?php
	}
	
	loobek_filter_widget_area( array('popup', 'dropdown') );
}

function loobek_filter_widget_area( $showed_in_styles = array() ){
	$filter_style = loobek_get_theme_options('ts_filter_widget_area_style');
	$show_area = false;
	if( in_array($filter_style, $showed_in_styles) ){
		$show_area = true;
	}
	
	if( $show_area && loobek_is_active_filter_area() ){
	?>
		<div id="ts-filter-widget-area" class="ts-floating-sidebar">
			<div class="overlay"></div>
			<div class="ts-sidebar-content">
				<span class="close"></span>
				<span class="title"><?php esc_html_e('Filter', 'loobek'); ?></span>
				<aside class="filter-widget-area">
					<?php
					loobek_widget_layered_nav_filters();
					loobek_product_on_sale_form();
					dynamic_sidebar( 'filter-widget-area' );
					?>
				</aside>
			</div>
		</div>
	<?php
	}
}

function loobek_reset_filter_button(){
	if( function_exists('is_filtered') && !is_filtered() ){
		return;
	}
	
	$link = '';
	if( defined( 'SHOP_IS_ON_FRONT' ) ){
		$link = home_url();
	}elseif( is_shop() ){
		$link = get_permalink( wc_get_page_id( 'shop' ) );
	}elseif( is_product_category() ){
		$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
	}elseif( is_product_tag() ){
		$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
	}else{
		$queried_object = get_queried_object();
		$link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
	}
	
	if( $link ){
		echo '<a href="'.esc_url($link).'" class="button-text">'.esc_html__('Clear all filters', 'loobek').'</a>';
	}
}

function loobek_widget_layered_nav_filters( $showed_in_styles = array() ){
	if( !class_exists('WC_Widget_Layered_Nav_Filters') ){
		return;
	}
	
	$filter_style = loobek_get_theme_options('ts_filter_widget_area_style');
	$show_widget = false;
	if( empty($showed_in_styles) || in_array($filter_style, $showed_in_styles) ){
		$show_widget = true;
	}
	
	if( $show_widget ){
		echo '<div class="ts-active-filters">';
		the_widget('WC_Widget_Layered_Nav_Filters', array('title' => esc_html__('Selected filters', 'loobek')));
		loobek_reset_filter_button();
		echo '</div>';
	}
}

function loobek_shop_load_more_html(){
	if( wc_get_loop_prop( 'total_pages' ) == 1 || !woocommerce_products_will_display() ){
		return;
	}
	$loading_type = loobek_get_theme_options('ts_prod_cat_loading_type');
	if( in_array($loading_type, array('infinity-scroll', 'load-more-button')) ){
		$total = wc_get_loop_prop( 'total' );
		$per_page = wc_get_loop_prop( 'per_page' );
		$current = wc_get_loop_prop( 'current_page' );
		$showing = min($current * $per_page, $total);
		$bar_width = round( $showing * 100 / $total, 2 );
	?>
	<div class="ts-shop-result-count">
		<span>
		<?php 
		if( $showing < $total ){
			printf( esc_html__('You\'re viewed %s of %s products', 'loobek'), $showing, $total );
		}
		else{
			printf( esc_html__('You\'re viewed all %s products', 'loobek'), $total );
		}
		?>
		</span>
		<span class="bar"><span style="width: <?php echo esc_attr($bar_width) ?>%"></span></span>
	</div>
	<div class="ts-shop-load-more">
		<a class="load-more button"><?php esc_html_e('Load more', 'loobek'); ?></a>
	</div>
	<?php
	}
}

function loobek_empty_woocommerce_stock_html( $html, $product ){
	if( $product->get_type() == 'simple' ){
		return '';
	}
	return $html;
}

function loobek_before_output_product_categories(){
	return '<div class="list-categories">';
}

function loobek_after_output_product_categories(){
	return '</div>';
}
/*** End Shop - Category ***/



/*** Single Product ***/

/* Remove hook */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

/* Add hook */
add_action('woocommerce_before_single_product_summary', 'loobek_before_single_product_summary_images', 1);
add_action('woocommerce_after_single_product_summary', 'loobek_after_single_product_summary_images', 3);

add_action('woocommerce_product_thumbnails', 'loobek_template_loop_product_label', 99);
add_action('woocommerce_product_thumbnails', 'loobek_template_single_product_video_360_buttons', 99);

add_action('woocommerce_single_product_summary', 'loobek_template_single_before_top_meta', 6);
add_action('woocommerce_single_product_summary', 'loobek_template_single_after_top_meta', 16);

add_action('woocommerce_single_product_summary', 'loobek_template_single_categories', 2);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
add_action('woocommerce_single_product_summary', 'loobek_template_single_brand', 8);
add_action('woocommerce_single_product_summary', 'loobek_template_single_sku', 10);
add_action('woocommerce_single_product_summary', 'loobek_template_single_availability', 15);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 24);
add_action('woocommerce_single_product_summary', 'loobek_template_single_variation_price', 25);
add_action('woocommerce_single_product_summary', 'loobek_single_product_calc_discount', 26);
add_action('woocommerce_single_product_summary', 'loobek_template_single_countdown', 27);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 29);

add_action('woocommerce_single_product_summary', 'loobek_single_product_buy_now_button', 31);

add_action('woocommerce_single_product_summary', 'loobek_single_product_group_button_start', 31);

add_action('woocommerce_single_product_summary', 'loobek_ask_about_product_button', 40);

add_action('woocommerce_single_product_summary', 'loobek_single_product_group_button_end', 41);

add_action('woocommerce_single_product_summary', 'loobek_template_single_meta', 60);

add_action('woocommerce_single_product_summary', 'loobek_product_bottom_summary_content', 99);

add_action('woocommerce_after_single_product_summary', 'loobek_product_custom_content', 9);

add_action('woocommerce_after_single_product_summary', 'loobek_related_upsell_bestseller_products_before', 14); /* 15: upsell, 20: related */

add_action('woocommerce_after_single_product_summary', 'loobek_single_bestseller_products', 25);

add_action('woocommerce_after_single_product_summary', 'loobek_related_upsell_bestseller_products_after', 26);

if( function_exists('ts_template_social_sharing') ){
	add_action('woocommerce_share', 'ts_template_social_sharing', 10);
}

add_action('init', 'loobek_woocommerce_tabs_handle', 20);

add_action('init', 'loobek_change_product_thumbnail_layout_on_mobile', 18);

add_action('init', 'loobek_grouped_product_handle');

add_filter('woocommerce_product_upsells_products_heading', 'loobek_upsells_products_heading_filter');

add_filter('woocommerce_product_related_products_heading', 'loobek_related_products_heading_filter');

add_filter('woocommerce_output_related_products_args', 'loobek_output_related_products_args_filter');

add_filter('woocommerce_single_product_image_gallery_classes', 'loobek_add_classes_to_single_product_thumbnail');
add_filter('woocommerce_gallery_thumbnail_size', 'loobek_product_gallery_thumbnail_size');

add_filter('woocommerce_dropdown_variation_attribute_options_args', 'loobek_variation_attribute_options_args');
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'loobek_variation_attribute_options_html', 10, 2);

add_filter('woocommerce_add_to_cart_redirect', 'loobek_product_buy_now_redirect');

add_filter('woocommerce_available_variation', 'loobek_add_more_attribute_to_variation', 10, 3);

add_filter( 'woocommerce_single_product_carousel_options', 'loobek_single_product_carousel_options' );

if( !is_admin() ){ /* Fix for WooCommerce Tab Manager plugin */
	add_filter( 'woocommerce_product_tabs', 'loobek_product_remove_tabs', 999 );
	add_filter( 'woocommerce_product_tabs', 'loobek_add_product_custom_tab', 90 );
}

function loobek_calc_discount_percent($regular_price, $sale_price){
	return ( 1 - round($sale_price / $regular_price, 2) ) * 100;
}

add_action('wp_ajax_loobek_load_product_video', 'loobek_load_product_video_callback' );
add_action('wp_ajax_nopriv_loobek_load_product_video', 'loobek_load_product_video_callback' );
/*** End Product ***/

function loobek_before_single_product_summary_images(){
	echo '<div class="product-images-summary">';
}

function loobek_after_single_product_summary_images(){
	echo '</div>';
}

function loobek_template_single_before_top_meta(){
	echo '<div class="detail-meta-top">';
}

function loobek_template_single_after_top_meta(){
	echo '</div>';
}

function loobek_change_product_thumbnail_layout_on_mobile(){
	if( wp_is_mobile() ){
		loobek_change_theme_options( 'ts_prod_thumbnail_layout', loobek_get_theme_options('ts_prod_thumbnail_layout_mobile') );
	}
}

function loobek_single_product_carousel_options( $options ){
	$thumbnail_layout = loobek_get_theme_options('ts_prod_thumbnail_layout');
	if( in_array( $thumbnail_layout, array( 'slider-2-col', 'slider-3-col' ) ) ){
		$item = $thumbnail_layout == 'slider-2-col' ? 2 : 3;
		$options['itemWidth'] = 664;
		$options['itemMargin'] = 10;
		$options['minItems'] = $item;
		$options['maxItems'] = $item;
		$options['move'] = 1;
		$options['directionNav'] = true;
		if( $thumbnail_layout == 'slider-3-col' ){
			$options['controlNav'] = true;
		}
	}

	return $options;
}

function loobek_template_single_product_video_360_buttons(){
	if( !is_singular('product') ){
		return;
	}
	
	global $product;
	$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
	if( $video_url ){
		echo '<a class="ts-product-video-button" href="#" data-product_id="'.$product->get_id().'">'.esc_html__('Video', 'loobek').'</a>';
		add_action('wp_footer', 'loobek_add_product_video_popup_modal', 999);
	}
	
	$gallery_360 = get_post_meta($product->get_id(), 'ts_prod_360_gallery', true);
	if( $gallery_360 ){
		$galleries = array_map('trim', explode(',', $gallery_360));
		$image_array = array();
		foreach($galleries as $gallery ){
			$image_src = wp_get_attachment_image_url($gallery, 'woocommerce_single');
			if( $image_src ){
				$image_array[] = "'" . $image_src . "'";
			}
		}
		wp_enqueue_script('threesixty');
		wp_add_inline_script('threesixty', 'var _ts_product_360_image_array = ['.implode(',', $image_array).'];');
		
		echo '<a class="ts-product-360-button" href="#">'.esc_html__('360', 'loobek').'</a>';
		add_action('wp_footer', 'loobek_add_product_360_popup_modal', 999);
	}
}

function loobek_add_product_video_popup_modal(){
	?>
	<div id="ts-product-video-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<div class="product-video-container popup-container">
			<span class="close"></span>
			<div class="product-video-content"></div>
		</div>
	</div>
	<?php
}

function loobek_add_product_360_popup_modal(){
	global $product;
	?>
	<div id="ts-product-360-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<span class="close"></span>
		<h4 class="product-title"><?php echo esc_html( $product->get_title() ); ?></h4>
		<div class="product-360-container popup-container">
			<div class="product-360-content"><?php loobek_load_product_360(); ?></div>
		</div>
	</div>
	<?php
}

function loobek_add_product_size_chart_popup_modal(){
	?>
	<div id="ts-product-size-chart-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<div class="product-size-chart-container popup-container">
			<span class="close"></span>
			<div class="product-size-chart-content">
				<?php loobek_product_size_chart_content(); ?>
			</div>
		</div>
	</div>
	<?php
}

function loobek_add_classes_to_single_product_thumbnail( $classes ){
	global $product;
	$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
	if( $video_url ){
		$classes[] = 'has-video';
	}
	$gallery_360 = get_post_meta($product->get_id(), 'ts_prod_360_gallery', true);
	if( $gallery_360 ){
		$classes[] = 'has-360-gallery';
	}
	
	return $classes;
}

function loobek_product_gallery_thumbnail_size(){
	if( loobek_get_theme_options('ts_prod_thumbnail_layout') == 'grid' ){
		return 'woocommerce_single';
	}
	return 'woocommerce_thumbnail';
}

/* Single Product Video - Register ajax */
function loobek_load_product_video_callback(){
	if( empty($_POST['product_id']) ){
		die( esc_html__('Invalid Product', 'loobek') );
	}
	
	$prod_id = absint($_POST['product_id']);

	if( $prod_id <= 0 ){
		die( esc_html__('Invalid Product', 'loobek') );
	}
	
	$video_url = get_post_meta($prod_id, 'ts_prod_video_url', true);
	ob_start();
	if( !empty($video_url) ){
		echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
	}
	die( ob_get_clean() );
}

function loobek_load_product_360(){
	?>
	<div class="threesixty ts-product-360">
		<div class="spinner">
			<span>0%</span>
		</div>
		<ol class="threesixty_images"></ol>
	</div>
	<?php
}

function loobek_template_single_countdown(){
	if( loobek_get_theme_options('ts_prod_count_down') && function_exists('ts_template_loop_time_deals') ){
		ts_template_loop_time_deals();
	}
}

function loobek_template_single_variation_price(){
	if( loobek_get_theme_options('ts_prod_price') ){
		echo '<div class="ts-variation-price hidden"></div>';
	}
}

function loobek_variation_attribute_options_args( $args ){
	if( !loobek_get_theme_options('ts_prod_attr_dropdown') ){
		$args['class'] = 'hidden';
	}
	if( $args['attribute'] ){
		$args['show_option_none'] = esc_html__('Choose your', 'loobek') . ' ' . wc_attribute_label( $args['attribute'] );
	}
	return $args;
}

function loobek_get_color_variation_thumbnails(){
	global $product;
	$color_variation_thumbnails = array();
	
	$attribute_name = wc_attribute_taxonomy_name( 'color' );
	$variation_attribute_name = wc_variation_attribute_name( $attribute_name );
	
	$children = $product->get_children();
	if( is_array($children) && count($children) > 0 ){
		foreach( $children as $children_id ){
			$variation_attributes = wc_get_product_variation_attributes( $children_id );
			foreach( $variation_attributes as $attr_name => $attr_value ){
				if( $attr_name == $variation_attribute_name ){
					if( !$attr_value ){ /* Any */
						break;
					}
					if( in_array( $attr_value, array_keys($color_variation_thumbnails) ) ){
						break;
					}
					
					$thumbnail_id = get_post_meta( $children_id, '_thumbnail_id', true );
					if( $thumbnail_id ){
						$thumbnail = wp_get_attachment_image($thumbnail_id, 'woocommerce_thumbnail');
					}
					else{
						$thumbnail = wc_placeholder_img();
					}
					
					$color_variation_thumbnails[$attr_value] = $thumbnail;
					
					break;
				}
			}
		}
	}
	
	return $color_variation_thumbnails;
}

function loobek_variation_attribute_options_html( $html, $args ){
	$theme_options = loobek_get_theme_options();
	if( loobek_get_theme_options('ts_prod_attr_dropdown') ){
		return $html;
	}
	
	global $product;
	
	$attr_color_text = loobek_get_theme_options('ts_prod_attr_color_text');
	$use_variation_thumbnail = loobek_get_theme_options('ts_prod_attr_color_variation_thumbnail');
	
	$options = $args['options'];
	$attribute_name = $args['attribute'];
	
	ob_start();
	
	if( is_array( $options ) ){
	?>
		<div class="ts-product-attribute">
		<?php 
		$selected_key = 'attribute_' . sanitize_title( $attribute_name );
		
		$selected_value = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $product->get_variation_default_attribute( $attribute_name );
		
		// Get terms if this is a taxonomy - ordered
		if( taxonomy_exists( $attribute_name ) ){
			
			$class = 'option';
			$is_attr_color = false;
			$attribute_color = wc_sanitize_taxonomy_name( 'color' );
			if( $attribute_name == wc_attribute_taxonomy_name( $attribute_color ) ){
				if( !$attr_color_text ){
					$is_attr_color = true;
					$class .= ' color';
					
					if( $use_variation_thumbnail ){
						$color_variation_thumbnails = loobek_get_color_variation_thumbnails();
					}
				}
				else{
					$class .= ' text';
				}
			}
			$terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );

			foreach ( $terms as $term ) {
				if ( ! in_array( $term->slug, $options ) ) {
					continue;
				}
				$term_name = apply_filters( 'woocommerce_variation_option_name', $term->name );
				
				if( $is_attr_color && !$use_variation_thumbnail ){
					$datas = get_term_meta( $term->term_id, 'ts_product_color_config', true );
					if( $datas ){
						$datas = unserialize( $datas );	
					}else{
						$datas = array(
									'ts_color_color' 				=> "#ffffff"
									,'ts_color_image' 				=> 0
								);
					}
				}
				
				$selected_class = sanitize_title( $selected_value ) == sanitize_title( $term->slug ) ? 'selected' : '';
				
				echo '<div data-value="' . esc_attr( $term->slug ) . '" class="'. $class .' '. $selected_class .'">';
				
				if( $is_attr_color ){
					if( $use_variation_thumbnail ){
						if( isset($color_variation_thumbnails[$term->slug]) ){
							echo '<a class="img-color variation-img" href="#">' . $color_variation_thumbnails[$term->slug] . '</a>';
						}
					}
					else{
						if( absint($datas['ts_color_image']) > 0 ){
							echo '<a class="img-color" href="#">' . wp_get_attachment_image( absint($datas['ts_color_image']), 'ts_prod_color_thumb', true, array('title' => $term_name, 'alt' => $term_name) ) . '</a>';
						}
						else{
							echo '<a href="#" style="background-color:' . $datas['ts_color_color'] . '"></a>';
						}
					}
				}
				else{
					echo '<a href="#">' . $term_name . '</a>';
				}
				
				echo '</div>';
			}

		} else {
			foreach( $options as $option ){
				$class = 'option';
				$class .= sanitize_title( $selected_value ) == sanitize_title( $option ) ? ' selected' : '';
				echo '<div data-value="' . esc_attr( $option ) . '" class="' . $class . '"><a href="#">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</a></div>';
			}
		}
		?>
	</div>
	<?php
		if( $theme_options['ts_prod_size_chart'] && $theme_options['ts_prod_size_chart_style'] == 'popup' && is_singular('product') ){
			$show_size_chart = false;
			if( taxonomy_exists( $attribute_name ) && strpos( $attribute_name, 'size' ) !== false ){
				$show_size_chart = true;
			}
			else if( strpos( sanitize_title( $attribute_name ), 'size' ) !== false ){ /* Custom attribute */
				$show_size_chart = true;
			}
		
			if( $show_size_chart && loobek_get_product_size_chart_id() ){
				echo '<a class="ts-product-size-chart-button" href="#">' . esc_html__('Size guide', 'loobek') . '</a>';
				add_action('wp_footer', 'loobek_add_product_size_chart_popup_modal', 999);
				wp_cache_set('ts_size_chart_added', 1); /* show in tabs if not added */
			}
		}
	}
	
	return ob_get_clean() . $html;
}

function loobek_template_single_sku(){
	global $product;
	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ){
		echo '<div class="sku-wrapper product_meta"><span>' . esc_html__( 'Product code', 'loobek' ) . '</span><span class="sku">' . (( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'loobek' )) . '</span></div>';
	}
}

function loobek_template_single_brand(){
	global $product;
	if( taxonomy_exists('ts_product_brand') ){
		echo get_the_term_list($product->get_id(), 'ts_product_brand', '<div class="brands-link"><span>' . esc_html__( 'Brands', 'loobek' ) . '</span><span class="brand-links">', ', ', '</span></div>');
	}
}

function loobek_template_single_categories(){
	global $product;
	echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="cats-link"><span>' . esc_html__( 'Categories:', 'loobek' ) . '</span><span class="cat-links">', '</span></div>' );
}

function loobek_template_single_availability(){
	global $product;
	$product_stock = $product->get_availability();

	$availability_text = empty($product_stock['availability']) ? __('In Stock', 'loobek') : $product_stock['availability'];
	?>	
		<div class="availability stock <?php echo esc_attr($product_stock['class']); ?>" data-original="<?php echo esc_attr($availability_text) ?>" data-class="<?php echo esc_attr($product_stock['class']) ?>">
			<span><?php esc_html_e('Availability', 'loobek') ?></span>
			<span class="availability-text"><?php echo esc_html($availability_text); ?></span>
		</div>	
	<?php
}

function loobek_single_product_calc_discount(){
	if( !loobek_get_theme_options('ts_prod_price') || !loobek_get_theme_options('ts_prod_discount_percent') ){
		return;
	}
	
	global $product;
	$percent = '';
	if( $product->is_on_sale() ){
		if( $product->get_type() == 'variable' ){
			$percent = '-1'; /* add html but hide */
		}
		else{
			$regular_price = $product->get_regular_price();
			$sale_price = $product->get_price();
			
			if( $regular_price && $sale_price ){
				$percent = loobek_calc_discount_percent($regular_price, $sale_price);
			}
		}
	}
	
	if( $percent ){
		echo '<span class="ts-discount-percent '.($percent == '-1' ? 'hidden': '').'">-<span>'.$percent.'</span>%</span>';
	}
}

function loobek_add_more_attribute_to_variation( $attributes, $variable, $variation ){
	if( loobek_get_theme_options('ts_prod_price') && loobek_get_theme_options('ts_prod_discount_percent') ){
		if( $variation->is_on_sale() && $variation->get_regular_price() ){
			$attributes['discount_percent'] = (string)loobek_calc_discount_percent($variation->get_regular_price(), $variation->get_price());
		}
	}
	
	$attributes['low_stock_notice'] = loobek_get_product_low_stock_notice( $variation );
	
	return $attributes;
}

function loobek_single_product_buy_now_button(){
	global $product;
	if( !loobek_get_theme_options('ts_enable_catalog_mode') && loobek_get_theme_options('ts_prod_buy_now') && in_array( $product->get_type(), array('simple', 'variable') ) && $product->is_purchasable() && $product->is_in_stock() ){
	?>
		<a href="#" class="button ts-buy-now-button"><?php esc_html_e('Buy Now', 'loobek'); ?></a>
	<?php
	}
}

function loobek_product_buy_now_redirect( $url ){
	if( isset($_REQUEST['ts_buy_now']) && $_REQUEST['ts_buy_now'] == 1 ){
		return apply_filters( 'loobek_product_buy_now_redirect_url', wc_get_checkout_url() );
	}
	return $url;
}

function loobek_template_single_meta(){
	global $product;
	$theme_options = loobek_get_theme_options();
	
	$show_tag = $theme_options['ts_prod_tag'] && !$theme_options['ts_prod_tag_color_style'];
	$show_social = $theme_options['ts_prod_sharing'];
	
	if( !$show_tag && !$show_social ){
		return;
	}
	
	$class = $show_social && $theme_options['ts_prod_sharing_sticky'] && !$theme_options['ts_prod_sharing_sharethis'] && !$show_tag ? 'only-social-sticky' : '';
	
	echo '<div class="detail-meta-bottom ' . esc_attr($class) . '">';
		do_action( 'woocommerce_product_meta_start' );
		
		if( $show_tag ){
			echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tags-link"><span>' . esc_html__( 'Tags', 'loobek' ) . '</span><span class="tag-links">', '</span></div>' );	
		}
		
		if( $show_social ){
			woocommerce_template_single_sharing();
		}
		
		do_action( 'woocommerce_product_meta_end' );
	echo '</div>';
}

function loobek_template_single_product_tag_color_style(){
	global $product;
	$tags = get_the_terms( $product->get_id(), 'product_tag' );
	if( is_wp_error( $tags ) ){
		return;
	}
	
	if( empty( $tags ) ){
		return;
	}
	?>
	<div class="tags-color-style">
		<?php
		foreach( $tags as $tag ){
			$link = get_term_link( $tag, 'product_tag' );
			if( !is_wp_error( $link ) ){
				$icon_id = get_term_meta( $tag->term_id, 'icon_id', true );
				$text_color = get_term_meta( $tag->term_id, 'text_color', true );
				$background_color = get_term_meta( $tag->term_id, 'background_color', true );
				
				$style = '';
				if( $text_color ){
					$style .= 'color: ' . $text_color . ';';
				}
				if( $background_color ){
					$style .= 'background-color: ' . $background_color . ';';
				}
				
				$icon = '';
				if( $icon_id ){
					$icon = wp_get_attachment_image( $icon_id, 'full' );
				}
			
				echo '<a href="'.esc_url($link).'" class="tag-item" rel="tag" style="' . esc_attr($style) . '">' . $icon . '<span>' . esc_html($tag->name) . '</span></a>';
			}
		}
		?>
	</div>
	<?php
}

function loobek_product_bottom_summary_content(){
	if( $content = loobek_get_theme_options('ts_prod_bottom_summary_content') ){
	?>
		<div class="product-bottom-summary-content ts-custom-block-content hidden">
			<?php loobek_get_custom_block_content( $content ); ?>
		</div>
	<?php
	}
}

function loobek_mysql_version_greater_8(){
	if( function_exists('wc_get_server_database_version') ){
		$database_version = wc_get_server_database_version();
		$number = isset($database_version['number']) ? $database_version['number'] : '';
		if( $number ){
			if( version_compare( $number, '8.0.0', '>=' ) ){
				return true;
			}
		}
	}
	return false;
}

/*** Product size chart ***/
function loobek_get_product_size_chart_id(){
	global $product;
	$product_id = $product->get_id();
	$cache_key = 'loobek_size_chart_id_of_' . $product_id;
	$size_chart_id = wp_cache_get($cache_key);
	if( false !== $size_chart_id ){
		return $size_chart_id;
	}
	$size_chart_id = get_post_meta($product_id, 'ts_prod_size_chart', true);
	if( $size_chart_id ){
		wp_cache_set($cache_key, $size_chart_id);
		return $size_chart_id;
	}
	$product_cats = wc_get_product_term_ids( $product_id, 'product_cat' );
	if( !empty($product_cats) && is_array($product_cats) ){
		$args = array(
                    'posts_per_page'         => 1,
                    'order'                  => 'DESC',
                    'post_type'              => 'ts_size_chart',
                    'post_status'            => 'publish',
                    'no_found_rows'          => true,
                    'update_post_term_cache' => false,
                    'fields'                 => 'ids',
                );
				
		if( count( $product_cats ) > 1 ){
			$args['meta_query']['relation'] = 'OR';
		}
		
		foreach( $product_cats as $product_cat ){
			$args['meta_query'][] = array(
				'key'     => 'ts_chart_categories',
				'value'   => loobek_mysql_version_greater_8() ? "\\b{$product_cat}\\b" : "[[:<:]]{$product_cat}[[:>:]]",
				'compare' => 'RLIKE',
			);
		}
		
		$size_charts = new WP_Query( $args );
		if( $size_charts->have_posts() ){
			foreach( $size_charts->posts as $id ){
				$size_chart_id = $id;
			}
		}
		wp_reset_postdata();
	}
	wp_cache_set($cache_key, $size_chart_id);
	
	return $size_chart_id;
}

function loobek_product_size_chart_content(){
	$chart_id = loobek_get_product_size_chart_id();
	$chart_content = get_the_content( null, false, $chart_id );
	$chart_label = get_post_meta( $chart_id, 'ts_chart_label', true );
	$chart_image = get_post_meta( $chart_id, 'ts_chart_image', true );
	$chart_table = get_post_meta( $chart_id, 'ts_chart_table', true );
	
	if( $chart_table ){
		$chart_table = json_decode( $chart_table, true );
		if( is_array($chart_table) ){
			$chart_table = array_filter($chart_table, function($v, $k){
				return is_array($v) && array_filter($v);
			}, ARRAY_FILTER_USE_BOTH);
		}
	}
	
	$classes = array();
	if( $chart_image ){
		$classes[] = 'has-image';
	}
	
	if( !empty($chart_table) && is_array($chart_table) ){
		$classes[] = 'has-table';
	}
	
	?>
	<h2><?php esc_html_e('Size & Shape', 'loobek'); ?></h2>
	
	<div class="ts-size-chart-content <?php echo implode(' ', $classes); ?>">
		<?php
		if( $chart_label ){
			echo '<h5 class="chart-label">'.esc_html($chart_label).'</h5>';
		}
		
		if( $chart_content ){
			echo '<div class="chart-content">';
				echo wp_kses_post( do_shortcode( $chart_content ) ); /* Allowed html as post content */
			echo '</div>';
		}
		
		if( $chart_image ){
			echo '<div class="chart-image">';
				echo '<img src="'.esc_url($chart_image).'" alt="'.esc_attr($chart_label).'" />';
			echo '</div>';
		}
		
		if( !empty($chart_table) && is_array($chart_table) ){
			echo '<table class="chart-table"><tbody>';
			foreach( $chart_table as $row ){
				echo '<tr>';
				foreach( $row as $col ){
					echo '<td>'.esc_html($col).'</td>';
				}
				echo '</tr>';
			}
			echo '</tbody></table>';
		}
		?>
	</div>
	<?php
}

/*** Product tab ***/
function loobek_product_remove_tabs( $tabs = array() ){
	if( !loobek_get_theme_options('ts_prod_tabs') ){
		return array();
	}
	if( loobek_get_theme_options('ts_prod_separate_reviews_tab') ){
		unset( $tabs['reviews'] );
	}
	return $tabs;
}

function loobek_add_product_custom_tab( $tabs = array() ){
	global $post;
	$theme_options = loobek_get_theme_options();
	$size_chart_style = $theme_options['ts_prod_size_chart_style'];
	$show_size_chart = $theme_options['ts_prod_size_chart'] 
						&& ( $size_chart_style == 'tab' || ( $size_chart_style == 'popup' && wp_cache_get('ts_size_chart_added') === false ) );
	
	if( $show_size_chart && loobek_get_product_size_chart_id() ){
		$tabs['ts_size_chart'] = array(
			'title'    	=> esc_html__('Size & Shape', 'loobek')
			,'priority' => 25
			,'callback' => 'loobek_product_size_chart_content'
		);
	}
	
	$override_custom_tab = get_post_meta( $post->ID, 'ts_prod_custom_tab', true );
	if( $theme_options['ts_prod_custom_tab'] || $override_custom_tab ){
		if( $override_custom_tab ){
			$custom_tab_title = get_post_meta( $post->ID, 'ts_prod_custom_tab_title', true );
			$custom_tab_content = get_post_meta( $post->ID, 'ts_prod_custom_tab_content', true );
			loobek_change_theme_options( 'ts_prod_custom_tab_title', $custom_tab_title );
			loobek_change_theme_options( 'ts_prod_custom_tab_content', $custom_tab_content );
		}
		else{
			$custom_tab_title = $theme_options['ts_prod_custom_tab_title'];
		}

		$tabs['ts_custom'] = array(
			'title'    	=> esc_html( $custom_tab_title )
			,'priority' => 22
			,'callback' => 'loobek_product_custom_tab_content'
		);
	} 
	return $tabs;
}

function loobek_product_custom_tab_content(){
	global $post;
	
	$theme_options = loobek_get_theme_options();
	
	$custom_tab_title = $theme_options['ts_prod_custom_tab_title'];
	$custom_tab_content = $theme_options['ts_prod_custom_tab_content'];
	
	if( $custom_tab_title ){
		echo '<h2>' . esc_html($custom_tab_title) . '</h2>';
	}
	
	loobek_get_custom_block_content( $custom_tab_content );
}

function loobek_woocommerce_tabs_handle(){
	if( loobek_get_theme_options('ts_prod_tabs_show_content_default') ){
		loobek_change_theme_options('ts_prod_tabs_accordion', 0);
	}
	
	add_action('woocommerce_product_additional_information', function(){
		echo '<div>';
	}, 5);
	
	add_action('woocommerce_product_additional_information', function(){
		echo '</div>';
	}, 15);
	
	add_filter('woocommerce_reviews_title', 'loobek_woocommerce_reviews_title', 10, 3);
}

function loobek_woocommerce_reviews_title( $reviews_title, $count, $product ){
	return esc_html__('Reviews', 'loobek');
}

/* Ads Banner */
function loobek_product_custom_content(){
	if( $content = loobek_get_theme_options('ts_prod_custom_content') ){
		echo '<div class="product-custom-content ts-custom-block-content hidden">';
		loobek_get_custom_block_content( $content );
		echo '</div>';
	}
}

/* Related Products */
function loobek_upsells_products_heading_filter( $heading ){
	if( $custom_heading = loobek_get_theme_options('ts_prod_upsells_heading') ){
		return $custom_heading;
	}
	return $heading;
}

function loobek_related_products_heading_filter( $heading ){
	if( $custom_heading = loobek_get_theme_options('ts_prod_related_heading') ){
		return $custom_heading;
	}
	return $heading;
}

function loobek_output_related_products_args_filter( $args ){
	$args['posts_per_page'] = 6;
	$args['columns'] = 5;
	return $args;
}

/* Bestseller Products */
function loobek_single_bestseller_products(){
	global $product;
	$theme_options = loobek_get_theme_options();
	if( !$theme_options['ts_prod_bestsellers'] ){
		return;
	}
	
	$limit = absint($theme_options['ts_prod_bestsellers_limit']);
	
	$args = array(
		'post_type'				=> 'product'
		,'post_status' 			=> 'publish'
		,'posts_per_page' 		=> $limit
		,'meta_query' 			=> WC()->query->get_meta_query()
		,'tax_query'           	=> WC()->query->get_tax_query()
		,'meta_key'           	=> 'total_sales'
		,'orderby'           	=> 'meta_value_num'
		,'order'           		=> 'desc'
	);
	
	if( $theme_options['ts_prod_bestsellers_based_category'] ){
		$product_cats = wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'ids' ) );
		if( !empty( $product_cats ) ){
			$args['tax_query'][] = array(
								'taxonomy' 	=> 'product_cat'
								,'terms' 	=> $product_cats
								,'field' 	=> 'term_id'
							);
		}
	}
	
	$products = new WP_Query( $args );
	if( !$products->have_posts() ){
		return;
	}
	
	wc_set_loop_prop( 'is_shortcode', true );
	
	?>
	<section class="related bestsellers products">
		<?php if( $theme_options['ts_prod_bestsellers_heading'] ){ ?>
		<h2><?php echo esc_html( $theme_options['ts_prod_bestsellers_heading'] ); ?></h2>
		<?php } ?>
		
		<?php
		woocommerce_product_loop_start();
		while( $products->have_posts() ){ 
			$products->the_post();	
			wc_get_template_part( 'content', 'product' );
		}
		woocommerce_product_loop_end();
		?>
	</section>
	<?php
	
	wc_set_loop_prop( 'is_shortcode', false );
	
	wp_reset_postdata();
}

function loobek_related_upsell_bestseller_products_before(){
?>
	<div class="related-up-sells-bestsellers">
<?php
}

function loobek_related_upsell_bestseller_products_after(){
?>
	</div>
<?php
}

/* Grouped product */
function loobek_grouped_product_handle(){
	if( loobek_get_theme_options('ts_prod_grouped_product_checkbox_style') ){
		add_action('woocommerce_before_add_to_cart_form', 'loobek_woocommerce_grouped_product_form_heading');
		
		add_action('woocommerce_grouped_product_list_before_label', 'loobek_woocommerce_grouped_product_extra_columns');
		
		add_filter('woocommerce_grouped_product_list_column_label', 'loobek_woocommerce_grouped_product_price', 10, 2);
		
		add_action('woocommerce_before_add_to_cart_button', 'loobek_woocommerce_grouped_product_before_add_to_cart_button');
	}

	add_filter('woocommerce_grouped_product_columns', 'loobek_woocommerce_grouped_product_columns');
}

function loobek_woocommerce_grouped_product_form_heading(){
	global $product;
	if( $product->get_type() == 'grouped' && $heading = loobek_get_theme_options('ts_prod_grouped_product_heading') ){
		echo '<h5 class="grouped-product-heading">' . esc_html($heading) . '</h5>';
	}
}

function loobek_woocommerce_grouped_product_extra_columns( $product_child ){
	$is_purchasable = $product_child->get_type() == 'simple' && $product_child->is_purchasable() && $product_child->is_in_stock();
    ?>
	<td class="woocommerce-grouped-product-list-item__checkbox">
		<label class="<?php echo !$is_purchasable ? 'disabled' : '' ?>">
			<input type="checkbox" value="1" class="grouped-product-item-checkbox" <?php echo !$is_purchasable ? 'disabled="disabled"': ''; ?> />
		</label>
	</td>
    <td class="woocommerce-grouped-product-list-item__thumbnail">
        <?php echo wp_kses( $product_child->get_image(), 'loobek_product_image' ); ?>
    </td>
    <?php
}

function loobek_woocommerce_grouped_product_price( $value, $product_child ){
	$value .= $product_child->get_price_html();
	return $value;
}

function loobek_woocommerce_grouped_product_before_add_to_cart_button(){
	global $product;
	if( $product->get_type() == 'grouped' ){
		woocommerce_quantity_input(
			array(
				'min_value'    => 1
				,'max_value'   => -1
				,'input_name'  => 'grouped_quantity'
				,'input_value' => isset( $_POST['quantity'] ) ? intval( wp_unslash( $_POST['quantity'] ) ) : 1
			)
		);
	}
}

function loobek_woocommerce_grouped_product_columns( $columns ){
	$columns = array('label', 'price', 'quantity');
	if( loobek_get_theme_options('ts_prod_grouped_product_checkbox_style') ){
		$columns = array('label', 'quantity');
	}
	return $columns;
}
/*** General hook ***/

/*************************************************************
* Custom group button on product (quickshop, wishlist, compare) 
* Begin tag: 	10000
* Wishlist:  	10001
* Quickshop: 	10002
* Compare:   	10003
* Add To Cart: 	10004
* End tag:   	10005
**************************************************************/
add_action('woocommerce_after_shop_loop_item_title', 'loobek_template_loop_add_to_cart', 10004 );
function loobek_product_group_button_start(){	
	echo '<div class="product-group-button">';
}

function loobek_product_group_button_end(){
	echo '</div>';
}

add_action('init', 'loobek_wrap_product_group_button', 20);
function loobek_wrap_product_group_button(){
	add_action('woocommerce_after_shop_loop_item_title', 'loobek_product_group_button_start', 10000 );
	add_action('woocommerce_after_shop_loop_item_title', 'loobek_product_group_button_end', 10005 );
}

/* Wishlist */
if( class_exists('YITH_WCWL') ){
	function loobek_add_wishlist_button_to_product_list(){
		echo '<div class="button-in wishlist">';
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		echo '</div>';
	}
	
	if( 'yes' == get_option( 'yith_wcwl_show_on_loop', 'no' ) ){
		add_action( 'woocommerce_after_shop_loop_item_title', 'loobek_add_wishlist_button_to_product_list', 10001 );
		add_action( 'woocommerce_after_shop_loop_item', 'loobek_add_wishlist_button_to_product_list', 75 );
		
		add_filter( 'yith_wcwl_loop_positions', '__return_empty_array' ); /* Remove button which added by plugin */
	}
	
	add_filter('yith_wcwl_add_to_wishlist_params', 'loobek_yith_wcwl_add_to_wishlist_params');
	function loobek_yith_wcwl_add_to_wishlist_params( $additional_params ){
		if( isset($additional_params['container_classes']) && $additional_params['exists'] ){
			$additional_params['container_classes'] .= ' added';
		}
		$additional_params['label'] = '<span class="ts-tooltip button-tooltip" data-title="'.esc_attr__('Add to wishlist', 'loobek').'">' . esc_html__('Wishlist', 'loobek') . '</span>';
		return $additional_params;
	}
	
	add_filter('yith_wcwl_browse_wishlist_label', 'loobek_yith_wcwl_browse_wishlist_label', 10, 2);
	function loobek_yith_wcwl_browse_wishlist_label( $text = '', $product_id = 0 ){
		if( $product_id ){
			return '<span class="ts-tooltip button-tooltip" data-title="'.esc_attr__('Add to wishlist', 'loobek').'">' . esc_html__('Wishlist', 'loobek') . '</span>';
		}
		return $text;
	}
}

/* Compare */
if( class_exists('YITH_Woocompare') ){
	add_action('init', 'loobek_yith_compare_handle', 30);
	function loobek_yith_compare_handle(){
		global $yith_woocompare;
		$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
		if( $yith_woocompare->is_frontend() || $is_ajax ){
			if( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
				if( $is_ajax ){
					if( defined('YITH_WOOCOMPARE_DIR') && !class_exists('YITH_Woocompare_Frontend') ){
						$compare_frontend_class = YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
						if( file_exists($compare_frontend_class) ){
							require_once $compare_frontend_class;
						}
						$yith_woocompare->obj = new YITH_Woocompare_Frontend();
					}
				}
				remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
				
				add_action( 'woocommerce_after_shop_loop_item_title', 'loobek_add_compare_button_to_product_list', 10003 );
				add_action( 'woocommerce_after_shop_loop_item', 'loobek_add_compare_button_to_product_list', 80 );
			}
			
			add_filter( 'option_yith_woocompare_button_text', 'loobek_compare_button_text_filter', 99 );
		}
	}
	
	function loobek_add_compare_button_to_product_list(){
		global $yith_woocompare, $product;
		echo '<div class="button-in compare">';
		echo '<a class="compare" href="'.$yith_woocompare->obj->add_product_url( $product->get_id() ).'" data-product_id="'.$product->get_id().'">'.get_option('yith_woocompare_button_text').'</a>';
		echo '</div>';
	}
	
	function loobek_compare_button_text_filter( $button_text ){
		return '<span class="ts-tooltip button-tooltip" data-title="'.esc_attr__('Add to compare', 'loobek').'">'.esc_html($button_text).'</span>';
	}
}

/* Ask about product */
function loobek_ask_about_product_button(){
	if( $contact_page = loobek_get_theme_options('ts_prod_contact_page') ){
	?>
	<a href="<?php echo esc_url( get_permalink($contact_page) ); ?>" target="_blank" class="ask-about-product-button"><?php esc_html_e( 'Ask about product', 'loobek' ); ?></a>
	<?php
	}
}

/*************************************************************
* Group button on single product (wishlist, compare, ask about product)
* Begin tag: 31
* Wishlist: 31
* Compare: 35
* Ask about product: 40
* End tag: 41
*************************************************************/
function loobek_single_product_group_button_start(){
?>
	<div class="single-product-buttons">
<?php
}

function loobek_single_product_group_button_end(){
?>
	</div>
<?php
}

/*************************************************************
* Group button on product meta (add to cart, wishlist, compare) 
* Begin tag: 69
* Add to cart: 70
* Wishlist: 75
* Compare: 80
* Quickshop: 81
* End tag: 82
*************************************************************/
add_action('woocommerce_after_shop_loop_item', 'loobek_product_group_button_meta_start', 69);
add_action('woocommerce_after_shop_loop_item', 'loobek_product_group_button_meta_end', 82);
function loobek_product_group_button_meta_start(){
	echo '<div class="product-group-button-meta">';
}
function loobek_product_group_button_meta_end(){
	echo '</div>';
}

/*** End General hook ***/

function loobek_get_product_low_stock_notice( $product ){
	$theme_options = loobek_get_theme_options();
	if( $theme_options['ts_prod_low_stock_notice'] ){
		if( is_singular('product') || ( isset($_POST['action']) && $_POST['action'] == 'loobek_load_quickshop_content' ) ){
			if( is_object($product) && in_array( $product->get_type(), array('simple', 'variation') ) && $product->is_in_stock() ){
				$stock_quantity = $product->get_stock_quantity();
				if( $stock_quantity > 0 && $stock_quantity <= absint( $theme_options['ts_prod_low_stock_notice_threshold'] ) ){
					return sprintf( __('Hurry! Only %d left in stock', 'loobek'), $stock_quantity );
				}
			}
		}
	}
	return '';
}

/*** Quantity Input hooks ***/
add_action('woocommerce_before_quantity_input_field', 'loobek_before_quantity_input_field', 1);
function loobek_before_quantity_input_field(){
	global $product;
	?>
	<label class="ts-screen-reader-text"><?php esc_html_e('Quantity', 'loobek'); ?><span class="ts-low-stock-notice"><?php echo esc_html( loobek_get_product_low_stock_notice( $product ) ); ?></span></label>
	<div class="number-button">
		<input type="button" value="-" class="minus" />
	<?php
}

add_action('woocommerce_after_quantity_input_field', 'loobek_after_quantity_input_field', 99);
function loobek_after_quantity_input_field(){
	?>
		<input type="button" value="+" class="plus" />
	</div>
	<?php
}

/*** Cart - Checkout hooks ***/
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );

add_filter('woocommerce_product_cross_sells_products_heading', 'loobek_product_cross_sells_products_heading');
function loobek_product_cross_sells_products_heading(){
	return __('Customers also bought', 'loobek');
}

add_action('woocommerce_cart_actions', 'loobek_empty_cart_button');
function loobek_empty_cart_button(){
?>
	<button type="submit" class="button button-border empty-cart-button" name="ts_empty_cart" value="<?php esc_attr_e('Empty cart', 'loobek'); ?>"><?php esc_html_e('Empty cart', 'loobek'); ?></button>
<?php
}

add_action('init', 'loobek_empty_woocommerce_cart');
function loobek_empty_woocommerce_cart(){
	if( isset($_POST['ts_empty_cart']) ){
		WC()->cart->empty_cart();
	}
}

add_action('woocommerce_before_checkout_form', 'loobek_before_checkout_form_start', 1);
add_action('woocommerce_before_checkout_form', 'loobek_before_checkout_form_end', 999);
function loobek_before_checkout_form_start(){
	echo '<div class="checkout-login-coupon-wrapper">';
}
function loobek_before_checkout_form_end(){
	echo '</div>';
}

remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
add_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 20);

remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
add_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 1000);

if( !( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) ){
	add_action('woocommerce_before_checkout_form', function(){
		echo '<div class="checkout-login-wrapper">';
	}, 9);
	add_action('woocommerce_before_checkout_form', function(){
		echo '</div>';
	}, 11);
}

if( function_exists('wc_coupons_enabled') && wc_coupons_enabled() ){
	add_action('woocommerce_before_checkout_form', function(){
		echo '<div class="checkout-coupon-wrapper">';
	}, 19);
	add_action('woocommerce_before_checkout_form', function(){
		echo '</div>';
	}, 21);
}
?>