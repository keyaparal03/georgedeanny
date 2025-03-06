jQuery(function($){
	"use strict";
	
	/*** Product Video ***/
	$('a.ts-product-video-button').on('click', function(e){
		e.preventDefault();
		var product_id = $(this).data('product_id');
		var container = $('#ts-product-video-modal');
		if( container.find('.product-video-content').html() ){
			container.addClass('show');
		}
		else{
			container.addClass('loading');
			$.ajax({
				type : 'POST'
				,url : loobek_params.ajax_url
				,data : {action : 'loobek_load_product_video', product_id: product_id}
				,success : function(response){
					container.find('.product-video-content').html( response );
					container.removeClass('loading').addClass('show');
				}
			});
		}
	});
	
	/*** Product 360 ***/
	if( typeof $.fn.ThreeSixty == 'function' ){
		if( $('.ts-product-360-button').length == 0 ){
			setTimeout(function(){
				generate_product_360();
			}, 1000);
		}
		
		$('.ts-product-360-button').on('click', function(){
			$('#ts-product-360-modal').addClass('loading');
			generate_product_360();
			return false;
		});
	}
	
	function generate_product_360(){
		if( !$('.ts-product-360').hasClass('loaded') ){
			$('.ts-product-360').ThreeSixty({
				currentFrame: 1
				,imgList: '.threesixty_images'
				,imgArray: _ts_product_360_image_array
				,totalFrames: _ts_product_360_image_array.length
				,endFrame: _ts_product_360_image_array.length
				,progress: '.spinner'
				,navigation: true
				,responsive: true
				,onReady: function(){
					$('#ts-product-360-modal').removeClass('loading').addClass('show');
					$('.ts-product-360').addClass('loaded');
				}
			});
		}
		else{
			$('#ts-product-360-modal').removeClass('loading').addClass('show');
		}
	}
	
	/*** Size Chart ***/
	$('.ts-product-size-chart-button').on('click', function(e){
		e.preventDefault();
		$('#ts-product-size-chart-modal').addClass('show');
	});
	
	/*** Show more/less product content ***/
	if( $('.single-product .more-less-buttons').length > 0 ){
		var product_content = $('.single-product .more-less-buttons').siblings('.product-content');
		if( product_content.height() < 731 ){
			$('.single-product .more-less-buttons').remove();
			product_content.removeClass('closed show-more-less');
		}
		else{
			var timeout = 200 + ( product_content.find('img').length * 200 );
			setTimeout(function(){
				var scrollheight = product_content.get(0).scrollHeight;
				var speed = scrollheight / 1500;
				var style = '<style>'
							+ '.product-content.show-more-less{transition:'+speed+'s ease;}'
							+ '.product-content.opened{max-height:'+scrollheight+'px;}'
							+ '</style>';
				$('head').append( style );
			}, timeout);
		}
	}
	
	$('.single-product .more-less-buttons a').on('click', function(e){
		e.preventDefault();
		$(this).hide();
		$(this).siblings('a').show();
		var action = $(this).data('action');
		$(this).parent().siblings('.product-content').removeClass('opened closed').addClass(action);
		
		if( action == 'closed' ){
			var top = $(this).parents('.woocommerce-tabs').offset().top - get_fixed_header_height() - 10;
			$('body, html').animate({
				scrollTop: top
			}, 1000);
		}
	});
	
	function get_fixed_header_height(){
		var admin_bar_height = $('#wpadminbar').length > 0?$('#wpadminbar').outerHeight():0;
		var sticky_height = $('.is-sticky .header-sticky').length > 0?$('.is-sticky .header-sticky').outerHeight():0;
		return admin_bar_height + sticky_height;
	}
	
	/*** Buy Now ***/
	$('.ts-buy-now-button').on('click', function(e){
		e.preventDefault();
		var cart_form = $(this).parents('.summary').find('form.cart');
		if( cart_form.length ){
			if( !$(this).hasClass('disabled') ){
				$(document).off('submit', '.product:not(.product-type-external) .summary form.cart'); /* disable ajax add to cart */
				cart_form.append('<input type="hidden" name="ts_buy_now" value="1" />');
			}
			cart_form.find('.single_add_to_cart_button').trigger('click');
		}
	});
	
	/** Set height content for Frequently Bought Together Style Horizontal **/
	if( $('.bought-together-layout-horizontal .yith-wfbt-section').length ){
		$(window).on('ts_single_product_handle resize orientationchange', function(){
			if( $(window).width() > 991 ){
				$('.yith-wfbt-items, .yith-wfbt-images').css('min-height', 'auto');/* reset default when responsive */
				
				var height = $('.yith-wfbt-images').outerHeight() > $('.yith-wfbt-items').outerHeight() ? $('.yith-wfbt-images').outerHeight() : $('.yith-wfbt-items').outerHeight();
				$('.yith-wfbt-items, .yith-wfbt-images').css('min-height', height + 'px');				
				$('.yith-wfbt-form').css('margin-bottom','-' + height + 'px');
			}
			$('.wfbt-loading').removeClass('wfbt-loading');
		});
	}
	
	/** Product name height for Frequently Bought Together Style Vetical **/
	if( $('.bought-together-layout-vertical .yith-wfbt-section').length ){
		$(window).on('ts_single_product_handle resize orientationchange', function(){
			if( $(window).width() > 1200 ){
				var product_name = $('.yith-wfbt-item');
				var product_image = $('.yith-wfbt-images .image-td');
				var height = 0;
				product_name.each(function(i, e){
					height = $(e).height() < $(product_image[i]).height() ? $(product_image[i]).height() : $(e).height();
					$(e).css('min-height', height);
					$(product_image[i]).css('min-height', height);
				});
			}
			$('.wfbt-loading').removeClass('wfbt-loading');
		});
	}
	
	/** Product Sticky For Thumbnail < Summary **/
	if( $('div.product.summary-scrolling').length || $('div.product.reviews-inside-summary.tabs-inside-summary').length ){
		$(window).on('ts_single_product_handle resize orientationchange', function(){
			if( $(window).width() > 767 ){
				setTimeout(function(){
					var image_height = $('.product-images-summary .woocommerce-product-gallery').height();
					var summary_height = $('.product-images-summary .summary').height();
					$('.product-images-summary').css({
						'--imageHeight': image_height < summary_height ? image_height + 'px' : 'auto'
						,'--minHeight': image_height < summary_height ? summary_height + 'px' : 'auto'
					});
				}, 1000);
			}
		});
	}
	
	$(window).trigger('ts_single_product_handle');
	
	
	$(document).on('found_variation', 'form.variations_form', function(){
		$(this).parents('.summary').find('.ts-buy-now-button').removeClass('disabled');
	});
	
	$(document).on('reset_image', 'form.variations_form', function(){
		$(this).parents('.summary').find('.ts-buy-now-button').addClass('disabled');
	});
	
	/*** Tabs Accordion ***/
	if( $('.product.tabs-accordion').length ){
		setTimeout(function(){
			$('.woocommerce-Tabs-panel--reviews').prepend( $('.woocommerce-Reviews-title') );
			
			$('.woocommerce-Tabs-panel > h2').on('click', function(){
				$(this).toggleClass('active');
				$(this).siblings().slideToggle();
			});
		}, 20);
	}
	
	/*** Collapse Reviews Tab ***/
	if( $('.collapse-reviews-tab').length ){
		setTimeout(function(){
			$('#reviews').addClass('loaded');
			
			if( !$('#reviews .wcpr-overall-rating-and-rating-count').length ){
				$('.collapse-reviews-tab').removeClass('collapse-reviews-tab');
				return;
			}
			
			var btn_class = $('.summary #reviews').length ? 'button-text' : 'button button-border';
			
			/* Add buttons */
			$('.wcpr-overall-rating-and-rating-count').after('<a href="#" class="collapse-write-review-button ' + btn_class + '">' + loobek_params.write_review_button_label + '</a>');
			$('.wcpr-overall-rating-and-rating-count').after('<a href="#" class="collapse-show-reviews-button ' + btn_class + '">' + loobek_params.show_reviews_button_label + '</a>');
			
			/* Add overlay & close button */
			$('#reviews').append('<div class="overlay"></div>');
			$('#reviews').append('<a href="#" class="close"></a>');
			
			/* Add actions */
			$('.collapse-write-review-button').on('click', function(){
				$('body').removeClass('collapse-show-all-reviews').addClass('collapse-show-review-form');
				return false;
			});
			
			$('.collapse-show-reviews-button').on('click', function(){
				$('body').addClass('collapse-show-all-reviews');
				$('.collapse-write-review-button').removeClass(btn_class).addClass('button button-border');
				return false;
			});
			
			$('#reviews .overlay, #reviews .close').on('click', function(){
				$('body').removeClass('collapse-show-review-form collapse-show-all-reviews');
				$('.collapse-write-review-button').removeClass('button button-border').addClass(btn_class);
				return false;
			});
			
			$('.woocommerce-review-link').on('click', function(){
				$('.collapse-write-review-button').trigger('click');
				return false;
			});
			
			var href =  window.location.href;
			if( href.indexOf('#comments') != -1 || href.indexOf('#reviews') != -1 ){
				if( 'scrollRestoration' in history ){
					history.scrollRestoration = 'manual';
				}
				
				if( href.indexOf('#comments') != -1 ){
					$('.collapse-show-reviews-button').trigger('click');
				}
				
				if( href.indexOf('#reviews') != -1 ){
					$('.collapse-write-review-button').trigger('click');
				}
			}
		}, 20);
	}
	else if( $('.wcpr-overall-rating-main').length && $('#review_form_wrapper').length ){
		setTimeout(function(){
			$('.wcpr-overall-rating-main').append('<a href="#review_form_wrapper" class="button button-border">' + loobek_params.write_review_button_label + '</a>');
		}, 20);
	}
});