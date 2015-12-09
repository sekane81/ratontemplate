jQuery(document).ready(function ($) {

	"use strict";

	jQuery.browser={};(function(){jQuery.browser.msie=false;
	jQuery.browser.version=0;if(navigator.userAgent.match(/MSIE ([0-9]+)\./)){
	jQuery.browser.msie=true;jQuery.browser.version=RegExp.$1;}})();
	jQuery('#ajax-login-tabs').insertAfter('#ajax-login-wrap');
	jQuery("#layout").fitVids();
	if ($(".buddypress")[0]) {
		jQuery(".buddypress").removeClass('widget');
	}

	if ($(".res_mode")[0]) {
		if ($("#mymenuone")[0]) {
			jQuery('#mymenuone').before('<a class="btn_canvas mymenuone" href="#mymenuone"><i class="fa fa-bars"></i></a>');
			jQuery('#mymenuone').mmenu({
				dragOpen: true,
				position: "left",
				zposition: "next"
			}, {
				clone  : true
			});
		}
		if ($("#mymenutwo")[0]) {
			jQuery('#mymenutwo').before('<a class="btn_canvas mymenutwo" href="#mymenutwo"><i class="fa fa-bars"></i></a>');
			jQuery("#mymenutwo").mmenu({
				dragOpen: true,
				position: "left",
				zposition: "next"
			}, {
				clone  : true
			});
		}
		jQuery('.mm-menu .mm-list').removeClass('sf-menu res_mode sf-js-enabled sf-shadow');
	}
	// Superfish
	if ($(".sf-menu")[0]) {
		$('.sf-menu').superfish({
			delay: 100,
			autoArrows: true,
			animation: {
				opacity: 'none', height: 'show'
			},
			speed: 300
		});
		$('.sf-menu li li .sf-sub-indicator i').removeClass('fa-chevron-down').addClass('icon-chevron-right');
	}

	// Tabs widget
	(function() {
		var $tabsNav       = $('.T20-tabs-nav'),
			$tabsNavLis    = $tabsNav.children('li'),
			$tabsContainer = $('.T20-tabs-container');

		$tabsNav.each(function() {
			var $this = $(this);
			$this.next().children('.T20-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);

			$this.siblings().removeClass('active').end()
			.addClass('active');
			
			$this.parent().next().children('.T20-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		}).children( window.location.hash ? 'a[href=' + window.location.hash + ']' : 'a:first' ).trigger('click');

	})();

	// prettyPhoto
	$("a[class^='prettyPhoto']").prettyPhoto();

	// ToTop
	jQuery('#toTop').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 1000);
	});
	jQuery("#toTop").addClass("hidett");
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() < 400) {
			jQuery("#toTop").addClass("hidett").removeClass("showtt");
		} else {
			jQuery("#toTop").removeClass("hidett").addClass("showtt");
		}
	});

	// Slideshows
	if ($("#Flexslidert")[0]) {
		$('#Flexslidert').flexslider({
			animation: "slide",
			manualControls: "#slider_nav li"
		});
	}
	if ($("[class^='gallery_']")[0]) {
		$("[class^='gallery_']").owlCarousel({
			slideSpeed : 500,
			paginationSpeed : 500,
			autoPlay: true,
			autoHeight: true,
			stopOnHover: true,
			transitionStyle : "goDown",
			singleItem:true,
			navigation : true,
			navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
			rewindNav : true,
			scrollPerPage : false,
			pagination : false
		});
	}
	if ($("[class^='slideshow_']")[0]) {
		$("[class^='slideshow_b']").owlCarousel({
			slideSpeed : 500,
			paginationSpeed : 1500,
			autoPlay: true,
			autoHeight: true,
			stopOnHover: true,
			transitionStyle : "goDown",
			singleItem:true,
			navigation : false,
			rewindNav : true,
			scrollPerPage : false,
			pagination : true
		});
	}

	if ($("[class^='carousel_posts_']")[0]) {
		$(".grid_2 [class^='carousel_posts_'], .grid_3 [class^='carousel_posts_']").owlCarousel({
			slideSpeed : 600,
			paginationSpeed : 1000,
			items : 1,
			autoPlay: true,
			stopOnHover: true,
			autoHeight: false,
			responsive: true,
			pagination: true,
			paginationNumbers: false
		});
		$(".grid_4 [class^='carousel_posts_']").owlCarousel({
			slideSpeed : 600,
			paginationSpeed : 1000,
			items : 2,
			autoPlay: true,
			stopOnHover: true,
			autoHeight: false,
			responsive: true,
			pagination: true,
			paginationNumbers: false
		});
		$(".grid_8 [class^='carousel_posts_'], .grid_6 [class^='carousel_posts_'], .grid_7 [class^='carousel_posts_'], .grid_5 [class^='carousel_posts_']").owlCarousel({
			slideSpeed : 600,
			paginationSpeed : 1000,
			items : 3,
			autoPlay: true,
			stopOnHover: true,
			autoHeight: false,
			responsive: true,
			pagination: true,
			paginationNumbers: false
		});
		$(".grid_10 [class^='carousel_posts_'], .grid_9 [class^='carousel_posts_']").owlCarousel({
			slideSpeed : 600,
			paginationSpeed : 1000,
			items : 4,
			autoPlay: true,
			stopOnHover: true,
			autoHeight: false,
			responsive: true,
			pagination: true,
			paginationNumbers: false
		});
		$(".grid_11 [class^='carousel_posts_'], .grid_12 [class^='carousel_posts_']").owlCarousel({
			slideSpeed : 600,
			paginationSpeed : 1000,
			items : 5,
			autoPlay: true,
			stopOnHover: true,
			autoHeight: false,
			responsive: true,
			pagination: true,
			paginationNumbers: false
		});
	}

	// Search
	var popupStatus = 0;
	$(".search_icon").click(function() {
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var popupHeight = $("#popup").height();
		var popupWidth = $("#popup").width();
		$("#popup").css({
			"top": windowHeight / 2 - popupHeight / 2,
			"left": windowWidth / 2 - popupWidth / 2
		});
		// Aligning bg
		$("#SearchBackgroundPopup").css({"height": windowHeight});
		if (popupStatus == 0) {
			$("#SearchBackgroundPopup").fadeIn(400);
			$("#popup").fadeIn(400);
			$(".search_place").addClass('animated slideDown');
			popupStatus = 1;
		}
		$('#inputhead').select();
	});
	// Close Popup
	$("#popupLoginClose").click(function() {
		if (popupStatus == 1) {
			$("#SearchBackgroundPopup").fadeOut();
			$("#popup").fadeOut();
			popupStatus = 0;
		}
	});
	$("body").click(function() {
		$("#SearchBackgroundPopup").fadeOut();
		$("#popup").fadeOut();
		popupStatus = 0;
	});
	$('#popup, .search_icon').click(function(e) {
		e.stopPropagation();
	});

	// Tipsy
	$('.toptip, abbr, .item-avatar a, .activity-meta a').tipsy({fade: true,gravity: 's'});
	$('.bottomtip').tipsy({fade: true,gravity: 'n'});
	$('.righttip').tipsy({fade: true,gravity: 'w'});
	$('.lefttip').tipsy({fade: true,gravity: 'e'});

	// Sticky
		$('.my_sticky').before('<div class="Corpse_Sticky"></div>');
		$(window).scroll(function(){
			var wind_scr = $(window).scrollTop();
			var window_width = $(window).width();
			var head_w = $('.my_sticky').height();
			if (window_width >= 1177) {
			 	var headdown_h = $('#header').height();
				if(wind_scr < headdown_h){
					if($('.my_sticky').data('ssticky') === true){
						$('.my_sticky').data('ssticky', false);
						$('.my_sticky').stop(true).animate({opacity : 0}, 300, function(){
							$('.my_sticky').removeClass('ssticky');
							$('.my_sticky').stop(true).animate({opacity : 1}, 300);
							$('.Corpse_Sticky').css('padding-top', '');
						});
					}
				} else {
					if($('.my_sticky').data('ssticky') === false || typeof $('.my_sticky').data('ssticky') === 'undefined'){
						$('.my_sticky').data('ssticky', true);
						$('.my_sticky').stop(true).animate({opacity : 0},300,function(){
							$('.my_sticky').addClass('ssticky');
							$('.my_sticky.ssticky').stop(true).animate({opacity : 1}, 300);
							$('.Corpse_Sticky').css('padding-top', head_w + 'px');
						});
					}
				}
			}
		});
		$(window).resize(function(){
			var window_width = $(window).width();
			if (window_width <= 1177) {
				if($('.my_sticky').hasClass('ssticky')){
					$('.my_sticky').removeClass('ssticky');
					$('.my_sticky').stop(true).animate({opacity : 0}, 300, function(){
						$('.my_sticky').removeClass('ssticky');
						$('.my_sticky').stop(true).animate({opacity : 1}, 300);
						$('.Corpse_Sticky').css('padding-top', '');
					});
				}
			}
		});
	vc_prettyPhoto();
});
  function vc_prettyPhoto() {
    try {
      // just in case. maybe prettyphoto isnt loaded on this site
      jQuery('a.prettyphoto, .gallery-icon a[href*=".jpg"]').prettyPhoto({
        animationSpeed:'normal', /* fast/slow/normal */
        padding:15, /* padding for each side of the picture */
        opacity:0.7, /* Value betwee 0 and 1 */
        showTitle:true, /* true/false */
        allowresize:true, /* true/false */
        counter_separator_label:'/', /* The separator for the gallery counter 1 "of" 2 */
        //theme: 'light_square', /* light_rounded / dark_rounded / light_square / dark_square */
        hideflash:false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
        deeplinking:false, /* Allow prettyPhoto to update the url to enable deeplinking. */
        modal:false, /* If set to true, only the close button will close the window */
        callback:function () {
          var url = location.href;
          var hashtag = (url.indexOf('#!prettyPhoto')) ? true : false;
          if (hashtag) location.hash = "!";
        } /* Called when prettyPhoto is closed */,
        social_tools:''
      });
    } catch (err) {
    }
  }