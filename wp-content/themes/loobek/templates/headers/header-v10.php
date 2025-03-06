<?php
$loobek_theme_options = loobek_get_theme_options();

$header_classes = array();
if( !$loobek_theme_options['ts_enable_search'] ){
	$header_classes[] = 'hidden-search';
}

if( $loobek_theme_options['ts_header_layout_fullwidth'] ){
	$header_classes[] = 'header-fullwidth';
}
?>

<header class="ts-header header-sticky menu-middle <?php echo esc_attr(implode(' ', $header_classes)); ?>">
	<div class="overlay"></div>
	<div class="header-template">
			
		<div class="header-top">
			<div class="container">
			
				<?php if( $loobek_theme_options['ts_header_mobile_layout'] =='v2' || $loobek_theme_options['ts_header_mobile_layout'] =='v3' ): ?>
				<div class="logo-wrapper visible-phone"><?php loobek_theme_logo(); ?></div>
				<?php endif; ?>
				
				<div class="header-left">
					
					<?php if( (( wp_is_mobile() && $loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ) || !$loobek_theme_options['ts_only_load_mobile_menu_on_mobile']) && ( $loobek_theme_options['ts_header_mobile_layout'] == 'v1' || $loobek_theme_options['ts_header_mobile_layout'] == 'v4' ) ): ?>
					<div class="ts-mobile-icon-toggle">
						<span class="icon"></span>
					</div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_enable_search'] && ( $loobek_theme_options['ts_header_mobile_layout'] == 'v1' ) ): ?>
					<div class="search-button"><span class="icon"></span></div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_header_language'] ): ?>
					<div class="header-language"><?php loobek_wpml_language_selector(); ?></div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_header_currency'] ): ?>
					<div class="header-currency"><?php loobek_woocommerce_multilingual_currency_switcher(); ?></div>
					<?php endif; ?>
					
					<?php if( function_exists('ts_header_social_icons') && $loobek_theme_options['ts_enable_header_social_icons'] ): ?>
					<div class="header-social-icon hidden-phone"><?php ts_header_social_icons(); ?></div>
					<?php endif; ?>
					
				</div>
				
				<?php if( $loobek_theme_options['ts_header_mobile_layout'] =='v1' || $loobek_theme_options['ts_header_mobile_layout'] =='v4' ): ?>
				<div class="logo-wrapper visible-phone"><?php loobek_theme_logo(); ?></div>
				<?php endif; ?>
				
				<div class="header-right">
					
					<?php if( $loobek_theme_options['ts_second_menu_top_header'] ): ?>
					<div class="header-link hidden-phone">
						<?php wp_nav_menu( array( 'menu' => $loobek_theme_options['ts_second_menu_top_header'], 'container' => 'nav', 'container_class' => 'second-menu', 'depth' => 1 ) ); ?>
					</div>
					<?php endif; ?>
					
					<?php if( (( wp_is_mobile() && $loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ) || !$loobek_theme_options['ts_only_load_mobile_menu_on_mobile']) && $loobek_theme_options['ts_header_mobile_layout'] == 'v2' ): ?>
					<div class="ts-mobile-icon-toggle">
						<span class="icon"></span>
					</div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_enable_search'] && ( $loobek_theme_options['ts_header_mobile_layout'] == 'v2' || $loobek_theme_options['ts_header_mobile_layout'] == 'v4' ) ): ?>
					<div class="search-button visible-phone"><span class="icon"></span></div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_enable_tiny_account'] ): ?>
					<div class="my-account-wrapper">
						<?php echo loobek_tiny_account(); ?>
					</div>
					<?php endif; ?>
					
					<?php if( class_exists('YITH_WCWL') && $loobek_theme_options['ts_enable_tiny_wishlist'] ): ?>
					<div class="my-wishlist-wrapper"><?php echo loobek_tini_wishlist(); ?></div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_enable_tiny_shopping_cart'] ): ?>					
					<div class="shopping-cart-wrapper">
						<?php echo loobek_tiny_cart(); ?>
					</div>
					<?php endif; ?>
					
				</div>
				
			</div>
		</div>
			
		<div class="header-middle hidden-phone">
			<div class="container">
			
				<div class="logo-wrapper"><?php loobek_theme_logo(); ?></div>

				<div class="menu-wrapper">
					<div class="ts-menu">
						<?php 
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu ts-mega-menu-wrapper','theme_location' => 'primary','walker' => new Loobek_Walker_Nav_Menu() ) );
							}
							else{
								wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu ts-mega-menu-wrapper' ) );
							}
						?>
					</div>
				</div>
				
				<div class="header-right">
					
					<?php if( $loobek_theme_options['ts_enable_search'] ): ?>
					<div class="ts-search-normal hidden-phone"><?php get_search_form(); ?></div>
					<?php endif; ?>
					
					<div class="icon-menu-ipad-header hidden-phone">
						<span class="icon"></span>
					</div>
					
				</div>
				
			</div>
		</div>		
		
	</div>	
</header>