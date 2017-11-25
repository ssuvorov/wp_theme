jQuery( document ).ready( function () {
    "use strict";

	// Search button
	jQuery('.noo-search').click(function(){
	    jQuery('.search-header5').fadeIn(1).addClass('search-header-eff');
	    jQuery('.search-header5').find('input[type="search"]')
	    	.val('')
	    	.attr('placeholder', '')
	    	.select();
	   return false;
    });
	jQuery('.remove-form').click(function(){
	    jQuery('.search-header5').fadeOut(1).removeClass('search-header-eff');
	});

    jQuery('.button-menu-extend').click(function(){
        jQuery('.noo-menu-extend-overlay').fadeIn(1, function(){
            jQuery('.noo-menu-extend').addClass('show');    
        }).addClass('show');
        return false;
    });
    jQuery('.menu-closed, .noo-menu-extend-overlay').click(function(){
        jQuery('.noo-menu-extend-overlay').removeClass('show').hide();
        jQuery('.noo-menu-extend').removeClass('show');
    });

	// scroll height
	if ( jQuery('body').hasClass('fixed_top') ) {	    



	    jQuery(window).scroll(function(){
            var $resTopbar = 0;
            if ( jQuery('.noo-topbar').length > 0 ){
                var $heightTopbar = jQuery('.noo-topbar').height();
                $resTopbar = '-'+$heightTopbar+'px';
            }
            var $heightBar = jQuery('header').height();
            if ( jQuery('.header-5').length > 0 ){
                if ( jQuery(window).width() < 992 ) {
                    $resTopbar = '144px';
                } else {
                    $heightBar = 200;
                }
            }

            var $top = jQuery(window).scrollTop();
            if( $top <= $heightBar ){
                if (jQuery('header').hasClass('eff')) {
                    if ( jQuery('.header-6').length > 0 ){
                        jQuery('header').css('marginTop', '25px').removeClass('eff');
                    } else {
                        jQuery('header').css('marginTop', 0).removeClass('eff');
                    }
                }
            } else{
                if (!jQuery('header').hasClass('eff')) {
                    jQuery('header').css('marginTop', '-150px').animate({'marginTop': $resTopbar}, 400);
                    jQuery('header').addClass('eff');
                }
            }
	    });
	}

    // resize window
    resize_window();
    jQuery( window ).resize(function() {
        "use strict";
        resize_window();
    });
    function resize_window() {

        "use strict";
        // header-1
        if ( jQuery('.header-1').length > 0 ) {
            if ( jQuery( window ).width() < 1500 ) {
                if ( jQuery('header').find('.noo-menu-option').find('li').length > 0 )
                    jQuery('header').find('.noo-menu-option').addClass('collapse');
            } else {
                jQuery('header').find('.noo-menu-option').removeClass('collapse');
            }
        }
        // header-3
        if ( jQuery('.header-3').length > 0 ) {
            if ( jQuery( window ).width() < 1300 ) {
                if ( jQuery('header').find('.noo-menu-option').find('li').length > 0 )
                    jQuery('header').find('.noo-menu-option').addClass('collapse');
            } else {
                jQuery('header').find('.noo-menu-option').removeClass('collapse');
            }
        }
    }
    
    jQuery('#off-canvas-nav li.menu-item-has-children').append('<i class="fa fa-angle-down"></i>');
    jQuery('#off-canvas-nav li.menu-item-has-children i').on("click", function (e) {
        var link_i = jQuery(this); //preselect the link
        link_i.prev().slideToggle(300);
        link_i.parent().toggleClass('active');
    });


    //  -   IS MOBILE ?? 
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
    {
       
        jQuery('.navbar-nav').find('.menu-item-has-children').find('a').on("touchstart", function (e) {
            "use strict"; //satisfy the code inspectors
            var link = jQuery(this); //preselect the link
            if (link.hasClass('hover')) {
                return true;
            } else {
                link.addClass("hover");
                jQuery('.navbar-nav').find('.menu-item-has-children').find('a').not(this).removeClass("hover");
                e.preventDefault();
                return false; //extra, and to make sure the function has consistent return points
            }
        }); 

    }

});
