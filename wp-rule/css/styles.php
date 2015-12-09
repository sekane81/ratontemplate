<?php

	/* Welcome Block */
	if ( isset( $ct_options['ct_welcome_background'] ) ) $welcome_background = stripslashes ( $ct_options['ct_welcome_background'] );
	if ( isset( $ct_options['ct_welcome_opacity'] ) ) $welcome_opacity = stripslashes ( $ct_options['ct_welcome_opacity'] );
	if ( isset( $ct_options['ct_welcome_text_transform'] ) ) $welcome_transform = stripslashes ( $ct_options['ct_welcome_text_transform'] );
	if ( isset( $ct_options['ct_welcome_text_font'] ) ) $welcome_text_font = $ct_options['ct_welcome_text_font'];
	if ( isset( $ct_options['ct_welcome_text_align'] ) ) $welcome_text_align = stripslashes ( $ct_options['ct_welcome_text_align'] );
	if ( isset( $ct_options['ct_welcome_links_color'] ) ) $welcome_links_color = stripslashes ( $ct_options['ct_welcome_links_color'] );
	if ( isset( $ct_options['ct_welcome_padding'] ) ) $welcome_padding = stripslashes ( $ct_options['ct_welcome_padding'] );

	/* Menu */
	if ( isset( $ct_options['ct_menu_position'] ) ) $menu_position = stripslashes ( $ct_options['ct_menu_position'] );
	if ( isset( $ct_options['ct_menu_background'] ) ) $menu_background = stripslashes ( $ct_options['ct_menu_background'] );
	if ( isset( $ct_options['ct_menu_opacity'] ) ) $menu_opacity = $ct_options['ct_menu_opacity'];	
	if ( isset( $ct_options['ct_dd_menu_background'] ) ) $dd_menu_background = $ct_options['ct_dd_menu_background'];
	if ( isset( $ct_options['ct_dd_menu_hover_background'] ) ) $dd_menu_hover_background = $ct_options['ct_dd_menu_hover_background'];
	if ( isset( $ct_options['ct_dd_menu_opacity'] ) ) $dd_menu_opacity = $ct_options['ct_dd_menu_opacity'];	
	if ( isset( $ct_options['ct_menu_border'] ) ) $menu_border = $ct_options['ct_menu_border'];
	if ( isset( $ct_options['ct_menu_font'] ) ) $menu_font = $ct_options['ct_menu_font'];
	if ( isset( $ct_options['ct_menu_transform'] ) ) $menu_transform = strtolower( $ct_options['ct_menu_transform'] );


	/* Show Featured Image */
	if ( isset( $ct_options['ct_featured_image_post'] ) ) $featured_image_post = $ct_options['ct_featured_image_post'];

	/* Responsive Layout */
	if ( isset( $ct_options['ct_responsive_layout'] ) ) $responsive_layout = $ct_options['ct_responsive_layout'];

	/* Stretch thumbnail post images */
	if ( isset( $ct_options['ct_thumb_posts_stretch'] ) ) $thumb_posts_stretch = $ct_options['ct_thumb_posts_stretch'];

	/* Links Color */
	if ( isset( $ct_options['ct_links_color'] ) ) $links_color = stripslashes ( $ct_options['ct_links_color'] );

	/* Blog meta */
	if ( isset( $ct_options['ct_meta_color'] ) ) $meta_color = stripslashes ( $ct_options['ct_meta_color'] );

	/* Pagination */
	if ( isset( $ct_options['ct_pagination_background'] ) ) $pagination_background = stripslashes ( $ct_options['ct_pagination_background'] );
	if ( isset( $ct_options['ct_pagination_border'] ) ) $pagination_border = $ct_options['ct_pagination_border'];	

	/* Body background Color */
	if ( isset( $ct_options['ct_body_background'] ) ) $body_background = stripslashes ( $ct_options['ct_body_background'] );

	/* Footer */
	if ( isset( $ct_options['ct_footer_background'] ) ) $footer_background = stripslashes ( $ct_options['ct_footer_background'] );
	if ( isset( $ct_options['ct_footer_opacity'] ) ) $footer_opacity = stripslashes ( $ct_options['ct_footer_opacity'] );
	if ( isset( $ct_options['ct_footer_font'] ) ) $footer_font = $ct_options['ct_footer_font'];

	/* Post format */
	if ( isset( $ct_options['ct_postformat_meta'] ) ) $postformat_meta = stripslashes ( $ct_options['ct_postformat_meta'] );

	/* Headings Options: Size, Style, Color */
	if ( isset( $ct_options['ct_h_one'] ) ) $h_one = $ct_options['ct_h_one'];
	if ( isset( $ct_options['ct_h_two'] ) ) $h_two = $ct_options['ct_h_two'];
	if ( isset( $ct_options['ct_h_three'] ) ) $h_three = $ct_options['ct_h_three'];
	if ( isset( $ct_options['ct_h_four'] ) ) $h_four = $ct_options['ct_h_four'];
	if ( isset( $ct_options['ct_h_five'] ) ) $h_five = $ct_options['ct_h_five'];
	if ( isset( $ct_options['ct_h_six'] ) ) $h_six = $ct_options['ct_h_six'];
	if ( isset( $ct_options['ct_post_title_font'] ) ) $post_title_font = $ct_options['ct_post_title_font'];
	if ( isset( $ct_options['ct_post_title_transform'] ) ) $post_title_transform = strtolower( $ct_options['ct_post_title_transform'] );

	/* Homepage Columns */
	if ( isset( $ct_options['ct_homepage_columns'] ) ) $homepage_columns = stripslashes( $ct_options['ct_homepage_columns'] );
	/* Category page Columns */
	if ( isset( $ct_options['ct_categorypage_columns'] ) ) $categorypage_columns = stripslashes( $ct_options['ct_categorypage_columns'] );

	if ( isset( $ct_options['ct_pagination_type'] ) ) $pagination_type = stripslashes( $ct_options['ct_pagination_type'] );
	
	/* Sidebar */
	if ( isset( $ct_options['ct_sidebar_opacity'] ) ) $sidebar_opacity = stripslashes ( $ct_options['ct_sidebar_opacity'] );
	if ( isset( $ct_options['ct_widget_top_border'] ) ) $widget_top_border = $ct_options['ct_widget_top_border'];
	if ( isset( $ct_options['ct_widget_bottom_border'] ) ) $widget_bottom_border = $ct_options['ct_widget_bottom_border'];
	if ( isset( $ct_options['ct_widget_margin_bottom'] ) ) $widget_margin_bottom = stripslashes ( $ct_options['ct_widget_margin_bottom'] );
	if ( isset( $ct_options['ct_sidebar_text_color'] ) ) $sidebar_text_color = stripslashes ( $ct_options['ct_sidebar_text_color'] );
	if ( isset( $ct_options['ct_widget_title_border'] ) ) $widget_title_border = $ct_options['ct_widget_title_border'];
	if ( isset( $ct_options['ct_widget_title_font'] ) ) $widget_title_font = $ct_options['ct_widget_title_font'];
	if ( isset( $ct_options['ct_widget_background'] ) ) $widget_background = $ct_options['ct_widget_background'];

	/* Page Title Bar */
	if ( isset( $ct_options['ct_page_bar_opacity'] ) ) $page_bar_opacity = stripslashes ( $ct_options['ct_page_bar_opacity'] );
	if ( isset( $ct_options['ct_page_bar_top_border'] ) ) $page_bar_top_border = $ct_options['ct_page_bar_top_border'];
	if ( isset( $ct_options['ct_page_bar_bottom_border'] ) ) $page_bar_bottom_border = $ct_options['ct_page_bar_bottom_border'];
	if ( isset( $ct_options['ct_page_bar_background'] ) ) $page_bar_background = $ct_options['ct_page_bar_background'];
