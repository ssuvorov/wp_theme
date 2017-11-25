    <?php
        if( !is_page_template('page-full-width.php') ) {
            $noo_footer_top_content = noo_organici_get_option( 'noo_footer_top_content', '' );
             echo noo_organici_html_content_filter($noo_footer_top_content);
        }
    ?>
    <?php
        $num = ( noo_organici_get_option( 'noo_footer_widgets', '4' ) == '' ) ? '4' : noo_organici_get_option( 'noo_footer_widgets', '4' );
        $noo_bottom_bar_content = noo_organici_get_option( 'noo_bottom_bar_content', '&copy; 2016. Designed with <i class="fa fa-heart text-primary" ></i> by NooTheme' );

        $footer_style = noo_organici_get_option('noo_footer_style','footer2');
        if( is_page() ) {
            $footer_page = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_footer_style');
            if( !empty( $footer_page ) && $footer_page != 'footer' ){
                $footer_style = $footer_page;
            }
        }

        $class = '';

        $url_img = '';
        if ( $footer_style == 'footer2' ) {
            $url_img = noo_organici_get_option( 'noo_footer_style2_background', '' );
        }
        if ( $footer_style == 'footer4' ) {
            $url_img = noo_organici_get_option( 'noo_footer_style4_background', '' );
        }
    ?>
    <footer class="wrap-footer <?php noo_organici_footer_class(); ?>" style="background-image: url(<?php echo esc_url($url_img); ?>);">
        <div class="noo-container">
            <div class="noo-row">
                <div class="noo-md-12">
                    <div class="sidebar-right-footer">
                        <!--div class="sidebar-top-footer">
                            <?php //if( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-top-footer') ): ?>
                            <?php //else : ?>
                                <aside class="widget">
                                    <h3 class="widget-title"><?php //echo esc_html__('Footer Top','noo-organici'); ?></h3>
                                    <a class="demo-widgets" href="<?php //echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php //echo esc_html__( 'Click here to add your widgets', 'noo-organici' ); ?></a>
                                </aside>
                            <?php //endif; ?>
                        </div-->
                        <?php if ( $num != 0 && $footer_style != 'footer4') : ?>
                        <!--Start footer widget-->
                        <div class="colophon wigetized">
                            <div class="noo-container">
                                <div class="noo-row">
                                    <?php

                                    $i = 0; while ( $i < $num ) : $i ++;
                                        switch ( $num ) {
                                            case 4 : $class = 'noo-md-3 noo-sm-6 item-footer-four';  break;
                                            case 3 :
                                                $class = 'noo-md-4 noo-sm-4';
                                                break;
                                            case 2 : $class = 'noo-md-6 noo-sm-12';  break;
                                            case 1 : $class = 'noo-md-12'; break;
                                        }
                                        ?>
                                        <div class="<?php echo esc_attr($class); ?>">
                                        <?php
                                            if( function_exists('dynamic_sidebar') && dynamic_sidebar( 'noo-footer-' . esc_attr($i) ) ):
                                            else:
                                        ?>
                                            <aside class="widget">
                                                <h4 class="widget-title">Footer <?php echo esc_attr($i); ?></h4>
                                                <a class="demo-widgets" href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php echo esc_html__( 'Click here to add your widgets', 'noo-organici' ); ?></a>
                                            </aside>
                                        <?php endif; ?>
                                        </div>
                                        <?php
                                    endwhile;
                                    ?>
                                </div>
  <div class="socialicon">
    
    <ul>
     
    
   
   
   
    <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/fb_icon.png"></a></li>
     <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/g_bg.png"></a></li>
     <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/p_bg.png"></a></li>
     <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/r_bg.png"></a></li>
    <li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/t_bg.png"></a></li> 
<li><a href="#"><img src="http://stage.lavegando.com:81/wp-content/uploads/2015/12/in_bg.png"></a></li></ul>
</div>
                            </div>
                        </div>
                        <!--End footer widget-->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ( $footer_style != 'footer2' ) : ?>
            <?php if ( !empty( $noo_bottom_bar_content ) ) : ?>
                <div class="noo-bottom-bar-content">
                   <div class="noo-container">
                        <?php if ( $footer_style == 'footer4' ) : ?>
                        <div class="pull-left nav-footer">
                            <?php
                                $footer_nav_menu = noo_organici_get_option( 'noo_footer_nav_menu', 0 );
                                if ($footer_nav_menu > 0)
                                    wp_nav_menu( array('menu' => $footer_nav_menu ));
                            ?>
                        </div>
                        <div class="pull-right">
                           <?php echo noo_organici_html_content_filter($noo_bottom_bar_content); ?>
                        </div>
                        <?php else: ?>
                            <?php echo noo_organici_html_content_filter($noo_bottom_bar_content); ?>
                        <?php endif; ?>
                   </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </footer>

    <!-- For header 3 Extend Menu -->
    <?php
        $header_style = noo_organici_get_option('noo_header_nav_style','header1');
        if( is_page() ) {
            $header_page = noo_organici_get_post_meta(get_the_ID(),'_noo_wp_page_header_style');
            if( !empty( $header_page ) && $header_page != 'header' ){
                $header_style = $header_page;
            }
        }
        if ($header_style == 'header3') : ?>
        <div class="noo-menu-extend">
            <div class="menu-extend-wrap">
                <span class="menu-closed"></span>
                <?php dynamic_sidebar( 'sidebar-secondary'); ?>
            </div>
        </div>
        <div class="noo-menu-extend-overlay"></div>
    <?php
        endif;
    ?>

</div>
<!--End .site -->


<?php wp_footer(); ?>
<?php if(!is_page(1339)): ?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/modernizr.custom.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/masonry.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/imagesloaded.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/classie.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/AnimOnScroll.js"></script>
<script>
	new AnimOnScroll( document.getElementById( 'grid' ), {
		minDuration : 0.4,
		maxDuration : 0.7,
		viewportFactor : 0.2
	});
</script>
<?php endif; ?>
<script>
// load more recipe post
			
jQuery("#movetorate").appendTo("#fromrate");
jQuery("#movetoprint").appendTo("#fromprint");
				
</script>
</body>
</html>
<script>
	jQuery(document).ready(function(){
 
   jQuery("#search_form1").hide();
 
});

	</script>
	<script>
jQuery( "#search_icon" ).click(function() {
   jQuery("#search_form1").slideToggle('slow');
    
});
</script>