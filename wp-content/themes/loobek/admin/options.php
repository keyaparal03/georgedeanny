<?php
$redux_url = '';
if( class_exists('ReduxFramework') ){
	$redux_url = ReduxFramework::$_url;
}

$logo_url 					= get_template_directory_uri() . '/images/logo.png'; 
$favicon_url 				= get_template_directory_uri() . '/images/favicon.ico';

$color_image_folder = get_template_directory_uri() . '/admin/assets/images/colors/';
$list_colors = array('red','red2','red3','red4','red5','yellow','orange','orange2','red6','red7','blue1','blue2','blue3','green','green2','yellow2','yellow3');
$preset_colors_options = array();
foreach( $list_colors as $color ){
	$preset_colors_options[$color] = array(
					'alt'      => $color
					,'img'     => $color_image_folder . $color . '.jpg'
					,'presets' => loobek_get_preset_color_options( $color )
	);
}

$family_fonts = array(
	"Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif"
	,"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif"
	,"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif"
	,"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive"
	,"Courier, monospace"                                   => "Courier, monospace"
	,"Garamond, serif"                                      => "Garamond, serif"
	,"Georgia, serif"                                       => "Georgia, serif"
	,"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif"
	,"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace"
	,"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"
	,"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif"
	,"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif"
	,"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif"
	,"Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif"
	,"'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif"
	,"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif"
	,"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif"
	,"CustomFont"                          					=> "CustomFont"
);

$header_layout_options = array();
$header_image_folder = get_template_directory_uri() . '/admin/assets/images/headers/';
for( $i = 1; $i <= 12; $i++ ){
	$header_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Header Layout %s', 'loobek'), $i)
		,'img' => $header_image_folder . 'header_v'.$i.'.jpg'
	);
}

$header_number_style = array();
$header_number_style_folder = get_template_directory_uri() . '/admin/assets/images/headers/number/';
for( $i = 1; $i <= 2; $i++ ){
	$header_number_style['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Number Style %s', 'loobek'), $i)
		,'img' => $header_number_style_folder . 'style_v'.$i.'.jpg'
	);
}

$header_mobile_layout_options = array();
$header_mobile_image_folder = get_template_directory_uri() . '/admin/assets/images/headers/mobile/';
for( $i = 1; $i <= 4; $i++ ){
	$header_mobile_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Mobile Header Layout %s', 'loobek'), $i)
		,'img' => $header_mobile_image_folder . 'header_v'.$i.'.jpg'
	);
}

$product_hover_style_options = array();
$product_hover_image_folder = get_template_directory_uri() . '/admin/assets/images/products/';
for( $i = 1; $i <= 5; $i++ ){
	$product_hover_style_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Product Hover Style %s', 'loobek'), $i)
		,'img' => $product_hover_image_folder . 'product_v'.$i.'.jpg'
	);
}

$product_mobile_style_options = array();
$product_mobile_image_folder = get_template_directory_uri() . '/admin/assets/images/products/mobile/';
for( $i = 1; $i <= 3; $i++ ){
	$product_mobile_style_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Mobile Product Style %s', 'loobek'), $i)
		,'img' => $product_mobile_image_folder . 'product_v'.$i.'.jpg'
	);
}

$sort_filter_style_options = array();
$sort_filter_image_folder = get_template_directory_uri() . '/admin/assets/images/sorts/';
for( $i = 1; $i <= 3; $i++ ){
	$sort_filter_style_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Sort Filter Style %s', 'loobek'), $i)
		,'img' => $sort_filter_image_folder . 'sort_v'.$i.'.png'
	);
}

$loading_screen_options = array();
$loading_image_folder = get_template_directory_uri() . '/images/loading/';
for( $i = 1; $i <= 10; $i++ ){
	$loading_screen_options[$i] = array(
		'alt'  => sprintf(esc_html__('Loading Image %s', 'loobek'), $i)
		,'img' => $loading_image_folder . 'loading_'.$i.'.svg'
	);
}

$footer_block_options = loobek_get_footer_block_options();

$custom_block_options = loobek_get_custom_block_options();

$breadcrumb_layout_options = array();
$breadcrumb_image_folder = get_template_directory_uri() . '/admin/assets/images/breadcrumbs/';
for( $i = 1; $i <= 3; $i++ ){
	$breadcrumb_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'loobek'), $i)
		,'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.jpg'
	);
}

$sidebar_options = array();
$default_sidebars = loobek_get_list_sidebars();
if( is_array($default_sidebars) ){
	foreach( $default_sidebars as $key => $_sidebar ){
		$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
	}
}

$product_loading_image = get_template_directory_uri() . '/images/prod_loading.gif';

$option_fields = array();

/*** General Tab ***/
$option_fields['general'] = array(
	array(
		'id'        => 'section-logo-favicon'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Logo - Favicon', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_logo'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Logo', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select an image file for the main logo', 'loobek' )
		,'readonly' => false
		,'default'  => array( 'url' => $logo_url )
	)
	,array(
		'id'        => 'ts_logo_mobile'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Mobile Logo', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on mobile', 'loobek' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_sticky'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Sticky Logo', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on sticky header', 'loobek' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_transparent_header'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Transparent Header Logo', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on transparent header', 'loobek' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'loobek' )
		,'default'  => '172'
	)
	,array(
		'id'        => 'ts_ipad_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width on Ipad', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'loobek' )
		,'default'  => '130'
	)
	,array(
		'id'        => 'ts_mobile_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width on Mobile', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'loobek' )
		,'default'  => '110'
	)
	,array(
		'id'        => 'ts_favicon'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Favicon', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a PNG, GIF or ICO image', 'loobek' )
		,'readonly' => false
		,'default'  => array( 'url' => $favicon_url )
	)
	,array(
		'id'        => 'ts_text_logo'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Text Logo', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Loobek'
	)
	
	,array(
		'id'        => 'section-layout-style'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Layout Style', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Layout Fullwidth', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_header_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Layout Fullwidth', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_main_content_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Main Content Layout Fullwidth', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_footer_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Footer Layout Fullwidth', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_layout_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout Style', 'loobek' )
		,'subtitle' => esc_html__( 'You can override this option for the individual page. Boxed is not available if Layout Fullwidth is enabled', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'boxed' 	=> esc_html__( 'Boxed', 'loobek' )
			,'wide' 	=> esc_html__( 'Wide', 'loobek' )
			,'wider' 	=> esc_html__( 'Wider', 'loobek' )
		)
		,'default'  => 'wide'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-rtl'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Right To Left', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_rtl'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Right To Left', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-smooth-scroll'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Smooth Scroll', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_smooth_scroll'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Smooth Scroll', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-back-to-top-button'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Back To Top Button', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_back_to_top_button'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_back_to_top_button_on_mobile'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button On Mobile', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-loading-screen'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Loading Screen', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_loading_screen'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Loading Screen', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_loading_image'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Loading Image', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $loading_screen_options
		,'default'  => '1'
	)
	,array(
		'id'        => 'ts_custom_loading_image'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Custom Loading Image', 'loobek' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'       	=> 'ts_display_loading_screen_in'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Display Loading Screen In', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'all-pages' 		=> esc_html__( 'All Pages', 'loobek' )
			,'homepage-only' 	=> esc_html__( 'Homepage Only', 'loobek' )
			,'specific-pages' 	=> esc_html__( 'Specific Pages', 'loobek' )
		)
		,'default'  => 'all-pages'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_loading_screen_exclude_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Exclude Pages', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'all-pages' )
	)
	,array(
		'id'       	=> 'ts_loading_screen_specific_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Specific Pages', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'specific-pages' )
	)
	
	,array(
		'id'        => 'section-general-style'
		,'type'     => 'section'
		,'title'    => esc_html__( 'General Style', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_image_button_radius'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Image + Button - Radius Style', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_text_uppercase'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Text Uppercase Style', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
	)
);

