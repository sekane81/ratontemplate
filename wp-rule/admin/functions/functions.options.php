<?php

add_action('init','of_options');

if ( !function_exists('of_options') ) {
	function of_options()
	{
		
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
			}

		$categories_tmp = array_unshift($of_categories, "all categories");    


		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
			$of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);



		//Background Images Reader
		$bg_images_path = get_template_directory() . '/img/bg/'; // change this to where you store your bg images
		$favico_urls = get_template_directory_uri().'/img';
		$bg_images_url = get_template_directory_uri().'/img/bg/'; // change this to where you store your bg images
		$default_bg = get_template_directory_uri().'/img/';
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
			if ($bg_images_dir = opendir($bg_images_path) ) { 
				while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}    
			}
		}

		$ajax_images_path = get_stylesheet_directory() . '/img/ajax-gif/'; // change this to where you store your bg images
		$ajax_images_url = get_template_directory_uri().'/img/ajax-gif/'; // change this to where you store your bg images
		$ajax_images = array();
		
		if ( is_dir($ajax_images_path) ) {
			if ($ajax_images_dir = opendir($ajax_images_path) ) { 
				while ( ($ajax_images_file = readdir($ajax_images_dir)) !== false ) {
					if(stristr($ajax_images_file, ".gif") !== false || stristr($ajax_images_file, ".png") !== false) {
						$ajax_images[] = $ajax_images_url . $ajax_images_file;
					}
				}    
			}
		}		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
//		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
//		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 

		$type_of_pagination = array( 'Infinite Scroll' , 'Standard' );

/*
======================================================================================= 
*/

// Type of Logo ( image or text )
$ct_logotype = array( "image" , "text" );
$ct_logo_width = array( "standard" , "wide" );

$comments_type = array(
	"facebook" => "Facebook",
	"disqus" => "Disqus",
);

$menu_position = array(
	"left" => "Left",
	"center" => "Center",
	"right" => "Right"
);

$post_content_excerpt = array( "Content" , "Excerpt" );

$ct_show_hide = array( "Show" , "Hide" );
$ct_yes_no = array( "Yes" , "No" );
$ct_enable_disable = array( "Enable" , "Disable" );

$theme_bg_type = array( "Uploaded", "Predefined" , "Color" );
$theme_bg_attachment = array( "Scroll" , "Fixed" );

$theme_bg_repeat = array( "No-Repeat" , "Repeat", "Repeat-X" , "Repeat-Y" );
$theme_bg_position = array( "Left" , "Right", "Centered" , "Full Screen" );
$show_top_banner = array( "Upload" , "Code", "None" );

$theme_bg_color = array( "Background Image" , "Color", "Upload" );
$theme_bg_attachment = array( "Scroll" , "Fixed" );

$ct_headline = array( "Headline" , "Menu" );

$ct_meta_style = array( "Left+Content" , "Standard" );

$type_of_pagination = array( 'Infinite Scroll' , 'Standard' );

$ct_home_columns = array( "3 Columns" , "4 Columns", "5 Columns" , "1 Column + Sidebar", "2 Columns + Sidebar", "3 Columns + Sidebar" );
$ct_category_columns = array( "3 Columns" , "4 Columns", "5 Columns" , "1 Column + Sidebar", "2 Columns + Sidebar", "3 Columns + Sidebar" );

$ct_text_align = array( "Left" , "Center" , "Right" );

$ct_block_width = array( "span3" , "span4" , "span5" , "span6" , "span7" , "span8" , "span9" );
/*
=======================================================================================
*/		
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

$prefix = 'ct_';

// Set the Options Array
global $of_options;
$of_options = array();


