<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_options = loobek_get_theme_options();

$show_breadcrumb = get_post_meta(wc_get_page_id( 'shop' ), 'ts_show_breadcrumb', true);
if( $show_breadcrumb === '' ){ /* page is not saved yet */
	$show_breadcrumb = true;
}
$show_page_title = apply_filters( 'woocommerce_show_page_title', true ) && get_post_meta(wc_get_page_id( 'shop' ), 'ts_show_page_title', true);
loobek_breadcrumbs_title($show_breadcrumb, $show_page_title, woocommerce_page_title(false));

$extra_class = '';
if( $show_breadcrumb || $show_page_title ){
	$extra_class = 'show-breadcrumb-'.$theme_options['ts_breadcrumb_layout'];
}

$classes = array();
$show_filter_area = loobek_is_active_filter_area();
if( $show_filter_area ){
	$theme_options['ts_prod_cat_layout'] = '0-1-0';
	$classes[] = 'style-filter-' . $theme_options['ts_filter_widget_area_style'];
	
	/* Button Filter Position */
	if( ( $theme_options['ts_filter_button_position'] && $theme_options['ts_filter_widget_area_style'] != 'dropdown' ) && ( $theme_options['ts_prod_cat_onsale_checkbox'] || $theme_options['ts_prod_cat_columns_selector'] ) ){
		$classes[] = 'filter-button-position-'.$theme_options['ts_filter_button_position'];
	}
	/* Filter Dropdown Style */
	if( $theme_options['ts_filter_widget_area_style'] == 'dropdown' && $theme_options['ts_filter_dropdown_style'] ){
		$classes[] = 'style-dropdown-'.$theme_options['ts_filter_dropdown_style'];
	}
}
else{
	$classes[] = 'no-filter-area';
}

$page_column_class = loobek_page_layout_columns_class($theme_options['ts_prod_cat_layout']);

/* Special Filter Area */
if( loobek_special_filter_area() ){
	/* Sub Categories Style */
	if( $theme_options['ts_filter_sub_cat_border'] && $theme_options['ts_special_filter_area'] == 'subcategory' ){
		$classes[] = 'subcat-has-border';
	}
	/* Sub Categories Style */
	if( $theme_options['ts_special_filter_area'] == 'attribute' ){
		$classes[] = 'has-special-attribute';
	}
}

/* Sort Filter Style */
if( $theme_options['ts_prod_cat_sort_filter_style'] == 'v1' ){
	$classes[] = 'style-sort-default';
}
elseif( $theme_options['ts_prod_cat_sort_filter_style'] == 'v2' ){
	$classes[] = 'style-sort-border';
}
elseif( $theme_options['ts_prod_cat_sort_filter_style'] == 'v3' ){
	$classes[] = 'style-sort-border-overflow';
}
/* Product Style */
if( $theme_options['ts_prod_cat_product_style'] ){
	$classes[] = 'product-'.$theme_options['ts_prod_cat_product_style'];
}
/* Product Columns Selector */
if( !$theme_options['ts_prod_cat_columns_selector'] ){
	$classes[] = 'hide-columns-selector';
}
/* Products On Sale Checkbox */
if( !$theme_options['ts_prod_cat_onsale_checkbox'] ){
	$classes[] = 'hide-onsale-checkbox';
}

?>
<div class="page-container <?php echo esc_attr($extra_class) ?> <?php echo esc_attr($page_column_class['main_class']); ?>">

	<?php
	if( $theme_options['ts_shop_category_description_position'] == 'out-of-main-content' ){
		loobek_shop_category_description();
	}
	?>

	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
	<div id="left-sidebar" class="ts-sidebar">
		<aside>
			<span class="close"></span>
		<?php 
		
		if( is_active_sidebar($theme_options['ts_prod_cat_left_sidebar']) ){
			loobek_product_on_sale_form();
			dynamic_sidebar( $theme_options['ts_prod_cat_left_sidebar'] );
		}
		?>
		</aside>
	</div>
	<?php endif; ?>	
	
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	<div id="main-content" class="<?php echo esc_attr(implode(' ', $classes)); ?>">	
		<div id="primary" class="site-content">
		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( woocommerce_product_loop() ) : ?>
		
			<?php
			if( woocommerce_products_will_display() ){
			?>
				<div class="before-loop-wrapper">
					<?php
					
					loobek_widget_layered_nav_filters( array('dropdown') );
					
					echo loobek_special_filter_area();
					
					do_action( 'woocommerce_before_shop_loop' );
					?>
				</div>
			<?php 
				loobek_filter_widget_area( array('sidebar','top') );
			}
			?>
			
			<?php 
			global $woocommerce_loop;
			if( $theme_options['ts_prod_cat_columns'] == '1-1' ){
				$woocommerce_loop['columns'] = 1;
			}
			else{
				$woocommerce_loop['columns'] = absint($theme_options['ts_prod_cat_columns']);
			}
			?>
			<div class="woocommerce main-products columns-<?php echo esc_attr($woocommerce_loop['columns']); ?> <?php echo esc_attr( $theme_options['ts_prod_cat_columns'] == '1-1' ? 'big-thumbnail' : '' ) ?>">
			<?php
			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ){
					the_post();

					do_action( 'woocommerce_shop_loop' );
				
					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();
			?>
			</div>
			
			<div class="after-loop-wrapper"><?php do_action( 'woocommerce_after_shop_loop' ); ?></div>
			
		<?php else: ?>

			<?php do_action( 'woocommerce_no_products_found' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		
		loobek_shop_category_bottom_content();
	?>
		</div>
	</div>
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<div id="right-sidebar" class="ts-sidebar">	
			<aside>
				<span class="close"></span>
			<?php 
			if( is_active_sidebar($theme_options['ts_prod_cat_right_sidebar']) ){
				loobek_product_on_sale_form();
				dynamic_sidebar( $theme_options['ts_prod_cat_right_sidebar'] );
			}
			?>
			</aside>
		</div>
	<?php endif; ?>	
	
</div>
<?php get_footer(); ?>