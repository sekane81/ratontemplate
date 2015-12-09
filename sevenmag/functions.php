<?php

/*  Option framework
/* ------------------------------------ */
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	add_filter( 'ot_theme_mode', '__return_true' );
	load_template( get_template_directory() . '/admin/ot-loader.php' );

/*  Load files
/* ------------------------------------ */
if ( ! function_exists( 'T20_load' ) ) {
	
	function T20_load() {
		load_theme_textdomain( 'T20', get_template_directory().'/languages' );
		load_template( get_template_directory() . '/admin/theme-options.php' );
		load_template( get_template_directory() . '/admin/meta-boxes.php' );
		if ( ot_get_option('wp_pagenavi') == 'on' ) {
			load_template( get_template_directory() . '/admin/wp-pagenavi.php' );
		}
		
		// widgets
		load_template( get_template_directory() . '/admin/widgets/T20-posts.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-posts-slideshow.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-ads.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-comments.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-facebook.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-instagram.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-pinterest.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-social.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-subscribe.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-tabs.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-video.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-weather.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-soundcloud.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-empty.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-flickr.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-flickr.php' );
		load_template( get_template_directory() . '/admin/widgets/T20-instagram2.php' );

		// Register widgets
		register_widget('T20_comments');
		register_widget('T20_Facebook_Widget');
		register_widget('T20_instagram');
		register_widget('T20_instagram2');
		register_widget('T20_pinterest');
		register_widget('T20_posts');
		register_widget('T20_posts_slideshow');
		register_widget('T20_social_widget');
		register_widget('T20_subscribe_widget');
		register_widget('TT_125Ad_Widget');
		register_widget('T20_Tabs');
		register_widget('T20_Video');
		register_widget('T20_weather');
		register_widget('T20_soundcloud');
		register_widget('T20_empty');
		register_widget('T20_flickr');

		// Dynamic styles
		load_template( get_template_directory() . '/admin/dynamic-styles.php' );
		
		// TGM
		load_template( get_template_directory() . '/admin/class-tgm-plugin-activation.php' );
	}
	
}
add_action( 'after_setup_theme', 'T20_load' );

/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'T20_setup' ) ) {
	
	function T20_setup() {	
		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Content width
		if ( !isset( $content_width ) ) { $content_width = 1230; }
		
		// Enable post format support
		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );
		
		// Enable featured image
		add_theme_support( 'post-thumbnails' );
		
		// Thumbnail sizes
		add_image_size( 'thumbnail', 80, 80, true ); // thumbnail
		add_image_size( 'masonry', 730, 9999 ); // thumbnail
		add_image_size( 'post-big-default', 768, 350, true ); // post-big-default
		add_image_size( 'first-post', 255, 333, true ); // first-post
		add_image_size( 'first-news-pic', 255, 245, true ); // first-news-pic
		add_image_size( 'blocktwo', 255, 280, true ); // for block2
		add_image_size( 'carousel-block', 255, 180, true ); // for carousel block
		add_image_size( 'slide', 246, 344, true ); // Slideshow default
		add_image_size( 'slidefour', 308, 344, true ); // Slideshow in four
		add_image_size( 'slidethree', 410, 344, true ); // Slideshow in three
		add_image_size( 'slidehalf', 615, 344, true ); // Slideshow half
		add_image_size( 'slidefull', 1230, 400, true ); // Slideshow full

		add_filter('widget_text', 'do_shortcode');
		add_theme_support( 'woocommerce' );
		add_theme_support( 'bbpress' );
		
		if ( ot_get_option('new_walker') !== 'off' ) {
			class vw_main_menu_walker extends Walker_Nav_Menu {
		
				function start_lvl( &$output, $depth = 0, $args = array() ) {
					// depth dependent classes
					$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
					$display_depth = ( $depth + 1); // because it counts the first submenu as 0
					$classes = array(
						'sub-menu',
						( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
						( $display_depth >=2 ? 'sub-sub-menu' : '' ),
						'menu-depth-' . $display_depth
						);
					$class_names = implode( ' ', $classes );
				  
					// build html
					$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
				}
				  
				// add main/sub classes to li's and links
				function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
				        global $wp_query;
				        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
				 
				        $class_names = $value = '';
				 
				        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
				 
				        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				        $class_names = ' class="'. esc_attr( $class_names ) . '"';
				 
				        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
				 
				        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				        $description  = ! empty( $item->description ) ? '<b class="sub">'.esc_attr( $item->description ).'</b>' : '';
				 
				        /* if($depth != 0) { $description = $append = $prepend = ""; } */
				 
				        $item_output = $args->before;
				        $item_output .= '<a'. $attributes .'>';
				        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
				        $item_output .= $description.$args->link_after;
				        $item_output .= '</a>';
				        $item_output .= $args->after;
				 
				        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
				}
		
				function end_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
					global $wp_query;
					global $post;
		
					/* Add custom menu */
		
					if ( $depth == 0 && $item->object == 'category' ) { 
						$cat = $item->object_id;
						ob_start();
						$mega_col = ot_get_option('mega_col');
						if ( $mega_col === '3' ) {
							$mega_id = 'three';
						} elseif ( $mega_col === '4' ) {
							$mega_id = 'four';
						} elseif ( $mega_col === '5' ) {
							$mega_id = 'five';
						} elseif ( $mega_col === '6' ) {
							$mega_id = 'six';
						}
							echo '<ul class="mega_posts '.$mega_id.'_mega">';
								$post_args = array( 'numberposts' => $mega_col, 'offset'=> 0, 'category' => $cat );
								$menuposts = get_posts( $post_args );
								echo '<li>';
								foreach( $menuposts as $post ) : setup_postdata( $post );
									get_template_part( 'content-m' );
								endforeach;
								echo '</li>';
								wp_reset_postdata();
							echo '</ul>';
						$output .= ob_get_clean();
					}
		
					$output .= "</li>\n";
				}
			}
		} else {
			class vw_main_menu_walker extends Walker_Nav_Menu {
				// custom walker
			}
		}
	}
	
}
add_action( 'after_setup_theme', 'T20_setup' );

