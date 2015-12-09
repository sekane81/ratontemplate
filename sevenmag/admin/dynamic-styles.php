<?php

/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if ( ! function_exists( 'T20_hex2rgb' ) ) {

	function T20_hex2rgb( $hex, $array=false ) {
		$hex = str_replace("#", "", $hex);

		if ( strlen($hex) == 3 ) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array( $r, $g, $b );
		if ( !$array ) { $rgb = implode(",", $rgb); }
		return $rgb;
	}
	
}	

/*  Google fonts
/* ------------------------------------ */
if ( ! function_exists( 'T20_google_fonts' ) ) {
	function T20_google_fonts () {
		$body_font = $nav_font = $head_font = '';
		if ( ot_get_option('font_name_body') ) {$body_font = '|'. ot_get_option('font_name_body');}
		if ( ot_get_option('font_name_navigation') ) {$nav_font = '|'. ot_get_option('font_name_navigation');}
		if ( ot_get_option('font_name_headlines') ) {$head_font = '|'. ot_get_option('font_name_headlines');}
		echo '<link href="//fonts.googleapis.com/css?family=Roboto'.$body_font.''.$nav_font.''.$head_font.'" rel="stylesheet" type="text/css">'. "\n";
	}
}
add_action( 'wp_head', 'T20_google_fonts', 2 );	

