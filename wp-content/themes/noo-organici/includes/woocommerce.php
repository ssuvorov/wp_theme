<?php

if ( class_exists( 'woocommerce' ) ) {

// Remove each style one by one
    add_filter( 'woocommerce_enqueue_styles', 'noo_organici_dequeue_styles' );
    function noo_organici_dequeue_styles( $enqueue_styles ) {
        unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
        return $enqueue_styles;
    }


	// Number of products per page
	function noo_organici_woocommerce_loop_shop_per_page() {
		return noo_organici_get_option( 'noo_shop_num', 12 );
	}
	add_filter( 'loop_shop_per_page', 'noo_organici_woocommerce_loop_shop_per_page' );

	function noo_organici_add_to_cart_fragments( $fragments ) {
		$output = noo_organici_minicart();
		$fragments['.minicart'] = $output;
		$fragments['.mobile-minicart-icon'] = noo_organici_minicart_mobile();
		return $fragments;
	}
	add_filter( 'add_to_cart_fragments', 'noo_organici_add_to_cart_fragments' );

	function noo_organici_woocommerce_remove_cart_item() {
		global $woocommerce;
		$response = array();
		
		if ( ! isset( $_GET['item'] ) && ! isset( $_GET['_wpnonce'] ) ) {
			exit();
		}
		$woocommerce->cart->set_quantity( $_GET['item'], 0 );
		
		$cart_count = $woocommerce->cart->cart_contents_count;
		$response['count'] = $cart_count != 0 ? $cart_count : "";
		$response['minicart'] = noo_organici_minicart( true );
		
		// widget cart update
		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();
		$response['widget'] = '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>';
		
		echo json_encode( $response );
		exit();
	}
	add_action( 'wp_ajax_noo_organici_woocommerce_remove_cart_item', 'noo_organici_woocommerce_remove_cart_item' );
	add_action( 'wp_ajax_nopriv_noo_organici_woocommerce_remove_cart_item', 'noo_organici_woocommerce_remove_cart_item' );

	function noo_organici_product_items_text( $count ) {
		$product_item_text = "";
		
		if ( $count > 1 ) {
			$product_item_text = str_replace( '%', number_format_i18n( $count ), esc_html__( '% items', 'noo-organici' ) );
		} elseif ( $count == 0 ) {
			$product_item_text = esc_html__( '0 items', 'noo-organici' );
		} else {
			$product_item_text = esc_html__( '1 item', 'noo-organici' );
		}
		
		return $product_item_text;
	}

	// Mobile icon
	function noo_organici_minicart_mobile() {
		if( ! noo_organici_get_option('noo_header_nav_icon_cart', true ) ) {
			return '';
		}

		global $woocommerce;
		
		$cart_output = "";
		$cart_total = $woocommerce->cart->get_cart_total();
		$cart_count = $woocommerce->cart->cart_contents_count;
		$cart_output = '<a href="' . esc_url($woocommerce->cart->get_cart_url()) . '" title="' . esc_html__( 'View Cart', 'noo-organici' ) .
			 '"  class="mobile-minicart-icon"><i class="fa fa-shopping-cart"></i><span>' . esc_html($cart_count) . '</span></a>';
		return $cart_output;
	}
	
	// Menu cart
	function noo_organici_minicart( $content = false ) {
		global $woocommerce;
		
		$cart_output = "";
		$cart_total = $woocommerce->cart->get_cart_total();
		$cart_count = $woocommerce->cart->cart_contents_count;
		$cart_count_text = noo_organici_product_items_text( $cart_count );
		
		$cart_has_items = '';
		if ( $cart_count != "0" ) {
			$cart_has_items = ' has-items';
		}
		
		$output = '';
		if ( ! $content ) {
			$output .= '<li id="nav-menu-item-cart" class="menu-item noo-menu-item-cart minicart"><a title="' .
				 esc_html__( 'View cart', 'noo-organici' ) . '" class="cart-button" href="' . esc_url($woocommerce->cart->get_cart_url()) .
				 '">' . '<span class="cart-item' . esc_html($cart_has_items) . '"><i class="fa fa-shopping-cart"></i>';
			if ( $cart_count != "0" ) {
				$output .= "<span>(" . esc_html($cart_count) . ")</span> Items";
			}
			$output .= '</span>';
			$output .= '</a>';
			$output .= '<div class="noo-minicart">';
		}
		if ( $cart_count != "0" ) {
			$output .= '<div class="minicart-header">' . esc_html($cart_count_text) . ' ' .
				 esc_html__( 'in the shopping cart', 'noo-organici' ) . '</div>';
			$output .= '<div class="minicart-body">';
			foreach ( $woocommerce->cart->cart_contents as $cart_item_key => $cart_item ) {
				
				$cart_product = $cart_item['data'];
				$product_title = $cart_product->get_title();
				$product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
				
				if ( $cart_product->exists() && $cart_item['quantity'] > 0 ) {
					$output .= '<div class="cart-product clearfix">';
					$output .= '<div class="cart-product-image"><a class="cart-product-img" href="' .
						 get_permalink( $cart_item['product_id'] ) . '">' . $cart_product->get_image() . '</a></div>';
					$output .= '<div class="cart-product-details">';
					$output .= '<div class="cart-product-title"><a href="' . get_permalink( $cart_item['product_id'] ) .
						 '">' .
						 apply_filters( 'woocommerce_cart_widget_product_title', $product_short_title, $cart_product ) .
						 '</a></div>';
					$output .= '<div class="cart-product-price">' . woocommerce_price( $cart_product->get_price() ) . '</div>';
					$output .= '<div class="cart-product-quantity">' . esc_html__( 'x ', 'noo-organici' ) . ' ' .
						 $cart_item['quantity'] . '</div>';
					$output .= '</div>';
					$output .= apply_filters( 
						'woocommerce_cart_item_remove_link', 
						sprintf( 
							'<a href="%s" class="remove" title="%s">&times;</a>', 
							esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), 
							esc_html__( 'Remove this item', 'noo-organici' ) ),
						$cart_item_key );
					$output .= '</div>';
				}
			}
			$output .= '</div>';
			$output .= '<div class="minicart-footer">';
			$output .= '<div class="minicart-total">' . esc_html__( 'Subtotal', 'noo-organici' ) . ' ' . ($cart_total) .
				 '</div>';
			$output .= '<div class="minicart-actions clearfix">';
			if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) {
				$cart_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_cart_url() );
				$checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );
				
				$output .= '<a class="button btn-primary" href="' . esc_url( $cart_url ) . '"><span class="text">' .
					 esc_html__( 'View Cart', 'noo-organici' ) . '</span></a>';
				$output .= '<a class="checkout-button button btn-primary" href="' . esc_url( $checkout_url ) .
					 '"><span class="text">' . esc_html__( 'Checkout', 'noo-organici' ) . '</span></a>';
			} else {
				
				$output .= '<a class="button btn-primary" href="' . esc_url( $woocommerce->cart->get_cart_url() ) .
					 '"><span class="text">' . esc_html__( 'View Cart', 'noo-organici' ) . '</span></a>';
				$output .= '<a class="checkout-button button btn-primary" href="' . esc_url( 
					$woocommerce->cart->get_checkout_url() ) . '"><span class="text">' .
					 esc_html__( 'Checkout', 'noo-organici' ) . '</span></a>';
			}
			$output .= '</div>';
			$output .= '</div>';
		} else {
			$output .= '<div class="minicart-header">' . esc_html__( 'Your shopping bag is empty.', 'noo-organici' ) . '</div>';
			$shop_page_url = "";
			if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) {
				$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
			} else {
				$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
			}
			
			$output .= '<div class="minicart-footer">';
			$output .= '<div class="minicart-actions clearfix">';
			$output .= '<a class="button pull-left button-null btn-primary" href="' . esc_url( $shop_page_url ) . '"><span class="text">' .
				 esc_html__( 'Go to the shop', 'noo-organici' ) . '</span></a>';
			$output .= '</div>';
			$output .= '</div>';
		}
		
		if ( ! $content ) {
			$output .= '</div>';
			$output .= '</li>';
		}
		
		return $output;
	}

	function noo_organici_navbar_shop_icons( $items, $args ) {

		if( ! NOO_WOOCOMMERCE_EXIST ) return $items;

		if ( $args->theme_location == 'primary' ) {
            $minicart = noo_organici_minicart();
            $items .= $minicart;
			if( noo_organici_get_option('noo_header_nav_icon_wishlist', true ) && defined( 'YITH_WCWL' ) ) {
				$wishlist_url = YITH_WCWL()->get_wishlist_url();
				$wishlist = '<li id="nav-menu-item-wishlist" class="menu-item noo-menu-item-wishlist"><a title="' .
				 esc_html__( 'View Wishlist', 'noo-organici' ) . '" class="wishlist-button" href="' . esc_url($wishlist_url) .
				 '"><i class="fa fa-heart"></i></a></li>';

				$items .= $wishlist;
			}
		}
		return $items;
	}
	 //add_filter( 'wp_nav_menu_items', 'noo_navbar_shop_icons', 10, 2 );

	function noo_organici_woocommerce_update_product_image_size() {
		$catalog = array( 'width' => '500', 'height' => '700', 'crop' => 1 );
		$single = array( 'width' => '500', 'height' => '700', 'crop' => 1 );
		$thumbnail = array( 'width' => '100', 'height' => '100', 'crop' => 1 );
		update_option( 'shop_catalog_image_size', $catalog );
		update_option( 'shop_single_image_size', $single );
		update_option( 'shop_thumbnail_image_size', $thumbnail );
	}
	
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
		add_action( 'init', 'noo_organici_woocommerce_update_product_image_size', 1 );
	}
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

