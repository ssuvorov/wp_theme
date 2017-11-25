<?php
    $phone = noo_organici_get_option('noo_header_top_phone');
    $email = noo_organici_get_option('noo_header_top_email');
?>
<div class="noo-topbar">
    <div class="noo-container">
        <ul>
            <?php if( isset($phone) && !empty($phone) ): ?>
                <li>
                    <span><i class="fa fa-phone"></i></span>
                    <a href="tel:<?php echo str_replace(' ', '', esc_attr($phone)) ?>"><?php echo esc_html($phone) ?></a>
                </li>
            <?php endif; ?>
            <?php if( isset($email) && !empty($email) ): ?>
                <li>
                    <span><i class="fa fa-envelope"></i></span>
                    <a href="mail:<?php echo esc_attr($email) ?>"><?php echo esc_html($email) ?></a>
                </li>
            <?php endif; ?>
        </ul>
        <ul>
            <?php if ( noo_organici_get_option('noo_header_nav_icon_user', false) == true ) : ?>
            <li>
                <span><i class="fa fa-user"></i></span>
                <a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><?php echo esc_html__('My Account', 'noo-organici'); ?></a>
            </li>
            <?php endif; ?>
            <?php if ( noo_organici_get_option('noo_header_nav_icon_wishlist', false) == true ) : ?>
            <li>
                <span><i class="fa fa-heart-o"></i></span>
                <a href="<?php echo esc_url(get_page_link( get_option('yith_wcwl_wishlist_page_id') )); ?>"><?php echo esc_html__('Wishlist', 'noo-organici'); ?></a>
            </li>
            <?php endif; ?>
            <?php
            if(defined('WOOCOMMERCE_VERSION') && noo_organici_get_option('noo_header_nav_icon_cart',false)):
                global $woocommerce;
            ?>
            <li>
                <a href="<?php echo esc_url($woocommerce->cart->get_cart_url());?>">
                    <span class="has-cart">
                        <i class="fa fa-shopping-cart"></i>
                        <em><?php echo $woocommerce->cart->cart_contents_count; ?></em>
                    </span>
                </a>
                &nbsp; &#8209; &nbsp; <?php echo $woocommerce->cart->get_cart_total(); ?>

            </li>
            <?php endif; ?>
            <?php if ( noo_organici_get_option('noo_header_nav_icon_search', false) == true ) : ?>
            <li>
                <a href="#" class="fa fa-search noo-search" id="noo-search"></a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>