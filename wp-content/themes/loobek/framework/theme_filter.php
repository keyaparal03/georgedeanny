<?php
/*** Comment ***/
function loobek_list_comments( $comment, $args, $depth ){
	switch ( $comment->comment_type ) :
		case '' :
		case 'comment' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>"  class="comment-wrapper">
			<div class="avatar">
				<?php echo get_avatar( $comment, 100, 'mystery' ); ?>
			</div>
			
			<div class="entry-meta-comment">		
				<span class="author">
					<?php echo sprintf( '<a href="%1$s" rel="external nofollow" class="url">%2$s</a>', get_comment_author_url(), get_comment_author() ); ?>
				</span>
				<span class="date-time"><?php echo get_comment_date(); ?></span>
			</div>
			<div class="comment-detail">
						
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'loobek' ); ?></em>
				<?php endif; ?>
						
				<div class="comment-text"><?php comment_text(); ?></div>
				
				<div class="comment-meta">
					<?php if( is_user_logged_in() ): ?>
					<span class="edit"><?php edit_comment_link( esc_html__( 'Edit', 'loobek' ), '' ); ?></span>
					<?php endif;?>
					
					<span class="reply"><?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'respond_id' => 'comment-wrapper' ) ) ); ?></span>
				</div>
				
			</div>
		</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'loobek' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'loobek' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

function loobek_comment_form( $args = array(), $post_id = null ){
	global $user_identity;

	if( null === $post_id ){
		$post_id = get_the_ID();
	}
	
	$allowed_html = array(
		'div'	=> array( 'class' => array() )
		,'p'	=> array( 'class' => array() )
		,'span'	=> array( 'class' => array() )
		,'a' 	=> array( 'href' => array(), 'title' => array(), 'rel' => array() )
	);

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$comment_author = '';
	$comment_author_email = '';
	
	extract(array_filter(array(
		'comment_author'		=>	esc_attr($commenter['comment_author'])
		,'comment_author_email'	=>	esc_attr($commenter['comment_author_email'])
	)), EXTR_OVERWRITE);
	
	$fields =  array(
		'author' => '<p class="author-row"><label>'.wp_kses( __('Your Name <span class="required">*</span>','loobek'), $allowed_html ).'</label>' . '<input id="author" class="input-text" name="author" type="text" value="' .$comment_author. '" size="30"' . $aria_req . ' />' . '</p>'
		,'email'  => '<p class="email-row"><label>'.wp_kses( __('Your Email <span class="required">*</span>','loobek'), $allowed_html ).'</label><input id="email" class="input-text" name="email" type="text" value="' . $comment_author_email . '" size="30"' . $aria_req . '/>' . '</p>'
	);

	$required_text = sprintf( ' ' . wp_kses( __('Required fields are marked %s','loobek'), $allowed_html ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields )
		,'fields_before'		   => '<div class="info-wrapper">'
		,'fields_after'		   => '</div>'
		,'comment_field'        => '<div class="message-wrapper"><p><label>'.esc_html__('Your Comment', 'loobek').'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>'
		,'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'loobek' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>'
		,'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'loobek' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>'
		,'comment_notes_before' => ''
		,'comment_notes_after'  => ''
		,'id_form'              => 'commentform'
		,'id_submit'            => 'submit'
		,'title_reply'          => esc_html__( 'Leave a comment', 'loobek' )
		,'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'loobek')
		,'cancel_reply_link'    => esc_html__( 'Cancel reply', 'loobek' )
		,'label_submit'         => esc_html__( 'Submit', 'loobek' )
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<section id="comment-wrapper">
				<header class="heading-wrapper">
					<h2 id="reply-title" class="heading-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h2>
				</header>
				
				<?php 
					if( get_option( 'comment_registration' ) && !is_user_logged_in() ):
						echo wp_kses($args['must_log_in'], $allowed_html);
						do_action( 'comment_form_must_log_in_after' );
					else: 
				?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php 
							do_action( 'comment_form_top' );
							if ( is_user_logged_in() ){
								echo wp_kses( apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ), $allowed_html );
								do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							}
							else{
								echo wp_kses($args['comment_notes_before'], $allowed_html);
								echo wp_kses($args['fields_before'], $allowed_html);
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								echo wp_kses($args['fields_after'], $allowed_html);								
							}
							echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
							echo wp_kses($args['comment_notes_after'], $allowed_html);
							if ( !is_user_logged_in() ){ 
								do_action( 'comment_form_after_fields' ); 
							}
						?>
						<p class="form-submit">
							<button class="button button-2" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><?php echo esc_html( $args['label_submit'] ); ?></button>

							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</section>
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
<?php
}

