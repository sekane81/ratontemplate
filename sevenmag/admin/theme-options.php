<?php

add_action( 'admin_init', 'custom_theme_options', 1 );

/*  Build the custom settings & update
/* ------------------------------------ */
function custom_theme_options() {
	
	// Get a copy of the saved settings array.
	$saved_settings = get_option( 'option_tree_settings', array() );
	$custom_settings = array(	
		'sections'        => array(
			array(
				'id'		=> 'general',
				'title'		=> __('<i class="ot-icon-cog"></i> General', 'T20'),
			),
			array(
				'id'		=> 'layout',
				'title'		=> __('<i class="ot-icon-columns"></i> Layout', 'T20'),
			),
			array(
				'id'		=> 'header',
				'title'		=> __('<i class="ot-icon-upload"></i> Header', 'T20'),
			),
			array(
				'id'		=> 'mega',
				'title'		=> __('<i class="ot-icon-filter"></i> Navigation', 'T20'),
			),
			array(
				'id'		=> 'blog',
				'title'		=> __('<i class="ot-icon-pencil"></i> Posts', 'T20'),
			),
			array(
				'id'		=> 'styling',
				'title'		=> __('<i class="ot-icon-tint"></i> Styling', 'T20'),
			),
			array(
				'id'		=> 'sidebar',
				'title'		=> __('<i class="ot-icon-th-list"></i> Create Sidebar', 'T20'),
			),
			array(
				'id'		=> 'bbpress',
				'title'		=> __('<i class="ot-icon-comments-alt"></i>bbpress', 'T20'),
			),
			array(
				'id'		=> 'bp',
				'title'		=> __('<i class="ot-icon-user"></i>Buddypress', 'T20'),
			),
			array(
				'id'		=> 'woocommerce',
				'title'		=> __('<i class="ot-icon-shopping-cart"></i>Woocommerce', 'T20'),
			),
			array(
				'id'		=> 'dwqa',
				'title'		=> __('<i class="ot-icon-question"></i>DWQA Layout', 'T20'),
			),
			array(
				'id'		=> 'translation',
				'title'		=> __('<i class="ot-icon-globe"></i> Translation', 'T20'),
			),
		),
	
/*  Theme options
/* ------------------------------------ */
	'settings'        => array(
		
		// General: Animations
		array(
			'id'		=> 'introfx',
			'label'		=> __('Load elements on scroll', 'T20'),
			'desc'		=> __('Adding load effect when user scrolling down elements will load one by one.', 'T20'),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'		=> 'general'
		),
		// General: AnimFX
		array(
			'id'		=> 'anim_fx',
			'label'		=> __('Animation Type', 'T20'),
			'desc'		=> __('Animation load effect type.', 'T20'),
			'std'		=> 'fadeInUp',
			'type'		=> 'select',
			'section'	=> 'general',
			'choices'	=> array(
				array( 
					'value' => 'fadeInUp',
					'label' => __('fadeInUp', 'T20')
				),
				array( 
					'value' => 'fadeInDown',
					'label' => __('fadeInDown', 'T20')
				),
				array( 
					'value' => 'fadeInLeft',
					'label' => __('fadeInLeft', 'T20')
				),
				array( 
					'value' => 'fadeInRight',
					'label' => __('fadeInRight', 'T20')
				),
				array( 
					'value' => 'bigEntrance',
					'label' => __('bigEntrance', 'T20')
				),
				array( 
					'value' => 'flash',
					'label' => __('flash', 'T20')
				),
				array( 
					'value' => 'shake',
					'label' => __('shake', 'T20')
				),
				array( 
					'value' => 'tada',
					'label' => __('tada', 'T20')
				),
				array( 
					'value' => 'swing',
					'label' => __('swing', 'T20')
				),
				array( 
					'value' => 'wobble',
					'label' => __('wobble', 'T20')
				),
				array( 
					'value' => 'pulse',
					'label' => __('pulse', 'T20')
				),
				array( 
					'value' => 'flip',
					'label' => __('flip', 'T20')
				),
				array( 
					'value' => 'flipInX',
					'label' => __('flipInX', 'T20')
				),
				array( 
					'value' => 'flipInY',
					'label' => __('flipInY', 'T20')
				),
				array( 
					'value' => 'fadeInDownBig',
					'label' => __('fadeInDownBig', 'T20')
				),
				array( 
					'value' => 'bounceIn',
					'label' => __('bounceIn', 'T20')
				),
				array( 
					'value' => 'rotateIn',
					'label' => __('rotateIn', 'T20')
				),
				array( 
					'value' => 'rollIn',
					'label' => __('rollIn', 'T20')
				),
				array( 
					'value' => 'lightSpeedIn',
					'label' => __('lightSpeedIn', 'T20')
				)
			)
		),
		// General: Favicon
		array(
			'id'		=> 'favicon',
			'label'		=> __('Favicon', 'T20'),
			'desc'		=> __('Upload a 16x16px Png/Gif/ico image that will be your favicon', 'T20'),
			'type'		=> 'upload',
			'section'	=> 'general'
		),
		// General: Apple Touch
		array(
			'id'		=> 'apple-touch',
			'label'		=> __('Apple Touch', 'T20'),
			'desc'		=> __('Upload a 144x144px Png image that will be your icon', 'T20'),
			'type'		=> 'upload',
			'section'	=> 'general'
		),
		// General: RSS Feed
		array(
			'id'		=> 'rss-feed',
			'label'		=> __('FeedBurner URL', 'T20'),
			'desc'		=> __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed e.g. http://feeds.feedburner.com/yoururlhere', 'T20'),
			'type'		=> 'text',
			'section'	=> 'general'
		),
		// General: Meta Description
		array(
			'id'		=> 'meta_desc',
			'label'		=> __('Seo meta site description', 'T20'),
			'type'		=> 'text',
			'section'	=> 'general'
		),
		// General: Meta Keywords
		array(
			'id'		=> 'meta_key',
			'label'		=> __('Seo meta site keywords - ex: modern, photo, news', 'T20'),
			'type'		=> 'text',
			'section'	=> 'general'
		),
		// General: Custom head codes
		array(
			'id'		=> 'custom-codes-head',
			'label'		=> __('Custom Head Codes', 'T20'),
			'desc'		=> __('Add your custom codes or scripts or meta tags, this will add before close head', 'T20'),
			'type'		=> 'textarea-simple',
			'section'		=> 'general',
			'rows'		=> '3'
		),
		// General: Custom Footer codes
		array(
			'id'		=> 'custom-codes-footer',
			'label'		=> __('Custom Footer Codes', 'T20'),
			'desc'		=> __('Add your custom codes, analytics or scripts, this will add before close body', 'T20'),
			'type'		=> 'textarea-simple',
			'section'		=> 'general',
			'rows'		=> '3'
		),
		// General: Custom CSS
		array(
			'id'		=> 'custom-css-head',
			'label'		=> __('Custom CSS', 'T20'),
			'desc'		=> __('add your custom css code here without style tag', 'T20'),
			'type'		=> 'css',
			'section'		=> 'general'
		),
		// Blog: Wp pagenavi
		array(
			'id'		=> 'wp_pagenavi',
			'label'		=> __('WP Pagenavi', 'T20'),
			'desc'		=> __('Adds a more advanced paging navigation to your WordPress blog.', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'blog'
		),
		// Blog: single featured
		array(
			'id'		=> 'single_featured',
			'label'		=> __('Featured Image on Single post', 'T20'),
			'desc'		=> __('If you want also showing featured image top of the post in single post, please set this ON', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'blog'
		),
		// Blog: Post format icons
		array(
			'id'		=> 'post_format_icons',
			'label'		=> __('Post format icons', 'T20'),
			'desc'		=> __('if you dont like post format icons on post image hover, please set this to Off.', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'blog'
		),
		// Blog: Excerpt Length
		array(
			'id'		=> 'excerpt-length',
			'label'		=> __('Excerpt Length', 'T20'),
			'desc'		=> __('Max number of words', 'T20'),
			'std'		=> '34',
			'type'		=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,100,1'
		),
		// Blog: Read More
		array(
			'id'		=> 'read_more_text',
			'label'		=> __('Read More button Text', 'T20'),
			'desc'		=> __('Example: Read More &#187; ', 'T20'),
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Single - Authorbox
		array(
			'id'		=> 'author_box',
			'label'		=> __('Author Box in Single Post', 'T20'),
			'desc'		=> __('Shows post author description, if it exists', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: type
		array(
			'id'		=> 'posts_type',
			'label'		=> __('Default Posts Views', 'T20'),
			'std'		=> '1',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => __('Normal List', 'T20')
				),
				array( 
					'value' => '2',
					'label' => __('Masonry', 'T20')
				)
			)
		),
		// Blog: type col
		array(
			'id'		=> 'posts_type_col',
			'label'		=> __('Masonry Columns', 'T20'),
			'std'		=> 'three_col_mas',
			'type'		=> 'radio',
			'section'		=> 'blog',
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
		// Blog: Thumbs Size
		array(
			'id'		=> 'posts_thumbs',
			'label'		=> __('Posts Featured Images', 'T20'),
			'desc'		=> __('This options will effective on posts list in blog style pages - category page - seach - author - tag and where have posts list and dont effective on masonry view', 'T20'),
			'std'		=> '1',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => __('Big Thumbnails', 'T20')
				),
				array( 
					'value' => '2',
					'label' => __('Medium Thumbnails', 'T20')
				)
			)
		),
		// Blog: Single - Related Posts
		array(
			'id'		=> 'related_posts',
			'label'		=> __('Related Posts', 'T20'),
			'desc'		=> __('Shows randomized related articles below the post in single post', 'T20'),
			'std'		=> 'categories',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => 'none',
					'label' => __('Disable', 'T20')
				),
				array( 
					'value' => 'categories',
					'label' => __('Related by categories', 'T20')
				),
				array( 
					'value' => 'tags',
					'label' => __('Related by tags', 'T20')
				)
			)
		),
		// Blog: Single - Related Posts
		array(
			'id'		=> 'related_posts_num',
			'label'		=> __('Related Posts Limit', 'T20'),
			'desc'		=> __('Max number of posts if has', 'T20'),
			'std'		=> '6',
			'type'		=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '1,30,1'
		),
		// Blog: Single - Share Post
		array(
			'id'		=> 'share_post',
			'label'		=> __('Share Post Buttons', 'T20'),
			'desc'		=> __('Shows social share buttons below the post in single post', 'T20'),
			'std'		=> '2',
			'type'		=> 'radio',
			'section'		=> 'blog',
			'choices'	=> array(
				array( 
					'value' => 'none',
					'label' => __('Disable', 'T20')
				),
				array( 
					'value' => '2',
					'label' => __('Display Share Buttons', 'T20')
				)
			)
		),
		// Blog: Disable Review
		array(
			'id'		=> 'hide_review',
			'label'		=> __('Hide Review', 'T20'),
			'desc'		=> __('if you dont need review system on your site please set it off', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'blog'
		),
		// Header: Custom Logo
		array(
			'id'		=> 'custom-logo',
			'label'		=> __('Custom Logo', 'T20'),
			'desc'		=> __('Upload your custom logo image', 'T20'),
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Header: img
		array(
			'id'		=> 'head_img_above',
			'label'		=> __('Above header image ( width is 1230px )', 'T20'),
			'type'		=> 'upload',
			'section'		=> 'header'
		),
		array(
			'id'		=> 'head_img_above_link',
			'label'		=> __('Above header image link', 'T20'),
			'type'		=> 'text',
			'section'		=> 'header'
		),
		// Header: img
		array(
			'id'		=> 'head_img_below',
			'label'		=> __('Below header image ( width is 1230px )', 'T20'),
			'type'		=> 'upload',
			'section'		=> 'header'
		),
		array(
			'id'		=> 'head_img_below_link',
			'label'		=> __('Below header image link', 'T20'),
			'type'		=> 'text',
			'section'		=> 'header'
		),

		// Header : Style
		array(
			'id'		=> 'head_pos',
			'label'		=> __('Header Style', 'T20'),
			'std'		=> 'head1',
			'type'		=> 'radio-image',
			'section'	=> 'header',
			'choices'	=> array(
				array(
					'value'		=> 'head1',
					'label'		=> __('Header 1', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/head1.png'
				),
				array(
					'value'		=> 'head2',
					'label'		=> __('Header 2', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/head2.png'
				),
				array(
					'value'		=> 'head3',
					'label'		=> __('Header 3', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/head3.png'
				),
				array(
					'value'		=> 'head4',
					'label'		=> __('Header 4', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/head4.png'
				),
				array(
					'value'		=> 'head5',
					'label'		=> __('Header 5', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/head5.png'
				)
			)
		),
		// Header: Ads
		array(
			'id'		=> 'header-ads-img',
			'label'		=> __('Header Ads', 'T20'),
			'desc'		=> __('Upload your ads image or insert your ads image url', 'T20'),
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Header: Ads link
		array(
			'id'		=> 'header-ads-link',
			'label'		=> '',
			'desc'		=> __('Ads link address', 'T20'),
			'std'		=> '',
			'type'		=> 'text',
			'section'		=> 'header'
		),
		// Header: Ads Description
		array(
			'id'		=> 'header-ads-description',
			'label'		=> '',
			'desc'		=> __('Ads Description - will show on mouse hover', 'T20'),
			'type'		=> 'text',
			'section'		=> 'header'
		),
		// Header: Ads Description
		array(
			'id'		=> 'header-ads-code',
			'label'		=> __('Or insert your Ads code', 'T20'),
			'desc'		=> __('Ads script or code', 'T20'),
			'type'		=> 'textarea-simple',
			'section'		=> 'header',
			'rows'		=> '3'
		),
		// Header: News or Sec Menu
		array(
			'id'		=> 'breaking-or-menu',
			'label'		=> __('News Bar', 'T20'),
			'desc'		=> __('Select Breaking News or Second Menu or Empty', 'T20'),
			'type'		=> 'radio',
			'std'		=> '1',
			'section'	=> 'header',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => __('Breaking News', 'T20')
				),
				array( 
					'value' => '2',
					'label' => __('Second Menu Navigation', 'T20')
				),
				array( 
					'value' => '3',
					'label' => __('Empty', 'T20')
				)
			)
		),
		// Header: News Category
		array(
			'id'		=> 'news-category',
			'label'		=> __('Breaking News Category', 'T20'),
			'desc'		=> __('By not selecting a category, it will show your latest post(s) from all categories', 'T20'),
			'type'		=> 'category-checkbox',
			'section'		=> 'header'
		),
		// Header: News Title
		array(
			'id'		=> 'news-category-title',
			'label'		=> __('News Title Badge', 'T20'),
			'desc'		=> __('Example: News Trending', 'T20'),
			'type'		=> 'text',
			'section'		=> 'header'
		),
		// Header: News Number of posts
		array(
			'id'		=> 'news-category-num',
			'label'		=> __('Breaking News Numbers', 'T20'),
			'desc'		=> __('Number of Breaking News to display', 'T20'),
			'std'		=> '10',
			'type'		=> 'numeric-slider',
			'section'		=> 'header',
			'min_max_step'	=> '1,30,1'
		),
		// Header: News Title BG
		array(
			'id'		=> 'news-title-bg',
			'label'		=> __('Breaking News Title Background color', 'T20'),
			'type'		=> 'colorpicker',
			'section'		=> 'header',
			'class'		=> ''
		),
		// Header: News Ticker Speed
		array(
			'id'		=> 'news-speed',
			'label'		=> __('News Ticker Speed', 'T20'),
			'desc'		=> __('Speed of news ticker - default is 7', 'T20'),
			'std'		=> '7',
			'type'		=> 'numeric-slider',
			'section'		=> 'header',
			'min_max_step'	=> '1,9,1'
		),
		// Header: News Time
		array(
			'id'		=> 'news_ago',
			'label'		=> __('Text after time', 'T20'),
			'desc'		=> __('Example: ago ', 'T20'),
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'header'
		),
		// Header: Search
		array(
			'id'		=> 'header-search',
			'label'		=> __('Search Form', 'T20'),
			'desc'		=> __('Search form on header', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Search Tooltip
		array(
			'id'		=> 'header-search-tooltip',
			'label'		=> __('Search Tooltip', 'T20'),
			'desc'		=> __('Tooltip fo search icon', 'T20'),
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'header'
		),
		// Header: Search Placeholder
		array(
			'id'		=> 'header-search-placeholder',
			'label'		=> __('Search Placeholder', 'T20'),
			'desc'		=> __('Set placeholder for search form in header', 'T20'),
			'std'		=> '',
			'type'		=> 'text',
			'section'		=> 'header'
		),
		// Header: Search form Title
		array(
			'id'		=> 'search_title',
			'label'		=> __('Search form Title', 'T20'),
			'desc'		=> __('Set title for search form overlay', 'T20'),
			'type'		=> 'text',
			'section'		=> 'header'
		),
		array(
			'id'		=> 'header-search-tags',
			'label'		=> __('Search Popular Tags', 'T20'),
			'desc'		=> __('Popular tags under Search form on header', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Random Posts
		array(
			'id'		=> 'random-posts',
			'label'		=> __('Random Post Button', 'T20'),
			'desc'		=> __('do you like display random post button in sub header', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Random Posts Title
		array(
			'id'		=> 'random-posts-title',
			'label'		=> __('Random Post Button Title', 'T20'),
			'desc'		=> __('This title showing on button hover', 'T20'),
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'header'
		),
		// Social Links : List
		array(
			'id'		=> 'social-links',
			'label'		=> __('Social icons on header', 'T20'),
			'type'		=> 'list-item',
			'section'		=> 'header',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-icon',
					'label'		=> __('Select Icon', 'T20'),
					'std'		=> 'fa-facebook',
					'type'		=> 'select',
					'choices'	=> array(
						array( 
							'value' => 'fa-home',
							'label' => 'Home'
						),
						array( 
							'value' => 'fa-envelope-o',
							'label' => 'Envelope (Email)'
						),
						array( 
							'value' => 'fa-music',
							'label' => 'Music'
						),
						array( 
							'value' => 'fa-facebook',
							'label' => 'Facebook'
						),
						array( 
							'value' => 'fa-twitter',
							'label' => 'Twitter'
						),
						array( 
							'value' => 'fa-rss',
							'label' => 'Rss Feed'
						),
						array( 
							'value' => 'fa-soundcloud',
							'label' => 'Soundcloud'
						),
						array( 
							'value' => 'fa-spotify',
							'label' => 'Spotify'
						),
						array( 
							'value' => 'fa-star',
							'label' => 'Reverbnation'
						),
						array( 
							'value' => 'fa-dribbble',
							'label' => 'Dribbble'
						),
						array( 
							'value' => 'fa-github',
							'label' => 'Github'
						),
						array( 
							'value' => 'fa-instagram',
							'label' => 'Instagram'
						),
						array( 
							'value' => 'fa-linkedin',
							'label' => 'Linkedin'
						),
						array( 
							'value' => 'fa-pinterest',
							'label' => 'Pinterest'
						),
						array( 
							'value' => 'fa-google-plus',
							'label' => 'Google Plus'
						),
						array( 
							'value' => 'fa-foursquare',
							'label' => 'Foursquare'
						),
						array( 
							'value' => 'fa-skype',
							'label' => 'Skype'
						),
						array( 
							'value' => 'fa-youtube',
							'label' => 'Youtube'
						),
						array( 
							'value' => 'fa-tumblr',
							'label' => 'Tumblr'
						),
						array( 
							'value' => 'fa-flickr',
							'label' => 'Flickr'
						),
						array( 
							'value' => 'fa-vimeo-square',
							'label' => 'Vimeo'
						),
						array( 
							'value' => 'fa-yahoo',
							'label' => 'Yahoo'
						),
						array( 
							'value' => 'fa-weibo',
							'label' => 'Weibo'
						),
						array( 
							'value' => 'fa-behance',
							'label' => 'Behance'
						),
						array( 
							'value' => 'fa-deviantart',
							'label' => 'Deviantart'
						),
						array( 
							'value' => 'fa-digg',
							'label' => 'Digg'
						),
						array( 
							'value' => 'fa-reddit',
							'label' => 'Reddit'
						),
						array( 
							'value' => 'fa-phone',
							'label' => 'Phone'
						)
					)
				),
				array(
					'id'		=> 'social-link',
					'label'		=> __('Link url', 'T20'),
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-target',
					'label'		=> '',
					'std'		=> '',
					'type'		=> 'checkbox',
					'choices'	=> array(
						array( 
							'value' => '_blank',
							'label' => '_blank'
						)
					)
				)
			)
		),
		// MegaMenu
		array(
			'id'		=> 'new_walker',
			'label'		=> __('MegaMenu', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'mega'
		),
		array(
			'id'		=> 'mega_col',
			'label'		=> __('Posts per category megamenu', 'T20'),
			'std'		=> '4',
			'type'		=> 'radio-image',
			'section'		=> 'mega',
			'choices'	=> array(
				array(
					'value'		=> '4',
					'label'		=> '4',
					'src'		=> get_template_directory_uri() . '/admin/assets/images/4col.png'
				),
				array(
					'value'		=> '5',
					'label'		=> '5',
					'src'		=> get_template_directory_uri() . '/admin/assets/images/5col.png'
				),
				array(
					'value'		=> '6',
					'label'		=> '6',
					'src'		=> get_template_directory_uri() . '/admin/assets/images/6col.png'
				)
			)
		),
		array(
			'id'		=> 'sticky',
			'label'		=> __('Sticky Navigation', 'T20'),
			'desc'		=> __('Just working on primary navigation', 'T20'),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'		=> 'mega'
		),
		// Layout: Responsive Layout
		array(
			'id'		=> 'responsive',
			'label'		=> __('Responsive Layout', 'T20'),
			'desc'		=> __('Mobile and tablet optimizations [ <strong>responsive.css</strong> ]', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'layout'
		),
		// Layout: Layout
		array(
			'id'		=> 'full-boxed',
			'label'		=> __('Fullwide or Boxed', 'T20'),
			'desc'		=> __('This option is effective on all pages', 'T20'),
			'type'		=> 'radio',
			'std'		=> '3',
			'section'		=> 'layout',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => __('Fullwide', 'T20')
				),
				array( 
					'value' => '2',
					'label' => __('Boxed', 'T20')
				),
				array( 
					'value' => '3',
					'label' => __('Boxed with margin', 'T20')
				)
			)
		),
		// Layout : Global
		array(
			'id'		=> 'layout-global',
			'label'		=> __('Global Layout', 'T20'),
			'desc'		=> __('This option will set on all pages and posts, also you can create different layout with pagebuilder for any page you like.', 'T20'),
			'std'		=> 'both-sidebar-right',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'without-sidebar',
					'label'		=> __('Without Sidebar', 'T20'),
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
		// Layout : Layout Footer
		array(
			'id'		=> 'footer-widgets',
			'label'		=> __('Footer Widget Columns', 'T20'),
			'desc'		=> __('Select columns to enable footer widgets', 'T20'),
			'std'		=> '4',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> __('Disable', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/layout-off.png'
				),
				array(
					'value'		=> '1',
					'label'		=> __('1 Column', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-1.png'
				),
				array(
					'value'		=> '2',
					'label'		=> __('2 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-2.png'
				),
				array(
					'value'		=> '3',
					'label'		=> __('3 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-3.png'
				),
				array(
					'value'		=> '4',
					'label'		=> __('4 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-4.png'
				)
			)
		),
		// Layout : Layout Footer
		array(
			'id'		=> 'footer-widgets-2',
			'label'		=> __('Footer Widget Columns 2nd Row', 'T20'),
			'std'		=> '0',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> __('Disable', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/layout-off.png'
				),
				array(
					'value'		=> '1',
					'label'		=> __('1 Column', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-1.png'
				),
				array(
					'value'		=> '2',
					'label'		=> __('2 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-2.png'
				),
				array(
					'value'		=> '3',
					'label'		=> __('3 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-3.png'
				),
				array(
					'value'		=> '4',
					'label'		=> __('4 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-4.png'
				),
				array(
					'value'		=> '5',
					'label'		=> __('5 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-5.png'
				),
				array(
					'value'		=> '6',
					'label'		=> __('6 Columns', 'T20'),
					'src'		=> get_template_directory_uri() . '/admin/assets/images/footer-widgets-6.png'
				)
			)
		),
		// Layout: Subfooter
		array(
			'id'		=> 'subfooter',
			'label'		=> __('Subfooter', 'T20'),
			'desc'		=> __('Do you like display Subfooter?', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'layout'
		),
		// Layout: Copyright Text
		array(
			'id'		=> 'copyright',
			'label'		=> __('Copyright Text', 'T20'),
			'desc'		=> __('Set copyright text for subfooter like: Copyright 2014 by Theme20. All Rights Reserved. Powered by Wordpress', 'T20'),
			'std'		=> '',
			'type'		=> 'text',
			'section'		=> 'layout'
		),
		// bbpress
		array(
			'id'		=> 'layout-bbp',
			'label'		=> __('bbpress Layout', 'T20'),
			'desc'		=> __('This option will set on all pages of bbpress forums', 'T20'),
			'std'		=> 'sidebar-right',
			'type'		=> 'radio-image',
			'section'	=> 'bbpress',
			'choices'	=> array(
				array(
					'value'		=> 'without-sidebar',
					'label'		=> __('Without Sidebar', 'T20'),
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
			'label'		=> 'bbpress Primary Sidebar',
			'id'		=> 'bbp_primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'bbpress',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'bbpress Secondary Sidebar',
			'id'		=> 'bbp_secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'bbpress',
			'desc'		=> 'Overrides default'
		),
		// buddypress 
		array(
			'id'		=> 'layout-bp',
			'label'		=> __('Buddypress Layout', 'T20'),
			'desc'		=> __('This option will set on all original pages of buddypress', 'T20'),
			'std'		=> 'sidebar-right',
			'type'		=> 'radio-image',
			'section'	=> 'bp',
			'choices'	=> array(
				array(
					'value'		=> 'without-sidebar',
					'label'		=> __('Without Sidebar', 'T20'),
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
			'label'		=> 'Buddypress Primary Sidebar',
			'id'		=> 'bp_primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'bp',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'Buddypress Secondary Sidebar',
			'id'		=> 'bp_secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'bp',
			'desc'		=> 'Overrides default'
		),
		// DWQA : Global
		array(
			'id'		=> 'layout-dwqa',
			'label'		=> __('DWQA Layout', 'T20'),
			'desc'		=> __('This option will set on all dwqa pages.', 'T20'),
			'std'		=> 'sidebar-right',
			'type'		=> 'radio-image',
			'section'	=> 'dwqa',
			'choices'	=> array(
				array(
					'value'		=> 'without-sidebar',
					'label'		=> __('Without Sidebar', 'T20'),
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
			'label'		=> 'DWQA Primary Sidebar',
			'id'		=> 'dwqa_primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'dwqa',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'DWQA Secondary Sidebar',
			'id'		=> 'dwqa_secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'dwqa',
			'desc'		=> 'Overrides default'
		),
		// Sidebars: Create Areas
		array(
			'id'		=> 'sidebar-areas',
			'label'		=> __('Create Unlimited Sidebars', 'T20'),
			'desc'		=> __('You must save changes for the new areas to appear below. <br /><i>Warning: Make sure each area has a unique ID.</i>', 'T20'),
			'type'		=> 'list-item',
			'section'	=> 'sidebar',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'id',
					'label'		=> __('Sidebar ID', 'T20'),
					'desc'		=> __('This ID must be unique, for example "sidebar-about"', 'T20'),
					'std'		=> 'sidebar-',
					'type'		=> 'text',
					'choices'	=> array()
				)
			)
		),
		// Styling: Dark Version
		array(
			'id'		=> 'dark',
			'label'		=> __('Dark Version', 'T20'),
			'desc'		=> __('-', 'T20'),
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Enable
		array(
			'id'		=> 'dynamic-styles',
			'label'		=> __('Dynamic Styles', 'T20'),
			'desc'		=> __('Turn on to use the styling options below', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Font
		array(
			'id'		=> 'font_name_body',
			'label'		=> __('Body Font', 'T20'),
			'desc'		=> __('Just paste your google font name example: Raleway you can see all fonts here https://www.google.com/fonts', 'T20'),
			'type'		=> 'text',
			'section'	=> 'styling',
		),
		array(
			'id'		=> 'font_name_navigation',
			'label'		=> __('Menu Navigation Font', 'T20'),
			'desc'		=> __('Just paste your google font name example: Raleway you can see all fonts here https://www.google.com/fonts', 'T20'),
			'type'		=> 'text',
			'section'	=> 'styling',
		),
		array(
			'id'		=> 'font_name_headlines',
			'label'		=> __('H1 to H6 Font', 'T20'),
			'desc'		=> __('Just paste your google font name example: Raleway you can see all fonts here https://www.google.com/fonts', 'T20'),
			'type'		=> 'text',
			'section'		=> 'styling',
		),
		// Styling: Primary Color
		array(
			'id'		=> 'theme_color',
			'label'		=> __('Theme Color Scheme', 'T20'),
			'type'		=> 'colorpicker',
			'section'		=> 'styling',
			'class'		=> ''
		),
		// Styling: Blocks Border Color
		array(
			'id'		=> 'blocks_color',
			'label'		=> __('Top Border Color of Blocks', 'T20'),
			'type'		=> 'colorpicker',
			'section'		=> 'styling',
			'class'		=> ''
		),
		// Styling: Widgets Border Color
		array(
			'id'		=> 'widgets_color',
			'label'		=> __('Top Border Color of Widgets', 'T20'),
			'type'		=> 'colorpicker',
			'section'		=> 'styling',
			'class'		=> ''
		),
		// Styling: Navigation Hover
		array(
			'id'		=> 'nav_hover',
			'label'		=> __('Navigation Hover/Active Style', 'T20'),
			'desc'		=> __('This option is effective on parent links in navigation when it is active or hover', 'T20'),
			'type'		=> 'radio',
			'std'		=> '1',
			'section'		=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => __('Hover with border', 'T20')
				),
				array( 
					'value' => '2',
					'label' => __('Hover without border', 'T20')
				),
				array( 
					'value' => '3',
					'label' => __('Hover with background', 'T20')
				)
			)
		),
		array(
			'id'		=> 'nav_radius',
			'label'		=> __('Navigation Border Radius', 'T20'),
			'desc'		=> __('Default is 20', 'T20'),
			'std'		=> '20',
			'type'		=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '0,20,1'
		),
		// Styling: Body Background
		array(
			'id'		=> 'body_bg',
			'label'		=> __('Body Background', 'T20'),
			'type'		=> 'background',
			'section'		=> 'styling'
		),
		// Styling: Blocks Pattern
		array(
			'id'		=> 'blocks-pattern',
			'label'		=> __('Blocks and Widgets Title Pattern', 'T20'),
			'desc'		=> __('This pattern will added after title with repeat', 'T20'),
			'type'		=> 'upload',
			'section'	=> 'styling'
		),
		// Styling: Blocks Pattern
		array(
			'id'		=> 'blocks-pattern-footer',
			'label'		=> __('Blocks and Widgets Title Pattern on Footer', 'T20'),
			'desc'		=> __('This pattern will added after title with repeat for blocks and widgets in footer', 'T20'),
			'type'		=> 'upload',
			'section'	=> 'styling'
		),
		array(
			'id'		=> 'blocks_shadow',
			'label'		=> __('Shadows of blocks and widgets - <a target="_blank" href="//www.w3schools.com/cssref/css3_pr_box-shadow.asp"> About css shadow </a>', 'T20'),
			'std'		=> '0 0 13px rgba(0, 0, 0, 0.1)',
			'type'		=> 'text',
			'section'		=> 'styling'
		),
		// Styling: Post format Hover
		array(
			'id'		=> 'featured_thumb_color',
			'label'		=> __('Featured image post hover background color', 'T20'),
			'type'		=> 'colorpicker',
			'section'		=> 'styling',
			'class'		=> ''
		),
		// Styling: Tooltip Tipsy
		array(
			'id'		=> 'tipsy',
			'label'		=> __('Tooltip Tipsy color', 'T20'),
			'type'		=> 'colorpicker',
			'section'		=> 'styling',
			'class'		=> ''
		),
		// Styling: Back To Top
		array(
			'id'		=> 'totop',
			'label'		=> __('Back To Top Button', 'T20'),
			'desc'		=> __('Display Back To Top Button', 'T20'),
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'		=> 'styling'
		),
		// Translation
		array(
			'id'		=> 'error_tr',
			'label'		=> __('Translation Important Strings', 'T20'),
			'desc'		=> __(' Important Note:  This options just is a little part of theme translation. For full control on all strings for translation you should using .po file with PoEdit software or WPML string translation plugin.', 'T20'),
			'std'		=> __('Error 404 !', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'error_title_tr',
			'label'		=> '',
			'desc'		=> __('Error page title', 'T20'),
			'std'		=> __('Page not found!', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'error_info_tr',
			'label'		=> '',
			'desc'		=> __('404 Error page full message', 'T20'),
			'std'		=> __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'archive_tr',
			'label'		=> '',
			'desc'		=> __('Posts page error message', 'T20'),
			'std'		=> __('No posts - Sorry', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'search_tr',
			'label'		=> '',
			'desc'		=> __('Search page details message', 'T20'),
			'std'		=> __('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'archive_latest_tr',
			'label'		=> '',
			'desc'		=> __('Archive page latest posts title', 'T20'),
			'std'		=> __('Latest Posts', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'archive_tags_tr',
			'label'		=> '',
			'desc'		=> __('Archive page popular tags title', 'T20'),
			'std'		=> __('Popular Tags', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'archive_cats_tr',
			'label'		=> '',
			'desc'		=> __('Archive page categories title', 'T20'),
			'std'		=> __('Categories', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'archive_month_tr',
			'label'		=> '',
			'desc'		=> __('Archive page monthly archives title', 'T20'),
			'std'		=> __('Monthly Archives', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'archive_pages_tr',
			'label'		=> '',
			'desc'		=> __('Archive page pages title', 'T20'),
			'std'		=> __('Pages', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'search_btn_tr',
			'label'		=> '',
			'desc'		=> __('Search Button', 'T20'),
			'std'		=> __('Search', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'search_page_title_tr',
			'label'		=> '',
			'desc'		=> __('Search page title', 'T20'),
			'std'		=> __('Search results for:', 'T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'nav_newer_tr',
			'label'		=> '',
			'desc'		=> __('Default wp navigation newer posts title', 'T20'),
			'std'		=> __('&raquo; Newer Posts','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'nav_older_tr',
			'label'		=> '',
			'desc'		=> __('Default wp navigation older posts title', 'T20'),
			'std'		=> __('&laquo; Older Posts','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'nav_page_tr',
			'label'		=> '',
			'desc'		=> __('Pages Navigation. Just change Page and of', 'T20'),
			'std'		=> __('Page','T20').' %CURRENT_PAGE% ' .__('of','T20').' %TOTAL_PAGES%',
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'nav_first_tr',
			'label'		=> '',
			'desc'		=> __('Pages nav first', 'T20'),
			'std'		=> __('&laquo; First','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'nav_last_tr',
			'label'		=> '',
			'desc'		=> __('Pages nav last', 'T20'),
			'std'		=> __('Last &raquo;','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'prev_post_tr',
			'label'		=> '',
			'desc'		=> __('Single previous post', 'T20'),
			'std'		=> __('Previous','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'next_post_tr',
			'label'		=> '',
			'desc'		=> __('Single next post', 'T20'),
			'std'		=> __('Next','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'tags_post_tr',
			'label'		=> '',
			'desc'		=> __('Single post tags', 'T20'),
			'std'		=> __('Tags','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'pages_post_tr',
			'label'		=> '',
			'desc'		=> __('Single post more pages', 'T20'),
			'std'		=> __('Pages:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'author_post_tr',
			'label'		=> '',
			'desc'		=> __('Single post about author title', 'T20'),
			'std'		=> __('About:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'related_post_tr',
			'label'		=> '',
			'desc'		=> __('Single post related title', 'T20'),
			'std'		=> __('You may also like...','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'author_posts_tr',
			'label'		=> '',
			'desc'		=> __('Author posts page title', 'T20'),
			'std'		=> __('Posts by:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'cat_page_title_tr',
			'label'		=> '',
			'desc'		=> __('Categories page title', 'T20'),
			'std'		=> __('All posts under:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'tag_page_title_tr',
			'label'		=> '',
			'desc'		=> __('Tag page title', 'T20'),
			'std'		=> __('Tagged:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'daily_page_title_tr',
			'label'		=> '',
			'desc'		=> __('Archive by day page title', 'T20'),
			'std'		=> __('Daily Archive:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'monthly_page_title_tr',
			'label'		=> '',
			'desc'		=> __('Archive by month page title', 'T20'),
			'std'		=> __('Monthly Archive:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'yearly_page_title_tr',
			'label'		=> '',
			'desc'		=> __('Archive by year page title', 'T20'),
			'std'		=> __('Yearly Archive:','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'cm_one_tr',
			'label'		=> '',
			'desc'		=> __('Comments - One thought on', 'T20'),
			'std'		=> __('One thought on','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'cm_two_tr',
			'label'		=> '',
			'desc'		=> __('Comments - thoughts on', 'T20'),
			'std'		=> __('thoughts on','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'cm_closed_tr',
			'label'		=> '',
			'desc'		=> __('Comments - closed message', 'T20'),
			'std'		=> __(' Sorry - Comments are closed','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'tab_recent',
			'label'		=> __('Tabs Widget Strings', 'T20'),
			'desc'		=> __('Recent Posts Title', 'T20'),
			'std'		=> __('Recent Posts','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'tab_pop',
			'label'		=> '',
			'desc'		=> __('Popular Posts Title', 'T20'),
			'std'		=> __('Popular Posts','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'tab_cm',
			'label'		=> '',
			'desc'		=> __('Recent Comments Title', 'T20'),
			'std'		=> __('Recent Comments','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		array(
			'id'		=> 'tab_tags',
			'label'		=> '',
			'desc'		=> __('Tags Title', 'T20'),
			'std'		=> __('Tags','T20'),
			'type'		=> 'text',
			'section'		=> 'translation'
		),
		// woocommerce : Layout
		array(
			'id'		=> 'layout-woo',
			'label'		=> __('Woocommerce default layout', 'T20'),
			'desc'		=> __('This option will set on default woocommerce shop pages and not all. other pages you can set from edit Pages', 'T20'),
			'std'		=> 'sidebar-right',
			'type'		=> 'radio-image',
			'section'		=> 'woocommerce',
			'choices'	=> array(
				array(
					'value'		=> 'without-sidebar',
					'label'		=> __('Without Sidebar', 'T20'),
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
			'id'		=> '_woo_primary',
			'type'		=> 'sidebar-select',
			'section'		=> 'woocommerce'
		),
		array(
			'label'		=> __('Secondary Sidebar', 'T20'),
			'id'		=> '_woo_secondary',
			'type'		=> 'sidebar-select',
			'section'		=> 'woocommerce'
		)
	)
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	} 
}
