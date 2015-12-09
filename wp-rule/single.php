<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */

get_header(); ?>

<?php
	global $ct_options, $post, $wpdb;;

	$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);
	$featured_image_post = stripslashes( $ct_options['ct_featured_image_post'] );
	$about_author = stripslashes( $ct_options['ct_author_meta'] );

	$show_comments = stripslashes( $ct_options['ct_single_comments_meta'] );
	$show_date = stripslashes( $ct_options['ct_single_date_meta'] );
	$show_categories = stripslashes( $ct_options['ct_single_categories_meta'] );
	$show_likes = stripslashes( $ct_options['ct_single_likes_meta'] );
	$show_views = stripslashes( $ct_options['ct_single_views_meta'] );
	$show_tags = stripslashes( $ct_options['ct_single_tags_meta'] );

	$review_position = get_post_meta( $post->ID, 'ct_mb_review_position', true);

	if ( $review_position == '' ) $review_position = 'before_content';

	if ( $mb_sidebar_position == '' ) $mb_sidebar_position = 'right';
?>

<div class="container">
	<div class="page-title-bar">
		<div class="row-fluid">
			<header>
				<div class="span9">
				 	<h1 class="archive-title"><?php the_title(); ?></h1>
				 </div>	
					<div class="span3">
						<nav class="nav-single-top">	
							<h3 class="assistive-text"><?php _e( 'Post navigation', 'color-theme-framework' ); ?></h3>
							<span class="nav-next-top"><?php next_post_link( '%link', '<span class="icon-chevron-right" title="%title">' . _x( '', 'Next post link', 'color-theme-framework' ) . '</span>' ); ?></span>
							<span class="nav-previous-top"><?php previous_post_link( '%link', '<span class="icon-chevron-left" title="%title">' . _x( '', 'Previous post link', 'color-theme-framework' ) . '</span>' ); ?></span>						
						</nav><!-- .nav-single -->
					</div>				 
			</header>
		</div> <!-- /row-fluid -->
	</div><!-- /archive-header -->
</div>	

