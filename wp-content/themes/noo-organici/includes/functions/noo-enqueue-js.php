<?php
/**
 * NOO Framework Site Package.
 *
 * Register Script
 * This file register & enqueue scripts used in NOO Themes.
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */
// =============================================================================

//
// Site scripts
//
if ( ! function_exists( 'noo_organici_enqueue_site_scripts' ) ) :
	function noo_organici_enqueue_site_scripts() {

		// Main script

		// vendor script
		wp_register_script( 'vendor-modernizr', get_template_directory_uri() . '/assets/vendor/modernizr-2.7.1.min.js', null, null, false );

    	wp_register_script( 'vendor-imagesloaded', get_template_directory_uri() . '/assets/vendor/imagesloaded.pkgd.min.js', null, null, true );
		wp_register_script( 'vendor-isotope', get_template_directory_uri() . '/assets/vendor/jquery.isotope.min.js', array('vendor-imagesloaded'), null, true );
		wp_register_script( 'vendor-masonry', get_template_directory_uri() . '/assets/vendor/masonry.pkgd.min.js', array('vendor-imagesloaded'), null, true );
		wp_register_script( 'vendor-infinitescroll', get_template_directory_uri() . '/assets/vendor/infinitescroll-2.0.2.min.js', null, null, true );
		
		wp_register_script( 'vendor-touchSwipe', get_template_directory_uri() . '/assets/vendor/jquery.touchSwipe.js', array( 'jquery' ), null, true );
		wp_register_script( 'vendor-carouFredSel', get_template_directory_uri() . '/assets/vendor/carouFredSel/jquery.carouFredSel-6.2.1-packed.js', array( 'jquery', 'vendor-touchSwipe','vendor-imagesloaded' ), null, true );
		
		wp_register_script( 'vendor-jplayer', get_template_directory_uri() . '/assets/vendor/jplayer/jplayer-2.5.0.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'vendor-nivo-lightbox-js', get_template_directory_uri() . '/assets/vendor/nivo-lightbox/nivo-lightbox.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'vendor-fancybox-lightbox-js', get_template_directory_uri() . '/assets/vendor/fancybox-lightbox/source/jquery.fancybox.pack.js', array( 'jquery' ), null, true );
		
		wp_register_script( 'vendor-parallax', get_template_directory_uri() . '/assets/vendor/jquery.parallax-1.1.3.js', array( 'jquery'), null, true );

        wp_register_script( 'vendor-modernizr-custom', get_template_directory_uri() . '/assets/vendor/elastiStack/modernizr.custom.js', array( 'jquery'), null, true );
        wp_register_script( 'vendor-draggabilly', get_template_directory_uri() . '/assets/vendor/elastiStack/draggabilly.pkgd.min.js', array( 'jquery'), null, true );
        wp_register_script( 'vendor-elastiStack', get_template_directory_uri() . '/assets/vendor/elastiStack/elastiStack.js', array( 'jquery'), null, true );

        wp_register_script( 'vendor-countdown-plugin', get_template_directory_uri() . '/assets/vendor/countdown/jquery.plugin.min.js', array( 'jquery' ), null, true );
        wp_register_script( 'vendor-countdown-js', get_template_directory_uri() . '/assets/vendor/countdown/jquery.countdown.min.js', array( 'jquery' ), null, true );

        wp_register_script( 'noo-category', get_template_directory_uri() . '/assets/js/noo_category.js', array( 'jquery'), null, true );
        wp_register_script( 'noo-carousel', get_template_directory_uri() . '/assets/vendor/owl.carousel.min.js', array( 'jquery'), null, true );
        wp_register_script( 'portfolio', get_template_directory_uri() . '/assets/js/portfolio.js', array( 'jquery' ), null, true );
		wp_register_script( 'noo-script', get_template_directory_uri() . '/assets/js/noo.js', array( 'jquery' ), null, true );
		wp_register_script( 'noo-script-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), null, true );

        wp_register_script( 'noo-grid-modernizr', get_template_directory_uri() . '/assets/vendor/image-grid/modernizr.custom.26633.js', array( 'jquery'), null, true );
        wp_register_script( 'noo-grid-gridrotator', get_template_directory_uri() . '/assets/vendor/image-grid/jquery.gridrotator.js', array( 'jquery'), null, true );

		wp_register_script('google-map','http'.(is_ssl() ? 's':'').'://maps.googleapis.com/maps/api/js',array('jquery'), '1.0', false);
		wp_register_script( 'google-map-custom', get_template_directory_uri() . '/assets/js/google-map-custom.js', array( 'jquery' ), null, false );

		if ( ! is_admin() ) {
			wp_enqueue_script( 'vendor-modernizr' );
			
			// Required for nested reply function that moves reply inline with JS
			if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

			$is_shop				= NOO_WOOCOMMERCE_EXIST && is_shop();
			$nooL10n = array(
				'ajax_url'        => admin_url( 'admin-ajax.php', 'relative' ),
				'ajax_finishedMsg'=> esc_html__('All posts displayed', 'noo-organici'),
				'home_url'        => home_url( '/' ),
				'is_blog'         => is_home() ? 'true' : 'false',
				'is_archive'      => is_post_type_archive('post') ? 'true' : 'false',
				'is_single'       => is_single() ? 'true' : 'false',
				'is_shop'         => NOO_WOOCOMMERCE_EXIST && is_shop() ? 'true' : 'false',
				'is_product'      => NOO_WOOCOMMERCE_EXIST && is_product() ? 'true' : 'false',
				'infinite_scroll_end_msg' => esc_html__( 'All posts displayed', 'noo-organici')
			);

			global $noo_post_types;
			if( !empty( $noo_post_types ) ) {
				foreach ($noo_post_types as $post_type => $args) {
					$nooL10n['is_' . $post_type . '_archive'] = is_post_type_archive( $post_type ) ? 'true' : 'false';
					$nooL10n['is_' . $post_type . '_single'] = is_singular( $post_type ) ? 'true' : 'false';
				}
			}


			wp_localize_script('noo-script', 'nooL10n', $nooL10n);
			wp_enqueue_script( 'vendor-infinitescroll' );

            wp_enqueue_script( 'noo-cabas', get_template_directory_uri() . '/assets/js/off-cavnass.js', array(), null, true );
            wp_enqueue_script( 'noo-new', get_template_directory_uri() . '/assets/js/noo_new.js', array(), null, true );
            wp_localize_script('noo-new', 'noo_new', array('ajax_url'        => admin_url( 'admin-ajax.php', 'relative' )));
			wp_enqueue_script( 'noo-script' );
			wp_enqueue_script( 'noo-script-custom' );
		}
	}
add_action( 'wp_enqueue_scripts', 'noo_organici_enqueue_site_scripts' );
endif;
