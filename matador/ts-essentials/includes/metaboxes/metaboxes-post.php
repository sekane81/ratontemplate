<?php
/*-----------------------------------------------------------------------------------*/
/*  POST METABOX */
/*-----------------------------------------------------------------------------------*/
add_filter ('cmb_meta_boxes', 'cmb_post_metaboxes', 500);
function cmb_post_metaboxes(array $meta_boxes) 
{	    
    $prefix = '_p_';

    $meta_boxes[] = array(
        'id'         => 'post_metabox2',
        'title'      => __('General Post Settings', 'ThemeStockyard'),
        'pages'      => array( 'post' ),
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
                'name'    => __('Show Title Bar', 'ThemeStockyard'),
                'id'      => $prefix . 'titlebar',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('No', 'ThemeStockyard'),  'value' => 'no'),
                ),
                "std"     => 'default',
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
                "std"     => 'default',
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
                    array('name' => __('Right (under featured image)', 'ThemeStockyard'), 'value' => 'content-right'),
                    array('name' => __('Left (under featured image)', 'ThemeStockyard'), 'value' => 'content-left'),
                    array('name' => __('Right (next to comments)', 'ThemeStockyard'), 'value' => 'comments-right'),
                    array('name' => __('Left (next to comments)', 'ThemeStockyard'), 'value' => 'comments-left'),
                ),
                "std"     => 'default'
            ),
        
            array(
                'name'    => __('Sharing Options position', 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'sharing_options_position',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Top (below featured image)', 'ThemeStockyard'), 'value' => 'top'),
                    array('name' => __('Bottom (below post content)', 'ThemeStockyard'), 'value' => 'bottom'),
                    array('name' => __('Hidden', 'ThemeStockyard'), 'value' => 'hidden'),
                ),
                "std"     => 'default',
            ),
        
               
            array(
                'name'    => __('Show featured media on single post', 'ThemeStockyard'),
                'desc'    => __('Show or hide the featured media (image, video, audio) when viewing this individual post page', 'ThemeStockyard'),
                'id'      => $prefix . 'show_featured_image_on_single',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),
                ),
                "std"     => 'default',
            ),
        
               
            array(
                'name'    => __('Preview Image', 'ThemeStockyard'),
                'desc'    => __('Preview Images can be used as alternatives to Featured Images within the &#8220;posts loop&#8221; (archives, blog, search, recent posts, etc) &ndash; they are <strong>not</strong> shown within sliders or on single post pages.', 'ThemeStockyard'),
                'id'      => $prefix . 'preview_image',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => 'upload',
            ),
            /*
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
            */
        
            array(
                'name'    => __('Show "Previous/Next" post links?', 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'show_direction_links',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('Yes (from same category)', 'ThemeStockyard'), 'value' => 'yes_similar'),
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),
                ),
                "std"     => 'default',
            ),
            
            array(
                'name'    => __('Show Related Posts', 'ThemeStockyard'),
                'id'      => $prefix . 'related_posts',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Yes - filter by category', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('Yes - use a specific category...', 'ThemeStockyard'), 'value' => 'yes_specific_cat'),
                    array('name' => __('Yes - filter by tags', 'ThemeStockyard'), 'value' => 'yes_tag'),
                    array('name' => __('Yes - use a specific tag...', 'ThemeStockyard'), 'value' => 'yes_specific_tag'),
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),               
                )
            ),
            
            array(
                'name'    => __('Related Posts: Enter a Category', 'ThemeStockyard'),
                'desc'    => __('Please enter one category only!', 'ThemeStockyard'),
                'id'      => $prefix . 'specific_related_category',
                'type'    => 'text',
                "std"     => '',
                'unhide_id' => $prefix . 'related_posts',
                'unhide_value' => 'yes_specific_cat'
            ),
            
            array(
                'name'    => __('Related Posts: Enter a Tag', 'ThemeStockyard'),
                'desc'    => __('Please enter one tag only!', 'ThemeStockyard'),
                'id'      => $prefix . 'specific_related_tag',
                'type'    => 'text',
                "std"     => '',
                'unhide_id' => $prefix . 'related_posts',
                'unhide_value' => 'yes_specific_tag'
            ),
            
            array(
                'name'    => __('Crop featured image(s)?', 'ThemeStockyard'),
                'id'      => $prefix . 'crop_images',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Use default', 'ThemeStockyard'), 'value' => 'default'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'yes'),
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),               
                )
            ),

            array(
                'name' => __('Alternate Category Text (within Slider)', 'ThemeStockyard'),
                'desc' => __('If this post appears in a slider, the text entered here will be shown instead of the category name. <strong>Note:</strong> best to keep it short - one or two words.', 'ThemeStockyard'),
                'type' => 'text',
                'id'   => $prefix . 'alt_category_text'
            ),
            
            
            // start gallery & video settings...
            array(
                'name' => __('Gallery Settings' , 'ThemeStockyard'),
                'desc' => '',
                'type' => 'title',
                'id'   => $prefix . 'title_image_slider_project'
            ),
            
            array(
                'name'    => __('Image 1' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_1',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 2' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_2',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 3' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_3',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 4' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_4',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 5' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_5',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 6' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_6',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 7' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_7',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 8' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_8',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 9' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_9',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            array(
                'name'    => __('Image 10' , 'ThemeStockyard'),
                'desc'    => __('Upload an image or enter an URL.' , 'ThemeStockyard'),
                'id'      => $prefix . 'image_10',
                'type'    => 'file',
                'save_id' => true,
                'allow'   => array( 'attachment' )
            ),
            
            
        
            array(
                'name' => __('Video Settings', 'ThemeStockyard'),
                'desc' => __('To enable a featured video, paste a video ID or URL below.', 'ThemeStockyard'),
                'type' => 'title',
                'id'   => $prefix . 'video_title_menu_setting'
            ),

            array(
                'name' => __('Vimeo Video URL', 'ThemeStockyard'),
                'desc' => '',
                'type' => 'text',
                'id'   => $prefix . 'vimeo_id'
            ),

            array(
                'name' => __('YouTube Video URL', 'ThemeStockyard'),
                'desc' => '',
                'type' => 'text',
                'id'   => $prefix . 'youtube_id'
            ),

            array(
                'name' => __('Self-hosted Video', 'ThemeStockyard'),
                'desc' => __('Upload your own video.<br/><strong>Note:</strong> Self-hosted video is only supported on single post pages &mdash; not within the loop.', 'ThemeStockyard'),
                'type' => 'file',
                'id'   => $prefix . 'self_hosted_video',
            ),

            array(
                'name' => __('Video Embed Code', 'ThemeStockyard').'<br/><em>'.__('(iframes only)', 'ThemeStockyard').'</em>',
                'desc' => __('For all other videos, you can paste a video embed code.<br/><strong>Note:</strong> not supported within sliders.<br/> Please only use iframes here (example: &lt;iframe src="http://..."&gt;)', 'ThemeStockyard'),
                'type' => 'textarea_code',
                'id'   => $prefix . 'video_embed_code',
            ),
            
            
        
            array(
                'name' => __('Featured Audio Settings', 'ThemeStockyard'),
                'desc' => __('To enable featured audio, paste a SoundCloud or Spotify URL or embed code below.<br/><strong>Note:</strong> Featured Audio is only supported on single post pages &mdash; not within the loop.', 'ThemeStockyard'),
                'type' => 'title',
                'id'   => $prefix . 'audio_title_menu_setting'
            ),

            array(
                'name' => __('SoundCloud URL', 'ThemeStockyard'),
                'desc' => '',
                'type' => 'text',
                'id'   => $prefix . 'soundcloud_id'
            ),

            array(
                'name' => __('Spotify URL', 'ThemeStockyard'),
                'desc' => '',
                'type' => 'text',
                'id'   => $prefix . 'spotify_id'
            ),

            array(
                'name' => __('Self-hosted Audio', 'ThemeStockyard'),
                'desc' => __('Upload your own audio.', 'ThemeStockyard'),
                'type' => 'file',
                'id'   => $prefix . 'self_hosted_audio',
            ),
        ),
    );
    
    $meta_boxes[] = array(
        'id'         => 'post_metabox4',
        'title'      => __('Custom CSS', 'ThemeStockyard'),
        'pages'      => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'low',
        'show_names' => true,
        'fields'     => array(
        
            array(
                'desc'    => __('Type or paste your post-specific CSS here.', 'ThemeStockyard'),
                'id'      => $prefix . 'css',
                'type'    => 'textarea_code',
                "std"     => ''
            ),

        ),
    );

    return $meta_boxes;
}