<?php
/**
 * Style Functions for NOO Framework.
 * This file contains functions for calculating style (normally it's css class) base on settings from admin side.
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

if (!function_exists('noo_organici_body_class')):
	function noo_organici_body_class($output) {
		global $wp_customize;
		if (isset($wp_customize)) {
			$output[] = 'is-customize-preview';
		}

		$page_nav_position = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_nav_position');
		if($page_nav_position == 'static_top' || $page_nav_position == 'fixed_top' ){
			if($page_nav_position == 'fixed_top' ){
				$output[] ='fixed_top';
			}
		} else {
			$navbar_position = noo_organici_get_option('noo_header_nav_position', 'static_top');
			if( $navbar_position == 'fixed_top' ) {
	            $output[] = 'fixed_top';
	        }
		}

		// Preload
		if( noo_organici_get_option( 'noo_preload', false ) ) {
			$output[] = 'enable-preload';
		}

		$page_layout = noo_organici_get_page_layout();
		if ($page_layout == 'fullwidth') {
			$output[] = ' page-fullwidth';
		} elseif ($page_layout == 'left_sidebar') {
			$output[] = ' page-left-sidebar';
		} else {
			$output[] = ' page-right-sidebar';
		}
		
		switch (noo_organici_get_option('noo_site_layout', 'fullwidth')) {
			case 'boxed':
				$output[] = 'boxed-layout';
			break;
			default:
				$output[] = 'full-width-layout';
			break;
		}

        // if ( noo_organici_get_option('noo_layout_rtl','no') == 'yes' ){
        //     $output[] = 'theme-rtl';
        // }
		
		return $output;
	}
endif;
add_filter('body_class', 'noo_organici_body_class');

if (!function_exists('noo_organici_footer_class')):
	function noo_organici_footer_class() {
        $class = '';
        $footer_style = noo_organici_get_option('noo_footer_style','footer2');
        if( is_page() ){
            $footerpage   = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_footer_style');
            if( !empty($footerpage) && $footerpage != 'footer' ){
                $footer_style = $footerpage;
            }
        }
        switch ($footer_style) {
            case 'footer2';
                $class .= ' footer-2';
                break;
            case 'footer3';
                $class .= ' footer-3';
                break;
            case 'footer4';
                $class .= ' footer-4';
                break;
            default: case 'footer2';
                $class .= ' footer-2';
                break;
        }
		echo esc_attr($class);
	}
endif;

if (!function_exists('noo_organici_header_class')):
	function noo_organici_header_class() {
        $class = '';
        $header_style = noo_organici_get_option('noo_header_nav_style','header1');
        if( is_page() ){
            $headerpage   = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_header_style');
            if( !empty($headerpage) && $headerpage != 'header' ){
                $header_style = $headerpage;
            }
        }
        switch ($header_style) {
            case 'header2';
                $class .= ' header-2';
                break;
            case 'header3';
                $class .= ' header-3';
                break;
            case 'header4';
                $class .= ' header-4';
                break;
           	case 'header5';
                $class .= ' header-5';
                break;
            case 'header6';
                $class .= ' header-6';
                break;
            default: case 'header1';
                $class .= ' header-1';
                break;
        }
		echo esc_attr($class);
	}
endif;


if (!function_exists('noo_organici_main_class')):
	function noo_organici_main_class() {
		$class = 'noo-main';
		$page_layout = noo_organici_get_page_layout();

		if ($page_layout == 'fullwidth') {
			$class.= ' noo-md-12';
		} elseif ($page_layout == 'left_sidebar') {
			$class.= ' noo-md-9 pull-right';
		} else {
			$class.= ' noo-md-9';
		}
		
		echo esc_attr($class);
	}
endif;

if (!function_exists('noo_organici_sidebar_class')):
	function noo_organici_sidebar_class() {
		$class = ' noo-sidebar noo-md-3';
		$page_layout = noo_organici_get_page_layout();
		
		if ( $page_layout == 'left_sidebar' ) {
			$class .= ' noo-sidebar-left pull-left';
		}
		
		echo esc_attr($class);
	}
endif;

if (!function_exists('noo_organici_post_class')):
	function noo_organici_post_class($output) {
		if (noo_organici_has_featured_content()) {
			$output[] = 'has-featured';
		} else {
			$output[] = 'no-featured';
		}
		
		return $output;
	}
	
	add_filter('post_class', 'noo_organici_post_class');
endif;
