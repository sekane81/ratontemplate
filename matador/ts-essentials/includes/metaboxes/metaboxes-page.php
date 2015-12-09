<?php
/*-----------------------------------------------------------------------------------*/
/* PAGE METABOX */
/*-----------------------------------------------------------------------------------*/

add_filter ('cmb_meta_boxes', 'cmb_page_metaboxes', 505);
function cmb_page_metaboxes(array $meta_boxes) 
{
    global $wpdb;
    
    /*** begin: helper variables ***/
    $cmb_slider_count = array();
    for($i = 1; $i <= 10; $i++) {
        $cmb_slider_count[] = array('name'=>$i, 'value'=>$i);
    }        
    
    $ts_cmb_categories 		= array(); 
    $ts_cmb_categories_obj 	= get_categories('hide_empty=0');
    foreach ($ts_cmb_categories_obj as $cmb_cat) {
        $ts_cmb_categories[$cmb_cat->term_id] = $cmb_cat->cat_name;
    }        
    
    $ts_cmb_categories_v2 		= array(); 
    $ts_cmb_categories_obj_v2 	= get_categories('hide_empty=0');
    foreach ($ts_cmb_categories_obj_v2 as $cmb_cat) {
        $ts_cmb_categories_v2[] = array("name"=>$cmb_cat->cat_name, "value"=>$cmb_cat->term_id);
    }        
    
    $cmb_bg_repeat      = array(
                            array("name"=>"repeat", "value"=>"repeat"),
                            array("name"=>"no-repeat", "value"=>"no-repeat"),
                            array("name"=>"repeat-x", "value"=>"repeat-x"),
                            array("name"=>"repeat-y", "value"=>"repeat-y"),
                        );
                            
    $cmb_bg_pos 		= array(
                            array("name"=>"top left", "value"=>"top left"),
                            array("name"=>"top center", "value"=>"top center"),
                            array("name"=>"top right", "value"=>"top right"),
                            array("name"=>"center left", "value"=>"center left"),
                            array("name"=>"center center", "value"=>"center center"),
                            array("name"=>"center right", "value"=>"center right"),
                            array("name"=>"bottom left", "value"=>"bottom left"),
                            array("name"=>"bottom center", "value"=>"bottom center"),
                            array("name"=>"bottom right", "value"=>"bottom right"),
                        );
    
    $ts_rev_sliders = array();
    $ts_rev_sliders[] = array('name'=>__('[none]','ThemeStockyard'), 'value'=>'');
    if(function_exists('rev_slider_shortcode')) {
        $get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
        if($get_sliders) {
            foreach($get_sliders as $slider) {
                $ts_rev_sliders[] = array('name'=>$slider->title, 'value'=>$slider->alias);
            }
        }
    }
    
    $ts_slider_type_options = array(
        array('name' => __('[none]', 'ThemeStockyard'), 'value' => ''),
        array('name' => __('Flexslider', 'ThemeStockyard'),  'value' => 'flex'),
        //array('name' => __('Carousel Slider', 'ThemeStockyard'), 'value' => 'carousel'),
    );
    if(function_exists('rev_slider_shortcode')) {
        $ts_slider_type_options[] = array('name' => __('Slider Revolution', 'ThemeStockyard'),  'value' => 'rev');
    }
    /*** end: helper variables ***/
    
    
    $prefix = '_page_';

    $meta_boxes[] = array(
        'id'         => 'page_metabox',
        'title'      => __('General Page Settings', 'ThemeStockyard'),
        'pages'      => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields'     => array(

            array(
                'name'    => __('Title Bar Caption', 'ThemeStockyard'),
                'id'      => $prefix . 'titlebar_caption',
                'type'    => 'text',
                "std"     => ''
            ),

            array(
                'name'    => __('Show Page Title Bar', 'ThemeStockyard'),
                'id'      => $prefix . 'titlebar',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('No', 'ThemeStockyard'),  'value' => 'no'),
                ),
                "std"     => 'default'
            ),
               
            array(
                'name'    => __('Show the sidebar?', 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'sidebar',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),
                ),
                "std"     => 'default'
            ),
               
            array(
                'name'    => __('Sidebar Position', 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Right', 'ThemeStockyard'), 'value' => 'right'),
                    array('name' => __('Left', 'ThemeStockyard'), 'value' => 'left'),
                ),
                "std"     => 'default'
            ),
            
            array(
                'name'    => __('Content Padding', 'ThemeStockyard'),
                'desc'    => __('Top/bottom content padding is automatically removed in some cases.', 'ThemeStockyard'),
                'id'      => $prefix . 'content_padding',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Normal', 'ThemeStockyard'), 'value' => ''),
                    array('name' => __('Remove Top Padding', 'ThemeStockyard'), 'value' => 'no_top_padding'),
                    array('name' => __('Remove Bottom Padding', 'ThemeStockyard'), 'value' => 'no_bottom_padding'),
                    array('name' => __('Remove Top & Bottom Padding', 'ThemeStockyard'), 'value' => 'no_padding'),           
                )
            ),
            
            array(
                'name' => __('Slider Settings' , 'ThemeStockyard'),
                'desc' => __('These slider settings work on all pages except blog, archive, and search pages.', 'ThemeStockyard'),
                'type' => 'title',
                'id'   => $prefix . 'title_image_slider_project'
            ), 
            
            array(
                'name'    => __('Slider Type', 'ThemeStockyard'),
                'id'      => $prefix . 'slider_type',
                'type'    => 'select',
                'options' => $ts_slider_type_options,
                "std"     => ''
            ),
            
            array(
                'name'    => __('Slider Revolution: Select a slider', 'ThemeStockyard'),
                'id'      => $prefix . 'rev_slider',
                'desc'    => __('This setting is only useful when the <a href="http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380?ref=themestockyard" target="_blank">Slider Revolution</a> plugin is installed and activated.', 'ThemeStockyard'),
                'type'    => 'select',
                "std"     => '',
                'options' => $ts_rev_sliders,
                'hidden'  => true,
                'unhide_id' => $prefix . 'slider_type',
                'unhide_value' => 'rev'
            ),
            
            array(
                'name'    => '',
                'id'      => $prefix . 'rev_slider_stop_here',
                'desc'    => __('The following slider settings are not used with the Slider Revolution.', 'ThemeStockyard'),
                'type'    => 'title',
                'hidden'  => true,
                'unhide_id' => $prefix . 'slider_type',
                'unhide_value' => 'rev'
            ),
            
            array(
                'name'    => __('Slider Source', 'ThemeStockyard'),
                'id'      => $prefix . 'slider_source',
                //'desc'    => __('Choose whether the slides should come from &#8220;Blog posts&#8221; or &#8220;Slider posts&#8221;.', 'ThemeStockyard'),
                'type'    => 'select',
                'options' => array(
                    //array('name' => __('[none]', 'ThemeStockyard'), 'value' => ''),
                    array('name' => __('Blog posts', 'ThemeStockyard'), 'value' => 'blog'),
                    array('name' => __('Specific blog posts', 'ThemeStockyard'), 'value' => 'specific_blog_posts'),
                    //array('name' => __('Portfolio posts', 'ThemeStockyard'),  'value' => 'portfolio'),
                ),
                "std"     => 'blog',
            ),
            
            
            array(
                'name' => __('Input Blog Post IDs', 'ThemeStockyard'),
                'desc' => __('Separate with commas. <strong>Note:</strong> To easily see blog post IDs, navigate to Dashboard > Posts to see the column displaying IDs.', 'ThemeStockyard'),
                'id'   => $prefix . 'slider_blog_post_ids',
                'type' => 'text',
                'std'  => '',
                'unhide_id' => $prefix . 'slider_source',
                'unhide_value' => 'specific_blog_posts'
            ),

            array(
                'name'    => __('Blog Categories', 'ThemeStockyard'),
                'id'      => $prefix . 'slider_blog_cats',
                'desc'    => __('Leave all unchecked to show posts from <strong>all</strong> categories.', 'ThemeStockyard'),
                'type'    => 'multicheck',
                'options' => $ts_cmb_categories,
                "std"     => '',
                'hidden'  => true,
                'unhide_id' => $prefix . 'slider_source',
                'unhide_value' => 'blog'
            ),
            
            /*
            array(
                'name'    => __('Portfolio Categories', 'StoryAndCraft'),
                'id'      => $prefix . 'slider_portfolio_cats',
                'desc'    => __('Leave all unchecked to show posts from <strong>all</strong> categories.', 'ThemeStockyard'),
                'type'    => 'taxonomy_multicheck',
                'taxonomy'=> 'portfolio-category',
                "std"     => '',
                'hidden'  => true,
                'unhide_id' => $prefix . 'slider_source',
                'unhide_value' => 'portfolio'
            ),
            */

            array(
                'name'    => __('Text Alignment', 'ThemeStockyard'),
                'id'      => $prefix . 'slider_text_align',
                'desc'    => __('Title, description, etc', 'ThemeStockyard'),
                'type'    => 'select',
                'options' => array(
                    array('name' => __('left', 'ThemeStockyard'), 'value' => 'left'),
                    array('name' => __('center', 'ThemeStockyard'), 'value' => 'center'),
                    array('name' => __('right', 'ThemeStockyard'),  'value' => 'right'),
                ),
                "std"     => 'left'
            ),
            
            array(
                'name'    => __('# of Slides', 'ThemeStockyard'),
                'id'      => $prefix . 'slider_count',
                'desc'    => __('Choose the number of items to show in the slider.', 'ThemeStockyard'),
                'type'    => 'select',
                'options' => $cmb_slider_count,
                "std"     => 5,
            ),
            

            array(
                'name'    => __('Allow videos?', 'ThemeStockyard'),
                'id'      => $prefix . 'slider_allow_videos',
                'desc'    => '',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),
                ),
                "std"     => 'no',
                'unhide_id' => $prefix . 'slider_type',
                'unhide_value' => 'carousel'
            ),
            
            
            array(
                'name'    => __('Slider Width', 'ThemeStockyard'),
                'id'      => $prefix . 'slider_width',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Full width', 'ThemeStockyard'), 'value' => 'fullwidth'),
                    array('name' => __('Content Width', 'ThemeStockyard'), 'value' => 'content'),
                ),
                "std"     => 'fullwidth'
            ),
            
            
            array(
                'name' => __('Enable Parallax Effect?', 'ThemeStockyard'),
                'desc' => __('Only works with "Full width" slider', 'ThemeStockyard'),
                'id'   => $prefix . 'slider_enable_parallax',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                ),
                'unhide_id' => $prefix . 'slider_width',
                'unhide_value' => 'fullwidth'
            ),
            
            array(
                'name' => __('Slider Height', 'ThemeStockyard'),
                'desc' => __('Leave blank for default (450px)', 'ThemeStockyard'),
                'id'   => $prefix . 'slider_height',
                'type' => 'text_small',
                'std'  => '',
                'unhide_id' => $prefix . 'slider_type',
                'unhide_value' => 'flex'
            ),
            
            /*
            array(
                'name' => __('Slider Height', 'ThemeStockyard'),
                'desc' => __('Leave blank for default: 400px (Minimum: 300px - Maximum: 600px)', 'ThemeStockyard'),
                'id'   => $prefix . 'slider_carousel_height',
                'type' => 'text_small',
                'std'  => '',
                'unhide_id' => $prefix . 'slider_type',
                'unhide_value' => 'carousel'
            ),
            */
            
            array(
                'name' => __('Homepage Template Settings' , 'ThemeStockyard'),
                'desc' => __('These settings will only appear when using certain "Homepage" templates. For additional instructions on imitating the homepages in the Matador demo, please <a href="http://themestockyard.com/matador/documentation/" target="_blank">view the documentation</a>.', 'ThemeStockyard'),
                'type' => 'title',
                'id'   => $prefix . 'title_image_slider_project'
            ), 
            
            array(
                'name'    => __('Home - Alt. 3 <br/>Right column category', 'ThemeStockyard'),
                'id'      => $prefix . 'home_alt_3_cat',
                'type'    => 'select',
                'options' => $ts_cmb_categories_v2,
                "std"     => '',
                'unhide_id' => 'page_template',
                'unhide_value' => 'home-alt-3.php'
            ),
            
            array(
                'name'    => __('Home - Alt. 4 <br/>Left column category', 'ThemeStockyard'),
                'id'      => $prefix . 'home_alt_4_cat_left',
                'type'    => 'select',
                'options' => $ts_cmb_categories_v2,
                "std"     => '',
                'unhide_id' => 'page_template',
                'unhide_value' => 'home-alt-4.php'
            ),
            
            array(
                'name'    => __('Home - Alt. 4 <br/>Right column category', 'ThemeStockyard'),
                'id'      => $prefix . 'home_alt_4_cat_right',
                'type'    => 'select',
                'options' => $ts_cmb_categories_v2,
                "std"     => '',
                'unhide_id' => 'page_template',
                'unhide_value' => 'home-alt-4.php'
            ),

        ),
    );

    $meta_boxes[] = array(
        'id'         => 'page_metabox2',
        'title'      => __('Custom CSS', 'ThemeStockyard'),
        'pages'      => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'low',
        'show_names' => true,
        'fields'     => array(

            array(
                'desc'    => __('Type or paste your page-specific CSS here.', 'ThemeStockyard'),
                'id'      => $prefix . 'css',
                'type'    => 'textarea_code',
                "std"     => ''
            ),
             
        ),
    );

    return $meta_boxes;
}