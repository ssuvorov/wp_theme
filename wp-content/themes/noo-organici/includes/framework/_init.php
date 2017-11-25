<?php
/**
 * Initialize Theme functions for NOO Framework.
 * This file include the framework functions, it should remain intact between themes.
 * For theme specified functions, see file functions-<theme name>.php
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

// Initialize NOO Libraries
$noo_libs = 'includes/framework/libs/noo';

get_template_part( 'includes/framework/libs/noo' ,'theme');

get_template_part( 'includes/framework/libs/noo' ,'layout');

get_template_part( 'includes/framework/libs/noo' ,'post-type');

get_template_part( 'includes/framework/libs/noo' ,'css');

// Initialize NOO Customizer

require_once get_template_directory() . '/includes/framework/customizer/_init.php';

// Meta Boxes
require_once get_template_directory() . '/includes/framework/meta-boxes/_init.php';

//
// Plugins
// First we'll check if there's any plugins inluded
//
$plugin_path = get_template_directory() . '/plugins';
if ( file_exists( get_template_directory() . '/plugins/tgmpa_register.php' ) ) {
    require_once get_template_directory() . '/includes/framework/class-tgm-plugin-activation.php';
    require_once get_template_directory() . '/plugins/tgmpa_register.php';
}

// Enqueue style for admin
if ( ! function_exists( 'noo_organici_enqueue_admin_assets' ) ) :
	function noo_organici_enqueue_admin_assets() {

		wp_register_style( 'noo-admin-css', get_template_directory_uri() . '/includes/framework/assets/css/noo-admin.css', null, null, 'all' );
		wp_enqueue_style( 'noo-admin-css' );

		wp_register_style( 'vendor-font-awesome-css', get_template_directory_uri() . '/assets/vendor/fontawesome/css/font-awesome.min.css',array(),'4.1.0');
		wp_register_style( 'noo-icon-bootstrap-modal-css', get_template_directory_uri() . '/includes/framework/assets/css/noo-icon-bootstrap-modal.css', null, null, 'all' );
		wp_register_style( 'noo-jquery-ui-slider', get_template_directory_uri() . '/includes/framework/assets/css/noo-jquery-ui.slider.css', null, '1.10.4', 'all' );
		wp_register_style( 'vendor-chosen-css', get_template_directory_uri() . '/includes/framework/assets/css/noo-chosen.css', null, null, 'all' );

		wp_register_style( 'vendor-alertify-core-css', get_template_directory_uri() . '/includes/framework/assets/css/alertify.core.css', null, null, 'all' );
		wp_register_style( 'vendor-alertify-default-css', get_template_directory_uri() . '/includes/framework/assets/css/alertify.default.css', array('vendor-alertify-core-css'), null, 'all' );
		
		wp_register_style( 'vendor-datetimepicker', get_template_directory_uri() . '/assets/vendor/datetimepicker/jquery.datetimepicker.css', '2.4.0' );
		wp_register_script( 'vendor-datetimepicker', get_template_directory_uri() . '/assets/vendor/datetimepicker/jquery.datetimepicker.js', array( 'jquery' ), '2.4.0', true );
		
		wp_register_script( 'openhours-js', get_template_directory_uri() . '/includes/admin_assets/js/openhours.js', array( 'jquery' ), null, true );
        wp_enqueue_script( 'openhours-js' );	
        $args_openhour = admin_url('admin-ajax.php');
        $openhours_array = array(
            'url'   => $args_openhour
        );
        wp_localize_script('openhours-js','openhours',$openhours_array);
		
		// Main script
		wp_register_script( 'noo-admin-js', get_template_directory_uri() . '/includes/framework/assets/js/noo-admin.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'noo-admin-js' );

		wp_register_script( 'noo-bootstrap-modal-js', get_template_directory_uri() . '/includes/framework/assets/js/bootstrap-modal.js', array('jquery'), '2.3.2', true );
		wp_register_script( 'noo-bootstrap-tab-js',get_template_directory_uri() . '/includes/framework/assets/js/bootstrap-tab.js',array('jquery'), '2.3.2', true);
		wp_register_script( 'noo-font-awesome-js', get_template_directory_uri() . '/includes/framework/assets/js/font-awesome.js', array( 'noo-bootstrap-modal-js', 'noo-bootstrap-tab-js'), null, true );
		wp_register_script( 'vendor-chosen-js', get_template_directory_uri() . '/includes/framework/assets/js/chosen.jquery.min.js', array( 'jquery'), null, true );
		wp_register_script( 'vendor-fileDownload-js', get_template_directory_uri() . '/includes/framework/assets/js/jquery.fileDownload.js', array( 'jquery' ), null, true );
		wp_register_script( 'vendor-alertify-js', get_template_directory_uri() . '/includes/framework/assets/js/alertify.mod.min.js', null, null, true );

	}
	add_action( 'admin_enqueue_scripts', 'noo_organici_enqueue_admin_assets' );
endif;

