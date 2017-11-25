<?php
/**
 * Theme functions for NOO Framework.
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

// Set global constance


if ( !defined( 'NOO_ASSETS' ) ) {
	define( 'NOO_ASSETS', get_template_directory() . '/assets' );
}

if ( !defined( 'NOO_ASSETS_URI' ) ) {
	define( 'NOO_ASSETS_URI', get_template_directory_uri() . '/assets' );
}

if ( !defined( 'NOO_VENDOR' ) ) {
	define( 'NOO_VENDOR', NOO_ASSETS . '/vendor' );
}

if ( !defined( 'NOO_VENDOR_URI' ) ) {
	define( 'NOO_VENDOR_URI', NOO_ASSETS_URI . '/vendor' );
}

define( 'NOO_INCLUDES', get_template_directory() . '/includes' );
define( 'NOO_INCLUDES_URI', get_template_directory_uri() . '/includes' );
define( 'NOO_FUNCTIONS', NOO_INCLUDES . '/functions' );

define( 'NOO_POST_TYPE', NOO_INCLUDES . '/post_type' );
define( 'NOO_POST_TYPE_URI', NOO_INCLUDES_URI . '/post_type' );

define( 'NOO_FRAMEWORK', NOO_INCLUDES . '/framework' );
define( 'NOO_FRAMEWORK_URI', NOO_INCLUDES_URI . '/framework' );

define( 'NOO_ADMIN_ASSETS', NOO_INCLUDES . '/admin_assets' );
define( 'NOO_ADMIN_ASSETS_URI', NOO_INCLUDES_URI . '/admin_assets' );

// Functions for specific theme
$theme_name = basename(dirname(__FILE__));

if ( !defined( 'NOO_THEME_NAME' ) ) {
	define( 'NOO_THEME_NAME', $theme_name );
}

define( 'NOO_WOOCOMMERCE_EXIST', class_exists( 'WC_API' ) );

// Theme setup
require_once get_template_directory() . '/includes/theme_setup.php';

//
// Init Framework.
//
require_once get_template_directory() . '/includes/framework/_init.php';

//
// Enqueue assets
//
require_once get_template_directory() . '/includes/functions/noo-enqueue-css.php';
require_once get_template_directory() . '/includes/functions/noo-enqueue-js.php';

// Helper functions
require_once get_template_directory() . '/includes/functions/noo-html.php';
require_once get_template_directory() . '/includes/functions/noo-utilities.php';
require_once get_template_directory() . '/includes/functions/noo-style.php';
require_once get_template_directory() . '/includes/functions/noo-wp-style.php';
require_once get_template_directory() . '/includes/functions/noo-user.php';


// Mega Menu
require_once get_template_directory() . '/includes/mega-menu/noo_mega_menu.php';

// WooCommerce

 require_once get_template_directory() . '/includes/woocommerce.php';

//
// Widgets
//
$widget_path = get_template_directory() . '/widgets';


if ( file_exists( get_template_directory() . '/widgets/widgets_init.php' ) ) {
    require_once get_template_directory() . '/widgets/widgets_init.php';
    require_once get_template_directory() . '/widgets/widgets.php';

}

function noo_organici_add_span_cat_count($links) {
    $links = str_replace('</a> (', '</a> <span class="count">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}
add_filter('wp_list_categories', 'noo_organici_add_span_cat_count');

function noo_organici_search_form() {
    $form = '<form method="get" class="form-horizontal" action="' . home_url( '/' ) . '" >
        <input type="search" name="s" class="form-control" value="' . get_search_query() . '" placeholder="'.esc_html__( 'Enter your keyword...', 'noo-organici' ).'">
        <input type="submit" value="Search">
    </form>';
    return $form;
}


function noo_organici_post_nav() {
    global $post;
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;

    ?>
    <?php $prev_link = get_previous_post_link( '%link', _x( '%title', 'Previous post link', 'noo-organici' ) ); ?>
    <?php $next_link = get_next_post_link( '%link', _x( '%title', 'Next post link', 'noo-organici' ) ); ?>
    <nav class="post-navigation<?php echo( (!empty($prev_link) || !empty($next_link) ) ? ' post-navigation-line':'' )?>">
        <?php if($prev_link):?>
            <?php
                $url_img = wp_get_attachment_image_src(get_post_thumbnail_id( $previous->ID ), 'large');
            ?>
            <div class="prev-post">
                <div class="bg-prev-post" style="background-image: url(<?php echo esc_url($url_img[0]); ?>);"></div>
                <i class="fa fa-long-arrow-left">&nbsp;</i>
                <?php echo ($prev_link);?>
            </div>
        <?php endif;?>
                
        <?php if(!empty($next_link)):?>
            <?php
                $url_img = wp_get_attachment_image_src(get_post_thumbnail_id( $next->ID ), 'large');
            ?>
            <div class="next-post">
                <div class="bg-next-post" style="background-image: url(<?php echo esc_url($url_img[0]); ?>);"></div>
                <?php echo ($next_link);?>
                <i class="fa fa-long-arrow-right">&nbsp;</i>
            </div>
        <?php endif;?>
    </nav>
    <?php
}

if ( !function_exists('noo_organici_content_tags') ) :
    function noo_organici_content_tags(){
        if ( is_single() ) {
            $vartocheck = noo_organici_get_option('noo_blog_post_show_post_tag', false);
        } else {
            $vartocheck = noo_organici_get_option('noo_blog_show_post_tag', false);
        }
        if( $vartocheck && has_tag() ):?>
            <div class="content-tags">
                <?php echo get_the_tag_list('<span class="fa fa-tag"></span>',', ',''); ?>
            </div>
        <?php endif;
    }
endif;

if ( !function_exists('noo_organici_content_social') ) :
    function noo_organici_content_social(){
        if ( is_single() ) {
            $vartocheck = noo_organici_get_option('noo_blog_post_social', false);
        } else {
            $vartocheck = noo_organici_get_option('noo_blog_social', false);
        }
        if( $vartocheck ): ?>
            <div class="single-social">
                <span class="text-share"><span class="fa fa-share-alt"></span><?php echo esc_html__( 'Share this post','noo-organici'); ?></span>
                <?php noo_organici_social_share(); ?>
            </div>
        <?php endif;
    }
endif;

if ( !function_exists('noo_organici_content_social_and_tags') ) :
    function noo_organici_content_social_and_tags(){
        ?>
        <div class="content-meta">
        <?php noo_organici_content_tags(); ?>
        <?php noo_organici_content_social(); ?>
        </div>
        <?php
    }
endif;

if ( !function_exists('noo_organici_content_meta') ) :
    function noo_organici_content_meta(){
        $flag = false;
        if ( is_single() ) {
            if ( noo_organici_get_option('noo_blog_post_show_post_meta', false) ) {
                $flag = true;        
            }
        } else {
            if ( noo_organici_get_option('noo_blog_show_post_meta', false) ) {
                $flag = true;
            }
        }
        if ($flag):
        ?>
        <span class="meta">
        <?php
        echo get_the_date() . esc_html__(' By ','noo-organici');
        the_author_posts_link();
        ?>
        </span>
        <?php
        endif;
    }
endif;

if( !function_exists('noo_organici_get_instagram_data') ) :
    // using standard_resolution / thumbnail / low_resolution
    function noo_organici_get_instagram_data($username = 'nootheme', $cache_hours = '5', $nr_images = '4', $resolution = 'thumbnail', $randomise = false) {
        $opt_name    = 'noo_insta_'.md5( $username );
        $instaData 	 = get_transient( $opt_name );
        $user_opt    = get_option( $opt_name );

        if( !in_array($resolution, array( 'low_resolution', 'thumbnail', 'standard_resolution' ) ) ) $resolution = 'thumbnail';
        if ( false === $instaData
            || $user_opt['username']    != $username
            || $user_opt['cache_hours'] != $cache_hours
            || $user_opt['nr_images']   != $nr_images
            || $user_opt['resolution']  != $resolution
        ) {
            $instaData    = array();
            $insta_url    = 'https://instagram.com/';
            $user_profile = $insta_url.$username;
            $json     	  = wp_remote_get( $user_profile, array( 'sslverify' => false, 'timeout'=> 60 ) );
            if ( !is_wp_error( $json ) && $json['response']['code'] == 200 ) {
                $json 	  = $json['body'];
                $json     = strstr( $json, 'window._sharedData = ' );
                $json     = str_replace('window._sharedData = ', '', $json);

                // Compatibility for version of php where strstr() doesnt accept third parameter
                if ( version_compare( phpversion(), '5.3.10', '<' ) ) {
                    $json = substr( $json, 0, strpos($json, '</script>' ) );
                } else {
                    $json = strstr( $json, '</script>', true );
                }

                $json     = rtrim( $json, ';' );

                // Function json_last_error() is not available before PHP * 5.3.0 version
                if ( function_exists( 'json_last_error' ) ) {

                    ( $results = json_decode( $json, true ) ) && json_last_error() == JSON_ERROR_NONE;

                } else {

                    $results = json_decode( $json, true );
                }

                if ( ( $results ) && is_array( $results ) && isset( $results['entry_data']['ProfilePage'] ) && is_array( $results['entry_data']['ProfilePage'] ) ) {

                    foreach( $results['entry_data']['ProfilePage'][0]['user']['media']['nodes'] as $result ) {

                        $caption      = $result['caption'];
                        $image        = $result['display_src'];
                        $id           = $result['id'];
                        $link         = 'https://instagram.com/p/'.$result['code'];
                        $text         = noo_organici_utf8_4byte_to_3byte($caption);
                        $filename_data= explode( '.', $image );

                        if ( is_array( $filename_data ) ) {

                            $fileformat   = end( $filename_data );

                            if ( $fileformat !== false ){

                                array_push( $instaData, array(
                                    'id'           => $id,
                                    'user_name'	   => $username,
                                    'user_url'	   => $user_profile,
                                    'text'         => $text,
                                    'image'        => $image,
                                    'link'         => $link
                                ));

                            } // end -> if $fileformat !== false

                        } // end -> is_array( $filename_data )

                    } // end -> foreach

                } // end -> ( $results ) && is_array( $results ) )
                if ( $instaData ) {
                    set_transient( $opt_name, $instaData, $cache_hours * 60 * 60 );
                    $user_options = compact('username', 'cache_hours', 'nr_images', 'resolution');
                    update_option( $opt_name, $user_options );
                } else {
                    delete_option( $opt_name );
                    delete_transient( $opt_name );
                }// end -> true $instaData
            } else {
                delete_option( $opt_name );
                delete_transient( $opt_name );
            }
        }

        if( $randomise ) shuffle( $instaData );
        return array_slice($instaData, 0, $nr_images, true);
    }
endif;

function noo_organici_utf8_4byte_to_3byte( $input ) {

    if (!empty($input)) {
        $utf8_2byte = 0xC0 /*1100 0000*/; $utf8_2byte_bmask = 0xE0 /*1110 0000*/;
        $utf8_3byte = 0xE0 /*1110 0000*/; $utf8_3byte_bmask = 0XF0 /*1111 0000*/;
        $utf8_4byte = 0xF0 /*1111 0000*/; $utf8_4byte_bmask = 0xF8 /*1111 1000*/;

        $sanitized = "";
        $len = strlen($input);
        for ($i = 0; $i < $len; ++$i) {
            $mb_char = $input[$i]; // Potentially a multibyte sequence
            $byte = ord($mb_char);
            if (($byte & $utf8_2byte_bmask) == $utf8_2byte) {
                $mb_char .= $input[++$i];
            }
            else if (($byte & $utf8_3byte_bmask) == $utf8_3byte) {
                $mb_char .= $input[++$i];
                $mb_char .= $input[++$i];
            }
            else if (($byte & $utf8_4byte_bmask) == $utf8_4byte) {
                // Replace with ? to avoid MySQL exception
                $mb_char = '?';
                $i += 3;
            }

            $sanitized .=  $mb_char;
        }

        $input= $sanitized;
    }

    return $input;
}

