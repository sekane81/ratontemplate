/*!
 * Kopa custom js (http://kopatheme.com)
 * Copyright 2014 Kopasoft.
 * Licensed under GNU General Public License v3
 */


/* =========================================================
 Comment Form
 ============================================================ */
jQuery(document).ready(function() {
    if (jQuery("#comments-form").length > 0) {
        // get front validate localization
        var validateLocalization = kopa_custom_front_localization.validate;

        // Validate the contact form
        jQuery('#comments-form').validate({
            // Add requirements to each of the fields
            rules: {
                author: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                comment: {
                    required: true,
                    minlength: 10
                }
            },
            // Specify what error messages to display
            // when the user does something horrid
            messages: {
                author: {
                    required: validateLocalization.name.required,
                    minlength: jQuery.format(validateLocalization.name.minlength)
                },
                email: {
                    required: validateLocalization.email.required,
                    email: validateLocalization.email.email
                },
                url: {
                    required: validateLocalization.url.required,
                    url: validateLocalization.url.url
                },
                comment: {
                    required: validateLocalization.message.required,
                    minlength: jQuery.format(validateLocalization.message.minlength)
                }
            }
        });
    }

    if (jQuery("#contact-form").length > 0) {
        // get front validate localization
        var validateLocalization = kopa_custom_front_localization.validate;

        // Validate the contact form
        jQuery('#contact-form').validate({
            // Add requirements to each of the fields
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                    minlength: 10
                }
            },
            // Specify what error messages to display
            // when the user does something horrid
            messages: {
                name: {
                    required: validateLocalization.name.required,
                    minlength: jQuery.format(validateLocalization.name.minlength)
                },
                email: {
                    required: validateLocalization.email.required,
                    email: validateLocalization.email.email
                },
                url: {
                    required: validateLocalization.url.required,
                    url: validateLocalization.url.url
                },
                message: {
                    required: validateLocalization.message.required,
                    minlength: jQuery.format(validateLocalization.message.minlength)
                }
            },
            // Use Ajax to send everything to processForm.php
            submitHandler: function(form) {
                jQuery("#submit-contact").attr("value", validateLocalization.form.sending);
                jQuery(form).ajaxSubmit({
                    success: function(responseText, statusText, xhr, $form) {
                        jQuery("#response").html(responseText).hide().slideDown("fast");
                        jQuery("#submit-contact").attr("value", validateLocalization.form.submit);
                    }
                });
                return false;
            }
        });
    }
});

/* =========================================================
 Sub menu
 ==========================================================*/
(function($) { //create closure so we can safely use $ as alias for jQuery

    jQuery(document).ready(function() {

        // initialise plugin
        var example = jQuery('#main-menu').superfish({
            //add options here if required
            disableHI: true // Fix: Superfish conflicts with WP admin bar for WordPress < 3.6
        });
    });

})(jQuery);

/* =========================================================
 Mobile menu
 ============================================================ */
jQuery(document).ready(function() {

    jQuery('#mobile-menu > span').click(function() {

        var mobile_menu = jQuery('#toggle-view-menu');

        if (mobile_menu.is(':hidden')) {
            mobile_menu.slideDown('300');
            jQuery(this).children('span').html('-');
        } else {
            mobile_menu.slideUp('300');
            jQuery(this).children('span').html('+');
        }



    });

    jQuery('#toggle-view-menu li').click(function() {

        var text = jQuery(this).children('div.menu-panel');

        if (text.is(':hidden')) {
            text.slideDown('300');
            jQuery(this).children('span').html('-');
        } else {
            text.slideUp('300');
            jQuery(this).children('span').html('+');
        }

        jQuery(this).toggleClass('active');

    });

});

/* =========================================================
 Flex Slider
 ============================================================ */
jQuery(window).load(function() {
    jQuery('.home-slider').flexslider({
        animation: "slide",
        start: function(slider) {
            jQuery('body').removeClass('loading');
        }
    });

});

/* =========================================================
 HeadLine Scroller
 ============================================================ */

