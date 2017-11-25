<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}
$grid_columns = noo_organici_get_option('noo_shop_grid_column',4);
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $grid_columns );
}
if( !is_product() ):
// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

endif;
// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
$term_cat = get_the_terms(get_the_ID(), 'product_cat');
if( isset($term_cat) && !empty($term_cat) ){
    foreach($term_cat as $term):
        $classes[] = $term->slug;
    endforeach;
}
$classes[] = 'masonry-item';

if( $grid_columns == 4 ){
    $classes[] = 'noo-product-column noo-md-3 noo-sm-6';
}elseif ( $grid_columns == 2 ) {
    $classes[] = 'noo-product-column noo-md-6 noo-sm-6';
} elseif ( $grid_columns == 1 ) {
    $classes[] = 'noo-product-column noo-md-12 noo-sm-12';
} else {
    $classes[] = 'noo-product-column noo-md-4 noo-sm-6';
}


if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<div <?php post_class( $classes ); ?>>
    <div class="noo-product-inner">
        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        <a href="<?php the_permalink(); ?>" class="noo-link-thumbail">

            <?php
                /**
                 * woocommerce_before_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item_title' );



            ?>

        </a>

        <?php
        echo '<div class="noo-product-title">';
        /**
         * woocommerce_shop_loop_item_title hook
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
      //  do_action( 'woocommerce_shop_loop_item_title' );
        ?>
        <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
        <?php

        /**
         * woocommerce_after_shop_loop_item_title hook
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
        echo '</div>';

            /**
             * woocommerce_after_shop_loop_item hook
             *
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
          //  do_action( 'woocommerce_after_shop_loop_item' );

        ?>
    </div>
</div>
