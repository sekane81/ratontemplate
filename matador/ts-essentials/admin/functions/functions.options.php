<?php
if (!function_exists('of_options'))
{
	function of_options()
	{
        $data = of_get_options();
        
        global $ts_all_fonts;
        
        if(defined('TS_ALL_FONTS')) {
            $ts_all_fonts = TS_ALL_FONTS;
        }
        elseif(function_exists('ts_essentials_all_fonts')) {
            $ts_all_fonts = ts_essentials_all_fonts(true);
        }
        elseif(function_exists('ts_all_fonts')) {
            $ts_all_fonts = ts_all_fonts(true);
        }
        else {
            $ts_all_fonts = array();
        }
        
        //Access the WordPress Categories via an Array
        $of_categories 		= array();  
        $of_categories_obj 	= get_categories('hide_empty=0');
        foreach ($of_categories_obj as $of_cat) {
            $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
        }
        $_of_categories     = $of_categories;
        $categories_tmp 	= array_unshift($of_categories, __("Select a category:", 'ThemeStockyard'));    
           
        //Access the WordPress Pages via an Array
        $of_pages 			= array();
        $of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
        foreach ($of_pages_obj as $of_page) {
            $of_pages[$of_page->ID] = $of_page->post_name; 
        }
        $of_pages_tmp 		= array_unshift($of_pages, __("Select a page:", 'ThemeStockyard'));       
    
        //Testing 
        $of_options_select 	= array("one","two","three","four","five"); 
        $of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
        
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
                "placebo" 		=> "placebo", //REQUIRED!
                "block_four"	=> "Block Four",
            ),
        );


        //Background Images Reader
        $bg_images_path =  get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
        $bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
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
        

        /*-----------------------------------------------------------------------------------*/
        /* TO DO: Add options/functions that use these */
        /*-----------------------------------------------------------------------------------*/
        
        //More Options
        $uploads_arr 		= wp_upload_dir();
        $all_uploads_path 	= $uploads_arr['path'];
        $all_uploads 		= get_option('of_uploads');
        $other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");
        $body_attachment	= array("scroll","fixed");
        $body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
        $body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
        $css_shadow_entries = array('min'=>'-10','max'=>'10');
        
        // Image Alignment radio box
        $of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
        
        // Image Links to Options
        $of_options_image_link_to = array("image" => "The Image","post" => "The Post");


        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        // Set the Options Array
        global $of_options;
        $of_options = array();

        /***
        General Settings
        ***/
        $of_options[] = array( 	"name" 		=> __("General Settings", 'ThemeStockyard'),
                                "type" 		=> "heading"
                        );
        
        $of_options[] = array( "name" => __('Enable "Smooth Page Scrolling"', 'ThemeStockyard'),
                            "desc" => __("Makes scrolling a bit smoother.<br/><strong>Default:</strong> Off", 'ThemeStockyard'),
                            "id" => "smooth_page_scroll",
                            "std" => 1,
                            "type" => "switch");
        
        $of_options[] = array( "name" => __("Enable Inline CSS", 'ThemeStockyard'),
                            "desc" => __("Only enable this setting as a last resort if styling options (typography, colors, backgrounds, etc) are not updating correctly.", 'ThemeStockyard'),
                            "id" => "enable_inline_css",
                            "std" => 0,
                            "type" => "switch",
                            );
                        
        $of_options[] = array( 	"name" 		=> __("Custom CSS", 'ThemeStockyard'),
                                "desc" 		=> __("Paste any custom CSS you have right here.", 'ThemeStockyard'),
                                "id" 		=> "custom_css",
                                "std" 		=> "",
                                "type" 		=> "textarea"
                        );

        $of_options[] = array( 	"name" 		=> __("Custom Favicon", 'ThemeStockyard'),
                                "desc" 		=> __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon.", 'ThemeStockyard'),
                                "id" 		=> "custom_favicon",
                                "std" 		=> "",
                                "type" 		=> "upload"
                        ); 

        $of_options[] = array( "name" => __("Apple iPhone Icon Upload", 'ThemeStockyard'),
                            "desc" => __("Icon for Apple iPhone (57px x 57px)", 'ThemeStockyard'),
                            "id" => "iphone_icon",
                            "std" => "",
                            "type" => "upload");

        $of_options[] = array( "name" => __("Apple iPhone Retina Icon Upload", 'ThemeStockyard'),
                            "desc" => __("Icon for Apple iPhone Retina Version (114px x 114px)", 'ThemeStockyard'),
                            "id" => "iphone_icon_retina",
                            "std" => "",
                            "type" => "upload");

        $of_options[] = array( "name" => __("Apple iPad Icon Upload", 'ThemeStockyard'),
                            "desc" => __("Icon for Apple iPhone (72px x 72px)", 'ThemeStockyard'),
                            "id" => "ipad_icon",
                            "std" => "",
                            "type" => "upload");

        $of_options[] = array( "name" => __("Apple iPad Retina Icon Upload", 'ThemeStockyard'),
                            "desc" => __("Icon for Apple iPad Retina Version (144px x 144px)", 'ThemeStockyard'),
                            "id" => "ipad_icon_retina",
                            "std" => "",
                            "type" => "upload");
                        
        $of_options[] = array( 	"name" 		=> __("Custom RSS URL", 'ThemeStockyard'),
                                "desc" 		=> __("Paste your FeedBurner (or other) URL here.", 'ThemeStockyard'),
                                "id" 		=> "rss_url",
                                "std" 		=> "",
                                "type" 		=> "text"
                        );	
        
        // Social Links
        $of_options[] = array( 	"name" 		=> __("Social Links", 'ThemeStockyard'),
                                "type" 		=> "heading",
                        );
        		
        $of_options[] = array( 	"name" 		=> __("Social Links", 'ThemeStockyard'),
                                "desc" 		=> __('These social links/icons are used in the header and as the defaults for the <strong>(TS) Social Links</strong> widget.', 'ThemeStockyard'),
                                "id" 		=> "social_links_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Facebook</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_facebook",
                                "std" 		=> '#',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Twitter</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_twitter",
                                "std" 		=> '#',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Pinterest</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_pinterest",
                                "std" 		=> '#',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Google+</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_google_plus",
                                "std" 		=> '#',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Github</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_github",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>LinkedIn</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_linkedin",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Instagram</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_instagram",
                                "std" 		=> '#',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Flickr</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_flickr",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Youtube</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_youtube",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Vimeo</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_vimeo",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>VK</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_vk",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Tumblr</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_tumblr",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Behance</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_behance",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Dribbble</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_dribbble",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>Soundcloud</strong>", 'ThemeStockyard'),
                                "id" 		=> "social_url_soundcloud",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("<strong>RSS</strong> (use the <strong>[rss_url]</strong> shortcode for the default RSS url).", 'ThemeStockyard'),
                                "id" 		=> "social_url_rss",
                                "std" 		=> '',
                                "type" 		=> "text"
                        );	

        // Header Options
        $of_options[] = array( 	"name" 		=> __("Header and Nav", 'ThemeStockyard'),
                                "type" 		=> "heading",
                                "class"     => 'headeroptions'
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Logo Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "logo_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );


        $of_options[] = array(  "name" => __("Logo", 'ThemeStockyard'),
                                "desc" => __("Upload your brand/company logo here.", 'ThemeStockyard'),
                                "id" => "logo_upload",
                                "std" => '',
                                "type" => "media");

        $of_options[] = array(  "name" => __("Retina Logo", 'ThemeStockyard'),
                                "desc" => __("Upload your retina logo here.", 'ThemeStockyard'),
                                "id" => "retina_logo",
                                "std" => '',
                                "type" => "media");

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Retina logo width. Example: 120px", 'ThemeStockyard'),
                                "id" 		=> "retina_logo_width",
                                "std" 		=> "",
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Retina logo height. Example: 40px", 'ThemeStockyard'),
                                "id" 		=> "retina_logo_height",
                                "std" 		=> "",
                                "type" 		=> "text"
                        );

        $alt_logo_text = get_bloginfo('name');
        $of_options[] = array( 	"name" 		=> __("Alternate Logo Text", 'ThemeStockyard'),
                                "desc" 		=> __('This text only shows up if you choose not to use an image logo above. <strong>Note:</strong> This text can be styled in the "Typography" section.', 'ThemeStockyard'),
                                "id" 		=> "logo_text",
                                "std" 		=> (trim($alt_logo_text)) ? $alt_logo_text : "Your company",
                                "type" 		=> "text"
                        );
        
        $logo_tagline_text = get_bloginfo('description');
        $of_options[] = array( 	"name" 		=> __("Logo Tagline Text", 'ThemeStockyard'),
                                "desc" 		=> __("HTML allowed", 'ThemeStockyard'),
                                "id" 		=> "logo_tagline_text",
                                "std" 		=> (trim($logo_tagline_text)) ? $logo_tagline_text : "",
                                "type" 		=> "textarea",
                                "options"   => array(
                                    "rows"  => '3'
                                )
                        );
        
                        
        $of_options[] = array( 	"name" 		=> __("Main Navigation Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "main_nav_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );
                        
        
        $of_options[] = array( "name" => __("Enable &#8220;Sticky&#8221; Navigation", 'ThemeStockyard'),
                            "desc" => __("Turn on sticky navigation. <strong>Default:</strong> Off", 'ThemeStockyard'),
                            "id" => "sticky_nav",
                            "std" => 0,
                            "type" => "switch");
                        
        
        $of_options[] = array( "name" => __('Main Navigation Alignment', 'ThemeStockyard'),
                            "desc" => '',
                            "id" => "main_nav_align",
                            "std" => 'standard',
                            "type" => "select",
                            "options"   => array(
                                    'standard' => __('Standard', 'ThemeStockyard'),
                                    'centered' => __('Centered', 'ThemeStockyard'),
                                )
                        );
        				
        $of_options[] = array( 	"name" 		=> __('Show "Shop" Icon in Main Navigation', 'ThemeStockyard'),
                                "desc" 		=> __("Will only show if WooCommerce is installed.", 'ThemeStockyard'),
                                "id" 		=> "include_main_nav_shop_link",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );
        
                        
        $of_options[] = array( 	"name" 		=> __("Top Bar Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "top_sticky_bar_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );
                        
        
        $of_options[] = array( "name" => __('Top Bar: Middle Area', 'ThemeStockyard'),
                            "desc" => __('Choose whether to show the "Top Bar: Small Navigation" menu or the "Alternate text" (below)', 'ThemeStockyard'),
                            "id" => "top_bar_center_content",
                            "std" => 'alt_text',
                            "type" => "select",
                            "options"   => array(
                                    'small_nav' => __('Top Bar: Small Navigation menu', 'ThemeStockyard'),
                                    'alt_text' => __('Alternate text (below)', 'ThemeStockyard'),
                                )
                        );

        $of_options[] = array( 	"name" 		=> __("Top Bar: Middle Area - Alternate text", 'ThemeStockyard'),
                                "desc"      => __('HTML and shortcodes are allowed. Remember, space is somewhat limited in this area.', 'ThemeStockyard'),
                                "id" 		=> "top_bar_center_alt_content",
                                "std" 		=> 'Lorem ipsum...',
                                "type" 		=> "textarea"
                        );
        
                        
        $of_options[] = array( 	"name" 		=> __("Title Bar Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "title_bar_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );
        
        $of_options[] = array( 	"name" 		=> __("Show Title Bar on pages", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "show_titlebar_on_pages",
                                "std" 		=> 1, 
                                "type" 		=> "switch"
                        );
        
        // Footer Options
        $of_options[] = array( 	"name" 		=> __("Footer Options", 'ThemeStockyard'),
                                "type" 		=> "heading",
                        );

        $of_options[] = array( 	"name" 		=> __("Show Bottom Ad", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "show_bottom_ad",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __("Bottom Ad Content", 'ThemeStockyard'),
                                "desc"      => __('Paste your Google Adwords or other ad code here', 'ThemeStockyard'),
                                "id" 		=> "bottom_ad_code",
                                "std" 		=> '',
                                "type" 		=> "textarea"
                        );

        $of_options[] = array( 	"name" 		=> __("Show Footer Widget Area", 'ThemeStockyard'),
                                "id" 		=> "show_footer_widgets",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $url =  (defined('TS_ESSENTIALS_ADMIN_URI')) ? TS_ESSENTIALS_ADMIN_URI . 'assets/images/' : '/path_to_images/';
        $of_options[] = array( 	"name" 		=> __("Footer Widget Area Layout", 'ThemeStockyard'),
                                "id" 		=> "footer_layout",
                                "std" 		=> "footer2",
                                "type" 		=> "images",
                                "options" 	=> array(
                                    'footer1' 	    => $url . 'footer-1.png',
                                    'footer2' 	    => $url . 'footer-2.png',
                                    'footer3' 	    => $url . 'footer-3.png',
                                    'footer4' 	    => $url . 'footer-4.png',
                                    'footer5' 	    => $url . 'footer-5.png',
                                    'footer6' 	    => $url . 'footer-6.png',
                                    'footer7' 	    => $url . 'footer-7.png',
                                    'footer8' 	    => $url . 'footer-8.png'
                                )
                        );

        $of_options[] = array( 	"name" 		=> __("Show Copyright &amp; Bottom Navigation Area", 'ThemeStockyard'),
                                "id" 		=> "show_copyright",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __("Copyright Text", 'ThemeStockyard'),
                                "desc" 		=> __("<strong>Note:</strong> Use the [year] shortcode to always show the current year.", 'ThemeStockyard'),
                                "id" 		=> "copyright_text",
                                "std" 		=> "&copy; Copyright [year]. All rights reserved.",
                                "type" 		=> "text"
                        );
        
        // Performance issues arise with the following option(s). Look into it...
        
        
        $of_options[] = array( 	"name" 		=> __('Show "Back to top" button in footer', 'ThemeStockyard'),
                                "desc" 		=> __("Toggle ON or OFF any time", 'ThemeStockyard'),
                                "id" 		=> "show_back_to_top",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __('Show "Back to top" button on mobile devices', 'ThemeStockyard'),
                                "desc" 		=> __("Toggle ON or OFF any time", 'ThemeStockyard').'<br/>'.__('Not recommended', 'ThemeStockyard'),
                                "id" 		=> "show_back_to_top_on_mobile",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );
        

        // Sidebar Options
        $of_options[] = array( 	"name" 		=> __("Sidebar Options", 'ThemeStockyard'),
                                "type" 		=> "heading"
                        );
        /*
        $of_options[] = array( "name" => __("Sidebar Width", 'ThemeStockyard'),
                            "desc" => __("Set the desired sidebar width in pixels.<br/>Even numbers work best.<br/>Min: 100px - Max: 600px<br/><strong>Default:</strong> 310px", 'ThemeStockyard'),
                            "id" => "sidebar_width",
                            "std" => '310px',
                            "type" => "text",
                            );
        */

        $of_options[] = array( "name" => __("Default Sidebar Visibility", 'ThemeStockyard'),
                            "desc" => __("<strong>Show sidebar on Pages</strong><br/>(Can be changed for individual pages)", 'ThemeStockyard'),
                            "id" => "show_page_sidebar",
                            "std" => 1,
                            "type" => "checkbox",
                            );

        $of_options[] = array( "name" => '',
                            "desc" => __("<strong>Show sidebar on Archive pages</strong><br/>(category, tags, custom taxonomies, etc)", 'ThemeStockyard'),
                            "id" => "show_archive_sidebar",
                            "std" => 1,
                            "type" => "checkbox",
                            );

        $of_options[] = array( "name" => '',
                            "desc" => __("<strong>Show sidebar on Search page</strong>", 'ThemeStockyard'),
                            "id" => "show_search_sidebar",
                            "std" => 1,
                            "type" => "checkbox",
                            );

        $of_options[] = array( "name" => '',
                            "desc" => __("<strong>Show sidebar on Blog posts</strong><br/>(Can be changed for individual posts)", 'ThemeStockyard'),
                            "id" => "show_post_sidebar",
                            "std" => 1,
                            "type" => "checkbox",
                            );

        $of_options[] = array( "name" => __("Default Sidebar Position: Pages", 'ThemeStockyard'),
                            "desc" => __("Can be changed for individual pages", 'ThemeStockyard'),
                            "id" => "page_sidebar_position",
                            "std" => 'right',
                            "type" => "radio",
                            "options"   => array(
                                    'right' => __('Right', 'ThemeStockyard'),
                                    'left' => __('Left', 'ThemeStockyard'),
                                ),
                            );

        $of_options[] = array( "name" => __("Default Sidebar Position: Posts", 'ThemeStockyard'),
                            "desc" => __("Can be changed for individual posts", 'ThemeStockyard'),
                            "id" => "post_sidebar_position",
                            "std" => 'right',
                            "type" => "radio",
                            "options"   => array(
                                    'right' => __('Right', 'ThemeStockyard'),
                                    'left' => __('Left', 'ThemeStockyard'),
                                    'content-right' => __('Right (under fullwidth featured media)', 'ThemeStockyard'),
                                    'content-left' => __('Left (under fullwidth featured media)', 'ThemeStockyard'),
                                    'comments-right' => __('Right (under content, next to comments)', 'ThemeStockyard'),
                                    'comments-left' => __('Left (under content, next to comments)', 'ThemeStockyard'),
                                ),
                            );

        $of_options[] = array( "name" => __("Sidebar Placement on Tablets", 'ThemeStockyard'),
                            "desc" => __("For devices with a viewport smaller than 768 pixels (like tablets), decide where the sidebar should appear.", 'ThemeStockyard'),
                            "id" => "tablet_sidebar_placement",
                            "std" => 'beside-content',
                            "type" => "radio",
                            "options"   => array(
                                    'beside-content' => __('Beside Content (default)', 'ThemeStockyard'),
                                    'below-content' => __('Below Content', 'ThemeStockyard'),
                                ),
                            );

        // Blog Options
        $of_options[] = array( 	"name" 		=> __("Blog Options", 'ThemeStockyard'),
                                "type" 		=> "heading"
                        );	

        $of_options[] = array( 	"name" 		=> __('Turn on "Infinite Scrolling" for the "Blog"?', 'ThemeStockyard'),
                                "desc" 		=> __('This option is only for the main blog page and pages that use the "Blog Template". The blog shortcode has its own infinite scroll method.', 'ThemeStockyard'),
                                "id" 		=> "infinite_scroll_on_blog_template",
                                "std" 		=> 'no',
                                "type" 		=> "select" ,
                                "options"   => array(
                                        '0' => __('No', 'ThemeStockyard'),
                                        '1' => __('Yes (load more on scroll)', 'ThemeStockyard'),
                                        'yes_button' => __('Yes (load more on button click)', 'ThemeStockyard'),
                                    ),
                        );	

        $of_options[] = array( 	"name" 		=> __('"Infinite Scrolling" button text', 'ThemeStockyard'),
                                "desc" 		=> __('Only works when previous setting is "Yes (load more on button click)".', 'ThemeStockyard'),
                                "id" 		=> "infinite_scroll_button_text",
                                "std" 		=> 'Load more posts',
                                "type" 		=> "text" 
                        );

        $of_options[] = array( 	"name" 		=> __('Crop Featured Images on "Blog" page?', 'ThemeStockyard'),
                                "desc" 		=> __('<strong>Note:</strong> This option is only used with "1 Column" / "Classic" blog layouts.', 'ThemeStockyard'),
                                "id" 		=> "crop_images_on_blog",
                                "std" 		=> 1,
                                "type" 		=> "switch" 
                        );

        $of_options[] = array( 	"name" 		=> __('Default posts layout on "Blog" page', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "blog_layout",
                                "std" 		=> "classic",
                                "type" => "select",
                                "options"   => array(
                                        'classic' => __('Classic', 'ThemeStockyard'),
                                        '2columns' => __('2 Column Grid', 'ThemeStockyard'),
                                        '3columns' => __('3 Column Grid', 'ThemeStockyard'),
                                        '4columns' => __('4 Column Grid', 'ThemeStockyard'),
                                        'masonry' => __('Masonry', 'ThemeStockyard'),
                                        //'masonrycards' => __('Masonry Cards', 'ThemeStockyard'),
                                        'list' => __('List', 'ThemeStockyard'),
                                        'banner' => __('Banners', 'ThemeStockyard'),
                                        //'legacy' => __('Legacy', 'ThemeStockyard'),
                                    ),
                        );

        $of_options[] = array( 	"name" 		=> __('Default posts layout on "Search" page', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "search_layout",
                                "std" 		=> "classic",
                                "type" => "select",
                                "options"   => array(
                                        'classic' => __('Classic', 'ThemeStockyard'),
                                        '2columns' => __('2 Column Grid', 'ThemeStockyard'),
                                        '3columns' => __('3 Column Grid', 'ThemeStockyard'),
                                        '4columns' => __('4 Column Grid', 'ThemeStockyard'),
                                        'masonry' => __('Masonry', 'ThemeStockyard'),
                                        //'masonrycards' => __('Masonry Cards', 'ThemeStockyard'),
                                        'list' => __('List', 'ThemeStockyard'),
                                        'banner' => __('Banners', 'ThemeStockyard'),
                                        //'legacy' => __('Legacy', 'ThemeStockyard'),
                                    ),
                        );

        $of_options[] = array( 	"name" 		=> __('Default posts layout on "Archives" page', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "archive_layout",
                                "std" 		=> "classic",
                                "type" => "select",
                                "options"   => array(
                                        'classic' => __('Classic', 'ThemeStockyard'),
                                        '2columns' => __('2 Column Grid', 'ThemeStockyard'),
                                        '3columns' => __('3 Column Grid', 'ThemeStockyard'),
                                        '4columns' => __('4 Column Grid', 'ThemeStockyard'),
                                        'masonry' => __('Masonry', 'ThemeStockyard'),
                                        //'masonrycards' => __('Masonry Cards', 'ThemeStockyard'),
                                        'list' => __('List', 'ThemeStockyard'),
                                        'banner' => __('Banners', 'ThemeStockyard'),
                                        //'legacy' => __('Legacy', 'ThemeStockyard'),
                                    ),
                        );

        $of_options[] = array( 	"name" 		=> __("Default excerpt length within loop", 'ThemeStockyard'),
                                "desc" 		=> __('"Classic" layout. <strong>Default:</strong> 320', 'ThemeStockyard'),
                                "id" 		=> "excerpt_length_more",
                                "std" 		=> "320",
                                "type" => "text",
                                'class' => 'small-text'
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __('"2 Column Grid" and "List" layouts. <strong>Default:</strong> 160', 'ThemeStockyard'),
                                "id" 		=> "excerpt_length_standard",
                                "std" 		=> "160",
                                "type" => "text",
                                'class' => 'small-text'
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __('"3 column", "4 column", and "Masonry" layouts. <strong>Default:</strong> 100', 'ThemeStockyard'),
                                "id" 		=> "excerpt_length_minimum",
                                "std" 		=> "100",
                                "type" => "text",
                                'class' => 'small-text'
                        );

        $of_options[] = array( 	"name" 		=> __("Default image size/orientation within loop", 'ThemeStockyard'),
                                "desc" 		=> __('"2 Column Grid", "3 Column Grid", and "List" layouts. <br/><strong>Default:</strong> 3:2', 'ThemeStockyard'),
                                "id" 		=> "image_orientation_standard",
                                "std" 		=> "3:2",
                                "type" => "select",
                                "options"   => array(
                                        '3:2' => __('3:2 (landscape)', 'ThemeStockyard'),
                                        '16:9' => __('16:9 (landscape)', 'ThemeStockyard'),
                                        '16:10' => __('16:10 (landscape)', 'ThemeStockyard'),
                                        '2:3' => __('2:3 (portrait)', 'ThemeStockyard'),
                                        '9:16' => __('9:16 (portrait)', 'ThemeStockyard'),
                                        '10:16' => __('10:16 (portrait)', 'ThemeStockyard'),
                                        '1:1' => __('1:1 (square)', 'ThemeStockyard')
                                    ),
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __('"4 column" layout only. <br/><strong>Default:</strong> 1:1', 'ThemeStockyard'),
                                "id" 		=> "image_orientation_4col",
                                "std" 		=> "1:1",
                                "type" => "select",
                                "options"   => array(
                                        '3:2' => __('3:2 (landscape)', 'ThemeStockyard'),
                                        '16:9' => __('16:9 (landscape)', 'ThemeStockyard'),
                                        '16:10' => __('16:10 (landscape)', 'ThemeStockyard'),
                                        '2:3' => __('2:3 (portrait)', 'ThemeStockyard'),
                                        '9:16' => __('9:16 (portrait)', 'ThemeStockyard'),
                                        '10:16' => __('10:16 (portrait)', 'ThemeStockyard'),
                                        '1:1' => __('1:1 (square)', 'ThemeStockyard')
                                    ),
                        );
        /*
        $of_options[] = array( 	"name" 		=> __("Allow HTML in excerpts within loop?", 'ThemeStockyard'),
                                "desc" 		=> __("<strong>Default:</strong> Off<br/>This option retains/enables the following html tags within excerpts:<br/>", 'ThemeStockyard').esc_html('<strong> <b> <i> <br> <em> <a> <u> <strike> <del> <acronym> <abbr> <sup> <sub>'),
                                "id" 		=> "allow_html_excerpts",
                                "std" 		=> 0,
                                "type" 		=> "switch" 
                        );
        */
        $of_options[] = array( 	"name" 		=> __('Get featured image "alt text" within loop?', 'ThemeStockyard'),
                                "desc" 		=> __("<strong>Default:</strong> Off<br/>Good for SEO, but may decrease performance as it requires an additional database query for each featured image.", 'ThemeStockyard'),
                                "id" 		=> "featured_image_alt_text_within_loop",
                                "std" 		=> 0,
                                "type" 		=> "switch" 
                        );

        $of_options[] = array( 	"name" 		=> __('Exclude Categories from Loop', 'ThemeStockyard'),
                                "desc" 		=> __('Optionally select one or more categories. Posts within these categories will not appear in blog results.', 'ThemeStockyard'),
                                "id" 		=> "excluded_blog_loop_categories",
                                "std" 		=> "",
                                "type" => "multiselect",
                                'options' => $_of_categories
                        );
                        
                        
                        
                        

        // Single Post Options
        $of_options[] = array( 	"name" 		=> __("Single Post Options", 'ThemeStockyard'),
                                "type" 		=> "heading"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Single Post Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "single_post_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __('Link the title on "Single" post?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "link_title_on_post",
                                "std" 		=> 1,
                                "type" 		=> "switch" 
                        );

        $of_options[] = array( 	"name" 		=> __('Crop Featured Images on "Single" post?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "crop_images_on_post",
                                "std" 		=> 1,
                                "type" 		=> "switch" 
                        );	

        $of_options[] = array( 	"name" 		=> __('Cropped Featured Image Dimensions (with sidebar)', 'ThemeStockyard'),
                                "desc" 		=> __('<strong>Width</strong> (leave blank for default)', 'ThemeStockyard'),
                                "id" 		=> "cropped_featured_image_width",
                                "std" 		=> '',
                                "type" => "text",
                                'class' => 'small-text'
                        );	

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __('<strong>Height</strong> (leave blank for default)', 'ThemeStockyard'),
                                "id" 		=> "cropped_featured_image_height",
                                "std" 		=> '',
                                "type" => "text",
                                'class' => 'small-text'
                        );

        $of_options[] = array( 	"name" 		=> __('Cropped Featured Image Dimensions (NO sidebar)', 'ThemeStockyard'),
                                "desc" 		=> __('<strong>Width</strong> (leave blank for default)', 'ThemeStockyard'),
                                "id" 		=> "cropped_featured_image_width_full",
                                "std" 		=> '',
                                "type" => "text",
                                'class' => 'small-text'
                        );	

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __('<strong>Height</strong> (leave blank for default)', 'ThemeStockyard'),
                                "id" 		=> "cropped_featured_image_height_full",
                                "std" 		=> '',
                                "type" => "text",
                                'class' => 'small-text'
                        );		

        $of_options[] = array( 	"name" 		=> __('Show Featured Images/Videos on "Single" post?', 'ThemeStockyard'),
                                "desc" 		=> __('Use this option if you only want featured images to appear within the "loop", but not on individual post pages', 'ThemeStockyard'),
                                "id" 		=> "show_images_on_post",
                                "std" 		=> 1,
                                "type" 		=> "switch" 
                        );	

        $of_options[] = array( 	"name" 		=> __('Show "About the Author" on "Single" post?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "author_info_on_post",
                                "std" 		=> 1,
                                "type" => "switch"
                        );	

        $of_options[] = array( 	"name" 		=> __('Show previous/next post on "Single" post?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "post_show_direction_links",
                                "std" 		=> 'yes',
                                "type" => "select",
                                "options"   => array(
                                        'yes' => __('Yes', 'ThemeStockyard'),
                                        'yes_similar' => __('Yes (from same category)', 'ThemeStockyard'),
                                        'no' => __('No', 'ThemeStockyard'),
                                    ),
                        );	

        $of_options[] = array( 	"name" 		=> __('Show related posts on "Single" post?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "show_related_blog_posts",
                                "std" 		=> 'yes',
                                "type" => "select",
                                "options"   => array(
                                        'yes' => __('Yes (filter by category)', 'ThemeStockyard'),
                                        'yes_tag' => __('Yes (filter by tags)', 'ThemeStockyard'),
                                        'no' => __('No', 'ThemeStockyard'),
                                    ),
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __('Related Posts Title Text', 'ThemeStockyard'),
                                "id" 		=> "related_blog_posts_title_text",
                                "std" 		=> "Related Posts",
                                "type" => "text",
                        );
        /*
        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __('Related Posts Title Alignment', 'ThemeStockyard'),
                                "id" 		=> "related_blog_posts_title_alignment",
                                "std" 		=> "left",
                                "type" => "select",
                                "options"   => array(
                                        'left' => __('Left', 'ThemeStockyard'),
                                        'center' => __('Center', 'ThemeStockyard'),
                                        'right' => __('Right', 'ThemeStockyard'),
                                    ),
                        );		
        */		
        
        $of_options[] = array( 	"name" 		=> __('"Sharing Options / Comment Count" position on "Single" post?', 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "sharing_options_position_on_post",
                                "std" 		=> 'top',
                                "type" 		=> "radio",
                                "options"   => array(
                                    'top' => __('Top (below featured image)', 'ThemeStockyard'),
                                    'bottom' => __('Bottom (below post content)', 'ThemeStockyard'),
                                    'hidden' => __('Hidden', 'ThemeStockyard'),
                                ),
                        );		
        
        $of_options[] = array( 	"name" 		=> __("Available Sharing Options...", 'ThemeStockyard'),
                                "desc" 		=> __("Select the Sharing Options you want your website visitors to use.", 'ThemeStockyard'),
                                "id" 		=> "available_sharing_options",
                                "std" 		=> array(
                                    'facebook',
                                    'twitter',
                                    'google-plus',
                                    'pinterest',
                                    'tumblr',
                                    'linkedin',
                                    'reddit',
                                    'email',
                                    'print'
                                ),
                                "type" 		=> "multicheck",
                                'keyAsValue' => true,
                                "options"   => array(
                                    'facebook' => 'Facebook',
                                    'twitter' => 'Twitter',
                                    'google-plus' => 'Google+',
                                    'pinterest' => 'Pinterest',
                                    'vk' => 'VK',
                                    'tumblr' => 'Tumblr',
                                    'linkedin' => 'LinkedIn',
                                    'reddit' => 'Reddit',
                                    'digg' => 'Digg',
                                    'stumbleupon' => 'StumbleUpon',
                                    'email' => __('Email', 'ThemeStockyard'),
                                    'print' => __('Print', 'ThemeStockyard')
                                ),
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Single Post Options (BETA)", 'ThemeStockyard'),
                                "desc" 		=> __('The following options are in open beta and may not work as expected.', 'ThemeStockyard'),
                                "id" 		=> "single_post_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );	
                        
        $of_options[] = array( 	"name" 		=> __("Show page view count for single posts?", 'ThemeStockyard'),
                                "desc" 		=> __('The page view count will be shown within the meta section of the title bar.<br/><strong>Note:</strong> The counter may not update properly on cached pages.', 'ThemeStockyard'),
                                "id" 		=> "show_titlebar_post_view_count",
                                "std" 		=> 0,
                                "type" 		=> "switch" 
                        );	
				
                        
        // Comment Options
        $of_options[] = array( 	"name" 		=> __("Comment Options", 'ThemeStockyard'),
                                "type" 		=> "heading",
                        );

        $of_options[] = array( 	"name" 		=> __("Show Comments on pages", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "show_comments_on_pages",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __("Show user avatars next to comments", 'ThemeStockyard'),
                                "desc" 		=> __("Not available for Disqus comments", 'ThemeStockyard'),
                                "id" 		=> "show_comments_avatars",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Disqus Options", 'ThemeStockyard'),
                                "desc" 		=> __('If using Disqus comments, we recommend the following "Comment Count Link" settings:', 'ThemeStockyard').'<br/><img src="'.get_template_directory_uri().'/images/disqus-settings.jpg" alt="image: disqus settings" style="border:1px solid #e1e1e1;margin:10px 0;display:inline-block;"/><br/>'.__('You can edit those settings on Disqus: ', 'ThemeStockyard').'<a href="https://disqus.com/admin/settings">https://disqus.com/admin/settings</a>',
                                "id" 		=> "single_post_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Use Disqus", 'ThemeStockyard'),
                                "desc" 		=> __('Enable <a href="http://disqus" target="_blank">Disqus</a> comments (instead of standard comments)', 'ThemeStockyard'),
                                "id" 		=> "use_disqus",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Disqus Shortname", 'ThemeStockyard'),
                                "desc" 		=> __('Type the "shortname" that belongs to the Disqus account you created for this website.', 'ThemeStockyard'),
                                "id" 		=> "disqus_shortname",
                                "std" 		=> "",
                                "type" 		=> "text"
                        );

        $of_options[] = array( 	"name" 		=> __('Are you using the recommended "Comment Count Link" settings for Disqus?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "using_recommended_disqus_settings",
                                "std" 		=> 'no',
                                "type" 		=> "select",
                                "options"   => array(
                                        'yes' => __('Yes', 'ThemeStockyard'),
                                        'no' => __('No', 'ThemeStockyard'),
                                )
                        );

        // Shop Options
        $of_options[] = array( 	"name" 		=> __("Shop Options", 'ThemeStockyard'),
                                "type" 		=> "heading",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("WooCommerce Options", 'ThemeStockyard'),
                                "desc" 		=> __('The following settings will are only useful if the <a href="http://www.woothemes.com/woocommerce/" target="_blank">WooCommerce plugin</a> is installed and activated.', 'ThemeStockyard'),
                                "id" 		=> "woocommerce_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Ajax Load Shopping Cart Total on Each Page", 'ThemeStockyard'),
                                "desc" 		=> __('Enable ajax loading of the shopping cart total (in the header or main navigation area) on each page load. This setting should be enabled if WP Cache or another caching plugin is in use.', 'ThemeStockyard'),
                                "id" 		=> "enable_cart_ajax_loading",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __('Show "Add to Cart" Buttons on Results Page', 'ThemeStockyard'),
                                "desc" 		=> __('Default: On', 'ThemeStockyard'),
                                "id" 		=> "show_add_to_cart_button_on_results",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __('Show "Add to Cart" Buttons on Single Product Page(s)', 'ThemeStockyard'),
                                "desc" 		=> __('Default: On', 'ThemeStockyard'),
                                "id" 		=> "show_add_to_cart_button_on_single",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __('Show "Price(s)" on Results Page', 'ThemeStockyard'),
                                "desc" 		=> __('Default: On', 'ThemeStockyard'),
                                "id" 		=> "show_shop_prices_on_results",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __('Show "Price(s)" on Single Product Page(s)', 'ThemeStockyard'),
                                "desc" 		=> __('Default: On', 'ThemeStockyard'),
                                "id" 		=> "show_shop_prices_on_single",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );
        
        $of_options[] = array( 	"name" 		=> __('Show "Reviews" on Single Product Page(s)', 'ThemeStockyard'),
                                "desc" 		=> __('Default: On', 'ThemeStockyard'),
                                "id" 		=> "show_shop_reviews_on_single",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Catalog Mode", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "disable_cart_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Disable Cart and Checkout Pages", 'ThemeStockyard'),
                                "desc" 		=> __('Default: Off', 'ThemeStockyard'),
                                "id" 		=> "catalog_mode",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __("Disable Checkout Button/Form", 'ThemeStockyard'),
                                "desc" 		=> __('Use this option to only disable the checkout form. Default: Off', 'ThemeStockyard'),
                                "id" 		=> "disable_woocommerce_checkout",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );

        // Other Options
        $of_options[] = array( 	"name" 		=> __("Other Options", 'ThemeStockyard'),
                                "type" 		=> "heading",
                        );
        				
        $of_options[] = array( 	"name" 		=> __("Date and Time Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "date_time_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __('Enable "Smart Date/Time Conversion"', 'ThemeStockyard'),
                                "desc" 		=> __('Use this option to automatically convert dates/times for posts into a more localized format (using the options below).', 'ThemeStockyard'),
                                "id" 		=> "smart_datetime",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );	

        $of_options[] = array( 	"name" 		=> __('Which date looks correct?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "smart_date_format",
                                "std" 		=> 'american',
                                "type" => "select",
                                "options"   => array(
                                        'american' => __('June 12th, 2020', 'ThemeStockyard'),
                                        'not_american' => __('12 June 2020', 'ThemeStockyard'),
                                    ),
                        );

        $of_options[] = array( 	"name" 		=> __('Which time looks correct?', 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "smart_time_format",
                                "std" 		=> '12hour',
                                "type" => "select",
                                "options"   => array(
                                        '12hour' => __('5:30 pm', 'ThemeStockyard'),
                                        '24hour' => __('17:30', 'ThemeStockyard'),
                                    ),
                        );
        				
        $of_options[] = array( 	"name" 		=> __("Search Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "search_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Search Input Placeholder Text", 'ThemeStockyard'),
                                "desc" 		=> __('This text will be used in sidebar search inputs as well.', 'ThemeStockyard'),
                                "id" 		=> "search_placeholder_text",
                                "std" 		=> "Search...",
                                "type" 		=> "text"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Breadcrumb Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "breadcrumb_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __('"Breadcrumb" Home Link Text', 'ThemeStockyard'),
                                "desc" 		=> __('This text will be used to represent the homepage link in the "breadcrumbs".<br/><strong>Note:</strong> Leave blank for default.', 'ThemeStockyard'),
                                "id" 		=> "breadcrumbs_home_link_text",
                                "std" 		=> "",
                                "type" 		=> "text"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Image Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "image_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Sharpen Resized Images?", 'ThemeStockyard'),
                                "desc" 		=> __('<strong>Default:</strong> On', 'ThemeStockyard'),
                                "id" 		=> "sharpen_resized_images",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __("Use Custom JPEG Compression?", 'ThemeStockyard'),
                                "desc" 		=> __('<strong>Default:</strong> On', 'ThemeStockyard'),
                                "id" 		=> "use_custom_jpeg_compression",
                                "std" 		=> 1,
                                "type" 		=> "switch"
                        );

        $of_options[] = array( 	"name" 		=> __('JPEG Compression', 'ThemeStockyard'),
                                "desc" 		=> __("Set your desired JPEG compression for resized images. <strong>Note:</strong> While a higher setting will result in clearer images, it can also  result in larger file sizes and slower page loads.", 'ThemeStockyard'),
                                "id" 		=> "jpeg_compression",
                                "std" 		=> "95",
                                "min" 		=> "1",
                                "step"		=> "1",
                                "max" 		=> "100",
                                "type" 		=> "sliderui" 
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Developer Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "developer_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Enable Style Selector", 'ThemeStockyard'),
                                "desc" 		=> __('Should probably only be used by developers', 'ThemeStockyard'),
                                "id" 		=> "enable_style_selector",
                                "std" 		=> 0,
                                "type" 		=> "switch"
                        );
                        
                        
                        /**/
                        
        /************************************************************************************
        Styling Options
        ************************************************************************************/


        // Typography
        $of_options[] = array(  "name"      => __("Typography", 'ThemeStockyard'),
                                "type"      => "heading",
                                "class"     => "mt10",
                                );

        $alt_logo_text = get_option('blogname');
        $preview_text  = ($alt_logo_text) ? $alt_logo_text : 'Grumpy wizards make toxic brew for the evil Queen and Jack.';
        $of_options[] = array( 	"name" 		=> __("Alternate Logo", 'ThemeStockyard'),
                                "desc"      => __("Choose a font<br/><strong>Note:</strong> only useful if you haven't uploaded a logo", 'ThemeStockyard'),
                                "id" 		=> "logo_font_family",
                                "std" 		=> "Montserrat",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>$preview_text, "size"=>'24px'),
                        );
        /*
        $of_options[] = array( 	"name" 		=> "",
                                "desc" => __("Don't see the font you were looking for?", 'ThemeStockyard'),
                                "id" => "use_alt_logo_font_family",
                                "std" => 0,
                                "type" => "checkbox",
                                "folds" => 1,
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" => __('Enter the name of a font here.', 'ThemeStockyard').'<br/>'.__('View all options at:', 'ThemeStockyard').' '.'<a href="https://www.google.com/fonts" target="_blank">Google Fonts</a>',
                                "id" => "alt_logo_font_family",
                                "std" => "",
                                "type" => "text",
                                "fold" => "use_alt_logo_font_family"
                        );
        */

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Alternate logo size &amp; style", 'ThemeStockyard'),
                                "id" 		=> "logo_font_style",
                                "std" 		=> array('size' => '30px','style' => 'normal'),
                                "type" 		=> "typography",
                                "class"     => "w345"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("General Typography Options", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "general_typography_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );


        $of_options[] = array( 	"name" 		=> __("Small Text", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "small_font_family",
                                "std" 		=> "Open Sans",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );

        $of_options[] = array( 	"name" 		=> __("Plain Text", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "body_font_family",
                                "std" 		=> "Open Sans",
                                "type" 		=> "select_google_font",
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                                "options"   => $ts_all_fonts,
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font size &amp; style", 'ThemeStockyard'),
                                "id" 		=> "body_font_style",
                                "std" 		=> array('size' => '14px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                                    
        $of_options[] = array( 	"name" 		=> __("&lt;H1&gt; heading", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "h1_font_family",
                                "std" 		=> "Montserrat",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "h1_font_style",
                                "std" 		=> array('style' => 'normal','size' => '36px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("&lt;H2&gt; heading", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "h2_font_family",
                                "std" 		=> "Montserrat",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "h2_font_style",
                                "std" 		=> array('style' => 'normal','size' => '26px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("&lt;H3&gt; heading", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "h3_font_family",
                                "std" 		=> "Montserrat",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "h3_font_style",
                                "std" 		=> array('style' => 'normal','size' => '20px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("&lt;H4&gt; heading", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "h4_font_family",
                                "std" 		=> "Montserrat",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "h4_font_style",
                                "std" 		=> array('style' => 'normal','size' => '15px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("&lt;H5&gt; heading", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "h5_font_family",
                                "std" 		=> "Open Sans",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "h5_font_style",
                                "std" 		=> array('style' => 'normal','size' => '14px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("&lt;H6&gt; heading", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "h6_font_family",
                                "std" 		=> "Open Sans",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "h6_font_style",
                                "std" 		=> array('style' => 'normal','size' => '12px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Stylized Meta", 'ThemeStockyard'),
                                "desc" 		=> __("Used mostly for post authors within blog results", 'ThemeStockyard'),
                                "id" 		=> "stylized_meta_font_family",
                                "std" 		=> "Libre Baskerville",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'12px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "stylized_meta_font_style",
                                "std" 		=> array('style' => 'italic'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Form text", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "form_font_family",
                                "std" 		=> "Open Sans",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'14px'),
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font style", 'ThemeStockyard'),
                                "id" 		=> "form_font_style",
                                "std" 		=> array('style' => 'normal','size' => '14px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Main Navigation Typography", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "main_nav_typography_options_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );


        $of_options[] = array( 	"name" 		=> __("Main Navigation", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "main_nav_font_family",
                                "std" 		=> "Open Sans",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );
                        
        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font size", 'ThemeStockyard'),
                                "id" 		=> "main_nav_font_style",
                                "std" 		=> array('size' => '13px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );

        $of_options[] = array( 	"name" 		=> __("Main Navigation: Sub-menu", 'ThemeStockyard'),
                                "desc" 		=> __("Choose a font", 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_font",
                                "std" 		=> "Open Sans",
                                "type" 		=> "select_google_font",
                                "options"   => $ts_all_fonts,
                                "preview"   => array("text"=>'0123456789 Grumpy wizards make toxic brew for the evil Queen and Jack.', "size"=>'16px'),
                        );
                        
        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Font size", 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_font_style",
                                "std" 		=> array('size' => '13px'),
                                "type" 		=> "typography",
                                "class"     => "w345",
                        );



        // Colors
        
        $of_options[] = array(  "name"      => __("Colors", 'ThemeStockyard'),
                                "type"      => "heading",
                                );
        
        $of_options[] = array( 	"name" 		=> __("Choose a color scheme", 'ThemeStockyard'),
                                "desc" 		=> __("Note: Choosing a color scheme will automatically change some of the colors below.", 'ThemeStockyard'),
                                "id" 		=> "color_scheme",
                                "std" 		=> "coral",
                                "type" => "select_color_scheme",
                                "options"   => array(
                                        '#ee4643' => __('Coral', 'ThemeStockyard'),
                                        '#e2a8a8' => __('Faded Rose', 'ThemeStockyard'),
                                        '#f28d7b' => __('Peach', 'ThemeStockyard'),
                                        '#8e587a' => __('Purple', 'ThemeStockyard'),
                                        '#134063' => __('Navy', 'ThemeStockyard'),
                                        '#365d95' => __('Blue', 'ThemeStockyard'),
                                        '#1e7775' => __('Teal', 'ThemeStockyard'),
                                        '#67a788' => __('Sea Green', 'ThemeStockyard'),
                                        '#3ab54b' => __('Sage', 'ThemeStockyard'),
                                        '#7f9614' => __('Green', 'ThemeStockyard'),
                                        '#e8b71a' => __('Mustard Yellow (default)', 'ThemeStockyard'),
                                        '#f28707' => __('Orange', 'ThemeStockyard'),
                                        '#9b7c56' => __('Brown', 'ThemeStockyard'),
                                        '#d9b753' => __('Gold', 'ThemeStockyard'),
                                        '#3b3b3b' => __('Gray', 'ThemeStockyard'),
                                    ),
                                "fields" => array(
                                    'logo_font_color',
                                    'primary_color',
                                    'body_link_color',
                                    'top_container_link_hover_color',
                                    'main_nav_hover_color',
                                    'main_nav_submenu_hover_color',
                                    'footer_widgets_link_color',
                                    'copyright_bg_color'
                                )
                        );
                        
        $of_options[] = array( 	"name" 		=> "",
                                "desc" => __("Check this box to create your own color scheme.", 'ThemeStockyard'),
                                "id" => "use_custom_color_scheme",
                                "std" => 0,
                                "type" => "checkbox",
                                "folds" => 1,
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" => __('<button id="custom_color_scheme_button" type="button" class="button-primary">Select Color</button> &nbsp; Choose any color you like, then click the button.', 'ThemeStockyard'),
                                "id" => "custom_color_scheme",
                                "std" => "",
                                "type" => "color",
                                "fold" => "use_custom_color_scheme"
                        );
                                
        $of_options[] = array( 	"name" 		=> __("General Colors", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "general_colors_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        ); 

        $of_options[] = array( 	"name" 		=> __("Primary/Highlight Color", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "primary_color",
                                "std" 		=> '#ee4643',
                                "type" 		=> "color"
                        ); 
        /*                                   
        $of_options[] = array( 	"name" 		=> __("Background color", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "background_color",
                                "std" 		=> "#fff",
                                "type" 		=> "color"
                        );
                               
        $of_options[] = array( 	"name" 		=> __("Content background color", 'ThemeStockyard'),
                                "desc" 		=> __("Post content, Top Bar, Main Navigation area, pricing tables, masonry cards, etc.", 'ThemeStockyard'),
                                "id" 		=> "content_background_color",
                                "std" 		=> "#fff",
                                "type" 		=> "color"
                        );
        */
        $of_options[] = array( 	"name" 		=> __("Standard Border Color", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "standard_border_color",
                                "std" 		=> '#eee',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> __("Subtle Text Color", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "subtle_text_color",
                                "std" 		=> '#999',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> __("Subtle Background Color", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "subtle_bg_color",
                                "std" 		=> '#f5f5f5',
                                "type" 		=> "color"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Top area colors", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "top_area_colors_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );
        
        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Text color", 'ThemeStockyard'),
                                "id" 		=> "top_bar_text_color",
                                "std" 		=> '#aaa',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Link color", 'ThemeStockyard'),
                                "id" 		=> "top_bar_link_color",
                                "std" 		=> '#808080',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> __("Alternate Logo", 'ThemeStockyard'),
                                "desc" 		=> __("Alternate logo color<br/><strong>Note:</strong> only useful if you haven't uploaded a logo.", 'ThemeStockyard'),
                                "id" 		=> "logo_font_color",
                                "std" 		=> '#EE4643',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> __("Logo Tagline", 'ThemeStockyard'),
                                "desc" 		=> __("Text color", 'ThemeStockyard'),
                                "id" 		=> "logo_tagline_color",
                                "std" 		=> '#808080',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> __("Main Navigation Colors", 'ThemeStockyard'),
                                "desc" 		=> __("Link color", 'ThemeStockyard'),
                                "id" 		=> "main_nav_link_color",
                                "std" 		=> '#444',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Hover/active color", 'ThemeStockyard'),
                                "id" 		=> "main_nav_hover_color",
                                "std" 		=> '#ee4643',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __('"Has sub-menu" indicator color', 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_indicator_color",
                                "std" 		=> '#e5e5e5',
                                "type" 		=> "color"
                        );
        /*                
        $of_options[] = array( 	"name" 		=> __("Main Navigation: Sub-menu", 'ThemeStockyard'),
                                "desc" 		=> __('Background Color', 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_bg_color",
                                "std" 		=> '#fff',
                                "type" 		=> "color"
                        );
        */                
        $of_options[] = array( 	"name" 		=> __("Main Navigation: Sub-menu", 'ThemeStockyard'),
                                "desc" 		=> __("Link color", 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_link_color",
                                "std" 		=> '#575757',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Hover/Active Link Color", 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_hover_color",
                                "std" 		=> '#ee4643',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Text Color", 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_text_color",
                                "std" 		=> '#808080',
                                "type" 		=> "color"
                        );
        /*
        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Border/Separator Color", 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_border_color",
                                "std" 		=> '#eee',
                                "type" 		=> "color"
                        );	

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Subtle Background Color", 'ThemeStockyard'),
                                "id" 		=> "main_nav_submenu_subtle_bg_color",
                                "std" 		=> '#f5f5f5',
                                "type" 		=> "color"
                        );
        */                
        $of_options[] = array( 	"name" 		=> __("Body/Content Colors", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "body_colors_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Body: General Links", 'ThemeStockyard'),
                                "desc" 		=> __("Link color", 'ThemeStockyard'),
                                "id" 		=> "body_link_color",
                                "std" 		=> "#ee4643",
                                "type" 		=> "color"
                        );
        
        $of_options[] = array( 	"name" 		=> __("Body: Title Links", 'ThemeStockyard'),
                                "desc" 		=> __("Link color", 'ThemeStockyard'),
                                "id" 		=> "body_title_link_color",
                                "std" 		=> "#212121",
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> __("Body: Plain Text", 'ThemeStockyard'),
                                "desc" 		=> __("Body text color", 'ThemeStockyard'),
                                "id" 		=> "body_font_color",
                                "std" 		=> '#555',
                                "type" 		=> "color",
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Body: &lt;H1-6&gt; Headings", 'ThemeStockyard'),
                                "desc" 		=> __("Body heading colors", 'ThemeStockyard'),
                                "id" 		=> "heading_font_color",
                                "std" 		=> '#444',
                                "type" 		=> "color",
                        );
                                      
        $of_options[] = array( 	"name" 		=> __("WooCommerce Colors", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "woocommerce_colors_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Price Color", 'ThemeStockyard'),
                                "id" 		=> "woocommerce_price_color",
                                "std" 		=> '#7ac142',
                                "type" 		=> "color",
                        );
                    
        $of_options[] = array( 	"name" 		=> __("Form Colors", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "form_colors_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );

        $of_options[] = array( 	"name" 		=> __("Form Element Colors", 'ThemeStockyard'),
                                "desc" 		=> __("Text color", 'ThemeStockyard'),
                                "id" 		=> "form_font_color",
                                "std" 		=> '#808080',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Form field background color", 'ThemeStockyard'),
                                "id" 		=> "form_background_color",
                                "std" 		=> '#eee',
                                "type" 		=> "color"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Footer Colors", 'ThemeStockyard'),
                                "desc" 		=> "",
                                "id" 		=> "footer_colors_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );
        
        $of_options[] = array( 	"name" 		=> __("Footer Area", 'ThemeStockyard'),
                                "desc" 		=> __("Background color", 'ThemeStockyard'),
                                "id" 		=> "footer_bg_color",
                                "std" 		=> "#f5f5f5",
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Link color", 'ThemeStockyard'),
                                "id" 		=> "footer_widgets_link_color",
                                "std" 		=> '#ee4643',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Plain text color", 'ThemeStockyard'),
                                "id" 		=> "footer_widget_font_color",
                                "std" 		=> '#808080',
                                "type" 		=> "color",
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Headings", 'ThemeStockyard'),
                                "id" 		=> "footer_widget_headings_color",
                                "std" 		=> '#808080',
                                "type" 		=> "color",
                        );
                                
        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Widget border colors (some widgets use borders, set those colors here)", 'ThemeStockyard'),
                                "id" 		=> "footer_widget_border_color",
                                "std" 		=> '#e5e5e5',
                                "type" 		=> "color"
                        );
                                
        $of_options[] = array( 	"name" 		=> __('Copyright Area Colors', 'ThemeStockyard'),
                                "desc" 		=> __("Copyright background color", 'ThemeStockyard'),
                                "id" 		=> "copyright_bg_color",
                                "std" 		=> '#EE4643',
                                "type" 		=> "color"
                        );
                                
        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Copyright link color", 'ThemeStockyard'),
                                "id" 		=> "copyright_link_color",
                                "std" 		=> '#fff',
                                "type" 		=> "color"
                        );
                                
        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Copyright text color", 'ThemeStockyard'),
                                "id" 		=> "copyright_text_color",
                                "std" 		=> '#f5f5f5',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> __("Footer Form Elements", 'ThemeStockyard'),
                                "desc" 		=> __("Text color", 'ThemeStockyard'),
                                "id" 		=> "footer_form_font_color",
                                "std" 		=> '#808080',
                                "type" 		=> "color"
                        );

        $of_options[] = array( 	"name" 		=> '',
                                "desc" 		=> __("Form field background color", 'ThemeStockyard'),
                                "id" 		=> "footer_form_background_color",
                                "std" 		=> '#eee',
                                "type" 		=> "color"
                        );
          

        
        // Backgrounds Styles
        $of_options[] = array(  "name"      => __("Background", 'ThemeStockyard'),
                                "type"      => "heading",
                                );
                                
        $of_options[] = array( "name" => __("Enable Fullwidth Layout", 'ThemeStockyard'),
                            "desc" => __("Turn <strong>off</strong> to use a background image.<br/><strong>Default:</strong> On", 'ThemeStockyard'),
                            "id" => "layout",
                            "std" => 1,
                            "type" => "switch");
        /*                        
        $of_options[] = array( "name" => __("Add Subtle Shadow To Content", 'ThemeStockyard'),
                            "desc" => __("This adds a very subtle shadow on the left and right sides of web page content. <strong>Note:</strong> Only useful when fullwidth layout is disabled.", 'ThemeStockyard'),
                            "id" => "layout_shadow",
                            "std" => 0,
                            "type" => "switch");
        */                                   
        $of_options[] = array( 	"name" 		=> __("Body background color.", 'ThemeStockyard'),
                                "desc" 		=> '',
                                "id" 		=> "background_color",
                                "std" 		=> "#fff",
                                "type" 		=> "color"
                        );
                                
        $of_options[] = array( 	"name" 		=> __("Body content background color", 'ThemeStockyard'),
                                "desc" 		=> __("<strong>Note:</strong> not useful with fullwidth layout", 'ThemeStockyard'),
                                "id" 		=> "content_background_color",
                                "std" 		=> "#fff",
                                "type" 		=> "color"
                        );

        $url =  get_template_directory_uri() . '/images/backgrounds/';
        $of_options[] = array( 	"name" 		=> __("Body: Background Pattern/Color", 'ThemeStockyard'),
                                "desc" 		=> __('Choose a background pattern and color for your website.<br/><br/>Visit <a href="http://subtlepatterns.com" target="_blank">SubtlePatterns.com</a> for more.', 'ThemeStockyard'),
                                "id" 		=> "background_pattern",
                                "std" 		=> "",
                                "type" 		=> "images",
                                "options" 	=> array(
                                    '' 	            => $url . 'none_thumb.jpg',
                                    'arches' 	    => $url . 'arches_thumb.png',
                                    'bright-squares'    => $url . 'bright-squares_thumb.jpg',
                                    'cartographer'    => $url . 'cartographer_thumb.png',	
                                    'dark_wood' 	    => $url . 'dark_wood_thumb.png',
                                    'diagmonds'    => $url . 'diagmonds_thumb.png',
                                    'escheresque_ste' 	    => $url . 'escheresque_ste_thumb.png',
                                    'escheresque'    => $url . 'escheresque_thumb.png',
                                    'food'    => $url . 'food_thumb.png',
                                    'gplaypattern' 	    => $url . 'gplaypattern_thumb.png',
                                    'graphy'    => $url . 'graphy_thumb.png',
                                    'green_cup'    => $url . 'green_cup_thumb.png',
                                    'grunge-wall' 	    => $url . 'grunge-wall_thumb.jpg',
                                    'px_by_Gr3g' 	    => $url . 'px_by_Gr3g_thumb.png',							
                                    'retina_wood'    => $url . 'retina_wood_thumb.jpg',
                                    'school'    => $url . 'school_thumb.png',
                                    'shattered'    => $url . 'shattered_thumb.png',
                                    'skulls'    => $url . 'skulls_thumb.png',
                                    'sneaker_mesh_fabric'      => $url . 'sneaker_mesh_fabric_thumb.jpg',
                                    'stressed_linen' 	    => $url . 'stressed_linen_thumb.png',
                                    'swirl_pattern'    => $url . 'swirl_pattern_thumb.png',
                                    'symphony'    => $url . 'symphony_thumb.png',
                                    'tileable_wood_texture'    => $url . 'tileable_wood_texture_thumb.png',
                                    'type' 	    => $url . 'type_thumb.png',
                                )
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" => __("<strong>Alternatively, you can upload your own.</strong> Check the box to get started.", 'ThemeStockyard'),
                                "id" => "use_custom_background_image",
                                "std" => 0,
                                "type" => "checkbox",
                                "folds" => 1,
                        );

        $of_options[] = array( 	"name" 		=> __("Body: Custom Background Image", 'ThemeStockyard'),
                                "desc" => __('Upload a custom background image or pattern here.<br/><strong>Note:</strong> only useful in &#8220;Boxed&#8221; layout', 'ThemeStockyard'),
                                "id" => "custom_background_image",
                                "std" => "",
                                "type" => "media",
                                "fold" => "use_custom_background_image"
                        );

        $of_options[] = array( 	"name" 		=> "",
                                "desc" 		=> __("Custom background image properties: Repeat, Position, Attachment", 'ThemeStockyard'),
                                "id" 		=> "custom_background_positioning",
                                "std" 		=> array('position'=>'top center', 'repeat'=>'repeat', 'attachment'=>'scroll'),
                                "type" 		=> "background_positioning",
                                "options" 	=> array('position'=>$body_pos, 'repeat'=>$body_repeat, 'attachment'=>$body_attachment),
                                "fold" => "use_custom_background_image"
                        );
        /*
        $of_options[] = array( 	"name" 		=> "",
                                "desc" => __("<strong>Use background image with Fullwidth layout.</strong><br/>By default, background images are only used with the boxed layout.", 'ThemeStockyard'),
                                "id" => "fullwidth_bg_image",
                                "std" => 0,
                                "type" => "checkbox",
                        );
        */



        // Backup Options
        $of_options[] = array( 	"name" 		=> __("Backup Options", 'ThemeStockyard'),
                                "type" 		=> "heading",
                                "class"     => "mt10"
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Backup and Restore Options", 'ThemeStockyard'),
                                "id" 		=> "of_backup",
                                "std" 		=> "",
                                "type" 		=> "backup",
                                "desc" 		=> __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'ThemeStockyard'),
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Transfer Theme Options Data", 'ThemeStockyard'),
                                "id" 		=> "of_transfer",
                                "std" 		=> "",
                                "type" 		=> "transfer",
                                "desc" 		=> __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'ThemeStockyard'),
                        );
                        
        // Documentation Options
        $of_options[] = array( 	"name" 		=> __("Documentation", 'ThemeStockyard'),
                                "type" 		=> "heading",
                                "class"     => ""
                        );
                        
        $of_options[] = array( 	"name" 		=> __("Documentation Info", 'ThemeStockyard'),
                                "desc" 		=> __('A copy of the documentation for the Matador theme can always be found online at: <a href="http://themestockyard.com/matador/documentation" target="_blank">http://themestockyard.com/matador/documentation</a><br/><br/>Additionally, a copy should have been included with your Themeforest download.', 'ThemeStockyard'),
                                "id" 		=> "documentation_info",
                                "std" 		=> '',
                                "icon" 		=> true,
                                "type" 		=> "info"
                        );
				
	}//End function: of_options()
}//End check if function exists: of_options()