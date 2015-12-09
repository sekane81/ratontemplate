<?php 
	get_header(); 
	$layout = ot_get_option('layout-global');
	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( 'primary' ); ?>
	</div><!--/.grid_3-->

	<div class="grid_6 posts">
<?php elseif ( $layout == 'both-sidebar-right' ):  ?>
	<div class="grid_6 alpha posts">
<?php elseif ( $layout == 'sidebar-right' ):  ?>
	<div class="grid_9 alpha posts">
<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
	<div class="grid_6 righter omega posts">
<?php elseif ( $layout == 'sidebar-left' ):  ?>
	<div class="grid_9 righter omega posts">
<?php elseif ( $layout == 'without-sidebar' ):  ?>
	<div class="clearfix posts">
<?php endif; ?>

	<?php
		global $wp_query;
		$curauth = $wp_query->get_queried_object();
		$userid = $curauth->ID;

		if ( ( ot_get_option( 'author_box' ) != 'off' ) && $curauth->description ): ?>
			<div class="b_title"><h3><?php echo ot_get_option('author_post_tr'); ?> <?php echo $curauth->display_name; ?></h3></div>
			<div class="b_block clearfix">
				<div class="author_box introfx clearfix">
					<div class="author_avatar"><?php echo get_avatar( $curauth->user_email ,'90'); ?></div>
					<p class="author_desc"><?php echo $curauth->description; ?></p>
					<div class="widget_social">
						<div class="social with_color">
							<?php if ( get_the_author_meta( 'url', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'url', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('Website', 'T20'); ?>" target="_blank"><i class="fa fa-home"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'facebook', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'facebook', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Facebook', 'T20'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'twitter', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'twitter', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Twitter', 'T20'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'dribbble', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'dribbble', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Dribbble', 'T20'); ?>" target="_blank"><i class="fa fa-dribbble"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'github', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'github', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Github', 'T20'); ?>" target="_blank"><i class="fa fa-github"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'instagram', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'instagram', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Instagram', 'T20'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'linkedin', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'linkedin', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Linkedin', 'T20'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'pinterest', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'pinterest', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Pinterest', 'T20'); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'skype', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'skype', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Skype', 'T20'); ?>" target="_blank"><i class="fa fa-skype"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'cloud', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'cloud', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Soundcloud', 'T20'); ?>" target="_blank"><i class="fa fa-cloud"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'youtube', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'youtube', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Youtube', 'T20'); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'tumblr', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'tumblr', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Tumblr', 'T20'); ?>" target="_blank"><i class="fa fa-tumblr"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'star', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'star', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Reverbnation', 'T20'); ?>" target="_blank"><i class="fa fa-star"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'flickr', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'flickr', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Flickr', 'T20'); ?>" target="_blank"><i class="fa fa-flickr"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'googleplus', $userid ) ) : ?>
								<a rel="author" itemprop="author" href="<?php the_author_meta( 'googleplus', $userid ); ?>?rel=author" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Google+', 'T20'); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'foursquare', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'foursquare', $userid ); ?>" class="toptip" title="<?php echo $curauth->display_name; ?> <?php _e('on Foursquare', 'T20'); ?>" target="_blank"><i class="fa fa-foursquare"></i></a>
							<?php endif ?>
							<?php if ( get_the_author_meta( 'envelope', $userid ) ) : ?>
								<a href="<?php the_author_meta( 'envelope', $userid ); ?>" class="toptip" title="<?php _e('Contact with', 'T20'); ?> <?php echo $curauth->display_name; ?>" target="_blank"><i class="fa fa-envelope-o"></i></a>
							<?php endif ?>
						</div>
					</div>
				</div><!-- /author -->
			</div><!-- /block -->
		<?php endif; get_template_part('inc/page-title'); ?>

		<?php if ( ot_get_option('posts_type') === '2' ) { ?><div id="masonry-container" class="<?php echo ot_get_option('posts_type_col'); ?> transitions-enabled centered clearfix"><?php } ?>
		<?php if ( have_posts() ) : while ( have_posts() ): the_post();
			if ( ot_get_option('posts_type') === '2' ) {
				get_template_part('content-masonry');
			} else {
				get_template_part('content');
			}
			endwhile;
			if ( ot_get_option('posts_type') === '2' ) { ?></div><?php }
			get_template_part('inc/pagination');
		else: if ( ot_get_option('posts_type') === '2' ) { ?></div><?php } ?>
			<h2 class="mbt mt"><?php echo ot_get_option('archive_tr'); ?></h2>
		<?php endif; ?>
	</div><!--/.grid posts -->

<?php 
	get_sidebar();
	get_footer(); 
?>