<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/

function ts_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 , $step = 1) {
	if($all) {
		$numbers['-1'] = 'All';
	}

	if($default) {
		$numbers[''] = 'Default';
	}
	
	if($step == '.01') {
        $numbers[] = '0.00';
	}

	foreach(range($range_start, $range) as $number) {
        $number = ($step == '.01') ? number_format($number / 100, 2) : $number;
		$numbers[$number] = $number;
	}

	return ($step == '.01') ? array_reverse($numbers) : $numbers;
}

// Menus
function ts_shortcodes_menu_options() {
    $menus = wp_get_nav_menus();
    
    $menu_array = array('' => __('Choose a menu...', 'ThemeStockyard'));
    
    foreach ($menus as $menu) {
        $menu_array[$menu->term_id] = $menu->name;
    }
    
    return $menu_array;
}

// Taxonomies
function ts_shortcodes_categories ( $taxonomy = 'category', $empty_choice = false ) {
	if($empty_choice == true) {
		$post_categories[''] = 'Default';
	}

	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

	if( ! array_key_exists('errors', $get_categories) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
                $post_categories[$cat->term_id] = $cat->name;
			}
		}

		if(isset($post_categories)) {
			return $post_categories;
		}
	}
}

// Color Options
function ts_color_options($default = true) {
    $color_options = array(
        'faded_rose'    => __('Faded Rose','ThemeStockyard'), 
        'coral'         => __('Coral','ThemeStockyard'), 
        'peach'         => __('Peach','ThemeStockyard'),
        'purple'        => __('Purple','ThemeStockyard'),
        'navy'          => __('Navy','ThemeStockyard'),
        'blue'          => __('Blue','ThemeStockyard'), 
        'teal'          => __('Teal', 'ThemeStockyard'),
        'sea_green'     => __('Sea Green','ThemeStockyard'), 
        'sage'          => __('Sage','ThemeStockyard'), 
        'green'         => __('Green', 'ThemeStockyard'), 
        'yellow'        => __('Mustard Yellow','ThemeStockyard'), 
        'orange'        => __('Orange','ThemeStockyard'), 
        'brown'         => __('Brown','ThemeStockyard'), 
        'gold'          => __('Gold','ThemeStockyard'),
        'gray'          => __('Gray','ThemeStockyard'),
        'dark'          => __('Dark Gray','ThemeStockyard'),
        'black'         => __('Black','ThemeStockyard'),
        'white'         => __('White','ThemeStockyard')
    );
    
    if($default) {
        $color_options = array_merge(array('' => __('Default', 'ThemeStockyard')), $color_options);
    }
    
    return $color_options;
}
$align_options = array(
    '' => __('Default', 'ThemeStockyard'),
    'left' => __('Left','ThemeStockyard'),
    'center' => __('Center','ThemeStockyard'),
    'right' => __('Right','ThemeStockyard')
);
$choices = array('yes' => 'Yes', 'no' => 'No');
$choices_plus_default = array(
    ''=>__('Use default (from Theme Options)','ThemeStockyard'), 
    'yes' => 'Yes', 
    'no' => 'No'
);
$reverse_choices = $alt_choices = array('no' => 'No', 'yes' => 'Yes');


$bool_choices = array('1' => 'Yes', '0' => 'No');
$reverse_bool_choices = $alt_bool_choices = array('0' => 'No', '1' => 'Yes');

$decimals = array(
    '0.1' => '0.1', 
    '0.2' => '0.2', 
    '0.3' => '0.3', 
    '0.4' => '0.4', 
    '0.5' => '0.5', 
    '0.6' => '0.6', 
    '0.7' => '0.7', 
    '0.8' => '0.8', 
    '0.9' => '0.9', 
    '1' => '1' 
);

// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = get_template_directory().'/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) 
{
	//$subject = file_get_contents($fontawesome_path);
    $fontawesome_path = get_template_directory_uri().'/css/font-awesome.css';
	$subject =   wp_remote_get($fontawesome_path);
    // Get the body of the response
    $subject = wp_remote_retrieve_body( $subject );
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match)
{
	$icons[$match[1]] = $match[2];
}

$checklist_icons = array ( 
    'fa-check'        => '\f00c', 
    'fa-star'         => '\f006', 
    'fa-angle-right'  => '\f105', 
    'fa-asterisk'     => '\f069', 
    'fa-remove'       => '\f00d', 
    'fa-plus'         => '\f067' 
);

$icons = (count($icons) < 1) ? $checklist_icons : $icons;

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/

$current_user = wp_get_current_user();

$ts_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(
        'hello' => array(
            'type' => 'info',
            'std' => sprintf(__('Hi there, %s! <br/><br/>To get started, choose a shortcode from the drop-down list above.', 'ThemeStockyard'), $current_user->display_name)
        )
	),
	'shortcode' => '',
	'popup_title' => ''
);

