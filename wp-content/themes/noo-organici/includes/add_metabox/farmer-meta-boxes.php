<?php
/**
 * NOO Meta Boxes Package
 *
 * Setup NOO Meta Boxes for Farmer
 * This file add Meta Boxes to WP Page edit Farmer.
 *
 * @package    NOO Framework
 * @subpackage NOO Meta Boxes
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2015, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

if (!function_exists('noo_organici_farmer_meta_boxes')):
    function noo_organici_farmer_meta_boxes() {
        // Declare helper object
        $prefix = '_noo_wp_farmer';
        $helper = new Noo_Organici_Meta_Boxes_Helper($prefix, array(
            'page' => 'farmer'
        ));

        // infomation
        $meta_box = array(
            'id' => "{$prefix}_meta_box_farmer",
            'title' => esc_html__('Farmer Information:', 'noo-organici'),
            'fields' => array(
                array(
                    'id' => "{$prefix}_image",
                    'label' => esc_html__( 'Image', 'noo-organici' ),
                    'type' => 'image',
                ),
                array(
                    'id' => "{$prefix}_name",
                    'label' => esc_html__( 'Name', 'noo-organici' ),
                    'type' => 'text',
                )

            )
        );
        $helper->add_meta_box($meta_box);

        $meta_box = array(
            'id' => "{$prefix}_meta_box_farmer_social",
            'title' => esc_html__('Media Data: Social', 'noo-organici'),
            'fields' => array(
                array(
                    'id' => "{$prefix}_facebook",
                    'label' => esc_html__( 'Facebook', 'noo-organici' ),
                    'type' => 'text',
                ),
                array(
                    'id' => "{$prefix}_twitter",
                    'label' => esc_html__( 'Twitter', 'noo-organici' ),
                    'type' => 'text',
                ),
                array(
                    'id' => "{$prefix}_google",
                    'label' => esc_html__( 'Google +', 'noo-organici' ),
                    'type' => 'text',
                ),
                array(
                    'id' => "{$prefix}_linkedin",
                    'label' => esc_html__( 'Linkedin', 'noo-organici' ),
                    'type' => 'text',
                ),
                array(
                    'id' => "{$prefix}_flickr",
                    'label' => esc_html__( 'Flickr', 'noo-organici' ),
                    'type' => 'text',
                ),
                array(
                    'id' => "{$prefix}_pinterest",
                    'label' => esc_html__( 'Pinterest', 'noo-organici' ),
                    'type' => 'text',
                ),
                array(
                    'id' => "{$prefix}_instagram",
                    'label' => esc_html__( 'Instagram', 'noo-organici' ),
                    'type' => 'text',
                ),
                array(
                    'id' => "{$prefix}_tumblr",
                    'label' => esc_html__( 'Tumblr', 'noo-organici' ),
                    'type' => 'text',
                )
            )
        );
        $helper->add_meta_box($meta_box);
    }
endif;

add_action('add_meta_boxes', 'noo_organici_farmer_meta_boxes');