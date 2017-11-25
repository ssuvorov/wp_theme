<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<!--<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
-->
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

<?php
if ( function_exists('wp_site_icon') ) :
    wp_site_icon();
elseif ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :
    $favicon = noo_organici_get_image_option('noo_custom_favicon', '');
    if ($favicon != ''): ?>
        <!-- Favicon-->
        <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>"/>
    <?php
    endif;
endif;
?>

<?php wp_head(); ?>
<link href='wp-content/themes/noo-organici/assets/css.css' rel='stylesheet' type='text/css'>
<link href='wp-content/themes/noo-organici/assets/css/component.css' rel='stylesheet' type='text/css'>
</head>
<body <?php body_class(); ?>>
    <?php $loading = noo_organici_get_option('noo_css_loading',1);
        if( $loading == 1 ):
    ?>
    <div class="noo-spinner">
        <div class="spinner">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>
    <?php endif; ?>
	<div class="site">
    <div class="social_icon">
    <div class="socialicon">

    <ul>

    <li><a href="#"><img style='width:100%;' border="0"style='width:100%;' border="0"  src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/fb_icon.png"></a></li>
     <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/g_bg.png"></a></li>
     <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/p_bg.png"></a></li>
     <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/r_bg.png"></a></li>
    <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/t_bg.png"></a></li>
<li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/in_bg.png"></a></li>
<li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/youtube.png"></a></li>
<li><a href="#"><div class="language_switcher"><?php dynamic_sidebar('[smk_sidebar_3w0z]');?>
</div>
</a></li>
<li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/search_icon.png" id="search_icon"></a></li>
 <div id="search_form1"><?php echo noo_organici_search_form(); ?></div>
</ul>
    </div>



    </div>


	<?php noo_organici_get_layout('navbar'); ?>
    <?php noo_organici_get_layout( 'heading' ); ?>


