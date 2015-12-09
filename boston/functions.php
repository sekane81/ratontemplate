<?php

	/**********************************************************************
	***********************************************************************
	COUPON FUNCTIONS
	**********************************************************************/
require_once( locate_template( 'includes/class-tgm-plugin-activation.php' ) );
require_once( locate_template( 'includes/google-fonts.php' ) );
require_once( locate_template( 'includes/awesome-icons.php' ) );
require_once( locate_template( 'includes/widgets.php' ) );
require_once( locate_template( 'includes/gallery.php' ) );
require_once( locate_template( 'includes/twitter_api.php' ) );
require_once( locate_template( 'includes/theme-options.php' ) );
require_once get_template_directory() .'/includes/radium-one-click-demo-install/init.php';
if( is_admin() ){
	require_once( locate_template( 'includes/shortcodes.php' ) );
}
foreach ( glob( dirname(__FILE__).DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR ."shortcodes".DIRECTORY_SEPARATOR ."*.php" ) as $filename ){
	require_once( locate_template( 'includes/shortcodes/'.basename( $filename ) ) );
}


add_action( 'tgmpa_register', 'boston_requred_plugins' );
function boston_requred_plugins(){
	$plugins = array(
		array(
				'name'                 => 'Redux Options',
				'slug'                 => 'redux-framework',
				'source'               => get_stylesheet_directory() . '/lib/plugins/redux-framework.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => 'Smeta',
				'slug'                 => 'smeta',
				'source'               => get_stylesheet_directory() . '/lib/plugins/smeta.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => 'User Avatars',
				'slug'                 => 'wp-user-avatar',
				'source'               => get_stylesheet_directory() . '/lib/plugins/wp-user-avatar.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),		
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
			'domain'           => 'boston',
			'default_path'     => '',
			'parent_menu_slug' => 'themes.php',
			'parent_url_slug'  => 'themes.php',
			'menu'             => 'install-required-plugins',
			'has_notices'      => true,
			'is_automatic'     => false,
			'message'          => '',
			'strings'          => array(
				'page_title'                      => __( 'Install Required Plugins', 'boston' ),
				'menu_title'                      => __( 'Install Plugins', 'boston' ),
				'installing'                      => __( 'Installing Plugin: %s', 'boston' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'boston' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'boston' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'boston' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'boston' ),
				'nag_type'                        => 'updated'
			)
	);

	tgmpa( $plugins, $config );
}

if (!isset($content_width)){
	$content_width = 1920;
}

/* do shortcodes in the excerpt */
add_filter('the_excerpt', 'do_shortcode');

function jonas_sidebar_widget_check( $instance, $this, $args ){
	if( empty( $instance['title'] ) && stristr( $args['widget_id'], 'search' ) ){
		$instance['title'] = __( 'Search', 'jonas' );
	}

	return $instance;
}
add_filter('widget_display_callback', 'jonas_sidebar_widget_check', 10, 3);

function boston_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'boston_set_post_views', 10, 0);


