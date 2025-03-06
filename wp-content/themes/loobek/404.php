<?php get_header(); ?>
<div class="page-container">
	<div id="main-content">	
		<div id="primary" class="site-content">
			<article>
				<h1 class="h3"><?php esc_html_e('404. Page not found.', 'loobek'); ?></h2>
				<p class="ts-description"><?php esc_html_e('Sorry, we couldn’t find the page you where looking for. We suggest that you return to homepage.', 'loobek'); ?></p>
				<?php if( $referer = wp_get_referer() ): ?>
				<a href="<?php echo esc_url( $referer ) ?>" class="button"><?php esc_html_e('Go Back', 'loobek'); ?></a>
				<?php endif; ?>
			</article>
		</div>
	</div>
</div>
<?php
get_footer();