/*-----------------------------------------------------------------------------------*/
/*	Accordion
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['accordion'] = array(
	'params' => array(

		'open_icon' => array(
			'type' => 'iconpicker',
			'label' => __('Open Icon', 'ThemeStockyard'),
			'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
			'options' => $icons,
			'std' => '',
		),
		'closed_icon' => array(
			'type' => 'iconpicker',
			'label' => __('Closed Icon', 'ThemeStockyard'),
			'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
			'options' => $icons,
			'std' => '',
		),
	),
	'no_preview' => true,
	'shortcode' => '[accordion open_icon="{{open_icon}}" closed_icon="{{closed_icon}}"]{{child_shortcode}}[/accordion]',
	'popup_title' => __('Insert Accordion Shortcode', 'ThemeStockyard'),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'ThemeStockyard'),
				'type' => 'text',
				'label' => __('Toggle Title', 'ThemeStockyard'),
				'desc' => __('Title of the toggle', 'ThemeStockyard'),
			),
			'content' => array(
				'std' => __('Toggle Content', 'ThemeStockyard'),
				'type' => 'textarea',
				'label' => __('Toggle Content', 'ThemeStockyard'),
				'desc' => __('Add the accordion toggle content', 'ThemeStockyard')
			),
			'open' => array(
				'std' => 'no',
				'type' => 'select',
				'label' => __('Initially Open?', 'ThemeStockyard'),
				'options' => $alt_choices,
			)
		),
		'shortcode' => '[toggle title="{{title}}" open="{{open}}"]{{content}}[/toggle]',
		'clone_button' => __('Add Toggle Option', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Alert Type', 'ThemeStockyard'),
			'desc' => __( 'Select the type of alert message', 'ThemeStockyard'),
			'options' => array(
				'general' => __('General', 'ThemeStockyard'),
				'error' => __('Error', 'ThemeStockyard'),
				'success' => __('Success', 'ThemeStockyard'),
				'notice' => __('Notice', 'ThemeStockyard'),
			)
		),
		'content' => array(
			'std' => __('Text Goes Here', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'ThemeStockyard'),
			'desc' => __( 'Insert the alert text', 'ThemeStockyard'),
			'use_selection' => true
		)
	),
	'shortcode' => '[alert type="{{type}}"]{{content}}[/alert]',
	'popup_title' => __( 'Alert Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Blockquote Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['blockquote'] = array(
	'no_preview' => true,
	'params' => array(

		'content' => array(
			'std' => __('Text Goes Here', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Blockquote Content', 'ThemeStockyard'),
			'use_selection' => true
		),
		'attributed_to' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'ThemeStockyard'),
			'desc' => __('Example: Ernest Hemingway', 'ThemeStockyard')
		),
		'atrributed_to_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('&#8220;Attributed To&#8221; URL', 'ThemeStockyard'),
			'desc' => __('http://example.com', 'ThemeStockyard')
		),
		'align' => array(
			'type' => 'select',
			'label' => __( 'Align Text', 'ThemeStockyard'),
			//'desc' => __( 'Select the type of alert message', 'ThemeStockyard'),
			'options' => array(
				'left' => __('Left', 'ThemeStockyard'),
				'right' => __('Right', 'ThemeStockyard'),
			),
			'std' => 'left'
		),
		'pull' => array(
			'type' => 'select',
			'label' => __( 'Pull Direction', 'ThemeStockyard'),
			//'desc' => __( 'Select the type of alert message', 'ThemeStockyard'),
			'options' => array(
				'' => __('[none]', 'ThemeStockyard'),
				'left' => __('Left', 'ThemeStockyard'),
				'right' => __('Right', 'ThemeStockyard'),
			)
		),
	),
	'shortcode' => '[blockquote pull="{{pull}}" align="{{align}}" attributed_to="{{attributed_to}}" attributed_to_url="{{attributed_to_url}}"]{{content}}[/blockquote]',
	'popup_title' => __( 'Blockquote Shortcode', 'ThemeStockyard')
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['blog'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Blog Layout', 'ThemeStockyard'),
			'desc' => __( 'Select the layout for the blog shortcode', 'ThemeStockyard'),
			'options' => array(
				'' => __('Default', 'ThemeStockyard'),
				'classic' => __('Classic', 'ThemeStockyard'),
				'2-column-grid' => __('2 Column Grid', 'ThemeStockyard'),
				'3-column-grid' => __('3 Column Grid', 'ThemeStockyard'),
				'4-column-grid' => __('4 Column Grid', 'ThemeStockyard'),
                'masonry' => __('Masonry', 'ThemeStockyard'),
                //'masonry-cards' => __('Masonry Cards', 'ThemeStockyard'),
				'list' => __('List', 'ThemeStockyard'),
			)
		),
		'posts_per_page' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'ThemeStockyard'),
			'desc' => __( 'Select number of posts per page', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 30, true, true ),
			'std' => 10
		),
		'show_pagination' => array(
			'type' => 'select',
			'label' => __( 'Show Pagination?', 'ThemeStockyard'),
			'desc' => __('Not recommended for pages that have more than one instance of a blog shortcode', 'ThemeStockyard'),
			'options' => $reverse_choices,
			'std' => 'no'
		),
		'infinite_scroll' => array(
			'type' => 'select',
			'label' => __( 'Turn on Infinite Scrolling?', 'ThemeStockyard'),
			'desc' => __('Set to &#8220;Yes&#8221; to automatically hide pagination and load more posts via ajax when scrolling the page', 'ThemeStockyard'),
			'options' => array(
                'no' => __('No', 'ThemeStockyard'),
                'yes' => __('Yes (load more on scroll)', 'ThemeStockyard'),
                'yes_button' => __('Yes (load more on button click)', 'ThemeStockyard')
			),
			'std' => 'no'
		),
		'infinite_scroll_button_text' => array(
			'type' => 'text',
			'label' => __( 'Infinite Scrolling button text', 'ThemeStockyard'),
			'desc' => __('Only works if the previous setting is "Yes (load more on button click)".', 'ThemeStockyard'),
			'std' => 'Load more posts'
		),/*
		'infinite_scroll_button_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Infinite Scrolling button color', 'ThemeStockyard'),
			'desc' => __('Only works if "Turn on Infinite Scrolling?" is set to "Yes (load more on button click)".', 'ThemeStockyard'),
			'std' => '',
			'options' => ts_color_options()
		),
		'show_author_avatar' => array(
			'type' => 'select',
			'label' => __( 'Show Author Avatar(s)?', 'ThemeStockyard'),
			//'desc' => __('Author avatars will be shown ', 'ThemeStockyard'),
			'options' => $choices_plus_default,
			'std' => ''
		),
		'show_sharing_options' => array(
			'type' => 'select',
			'label' => __( 'Show Sharing Options', 'ThemeStockyard'),
			'desc' => __('Show quick sharing options (e.g. Facebook, Twitter, etc) under each post. <strong>Note:</strong> does not work with "Cards" layout.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),*/
		'cat' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'ThemeStockyard'),
			'desc' => __( 'Select a category or leave blank for all', 'ThemeStockyard'),
			'options' => ts_shortcodes_categories( 'category' )
		),
		'include' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to include...', 'ThemeStockyard'),
			'desc' =>  __( 'Display only certain posts by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to <em>exclude</em>...', 'ThemeStockyard'),
			'desc' =>  __( 'Prevent certain posts from displaying by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude_previous_posts' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude previous posts?', 'ThemeStockyard'),
			'desc' => __('This option can prevent posts from the slider or other instances of blog shortcodes from appearing.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'exclude_these_later' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude these posts later?', 'ThemeStockyard'),
			'desc' => __('This option can prevent *these* posts from appearing in other instances of blog shortcodes.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'title_size' => array(
			'type' => 'text',
			'label' => __('Title Size', 'ThemeStockyard'),
			'desc' => __('Examples: H1, H2, H3, H4, H5, H6... or enter any font size (ex: 16px). Leave blank for default.', 'ThemeStockyard')
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Align Text', 'ThemeStockyard'),
			'options' => $align_options,
			'std' => ''
		),
		'excerpt_length' => array(
			'type' => 'text',
			'label' => __( 'Excerpt Length (leave blank for default)', 'ThemeStockyard'),
			'desc' =>  __( 'Maximum number of characters to show in the excerpt. Example: 100', 'ThemeStockyard'),
		),/*
		'show_title' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Title?', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),*/
		'show_category' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Category?', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'show_media' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Media?', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'show_excerpt' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Excerpt?', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'show_meta' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Meta? (category, author, etc)', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'show_read_more' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show &#8220;Read More&#8221; text?', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'image_orientation' => array(
			'type' => 'select',
			'label' => __( 'Image Orientation?', 'ThemeStockyard'),
			'desc' => __('Only useful with "2 Column Grid", "3 Column Grid", "4 Column Grid", and "List" layouts.', 'ThemeStockyard'),
			'options' => array(
                '' => __('Use default', 'ThemeStockyard'),
                '3:2' => __('3:2 (landscape)', 'ThemeStockyard'),
                '16:9' => __('16:9 (landscape)', 'ThemeStockyard'),
                '16:10' => __('16:10 (landscape)', 'ThemeStockyard'),
                '2:3' => __('2:3 (portrait)', 'ThemeStockyard'),
                '9:16' => __('16:9 (portrait)', 'ThemeStockyard'),
                '10:16' => __('16:10 (portrait)', 'ThemeStockyard'),
                '1:1' => __('1:1 (square)', 'ThemeStockyard')
			),
			'std' => ''
		),
		'allow_videos' => array(
			'type' => 'radio_inline',
			'label' => __( 'Allow Videos?', 'ThemeStockyard'),
			'desc' => __('If set to &#8220;No&#8221, only featured images will be shown. (Videos are not compatible with "2", "3", and "4 Column Grid" layouts)', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'allow_galleries' => array(
			'type' => 'radio_inline',
			'label' => __( 'Allow Galleries?', 'ThemeStockyard'),
			'desc' => __('If set to &#8220;No&#8221, only featured images (but not galleries) will be shown.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),/*
		'within_mega_menu' => array(
			'type' => 'radio_inline',
			'label' => __( 'Within Mega Menu?', 'ThemeStockyard'),
			'desc' => __('If this shortcode is being within a Mega Menu, choose yes for better formatting.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'no'
		),*/
		'ignore_sticky_posts' => array(
            'type' => 'select',
            'label' => __('Ignore Sticky Posts?', 'ThemeStockyard'),
            'options' => $reverse_bool_choices
		)
	),
	'shortcode' => '[blog layout="{{layout}}" limit="{{posts_per_page}}" infinite_scroll="{{infinite_scroll}}" infinite_scroll_button_text="{{infinite_scroll_button_text}}" cat="{{cat}}" include="{{include}}" exclude="{{exclude}}" exclude_previous_posts="{{exclude_previous_posts}}" exclude_these_later="{{exclude_these_later}}" excerpt_length="{{excerpt_length}}" title_size="{{title_size}}" text_align="{{text_align}}" show_pagination="{{show_pagination}}" show_category="{{show_category}}" show_media="{{show_media}}" show_excerpt="{{show_excerpt}}" show_meta="{{show_meta}}" show_read_more="{{show_read_more}}" image_orientation="{{image_orientation}}" allow_videos="{{allow_videos}}" allow_galleries="{{allow_galleries}}" ignore_sticky_posts="{{ignore_sticky_posts}}"][/blog]',
	'popup_title' => __( 'Blog Shortcode', 'ThemeStockyard')
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Banner Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['blog_banner'] = array(
	'no_preview' => true,
	'params' => array(
        
        'columns' => array(
            'type' => 'select',
			'label' => __( 'Columns', 'ThemeStockyard'),
			'desc' => __( 'Select the column number', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 2, false, false ),
			'std' => 2
        ),
		'posts_per_page' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'ThemeStockyard'),
			'desc' => __( 'Select number of posts per page', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 20, true, true ),
			'std' => 2
		),
		'fullwidth' => array(
            'type' => 'select',
			'label' => __( 'Fullwidth?', 'ThemeStockyard'),
			'desc' => __( 'Only works when no sidebar is present', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
        ),
		'show_pagination' => array(
			'type' => 'select',
			'label' => __( 'Show Pagination?', 'ThemeStockyard'),
			'desc' => __('Not recommended for pages that have more than one instance of a blog shortcode', 'ThemeStockyard'),
			'options' => $reverse_choices,
			'std' => 'no'
		),
		'infinite_scroll' => array(
			'type' => 'select',
			'label' => __( 'Turn on Infinite Scrolling?', 'ThemeStockyard'),
			'desc' => __('Set to &#8220;Yes&#8221; to automatically hide pagination and load more posts via ajax when scrolling the page', 'ThemeStockyard'),
			'options' => array(
                'no' => __('No', 'ThemeStockyard'),
                'yes' => __('Yes (load more on scroll)', 'ThemeStockyard'),
                'yes_button' => __('Yes (load more on button click)', 'ThemeStockyard')
			),
			'std' => 'no'
		),
		'infinite_scroll_button_text' => array(
			'type' => 'text',
			'label' => __( 'Infinite Scrolling button text', 'ThemeStockyard'),
			'desc' => __('Only works if the previous setting is "Yes (load more on button click)".', 'ThemeStockyard'),
			'std' => 'Load more posts'
		),
		'cat' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'ThemeStockyard'),
			'desc' => __( 'Select a category or leave blank for all', 'ThemeStockyard'),
			'options' => ts_shortcodes_categories( 'category' )
		),
		'include' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to include...', 'ThemeStockyard'),
			'desc' =>  __( 'Display only certain posts by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to <em>exclude</em>...', 'ThemeStockyard'),
			'desc' =>  __( 'Prevent certain posts from displaying by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude_previous_posts' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude previous posts?', 'ThemeStockyard'),
			'desc' => __('This option can prevent posts from the slider or other instances of blog shortcodes from appearing.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'exclude_these_later' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude these posts later?', 'ThemeStockyard'),
			'desc' => __('This option can prevent *these* posts from appearing in other instances of blog shortcodes.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		/*
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Align Text', 'ThemeStockyard'),
			'options' => $align_options,
			'std' => ''
		),
		*/
		'excerpt_length' => array(
			'type' => 'text',
			'label' => __( 'Excerpt Length (leave blank for default)', 'ThemeStockyard'),
			'desc' =>  __( 'Maximum number of characters to show in the excerpt. Example: 100', 'ThemeStockyard'),
		),
		'ignore_sticky_posts' => array(
            'type' => 'select',
            'label' => __('Ignore Sticky Posts?', 'ThemeStockyard'),
            'options' => $reverse_bool_choices
		)
	),
	'shortcode' => '[blog_banner columns="{{columns}}" limit="{{posts_per_page}}" fullwidth="{{fullwidth}}" infinite_scroll="{{infinite_scroll}}" infinite_scroll_button_text="{{infinite_scroll_button_text}}" cat="{{cat}}" include="{{include}}" exclude="{{exclude}}" exclude_previous_posts="{{exclude_previous_posts}}" exclude_these_later="{{exclude_these_later}}" excerpt_length="{{excerpt_length}}" show_pagination="{{show_pagination}}" ignore_sticky_posts="{{ignore_sticky_posts}}"][/blog_banner]',
	'popup_title' => __( 'Blog Banner Shortcode', 'ThemeStockyard')
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Slider Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['blog_slider'] = array(
	'no_preview' => true,
	'params' => array(

		'limit' => array(
			'type' => 'select',
			'label' => __( 'Post count', 'ThemeStockyard'),
			'desc' => __( 'Select number of posts to show in the slider', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 20, true, true ),
			'std' => 5
		),
		'cat' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'ThemeStockyard'),
			'desc' => __( 'Select a category or leave blank for all', 'ThemeStockyard'),
			'options' => ts_shortcodes_categories( 'category' )
		),
		'include' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to include...', 'ThemeStockyard'),
			'desc' =>  __( 'Display only certain posts by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to <em>exclude</em>...', 'ThemeStockyard'),
			'desc' =>  __( 'Prevent certain posts from displaying by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude_previous_posts' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude previous posts?', 'ThemeStockyard'),
			'desc' => __('This option can prevent posts from the slider or other instances of blog shortcodes from appearing.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'exclude_these_later' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude these posts later?', 'ThemeStockyard'),
			'desc' => __('This option can prevent *these* posts from appearing in other instances of blog shortcodes.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'title_size' => array(
			'type' => 'text',
			'label' => __('Title Size', 'ThemeStockyard'),
			'desc' => __('Examples: H1, H2, H3, H4, H5, H6... or enter any font size (ex: 16px). Leave blank for default.', 'ThemeStockyard')
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Align Text', 'ThemeStockyard'),
			'options' => $align_options,
			'std' => 'center'
		),
		'allow_videos' => array(
			'type' => 'radio_inline',
			'label' => __( 'Allow Videos?', 'ThemeStockyard'),
			'desc' => __('If set to &#8220;No&#8221, only featured images will be shown.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'image_size' => array(
			'type' => 'select',
			'label' => __( 'Image size', 'ThemeStockyard'),
			'desc' => __('If using this shortcode within a small column or within the sidebar, select a smaller size to save bandwith.', 'ThemeStockyard'),
			'options' => array(
				'large' => __('Large', 'ThemeStockyard'),
				'medium' => __('Medium', 'ThemeStockyard'),
				'small' => __('Small', 'ThemeStockyard'),
			),
			'std' => 'large'
		),
		/*
		'image_orientation' => array(
			'type' => 'select',
			'label' => __( 'Image size', 'ThemeStockyard'),
			'options' => 'options' => array(
				'16:9' => __('16:9 (landscape)', 'ThemeStockyard'),
				'2:1' => __('2:1 (landscape)', 'ThemeStockyard'),
				'13:6' => __('13:6 (landscape)', 'ThemeStockyard'),
				'9:16' => __('9:16 (portrait)', 'ThemeStockyard'),
				'1:2' => __('1:2 (portrait)', 'ThemeStockyard'),
				'6:13' => __('6:13 (portrait)', 'ThemeStockyard'),
			),
			'std' => 'large'
		),*/
		'ignore_sticky_posts' => array(
            'type' => 'select',
            'label' => __('Ignore Sticky Posts?', 'ThemeStockyard'),
            'options' => $reverse_bool_choices
		)
	),
	'shortcode' => '[blog_slider limit="{{limit}}" cat="{{cat}}" include="{{include}}" exclude="{{exclude}}" exclude_previous_posts="{{exclude_previous_posts}}" exclude_these_later="{{exclude_these_later}}" title_size="{{title_size}}" text_align="{{text_align}}" allow_videos="{{allow_videos}}" image_size="{{image_size}}" ignore_sticky_posts="{{ignore_sticky_posts}}"][/blog_slider]',
	'popup_title' => __( 'Blog Slider Shortcode', 'ThemeStockyard')
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Widget Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['blog_widget'] = array(
	'no_preview' => true,
	'params' => array(
        
		'widget_heading' => array(
			'type' => 'text',
			'label' => __('Widget Heading', 'ThemeStockyard'),
			'desc' => __('Leave blank for no heading.', 'ThemeStockyard')
		),/*
		'widget_heading_size' => array(
			'type' => 'text',
			'label' => __('Widget Heading Size', 'ThemeStockyard'),
			'desc' => __('Examples: H1, H2, H3, H4, H5, H6... or enter any font size (ex: 16px). Leave blank for default.', 'ThemeStockyard')
		),*/
		'widget_layout' => array(
			'type' => 'select',
			'label' => __( 'Widget Layout', 'ThemeStockyard'),
			'desc' => __( 'This shortcode is best for columns less than 480 pixels. However, the &#8220;horizontal&#8221; layout will also work well in wider columns.', 'ThemeStockyard'),
			'options' => array(
				'vertical' => __('Vertical', 'ThemeStockyard'),
				'horizontal' => __('Horizontal', 'ThemeStockyard'),
			)
		),
		'limit' => array(
			'type' => 'select',
			'label' => __( 'Limit', 'ThemeStockyard'),
			'desc' => __( 'Select number of posts to show', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 30, true, true ),
			'std' => 4
		),
		'cat' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'ThemeStockyard'),
			'desc' => __( 'Select a category or leave blank for all', 'ThemeStockyard'),
			'options' => ts_shortcodes_categories( 'category' )
		),
		'override_widget_heading' => array(
			'type' => 'radio_inline',
			'label' => __( 'Override Widget Heading?', 'ThemeStockyard'),
			'desc' => __('If set to &#8220;Yes&#8221 and a single Category is chosen above, the category name will be linked and used as the Widget Heading.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'include' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to include...', 'ThemeStockyard'),
			'desc' =>  __( 'Display only certain posts by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to <em>exclude</em>...', 'ThemeStockyard'),
			'desc' =>  __( 'Prevent certain posts from displaying by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude_previous_posts' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude previous posts?', 'ThemeStockyard'),
			'desc' => __('This option can prevent posts from the slider or other instances of blog shortcodes from appearing.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'exclude_these_later' => array(
			'type' => 'radio_inline',
			'label' => __( 'Exclude these posts later?', 'ThemeStockyard'),
			'desc' => __('This option can prevent *these* posts from appearing in other instances of blog shortcodes.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'title_size' => array(
			'type' => 'text',
			'label' => __('Title Size', 'ThemeStockyard'),
			'desc' => __('Examples: H1, H2, H3, H4, H5, H6... or enter any font size (ex: 16px). Leave blank for default.', 'ThemeStockyard')
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Align Text', 'ThemeStockyard'),
			'options' => $align_options,
			'std' => ''
		),
		'excerpt_length' => array(
			'type' => 'text',
			'label' => __( 'Excerpt Length (leave blank for default)', 'ThemeStockyard'),
			'desc' =>  __( 'Maximum number of characters to show in the excerpt. Example: 100', 'ThemeStockyard'),
		),
		'show_excerpt' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Excerpt?', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'show_meta' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Meta? (category, author, etc)', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'show_media' => array(
			'type' => 'radio_inline',
			'label' => __( 'Show Featured Images/Video?', 'ThemeStockyard'),
			'options' => array(
				'yes' => __('Yes', 'ThemeStockyard'),
				'first' => __('Only for the first post', 'ThemeStockyard'),
				'no' => __('No', 'ThemeStockyard'),
			),
			'std' => 'yes'
		),
		'allow_videos' => array(
			'type' => 'radio_inline',
			'label' => __( 'Allow Videos?', 'ThemeStockyard'),
			'desc' => __('If set to &#8220;No&#8221, only featured images will be shown.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'allow_galleries' => array(
			'type' => 'radio_inline',
			'label' => __( 'Allow Galleries?', 'ThemeStockyard'),
			'desc' => __('If set to &#8220;No&#8221, only featured images (but not galleries) will be shown.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'ignore_sticky_posts' => array(
            'type' => 'select',
            'label' => __('Ignore Sticky Posts?', 'ThemeStockyard'),
            'options' => $reverse_bool_choices
		)
	),
	'shortcode' => '[blog_widget widget_heading="{{widget_heading}}" widget_layout="{{widget_layout}}" limit="{{limit}}" cat="{{cat}}" override_widget_heading="{{override_widget_heading}}" include="{{include}}" exclude="{{exclude}}" exclude_previous_posts="{{exclude_previous_posts}}" exclude_these_later="{{exclude_these_later}}" excerpt_length="{{excerpt_length}}" title_size="{{title_size}}" text_align="{{text_align}}" show_excerpt="{{show_excerpt}}" show_meta="{{show_meta}}" show_media="{{show_media}}" allow_videos="{{allow_videos}}" allow_galleries="{{allow_galleries}}" ignore_sticky_posts="{{ignore_sticky_posts}}"][/blog_widget]',
	'popup_title' => __( 'Blog Widget Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(

		'style' => array(
			'std' => 'standard',
			'type' => 'select',
			'label' => __('Button Style', 'ThemeStockyard'),
			'options' => array(
                'standard' => __('Standard', 'ThemeStockyard'),
                'outline' => __('Outline', 'ThemeStockyard'),
                'outline-thin' => __('Outline Thin', 'ThemeStockyard'),
			)
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'ThemeStockyard'),
			'desc' => __('http://example.com', 'ThemeStockyard')
		),
		'color' => array(
			'std' => '',
			'type' => 'colorpicker',
			'label' => __('Button Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Button Size', 'ThemeStockyard'),
			'options' => array(
				'small' => __('Small', 'ThemeStockyard'),
				'medium' => __('Medium', 'ThemeStockyard'),
				'large' => __('Large', 'ThemeStockyard'),
			),
			'std' => 'medium'
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Button Link Target', 'ThemeStockyard'),
			'options' => array(
				'_self' => __('Same window/tab', 'ThemeStockyard'),
				'_blank' => __('New window/tab', 'ThemeStockyard')
			)
		),
		'content' => array(
			'std' => __('Button Text', 'ThemeStockyard'),
			'type' => 'text',
			'label' => __('Button\'s Text', 'ThemeStockyard'),
			'use_selection' => true
		),
	),
	'shortcode' => '[button link="{{url}}" color="{{color}}" size="{{size}}" target="{{target}}" style="{{style}}"]{{content}}[/button]',
	'popup_title' => __('Button Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Callout Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['callout'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => __('Title goes here', 'ThemeStockyard'),
			'type' => 'text',
			'label' => __('Title', 'ThemeStockyard')
		),
		'content' => array(
			'std' => __('Description goes here', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __('Description', 'ThemeStockyard'),
			'desc' => '',
			'use_selection' => true
		),
		'align' => array(
			'std' => 'left',
			'type' => 'select',
			'label' => __('Align', 'ThemeStockyard'),
			'options' => array(
                'left' => __('Left', 'ThemeStockyard'),
                'right' => __('Right', 'ThemeStockyard'),
                'bottom' => __('Bottom', 'ThemeStockyard'),
			)
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button Link URL', 'ThemeStockyard'),
			'desc' => 'http://example.com'
		),
		'linktarget' => array(
			'std' => '_self',
			'type' => 'select',
			'label' => __('Button Link Target', 'ThemeStockyard'),
			'options' => array(
                '_self' => __('Same window/tab', 'ThemeStockyard'),
                '_blank' => __('New window/tab', 'ThemeStockyard'),
			)
		),
		'button_text' => array(
			'std' => __('Button text here', 'ThemeStockyard'),
			'type' => 'text',
			'label' => __('Button Text', 'ThemeStockyard')
		),
		'button_color' => array(
			'std' => '',
			'type' => 'colorpicker',
			'label' => __('Button Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'button_position' => array(
			'std' => 'right',
			'type' => 'select',
			'label' => __('Button Position', 'ThemeStockyard'),
			'options' => array(
                'right' => __('Right', 'ThemeStockyard'),
                'left' => __('Left', 'ThemeStockyard'),
                'bottom' => __('Bottom', 'ThemeStockyard'),
			)
		),
		'border_color' => array(
			'type' => 'colorpicker',
			'label' => __('Border Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'background_color' => array(
            'type' => 'colorpicker',
			'label' => __('Background Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'title_color' => array(
            'type' => 'colorpicker',
			'label' => __('Title Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'description_color' => array(
            'type' => 'colorpicker',
			'label' => __('Description Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'add_shadow' => array(
            'std' => 'no',
            'type' => 'select',
			'label' => __('Add Drop Shadow', 'ThemeStockyard'),
			'options' => $alt_choices
		),
		/*'background_image' => array(
            'type' => 'uploader',
            'label' => __('Background Image', 'ThemeStockyard')
		),
		'background_repeat' => array(
            'std' => '0',
            'type' => 'select',
            'label' => __('Background Image Repeat', 'ThemeStockyard'),
            'options' => array(
                'no-repeat' => __('No repeat', 'ThemeStockyard'),
                'repeat' => __('Repeat', 'ThemeStockyard'),
                'repeat-x' => __('Repeat on X-axis (repeat-x)', 'ThemeStockyard'),
                'repeat-y' => __('Repeat on Y-axis (repeat-y)', 'ThemeStockyard')
            )
		),*/
	),
	'shortcode' => '[callout title="{{title}}" align="{{align}}" link="{{link}}" linktarget="{{linktarget}}" button_text="{{button_text}}" button_color="{{button_color}}" button_position="{{button_position}}" border_color="{{border_color}}" background_color="{{background_color}}" title_color="{{title_color}}" description_color="{{description_color}}" add_shadow="{{add_shadow}}"]{{content}}[/callout]',
	'popup_title' => __('Callout Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Clear Floats Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['clear'] = array(
	'params' => array(

		'height' => array(
			'type' => 'text',
			'label' => __('Height (optional)', 'ThemeStockyard'),
			'desc' => __('&#8220;Clear floats&#8221; should be used after a full row of columns to make sure content is displayed correctly. You can add a height as well to divide content.', 'ThemeStockyard'),
			'std' => '0px'
		)
	),
	'shortcode' => '[clear height="{{height}}"]', // as there is no wrapper shortcode
	'popup_title' => __('Clear Floats Shortcode', 'ThemeStockyard'),
	'no_preview' => true,
);


/*-----------------------------------------------------------------------------------*/
/*	Client Slider Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['clientslider'] = array(
	'params' => array(),
	'shortcode' => '[clients]{{child_shortcode}}[/clients]', // as there is no wrapper shortcode
	'popup_title' => __('Client Slider Shortcode', 'ThemeStockyard'),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Client Website Link', 'ThemeStockyard'),
				'desc' => __('Add the url to client\'s website <br />ex: http://example.com', 'ThemeStockyard')
			),
			'target' => array(
				'type' => 'select',
				'label' => __('Link Target', 'ThemeStockyard'),
				'options' => array(
					'_self' => __('Same window/tab', 'ThemeStockyard'),
					'_blank' => __('New window/tab', 'ThemeStockyard')
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __('Client Image', 'ThemeStockyard'),
				'desc' => __('Upload the client image', 'ThemeStockyard'),
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Image Alt Text', 'ThemeStockyard'),
				'desc' => __('The alt attribute provides alternative information if an image cannot be viewed', 'ThemeStockyard')
			)
		),
		'shortcode' => '[client link="{{url}}" linktarget="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' => __('Add New Client Image', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Code Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['code'] = array(
	'no_preview' => true,
	'params' => array(

		'style' => array(
			'std' => 'inline',
			'type' => 'select',
			'label' => __('Style', 'ThemeStockyard'),
			'options' => array(
                'inline' => __('Inline', 'ThemeStockyard'),
                'block'  => __('Block', 'ThemeStockyard')
			)
		),
		'content' => array(
			'std' => __('Content', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __('Content', 'ThemeStockyard'),
			'desc' => '',
			'use_selection' => true
		),
	),
	'shortcode' => '[code style="{{style}}"]{{content}}[/code]',
	'popup_title' => __('Code Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Color Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['color'] = array(
	'no_preview' => true,
	'params' => array(

		'color' => array(
			'std' => '',
			'type' => 'colorpicker',
			'label' => __('Text Color', 'ThemeStockyard')
		),
		'content' => array(
			'std' => __('Text content', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __('Content', 'ThemeStockyard'),
			'use_selection' => true
		),
	),
	'shortcode' => '[color color="{{color}}"]{{content}}[/color]',
	'popup_title' => __('Color Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['columns'] = array(
	
	'params' => array(
		'margin_top' => array(
			'type' => 'text',
			'label' => __('Row Top Margin', 'ThemeStockyard'),
			'desc' => __('The top margin for this row of columns. (In Pixels)', 'ThemeStockyard'),
			'std' => '0px'
		),
		'margin_bottom' => array(
			'type' => 'text',
			'label' => __('Row Bottom Margin', 'ThemeStockyard'),
			'desc' => __('The bottom margin for this row of columns. (In Pixels)', 'ThemeStockyard'),
			'std' => '0px'
		),
	),
	'shortcode' => '[columns_row margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}"]{{child_shortcode}}[/columns_row]',
	'popup_title' => __('Insert Columns Shortcode', 'ThemeStockyard'),
	'no_preview' => true,
	'max_children' => 6,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'ThemeStockyard'),
				'desc' => __('Select the width of the column', 'ThemeStockyard'),
				'options' => array(
                    'one_half' => __('One Half (1/2)', 'ThemeStockyard'),
					'one_third' => __('One Third (1/3)', 'ThemeStockyard'),
                    'one_fourth' => __('One Fourth (1/4)', 'ThemeStockyard'),
                    'one_fifth' => __('One Fifth (1/5)', 'ThemeStockyard'),
                    'one_sixth' => __('One Sixth (1/6)', 'ThemeStockyard'),
                    'two_third' => __('Two Third (2/3)', 'ThemeStockyard'),
                    'two_fifth' => __('Two Fifth (2/5)', 'ThemeStockyard'),
                    'three_fourth' => __('Three Fourth (3/4)', 'ThemeStockyard'),
                    'three_fifth' => __('Three Fifth (3/5)', 'ThemeStockyard'),
                    'four_fifth' => __('Four Fifth (4/5)', 'ThemeStockyard'),
                    'five_sixth' => __('Five Sixth (5/6)', 'ThemeStockyard')
				)
			),
			'last' => array(
				'type' => 'select',
				'label' => __('Last Column', 'ThemeStockyard'),
				'desc' => __('This should be set to "Yes" for the last column in a set. (not absolutely necessary in most cases)', 'ThemeStockyard'),
				'options' => $reverse_choices
			),
			'content' => array(
				'std' => __('Add column content here...', 'ThemeStockyard'),
				'type' => 'textarea',
				'label' => __('Column Content', 'ThemeStockyard'),
				'desc' => __('Insert the column content', 'ThemeStockyard'),
				'use_selection' => true
			)
		),
		'shortcode' => '[column size="{{column}}" last="{{last}}"]&lt;br /&gt;{{content}}&lt;br /&gt;[/column] ',
		'clone_button' => __('Add Column', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Custom Menus Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['custom_menu'] = array(
	'no_preview' => true,
	'params' => array(

		'style' => array(
			'std' => 'standard',
			'type' => 'select',
			'label' => __('List Style', 'ThemeStockyard'),
			'options' => array(
                'plain' => __('Plain', 'ThemeStockyard'),
                'angles' => __('Angles', 'ThemeStockyard'),
                'carets' => __('Small Triangles', 'ThemeStockyard'),
                'borders' => __('Borders', 'ThemeStockyard'),
			)
		),
		'columns' => array(
			'std' => '1',
			'type' => 'select',
			'label' => __('Columns', 'ThemeStockyard'),
			'desc' => '',
			'options' => ts_shortcodes_range(4, false, false)
		),
		'id' => array(
			'type' => 'select',
			'label' => __('Select a menu...', 'ThemeStockyard'),
			'options' => ts_shortcodes_menu_options(),
			'std' => ''
		),
	),
	'shortcode' => '[custom_menu style="{{style}}" columns="{{columns}}" id="{{id}}"][/custom_menu]',
	'popup_title' => __('Custom Menu Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Divider Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['divider'] = array(
	'no_preview' => true,
	'params' => array(

		'style' => array(
			'type' => 'select',
			'label' => __('Divider Style', 'ThemeStockyard'),
			'desc' => __('Select a divider style', 'ThemeStockyard'),
			'options' => array(
                'invisible' => __('Invisible', 'ThemeStockyard'),
                'single' => __('Single Border', 'ThemeStockyard'),
                'dashed' => __('Dashed Border', 'ThemeStockyard'),
                'double' => __('Double Border', 'ThemeStockyard'),
                'double-dashed' => __('Double-Dashed Border', 'ThemeStockyard'),
                'circle' => __('Circle', 'ThemeStockyard'),
                'square' => __('Square', 'ThemeStockyard')
			)
		),
		'align' => array(
			'type' => 'select',
			'label' => __('Align Shape', 'ThemeStockyard'),
			'desc' => __('Note: Only useful for &#8220;Circle&#8221; and &#8220;Square&#8221; dividers', 'ThemeStockyard'),
			'options' => array(
                'left' => __('Left', 'ThemeStockyard'),
                'center' => __('Center', 'ThemeStockyard'),
                'right' => __('Right', 'ThemeStockyard')
			),
			'std' => 'center'
		),
		'color' => array(
			'std' => '',
			'type' => 'colorpicker',
			'label' => __('Divider Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'opacity' => array(
			'type' => 'select',
			'label' => __('Divider Opacity', 'ThemeStockyard'),
			'options' => ts_shortcodes_range(100, false, false, 1, '.01'),
			'std' => 1
		),
		'width' => array(
			'type' => 'text',
			'label' => __('Maximum Width', 'ThemeStockyard'),
			'desc' => __('Example: 300px. Note: Leave blank for 100%', 'ThemeStockyard')
		),
		'pull' => array(
			'type' => 'select',
			'label' => __('Pull Divider', 'ThemeStockyard'),
			'desc' => __('Which direction to pull to divider. Note: Only useful when &#8220;Width&#8221; has been added.', 'ThemeStockyard'),
			'options' => array(
                '' => __('[none]', 'ThemeStockyard'),
                'left' => __('Left', 'ThemeStockyard'),
                'center' => __('Center', 'ThemeStockyard'),
                'right' => __('Right', 'ThemeStockyard')
			),
			'std' => ''
		),
		'padding_top' => array(
			'type' => 'text',
			'label' => __('Padding Top', 'ThemeStockyard'),
			'desc' => __('In Pixels', 'ThemeStockyard'),
			'std' => '20px'
		),
		'padding_bottom' => array(
			'type' => 'text',
			'label' => __('Padding Bottom', 'ThemeStockyard'),
			'desc' => __('In Pixels', 'ThemeStockyard'),
			'std' => '20px'
		),
	),
	'shortcode' => '[divider style="{{style}}" align="{{align}}" color="{{color}}" opacity="{{opacity}}" width="{{width}}" pull="{{pull}}" padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}"]',
	'popup_title' => __('Divider Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Sinple Divider Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['simple_divider'] = array(
	'no_preview' => true,
	'params' => array(
		'height' => array(
			'type' => 'text',
			'label' => __('Divider Height', 'ThemeStockyard'),
			'desc' => __('Example: 40px.', 'ThemeStockyard')
		)
	),
	'shortcode' => '[divider height="{{height}}"]',
	'popup_title' => __('Divider Shortcode (simple version)', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Dropcap Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' => array(

		'content' => array(
			'std' => __('A', 'ThemeStockyard'),
			'type' => 'text',
			'label' => __('Featured letter...', 'ThemeStockyard'),
			'desc' => __('Dropcap letter goes here.', 'ThemeStockyard'),
			'use_selection' => true
		),
		'text_color' => array(
			'type' => 'colorpicker',
			'label' => __('Text Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'background_color' => array(
            'type' => 'colorpicker',
			'label' => __('Background Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
	),
	'shortcode' => '[dropcap text_color="{{text_color}}" background_color="{{background_color}}"]{{content}}[/dropcap]',
	'popup_title' => __('Dropcap Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Email Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['email'] = array(
	'params' => array(

		'address' => array(
			'type' => 'text',
			'label' => __('Email Address', 'ThemeStockyard'),
			'desc' => __('Example: you@yourcompany.com<br/>Will print via JavaScript to avoid spam.', 'ThemeStockyard'),
			'std' => ''
		),
		'content' => array(
			'type' => 'text',
			'label' => __('Display Text', 'ThemeStockyard'),
			'desc' => __('Leave blank to simply use the email address as display text.', 'ThemeStockyard'),
			'std' => ''
		)
	),
	'shortcode' => '[email address="{{address}}"]{{content}}[/email]', // as there is no wrapper shortcode
	'popup_title' => __('Email Link Shortcode', 'ThemeStockyard'),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	FadeIn Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['fadein'] = array(
	'no_preview' => true,
	'params' => array(

		'from' => array(
			'type' => 'select',
			'label' => __( 'Fade in from...', 'ThemeStockyard'),
			'desc' => '',
			'options' => array(
				'here' => __('Current location', 'ThemeStockyard'),
				'above' => __('Above', 'ThemeStockyard'),
				'below' => __('Below', 'ThemeStockyard'),
				'left' => __('Left', 'ThemeStockyard'),
				'right' => __('Right', 'ThemeStockyard'),
			)
		),
		'content' => array(
			'std' => __('Content', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Fade-in Content', 'ThemeStockyard'),
			'desc' => __( 'Insert the content', 'ThemeStockyard'),
			'use_selection' => true
		)
	),
	'shortcode' => '[fadein from="{{from}}"]&lt;br /&gt;{{content}}&lt;br /&gt;[/fadein]',
	'popup_title' => __( 'Fade In Animation Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	FontAwesome Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['fontawesome'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'ThemeStockyard'),
			'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
			'options' => $icons
		),
		'size' => array(
			'type' => 'text',
			'label' => __('Size of Icon', 'ThemeStockyard'),
			'desc' => __('Example: 16px', 'ThemeStockyard'),
			'std' => '14px'
		),
		'color' => array(
			'type' => 'colorpicker',
			'label' => __('Icon Color', 'ThemeStockyard'),
			'desc' => '',
			'options' => ts_color_options()
		)
	),
	'shortcode' => '[fontawesome icon="{{icon}}" size="{{size}}" color="{{color}}"]',
	'popup_title' => __( 'FontAwesome Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Fullwidth Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['fullwidth'] = array(
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Style', 'ThemeStockyard'),
			'desc' => __('Choose &#8220;Default&#8221; or &#8220;Parallax&#8221;', 'ThemeStockyard'),
			'options' => array(
				'default' => __('Default', 'ThemeStockyard'),
				'parallax' => __('Parallax', 'ThemeStockyard')
			)
		),
		'fullwidth' => array(
            'std' => 'yes',
			'type' => 'select',
			'label' => __('Fullwidth?', 'ThemeStockyard'),
			'desc' => __("Stretch parallax section to full width of browser? (Only works on pages without a sidebar)", 'ThemeStockyard'),
			'options' => $choices
		),
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __('Background Color', 'ThemeStockyard'),
		),
		'background_image' => array(
			'type' => 'uploader',
			'label' => __('Backgrond Image', 'ThemeStockyard'),
			'desc' => __('Upload an image to display in the background', 'ThemeStockyard')
		),
		'background_repeat' => array(
			'type' => 'select',
			'label' => __('Background Repeat', 'ThemeStockyard'),
			'desc' => __('Choose how the background image repeats.', 'ThemeStockyard'),
			'options' => array(
				'no-repeat' => __('No Repeat', 'ThemeStockyard'),
				'repeat' => __('Repeat Vertically and Horizontally', 'ThemeStockyard'),
				'repeat-x' => __('Repeat Horizontally', 'ThemeStockyard'),
				'repeat-y' => __('Repeat Vertically', 'ThemeStockyard')
			)
		),
		'background_position' => array(
			'type' => 'select',
			'label' => __('Background Position', 'ThemeStockyard'),
			'desc' => __('Choose the postion of the background image', 'ThemeStockyard'),
			'options' => array(
				'left top' => __('Left Top', 'ThemeStockyard'),
				'left center' => __('Left Center', 'ThemeStockyard'),
				'left bottom' => __('Left Bottom', 'ThemeStockyard'),
				'right top' => __('Right Top', 'ThemeStockyard'),
				'right center' => __('Right Center', 'ThemeStockyard'),
				'right bottom' => __('Right Bottom', 'ThemeStockyard'),
				'center top' => __('Center Top', 'ThemeStockyard'),
				'center center' => __('Center Center', 'ThemeStockyard'),
				'center bottom' => __('Center Bottom', 'ThemeStockyard')
			)
		),
		'mesh_overlay' => array(
            'std' => 'yes',
			'type' => 'select',
			'label' => __('Mesh overlay?', 'ThemeStockyard'),
			'desc' => __("Cover background color/image with mesh overlay?", 'ThemeStockyard'),
			'options' => $reverse_choices
		),
		'border_width' => array(
			'std' => '1',
			'type' => 'select',
			'label' => __( 'Border Size/Width', 'ThemeStockyard'),
			'desc' => __( 'In pixels', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 10, false, false ,0 )
		),
		'border_color' => array(
			'type' => 'colorpicker',
			'label' => __('Border Color', 'ThemeStockyard'),
			'desc' => __('Leave blank for default', 'ThemeStockyard')
		),
		'padding_top' => array(
			'std' => 20,
			'type' => 'select',
			'label' => __( 'Padding Top', 'ThemeStockyard'),
			'desc' => __( 'In pixels', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 100, false, false, 0 )
		),
		'padding_bottom' => array(
			'std' => 20,
			'type' => 'select',
			'label' => __( 'Padding Bottom', 'ThemeStockyard'),
			'desc' => __( 'In pixels', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 100, false, false, 0 )
		),
		'padding_left' => array(
			'std' => 20,
			'type' => 'select',
			'label' => __( 'Padding Left', 'ThemeStockyard'),
			'desc' => __( 'In pixels', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 100, false, false, 0 )
		),
		'padding_right' => array(
			'std' => 20,
			'type' => 'select',
			'label' => __( 'Padding Right', 'ThemeStockyard'),
			'desc' => __( 'In pixels', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 100, false, false, 0 )
		),
		'content' => array(
			'std' => __('Your content here...', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Content', 'ThemeStockyard'),
			'desc' => __( 'Add content', 'ThemeStockyard'),
			'use_selection' => true
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Align Content Text', 'ThemeStockyard'),
			'options' => $align_options,
			'std' => ''
		),
		'text_color' => array(
			'type' => 'colorpicker',
			'label' => __('Text Color', 'ThemeStockyard'),
			'desc' => __('Leave blank for default', 'ThemeStockyard')
		),
	),
	'shortcode' => '[fullwidth style="{{style}}" fullwidth="{{fullwidth}}" background_color="{{background_color}}" background_image="{{background_image}}" background_repeat="{{background_repeat}}" background_position="{{background_position}}" mesh_overlay="{{mesh_overlay}}" border_width="{{border_width}}px" border_color="{{border_color}}" padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}" padding_left="{{padding_left}}" padding_right="{{padding_right}}" text_align="{{text_align}}" text_color="{{text_color}}"]&lt;br /&gt;{{content}}&lt;br /&gt;[/fullwidth]',
	'popup_title' => __( 'Fullwidth Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Google Map Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['googlemap'] = array(
	'no_preview' => true,
	'params' => array(
        
        
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Address', 'ThemeStockyard'),
			'desc' => __( 'Add address to the location which will show up on map.', 'ThemeStockyard'),
		),
		/*'type' => array(
			'type' => 'select',
			'label' => __('Map Type', 'ThemeStockyard'),
			'desc' => __('Select the type of google map to display', 'ThemeStockyard'),
			'options' => array(
				'roadmap' => 'Roadmap',
				'satellite' => 'Satellite',
				'hybrid' => 'Hybrid',
				'terrain' => 'Terrain'
			)
		),*/
		'height' => array(
			'std' => '300px',
			'type' => 'text',
			'label' => __('Map Height', 'ThemeStockyard'),
			'desc' => __('Map Height in Percentage or Pixels', 'ThemeStockyard')
		),
		'zoom' => array(
			'std' => 14,
			'type' => 'select',
			'label' => __('Zoom Level', 'ThemeStockyard'),
			'desc' => __('Higher number will be more zoomed in.', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 25, false )
		),
		'scrollwheel' => array(
            'std' => 'no',
			'type' => 'select',
			'label' => __('Enable Scrollwheel', 'ThemeStockyard'),
			'desc' => __("Enable zooming using a mouse's scroll wheel", 'ThemeStockyard'),
			'options' => $alt_choices
		),
	),
	'shortcode' => '[map address="{{content}}" height="{{height}}" zoom="{{zoom}}" scrollwheel="{{scrollwheel}}"][/map]',
	'popup_title' => __( 'Google Map Shortcode', 'ThemeStockyard'),
);

/*-----------------------------------------------------------------------------------*/
/*	Highlight Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' => array(

		'color' => array(
			'type' => 'select',
			'label' => __('Highlight Color', 'ThemeStockyard'),
			'options' => array(
                'yellow' => __('Yellow', 'ThemeStockyard'),
                'black' => __('Black', 'ThemeStockyard')
			)
		),
		'text_color' => array(
			'type' => 'colorpicker',
			'label' => __('Text Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __('Background Color', 'ThemeStockyard'),
			'desc' => __('This will override the &#8220;Highlight Color&#8221; option above', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'background_opacity' => array(
			'type' => 'select',
			'label' => __('Background Color Opacity', 'ThemeStockyard'),
			'desc' => __('Note: This only works with a hex background color', 'ThemeStockyard'),
			'options' => ts_shortcodes_range(100, false, false, 1, '.01'),
			'std' => 1
		),
		'content' => array(
			'std' => __('Your content here...', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Content to Higlight', 'ThemeStockyard'),
			'desc' => __( 'Add your content to be highlighted', 'ThemeStockyard'),
			'use_selection' => true
		)

	),
	'shortcode' => '[highlight color="{{color}}" text_color="{{text_color}}" background_color="{{background_color}}" background_opacity="{{background_opacity}}"]{{content}}[/highlight]',
	'popup_title' => __( 'Highlight Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Iconboxes Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['iconboxes'] = array(
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Iconbox Layout', 'ThemeStockyard'),
			'desc' => __('Select the layout for the iconboxes', 'ThemeStockyard'),
			'options' => array(
				'icon-inside-left' => __('Icon next to title', 'ThemeStockyard'),
				'icon-top' => __('Icon above title', 'ThemeStockyard'),
				'icon-outside-left' => __('Icon beside title and content', 'ThemeStockyard'),
			)
		)
	),
	'shortcode' => '[iconboxes layout="{{layout}}"]&lt;br /&gt;{{child_shortcode}}&lt;br /&gt;[/iconboxes]', // as there is no wrapper shortcode
	'popup_title' => __('Iconboxes Shortcode', 'ThemeStockyard'),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Title', 'ThemeStockyard')
			),
            'title_color' => array(
                'type' => 'colorpicker',
                'label' => __('Title Color', 'ThemeStockyard'),
                'options' => ts_color_options()
            ),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __('Icon', 'ThemeStockyard'),
				'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
				'options' => $icons
			),
            'icon_color' => array(
                'type' => 'colorpicker',
                'label' => __('Icon Color', 'ThemeStockyard'),
                'desc' => '',
                'options' => ts_color_options()
            ),
            'icon_background_color' => array(
                'type' => 'colorpicker',
                'label' => __('Icon Circle Background Color', 'ThemeStockyard'),
                'desc' => __('Default is none', 'ThemeStockyard'),
                'options' => ts_color_options()
            ),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('&#8220;Read More&#8221; Link Url', 'ThemeStockyard'),
				'desc' => __('http://example.com', 'ThemeStockyard')

			),
			'linktext' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('&#8220;Read More&#8221; Link Text', 'ThemeStockyard'),
				'desc' => __('Insert the text to display as the link', 'ThemeStockyard')

			),
			'target' => array(
				'type' => 'select',
				'label' => __('&#8220;Read More&#8221; Link Target', 'ThemeStockyard'),
				'options' => array(
					'_self' => __('Same window/tab', 'ThemeStockyard'),
					'_blank' => __('New window/tab', 'ThemeStockyard')
				)
			),
			'content' => array(
				'std' => __('Your content here...', 'ThemeStockyard'),
				'type' => 'textarea',
				'label' => __( 'Description / Content', 'ThemeStockyard'),
				'desc' => __( 'Add content for infobox', 'ThemeStockyard'),
			),
            'description_color' => array(
                'type' => 'colorpicker',
                'label' => __('Description Color', 'ThemeStockyard'),
                'desc' => '',
                'options' => ts_color_options()
            ),
		),
		'shortcode' => '[iconbox title="{{title}}" title_color="{{title_color}}" icon="{{icon}}" icon_color="{{icon_color}}" icon_background_color="{{icon_background_color}}" link="{{link}}" linktext="{{linktext}}" linktarget="{{target}}" description_color="{{description_color}}"]{{content}}[/iconbox]',
		'clone_button' => __('Add New Iconbox', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Gallery Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['lightbox_gallery'] = array(
    'params' => array(
		'columns' => array(
			'type' => 'select',
			'label' => __('Columns', 'ThemeStockyard'),
			'desc' => '',
			'options' => ts_shortcodes_range (12, false),
			'std' => 3
		),
		'size' => array(
			'type' => 'text',
			'label' => __('Size', 'ThemeStockyard'),
			'desc' => __('Leave blank for default, or enter [width],[height] (example: 220,300)', 'ThemeStockyard'),
			'std' => ''
		),
		'hover_zoom' => array(
			'type' => 'select',
			'label' => __('Zoom On Hover', 'ThemeStockyard'),
			'desc' => __('Enable zoom effect when hovering over images', 'ThemeStockyard'),
			'options' => $choices
		)
    ),
	'shortcode' => '[lightbox_gallery columns="{{columns}}" size="{{size}}" hover_zoom="{{hover_zoom}}"]{{child_shortcode}}[/lightbox_gallery]',
	'popup_title' => __('Lightbox Gallery Shortcode', 'ThemeStockyard'),
	'no_preview' => true,

	// child shortcode
	'child_shortcode' => array(
		'params' => array(
			'src' => array(
				'type' => 'uploader',
				'label' => __('Image', 'ThemeStockyard'),
				'desc' => __('Upload an image to display', 'ThemeStockyard')
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Image Alt Text', 'ThemeStockyard'),
				'desc' => __('The alt attribute provides alternative information if an image cannot be loaded', 'ThemeStockyard')
			)
		),
		'shortcode' => '[image src="{{src}}" alt="{{alt}}"]',
		'clone_button' => __('Add New Image', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	List Config
/*-----------------------------------------------------------------------------------*/
$ts_shortcodes['list'] = array(
	'params' => array(

		'default_icon' => array(
			'type' => 'iconpicker',
			'label' => __('Default Icon', 'ThemeStockyard'),
			'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
			'options' => $icons
		),
		'icon_color' => array(
			'type' => 'colorpicker',
			'label' => __('Icon Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'columns' => array(
			'std' => '1',
			'type' => 'select',
			'label' => __('Columns', 'ThemeStockyard'),
			'desc' => '',
			'options' => ts_shortcodes_range(4, false, false, 0)
		),
		'arrange_columns' => array(
			'std' => '1',
			'type' => 'select',
			'label' => __('Arrange Columns', 'ThemeStockyard'),
			'desc' => __('Only works with 2+ columns', 'ThemeStockyard'),
			'options' => array(
                'vertical' => __('Top to bottom', 'ThemeStockyard'),
                'horizontal' => __('Left to Right', 'ThemeStockyard')
			)
		)
	),

	'shortcode' => '[list default_icon="{{default_icon}}" icon_color="{{icon_color}}" columns="{{columns}}" arrange_columns="{{arrange_columns}}"]{{child_shortcode}}[/list]',
	'popup_title' => __('List Shortcode', 'ThemeStockyard'),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'content' => array(
				'std' => __('Your content here...', 'ThemeStockyard'),
				'type' => 'textarea',
				'label' => __( 'List Item Content', 'ThemeStockyard'),
				'desc' => __( 'Add list item content', 'ThemeStockyard'),
			),
			'icon' => array(
                'type' => 'iconpicker',
                'label' => __('Default Icon', 'ThemeStockyard'),
                'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
                'options' => $icons
            ),
            'icon_color' => array(
                'type' => 'colorpicker',
                'label' => __('Icon Color', 'ThemeStockyard'),
                'options' => ts_color_options()
            )
		),
		'shortcode' => '[list_item icon="{{icon}}" icon_color="{{icon_color}}"]{{content}}[/list_item]',
		'clone_button' => __('Add New List Item', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Parallax Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['parallax'] = array(
	'no_preview' => true,
	'params' => array(
        
		'fullwidth' => array(
            'std' => 'yes',
			'type' => 'select',
			'label' => __('Fullwidth?', 'ThemeStockyard'),
			'desc' => __("Stretch parallax section to full width of browser? (Only works on pages without a sidebar)", 'ThemeStockyard'),
			'options' => $choices
		),
		'padding_top' => array(
			'std' => '0',
			'type' => 'select',
			'label' => __('Padding Top', 'ThemeStockyard'),
			'desc' => __('In pixels', 'ThemeStockyard'),
			'options' => ts_shortcodes_range(200, false, false, 0)
		),
		'padding_bottom' => array(
			'std' => '0',
			'type' => 'select',
			'label' => __('Padding Bottom', 'ThemeStockyard'),
			'desc' => __('In pixels', 'ThemeStockyard'),
			'options' => ts_shortcodes_range(200, false, false, 0)
		),
		'border_color' => array(
			'type' => 'colorpicker',
			'label' => __('Border Color', 'ThemeStockyard')
		),
		'border_width' => array(
            'std' => '0',
            'type' => 'select',
            'label' => __('Border Width', 'ThemeStockyard'),
			'desc' => __('In pixels', 'ThemeStockyard'),
            'options' => ts_shortcodes_range(10, false, false, 0)
		),
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __('Background Color', 'ThemeStockyard')
		),
		'background_image' => array(
            'type' => 'uploader',
            'label' => __('Background Image', 'ThemeStockyard')
		),
		'background_repeat' => array(
            'std' => '0',
            'type' => 'select',
            'label' => __('Background Image Repeat', 'ThemeStockyard'),
            'options' => array(
                'no-repeat' => __('No repeat', 'ThemeStockyard'),
                'repeat' => __('Repeat', 'ThemeStockyard'),
                'repeat-x' => __('Repeat on X-axis (repeat-x)', 'ThemeStockyard'),
                'repeat-y' => __('Repeat on Y-axis (repeat-y)', 'ThemeStockyard')
            )
		),
		'content' => array(
			'std' => __('Content', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __('Content', 'ThemeStockyard'),
			'desc' => '',
			'use_selection' => true
		),
	),
	'shortcode' => '[parallax padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}" border_color="{{border_color}}" border_width="{{border_width}}" background_color="{{background_color}}" background_image="{{background_image}}" background_repeat="{{background_repeat}}" fullwidth="{{fullwidth}}"]&lt;br /&gt;{{content}}&lt;br /&gt;[/parallax]',
	'popup_title' => __('Parallax Shortcode', 'ThemeStockyard')
);



/*-----------------------------------------------------------------------------------*/
/*	People Config
/*-----------------------------------------------------------------------------------*/
$ts_shortcodes['people'] = array(
	'params' => array(

		'columns' => array(
			'std' => '1',
			'type' => 'select',
			'label' => __('Columns', 'ThemeStockyard'),
			'desc' => '',
			'options' => ts_shortcodes_range(6, false, false, 0)
		),
		'image_size' => array(
			'type' => 'text',
			'label' => __('Image Size', 'ThemeStockyard'),
			'desc' => __('Leave blank for default, or enter [width],[height] (example: 220,300)', 'ThemeStockyard'),
			'std' => ''
        ),
		'rounded_images' => array(
			'std' => '1',
			'type' => 'select',
			'label' => __('Rounded Images?', 'ThemeStockyard'),
			'desc' => __('May not work with custom image size', 'ThemeStockyard'),
			'options' => $choices
		),
		'align' => array(
			'type' => 'select',
			'label' => __( 'Align Text', 'ThemeStockyard'),
			'options' => $align_options,
			'std' => ''
		),
		
	),

	'shortcode' => '[people columns="{{columns}}" image_size="{{image_size}}" rounded_images="{{rounded_images}}" align="{{align}}"]{{child_shortcode}}[/people]',
	'popup_title' => __('People Shortcode', 'ThemeStockyard'),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'image' => array(
                'type' => 'uploader',
                'label' => __('Image', 'ThemeStockyard')
            ),
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Name', 'ThemeStockyard'),
			),
			'subtitle' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Subtitle', 'ThemeStockyard'),
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Description', 'ThemeStockyard'),
			),
            'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link URL', 'ThemeStockyard'),
			),
            'link_text' => array(
				'std' => 'Read more',
				'type' => 'text',
				'label' => __( 'Link Text', 'ThemeStockyard'),
			),
            'link_target' => array(
				'std' => '',
				'type' => 'select',
				'label' => __( 'Link Target', 'ThemeStockyard'),
				'options' => array(
                    '_self' => __('Same window/tab', 'ThemeStockyard'),
                    '_blank' => __('New window/tab', 'ThemeStockyard'),
				)
			),
		),
		'shortcode' => '[person image="{{image}}" name="{{name}}" subtitle="{{subtitle}}" link="{{link}}" link_text="{{link_text}}" link_target="{{link_target}}"]{{content}}[/person]',
		'clone_button' => __('Add New Person', 'ThemeStockyard')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Portfolio Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['portfolio'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Portfolio Layout', 'ThemeStockyard'),
			'desc' => __( 'Select the layout for the portfolio shortcode', 'ThemeStockyard'),
			'options' => array(
				'' => __('Default', 'ThemeStockyard'),
				'2column' => __('2 Column', 'ThemeStockyard'),
				'3column' => __('3 Column', 'ThemeStockyard'),
				'4column' => __('4 Column', 'ThemeStockyard'),
				'cards' => __('Masonry Cards', 'ThemeStockyard'),
				'grid' => __('Masonry Grid', 'ThemeStockyard'),
			)
		),
		'posts_per_page' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'ThemeStockyard'),
			'desc' => __( 'Select number of posts per page', 'ThemeStockyard'),
			'options' => ts_shortcodes_range( 30, true, true ),
			'std' => 'All'
		),
		'show_pagination' => array(
			'type' => 'select',
			'label' => __( 'Show Pagination?', 'ThemeStockyard'),
			'desc' => __('Set to &#8220;No&#8221; if you only want to show a recent posts, with no page links', 'ThemeStockyard'),
			'options' => $alt_choices,
			'std' => 'no'
		),
		'fullwidth' => array(
			'type' => 'select',
			'label' => __( 'Fullwidth?', 'ThemeStockyard'),
			'desc' => __('Does not work with Masonry Cards layout.', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),/*
		'show_filter' => array(
			'type' => 'select',
			'label' => __( 'Show Filter Links?', 'ThemeStockyard'),
			'desc' => __('Filter links allow users to dynamically filter posts by category', 'ThemeStockyard'),
			'options' => $choices,
			'std' => 'yes'
		),
		'align_filter' => array(
			'type' => 'select',
			'label' => __( 'Align Filter Links', 'ThemeStockyard'),
			'std' => 'center',
			'options' => array(
				'left' => __('Left', 'ThemeStockyard'),
				'center' => __('Center', 'ThemeStockyard'),
				'right' => __('Right', 'ThemeStockyard'),
			)
		),
		'cat' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'ThemeStockyard'),
			'desc' => __( 'Select a category or leave blank for all', 'ThemeStockyard'),
			//'options' => ts_shortcodes_categories( 'portfolio-category' )
		),
		'include' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to include...', 'ThemeStockyard'),
			'desc' =>  __( 'Display only certain posts by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		),
		'exclude' => array(
			'type' => 'text',
			'label' => __( 'Post "IDs" to <strong>exclude</strong>...', 'ThemeStockyard'),
			'desc' =>  __( 'Prevent certain posts from displaying by listing their IDs here (separated by commas)', 'ThemeStockyard'),
		)*/
	),
	'shortcode' => '[portfolio layout="{{layout}}" limit="{{posts_per_page}}" show_pagination="{{show_pagination}}" fullwidth="{{fullwidth}}"][/portfolio]',
	'popup_title' => __( 'Portfolio Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['pricingtable'] = array(
	'no_preview' => true,
	'params' => array(

		'separate_columns' => array(
			'type' => 'select',
			'std' => 'no',
			'label' => __('Separate Columns?', 'ThemeStockyard'),
			'desc' => __('Select whether columns should be joined or separated', 'ThemeStockyard'),
			'options' => $alt_choices
		),
	),
	'shortcode' => '[pricing_table separate_columns="{{separate_columns}}"]{{child_shortcode}}[/pricing_table]',
	'popup_title' => __( 'Pricing Table Shortcode', 'ThemeStockyard'),
	
	'child_shortcode' => array(
		'params' => array(
			'featured' => array(
				'type' => 'select',
				'label' => __('Featured Column?', 'ThemeStockyard'),
				'desc' => '',
				'options' => $reverse_choices
			),
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Title', 'ThemeStockyard'),
				'desc' => __('Insert the Pricing Column title', 'ThemeStockyard'),
			),
			'subtitle' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Sub-title', 'ThemeStockyard'),
				'desc' => __('Insert the Pricing Column sub-title (optional)', 'ThemeStockyard'),
			),
			'button_text' => array(
				'type' => 'text',
				'label' => __('Button Text', 'ThemeStockyard'),
				'desc' => ''
			),
			'link' => array(
				'type' => 'text',
				'label' => __('Button Link', 'ThemeStockyard'),
				'desc' => ''
			),
			'target' => array(
				'type' => 'select',
				'label' => __('Button Link Target', 'ThemeStockyard'),
				'options' => array(
                    '_self' => __('Same window/tab', 'ThemeStockyard'),
                    '_blank' => __('New window/tab', 'ThemeStockyard'),
				)
			),
		),
		'shortcode' => '[pricing_column title="{{title}}" subtitle="{{subtitle}}" featured="{{featured}}"]&lt;br /&gt;[pricing_row strikethrough="false" bold="false" italics="false"]Feature #1[/pricing_row]&lt;br /&gt;[pricing_row strikethrough="false" bold="false" italics="false"]Feature #2[/pricing_row]&lt;br /&gt;[pricing_row strikethrough="false" bold="false" italics="false"]Feature #3[/pricing_row]&lt;br /&gt;[pricing_footer][button color="primary" url="{{link}}" target="{{target}}"]{{button_text}}[/button][/pricing_footer]&lt;br /&gt;[/pricing_column]',
		'clone_button' => __('Add Pricing Column', 'ThemeStockyard')
	),
	
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['progressbar'] = array(
	'params' => array(

		'percentage' => array(
			'type' => 'select',
			'label' => __('Filled Area Percentage', 'ThemeStockyard'),
			'desc' => __('From 1% to 100%', 'ThemeStockyard'),
			'options' => ts_shortcodes_range(100, false)
		),
		'unit' => array(
			'std' => '%',
			'type' => 'text',
			'label' => __( 'Progress Bar Unit', 'ThemeStockyard'),
			'desc' => __( 'Insert a unit for the progress bar. ex %', 'ThemeStockyard'),
		),
		'filledcolor' => array(
			'type' => 'colorpicker',
			'label' => __('Filled Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'unfilledcolor' => array(
			'type' => 'colorpicker',
			'label' => __('Unfilled Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'content' => array(
			'std' => 'Text',
			'type' => 'text',
			'label' => __( 'Progess Bar Text', 'ThemeStockyard'),
			'desc' => __( 'Text will appear within the progess bar', 'ThemeStockyard'),
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'label' => __('Text Color', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'hide_text' => array(
			'type' => 'select',
			'options' => $reverse_choices,
			'label' => __('Hide all text', 'ThemeStockyard'),
			'desc' => __('Only show the progress bar (will be thinner, since no text is present)', 'ThemeStockyard')
		)
	),
	'shortcode' => '[progressbar percentage="{{percentage}}" unit="{{unit}}" filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}" textcolor="{{textcolor}}" hide_text="{{hide_text}}"]{{content}}[/progressbar]',
	'popup_title' => __('Progress Bar Shortcode', 'ThemeStockyard'),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Section Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['section'] = array(
	'no_preview' => true,
	'params' => array(

		'padding_top' => array(
			'std' => '0',
			'type' => 'select',
			'label' => __('Padding Top', 'ThemeStockyard'),
			'options' => ts_shortcodes_range(200, false, false, 0)
		),
		'padding_bottom' => array(
			'std' => '0',
			'type' => 'select',
			'label' => __('Padding Bottom', 'ThemeStockyard'),
			'options' => ts_shortcodes_range(200, false, false, 0)
		),
		'border_width' => array(
            'std' => '1',
            'type' => 'select',
            'label' => __('Border Width', 'ThemeStockyard'),
            'options' => ts_shortcodes_range(10, false, false, 0)
		),
		'border_color' => array(
			'type' => 'colorpicker',
			'label' => __('Border Color', 'ThemeStockyard'),
			'desc' => __('Leave blank for default', 'ThemeStockyard')
		),
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __('Background Color', 'ThemeStockyard')
		),
		'background_image' => array(
            'type' => 'uploader',
            'label' => __('Background Image', 'ThemeStockyard')
		),
		'background_repeat' => array(
            'std' => '0',
            'type' => 'select',
            'label' => __('Background Image Repeat', 'ThemeStockyard'),
            'options' => array(
                'no-repeat' => __('No repeat', 'ThemeStockyard'),
                'repeat' => __('Repeat', 'ThemeStockyard'),
                'repeat-x' => __('Repeat on X-axis (repeat-x)', 'ThemeStockyard'),
                'repeat-y' => __('Repeat on Y-axis (repeat-y)', 'ThemeStockyard')
            )
		),
		'content' => array(
			'std' => __('Content', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __('Content', 'ThemeStockyard'),
			'use_selection' => true
		),
	),
	'shortcode' => '[section padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}" border_color="{{border_color}}" border_width="{{border_width}}" background_color="{{background_color}}" background_image="{{background_image}}" background_repeat="{{background_repeat}}"]&lt;br /&gt;{{content}}&lt;br /&gt;[/section]',
	'popup_title' => __('Section Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Show if Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['show_if'] = array(
	'no_preview' => true,
	'params' => array(

		'user_is' => array(
			'type' => 'select',
			'label' => __( 'Show if: user is...', 'ThemeStockyard'),
			'desc' => '',
			'options' => array(
				'' => __('logged in OR logged out', 'ThemeStockyard'),
				'logged in' => __('logged in', 'ThemeStockyard'),
				'logged out' => __('logged out', 'ThemeStockyard'),
			)
		),
		'pagination_page_is' => array(
			'type' => 'text',
			'label' => __( 'Show if: pagination page is...', 'ThemeStockyard'),
			'desc' => __('Example(s): 1, 3, 5-7, 10+, -14', 'ThemeStockyard'),
		),
		'content' => array(
			'std' => __('Content goes here', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Content', 'ThemeStockyard'),
			'desc' => __( 'Content to show/hide', 'ThemeStockyard'),
			'use_selection' => true
		)
	),
	'shortcode' => '[show_if user_is="{{user_is}}" pagination_page_is="{{pagination_page_is}}"]{{content}}[/show_if]',
	'popup_title' => __( '&#8220;Show if&#8221; Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Hide if Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['hide_if'] = array(
	'no_preview' => true,
	'params' => array(

		'user_is' => array(
			'type' => 'select',
			'label' => __( 'Hide if: user is...', 'ThemeStockyard'),
			'desc' => '',
			'options' => array(
				'' => __('logged in OR logged out', 'ThemeStockyard'),
				'logged in' => __('logged in', 'ThemeStockyard'),
				'logged out' => __('logged out', 'ThemeStockyard'),
			)
		),
		'pagination_page_is' => array(
			'type' => 'text',
			'label' => __( 'Hide if: pagination page is...', 'ThemeStockyard'),
			'desc' => __('Example(s): 1, 3, 5-7, 10+, -14', 'ThemeStockyard'),
		),
		'content' => array(
			'std' => __('Content goes here', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Content', 'ThemeStockyard'),
			'desc' => __( 'Content to show/hide', 'ThemeStockyard'),
			'use_selection' => true
		)
	),
	'shortcode' => '[hide_if user_is="{{user_is}}" pagination_page_is="{{pagination_page_is}}"]{{content}}[/hide_if]',
	'popup_title' => __( '&#8220;Hide if&#8221; Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Small Text Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['small'] = array(
	'no_preview' => true,
	'params' => array(

		'content' => array(
			'std' => __('Text Goes Here', 'ThemeStockyard'),
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'ThemeStockyard'),
			'desc' => __( 'Insert the alert text', 'ThemeStockyard'),
			'use_selection' => true
		)
	),
	'shortcode' => '[small]{{content}}[/small]',
	'popup_title' => __( 'Small Text Shortcode', 'ThemeStockyard')
);


/*-----------------------------------------------------------------------------------*/
/*	Slider Gallery Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['slider_gallery'] = array(
    'params' => array(
		'crop' => array(
			'type' => 'select',
			'label' => __('Crop Images', 'ThemeStockyard'),
			'desc' => __('Crop images for uniform height or leave uncropped.', 'ThemeStockyard'),
			'options' => $choices
		)
    ),
	'shortcode' => '[slider_gallery crop="{{crop}}"]{{child_shortcode}}[/slider_gallery]',
	'popup_title' => __('Slider Gallery Shortcode', 'ThemeStockyard'),
	'no_preview' => true,

	'child_shortcode' => array(
		'params' => array(
            'video_url' => array(
				'type' => 'text',
				'label' => __('Video URL', 'ThemeStockyard'),
				'desc' => __('Example: https://vimeo.com/119167199', 'ThemeStockyard')
			),
			'info' => array(
				'type' => 'info',
				'label' => __('Note', 'ThemeStockyard'),
				'desc' => __('If using a video, the following fields are not needed.', 'ThemeStockyard')
			),
			'src' => array(
				'type' => 'uploader',
				'label' => __('Image', 'ThemeStockyard'),
				'desc' => __('Upload an image', 'ThemeStockyard')
			),
			'url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Image Website Link', 'ThemeStockyard'),
				'desc' => __('If you want the image to link to a URL, add it here.', 'ThemeStockyard')
			),
			'target' => array(
				'type' => 'select',
				'label' => __('Link Target', 'ThemeStockyard'),
				'options' => array(
					'_self' => __('Same window/tab', 'ThemeStockyard'),
					'_blank' => __('New window/tab', 'ThemeStockyard')
				)
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Image Alt Text', 'ThemeStockyard'),
				'desc' => __('The alt attribute provides alternative information if an image cannot be loaded.', 'ThemeStockyard')
			)
		),
		'shortcode' => '[image video_url="{{video_url}}" url="{{url}}" target="{{target}}" src="{{src}}" alt="{{alt}}"]',
		'clone_button' => __('Add New Image', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Social Links Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['social_links'] = array(
	'no_preview' => true,
	'params' => array(

		'size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Size', 'ThemeStockyard'),
			'desc' => __('&#8220;Large&#8221; or &#8220;Small&#8221; for image icons, pixels for FontAwesome icons (eg. 16px)', 'ThemeStockyard')
		),
        'target' => array(
            'type' => 'select',
            'label' => __('Link Target', 'ThemeStockyard'),
            'options' => array(
                '_self' => __('Same window/tab', 'ThemeStockyard'),
                '_blank' => __('New window/tab', 'ThemeStockyard'),
            )
        ),
		'color' => array(
			'std' => '',
			'type' => 'colorpicker',
			'label' => __('Icon Color', 'ThemeStockyard'),
			'desc' => __('Note: only used with &#8220;FontAwesome&#8221; icons', 'ThemeStockyard'),
			'options' => ts_color_options()
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('RSS Link', 'ThemeStockyard'),
		),
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Facebook Link', 'ThemeStockyard'),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Twitter Link', 'ThemeStockyard'),
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Dribbble Link', 'ThemeStockyard'),
		),
		'googleplus' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Google+ Link', 'ThemeStockyard'),
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('LinkedIn Link', 'ThemeStockyard'),
		),
		'blogger' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Blogger Link', 'ThemeStockyard'),
			'desc' => __('Note: only works with &#8220;Image&#8221; icons', 'ThemeStockyard')
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Tumblr Link', 'ThemeStockyard'),
		),
		'reddit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Reddit Link', 'ThemeStockyard'),
			'desc' => __('Note: only works with &#8220;Image&#8221; icons', 'ThemeStockyard')
		),
		'deviantart' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Deviantart Link', 'ThemeStockyard'),
			'desc' => __('Note: only works with &#8220;Image&#8221; icons', 'ThemeStockyard')
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Vimeo Link', 'ThemeStockyard'),
			'desc' => __('Note: only works with &#8220;Image&#8221; icons', 'ThemeStockyard')
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Youtube Link', 'ThemeStockyard'),
			'desc' => ''
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Pinterest Link', 'ThemeStockyard'),
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Flickr Link', 'ThemeStockyard'),
		),
		'forrst' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Forrst Link', 'ThemeStockyard'),
			'desc' => __('Note: only works with &#8220;Image&#8221; icons', 'ThemeStockyard')
		),
		'myspace' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Myspace Link', 'ThemeStockyard'),
			'desc' => __('Note: only works with &#8220;Image&#8221; icons', 'ThemeStockyard')
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Skype Link', 'ThemeStockyard'),
		),
	),
	'shortcode' => '[social_links size="{{size}}" color="{{color}}" linktarget="{{target}}" rss="{{rss}}" facebook="{{facebook}}" twitter="{{twitter}}" dribbble="{{dribbble}}" googleplus="{{googleplus}}" linkedin="{{linkedin}}" blogger="{{blogger}}" tumblr="{{tumblr}}" reddit="{{reddit}}" deviantart="{{deviantart}}" vimeo="{{vimeo}}" youtube="{{youtube}}" pinterest="{{pinterest}}" flickr="{{flickr}}" forrst="{{forrst}}" myspace="{{myspace}}" skype="{{skype}}"]',
	'popup_title' => __( 'Social Links Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	SoundCloud Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['soundcloud'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('SoundCloud Url', 'ThemeStockyard'),
			'desc' => __('The SoundCloud url', 'ThemeStockyard')
		),
		'comments' => array(
			'type' => 'select',
			'label' => __('Show Comments', 'ThemeStockyard'),
			'desc' => __('Choose to display comments', 'ThemeStockyard'),
			'options' => $choices
		),
		'auto_play' => array(
			'type' => 'select',
			'label' => __('Autoplay', 'ThemeStockyard'),
			'desc' => __('Choose to autoplay the track', 'ThemeStockyard'),
			'options' => $reverse_choices
		),
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color', 'ThemeStockyard'),
			'desc' => __('Select the color of the shortcode', 'ThemeStockyard')
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __('Width', 'ThemeStockyard'),
			'desc' => __('In pixels (px) or percentage (%)', 'ThemeStockyard')
		),
		'height' => array(
			'std' => '81px',
			'type' => 'text',
			'label' => __('Height', 'ThemeStockyard'),
			'desc' => __('In pixels (px)', 'ThemeStockyard')
		),
	),
	'shortcode' => '[soundcloud url="{{url}}" comments="{{comments}}" auto_play="{{auto_play}}" color="{{color}}" width="{{width}}" height="{{height}}"]',
	'popup_title' => __( 'Sharing Box Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Table Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['table'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __('Type', 'ThemeStockyard'),
			'desc' => __('Select the table style', 'ThemeStockyard'),
			'options' => array(
				'1' => __('Style 1', 'ThemeStockyard'),
				'2' => __('Style 2', 'ThemeStockyard'),
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __('Number of Columns', 'ThemeStockyard'),
			'desc' => __('Select how many columns to display', 'ThemeStockyard'),
			'options' => array(
				'1' => __('1 Column', 'ThemeStockyard'),
				'2' => __('2 Columns', 'ThemeStockyard'),
				'3' => __('3 Columns', 'ThemeStockyard'),
				'4' => __('4 Columns', 'ThemeStockyard')
			)
		)
	),
	'shortcode' => '',
	'popup_title' => __( 'Table Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['tabs'] = array(
	'params' => array(

		
		'layout' => array(
			'type' => 'select',
			'label' => __('Layout', 'ThemeStockyard'),
			'desc' => __('Choose between &#8220;Horizontal&#8221; and &#8220;Vertical&#8221; tabs', 'ThemeStockyard'),
			'options' => array(
				'horizontal' => __('Horizontal', 'ThemeStockyard'),
				'vertical-left' => __('Vertical (tabs to the left)', 'ThemeStockyard'),
				'vertical-right' => __('Vertical (tabs to the right)', 'ThemeStockyard')
			)
		),
	),
	'no_preview' => true,
	'shortcode' => '[tabs layout="{{layout}}"]&lt;br /&gt;{{child_shortcode}}&lt;br /&gt;[/tabs]',
	'popup_title' => __('Insert Tab Shortcode', 'ThemeStockyard'),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'ThemeStockyard'),
				'type' => 'text',
				'label' => __('Tab Title', 'ThemeStockyard'),
				'desc' => __('Title of the tab', 'ThemeStockyard'),
			),
			'icon' => array(
				'std' => '',
				'type' => 'iconpicker',
				'label' => __('Icon', 'ThemeStockyard'),
				'desc' => __('Icon to accompany the tab title', 'ThemeStockyard'),
				'options' => $icons,
			),
			'content' => array(
				'std' => __('Tab Content', 'ThemeStockyard'),
				'type' => 'textarea',
				'label' => __('Tab Content', 'ThemeStockyard'),
				'desc' => __('Add the tab content', 'ThemeStockyard')
			)
		),
		'shortcode' => '[tab title="{{title}}" icon="{{icon}}"]{{content}}[/tab]',
		'clone_button' => __('Add Tab', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['testimonials'] = array(
	'params' => array(

		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'ThemeStockyard'),
			'desc' => __('Leave blank for default', 'ThemeStockyard')
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Text Color', 'ThemeStockyard'),
			'desc' => __('Leave blank for default', 'ThemeStockyard')
		),
	),
	'no_preview' => true,
	'shortcode' => '[testimonials backgroundcolor="{{backgroundcolor}}" textcolor="{{textcolor}}"]{{child_shortcode}}[/testimonials]',
	'popup_title' => __('Insert Testimonials Shortcode', 'ThemeStockyard'),

	'child_shortcode' => array(
		'params' => array(
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Name', 'ThemeStockyard'),
				'desc' => __('Insert the name of the person', 'ThemeStockyard'),
			),
			'gender' => array(
				'type' => 'select',
				'label' => __('Gender', 'ThemeStockyard'),
				'desc' => __('Choose male or female', 'ThemeStockyard'),
				'options' => array(
					'male' => __('Male', 'ThemeStockyard'),
					'female' => __('Female', 'ThemeStockyard')
				)
			),
			'company' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Company', 'ThemeStockyard'),
				'desc' => __('Insert the name of the company', 'ThemeStockyard'),
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Link', 'ThemeStockyard'),
				'desc' => __('Add the url the company name will link to', 'ThemeStockyard')
			),
			'target' => array(
				'type' => 'select',
				'label' => __('Link Target', 'ThemeStockyard'),
				'options' => array(
					'_self' => __('Same window/tab', 'ThemeStockyard'),
					'_blank' => __('New window/tab', 'ThemeStockyard')
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Testimonial Content', 'ThemeStockyard'),
				'desc' => __('Add the testimonial content', 'ThemeStockyard')
			)
		),
		'shortcode' => '[testimonial name="{{name}}" gender="{{gender}}" company="{{company}}" link="{{link}}" target="{{target}}"]{{content}}[/testimonial]',
		'clone_button' => __('Add Testimonial', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Title Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['title'] = array(
	'no_preview' => true,
	'params' => array(

		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Title', 'ThemeStockyard'),
			'desc' => __('Insert the title text', 'ThemeStockyard'),
			'use_selection' => true
		),
		'size' => array(
			'type' => 'text',
			'label' => __('Title Size', 'ThemeStockyard'),
			'desc' => __('Examples: H1, H2, H3, H4, H5, H6... or enter any font size (ex: 12px)', 'ThemeStockyard')
		),
		'bold' => array(
			'type' => 'select',
			'label' => __('Bold text?', 'ThemeStockyard'),
			'desc' => '',
			'options' => $reverse_choices
		),
		'align' => array(
			'type' => 'select',
			'label' => __( 'Align Text', 'ThemeStockyard'),
			'options' => $align_options,
			'std' => ''
		),
		'color' => array(
            'type' => 'colorpicker',
            'label' => __('Color', 'ThemeStockyard'),
            'desc' => __('Leave blank for default', 'ThemeStockyard'),
            'options' => ts_color_options()
        ),
		'style' => array(
			'std' => '',
			'type' => 'select',
			'label' => __('Border Style', 'ThemeStockyard'),
			'options' => array(
                '' => __('(no border)', 'ThemeStockyard'),
                'underline-full' => __('Underline (full)', 'ThemeStockyard'),
                'underline-text' => __('Underline (text width)', 'ThemeStockyard'),
                'single' => __('Single Line-through', 'ThemeStockyard'),
                'dashed' => __('Dashed Line-through', 'ThemeStockyard'),
                'double' => __('Double Line-through', 'ThemeStockyard'),
                'double-dashed' => __('Double Dashed Line-through', 'ThemeStockyard'),
			)
		),
		'border_color' => array(
            'type' => 'colorpicker',
            'label' => __('Border Color', 'ThemeStockyard'),
            'desc' => __('Leave blank for default', 'ThemeStockyard'),
            'options' => ts_color_options()
        ),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Padding Top', 'ThemeStockyard'),
			'desc' => __('ex: 20px', 'ThemeStockyard')
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Padding Bottom', 'ThemeStockyard'),
			'desc' => __('ex: 20px', 'ThemeStockyard')
		),
	),
	'shortcode' => '[title size="{{size}}" bold="{{bold}}" align="{{align}}" color="{{color}}" style="{{style}}" border_color="{{border_color}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}"]{{content}}[/title]',
	'popup_title' => __( 'Title Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Toggles
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['toggles'] = array(
	'params' => array(

		'open_icon' => array(
			'type' => 'iconpicker',
			'label' => __('Open Icon', 'ThemeStockyard'),
			'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
			'options' => $icons,
			'std' => '',
		),
		'closed_icon' => array(
			'type' => 'iconpicker',
			'label' => __('Closed Icon', 'ThemeStockyard'),
			'desc' => __('Click an icon to select, click again to unselect', 'ThemeStockyard'),
			'options' => $icons,
			'std' => '',
		),
	),
	'no_preview' => true,
	'shortcode' => '[toggles open_icon="{{open_icon}}" closed_icon="{{closed_icon}}"]&lt;br /&gt;{{child_shortcode}}&lt;br /&gt;[/toggles]',
	'popup_title' => __('Insert Accordion Shortcode', 'ThemeStockyard'),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'ThemeStockyard'),
				'type' => 'text',
				'label' => __('Toggle Title', 'ThemeStockyard'),
				'desc' => __('Title of the toggle', 'ThemeStockyard'),
			),
			'content' => array(
				'std' => 'Toggle Content',
				'type' => 'textarea',
				'label' => __('Toggle Content', 'ThemeStockyard'),
				'desc' => __('Add the toggle content', 'ThemeStockyard')
			),
			'open' => array(
				'std' => 'no',
				'type' => 'select',
				'label' => __('Initially Open?', 'ThemeStockyard'),
				'options' => $alt_choices,
			)
		),
		'shortcode' => '[toggle title="{{title}}" open="{{open}}"]{{content}}[/toggle]',
		'clone_button' => __('Add Toggle Option', 'ThemeStockyard')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Video URL/ID', 'ThemeStockyard'),
			'desc' => ''
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'ThemeStockyard'),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'ThemeStockyard'),
			'options' => $reverse_choices
		),
	),
	'shortcode' => '[vimeo url="{{url}}" autoplay="{{autoplay}}"]',
	'popup_title' => __( 'Vimeo Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Vine Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['vine'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Video URL/ID', 'ThemeStockyard'),
			'desc' => ''
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'ThemeStockyard'),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'ThemeStockyard'),
			'options' => $reverse_choices
		),
	),
	'shortcode' => '[vine url="{{url}}" autoplay="{{autoplay}}"]',
	'popup_title' => __( 'Vine Shortcode', 'ThemeStockyard')
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube Config
/*-----------------------------------------------------------------------------------*/

$ts_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Video URL/ID', 'ThemeStockyard'),
			'desc' => ''
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'ThemeStockyard'),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'ThemeStockyard'),
			'options' => $reverse_choices
		),

	),
	'shortcode' => '[youtube url="{{url}}" autoplay="{{autoplay}}"]',
	'popup_title' => __( 'Youtube Shortcode', 'ThemeStockyard')
);