<div class="container">
	
	<div class="row-fluid">

		<?php 
		/*
			*
			*
			*	Get Meta Information If Sidebar Position == RIGHT
			*
			*
		*/
		if ( $mb_sidebar_position == 'right') : ?>
		<div class="span2">
			<div class="entry-single-meta">	
				<?php if ( $show_date == 1 ) : ?>
					<div class="post-month">
						<?php the_time('F j, Y'); ?>
					</div>
					<?php 
						if ( ( $show_comments == 1 ) or ( $show_views == 1 ) or ( $show_likes == 1 ) ) { 
							echo '<div class="divider-1px"></div>';
					 	} 
					?>	
				<?php endif; ?>	
				
				<?php 
					if ( $show_categories == 1 ) {
						echo __( 'in Category: ' , 'color-theme-framework') . get_the_category_list(', '); 						
						echo '<div class="clear"></div>';

						if ( ( $show_comments == 1 ) or ( $show_views == 1 ) or ( $show_likes == 1 ) ) {
							echo '<div class="divider-1px"></div>';
						}
					}
				?>

				<?php if ( ( $show_comments == 1 ) or ( $show_views == 1 ) or ( $show_likes == 1 ) ) : ?>
					<div class="entry-views-likes">
						<?php if ( $show_comments == 1 ) { ?>
							<span class="single-meta-margin"><i class="icon-comment"></i><?php comments_popup_link( __( '<b>0</b>', 'color-theme-framework' ), __( '<b>1</b>', 'color-theme-framework' ), __( '<b>%</b>', 'color-theme-framework' ) ); ?></span>
						<?php } ?>
						<?php if ( $show_views == 1 ) { ?>	
							<span class="single-meta-margin"><i class="icon-eye-open"></i><?php echo getPostViews( get_the_ID() ); ?></span>
						<?php } ?>	
						<?php 
							if ( $show_likes == 1 ) {
								getPostLikeLink( get_the_ID() ); 
							}	
						?>
					</div> <!-- /entry-views-likes -->	
				<?php endif; ?>
			</div> <!-- /entry-single-meta -->

			<?php 
				$sharing_code = stripslashes( $ct_options['ct_code_blog_sharing'] );

				if ( !empty( $sharing_code ) ) {
					echo '<div class="share-block">';
						echo $sharing_code;
					echo '</div><!-- /sharing-block -->';	
				}	
			?>	
		</div>
		<?php endif; ?>


		<?php 
		/*
			*
			*
			*	Get Sidebar If Sidebar Position == LEFT
			*
			*
		*/		
		if ( $mb_sidebar_position == 'left') :?>
		<div id="secondary" class="sidebar span4" role="complementary">
			<?php
			global $wp_query; 
			$postid = $wp_query->post->ID; 
			$cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);

			if ($cus != '') {
			  if ($cus[0] != '0') { if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])) : endif; }
			  else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Post Sidebar')) : endif; }
			}
			else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Post Sidebar')) : endif; }
			?>
		</div><!-- .span4 -->
		<?php endif; ?>

		
		<div id="primary" class="span6">

			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php setPostViews(get_the_ID()); ?>
				
				<div class="entry-page">
					<?php 
						$overall_numeric_review = get_post_meta( $post->ID, 'ct_mb_overall_numeric_review', true );
						$review_numeric_bg_color = get_post_meta( $post->ID, 'ct_mb_review_numeric_bg_color', true );
						$review_numeric_value_color = get_post_meta( $post->ID, 'ct_mb_review_numeric_value_color', true );
						$numeric_review_good = get_post_meta( $post->ID, 'ct_mb_review_good', true );
						$numeric_review_bad = get_post_meta( $post->ID, 'ct_mb_review_bad', true );

						if ( empty( $review_numeric_bg_color ) ) $review_numeric_bg_color = '#000';
						if ( empty( $review_numeric_value_color ) ) $review_numeric_value_color = '#FFF';


						$post_type = get_post_meta( $post->ID, 'ct_mb_post_type', true );

						if ( $post_type == 'review_post_numeric' ) :
					?>	
						<div class="num-block-review clearfix">
							<div class="numeric-review clearfix" style="background-color:<?php echo $review_numeric_bg_color; ?>">
									<div class="review-number" style="color: <?php echo $review_numeric_value_color; ?>">
										<?php echo $overall_numeric_review; ?>
									</div> <!-- /review-number -->
							</div> <!-- /numeric-review -->
							<div class="review-right-block">
								<div class="good-review">
									<strong><?php _e( 'Good:' , 'color-theme-framework'); ?></strong>
									<?php echo $numeric_review_good; ?>
								</div>	
								<div class="divider-1px"></div>
								<div class="bad-review">
									<strong><?php _e( 'Bad:' , 'color-theme-framework'); ?></strong>
									<?php echo $numeric_review_bad; ?>
								</div>
							</div>
						</div>
						<div class="divider-5px"></div>
					<?php endif; ?>	
					
				<div class="single-post <?php echo $ct_post_class; ?>">

					<?php $format = get_post_format(); ?>

						<?php 
							/*
							*	----------------------------------------------------------------------------------------------------
							*	POST FORMAT: Image and Standard
							*	----------------------------------------------------------------------------------------------------
							*/
							if ( has_post_format('image') || !get_post_format() ) : ?>	

								<?php
									if ( has_post_thumbnail() && ( $featured_image_post == 1 ) ) {
										$not_crop = stripslashes( $ct_options['ct_featured_type'] );										
									    
									    if ( $not_crop == 'original' )
									    	$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb'); 
									    else
									    	$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb-crop'); 

										$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
									
								?>
									<div class="media-thumb img-format">								
										<a href="<?php echo $large_image_url[0]; ?>" data-rel="prettyPhoto"><img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" /></a>
									</div> <!-- /media-thumb -->
								<?php } ?>

						<?php endif; // image and standard post formats ?>


						<?php if ( has_post_format('audio') ) : ?>
						<?php
							// Get Soundcloud code from Post Metabox
							$soundcloud = get_post_meta( $post->ID, 'ct_mb_post_soundcloud', true );							
						?>

							<?php if ( !empty( $soundcloud ) ) { ?>
								<div class="media-thumb audio-format">
									<?php echo $soundcloud; ?>	
								</div> <!-- /media-thumb -->
							<?php } ?>
						<?php endif; ?>

						<?php if( has_post_format('gallery') ) : ?>

							<?php
							$time_id = rand();
							$meta_gallery = get_post_meta(get_the_ID(), 'ct_mb_gallery', false);

							if (!is_array($meta_gallery)) $meta_gallery = (array) $meta_gallery; ?>

							<?php
							if (!empty($meta_gallery)) {

								if ( !is_admin() ) {
									/* Flex Slider */
									wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
									wp_enqueue_script('flex-min-jquery',array('jquery'));
								} ?>

								<script type="text/javascript">
								/* <![CDATA[ */
									jQuery.noConflict()(function($){
										$(window).load(function () {

											$('#slider-<?php echo $post->ID . '-' . $time_id; ?>').flexslider({
													animation: "fade",
													directionNav: true,
													controlNav: false,
													slideshow: false,
													smoothHeight: true
											});
										});
									});
								/* ]]> */
								</script>

								<!-- Start FlexSlider -->
							<div class="entry-thumb">
								<div id="slider-<?php echo $post->ID . '-' . $time_id; ?>" class="flexslider clearfix">
									<ul class="slides clearfix">

										<?php
										$meta_gallery = implode(',', $meta_gallery);

										$images = $wpdb->get_col("
												SELECT ID FROM $wpdb->posts
												WHERE post_type = 'attachment'
												AND ID in ($meta_gallery)
												ORDER BY menu_order ASC
										");

										foreach ($images as $att) {
											$src = wp_get_attachment_image_src($att, 'single-post-thumb-crop');
											$src_full = wp_get_attachment_image_src($att, 'full');
											$src = $src[0];
											$src_full = $src_full[0]; ?>

											<?php
											echo '<li><a href="' . $src_full . '" data-rel="prettyPhoto[gal]">';
											echo '<img src="' . $src . '" alt="' . the_title('','',false) . '">';
											echo '</a></li>';
										} // end foreach ?>
									</ul><!-- .slides -->
								</div><!-- .flexSlider -->
							</div> <!-- .entry-thumb -->
							<?php } ?>

						<?php endif; ?>

						<?php if( has_post_format('video') ) : ?>

							<?php 
								$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
								$thumb_type = get_post_meta( $post->ID, 'ct_mb_post_video_thumb', true );
								$videoid = get_post_meta( $post->ID, 'ct_mb_post_video_file', true );
							?>
							
							<div class="media-thumb video-post-widget">
							<?php	
								if ( $video_type == 'youtube' ) echo '<iframe src="http://www.youtube.com/embed/' . $videoid .'?wmode=opaque"></iframe>';
								if ( $video_type == 'vimeo' ) echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '"></iframe>';
								if ( $video_type == 'dailymotion' ) echo '<iframe src="http://www.dailymotion.com/embed/video/' . $videoid . '"></iframe>';
							?>
							</div>
						<?php endif; ?>

						<?php 
							if ( $post_type == 'review_post' ) {
								get_template_part( 'includes/single' , 'rating' );
							}	

							/*
							*	------------------------------
							* Show Content
							*	------------------------------
							*/ 
							the_content(); 
						?>

					</div> <!-- /single-post -->

						<?php if ( $show_tags == 1 ) : ?>	
								<?php 
									$posttags = get_the_tags(); 
									if ( $posttags ) {
								?>	
									<span class="meta-tags" title="<?php _e('Tags','color-theme-framework'); ?>">
										<i class="icon-tags"></i>
										<?php echo the_tags('',', ',''); ?>
										<!-- <meta itemprop="keywords" content="<?php //echo strip_tags(get_the_tag_list('',', ','')); ?>"> -->
									</span><!-- .meta-tags -->
									<div class="clear"></div>
									<div class="margin-15b"></div>
								<?php } ?>	
						<?php endif; ?>	

				<?php 
				if ( $about_author ) : ?>
						<!-- about the author -->
						<div id="author-block" class="clearfix" itemscope="" itemtype="http://schema.org/Person">							
							<div id="author-avatar">
								<?php 
								$user_email = get_the_author_meta( 'user_email' );
    							$hash = md5( strtolower( trim ( $user_email ) ) );
    							echo '<img itemprop="image" style="display:none;" src="http://gravatar.com/avatar/' . $hash .'" alt="" />';
								?>
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 75 ) ); ?>
							</div><!-- #author-avatar -->

							<div id="author-description">
								<strong><?php the_author_meta('display_name'); ?></strong>
								<meta itemprop="name" content="<?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?>">
								<meta itemprop="url" content="<?php the_author_meta( 'user_url' ); ?>">
								<p><?php the_author_meta( 'description' ); ?></p>

								<?php 
								$code_about_author = stripslashes( $ct_options['ct_code_about_author'] );
								if ( !empty($code_about_author) ) : ?>
								<p class="add-author-info">
									<?php echo $code_about_author; ?>
								</p><!-- .add-author-info -->
								<?php endif; ?>

								<a style="font-size: 11px;" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php _e('View my other posts', 'color-theme-framework'); ?></a>
							</div><!-- #author-description	-->
						</div><!-- #author-info -->
	  				<?php endif; ?>



							<?php comments_template( '', true ); ?>

							<?php //echo $post->rating; ?>
						</div>	


					<div class="nav-block clearfix">
						<nav class="nav-single">
							<h3 class="assistive-text"><?php _e( 'Post navigation', 'color-theme-framework' ); ?></h3>
							<span class="nav-previous"><?php previous_post_link( '%link', '<span class="icon-chevron-left">' . _x( '', 'Previous post link', 'color-theme-framework' ) . '</span> %title' ); ?></span>
							<span class="nav-next"><?php next_post_link( '%link', '%title <span class="icon-chevron-right">' . _x( '', 'Next post link', 'color-theme-framework' ) . '</span>' ); ?></span>
						</nav><!-- .nav-single -->

						<nav class="nav-single-hidden">
							<?php if( get_previous_post() ) : ?>				
								<span class="nav-previous"><?php previous_posts_link(); ?></span>
							<?php endif; ?>
							<?php if( get_next_post() ) : ?>
		                        <!-- next_posts_link -->
								<span class="nav-next"><?php next_posts_link(); ?></span>
							<?php endif; ?>	
							<div class="clear"></div>
						</nav><!-- .nav-single-hidden -->
					</div><!-- .nav-block -->

					<!-- <div class="comments-block box-shadow-2px clearfix"> -->
						<?php // comments_template( '', true ); ?>
					<!-- </div> --><!-- .comments-block -->
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- .span8 #content -->


		<?php 
		/*
			*
			*
			*	Get Sidebar If Sidebar Position == RIGHT
			*
			*
		*/
		if ( $mb_sidebar_position == 'right') :?>
		<div id="secondary" class="sidebar span4" role="complementary">
			<?php
			global $wp_query; 
			$postid = $wp_query->post->ID; 
			$cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);

			if ($cus != '') {
			  if ($cus[0] != '0') { if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])) : endif; }
			  else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Post Sidebar')) : endif; }
			}
			else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Post Sidebar')) : endif; }
			?>
		</div><!-- .span4 -->
		<?php endif; ?>

		<?php 
		/*
			*
			*
			*	Get Meta Information If Sidebar Position == LEFT
			*
			*
		*/
		if ( $mb_sidebar_position == 'left') : ?>
		<div class="span2">
			<div class="entry-single-meta">	
				<?php if ( $show_date == 1 ) : ?>
					<div class="post-month">
						<?php the_time('F j, Y'); ?>
					</div>
					<?php 
						if ( ( $show_comments == 1 ) or ( $show_views == 1 ) or ( $show_likes == 1 ) ) { 
							echo '<div class="divider-1px"></div>';
					 	} 
					?>	
				<?php endif; ?>	
				
				<?php 
					if ( $show_categories == 1 ) {
						echo __( 'in Category: ' , 'color-theme-framework') . get_the_category_list(', '); 						
						echo '<div class="clear"></div>';

						if ( ( $show_comments == 1 ) or ( $show_views == 1 ) or ( $show_likes == 1 ) ) {
							echo '<div class="divider-1px"></div>';
						}
					}
				?>

				<?php if ( ( $show_comments == 1 ) or ( $show_views == 1 ) or ( $show_likes == 1 ) ) : ?>
					<div class="entry-views-likes">
						<?php if ( $show_comments == 1 ) { ?>
							<span class="single-meta-margin"><i class="icon-comment"></i><?php comments_popup_link( __( '<b>0</b>', 'color-theme-framework' ), __( '<b>1</b>', 'color-theme-framework' ), __( '<b>%</b>', 'color-theme-framework' ) ); ?></span>
						<?php } ?>
						<?php if ( $show_views == 1 ) { ?>	
							<span class="single-meta-margin"><i class="icon-eye-open"></i><?php echo getPostViews( get_the_ID() ); ?></span>
						<?php } ?>	
						<?php 
							if ( $show_likes == 1 ) {
								getPostLikeLink( get_the_ID() ); 
							}	
						?>
					</div> <!-- /entry-views-likes -->	
				<?php endif; ?>
			</div> <!-- /entry-single-meta -->

			<?php 
				$sharing_code = stripslashes( $ct_options['ct_code_blog_sharing'] );

				if ( !empty( $sharing_code ) ) {
					echo '<div class="share-block">';
						echo $sharing_code;
					echo '</div><!-- /sharing-block -->';	
				}	
			?>	
		</div>
		<?php endif; ?>

	</div><!-- .row-fluid -->
</div> <!-- .container -->

<?php get_footer(); ?>