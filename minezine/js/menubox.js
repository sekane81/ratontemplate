jQuery(document).ready(function($) {
		var stickyHeaderTop = $('.menu-box').offset().top;
		$(window).scroll(function(){
		    if( $(window).scrollTop() > stickyHeaderTop ) {
			$('.menu-box').addClass("sticky-nav");
		    } else {
			$('.menu-box').removeClass("sticky-nav");
		    }
		});
});