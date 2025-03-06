<?php
/**
 *	Template Name: Blog Template
 */	
get_header();

global $post;
setup_postdata($post);

$page_options = loobek_get_page_options();

$page_column_class = loobek_page_layout_columns_class($page_options['ts_page_layout']);

$show_breadcrumb = ( !is_home() && !is_front_page() && $page_options['ts_show_breadcrumb'] );
$show_page_title = ( !is_home() && !is_front_page() && $page_options['ts_show_page_title'] );

loobek_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());

$extra_class = '';
if( $show_breadcrumb || $show_page_title ){
	$extra_class = 'show-breadcrumb-'.loobek_get_theme_options('ts_breadcrumb_layout');
}	
?>
<div class="page-template blog-template page-container container-post <?php echo esc_attr($page_column_class['main_class']); ?> <?php echo esc_attr($extra_class) ?>">
	<!-- Page slider -->
	<?php if( $page_options['ts_page_slider'] && $page_options['ts_page_slider_position'] == 'before_main_content' ): ?>
	<div class="top-slideshow">
		<div class="top-slideshow-wrapper">
			<?php loobek_show_page_slider(); ?>
		</div>
	</div>
	<?php endif; ?>

	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar">
			<?php if( is_active_sidebar($page_options['ts_left_sidebar']) ): ?>
				<?php dynamic_sidebar( $page_options['ts_left_sidebar'] ); ?>
			<?php endif; ?>
		</aside>
	<?php endif; ?>			
	
	<div id="main-content">	
		<div id="primary" class="site-content">
			
			<?php if( get_the_content() ): ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<?php endif; ?>
			
			<?php
				loobek_blog_categories_filter();
				
				$paged = 1;
				if( is_paged() ){
					$paged = get_query_var('page');
					if( !$paged ){
						$paged = get_query_var('paged');
					}
				}
				
				$posts = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged ) );
				if( $posts->have_posts() ):
					echo '<div class="list-posts columns-' . loobek_get_theme_options('ts_blog_columns') . '">';
					while( $posts->have_posts() ) : $posts->the_post();
						get_template_part( 'content', get_post_format() ); 
					endwhile;
					echo '</div>';
					
					wp_reset_postdata();
				else:
					echo '<div class="alert alert-error">' . esc_html__('Sorry. There are no posts to display', 'loobek') . '</div>';
				endif;
				
				loobek_pagination($posts);
			?>

		</div>
	</div>
	
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar">
			<?php if( is_active_sidebar($page_options['ts_right_sidebar']) ): ?>
				<?php dynamic_sidebar( $page_options['ts_right_sidebar'] ); ?>
			<?php endif; ?>
		</aside>
	<?php endif; ?>	
		
</div><!-- #container -->
<?php get_footer(); ?>