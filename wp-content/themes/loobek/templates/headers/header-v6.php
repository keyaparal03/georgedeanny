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

<header class="ts-header header-sticky logo-center <?php echo esc_attr(implode(' ', $header_classes)); ?>">
	<div class="overlay"></div>
	<div class="header-template">
		<div class="header-middle">
			<div class="container">
			
				<?php if( $loobek_theme_options['ts_header_mobile_layout'] == 'v1' || $loobek_theme_options['ts_header_mobile_layout'] == 'v4' ): ?>
				<div class="header-left visible-phone">
				
					<?php if( ( wp_is_mobile() && $loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ) || !$loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ): ?>
					<div class="ts-mobile-icon-toggle">
						<span class="icon"></span>
					</div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_enable_search'] && ( $loobek_theme_options['ts_header_mobile_layout'] == 'v1' ) ): ?>
					<div class="search-button"><span class="icon"></span></div>
					<?php endif; ?>
					
				</div>
				<?php endif; ?>
				
				<div class="header-left hidden-phone">
				
					<?php if( !empty( $loobek_theme_options['ts_second_menu_middle_header'] ) ): ?>
					<div class="menu-wrapper hidden-phone">
						<div class="ts-menu">
						<?php wp_nav_menu( array( 'menu' => $loobek_theme_options['ts_second_menu_middle_header'], 'container' => 'nav', 'container_class' => 'second-menu-middle', 'depth' => 1 ) ); ?>
						</div>
					</div>
					<?php endif; ?>
					
				</div>
					
				<div class="logo-wrapper"><?php loobek_theme_logo(); ?></div>
				
				<?php if( $loobek_theme_options['ts_header_language'] || $loobek_theme_options['ts_header_currency'] ): ?>
				<div class="group-language-currency">
				
					<?php if( $loobek_theme_options['ts_header_language'] ): ?>
					<div class="header-language"><?php loobek_wpml_language_selector(); ?></div>
					<?php endif; ?>
					
					<?php if( $loobek_theme_options['ts_header_currency'] ): ?>
					<div class="header-currency"><?php loobek_woocommerce_multilingual_currency_switcher(); ?></div>
					<?php endif; ?>
					
				</div>
				<?php endif; ?>
				
				<div class="header-right">
					
					<?php if( $loobek_theme_options['ts_header_language'] || $loobek_theme_options['ts_header_currency'] ): ?>
					<div class="group-language-currency">
					
						<?php if( $loobek_theme_options['ts_header_language'] ): ?>
						<div class="header-language"><?php loobek_wpml_language_selector(); ?></div>
						<?php endif; ?>
						
						<?php if( $loobek_theme_options['ts_header_currency'] ): ?>
						<div class="header-currency"><?php loobek_woocommerce_multilingual_currency_switcher(); ?></div>
						<?php endif; ?>
						
					</div>
					<?php endif; ?>
					
					<?php if( (( wp_is_mobile() && $loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ) || !$loobek_theme_options['ts_only_load_mobile_menu_on_mobile']) && $loobek_theme_options['ts_header_mobile_layout'] == 'v2' ): ?>
					<div class="ts-mobile-icon-toggle">
						<span class="icon"></span>
					</div>
					<?php endif; ?>
					
					<div class="icon-menu-sticky-header hidden-phone">
						<span class="icon"></span>
					</div>
					
					<?php if( $loobek_theme_options['ts_enable_search'] ): ?>
					<div class="search-button"><span class="icon"></span></div>
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
		
		<div class="header-bottom">
			<div class="container">
			
				<div class="menu-wrapper hidden-phone">
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
			
			</div>
		</div>		
		
	</div>	
</header>