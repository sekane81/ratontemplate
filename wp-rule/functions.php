<?php

/*-----------------------------------------------------------------------------------*/
/* Slightly Modified Options Framework
/*-----------------------------------------------------------------------------------*/
require_once ('admin/index.php');


/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
 * Theme supports.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_theme_setup' ) ) {	
	function ct_theme_setup(){

		// Makes theme available for translation.
		load_theme_textdomain( 'color-theme-framework', get_template_directory() . '/languages' );

		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions

		// This automatically adds the relevant feed links everywhere on the whole site.
		add_theme_support( 'automatic-feed-links' );

		// Registers a new image sizes.
		add_image_size( 'blog-thumb', 366, 9999 ); //366 pixels wide (and unlimited height)
		add_image_size( 'single-post-thumb', 770, 9999 ); //770 pixels wide (and unlimited height)
		add_image_size( 'single-post-thumb-crop', 770, 433, true ); //cropped single and cropped ratio for blog
		//add_image_size( 'carousel-thumb', 285, 190, true ); // carousel thumbnail
		add_image_size( 'small-thumb', 75, 75, true ); // small thumbnail
		
	}
}
add_action('after_setup_theme', 'ct_theme_setup');



/*-----------------------------------------------------------------------------------*/
/* TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/
require_once('includes/class-tgm-plugin-activation.php');
add_action('tgmpa_register', 'ct_register_required_plugins');

function ct_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'AJAX Thumbnail Rebuild', // The plugin name
			'slug'     				=> 'ajax-thumbnail-rebuild', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/includes/plugins/ajax-thumbnail-rebuild.1.08.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'CT Shortcodes', // The plugin name
			'slug'     				=> 'ct-shortcodes', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/includes/plugins/ct-shortcodes.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)		
	);

	// Change this to your theme text domain, used for internationalising strings
	//$theme_text_domain = 'color-theme-framework';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'color-theme-framework',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'color-theme-framework' ),
			'menu_title'                       			=> __( 'Install Plugins', 'color-theme-framework' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'color-theme-framework' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'color-theme-framework' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'color-theme-framework' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'color-theme-framework' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'color-theme-framework' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);
}




/*-----------------------------------------------------------------------------------*/
/* Add WP Menu Support
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_register_menus' ) ) {
	function ct_register_menus() { 
		register_nav_menus(
		array(
			'main_menu' => __( 'main navigation' , 'color-theme-framework' )
			//'bottom_menu' => __( 'bottom navigation' , 'color-theme-framework' )
			)
		);
	}
}
add_action( 'init', 'ct_register_menus' ); 


/*-----------------------------------------------------------------------------------*/
/* Get rid of ?ver on the end of CSS/JS files
/*-----------------------------------------------------------------------------------*/
function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/* Enable all HTML Tags in Profile Bios
/*-----------------------------------------------------------------------------------*/
//disable WordPress sanitization to allow more than just $allowedtags from /wp-includes/kses.php
remove_filter('pre_user_description', 'wp_filter_kses');
//add sanitization for WordPress posts
add_filter( 'pre_user_description', 'wp_filter_post_kses');


/*-----------------------------------------------------------------------------------*/
/* Convert Hex Color to RGB
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_hex2rgb' ) ) {
	function ct_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
}

/*-----------------------------------------------------------------------------------*/
/* Sticky Menu
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_sticky_menu' ) ) {
	function ct_sticky_menu() {
		global $ct_options;
		$sticky_menu = stripslashes( $ct_options['ct_sticky_menu'] );
		$menu_background = stripslashes( $ct_options['ct_menu_background'] );

		$rgb = ct_hex2rgb($menu_background);
		$rgba = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . "," . "0.9)";

		if ( $sticky_menu ) { ?>
			<script type="text/javascript">
			/* <![CDATA[ */
				jQuery.noConflict()(function($){
					$(document).ready(function(){
						var sticky_navigation_offset_top = $('#mainmenu-block-bg').offset().top+0;
						var sticky_navigation = function(){
							var scroll_top = $(window).scrollTop(); // our current vertical position from the top

							if (scroll_top > sticky_navigation_offset_top) { 
								<?php if ( !is_admin_bar_showing() ) : ?>
									$('#mainmenu-block-bg').css({ 'position': 'fixed', 'top':0, 'left':0, 'z-index':11 });
								<?php else : ?>
									$('#mainmenu-block-bg').css({ 'position': 'fixed', 'top':28, 'left':0, 'z-index':11 });
								<?php endif; ?>
							} else {
								$('#mainmenu-block-bg').css({ 'top':0, 'position': 'relative','padding-top':0 }); 
							}  
						};

						// run our function on load
						sticky_navigation();

						// and run it again every time you scroll
						$(window).scroll(function() {
							sticky_navigation();
						});
					});
				});
			/* ]]> */   
			</script>
		<?php
		}
	}
	add_action('wp_footer', 'ct_sticky_menu');
}