?>

.pagination a { 
	background: <?php echo $pagination_background; ?>;
	opacity: .7;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
	filter: alpha(opacity=70);
}
.pagination .current, .pagination a { 
	border-top: <?php echo $pagination_background['width'] . 'px'; ?> <?php echo $pagination_background['style']; ?> <?php echo $pagination_background['color']; ?>;
	border-bottom: <?php echo $pagination_background['width'] . 'px'; ?> <?php echo $pagination_background['style']; ?> <?php echo $pagination_background['color']; ?>;
}

/* Page Title Bar */
<?php if ( empty( $page_bar_opacity ) ) $page_bar_opacity = 0.7; ?>
<?php
	// convert hex color too rgb
	$rgb = ct_hex2rgb($page_bar_background);
	$rgba = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . ", " . $page_bar_opacity . ")";
?>
.page-title-bar {
	background: <?php echo $rgba; ?>;
	border-top: <?php echo $page_bar_top_border['width'] . 'px'; ?> <?php echo $page_bar_top_border['style']; ?> <?php echo $page_bar_top_border['color']; ?>;
	border-bottom: <?php echo $page_bar_bottom_border['width'] . 'px'; ?> <?php echo $page_bar_bottom_border['style']; ?> <?php echo $page_bar_bottom_border['color']; ?>;
}

