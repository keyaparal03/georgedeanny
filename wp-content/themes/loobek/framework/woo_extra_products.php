<?php
class Loobek_WooCommerce_Extra_Products{
	protected static $instance;
	
	public function __construct(){
		/* Backend */
		add_filter( 'woocommerce_product_data_tabs', array( $this, 'add_extra_products_tab' ), 10, 1 );
		add_action( 'woocommerce_product_data_panels', array( $this, 'add_extra_products_panel' ) );
		
		add_action( 'wp_ajax_loobek_ajax_search_extra_product', array( $this, 'ajax_search_extra_product' ) );
		add_action( 'wp_ajax_nopriv_loobek_ajax_search_extra_product', array( $this, 'ajax_search_extra_product' ) );
		
		$product_types = array(
					'simple'
					,'variable'
					,'grouped'
					,'external'
				);
				
		foreach ( $product_types as $product_type ) {
			add_action( 'woocommerce_process_product_meta_' . $product_type, array( $this, 'save_extra_products_tab' ), 10, 1 );
		}
		
		/* Frontend */
		add_action('woocommerce_before_add_to_cart_button', array($this, 'extra_products_html'));
		add_action('woocommerce_before_variations_form', array($this, 'extra_products_html'));
		
		add_action('wp_loaded', array($this, 'add_extra_products_to_cart'), 20);
	}
	
	public static function get_instance(){
		if( is_null( self::$instance ) ){
			self::$instance = new self();
		}

		return self::$instance;
	}
	
	function add_extra_products_tab( $tabs ){
		$tabs['ts-extra-products'] = array(
				'label'   => _x( 'TS Extra Products', 'tab in product data box', 'loobek' )
				,'target' => 'ts_extra_products_data_option'
				,'class'  => array( 'hide_if_grouped', 'hide_if_external', 'hide_if_bundle' )
			);
			
		return $tabs;
	}
	
	function add_extra_products_panel(){
		global $post;

		$product_id = $post->ID;
		$to_exclude = array( $product_id );
		
		$heading = get_post_meta( $product_id, 'ts_extra_products_heading', true );
		
		$product_ids = get_post_meta( $product_id, 'ts_extra_products', true );
		$product_ids = array_filter( array_map( 'absint', (array) $product_ids ) );
		$selected_products    = array();

		foreach( $product_ids as $product_id ){
			$product = wc_get_product( $product_id );
			if( is_object( $product ) ){
				$selected_products[ $product_id ] = html_entity_decode( $product->get_formatted_name() );
			}
		}
		?>
		<div id="ts_extra_products_data_option" class="panel woocommerce_options_panel">
			<div class="options_group">
				<p class="form-field">
					<label for="ts_extra_products_heading"><?php esc_html_e( 'Heading', 'loobek' ); ?></label>
					<input type="text" name="ts_extra_products_heading" id="ts_extra_products_heading" class="short" value="<?php echo esc_attr($heading); ?>" placeholder="<?php esc_attr_e('Add some accessories', 'loobek'); ?>" />
				</p>
				<p class="form-field">
					<label for="ts_extra_products"><?php esc_html_e( 'Select products', 'loobek' ); ?></label>
					<select
						id="ts_extra_products"
						class="wc-product-search"
						name="ts_extra_products[]"
						data-placeholder="<?php esc_attr_e( 'Search for products', 'loobek' ); ?>"
						data-allow_clear="false"
						data-action="loobek_ajax_search_extra_product"
					    multiple="multiple"
						style="width: 50%;"
						data-exclude="<?php echo esc_attr( $post->ID ); ?>"
					>
						<?php foreach( $selected_products as $id => $name ){ ?>
							<option value="<?php echo esc_attr( $id ); ?>" <?php selected( true, true, true ); ?> >
								<?php echo esc_html( $name ); ?>
							</option>
						<?php } ?>
					</select>
				</p>
			</div>
		</div>
		<?php
	}
	