/*
*	-------------------------------------------------------------------------------------------------------
*	Add Google Analytics
*	-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists ( 'ct_func_google' ) ) {
	function ct_func_google() {
		global $ct_options;
		echo stripslashes ( $ct_options['ct_google_analytics'] );
	}
}

add_action('wp_footer', 'ct_func_google');



/*-----------------------------------------------------------------------------------*/
/* Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_title' ) ) {
	function ct_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'color-theme-framework' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'ct_wp_title', 10, 2 );
}


/*-----------------------------------------------------------------------------------*/
/* Registers our theme widget areas and sidebars
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_widgets_init' ) ) {
function ct_widgets_init() {
	register_sidebar(array(
		'name' => 'Homepage Sidebar',
		'id' => 'ct_home_sidebar',
		'description' => __( 'Appears on the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Single Post Sidebar',
		'id' => 'ct_single_sidebar',
		'description' => __( 'Appears on the Single post page', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Category Page Sidebar',
		'id' => 'ct_category_sidebar',
		'description' => __( 'Appears on the Category page', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'ct_page_sidebar',
		'description' => __( 'Appears on the Pages', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	global $ct_options;

	$footer_columns = $ct_options['ct_footer_columns'];

	for( $i=1; $i<$footer_columns+1;$i++) {

		register_sidebar(array(
			'name' => 'Footer Column #'.$i,				
			'before_widget' => '<div id="%1$s" class="footer-widget clearfix">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}	

}
add_action( 'widgets_init', 'ct_widgets_init' );
}



if ( !isset( $content_width ) ) 
	$content_width = 980;


/*-----------------------------------------------------------------------------------*/
/*  Adding the Farbtastic Color Picker
/*  register message box widget
/*-----------------------------------------------------------------------------------*/
if ( is_admin() ) {
	if ( !function_exists( 'ct_load_color_picker_script' ) ) {
		function ct_load_color_picker_script() {
		   wp_enqueue_script('farbtastic');
		}

		add_action('admin_print_scripts-widgets.php', 'ct_load_color_picker_script');
	}

	if ( !function_exists( 'ct_load_color_picker_style' ) ) {
		function ct_load_color_picker_style() {
		   wp_enqueue_style('farbtastic');	
		}

		add_action('admin_print_styles-widgets.php', 'ct_load_color_picker_style');
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Add Thumbnails in Manage Posts/Pages List
/*-----------------------------------------------------------------------------------*/
// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'ct_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'ct_add_post_thumbnail_column', 5);

// Add the column
function ct_add_post_thumbnail_column($cols){
  $cols['tcb_post_thumb'] = __('Featured', 'color-theme-framework');
  return $cols;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'ct_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'ct_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function ct_display_post_thumbnail_column($col, $id){
  switch($col){
	case 'tcb_post_thumb':
	  if( function_exists('the_post_thumbnail') )
		echo the_post_thumbnail( 'small-thumb' );
	  else
		echo 'Not supported in theme';
	  break;
  }
}

/*-----------------------------------------------------------------------------------*/
/*  Change excerpt length
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_new_excerpt_length' ) ) {
	function ct_new_excerpt_length($length) {
		return 999;
	}
}
add_filter('excerpt_length', 'ct_new_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*  Change excerpt more string
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_new_excerpt_more' ) ) {
	function ct_new_excerpt_more($more) {
		return '...';
	}
}
add_filter('excerpt_more', 'ct_new_excerpt_more');



/*-----------------------------------------------------------------------------------*/
/*  Add Admin Bar only for Editors
/*-----------------------------------------------------------------------------------*/
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}



/*-----------------------------------------------------------------------------------*/
/*  Show Featured Images in RSS Feed
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_featuredtorss' ) ) {
	function ct_featuredtorss($content) {
		global $post;
		if ( has_post_thumbnail( $post->ID ) ){
			$content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
		}
		return $content;
	}
}
add_filter('the_excerpt_rss', 'ct_featuredtorss');
add_filter('the_content_feed', 'ct_featuredtorss');



/*-----------------------------------------------------------------------------------*/
/*  Enable Shortcodes In Sidebar Widgets
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');



/*-----------------------------------------------------------------------------------*/
/*  Enqueues scripts for front-end
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'ct_scripts_method');

if ( !function_exists( 'ct_scripts_method' ) ) {
function ct_scripts_method() {

	//enqueue jquery
	wp_enqueue_script('jquery');

	if( !is_admin() ) {
	
		global $ct_options;

		$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );

		/* Super Fish JS */
		wp_register_script('ct-super-fish',get_template_directory_uri().'/js/superfish.js',false, null , true);
		wp_enqueue_script('ct-super-fish',array('jquery'));	

		/* Google Prettify */
		wp_register_script('ct-google-prettify',get_template_directory_uri().'/js/prettify.js',false, null , true);
		wp_enqueue_script('ct-google-prettify',array('jquery'));

		/* Retina */
		wp_register_script('ct-retina-js',get_template_directory_uri().'/js/retina.js',false, null , true);
		wp_enqueue_script('ct-retina-js',array('jquery'));

		/* To Top */
		wp_register_script('ct-scrolltopcontrol-js',get_template_directory_uri().'/js/scrolltopcontrol.js',false, null , true);
		wp_enqueue_script('ct-scrolltopcontrol-js',array('jquery'));

		/* Prettyphoto */
		wp_register_script('ct-prettyphoto-js',get_template_directory_uri().'/js/jquery.prettyphoto.js',false, null , true);
		wp_enqueue_script('ct-prettyphoto-js',array('jquery'));

		/* Masonry */
		wp_register_script('ct-masonry-js',get_template_directory_uri().'/js/jquery.masonry.min.js',false, null , true);
		wp_enqueue_script('ct-masonry-js',array('jquery'));

		if( $pagination_type == 'Infinite Scroll' ) :
			/* Infinite */
			wp_register_script('ct-infinitescroll-js',get_template_directory_uri().'/js/jquery.infinitescroll.min.js',false, null , true);
			wp_enqueue_script('ct-infinitescroll-js',array('jquery'));

			/* Images Load */
			wp_register_script('ct-imagesloaded-js',get_template_directory_uri().'/js/jquery.imagesloaded.min.js',false, null , true);
			wp_enqueue_script('ct-imagesloaded-js',array('jquery'));
		endif;

		/* Bootstrap */
		wp_register_script('ct-jquery-bootstrap',get_template_directory_uri().'/js/bootstrap.js',false, null , true);
		wp_enqueue_script('ct-jquery-bootstrap',array('jquery'));

		/* Custom JS */
		wp_register_script('ct-custom-js',get_template_directory_uri().'/js/custom.js',false, null , true);
		wp_enqueue_script('ct-custom-js',array('jquery'));

		/*
		* Adds JavaScript to pages with the comment form to support
		* sites with threaded comments (when in use).
		*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

	} /* End Include jQuery Libraries */
  }
}