/* Sidebar */
<?php if ( empty( $sidebar_opacity ) ) $sidebar_opacity = 0.7; ?>
<?php
	// convert hex color too rgb
	$rgb = ct_hex2rgb($widget_background);
	$rgba = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . ", " . $sidebar_opacity . ")";
?>

.widget {
	background: <?php echo $rgba; ?>;
	border-top: <?php echo $widget_top_border['width'] . 'px'; ?> <?php echo $widget_top_border['style']; ?> <?php echo $widget_top_border['color']; ?>;
	border-bottom: <?php echo $widget_bottom_border['width'] . 'px'; ?> <?php echo $widget_bottom_border['style']; ?> <?php echo $widget_bottom_border['color']; ?>;
	margin-bottom: <?php echo $widget_margin_bottom . 'px'; ?>;
}

.entry-single-meta {
	background: <?php echo $rgba; ?>;
	border-top: <?php echo $widget_top_border['width'] . 'px'; ?> <?php echo $widget_top_border['style']; ?> <?php echo $widget_top_border['color']; ?>;
	border-bottom: <?php echo $widget_bottom_border['width'] . 'px'; ?> <?php echo $widget_bottom_border['style']; ?> <?php echo $widget_bottom_border['color']; ?>;
}

.sidebar { color: <?php echo $sidebar_text_color; ?>; }

.widget-title {
	border-left: <?php echo $widget_title_border['width'] . 'px'; ?> <?php echo $widget_title_border['style']; ?> <?php echo $widget_title_border['color']; ?>;

	font-size: <?php echo $widget_title_font['size']; ?>;
	line-height: <?php echo $widget_title_font['height']; ?>;
	color: <?php echo $widget_title_font['color']; ?>;
	<?php if( $widget_title_font['style'] == 'normal' || $widget_title_font['style'] == 'italic' ) { ?>
		font-style: <?php echo $widget_title_font['style']; ?>;
		font-weight: normal;
	<?php } ?>		
	<?php if( $widget_title_font['style'] == 'bold' ) { ?>
		font-weight: <?php echo $widget_title_font['style']; ?>;
	<?php } ?>
	<?php if( $widget_title_font['style'] == 'bold italic' ) { ?>
		font-weight: bold;
		font-style: italic;
	<?php } ?>	
}

/* Welcome Block */
<?php if ( empty( $welcome_opacity ) ) $welcome_opacity = 0.5; ?>
#welcome-block > .transparent-bg {
	background-color: <?php echo $welcome_background; ?>;
	opacity: <?php echo $welcome_opacity; ?>;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $welcome_opacity*100; ?>)";
	filter: alpha(opacity=<?php echo $welcome_opacity*100; ?>);	
}
#welcome-block a, 
#welcome-block h1 a, 
#welcome-block h2 a, 
#welcome-block h3 a, 
#welcome-block h4 a, 
#welcome-block h5 a, 
#welcome-block h6 a {
	color: <?php echo $welcome_links_color; ?>;
	border-bottom: 2px solid <?php echo $welcome_links_color; ?>;
}