//	function noo_organici_woocommerce_shop_columns() {
//		if ( noo_organici_get_option( 'noo_shop_layout', 'fullwidth' ) === 'fullwidth' ) {
//			return 4;
//		}
//		return 3;
//	}
//	add_filter( 'loop_shop_columns', 'noo_organici_woocommerce_shop_columns' );

	function noo_organici_woocommerce_shop_posts_per_page() {
		return noo_organici_get_option( 'noo_shop_num', 13 );
	}
	
	add_filter( 'loop_shop_per_page', 'noo_organici_woocommerce_shop_posts_per_page' );
	



	function noo_organici_template_loop_product_get_frist_thumbnail() {
		global $product, $post;
		$image = '';
		if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
			$attachment_ids = $product->get_gallery_attachment_ids();
			$image_count = 0;
			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $attachment_id ) {
					if ( noo_organici_get_post_meta( $attachment_id, '_woocommerce_exclude_image' ) )
						continue;
					
					$image = wp_get_attachment_image( $attachment_id, 'shop_catalog' );
					
					$image_count++;
					if ( $image_count == 1 )
						break;
				}
			}
		} else {
			$attachments = get_posts( 
				array( 
					'post_type' => 'attachment', 
					'numberposts' => - 1, 
					'post_status' => null, 
					'post_parent' => $post->ID, 
					'post__not_in' => array( get_post_thumbnail_id() ), 
					'post_mime_type' => 'image', 
					'orderby' => 'menu_order', 
					'order' => 'ASC' ) );
			$image_count = 0;
			if ( $attachments ) {
				foreach ( $attachments as $attachment ) {
					
					if ( noo_organici_get_post_meta( $attachment->ID, '_woocommerce_exclude_image' ) == 1 )
						continue;
					
					$image = wp_get_attachment_image( $attachment->ID, 'shop_catalog' );
					
					$image_count++;
					
					if ( $image_count == 1 )
						break;
				}
			}
		}
		return $image;
	}
	
	// Loop actions
	add_action( 'woocommerce_after_shop_loop_item', 'noo_organici_template_loop_quickview', 11 );

	function noo_organici_template_loop_quickview() {
		global $product;
		echo '<a class="shop-loop-quickview" data-product_id ="' . esc_attr($product->id) . '" href="' . esc_url($product->get_permalink()) .
			 '">' . esc_html( 'Quick shop', 'noo-organici' ) . '</a>';
	}

	
	// Quick view
	add_action( 'wp_ajax_noo_organici_woocommerce_quickview', 'noo_organici_woocommerce_quickview' );
	add_action( 'wp_ajax_nopriv_noo_organici_woocommerce_quickview', 'noo_organici_woocommerce_quickview' );

	function noo_organici_woocommerce_quickview() {
		global $woocommerce, $post, $product;
		$product_id = $_POST['product_id'];
		$product = get_product( $product_id );
		$post = get_post( $product_id );
		$output = '';
		
		ob_start();
		woocommerce_get_template( 'quickview.php' );
		$output = ob_get_contents();
		ob_end_clean();
		
		echo $output;
		die();
	}
	
	// Wishlist
	if ( ! function_exists( 'noo_organici_woocommerce_wishlist_is_active' ) ) {

		/**
		 * Check yith-woocommerce-wishlist plugin is active
		 *
		 * @return boolean .TRUE is active
		 */
		function noo_organici_woocommerce_wishlist_is_active() {
			$active_plugins = (array) get_option( 'active_plugins', array() );
			
			if ( is_multisite() )
				$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
			
			return in_array( 'yith-woocommerce-wishlist/init.php', $active_plugins ) ||
				 array_key_exists( 'yith-woocommerce-wishlist/init.php', $active_plugins );
		}
	}
	if ( ! function_exists( 'noo_organici_woocommerce_compare_is_active' ) ) {

		/**
		 * Check yith-woocommerce-compare plugin is active
		 *
		 * @return boolean .TRUE is active
		 */
		function noo_organici_woocommerce_compare_is_active() {
			$active_plugins = (array) get_option( 'active_plugins', array() );
			
			if ( is_multisite() )
				$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
			
			return in_array( 'yith-woocommerce-compare/init.php', $active_plugins ) ||
				 array_key_exists( 'yith-woocommerce-compare/init.php', $active_plugins );
		}
	}
	
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash' );
	

	
	// Related products
	add_filter( 'woocommerce_output_related_products_args', 'noo_organici_woocommerce_output_related_products_args' );

	function noo_organici_woocommerce_output_related_products_args() {
		if ( noo_organici_get_option( 'noo_shop_layout', 'fullwidth' ) === 'fullwidth' ) {
			$args = array( 'posts_per_page' => 4, 'columns' => 4 );
			return $args;
		}

		$args = array( 'posts_per_page' => noo_organici_get_option('noo_woocommerce_product_related',6), 'columns' => 4 );
		return $args;
	}
	
	// Upsell products
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'noo_organici_woocommerce_upsell_display', 15 );
	if ( ! function_exists( 'noo_organici_woocommerce_upsell_display' ) ) {

		function noo_organici_woocommerce_upsell_display() {
			if ( noo_organici_get_option( 'noo_shop_layout', 'fullwidth' ) === 'fullwidth' ) {
				woocommerce_upsell_display( - 1, 4 );
			} else {
				woocommerce_upsell_display( - 1, 3 );
			}
		}
	}

    // remove rating
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    // Loop thumbnail
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'noo_organici_template_loop_product_thumbnail', 10 );

    function noo_organici_template_loop_product_thumbnail() {
        ?>
            <div class="noo-product-thumbnail">
                <?php the_post_thumbnail('lager'); ?>
            </div>
            <?php wc_get_template_part('loop/rating'); ?>
        <?php
    }

    add_action('woocommerce_after_shop_loop_item_title','noo_organici_product_single_excerpt');
    add_action('woocommerce_after_shop_loop_item_title','noo_organici_template_loop_add_to_cart');
    function noo_organici_template_loop_add_to_cart(){
        ?>
            <div class="noo-product-action">
                <div class="noo-action">
                    <a href="#" data-id="<?php the_ID(); ?>" class="noo-qucik-view"><i class="fa fa-search"></i><span><?php esc_html_e('Quick view','noo-organici') ?></span></a>
                    <?php do_action('noo_organici-product-action') ?>
                </div>
            </div>
        <?php
    }

    add_action( 'noo_organici-product-action', 'woocommerce_template_loop_add_to_cart', 10 );
    add_action( 'noo_organici-product-action', 'noo_organici_template_loop_wishlist', 12 );
    add_action( 'noo_organici-product-action', 'noo_organici_product_link_detail', 15 );

    function noo_organici_template_loop_wishlist() {
        if ( noo_organici_woocommerce_wishlist_is_active() ) {
            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
        }
    }

    function noo_organici_product_link_detail(){

        ?>
            <a href="<?php the_permalink() ?>" class="link-detail"><i class="fa fa-link"></i><span><?php esc_html_e('View detail','noo-organici') ?></span></a>
        <?php
    }

    // single woo
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
    add_action('woocommerce_single_product_summary','woocommerce_template_single_meta',25);

    add_action('woocommerce_share','noo_organici_social_share_product');

    // single product add new tab
    add_filter('woocommerce_product_tabs','noo_organici_create_boxes_product_tab');
    function noo_organici_create_boxes_product_tab( $tabs ){
        $box_contents = noo_organici_get_post_meta(get_the_ID(),'noo_box_contents');
        if( isset($box_contents) && !empty($box_contents) ):
        $tabs['noo_boxes_tab'] = array(
                'title'     => esc_html__('Box contents','noo-organici'),
                'priority'  =>  1,
                'callback'  =>  'noo_organici_boxed_tabs_content'
        );
        endif;
        return $tabs;

    }
    function noo_organici_boxed_tabs_content(){

        $box_contents = noo_organici_get_post_meta(get_the_ID(),'noo_box_contents');
        if( isset($box_contents) && !empty($box_contents) ):
            echo '<ul>';
                foreach( $box_contents as $content ){ ?>
                    <li>
                        <div class="box-item">
                            <?php echo wp_get_attachment_image( esc_attr($content['noo_thumbnail_id']) ); ?>
                            <strong><?php echo esc_html($content['noo_box_title_item']); ?></strong>
                            <span><?php echo esc_html($content['noo_box_value']); ?></span>
                        </div>
                    </li>
                <?php }
            echo '</ul>';
            echo '<p class="ds">'.esc_html__('We  do our best to send you the things youwill will chosen. Our photos do not show the actual quantities.','noo-organici').'</p>';
        endif;
    }




    // add link button box
    function noo_organici_link_in_boxes(){
        $term = get_the_terms(get_the_ID(),'product_boxed');
        if( isset($term) && !empty($term) ){
            $box_id = $term[0]->term_id;


        $all_product   = noo_organici_get_term_meta( $box_id, 'boxed_id_sort', '' );
        $product_box   = '';
        if( isset($all_product) && !empty($all_product) ){
            $product_box = explode(',',$all_product);
            if (in_array(get_the_ID(), $product_box))
            {
                unset($product_box[array_search(get_the_ID(),$product_box)]);
            }
        ?>
            <ul class="noo_link_boxes">
                <li>
                    <a href="#"><?php echo esc_html(noo_organici_get_post_meta(get_the_ID(),'_noo_box_title')); ?> <i class="fa fa-angle-down"></i></a>
                    <ul>
                        <?php foreach($product_box as $id): ?>
                       <li>
                           <a href="<?php echo esc_url(get_permalink($id)) ?>"><?php echo esc_html(noo_organici_get_post_meta($id,'_noo_box_title')); ?></a>
                       </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        <?php
        }
        }
    }
    add_action('woocommerce_single_product_summary','noo_organici_link_in_boxes',3);


    // get product slider ajax

    add_action('wp_ajax_noo_organici_product_slider','noo_organici_product_slider');
    add_action('wp_ajax_nopriv_noo_organici_product_slider','noo_organici_product_slider');
    function noo_organici_product_slider(){
        $catid = '';
        $limit = 10;
        if( isset($_POST['limit']) && !empty($_POST['limit'])){
            $limit = $_POST['limit'];
        }
        if( isset($_POST['catid']) && !empty($_POST['catid'])){
            $catid = $_POST['catid'];
        }
        $args = array(
            'post_type'         =>  'product',
            'posts_per_page'    =>   $limit
        );
        if( isset($catid) && $catid != 'all' && !empty($catid) ){
            $new_id = explode(',',$catid);
            $new_cat = array();
            foreach($new_id as $id){
                $new_cat[] = intval($id);
            }
            $args['tax_query'][] = array(
                'taxonomy'  =>  'product_cat',
                'field'     =>  'term_id',
                'terms'     =>   $new_cat
            );
        }

        ?>
        <div class="noo-slider">
            <?php
            $query = new WP_Query($args);
                if( $query->have_posts() ):
                while( $query->have_posts() ): $query->the_post();
                    wc_get_template_part( 'content', 'product' );
                endwhile;
                endif; wp_reset_postdata(); ?>
        </div>
        <?php
        exit();
    }

     // get product menu ajax

    add_action('wp_ajax_noo_organici_product_menu_action','noo_organici_product_menu_action');
    add_action('wp_ajax_nopriv_noo_organici_product_menu_action','noo_organici_product_menu_action');
    function noo_organici_product_menu_action(){
        $catid = $_POST['catid'];
        $limit = $_POST['limit'];
        $args = array(
            'post_type'         =>  'product',
            'posts_per_page'    =>   $limit
        );
        if( $catid != 'all' && !empty($catid) ){
            $args['tax_query'][] = array(
                'taxonomy'  =>  'product_cat',
                'field'     =>  'term_id',
                'terms'     =>  array($catid)
            );
        }
        ?>

            <?php
            $query = new WP_Query($args);
                if( $query->have_posts() ):
                    $i = 1;
                while( $query->have_posts() ): $query->the_post();
                    global $product;
                    $classes = 'first';
                    if ( 0 == $i % 2 ) {
                        $classes = 'last';
                    }
                    $i++;
                    ?>
                    <li class="<?php echo esc_attr($classes); ?>">
                        <div class="menu-thumb">
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(array(65,65)) ?></a>
                        </div>
                        <div class="product-menu-ds">
                            <div class="product-menu-flex">
                                <span class="p-menu-title"> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span>
                                <span class="p-menu-border"></span>
                                <span class="price"><?php echo $product->get_price_html(); ?></span>
                            </div>
                            <?php the_excerpt(); ?>
                        </div>
                    </li>
                  <?php
                endwhile;
                endif; wp_reset_postdata(); ?>

        <?php
        exit();
    }

    // noo_organici quick view
    add_action('wp_ajax_noo_organici_product_quick_view','noo_organici_product_quick_view');
    add_action('wp_ajax_nopriv_noo_organici_product_quick_view','noo_organici_product_quick_view');
    function noo_organici_product_quick_view(){

        $id = $_POST['p_id'];
        if( !isset($id) && empty($id) ) return;
        $args = array(
            'post_type' =>  'product',
            'p'         =>  $id
        );
        $query = new WP_Query( $args );
        if( $query->have_posts() ):

            remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);
            remove_action('woocommerce_single_product_summary','noo_organici_link_in_boxes',3);
            while( $query->have_posts() ):
                $query->the_post();
            ?>
                <div class="quick-left">
                    <?php
                        the_post_thumbnail('full');
                    ?>
                </div>
                <div class="quick-right">

                    <?php
                    /**
                     * woocommerce_single_product_summary hook
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>
            <?php
            endwhile;
        endif; wp_reset_postdata();

        wp_die();
    }

    function noo_organici_product_single_excerpt(){
        ?>
        <div class="noo-product-excerpt">
            <?php the_excerpt(); ?>
        </div>
        <?php
    }

    remove_action ('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action ('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

    // add to cart shortcode
    add_action ('noo_organici-sh-addtocart', 'woocommerce_template_loop_add_to_cart', 5);
}


