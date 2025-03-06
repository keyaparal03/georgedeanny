<?php
add_action('init', 'loobek_get_default_theme_options');
function loobek_get_default_theme_options(){
	global $loobek_theme_options;
	if( empty( $loobek_theme_options ) ){
		include get_template_directory() . '/admin/options.php';
		foreach( $option_fields as $fields ){
			foreach( $fields as $field ){
				if( in_array($field['type'], array('section', 'info')) ){
					continue;
				}
				if( isset($field['default']) ){
					$loobek_theme_options[ $field['id'] ] = $field['default'];
				}
			}
		}
	}
}

function loobek_get_theme_options( $key = '', $default = '' ){
	global $loobek_theme_options;
	
	if( !$key ){
		return $loobek_theme_options;
	}
	else if( isset($loobek_theme_options[$key]) ){
		return $loobek_theme_options[$key];
	}
	else{
		return $default;
	}
}

function loobek_change_theme_options( $key, $value ){
	global $loobek_theme_options;
	if( isset( $loobek_theme_options[$key] ) ){
		$loobek_theme_options[$key] = $value;
	}
}

add_filter('redux/validate/loobek_theme_options/defaults', 'loobek_set_default_color_options_on_reset');
add_filter('redux/validate/loobek_theme_options/defaults_section', 'loobek_set_default_color_options_on_reset');
function loobek_set_default_color_options_on_reset( $options_defaults ){
	if( !isset($options_defaults['redux-section']) || ( isset($options_defaults['redux-section']) && $options_defaults['redux-section'] == 2 ) ){
		if( isset($options_defaults['ts_color_scheme']) ){
			$preset_colors = array();
			include get_template_directory() . '/admin/preset-colors/' . $options_defaults['ts_color_scheme'] . '.php';
			foreach( $preset_colors as $key => $value ){
				if( isset($options_defaults[$key]) ){
					$options_defaults[$key] = $value;
				}
			}
		}
	}
	return $options_defaults;
}

function loobek_get_preset_color_options( $color ){
	$preset_colors = array();
	include get_template_directory() . '/admin/preset-colors/' . $color . '.php';
	return $preset_colors;
}

add_action('add_option_loobek_theme_options', 'loobek_create_dynamic_css', 10, 2);
function loobek_create_dynamic_css( $option, $value ){
	loobek_update_dynamic_css($value, $value, $option);
}

add_action('update_option_loobek_theme_options', 'loobek_update_dynamic_css', 10, 3);
function loobek_update_dynamic_css( $old_value, $value, $option ){
	if( is_array($value) ){
		$data = $value;
		$upload_dir = wp_get_upload_dir();
		$filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
		ob_start();
		include get_template_directory() . '/framework/dynamic_style.php';
		$dynamic_css = ob_get_contents();
		ob_end_clean();
		
		global $wp_filesystem;
		if( empty( $wp_filesystem ) ) {
			require_once ABSPATH .'/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		
		$creds = request_filesystem_credentials($filename_dir, '', false, false, array());
		if( ! WP_Filesystem($creds) ){
			return false;
		}

		if( $wp_filesystem ) {
			$wp_filesystem->put_contents(
				$filename_dir,
				$dynamic_css,
				FS_CHMOD_FILE
			);
		}
	}
}

add_filter('redux/loobek_theme_options/localize', 'loobek_remove_redux_ads', 99);
function loobek_remove_redux_ads( $localize_data ){
	if( isset($localize_data['rAds']) ){
		$localize_data['rAds'] = '';
	}
	return $localize_data;
}

if( is_admin() && isset($_GET['page']) && $_GET['page'] == 'themeoptions' ){
	add_filter('upload_mimes', 'loobek_allow_upload_font_files');
	function loobek_allow_upload_font_files( $existing_mimes = array() ){
		$existing_mimes['ttf'] = 'font/ttf';
		return $existing_mimes;
	}
}

function loobek_get_footer_block_options(){
	$footer_blocks = array('0' => esc_html__('No Footer', 'loobek'));
	$args = array(
		'post_type'			=> 'ts_footer_block'
		,'post_status'	 	=> 'publish'
		,'posts_per_page' 	=> -1
	);

	$posts = new WP_Query($args);

	if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
		foreach( $posts->posts as $p ){
			$footer_blocks[$p->ID] = $p->post_title;
		}
	}

	wp_reset_postdata();
	
	return $footer_blocks;
}

function loobek_get_custom_block_options(){
	$custom_blocks = array('0' => esc_html__('Select Custom Block', 'loobek'));
	$args = array(
		'post_type'			=> 'ts_custom_block'
		,'post_status'	 	=> 'publish'
		,'posts_per_page' 	=> -1
	);

	$posts = new WP_Query($args);

	if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
		foreach( $posts->posts as $p ){
			$custom_blocks[$p->ID] = $p->post_title;
		}
	}

	wp_reset_postdata();
	
	return $custom_blocks;
}

function loobek_get_product_attribute_taxonomies_options(){
	$attribute_options = array();
	if( class_exists('WooCommerce') ){
		$attributes = wc_get_attribute_taxonomies();

		if( !empty($attributes) ){
			$attribute_options[0] = esc_html__('Select an attribute', 'loobek');
			foreach( $attributes as $attr ){
				$attribute_options[ $attr->attribute_name ] = $attr->attribute_label;
			}
		}
	}
	return $attribute_options;
}