jQuery(function() {
    var _scroll = {
        delay: 1000,
        easing: 'linear',
        items: 1,
        duration: 0.07,
        timeoutDuration: 0,
        pauseOnHover: 'immediate'
    };
    jQuery('.ticker-1').carouFredSel({
        width: 1000,
        align: false,
        items: {
            width: 'variable',
            height: 40,
            visible: 1
        },
        scroll: _scroll
    });

    //	set carousels to be 100% wide
    jQuery('.caroufredsel_wrapper').css('width', '100%');
});

/* =========================================================
 Carousel
 ============================================================ */


jQuery(window).load(function() {

    if (jQuery(".kopa-featured-news-carousel").length > 0) {
        jQuery(".kopa-featured-news-carousel").each(function() {
            var $this = jQuery(this),
                    scrollItems = $this.data('scroll-items');
            $this.owlCarousel({
                items: scrollItems,
                itemsDesktop: [1200, 3],
                itemsTablet: [800, 2],
                itemsTabletSmall: [640, 3],
                itemsMobile: [480, 2],
                pagination: true,
                slideSpeed: 500
            });
        });

    }



    if (jQuery(".kopa-gallery-carousel").length > 0) {
        jQuery(".kopa-gallery-carousel").each(function() {
            var $this = jQuery(this),
                    scrollItems = $this.data('scroll-items');

            $this.owlCarousel({
                pagination: false,
                items: scrollItems,
                itemsDesktopSmall: [1180, 1],
                itemsTablet: [800, 2],
                itemsTabletSmall: [640, 2],
                itemsMobile: [460, 1],
                navigation: true,
                slideSpeed: 700,
                navigationText: ['', '']
            });
            
        });
    }
});
/* =========================================================
 Tabs
 ============================================================ */
jQuery(document).ready(function() {

    jQuery('.tabs-1').each(function() {
        var $this = jQuery(this),
                firstTabContentID = $this.find('li a').first().attr('href');

        // add active class to first list item
        $this.children('li').first().addClass('active');

        // hide all tabs
        $this.find('li a').each(function() {
            var tabContentID = jQuery(this).attr('href');
            jQuery(tabContentID).hide();
        });
        // show only first tab
        jQuery(firstTabContentID).show();

        $this.children('li').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this),
                    $currentClickLink = $this.children('a');

            if ($this.hasClass('active')) {
                return;
            } else {
                $this.addClass('active')
                        .siblings().removeClass('active');
            }

            $this.siblings('li').find('a').each(function() {
                var tabContentID = jQuery(this).attr('href');
                jQuery(tabContentID).hide();
            });

            jQuery($currentClickLink.attr('href')).fadeIn();

        });
    });

    jQuery('.tabs-2').each(function() {
        var $this = jQuery(this),
                firstTabContentID = $this.find('li a').first().attr('href');

        // add active class to first list item
        $this.children('li').first().addClass('active');

        // hide all tabs
        $this.find('li a').each(function() {
            var tabContentID = jQuery(this).attr('href');
            jQuery(tabContentID).hide();
        });
        // show only first tab
        jQuery(firstTabContentID).show();

        $this.children('li').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this),
                    $currentClickLink = $this.children('a');

            if ($this.hasClass('active')) {
                return;
            } else {
                $this.addClass('active')
                        .siblings().removeClass('active');
            }

            $this.siblings('li').find('a').each(function() {
                var tabContentID = jQuery(this).attr('href');
                jQuery(tabContentID).hide();
            });

            jQuery($currentClickLink.attr('href')).fadeIn();

        });
    });

    jQuery('.tabs-3').each(function() {
        var $this = jQuery(this),
                firstTabContentID = $this.find('li a').first().attr('href');

        // add active class to first list item
        $this.children('li').first().addClass('active');

        // hide all tabs
        $this.find('li a').each(function() {
            var tabContentID = jQuery(this).attr('href');
            jQuery(tabContentID).hide();
        });
        // show only first tab
        jQuery(firstTabContentID).show();

        $this.children('li').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this),
                    $currentClickLink = $this.children('a');

            if ($this.hasClass('active')) {
                return;
            } else {
                $this.addClass('active')
                        .siblings().removeClass('active');
            }

            $this.siblings('li').find('a').each(function() {
                var tabContentID = jQuery(this).attr('href');
                jQuery(tabContentID).hide();
            });

            jQuery($currentClickLink.attr('href')).fadeIn();

        });
    });

});

