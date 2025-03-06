<?php
if( !isset($data) ){
	$data = loobek_get_theme_options();
}

$default_options = array(
				'ts_layout_fullwidth'								=> 0
				,'ts_logo_width'									=> "172"
				,'ts_ipad_logo_width'								=> "130"
				,'ts_mobile_logo_width'								=> "110"
				,'ts_custom_font_ttf'								=> array( 'url' => '' )
		);
		
foreach( $default_options as $option_name => $value ){
	if( isset($data[$option_name]) ){
		$default_options[$option_name] = $data[$option_name];
	}
}

extract($default_options);
		
$default_colors = array(

				'ts_main_content_bg'										=> "#ffffff"
				,'ts_text_color'											=> "#000000"
				
				,'ts_input_color'											=> "#000000"
				,'ts_input_hover_color'										=> "#000000"
				,'ts_input_color'											=> "#000000"
				,'ts_input_hover_color'										=> "#000000"
				
				,'ts_link_color'											=> "#c6213b"
				,'ts_link_hover_color'										=> "#c6213b"
				
				,'ts_text_light_color'										=> "#808080"
				,'ts_text_bold_color'										=> "#000000"
				
				,'ts_primary_color'											=> "#c6213b"
				,'ts_text_in_bg_primary'									=> "#ffffff"
				
				,'ts_border_color'											=> "#e5e5e5"

				,'ts_button_color'											=> "#ffffff"
				,'ts_button_hover_color'									=> "#ffffff"
				,'ts_button_bg'												=> "#000000"
				,'ts_button_hover_bg'										=> "#c6213b"
				,'ts_button_border_color'									=> "#000000"
				,'ts_button_hover_border'									=> "#c6213b"
				
				,'ts_nav_color'												=> "#000000"
				,'ts_nav_hover_color'										=> "#00000"
				,'ts_nav_bg'												=> "#ffffff"
				,'ts_nav_hover_bg'											=> "#f5f5f5"
				
				// BREADCRUMB
				,'ts_breadcrumb_color'										=> "#000000"
				,'ts_breadcrumb_link_hover'									=> "#c6213b"
				,'ts_breadcrumb_bg'											=> "#ffffff"
				,'ts_breadcrumb_border_color'								=> "#e5e5e5"
				
				,'ts_breadcrumb_img_color'									=> "#ffffff"
				,'ts_breadcrumb_img_link_hover'								=> "#c6213b"
				
				// HEADER
				,'ts_top_header_color'										=> "#000000"
				,'ts_top_header_hover_color'								=> "#c6213b"
				,'ts_top_header_bg'											=> "#ffffff"
				,'ts_top_header_border_color'								=> "#e5e5e5"
				
				,'ts_middle_header_color'									=> "#000000"
				,'ts_middle_header_link_hover'								=> "#c6213b"
				,'ts_middle_header_bg'										=> "#ffffff"
				,'ts_middle_header_border_color'							=> "#e5e5e5"
				
				,'ts_header_cart_number_color'								=> "#ffffff"
				,'ts_header_cart_number_bg'									=> "#000000"
				
				,'ts_header_search_color'									=> "#000000"
				,'ts_header_search_placeholder_color'						=> "#999999"
				,'ts_header_search_bg'										=> "#f0f0f0"
				,'ts_header_search_border_color'							=> "#f0f0f0"
				,'ts_header_search_icon_color'								=> "#000000"
				,'ts_header_search_hover_icon'								=> "#c6213b"
				
				,'ts_bottom_header_text_color'								=> "#707070"
				,'ts_bottom_header_bg'										=> "#ffffff"
				,'ts_bottom_header_border_color'							=> "#e5e5e5"
				
				
				// MENU
				,'ts_menu_color'											=> "#000000"
				,'ts_menu_hover_color'										=> "#000000"

				,'ts_sub_menu_color'										=> "#000000"
				,'ts_sub_menu_heading_color'								=> "#000000"
				,'ts_sub_menu_hover_color'									=> "#c6213b"
				,'ts_sub_menu_bg'											=> "#ffffff"
				
				,'ts_menu_2_color'											=> "#808080"
				,'ts_menu_2_hover_color'									=> "#000000"
				,'ts_menu_2_active_color'									=> "#ffffff"
				,'ts_menu_2_active_bg'										=> "#000000"
				
				,'ts_notice_color'											=> "#ffffff"
				,'ts_notice_bg'												=> "#c6213b"
				,'ts_notice_border'											=> "#c6213b"
				
				,'ts_header_mobile_color'									=> "#000000"
				,'ts_header_mobile_hover_color'								=> "#c6213b"
				,'ts_header_mobile_bg'										=> "#ffffff"
				,'ts_header_mobile_border_color'							=> "#e5e5e5"
				,'ts_header_mobile_cart_color'								=> "#ffffff"
				,'ts_header_mobile_cart_bg'									=> "#000000"
				
				,'ts_menu_mobile_color'										=> "#000000"
				,'ts_menu_mobile_hover_color'								=> "#c6213b"
				,'ts_menu_mobile_title_active_color'						=> "#808080"
				,'ts_menu_mobile_bg'										=> "#ffffff"
				,'ts_menu_mobile_border_color'								=> "#e5e5e5"
				
				,'ts_menu_bottom_mobile_color'								=> "#000000"
				,'ts_menu_bottom_mobile_hover_color'						=> "#c6213b"
				,'ts_menu_bottom_mobile_bg'									=> "#ffffff"
				,'ts_menu_bottom_mobile_border_color'						=> "#e5e5e5"
				
				// FOOTER
				,'ts_footer_color'											=> "#000000"
				,'ts_footer_hover_color'									=> "#c6213b"
				,'ts_footer_heading_color'									=> "#000000"
				,'ts_footer_bg'												=> "#ffffff"
				,'ts_footer_border_color'									=> "#e5e5e5"

				// PRODUCT	
				,'ts_rating_color'											=> "#fbbf0a"
				
				,'ts_product_detail_deal_color'								=> "#c6213b"
				,'ts_product_detail_deal_bg'								=> "#fee9ec"
				,'ts_shop_bg'												=> "#fafafa"
				,'ts_quantity_bg'											=> "#f0f0f0"

				,'ts_product_button_thumbnail_color'						=> "#000000"
				,'ts_product_button_thumbnail_hover_hover'					=> "#ffffff"
				,'ts_product_button_thumbnail_bg'							=> "#ffffff"
				,'ts_product_button_thumbnail_bg_hover'						=> "#000000"

				,'ts_product_sale_label_color'								=> "#ffffff"
				,'ts_product_sale_label_bg'									=> "#c6213b"
				,'ts_product_new_label_color'								=> "#000000"
				,'ts_product_new_label_bg'									=> "#ffffff"
				,'ts_product_feature_label_color'							=> "#ffffff"
				,'ts_product_feature_label_bg'								=> "#115241"
				,'ts_product_outstock_label_color'							=> "#000000"
				,'ts_product_outstock_label_bg'								=> "#f0f0f0"

				,'ts_product_price_color'									=> "#000000"
				,'ts_product_del_price_color'								=> "#808080"
				,'ts_product_sale_price_color'								=> "#c6213b"
				
);

