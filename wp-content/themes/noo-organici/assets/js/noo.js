/*!
 * NOO Site Script.
 *
 * Javascript used in NOO-Framework
 * This file contains base script used on the frontend of NOO theme.
 *
 * @package    NOO Framework
 * @subpackage NOO Site
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */
// =============================================================================


;(function($){
	"use strict";	
	var nooGetViewport = function() {
	    var e = window, a = 'inner';
	    if (!('innerWidth' in window )) {
	        a = 'client';
	        e = document.documentElement || document.body;
	    }
	    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	};
	
	$.fn.nooLoadmore = function(options,callback){
		var defaults = {
				contentSelector: null,
				contentWrapper:null,
				nextSelector: "div.navigation a:first",
				navSelector: "div.navigation",
				itemSelector: "div.post",
				dataType: 'html',
				finishedMsg: "<em>Congratulations, you've reached the end of the internet.</em>",
				loading:{
					speed:'fast',
					start: undefined
				},
				state: {
			        isDuringAjax: false,
			        isInvalidPage: false,
			        isDestroyed: false,
			        isDone: false, // For when it goes all the way through the archive.
				    isPaused: false,
				    isBeyondMaxPage: false,
				    currPage: 1
				}
		};
		var options = $.extend(defaults, options);
		
		return this.each(function(){
			var self = this;
			var $this = $(this),
				wrapper = $this.find('.loadmore-wrap'),
				action = $this.find('.loadmore-action'),
				btn = action.find(".btn-loadmore"),
				loading = action.find('.loadmore-loading');
			
			options.contentWrapper = options.contentWrapper || wrapper;
			
			
				
			var _determinepath = function(path){
				if (path.match(/^(.*?)\b2\b(.*?$)/)) {
	                path = path.match(/^(.*?)\b2\b(.*?$)/).slice(1);
	            } else if (path.match(/^(.*?)2(.*?$)/)) {
	                if (path.match(/^(.*?page=)2(\/.*|$)/)) {
	                    path = path.match(/^(.*?page=)2(\/.*|$)/).slice(1);
	                    return path;
	                }
	                path = path.match(/^(.*?)2(.*?$)/).slice(1);
	
	            } else {
	                if (path.match(/^(.*?page=)1(\/.*|$)/)) {
	                    path = path.match(/^(.*?page=)1(\/.*|$)/).slice(1);
	                    return path;
	                } else {
	                	options.state.isInvalidPage = true;
	                }
	            }
				return path;
			}
			if(!$(options.nextSelector).length){
				return;
			}
			
			
			// callback loading
			options.callback = function(data, url) {
	            if (callback) {
	                callback.call($(options.contentSelector)[0], data, options, url);
	            }
	        };
	        
	        options.loading.start = options.loading.start || function() {
				 	btn.hide();
	                $(options.navSelector).hide();
	                loading.show(options.loading.speed, $.proxy(function() {
	                	loadAjax(options);
	                }, self));
	         };
			
			var loadAjax = function(options){
				var path = $(options.nextSelector).attr('href');
					path = _determinepath(path);
				
				var callback=options.callback,
					desturl,frag,box,children,data;
				
				options.state.currPage++;
				// Manually control maximum page
	            if ( options.maxPage !== undefined && options.state.currPage > options.maxPage ){
	            	options.state.isBeyondMaxPage = true;
	                return;
	            }
	            desturl = path.join(options.state.currPage);
	            box = $('<div/>');
	            box.load(desturl + ' ' + options.itemSelector,undefined,function(responseText){
	            	children = box.children();
	            	if (children.length === 0) {
	            		//loading.hide();
	            		btn.hide();
	            		action.append('<div style="margin-top:5px;">' + options.finishedMsg + '</div>').animate({ opacity: 1 }, 2000, function () {
	            			action.fadeOut(options.loading.speed);
	                    });
	                    return ;
	                }
	            	frag = document.createDocumentFragment();
	                while (box[0].firstChild) {
	                    frag.appendChild(box[0].firstChild);
	                }
	                $(options.contentWrapper)[0].appendChild(frag);
	                data = children.get();
	                loading.hide();
	                btn.show(options.loading.speed);
	                options.callback(data);
	               
	            });
			}
			
			
			btn.on('click',function(e){
				 e.stopPropagation();
				 e.preventDefault();

				 options.loading.start.call($(options.contentWrapper)[0],options);
			});
		});
	};
	

	


	var nooInit = function() {
		
		//Enable swiping...
		var isTouch = 'ontouchstart' in window;
		if(isTouch){
			if ( $(".carousel-inner").length > 0 ) {
				$(".carousel-inner").swipe( {
					//Generic swipe handler for all directions
					swipeLeft: function(event, direction, distance, duration, fingerCount) {
						$(this).parent().carousel('prev');
					},
					swipeRight: function(event, direction, distance, duration, fingerCount) {
						$(this).parent().carousel('next');
					},
					//Default is 75px, set to 0 for demo so any distance triggers swipe
					threshold:0
				}); 
			}
		}
		if($( '.navbar' ).length){
			var $window = $( window );
			var $body   = $( 'body' ) ;
			var navTop = $( '.navbar' ).offset().top;
			var adminbarHeight = 0;
			if ( $body.hasClass( 'admin-bar' ) ) {
				adminbarHeight = $( '#wpadminbar' ).outerHeight();
			}
			var lastScrollTop = 0,
				navHeight = 0,
				defaultnavHeight = 70;
			

			// if (nooGetViewport().height >= 320){
			//     $(window).resize(adjustModalMaxHeightAndPosition).trigger("resize");
			// }
			
			var navbarInit = function () {
				if(nooGetViewport().width > 992){
					var $this = $( window );
					var $navbar = $( '.navbar' ),
					navHeight = $navbar.outerHeight();
					if ( $navbar.hasClass( 'fixed-top' ) ) {
						var navFixedClass = 'navbar-fixed-top';
						if( $navbar.hasClass( 'shrinkable' )  && !$body.hasClass('one-page-layout')) {
							navFixedClass += ' navbar-shrink';
						}
			
						var checkingPoint = navTop;
						if ( ($this.scrollTop() + adminbarHeight) >= checkingPoint ) {
            
							if( ! $navbar.hasClass('navbar-fixed-top') ) {
								if( $body.hasClass('page-menu-transparent') ) {
									$navbar.closest('.noo-header').css({'height': '1px'});
									$navbar.closest('.noo-header').css({'position': 'relative'});
								} else {
									$('.navbar-wrapper').css({'min-height': navHeight+'px'});
								}
								$navbar.addClass( navFixedClass );
								$navbar.css('top', adminbarHeight);
							}
						} else {
							if( $body.hasClass('page-menu-transparent') ) {
								$navbar.closest('.noo-header').css({'height': ''});
								$navbar.closest('.noo-header').css({'position': ''});
							} else {
								$('.navbar-wrapper').css({'min-height': ''});
							}
							$navbar.removeClass( navFixedClass );
						}
						
					}
				}
			};

			$window.bind('scroll',navbarInit).resize(navbarInit);
			if( $body.hasClass('one-page-layout') ) {
	
				// Scroll link
				$('.navbar-scrollspy > .nav > li > a[href^="#"]').click(function(e) {
					e.preventDefault();
					var target = $(this).attr('href').replace(/.*(?=#[^\s]+$)/, '');
					if (target && ($(target).length)) {
						var position = Math.max(0, $(target).offset().top );
							position = Math.max(0,position - (adminbarHeight + $('.navbar').outerHeight()) + 5);
						
						$('html, body').animate({
							scrollTop: position
						},{
							duration: 800, 
				            easing: 'easeInOutCubic',
				            complete: window.reflow
						});
					}
				});
				
				// Initialize scrollspy.
				$body.scrollspy({
					target : '.navbar-scrollspy',
					offset : (adminbarHeight + $('.navbar').outerHeight())
				});
				
				// Trigger scrollspy when resize.
				$(window).resize(function() {
					$body.scrollspy('refresh');
				});
	
			}
			
		}
		//Category mage manu hover
		$('.cat-mega-menu').each(function(){
			var _this = $(this),
				el = _this.find('.cat-mega-filters a');
				el.on('mouseenter',function(){
					_this.find('.cat-mega-filters li.selected').removeClass('selected');
					$(this).closest('li').addClass('selected');
					var _el_id = $(this).data('cat-id');
					_this.find('.cat-mega-content').hide();
					_this.find('[data-control-id="cat-mega-'+_el_id+'"]').show();
				});
		});
		
		$('.navbar-toggle').on('click',function(e){
			e.stopPropagation();
			e.preventDefault();
			if($('body').hasClass('offcanvas-open')){
				$('body').removeClass('offcanvas-open').addClass('offcanvas-close');
			}else{
				$('body').removeClass('offcanvas-close').addClass('offcanvas-open');
			}
			
		});
		$(document).on('click','.offcanvas-close-btn',function(){
			$('body').removeClass('offcanvas-open').addClass('offcanvas-close');
		});
		$('body').on('mousedown', $.proxy( function(e){
			var element = $(e.target);
			if($('.offcanvas').length && $('body').hasClass('offcanvas-open')){
				if(!element.is('.offcanvas') && element.parents('.offcanvas').length === 0 )
				{
					$('body').removeClass('offcanvas-open');
				}
			}
		}, this) );

		// Slider scroll bottom button
		$('.noo-slider-revolution-container .noo-slider-scroll-bottom').click(function(e) {
			e.preventDefault();
			var sliderHeight = $('.noo-slider-revolution-container').outerHeight();
			$('html, body').animate({
				scrollTop: sliderHeight
			}, 900, 'easeInOutExpo');
		});
	
		$('body').on('mouseleave ', '.masonry-style-elevated .masonry-portfolio.no-gap .masonry-item', function(){
			$(this).closest('.masonry-container').find('.masonry-overlay').hide();
			$(this).removeClass('masonry-item-hover');
		});

		if($('.masonry.noo-category-featured').length){
			$('.masonry.noo-category-featured').each(function(){
				var $this = $(this);
				$this.find('div.pagination').hide();
				$this.find('.loadmore-loading').hide();
				$this.nooLoadmore({
					navSelector  : $this.find('div.pagination'),            
			   	    nextSelector : $this.find('div.pagination a.next'),
			   	    itemSelector : 'div.loadmore-item',
			   	    loading:{
						speed:1,
						start: undefined
					},
			   	    finishedMsg  : nooL10n.ajax_finishedMsg
				},function(newElements){
					$this.find('.masonry-container').isotope('appended', $(newElements));
					$(window).unbind('.infscr');
					if($this.find('.masonry-filters').length){
						var selector = $this.find('.masonry-filters').find('a.selected').data('option-value');
						$this.find('.masonry-container').isotope({ filter: selector });
					}
				});
			});
		}


        //Init masonry isotope
        if($('.masonry').length){
            $('.masonry').each(function(){
                var $this = $(this);
                $this.find('div.pagination').hide();
                $this.find('.loadmore-loading').hide();
                $this.nooLoadmore({
                    navSelector  : $this.find('div.pagination'),
                    nextSelector : $this.find('div.pagination a.next'),
                    itemSelector : '.loadmore-item',
                    contentWrapper: $this.find('.masonry-container'),
                    loading:{
                        speed:1,
                        start: undefined
                    },
                    finishedMsg  : nooL10n.ajax_finishedMsg
                },function(newElements){
                    var masonrycontainer = $this.find('.masonry-container');
                    masonrycontainer.isotope('appended', $(newElements));
                    masonrycontainer.isotope('layout');
                    $(window).unbind('.infscr');
                    $(newElements).each(function() {
                        $(this).find('.content-featured .sliders').each(function(){
                            var __this = $(this);
                            var gallerySliderOptions = {
                                infinite: true,
                                circular: true,
                                auto: false,
                                responsive: true,
                                items: {
                                    visible: {min:1, max: 1}
                                },
                                prev: {
                                    button: __this.siblings(".slider-control.prev-btn")
                                },
                                next: {
                                    button: __this.siblings(".slider-control.next-btn")
                                },
                                pagination: {
                                    container: __this.siblings(".slider-indicators")
                                }
                            }
                            __this.carouFredSel(gallerySliderOptions);
                            imagesLoaded('.content-featured .sliders',function(){
                                __this.trigger('updateSizes');
                            });
                        });
                    });
                    if($this.find('.masonry-filters').length){
                        $this.find('.masonry-filters a').each(function(){
                            var $this = jQuery(this);
                            if($this.hasClass('selected')){
                                var options = {
                                        layoutMode : 'masonry',
                                        transitionDuration : '0.8s',
                                        'masonry' : {
                                            'gutter' : 0
                                        }
                                    },
                                    value = $this.attr('data-option-value');

                                value = value === 'false' ? false : value;
                                options['filter'] = value;

                                masonrycontainer.isotope(options);
                            }

                        });
                    }
                    imagesLoaded(masonrycontainer,function(){
                        masonrycontainer.isotope('layout');
                    });
                });
            });
        }


        //Init masonry isotope
        $('.masonry').each(function(){
            var self = $(this);
            var $container = $(this).find('.masonry-container');
            var $filter = $(this).find('.masonry-filters a');
            var masonry_options = {
                'gutter' : 0
            };
//            if( $(this).find('.masonry-item.standard').length ) {
//            	masonry_options.columnWidth = '.masonry-item.standard';
//            }
            $container.isotope({
                itemSelector : '.masonry-item',
                transitionDuration : '0.8s',
                masonry : masonry_options
            });

            imagesLoaded(self,function(){
                $container.isotope('layout');
            });
            $(window).resize(function(){
                $container.isotope('layout');
            });
            $filter.click(function(e){
                e.stopPropagation();
                e.preventDefault();

                var $this = jQuery(this);
                // don't proceed if already selected
                if ($this.hasClass('selected')) {
                    return false;
                }
                self.find('.masonry-result h3').text($this.text());
                var filters = $this.closest('ul');
                filters.find('.selected').removeClass('selected');
                $this.addClass('selected');

                var options = {
                        layoutMode : 'masonry',
                        transitionDuration : '0.8s',
                        'masonry' : {
                            'gutter' : 0
                        }
                    },
                    key = filters.attr('data-option-key'),
                    value = $this.attr('data-option-value');

                value = value === 'false' ? false : value;
                options[key] = value;

                $container.isotope(options);

            });
        });

        //Go to top
		$(window).scroll(function () {
			if ($(this).scrollTop() > 500) {
				$('.go-to-top').addClass('on');
			}
			else {
				$('.go-to-top').removeClass('on');
			}
		});
		$('body').on( 'click', '.go-to-top', function () {
			$("html, body").animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
		//Search
		$('body').on( 'click', '.search-button', function() {
			if ($('.searchbar').hasClass('hide'))
			{
				$('.searchbar').removeClass('hide').addClass('show');
				$('.searchbar #s').focus();
			}
			return false;
		});
		
		$('body').on('mousedown', $.proxy( function(e){
			var element = $(e.target);
			if(!element.is('.searchbar') && element.parents('.searchbar').length === 0 )
			{
				$('.searchbar').removeClass('show').addClass('hide');
			}
		}, this) );

		//Shop mini cart
		$(document).on("mouseenter", ".cart-item", function() {
			clearTimeout($(this).data('timeout'));
			$('.noo-minicart').addClass('show');
		});
		$(document).on("mouseleave", ".noo-menu-item-cart", function() {
			var t = setTimeout(function() {
				$('.noo-minicart').removeClass('show');
			}, 400);
			$(this).data('timeout', t);
		});
		

		// MailChimp subscribe
		$( ".mc-subscribe-form" ).submit(function( event ) {
			event.preventDefault();

			var $form = $( this );
			var data = $form.serializeArray();
			$form.find('label.noo-message').remove();
			$.ajax({
				type: 'POST',
				url: nooL10n.ajax_url,
				data: data,
				success: function (response) {
					var result = $.parseJSON(response);
					var message = '';
					if( result.success ) {
						if( result.data !== '' ) {
							message = '<label class="noo-message error" role="alert">' + result.data + '</label>';
							$form.addClass('submited');
							$form.html(message);
						}
					} else {
						if( result.data !== '' ) {
							$form.removeClass('submited');
							$( '<label class="noo-message" role="alert">' + result.data + '</label>' ).prependTo($form);
						}
					}
				},
				error: function (errorThrown) {
				}
			});
		});
	};

	$( document ).ready( function () {
		nooInit();		
	});

	$( window ).load(function() {
		if ( $('body').hasClass( 'enable-preload') ) {
			if( $("#loader-wrapper #loader").length ) {
				$("#loader-wrapper").fadeOut({
					duration: 200,
					complete: function() {
						$(this).remove();
						$(".site").animate({opacity: 1}, { easing: 'swing', duration: 350 });
					}
				});
			} else {
				$(".site").animate({opacity: 1}, { easing: 'swing', duration: 350 });
			}
		}
	});

	$(document).bind('noo-layout-changed',function(){
		nooInit();	
	});
	$( document ).ready( function () {
		if($('[data-paginate="loadmore"]').length && $('[data-paginate="loadmore"]').find('.btn-loadmore').length){
		
			$(function(){
				var $container = $('[data-paginate="loadmore"] .infinite-wrap');
				$container.infinitescroll({
					navSelector:"div.pagination",
					nextSelector:"div.pagination a.next",
					itemSelector:"article",
					loading: {
						img: '',
						finishedMsg: nooL10n.infinite_scroll_end_msg,
						msg: $('<div class="noo-loader loadmore-loading"><span></span><span></span><span></span><span></span><span></span></div>'),
						finished: function(el, opts) {
							$('.noo-loader').remove();
							$btn.show();
						}
					}
				}, function(newElements){ 
					//callback
					if ($.fn.nooCarouFredSelInit) $.fn.nooCarouFredSelInit();
					if ($.fn.nooNivoLighboxInit) $.fn.nooNivoLighboxInit();
				});
				$(window).unbind('.infscr');

				var $btn = $('[data-paginate="loadmore"] .btn-loadmore');

				$btn.on('click',function(e){
					$btn.hide();
					$container.infinitescroll('retrieve');
					return false;
				});
				$(document).ajaxError(
					function(e,xhr,opt){
						if(xhr.status==404) {
							$btn.remove();
							$('.noo-loader.loadmore-loading').addClass('finished').html('<em>' + nooL10n.infinite_scroll_end_msg + '</em>').animate({ opacity: 1 }, 2000, function () {
				                $(this).fadeOut('fast');
				            });
						}
				});
			});
		}
	});
	
	
})(jQuery);