add_filter( 'wp_nav_menu_items', 'noo_organici_custom_menu_item', 10, 2 );
function noo_organici_custom_menu_item($items, $args){
    if ($args->theme_location == 'right-menu') {
        if ( noo_organici_get_option('noo_header_nav_icon_search', false) == true ) :
            $items .= '<li><a href="#" class="fa fa-search noo-search" id="noo-search"></a></li>';
        endif;
        if(defined('WOOCOMMERCE_VERSION') && noo_organici_get_option('noo_header_nav_icon_cart',false)):
            global $woocommerce;
            $items .= '<li><a href="' . $woocommerce->cart->get_cart_url() . '"><span class="has-cart">';
            $items .= '<i class="fa fa-shopping-cart"></i>';
            $items .= '<em>' . $woocommerce->cart->cart_contents_count . '</em>';
            $items .= '</span></a></li>';
        endif;
    }
    return $items;
}

function title_filter($where, &$wp_query){
    global $wpdb;
    if($search_term = $wp_query->get( 'title_filter' )){
        $search_term = $wpdb->esc_like($search_term); //instead of esc_sql()
        $search_term = ' \'%' . $search_term . '%\'';
        $title_filter_relation = (strtoupper($wp_query->get( 'title_filter_relation'))=='OR' ? 'OR' : 'AND');
        $where .= ' '.$title_filter_relation.' ' . $wpdb->posts . '.post_title LIKE '.$search_term;
    }
    return $where;
}
add_filter('posts_where','title_filter',10,2);