/*-----------------------------------------------------------------------------------*/
/*  Enqueues styles for front-end
/*-----------------------------------------------------------------------------------*/
if ( !function_exists ('ct_header_styles' ) ) {
	function ct_header_styles() {

		global $wp_styles, $ct_options;
		$responsive_layout = $ct_options['ct_responsive_layout'];

		wp_enqueue_style( 'bootstrap-main-style',get_template_directory_uri().'/css/bootstrap.css','','','all');	
		wp_enqueue_style( 'font-awesome-style',get_template_directory_uri().'/css/font-awesome.min.css','','','all');
		if ( $responsive_layout ) {
			wp_enqueue_style( 'bootstrap-responsive',get_template_directory_uri().'/css/bootstrap-responsive.css','','','all');
		}
		wp_enqueue_style( 'ct-flexslider',get_template_directory_uri().'/css/flexslider.css','','','all');
		wp_enqueue_style( 'ct-style',get_stylesheet_directory_uri().'/style.css','','','all');
		if ( $responsive_layout ) {
			wp_enqueue_style( 'ct-rwd-style',get_template_directory_uri().'/css/rwd-styles.css','','','all');
		}
		wp_enqueue_style( 'prettyphoto-style',get_template_directory_uri().'/css/prettyphoto.css','','','all');
		wp_enqueue_style( 'options-css-style',get_template_directory_uri().'/css/options.css','','','all');
	}
}

add_action('wp_print_styles', 'ct_header_styles'); 