#welcome-block h1, 
#welcome-block h2, 
#welcome-block h3, 
#welcome-block h4, 
#welcome-block h5, 
#welcome-block h6, 
#welcome-block {
	text-transform: <?php echo $welcome_transform; ?>;
	font-size: <?php echo $welcome_text_font['size']; ?>;
	line-height: <?php echo $welcome_text_font['height']; ?>;
	color: <?php echo $welcome_text_font['color']; ?>;
	text-align: <?php echo strtolower( $welcome_text_align ); ?>;
	<?php if( $welcome_text_font['style'] == 'normal' || $welcome_text_font['style'] == 'italic' ) { ?>
		font-style: <?php echo $welcome_text_font['style']; ?>;
		font-weight: normal;
	<?php } ?>		
	<?php if( $welcome_text_font['style'] == 'bold' ) { ?>
		font-weight: <?php echo $welcome_text_font['style']; ?>;
	<?php } ?>
	<?php if( $welcome_text_font['style'] == 'bold italic' ) { ?>
		font-weight: bold;
		font-style: italic;
	<?php } ?>
	<?php if ( $welcome_padding == 1 ) { ?>
		margin-bottom: 0;
	<?php } ?>	
}

/* Menu */
#mainmenu-block-bg {
	text-align: <?php echo $menu_position; ?>;
	border-top: <?php echo $menu_border['width']; ?>px <?php echo $menu_border['style']; ?> <?php echo $menu_border['color']; ?>;
	border-bottom: <?php echo $menu_border['width']; ?>px <?php echo $menu_border['style']; ?> <?php echo $menu_border['color']; ?>;
}

#mainmenu-block-bg > .transparent-bg { background-color: <?php echo $menu_background; ?>; }

<?php if ( empty( $menu_opacity ) ) $menu_opacity = 0.5; ?>
#mainmenu-block-bg > .transparent-bg { 
	opacity: <?php echo $menu_opacity; ?>;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $menu_opacity*100; ?>)";
	filter: alpha(opacity=<?php echo $menu_opacity*100; ?>);	
}

.sf-menu a {
	text-transform: <?php echo $menu_transform; ?>;
	font-size: <?php echo $menu_font['size']; ?>;
	color: <?php echo $menu_font['color']; ?> !important;
	<?php if( $menu_font['style'] == 'normal' || $menu_font['style'] == 'italic' ) { ?>
		font-style: <?php echo $menu_font['style']; ?>;
		font-weight: normal;
	<?php } ?>		
	<?php if( $menu_font['style'] == 'bold' ) { ?>
		font-weight: <?php echo $menu_font['style']; ?>;
	<?php } ?>
	<?php if( $menu_font['style'] == 'bold italic' ) { ?>
		font-weight: bold;
		font-style: italic;
	<?php } ?>
}
.current-menu-item > a, .current-menu-ancestor > a, .current-post-ancestor > a { color: <?php echo $links_color; ?> !important; }

<?php
	// convert hex color too rgb
	$rgb = ct_hex2rgb($dd_menu_background);
	$rgba = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . ", " . $dd_menu_opacity . ")";
?>
.sf-menu > li > ul, .sf-menu ul li ul, .sf-menu ul li {
	background: <?php echo $dd_menu_background; ?>;
	background: <?php echo $rgba; ?>;
}
.sf-menu ul > li:hover { background: <?php echo $dd_menu_hover_background; ?>; }


/* Body background Color */
body { background: <?php echo $body_background; ?>; }

/* Post format */
<?php if ( !$postformat_meta ) { ?>
#blog-entry .entry-title { padding-right: 20px; }
<?php } ?>

/* Homepage Columns */
.post-block {
	<?php if ($homepage_columns == '3 Columns') echo 'width: 366px'; ?>
	<?php if ($homepage_columns == '4 Columns') echo 'width: 277px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	<?php if ($homepage_columns == '5 Columns') echo 'width: 218px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	
	<?php if ($homepage_columns == '1 Column + Sidebar') echo 'width: 770px; margin-right: 0; margin-bottom: 30px;'; ?>	
	<?php if ($homepage_columns == '2 Columns + Sidebar') echo 'width: 366px;margin-right: 35px; margin-bottom: 35px;'; ?>
	<?php if ($homepage_columns == '3 Columns + Sidebar') echo 'width: 243px; margin-right: 20px; margin-bottom: 20px;'; ?>			
}


