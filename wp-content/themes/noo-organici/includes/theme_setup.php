<?php
/**
 * Initialize Theme functions for NOO Themes.
 *
 * @package    NOO Themes
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

// Content Width
if ( ! isset( $content_width ) ) :
	$content_width = 970;
endif;

// Initialize Theme
if (!function_exists('noo_organici_init_theme')):
	function noo_organici_init_theme() {
		load_theme_textdomain( 'noo-organici', get_template_directory() . '/languages' );

		require_once( get_template_directory() . '/includes/framework/libs/noo-check-version.php' );
 
        if ( is_admin() ) {     
            $license_manager = new Noo_Organici_Check_Version(
                'noo-organici',
                'Noo Organici',
                'http://update.nootheme.com/api/license-manager/v1',
                'theme',
                '',
                false
            );
        }

		// Title Tag -- From WordPress 4.1.
		add_theme_support('title-tag');
		// @TODO: Automatic feed links.
		add_theme_support('automatic-feed-links');
		// Add support for some post formats.
		add_theme_support('post-formats', array(
			'image',
			'gallery',
			'video',
			'audio',
			'quote'
		));

		add_theme_support( 'woocommerce' );

		// WordPress menus location.
		$menu_list = array();
		
		$menu_list['primary']    = esc_html__( 'Primary Menu', 'noo-organici');
		$menu_list['left-menu']  = esc_html__( 'Menu Left', 'noo-organici');
		$menu_list['right-menu'] = esc_html__( 'Menu Right', 'noo-organici');
		
		if (noo_organici_get_option( 'noo_header_top_bar', false ) && (noo_organici_get_option('noo_top_bar_type', 'menu') == 'menu') ) {
			$menu_list['top-menu'] = esc_html__( 'Top Menu', 'noo-organici');
		}
		
		if (noo_organici_get_option('noo_footer_top', false)) {
			$menu_list['footer-menu'] = esc_html__( 'Footer Menu', 'noo-organici');
		}

		// Register Menu
		register_nav_menus($menu_list);

		// Define image size
		add_theme_support('post-thumbnails');
		
		add_image_size('noo-thumbnail-square',600,450, true);

        add_image_size('noo-thumbnail-product',260,330, true);

		$default_values = array( 
				'primary_color'         => '#79cba8',
				'secondary_color'       => '#f5a64a',
				'font_family'           => 'Lato',
				'text_color'            => '#696969',
				'font_size'             => '14',
				'font_weight'           => '400',
				'headings_font_family'  => 'Pacifico',
				'headings_color'        => '#212121',
				'logo_color'            => '#000',
				'logo_font_family'      => 'Anonymous Pro',
			);
		noo_organici_set_theme_default( $default_values );
	}
	add_action('after_setup_theme', 'noo_organici_init_theme');
endif;
