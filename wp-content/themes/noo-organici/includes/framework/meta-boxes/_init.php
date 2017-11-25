<?php
/**
 * NOO Meta Boxes Package
 *
 * Initialize NOO Meta Boxes
 * This file initialize NOO Meta Boxes, it include materials and start the Meta Boxes for Post and Page.
 *
 * @package    NOO Framework
 * @subpackage NOO Meta Boxes
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */


// 0. Init variables
if(!defined('NOO_META_BOXES'))
{
  define('NOO_META_BOXES', NOO_FRAMEWORK . '/meta-boxes');
}

// 1. Include required material
require_once get_template_directory() . '/includes/framework/meta-boxes/generate-meta-box.php';
require_once get_template_directory() . '/includes/framework/meta-boxes/class-helper.php';

require_once get_template_directory() .'/includes/add_metabox/function-init.php';

// 3. Enqueue script for NOO Meta Boxes
if ( ! function_exists( 'noo_organici_enqueue_meta_boxes_js' ) ) :
	function noo_organici_enqueue_meta_boxes_js( $hook ) {

		if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) {
			return;
		}

		wp_register_script( 'noo-meta-boxes-js', get_template_directory_uri() . '/includes/framework/assets/js/noo-meta-boxes.js', array( 'jquery', 'media-upload', 'thickbox' ), NULL, true );
		wp_enqueue_script( 'noo-meta-boxes-js' );

	}
	add_action( 'admin_enqueue_scripts', 'noo_organici_enqueue_meta_boxes_js' );
endif;


// 4. Enqueue style for NOO Meta Boxes
if ( ! function_exists( 'noo_organici_enqueue_meta_boxes_css' ) ) :
	function noo_organici_enqueue_meta_boxes_css( $hook ) {

		if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) {
			return;
		}

		wp_register_style( 'noo-meta-boxes-css', get_template_directory_uri() . '/includes/framework/assets/css/noo-meta-boxes.css', NULL, NULL, 'all' );
		wp_enqueue_style( 'noo-meta-boxes-css' );

	}
	add_action( 'admin_enqueue_scripts', 'noo_organici_enqueue_meta_boxes_css' );
endif;