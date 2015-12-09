<?php
/**
 * The template for displaying posts in the Standard Post Format
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

		<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumb">

					<?php
						if ( $ct_post_class == 'one_columns_sidebar' ) :
							$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb-crop');
						else :
							$not_crop = stripslashes( $ct_options['ct_blog_blocks_featured_type'] );										
									    
						    if ( $not_crop == 'original' )
						    	$thumb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb'); 
						    else
						    	$thumb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb-crop'); 
						endif;
					?>
					<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $thumb_image_url[0]; ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" /></a>
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