/* Category page Columns */
.archive .post-block {
	<?php if ($categorypage_columns == '3 Columns') echo 'width: 366px; margin-right: 35px; margin-bottom: 35px;'; ?>
	<?php if ($categorypage_columns == '4 Columns') echo 'width: 277px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	<?php if ($categorypage_columns == '5 Columns') echo 'width: 218px; margin-right: 20px; margin-bottom: 20px;'; ?>	

	<?php if ($categorypage_columns == '1 Column + Sidebar') echo 'width: 770px; margin-right: 0; margin-bottom: 30px;'; ?>
	<?php if ($categorypage_columns == '2 Columns + Sidebar') echo 'width: 366px;margin-right: 35px; margin-bottom: 35px;'; ?>		
	<?php if ($categorypage_columns == '3 Columns + Sidebar') echo 'width: 243px; margin-right: 20px; margin-bottom: 20px;'; ?>			
}

.search-results .post-block {
	<?php if ($categorypage_columns == '3 Columns') echo 'width: 366px; margin-right: 35px; margin-bottom: 35px;'; ?>
	<?php if ($categorypage_columns == '4 Columns') echo 'width: 277px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	<?php if ($categorypage_columns == '5 Columns') echo 'width: 218px; margin-right: 20px; margin-bottom: 20px;'; ?>	

	<?php if ($categorypage_columns == '1 Column + Sidebar') echo 'width: 770px; margin-right: 0; margin-bottom: 30px;'; ?>
	<?php if ($categorypage_columns == '2 Columns + Sidebar') echo 'width: 366px;margin-right: 35px; margin-bottom: 35px;'; ?>		
	<?php if ($categorypage_columns == '3 Columns + Sidebar') echo 'width: 243px; margin-right: 20px; margin-bottom: 20px;'; ?>			
}



#blog-entry {
	<?php if ($homepage_columns == '1 Column + Sidebar') echo 'margin-right: 0;'; ?>
}

<?php if ($categorypage_columns == '1 Column + Sidebar') : ?>
.archive #blog-entry {
	margin-right: 0;
}
<?php else : ?>
.archive #blog-entry {
	margin-right: -35px;
}
<?php endif; ?>


/* Footer font*/
.copyright-info, .add-info { color: <?php echo $footer_font['color']; ?>; <?php echo $footer_font['size']; ?>; }

<?php if ( empty( $footer_opacity ) ) $footer_opacity = 0.7; ?>
#footer > .transparent-bg {
	background-color: <?php echo $footer_background; ?>;
	opacity: <?php echo $footer_opacity; ?>;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $footer_opacity*100; ?>)";
	filter: alpha(opacity=<?php echo $footer_opacity*100; ?>);	
}


