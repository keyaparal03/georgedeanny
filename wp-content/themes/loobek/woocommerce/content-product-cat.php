<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_cat_icon = isset($show_icon)?$show_icon:false;
$show_cat_title = isset($show_title)?$show_title:true;
$show_cat_product_count = isset($show_product_count)?$show_product_count:true;

$term_link = get_term_link( $category, 'product_cat' );
?>
<section <?php wc_product_cat_class('product-category product', $category); ?>>
	
	<div class="product-wrapper">

		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
		
		<a href="<?php echo esc_url($term_link) ?>">
		<?php
			if( !$show_cat_icon ){
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			}
			else{
				$icon_id = get_term_meta($category->term_id, 'icon_id', true);
				if( $icon_id ){
					echo wp_get_attachment_image($icon_id, 'thumbnail');
				}
			}
		?>
		</a>
		
		<div class="meta-wrapper">
		
			<div class="category-name">
				<?php if( $show_cat_title ){ ?>
				<h3 class="heading-title">
					<a href="<?php echo esc_url($term_link) ?>">
						<?php echo esc_html($category->name); ?>
					</a>
				</h3>
				<?php } ?>
				<?php 
				if ( $show_cat_product_count ){
					echo apply_filters( 'woocommerce_subcategory_count_html', '<div class="count">' . sprintf( _n( '%s Product', '%s Products', $category->count, 'loobek' ), $category->count ) . '</div>', $category );
				}
				?>
			</div>
		</div>
		
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

		<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
	</div>

</section>