add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
  if ( ( isset( $_POST['condition1'] ) ) && ( $_POST['condition1'] != '') )
  $condition1 = wp_filter_nohtml_kses($_POST['condition1']);
  add_comment_meta( $comment_id, 'condition1', $condition1 );

  if ( ( isset( $_POST['condition2'] ) ) && ( $_POST['condition2'] != '') )
  $condition2 = wp_filter_nohtml_kses($_POST['condition2']);
  add_comment_meta( $comment_id, 'condition2', $condition2 );

  if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') )
  $rating = wp_filter_nohtml_kses($_POST['rating']);
  add_comment_meta( $comment_id, 'rating', $rating );
}
// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts
add_shortcode( 'list-posts', 'rmcc_post_listing_parameters_shortcode' );
function rmcc_post_listing_parameters_shortcode( $atts ) {
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'type' => 'post',
        'order' => 'date',
        'orderby' => 'title',
        'posts' => -1,        
        'category' => '',
    ), $atts ) ); 
    // define query parameters based on attributes
	
	// Check for multiple categories by comma
   if ( strpos( $category, ',' ) !== false ) {
      $category = explode(",",$category );	  	    
   } else {
      $category = $category;	  
   }		
    $options = array(
        'post_type' => $type,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
		'tax_query' => array(
		'relation'     => 'OR',
		array(
			'taxonomy' => 'category',
			'field'    => 'name',
			'terms'    => $category,
		),
	   ),
    );
    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { ?>
    <!--Search-Result Page Start-->
    <div class="search-result-blk">
    	<div class="">
        	<div class="search-listing">
            	<ul class="grid effect-1" id="grid">
    <?php
    // Start the loop.
    while ( $query->have_posts() ) : $query->the_post();
	?>    
    <!--grid-item start-->
                    <li class="grid-item">
                    	<div class="search-result-box">
                        	<div class="box-image">
							<?php 
								if ( has_post_thumbnail() ) {					
									the_post_thumbnail("small");					
								}
							?>
                            </div>
                            <div class="box-text">
                            	<h3 class="b-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="b-rating">
                                <span class="activ"></span>
                                <span class="activ"></span>
                                <span class="activ"></span>
                                <span class="activ"></span>
                                <span></span>
                                </div>
                                <div class="b-text">
                                	<p><?php the_excerpt(); ?></p>
                                </div>
                                <!--<div class="b-author">
                                	<div class="author-img"><img src="images/author.jpg" alt=""></div>
                                    <div class="author-txt">By <a href="#">contributor</a></div>
                                </div>-->
                                <div class="b-caption">
                                	<?php //the_category();
									//$terms = get_terms('category');          							
									//print_r($terms);
									 ?>
                                    <?php the_tags(); ?>
                                    <small><?php the_date(); ?></small>
                                	<!--<div class="c-item"><span>Prep:</span>45 min</div>
                                    <div class="c-item"><span>Cook:</span>1 hr 30 min</div>
                                    <div class="c-item"><span>Yields:</span>6 Servings</div>-->
                                </div>
                            </div>
                        </div>
                    </li>
<!--grid-item end-->
    <?php
	endwhile;
	?>
    			</ul>
            </div>
        </div>
    </div>   
	<?php        
    }
}