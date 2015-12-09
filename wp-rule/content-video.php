<?php
/**
 * The template for displaying posts in the Video Post Format
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */
?>

<?php 
	global $ct_options, $post, $ct_post_class;

	$post_type = get_post_meta($post->ID, 'ct_mb_post_type', true);
	if( $post_type == '' ) $post_type = 'standard_post';
?>

<?php if ($post_type == 'standard_post') : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-box clearfix' ); ?> itemscope itemtype="http://schema.org/BlogPosting">
<?php else : // review ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-box clearfix' ); ?> itemscope itemtype="http://data-vocabulary.org/Review">
<?php endif; ?>

	<?php
	

	// Color for top line ( by default: #000000 )
	$bg_color_top_line = get_post_meta( $post->ID, 'ct_mb_post_top_line_bg_color', true);
	
	if ( empty( $bg_color_top_line ) ) $bg_color_top_line = $ct_options['ct_post_top_line_bg_color'];
	
	// from post Metabox
	$show_title = get_post_meta( $post->ID, 'ct_mb_show_post_title', true);
	$show_content = get_post_meta( $post->ID, 'ct_mb_show_post_content', true);

	if ( empty( $show_title ) ) $show_title = 1;
	if ( empty( $show_content ) ) $show_content = 1;
	
	//from Admin Panel
	$show_date = $ct_options['ct_date_meta'];
	$show_categories = $ct_options['ct_categories_meta'];
	$show_author = $ct_options['ct_author_meta'];
	$show_comments = $ct_options['ct_comments_meta'];
	$show_views = $ct_options['ct_views_meta'];
	$show_likes = $ct_options['ct_likes_meta'];

	$excerpt_function = $ct_options['ct_excerpt_function'];
	$excerpt_length = $ct_options['ct_excerpt_length'];
	$mb_excerpt_length = get_post_meta( $post->ID, 'ct_mb_excerpt_length', true);	
	if ( empty( $mb_excerpt_length ) ) $mb_excerpt_length = '0';
