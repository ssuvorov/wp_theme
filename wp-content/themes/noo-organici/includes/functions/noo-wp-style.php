<?php
/**
 * WP Element Functions.
 * This file contains functions related to Wordpress base elements.
 * It mostly contains functions for improving trivial issue on Wordpress.
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */


// Excerpt Length
// --------------------------------------------------------

if ( ! function_exists( 'noo_organici_excerpt_length' ) ) :
	function noo_organici_excerpt_length( $length ) {
		$excerpt_length = noo_organici_get_option('noo_blog_excerpt_length', 60);

		return (empty($excerpt_length) ? 60 : $excerpt_length); 
	}
	add_filter( 'excerpt_length', 'noo_organici_excerpt_length' );
endif;


if(!function_exists('noo_organici_the_excerpt')){
	function noo_organici_the_excerpt($excerpt=''){
		return str_replace('&nbsp;', '', $excerpt);
	}
	add_filter('the_excerpt', 'noo_organici_the_excerpt');
}


// Excerpt Read More
// --------------------------------------------------------

if ( ! function_exists( 'noo_organici_excerpt_read_more' ) ) :
	function noo_organici_excerpt_read_more( $more ) {

		return '...<div>' . noo_organici_get_readmore_link() . '</div>';
	}

	add_filter( 'excerpt_more', 'noo_organici_excerpt_read_more' );
endif;


// Content Read More
// --------------------------------------------------------

if ( ! function_exists( 'noo_organici_content_read_more' ) ) :
	function noo_organici_content_read_more( $more ) {

		return noo_organici_get_readmore_link();
	}

	add_filter( 'the_content_more_link', 'noo_organici_content_read_more' );
endif;

