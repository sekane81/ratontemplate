<?php

/*  Initialize the meta boxes.
/* ------------------------------------ */
add_action( 'admin_init', '_custom_meta_boxes' );

function _custom_meta_boxes() {
  
$page_options = array(
	'id'          => 'page-options',
	'title'       => __('Page Options', 'T20'),
	'desc'        => '',
	'pages'       => array( 'page' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> __('Page Title', 'T20'),
			'id'		=> '_page_title',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'desc'		=> __('If you like to display page title before content please set this On', 'T20')
		),
		array(
			'label'		=> __('Layout', 'T20'),
			'id'		=> '_layout',
			'type'		=> 'radio-image',
			'desc'		=> __('Overrides the default layout option', 'T20'),
			'std'		=> 'inherit',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> __('Default Layout - Set from Theme Options for all pages and posts', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/layout-off.png'
				),
				array(
					'value'		=> 'without-sidebar',
					'label'		=> __('Without Sidebar - Fullwide', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-1c.png'
				),
				array(
					'value'		=> 'sidebar-right',
					'label'		=> __('1 Sidebar Right', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-2cl.png'
				),
				array(
					'value'		=> 'sidebar-left',
					'label'		=> __('1 Sidebar Left', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-2cr.png'
				),
				array(
					'value'		=> 'both-sidebar',
					'label'		=> __('Both Sidebar', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-3cm.png'
				),
				array(
					'value'		=> 'both-sidebar-right',
					'label'		=> __('Both Sidebar Right', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-3cl.png'
				),
				array(
					'value'		=> 'both-sidebar-left',
					'label'		=> __('Both Sidebar Left', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-3cr.png'
				)
			)
		),
		array(
			'label'		=> __('Primary Sidebar', 'T20'),
			'id'		=> '_sidebar_primary',
			'type'		=> 'sidebar-select',
			'desc'		=> __('Overrides default', 'T20')
		),
		array(
			'label'		=> __('Secondary Sidebar', 'T20'),
			'id'		=> '_sidebar_secondary',
			'type'		=> 'sidebar-select',
			'desc'		=> __('Overrides default', 'T20')
		),
		array(
			'label'		=> __('Page Comments', 'T20'),
			'id'		=> '_page_comments',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'desc'		=> __('If you like to display page comments after content please set this On', 'T20')
		),
		array(
			'label'		=> __('Display Loop', 'T20'),
			'id'		=> '_loop',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'desc'		=> __('If you like to display posts loops in this page please set "on", also you can use page builder will effective before loop.', 'T20')
		),
		array(
			'id'		=> '_loop_category',
			'label'		=> __('Loop category', 'T20'),
			'desc'		=> __('By not selecting a category, it will show your latest post(s) from all categories', 'T20'),
			'type'		=> 'category-checkbox'
		),
		array(
			'label'		=> __('Masonry', 'T20'),
			'id'		=> 'masonry_meta',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'desc'		=> __('Do you like to display posts in masonry style?', 'T20')
		),
		array(
			'label'		=> __('Columns', 'T20'),
			'id'		=> 'masonry_col',
			'type'		=> 'radio',
			'std'		=> 'three_col_mas',
			'choices'	=> array(
				array(
					'value'		=> 'two_col_mas',
					'label'		=> '2',
				),
				array(
					'value'		=> 'three_col_mas',
					'label'		=> '3',
				),
				array(
					'value'		=> 'four_col_mas',
					'label'		=> '4',
				)
			)
		),
	)
);  

$page_slideshow = array(
	'id'          => 'slideshow-options',
	'title'       => __('Slideshow Options', 'T20'),
	'desc'        => '',
	'pages'       => array( 'page' ),
	'context'     => 'normal',
	'priority'    => 'low',
	'fields'      => array(
		array(
			'id'		=> '_slideshow_category',
			'label'		=> __('Slideshow posts by category', 'T20'),
			'desc'		=> __('By not selecting a category, it will show your latest post(s) from all categories', 'T20'),
			'type'		=> 'category-checkbox'
		),
		array(
			'id'		=> '_slideshow_tag',
			'label'		=> __('Slideshow posts by tags', 'T20'),
			'desc'		=> __('-', 'T20'),
			'type'		=> 'tag-checkbox'
		),
		array(
			'id'		=> '_slideshow_num',
			'label'		=> __('Slideshow Number of slides', 'T20'),
			'desc'		=> __('Number of all posts in slideshow', 'T20'),
			'std'		=> '15',
			'type'		=> 'numeric-slider',
			'min_max_step'	=> '1,30,1'
		),
		array(
			'id'		=> '_slideshow_num_view',
			'label'		=> __('Slideshow Number of slides in view', 'T20'),
			'desc'		=> __('Number of posts in screen view', 'T20'),
			'std'		=> '5',
			'type'		=> 'numeric-slider',
			'min_max_step'	=> '1,5,1'
		),
		array(
			'id'		=> '_slideshow_pos',
			'label'		=> __('Slideshow Position', 'T20'),
			'desc'		=> __('If you want moving slideshow at above of header turn this on', 'T20'),
			'std'		=> 'off',
			'type'		=> 'on-off'
		),
		array(
			'id'		=> '_autoPlay',
			'label'		=> __('autoPlay', 'T20'),
			'desc'		=> '-',
			'std'		=> 'on',
			'type'		=> 'on-off'
		),
		array(
			'id'		=> '_stopOnHover',
			'label'		=> __('stopOnHover', 'T20'),
			'desc'		=> '-',
			'std'		=> 'on',
			'type'		=> 'on-off'
		),
		array(
			'id'		=> '_pagination',
			'label'		=> __('Pagination', 'T20'),
			'desc'		=> '-',
			'std'		=> 'on',
			'type'		=> 'on-off'
		),
		array(
			'id'		=> '_navigation',
			'label'		=> __('navigation', 'T20'),
			'desc'		=> __('Navigation Arrows', 'T20'),
			'std'		=> 'off',
			'type'		=> 'on-off'
		),
		array(
			'id'		=> '_slideSpeed',
			'label'		=> __('SlideSpeed', 'T20'),
			'desc'		=> __('default is 1500 - This parameter is speed for when you touch and leave slides or select on arrows.', 'T20'),
			'std'		=> '1500',
			'type'		=> 'numeric-slider',
			'min_max_step'	=> '100,3000,100'
		),
		array(
			'id'		=> '_paginationSpeed',
			'label'		=> __('paginationSpeed', 'T20'),
			'desc'		=> __('default is 500 - This parameter is speed for when you select pagination for change slides', 'T20'),
			'std'		=> '500',
			'type'		=> 'numeric-slider',
			'min_max_step'	=> '100,5000,100'
		)
	)
);

$post_options = array(
	'id'          => 'post-options',
	'title'       => __('Post Options', 'T20'),
	'desc'        => '',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> __('Layout', 'T20'),
			'id'		=> '_layout',
			'type'		=> 'radio-image',
			'desc'		=> __('Overrides the default layout option', 'T20'),
			'std'		=> 'inherit',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> __('Default Layout - Set from Theme Options for all pages and posts', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/layout-off.png'
				),
				array(
					'value'		=> 'without-sidebar',
					'label'		=> __('Without Sidebar - Fullwide', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-1c.png'
				),
				array(
					'value'		=> 'sidebar-right',
					'label'		=> __('1 Sidebar Right', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-2cl.png'
				),
				array(
					'value'		=> 'sidebar-left',
					'label'		=> __('1 Sidebar Left', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-2cr.png'
				),
				array(
					'value'		=> 'both-sidebar',
					'label'		=> __('Both Sidebar', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-3cm.png'
				),
				array(
					'value'		=> 'both-sidebar-right',
					'label'		=> __('Both Sidebar Right', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-3cl.png'
				),
				array(
					'value'		=> 'both-sidebar-left',
					'label'		=> __('Both Sidebar Left', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/col-3cr.png'
				)
			)
		),
		array(
			'label'		=> __('Primary Sidebar', 'T20'),
			'id'		=> '_sidebar_primary',
			'type'		=> 'sidebar-select',
			'desc'		=> __('Overrides default', 'T20')
		),
		array(
			'label'		=> __('Secondary Sidebar', 'T20'),
			'id'		=> '_sidebar_secondary',
			'type'		=> 'sidebar-select',
			'desc'		=> __('Overrides default', 'T20')
		)
	)
);

$post_format_audio = array(
	'id'          => 'format-audio',
	'title'       => __('Format: Audio', 'T20'),
	'desc'        => __('These settings enable you to embed audio into your posts. You must provide both .mp3 and .ogg/.oga file formats in order for self hosted audio to function accross all browsers.', 'T20'),
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> __('Audio Code', 'T20'),
			'id'		=> '_audio_code',
			'type'		=> 'textarea',
			'rows'		=> '3',
			'desc'		=> __('Put your audio embed code', 'T20')
		)
	)
);
$post_format_gallery = array(
	'id'          => 'format-gallery',
	'title'       => __('Format: Gallery', 'T20'),
	'desc'        => '<a title="Add Media" data-editor="content" class="button insert-media add_media" id="insert-media-button" href="#">Add Media</a> <br /><br />
						To create a gallery, upload your images and then select "<strong>Uploaded to this post</strong>" from the dropdown (in the media popup) to see images attached to this post. You can drag to re-order or delete them there. <br /><br /><i>Note: Do not click the "Insert into post" button. Only use the "Insert Media" section of the upload popup, not "Create Gallery" which is for standard post galleries.</i>',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array()
);
$post_format_video = array(
	'id'          => 'format-video',
	'title'       => __('Format: Video', 'T20'),
	'desc'        => __('This setting enable you to embed videos into your posts.', 'T20'),
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> __('Video Embed Code', 'T20'),
			'id'		=> '_video_embed_code',
			'type'		=> 'textarea',
			'rows'		=> '2'
		)
	)
);

/*  Register meta boxes
/* ------------------------------------ */
	ot_register_meta_box( $page_options );
	ot_register_meta_box( $page_slideshow );
	ot_register_meta_box( $post_format_audio );
	ot_register_meta_box( $post_format_gallery );
	ot_register_meta_box( $post_format_video );
	ot_register_meta_box( $post_options );
}