/* =========================================================
 Flickr Feed
 ============================================================ */
jQuery(document).ready(function() {

    if (jQuery('.flickr-wrap').length > 0) {

        jQuery('.flickr-wrap').each(function() {

            var $this = jQuery(this),
                    flickrID = $this.data('flickr_id'),
                    limitItems = parseInt($this.data('limit'));

            $this.jflickrfeed({
                limit: limitItems,
                qstrings: {
                    id: flickrID
                },
                itemTemplate:
                        '<li class="flickr-badge-image">' +
                        '<a rel="prettyPhoto[kopa-flickr]" href="{{image}}" title="{{title}}">' +
                        '<img src="{{image_s}}" alt="{{title}}" width="52px" height="52px" />' +
                        '</a>' +
                        '</li>'
            }, function(data) {
                jQuery("a[rel^='prettyPhoto']").prettyPhoto({
                    show_title: false,
                    deeplinking: false
                }).mouseenter(function() {
                    //jQuery(this).find('img').fadeTo(500, 0.6);
                }).mouseleave(function() {
                    //jQuery(this).find('img').fadeTo(400, 1);
                });
            });
        });
    }
});


/* =========================================================
 prettyPhoto
 ============================================================ */
jQuery(document).ready(function() {
    init_image_effect();
});

jQuery(window).resize(function() {
    init_image_effect();
});

function init_image_effect() {

    var view_p_w = jQuery(window).width();
    var pp_w = 500;
    var pp_h = 344;

    if (view_p_w <= 479) {
        pp_w = '120%';
        pp_h = '100%';
    }
    else if (view_p_w >= 480 && view_p_w <= 599) {
        pp_w = '100%';
        pp_h = '170%';
    }

    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
        show_title: false,
        deeplinking: false,
        social_tools: false,
        default_width: pp_w,
        default_height: pp_h
    });
}

/* =========================================================
 Twitter
 ============================================================ */
jQuery(function() {
  var twitterLocalization = kopa_custom_front_localization.twitter;
    jQuery('.kopa-twitter-widget .tweets').each(function() {
        var $this = jQuery(this),
                dataUsername = $this.data('username'),
                dataLimit = $this.data('limit');
                
        $this.tweetable({
            username: dataUsername,
            time: true,
            rotate: false,
            speed: 4000,
            limit: dataLimit,
            replies: false,
            loading: twitterLocalization.loading ,
            position: 'append',
            failed: twitterLocalization.failed ,
            html5: true,
            onComplete: function($ul) {
                jQuery('time').timeago();
                $this.parent().find('.twitter-loading').remove();
            }
        });
    });
});

/* =========================================================
 Scroll bar
 ============================================================ */
jQuery(window).load(function() {
    mCustomScrollbars();
});

function mCustomScrollbars() {
    /* 
     malihu custom scrollbar function parameters: 
     1) scroll type (values: "vertical" or "horizontal")
     2) scroll easing amount (0 for no easing) 
     3) scroll easing type 
     4) extra bottom scrolling space for vertical scroll type only (minimum value: 1)
     5) scrollbar height/width adjustment (values: "auto" or "fixed")
     6) mouse-wheel support (values: "yes" or "no")
     7) scrolling via buttons support (values: "yes" or "no")
     8) buttons scrolling speed (values: 1-20, 1 being the slowest)
     */
    if (jQuery(".mcs5_container").length > 0) {
        jQuery(".mcs5_container").each(function() {
            var id = '#' + jQuery(this).attr('id');

            jQuery(id).mCustomScrollbar("horizontal", 500, "easeOutCirc", 1, "fixed", "yes", "yes", 20);
        });
    }
}

/* function to fix the -10000 pixel limit of jquery.animate */
jQuery.fx.prototype.cur = function() {
    if (this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null)) {
        return this.elem[ this.prop ];
    }
    var r = parseFloat(jQuery.css(this.elem, this.prop));
    return typeof r == 'undefined' ? 0 : r;
}

/* function to load new content dynamically */
function LoadNewContent(id, file) {
    jQuery("#" + id + " .customScrollBox .horWrapper-content").load(file, function() {
        mCustomScrollbars();
    });
}

