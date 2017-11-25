<?php

// Header attr
$noo_header_fix_logo_image_height =     noo_organici_get_option( 'noo_header_fix_logo_image_height', false );
$noo_header_logo_image_height     =     noo_organici_get_option( 'noo_header_logo_image_height', '40' );
$noo_header_nav_height            =     noo_organici_get_option( 'noo_header_nav_height', '80' );
$noo_header_nav_link_spacing      =     noo_organici_get_option( 'noo_header_nav_link_spacing', 20);
$noo_site_primary_hover_color     =     noo_organici_get_option( 'noo_site_primary_color', noo_organici_get_theme_default( 'primary_color' ) );

// logo text
$noo_header_use_image_logo    =     noo_organici_get_option( 'noo_header_use_image_logo', false );
$noo_header_logo_font         =     noo_organici_get_option( 'noo_header_logo_font', noo_organici_get_theme_default( 'logo_font_family' ) );
$noo_header_logo_font_size    =     noo_organici_get_option( 'noo_header_logo_font_size', '30' );
$noo_header_logo_font_color   =     noo_organici_get_option( 'noo_header_logo_font_color', noo_organici_get_theme_default( 'logo_color' ) );
$noo_header_logo_uppercase    =     noo_organici_get_option( 'noo_header_logo_uppercase', false ) ? 'uppercase': 'normal';
// Navigation
$noo_header_custom_nav_font   =     noo_organici_get_option( 'noo_header_custom_nav_font', false );


if ( $noo_header_custom_nav_font ):
    $noo_header_nav_font          =     noo_organici_get_option( 'noo_header_nav_font', noo_organici_get_option( 'noo_typo_body_font', noo_organici_get_theme_default( 'font_family' ) ) );
    $noo_header_nav_color         =     noo_organici_get_option( 'noo_header_nav_link_color', '' );
    $noo_header_nav_hover_color   =     noo_organici_get_option( 'noo_header_nav_link_hover_color', '');
    $noo_header_nav_font_size     =     noo_organici_get_option( 'noo_header_nav_font_size', 16 );
    $noo_header_nav_uppercase     =     noo_organici_get_option( 'noo_header_nav_uppercase', false ) ? 'uppercase': 'none';
?>
    /*
    * Typography for menu
    * ===============================
    */
    header .noo-main-menu .navbar-nav li > a{
        font-family:     "<?php echo esc_html( $noo_header_nav_font ); ?>", sans-serif;
        font-size:       <?php echo esc_attr( $noo_header_nav_font_size ) . 'px'; ?>;
        text-transform:  <?php echo esc_attr( $noo_header_nav_uppercase ) ; ?>;
        <?php if ( $noo_header_nav_color != '' ): ?>
            color: <?php echo esc_attr( $noo_header_nav_color ) ; ?>;
        <?php endif; ?>
    }

    .noo-header .menu-position .navbar-nav > li.noo_megamenu > .sub-menu > li > a,
    .noo-header .menu-position .navbar-nav > li.noo_megamenu > .sub-menu > li .noo_megamenu_widget_area li a,
    .noo-header .menu-position .navbar-nav > li.noo_megamenu > .sub-menu > li .noo_megamenu_widget_area .widget-title{
        font-size:       <?php echo esc_attr( $noo_header_nav_font_size + 2 ) . 'px'; ?>;
    }

    <?php if ( $noo_header_nav_color != '' ): ?>
    header .noo-main-menu .navbar-nav li > a:hover,
    header .noo-main-menu .navbar-nav li > a:focus,
    header .noo-main-menu .navbar-nav li > a:active{
        color: <?php echo esc_attr( $noo_site_primary_hover_color ) ; ?>;
    }
    header .noo-main-menu .navbar-nav li > .sub-menu li a:hover{
        color: <?php echo esc_attr( $noo_site_primary_hover_color ) ; ?>;
    }    
    <?php endif; ?>

    <?php if ( $noo_header_nav_hover_color != '' ): ?>
    header .noo-main-menu .navbar-nav li > a:hover,
    header .noo-main-menu .navbar-nav li > a:focus,
    header .noo-main-menu .navbar-nav li > a:active{
        color: <?php echo esc_attr( $noo_header_nav_hover_color ) ; ?>;
    }
    .noo-header .menu-position .navbar-nav > li.noo_megamenu > .sub-menu > li .noo_megamenu_widget_area li a:hover,
    header .noo-main-menu .navbar-nav li > .sub-menu li a:hover{
        color: <?php echo esc_attr( $noo_header_nav_hover_color ) ; ?>;
    }
    <?php endif; ?>
    
    .noo-header .menu-position .navbar-nav > li.noo_megamenu > .sub-menu > li .noo_megamenu_widget_area .widget-title{    
        font-family: "<?php echo esc_html($noo_header_nav_font); ?>", sans-serif;
    }
<?php endif; ?>

    /*
    * Alignment for menu
    * ===============================
    */
    header .noo-main-menu .navbar-nav li > a{
        padding-left:    <?php echo esc_attr( $noo_header_nav_link_spacing ).'px'; ?>;
        padding-right:   <?php echo esc_attr( $noo_header_nav_link_spacing ).'px'; ?>;
        line-height:     <?php echo esc_attr( $noo_header_nav_height ).'px'; ?>;
    }

    /*
    * Typography for Logo text
    * ===============================
    */
   <?php if ( $noo_header_fix_logo_image_height ) : ?>
    header .navbar-brand .noo-logo-img{
        height: <?php echo esc_attr( $noo_header_logo_image_height ). 'px'; ?>;
    }
    <?php endif; ?>
    header .navbar{
        min-height: <?php echo esc_attr( $noo_header_nav_height ).'px'; ?>;
    }
    header .navbar-brand{
        line-height: <?php echo esc_attr( $noo_header_nav_height ).'px'; ?>;
        <?php if( $noo_header_use_image_logo == false): ?>
            font-family:    <?php echo esc_attr( $noo_header_logo_font ); ?>, sans-serif;
            font-size:      <?php echo esc_attr( $noo_header_logo_font_size ) .'px'; ?>;
            color:          <?php echo esc_attr( $noo_header_logo_font_color ); ?>;
            text-transform: <?php echo esc_attr( $noo_header_logo_uppercase ); ?>;
        <?php endif; ?>
    }
    header .noo-menu-option ul li a{
        line-height: <?php echo esc_attr( $noo_header_nav_height ).'px'; ?>;
    }