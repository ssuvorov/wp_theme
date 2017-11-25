<?php
/**
 * NOO Customizer Package
 *
 * Initialize NOO Customizer
 * This file set up NOO Customizer menu as well as including martial needed by Customizer.
 *
 * @package    NOO Framework
 * @subpackage NOO Customizer
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

// 0. Define constance
if ( !defined( 'NOO_FRAMEWORK_CUSTOMIZER' ) ) {
	define( 'NOO_FRAMEWORK_CUSTOMIZER', NOO_FRAMEWORK . '/customizer' );
}
if ( !defined( 'NOO_CUSTOMIZER_PATH' ) ) {
	define( 'NOO_CUSTOMIZER_PATH', NOO_INCLUDES . '/customizer' );
}

// 1. Init NOO-Customizer
// 1.1 Remove WP Theme Customize Submenu
if ( floatval( get_bloginfo( 'version' ) ) >= 3.6 ) {
	function noo_organici_remove_wp_customize_submenu() {
		// remove_submenu_page( 'themes.php', 'customize.php' );
		global $submenu;
        unset($submenu['themes.php'][6]); // Work on WP 4.0
	}

	add_action( 'admin_menu', 'noo_organici_remove_wp_customize_submenu', 999 );
}


// 2. Include materials
// 2.1 Include framework materials
require_once get_template_directory() . '/includes/framework/customizer/class-noo_customizer_helper.php';
require_once get_template_directory() . '/includes/framework/customizer/custom_controls.php';
require_once get_template_directory() . '/includes/framework/customizer/live-css.php';
require_once get_template_directory() . '/includes/framework/customizer/live-ajax.php';

require_once get_template_directory() . '/includes/customizer/options.php';

// 3. Generating Live CSS & JS
// 3.1. Generating Custom CSS
function noo_organici_theme_option_custom_css() {
	if ( noo_organici_get_option( 'noo_custom_css', '' ) ) :
?>
    <style id="noo-custom-css" type="text/css"><?php echo noo_organici_get_option( 'noo_custom_css', '' ); ?></style>
  <?php
	endif;
}

add_action( 'wp_head', 'noo_organici_theme_option_custom_css', 9999, 0 );

// 3.2. Generating Custom JS
function noo_organici_theme_option_custom_js() {
	if ( noo_organici_get_option( 'noo_custom_javascript', '' ) ) :
?>
	<script>
		<?php echo noo_organici_get_option( 'noo_custom_javascript', '' ); ?>
	</script>
	<?php
	endif;
}

add_action( 'wp_footer', 'noo_organici_theme_option_custom_js', 999, 0 );


// 4. Enqueue script for NOO Customizer
// 4.1 Customizer Controls
// 4.1.1 Localize String
if ( ! function_exists( 'noo_organici_customizer_controls_l10n' ) ) :
	function noo_organici_customizer_controls_l10n() {
		return array(
			'navbar_height' => esc_html__( 'NavBar Height (px)', 'noo-organici'),
			'mobile_navbar_height' => esc_html__( 'Mobile NavBar Height (px)', 'noo-organici'),
			'ajax_update_msg'    => esc_html__( 'Updating ...', 'noo-organici' ),
			'import_error_msg' => esc_html__( 'Error when parsing your file.', 'noo-organici' ),
			'export_preparing_msg' => esc_html__( 'We are preparing your export file, please wait...', 'noo-organici' ),
			'export_fail_msg' => esc_html__( 'There was a problem generating your export file, please try again.', 'noo-organici' ),
			'export_url'  => admin_url( 'options.php?page=export_settings' ),
			'ajax_url'    => admin_url( 'admin-ajax.php', 'relative' )
		);
	}
endif;

// 4.1.2 Enqueue script for Customizer Controls
if ( ! function_exists( 'noo_organici_enqueue_customizer_controls_js' ) ) :
	function noo_organici_enqueue_customizer_controls_js() {
		wp_enqueue_media();

		wp_register_script( 'noo-customizer-controls-js', get_template_directory_uri() . '/includes/admin_assets/js/noo-customizer-controls.js', array( 'jquery', 'vendor-chosen-js', 'vendor-alertify-js', 'vendor-fileDownload-js' ), null, true );
		wp_localize_script( 'noo-customizer-controls-js', 'nooCustomizerL10n', noo_organici_customizer_controls_l10n() );
		wp_enqueue_script( 'noo-customizer-controls-js' );

		wp_print_media_templates();

		?>
		<?php

	}
endif;
add_action( 'customize_controls_print_footer_scripts', 'noo_organici_enqueue_customizer_controls_js' );

// 4.2 Enqueue script for Customizer Live Preview
// 4.1.1 Customizer Live Data
if ( ! function_exists( 'noo_organici_customizer_live_data' ) ) :
	function noo_organici_customizer_live_data() {
		global $noo_post_types;

		$blog_page             = ( get_option( 'show_on_front' ) == 'page' ) ? get_permalink( get_option('page_for_posts' ) ) : home_url();
		$shop_page             = ( NOO_WOOCOMMERCE_EXIST ) ? get_permalink( woocommerce_get_page_id( 'shop' ) ) : '';
		$query_args =  array(
			'orderby' => 'name',
			'order' => 'ASC',
		);
		$category_terms = get_terms('category', $query_args);
		$archive_page   = !empty( $category_terms ) ? reset($category_terms) : '';
		$archive_page   = !empty( $category_terms ) ? get_term_link( $archive_page->term_id ) : $blog_page;
		$post           = get_posts( array('posts_per_page' => 1 ) );
		$post_page      = !empty( $post ) ? get_permalink( $post[0]->ID ) : $blog_page;
		$product        = get_posts( array('posts_per_page' => 1, 'post_type' => 'product' ) );
		$product_page   = !empty( $product ) ? get_permalink( $product[0]->ID ) : $shop_page;

		wp_reset_query();

		$customizer_live_data = array(
			'is_preview'			=> 'true',
 			'customize_live_css'	=> wp_create_nonce('noo_customize_live_css'),
			'customize_attachment'	=> wp_create_nonce('noo_customize_attachment'),
			'customize_menu'		=> wp_create_nonce('noo_customize_menu'),
			'customize_social_icons'=> wp_create_nonce('noo_customize_social_icons'),
			'blog_page'				=> $blog_page,
			'shop_page'				=> $shop_page,
			'archive_page'			=> $archive_page,
			'post_page'				=> $post_page,
			'product_page'			=> $product_page,
			'ok'					=> esc_html__( 'Yes', 'noo-organici' ),
			'cancel'				=> esc_html__( 'No', 'noo-organici' ),
			'ajax_update_msg'		=> esc_html__( 'Updating ...', 'noo-organici' ),
			'cannot_preview_msg'	=> esc_html__( 'This option doesn\'t support live preview. Save it and see the change on your site.', 'noo-organici' ),
			'redirect_msg'			=> esc_html__( 'Wanna go to %s to see the change?', 'noo-organici' ),
			'blog_text'				=> esc_html__( 'Blog Page', 'noo-organici' ),
			'shop_text'				=> esc_html__( 'Shop Page', 'noo-organici' ),
			'archive_text'			=> esc_html__( 'An Archive Page', 'noo-organici' ),
			'post_text'				=> esc_html__( 'A Post', 'noo-organici' ),
			'product_text'			=> esc_html__( 'A Product', 'noo-organici' ),
		);

		if( !empty( $noo_post_types ) ) {
			foreach ($noo_post_types as $post_type => $args) {
				if( !isset( $args['name'] ) ) continue;
				$args['singular_name'] = !isset( $args['singular_name'] ) ? $args['name'] : $args['singular_name'];

				$archive_link = get_post_type_archive_link( $post_type );
				$archive_text = sprintf( esc_html__( '%s Archive Page', 'noo-organici'), $args['name'] );

				$single			= get_posts( array('posts_per_page' => 1, 'post_type' => $post_type ) );
				$single_link	= !empty( $single ) ? get_permalink( $single[0]->ID ) : $archive_link;
				$single_text	= sprintf( esc_html__( 'A %s Page', 'noo-organici'), $args['singular_name'] );

				$customizer_live_data[$post_type . '_archive_page'] = $archive_link;
				$customizer_live_data[$post_type . '_single_page'] = $single_link;
				$customizer_live_data[$post_type . '_archive_text'] = $archive_text;
				$customizer_live_data[$post_type . '_single_text'] = $single_text;
			}
		}

		return apply_filters( 'noo_customizer_live_js_data', $customizer_live_data );
	}
endif;

// 4.2.2 Enqueue script for Customizer Live
if ( ! function_exists( 'noo_organici_enqueue_customizer_live_js' ) ) :
	function noo_organici_enqueue_customizer_live_js() {
		// Script
		wp_register_script( 'vendor-alertify-js', get_template_directory_uri() . '/includes/framework/assets/js/alertify.mod.min.js', null, null, true );
		wp_register_script( 'noo-customizer-live-core-js', get_template_directory_uri() . '/includes/framework//assets/js/noo-customizer-live-core.js', array( 'jquery', 'vendor-alertify-js' ), null, true );
		wp_localize_script( 'noo-customizer-live-core-js', 'nooCustomizerL10n', noo_organici_customizer_live_data() );
		wp_register_script( 'noo-customizer-live-js', get_template_directory_uri() . '/includes/admin_assets/js/noo-customizer-live.js', array( 'noo-customizer-live-core-js' ), null, true );
		wp_enqueue_script( 'noo-customizer-live-js' );

		// Style
		wp_register_style( 'noo-customizer-live-css', get_template_directory_uri() . '/includes/admin_assets/css/noo-customizer-live.css', array( 'jquery' ), null, true );
		wp_enqueue_style( 'noo-customizer-live-css' );

		wp_register_style( 'vendor-alertify-core-css', get_template_directory_uri() . '/includes/framework//assets/css/alertify.core.css', null, null, 'all' );
		wp_register_style( 'vendor-alertify-default-css', get_template_directory_uri() . '/includes/framework//assets/css/alertify.default.css', array('vendor-alertify-core-css'), null, 'all' );
		wp_enqueue_style( 'vendor-alertify-default-css' );
	}
endif;
add_action( 'customize_preview_init', 'noo_organici_enqueue_customizer_live_js' );

// 4.2.3 Footer Script for Customizer Live
if ( ! function_exists('noo_organici_customizer_live_footer_script') ) :
	function noo_organici_customizer_live_footer_script() {
		global $wp_customize;
		global $noo_post_types;
		global $noo_customize_options;
		if ( !isset( $wp_customize ) ) {
			return;
		} ?>
		<script type="text/javascript" id="noo-customizer-live-iniline-post-type">
		<?php if( !empty( $noo_post_types ) ) : ?>
			( function( $ ) {
				<?php foreach ($noo_post_types as $post_type => $args) : ?>
					function noo_organici_refresh_preview_<?php echo esc_attr($post_type) . '_archive'; ?>() {
						if( nooL10n.is_<?php echo $post_type . '_archive'; ?> === "true" ) {
							noo_organici_refresh_preview();
						} else {
							noo_organici_redirect_preview( '<?php echo esc_attr($post_type) . '_archive'; ?>' );
						}
					}

					function noo_organici_refresh_preview_<?php echo esc_attr($post_type) . '_single'; ?>() {
						if( nooL10n.is_<?php echo esc_attr($post_type) . '_single'; ?> === "true" ) {
							noo_organici_refresh_preview();
						} else {
							noo_organici_redirect_preview( '<?php echo esc_attr($post_type) . '_single'; ?>' );
						}
					}
					<?php 
					if( !empty( $noo_customize_options ) ) :
						foreach( $noo_customize_options as $key => $option ) :
							if( strpos( $key, $post_type ) !== 0 ) continue;
							if( !$option->auto_script || $option->preview_type == 'custom' ) continue;
							?>
								wp.customize( '<?php echo esc_attr($key); ?>', function( value ) {
									value.bind( function( newval ) {
										<?php if( $option->preview_type == 'none' ) : ?>
										showCannotPreviewMsg();
										<?php else : ?>
										noo_organici_refresh_preview_<?php echo strpos( $key, $post_type . '_single' ) === 0 ? esc_attr($post_type) . '_single' : esc_attr($post_type) . '_archive' ?>();
										<?php endif; ?>
									} );
								} );
							<?php 
							$option->auto_script = 0;
						endforeach;
					endif;
				endforeach; ?>
			} ) ( jQuery );
		<?php endif; ?>
		</script>
		<?php

		if( !empty( $noo_customize_options ) ) :
			?>
		<script type="text/javascript" id="noo-customizer-live-iniline">
			( function( $ ) {
			<?php 
			foreach( $noo_customize_options as $key => $option ) :
				if( !$option->auto_script || $option->preview_type == 'custom' ) continue;
			?>
				wp.customize( '<?php echo esc_attr($key); ?>', function( value ) {
					value.bind( function( newval ) {
						<?php if( $option->preview_type == 'none' ) : ?>
						showCannotPreviewMsg();
						<?php elseif( $option->preview_type == 'update_css' ) : 
							if( !isset( $option->preview_params ) ) continue;
						?>
						noo_organici_update_customizer_css( '<?php echo $option->preview_params['css']; ?>' );
						<?php elseif( strpos( $key, 'noo_blog' ) === 0 ) : ?>
						noo_organici_refresh_preview_blog();
						<?php elseif( strpos( $key, 'noo_post' ) === 0 ) : ?>
						noo_organici_refresh_preview_post();
						<?php elseif( strpos( $key, 'noo_shop' ) === 0 ) : ?>
						noo_organici_refresh_preview_shop();
						<?php elseif( strpos( $key, 'noo_woocommerce_product' ) === 0 ) : ?>
						noo_organici_refresh_preview_product();
						<?php else : ?>
						noo_organici_refresh_preview();
						<?php endif; ?>
					} );
				} );
			<?php 
				$option->auto_script = 0;
			endforeach;
			?>
			} ) ( jQuery );
		</script>
		<?php endif; ?>
		<?php
	}
endif;
add_action('wp_print_footer_scripts', 'noo_organici_customizer_live_footer_script');


// 5. Enqueue style for NOO Customizer
// 5.1 Enqueue style for Customizer Controls
if ( ! function_exists( 'noo_organici_enqueue_customizer_controls_css' ) ) :
	function noo_organici_enqueue_customizer_controls_css() {

		wp_register_style( 'noo-customizer-controls-css', get_template_directory_uri() . '/includes/admin_assets/css/noo-customizer-control.css', array( 'noo-jquery-ui-slider', 'vendor-chosen-css' ), null, 'all' );
		wp_enqueue_style( 'noo-customizer-controls-css' );

		wp_enqueue_style( 'vendor-alertify-default-css' );

	}
endif;
add_action( 'customize_controls_print_styles', 'noo_organici_enqueue_customizer_controls_css' );

// 6. Import/Export functions
// 6.1 Import

// 6.2 Export
require_once get_template_directory() . '/includes/framework/customizer/export-settings.php';

// 7. Generate CSS file
if ( ! function_exists( 'noo_organici_output_css_file' ) ) :
	function noo_organici_output_css_file($creds) {
		ob_start();

        require_once get_template_directory() . '/includes/customizer/css-php/layout.php';
        require_once get_template_directory() . '/includes/customizer/css-php/design.php';
        require_once get_template_directory() . '/includes/customizer/css-php/typography.php';
        require_once get_template_directory() . '/includes/customizer/css-php/header.php';

		$css = ob_get_clean();

		if( !defined('WP_DEBUG') || !WP_DEBUG ) {
			// Remove comment, space
			$css = preg_replace( '#/\*.*?\*/#s', '', $css );
			$css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css );
			$css = preg_replace( '/\s\s+(.*)/', '$1', $css );
		}

		$css = "/* This custom.css file is automatically generated each time admin update Customize settings.\nTherefore, please DO NOT CHANGE ANYTHING as your changes will be lost.\n@NooTheme */" . $css;

		// file_put_contents($css_dir . 'custom.css', $css, LOCK_EX); // Save it

		$creds = get_theme_mod('noo_customizer_credits', '');
		WP_Filesystem( $creds );
		global $wp_filesystem; 
		
		$css_dir = noo_organici_create_upload_dir( $wp_filesystem );
		if ( ! $css_dir || ! $wp_filesystem->put_contents(  $css_dir . '/custom.css', $css, FS_CHMOD_FILE) ) {

			// store option for using inline css
			set_theme_mod('noo_use_inline_css', true);

			wp_die("error saving file!", '', array( 'response' => 403 ));
		} else {
			set_theme_mod('noo_use_inline_css', false);
		}
	}