/*-----------------------------------------------------------------------------------*/
/* Add Google Fonts for Headings 
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_custom_fonts' ) ) {
		function ct_custom_fonts() {
			global $ct_options;
		
			$google_fonts = stripslashes( $ct_options['ct_google_fonts']['face'] );

			if ( !empty( $google_fonts ) ) {
				echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=' . str_replace(" ", "%20", $google_fonts) . ':300,400,400italic,700,700italic" type="text/css" />';								
				echo '<style type="text/css">h1,h2,h3,h4,h5,h6, h3.widget-title { ';
				echo 'font-family: "' . $google_fonts .'", Arial, sans-serif';
				echo '}</style>';
			}
	}
}
add_action('wp_head','ct_custom_fonts');


/*-----------------------------------------------------------------------------------*/
/*  Fav and touch icons
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_fav_icons' ) ) {
	function ct_fav_icons() {
		global $ct_options;
			
		echo "<!-- Fav and touch icons -->\n";
		echo "<link rel=\"shortcut icon\" href=\"" . stripslashes( $ct_options['ct_custom_favicon'] ) . "\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"" . get_template_directory_uri() . "/img/icons/apple-touch-icon-144-precomposed.png\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"" . get_template_directory_uri() ."/img/icons/apple-touch-icon-114-precomposed.png\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"" . get_template_directory_uri() ."/img/icons/apple-touch-icon-72-precomposed.png\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" href=\"" . get_template_directory_uri() . "/img/icons/apple-touch-icon-57-precomposed.png\">\n";

		echo "<!--[if IE 7]>\n";
		echo "<link rel=\"stylesheet\" href=\"" . get_template_directory_uri() . "/css/font-awesome-ie7.min.css\">\n";
		echo "<![endif]-->\n";
	}
}
add_action('wp_head','ct_fav_icons');


/*-----------------------------------------------------------------------------------*/
/* Add IE conditional fix to header 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_ie_fix' ) ) {
	function ct_ie_fix () {
		echo "<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->\n";
		echo "<!--[if lt IE 9]>\n";
		echo "<script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>\n";
		echo "<script src=\"" . get_template_directory_uri() . "/js/respond.min.js\"></script>\n";
		echo "<![endif]-->\n";

		echo "<script>if(Function('/*@cc_on return 10===document.documentMode@*/')()){document.documentElement.className='ie10';}</script>";

		$IE10 = (ereg('MSIE 10',$_SERVER['HTTP_USER_AGENT'])) ? true : false;
		if ( $IE10 == 1 ) {
			echo "<style type=\"text/css\">\n .video-post-widget, .single-video-post, .single-media-thumb, .embed-youtube, .embed-vimeo, .video-frame {position: relative;padding-bottom: 56.25%; height: 0;} .video-post-widget iframe, .single-video-post iframe, .single-media-thumb iframe, .embed-youtube iframe, .embed-vimeo iframe, .video-frame iframe { position: absolute;top: 0;left: 0;width: 100%;height: 100%;}</style>\n";
		}
	}
}
add_action('wp_head', 'ct_ie_fix');



/*-----------------------------------------------------------------------------------*/
/* Get Related Post function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_related_posts' ) ) {
	function ct_get_related_posts($post_id, $tags = array(), $posts_number_display, $order_by) {
		$query = new WP_Query();

		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);

		if($tags) {
			foreach($tags as $tag) {
				$tagsA[] = $tag->term_id;
			}
		}
	   $query = new WP_Query( array('orderby'				=> $order_by,
									'showposts'				=> $posts_number_display,
									'post_type'				=> $post_types,
									'post__not_in'			=> array($post_id),
									'tag__in'				=> $tagsA,
									'ignore_sticky_posts'	=> 1 
									)
							);
		return $query;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Pagination function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_pagination' ) ) {
	function ct_pagination($pages = '', $range = 4)
	{  
		$showitems = ($range * 2)+1;  
 
		global $paged;
		if(empty($paged)) $paged = 1;
 
		if($pages == '')
		{
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}   
 
		if(1 != $pages)
		{
			echo "<div class=\"pagination clearfix\" role=\"navigation\">";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
			echo "</div>\n";
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Styles for Backend Options
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'ct_upload_styles_post' ) ) {
	function ct_upload_styles_post() {
		wp_enqueue_style( 'style-metabox-admin',get_template_directory_uri().'/admin/assets/css/metabox-options.css','','','all');
	}

	add_action('admin_print_styles', 'ct_upload_styles_post'); 
}



/*-----------------------------------------------------------------------------------*/
/* Get DailyMotion Thumbnail
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'getDailyMotionThumb' ) ) {
	function getDailyMotionThumb( $id ) {
		if ( ! function_exists( 'curl_init' ) ) {
			return null;
		}
		else {
		  $ch = curl_init();
		  $videoinfo_url = "https://api.dailymotion.com/video/$id?fields=thumbnail_url";
		  curl_setopt( $ch, CURLOPT_URL, $videoinfo_url );
		  curl_setopt( $ch, CURLOPT_HEADER, 0 );
		  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		  curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		  curl_setopt( $ch, CURLOPT_FAILONERROR, true ); // Return an error for curl_error() processing if HTTP response code >= 400
		  $output = curl_exec( $ch );
		  $output = json_decode( $output );
		  $output = $output->thumbnail_url;
		  if ( curl_error( $ch ) != null ) {
			$output = new WP_Error( 'dailymotion_info_retrieval', __( 'Error retrieving video information from the URL','color-theme-framework') . '<a href="' . $videoinfo_url . '">' . $videoinfo_url . '</a>.<br /><a href="http://curl.haxx.se/libcurl/c/libcurl-errors.html">Libcurl error</a> ' . curl_errno( $ch ) . ': <code>' . curl_error( $ch ) . '</code>. If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.' );
		  }
		  curl_close( $ch ); // Moved here to allow curl_error() operation above. Was previously below curl_exec() call.
		  return $output;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get Post Count
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_post_count' ) ) {
	function ct_get_post_count() {
	   $res_search = &new WP_Query("showposts=-1");
	   $count = $res_search->post_count;

	   return $count; 
		 
	   wp_reset_query();
	   unset($res_search, $count);
	}
}



/*-----------------------------------------------------------------------------------*/
/* Set an option for a cURL transfer
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_curl_subscribers_text_counter' ) ) {
	function ct_curl_subscribers_text_counter( $xml_url ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $xml_url);
		$ct_options = curl_exec($ch);
		curl_close($ch);
		return $ct_options;
	}
}


/*-----------------------------------------------------------------------------------*/
/* This is function gets the post views and display it in admin panel.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'getPostViews' ) ) {
	function getPostViews( $postID ){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);

		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0";
		}
		return $count. __('','color-theme-framework');
	}
}

if ( !function_exists( 'setPostViews' ) ) {
	function setPostViews($postID) {
	if (!current_user_can('administrator') ) :
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	endif;
	}
}

if ( !function_exists( 'posts_column_views' ) ) {
	function posts_column_views($defaults){
		$defaults['post_views'] = __( 'Views' , 'color-theme-framework' );
		return $defaults;
	}
}

if ( !function_exists( 'posts_custom_column_views' ) ) {
	function posts_custom_column_views($column_name, $id){
		if( $column_name === 'post_views' ) {
			echo getPostViews( get_the_ID() );
		}
	}
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);


/*
*	-------------------------------------------------------------------------------------------------------
*	Exclude pages from search, if value set in theme options
*	-------------------------------------------------------------------------------------------------------
*/


