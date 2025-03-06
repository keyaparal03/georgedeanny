<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

$review_link = apply_filters('loobek_woocommerce_review_link_filter', '#reviews');
?>
<div class="woocommerce-product-rating">
	<?php
	if( $rating_count > 0 ){
		echo wc_get_rating_html( $average, $rating_count );
	}
	?>
	<span><?php echo sprintf( _n('%d Review', '%d Reviews', $review_count, 'loobek'), $review_count ); ?></span>
	<?php if( comments_open() ){ ?>
		<a href="<?php echo esc_url($review_link); ?>" class="woocommerce-review-link" rel="nofollow"><?php esc_html_e( 'Write a review', 'loobek' ); ?></a>
	<?php } ?>
</div>
