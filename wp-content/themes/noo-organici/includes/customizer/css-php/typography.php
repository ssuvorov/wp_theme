<?php
// Use Custom Headings Font
$noo_typo_use_custom_headings_font = noo_organici_get_option( 'noo_typo_use_custom_headings_font', false );
// Use Custom Body Font
$noo_typo_use_custom_body_font     = noo_organici_get_option( 'noo_typo_use_custom_body_font', false );

if( $noo_typo_use_custom_headings_font ) :
    $noo_typo_headings_uppercase = noo_organici_get_option( 'noo_typo_headings_uppercase', false );
    $noo_typo_text_transform = !empty( $noo_typo_headings_uppercase ) ? 'uppercase' : 'none';
    $noo_typo_headings_font = noo_organici_get_option( 'noo_typo_headings_font', noo_organici_get_theme_default( 'headings_font_family' ) );
    $noo_typo_headings_font_color =  noo_organici_get_option( 'noo_typo_headings_font_color', noo_organici_get_theme_default( 'headings_color' ) );
?>
    /* Headings */
    /* ====================== */
    h1, h2, h3, h4, h5, h6,
    .h1, .h2, .h3, .h4, .h5, .h6 {
        font-family:    "<?php echo esc_html( $noo_typo_headings_font ); ?>", sans-serif;
        color:          <?php echo esc_html( $noo_typo_headings_font_color ); ?>;
        text-transform: <?php echo esc_html( $noo_typo_text_transform ); ?>;
    }
    .blog-item .blog-quote cite,
    .defaultCountdown,
    .woocommerce-wishlist table.wishlist_table th,
    .woocommerce-cart table.cart th,
    .noo-countdown-product.style_white h3{
        font-family:    "<?php echo esc_html( $noo_typo_headings_font ); ?>", sans-serif;
    }
<?php endif; ?>
<?php
if( $noo_typo_use_custom_body_font ) :
    $noo_typo_body_font = noo_organici_get_option( 'noo_typo_body_font', noo_organici_get_theme_default( 'font_family' ) );
    $noo_typo_body_font_color = noo_organici_get_option( 'noo_typo_body_font_color', noo_organici_get_theme_default( 'text_color' ) );
    $noo_typo_body_font_size = noo_organici_get_option( 'noo_typo_body_font_size', noo_organici_get_theme_default( 'font_size' ) );
?>
    /* Body style */
    /* ===================== */
     body {
        font-family: "<?php echo esc_html( $noo_typo_body_font ); ?>", sans-serif;
        color:        <?php echo esc_html( $noo_typo_body_font_color ); ?>;
        font-size:    <?php echo esc_html( $noo_typo_body_font_size ) . 'px'; ?>;
    }
    .blog-item .blog-quote .content-title,
    .noo-header .menu-position .navbar-nav > li.noo_megamenu > .sub-menu > li .noo_megamenu_widget_area .widget-title,
    .woocommerce .product-grid .noo-product-title .noo-product-action h4,
    .noo-our-story2 .story-bk h2,
    .noo-simple-slider-content h3,
    .wigetized .widget-title,
    div.product-style2 .noo-sh-title h2,
    .woocommerce .product-grid .noo-product-title h3,
    .single-product div.product .entry-summary .product_title,
    body.single .blog-item h1,
    body.single .blog-item h2,
    body.single .blog-item h3,
    body.single .blog-item h4,
    body.single .blog-item h5,
    body.single .blog-item h6,
    .product-masonry .noo-product-table-cell h4,
    .blog-item .blog-description h1, .blog-item .blog-description h3{
        font-family: "<?php echo esc_html( $noo_typo_body_font ); ?>", sans-serif;
    }
<?php endif; ?>