if ( !function_exists( 'ct_search_filter_page' ) ) {
	function ct_search_filter_page( $query ) {
			global $ct_options;
		
		$exclude_page = stripslashes( $ct_options['ct_exclude_search_page'] );
		
		if ( $exclude_page == 1 ) {
			if ($query->is_search) {
				$query->set('post_type',  array( 'post' ));
			}
		}	
		return $query;
	}
}	
add_filter('pre_get_posts','ct_search_filter_page'); 


/*-----------------------------------------------------------------------------------*/
/* Remove rel attribute from the category list
/*-----------------------------------------------------------------------------------*/
function ct_remove_category_list_rel($output)
{
	$output = str_replace(' rel="category"', '', $output);
	return $output;
}

add_filter('wp_list_categories', 'ct_remove_category_list_rel');
add_filter('the_category', 'ct_remove_category_list_rel');

add_filter( 'the_category', 'ct_replace_cat_tag' );

function ct_replace_cat_tag ( $text ) {
	$text = str_replace('rel="category tag"', "", $text); return $text;
}




/*-----------------------------------------------------------------------------------*/
/* Add Theme Widgets
/*-----------------------------------------------------------------------------------*/
include("functions/ct-flickr-widget.php");
include("functions/ct-instagram-widget.php");
include("functions/ct-categories-widget.php");
include("functions/ct-twitter-widget.php");
include("functions/ct-popular-posts-widget.php");
include("functions/ct-recent-posts-widget.php");
include("functions/ct-small-slider-widget.php");
include("functions/ct-related-posts-thumbs-widget.php");

/* Post Like */
require_once("post-like.php");

/* Metabox components */
require_once("meta-box/meta-box.php");

/* Theme Metaboxes */
require_once("includes/theme-metaboxes.php");

/* Sidebar Generator */
require_once ('includes/sidebar-generator.php');

/* Update notifier */
//require_once ("includes/update-notifier.php");