/* kses allowed html */
add_filter('wp_kses_allowed_html', 'loobek_wp_kses_allowed_html', 10, 2);
function loobek_wp_kses_allowed_html( $tags, $context ){
	switch( $context ){
		case 'loobek_tgmpa':
			$tags = array(
				'a' 		=> array( 'href' => array(), 'class' => array(), 'target' => array() )
				,'p' 		=> array( 'class' => array() )
				,'span' 	=> array( 'class' => array() )
				,'strong' 	=> array()
				,'br' 		=> array()
			);
		break;
		case 'loobek_product_image':
			$tags = array(
				'img' 		=> array( 
					'width' 	=> array()
					,'height' 	=> array()
					,'src' 		=> array()
					,'class' 	=> array()
					,'id' 		=> array()
					,'alt' 		=> array()
					,'loading' 	=> array()
					,'title' 	=> array()
					,'srcset' 	=> array()
					,'sizes' 	=> array()
					,'style' 	=> array()
					,'data-*' 	=> array()
				)
			);
		break;
		case 'loobek_product_name':
			$tags = array(
				'h3' 		=> array( 'class' => array() )
				,'h4' 		=> array( 'class' => array() )
				,'span' 	=> array( 'class' => array() )
				,'a' 		=> array( 'href' => array(), 'class' => array(), 'title' => array(), 'target' => array() )
			);
		break;
		case 'loobek_product_price':
			$tags = array(
				'span' 		=> array( 'class' => array(), 'data-*' => array() )
				,'div' 		=> array( 'class' => array(), 'data-*' => array() )
				,'p' 		=> array( 'class' => array(), 'data-*' => array() )
				,'bdi' 		=> array()
				,'ins' 		=> array()
				,'del' 		=> array()
			);
		break;
		case 'loobek_link':
			$tags = array(
				'a' 		=> array( 
					'href' 		=> array()
					,'target' 	=> array()
					,'class' 	=> array()
					,'style' 	=> array()
					,'title' 	=> array()
					,'rel' 		=> array()
					,'data-*' 	=> array()
				)
			);
		break;
		case 'loobek_header_feature':
			$tags = array(
				'span' 		=> array( 'class' => array(), 'style' => array() )
			);
		break;
	}
	return $tags;
}

/* Check if has breadcrumb */
function loobek_has_breadcrumb_area(){
	if( is_home() || is_front_page() ){
		return false;
	}
	if( is_singular('product') && !loobek_get_theme_options('ts_prod_breadcrumb') && !( loobek_get_theme_options('ts_prod_title') && !loobek_get_theme_options('ts_prod_title_in_content') ) ){
		return false;
	}
	if( !loobek_get_page_options('ts_show_breadcrumb', true) && !loobek_get_page_options('ts_show_page_title', true) ){
		return false;
	}
	return true;
}

