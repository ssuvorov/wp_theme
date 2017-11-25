<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

// add box by option sidebar

$product_layout = noo_organici_get_option('noo_woocommerce_product_layout', 'same_as_shop');
if ($product_layout == 'same_as_shop') {
    $product_layout = noo_organici_get_option('noo_shop_layout', 'fullwidth');
}
$override_setting = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_product_override_layout','');

if ( isset($override_setting) && $override_setting != '' ) {
    $product_layout = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_product_layout','');

}
if( $product_layout == 'fullwidth' ){
    remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);
    add_action('woocommerce_single_product_summary','woocommerce_output_product_data_tabs',60);

}
?>
<div class="noo-shop-main noo-container">
    <div class="noo-row">
        <div class="<?php noo_organici_main_class(); ?>">
        <?php


            /**
             * woocommerce_before_main_content hook
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             */
            do_action( 'woocommerce_before_main_content' );
        ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php wc_get_template_part( 'content', 'single-product' ); ?>

            <?php endwhile; // end of the loop. ?>

        <?php
            /**
             * woocommerce_after_main_content hook
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
        ?>
        </div><!--end class .col-md-9 or col-md-12-->
        <?php
        /**
         * woocommerce_sidebar hook
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' );
        ?>
    </div><!--end .noo-row-->
</div>
<?php get_footer( 'shop' ); ?>