/*-----------------------------------------------------------------------------------*/
/* Shortcode Formatter
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_shortcodes_formatter' ) ) {
	function ct_shortcodes_formatter($content) {
		$shortcode = join("|",array( "row", "clear" , "ct_testimonials" , "ct_testimonial" , "ct_button" , "ct_alert" , "ct_margin" , "ct_highlight", "ct_dropcap" , "ct_divider" , "ct_plus" , "ct_label" , "ct_badge" , "ct_toggle" , "ct_works" , "ct_progress" , "ct_icon" , "ct_posts" , "ct_toggle" , "ct_slider" , "ct_ul" , "ct_li" , "ct_tab" , "ct_price" , "ct_price_option" , "ct_infobox" , "ct_infoblock" , "ct_headings" , "ct_video" , "ct_soundcloud" , "ct_collapses" , "ct_collapse"));

		// opening tag
		$output = preg_replace("/(<p>)?\[($shortcode)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

		// closing tag
		$output = preg_replace("/(<p>)?\[\/($shortcode)](<\/p>|<br \/>)/","[/$2]",$output);

		return $output;
	}

	add_filter('the_content', 'ct_shortcodes_formatter');
	add_filter('widget_text', 'ct_shortcodes_formatter');
}

/*-----------------------------------------------------------------------------------*/
/* Get Post Meta
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_post_meta' ) ) {
	function ct_get_post_meta( $ct_postid, $ct_comments , $ct_views, $ct_likes ) { 

		global $post;
		?>

		<?php if ( $ct_comments == 1 ) { ?>
			<?php if ( comments_open() ) : ?>
			<span class="meta-comments">
				<i class="icon-comment"></i>
				<?php comments_popup_link(__('0','color-theme-framework'),__('1','color-theme-framework'),__('%','color-theme-framework')); ?>
			</span><!-- .meta-comments -->
			<?php endif; ?>
		<?php } ?>


		<?php if ( $ct_views == 1 ) { ?>
		<span class="meta-views" title="<?php _e('Views','color-theme-framework'); ?>">
			<i class="icon-eye-open"></i>
			<?php echo getPostViews($ct_postid); ?>
		</span><!-- .meta-views -->
		<?php } ?>

		<?php if ( $ct_likes == 1 ) { ?>
		<span class="meta-likes" title="<?php _e('Likes','color-theme-framework'); ?>">
			<?php getPostLikeLink( $ct_postid ); ?>
		</span><!-- .meta-likes -->
		<?php } ?>
		

		<?php 
			$post_type = get_post_meta( $post->ID, 'ct_mb_post_type', true);
			if ( $post_type == 'review_post' ) {
				ct_get_rating_stars();
			} 
			if ( $post_type == 'review_post_numeric' ) {
				ct_get_rating_numeric();
			} 
		?>

<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get author for comment
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_get_author' ) ) :
function ct_get_author($comment) {
	$author = "";
	if ( empty($comment->comment_author) )
		$author = __('Anonymous', 'color-theme-framework');
	else
		$author = $comment->comment_author;
	return $author;
}
endif;



/*-----------------------------------------------------------------------------------*/
/*  This will add rel=lightbox[postid] to the href of the image link
/*-----------------------------------------------------------------------------------*/
$add_prettyphoto = stripslashes( $ct_options['ct_add_prettyphoto'] );

if ( $add_prettyphoto ) :
	if ( !function_exists( 'ct_add_prettyphoto_rel' ) ) {
		function ct_add_prettyphoto_rel ($content)
		{   
			global $post;
			$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
			$replacement = '<a$1href=$2$3.$4$5 rel="prettyphoto['.$post->ID.']"$6>$7</a>';
			$content = preg_replace($pattern, $replacement, $content);
			return $content;
		}
		add_filter('the_content', 'ct_add_prettyphoto_rel', 12);
	}
endif;


/*-----------------------------------------------------------------------------------*/
/*  Custom Background and Custom CSS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_custom_head_css' ) ) {
	function ct_custom_head_css() {

		$output = '';

		global $wp_query, $ct_options;
		if( is_home() ) {
			$postid = get_option('page_for_posts');
		} elseif( is_search() || is_404() || is_category() || is_tag() || is_author() ) {
			$postid = 0;
		} else {
			$postid = $wp_query->post->ID;
		}

		/* -- Get the unique custom background image for page --------------------*/
		$bg_img = get_post_meta($postid, 'ct_mb_background_image', true);
		$src = wp_get_attachment_image_src( $bg_img, 'full' );
		$bg_img = $src[0];

		if( empty($bg_img) ) {
			/* -- Background image not defined, fallback to default background -- */
			$bg_pos = strtolower ( stripslashes ( $ct_options['ct_default_bg_position'] ) );
			if ( $bg_pos == 'full screen' ) {
				$bg_pos = 'full';
			}
			$bg_type = stripslashes ( $ct_options['ct_default_bg_type'] );

			if( $bg_pos != 'full' ) {
				/* -- Setup body backgroung image, if not fullscreen -- */
				if ( $bg_type == 'Uploaded' ) {
					$bg_img = stripslashes ( $ct_options['ct_default_bg_image'] );
				} else if ( $bg_type == 'Predefined' ) {
					$bg_img = stripslashes ( $ct_options['ct_default_predefined_bg'] );
				}

				if( !empty($bg_img) ) {
					$bg_img = " url($bg_img)";
				} else {
					$bg_img = " none";
				}

				$bg_repeat = strtolower ( stripslashes ( $ct_options['ct_default_bg_repeat'] ) );
				$bg_attachment = strtolower ( stripslashes ( $ct_options['ct_default_bg_attachment'] ) );
				$bg_color = get_post_meta($postid, 'ct_mb_background_color', true);

				if( empty($bg_color) ) { 
					$bg_color = stripslashes ( $ct_options['ct_body_background'] );
				}

				$output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: $bg_attachment;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";
			}    
		} else {
			/* -- Custom image defined, check default position -------------------- */
			$bg_pos = get_post_meta($postid, 'ct_mb_background_position', true);

			if( $bg_pos != 'full' ) {
				/* -- Setup body backgroung image, if not fullscreen -- */
				$bg_img = " url($bg_img)";

				/* -- Get the repeat and backgroung color options -- */
				$bg_repeat = get_post_meta($postid, 'ct_mb_background_repeat', true);
				$bg_attachment = get_post_meta($postid, 'ct_mb_background_attachment', true);
				$bg_color = get_post_meta($postid, 'ct_mb_background_color', true);

				if( empty($bg_color) ) {
					$bg_color = stripslashes ( $ct_options['ct_body_background'] );
				}

				$output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: $bg_attachment;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";
			}
		}
		
		/* -- Custom CSS from Theme Options --------------------*/
		$custom_css = stripslashes ( $ct_options['ct_custom_css'] );
	
		if ( !empty($custom_css) ) {
			$output .= $custom_css . "\n";
		}
		
		/* -- Output our custom styles --------------------------*/
		if ($output <> '') {
			$output = "<!-- Custom Styles -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
	
	}

	add_action('wp_head', 'ct_custom_head_css');
}