/*
=====================================================================================================================
					GENERAL SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "General Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __( "Select a Category for Home page" , "color-theme-framework" ),
						"desc"		=> __( "Pick a Category for the Home page" , "color-theme-framework" ),
						"id"		=> "{$prefix}homepage_category",
						"std"		=> "Select a category:",
						"type"		=> "select",
						"options"	=> $of_categories
				);

$of_options[] = array(	"name"		=> __( "Select a Layout for Home page" , "color-theme-framework" ),
						"desc"		=> __( "Select 3/4/5 columns for Home page" , "color-theme-framework" ),
						"id"		=> "{$prefix}homepage_columns",
						"std"		=> "three_columns",
						"type"		=> "select",
						"options"	=> $ct_home_columns
				);

$of_options[] = array(	"name"		=> __( "Sidebar position for Home page" , "color-theme-framework" ),
						"desc"		=> __( "Select sidebar position for Home page" , "color-theme-framework" ),
						"id"		=> "{$prefix}homepage_sidebar",
						"std"		=> "Right",
						"type"		=> "select",
						"options" 	=> array( 'Left', 'Right')
				);

$of_options[] = array(	"name"		=> __( "Select a Layout for Category page (tag page, etc.)" , "color-theme-framework" ),
						"desc"		=> __( "Select 3/4/5 columns for Category page (tag page, etc.)" , "color-theme-framework" ),
						"id"		=> "{$prefix}categorypage_columns",
						"std"		=> "three_columns",
						"type"		=> "select",
						"options"	=> $ct_category_columns
				);


$of_options[] = array(	"name"		=> __( "Sidebar position for Category page (tag page, etc.)" , "color-theme-framework" ),
						"desc"		=> __( "Select sidebar position for Category page (tag page, etc.)" , "color-theme-framework" ),
						"id"		=> "{$prefix}categorypage_sidebar",
						"std"		=> "Right",
						"type"		=> "select",
						"options" 	=> array( 'Left', 'Right')
				);

$of_options[] = array(	"name"		=> __( "Type of Pagination" , "color-theme-framework" ),
						"desc"		=> __( "Select Standard or Infinite Scroll pagination" , "color-theme-framework" ),
						"id" 		=> "{$prefix}pagination_type",
						"std"		=> "Infinite Scroll",
						"type"		=> "select",
						"options"	=> $type_of_pagination
				); 

$of_options[] = array(	"name"		=> __( "Responsive Layout" , "color-theme-framework" ),
						"desc"		=> __( "Enable/Disable responsive layout", "color-theme-framework" ),
						"id"		=> "{$prefix}responsive_layout",
						"std" 		=> 1,
						"on" 		=> __( "Enable" , "color-theme-framework" ),
						"off" 		=> __( "Disable" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Exclude Pages From Search?" , "color-theme-framework" ),
						"desc"		=> __( "Select Yes, if you can exclude pages from search", "color-theme-framework" ),
						"id"		=> "{$prefix}exclude_search_page",
						"std" 		=> 1,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"						
				);

$of_options[] = array(	"name"		=> __( "Custom Favicon" , "color-theme-framework" ),
						"desc"		=> __( "Upload a 16px x 16px Png/Gif image that will represent your website's favicon." , "color-theme-framework" ),
						"id" 		=> "{$prefix}custom_favicon",
						"std"		=> $favico_urls . "/favicon.ico",
						"type"		=> "upload"
				); 

$of_options[] = array(	"name"		=> __( "Tracking Code" , "color-theme-framework" ),
						"desc"		=> __( "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme." , "color-theme-framework" ),
						"id"		=> "{$prefix}google_analytics",
						"std"		=> "",
						"type"		=> "textarea"
				);


/*
=====================================================================================================================
					WELCOME BLOCK
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Welcome Block" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __( "Welcome Block" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide Welcome Block" , "color-theme-framework" ),
						"id" 		=> "{$prefix}show_welcome",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #00AEFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}welcome_background",
						"std"		=> "#00AEFF",
						"type"		=> "color",
						"fold" 		=> "{$prefix}show_welcome"
				);

$of_options[] = array( 	"name" 		=> __( "Background Opacity" , "color-theme-framework"),
						"desc" 		=> __("Set opacity for welcome block background<br /> Min: 0, max: 1, step: 0.01, default value: 0.5" , "color-theme-framework"),
						"id" 		=> "{$prefix}welcome_opacity",
						"std"		=> "0.5",
						"type"		=> "text",
						"fold"		=> "{$prefix}show_welcome"
				);

$of_options[] = array(	"name"		=> __( "Text and Headings Styles" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for welcome text and headings" , "color-theme-framework"),
						"id"		=> "{$prefix}welcome_text_font",
						"std"		=> array('size' => '22px','height' => '32px', 'style' => 'bold','color' => '#FFFFFF'),
						"type"		=> "typography",
						"fold"		=> "{$prefix}show_welcome"
				);

$of_options[] = array(	"name"		=> __( "Text Align" , "color-theme-framework" ),
						"desc"		=> __( "Select left/center/right align for welcome text" , "color-theme-framework" ),
						"id"		=> "{$prefix}welcome_text_align",
						"std"		=> "Center",
						"type"		=> "select",
						"options"	=> $ct_text_align,
						"fold"		=> "{$prefix}show_welcome"
				);

$of_options[] = array(	"name"		=> __( "Welcome Block Text-Transform" , "color-theme-framework" ),
						"desc"		=> __( "The text-transform property controls the capitalization of text." , "color-theme-framework" ),
						"id"		=> "{$prefix}welcome_text_transform",
						"std"		=> "Capitalize",
						"type"		=> "select",
						"options" 	=> array(
							'none'			=> 'None',
							'capitalize'	=> 'Capitalize',
							'uppercase'		=> 'Uppercase',
							'lowercase'		=> 'Lowercase'
						),
						"fold"		=> "{$prefix}show_welcome"
				);

$of_options[] = array(	"name"		=> __( "Links Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a links color (default: #FFFFFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}welcome_links_color",
						"std"		=> "#FFFFFF",
						"type"		=> "color",
						"fold" 		=> "{$prefix}show_welcome"
				);

$of_options[] = array( 	"name" 		=> __( "Remove Text Padding" , "color-theme-framework" ),
						"desc" 		=> __( "Remove text padding for Welcome Block" , "color-theme-framework" ),
						"id" 		=> "{$prefix}welcome_padding",
						"std" 		=> 0,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch",
						"fold" 		=> "{$prefix}show_welcome"
				);

$of_options[] = array(	"name"		=> __( "Text/Code for Welcome Block" , "color-theme-framework" ),
						"desc"		=> __( "Enter text or code" , "color-theme-framework" ),
						"id"		=> "{$prefix}welcome_text",
						"std"		=> "<h2>Welcome to the <a href='#'>Rule</a> Magazine Wordpress Theme. <a href='#'>Rule</a> Theme is <a href='#'>Unique</a> For Your Blog Or Magazine! <a href='#'>Fully</a> Responsive & Retina Ready!</h2>",
						"type"		=> "textarea",
						"fold" 		=> "{$prefix}show_welcome"
				);




/*
=====================================================================================================================
					HEADER SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Header Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __( "Search Block" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide the Search Block on the Home Page" , "color-theme-framework" ),
						"id" 		=> "{$prefix}search_block_homepage",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Logo Block Width" , "color-theme-framework" ),
						"desc"		=> __( "Select your logo block width" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_block_width",
						"std"		=> 'span8',
						"type"		=> "select",
						"options"	=> $ct_block_width
				);

$of_options[] = array(	"name"		=> __( "Right Block Width (search, social icons, contacts)" , "color-theme-framework" ),
						"desc"		=> __( "Select your right block width" , "color-theme-framework" ),
						"id"		=> "{$prefix}right_block_width",
						"std"		=> 'span4',
						"type"		=> "select",
						"options"	=> $ct_block_width
				);

$of_options[] = array(	"name"		=> "Logo Settings",
						"desc"		=> "",
						"id"		=> "introduction",
						"std"		=> "<h3 style=\"margin: 0;\">Logo Settings.</h3>",
						"icon"		=> true,
						"type"		=> "info"
				);

$of_options[] = array(	"name"		=> __("Type of Logo","color-theme-framework"),
						"desc"		=> __("Select your logo type ( Image or Text )" , "color-theme-framework"),
						"id"		=> "{$prefix}type_logo",
						"std"		=> "image",
						"type"		=> "select",
						"options"	=> $ct_logotype
				);

$of_options[] = array(	"name"		=> __( "Logo Upload" , "color-theme-framework" ),
						"desc"		=> __( "Upload image using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_upload",
						"std"		=> get_template_directory_uri() . "/img/logo.png",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Logo Text" , "color-theme-framework" ),
						"desc"		=> __( "Enter text for logo" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_text",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Logo Slogan" , "color-theme-framework" ),
						"desc"		=> __( "Enter text for logo slogan" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_slogan",
						"std"		=> "",
						"type"		=> "text"
				);

/*
=====================================================================================================================
					SOCIAL ICONS
=====================================================================================================================	
*/