function boston_track_post_views ($post_id) {
    if ( !is_singular('post') ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    boston_set_post_views($post_id);
}
add_action( 'wp_head', 'boston_track_post_views');

/* include custom made widgets */
function boston_widgets_init(){
	
	register_sidebar(array(
		'name' => __('Blog Sidebar', 'boston') ,
		'id' => 'sidebar-blog',
		'before_widget' => '<div class="widget clearfix %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-header"><h3>',
		'after_title' => '</h3></div><div class="widget-inner">',
		'description' => __('Appears on the right side of the blog.', 'boston')
	));
	
	register_sidebar(array(
		'name' => __('Page Sidebar Right', 'boston') ,
		'id' => 'sidebar-right',
		'before_widget' => '<div class="widget clearfix %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-header"><h3>',
		'after_title' => '</h3></div><div class="widget-inner">',
		'description' => __('Appears on the right side of the page.', 'boston')
	));

	register_sidebar(array(
		'name' => __('Page Sidebar Left', 'boston') ,
		'id' => 'sidebar-left',
		'before_widget' => '<div class="widget clearfix %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-header"><h3>',
		'after_title' => '</h3></div><div class="widget-inner">',
		'description' => __('Appears on the left side of the page.', 'boston')
	));	

	register_sidebar(array(
		'name' => __('Bottom Sidebar 1', 'boston') ,
		'id' => 'sidebar-bottom-1',
		'before_widget' => '<div class="footer-widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="f-widget-header"><h6>',
		'after_title' => '</h6></div>',
		'description' => __('Appears at the bottom of the page.', 'boston')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 2', 'boston') ,
		'id' => 'sidebar-bottom-2',
		'before_widget' => '<div class="footer-widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="f-widget-header"><h6>',
		'after_title' => '</h6></div>',
		'description' => __('Appears at the bottom of the page.', 'boston')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 3', 'boston') ,
		'id' => 'sidebar-bottom-3',
		'before_widget' => '<div class="footer-widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="f-widget-header"><h6>',
		'after_title' => '</h6></div>',
		'description' => __('Appears at the bottom of the page.', 'boston')
	));	

	register_sidebar(array(
		'name' => __('Bottom Sidebar 4', 'boston') ,
		'id' => 'sidebar-bottom-4',
		'before_widget' => '<div class="footer-widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="f-widget-header"><h6>',
		'after_title' => '</h6></div>',
		'description' => __('Appears at the bottom of the page.', 'boston')
	));	
}

add_action('widgets_init', 'boston_widgets_init');


function boston_wp_title( $title, $sep ) {
	global $paged, $page, $boston_slugs;

	if ( is_feed() ){
		return $title;
	}
	if( is_page() && get_page_template_slug( get_the_ID() ) == 'page-tpl_my_profile.php' ){
		return $title;
	}

	$keyword = get_query_var( $boston_slugs['keyword'] );
	if( !empty( $keyword ) ){
		$title = str_replace( '_', ' ', urldecode( $keyword ) )." $sep ".$title;
	}

	$offer_store = get_query_var( $boston_slugs['offer_store'] );
	if( !empty( $offer_store ) ){
		$title = get_the_title( $offer_store )." $sep ".$title;
	}

	$location = get_query_var( $boston_slugs['location'] );
	if( !empty( $location ) ){
		$term = get_term_by( 'slug', $location, 'location' );
		$title = $term->name." $sep ".$title;
	}

	$offer_cat = get_query_var( $boston_slugs['offer_cat'] );
	if( !empty( $offer_cat ) ){
		$term = get_term_by( 'slug', $offer_cat, 'offer_cat' );
		$title = $term->name." $sep ".$title;
	}

	return $title;
}
add_filter( 'wp_title', 'boston_wp_title', 10, 2 );

function boston_set_direction() {
	global $wp_locale, $wp_styles;

	$_user_id = get_current_user_id();
	$direction = boston_get_option( 'direction' );
	if( empty( $direction ) ){
		$direction = 'ltr';
	}

	if ( $direction ) {
		update_user_meta( $_user_id, 'rtladminbar', $direction );
	} else {
		$direction = get_user_meta( $_user_id, 'rtladminbar', true );
		if ( false === $direction )
			$direction = isset( $wp_locale->text_direction ) ? $wp_locale->text_direction : 'ltr' ;
	}

	$wp_locale->text_direction = $direction;
	if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
		$wp_styles = new WP_Styles();
	}
	$wp_styles->text_direction = $direction;
}
add_action( 'init', 'boston_set_direction' );


/* total_defaults */
function boston_defaults( $id ){	
	$defaults = array(
		'site_favicon' => array( 'url' => ''),
		'site_logo' => array( 'url' => ''),
		'site_logo_dark' => array( 'url' => ''),
		'logo_padding' => '',
		'enable_sticky' => 'no',
		'header_style' => 'style1',
		'featured_visible_items' => '3',
		'site_style' => 'light',
		'secondary_color' => '#6bbafd',
		'main_font' => 'Open Sans',
		'footer_text' => '',
		'blog_listing_layout' => 'right_sidebar',
		'blog_listing_single_layout' => 'right_sidebar',
		'blog_single_author_desc_length' => '100',
		'blog_title_max_length' => '60',
		'blog_excerpt_max_length' => '180',
		'contact_mail' => '',
		'contact_form_subject' => '',
		'contact_map' => '',
		'twitter-username' => '',
		'twitter-oauth_access_token' => '',
		'twitter-oauth_access_token_secret' => '',
		'twitter-consumer_key' => '',
		'twitter-consumer_secret' => '',
	);
	
	if( isset( $defaults[$id] ) ){
		return $defaults[$id];
	}
	else{
		
		return '';
	}
}

/* get option from theme options */
function boston_get_option($id){
	global $boston_options;
	if( isset( $boston_options[$id] ) ){
		$value = $boston_options[$id];
		if( isset( $value ) ){
			return $value;
		}
		else{
			return '';
		}
	}
	else{
		return boston_defaults( $id );
	}	
}

	/* setup neccessary theme support, add image sizes */
function boston_setup(){
	load_theme_textdomain('boston', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support( "title-tag" );
	add_theme_support('html5', array(
		'comment-form',
		'comment-list'
	));
	register_nav_menu( 'top-navigation', __('Top Navigation', 'boston') );
	
	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 1250 );
	if (function_exists('add_image_size')){
		add_image_size( 'listing-box', 538 );
		add_image_size( 'widget-box', 203, 135, true );
		add_image_size( 'slider-box-2', 812, 488, true );
		add_image_size( 'slider-box-3', 541, 325, true );
		add_image_size( 'slider-box-4', 406, 244, true );
		add_image_size( 'slider-box-5', 325, 195, true );
		add_image_size( 'round-widget', 60, 60, true );
		add_image_size( 'full-width-box', 1250, 438, true );
	}

	add_theme_support('custom-header');
	add_theme_support('custom-background');
	add_theme_support('post-formats',array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ));
	add_editor_style();
}
add_action('after_setup_theme', 'boston_setup');

