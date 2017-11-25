<?php
/**
 * This file initialize widgets area used in this theme.
 *
 *
 * @package    NOO Framework
 * @subpackage Widget Initiation
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

if ( ! function_exists( 'noo_organici_widgets_init' ) ) :

	function noo_organici_widgets_init() {
		
		// Default Sidebar (WP main sidebar)
		register_sidebar( 
			array(  // 1
				'name' => esc_html__( 'Main Sidebar', 'noo-organici' ),
				'id' => 'sidebar-main', 
				'description' => esc_html__( 'Default Blog Sidebar.', 'noo-organici' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h3 class="widget-title">', 
				'after_title' => '</h3>' ) );
		
		register_sidebar(
                array(
                    'name' => esc_html__( 'Secondary Sidebar', 'noo-organici' ),
                    'id' => 'sidebar-secondary',
                    'description' => esc_html__( 'Display widget on Header 3.', 'noo-organici' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="widget-title">',
                    'after_title' => '</h3>' ) );

		register_sidebar( 
			array(  // 1
				'name' => esc_html__( 'NOO - Footer Top', 'noo-organici' ),
				'id' => 'sidebar-top-footer', 
				'description' => esc_html__( 'Display Footer Top.', 'noo-organici' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">', 
				'after_widget' => '</div>', 
				'before_title' => '<h3 class="widget-title">', 
				'after_title' => '</h3>' ) );

		// Footer Columns (Widgetized)
		$num = ( noo_organici_get_option( 'noo_footer_widgets' ) == '' ) ? 4 : noo_organici_get_option( 'noo_footer_widgets' );
		for ( $i = 1; $i <= $num; $i++ ) :
			register_sidebar( 
				array( 
					'name' => esc_html__( 'NOO - Footer Column #', 'noo-organici' ) . $i,
					'id' => 'noo-footer-' . $i, 
					'before_widget' => '<div id="%1$s" class="widget %2$s">', 
					'after_widget' => '</div>', 
					'before_title' => '<h4 class="widget-title">', 
					'after_title' => '</h4>' ) );
		endfor
		;
	}
	add_action( 'widgets_init', 'noo_organici_widgets_init' );

endif;