/* Headings Styling */
h1 {
	color: <?php echo $h_one['color']; ?>;
	<?php if( $h_one['style'] == 'normal' || $h_one['style'] == 'italic') { ?>font-style: <?php echo $h_one['style']; ?>;<?php } ?>	
	<?php if( $h_one['style'] == 'bold' || $h_one['style'] == 'bold italic') { ?>font-weight: <?php echo $h_one['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_one['size']; ?>; 
	line-height: <?php echo $h_one['height']; ?>; 
}

h2 {
	color: <?php echo $h_two['color']; ?>;
	<?php if( $h_two['style'] == 'normal' || $h_two['style'] == 'italic') { ?>font-style: <?php echo $h_two['style']; ?>;<?php } ?>	
	<?php if( $h_two['style'] == 'bold' || $h_two['style'] == 'bold italic') { ?>font-weight: <?php echo $h_two['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_two['size']; ?>; 
	line-height: <?php echo $h_two['height']; ?>; 
}

h3 {
	color: <?php echo $h_three['color']; ?>;
	<?php if( $h_three['style'] == 'normal' || $h_three['style'] == 'italic') { ?>font-style: <?php echo $h_three['style']; ?>;<?php } ?>	
	<?php if( $h_three['style'] == 'bold' || $h_three['style'] == 'bold italic') { ?>font-weight: <?php echo $h_three['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_three['size']; ?>; 
	line-height: <?php echo $h_three['height']; ?>; 
}

h4 {
	color: <?php echo $h_four['color']; ?>;
	<?php if( $h_four['style'] == 'normal' || $h_four['style'] == 'italic') { ?>font-style: <?php echo $h_four['style']; ?>;<?php } ?>	
	<?php if( $h_four['style'] == 'bold' || $h_four['style'] == 'bold italic') { ?>font-weight: <?php echo $h_four['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_four['size']; ?>; 
	line-height: <?php echo $h_four['height']; ?>; 
}

h5 {
	color: <?php echo $h_five['color']; ?>;
	<?php if( $h_five['style'] == 'normal' || $h_five['style'] == 'italic') { ?>font-style: <?php echo $h_five['style']; ?>;<?php } ?>	
	<?php if( $h_five['style'] == 'bold' || $h_five['style'] == 'bold italic') { ?>font-weight: <?php echo $h_five['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_five['size']; ?>; 
	line-height: <?php echo $h_five['height']; ?>; 
}

h6 {
	color: <?php echo $h_six['color']; ?>;
	<?php if( $h_six['style'] == 'normal' || $h_six['style'] == 'italic') { ?>font-style: <?php echo $h_six['style']; ?>;<?php } ?>	
	<?php if( $h_six['style'] == 'bold' || $h_six['style'] == 'bold italic') { ?>font-weight: <?php echo $h_six['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_six['size']; ?>; 
	line-height: <?php echo $h_six['height']; ?>; 
}

h1.entry-title, h2.entry-title {
	<?php if( $post_title_font['style'] == 'normal' || $post_title_font['style'] == 'italic' ) { ?>
		font-style: <?php echo $post_title_font['style']; ?>;
		font-weight: normal;
	<?php } ?>		
	<?php if( $post_title_font['style'] == 'bold' ) { ?>
		font-weight: <?php echo $post_title_font['style']; ?>;
	<?php } ?>
	<?php if( $post_title_font['style'] == 'bold italic' ) { ?>
		font-weight: bold;
		font-style: italic;
	<?php } ?>

	font-size: <?php echo $post_title_font['size']; ?>; 
	line-height: <?php echo $post_title_font['height']; ?>;
	text-transform: <?php echo $post_title_transform; ?>;
}

h1.entry-title a, h2.entry-title a {
	color: <?php echo $post_title_font['color']; ?>;
}

/* Featured image */
<?php if ( $featured_image_post == '0') : ?>
.single .entry-content { padding-top: 0; }
<?php endif; ?>

/* Stretch thumbnail post images */
<?php if ( $thumb_posts_stretch ) : ?>
.single-post .media-thumb img { width: 100%; }
<?php endif; ?>

<?php if ( $welcome_padding ) : ?>
.welcome-text { padding: 0; }
<?php endif; ?>

/* Links color */
a { color: <?php echo $links_color; ?>; }
.entry-meta a:hover { color: <?php echo $links_color; ?>; }

h2.entry-title a:hover { color: <?php echo $links_color; ?>; }

.sf-menu a:hover { color: <?php echo $links_color; ?> !important; }
.sub-menu a:hover { color: #333 !important; }

.recent-posts-widget .post-title a:hover,
.popular-posts-widget .post-title a:hover,
.small-slider .entry-title a:hover { color: <?php echo $links_color; ?>; }

.entry-thumb:hover .video { border-color: <?php echo $links_color; ?>; }

.widget .tagcloud a[class|=tag-link]:hover,
#entry-post a[rel=tag]:hover,
.tagcloud a[class|=tag-link]:hover { background-color:<?php echo $links_color; ?>; }

.pagination a:hover { background: <?php echo $links_color; ?>; }
.pagination .current { background: <?php echo $links_color; ?>; }

.meta .meta-category a:hover,
.meta .meta-author a:hover,
.meta .meta-comments a:hover { color: <?php echo $links_color; ?>; }

.widget_nav_menu li.current-menu-item:before,
.widget_nav_menu li.current-menu-ancestor:before { color: <?php echo $links_color; ?>; }



/* Responsive Layout */
<?php if ( !$responsive_layout ) : ?>
	#header, #footer { min-width:1170px; }
	.container { width: 1170px; }
<?php endif; ?>

/* Pagination None */
<?php if ( $pagination_type == 'Infinite Scroll') { ?>
	.pagination { display: none; }
<?php } ?>