/*  Random post
/* ------------------------------------ */
add_action('init','random_post');
function random_post() {
	global $wp;
	$wp->add_query_var('random');
	add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}
add_action('template_redirect','random_template');
function random_template() {
	if (get_query_var('random') == 1) {
		$posts = get_posts('post_type=post&orderby=rand&numberposts=1');
		foreach($posts as $post) {
			$link = get_permalink($post);
		}
		wp_redirect($link,307);
		exit;
	}
}

/*  Time Ago
/* ------------------------------------ */
function time_ago( $type = 'post' ) {
	$mylocale = get_bloginfo('language');
	if($mylocale == 'ar') {
		$posie = ot_get_option('news_ago');
		$posif = '';
	} else {
		$posie = '';
		$posif = ot_get_option('news_ago');
	}
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	return $posie . " " . human_time_diff($d('U'), current_time('timestamp')) . " " . $posif;
}

/*  Format Icons
/* ------------------------------------ */
function format_icon() {
	if ( has_post_format('video') && !is_sticky() ) {
		echo '<span class="thumb-icon"><i class="icon-media-play"></i></span>';
	} elseif ( has_post_format('audio') && !is_sticky() ) {
		echo '<span class="thumb-icon"><i class="icon-music"></i></span>';
	} elseif ( has_post_format('gallery') && !is_sticky() ) {
		echo '<span class="thumb-icon"><i class="icon-camera"></i></span>';
	} elseif ( is_sticky() ) {
		echo '<span class="thumb-icon"><i class="icon-star"></i></span>';
	} else {
		echo '<span class="thumb-icon"><i class="icon-export"></i></span>';
	}
}

/*  Review total
/* ------------------------------------ */
function get_review() {
	global $post;
	$heading	= get_post_meta( $post->ID, 'wp_review_heading', true );
	$type		= get_post_meta( $post->ID, 'wp_review_type', true );
	$total		= get_post_meta( $post->ID, 'wp_review_total', true );

		if ( $total ) {
			echo '<div class="tt_review">';
			if ( 'star' == $type ) {
				$result = $total * 20;
				$bestresult = '<meta itemprop="best" content="5"/>';
				$best = '5';
			} elseif( 'point' == $type ) {
				$result = $total * 10;
				$bestresult = '<meta itemprop="best" content="10"/>';
				$best = '10';
			} else {
				$result = $total * 100 / 100;
				$bestresult = '<meta itemprop="best" content="100"/>';
				$best = '100';
			}

			if ( 'star' == $type ) {
				echo '<div class="tt_star" title="' . $heading . '">';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<div class="review_w_out" style="width:' . $result . '%;">';
				echo '<div class="review_w">';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '</div></div></div>';
			} elseif ( 'point' == $type ) {
				echo '<div class="tt_point">';
				echo '<div class="tt_val">' . $total . '</div>';
				if( $heading != '' ){
					echo '<span class="tt_title">' . $heading . '</span>';
				}
				echo '</div>';
			} else {
				echo '<div class="tt_percentage">';
				echo '<div class="tt_val">' . $result . '%</div>';
				if( $heading != '' ){
					echo '<span class="tt_title">' . $heading . '</span>';
				}
				echo '</div>';
			}
			echo '</div>';
		}
}

