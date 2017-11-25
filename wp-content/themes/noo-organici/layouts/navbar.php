<?php

$blog_name            =   get_bloginfo( 'name' );
$blog_desc            =   get_bloginfo( 'description' );
$image_logo_sticky    =   '';
$image_logo           =   '';
$page_logo            =   '';
$class_text           =   '';
$header_style = noo_organici_get_option('noo_header_nav_style','header1');
if ( noo_organici_get_option( 'noo_header_use_image_logo', true ) ) {
    if ( noo_organici_get_image_option( 'noo_header_logo_image', '' ) !=  '' ) {
        $image_logo = noo_organici_get_image_option( 'noo_header_logo_image', '' );
    }else{
        $image_logo = esc_attr(NOO_ASSETS_URI. '/images/logo_default.png');
    }
    $navbar_position = noo_organici_get_option('noo_header_nav_position', 'static_top');
    if ( $navbar_position == 'fixed_top' ) {
        $image_logo_sticky = noo_organici_get_image_option( 'noo_header_logo_image_sticky', '' );
    }
}else{
    $class_text = 'logo-text';
    $blog_name = noo_organici_get_option( 'blogname', $blog_name );
}
if( is_page() ) {
    $page_logo = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_menu_logo');
    if(!empty( $page_logo ) ){
        $image_logo = wp_get_attachment_url( esc_attr($page_logo) );
    }

    if ( noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_nav_position') == 'fixed_top' ) {
        $page_logo_sticky = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_menu_logo_sticky');
        if(!empty( $page_logo_sticky ) ){
            $page_logo_sticky = wp_get_attachment_url( esc_attr($page_logo_sticky) );
        } else {
            $page_logo_sticky = noo_organici_get_image_option( 'noo_header_logo_image_sticky', '' );
        }
        $image_logo_sticky = $page_logo_sticky;
    }
    $header_page = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_header_style');
    if( !empty( $header_page ) && $header_page != 'header' ){
        $header_style = $header_page;
    }
}

