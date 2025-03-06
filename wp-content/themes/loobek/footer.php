<?php 
$loobek_theme_options = loobek_get_theme_options();
?>
</div><!-- #main .wrapper -->
	<?php if( !is_page_template('page-templates/blank-page-template.php') && $loobek_theme_options['ts_footer_block'] ): ?>
	<footer id="colophon" class="footer-container footer-area hidden <?php echo esc_attr( $loobek_theme_options['ts_footer_layout_fullwidth'] ? 'footer-fullwidth' : '' ) ?>">
		<?php loobek_get_footer_content( $loobek_theme_options['ts_footer_block'] ); ?>
	</footer>
	<?php endif; ?>
</div><!-- #page -->

<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>
	<?php if( ( wp_is_mobile() && $loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ) || !$loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ): ?>
		<!-- Group Header Button -->
		<div id="group-icon-header">
			<div class="ts-sidebar-content">
				
				<div class="sidebar-content">
					
					<h6 class="menu-title"><span><?php esc_html_e('Main Menu', 'loobek'); ?></span></h6>
					
					<div class="mobile-menu-wrapper ts-menu">
						<?php 
						if( has_nav_menu( 'mobile' ) ){
								wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'mobile', 'walker' => new Loobek_Walker_Nav_Menu() ) );
							}else if( has_nav_menu( 'primary' ) ){
								wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary', 'walker' => new Loobek_Walker_Nav_Menu() ) );
							}
							else{
								wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu' ) );
							}
						?>
					</div>
					
					<?php if( class_exists('YITH_WCWL') && $loobek_theme_options['ts_enable_tiny_wishlist'] && $loobek_theme_options['ts_header_mobile_layout'] == 'v1' ): ?>
					<div class="my-wishlist-wrapper"><?php echo loobek_tini_wishlist(); ?></div>
					<?php endif; ?>
					
					<?php if( ($loobek_theme_options['ts_header_currency'] || $loobek_theme_options['ts_header_language']) && ($loobek_theme_options['ts_header_mobile_layout'] == 'v1' || $loobek_theme_options['ts_header_mobile_layout'] == 'v4')): ?>
					<div class="group-mobile-bottom">
							
						<?php if( $loobek_theme_options['ts_header_language'] ): ?>
						<div class="header-language"><?php loobek_wpml_language_selector(); ?></div>
						<?php endif; ?>
						
						<?php if( $loobek_theme_options['ts_header_currency'] ): ?>
						<div class="header-currency"><?php loobek_woocommerce_multilingual_currency_switcher(); ?></div>
						<?php endif; ?>
						
					</div>
					<?php endif; ?>
					
				</div>	
				
			</div>
			
		</div>

		<!-- Mobile Group Button -->
		<?php if( $loobek_theme_options['ts_header_mobile_layout'] == 'v3' ): ?>
		<div id="ts-mobile-button-bottom">
			
			<?php if( ( wp_is_mobile() && $loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ) || !$loobek_theme_options['ts_only_load_mobile_menu_on_mobile'] ): ?>
			<div class="ts-mobile-icon-toggle">
				<span class="icon"></span>
			</div>
			<?php endif; ?>
			
			<?php if( $loobek_theme_options['ts_enable_search'] ): ?>
			<div class="search-button"><span class="icon"></span></div>
			<?php endif; ?>

			<?php if( class_exists('YITH_WCWL') && $loobek_theme_options['ts_enable_tiny_wishlist'] ): ?>
			<div class="my-wishlist-wrapper"><?php echo loobek_tini_wishlist(); ?></div>
			<?php endif; ?>
			
			<?php if( $loobek_theme_options['ts_enable_tiny_account'] ): ?>
			<div class="my-account-wrapper"><?php echo loobek_tiny_account(); ?></div>
			<?php endif; ?>
			
			<?php if( $loobek_theme_options['ts_enable_tiny_shopping_cart'] ): ?>					
			<div class="shopping-cart-wrapper">
				<?php echo loobek_tiny_cart(); ?>
			</div>
			<?php endif; ?>
			
		</div>
		<?php endif; ?>
		
	<?php endif; ?>

	<!-- Shopping Cart Floating Sidebar -->
	<?php if( class_exists('WooCommerce') && $loobek_theme_options['ts_enable_tiny_shopping_cart'] && $loobek_theme_options['ts_shopping_cart_sidebar'] && !is_cart() && !is_checkout() ): ?>
	<div id="ts-shopping-cart-sidebar" class="ts-floating-sidebar">
		<div class="overlay"></div>
		<div class="ts-sidebar-content">
			<span class="close"></span>
			<div class="ts-tiny-cart-wrapper"></div>
		</div>
	</div>
	<?php endif; ?>
	
<?php endif; ?>

<?php 
if( ( !wp_is_mobile() && $loobek_theme_options['ts_back_to_top_button'] ) || ( wp_is_mobile() && $loobek_theme_options['ts_back_to_top_button_on_mobile'] ) ): 
?>
<div id="to-top" class="scroll-button">
	<a class="scroll-button" href="javascript:void(0)" title="<?php esc_attr_e('Back to Top', 'loobek'); ?>"><?php esc_html_e('Back to Top', 'loobek'); ?></a>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>