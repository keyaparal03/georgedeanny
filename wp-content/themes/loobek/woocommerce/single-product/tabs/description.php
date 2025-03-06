<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'loobek' ) );

$enable_more_less = loobek_get_theme_options('ts_prod_more_less_content');
?>

<?php if( $heading ){ ?>
<h2><?php echo esc_html( $heading ); ?></h2>
<?php } ?>

<div class="product-content <?php echo esc_attr($enable_more_less?'closed show-more-less':''); ?>">
	<?php the_content(); ?>
</div>

<?php if( $enable_more_less ){ ?>
<div class="more-less-buttons">
	<a href="#" class="more-button button button-border" data-action="opened"><span><?php esc_html_e('Show More', 'loobek'); ?></span></a>
	<a href="#" class="less-button button button-border" data-action="closed"><span><?php esc_html_e('Show Less', 'loobek'); ?></span></a>
</div>
<?php } ?>