$data = apply_filters('loobek_custom_style_data', $data);

foreach( $default_colors as $option_name => $default_color ){
	if( isset($data[$option_name]['rgba']) ){
		$default_colors[$option_name] = $data[$option_name]['rgba'];
	}
	else if( isset($data[$option_name]['color']) ){
		$default_colors[$option_name] = $data[$option_name]['color'];
	}
}

extract( $default_colors );

/* Parse font option. Ex: if option name is ts_body_font, we will have variables below:
* ts_body_font (font-family)
* ts_body_font_weight
* ts_body_font_style
* ts_body_font_size
* ts_body_font_line_height
* ts_body_font_letter_spacing
*/
$font_option_names = array(
							'ts_body_font',
							'ts_body_font_bold',
							'ts_body_font_extra_bold',
							'ts_body_font_thin',
							'ts_heading_font',
							'ts_menu_font',
							'ts_second_menu_font',
							);
$font_size_option_names = array( 
							'ts_h1_font', 
							'ts_h2_font', 
							'ts_h3_font', 
							'ts_h4_font', 
							'ts_h5_font', 
							'ts_h6_font',
							'ts_small_font',
							'ts_small_2_font',
							'ts_button_font',
							'ts_product_name_font',
							'ts_sub_cat_font',
							'ts_sub_cat_device_font',
							'ts_menu_ipad_font',
							'ts_h1_ipad_font', 
							'ts_h2_ipad_font', 
							'ts_h3_ipad_font', 
							'ts_h4_ipad_font',
							'ts_h5_ipad_font',
							'ts_h6_ipad_font',
							'ts_heading_ipad_font',
							'ts_h1_mobile_font', 
							'ts_h2_mobile_font',
							);