$of_options[] = array(	"name"		=> __( "Social Icons" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __( "Social Icons" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide the Social Icons" , "color-theme-framework" ),
						"id" 		=> "{$prefix}sc_block",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> "Social Icons Settings",
						"desc"		=> "",
						"id"		=> "introduction_social_icons",
						"std"		=> "<h3 style=\"margin: 0;\">Social Icons Settings</h3> To hide any icon, just remove the URL from the appropriate field",
						"icon"		=> true,
						"type"		=> "info"
				);

$of_options[] = array(	"name"		=> __( "Text For Social Icons" , "color-theme-framework" ),
						"desc"		=> __( "Enter the text for social icons" , "color-theme-framework" ),
						"id"		=> "{$prefix}sc_text",
						"std"		=> "Follow Us:",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Android" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}android_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Apple" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}apple_url",
						"std"		=> "http://www.apple.com",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Dribble" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}dribbble_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "GitHub" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}github_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Flickr" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}flickr_url",
						"std"		=> "http://www.flickr.com",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Youtube" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}youtube_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Instagram" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}instagram_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Skype" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}skype_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Pinterest" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}pinterest_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Google" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}google_url",
						"std"		=> "http://www.google.com",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Twitter" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}twitter_url",
						"std"		=> "http://www.twitter.com",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Facebook" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}facebook_url",
						"std"		=> "http://www.facebook.com",
						"type"		=> "text"
				);