	function ajax_search_extra_product(){
		$term = isset( $_GET['term'] ) ? (string) wc_clean( stripslashes( $_GET['term'] ) ) : '';
		
		$to_exclude = isset( $_GET['exclude'] ) ? explode( ',', wc_clean( stripslashes( $_GET['exclude'] ) ) ) : false;
		if( empty( $term ) ){
			die();
		}
		
		$args = array(
			'post_type'       => 'product'
			,'post_status'    => 'publish'
			,'posts_per_page' => -1
			,'s'              => $term
			,'fields'         => 'ids'
		);

		if( $to_exclude ){
			$args['post__not_in'] = $to_exclude;
		}
		
		if( is_numeric( $term ) ){
			$args2 = array(
				'post_type'       => 'product'
				,'post_status'    => 'publish'
				,'posts_per_page' => -1
				,'post__in'       => array( 0, $term )
				,'fields'         => 'ids'
			);

			$args3 = array(
				'post_type'       => 'product'
				,'post_status'    => 'publish'
				,'posts_per_page' => -1
				,'meta_query'     => array(
					array(
						'key'      => '_sku'
						,'value'   => $term
						,'compare' => 'LIKE'
					)
				)
				,'fields'         => 'ids'
			);

			$posts = array_unique( array_merge( get_posts( $args ), get_posts( $args2 ), get_posts( $args3 ) ) );
		} else {
			$args2 = array(
				'post_type'       => 'product'
				,'post_status'    => 'publish'
				,'posts_per_page' => -1
				,'meta_query'     => array(
					array(
						'key'      => '_sku'
						,'value'   => $term
						,'compare' => 'LIKE'
					)
				)
				,'fields'         => 'ids'
			);

			$posts = array_unique( array_merge( get_posts( $args ), get_posts( $args2 ) ) );
		}
			
		$found_products = array();

		if( $posts ){
			foreach( $posts as $post ){
				$product = wc_get_product( $post );
				if( $product->get_type() != 'simple' ){
					continue;
				}

				$found_products[ $post ] = rawurldecode( $product->get_formatted_name() );
			}
		}

		wp_send_json( $found_products );
	}
	
	function save_extra_products_tab( $post_id ){
		if( !empty( $_POST['ts_extra_products_heading'] ) ){
			update_post_meta( $post_id, 'ts_extra_products_heading', $_POST['ts_extra_products_heading'] );
		}
		else{
			delete_post_meta( $post_id, 'ts_extra_products_heading' );
		}
		
		$products_array = array();
		if( isset( $_POST['ts_extra_products'] ) ){
			$products_array = ! is_array( $_POST['ts_extra_products'] ) ? array_map( 'sanitize_text_field', explode( ',', stripslashes_deep( $_POST['ts_extra_products'] ) ) ) : stripslashes_deep( array_map( 'sanitize_text_field', $_POST['ts_extra_products'] ) );
			$products_array = array_filter( array_map( 'intval', $products_array ) );
		}
		if( $products_array ){
			update_post_meta( $post_id, 'ts_extra_products', $products_array );
		}
		else{
			delete_post_meta( $post_id, 'ts_extra_products' );
		}
	}
	
	/* Frondend */
	function extra_products_html(){
		global $product;
		if( !is_singular('product') && !( isset( $_POST['action'] ) && $_POST['action'] == 'loobek_load_quickshop_content' ) ){
			return;
		}
		
		if( wp_cache_get('ts_extra_products_is_added') !== false ){
			return;
		}
		
		if( !is_object($product) ){
			return;
		}
		
		if( !in_array( $product->get_type(), array('simple', 'variable') ) ){
			return;
		}
		
		$product_ids = get_post_meta( $product->get_id(), 'ts_extra_products', true );
		if( !is_array( $product_ids ) ){
			return;
		}
		
		$heading = get_post_meta( $product->get_id(), 'ts_extra_products_heading', true );
		?>
		<div class="ts-extra-products-wrapper">
			<?php if( $heading ){ ?>
			<div class="heading"><?php echo esc_html( $heading ); ?></div>
			<?php } ?>
			
			<div class="items">
			<?php
			foreach( $product_ids as $product_id ){
				$prod = wc_get_product( $product_id );
				
				if( is_object($prod) && $prod->get_type() == 'simple' ){
				?>
					<div class="item">
						<div class="product-image-meta">
							<div class="image">
								<?php echo wp_kses( $prod->get_image(), 'loobek_product_image' ); ?>
							</div>
							<div class="meta">
								<span><?php echo wp_kses( $prod->get_name(), 'loobek_product_name' ); ?></span>
								<?php echo wp_kses( $prod->get_price_html(), 'loobek_product_price' ); ?>
							</div>
						</div>
						<label>
							<input type="checkbox" class="ts-extra-products-checkbox" value="<?php echo esc_attr( $prod->get_id() ); ?>" />
							<span data-checked="<?php esc_attr_e('Selected', 'loobek'); ?>" data-unchecked="<?php esc_attr_e('Select', 'loobek'); ?>"><?php esc_html_e('Select', 'loobek'); ?></span>
						</label>
					</div>
				<?php
				}
			}
			?>
			</div>
			<input type="hidden" name="ts-extra-products" class="ts-extra-products-value" value="" />
		</div>
		<?php
		wp_cache_set('ts_extra_products_is_added', 1);
	}
	
	function add_extra_products_to_cart(){
		if( empty( $_POST['ts-extra-products'] ) ){
			return;
		}
		
		$quantity = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;
		
		$products_added = array();
		$message        = array();
		
		$product_ids = array_map('absint', explode( ',', $_POST['ts-extra-products'] ) );
		
		foreach( $product_ids as $product_id ){
			$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity );
				
			if( $cart_item_key ){
				$products_added[ $cart_item_key ] = $product_id;
				$message[ $product_id ]           = $quantity;
			}
		}
		
		if( ! empty( $message ) ){
			wc_add_to_cart_message( $message );
		}
	}
}

Loobek_WooCommerce_Extra_Products::get_instance();