$font_option_names = array_merge($font_option_names, $font_size_option_names);
foreach( $font_option_names as $option_name ){
	$default = array(
		$option_name 						=> 'inherit'
		,$option_name . '_weight' 			=> 'normal'
		,$option_name . '_style' 			=> 'normal'
		,$option_name . '_size' 			=> 'inherit'
		,$option_name . '_line_height' 		=> 'inherit'
		,$option_name . '_letter_spacing' 	=> 'inherit'
	);
	if( is_array($data[$option_name]) ){
		if( !empty($data[$option_name]['font-family']) ){
			$default[$option_name] = $data[$option_name]['font-family'];
		}
		if( !empty($data[$option_name]['font-weight']) ){
			$default[$option_name . '_weight'] = $data[$option_name]['font-weight'];
		}
		if( !empty($data[$option_name]['font-style']) ){
			$default[$option_name . '_style'] = $data[$option_name]['font-style'];
		}
		if( !empty($data[$option_name]['font-size']) ){
			$default[$option_name . '_size'] = $data[$option_name]['font-size'];
		}
		if( !empty($data[$option_name]['line-height']) ){
			$default[$option_name . '_line_height'] = $data[$option_name]['line-height'];
		}
		if( !empty($data[$option_name]['letter-spacing']) ){
			$default[$option_name . '_letter_spacing'] = $data[$option_name]['letter-spacing'];
		}
	}
	extract( $default );
}
?>	
/********** FONT FAMILY **********/
	
