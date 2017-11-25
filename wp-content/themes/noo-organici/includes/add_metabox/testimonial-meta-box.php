<?php
    if( !function_exists('noo_organici_testimonial_meta_boxs') ):
        function noo_organici_testimonial_meta_boxs(){
            // Declare helper object
            $prefix = '_noo_wp_testimonial';
            $helper = new Noo_Organici_Meta_Boxes_Helper($prefix, array(
                'page' => 'testimonial'
            ));
            // Post type: Gallery
            $meta_box = array(
                'id' => "{$prefix}_meta_box_testimonial",
                'title' => esc_html__('Testimonial options', 'noo-organici'),
                'fields' => array(
                    array(
                        'id' => "{$prefix}_image",
                         'label' => esc_html__( 'Your Image', 'noo-organici' ),
                        'type' => 'image',
                    ),
                    array(
                        'id' => "{$prefix}_name",
                         'label' => esc_html__( 'Your Name', 'noo-organici' ),
                        'type' => 'text',
                    ),
                    array(
                        'id' => "{$prefix}_position",
                         'label' => esc_html__( 'Your Position', 'noo-organici' ),
                        'type' => 'text',
                    ),
                )
            );

            $helper->add_meta_box($meta_box);
        }
        add_action('add_meta_boxes', 'noo_organici_testimonial_meta_boxs');
    endif;
?>