/* Body classes filter */
add_filter('body_class', 'loobek_body_classes_filter');
function loobek_body_classes_filter( $classes ){
	$theme_options = loobek_get_theme_options();
	
	if( $theme_options['ts_layout_fullwidth'] ){
		if( $theme_options['ts_header_layout_fullwidth'] && $theme_options['ts_main_content_layout_fullwidth'] && $theme_options['ts_footer_layout_fullwidth'] ){
			$classes[] = 'layout-fullwidth';
			
			loobek_change_theme_options('ts_header_layout_fullwidth', 0); /* Dont add class in content */
			loobek_change_theme_options('ts_main_content_layout_fullwidth', 0);
			loobek_change_theme_options('ts_footer_layout_fullwidth', 0);
		}
		
		if( $theme_options['ts_layout_style'] == 'boxed' ){
			$theme_options['ts_layout_style'] = 'wide';
		}
	}
	else{
		loobek_change_theme_options('ts_header_layout_fullwidth', 0); /* Dont add class in content */
		loobek_change_theme_options('ts_main_content_layout_fullwidth', 0);
		loobek_change_theme_options('ts_footer_layout_fullwidth', 0);
	}
	
	$classes[] = $theme_options['ts_layout_style'];
	
	if( $theme_options['ts_image_button_radius'] ){
		$classes[] = 'image-button-radius';
	}
	
	if( $theme_options['ts_text_uppercase'] ){
		$classes[] = 'text-uppercase';
	}
	
	if( is_rtl() || ( isset($theme_options['ts_enable_rtl']) && $theme_options['ts_enable_rtl'] ) ){
		$classes[] = 'rtl';
	}
	
	if( isset($theme_options['ts_header_layout']) ){
		$classes[] = 'header-' . $theme_options['ts_header_layout'];
	}
	
	if( isset($theme_options['ts_icon_number_style']) ){
		$classes[] = 'header-number-style-' . $theme_options['ts_icon_number_style'];
	}
	
	if( isset($theme_options['ts_header_mobile_layout']) ){
		$classes[] = 'header-mobile-' . $theme_options['ts_header_mobile_layout'];
	}
	
	if( $theme_options['ts_breadcrumb_overlap_header'] && in_array( $theme_options['ts_breadcrumb_layout'], array('v2', 'v3') ) && loobek_has_breadcrumb_area() ){
		wp_cache_set('ts_is_transparent_header', true);
		$classes[] = 'header-transparent has-breadcrumb';
		if( $theme_options['ts_overlapped_header_text_color'] ){
			$classes[] = 'header-text-' . $theme_options['ts_overlapped_header_text_color'];
		}
		if( $theme_options['ts_breadcrumb_layout'] == 'v3' ){
			$classes[] = 'no-absolute';
		}
	}
	
	if( !class_exists('WooCommerce') || !class_exists('YITH_Woocompare') ){
		$classes[] = 'hidden-compare';
	}
	
	if( $theme_options['ts_enable_catalog_mode']){
		$classes[] = 'enable-catalog-mode';
	}
	
	if( isset($theme_options['ts_product_label_style']) ){
		$classes[] = 'product-label-' . $theme_options['ts_product_label_style'];
	}
	
	if( isset($theme_options['ts_product_label_align']) ){
		$classes[] = 'label-align-' . $theme_options['ts_product_label_align'];
	}
	
	if( isset($theme_options['ts_product_hover_style']) ){
		$classes[] = 'product-hover-style-' . $theme_options['ts_product_hover_style'];
	}
	
	if( isset($theme_options['ts_product_mobile_style']) ){
		$classes[] = 'product-mobile-style-' . $theme_options['ts_product_mobile_style'];
	}
	
	if( isset($theme_options['ts_product_tooltip']) && !$theme_options['ts_product_tooltip'] ){
		$classes[] = 'product-no-tooltip';
	}
	
	if( isset($theme_options['ts_shopping_cart_quantity_input']) && $theme_options['ts_shopping_cart_quantity_input'] == 'inline' ){
		$classes[] = 'cart-quantity-inline';
	}
	
	if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( $theme_options['ts_prod_cat_loading_type'] != 'default' ){
			$classes[] = $theme_options['ts_prod_cat_loading_type'];
		}
		if( $theme_options['ts_filter_products_by_attribute_widget_style'] == 'inline' ){
			$classes[] = 'filter-by-attribute-inline';
		}
	}
	
	if( !wp_is_mobile() ){
		$classes[] = 'ts_desktop';
	}
	
	global $is_safari;
	if( !empty($is_safari) ){
		$classes[] = 'is-safari';
	}
	
	return $classes;
}
?>