?>
<header class="noo-header <?php noo_organici_header_class(); ?>">
    <?php if( $header_style == 'header2' || $header_style == 'header4' ): $has_topbar = 1; noo_organici_get_layout('topbar'); endif; ?>
    <div class="navbar-wrapper">
        <div class="navbar navbar-default" role="navigation">
            <div class="noo-container">
                <div class="menu-position">
                    <div class="navbar-header pull-left">
                        <?php if ( is_front_page() ) : echo '<h1 class="sr-only">' . $blog_name . '</h1>'; endif; ?>
                        <div class="noo_menu_canvas">
                            <?php if ( noo_organici_get_option('noo_header_nav_icon_search', true) == true ) : ?>
                            <?php
                                $class_topbar = '';
                                if ( isset($has_topbar) && $has_topbar == 1 )
                                    $class_topbar = 'topbar-has-search';
                            ?>
                            <div class="btn-search noo-search <?php echo esc_attr( $class_topbar ); ?>">
                                <i class="fa fa-search"></i>
                            </div>
                            <?php endif; ?>
                            <div data-target=".nav-collapse" class="btn-navbar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <a href="<?php echo esc_url(home_url( '/' )); ?>" class="navbar-brand" title="<?php echo esc_attr($blog_desc); ?>">
                            <?php echo ( $image_logo == '' ) ? $blog_name : '<img class="noo-logo-img noo-logo-normal" src="' . esc_url($image_logo) . '" alt="' . esc_attr($blog_desc) . '">'; ?>
                            <?php echo ( $image_logo_sticky == '' ) ? '' : '<img class="noo-logo-img noo-logo-normal" src="' . esc_url($image_logo_sticky) . '" alt="' . esc_attr($blog_desc) . '">'; ?>
                        </a>
                    </div> <!-- / .nav-header -->
                    <?php if( $header_style != 'header2' && $header_style != 'header4' && $header_style != 'header5' && $header_style != 'header6' ): ?>
                    <nav class="pull-right noo-menu-option">
                        <a href="#" class="button-expand-option"><i class="fa fa-ellipsis-v"></i></a>
                        <ul>
                            <?php if ( noo_organici_get_option('noo_header_nav_icon_user', false) == true ) : ?>
                            <li class="menu-item fly-right">
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><i class="fa fa-user"></i>
                                    <?php echo esc_html__('My Account', 'noo-organici'); ?>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if ( noo_organici_get_option('noo_header_nav_icon_wishlist', false) == true ) : ?>
                            <li class="menu-item fly-right">
                                <a href="<?php echo get_page_link( get_option('yith_wcwl_wishlist_page_id') ); ?>"><i class="fa fa-heart-o"></i>
                                    <?php echo esc_html__('Wishlist', 'noo-organici'); ?>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php 
                                if(defined('WOOCOMMERCE_VERSION') && noo_organici_get_option( 'noo_header_nav_icon_cart', true )){
                                    echo noo_organici_minicart();
                                }
                            ?>
                            <?php
                            if ( noo_organici_get_option('noo_header_nav_icon_search', true) == true && $header_style != 'header3' ): ?>
                             <li class="menu-item fly-right">
                                <a id="noo-search" class="search-button noo-search" href="#"><i class="fa fa-search"></i> <span><?php echo esc_html__('Search', 'noo-organici'); ?></span></a>
                             </li>
                            <?php endif; ?>
                        </ul>
                        <?php if( $header_style == 'header3' ): ?>
                            <a href="#" class="button-menu-extend"><i class="fa fa-bars"></i></a>
                        <?php endif; ?>
                    </nav>
                    <?php endif; ?>
                    <?php
                        if( $header_style == 'header5' ):
                            $phone = noo_organici_get_option('noo_header_top_phone');
                    ?>
                    <nav class="noo-header-anchor">
                       <ul>
                            <?php if( isset($phone) && !empty($phone) ): ?>
                            <li>
                                <div>
                                    <span><?php esc_html_e( 'CALL US NOW', 'noo-organici' ); ?></span>
                                    <a href="tel:<?php echo str_replace(' ', '', esc_attr($phone)) ?>"><?php echo esc_html($phone) ?></a>
                                </div>
                                <div>
                                    <span><i class="fa fa-phone"></i></span>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php
                            if(defined('WOOCOMMERCE_VERSION') && noo_organici_get_option('noo_header_nav_icon_cart',false)):
                                global $woocommerce;
                            ?>
                            <li>
                                <div>
                                    <a href="<?php echo esc_url($woocommerce->cart->get_cart_url());?>">
                                    <span class="has-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        <em><?php echo $woocommerce->cart->cart_contents_count; ?></em>
                                    </span>
                                    </a>
                                </div>
                                <div>
                                    <a href="<?php echo esc_url($woocommerce->cart->get_cart_url());?>"><span><?php esc_html_e( 'MY CART', 'noo-organici' ); ?></span></a>
                                    <span class="price"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>     
                    </nav>
                    <?php endif; ?>
                    <?php if( $header_style != 'header6' ): ?>
                    <nav class="pull-right noo-main-menu">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container'      => false,
                                'menu_class'     => 'nav-collapse navbar-nav',
                                'fallback_cb'    => 'noo_notice_set_menu',
                                'walker'         => new noo_organici_megamenu_walker
                            ) );
                        ?>
                    </nav>
                    <?php else: ?>
                    <nav class="noo-main-menu noo-left-menu">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'left-menu',
                                'container'      => false,
                                'menu_class'     => 'nav-collapse navbar-nav',
                                'fallback_cb'    => 'noo_notice_set_menu',
                                'walker'         => new noo_organici_megamenu_walker
                            ) );
                        ?>
                    </nav>
                    <nav class="noo-main-menu noo-right-menu">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'right-menu',
                                'container'      => false,
                                'menu_class'     => 'nav-collapse navbar-nav',
                                'fallback_cb'    => 'noo_notice_set_menu',
                                'walker'         => new noo_organici_megamenu_walker
                            ) );
                        ?>
                    </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="search-header5">
        <div class="remove-form"></div>
        <div class="noo-container">
            <?php echo noo_organici_search_form(); ?>
        </div>
    </div>
</header>
<?php if( $header_style != 'header2' && $header_style != 'header4' && $header_style != 'header6' ): ?>
    <?php if( $header_style == 'header5' ): ?>
        <div class="res-bar head5"></div>
    <?php else: ?>
        <div class="res-bar"></div>
    <?php endif; ?>
<?php endif; ?>