/*
=====================================================================================================================
					MENU SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Menu Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __( "Sticky Menu?" , "color-theme-framework" ),
						"desc"		=> __( "Use sticky menu?", "color-theme-framework" ),
						"id"		=> "{$prefix}sticky_menu",
						"std" 		=> 1,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"						
				);

$of_options[] = array(	"name"		=> __( "Menu Layout Position" , "color-theme-framework" ),
						"desc"		=> __( "Selectmenu position ( before logo/after logo )" , "color-theme-framework" ),
						"id"		=> "{$prefix}menu_layout_position",
						"std"		=> "Before Logo",
						"type"		=> "select",
						"options" 	=> array(
							'before'	=> 'Before Logo',
							'after'		=> 'After Logo'
						)
				);

$of_options[] = array(	"name"		=> __( "Menu Position" , "color-theme-framework" ),
						"desc"		=> __( "Select menu position", "color-theme-framework" ),
						"id"		=> "{$prefix}menu_position",
						"std"		=> "center",
						"type"		=> "select",
						"options"	=> $menu_position
				);

$of_options[] = array(	"name"		=> __( "Menu Block Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #000000)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}menu_background",
						"std"		=> "#000000",
						"type"		=> "color"
				);

$of_options[] = array( 	"name" 		=> __( "Menu Block Borders (top and bottom)" , "color-theme-framework" ),
						"id" 		=> "{$prefix}menu_border",
						"std" 		=> array(
											'width' => '1',
											'style' => 'solid',
											'color' => '#FFFFFF'
										),
						"type" 		=> "border"
				);

$of_options[] = array( 	"name" 		=> __( "Menu Block Opacity" , "color-theme-framework"),
						"desc" 		=> __("Set opacity for menu block<br /> Min: 0, max: 1, step: 0.01, default value: 0.5" , "color-theme-framework"),
						"id" 		=> "{$prefix}menu_opacity",
						"std"		=> "0.5",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Top-level Menu Font" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for top-level menu font" , "color-theme-framework"),
						"id"		=> "{$prefix}menu_font",
						"std"		=> array(
											'size'	=> '14px',
											'style'	=> 'bold',
											'color'	=> '#FFFFFF'
										),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "Top-level Menu Text-Transform" , "color-theme-framework" ),
						"desc"		=> __( "The text-transform property controls the capitalization of text." , "color-theme-framework" ),
						"id"		=> "{$prefix}menu_transform",
						"std"		=> "uppercase",
						"type"		=> "select",
						"options" 	=> array(
							'none'			=> 'None',
							'capitalize'	=> 'Capitalize',
							'uppercase'		=> 'Uppercase',
							'lowercase'		=> 'Lowercase'
						)
				);

$of_options[] = array(	"name"		=> __( "Drop-Down Menu Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #FFFFFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}dd_menu_background",
						"std"		=> "#FFFFFF",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Drop-Down Menu Hover Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a hover background color (default: #FFFFFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}dd_menu_hover_background",
						"std"		=> "#EBEBEB",
						"type"		=> "color"
				);

$of_options[] = array( 	"name" 		=> __( "Background Opacity for Drop-Down Menu" , "color-theme-framework"),
						"desc" 		=> __("Set opacity for drop-down menu<br /> Min: 0, max: 1, step: 0.01, default value: 0.95" , "color-theme-framework"),
						"id" 		=> "{$prefix}dd_menu_opacity",
						"std"		=> "0.7",
						"type"		=> "text"
				);

/*
=====================================================================================================================
					STYLING SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Styling Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __( "Body Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #3b3f41)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}body_background",
						"std"		=> "#3b3f41",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Links color" , "color-theme-framework"),
						"desc"		=> __("Pick a color for the links (default: #00AEFF)" , "color-theme-framework"),
						"id"		=> "{$prefix}links_color",
						"std"		=> "#00AEFF",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> "Default Background Settings",
						"desc"		=> "",
						"id"		=> "introduction",
						"std"		=> "<h3 style=\"margin: 0 0 10px;\">Default Background Settings.</h3> The following settings allow you to set the default background behavior for each page. Each of these options can be overridden on the individual post/page/ level. You are in complete control.",
						"icon"		=> true,
						"type"		=> "info"
				);

$of_options[] = array(	"name"		=> __( "Use Predefined Background Image / BG Color / Upload Your Image" , "color-theme-framework" ),
						"desc"		=> __( "Select the type of usage background" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_type",
						"std"		=> 'Color',
						"type"		=> "select",
						"options"	=> $theme_bg_type
				);

$of_options[] = array(	"name"		=> __( "Background Attachment" , "color-theme-framework" ),
						"desc"		=> __( "Select the background image property" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_attachment",
						"std"		=> 'Fixed',
						"type"		=> "select",
						"options"	=> $theme_bg_attachment
				);

$of_options[] = array(	"name"		=> __( "Background Repeat" , "color-theme-framework" ),
						"desc"		=> __( "Select the default background repeat for the background image" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_repeat",
						"std"		=> 'Repeat',
						"type"		=> "select",
						"options"	=> $theme_bg_repeat
				);

$of_options[] = array(	"name"		=> __( "Background Position" , "color-theme-framework" ),
						"desc"		=> __( "Select the default background position for the background image" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_position",
						"std"		=> 'Left',
						"type"		=> "select",
						"options"	=> $theme_bg_position
				);

$of_options[] = array(	"name"		=> __( "Uploaded Background Image" , "color-theme-framework" ),
						"desc"		=> __( "Upload image for background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_image",
						"std"		=> $default_bg . "default-bg.jpg",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Predefined Background Images" , "color-theme-framework" ),
						"desc"		=> __( "Select a background pattern." , "color-theme-framework" ),
						"id"		=> "{$prefix}default_predefined_bg",
						"std"		=> $bg_images_url."bg01.jpg",
						"type"		=> "tiles",
						"options"	=> $bg_images,
				);

$of_options[] = array(	"name"		=> __( "Custom CSS" , "color-theme-framework" ),
						"desc"		=> __( "Quickly add some CSS to your theme by adding it to this block." , "color-theme-framework" ),
						"id"		=> "{$prefix}custom_css",
						"std"		=> "",
						"type"		=> "textarea"
				);

/*
=====================================================================================================================
					Headings Styles
=====================================================================================================================	
*/
					
