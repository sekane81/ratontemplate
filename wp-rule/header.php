<!DOCTYPE html>
<!-- Pravda theme. A ZERGE design (http://www.color-theme.com - http://themeforest.net/user/ZERGE) - Proudly powered by WordPress (http://wordpress.org) -->

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<?php global $ct_options ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 

<?php wp_head(); ?>	

</head>

<body <?php body_class('body-class'); ?>>

<?php
// Load custom background image from Theme Options
	global $wp_query;
		if( is_home() ) {
			$postid = get_option('page_for_posts');
		} elseif( is_search() || is_404() || is_category() || is_tag() || is_author() ) {
			$postid = 0;
		} else {
			$postid = $wp_query->post->ID;
		}

		// Get the unique background image for page
		$bg_img = get_post_meta($postid, 'ct_mb_background_image', true);
		$src = wp_get_attachment_image_src( $bg_img, 'full' );
		$bg_img = $src[0];

		if( empty($bg_img) ) { 
			// Background image not defined, fallback to default background
			$bg_pos = stripslashes ( $ct_options['ct_default_bg_position'] );
			$bg_type = stripslashes ( $ct_options['ct_default_bg_type'] );

			if ( $bg_pos == 'Full Screen' ) {
				$bg_pos = 'full';
			}

			// Get the fullscreen background image for page
			if ( ( $bg_pos == 'full' ) && ( $bg_type != 'Color' ) ) {
				$bg_img = stripslashes ( $ct_options['ct_default_bg_image'] );
				if( !empty($bg_img) ) {
					$ct_page_title = $wp_query->post->post_title;

					echo '<img id="bg-stretch" src="' . $bg_img . '" alt="' . $ct_page_title . '" />';
				}
			}
		} else {
			// else get the unique background image for page
			$bg_pos = get_post_meta($postid, 'ct_mb_background_position', true);

			if( $bg_pos == 'full' ) {
				$ct_page_title = $wp_query->post->post_title;

				echo '<img id="bg-stretch" src="' . $bg_img . '" alt="' . $ct_page_title . '" />';
			}
		}
	?>

<?php 
	$logo_type = stripslashes( $ct_options['ct_type_logo'] );
?>

	<!-- START HEADER -->
	<header id="header">
		<?php if ( is_home() or is_front_page() ) : ?>
			<?php 		
				$show_welcome = stripslashes( $ct_options['ct_show_welcome'] );
				$welcome_text = stripslashes( $ct_options['ct_welcome_text'] ); 
				if ( $show_welcome && !empty( $welcome_text ) ) :
			?>
			<div id="welcome-block">
				<div class="transparent-bg"></div>
				<div class="close-btn" title="<?php _e( 'Close Welcome Screen' , 'color-theme-framework' ); ?>"><i class="icon-remove"></i></div>
				
				<div class="container">
					<div class="row-fluid">
						<?php echo $welcome_text; ?>
					</div> <!-- /row-fluid -->
				</div> <!-- /container -->
			</div> <!-- /welcome-block -->
			<?php endif; ?>
		<?php endif; ?>

		<?php 
			$show_top_banner = stripslashes( $ct_options['ct_top_banner'] );

			if ( !empty( $show_top_banner ) and ( $show_top_banner != 'None' ) ) :
		?>
			<div class="container">			
				<div class="banner" role="banner">
					<?php
						$banner_upload = stripslashes( $ct_options['ct_banner_upload'] );
						$banner_code = stripslashes( $ct_options['ct_banner_code'] );					
				
						if ( $banner_upload != '' && $show_top_banner == 'Upload' ) {
					?>
				
						<a href="<?php echo stripslashes( $ct_options['ct_banner_link'] ); ?>" target="_blank"><img src="<?php echo stripslashes( $ct_options['ct_banner_upload'] ) ?>" alt="" /></a>
						<?php } else if ( $banner_code != '' && $show_top_banner == 'Code' ) { echo $banner_code; } ?>
				</div><!-- /banner -->	
			</div> <!-- /container -->
		<?php endif; ?>

		<?php 
			$menu_position = stripslashes( $ct_options['ct_menu_layout_position'] ); 

			if ( $menu_position == 'before' ) :
		?>
		<!-- START MAIN MENU -->
		<div id="mainmenu-block-bg">
			<div class="transparent-bg"></div>
			<div class="container">
				<div class="row-fluid">
					<div class="span12">
						<div class="navigation" role="navigation">
							<div id="menu">
								<?php 
								if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu'));
								?>
							</div> <!-- /menu -->
						</div>  <!-- /navigation -->
					</div> <!-- /span12 -->
				</div><!-- /row-fluid -->
			</div><!-- /container -->
		</div> <!-- /mainmenu-block-bg -->
		<!-- END MAIN MENU -->
		<?php endif; ?>

		<?php 
			$logo_block_width = stripslashes( $ct_options['ct_logo_block_width'] );
			$right_block_width = stripslashes( $ct_options['ct_right_block_width'] );

			if ( empty( $logo_block_width ) ) $logo_block_width = 'span8';
			if ( empty( $right_block_width ) ) $right_block_width = 'span4';

		?>
		<div class="container header-block">
			<div class="row-fluid top-block">
				<div class="<?php echo $logo_block_width; ?> logo-block">
					<div id="logo">
						<?php if ( $logo_type == "image" ) { ?>
							<?php if ( is_home() or is_front_page() ) echo '<h1>'; ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $ct_options['ct_logo_upload'] ) ?>" alt="" /></a>
							<?php if ( is_home() or is_front_page() ) echo '</h1>'; ?>
						<?php }	?>

						<?php if ( $logo_type == "text" ) { ?>
							<h1><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $ct_options['ct_logo_text'] ); ?></a></h1>
							<span class="logo-slogan"><?php echo stripslashes( $ct_options['ct_logo_slogan'] ); ?></span>
						<?php } ?>
					</div> <!-- /logo -->
				</div><!-- /logo-block -->

				<div class="<?php echo $right_block_width; ?> right-block">
					<?php 
						$show_search = $ct_options['ct_search_block_homepage'];
						if ( $show_search == 1 ) get_search_form(); 
					?>
					<div class="clear">

					<?php 
						$show_social_icons = $ct_options['ct_sc_block']; 
						$social_text = stripslashes( $ct_options['ct_sc_text'] );
						if ( empty( $social_text ) ) $social_text = __( 'Follow Us:' , 'color-theme-framework' );

						$android_url = stripslashes( $ct_options['ct_android_url'] );
						$apple_url = stripslashes( $ct_options['ct_apple_url'] );
						$dribbble_url = stripslashes( $ct_options['ct_dribbble_url'] );
						$github_url = stripslashes( $ct_options['ct_github_url'] );
						$flickr_url = stripslashes( $ct_options['ct_flickr_url'] );
						$youtube_url = stripslashes( $ct_options['ct_youtube_url'] );
						$instagram_url = stripslashes( $ct_options['ct_instagram_url'] );
						$skype_url = stripslashes( $ct_options['ct_skype_url'] );
						$pinterest_url = stripslashes( $ct_options['ct_pinterest_url'] );
						$google_url = stripslashes( $ct_options['ct_google_url'] );
						$twitter_url = stripslashes( $ct_options['ct_twitter_url'] );
						$facebook_url = stripslashes( $ct_options['ct_facebook_url'] );


						if ( $show_social_icons == 1 ) :
					?>
						<ul class="follow-block">				
							<li><?php echo $social_text; ?></li>
							<?php if ( !empty( $android_url ) ) { ?>
								<li><a href="<?php echo $android_url; ?>" title="<?php _e( 'Android' , 'color-theme-framework' ); ?>"><i class="icon-android"></i></a></li>
							<?php } ?>	
							<?php if ( !empty( $apple_url ) ) { ?>
								<li><a href="<?php echo $apple_url; ?>" title="<?php _e( 'Apple' , 'color-theme-framework' ); ?>"><i class="icon-apple"></i></a></li>
							<?php } ?>	
							<?php if ( !empty( $dribbble_url ) ) { ?>
								<li><a href="<?php echo $dribbble_url; ?>" title="<?php _e( 'Dribbble' , 'color-theme-framework' ); ?>"><i class="icon-dribbble"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $github_url ) ) { ?>
								<li><a href="<?php echo $github_url; ?>" title="<?php _e( 'Github' , 'color-theme-framework' ); ?>"><i class="icon-github"></i></a></li>
							<?php } ?>	
							<?php if ( !empty( $flickr_url ) ) { ?>
								<li><a href="<?php echo $flickr_url; ?>" title="<?php _e( 'Flickr' , 'color-theme-framework' ); ?>"><i class="icon-flickr"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $youtube_url ) ) { ?>
								<li><a href="<?php echo $youtube_url; ?>" title="<?php _e( 'Youtube' , 'color-theme-framework' ); ?>"><i class="icon-youtube"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $instagram_url ) ) { ?>
								<li><a href="<?php echo $instagram_url; ?>" title="<?php _e( 'Instagram' , 'color-theme-framework' ); ?>"><i class="icon-instagram"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $skype_url ) ) { ?>
								<li><a href="<?php echo $skype_url; ?>" title="<?php _e( 'Skype' , 'color-theme-framework' ); ?>"><i class="icon-skype"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $pinterest_url ) ) { ?>
								<li><a href="<?php echo $pinterest_url; ?>" title="<?php _e( 'Pinterest' , 'color-theme-framework' ); ?>"><i class="icon-pinterest"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $google_url ) ) { ?>
								<li><a href="<?php echo $google_url; ?>" title="<?php _e( 'Google Plus' , 'color-theme-framework' ); ?>"><i class="icon-google-plus"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $twitter_url ) ) { ?>
								<li><a href="<?php echo $twitter_url; ?>" title="<?php _e( 'Twitter' , 'color-theme-framework' ); ?>"><i class="icon-twitter"></i></a></li>
							<?php } ?>								
							<?php if ( !empty( $facebook_url ) ) { ?>
								<li><a href="<?php echo $facebook_url; ?>" title="<?php _e( 'Facebook' , 'color-theme-framework' ); ?>"><i class="icon-facebook"></i></a></li>
							<?php } ?>								
					</ul>
					<?php endif; ?>	
					</div> <!-- /follow-block -->
				</div> <!-- /right-block -->
			</div><!-- /row-fluid -->
		</div><!-- /container -->


		<?php 
			if ( $menu_position == 'after' ) :
		?>
		<!-- START MAIN MENU -->
		<div id="mainmenu-block-bg">
			<div class="transparent-bg"></div>
			<div class="container">
				<div class="row-fluid">
					<div class="span12">
						<div class="navigation" role="navigation">
							<div id="menu">
								<?php 
								if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu'));
								?>
							</div> <!-- /menu -->
						</div>  <!-- /navigation -->
					</div> <!-- /span12 -->
				</div><!-- /row-fluid -->
			</div><!-- /container -->
		</div> <!-- /mainmenu-block-bg -->
		<!-- END MAIN MENU -->
		<?php endif; ?>		

		
		<?php 
			$menu_position = stripslashes( $ct_options['ct_menu_layout_position'] ); 

			if ( $menu_position == 'before' ) echo '<div class="container"><div class="divider-10px"></div></div>'; else echo '<div class="margin-40b"></div>';
		?>	
	</header> <!-- #header -->
	<!-- END HEADER -->