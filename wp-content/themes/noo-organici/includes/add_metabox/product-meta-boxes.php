<?php
/**
 * NOO Meta Boxes Package
 *
 * Setup NOO Meta Boxes for product
 * This file add Meta Boxes to WP Post edit page.
 *
 */
if (!function_exists('noo_organici_product_meta_boxes')):
    function noo_organici_product_meta_boxes() {
        // Declare helper object
        $prefix = '_noo_wp_product';
        $helper = new Noo_Organici_Meta_Boxes_Helper($prefix, array(
            'page' => 'product'
        ));


        // Page Settings: Single Post
        $meta_box = array(
            'id' => "{$prefix}_meta_box_single_page",
            'title' => esc_html__( 'Page Settings: Single Product', 'noo-organici'),
            'description' => esc_html__( 'Choose various setting for your Single Product page.', 'noo-organici'),
            'fields' => array(
                array(
                    'label' => esc_html__( 'Override Global Settings?', 'noo-organici'),
                    'id' => "{$prefix}_override_layout",
                    'type' => 'checkbox',
                    'child-fields' => array(
                        'on' => "{$prefix}_layout,{$prefix}_sidebar"
                    ),
                ),
                array(
                    'label' => esc_html__( 'Page Layout', 'noo-organici'),
                    'id' => "{$prefix}_layout",
                    'type' => 'radio',
                    'std' => 'sidebar',
                    'options' => array(
                        'fullwidth' => array(
                            'label' => esc_html__( 'Full-Width', 'noo-organici'),
                            'value' => 'fullwidth',
                        ),
                        'sidebar' => array(
                            'label' => esc_html__( 'With Right Sidebar', 'noo-organici'),
                            'value' => 'sidebar',
                        ),
                        'left_sidebar' => array(
                            'label' => esc_html__( 'With Left Sidebar', 'noo-organici'),
                            'value' => 'left_sidebar',
                        ),
                    )
                ),
                array(
                    'label' => esc_html__( 'Product Sidebar', 'noo-organici'),
                    'id' => "{$prefix}_sidebar",
                    'type' => 'sidebars',
                    'std' => 'sidebar-main'
                ),
            )
        );

        $helper->add_meta_box( $meta_box );
    }

endif;

add_action('add_meta_boxes', 'noo_organici_product_meta_boxes');