/*-----------------------------------------------------------------------------------*/
/* Load JS
/*-----------------------------------------------------------------------------------*/
function load_js() {
	global $ct_options;

	$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );
	?>

	<script type="text/javascript">
	/* <![CDATA[ */

	// Masonry
	jQuery.noConflict()(function($){
		$(document).ready(function() {

			var $container = $('#blog-entry');

			$container.imagesLoaded(function(){
			  $container.masonry({
					itemSelector: '.masonry-box',
					isAnimated: true
			  });
			});

<?php 

if( $pagination_type == 'Infinite Scroll' ) : ?>
	// Infinite Scroll

	$container.infinitescroll({
		navSelector  : '.pagination',    // selector for the paged navigation 
		nextSelector : '.pagination a',  // selector for the NEXT link (to page 2)
		itemSelector : '.masonry-box',     // selector for all items you'll retrieve
		loading: {
			finishedMsg: 'No more posts to load.',
			img: '<?php echo get_template_directory_uri(); ?>/img/ajax-loader.gif'
		}
	},

	// trigger Masonry as a callback
	function( newElements ) {
		var $newElems = $( newElements ).css({ opacity: 0 });

		$newElems.imagesLoaded(function()   {
			$newElems.animate({ opacity: 1 });
			$container.masonry( 'appended', $newElems, true ); 

			// post like system
			$(".post-like a").click(function() {

				heart = $(this);
				post_id = heart.data("post_id");

				$.ajax({
						type: "post",
						url: ajax_var.url,
						data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
						success: function(count){
							if(count != "already") {
								heart.addClass("voted");
								heart.siblings(".count").text(count);
							}
						}
				});
				return false;
			}) // end post like system		

		});
	});
 
 <?php endif; ?>
 

	});
});
/* ]]> */   
	</script>
<?php
}

add_action('wp_footer', 'load_js');



/*-----------------------------------------------------------------------------------*/
/* If we go beyond the last page and request a page that doesn't exist,
 * force WordPress to return a 404.
 * See http://core.trac.wordpress.org/ticket/15770
/*-----------------------------------------------------------------------------------*/
function ct_custom_paged_404_fix( ) {
	global $wp_query;
	if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
		return;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
}
add_action( 'wp', 'ct_custom_paged_404_fix' );