/* ---------------------------------------------------------------------- */
/*	Portfolio Filter
 /* ---------------------------------------------------------------------- */

if (jQuery('#pf-items').length > 0) {
    var $container = jQuery('#pf-items');
    // initialize

    imagesLoaded($container, function() {

        $container.multipleFilterMasonry({
            itemSelector: '.element',
            filtersGroupSelector: '.filters'
        });
        jQuery('#pf-filters li label').click(function() {
            jQuery('#pf-filters li label').removeClass('active');
            jQuery(this).addClass('active');
        });

    });
}
;
/* end Portfolio Filter */

/* =========================================================
 Accordion
 ========================================================= */
jQuery(document).ready(function() {
    var acc_wrapper = jQuery('.acc-wrapper');
    if (acc_wrapper.length > 0)
    {

        jQuery('.acc-wrapper .accordion-container').hide();
        jQuery.each(acc_wrapper, function(index, item) {
            jQuery(this).find(jQuery('.accordion-title')).first().addClass('active').next().show();

        });

        jQuery('.accordion-title').on('click', function(e) {
            kopa_accordion_click(jQuery(this));
            e.preventDefault();
        });

        var titles = jQuery('.accordion-title');

        jQuery.each(titles, function() {
            kopa_accordion_click(jQuery(this));
        });
    }

});

function kopa_accordion_click(obj) {
    if (obj.next().is(':hidden')) {
        obj.parent().find(jQuery('.active')).removeClass('active').next().slideUp(300);
        obj.toggleClass('active').next().slideDown(300);

    }
    jQuery('.accordion-title span').html('+');
    if (obj.hasClass('active')) {
        obj.find('span').first().html('-');
    }
}

/* =========================================================
 Single post slider
 ============================================================ */
jQuery(window).load(function() {

    jQuery('.kp-single-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 150,
        itemMargin: 10,
        asNavFor: '.kp-single-slider'
    });

    jQuery('.kp-single-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: ".kp-single-carousel",
        start: function(slider) {
            jQuery('body').removeClass('loading');
        }
    });
});

/* =========================================================
 Toggle Boxes
 ============================================================ */
jQuery(document).ready(function() {

    jQuery('#toggle-view li').click(function(event) {

        var text = jQuery(this).children('div.panel');

        if (text.is(':hidden')) {
            jQuery(this).addClass('active');
            text.slideDown('300');
            jQuery(this).children('span').html('-');
        } else {
            jQuery(this).removeClass('active');
            text.slideUp('300');
            jQuery(this).children('span').html('+');
        }

    });

});

/* =========================================================
 Ajax load more articles for quicksort widget
 ============================================================ */
(function($) {
    jQuery('.kopa-widget-quick-sort .loadmore').on('click', function() {
        var $this = jQuery(this),
                dataAction = $this.data('action'),
                dataNonce = $this.data('wp-nonce'),
                dataOffset = $this.data('offset'),
                dataCategories = $this.data('categories'),
                dataPostsPerPage = $this.data('more-posts'),
                dataOrderby = $this.data('orderby'),
                dataPostNotIn = $this.data('post-not-in');

        jQuery.ajax({
            type: 'POST',
            url: kopa_front_variable.ajax.url,
            data: {
                action: dataAction,
                wpnonce: dataNonce,
                offset: dataOffset,
                categories: dataCategories,
                posts_per_page: dataPostsPerPage,
                orderby: dataOrderby,
                post__not_in: dataPostNotIn
            },
            success: function(responses) {
                responses = jQuery.parseJSON(responses);

                if (responses) {
                    var newItems = jQuery(responses.output);
                    jQuery('#pf-items').isotope('insert', newItems);
                    $this.data('offset', dataOffset + dataPostsPerPage);
                    $this.data('post-not-in', responses.post__not_in);
                } else {
                    $this.remove();
                }
            }
        });

        return false;
    });
})(jQuery);

/*==========================================================
focus on comment form when click reply button
============================================================*/
jQuery(document).ready(function() {
jQuery('.comment-reply-link').on('click', function() {
    jQuery('#comment_message').focus();
});
});