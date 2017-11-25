<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php
    $product_class  = 'product-grid';
    $porduct_layout = noo_organici_get_option('noo_shop_default_layout','grid');
    if( $porduct_layout != 'grid' ){
        $product_class  = 'product-list';
    }
?>
<div class="products noo-row <?php echo esc_attr($product_class); ?>">