?>

		<div class="post-block <?php echo $ct_post_class; ?>">

	<?php
		$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
		$thumb_type = get_post_meta( $post->ID, 'ct_mb_post_video_thumb', true );
		$videoid = get_post_meta( $post->ID, 'ct_mb_post_video_file', true );
		$perma_link = get_permalink($post->ID);

		if ( empty($thumb_type) ) { $thumb_type = 'player'; }

		if ( $thumb_type != 'player' ) { $thumb_type_class = 'ct-'.$thumb_type; } else { $thumb_type_class = ''; }
	?>

		<?php if( $videoid != '' ) : ?>
			<div class="entry-thumb <?php echo $thumb_type_class; ?>">

				<?php
				// for Youtube
				if ( $video_type == 'youtube' ) {
					if ( $thumb_type == 'auto' ) {
						echo '<a href="' . $perma_link . '"><img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" /></a>';
			  		}
			  		else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
							$not_crop = stripslashes( $ct_options['ct_blog_blocks_featured_type'] );										
									    
						if ( $ct_post_class == 'one_columns_sidebar' ) :
							$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb-crop');
						else :
							$not_crop = stripslashes( $ct_options['ct_blog_blocks_featured_type'] );										
									    
						    if ( $not_crop == 'original' )
						    	$small_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb'); 
						    else
						    	$small_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb-crop'); 
						endif;

						echo '<a href="' . $perma_link . '"><img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" /></a>';
			  		}
			  		else if ( $thumb_type == 'player' or $thumb_type == '' ) {
						echo '<iframe src="http://www.youtube.com/embed/' . $videoid .'?wmode=opaque"></iframe>';
			  		}
			  		else { echo '<img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" />'; }
 				  
					if ( $thumb_type != 'player' && $thumb_type != '' ) {
						echo '<div class="video youtube"><a href="' . $perma_link . '" title="'. __('Watch Youtube Video','color-theme-framework').'">' . __( 'Youtube Video' , 'color-theme-framework' ) . '<i class="icon-play"></i></a></div>';
			  		}
				} // endif youtube

				// for Vimeo
				else if ( $video_type == 'vimeo' ) {
					if ( $thumb_type == 'auto' ) {
						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
						echo '<a href="' . $perma_link . '"><img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" /></a>';
			  		} 
			  		else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
							$not_crop = stripslashes( $ct_options['ct_blog_blocks_featured_type'] );										
									    
							if ( $ct_post_class == 'one_columns_sidebar' ) :
								$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb-crop');
							else :
								$not_crop = stripslashes( $ct_options['ct_blog_blocks_featured_type'] );										
										    
							    if ( $not_crop == 'original' )
							    	$small_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb'); 
							    else
							    	$small_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb-crop'); 
							endif;

						echo '<a href="' . $perma_link . '"><img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" /></a>';
			  		}
			  		else if ( $thumb_type == 'player' or $thumb_type == '' ) {
						echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '"></iframe>';
			  		}
			  		else {
						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
						echo '<img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" />';
			  		}

					if ( $thumb_type != 'player' && $thumb_type != '' ) {
						echo '<div class="video vimeo"><a href="' . $perma_link . '" title="'. __('Watch Vimeo Video','color-theme-framework').'">' . __( 'Vimeo Video' , 'color-theme-framework' ) . '<i class="icon-play"></i></a></div>';
					}
				} //endif Vimeo

				// for Dailymotion
				elseif ( $video_type == 'dailymotion' ) {
					if ( $thumb_type == 'auto' ) {
						echo '<a href="' . $perma_link . '"><img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" /></a>';
			  		} 
			  		else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
							$not_crop = stripslashes( $ct_options['ct_blog_blocks_featured_type'] );										
									    
							if ( $ct_post_class == 'one_columns_sidebar' ) :
								$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb-crop');
							else :
								$not_crop = stripslashes( $ct_options['ct_blog_blocks_featured_type'] );										
										    
							    if ( $not_crop == 'original' )
							    	$small_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb'); 
							    else
							    	$small_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb-crop'); 
							endif;
						
						echo '<a href="' . $perma_link . '"><img src="' . $small_image_url[0] . '" alt="'. the_title('','',false) . '" /></a>';
			  		}
			  		else if ( $thumb_type == 'player' or $thumb_type == '' ) {
						echo '<iframe src="http://www.dailymotion.com/embed/video/' . $videoid . '"></iframe>';
			  		}
			  		else {
						echo '<img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" />';
			  		}										

					if ( $thumb_type != 'player' && $thumb_type != '' ) {
						echo '<div class="video dailymotion"><a href="' . $perma_link . '" title="'. __('Watch DailyMotion Video','color-theme-framework').'">' . __( 'Dailymotion Video' , 'color-theme-framework' ) . '<i class="icon-play"></i></a></div>';
			  		}
				} //endif Dailymotion
		  		?>
			</div> <!-- .entry-thumb -->
		<?php endif; ?>

	<div class="entry-post-content">
		<header class="entry-header">
				<div class="entry-post-date" style="border-top-color: <?php echo $bg_color_top_line; ?>">
					<?php if ( $show_date == 1 ) : ?>
					<div class="date-month">
						<?php echo esc_attr( get_the_date( 'M j, Y' ) ); ?>						
					</div>
					<?php endif; ?>
				</div>

				<?php if ( $show_title == '1' ) : ?>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				<?php endif; ?>	
		</header><!-- .entry-header -->

		<?php if( $show_content == 1 ) : ?>
			<div class="entry-content<?php if( $show_title == 0 ) echo ' margin-15t'; ?>" itemprop="articleBody">
				<?php
					if ( $excerpt_function == 'Content' ) : 
							the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'color-theme-framework' ) ); 
						elseif ( $excerpt_function == 'Excerpt' ) : 
							if ( $mb_excerpt_length != '0' ) { 
								ct_excerpt_max_charlength( $mb_excerpt_length ); 
							} else {
								ct_excerpt_max_charlength( $excerpt_length ); 
							}
							?>
				<?php endif; ?>								
			</div> <!-- /entry-content -->
		<?php endif; ?>
		
		<?php if ( ( $show_categories == 1 ) or ( $show_author == 1 ) ) : ?>
			<div class="entry-meta clearfix<?php if( $show_title == 0 ) echo ' margin-15t'; ?>">
				<?php if ( $show_categories == 1 ) : ?>
					<?php _e( 'in ' , 'color-theme-framework' ); ?>
					<?php echo get_the_category_list(', '); ?>
				<?php endif; ?>
					
				<?php
					if ( ( $show_categories == 1 ) && ( $show_author == 1 ) ) _e( ' &mdash; by ' , 'color-theme-framework' );
					if ( ( $show_categories == 0 ) && ( $show_author == 1 ) ) _e( 'by ' , 'color-theme-framework' ); else
					if ( ( $show_categories == 1 ) && ( $show_author == 0 ) ) _e( '' , 'color-theme-framework' ); 
					
					if ( $show_author == 1 ) echo the_author_posts_link();
				?>
			</div> <!-- /entry-meta -->	
		<?php endif; ?>

		<div class="clear"></div>

		<?php 
			// Displays a link to edit the current post, if a user is logged in and allowed to edit the post
			edit_post_link( __( 'Edit', 'color-theme-framework' ), '<span class="edit-link"><i class="icon-pencil"></i>', '</span>' );
		?>


		<?php 
			$post_type = get_post_meta( $post->ID, 'ct_mb_post_type', true);
			if ( empty( $post_type ) ) $post_type = 'standard_post';

			if( ( $show_comments == 1 ) or ( $show_views == 1 ) or ( $show_likes == 1 ) or ( $post_type != 'standard_post' ) ) {
					echo '<div class="divider-1px-meta"></div>';
			} 
		?>

		<footer class="entry-extra clearfix">
			<?php ct_get_post_meta( $post->ID, $show_comments, $show_views, $show_likes );	?>
		</footer><!-- .entry-meta -->
	</div> <!-- /entry-post-content -->

	</div> <!-- /post-block -->  
</article><!-- #post-ID -->