/*** Color Scheme Tab ***/
$option_fields['color-scheme'] = array(
	array(
		'id'          => 'ts_color_scheme'
		,'type'       => 'image_select'
		,'presets'    => true
		,'full_width' => false
		,'title'      => esc_html__( 'Select Color Scheme of Theme', 'loobek' )
		,'subtitle'   => ''
		,'desc'       => ''
		,'options'    => $preset_colors_options
		,'default'    => 'red'
	)
	,array(
		'id'        => 'section-general-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'General Colors', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-primary-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Primary Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_primary_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Primary Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_in_bg_primary'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color In Background Primary Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-main-content-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Main Content Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_main_content_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Main Content Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color_light'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color Light', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#808080'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_bold_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Bold Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-input-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Input Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_input_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input - Border Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-navigation-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Navigation Button Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_nav_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Navigation - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_nav_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Navigation - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_nav_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Navigation - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_nav_hover_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Navigation - Background Hover', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f5f5f5'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Button Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_button_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_hover_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button - Background Hover', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_hover_border'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button - Border Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-breadcrumb-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Breadcrumb Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_breadcrumb_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_link_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb - Link Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_img_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Has Background Image - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_img_link_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Has Background Image - Link Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'        => 'section-header-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Colors', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	
	,array(
		'id'      => 'info-header-notice-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Header Notice Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_notice_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Notice - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_notice_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Notice - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_notice_border'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Notice - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-top-header-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Top Header Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_top_header_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Top Header - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_top_header_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Top Header - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_top_header_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Top Header - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_top_header_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Top Header - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-middle-header-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Middle Header Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_middle_header_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Middle Header - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_middle_header_link_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Middle Header - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_middle_header_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Middle Header - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_middle_header_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Middle Header - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-header-cart-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Header Cart Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_header_cart_number_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Number Of Cart Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_cart_number_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Number Of Cart Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-header-search-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Header Search Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_header_search_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_search_placeholder_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search Placeholder - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#999999'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_search_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f0f0f0'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_search_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f0f0f0'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_search_icon_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search - Icon Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_search_hover_icon'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search - Icon Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'        => 'section-menu-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Menu Colors', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_menu_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_sub_menu_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu - Heading Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-sub-menu-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Sub Menu Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_sub_menu_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sub Menu - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_sub_menu_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sub Menu - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_sub_menu_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sub Menu - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-menu-2-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Menu 2 Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_menu_2_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu 2 - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#808080'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_2_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu 2 - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_2_active_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu 2 - Item Active Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_2_active_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu 2 - Item Active Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'        => 'section-menu-mobile-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Menu Mobile Colors', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-header-mobile-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Header Mobile Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_header_mobile_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Mobile - Icon Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_mobile_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Mobile - Icon Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_mobile_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Mobile - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_mobile_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Mobile - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_mobile_cart_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Mobile - Number Of Cart Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_mobile_cart_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Mobile - Number Of Cart Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-menu-mobile-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Menu Content Mobile Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_menu_mobile_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_title_active_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile - Menu Active Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#808080'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-menu-bar-mobile-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Menu Bottom Mobile Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_menu_bottom_mobile_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Bottom Mobile - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_bottom_mobile_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Bottom Mobile - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_bottom_mobile_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Bottom Mobile - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_bottom_mobile_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Bottom Mobile - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'        => 'section-footer-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Footer Colors', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_footer_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer - Heading Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer - Border Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'        => 'section-product-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Colors', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_product_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product - Price Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_del_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product - Del Price Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#808080'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_sale_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product - Sale Price Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_rating_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product - Rating Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_shop_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Shop - Background Color', 'loobek' )
		,'subtitle' => esc_html__( 'Only available on "Product Style" is "Has Background"', 'loobek' )
		,'default'  => array(
			'color' 	=> '#fafafa'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_quantity_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Quantity - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f0f0f0'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_detail_deal_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Detail - Deal Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_detail_deal_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Detail - Deal Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#fee9ec'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-product-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Thumbnail Product Button Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_hover_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button - Text Hover Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_bg_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button - Background Hover', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-product-label-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Label Colors', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_sale_label_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_sale_label_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c6213b'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#115241'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label - Text Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_bg'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label - Background Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f0f0f0'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_background_overlap_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Background Overlap Color', 'loobek' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#fafafa'
			,'alpha'	=> 1
		)
	)
);

/*** Typography Tab ***/
$option_fields['typography'] = array(
	array(
		'id'        => 'section-fonts'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Fonts', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       			=> 'ts_body_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '14px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_body_font_bold'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font Bold', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '600'
			,'font-size'   		=> '18px'
			,'line-height' 		=> '24px'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_body_font_extra_bold'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font Extra Bold', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'line-height'  	=> false
		,'font-size'    	=> false
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '700'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_body_font_thin'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font Thin', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'line-height'  	=> false
		,'font-size'    	=> false
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '300'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_heading_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading Font', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '500'
			,'font-size'   		=> '30px'
			,'line-height' 		=> '42px'
			,'letter-spacing' 	=> '0'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Menu Font', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'line-height'		=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '500'
			,'font-size'   		=> '18px'
			,'letter-spacing' 	=> '0'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_second_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Second Menu', 'loobek' )
		,'subtitle' 		=> esc_html__( 'Only available on "Header Layout" is "6 or 9"', 'loobek' )
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '500'
			,'font-size'   		=> '16px'
			,'line-height' 		=> '24px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       			=> 'ts_button_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Button Font', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'line-height'  	=> false
		,'font-size'    	=> true
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '500'
			,'font-size'   		=> '16px'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_product_name_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Product Name Font', 'loobek' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'font-size'    	=> true
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '500'
			,'font-size'   		=> '14px'
			,'line-height'		=> '20px'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_sub_cat_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Sub Categories', 'loobek' )
		,'subtitle' 		=> esc_html__( 'Only available on "Special Filter Area" is "Sub Categories"', 'loobek' )
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'font-size'    	=> true
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> 'Plus Jakarta Sans'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '13px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'        => 'section-custom-font'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Custom Font', 'loobek' )
		,'subtitle' => esc_html__( 'If you get the error message \'Sorry, this file type is not permitted for security reasons\', you can add this line define(\'ALLOW_UNFILTERED_UPLOADS\', true); to the wp-config.php file', 'loobek' )
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_custom_font_ttf'
		,'type'     => 'media'
		,'url'      => true
		,'preview'  => false
		,'title'    => esc_html__( 'Custom Font ttf', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Upload the .ttf font file. To use it, you select CustomFont in the Standard Fonts group', 'loobek' )
		,'default'  => array( 'url' => '' )
		,'mode'		=> 'application'
	)
	
	,array(
		'id'        => 'section-font-sizes'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Font Sizes', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-font-size-pc'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on PC', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       			=> 'ts_h1_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading H1', 'loobek' )
		,'subtitle' 		=> ''
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> false
		,'font-family'  	=> false
		,'font-weight'  	=> false
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-size'   		=> '72px'
			,'line-height' 		=> '80px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       			=> 'ts_h2_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading H2', 'loobek' )
		,'subtitle' 		=> ''
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> false
		,'font-family'  	=> false
		,'font-weight'  	=> false
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-size'   		=> '40px'
			,'line-height' 		=> '52px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       			=> 'ts_h3_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading H3', 'loobek' )
		,'subtitle' 		=> ''
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> false
		,'font-family'  	=> false
		,'font-weight'  	=> false
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-size'   		=> '30px'
			,'line-height' 		=> '42px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       			=> 'ts_h4_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading H4', 'loobek' )
		,'subtitle' 		=> ''
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> false
		,'font-family'  	=> false
		,'font-weight'  	=> false
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-size'  	 	=> '24px'
			,'line-height' 		=> '32px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       			=> 'ts_h5_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading H5', 'loobek' )
		,'subtitle' 		=> ''
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> false
		,'font-family'  	=> false
		,'font-weight'  	=> false
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-size'   		=> '20px'
			,'line-height' 		=> '28px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       			=> 'ts_h6_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading H6', 'loobek' )
		,'subtitle' 		=> ''
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> false
		,'font-family'  	=> false
		,'font-weight'  	=> false
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  			=> array(
			'font-size'   		=> '16px'
			,'line-height' 		=> '22px'
			,'google'	  		=> false
		)
	)
	,array(
		'id'       		=> 'ts_small_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Text Small', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'line-height'	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-size'   => '13px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_small_2_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Text Small 2', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'line-height'	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-size'   => '12px'
			,'google'	   => false
		)
	)
	
	,array(
		'id'      => 'info-font-size-ipad'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on Device', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_menu_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Menu Ipad', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'	=> false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '16px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h1_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H1', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '42px'
			,'line-height' => '48px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h2_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H2', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '30px'
			,'line-height' => '40px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h3_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H3', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '24px'
			,'line-height' => '32px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h4_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H4', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '20px'
			,'line-height' => '28px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h5_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H5', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '18px'
			,'line-height' => '24px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h6_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H6', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '16px'
			,'line-height' => '22px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_heading_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '24px'
			,'line-height' => '32px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_sub_cat_device_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Sub Categories', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'	=> false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '13px'
			,'google'	   => false
		)
	)
	
	,array(
		'id'      => 'info-font-size-mobile'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on Mobile', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_h1_mobile_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H1', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '32px'
			,'line-height' => '38px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h2_mobile_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Heading H2', 'loobek' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '26px'
			,'line-height' => '34px'
			,'google'	   => false
		)
	)
);

