jQuery(document).ready(function ($) {
    "use strict";
    $(window).load(function(){
        $('.preloader').fadeOut(400, function(){
            $('.preloader').remove();
        });
    });
    // Main Navigation
    if ($(window).width() > 768) {
        $('.main-nav ul li').has('.submenu').on('mouseenter', function () {
            $(this).find('>.submenu').stop().addClass('active');
        })
            .on('mouseleave', function () {
                $(this).find('>.submenu').stop().removeClass('active');
            });
    }
    else {
        $('.menu-trigger').on('click', function(){
            $('.main-nav').slideToggle();
        });
    }

    $('.dropdown-toggle').click(function(){
        if( $(this).attr('href').indexOf('http') > -1 ){
            window.location.href = $(this).attr('href');
        }
    });

    // main slider
    var owl = $("#main-slider");

    owl.owlCarousel({
        items: owl.data('featured_visible_items'),
        beforeInit: function(){
            owl.show();
        },
        navRewind: false,
        itemsCustom: [
            [0, 2],
            [450,parseInt( owl.data('featured_visible_items') )],
        ],
        navigation: true,
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]        

    });

    /* STICKY NAVIGATION */
    function sticky_nav(){
        var $admin = $('#wpadminbar');
        if( $admin.length > 0 && $admin.css( 'position' ) == 'fixed' ){
            $sticky_nav.css( 'top', $admin.height() );
        }
        else{
            $sticky_nav.css( 'top', '0' );
        }
    }    
    var enable_sticky = $('.enable_sticky').val();
    if( enable_sticky == 'yes' ){
        var $navigation_bar = $('header');
        var $sticky_nav = $navigation_bar.clone().addClass('sticky_nav');
        $('body').append( $sticky_nav );

        $(window).on('scroll', function(){
            if( $(window).scrollTop() >= $navigation_bar.position().top && $(window).width() > 1030 ){
                $sticky_nav.slideDown();
            }
            else{
                $sticky_nav.slideUp();
            }
        }); 
        sticky_nav();
        handle_navigation();

        $(window).resize(function(){
            sticky_nav();
        });
    }  

    // Reveal search query
    $('.search-trigger, li.search a').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var search = $this.parents('.header').find('.search-query');
        search.css('opacity', '0').css('display', 'block').animate({
            opacity: 1
        }, 200, function(){
            $this.closest('.search').find('i').removeClass('fa-search').addClass('fa-times');
            $this.parents('.header').find('.search-query input').focus();
        });
    });

    $(document).click(function(event){
        var search = $('.header').find('.search-query');
        if( search.is(':visible') && $(event.target).attr('name') !== 's' && $(event.target).attr('class') !== 'fa fa-search' ) {
            search.animate({
                opacity: 0
            }, 200, function(){
                $('.search').find('i').removeClass('fa-times').addClass('fa-search');
                search.css('display', 'none')
            });
        }
    });

    // Calculating textbox position
    function calcl_content_height(){
        $( '.has-media' ).each(function(){
            var $this = $(this);
            if( $(window).width() > 768 ){
                var $boxHeight = $this.find('.col-md-5').height();
                var $content_height = $this.find( '.col-md-7' ).outerHeight(true);
                $this.find('.col-md-7').css('padding-top', ( $boxHeight - $content_height ) / 2 );
            }
            else{
                $this.find('.col-md-7').css('padding-top', 'auto');
            }

        });        
    }
    $(window).load(function ()  {
        calcl_content_height();
    });
    $(window).resize(function ()  {
        setTimeout(function(){
            calcl_content_height();
        }, 1000);
    });    

    //Handle navigation
    function handle_navigation(){
        if ($(window).width() >= 767) {
            $('ul.nav li.dropdown, ul.nav li.dropdown-submenu').hover(function () {
                var $this = $(this);
                if( !$this.hasClass('open') ){
                    $(this).addClass('open').find(' > .dropdown-menu').hide().slideDown(200);
                }
            }, function () {
                var $this = $(this);
                var delay = $('.header-3').length > 0 ? 200 : 0;
                setTimeout(function(){
                    if(  !$this.is(":hover") ){
                        if( $this.hasClass('open') ){
                            $this.removeClass('open').find(' > .dropdown-menu').hide();
                        }
                    }
                },delay);
    
            });
        }
        else{
            $('ul.nav li.dropdown, ul.nav li.dropdown-submenu').unbind('mouseenter mouseleave');
        }
    }
    handle_navigation(); 

    $('.post-slider').responsiveSlides({
        speed: 800,
        auto: false,
        pager: false,
        nav: true,
        prevText: '<i class="fa fa-angle-left"></i>',
        nextText: '<i class="fa fa-angle-right"></i>',
    });     

    var adminBar = 0;
    if( $('#wpadminbar').length > 0 && $('#wpadminbar').css('position') == 'fixed' ){
        adminBar = $('#wpadminbar').height();
    }
    if( $('.sticky_nav').length > 0 ){
        $('.sticky_nav').show();
        adminBar += $('.sticky_nav').height();
        $('.sticky_nav').hide();
    }    
    $('.sidebar').theiaStickySidebar({
        containerSelector: 'main',
        additionalMarginTop: adminBar,
        additionalMarginBottom: 0
    });

    $('.favourites-click').click(function(){
        var $this = $(this);
        if( $this.find('.fa-star').length > 0 ){

        }
        else{

        }
        $.ajax({
            url: ajaxurl,
            method: 'POST',
            data: {
                action: 'favourite',
                post_id: $this.data('post_id')
            },
            success: function(response){
                $this.html( response );
            }
        });
    });


    /* TOTAL OVERLAY */
    $('.total-overlay-trigger').click(function(){
        $(this).parents('header').find('.total-overlay').fadeIn();  
        $('body').css('overflow-y', 'hidden');
    });

    $('.total-overlay-close').click(function(){
        $('.total-overlay').fadeOut();
        $('body').css('overflow-y', 'auto');
    });

    /* SEND CONTACT */
    $('.submit-form-contact').click(function(e){
        e.preventDefault();
        
        $.ajax({
            url: ajaxurl,
            method: "POST",
            data: $(this).parents('form').serialize(),
            dataType: "JSON",
            success: function( response ){
                if( !response.error ){
                    $('.send_result').html( '<div class="alert alert-success" role="alert"><span class="fa fa-check-circle"></span> '+response.success+'</div>' );
                }
                else{
                    $('.send_result').html( '<div class="alert alert-danger" role="alert"><span class="fa fa-times-circle"></span> '+response.error+'</div>' );             
                }
            }
        })
    });
    /* CONTACT MAP */
    var $contact_map = $('.contact_map');
    if( $contact_map.length > 0 ){
        var markers = [];
        $('.contact_map_marker').each(function(){
            var temp = $(this).val().split(',');
            markers.push({
                longitude: temp[0].trim(),
                latitude: temp[1].trim()
            })
        });
        var markersArray = [];
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = { 
            mapTypeId: google.maps.MapTypeId.ROADMAP 
        };
        var map =  new google.maps.Map(document.getElementById("map"), mapOptions);
        var location;
        if( markers.length > 0 ){
            for( var i=0; i<markers.length; i++ ){
                location = new google.maps.LatLng( markers[i].longitude, markers[i].latitude );
                bounds.extend( location );

                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                });             
            }

            map.fitBounds( bounds );
            google.maps.event.addListenerOnce(map, 'idle', function() {
                if ( map.getZoom() > 12 && markers.length == 1 ) {
                    map.setZoom(12);
                }  
            });            
            
        }
    }   

    /* MAGNIFIC POPUP FOR THE GALLERY */
    $('.gallery').each(function(){
        var $this = $(this);
        $this.magnificPopup({
            type:'image',
            delegate: 'a',
            gallery:{enabled:true},
        });
    });
});