endif;

add_action( 'customize_save_after', 'noo_organici_output_css_file' );

if ( ! function_exists( 'noo_organici_delete_stored_credits' ) ) :
	function noo_organici_delete_stored_credits() {
		remove_theme_mod( 'noo_customizer_credits' );
	}
endif;

add_action('wp_login','noo_organici_delete_stored_credits' );

if ( ! function_exists( 'noo_organici_jbst_tmpadminheader' ) ) :
	function noo_organici_jbst_tmpadminheader() {
		/**
		 * Dashboard Administration Screen
		 *
		 * @package WordPress
		 * @subpackage Administration
		 */

		/** Load WordPress Bootstrap */
		require_once(ABSPATH . 'wp-admin/admin.php' );

		/** Load WordPress dashboard API */
		require_once(ABSPATH . 'wp-admin/includes/dashboard.php');

		wp_dashboard_setup();

		wp_enqueue_script( 'dashboard' );
		if ( current_user_can( 'edit_theme_options' ) )
			wp_enqueue_script( 'customize-loader' );
		if ( current_user_can( 'install_plugins' ) )
			wp_enqueue_script( 'plugin-install' );
		if ( current_user_can( 'upload_files' ) )
			wp_enqueue_script( 'media-upload' );
		add_thickbox();

		if ( wp_is_mobile() )
			wp_enqueue_script( 'jquery-touch-punch' );

		$title = esc_html__( 'Customizer credentials', 'noo-organici');
		$parent_file = 'index.php';
		include( ABSPATH . 'wp-admin/admin-header.php' );
	}