/*** Header Tab ***/
$option_fields['header'] = array(
	array(
		'id'        => 'section-header-layout'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Layout', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_header_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Header Layout', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $header_layout_options
		,'default'  => 'v1'
	)
	,array(
		'id'        => 'ts_header_mobile_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Mobile - Header Layout', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $header_mobile_layout_options
		,'default'  => 'v1'
	)
	
	,array(
		'id'        => 'section-header-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Option', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_sticky_header'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Sticky Header', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'        => 'ts_header_currency'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Currency', 'loobek' )
		,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WooCommerce Multilingual plugin, it may display demo html', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'        => 'ts_header_language'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Language', 'loobek' )
		,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WPML plugin, it may display demo html', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'        => 'ts_enable_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Search Bar', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'        => 'ts_search_popular_keywords'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Popular Keywords For Search', 'loobek' )
		,'subtitle' => esc_html__( 'A comma separated list of keywords. Ex: Men, Women, Sporting Goods', 'loobek' )
		,'desc'     => ''
		,'default'  => ''
		,'validate' => 'no_html'
		,'required'	=> array( 'ts_enable_search', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_enable_tiny_account'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'My Account', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'        => 'ts_tiny_account_custom_links'
		,'type'     => 'multi_text'
		,'title'    => esc_html__( 'My Account Custom Links', 'loobek' )
		,'subtitle' => esc_html__( 'Add custom links to dropdown after logged in. Format: title|link. Ex: Dashboard|https://mylink/', 'loobek' )
		,'default'  => array()
		,'add_text' => esc_html__( 'Add link', 'loobek' )
		,'required'	=> array( 'ts_enable_tiny_account', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_enable_tiny_wishlist'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Wishlist', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	
	,array(
		'id'        => 'ts_icon_number_style'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Number Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $header_number_style
		,'default'  => 'v1'
	)
	,array(
		'id'      => 'info-header-cart-option'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Shopping Cart Options', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_enable_tiny_shopping_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Shopping Cart', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_shopping_cart_quantity_input'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Quantity Input', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default' 		=> esc_html__( 'Default', 'loobek' )
			,'inline' 		=> esc_html__( 'Inline', 'loobek' )
			,'no-input' 	=> esc_html__( 'No Input', 'loobek' )
		)
		,'default'  => 'default'
		,'required'	=> array( 'ts_enable_tiny_shopping_cart', 'equals', '1' )
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_shopping_cart_sidebar'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Cart Sidebar', 'loobek' )
		,'subtitle' => esc_html__( 'Show shopping cart in sidebar instead of dropdown. You need to update cart after changing', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
		,'required'	=> array( 'ts_enable_tiny_shopping_cart', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_show_shopping_cart_after_adding'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Shopping Cart After Adding Product To Cart', 'loobek' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
		,'required'	=> array( 'ts_shopping_cart_sidebar', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_add_to_cart_effect'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Add To Cart Effect', 'loobek' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products. If "Show Shopping Cart After Adding Product To Cart" is enabled, this option will be disabled.', 'loobek' )
		,'options'  => array(
			'0'				=> esc_html__( 'None', 'loobek' )
			,'fly_to_cart'	=> esc_html__( 'Fly To Cart', 'loobek' )
			,'show_popup'	=> esc_html__( 'Show Popup', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_cart_popup_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Add To Cart Popup Style', 'loobek' )
		,'subtitle' => ''
		,'options'  => array(
			'default'	=> esc_html__( 'Default', 'loobek' )
			,'big'		=> esc_html__( 'Big Thumbnail', 'loobek' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_add_to_cart_effect', 'equals', 'show_popup' )
	)
	,array(
		'id'        => 'ts_cart_popup_cross_sells'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Add To Cart Popup Cross Sells', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
		,'required'	=> array( 'ts_cart_popup_style', 'equals', 'default' )
	)
	
	,array(
		'id'      => 'info-header-menu-link-option'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Mini Menu Options', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'		=> 'ts_second_menu_middle_header'
		,'type'     => 'select'
		,'title'	=> esc_html__( 'Second Menu on Middle Header', 'loobek' )
		,'subtitle'	=> esc_html__( 'Add another simple menu to middle header. This menu does not support mega menu and submenus. Only available to header layout 6 & 9', 'loobek' )
		,'desc'		=> ''
		,'data'		=> 'menus'
		,'default'  => ''
	)
	,array(
		'id'       	=> 'ts_second_menu_top_header'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Second Menu on Top Header', 'loobek' )
		,'subtitle' => esc_html__( 'Add another simple menu to top header. This menu does not support mega menu and submenus. Only available to header layout 1, 2, 3, 7 & 10', 'loobek' )
		,'desc'     => ''
		,'data'     => 'menus'
		,'default'	=> ''
	)
	
	,array(
		'id'      => 'info-header-social-option'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Social Options', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_enable_header_social_icons'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Social Icons', 'loobek' )
		,'subtitle' => esc_html__( 'Some header layouts don\'t include the social icons', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_social_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Social Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'style-icon' 		=> esc_html__( 'Icon', 'loobek' )
			,'style-text' 		=> esc_html__( 'Text', 'loobek' )
		)
		,'default'  => 'style-icon'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_instagram_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Instagram URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_tiktok_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Tiktok URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_youtube_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Youtube URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_linkedin_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'LinkedIn URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_twitter_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Twitter URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_facebook_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Facebook URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_pinterest_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Pinterest URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_custom_social_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Custom Social Text', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_custom_social_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Custom Social URL', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_custom_social_class'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Custom Social Class', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	
	,array(
		'id'      => 'info-header-notice-option'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Notice Options', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_enable_store_notice'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Store Notice', 'loobek' )
		,'subtitle' => esc_html__( 'Add a notice at the top of header', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'loobek' )
		,'off'		=> esc_html__( 'Disable', 'loobek' )
	)
	,array(
		'id'        => 'ts_store_notice'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Store Notice Content', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => true
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => true
		)
	)
	,array(
		'id'        => 'ts_store_notice_bg'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Store Notice Background', 'loobek' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	
	,array(
		'id'        => 'section-breadcrumb-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Breadcrumb Options', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_breadcrumb_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Breadcrumb Layout', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $breadcrumb_layout_options
		,'default'  => 'v1'
	)
	,array(
		'id'        => 'ts_bg_breadcrumbs'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Breadcrumbs Background Image', 'loobek' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a new image to override the default background image (only support breadcrumb layout 2 & 3)', 'loobek' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_breadcrumb_bg_parallax'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Breadcrumbs Background Parallax', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_breadcrumb_overlap_header'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Breadcrumbs Overlap Header', 'loobek' )
		,'subtitle' => esc_html__( 'Only support breadcrumb layout 2 & 3', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_overlapped_header_text_color'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Header Text Color', 'loobek' )
		,'subtitle' => ''
		,'options'  => array(
			'0'					=> esc_html__( 'Default', 'loobek' )
			,'light'			=> esc_html__( 'Light', 'loobek' )
			,'breadcrumb-color'	=> esc_html__( 'Use Breadcrumb Text Color', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_breadcrumb_overlap_header', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_breadcrumb_product_taxonomy_description'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Taxonomy Description In Breadcrumbs', 'loobek' )
		,'subtitle' => esc_html__( 'Show product taxonomy description (category, tags, ...) in breadcrumbs area on the product taxonomy page. Only support breadcrumb layout 2 + 3', 'loobek' )
		,'default'  => false
	)
);

/*** Footer Tab ***/
$option_fields['footer'] = array(
	array(
		'id'       	=> 'ts_footer_block'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Footer Block', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $footer_block_options
		,'default'  => '0'
		,'class'    => 'ts-post-select post_type-ts_footer_block'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
);

/*** Menu Tab ***/
$option_fields['menu'] = array(
	array(
		'id'             => 'ts_menu_thumb_width'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Width', 'loobek' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 50, step: 1, default value: 46', 'loobek' )
		,'default'       => 46
		,'min'           => 5
		,'step'          => 1
		,'max'           => 50
		,'display_value' => 'text'
	)
	,array(
		'id'             => 'ts_menu_thumb_height'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Height', 'loobek' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 50, step: 1, default value: 46', 'loobek' )
		,'default'       => 46
		,'min'           => 5
		,'step'          => 1
		,'max'           => 50
		,'display_value' => 'text'
	)
	,array(
		'id'        => 'ts_only_load_mobile_menu_on_mobile'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Only Load Mobile Menu On Mobile', 'loobek' )
		,'subtitle' => esc_html__( 'Only load mobile menu on a real mobile device. This may improve your site speed', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_enable_menu_overlay'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Menu Background Overlay', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
);

/*** Blog Tab ***/
$option_fields['blog'] = array(
	array(
		'id'        => 'section-blog'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Layout', 'loobek' )
		,'subtitle' => esc_html__( 'This option is available when Front page displays the latest posts', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'loobek')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-1'
	)
	,array(
		'id'       	=> 'ts_blog_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Blog Columns', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			1	=> 1
			,2	=> 2
			,3	=> 3
		)
		,'default'  => '1'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_categories_filter'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories Filter', 'loobek' )
		,'subtitle' => esc_html__( 'Show list of categories at the top of blog posts', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_read_more'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Read More Button', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_excerpt'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_excerpt_strip_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt Strip All Tags', 'loobek' )
		,'subtitle' => esc_html__( 'Strip all html tags in Excerpt', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_blog_excerpt_max_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Excerpt Max Words', 'loobek' )
		,'subtitle' => esc_html__( 'Input -1 to show full excerpt', 'loobek' )
		,'desc'     => ''
		,'default'  => '-1'
	)
	
	,array(
		'id'        => 'section-blog-details'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog Details', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_details_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Details Layout', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'loobek')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-1'
	)
	,array(
		'id'       	=> 'ts_blog_details_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_details_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_details_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Content', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Tags', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing - Use ShareThis', 'loobek' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'loobek')
		,'default'  => true
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Sharing - ShareThis Key', 'loobek' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'loobek' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_author_box'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author Box', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_navigation'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Navigation', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_related_posts'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Related Posts', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_blog_details_comment_form'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment Form', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
);

/*** WooCommerce Tab ***/
$option_fields['woocommerce'] = array(
	array(
		'id'        => 'section-product-label'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Label', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_label_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Label Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'rectangle' 	=> esc_html__( 'Rectangle', 'loobek' )
			,'circle' 		=> esc_html__( 'Circle', 'loobek' )
		)
		,'default'  => 'rectangle'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_product_label_align'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Alignment Label Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'vertical' 			=> esc_html__( 'Vertical', 'loobek' )
			,'horizontal' 		=> esc_html__( 'Horizontal', 'loobek' )
		)
		,'default'  => 'horizontal'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_product_show_new_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product New Label', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_product_new_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Text', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'New'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_show_new_label_time'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Time', 'loobek' )
		,'subtitle' => esc_html__( 'Number of days which you want to show New label since product is published', 'loobek' )
		,'desc'     => ''
		,'default'  => '30'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_sale_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sale Label Text', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sale'
	)
	,array(
		'id'        => 'ts_product_feature_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Feature Label Text', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Feature'
	)
	,array(
		'id'        => 'ts_product_out_of_stock_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Out Of Stock Label Text', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sold out'
	)
	,array(
		'id'       	=> 'ts_show_sale_label_as'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Show Sale Label As', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'text' 		=> esc_html__( 'Text', 'loobek' )
			,'number' 	=> esc_html__( 'Number', 'loobek' )
			,'percent' 	=> esc_html__( 'Percent', 'loobek' )
		)
		,'default'  => 'percent'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-product-style'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Style', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_hover_style'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Hover Style', 'loobek' )
		,'subtitle' => esc_html__( 'Select the style of buttons/icons when hovering on product', 'loobek' )
		,'desc'     => ''
		,'options'  => $product_hover_style_options
		,'default'  => 'v1'
	)
	,array(
		'id'       	=> 'ts_product_mobile_style'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Device - Product Style', 'loobek' )
		,'subtitle' => esc_html__( 'Select the style of buttons/icons on mobile', 'loobek' )
		,'desc'     => ''
		,'options'  => $product_mobile_style_options
		,'default'  => 'v1'
	)
	,array(
		'id'        => 'ts_effect_product'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Back Product Image', 'loobek' )
		,'subtitle' => esc_html__( 'Show another product image on hover. It will show an image from Product Gallery', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_product_tooltip'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tooltip', 'loobek' )
		,'subtitle' => esc_html__( 'Show tooltip when hovering on buttons/icons on product', 'loobek' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_variable_product_quick_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Variable Product Quick Add To Cart', 'loobek' )
		,'subtitle' => esc_html__( 'Allow user to select variation and add to cart in loop. Only support variation which has one attribute', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_variable_product_quick_add_to_cart_limit'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number of Variations', 'loobek' )
		,'subtitle' => esc_html__( 'Limit variations on loop. Avoid breaking layout, this value should not be high', 'loobek' )
		,'desc'     => ''
		,'default'  => '6'
		,'validate'	=> 'numeric'
		,'required'	=> array( 'ts_variable_product_quick_add_to_cart', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-lazy-load'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Lazy Load', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_lazy_load'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Lazy Load', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_placeholder_img'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Placeholder Image', 'loobek' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => $product_loading_image )
	)
	
	,array(
		'id'        => 'section-quickshop'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Quickshop', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_quickshop'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Quickshop', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-catalog-mode'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Catalog Mode', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_catalog_mode'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Catalog Mode', 'loobek' )
		,'subtitle' => esc_html__( 'Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off', 'loobek' )
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-ajax-search'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Ajax Search', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_ajax_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Ajax Search', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_ajax_search_number_result'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number Of Results', 'loobek' )
		,'subtitle' => esc_html__( 'Input -1 to show all results', 'loobek' )
		,'desc'     => ''
		,'default'  => '4'
	)
);

/*** Shop/Product Category Tab ***/
$option_fields['shop-product-category'] = array(
	array(
		'id'        => 'ts_prod_cat_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Shop/Product Category Layout', 'loobek' )
		,'subtitle' => esc_html__( 'Sidebar is only available if Filter Widget Area is disabled', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'loobek')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_cat_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_product_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0'						=> esc_html__( 'Default', 'loobek' )
			,'has-border-bottom'	=> esc_html__( 'Has Border Bottom', 'loobek' )
			,'has-background'		=> esc_html__( 'Has Background', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Columns', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'1'		=> '1'
			,'1-1'	=> esc_html__( '1 - Big Thumbnail', 'loobek' )
			,'2'	=> '2'
			,'3'	=> '3'
			,'4'	=> '4'
			,'5'	=> '5'
			,'6'	=> '6'
		)
		,'default'  => '5'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_columns_selector'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Columns Selector', 'loobek' )
		,'subtitle' => esc_html__( 'Allow users to select columns on frontend', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_per_page'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Products Per Page', 'loobek' )
		,'subtitle' => esc_html__( 'Number of products per page', 'loobek' )
		,'desc'     => ''
		,'default'  => '20'
	)
	,array(
		'id'       	=> 'ts_prod_cat_loading_type'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Loading Type', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'			=> esc_html__( 'Default', 'loobek' )
			,'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'loobek' )
			,'load-more-button'	=> esc_html__( 'Load More Button', 'loobek' )
			,'ajax-pagination'	=> esc_html__( 'Ajax Pagination', 'loobek' )
		)
		,'default'  => 'load-more-button'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_shop_description'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Shop Description', 'loobek' )
		,'subtitle' => esc_html__( 'By default, you can not edit Shop Description with Elementor (free). To use Elementor, you can add description with Custom Block', 'loobek' )
		,'desc'     => ''
		,'options'  => $custom_block_options
		,'default'  => '0'
		,'class'    => 'ts-post-select post_type-ts_custom_block'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_shop_category_description_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Shop/Category Description Position', 'loobek' )
		,'subtitle' => esc_html__( 'Select "Out Of Main Content" if you want Description to also show above sidebar (if have). Only available with Description which is added by Custom Block', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'default'				=> esc_html__( 'Default', 'loobek' )
			,'out-of-main-content'	=> esc_html__( 'Out Of Main Content', 'loobek' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-sort-filter-shop'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Sort Filter Area', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_prod_cat_sort_filter_style'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Sort Filter Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sort_filter_style_options
		,'default'  => 'v1'
	)
	,array(
		'id'        => 'ts_prod_cat_per_page_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Products Per Page Dropdown', 'loobek' )
		,'subtitle' => esc_html__( 'Allow users to select number of products per page', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_onsale_checkbox'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Products On Sale Checkbox', 'loobek' )
		,'subtitle' => esc_html__( 'Allow users to view only the discounted products', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_filter_widget_area'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Filter Widget Area', 'loobek' )
		,'subtitle' => esc_html__( 'Display Filter Widget Area on the Shop/Product Category page. If enabled, the shop sidebar will be removed', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_filter_widget_area_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Filter Widget Area - Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'top'		=> esc_html__( 'Top', 'loobek' )
			,'sidebar'	=> esc_html__( 'Sidebar', 'loobek' )
			,'dropdown'	=> esc_html__( 'Dropdown', 'loobek' )
			,'popup'	=> esc_html__( 'Popup', 'loobek' )
		)
		,'default'  => 'top'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_filter_widget_area', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_filter_dropdown_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Filter Dropdown - Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'Default', 'loobek' )
			,'border'		=> esc_html__( 'Border', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_filter_widget_area_style', 'equals', 'dropdown' )
	)
	,array(
		'id'       	=> 'ts_filter_button_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Filter Button Position', 'loobek' )
		,'subtitle' => 'Not available "Filter Widget Area Style" is "Dropdown"'
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'Default', 'loobek' )
			,'inline'		=> esc_html__( 'Inline Top', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_filter_widget_area', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_filter_products_by_attribute_widget_style'
		,'type'     => 'select'
		,'title'    => esc_html__( '"Filter Products by Attribute" Widget Item Style', 'loobek' )
		,'subtitle' => esc_html__( 'Only affect to widgets that "Display type" is "List"', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'0'			=> esc_html__( 'Default (List)', 'loobek' )
			,'inline'	=> esc_html__( 'Inline', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'      => 'info-special-filter-area'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Special Filter Area', 'loobek' )
		,'desc'   => esc_html__( 'Show this area at the top of page with subcategories or a special product attribute', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_special_filter_area'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Special Filter Area', 'loobek' )
		,'subtitle' => esc_html__( 'Select resource for Special Filter Area. If Sub Categories is selected and no subcategories, siblings will be shown', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'No', 'loobek' )
			,'subcategory'	=> esc_html__( 'Sub Categories', 'loobek' )
			,'attribute'	=> esc_html__( 'Product Attribute', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_filter_sub_cat_border'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Border Bottom', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'required'	=> array( 'ts_special_filter_area', 'equals', 'subcategory' )
	)
	,array(
		'id'       	=> 'ts_special_filter_area_show_on'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Show On', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'shop'		=> esc_html__( 'Shop', 'loobek' )
			,'category'	=> esc_html__( 'Product Category', 'loobek' )
			,'all'		=> esc_html__( 'Shop & Product Category', 'loobek' )
		)
		,'default'  => 'all'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_special_filter_area', '!=', '0' )
	)
	,array(
		'id'        => 'ts_special_filter_area_include_parent_category'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Include Parent Category', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_special_filter_area', 'equals', 'subcategory' )
	)
	,array(
		'id'       	=> 'ts_special_filter_area_attribute'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Attribute', 'loobek' )
		,'subtitle' => esc_html__( 'You can override attribute on each product category (set in Products > Categories)', 'loobek' )
		,'desc'     => ''
		,'options'  => loobek_get_product_attribute_taxonomies_options()
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_special_filter_area', 'equals', 'attribute' )
	)
	,array(
		'id'        => 'ts_special_filter_area_page_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Page Title', 'loobek' )
		,'subtitle' => esc_html__( 'Show Page Title/Category Name in Special Filter Area. You can disable page title in breadcrumb area by editing Page Options of the Shop page', 'loobek' )
		,'default'  => true
		,'required'	=> array( 'ts_special_filter_area', 'equals', 'attribute' )
	)
	
	,array(
		'id'        => 'section-product-content'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Content', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_cat_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'loobek' )
		,'subtitle' => esc_html__( 'Add brands to product list on all pages', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_desc_html'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description HTML', 'loobek' )
		,'subtitle' => esc_html__( 'If enabled, you should change Limit Words to -1 (show all) or number which does not broke html. Only support these tags: ul, ol, li, div, p, span', 'loobek' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_cat_desc_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Short Description - Limit Words', 'loobek' )
		,'subtitle' => esc_html__( 'It is also used for product shortcode', 'loobek' )
		,'desc'     => ''
		,'default'  => '-1'
	)
	,array(
		'id'        => 'ts_prod_cat_color_swatch'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Swatches', 'loobek' )
		,'subtitle' => esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_number_color_swatch'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Number Of Color Swatches', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			2	=> 2
			,3	=> 3
			,4	=> 4
			,5	=> 5
			,6	=> 6
		)
		,'default'  => '4'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_color_swatch', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_cat_gallery'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Galleries', 'loobek' )
		,'subtitle' => esc_html__( 'Show product galleries on the shop/product taxonomy pages. Please note that many images may make your site slower', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_number_gallery'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number Of Product Galleries', 'loobek' )
		,'subtitle' => esc_html__( 'Input -1 to show all', 'loobek' )
		,'desc'     => ''
		,'validate' => 'numeric'
		,'default'  => '-1'
		,'required'	=> array( 'ts_prod_cat_gallery', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_gallery_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Galleries Position', 'loobek' )
		,'subtitle' => esc_html__( 'Position of Galleries in product meta area', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'top'		=> esc_html__( 'Top', 'loobek' )
			,'bottom'	=> esc_html__( 'Bottom', 'loobek' )
		)
		,'default'  => 'top'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_gallery', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-product-content-list-view'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Content - List View (One & Two Columns)', 'loobek' )
		,'subtitle' => esc_html__( 'The below options can override the options of the Grid layout. It may allow you to add more elements on list view', 'loobek' )
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_cat_quantity_input'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Quantity Input', 'loobek' )
		,'subtitle' => esc_html__( 'Only available on one column layout', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_cat_list_view'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_rating_list_view'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_desc_list_view'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	
	,array(
		'id'        => 'section-shop-bottom-content'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Bottom Content', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_shop_bottom_description'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Shop Bottom Description', 'loobek' )
		,'subtitle' => esc_html__( 'By default, shop description is added at the top of page. This option will add another description at the bottom. Add content in Custom Block', 'loobek' )
		,'desc'     => ''
		,'options'  => $custom_block_options
		,'default'  => '0'
		,'class'    => 'ts-post-select post_type-ts_custom_block'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_recommended_products'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Recommended Products', 'loobek' )
		,'subtitle' => esc_html__( 'Add some recommended products on the shop/product category page at the bottom', 'loobek' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cat_recommended_products_limit'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number of Recommended Products', 'loobek' )
		,'subtitle' => esc_html__( 'Products only show if total products of shop/category is more than doubled this value', 'loobek' )
		,'desc'     => ''
		,'default'  => '8'
		,'validate'	=> 'numeric'
		,'required'	=> array( 'ts_prod_cat_recommended_products', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_recommended_products_product_type'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Type of Recommended Products', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'best_selling'	=> esc_html__( 'Best Selling', 'loobek' )
			,'top_rated'	=> esc_html__( 'Top Rated', 'loobek' )
			,'featured'		=> esc_html__( 'Featured', 'loobek' )
			,'sale'			=> esc_html__( 'Sale', 'loobek' )
		)
		,'default'  => 'best_selling'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_recommended_products', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_recommended_products_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Columns of Recommended Products', 'loobek' )
		,'subtitle' => esc_html__( 'Columns of slider depends on the width of container', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'3'		=> '3'
			,'4'	=> '4'
			,'5'	=> '5'
			,'6'	=> '6'
			,'7'	=> '7'
		)
		,'default'  => '6'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_recommended_products', 'equals', '1' )
	)
);