/*  Register sidebars
/* ------------------------------------ */	
if ( ! function_exists( 'T20_sidebars' ) ) {

	function T20_sidebars()	{
		$before_widget =  '<div id="%1$s" class="%2$s">';
		$after_widget  =  '</div></div><!-- .widget /-->';
		$before_title  =  '<div class="b_title"><h4>';
		$after_title   =  '</h4></div><div class="widget clearfix">';

		register_sidebar(array( 'name' => __( 'Primary', 'T20' ),'id' => 'primary','description' => __( 'Primary Sidebar', 'T20' ), 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
		register_sidebar(array( 'name' => __( 'Secondary', 'T20' ),'id' => 'secondary','description' => __( 'Secondary Sidebar', 'T20' ), 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
		register_sidebar(array( 'name' => __( 'Custom 1', 'T20' ),'id' => 'c1','description' => __( 'Custom Sidebar 1', 'T20' ), 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
		register_sidebar(array( 'name' => __( 'Custom 2', 'T20' ),'id' => 'c2','description' => __( 'Custom Sidebar 2', 'T20' ), 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
		register_sidebar(array( 'name' => __( 'Custom 3', 'T20' ),'id' => 'c3','description' => __( 'Custom Sidebar 3', 'T20' ), 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
		if ( ot_get_option('footer-widgets') >= '1' ) { register_sidebar(array( 'name' => __( 'Footer 1', 'T20' ),'id' => 'footer-1', 'description' => "Widetized footer column 1", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets') >= '2' ) { register_sidebar(array( 'name' => __( 'Footer 2', 'T20' ),'id' => 'footer-2', 'description' => "Widetized footer column 2", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets') >= '3' ) { register_sidebar(array( 'name' => __( 'Footer 3', 'T20' ),'id' => 'footer-3', 'description' => "Widetized footer column 3", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets') >= '4' ) { register_sidebar(array( 'name' => __( 'Footer 4', 'T20' ),'id' => 'footer-4', 'description' => "Widetized footer column 4", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }

		if ( ot_get_option('footer-widgets-2') >= '1' ) { register_sidebar(array( 'name' => __( 'Footer 2nd 1', 'T20' ),'id' => 'footer-2-1', 'description' => "Widetized footer 2nd column 1", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets-2') >= '2' ) { register_sidebar(array( 'name' => __( 'Footer 2nd 2', 'T20' ),'id' => 'footer-2-2', 'description' => "Widetized footer 2nd column 2", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets-2') >= '3' ) { register_sidebar(array( 'name' => __( 'Footer 2nd 3', 'T20' ),'id' => 'footer-2-3', 'description' => "Widetized footer 2nd column 3", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets-2') >= '4' ) { register_sidebar(array( 'name' => __( 'Footer 2nd 4', 'T20' ),'id' => 'footer-2-4', 'description' => "Widetized footer 2nd column 4", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets-2') >= '5' ) { register_sidebar(array( 'name' => __( 'Footer 2nd 5', 'T20' ),'id' => 'footer-2-5', 'description' => "Widetized footer 2nd column 5", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
		if ( ot_get_option('footer-widgets-2') >= '6' ) { register_sidebar(array( 'name' => __( 'Footer 2nd 6', 'T20' ),'id' => 'footer-2-6', 'description' => "Widetized footer 2nd column 6", 'before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title)); }
	}
	
}
add_action( 'widgets_init', 'T20_sidebars' );

/*  Fix Widget Empty Title
/* ------------------------------------ */
function widget_empty_title($output='') {
	if ($output == '') {
		return '<span class="empty"> </span>';
	}
	return $output;
}
add_filter('widget_title', 'widget_empty_title');

/*  Span to Category Widget
/* ------------------------------------ */
add_filter('wp_list_categories', 'add_span_cat_count');
function add_span_cat_count($links) {
	$links = str_replace('</a> (', '</a><span>(', $links);
	$links = str_replace(')', ')</span>', $links);
	return $links;
}

/*  Span to Archives Widget
/* ------------------------------------ */
add_filter('get_archives_link', 'archive_count_no_brackets');
function archive_count_no_brackets($links) {
	$links = str_replace('</a>&nbsp;(', '</a><span>(', $links);
	$links = str_replace(')', ')</span>', $links);
	return $links;
}


/*  Register custom sidebars
/* ------------------------------------ */
if ( ! function_exists( 'T20_custom_sidebars' ) ) {

	function T20_custom_sidebars() {
		if ( !ot_get_option('sidebar-areas') =='' ) {
			$sidebars = ot_get_option('sidebar-areas', array());
			$before_widget =  '<div id="%1$s" class="%2$s">';
			$after_widget  =  '</div></div><!-- .widget /-->';
			$before_title  =  '<div class="b_title"><h4>';
			$after_title   =  '</h4></div><div class="widget clearfix">';
			
			if ( !empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					if ( isset($sidebar['title']) && !empty($sidebar['title']) && isset($sidebar['id']) && !empty($sidebar['id']) && ($sidebar['id'] !='sidebar-') ) {
						register_sidebar(array('name' => ''.$sidebar['title'].'','id' => ''.strtolower($sidebar['id']).'','before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
					}
				}
			}
		}
	}
	
}
add_action( 'widgets_init', 'T20_custom_sidebars' );

/*  Dynamic sidebar primary
/* ------------------------------------ */
if ( ! function_exists( 'T20_sidebar_primary' ) ) {
	
	function T20_sidebar_primary() {
		// Default sidebar
		$s_p = 'primary';

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$metapp = get_post_meta($post->ID,'_sidebar_primary',true);
			if ( $metapp ) { $s_p = $metapp; }
		}

		// Return sidebar
		return $s_p;
	}
	
}

/*  Dynamic sidebar secondary
/* ------------------------------------ */
if ( ! function_exists( 'T20_sidebar_secondary' ) ) {

	function T20_sidebar_secondary() {
		// Default sidebar
		$s_s = 'secondary';

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$metass = get_post_meta($post->ID,'_sidebar_secondary',true);
			if ( $metass ) { $s_s = $metass; }
		}

		// Return sidebar
		return $s_s;
	}
	
}

/*  Sidebar bbpress
/* ------------------------------------ */
if ( ! function_exists( 'bbp_primary' ) ) {
	function bbp_primary() {
		$bbp_p = 'primary';
		if ( ot_get_option('bbp_primary') ) {
			$bbp_p = ot_get_option('bbp_primary');
		}
		return $bbp_p;
	}
}
if ( ! function_exists( 'bbp_secondary' ) ) {
	function bbp_secondary() {
		$bbp_s = 'secondary';
		if ( ot_get_option('bbp_secondary') ) {
			$bbp_s = ot_get_option('bbp_secondary');
		}
		return $bbp_s;
	}
}

/*  Sidebar buddypress
/* ------------------------------------ */
if ( ! function_exists( 'bp_primary' ) ) {
	function bp_primary() {
		$bp_p = 'primary';
		if ( ot_get_option('bp_primary') ) {
			$bp_p = ot_get_option('bp_primary');
		}
		return $bp_p;
	}
}
if ( ! function_exists( 'bp_secondary' ) ) {
	function bp_secondary() {
		$bp_s = 'secondary';
		if ( ot_get_option('bp_secondary') ) {
			$bp_s = ot_get_option('bp_secondary');
		}
		return $bp_s;
	}
}

/*  Sidebar DWQA
/* ------------------------------------ */
if ( ! function_exists( 'dwqa_primary' ) ) {
	function dwqa_primary() {
		$dwqa_p = 'primary';
		if ( ot_get_option('dwqa_primary') ) {
			$dwqa_p = ot_get_option('dwqa_primary');
		}
		return $dwqa_p;
	}
}
if ( ! function_exists( 'dwqa_secondary' ) ) {
	function dwqa_secondary() {
		$dwqa_s = 'secondary';
		if ( ot_get_option('dwqa_secondary') ) {
			$dwqa_s = ot_get_option('dwqa_secondary');
		}
		return $dwqa_s;
	}
}

/*  Author Social
/* ------------------------------------ */
function eff_show_extra_profile_fields( $contactmethods ) {
	$contactmethods['facebook'] = 'FaceBook URL';
	$contactmethods['twitter'] = 'Twitter URL';
	$contactmethods['dribbble'] = 'Dribbble URL';
	$contactmethods['github'] = 'Github URL';
	$contactmethods['instagram'] = 'Instagram URL';
	$contactmethods['linkedin'] = 'Linkedin URL';
	$contactmethods['pinterest'] = 'Pinterest URL';
	$contactmethods['googleplus'] = 'Google Plus URL';
	$contactmethods['foursquare'] = 'Foursquare URL';
	$contactmethods['skype'] = 'Skype URL';
	$contactmethods['cloud'] = 'Soundcloud URL';
	$contactmethods['youtube'] = 'Youtube URL';
	$contactmethods['tumblr'] = 'Tumblr URL';
	$contactmethods['star'] = 'Reverbnation URL';
	$contactmethods['flickr'] = 'Flickr URL';
	$contactmethods['envelope'] = 'Contact Address';
	return $contactmethods;		
}
add_filter('user_contactmethods','eff_show_extra_profile_fields',10,1);
add_action( 'personal_options_update', 'eff_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'eff_save_extra_profile_fields' );

function eff_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
	update_user_meta( $user_id, 'github', $_POST['github'] );
	update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_user_meta( $user_id, 'googleplus', $_POST['googleplus'] );
	update_user_meta( $user_id, 'foursquare', $_POST['foursquare'] );
	update_user_meta( $user_id, 'skype', $_POST['skype'] );
	update_user_meta( $user_id, 'cloud', $_POST['cloud'] );
	update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
	update_user_meta( $user_id, 'tumblr', $_POST['tumblr'] );
	update_user_meta( $user_id, 'star', $_POST['star'] );
	update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
	update_user_meta( $user_id, 'envelope', $_POST['envelope'] );
}
add_filter('user_contactmethods','hide_profile_fields',10,1);

function hide_profile_fields( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
}

/*  Social links
/* ------------------------------------------------------------------------------------------- */
if ( ! function_exists( 'T20_social_links' ) ) {

	function T20_social_links() {
		if ( !ot_get_option('social-links') =='' ) {
			$links = ot_get_option('social-links', array());
			if ( !empty( $links ) ) {
				echo '<div class="social">';	
				foreach( $links as $item ) {
					
					// Build each separate html-section only if set
					if ( isset($item['title']) && !empty($item['title']) ) 
						{ $title = 'title="' .$item['title']. '"'; } else $title = '';
					if ( isset($item['social-link']) && !empty($item['social-link']) ) 
						{ $link = 'href="' .$item['social-link']. '"'; } else $link = '';
					if ( isset($item['social-target']) && !empty($item['social-target']) ) 
						{ $target = 'target="_blank"'; } else $target = '';
					if ( isset($item['social-icon']) && !empty($item['social-icon']) ) 
						{ $icon = 'class="fa ' .$item['social-icon']. '"'; } else $icon = '';
					
					// Put them together
					if ( isset($item['title']) && !empty($item['title']) && isset($item['social-icon']) && !empty($item['social-icon']) && ($item['social-icon'] !='fa-') ) {
						echo '<a rel="nofollow" class="bottomtip" '.$title.' '.$link.' '.$target.'><i '.$icon.'></i></a>';
					}
				}
				echo '</div>';
			}
		}
	}
	
}

/*  Site name/logo
/* ------------------------------------ */
if ( ! function_exists( 'T20_site_title' ) ) {

	function T20_site_title() {
	
		// Text or image?
		if ( ot_get_option('custom-logo') ) {
			$logo = '<b class="hidden">'.get_bloginfo('name').'</b><a href="'.home_url('/').'" rel="home" title="'.get_bloginfo('description').'"><img src="'.ot_get_option('custom-logo').'" alt="'.get_bloginfo('name').'"></a>';
		} else {
			$logo = '<a class="text_logo" href="'.home_url('/').'" title="'.get_bloginfo('description').'" rel="home">'.get_bloginfo('name').'</a>';
		}
		
		$sitename = '<h1>'.$logo.'</h1><h2 class="hidden">'.get_bloginfo('description').'</h2>'."\n";
		
		return $sitename;
	}
	
}

function gen_meta_desc() {
	global $post;
	if ( ! is_singular() )
		return;

	$meta = strip_tags( $post->post_content );
	$meta = str_replace( array( "\\n", "\\r", "\\t" ), ' ', $meta);
	$meta = substr( $meta, 0, 125 );

	return $meta;
}

/*  Related posts
/* ------------------------------------ */
if ( ! function_exists( 'T20_related_posts' ) ) {

	function T20_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'			=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'			=> 'rand',
			'post__not_in'			=> array($post->ID),
			'posts_per_page'		=> ot_get_option('related_posts_num')
		);
		// Related by categories
		if ( ot_get_option('related-posts') == 'categories' ) {
			
			$cats = get_post_meta($post->ID, 'related-cat', true);
			
			if ( !$cats ) {
				$cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( ot_get_option('related-posts') == 'tags' ) {
		
			$tags = get_post_meta($post->ID, 'related-tag', true);
			
			if ( !$tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( !$tags ) { $break = true; }
		}
		
		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
	
}

/*  Get images attached to post
/* ------------------------------------ */
if ( ! function_exists( 'T20_post_images' ) ) {

	function T20_post_images( $args=array() ) {
		global $post;

		$defaults = array(
			'numberposts'		=> -1,
			'order'			=> 'ASC',
			'orderby'		=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=>  $post->ID,
			'post_type'		=> 'attachment',
		);

		$args = wp_parse_args( $args, $defaults );

		return get_posts( $args );
	}
	
}		

/*  Post formats script
/* ------------------------------------ */
if ( ! function_exists( 'T20_post_formats_script' ) ) {

	function T20_post_formats_script( $hook ) {
		// Only load on posts, pages
		if ( !in_array($hook, array('post.php','post-new.php')) )
			return;
		wp_enqueue_script('post-formats', get_template_directory_uri() . '/admin/assets/js/post-formats.js', array( 'jquery' ));
	}
	
}
add_action( 'admin_enqueue_scripts', 'T20_post_formats_script');

/*  Site title
/* ------------------------------------ */
if ( ! function_exists( 'T20_wp_title' ) ) {

	function T20_wp_title( $title ) {
		// Do not filter for RSS feed / if SEO plugin installed
		if ( is_feed() || class_exists('All_in_One_SEO_Pack') || class_exists('HeadSpace_Plugin') || class_exists('Platinum_SEO_Pack') || class_exists('wpSEO') || defined('WPSEO_VERSION') )
			return $title;
		if ( is_front_page() ) { 
			$title = bloginfo('name'); echo ' - '; bloginfo('description'); 
		}
		if ( !is_front_page() ) { 
			$title.= ''.''.''.get_bloginfo('name'); 
		}
		return $title;
	}
	
}
add_filter( 'wp_title', 'T20_wp_title' );

/*  Custom rss feed
/* ------------------------------------ */
if ( ! function_exists( 'T20_feed_link' ) ) {

	function T20_feed_link( $output, $feed ) {
		// Do not redirect comments feed
		if ( strpos( $output, 'comments' ) )
			return $output;
		// Return feed url
		return ot_get_option('rss-feed',$output);
	}
	
}
add_filter( 'feed_link', 'T20_feed_link', 10, 2 );

/*  Custom Code and CSS
/* ------------------------------------ */
if ( ! function_exists( 'T20_custom_codes' ) ) {
	function T20_custom_codes() {
		if ( ot_get_option('custom-codes-head') ) {
			echo ot_get_option('custom-codes-head')."\n";
		}
		if ( ot_get_option('custom-css-head') ) {
			echo '<style>'.ot_get_option('custom-css-head').'</style>'."\n";
		} ?>

		<script type="text/javascript">	
			/* <![CDATA[ */
				jQuery(document).ready(function() {
					jQuery(window).on('load', function(){ var $ = jQuery; });
					<?php if ( ot_get_option('introfx') === 'on' ) { ?>if ( jQuery('#layout').hasClass('load_anim') ) {
						jQuery('.widget').addClass('introfx');
						jQuery('.introfx, .introfxo > div,.widget, .T20-tabs-nav').data( 'appear-top-offset', 700 ).appear(function(){
							jQuery(this).addClass('animated <?php echo ot_get_option('anim_fx'); ?>');
							jQuery('.shake, .tada, .swing, .wobble, .pulse, .flip, .flipInX, .flipInY, .bounceIn, .rotateIn, .hinge, .rollIn, .lightSpeedIn').css('opacity', '1');
						});
					}
					<?php } ?>var $masonrytt = jQuery('#masonry-container');
					$masonrytt.imagesLoaded( function(){
						$masonrytt.masonry({
							itemSelector: '.post',
							isRTL: <?php if ( is_rtl() ) { echo'true'; } else { echo 'false'; } ?>,
							columnWidth: 1,
							isAnimated: true,
							animationOptions: {
								duration: 300,
								easing: 'easeInExpo',
								queue: true
							}
						});
					});
				});
			/* ]]> */
		</script>
	<?php }
}
add_filter( 'wp_head', 'T20_custom_codes' );

/*  Custom Code Footer
/* ------------------------------------ */
if ( ! function_exists( 'T20_custom_footer' ) ) {
	function T20_custom_footer() {
		if ( ot_get_option('custom-codes-footer') ) {
			echo ot_get_option('custom-codes-footer')."\n";
		}
	}
}
add_filter( 'wp_footer', 'T20_custom_footer', 100 );

/*  Custom favicon
/* ------------------------------------ */
if ( ! function_exists( 'T20_favicon' ) ) {

	function T20_favicon() {
		if ( ot_get_option('favicon') ) {
			echo '<link rel="shortcut icon" href="'.ot_get_option('favicon').'" />'."\n";
		}
		if ( ot_get_option('apple-touch') ) {
			echo '<link rel="apple-touch-icon" href="'.ot_get_option('apple-touch').'">'."\n";
		}
	}
	
}
add_filter( 'wp_head', 'T20_favicon' );


/*  Replaces the excerpt more link
/* ------------------------------------ */
function new_excerpt_more($more) {
	global $post;
	return ' ... <a class="readmore" href="'. get_permalink($post->ID) . '">' . ot_get_option('read_more_text') . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


/*  Excerpt length
/* ------------------------------------ */
if ( ! function_exists( 'T20_excerpt_length' ) ) {

	function T20_excerpt_length( $length ) {
		return ot_get_option('excerpt-length',$length);
	}
	
}
add_filter( 'excerpt_length', 'T20_excerpt_length', 999 );


/*  Upscale cropped thumbnails
/* ------------------------------------ */
if ( ! function_exists( 'T20_thumbnail_upscale' ) ) {

	function T20_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
		if ( !$crop ) return null; // let the wordpress default function handle this

		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}
	
}
add_filter( 'image_resize_dimensions', 'T20_thumbnail_upscale', 10, 6 );


/*  TGM plugin activation
/* ------------------------------------ */
if ( ! function_exists( 'T20_plugins' ) ) {
	
	function T20_plugins() {
		$plugins = array(
			array(
			            'name'     		=> 'Visual Composer',
			            'slug'     		=> 'js_composer',
			            'source'   		=> 'http://theme20.com/plugins/js_composer.zip', 
				'required' 		=> true, 
				'force_activation' 	=> false, 
				'force_deactivation' 	=> false, 
			),
			array(
			            'name'     		=> 'MasterSlider',
			            'slug'     		=> 'masterslider',
			            'source'   		=> 'http://theme20.com/plugins/masterslider.zip', 
				'required' 		=> true, 
				'force_activation' 	=> false, 
				'force_deactivation' 	=> false, 
			),
			array(
			            'name'     		=> 'Symple Shortcodes',
			            'slug'     		=> 'symple-shortcodes',
			            'source'   		=> get_stylesheet_directory() . '/plugins/symple-shortcodes.zip', 
				'required' 		=> true, 
				'force_activation' 	=> false, 
				'force_deactivation' 	=> false, 
			),
			array(
			            'name'     		=> 'Instagram Widget',
				'slug' 			=> 'instagram-slider-widget',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'Ajax Login Widget',
				'slug' 			=> 'wp-ajax-login',
			            'source'   		=> get_stylesheet_directory() . '/plugins/wp-ajax-login.zip', 
				'required' 		=> false, 
				'force_activation' 	=> false, 
				'force_deactivation' 	=> false, 
			),
			array(
				'name' 			=> 'WP Review',
				'slug' 			=> 'wp-review',
			            'source'   		=> get_stylesheet_directory() . '/plugins/wp-review.zip', 
				'required' 		=> false, 
				'force_activation' 	=> false, 
				'force_deactivation' 	=> false, 
			),
			array(
				'name' 			=> 'ZillaLikes',
				'slug' 			=> 'zilla-likes',
			            'source'   		=> get_stylesheet_directory() . '/plugins/zilla-likes.zip', 
				'required' 		=> false, 
				'force_activation' 	=> false, 
				'force_deactivation' 	=> false, 
			),
			array(
				'name' 			=> 'Regenerate Thumbnails',
				'slug' 			=> 'regenerate-thumbnails',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'wp-postviews',
				'slug' 			=> 'wp-postviews',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'WP-Polls',
				'slug' 			=> 'wp-polls',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'Contact Form 7',
				'slug' 			=> 'contact-form-7',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'DWQA',
				'slug' 			=> 'dw-question-answer',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'Widget Importer',
				'slug' 			=> 'widget-importer-exporter',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'bbpress',
				'slug' 			=> 'bbpress',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name' 			=> 'WooCommerce',
				'slug' 			=> 'woocommerce',
				'required'		=> false,
				'force_activation' 	=> false,
				'force_deactivation'	=> false,
			)
		);	
		tgmpa( $plugins );
	}
	
}
add_action( 'tgmpa_register', 'T20_plugins' );


/**
 * Front-end Scripts and Styles
 */
function sevenmag_scripts() {
	wp_enqueue_script( 'seven', get_template_directory_uri() . '/js/seven.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', true );
	if ( is_rtl() ) { 
		wp_enqueue_script( 'scroller', get_template_directory_uri() . '/js/jquery.li-scroller-rtl.1.0.js', array( 'jquery' ), '', true ); 
	} else {
		wp_enqueue_script( 'scroller', get_template_directory_uri() . '/js/jquery.li-scroller.1.0.js', array( 'jquery' ), '', true );
	}
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'prettyphoto' );
	wp_enqueue_style( 'prettyphoto' );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'sevenstyle', get_stylesheet_uri(), array() );
	wp_enqueue_style( 'icons', get_template_directory_uri() . '/styles/icons.css', array() );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/styles/animate.css', array() );
	if ( function_exists( 'is_woocommerce' ) ) {
		wp_enqueue_style( 'shop', get_template_directory_uri() . '/styles/shop.css', array() );
	}
	if ( function_exists( 'buddypress' ) ) {
		wp_enqueue_style( 'shop', get_template_directory_uri() . '/styles/buddypress.css', array() );
	}
	if ( ot_get_option('responsive') == 'on' ) { wp_enqueue_style( 'responsive', get_template_directory_uri() . '/styles/responsive.css', array() ); }
	if ( ot_get_option('dark') == 'on' ) { wp_enqueue_style( 'dark', get_template_directory_uri() . '/styles/dark.css', array() ); }
}
add_action( 'wp_enqueue_scripts', 'sevenmag_scripts' );

// woocommerce
if ( function_exists( 'is_woocommerce' ) ) {
	// Change columns
	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 3;
		}
	}
}

// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary menu', 'T20' ),
		'secondary' => __( 'Secondary menu', 'T20' ),
		'footer' => __( 'Footer menu', 'T20' ),
	) );

/*  VC
/* ------------------------------------ */
if (class_exists('WPBakeryVisualComposerAbstract')) {
	load_template( get_template_directory() . '/admin/T20_loader.php' );
	global $tt_row_count, $tt_column_count;
	$tt_row_count = 0;
	$tt_column_count = 0;
	
	// vc_disable_frontend();
	wpb_js_composer_check_version_schedule_deactivation(); 
	function my_custom_vc() {
		echo '<style>.vc-license-activation-notice, .vc_license-activation-notice, #vc_teaser {display: none} i[class^="ot-"], i[class*="ot-"], span[class^="ot-"], span[class*="ot-"] {background-image: none !important;background: none !important;text-align: center;font-size: 25px}</style>';
		echo '<style>.type-checkbox .format-setting-inner {height: 218px;overflow-y: scroll} #page-ot_theme_options i[class^="ot-"], #page-ot_theme_options i[class*="ot-"] {font-size: 16px}</style>';
	}
	add_action('admin_head', 'my_custom_vc');

	vc_remove_element("vc_tour");
	vc_remove_element("vc_teaser_grid");
	vc_remove_element("vc_posts_grid");
	vc_remove_element("vc_carousel");
	vc_remove_element("vc_wp_search");
	vc_remove_element("vc_wp_links");
	vc_remove_element("vc_wp_meta");
	vc_remove_element("vc_wp_recentcomments");
	vc_remove_element("vc_wp_calendar");
	vc_remove_element("vc_wp_pages");
	vc_remove_element("vc_wp_tagcloud");
	vc_remove_element("vc_wp_custommenu");
	vc_remove_element("vc_wp_text");
	vc_remove_element("vc_wp_posts");
	vc_remove_element("vc_wp_categories");
	vc_remove_element("vc_wp_archives");
	vc_remove_element("vc_wp_rss");
	
	/* $wpVC_setup->init($composer_settings); */
	tt_global_blocks::wpb_map_all();

	// Filter to Replace default css class for vc_row shortcode and vc_column
	function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
		if ($tag=='vc_row' || $tag=='vc_row_inner') {
			$class_string = str_replace('vc_row-fluid', 'row clearfix', $class_string);
		}
		if ($tag=='vc_column' || $tag=='vc_column_inner') {
			$class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'grid_$1', $class_string);
			$class_string = preg_replace('/vc_span(\d{1,2})/', '', $class_string);
		}
		return $class_string;
	}
	add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);

	// Filter to Title of Widgets
	function override_widget_title($output = '', $params = array('')) {
		$extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
		return '<div class="b_title"><h4><span>'.$params['title'].'</span></h4></div>';
	}
	add_filter('wpb_widget_title', 'override_widget_title', 10, 2);
} else {}

/*  Admin Posts Thumbs
/* ------------------------------------ */
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults){
	$defaults['riv_post_thumbs'] = __('Cover', 'T20');
	return $defaults;
}
function posts_custom_columns($column_name, $id){
	if($column_name === 'riv_post_thumbs'){
		echo the_post_thumbnail( array(60,60) );
	}
}

/*  Import Export
/* ------------------------------------ */
add_action( 'init', 'register_options_pages' );
function register_options_pages() {

   if ( is_admin() && function_exists( 'ot_register_settings' ) ) {
    ot_register_settings( 
      array(
        array( 
          'id'              => 'import_export',
          'pages'           => array(
            array(
              'id'              => 'import_export',
              'parent_slug'     => 'themes.php',
              'page_title'      => 'Theme Options Backup/Restore',
              'menu_title'      => 'Options Backup',
              'capability'      => 'edit_theme_options',
              'menu_slug'       => 'tmq-theme-backup',
              'icon_url'        => null,
              'position'        => null,
              'updated_message' => 'Options updated.',
              'reset_message'   => 'Options reset.',
              'button_text'     => 'Save Changes',
              'show_buttons'    => false,
              'screen_icon'     => 'themes',
              'contextual_help' => null,
              'sections'        => array(
                array(
                  'id'          => 'tmq_import_export',
                  'title'       => __( 'Import/Export', 'yourtextdomain' )
                )
              ),
              'settings'        => array(
                array(
                    'id'          => 'import_data_text',
                    'label'       => 'Import Theme Options',
                    'desc'        => __( 'Theme Options', 'yourtextdomain' ),
                    'std'         => '',
                    'type'        => 'import-data',
                    'section'     => 'tmq_import_export',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  ),
                  array(
                    'id'          => 'export_data_text',
                    'label'       => 'Export Theme Options',
                    'desc'        => __( 'Theme Options', 'yourtextdomain' ),
                    'std'         => '',
                    'type'        => 'export-data',
                    'section'     => 'tmq_import_export',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  )
              )
            )
          )
        )
      )
    );
  }
}

/*  Import Data
/* ------------------------------------ */
if ( ! function_exists( 'ot_type_import_data' ) ) {
	function ot_type_import_data() {
		echo '<form method="post" id="import-data-form">';
		wp_nonce_field( 'import_data_form', 'import_data_nonce' );
		echo '<div class="format-setting type-textarea has-desc">';
		echo '<div class="description">';

		if ( OT_SHOW_SETTINGS_IMPORT ) 
			echo '<p>' . __( 'Only after you\'ve imported the Settings should you try and update your Theme Options.', 'option-tree' ) . '</p>';
			echo '<p>' . __( 'To import your Theme Options copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Import Theme Options" button.', 'option-tree' ) . '</p>';
			echo '<button class="option-tree-ui-button blue right hug-right">' . __( 'Import Theme Options', 'option-tree' ) . '</button>';
			echo '</div>';
			echo '<div class="format-setting-inner">';
			echo '<textarea rows="10" cols="40" name="import_data" id="import_data" class="textarea"></textarea>';
			echo '</div>';
			echo '</div>';
			echo '</form>';
	}
}

/*  Export Data
/* ------------------------------------ */
if ( ! function_exists( 'ot_type_export_data' ) ) {
	function ot_type_export_data() {
		echo '<div class="format-setting type-textarea simple has-desc">';
		echo '<div class="description">';
		echo '<p>' . __( 'Export your Theme Options data by highlighting this text and doing a copy/paste into a blank .txt file. Then save the file for importing into another install of WordPress later. Alternatively, you could just paste it into the <code>OptionTree->Settings->Import</code> <strong>Theme Options</strong> textarea on another web site.', 'option-tree' ) . '</p>';
		echo '</div>';

		$data = get_option( 'option_tree' );
		$data = ! empty( $data ) ? ot_encode( serialize( $data ) ) : '';

		echo '<div class="format-setting-inner">';
		echo '<textarea rows="10" cols="40" name="export_data" id="export_data" class="textarea">' . $data . '</textarea>';
		echo '</div>';
		echo '</div>';
	}
}

/*  Gallery
/* ------------------------------------ */
add_filter( 'wp_get_attachment_link', 'sant_prettyadd');
function sant_prettyadd ($content) {
	$content = preg_replace("/<a/","<a class=\"prettyphoto\" rel=\"prettyPhoto[gallery]\"",$content,1);
	return $content;
}

/*  Remove plugin notifications
/* ------------------------------------ */
function filter_plugin_updates( $value ) {
	if( isset( $value->response['js_composer/js_composer.php'] ) ) {
		unset( $value->response['js_composer/js_composer.php'] );
	}
	if( isset( $value->response['revslider/revslider.php'] ) ) {
		unset( $value->response['revslider/revslider.php'] );
	}
	if( isset( $value->response['masterslider/masterslider.php'] ) ) {
		unset( $value->response['masterslider/masterslider.php'] );
	}
	if( isset( $value->response['essential-grid/essential-grid.php'] ) ) {
		unset( $value->response['essential-grid/essential-grid.php'] );
	}
	return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
