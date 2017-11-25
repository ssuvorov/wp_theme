<?php
/**
 * NOO Meta Boxes Package
 *
 * Setup NOO Meta Boxes for Page
 * This file add Meta Boxes to WP Page edit page.
 *
 * @package    NOO Framework
 * @subpackage NOO Meta Boxes
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

if (!function_exists('noo_organici_page_meta_boxes')):
	function noo_organici_page_meta_boxes() {
		// Declare helper object
		$prefix = '_noo_wp_page';
		$helper = new Noo_Organici_Meta_Boxes_Helper($prefix, array(
			'page' => 'page'
		));

		// Page Settings
		$meta_box = array(
			'id' => "{$prefix}_meta_box_page",
			'title' => esc_html__( 'Page Settings', 'noo-organici') ,
			'description' => esc_html__( 'Choose various setting for your Page.', 'noo-organici') ,
			'fields' => array(
				array(
                    'id'    => "{$prefix}_header_style",
                    'label' => esc_html__( 'Header setting' , 'noo-organici' ),
                    'desc'  => esc_html__( 'Header setting.', 'noo-organici' ),
                    'type'  => 'select',
                    'std'   => 'header',
                    'options' => array(
                        array('value'=>'header','label'=>'Using header in customizer'),
                        array('value'=>'header1','label'=>'Header Default'),
                        array('value'=>'header2','label'=>'Header Business'),
                        array('value'=>'header3','label'=>'Header Agency'),
                        array('value'=>'header4','label'=>'Header Fullwidth'),
                        array('value'=>'header5','label'=>'Header Shop'),
                        array('value'=>'header6','label'=>'Header Logo Center')
                    )
                ),
				array(
					'type' => 'divider'
				),
				array(
                    'id'    => "{$prefix}_footer_style",
                    'label' => esc_html__( 'Footer setting' , 'noo-organici' ),
                    'desc'  => esc_html__( 'Footer setting.', 'noo-organici' ),
                    'type'  => 'select',
                    'std'   => 'footer',
                    'options' => array(
                        array('value'=>'footer','label'=>'Using footer in customizer'),
                        array('value'=>'footer2','label'=>'Footer Business'),
                        array('value'=>'footer3','label'=>'Footer Business Dark'),
                        array('value'=>'footer4','label'=>'Footer Agency')
                    )
                ),
				array(
					'type' => 'divider'
				),
				array(
					'id'    => "{$prefix}_menu_logo",
					'label' => esc_html__( 'Menu Logo' , 'noo-organici' ),
					'desc'  => esc_html__( 'Menu Logo.', 'noo-organici' ),
					'type'  => 'image',
				),
				array(
					'type' => 'divider'
				),
				array(
					'id'    => "{$prefix}_nav_position",
					'label' => esc_html__( 'Navbar Position' , 'noo-organici' ),
					'desc'  => esc_html__( 'Navbar Position for Page', 'noo-organici' ),
					'type'  => 'radio',
					'std'   => 'default_position',
                    'options' => array(
                    	array('value'=>'default_position','label'=>'Using Navbar Position in customizer'),
                        array('value'=>'static_top','label'=>'Static Top'),
                        array('value'=>'fixed_top','label'=>'Fixed Top')
                    ),
                    'child-fields' => array(
						'fixed_top' => "{$prefix}_menu_logo_sticky",
					),
				),
				array(
					'id'    => "{$prefix}_menu_logo_sticky",
					'label' => esc_html__( 'Menu Logo Sticky' , 'noo-organici' ),
					'desc'  => esc_html__( 'Menu Logo Sticky.', 'noo-organici' ),
					'type'  => 'image',
				),
			)
		);

		if( noo_organici_get_option('noo_page_heading', true) ) {
			$meta_box['fields'][] = array(
				'id'    => '_heading_image',
				'label' => esc_html__( 'Heading Background Image', 'noo-organici' ),
				'desc'  => esc_html__( 'An unique heading image for this page', 'noo-organici'),
				'type'  => 'image',
			);
		}
		$helper->add_meta_box($meta_box);
	}
endif;

add_action('add_meta_boxes', 'noo_organici_page_meta_boxes');