/*** Product Details Tab ***/
$option_fields['product-details'] = array(
	array(
		'id'        => 'ts_prod_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Product Layout', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'loobek')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'loobek')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_breadcrumb'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Breadcrumb', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_image_summary_limited_width'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Image Summary In Limited Width', 'loobek' )
		,'subtitle' => esc_html__( 'Limit the width of container which contains product image and summary in some cases and Not available on Product Summary Scrolling', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'       	=> 'ts_prod_heading_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Heading Style', 'loobek' )
		,'subtitle' => esc_html__( 'Heading of Frequently Bought Together / Related - Up-sell - Bestseller products / Reviews', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'Default', 'loobek' )
			,'center'		=> esc_html__( 'Center', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-product-thumbnail'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Image', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_prod_thumbnail_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Thumbnail - Layout', 'loobek' )
		,'subtitle' => esc_html__( 'Quickshop does not support the Grid & Slider layouts', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'vertical'			=> esc_html__( 'Vertical', 'loobek' )
			,'horizontal'		=> esc_html__( 'Horizontal', 'loobek' )
			,'grid'				=> esc_html__( 'Grid', 'loobek' )
			,'slider-2-col'		=> esc_html__( 'Slider 2 Columns', 'loobek' )
			,'slider-3-col'		=> esc_html__( 'Slider 3 Columns', 'loobek' )
		)
		,'default'  => 'horizontal'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_thumbnail_layout_mobile'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Thumbnail - Layout On Mobile', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'vertical'			=> esc_html__( 'Vertical', 'loobek' )
			,'horizontal'		=> esc_html__( 'Horizontal', 'loobek' )
			,'grid'				=> esc_html__( 'Grid', 'loobek' )
		)
		,'default'  => 'horizontal'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_cloudzoom'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Cloud Zoom', 'loobek' )
		,'subtitle' => esc_html__( 'Not available if Product Thumbnail Layout is Grid or Slider', 'loobek' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_lightbox'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Lightbox', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-product-summary'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Summary', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_summary_scrolling'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Summary Scrolling', 'loobek' )
		,'subtitle' => esc_html__( 'Scroll summary if its height is smaller than the height of product image. If you want Summary scrolling Image and Description Tab, please to Product Tabs Position is "Inside Summary"', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_prod_summary_scrolling_border'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Summary Scrolling - Border', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
		,'required'	=> array( 'ts_prod_summary_scrolling', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_title_in_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title In Summary', 'loobek' )
		,'subtitle' => esc_html__( 'Display the product title in the page content instead of above the breadcrumbs', 'loobek' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_availability'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Availability', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_low_stock_notice'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Low Stock Notice', 'loobek' )
		,'subtitle' => esc_html__( 'Show a notice next to quantity when stock is low', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_low_stock_notice_threshold'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Low Stock Threshold', 'loobek' )
		,'subtitle' => esc_html__( 'Show notice when product stock reaches this amount', 'loobek' )
		,'desc'     => ''
		,'default'  => '10'
		,'validate'	=> 'numeric'
		,'required'	=> array( 'ts_prod_low_stock_notice', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_short_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_prod_short_desc_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Short Description Position', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'above-price'		=> esc_html__( 'Above Price', 'loobek' )
			,'below-price'		=> esc_html__( 'Below Price', 'loobek' )
		)
		,'default'  => 'below-price'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_short_desc', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_count_down'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Count Down', 'loobek' )
		,'subtitle' => esc_html__( 'You have to activate ThemeSky plugin', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_discount_percent'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Discount Percent', 'loobek' )
		,'subtitle' => esc_html__( 'Show discount percent next to the price', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
		,'required'	=> array( 'ts_prod_price', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_ajax_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Ajax Add To Cart', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_prod_add_to_cart', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_buy_now'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Buy Now Button', 'loobek' )
		,'subtitle' => esc_html__( 'Only support the simple and variable products', 'loobek' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_prod_contact_page'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Contact Page', 'loobek' )
		,'subtitle' => esc_html__( 'If selected, it will add a link to the selected page which may allow customer to ask about product', 'loobek' )
		,'desc'     => ''
		,'data'     => 'pages'
		,'default'	=> ''
	)
	,array(
		'id'       	=> 'ts_prod_bottom_summary_content'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Bottom Summary Content', 'loobek' )
		,'subtitle' => esc_html__( 'Add custom content at the bottom of product summary. You add content in Custom Block. You can set content for each product in Product Options', 'loobek' )
		,'desc'     => ''
		,'options'  => $custom_block_options
		,'default'  => '0'
		,'class'    => 'ts-post-select post_type-ts_custom_block'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'      => 'info-tags-products'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Tags', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_tag'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tags', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_tag_color_style'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tags - Color Style', 'loobek' )
		,'subtitle' => esc_html__( 'Set Icon/Color in Products > Tags', 'loobek' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_tag', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_prod_tag_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Tags Position', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'above-price'		=> esc_html__( 'Above Price', 'loobek' )
			,'below-price'		=> esc_html__( 'Below Price', 'loobek' )
		)
		,'default'  => 'above-price'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_tag_color_style', 'equals', '1' )
	)
	
	,array(
		'id'      => 'info-sharing-products'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Sharing', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sticky'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing - Sticky Style', 'loobek' )
		,'subtitle' => esc_html__( 'Keep share buttons while users scroll. Only available if don\'t use ShareThis', 'loobek' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing - Use ShareThis', 'loobek' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'loobek' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sharing - ShareThis Key', 'loobek' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'loobek' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)
	
	,array(
		'id'      => 'info-attr-products'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Attribute', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_attr_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Attribute Dropdown', 'loobek' )
		,'subtitle' => esc_html__( 'If you turn it off, the dropdown will be replaced by image or text label', 'loobek' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_attr_color_text'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Attribute Color Text', 'loobek' )
		,'subtitle' => esc_html__( 'Show text for the Color attribute instead of color/color image', 'loobek' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_attr_dropdown', 'equals', '0' )
	)
	,array(
		'id'        => 'ts_prod_attr_color_variation_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Attribute Variation Thumbnail', 'loobek' )
		,'subtitle' => esc_html__( 'Use the variation thumbnail for the Color attribute. The Color slug has to be "color". You need to specify Color for variation (not any)', 'loobek' )
		,'default'  => true
		,'required'	=> array( 'ts_prod_attr_color_text', 'equals', '0' )
	)
	
	,array(
		'id'      => 'info-size-chart-products'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Size Chart', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_size_chart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Size Chart', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_prod_size_chart_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Size Chart Style', 'loobek' )
		,'subtitle' => esc_html__( 'Modal Popup is only available if the slug of the Size attributes contains "size" and Attribute Dropdown is disabled', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'popup'		=> esc_html__( 'Modal Popup', 'loobek' )
			,'tab'		=> esc_html__( 'Additional Tab', 'loobek' )
		)
		,'default'  => 'popup'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_size_chart', 'equals', '1' )
	)
	
	,array(
		'id'      => 'info-grouped-product'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Grouped Product', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_grouped_product_checkbox_style'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Grouped Product Checkbox Style', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_prod_grouped_product_heading'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Grouped Product Heading', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_prod_grouped_product_checkbox_style', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-frequently-bought-together'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Frequently Bought Together', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_prod_bought_together_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'	=> esc_html__( 'Default', 'loobek' )
			,'small'	=> esc_html__( 'Small', 'loobek' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_frequently_bought_together_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout', 'loobek' )
		,'subtitle' => esc_html__( 'Only available if "Frequently Bought Together Style" is "Small" and product layout has no sidebar', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'horizontal'	=> esc_html__( 'Horizontal', 'loobek' )
			,'vertical'		=> esc_html__( 'Vertical', 'loobek' )
		)
		,'default'  => 'horizontal'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_bought_together_style', 'equals', 'small' )
	)
	,array(
		'id'       	=> 'ts_frequently_bought_together_border_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Border Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'None', 'loobek' )
			,'default'		=> esc_html__( 'Default', 'loobek' )
			,'overflow'		=> esc_html__( 'Overflow', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_frequently_bought_together_items_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Items Style', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'Defaut', 'loobek' )
			,'border'		=> esc_html__( 'Border', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-product-tabs'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Tabs', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_tabs'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tabs', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'       	=> 'ts_prod_tabs_heading_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Tabs - Heading Style', 'loobek' )
		,'subtitle' => esc_html__( 'Only available on the default tab layout', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'Default', 'loobek' )
			,'center'		=> esc_html__( 'Center', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_tabs_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Tabs - Position', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'after_summary'				=> esc_html__( 'After Summary', 'loobek' )
			,'inside_summary'			=> esc_html__( 'Inside Summary', 'loobek' )
		)
		,'default'  => 'after_summary'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_tabs_show_content_default'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Product Tabs Content By Default', 'loobek' )
		,'subtitle' => esc_html__( 'Show the content of all tabs by default and hide the tab headings', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'       	=> 'ts_prod_tabs_accordion'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Tabs Accordion', 'loobek' )
		,'subtitle' => esc_html__( 'Show tabs as accordion. If you add more custom tabs, please make sure that your tab content has heading (h2) at the top', 'loobek' )
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'None', 'loobek' )
			,'desktop'		=> esc_html__( 'On Desktop', 'loobek' )
			,'mobile'		=> esc_html__( 'On Mobile', 'loobek' )
			,'both'			=> esc_html__( 'On All Screens', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_tabs_show_content_default', 'equals', '0' )
	)
	,array(
		'id'        => 'ts_prod_custom_tab'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Custom Tab', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_custom_tab_title'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Custom Tab Title', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom tab'
	)
	,array(
		'id'        => 'ts_prod_custom_tab_content'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Custom Tab Content', 'loobek' )
		,'subtitle' => esc_html__( 'Add content in Custom Block', 'loobek' )
		,'desc'     => ''
		,'options'  => $custom_block_options
		,'default'  => '0'
		,'class'    => 'ts-post-select post_type-ts_custom_block'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_more_less_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product More/Less Content', 'loobek' )
		,'subtitle' => esc_html__( 'Show more/less content in the Description tab', 'loobek' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_separate_reviews_tab'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Separate Reviews Tab', 'loobek' )
		,'subtitle' => esc_html__( 'Remove Reviews tab in WooCommerce tabs and add it outside', 'loobek' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_prod_collapse_reviews_tab'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Collapse Reviews Tab', 'loobek' )
		,'subtitle' => esc_html__( 'Hide comment list and review form and show when clicking buttons. Only available if the Photo Reviews for WooCommerce plugin is enabled', 'loobek' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_separate_reviews_tab', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_prod_reviews_tab_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Reviews Tab Position', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'after_summary'				=> esc_html__( 'After Summary', 'loobek' )
			,'inside_summary'			=> esc_html__( 'Inside Summary', 'loobek' )
		)
		,'default'  => 'after_summary'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_separate_reviews_tab', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-product-custom-content'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Custom Content', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_prod_custom_content'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Custom Content', 'loobek' )
		,'subtitle' => esc_html__( 'Add content in Custom Block. You can set content for each product in Product Options', 'loobek' )
		,'desc'     => ''
		,'options'  => $custom_block_options
		,'default'  => '0'
		,'class'    => 'ts-post-select post_type-ts_custom_block'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_custom_content_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Custom Content Position', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'above-tabs'	=> esc_html__( 'Above Product Tabs', 'loobek' )
			,'below-tabs'	=> esc_html__( 'Below Product Tabs', 'loobek' )
			,'bottom'		=> esc_html__( 'Bottom', 'loobek' )
		)
		,'default'  => 'below-tabs'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-related-up-sell-products'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Related - Up-Sell - Bestseller Products', 'loobek' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_related_up_sell_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Style', 'loobek' )
		,'subtitle' => ''
		,'options'  => array(
			'default'				=> esc_html__( 'Default', 'loobek' )
			,'border'				=> esc_html__( 'Border', 'loobek' )
			,'border-overflow'		=> esc_html__( 'Border Overflow', 'loobek' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'      => 'info-upsell-products'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Up-Sell Products', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_upsells'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Up-Sell Products', 'loobek' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_upsells_heading'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Up-Sell Products Heading', 'loobek' )
		,'subtitle' => esc_html__( 'Leave blank to show default heading', 'loobek' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_prod_upsells', 'equals', '1' )
	)
	,array(
		'id'      => 'info-related-products'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Related Products', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_related'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Related Products', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_related_heading'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Related Products Heading', 'loobek' )
		,'subtitle' => esc_html__( 'Leave blank to show default heading', 'loobek' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_prod_related', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_prod_related_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Related Products Position', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0'				=> esc_html__( 'Default', 'loobek' )
			,'above-tabs'	=> esc_html__( 'Above Product Tabs', 'loobek' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_related', 'equals', '1' )
	)
	,array(
		'id'      => 'info-bestsellers-products'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Bestseller Products', 'loobek' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_prod_bestsellers'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Bestseller Products', 'loobek' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'loobek' )
		,'off'		=> esc_html__( 'Hide', 'loobek' )
	)
	,array(
		'id'        => 'ts_prod_bestsellers_heading'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Bestseller Products Heading', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Bestsellers'
		,'required'	=> array( 'ts_prod_bestsellers', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_bestsellers_based_category'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Bestseller Products Based Categories', 'loobek' )
		,'subtitle' => esc_html__( 'If enabled, it will show products based on the categories of the main product, not all products', 'loobek' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_bestsellers', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_bestsellers_limit'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number of Bestseller Products', 'loobek' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '8'
		,'validate'	=> 'numeric'
		,'required'	=> array( 'ts_prod_bestsellers', 'equals', '1' )
	)
);

/*** Custom Code Tab ***/
$option_fields['custom-code'] = array(
	array(
		'id'        => 'ts_custom_css_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom CSS Code', 'loobek' )
		,'subtitle' => ''
		,'mode'     => 'css'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_custom_javascript_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom Javascript Code', 'loobek' )
		,'subtitle' => ''
		,'mode'     => 'javascript'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
);