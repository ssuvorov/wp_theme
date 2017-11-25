<?php
// Variables

$noo_site_primary_hover_color       =   noo_organici_get_option( 'noo_site_primary_color', noo_organici_get_theme_default( 'primary_color' ) );

$noo_site_link_color_lighten_10     =   noo_organici_css_lighten( $noo_site_primary_hover_color, '10%' );
$noo_site_link_color_darken_5       =   noo_organici_css_darken( $noo_site_primary_hover_color, '5%' );
$noo_site_link_color_darken_15      =   noo_organici_css_darken( $noo_site_primary_hover_color, '15%' );
$noo_site_link_color_fade_50        =   noo_organici_css_fade( $noo_site_primary_hover_color, '50%' );

?>

/**
 * Heading Custom
 * ==================
 */



h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
.h1 a:hover, .h2 a:hover, .h3 a:hover, .h4 a:hover, .h5 a:hover, .h6 a:hover,
a:hover,
a:focus{
    color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}


.pagination .page-numbers.current,
.pagination a.page-numbers:hover{
    background: <?php echo esc_html($noo_site_primary_hover_color); ?>;
    border-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

.hentry.sticky:after,
#comments #respond .form-submit input:hover{
    background: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

.hentry.sticky{
    border-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

/*
* Design for menu
* ===============================
*/
.noo-header.header-5 .noo-header-anchor ul li div a:hover span,
body.fixed_top .noo-header.header-6.eff .noo-main-menu .navbar-nav li > .sub-menu li a:hover,
body.fixed_top .noo-header.header-4.eff .noo-main-menu .navbar-nav li > .sub-menu li a:hover,
body.fixed_top .noo-header.header-6.eff .noo-main-menu .navbar-nav li > a:hover,
body.fixed_top .noo-header.header-4.eff .noo-main-menu .navbar-nav li > a:hover,
.noo-header.header-6 .noo-main-menu .navbar-nav li > .sub-menu li a:hover,
.noo-header.header-6 .noo-main-menu .navbar-nav li > a:hover,
.noo-header.header-6 .noo-main-menu .navbar-nav li > a:focus,
.noo-header.header-4 .noo-main-menu .navbar-nav li > .sub-menu li a:hover,
.noo-header.header-4 .noo-main-menu .navbar-nav li > a:hover,
.noo-header.header-4 .noo-main-menu .navbar-nav li > a:focus,
.noo-header.header-3 .noo-menu-option ul li:last-child a:hover,
.noo-header.header-3 .noo-menu-option ul li a:hover,
.noo-menu-item-cart .noo-minicart .minicart-body .cart-product .cart-product-details .cart-product-title a:hover,
.noo-menu-item-cart .noo-minicart .minicart-body .cart-product .cart-product-details .cart-product-quantity,
.noo-menu-item-cart .cart-item span,
.noo-menu-option ul li a:hover, .noo-menu-option ul li a:focus,
.woocommerce ul.product_list_widget li .amount,
.noo-header .menu-position .navbar-nav > li.noo_megamenu > .sub-menu > li .noo_megamenu_widget_area li a:hover,
.footer-3 .noo-bottom-bar-content i,
.noo-main-menu .navbar-nav li > .sub-menu li a:hover{
	color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
/*
* Shortcode
* ===============================
*/
.woocommerce .product-grid .noo-product-inner:hover .noo-product-title .noo-product-action{
    background-color: <?php echo esc_html($noo_site_link_color_darken_15); ?>;
}
.google-map .noo-address-info-wrap .address-info,
.single-product div.product .woocommerce-tabs .wc-tab #reviews #review_form_wrapper .form-submit input,
.single-product div.product .woocommerce-tabs ul.tabs li:hover,
.woocommerce .product-list .noo-product-title .noo-product-action .add_to_cart_button,
.noo-countdown-product.style_white .noo-product-action .noo-action .add_to_cart_button:hover,
.noo-countdown-product.style_white .noo-product-action .noo-action .yith-wcwl-add-to-wishlist a:hover,
.cube1, .cube2,
.noo-countdown-product.style_white .noo-product-action .noo-action .yith-wcwl-wishlistexistsbrowse a:hover{
	background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

body.single .post-navigation-line .next-post:hover i, body.single .post-navigation-line .next-post:hover a,
.content-meta .single-social .content-share a:hover,
.content-meta .content-tags a:hover,
.content-meta .content-tags span,
.content-meta .single-social .text-share,
.single-product div.product .noo-social-share a:hover,
.widget ul li.current-cat a,
.single-product div.product .entry-summary .price,
.woocommerce .product-list .noo-product-title .price,
.noo_testimonial_wrap.noo_farmer_wrap .noo-testimonial-sync2 .testimonial-content .social a:hover,
.widget_noo_happyhours .widget-title,
.noo-simple-product-slider li .noo-simple-slider-item .n-simple-content .price,
.noo_testimonial_wrap .noo-testimonial-sync2 .testimonial-name .noo_testimonial_name,
.noo-countdown-product .price,
.noo-farmer .noo-farmer-content .social a:hover,
div.product-style2 .product-grid .noo-product-inner .noo-product-title .price,
.quick-view-wrap .quick-content .quick-right .price,
.noo-header-filter li a.selected span,
.noo-header-filter li > span.selected span,
.noo-header-filter li a:hover span,
.noo-header-filter li > span:hover span,
.filter-menu li span.selected, .filter-menu li span:hover,
.noo-menu-content li .product-menu-ds .product-menu-flex .price,
.noo-menu-content li .product-menu-ds .product-menu-flex .p-menu-title a:hover,
.custom_countdown_wrap h4,
.custom_countdown_wrap .price,
.inheader-sh-title h4,
.noo-blog-list li .cat a,
.noo-blog-list li .cat,
.noo_testimonial_wrap .noo-testimonial-sync2.testimonial-three .owl-controls .owl-buttons div:hover,
.woocommerce .noo-catalog .woocommerce-result-count em{
	color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

.woocommerce .product-grid .noo-product-inner:hover .noo-product-thumbnail,
.woocommerce .product-grid .noo-product-inner:hover,
.custom_countdown_wrap .countdown-section{
	border-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

.blog-item .blog-description .view-more,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce a.button.alt,
.woocommerce button.button,
.woocommerce input.button,
.single-product div.product .entry-summary .yith-wcwl-add-to-wishlist a,
.single-product div.product .entry-summary form.cart .button,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.product-style-control span:hover, .product-style-control span.active,
div.product-style2 .product-grid .noo-product-inner .noo-product-title .noo-product-action .noo-action .noo-qucik-view,
div.product-style2 .product-grid .noo-product-inner .noo-product-title .noo-product-action .noo-action .add_to_cart_button,
div.product-style2 .product-grid .noo-product-inner .noo-product-title .noo-product-action .noo-action .yith-wcwl-add-to-wishlist,
div.product-style2 .product-grid .noo-product-inner .noo-product-title .noo-product-action .noo-action .link-detail,
.noo-simple-slider-content .noo-product-action .noo-action .yith-wcwl-add-to-wishlist a:hover,
.noo-simple-slider-content .noo-product-action .noo-action .yith-wcwl-wishlistexistsbrowse a:hover,
.noo-simple-slider-content .noo-product-action .noo-action .add_to_cart_button:hover,
.view_all,
.noo-countdown-product .noo-product-action .noo-action .yith-wcwl-add-to-wishlist a,
.noo-countdown-product .noo-product-action .noo-action .yith-wcwl-wishlistexistsbrowse a,
.owl-theme .owl-controls .owl-page.active span, .owl-theme .owl-controls .owl-page:hover span,
.noo-countdown-product .noo-product-action .noo-action .add_to_cart_button,
.product-list-item .right-img a span:hover em,
.noo-our_story .text-center a,
.noo-represent span a,
.quick-view-wrap .quick-content .quick-right form.cart .button,
.noo-farmer .noo-farmer-thumbnail span.first:before,
.noo-farmer .noo-farmer-thumbnail span.second:before,
.noo-farmer .noo-farmer-thumbnail span.second:after,
.noo-farmer:hover .noo-farmer-content,
.woocommerce .product-grid .noo-product-title .noo-product-action{
	background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

.footer-2 .widget_noo_social .noo_social a:hover,
#comments #respond .form-submit input,
.widget_tag_cloud .tagcloud a:hover,
.widget_product_tag_cloud .tagcloud a:hover,
.woocommerce nav.woocommerce-pagination ul li a.current,
.woocommerce nav.woocommerce-pagination ul li span.current,
.product-masonry .noo-product-table-cell span a:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span:hover{
	background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
	border-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

.single-product div.product .woocommerce-tabs .wc-tab #reviews #review_form_wrapper .form-submit input:hover,
.woocommerce .product-list .noo-product-title .noo-product-action .add_to_cart_button:hover,
.single-product div.product .entry-summary .yith-wcwl-add-to-wishlist a:hover,
.single-product div.product .entry-summary form.cart .button:hover,
.single-product div.product .entry-summary .yith-wcwl-add-to-wishlist a:hover,
.single-product div.product .entry-summary form.cart .button:hover,
.woocommerce #respond input#submit:hover, .woocommerce a.button:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.noo-countdown-product .noo-product-action .noo-action .yith-wcwl-add-to-wishlist a:hover,
.noo-countdown-product .noo-product-action .noo-action .yith-wcwl-wishlistexistsbrowse a:hover,
.noo-countdown-product .noo-product-action .noo-action .add_to_cart_button:hover,
.view_all:hover,
.noo-our_story .text-center a:hover,
.noo-represent span a:hover{
	background-color: <?php echo esc_html($noo_site_link_color_darken_15); ?>;
}

.noo-button-creative a span.first{
    background: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-button-creative a span.second:before{
    border-left: 27px solid <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-button-creative a span.second:after{
    border-right: 27px solid <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-button-creative a .three,
.noo-button-creative a{
    background: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-button-creative a .three:before,
.noo-button-creative a span.first:before{
    border-top: 17.5px solid <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-button-creative a .three:after,
.noo-button-creative a span.first:before{
    border-bottom: 17.5px solid <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-button-creative a .four:before{
    border-bottom: 8px solid <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-button-creative a .four:after,
.noo-button-creative a .four:after{
    border-top: 8px solid <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-line .line-one{
    border-color: <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
}
.noo-line .line-one span:first-child:before{
    border: 1px solid <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
}
.noo-line .line-one span:last-child:before,
.noo-line .line-two span:first-child:before,
.noo-line .line-two span:last-child:before{
    border: 1px solid <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
}
.noo-line .line-two{
    border-color: <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
}
/**
 * Blog
 * ======================
 */
body.single .content-meta .content-tags a:hover,
body.single .content-meta .single-social .content-share a:hover,
body.single .content-meta .single-social .text-share,
body.single .content-meta .content-tags span,
body.single .post-navigation-line .prev-post:hover i,
body.single .post-navigation-line .prev-post:hover a,
body.single #author-bio .author-social a:hover,
.blog-item .blog-quote cite,
.blog-item .blog-description .cat a:hover,
.blog-item:hover .blog-description h3 a,
.blog-item .blog-description .meta a:hover,
.blog-item:hover .blog-description h3 a{
	color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.widget_calendar table td#today, .widget_calendar table th#today,
.noo-slider .slider-indicators a.selected, .noo-slider .slider-indicators a:hover{
	background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.mailchimp-widget .mc-subscribe-form button,
.btn-primary{
	background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
	border-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

.blog-item:hover .blog-description .view-more,
.mailchimp-widget .mc-subscribe-form button:focus,
.mailchimp-widget .mc-subscribe-form button.focus,
#comments #respond .form-submit input:focus,
#comments #respond .form-submit input.focus,
#comments #respond .form-submit input:hover,
.mailchimp-widget .mc-subscribe-form button:hover,
.btn-primary:active:hover,
.btn-primary.active:hover,
.open > .dropdown-toggle.btn-primary:hover,
.btn-primary:active:focus,
.btn-primary.active:focus,
.open > .dropdown-toggle.btn-primary:focus,
.btn-primary:active.focus,
.btn-primary.active.focus,
.open > .dropdown-toggle.btn-primary.focus,
.btn-primary:focus,
.btn-primary.focus,
.btn-primary:hover{
	background-color: <?php echo esc_html($noo_site_link_color_darken_15); ?>;
	border-color: <?php echo esc_html($noo_site_link_color_darken_15); ?>;
}

@keyframes preload_audio_wave {
0% {height:5px;transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
25% {height:30px;transform:translateY(15px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
50% {height:5px;transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
100% {height:5px;transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
}
@-webkit-keyframes preload_audio_wave {
0% {height:5px;-webkit-transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
25% {height:30px;-webkit-transform:translateY(15px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
50% {height:5px;-webkit-transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
100% {height:5px;-webkit-transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
}

@-moz-keyframes preload_audio_wave {
0% {height:5px;-moz-transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
25% {height:30px;-moz-transform:translateY(15px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
50% {height:5px;-moz-transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
100% {height:5px;-moz-transform:translateY(0px);background:<?php echo esc_html($noo_site_primary_hover_color); ?>;}
}

/**
 * Footer
 * ============
 */
.noo-footer-shop-now .noo-show-now:hover em{
	background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-footer-shop-now:before{
	background-color: <?php echo esc_html( noo_organici_css_fade( $noo_site_link_color_darken_15, '80%' ) ); ?>;
}
.footer-2 .widget.widget_text .copyright i,
.footer-4 .widget_noo_social .noo_social a:hover,
.footer-4 .noo-bottom-bar-content i,
.footer-3 .widget ul li a:hover,
.widget ul li a:hover,
.wrap-footer a:hover{
	color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}

/**
 * WooCommerce
 * ====================
 */
.single-product div.product .entry-summary .noo_link_boxes > li > a:hover,
.woocommerce-checkout #payment #place_order,
.woocommerce-checkout form.checkout_coupon input[type='submit'],
.woocommerce-page .cart-collaterals .cart_totals .wc-proceed-to-checkout a.checkout-button,
.woocommerce-cart table.cart th,
.woocommerce-cart table.cart .actions .continue:hover,
.woocommerce-wishlist table.wishlist_table th{
	background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.woocommerce-checkout .order_review_wrap #order_review table.shop_table tfoot .order-total .amount,
.woocommerce-checkout .woocommerce-info a,
.woocommerce-page .cart-collaterals .cart_totals table .order-total .amount{
	color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.single-product div.product .images .project-slider .sync2 .item:hover,
.woocommerce-checkout .order_review_wrap{
	border-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-sh-mailchimp .mc4wp-form-fields input[type="submit"]{
    background-color: <?php echo esc_html($noo_site_primary_hover_color); ?>;
}
.noo-sh-mailchimp .mc4wp-form-fields input[type="submit"]:hover{
    background-color: <?php echo esc_html($noo_site_link_color_darken_15); ?>;
}

/**
* Bakery
* ====================
*/
<?php if( $noo_site_primary_hover_color == '#f5a64a' ): ?>
    .noo-services-columns li .line-top,
    .noo-services-columns li .line-left{
        background-color: #f4eede;
    }
    .noo-services-columns li .line-top span:first-child:before,
    .noo-services-columns li .line-left span:last-child:before,
    .noo-services-columns li .line-top span:last-child:before,
    .noo-services-columns li .line-left span:first-child:before{
        border: 10px solid #f4eede;
    }
    .noo-instagram .noo-instagram-info{
        background-color: #f4eede;
    }
    .noo-instagram .noo-instagram-info .noo-line .line-one {
        border-color: <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
    }
    .noo-instagram .noo-instagram-info .noo-line .line-one span:first-child:before,
    .noo-instagram .noo-instagram-info .noo-line .line-one span:last-child:before {
        border-color: <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
    }
    .noo-instagram .noo-instagram-info .noo-line .line-two {
        border-color: <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
    }
    .noo-instagram .noo-instagram-info .noo-line .line-two span:first-child:before,
    .noo-instagram .noo-instagram-info .noo-line .line-two span:last-child:before {
        border-color: <?php echo esc_attr($noo_site_link_color_fade_50) ?>;
    }
    .noo-instagram .noo-instagram-info .noo-instagram-table .instagram-sh-title h4{
        color: #ababab;
    }
    .noo-instagram .noo-instagram-info .noo-instagram-table .instagram-sh-title p{
        color: #696969;
    }
    .noo-instagram .noo-instagram-info .noo-instagram-table .instagram-sh-title .on-instagram i{
        color: #696969;;
    }
    .noo-instagram .noo-instagram-info .noo-instagram-table .instagram-sh-title .on-instagram span{
        color: #c2bdb0;
    }
    .noo-instagram .noo-instagram-info .noo-instagram-table .instagram-sh-title .on-instagram span a{
        color: <?php echo esc_attr($noo_site_primary_hover_color); ?>
    }
<?php endif; ?>