/*-----------------------------------------------------------------------------------*/
/* Displays page links for paginated posts/pages
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_link_pages' ) ) {
	function ct_wp_link_pages( $args = '' ) {
		$defaults = array(
			'before' => '<p class="pagination clearfix"><span>' . __( 'Pages:', 'color-theme-framework' ) . '</span>', 
			'after' => '</p>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => __( 'Next page', 'color-theme-framework' ),
			'previouspagelink' => __( 'Previous page', 'color-theme-framework' ),
			'pagelink' => '%',
			'echo' => 1
		);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow;

		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= _wp_link_page( $i );
					else
						$output .= '<span class="current">';

					$output .= $text_before . $j . $text_after;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= '</a>';
					else
						$output .= '</span>';
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}

		if ( $echo )
			echo $output;

		return $output;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get rating numeric
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_rating_numeric' ) ) {
	function ct_get_rating_numeric() {
		global $post;

		$num_over_score = get_post_meta( $post->ID, 'ct_mb_overall_numeric_review', true);
		$num_bg_color = get_post_meta( $post->ID, 'ct_mb_review_numeric_bg_color', true);		
		$num_text_color = get_post_meta( $post->ID, 'ct_mb_review_numeric_value_color', true);

		if ( empty( $num_bg_color ) ) $num_bg_color = '#000000';
		if ( empty( $num_text_color ) ) $num_text_color = '#FFFFFF';


		echo '<div class="entry-numeric-review" title="'. __( 'Overall Score' , 'color-theme-framework' ) .'" style="background-color: ' . $num_bg_color . '; color: ' . $num_text_color . '">';
			echo $num_over_score;
		echo '</div> <!-- /entry-numeric-review -->';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get rating stars (big)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_rating_stars' ) ) {
	function ct_get_rating_stars() {

		global $post;
		$output = '';

		$stars_color = get_post_meta( $post->ID, 'ct_mb_stars_color', true);
		if ( $stars_color == '' ) $stars_color = '#DD0C0C';

		$overall_score = get_post_meta($post->ID, 'ct_mb_over_score', true);

		if ( $overall_score == '' ) $score = 'zero';

		switch( $overall_score ) {
			case 0:
				$score = 'zero';
				$output .= '';
				break;
			case 0.5:
				$score = 'zero_half';
				$output .= '<i class="icon-star-half-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 1:
				$score = 'one';
				$output .= '<i class="icon-star"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 1.5:
				$score = 'one_half';
				$output .= '<i class="icon-star"></i><i class="icon-star-half-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 2:
				$score = 'two';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 2.5:
				$score = 'two_half';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 3:
				$score = 'three';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 3.5:
				$score = 'three_half';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 4:
				$score = 'four';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-empty"></i>';
				break;
			case 4.5:
				$score = 'four_half';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half-empty"></i>';
				break;
			case 5:
				$score = 'five';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
		}

		echo '<span class="meta-stars ' . $score . '" title="'.__('Review Score: ','color-theme-framework'). $overall_score . '" style="color:'. $stars_color . '">'.$output.'</span>';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get Single Star Rating (for criteria)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_single_rating' ) ) {
	function ct_get_single_rating( $score_value, $local_ID ) {

//echo $score_value;
//		$score_value = 4.5;
		$output_stars = '';
		$stars_color = get_post_meta( $local_ID , 'ct_mb_stars_color', true);          
		if ( $stars_color == '' ) $stars_color = '#DD0C0C';

		if ( $score_value == '' ) $score = 'zero';

	switch( $score_value ) {
			case 0:
				$score = 'zero';
				$output_stars = '';
				break;
			case 0.5:
				$score = 'zero_half';
				$output_stars = '<i class="icon-star-half-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 1:
				$score = 'one';
				$output_stars = '<i class="icon-star"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 1.5:
				$score = 'one_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star-half-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 2:
				$score = 'two';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 2.5:
				$score = 'two_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half-empty"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 3:
				$score = 'three';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 3.5:
				$score = 'three_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half-empty"></i><i class="icon-star-empty"></i>';
				break;
			case 4:
				$score = 'four';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-empty"></i>';
				break;
			case 4.5:
				$score = 'four_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half-empty"></i>';
				break;
			case 5:
				$score = 'five';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
		}
		return '<span class="meta-stars ' . $score . '" title="'.__('Criteria Score: ','color-theme-framework'). $score_value . '" style="color:'. $stars_color . '">' . $output_stars . '</span>';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Displays Read more link
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_get_readmore' ) ) {
	function ct_get_readmore() {
		echo "<a class=\"read-more\" href=\"" . get_permalink() . "\" title=\"" . __('Permalink to ','color-theme-framework') . the_title('','',false) . "\">" . __('more','color-theme-framework') ."</a>";
	}
}

/*-----------------------------------------------------------------------------------*/
/* Print an excerpt by specifying a maximium number of characters.
/*-----------------------------------------------------------------------------------*/
function ct_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Template for comments and pingbacks.
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_comment' ) ) :
function ct_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'color-theme-framework' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'color-theme-framework' ), '<i class="icon-pencil"></i><span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment clearfix">
			<header class="comment-meta comment-author vcard">
				<?php
					echo '<div class="comment-avatar">' . get_avatar( $comment, 75 ) . '</div>';

					echo '<strong>' . get_comment_author_link() . '</strong>';
					// If current post author is also comment author, make it known visually.
					if ( $comment->user_id == $post->post_author ) {
						echo '<span class="muted-small"> ' . __( '(author)', 'color-theme-framework' ) . '</span>';
					} else echo '';

					echo '<br />';		
					
					printf( '<a class="comment-meta-time muted-small" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'color-theme-framework' ), get_comment_date(), get_comment_time() )
					);

				?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'color-theme-framework' ), 'after' => ' &rarr;', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'color-theme-framework' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'color-theme-framework' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>
			</section><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;