/*  Dynamic css output
/* ------------------------------------ */
if ( ! function_exists( 'T20_dynamic_css' ) ) {
	function T20_dynamic_css() {
		if ( ot_get_option('dynamic-styles') != 'off' ) {
		
			// rgb values
			$th_color = ot_get_option('featured_thumb_color');
			$theme_color_rgb = T20_hex2rgb($th_color);

			$styles = '<style type="text/css">'."\n";	
			
			// Fonts
			if ( ot_get_option('font_name_body') ) {
				$styles .= 'body { font-family: "'.ot_get_option('font_name_body').'", Roboto, tahoma, sans-serif; }'."\n";
			}
			if ( ot_get_option('font_name_navigation') ) {
				$styles .= 'nav a { font-family: "'.ot_get_option('font_name_navigation').'", Roboto, tahoma, sans-serif; }'."\n";
			}
			if ( ot_get_option('font_name_headlines') ) {
				$styles .= 'h1, h2, h3, h4, h5, h6 { font-family: "'.ot_get_option('font_name_headlines').'", Roboto, tahoma, sans-serif; }'."\n";
			}
			
			// Body background
			if ( ot_get_option('body_bg') ) {
				$body_bgg = ot_get_option( 'body_bg', array() );
				if ( $body_bgg['background-color'] ) { $bc = 'background-color:'.$body_bgg['background-color']; } else { $bc = 'background-color:#ddd'; }
				if ( $body_bgg['background-repeat'] ) { $br = 'background-repeat:'.$body_bgg['background-repeat']; } else { $br = 'background-repeat:repeat'; }
				if ( $body_bgg['background-attachment'] ) { $ba = 'background-attachment:'.$body_bgg['background-attachment']; } else { $ba = 'background-attachment:fixed'; }
				if ( $body_bgg['background-position'] ) { $bp = 'background-position:'.$body_bgg['background-position']; } else { $bp = 'background-position:center top'; }
				if ( $body_bgg['background-image'] ) { $bi = 'background-image:url('.$body_bgg['background-image'].')'; } else { $bi = 'background-image:url('.get_template_directory_uri().'/images/backgrounds/'.ot_get_option( 'body_bg_pattern' ).'.png)'; }
				if ( $body_bgg['background-size'] ) { $bs = 'background-size:'.$body_bgg['background-size']; } else { $bs = 'background-size:auto'; }
				$styles .= 'body{'.$bi.';'.$br.';'.$ba.';'.$bp.';'.$bc.';'.$bs.';}'."\n";
			}

			// primary color
			if ( ot_get_option('theme_color') ) {
				$styles .= '
::selection { background-color: '.ot_get_option('theme_color').'; }
::-moz-selection { background-color: '.ot_get_option('theme_color').'; }

a:hover, .sf-menu li li:hover > a, .sf-menu li li > a:hover, .sf-menu li li.current_page_item > a, .sf-menu li li.current-menu-item > a,.sec_head .sf-menu li a:hover, .sf-menu > li:hover > a, 
.sf-menu > li > a:hover, .post_meta a:hover, .widget_archive li.current a, .widget_categories li.current a, .widget_nav_menu li.current a, .widget_meta li.current a, .widget_pages li.current a, 
.widget_archive li:hover a, .widget_pages li:hover a, .widget_meta li:hover a, .widget_nav_menu li:hover > a, .widget_categories li:hover a, 
#footer .sf-menu a:hover, #footer .sf-menu .current-menu-item a, #footer .sf-menu .current_page_item a, #header .search button:hover, #footer a:hover, 
.r_post .more_meta a:hover, .r_post .s_category a:hover, .sf-menu li.current_page_item > a, .sf-menu li.current-menu-item > a, .medium_thumb .s_category a:hover { color: '.ot_get_option('theme_color').' !important }

.readmore:hover, .pagination_default a:hover, .dwqa-dropdown-menu li a:hover, .dwqa-dropdown-menu li a:focus, #layout .sf-menu li li b { color: #FFF !important }

.pagination_default a:hover, .social a:hover .fa-random, .with_color a .fa-random, .social a:hover .fa-envelope-o, .with_color a .fa-envelope-o, .social a:hover .fa-home, .with_color a .fa-home, .commentlist li.bypostauthor > .comment-body:after, .commentlist li.comment-author-admin > .comment-body:after, 
#ajax-login-content-tab input[type="submit"]:hover, #ajax-login-user a:hover, #ajax-recaptcha-container a:hover, #submit:hover, #wp-calendar #today, .tagcloud a:hover, .search_btn:hover, .wpcf7-submit:hover, .post-password-form input[type="submit"]:hover, 
.search_icon i:hover, .wp-pagenavi a, #footer #submit, #footer .search_btn, #footer .wpcf7-submit, .readmore:hover, .woocommerce-pagination a, #layout .sf-menu li li b, .wp-polls input.Buttons, .wp-polls-ans a, #bbpress-forums .button:hover, #bbp_search_submit:hover { background-color: '.ot_get_option('theme_color').' !important; }

.wp-pagenavi a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, 
.woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:focus, 
.woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:focus, 
.woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .wp-polls input.Buttons:hover, .wp-polls-ans a:hover {background: #1D1E20 !important;color: #fff !important}

#layout .sf-menu li li:first-child, #layout .sf-menu .two_col li:nth-child(2) {border-top-color: '.ot_get_option('theme_color').';}
textarea:focus, input[type=\'text\']:focus, input[type=\'email\']:focus, input[type=\'url\']:focus, input[type=\'number\']:focus, input[type=\'password\']:focus, .widget_archive li.current a, .widget_categories li.current a, .widget_nav_menu li.current a, .widget_meta li.current a, .widget_pages li.current a, .widget_archive li:hover a, .widget_pages li:hover a, .widget_meta li:hover a, .widget_nav_menu li:hover > a, .widget_categories li:hover a,
#footer .widget_archive li a:hover, #footer .widget_pages li a:hover, #footer .widget_meta li a:hover, #footer .widget_recent_entries li:hover, #footer .widget_recent_comments li:hover, #footer .widget_rss li:hover, #footer .widget_nav_menu li a:hover, #footer .widget_categories li a:hover { border-color: '.ot_get_option('theme_color').' !important }		
				'."\n";
			}

			if ( ot_get_option('tipsy') ) {
				$styles .= '
.tipsy-inner {background-color: '.ot_get_option('tipsy').' }
.tipsy-n .tipsy-arrow:before { border-bottom: 6px solid '.ot_get_option('tipsy').' !important }
.tipsy-s .tipsy-arrow:before { border-top: 6px solid '.ot_get_option('tipsy').' !important}
				'."\n";
			}

			if ( ot_get_option('nav_hover') !='1' ) {
				if ( ot_get_option('nav_hover') =='2' ) :
					$styles .= '.sf-menu > li:hover > a, .sf-menu > li > a:hover, .sf-menu li.current_page_item > a, .sf-menu li.current-menu-item > a {border: 1px solid transparent !important }'."\n";
				elseif ( ot_get_option('nav_hover') =='3' ) :
					$styles .= '.sf-menu > li:hover > a, .sf-menu > li > a:hover, .sf-menu li.current_page_item > a, .sf-menu li.current-menu-item > a {border: 1px solid transparent !important;background: '. ot_get_option('theme_color') .';color: #fff !important}'."\n";
				endif;
			}

			if ( ot_get_option('nav_radius') !='20' ) {
				$styles .= '.sf-menu > li:hover > a, .sf-menu > li > a:hover, .sf-menu li.current_page_item > a, .sf-menu li.current-menu-item > a {border-radius: '.ot_get_option('nav_radius').'px !important }'."\n";
			}

			if ( ot_get_option('blocks_color') ) {
				$styles .= '.b_block {border-top: 2px solid '.ot_get_option('blocks_color').' !important }'."\n";
			}

			if ( ot_get_option('widgets_color') ) {
				$styles .= '.widget {border-top: 2px solid '.ot_get_option('widgets_color').' !important }'."\n";
			}

			if ( is_rtl() ) { 
				if ( ot_get_option('news-title-bg') ) {
					$styles .= '.sec_head .breaking {background-color: '.ot_get_option('news-title-bg').' !important }.sec_head .breaking:after {border-right: 15px solid '.ot_get_option('news-title-bg').' !important }'."\n";
				}
			} else {
				if ( ot_get_option('news-title-bg') ) {
					$styles .= '.sec_head .breaking {background-color: '.ot_get_option('news-title-bg').' !important }.sec_head .breaking:after {border-left: 15px solid '.ot_get_option('news-title-bg').' !important }'."\n";
				}
				
			}

			if ( ot_get_option('blocks-pattern') ) {
				$styles .= '.b_title:after {background: url('.ot_get_option('blocks-pattern').') repeat !important}'."\n";
			}

			if ( ot_get_option('blocks-pattern-footer') ) {
				$styles .= '#footer .b_title:after {background: url('.ot_get_option('blocks-pattern-footer').') repeat !important}'."\n";
			}

			if ( ot_get_option('hide_review') =='off' ) {
				$styles .= '.tt_review, #review {display: none !important}'."\n";
			}

			if ( ot_get_option('post_format_icons') =='off' ) {
				$styles .= '.thumb-icon i {display: none !important}'."\n";
			}
			$styles .= '.featured_thumb .thumb-icon {background: rgba('.$theme_color_rgb.', 0.4) !important}'."\n";
			$styles .= '.widget, .b_block {box-shadow: '.ot_get_option('blocks_shadow').'}'."\n";
			$styles .= '</style>'."\n";
			echo $styles;		
		}
	}

}
add_action( 'wp_head', 'T20_dynamic_css', 100 );
