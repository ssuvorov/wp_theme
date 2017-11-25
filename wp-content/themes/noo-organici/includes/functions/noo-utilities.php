<?php
/**
 * Utilities Functions for NOO Framework.
 * This file contains various functions for getting and preparing data.
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

if (!function_exists('noo_organici_get_page_heading')):
	function noo_organici_get_page_heading() {
		$heading = '';
		$archive_title = '';
		$archive_desc = '';
		if( ! noo_organici_get_option( 'noo_page_heading', true ) ) {
			return array($heading, $archive_title, $archive_desc);
		}
		if ( is_home() ) {
			$heading = noo_organici_get_option( 'noo_blog_heading_title', esc_html__( 'Blog', 'noo-organici' ) );
		} elseif ( NOO_WOOCOMMERCE_EXIST && is_shop() ) {
			if( is_search() ) {
				$heading =esc_html__( 'Search', 'noo-organici' );
			} else {
				$heading = noo_organici_get_option( 'noo_shop_heading_title', esc_html__( 'Shop', 'noo-organici' ) );
			}
		} elseif ( is_search() ) {
			$heading = esc_html__( 'Search', 'noo-organici' );
		} elseif ( is_author() ) {
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$heading = esc_html__( 'Author Archive','noo-organici');
		} elseif ( is_year() ) {
    		$heading = esc_html__( 'Post Archive by Year: ', 'noo-organici' ) . get_the_date( 'Y' );
		} elseif ( is_month() ) {
    		$heading = esc_html__( 'Post Archive by Month: ', 'noo-organici' ) . get_the_date( 'F,Y' );
		} elseif ( is_day() ) {
    		$heading = esc_html__( 'Post Archive by Day: ', 'noo-organici' ) . get_the_date( 'F j, Y' );
		} elseif ( is_404() ) {
    		$heading = esc_html__( 'Oops! We could not find anything to show to you.', 'noo-organici' );
    		$archive_title =  esc_html__( 'Would you like going else where to find your stuff.', 'noo-organici' );
		} elseif ( is_archive() ) {
			$heading        = single_cat_title( '', false );
			// $archive_desc   = term_description();
		} elseif ( is_singular( 'product' ) ) {
			$heading = noo_organici_get_option( 'noo_woocommerce_product_disable_heading', true ) ? '' : get_the_title();
		}  elseif ( is_single() ) {
			$heading = get_the_title();
		} elseif( is_page() ) {
			if( ! noo_organici_get_post_meta(get_the_ID(), '_noo_wp_page_hide_page_title', false) ) {
				$heading = get_the_title();
			}
		}

		return array($heading, $archive_title, $archive_desc);
	}
endif;

if( !function_exists('noo_organici_new_heading') ){
    function noo_organici_new_heading(){
        $varible = array();
        $image   = '';
        $title   = '';
        if( ! noo_organici_get_option( 'noo_page_heading', true ) ) {
			return array();
		}
        if( NOO_WOOCOMMERCE_EXIST && ( is_shop()  || is_product_category() || is_product_tag() )) {
            $image = noo_organici_get_image_option('noo_shop_heading_image', '');
            $title = noo_organici_get_option('noo_shop_heading_title');
        }elseif(  NOO_WOOCOMMERCE_EXIST && is_product() ) {
            $option = noo_organici_get_option('noo_product_single_header', 1);
            $image = noo_organici_get_image_option('noo_shop_heading_image', '');
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
            if (isset($thumb) && !empty($thumb) && $option != 1) {
                $image = $thumb[0];
            }
            $title = get_the_title();

        }elseif( is_search() ) {
            $image = noo_organici_get_image_option('noo_blog_heading_image', '');
            $title = get_search_query();
        }elseif( is_home() || is_category() || is_tag() || is_date() ) {
            $image = noo_organici_get_image_option('noo_blog_heading_image', '');
            $title = noo_organici_get_option('noo_blog_heading_title', esc_html__('Blog', 'noo-organici'));
        }elseif( is_singular('noo_project') ){
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
            if (isset($thumb) && !empty($thumb)) {
                $image = $thumb[0];
            }
            $title = get_the_title();

        }elseif ( is_single()) {

            $image  = noo_organici_get_image_option( 'noo_blog_heading_image', '' );
            $option = noo_organici_get_option('noo_blog_single_header', 1);
            $thumb  = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

            if (isset($thumb) && !empty($thumb) && $option != 1) {
                $image = $thumb[0];
            }
            $title = get_the_title();
        }elseif( is_page() ){
            $id_image = noo_organici_get_post_meta(get_the_ID(),'_heading_image');
            if( isset($id_image) && !empty($id_image) ){
                $image = wp_get_attachment_url($id_image);
            }
            $title = get_the_title();

        }
        $varible['img'] =   $image;
        $varible['title'] =   $title;
        return $varible;
    }
}

if (!function_exists('noo_organici_get_page_heading_image')):
	function noo_organici_get_page_heading_image() {
		$image = '';
		if( ! noo_organici_get_option( 'noo_page_heading', true ) ) {
			return $image;
		}
		if( NOO_WOOCOMMERCE_EXIST && is_shop() ) {
			$image = noo_organici_get_image_option( 'noo_shop_heading_image', '' );
		} elseif ( is_home() ) {
			$image = noo_organici_get_image_option( 'noo_blog_heading_image', '' );
		} elseif( is_category() || is_tag() ) {
			$queried_object = get_queried_object();
			$image			= noo_organici_get_term_meta( $queried_object->term_id, 'heading_image', '' );
			$image			= empty( $image ) ? noo_organici_get_image_option( 'noo_blog_heading_image', '' ) : $image;
		} elseif( NOO_WOOCOMMERCE_EXIST && ( is_product_category() || is_product_tag() ) ) {
			$queried_object = get_queried_object();
			$image			= noo_organici_get_term_meta( $queried_object->term_id, 'heading_image', '' );
			$image			= empty( $image ) ? noo_organici_get_image_option( 'noo_shop_heading_image', '' ) : $image;
		} elseif ( is_singular('product' ) || is_page() ) {
			$image = noo_organici_get_post_meta(get_the_ID(), '_heading_image', '');
		} elseif ( is_single()) {
			$image = noo_organici_get_image_option( 'noo_blog_heading_image', '' );
		}

		if( !empty( $image ) && is_numeric( $image ) ) $image = wp_get_attachment_url( $image );

		return $image;
	}
endif;

if (!function_exists('noo_organici_has_featured_content')):
	function noo_organici_has_featured_content($post_id = null) {
		$post_id = (null === $post_id) ? get_the_ID() : $post_id;

		$post_type = get_post_type($post_id);
		$prefix = '';
		$post_format = '';
		
		if ($post_type == 'post') {
			$prefix = '_noo_wp_post';
			$post_format = get_post_format($post_id);
		}
		
		switch ($post_format) {
			case 'image':
				$main_image = noo_organici_get_post_meta($post_id, "{$prefix}_main_image", 'featured');
				if( $main_image == 'featured') {
					return has_post_thumbnail($post_id);
				}

				return has_post_thumbnail($post_id) || ( (bool)noo_organici_get_post_meta($post_id, "{$prefix}_image", '') );
			case 'gallery':
				if (!is_singular()) {
					$preview_content = noo_organici_get_post_meta($post_id, "{$prefix}_gallery_preview", 'slideshow');
					if ($preview_content == 'featured') {
						return has_post_thumbnail($post_id);
					}
				}
				
				return (bool)noo_organici_get_post_meta($post_id, "{$prefix}_gallery", '');
			case 'video':
				if (!is_singular()) {
					$preview_content = noo_organici_get_post_meta($post_id, "{$prefix}_preview_video", 'both');
					if ($preview_content == 'featured') {
						return has_post_thumbnail($post_id);
					}
				}
				
				$m4v_video = (bool)noo_organici_get_post_meta($post_id, "{$prefix}_video_m4v", '');
				$ogv_video = (bool)noo_organici_get_post_meta($post_id, "{$prefix}_video_ogv", '');
				$embed_video = (bool)noo_organici_get_post_meta($post_id, "{$prefix}_video_embed", '');
				
				return $m4v_video || $ogv_video || $embed_video;
			case 'link':
			case 'quote':
				return false;
				
			case 'audio':
				$mp3_audio = (bool)noo_organici_get_post_meta($post_id, "{$prefix}_audio_mp3", '');
				$oga_audio = (bool)noo_organici_get_post_meta($post_id, "{$prefix}_audio_oga", '');
				$embed_audio = (bool)noo_organici_get_post_meta($post_id, "{$prefix}_audio_embed", '');
				return $mp3_audio || $oga_audio || $embed_audio;
			default: // standard post format
				return has_post_thumbnail($post_id);
		}
		
		return false;
	}
endif;

// Get allowed HTML tag.
if( !function_exists('noo_organici_allowed_html') ) :
	function noo_organici_allowed_html() {
		return apply_filters( 'noo_organici_allowed_html', array(
			'a' => array(
				'href' => array(),
				'target' => array(),
				'title' => array(),
				'rel' => array(),
				'class' => array(),
				'style' => array(),
			),
			'img' => array(
				'src' => array(),
				'class' => array(),
				'style' => array(),
			),
			'h1' => array(),
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'p' => array(
				'class' => array(),
				'style' => array()
			),
			'br' => array(
				'class' => array(),
				'style' => array()
			),
			'hr' => array(
				'class' => array(),
				'style' => array()
			),
			'span' => array(
				'class' => array(),
				'style' => array()
			),
            'div' => array(
                "style" => array(),
                "class" => array(),
                "entrance" => array()
			),
			'em' => array(
				'class' => array(),
				'style' => array()
			),
			'strong' => array(
				'class' => array(),
				'style' => array()
			),
			'small' => array(
				'class' => array(),
				'style' => array()
			),
			'b' => array(
				'class' => array(),
				'style' => array()
			),
			'i' => array(
				'class' => array(),
				'style' => array()
			),
			'u' => array(
				'class' => array(),
				'style' => array()
			),
			'ul' => array(
				'class' => array(),
				'style' => array()
			),
			'ol' => array(
				'class' => array(),
				'style' => array()
			),
			'li' => array(
				'class' => array(),
				'style' => array()
			),
			'blockquote' => array(
				'class' => array(),
				'style' => array()
			),
		) );
	}
endif;

// Allow only unharmed HTML tag.
if( !function_exists('noo_organici_html_content_filter') ) :
	function noo_organici_html_content_filter( $content = '' ) {
		return wp_kses( $content, noo_organici_allowed_html() );
	}
endif;

// escape language with HTML.
if( !function_exists('noo_organici_kses') ) :
	function noo_organici_kses( $text = '' ) {
		return wp_kses( $text, noo_organici_allowed_html() );
	}
endif;

/* -------------------------------------------------------
 * Create functions noo_organici_get_page_id_by_template
 * ------------------------------------------------------- */

if ( ! function_exists( 'noo_organici_get_page_id_by_template' ) ) :
	
	function noo_organici_get_page_id_by_template( $page_template = '' ) {

		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $page_template
		));

		if( $pages ){
			return $pages[0]->ID;
		}
		return false;

	}

endif;

/** ====== END noo_organici_get_page_id_by_template ====== **/