endif;

if ( ! function_exists( 'noo_organici_store_credits' ) ) :
	function noo_organici_store_credits( $wp_customize ) {
		if(! WP_Filesystem(unserialize(get_theme_mod('noo_customizer_credits')))) {
			ob_start();	
			$in = true;
			$url = 'customize.php';
			if (false === ($creds = request_filesystem_credentials($url, '', false, false,null) ) ) {
				$in = false;

				$form = ob_get_contents();
				ob_end_clean();
				noo_organici_jbst_tmpadminheader();
				echo ($form);
				require( ABSPATH . 'wp-admin/admin-footer.php' );
				exit;
			}
			ob_end_clean();
			if ($in && ! WP_Filesystem($creds) ) {
			
				// our credentials were no good, ask the user for theme again
				noo_organici_jbst_tmpadminheader();
				request_filesystem_credentials($url, '', true, false,null);
				require( ABSPATH . 'wp-admin/admin-footer.php' );
				$in = false;
				exit;
			}

			set_theme_mod('noo_customizer_credits', serialize($creds));
		}
	}
endif;

add_action('customize_controls_init', 'noo_organici_store_credits', 1);

if (!function_exists('noo_organici_current_url')):
	function noo_organici_current_url($encoded = false) {
		global $wp;
		$current_url = esc_url( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		if( $encoded ) {
			return urlencode($current_url);
		}
		return $current_url;
	}
endif;

if (!function_exists('noo_organici_upload_dir_name')):
	function noo_organici_upload_dir_name() {
		return apply_filters( 'noo_organici_upload_dir_name', NOO_THEME_NAME );
	}
endif;

if (!function_exists('noo_organici_upload_dir')):
	function noo_organici_upload_dir() {
		$upload_dir = wp_upload_dir();

		return $upload_dir['basedir'] . '/' . noo_organici_upload_dir_name();
	}
endif;

if (!function_exists('noo_organici_upload_url')):
	function noo_organici_upload_url() {
		$upload_dir = wp_upload_dir();

		return $upload_dir['baseurl'] . '/' . noo_organici_upload_dir_name();
	}
endif;

if (!function_exists('noo_organici_create_upload_dir')):
	function noo_organici_create_upload_dir( $wp_filesystem = null ) {
		if( empty( $wp_filesystem ) ) {
			return false;
		}

		$upload_dir = wp_upload_dir();
		global $wp_filesystem;

		$noo_upload_dir = $wp_filesystem->find_folder( $upload_dir['basedir'] ) . noo_organici_upload_dir_name();
		if ( ! $wp_filesystem->is_dir( $noo_upload_dir ) ) {
			if ( $wp_filesystem->mkdir( $noo_upload_dir, 0777 ) ) {
				return $noo_upload_dir;
			}

			return false;
		}

		return $noo_upload_dir;
	}
endif;

if (!function_exists('noo_organici_handle_upload_file')):
	function noo_organici_handle_upload_file($upload_data) {
		$return = false;
		$uploaded_file = wp_handle_upload($upload_data, array('test_form' => false));

		if (isset($uploaded_file['file'])) {
			$file_loc = $uploaded_file['file'];
			$file_name = basename($upload_data['name']);
			$file_type = wp_check_filetype($file_name);

			$attachment = array(
				'post_mime_type' => $file_type['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_name)),
				'post_content' => '',
				'post_status' => 'inherit'
				);

			$attach_id = wp_insert_attachment($attachment, $file_loc);
			$attach_data = wp_generate_attachment_metadata($attach_id, $file_loc);
			wp_update_attachment_metadata($attach_id, $attach_data);

			$return = array('data' => $attach_data, 'id' => $attach_id);

			return $return;
		}

		return $return;
	}
endif;
