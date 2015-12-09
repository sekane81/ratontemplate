<?php 
	get_header(); 

	$s_p = T20_sidebar_primary();
	wp_reset_postdata();
	global $post;
	$meta = get_post_meta($post->ID,'_layout',true);

	if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) : 
		$layout = $meta; 
	else :
		$layout = ot_get_option('layout-global');
	endif; 

	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $s_p ); ?>
	</div><!--/.grid_3-->

	<div class="grid_6 hfeed">
<?php elseif ( $layout == 'both-sidebar-right' ):  ?>
	<div class="grid_6 hfeed alpha">
<?php elseif ( $layout == 'sidebar-right' ):  ?>
	<div class="grid_9 hfeed alpha">
<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
	<div class="grid_6 hfeed righter omega">
<?php elseif ( $layout == 'sidebar-left' ):  ?>
	<div class="grid_9 hfeed righter omega">
<?php elseif ( $layout == 'without-sidebar' ):  ?>
	<div class="clearfix hfeed">
<?php endif; ?>
		<?php while ( have_posts() ): the_post(); ?>
			<div class="b_title"><h1 class="post-title entry-title"><?php echo single_post_title(); ?></h1></div>
			<div class="b_block clearfix">
				<article <?php post_class('r_post introfx hentry'); ?>>	
	
					<div class="details clearfix mb">
						<span class="s_category">
							<a><i class="icon-calendar mi"></i><time class="post_date date updated" datetime="<?php the_time('j M, Y'); ?>"><?php the_time('j M, Y'); ?></time></a>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="icon-user mi"></i><span class="vcard author"><span class="fn"><?php the_author(); ?></span></span></a>
							<span class="morely mid"><i class="icon-folder-open mi"></i><?php the_category(', '); ?></span>
							<?php if(function_exists('the_views')) { ?><span class="mid"><i class="fa fa-eye mi"></i><?php the_views(); ?></span><?php } ?>
							<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
						</span>
						<span class="more_meta">
							<?php if ( comments_open() ): ?>
								<a href="<?php comments_link(); ?>"><span><i class="icon-message mi"></i><?php comments_number( '0', '1', '%' ); ?></span></a>
							<?php endif; ?>
						</span>
					</div><!-- /details -->
						
					<?php if( get_post_format() ) { get_template_part('inc/post-formats'); } else { if ( has_post_thumbnail() ): ?>
						<?php if ( ot_get_option('single_featured') != 'off' ) { ?>
						<div class="mbf">
							<div class="image-container" itemprop="image">
								<?php the_post_thumbnail('full'); ?>
								<?php 
									$caption = get_post(get_post_thumbnail_id())->post_excerpt;
									$description = get_post(get_post_thumbnail_id())->post_content;
									if ( isset($caption) && $caption ) echo '<div class="caption">'.$caption.'</div>';
								?>
							</div>
							<?php if ( isset($description) && $description ) echo '<div class="description mt"><i>'.$description.'</i></div>'; ?>
						</div>
					<?php } endif; } ?>
	
					<div itemprop="description" class="entry-content inside_single"><?php global $more; $more = 0; the_content('<span>'.ot_get_option('read_more_text').'</span>'); ?></div>
					<?php wp_link_pages(array('before'=>'<div class="wp-pagenavi clearfix">'.__('<span class="extend mid">'.ot_get_option('pages_post_tr').'</span>','T20'),'after'=>'</div>','link_after'=>'</b>','link_before'=>'<b>')); ?>	
	
				</article><!--/.post-->
				<?php the_tags('<p class="mtf tagcloud single_post"><span>'.ot_get_option('tags_post_tr').'</span> ','','</p>'); ?>
			</div><!-- /b block -->
		<?php endwhile; ?>

		<?php if ( ot_get_option( 'share_post' ) != 'none' ) : get_template_part('inc/share-posts'); endif; ?>

	<?php if ( 'post' == get_post_type() ) { ?>
		<?php if ( ( ot_get_option( 'author_box' ) != 'off' ) && get_the_author_meta( 'description' ) ): ?>
			<div class="b_title"><h3><?php echo ot_get_option('author_post_tr'); ?> <?php the_author_meta('display_name'); ?></h3></div>
			<div class="b_block clearfix">
				<div class="author_box introfx clearfix">
					<div class="author_avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'90'); ?></div>
					<p class="author_desc"><?php the_author_meta('description'); ?></p>
					<div class="widget_social">
						<div class="social with_color">
							<?php if ( get_the_author_meta( 'url' ) ) : ?>
								<a href="<?php the_author_meta( 'url' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('Website', 'T20'); ?>" target="_blank"><i class="fa fa-home"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
								<a href="<?php the_author_meta( 'facebook' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Facebook', 'T20'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
								<a href="<?php the_author_meta( 'twitter' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Twitter', 'T20'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'dribbble' ) ) : ?>
								<a href="<?php the_author_meta( 'dribbble' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Dribbble', 'T20'); ?>" target="_blank"><i class="fa fa-dribbble"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'github' ) ) : ?>
								<a href="<?php the_author_meta( 'github' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Github', 'T20'); ?>" target="_blank"><i class="fa fa-github"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
								<a href="<?php the_author_meta( 'instagram' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Instagram', 'T20'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
								<a href="<?php the_author_meta( 'linkedin' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Linkedin', 'T20'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
								<a href="<?php the_author_meta( 'pinterest' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Pinterest', 'T20'); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'skype' ) ) : ?>
								<a href="<?php the_author_meta( 'skype' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Skype', 'T20'); ?>" target="_blank"><i class="fa fa-skype"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'cloud' ) ) : ?>
								<a href="<?php the_author_meta( 'cloud' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Soundcloud', 'T20'); ?>" target="_blank"><i class="fa fa-cloud"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'youtube' ) ) : ?>
								<a href="<?php the_author_meta( 'youtube' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Youtube', 'T20'); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'tumblr' ) ) : ?>
								<a href="<?php the_author_meta( 'tumblr' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Tumblr', 'T20'); ?>" target="_blank"><i class="fa fa-tumblr"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'star' ) ) : ?>
								<a href="<?php the_author_meta( 'star' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Reverbnation', 'T20'); ?>" target="_blank"><i class="fa fa-star"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'flickr' ) ) : ?>
								<a href="<?php the_author_meta( 'flickr' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Flickr', 'T20'); ?>" target="_blank"><i class="fa fa-flickr"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'googleplus' ) ) : ?>
								<a rel="author" itemprop="author" href="<?php the_author_meta( 'googleplus' ); ?>?rel=author" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Google+', 'T20'); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'foursquare' ) ) : ?>
								<a href="<?php the_author_meta( 'foursquare' ); ?>" class="toptip" title="<?php the_author_meta( 'display_name' ); ?> <?php _e('on Foursquare', 'T20'); ?>" target="_blank"><i class="fa fa-foursquare"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'envelope' ) ) : ?>
								<a href="<?php the_author_meta( 'envelope' ); ?>" class="toptip" title="<?php _e('Contact with', 'T20'); ?> <?php the_author_meta( 'display_name' ); ?>" target="_blank"><i class="fa fa-envelope-o"></i></a>
							<?php endif ?>
						</div>
					</div>
				</div><!-- /author -->
			</div><!-- /block -->
		<?php endif; ?>
		
		<ul class="post_nav introfx clearfix">
			<?php if ( is_rtl() ) { ?>
				<li class="next"><?php previous_post_link('%link', '<strong><i class="fa fa-chevron-right"></i> '.ot_get_option('prev_post_tr').'</strong> <span>%title</span>'); ?></li>
				<li class="previous"><?php next_post_link('%link', '<strong>'.ot_get_option('next_post_tr').'<i class="fa fa-chevron-left"></i></strong> <span>%title</span>'); ?></li>
			<?php } else { ?>
				<li class="previous"><?php previous_post_link('%link', '<strong><i class="fa fa-chevron-left"></i>'.ot_get_option('prev_post_tr').'</strong> <span>%title</span>'); ?></li>
				<li class="next"><?php next_post_link('%link', '<strong>'.ot_get_option('next_post_tr').' <i class="fa fa-chevron-right"></i></strong> <span>%title</span>'); ?></li>
			<?php } ?>
		</ul>
		
		<?php if ( ot_get_option( 'related_posts' ) != 'none' ) : get_template_part('inc/related-posts'); endif; ?>
	<?php } ?>
		
		<?php comments_template('/comments.php',true); ?>
	</div><!--/grid posts -->
<?php 
	get_sidebar();
	get_footer(); 
?>