$of_options[] = array(	"name"		=> __( "Headings Styles" , "color-theme-framework"),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=>  __( "Google Fonts for Headings" , "color-theme-framework"),
						"desc"		=> __("Select Google Font for H1-H6 Headings " , "color-theme-framework"),
						"id"		=> "{$prefix}google_fonts",
						"std"		=> array('face' =>'Carrois Gothic'),
						"type"		=> "typography"
				);

/*$of_options[] = array(	"name"		=> "Body Font",
						"desc"		=> "Specify the body font properties",
						"id"		=> "{$prefix}body_font",
						"std"		=> array('size' => '14px','height' => '21px', 'style' => 'normal','color' => '#111111'),
						"type"		=> "typography"
				);  */

$of_options[] = array(	"name"		=> __( "H1 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for H1 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_one",
						"std"		=> array('size' => '38px','height' => '40px', 'style' => 'normal','color' => '#000000'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H2 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for H2 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_two",
						"std"		=> array('size' => '31px', 'height' => '40px', 'style' => 'normal','color' => '#000000'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H3 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for H3 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_three",
						"std"		=> array('size' => '24px','height' => '40px','style' => 'normal','color' => '#000000'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H4 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for H4 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_four",
						"std"		=> array('size' => '17px','height' => '20px','style' => 'normal','color' => '#000000'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H5 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for H5 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_five",
						"std"		=> array('size' => '14px','height' => '20px','style' => 'normal','color' => '#000000'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=>  __( "H6 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose parameters for H6 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_six",
						"std"		=> array('size' => '12px','height' => '16px','style' => 'normal','color' => '#000000'),
						"type"		=> "typography"
				);


/*
=====================================================================================================================
					BLOG SETTINGS
=====================================================================================================================	
*/


$of_options[] = array(	"name"		=> __( "Blog Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);


$of_options[] = array(	"name"		=> __( "Type of Featured Image" , "color-theme-framework" ),
						"desc"		=> __( "Choose the type of featured image." , "color-theme-framework" ),
						"id"		=> "{$prefix}blog_blocks_featured_type",
						"std"		=> "Original ratio",
						"type"		=> "select",
						"options" 	=> array(
							'original'		=> 'Original ratio',
							'cropped'		=> 'Cropped'
						)
				);

$of_options[] = array(	"name"		=> __( "Use Excerpt or Content Function" , "color-theme-framework" ),
						"desc"		=> __( "Select a Excerpt (automatically) or Content (More tag)" , "color-theme-framework" ),
						"id"		=> "{$prefix}excerpt_function",
						"std"		=> "Excerpt",
						"type"		=> "select",
						"options"	=> $post_content_excerpt
				);

$of_options[] = array( 	"name" 		=> __( "Length of Excerpt" , "color-theme-framework"),
						"desc" 		=> __("Set length of excerpt in chars<br /> Min: 1, max: 500, step: 1, default value: 100" , "color-theme-framework"),
						"id" 		=> "{$prefix}excerpt_length",
						"std" 		=> "100",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "500",
						"type" 		=> "sliderui" 
				);


$of_options[] = array(	"name"		=> __( "Background Color For Post Top Line" , "color-theme-framework" ),
						"desc"		=> __( "Pick a color (text, icons) (default: #000000)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}post_top_line_bg_color",
						"std"		=> "#000000",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Blog Post Title" , "color-theme-framework" ),
						"desc"		=> __ ( "Specify the blog post title font properties" , "color-theme-framework" ),
						"id"		=> "{$prefix}post_title_font",
						"std"		=> array('size' => '22px','height' => '26px', 'style' => 'normal','color' => '#111'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "Blog Post Title Text-Transform" , "color-theme-framework" ),
						"desc"		=> __( "The text-transform property controls the capitalization of text." , "color-theme-framework" ),
						"id"		=> "{$prefix}post_title_transform",
						"std"		=> "uppercase",
						"type"		=> "select",
						"options" 	=> array(
							'none'			=> 'None',
							'capitalize'	=> 'Capitalize',
							'uppercase'		=> 'Uppercase',
							'lowercase'		=> 'Lowercase'
						)
				);

$of_options[] = array(	"name"		=> __( "Pagination Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #111111)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}pagination_background",
						"std"		=> "#111111",
						"type"		=> "color"
				);

$of_options[] = array( 	"name" 		=> __( "Pagination Border" , "color-theme-framework" ),
						"id" 		=> "{$prefix}pagination_border",
						"std" 		=> array(
											'width' => '4',
											'style' => 'solid',
											'color' => '#a3a6a8'
										),
						"type" 		=> "border"
				);



$of_options[] = array( "name"		=> "Blog Post Meta Settings",
					"desc"			=> "",
					"id"			=> "introduction_blog_post",
					"std"			=> "<h3 style=\"margin: 0;\">Blog Post Meta Settings.</h3>",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array( 	"name" 		=> __( "Date" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post date" , "color-theme-framework" ),
						"id" 		=> "{$prefix}date_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Categories" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post categories" , "color-theme-framework" ),
						"id" 		=> "{$prefix}categories_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Author" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post author" , "color-theme-framework" ),
						"id" 		=> "{$prefix}author_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Comments" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post comments" , "color-theme-framework" ),
						"id" 		=> "{$prefix}comments_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Views" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post views" , "color-theme-framework" ),
						"id" 		=> "{$prefix}views_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);


$of_options[] = array( 	"name" 		=> __( "Likes" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post likes" , "color-theme-framework" ),
						"id" 		=> "{$prefix}likes_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

/*
=====================================================================================================================
					Single Page Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Single Page Options" , "color-theme-framework" ),
						"type"		=> "heading");


$of_options[] = array(	"name"		=> __( "Featured image" , "color-theme-framework" ),
						"desc"		=> __( "Show or Hide featured image in the single post" , "color-theme-framework" ),
						"id"		=> "{$prefix}featured_image_post",
						"std"		=> 1,
						"on"		=> __( "Show" , "color-theme-framework" ),
						"off"		=> __( "Hide" , "color-theme-framework" ),
						"type"		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Type of Featured Image For Single Page" , "color-theme-framework" ),
						"desc"		=> __( "Choose the type of featured image." , "color-theme-framework" ),
						"id"		=> "{$prefix}featured_type",
						"std"		=> "Original ratio",
						"type"		=> "select",
						"options" 	=> array(
							'original'		=> 'Original ratio',
							'cropped'		=> 'Cropped'
						)
				);

$of_options[] = array( 	"name"		=> __( "Stretch thumbnail post images" , "color-theme-framework" ),
						"desc" 		=> __( "Stretch or Not thumbnail post images" , "color-theme-framework" ),
						"id" 		=> "{$prefix}thumb_posts_stretch",
						"std" 		=> 0,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( "name"		=> __( "Add PrettyPhoto feature to all post images" , "color-theme-framework" ),
						"desc"		=> __( "Add PrettyPhoto feature to all post images with links" , "color-theme-framework" ),
						"id"		=> "{$prefix}add_prettyphoto",
						"std"		=> 1,
						"on"		=> __( "Yes" , "color-theme-framework" ),
						"off"		=> __( "No" , "color-theme-framework" ),
						"type"		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "About Author" , "color-theme-framework" ),
						"desc"		=> __( "Show or Hide about author information in the single post" , "color-theme-framework" ),
						"id"		=> "{$prefix}about_author",
						"std"		=> 1,
						"on"		=> __( "Show" , "color-theme-framework" ),
						"off"		=> __( "Hide" , "color-theme-framework" ),
						"type"		=> "switch"
				);

$of_options[] = array( "name"		=> "Single Post Meta Settings",
					"desc"			=> "",
					"id"			=> "introduction_single_post",
					"std"			=> "<h3 style=\"margin: 0;\">Single Post Meta Settings.</h3>",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array( 	"name" 		=> __( "Date" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post date" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_date_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
						"fold" 		=> "{$prefix}single_entire_meta"
				);

$of_options[] = array( 	"name" 		=> __( "Categories" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post categories" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_categories_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
						"fold" 		=> "{$prefix}single_entire_meta"
				);

$of_options[] = array( 	"name" 		=> __( "Comments" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post comments" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_comments_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Views" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post views" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_views_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
						"fold" 		=> "{$prefix}single_entire_meta"
				);

$of_options[] = array( 	"name" 		=> __( "Likes" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post likes" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_likes_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
						"fold" 		=> "{$prefix}single_entire_meta"
				);

$of_options[] = array( 	"name" 		=> __( "Tags" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post comments" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_tags_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Code for About the author block" , "color-theme-framework" ),
						"desc"		=> __( "Paste code for about the author block." , "color-theme-framework" ),
						"id"		=> "{$prefix}code_about_author",
						"std"		=> "<a href=\"#\"><i class=\"icon-facebook-sign\"></i></a><a href=\"#\"><i class=\"icon-twitter-sign\"></i></a><a href=\"#\"><i class=\"icon-google-plus-sign\"></i></a>",
						"type"		=> "textarea"
				);

$of_options[] = array(	"name"		=> __( "Code for bookmarking and sharing services" , "color-theme-framework" ),
						"desc"		=> __( "Paste code for bookmarking and sharing services (for example: www.addthis.com, www.sharethis.com, etc. )" , "color-theme-framework" ),
						"id"		=> "{$prefix}code_blog_sharing",
						"std"		=> "",
						"type"		=> "textarea"
				);

/*
=====================================================================================================================
					Page Title Bar
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Page Title Bar" , "color-theme-framework" ),
						"type"		=> "heading");


$of_options[] = array( 	"name" 		=> __( "Page Title Bar Opacity" , "color-theme-framework"),
						"desc" 		=> __("Set opacity for the page title block background<br /> Min: 0, max: 1, step: 0.01, default value: 0.7" , "color-theme-framework"),
						"id" 		=> "{$prefix}page_bar_opacity",
						"std"		=> "0.7",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Page Title Bar Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color forthe page title bar (default: #000000)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}page_bar_background",
						"std"		=> "#000000",
						"type"		=> "color"
				);

$of_options[] = array( 	"name" 		=> __( "Page Title Bar Top Border" , "color-theme-framework" ),
						"id" 		=> "{$prefix}page_bar_top_border",
						"std" 		=> array(
											'width' => '1',
											'style' => 'solid',
											'color' => '#FFFFFF'
										),
						"type" 		=> "border"
				);

$of_options[] = array( 	"name" 		=> __( "Page Title Bar Bottom Border" , "color-theme-framework" ),
						"id" 		=> "{$prefix}page_bar_bottom_border",
						"std" 		=> array(
											'width' => '1',
											'style' => 'solid',
											'color' => '#FFFFFF'
										),
						"type" 		=> "border"
				);


/*
=====================================================================================================================
					Sidebar Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Sidebar Settings" , "color-theme-framework" ),
						"type"		=> "heading");

$of_options[] = array( 	"name" 		=> __( "Sidebar Opacity" , "color-theme-framework"),
						"desc" 		=> __("Set opacity for the sidebar background<br /> Min: 0, max: 1, step: 0.01, default value: 0.7" , "color-theme-framework"),
						"id" 		=> "{$prefix}sidebar_opacity",
						"std"		=> "0.7",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Widget Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color for widget block in the sidebar (default: #000000)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}widget_background",
						"std"		=> "#000000",
						"type"		=> "color"
				);

$of_options[] = array( 	"name" 		=> __( "Widget Top Border" , "color-theme-framework" ),
						"id" 		=> "{$prefix}widget_top_border",
						"std" 		=> array(
											'width' => '1',
											'style' => 'solid',
											'color' => '#FFFFFF'
										),
						"type" 		=> "border"
				);

$of_options[] = array( 	"name" 		=> __( "Widget Bottom Border" , "color-theme-framework" ),
						"id" 		=> "{$prefix}widget_bottom_border",
						"std" 		=> array(
											'width' => '0',
											'style' => 'solid',
											'color' => '#FFFFFF'
										),
						"type" 		=> "border"
				);

$of_options[] = array( 	"name" 		=> __( "Widget Margin Bottom" , "color-theme-framework"),
						"desc" 		=> __("Set margin bottom in pixels<br /> Min: 0, max: 90, step: 5, default value: 0" , "color-theme-framework"),
						"id" 		=> "{$prefix}widget_margin_bottom",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "90",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(	"name"		=>  __( "Sidebar Text Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a color for sidebar (default: #777777)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}sidebar_text_color",
						"std"		=> "#777777",
						"type"		=> "color"
				);


$of_options[] = array( 	"name" 		=> __( "Widget Title Border Left" , "color-theme-framework" ),
						"id" 		=> "{$prefix}widget_title_border",
						"std" 		=> array(
											'width' => '3',
											'style' => 'solid',
											'color' => '#FFFFFF'
										),
						"type" 		=> "border"
				);


$of_options[] = array(	"name"		=> "Widget Title Font",
						"desc"		=> "Specify the widget title font properties",
						"id"		=> "{$prefix}widget_title_font",
						"std"		=> array('size' => '14px','height' => '20px', 'style' => 'bold','color' => '#FFFFFF'),
						"type"		=> "typography"
				);

/*
=====================================================================================================================
					Ads &Banner Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Ads Banner Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __( "Show banner: " , "color-theme-framework" ),
						"desc"		=> __( "Show or hide banner" , "color-theme-framework" ),
						"id"		=> "{$prefix}top_banner",
						"std"		=> 'Upload',
						"type"		=> "select",
						"options"	=> $show_top_banner
				);

$of_options[] = array(	"name"		=> __( "Site Header Banner Upload" , "color-theme-framework" ),
						"desc"		=> __( "Upload images using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}banner_upload",
						"std"		=> get_template_directory_uri() . "/img/banner_728x90.gif",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Site Header Banner URL" , "color-theme-framework" ),
						"desc"		=> __( "Enter clickthrough url for banner in top section" , "color-theme-framework" ),
						"id"		=> "{$prefix}banner_link",
						"std"		=> "http://themeforest.net/user/ZERGE?ref=zerge",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Site Header Ads\Banner Code" , "color-theme-framework" ),
						"desc"		=> __( "Paste your Google Adsense (or other) code here." , "color-theme-framework" ),
						"id"		=> "{$prefix}banner_code",
						"std"		=> "",
						"type"		=> "textarea"
				);

/*$of_options[] = array(	"name"		=> __( "Custom Advertising Post (Sticky Post)" , "color-theme-framework" ),
						"desc"		=> __( "Paste the HTML code or Adsense code" , "color-theme-framework" ),
						"id"		=> "{$prefix}custom_ads_code",
						"std"		=> "",
						"type"		=> "textarea"
				);*/

/*
=====================================================================================================================
					FOOTER SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Footer Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( "name" => __( "Number of Columns In Footer" , "color-theme-framework" ),
					"desc" => __( "Select number of columns for footer" , "color-theme-framework" ),
					"id" => "{$prefix}footer_columns",
					"std" => "4",
					"min" => "0",
					"step"	=> "1",
					"max" => "4",
					"type" => "sliderui"
				);

$of_options[] = array(	"name"		=>  __( "Footer Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #111111)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}footer_background",
						"std"		=> "#111111",
						"type"		=> "color"
				);

$of_options[] = array( 	"name" 		=> __( "Footer Opacity" , "color-theme-framework"),
						"desc" 		=> __("Set opacity for the footer background<br /> Min: 0, max: 1, step: 0.01, default value: 0.7" , "color-theme-framework"),
						"id" 		=> "{$prefix}footer_opacity",
						"std"		=> "0.7",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> "Footer Font",
						"desc"		=> "Specify the body font properties",
						"id"		=> "{$prefix}footer_font",
						"std"		=> array('size' => '11px', 'color' => '#FFF'),
						"type"		=> "typography"
				); 

$of_options[] = array(	"name"		=> __( "Copyrights for your theme" , "color-theme-framework" ),
						"desc"		=> __( "Enter your copyrights." , "color-theme-framework" ),
						"id"		=> "{$prefix}copyright_info",
						"std"		=> '&copy; 2013 Copyright. Proudly powered by <a href="http://wordpress.com/">WordPress.</a>',
						"type"		=> "textarea"
				);

$of_options[] = array(	"name"		=> __( "Additional Info" , "color-theme-framework" ),
						"desc"		=> __( "Enter you additional info" , "color-theme-framework" ),
						"id"		=> "{$prefix}add_info",
						"std"		=> '<a href="http://themeforest.net/user/ZERGE?ref=zerge">Rule</a> Theme by <a href="http://color-theme.com/">Color Theme</a><br /><a href="https://github.com/sy4mil/Options-Framework">Slightly Modified Options Framework</a> by <a href="http://themeforest.net/user/SyamilMJ">Syamil MJ</a>',
						"type"		=> "textarea"
				);

/*
=====================================================================================================================
					Twitter Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Twitter Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( "name"		=> "Auth Settings",
					"desc"			=> "",
					"id"			=> "introduction_oauth_settings",
					"std"			=> "<h3 style=\"margin: 0;\">Auth Settings</h3> Visit <a target=\"_target\" href=\"https://dev.twitter.com/apps/\" title=\"Twitter\" rel=\"nofollow\">this link</a> in a new tab, sign in with your account, click on \"Create a new application\" and create your own keys in case you don't have already.",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array(	"name"		=> __( "Consumer Key:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}consumer_key",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Consumer Secret:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}consumer_secret",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Access Token:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}user_token",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Access Token Secret:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}user_secret",
						"std"		=> "",
						"type"		=> "text"
				);

					
/*
=====================================================================================================================
					Backup Options
=====================================================================================================================	
*/
$of_options[] = array(	"name"		=> __( "Backup Options" , "color-theme-framework" ),
						"type"		=> "heading"
				);
					
$of_options[] = array(	"name"		=> __( "Backup and Restore Options" , "color-theme-framework" ),
						"id"		=> "of_backup",
						"std"		=> "",
						"type"		=> "backup",
						"desc"		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
					
$of_options[] = array(	"name"		=> __( "Transfer Theme Options Data" , "color-theme-framework" ),
						"id"		=> "of_transfer",
						"std"		=> "",
						"type"		=> "transfer",
						"desc"		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
					
	}
}
?>