/* setup neccessary styles and scripts */
function boston_scripts_styles(){
	wp_enqueue_style( 'boston-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'boston-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'boston-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'boston-magnific', get_template_directory_uri() . '/css/magnific-popup.css' );

	$protocol = is_ssl() ? 'https' : 'http';
	$main_font = boston_get_option( 'main_font' );
	if( !empty( $main_font ) ){
		wp_enqueue_style( 'boston-main-font', $protocol."://fonts.googleapis.com/css?family=".str_replace( " ", "+", $main_font ).":100,300,400,700,800,900,100italic,300italic,400italic,700italic,800italic,900italic" );
	}

	$site_style = boston_get_option( 'site_style' );
	if( $site_style == 'dark' || isset( $_GET['dark'] ) ){
		wp_enqueue_style( 'boston-dark', get_template_directory_uri() . '/css/dark.css' );
	}
	else{
		wp_enqueue_style( 'boston-light', get_template_directory_uri() . '/css/light.css' );
	}

	/* ENQUEUE STYLES */
	wp_enqueue_script('jquery');
	/* BOOTSTRAP */
	wp_enqueue_script( 'boston-magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', false, false, true);
	wp_enqueue_script( 'boston-googlemap', $protocol.'://maps.googleapis.com/maps/api/js?sensor=false', false, false, true );		
	wp_enqueue_script( 'boston-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', false, false, true );
	wp_enqueue_script( 'boston-bootstrap-dropdown-js', get_template_directory_uri() . '/js/bootstrap-dropdown-multilevel.js', false, false, true );
	wp_enqueue_script( 'boston-responsive-slides-js', get_template_directory_uri() . '/js/responsiveslides.min.js', false, false, true );
	wp_enqueue_script( 'boston-sticky-sidebar-js', get_template_directory_uri() . '/js/sticky_sidebar.js', false, false, true );
	wp_enqueue_script( 'boston-instagram-js', get_template_directory_uri() . '/js/instagram.js', false, false, true );
	wp_enqueue_script( 'boston-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', false, false, true );


	
	if (is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script( 'boston-custom', get_template_directory_uri() . '/js/custom.js', false, false, true );

}
add_action('wp_enqueue_scripts', 'boston_scripts_styles', 2 );

function boston_load_color_schema(){
	/* LOAD MAIN STYLE */
	wp_enqueue_style('boston-style', get_stylesheet_uri() , array());
	ob_start();
	include( locate_template( 'css/main-color.css.php' ) );
	$custom_css = ob_get_contents();
	ob_end_clean();
	wp_add_inline_style( 'boston-style', $custom_css );	
}
add_action('wp_enqueue_scripts', 'boston_load_color_schema', 4 );

function boston_admin_resources(){
	global $post;
	wp_enqueue_style( 'boston-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'jquery-ui-dialog' );

	wp_enqueue_style( 'boston-jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_style('boston-shortcodes-style', get_template_directory_uri() . '/css/admin.css' );
	wp_enqueue_script('boston-multidropdown', get_template_directory_uri() . '/js/multidropdown.js', false, false, true);
	wp_enqueue_media();

	if( strpos( $_SERVER['REQUEST_URI'], 'widget' ) !== false ){
		wp_enqueue_script('boston-shortcodes', get_template_directory_uri() . '/js/shortcodes.js', false, false, true);
	}	
}
add_action( 'admin_enqueue_scripts', 'boston_admin_resources' );

/* add admin-ajax */
function boston_custom_head(){
	echo '<script type="text/javascript">var ajaxurl = \'' . admin_url('admin-ajax.php') . '\';</script>';
}
add_action('wp_head', 'boston_custom_head');

function boston_smeta_images( $meta_key, $post_id, $default ){
	if(class_exists('SM_Frontend')){
		global $sm;
		return $result = $sm->sm_get_meta($meta_key, $post_id);
	}
	else{		
		return $default;
	}
}

function boston_get_image_sizes(){
	$list = array();
	$sizes = get_intermediate_image_sizes();
	foreach( $sizes as $size ){
		$list[$size] = $size;
	}

	return $list;
}

/* add custom meta fields using smeta to post types. */
if( !function_exists('boston_custom_meta_boxes') ){
function boston_custom_meta_boxes(){
	$post_meta_standard = array(
		array(
			'id' => 'iframe_standard',
			'name' => __( 'Embed URL', 'boston' ),
			'type' => 'text',
			'desc' => __( 'Input custom URL which will be embeded as the blog post media.', 'boston' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Standard Post Information', 'boston' ),
		'pages' => 'post',
		'fields' => $post_meta_standard,
	);	
	
	$post_meta_gallery = array(
		array(
			'id' => 'gallery_images',
			'name' => __( 'Gallery Images', 'boston' ),
			'type' => 'image',
			'repeatable' => 1,
			'desc' => __( 'Add images for the gallery post format. Drag and drop to change their order.', 'boston' )
		)
	);

	$meta_boxes[] = array(
		'title' => __( 'Gallery Post Information', 'boston' ),
		'pages' => 'post',
		'fields' => $post_meta_gallery,
	);	
	
	
	$post_meta_audio = array(
		array(
			'id' => 'iframe_audio',
			'name' => __( 'Audio URL', 'boston' ),
			'type' => 'text',
			'desc' => __( 'Input url to the audio source which will be media for the audio post format.', 'boston' )
		),
		
		array(
			'id' => 'audio_type',
			'name' => __( 'Audio Type', 'boston' ),
			'type' => 'select',
			'options' => array(
				'embed' => __( 'Embed', 'boston' ),
				'direct' => __( 'Direct Link', 'boston' )
			),
			'desc' => __( 'Select format of the audio URL ( Direct Link - for mp3, Embed - for the links from SoundCloud, MixCloud,... ).', 'boston' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Audio Post Information', 'boston' ),
		'pages' => 'post',
		'fields' => $post_meta_audio,
	);
	
	$post_meta_video = array(
		array(
			'id' => 'video',
			'name' => __( 'Video URL', 'boston' ),
			'type' => 'text',
			'desc' => __( 'Input url to the video source which will be media for the audio post format.', 'boston' )
		),
		array(
			'id' => 'video_type',
			'name' => __( 'Video Type', 'boston' ),
			'type' => 'select',
			'options' => array(
				'remote' => __( 'Embed', 'boston' ),
				'self' => __( 'Direct Link', 'boston' ),				
			),
			'desc' => __( 'Select format of the video URL ( Direct Link - for ogg, mp4..., Embed - for the links from YouTube, Vimeo,... ).', 'boston' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Video Post Information', 'boston' ),
		'pages' => 'post',
		'fields' => $post_meta_video,
	);
	
	$post_meta_quote = array(
		array(
			'id' => 'blockquote',
			'name' => __( 'Input Quotation', 'boston' ),
			'type' => 'textarea',
			'desc' => __( 'Input quote as blog media for the quote post format.', 'boston' )
		),
		array(
			'id' => 'cite',
			'name' => __( 'Input Quoted Person\'s Name', 'boston' ),
			'type' => 'text',
			'desc' => __( 'Input quoted person\'s name for the quote post format.', 'boston' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Quote Post Information', 'boston' ),
		'pages' => 'post',
		'fields' => $post_meta_quote,
	);	

	$post_meta_link = array(
		array(
			'id' => 'link',
			'name' => __( 'Input Link', 'boston' ),
			'type' => 'text',
			'desc' => __( 'Input link as blog media for the link post format.', 'boston' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Link Post Information', 'boston' ),
		'pages' => 'post',
		'fields' => $post_meta_link,
	);

	$post_meta_featured = array(
		array(
			'id' => 'fetured_post',
			'name' => __( 'Featured Post', 'boston' ),
			'type' => 'select',
			'options' => array(
				'no' => __( 'No', 'boston' ),
				'yes' => __( 'Yes', 'boston' ),
			),
			'desc' => __( 'Make this post to be featured.', 'boston' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Featured Information', 'boston' ),
		'pages' => 'post',
		'fields' => $post_meta_featured,
	);

	return $meta_boxes;
}

add_filter('sm_meta_boxes', 'boston_custom_meta_boxes');
}

function boston_get_favourites_count( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}
	$post_favs = get_post_meta( get_the_ID(), 'favourited_for' );

	return count( $post_favs );
}

function boston_favourited_class( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$is_favourited = get_post_meta( $post_id, 'favourited_for', $_SERVER['REMOTE_ADDR'].'_'.$post_id );

	if( !empty( $is_favourited ) ){
		return 'star';
	}
	else{
		return 'star-o';
	}
}

/* transform color form hex to rgb */
function boston_hex2rgb( $hex ) {
	$hex = str_replace("#", "", $hex);

	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	return $r.", ".$g.", ".$b; 
}


/* custom walker class to create main top and bottom navigation */
class boston_walker extends Walker_Nav_Menu {
  
	/**
	* @see Walker::start_lvl()
	* @since 3.0.0
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param int $depth Depth of page. Used for padding.
	*/
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	* @see Walker::start_el()
	* @since 3.0.0
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param object $item Menu item data object.
	* @param int $depth Depth of menu item. Used for padding.
	* @param int $current_page Menu item ID.
	* @param object $args
	*/
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		* Dividers, Headers or Disabled
		* =============================
		* Determine whether the item is a Divider, Header, Disabled or regular
		* menu item. To prevent errors we use the strcasecmp() function to so a
		* comparison that is not case sensitive. The strcasecmp() function returns
		* a 0 if the strings are equal.
		*/
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} 
		else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} 
		else {

			$mega_menu_custom = get_post_meta( $item->ID, 'mega-menu-set', true );

			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			if( !empty( $mega_menu_custom ) ){
				$classes[] = 'mega_menu_li';
			}
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			
			if ( $args->has_children ){
				$class_names .= ' dropdown';
			}
			
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title'] = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel'] = ! empty( $item->xfn )	? $item->xfn	: '';

			// If item has_children add atts to a.
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			if ( $args->has_children ) {
				$atts['data-toggle']	= 'dropdown';
				$atts['class']	= 'dropdown-toggle';
				$atts['data-hover']	= 'dropdown';
				$atts['aria-haspopup']	= 'true';
			} 

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			* Glyphicons
			* ===========
			* Since the the menu item is NOT a Divider or Header we check the see
			* if there is a value in the attr_title property. If the attr_title
			* property is NOT null we apply it as the class name for the glyphicon.
			*/

			$item_output .= '<a'. $attributes .'>';
			if ( ! empty( $item->attr_title ) ){
				$item_output .= '<div class="menu-tooltip">'.$item->attr_title.'</div>';
			}

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			if( !empty( $mega_menu_custom ) ){
				$registered_widgets = wp_get_sidebars_widgets();
				$count = count( $registered_widgets[$mega_menu_custom] );
				$item_output .= ' <i class="fa fa-angle-down"></i>';
				$item_output .= '</a>';
				$mega_menu_min_height = boston_get_option( 'mega_menu_min_height' );
				$style = '';
				if( !empty( $mega_menu_min_height ) ){
					$style = 'style="height: '.esc_attr( $mega_menu_min_height ).'"';
				}
				$item_output .= '<ul class="list-unstyled mega_menu col-'.$count.'" '.$style.'>';
				ob_start();
				if( is_active_sidebar( $mega_menu_custom ) ){
					dynamic_sidebar( $mega_menu_custom );
				}
				$item_output .= ob_get_contents();
				ob_end_clean();
				$item_output .= '</ul>';
			}
			else{
				if( $args->has_children && 0 === $depth ){
					$item_output .= ' <i class="fa fa-angle-down"></i>';
				}
				$item_output .= '</a>';
			}
			$item_output .= $args->after;
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	* Traverse elements to create list from elements.
	*
	* Display one element if the element doesn't have any children otherwise,
	* display the element and its children. Will only traverse up to the max
	* depth and no ignore elements under that depth.
	*
	* This method shouldn't be called directly, use the walk() method instead.
	*
	* @see Walker::start_el()
	* @since 2.5.0
	*
	* @param object $element Data object
	* @param array $children_elements List of elements to continue traversing.
	* @param int $max_depth Max depth to traverse.
	* @param int $depth Depth of current element.
	* @param array $args
	* @param string $output Passed by reference. Used to append additional content.
	* @return null Null on failure with no changes to parameters.
	*/
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element )
			return;

		$id_field = $this->db_fields['id'];

		// Display this element.
		if ( is_object( $args[0] ) ){
		   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	* Menu Fallback
	* =============
	* If this function is assigned to the wp_nav_menu's fallback_cb variable
	* and a manu has not been assigned to the theme location in the WordPress
	* menu manager the function with display nothing to a non-logged in user,
	* and will add a link to the WordPress menu manager if logged in as an admin.
	*
	* @param array $args passed from the wp_nav_menu function.
	*
	*/
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id ){
					$fb_output .= ' id="' . $container_id . '"';
				}

				if ( $container_class ){
					$fb_output .= ' class="' . $container_class . '"';
				}

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id ){
				$fb_output .= ' id="' . $menu_id . '"';
			}

			if ( $menu_class ){
				$fb_output .= ' class="' . $menu_class . '"';
			}

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container ){
				$fb_output .= '</' . $container . '>';
			}

			echo  $fb_output;
		}
	}
}

/* set sizes for cloud widget */
function boston_custom_tag_cloud_widget($args) {
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'boston_custom_tag_cloud_widget' );

/* format wp_link_pages so it has the right css applied to it */
function boston_link_pages(){
	$post_pages = wp_link_pages( 
		array(
			'before' 		   => '',
			'after' 		   => '',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'next_or_number'   => 'number',
			'nextpagelink'     => __( '&raquo;', 'boston' ),
			'previouspagelink' => __( '&laquo;', 'boston' ),			
			'separator'        => ' ',
			'echo'			   => 0
		) 
	);
	/* format pages that are not current ones */
	$post_pages = str_replace( '<a', '<li><a', $post_pages );
	$post_pages = str_replace( '</span></a>', '</a></li>', $post_pages );
	$post_pages = str_replace( '><span>', '>', $post_pages );
	
	/* format current page */
	$post_pages = str_replace( '<span>', '<li class="active"><a href="javascript:;">', $post_pages );
	$post_pages = str_replace( '</span>', '</a></li>', $post_pages );
	
	return $post_pages;
}

/* create tags list */
function boston_tags_list(){
	$tags = get_the_tags();
	$tag_list = array();
	if( !empty( $tags ) ){
		foreach( $tags as $tag ){
			$tag_list[] = '<a href="'.esc_url( get_tag_link( $tag->term_id ) ).'">'.$tag->name.'</a>';
		}
	}
	return join( ', ', $tag_list );
}

function boston_cloud_sizes($args) {
	$args['smallest'] = 13;
	$args['largest'] = 13;
	$args['unit'] = 'px';
	return $args; 
}
add_filter('widget_tag_cloud_args','boston_cloud_sizes');

/* create categories list */
function boston_categories_list(){
	$category_list = get_the_category();
	$categories = array();
	if( !empty( $category_list ) ){
		foreach( $category_list as $category ){
			$categories[] = '<a href="'.esc_url( get_category_link( $category->term_id ) ).'">'.$category->name.'</a>';
		}
	}
	
	return join( ', ', $categories );
}

/* format pagination so it has correct style applied to it */
function boston_format_pagination( $page_links ){
	global $boston_slugs;
	$list = '';
	if( !empty( $page_links ) ){
		foreach( $page_links as $page_link ){
			if( strpos( $page_link, 'page-numbers current' ) !== false ){
				$page_link = str_replace( "<span class='page-numbers current'>", '<a href="javascript:;">', $page_link );
				$page_link = str_replace( '</span>', '</a>', $page_link );
				$list .= '<li class="active">'.$page_link.'</li>';
			}
			else{
				if( get_query_var( $boston_slugs['coupon'] ) && get_option('permalink_structure') ){
					$page_link = preg_replace( '#coupon\\/(.*?)/#i', '', $page_link, -1 );
				}
				else{
					$page_link = preg_replace( '#(&\\#038\\;'.$boston_slugs['coupon'].'|&'.$boston_slugs['coupon'].')=(.*?)&#i', '&', $page_link );
					$page_link = preg_replace( '#(&\\#038\\;'.$boston_slugs['coupon'].'|&'.$boston_slugs['coupon'].')=(.*?)\'#i', '\'', $page_link );
				}				
				$list .= '<li>'.$page_link.'</li>';
			}
			
		}
	}
	
	return $list;
}

/*generate random password*/
function boston_random_string( $length = 10 ) {
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random = '';
	for ($i = 0; $i < $length; $i++) {
		$random .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $random;
}


/* add the ... at the end of the excerpt */
function boston_new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'boston_new_excerpt_more');

/* create options for the select box in the category icon select */
function boston_icons_list( $value ){
	$icons_list = boston_awesome_icons_list();
	
	$select_data = '';
	
	foreach( $icons_list as $key => $label){
		$select_data .= '<option value="'.esc_attr( $key ).'" '.( $value == $key ? 'selected="selected"' : '' ).'>'.$label.'</option>';
	}
	
	return $select_data;
}

function boston_send_contact(){
	$errors = array();
	$name = isset( $_POST['name'] ) ? esc_sql( $_POST['name'] ) : '';
	$email = isset( $_POST['email'] ) ? esc_sql( $_POST['email'] ) : '';
	$message = isset( $_POST['message'] ) ? esc_sql( $_POST['message'] ) : '';
	if( !isset( $_POST['captcha'] ) ){
		if( !empty( $name ) && !empty( $email ) && !empty( $message ) ){
			if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
				$email_to = boston_get_option( 'contact_mail' );
				$subject = boston_get_option( 'contact_form_subject' );
				if( !empty( $email_to ) ){
					$message = "
						".__( 'Name: ', 'boston' )." {$name} \n
						".__( 'Email: ', 'boston' )." {$email} \n
						".__( 'Message: ', 'boston' )."\n {$message} \n
					";
					$info = @wp_mail( $email_to, $subject, $message );
					if( $info ){
						echo json_encode(array(
							'success' => __( 'Your message was successfully submitted.', 'boston' ),
						));
						die();
					}
					else{
						echo json_encode(array(
							'error' => __( 'Unexpected error while attempting to send e-mail.', 'boston' ),
						));
						die();
					}
				}
				else{
					echo json_encode(array(
						'error' => __( 'Message is not send since the recepient email is not yet set.', 'boston' ),
					));
					die();
				}
			}
			else{
				echo json_encode(array(
					'error' => __( 'Email is not valid.', 'boston' ),
				));
				die();
			}
		}
		else{
			echo json_encode(array(
				'error' => __( 'All fields are required.', 'boston' ),
			));
			die();
		}
	}
	else{
		echo json_encode(array(
			'error' => __( 'Captcha is wrong.', 'boston' ),
		));
		die();
	}
}
add_action('wp_ajax_contact', 'boston_send_contact');
add_action('wp_ajax_nopriv_contact', 'boston_send_contact');

function boston_favourite(){
	$post_id = $_POST['post_id'];
	$class = boston_favourited_class( $post_id );
	if( $class == 'star-o' ){
		add_post_meta( $post_id, 'favourited_for', $_SERVER['REMOTE_ADDR'].'_'.$post_id );
		$class = 'star';
	}
	else{
		delete_post_meta( $post_id, 'favourited_for', $_SERVER['REMOTE_ADDR'].'_'.$post_id );	
		$class = 'star-o';
	}

	$post_favs = get_post_meta( $post_id, 'favourited_for' );

	echo '<i class="fa fa-'.esc_attr( $class ).'"></i> '.count( $post_favs );
	die();

}
add_action('wp_ajax_favourite', 'boston_favourite');
add_action('wp_ajax_nopriv_favourite', 'boston_favourite');

function boston_send_subscription( $email = '' ){
	$email = !empty( $email ) ? $email : $_POST["email"];
	$response = array();	
	if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		require_once( locate_template( 'includes/mailchimp.php' ) );
		$chimp_api = boston_get_option("mail_chimp_api");
		$chimp_list_id = boston_get_option("mail_chimp_list_id");
		if( !empty( $chimp_api ) && !empty( $chimp_list_id ) ){
			$mc = new MailChimp( $chimp_api );
			$result = $mc->call('lists/subscribe', array(
				'id'                => $chimp_list_id,
				'email'             => array( 'email' => $email )
			));
			
			if( $result === false) {
				$response['error'] = __( 'There was an error contacting the API, please try again.', 'boston' );
			}
			else if( isset($result['status']) && $result['status'] == 'error' ){
				$response['error'] = json_encode($result);
			}
			else{
				$response['success'] = __( 'You have successfully subscribed to the newsletter.', 'boston' );
			}
			
		}
		else{
			$response['error'] = __( 'API data are not yet set.', 'boston' );
		}
	}
	else{
		$response['error'] = __( 'Email is empty or invalid.', 'boston' );
	}
	
	echo json_encode( $response );
	die();
}
add_action('wp_ajax_subscribe', 'boston_send_subscription');
add_action('wp_ajax_nopriv_subscribe', 'boston_send_subscription');


function boston_get_avatar_url( $get_avatar ){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	if( empty( $matches[1] ) ){
		preg_match("/src=\"(.*?)\"/i", $get_avatar, $matches);
	}
    return $matches[1];
}

function boston_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'boston_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'boston_embed_html' ); // Jetpack

function boston_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$add_below = ''; 
	?>
	<!-- comment-1 -->
	<div class="comment <?php echo $depth > 1 ? esc_attr( 'comment-replied' ) : '' ?>" id="comment-<?php echo esc_attr( $comment->comment_ID ); ?>">
	    <div class="media">
	        <div class="media-left">
				<?php 
				$avatar = boston_get_avatar_url( get_avatar( $comment, 75 ) );
				if( !empty( $avatar ) ): ?>
					<a class="pull-left" href="javascript:;">
						<img src="<?php echo esc_url( $avatar ); ?>" class="media-object img-circle" title="" alt="">
					</a>
				<?php endif; ?>
	        </div>
	        <div class="media-body">
	            <h4 class="media-heading">
	            	<a href="javascript:;"><?php comment_author(); ?></a>
	            	<?php if( $comment->user_id == get_the_author_meta( 'ID' ) ): ?>
	            		<span class="author">Author</span>
	            	<?php endif; ?>
	            </h4>

	            <div class="comment-meta">
	                <span class="comment-date"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __( ' ago', 'boston' ); ?></span>
					<?php
						comment_reply_link( 
							array_merge( 
								$args, 
								array( 
									'reply_text' => '<span class="comment-reply">'.__( 'Reply', 'boston' ).'</span>', 
									'add_below' => $add_below, 
									'depth' => $depth, 
									'max_depth' => $args['max_depth'] 
								) 
							) 
						);
					?>	                
	                <a href="javascript:;"></a>
	            </div>

				<?php 
				if ($comment->comment_approved != '0'){
				?>
					<p><?php echo get_comment_text(); ?></p>
				<?php 
				}
				else{ ?>
					<p><?php _e('Your comment is awaiting moderation.', 'boston'); ?></p>
				<?php
				}
				?>

	        </div>
	    </div>
	</div>	
	<!-- .comment-1 -->	
	<?php  
}

function boston_end_comments(){
	return "";
}

/* check if the blog has any media */
function boston_has_media(){
	$post_format = get_post_format();
	switch( $post_format ){
		case 'aside' : 
			return has_post_thumbnail() ? true : false; break;
			
		case 'audio' :
			$iframe_audio = get_post_meta( get_the_ID(), 'iframe_audio', true );
			if( !empty( $iframe_audio ) && has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
			
		case 'chat' : 
			return has_post_thumbnail() ? true : false; break;
		
		case 'gallery' :
			$post_meta = get_post_custom();
			$gallery_images = boston_smeta_images( 'gallery_images', get_the_ID(), array() );		
			if( !empty( $gallery_images ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}			
			else{
				return false;
			}
			break;
			
		case 'image':
			return has_post_thumbnail() ? true : false; break;
			
		case 'link' :
			$link = get_post_meta( get_the_ID(), 'link', true );
			if( !empty( $link ) ){
				return true;
			}
			else{
				return false;
			}
			break;
			
		case 'quote' :
			$blockquote = get_post_meta( get_the_ID(), 'blockquote', true );
			$cite = get_post_meta( get_the_ID(), 'cite', true );
			if( !empty( $blockquote ) || !empty( $cite ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
		
		case 'status' :
			return has_post_thumbnail() ? true : false; break;
	
		case 'video' :
			$video = get_post_meta( get_the_ID(), 'video', true );
			if( !empty( $video ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
			
		default: 
			$iframe_standard = get_post_meta( get_the_ID(), 'iframe_standard', true );
			if( !empty( $iframe_standard ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
	}	
}


function boston_parse_url( $url ){
	if( stripos( $url, 'youtube' ) ){
		$temp = explode( '?v=', $url );
		return 'https://www.youtube.com/embed/'.$temp[1];
	}
	else if( stripos( $url, 'vimeo' ) ){
		$temp = explode( 'vimeo.com/', $url );
		return '//player.vimeo.com/video/'.$temp[1];
	}
	else{
		return $url;
	}
}


function boston_shortcode_style( $style_css ){
 	return '<script>jQuery(document).ready( function($){ $("head").append( \''.str_replace( array( "\n", "\r" ), " ", $style_css).'\' ); });</script>';
}

function boston_edit_user_status( $user ){
	$facebook = get_user_meta( $user->ID, 'facebook', true );
	$twitter = get_user_meta( $user->ID, 'twitter', true );
	$google = get_user_meta( $user->ID, 'google', true );
	$pinterest = get_user_meta( $user->ID, 'pinterest', true );
	$tumblr = get_user_meta( $user->ID, 'tumblr', true );
    ?>
        <h3><?php _e( 'User Social Networks', 'boston' ) ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="facebook"><?php _e( 'Facebook', 'boston' ); ?></label></th>
                <td>
                	<input type="text" name="facebook" id="facebook" value="<?php echo esc_url( $facebook ) ?>"/>
                </td>
            </tr>
            <tr>
                <th><label for="twitter"><?php _e( 'Twitter', 'boston' ); ?></label></th>
                <td>
                	<input type="text" name="twitter" id="twitter" value="<?php echo esc_url( $twitter ) ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="google"><?php _e( 'Google +', 'boston' ); ?></label></th>
                <td>
                	<input type="text" name="google" id="google" value="<?php echo esc_url( $google ) ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="pinterest"><?php _e( 'Pinterest', 'boston' ); ?></label></th>
                <td>
                	<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_url( $pinterest ) ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="tumblr"><?php _e( 'Tumblr', 'boston' ); ?></label></th>
                <td>
                	<input type="text" name="tumblr" id="tumblr" value="<?php echo esc_url( $tumblr ) ?>" />
                </td>
            </tr>
        </table>      
    <?php
}
add_action( 'show_user_profile', 'boston_edit_user_status' );
add_action( 'edit_user_profile', 'boston_edit_user_status' );

function boston_save_user_meta( $user_id ){
	update_user_meta( $user_id,'facebook', sanitize_text_field($_POST['facebook']) );
	update_user_meta( $user_id,'twitter', sanitize_text_field($_POST['twitter']) );
	update_user_meta( $user_id,'google', sanitize_text_field($_POST['google']) );
	update_user_meta( $user_id,'pinterest', sanitize_text_field($_POST['pinterest']) );
	update_user_meta( $user_id,'tumblr', sanitize_text_field($_POST['tumblr']) );
}
add_action( 'personal_options_update', 'boston_save_user_meta' );
add_action( 'edit_user_profile_update', 'boston_save_user_meta' );


function boston_return_tweets( $count = 1 ){
	include_once( locate_template( 'includes/twitter_api.php' ) );
	$username = boston_get_option( 'twitter-username' );
	$oauth_access_token = boston_get_option( 'twitter-oauth_access_token' );
	$oauth_access_token_secret = boston_get_option( 'twitter-oauth_access_token_secret' );
	$consumer_key = boston_get_option( 'twitter-consumer_key' );
	$consumer_secret = boston_get_option( 'twitter-consumer_secret' );
		
	if( !empty( $username ) && !empty( $oauth_access_token ) && !empty( $oauth_access_token_secret ) && !empty( $consumer_key ) && !empty( $consumer_secret ) ){		
		$cache_file = dirname(__FILE__).'/includes/'.'twitter-cache.txt';
		if( !file_exists( $cache_file ) ){
			file_put_contents( $cache_file, '' );
		}
		$modified = filemtime( $cache_file );
		$now = time();
		$interval = 600; // ten minutes

		$response = json_decode( file_get_contents( $cache_file ), true );

		if ( !$modified || empty( $response ) || ( ( $now - $modified ) > $interval ) || !empty( $response['errors'] ) || !empty( $response['error'] ) ) {
			$settings = array(
				'oauth_access_token' => $oauth_access_token,
				'oauth_access_token_secret' => $oauth_access_token_secret,
				'consumer_key' => $consumer_key,
				'consumer_secret' => $consumer_secret,
				'username' => $username,
				'tweets' => $count
			);
			
			$twitter = new TwitterAPIExchange( $settings );
			$response = $twitter->get_tweets();

			if ( $response ) {
				$cache_static = fopen( $cache_file, 'w' );
				fwrite( $cache_static, json_encode( $response ) );
				fclose( $cache_static );
			}
		}
	}
	else{
		$response = array( 'error' => 'NOK' );
	}
	return $response;
}
?>