<?php 
/* Custom Font */
if( isset($ts_custom_font_ttf) && $ts_custom_font_ttf['url'] ):
?>
@font-face {
	font-family: 'CustomFont';
	src:url('<?php echo esc_url($ts_custom_font_ttf['url']); ?>') format('truetype');
	font-weight: normal;
	font-style: normal;
}
<?php endif; ?>	
:root{
	--loobek-logo-width: <?php echo absint($ts_logo_width); ?>px;
	--loobek-logo-ipad-width: <?php echo absint($ts_ipad_logo_width); ?>px;
	--loobek-logo-mobile-width: <?php echo absint($ts_mobile_logo_width); ?>px;
	
	--loobek-main-font: <?php echo esc_html($ts_body_font); ?>;
	--loobek-main-font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
	--loobek-main-letter-spacing: <?php echo esc_html($ts_body_font_letter_spacing); ?>;
	--loobek-main-font-bold: <?php echo esc_html($ts_body_font_bold); ?>;
	--loobek-main-font-bold-weight: <?php echo esc_html($ts_body_font_bold_weight); ?>;
	--loobek-main-font-extra-bold: <?php echo esc_html($ts_body_font_extra_bold); ?>;
	--loobek-main-font-extra-bold-weight: <?php echo esc_html($ts_body_font_extra_bold_weight); ?>;
	--loobek-main-font-thin: <?php echo esc_html($ts_body_font_thin); ?>;
	--loobek-main-font-thin-weight: <?php echo esc_html($ts_body_font_thin_weight); ?>;
	--loobek-main-font-size: <?php echo esc_html($ts_body_font_size); ?>;
	--loobek-main-font-line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
	--loobek-main-font-bold-size: <?php echo esc_html($ts_body_font_bold_size); ?>;
	--loobek-main-font-bold-line-height: <?php echo esc_html($ts_body_font_bold_line_height); ?>;
	--loobek-main-small-font-size: <?php echo esc_html($ts_small_font_size); ?>;
	--loobek-main-small-2-font-size: <?php echo esc_html($ts_small_2_font_size); ?>;
	
	--loobek-button-font: <?php echo esc_html($ts_button_font); ?>;
	--loobek-button-font-weight: <?php echo esc_html($ts_button_font_weight); ?>;
	--loobek-button-font-size: <?php echo esc_html($ts_button_font_size); ?>;
	
	--loobek-menu-font: <?php echo esc_html($ts_menu_font); ?>;
	--loobek-menu-font-weight: <?php echo esc_html($ts_menu_font_weight); ?>;
	--loobek-menu-font-size: <?php echo esc_html($ts_menu_font_size); ?>;
	--loobek-menu-letter-spacing: <?php echo esc_html($ts_menu_font_letter_spacing); ?>;
	--loobek-second-menu-font: <?php echo esc_html($ts_second_menu_font); ?>;
	--loobek-second-menu-font-weight: <?php echo esc_html($ts_second_menu_font_weight); ?>;
	--loobek-second-menu-font-size: <?php echo esc_html($ts_second_menu_font_size); ?>;
	--loobek-second-menu-line-height: <?php echo esc_html($ts_second_menu_font_line_height); ?>;
	
	--loobek-product-name-font: <?php echo esc_html($ts_product_name_font); ?>;
	--loobek-product-name-font-weight: <?php echo esc_html($ts_product_name_font_weight); ?>;
	--loobek-product-name-font-size: <?php echo esc_html($ts_product_name_font_size); ?>;
	--loobek-product-name-font-line-height: <?php echo esc_html($ts_product_name_font_line_height); ?>;
	
	--loobek-heading-font: <?php echo esc_html($ts_heading_font); ?>;
	--loobek-heading-font-weight: <?php echo esc_html($ts_heading_font_weight); ?>;
	--loobek-heading-font-size: <?php echo esc_html($ts_heading_font_size); ?>;
	--loobek-heading-line-height: <?php echo esc_html($ts_heading_font_line_height); ?>;
	--loobek-heading-letter-spacing: <?php echo esc_html($ts_heading_font_letter_spacing); ?>;
	
	--loobek-h1-font-size: <?php echo esc_html($ts_h1_font_size); ?>;
	--loobek-h1-line-height: <?php echo esc_html($ts_h1_font_line_height); ?>;
	--loobek-h2-font-size: <?php echo esc_html($ts_h2_font_size); ?>;
	--loobek-h2-line-height: <?php echo esc_html($ts_h2_font_line_height); ?>;
	--loobek-h3-font-size: <?php echo esc_html($ts_h3_font_size); ?>;
	--loobek-h3-line-height: <?php echo esc_html($ts_h3_font_line_height); ?>;
	--loobek-h3-height: -<?php echo esc_html($ts_h3_font_line_height); ?>;
	--loobek-h4-font-size: <?php echo esc_html($ts_h4_font_size); ?>;
	--loobek-h4-line-height: <?php echo esc_html($ts_h4_font_line_height); ?>;
	--loobek-h5-font-size: <?php echo esc_html($ts_h5_font_size); ?>;
	--loobek-h5-line-height: <?php echo esc_html($ts_h5_font_line_height); ?>;
	--loobek-h6-font-size: <?php echo esc_html($ts_h6_font_size); ?>;
	--loobek-h6-line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
	
	--loobek-sub-cat-font: <?php echo esc_html($ts_sub_cat_font); ?>;
	--loobek-sub-cat-font-weight: <?php echo esc_html($ts_sub_cat_font_weight); ?>;
	--loobek-sub-cat-font-size: <?php echo esc_html($ts_sub_cat_font_size); ?>;
	--loobek-menu-ipad-font-size: <?php echo esc_html($ts_menu_ipad_font_size); ?>;
	--loobek-sub-cat-device-font-size: <?php echo esc_html($ts_sub_cat_device_font_size); ?>;
	--loobek-h1-device-font-size: <?php echo esc_html($ts_h1_ipad_font_size); ?>;
	--loobek-h1-device-line-height: <?php echo esc_html($ts_h1_ipad_font_line_height); ?>;
	--loobek-h2-device-font-size: <?php echo esc_html($ts_h2_ipad_font_size); ?>;
	--loobek-h2-device-line-height: <?php echo esc_html($ts_h2_ipad_font_line_height); ?>;
	--loobek-h3-device-font-size: <?php echo esc_html($ts_h3_ipad_font_size); ?>;
	--loobek-h3-device-line-height: <?php echo esc_html($ts_h3_ipad_font_line_height); ?>;
	--loobek-h3-device-height: -<?php echo esc_html($ts_h3_ipad_font_line_height); ?>;
	--loobek-h4-device-font-size: <?php echo esc_html($ts_h4_ipad_font_size); ?>;
	--loobek-h4-device-line-height: <?php echo esc_html($ts_h4_ipad_font_line_height); ?>;
	--loobek-h5-device-font-size: <?php echo esc_html($ts_h5_ipad_font_size); ?>;
	--loobek-h5-device-line-height: <?php echo esc_html($ts_h5_ipad_font_line_height); ?>;
	--loobek-h6-device-font-size: <?php echo esc_html($ts_h6_ipad_font_size); ?>;
	--loobek-h6-device-line-height: <?php echo esc_html($ts_h6_ipad_font_line_height); ?>;
	--loobek-heading-device-font-size: <?php echo esc_html($ts_heading_ipad_font_size); ?>;
	--loobek-heading-device-line-height: <?php echo esc_html($ts_heading_ipad_font_line_height); ?>;
	
	--loobek-h1-mobile-font-size: <?php echo esc_html($ts_h1_mobile_font_size); ?>;
	--loobek-h1-mobile-line-height: <?php echo esc_html($ts_h1_mobile_font_line_height); ?>;
	--loobek-h2-mobile-font-size: <?php echo esc_html($ts_h2_mobile_font_size); ?>;
	--loobek-h2-mobile-line-height: <?php echo esc_html($ts_h2_mobile_font_line_height); ?>;
	
	--loobek-primary-color: <?php echo esc_html($ts_primary_color); ?>;
	--loobek-text-in-primary-color: <?php echo esc_html($ts_text_in_bg_primary); ?>;
	--loobek-main-bg: <?php echo esc_html($ts_main_content_bg); ?>;
	--loobek-text-color: <?php echo esc_html($ts_text_color); ?>;
	--loobek-text-light-color: <?php echo esc_html($ts_text_light_color); ?>;
	--loobek-text-bold-color: <?php echo esc_html($ts_text_bold_color); ?>;
	--loobek-link-color: <?php echo esc_html($ts_link_color); ?>;
	--loobek-link-hover-color: <?php echo esc_html($ts_link_hover_color); ?>;
	--loobek-border: <?php echo esc_html($ts_border_color); ?>;
	
	--loobek-input-color: <?php echo esc_html($ts_input_color); ?>;
	--loobek-input-border: <?php echo esc_html($ts_input_color); ?>;
	--loobek-input-hover-color: <?php echo esc_html($ts_input_hover_color); ?>;
	--loobek-input-hover-border: <?php echo esc_html($ts_input_hover_color); ?>;
	
	--loobek-button-color: <?php echo esc_html($ts_button_color); ?>;
	--loobek-button-bg: <?php echo esc_html($ts_button_bg); ?>;
	--loobek-button-border: <?php echo esc_html($ts_button_border_color); ?>;
	--loobek-button-hover-color: <?php echo esc_html($ts_button_hover_color); ?>;
	--loobek-button-hover-bg: <?php echo esc_html($ts_button_hover_bg); ?>;
	--loobek-button-hover-border: <?php echo esc_html($ts_button_hover_border); ?>;
	
	--loobek-breadcrumb-color: <?php echo esc_html($ts_breadcrumb_color); ?>;
	--loobek-breadcrumb-bg: <?php echo esc_html($ts_breadcrumb_bg); ?>;
	--loobek-breadcrumb-border-color: <?php echo esc_html($ts_breadcrumb_border_color); ?>;
	--loobek-breadcrumb-link-hover: <?php echo esc_html($ts_breadcrumb_link_hover); ?>;
	--loobek-breadcrumb-img-color: <?php echo esc_html($ts_breadcrumb_img_color); ?>;
	--loobek-breadcrumb-img-link-hover: <?php echo esc_html($ts_breadcrumb_img_link_hover); ?>;
	
	--loobek-nav-color: <?php echo esc_html($ts_nav_color); ?>;
	--loobek-nav-hover-color: <?php echo esc_html($ts_nav_hover_color); ?>;
	--loobek-nav-bg: <?php echo esc_html($ts_nav_bg); ?>;
	--loobek-nav-hover-bg: <?php echo esc_html($ts_nav_hover_bg); ?>;
	
	--loobek-notice-bg: <?php echo esc_html($ts_notice_bg); ?>;
	--loobek-notice-color: <?php echo esc_html($ts_notice_color); ?>;
	--loobek-notice-border-color: <?php echo esc_html($ts_notice_border); ?>;
	
	--loobek-menu-color: <?php echo esc_html($ts_menu_color); ?>;
	--loobek-menu-hover-color: <?php echo esc_html($ts_menu_hover_color); ?>;
	--loobek-submenu-color: <?php echo esc_html($ts_sub_menu_color); ?>;
	--loobek-submenu-heading-color: <?php echo esc_html($ts_sub_menu_heading_color); ?>;
	--loobek-submenu-hover-color: <?php echo esc_html($ts_sub_menu_hover_color); ?>;
	--loobek-submenu-bg: <?php echo esc_html($ts_sub_menu_bg); ?>;
	--loobek-menu-2-color: <?php echo esc_html($ts_menu_2_color); ?>;
	--loobek-menu-2-hover-color: <?php echo esc_html($ts_menu_2_hover_color); ?>;
	--loobek-menu-2-active-color: <?php echo esc_html($ts_menu_2_active_color); ?>;
	--loobek-menu-2-active-bg: <?php echo esc_html($ts_menu_2_active_bg); ?>;
	
	--loobek-header-mobile-color: <?php echo esc_html($ts_header_mobile_color); ?>;
	--loobek-header-mobile-hover-color: <?php echo esc_html($ts_header_mobile_hover_color); ?>;
	--loobek-header-mobile-bg: <?php echo esc_html($ts_header_mobile_bg); ?>;
	--loobek-header-mobile-border-color: <?php echo esc_html($ts_header_mobile_border_color); ?>;
	--loobek-header-mobile-cart-color: <?php echo esc_html($ts_header_mobile_cart_color); ?>;
	--loobek-header-mobile-cart-bg: <?php echo esc_html($ts_header_mobile_cart_bg); ?>;
	
	--loobek-menu-mobile-color: <?php echo esc_html($ts_menu_mobile_color); ?>;
	--loobek-menu-mobile-hover-color: <?php echo esc_html($ts_menu_mobile_hover_color); ?>;
	--loobek-menu-mobile-title-active-color: <?php echo esc_html($ts_menu_mobile_title_active_color); ?>;
	--loobek-menu-mobile-bg: <?php echo esc_html($ts_menu_mobile_bg); ?>;
	--loobek-menu-mobile-border-color: <?php echo esc_html($ts_menu_mobile_border_color); ?>;
	
	--loobek-menu-bottom-mobile-color: <?php echo esc_html($ts_menu_bottom_mobile_color); ?>;
	--loobek-menu-bottom-mobile-hover: <?php echo esc_html($ts_menu_bottom_mobile_hover_color); ?>;
	--loobek-menu-bottom-bg: <?php echo esc_html($ts_menu_bottom_mobile_bg); ?>;
	--loobek-menu-bottom-border-color: <?php echo esc_html($ts_menu_bottom_mobile_border_color); ?>;
	
	--loobek-top-header-color: <?php echo esc_html($ts_top_header_color); ?>;
	--loobek-top-header-link-hover: <?php echo esc_html($ts_top_header_hover_color); ?>;
	--loobek-top-header-bg: <?php echo esc_html($ts_top_header_bg); ?>;
	--loobek-top-header-border: <?php echo esc_html($ts_top_header_border_color); ?>;
	--loobek-middle-header-color: <?php echo esc_html($ts_middle_header_color); ?>;
	--loobek-middle-header-link-hover: <?php echo esc_html($ts_middle_header_link_hover); ?>;
	--loobek-middle-header-bg: <?php echo esc_html($ts_middle_header_bg); ?>;
	--loobek-middle-header-border: <?php echo esc_html($ts_middle_header_border_color); ?>;
	--loobek-header-cart-number-color: <?php echo esc_html($ts_header_cart_number_color); ?>;
	--loobek-header-cart-number-bg: <?php echo esc_html($ts_header_cart_number_bg); ?>;
	
	--loobek-header-search-color: <?php echo esc_html($ts_header_search_color); ?>;
	--loobek-header-search-placeholder-color: <?php echo esc_html($ts_header_search_placeholder_color); ?>;
	--loobek-header-search-bg: <?php echo esc_html($ts_header_search_bg); ?>;
	--loobek-header-search-border-color: <?php echo esc_html($ts_header_search_border_color); ?>;
	--loobek-header-search-icon-color: <?php echo esc_html($ts_header_search_icon_color); ?>;
	--loobek-header-search-hover-icon: <?php echo esc_html($ts_header_search_hover_icon); ?>;
	
	--loobek-footer-bg: <?php echo esc_html($ts_footer_bg); ?>;
	--loobek-footer-color: <?php echo esc_html($ts_footer_color); ?>;
	--loobek-footer-hover-color: <?php echo esc_html($ts_footer_hover_color); ?>;
	--loobek-footer-heading-color: <?php echo esc_html($ts_footer_heading_color); ?>;
	--loobek-footer-border: <?php echo esc_html($ts_footer_border_color); ?>;
	
	--loobek-product-button-thumbnail-color: <?php echo esc_html($ts_product_button_thumbnail_color); ?>;
	--loobek-product-button-thumbnail-hover-color: <?php echo esc_html($ts_product_button_thumbnail_hover_hover); ?>;
	--loobek-product-button-thumbnail-bg: <?php echo esc_html($ts_product_button_thumbnail_bg); ?>;
	--loobek-product-button-thumbnail-bg-hover: <?php echo esc_html($ts_product_button_thumbnail_bg_hover); ?>;
	
	--loobek-shop-bg: <?php echo esc_html($ts_shop_bg); ?>;
	--loobek-quantity-bg: <?php echo esc_html($ts_quantity_bg); ?>;
	--loobek-product-detail-deal-color: <?php echo esc_html($ts_product_detail_deal_color); ?>;
	--loobek-product-detail-deal-bg: <?php echo esc_html($ts_product_detail_deal_bg); ?>;
	--loobek-star-color: <?php echo esc_html($ts_rating_color); ?>;
	--loobek-product-price-color: <?php echo esc_html($ts_product_price_color); ?>;
	--loobek-product-sale-price-color: <?php echo esc_html($ts_product_sale_price_color); ?>;
	--loobek-product-del-color: <?php echo esc_html($ts_product_del_price_color); ?>;
	--loobek-sale-label-color: <?php echo esc_html($ts_product_sale_label_color); ?>;
	--loobek-sale-label-bg: <?php echo esc_html($ts_product_sale_label_bg); ?>;
	--loobek-new-label-color: <?php echo esc_html($ts_product_new_label_color); ?>;
	--loobek-new-label-bg: <?php echo esc_html($ts_product_new_label_bg); ?>;
	--loobek-hot-label-color: <?php echo esc_html($ts_product_feature_label_color); ?>;
	--loobek-hot-label-bg: <?php echo esc_html($ts_product_feature_label_bg); ?>;
	--loobek-soldout-label-color: <?php echo esc_html($ts_product_outstock_label_color); ?>;
	--loobek-soldout-label-bg: <?php echo esc_html($ts_product_outstock_label_bg); ?>;
}