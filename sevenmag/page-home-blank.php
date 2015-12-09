<?php
	/* Template Name: Home - blank */
	get_header(); 

	$s_p = T20_sidebar_primary();
	wp_reset_postdata();
	global $post;
	$loop = get_post_meta($post->ID,'_loop',true);
	$loop_category = get_post_meta($post->ID,'_loop_category',true);
	$masonry = get_post_meta($post->ID,'masonry_meta',true);
	$masonry_col = get_post_meta($post->ID,'masonry_col',true);
	$page_title = get_post_meta($post->ID,'_page_title',true);
	$page_comments = get_post_meta($post->ID,'_page_comments',true);
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

	<div class="grid_6">
<?php elseif ( $layout == 'both-sidebar-right' ):  ?>
	<div class="grid_6 alpha">
<?php elseif ( $layout == 'sidebar-right' ):  ?>
	<div class="grid_9 alpha">
<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
	<div class="grid_6 righter omega">
<?php elseif ( $layout == 'sidebar-left' ):  ?>
	<div class="grid_9 righter omega">
<?php elseif ( $layout == 'without-sidebar' ):  ?>
	<div class="clearfix">
<?php endif; ?>

		<?php if ( $page_title === 'on' ) { ?>
			<div class="b_title"><h3><?php the_title(); ?></h3></div>
		<?php } ?>

		<div class="post clearfix">
			<?php if (have_posts()) { 
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			} else {} ?>
		</div>

		<?php if ( $loop === 'on' ) { ?>
			<div class="posts mbf clearfix">
				<div class="post_item">
				<?php if ( $masonry === 'on' ) { ?><div id="masonry-container" class="<?php echo $masonry_col; ?> transitions-enabled centered clearfix"><?php } ?>
					<?php 
						global $paged;
						if ( is_front_page() ) {
							$paged = (get_query_var('page')) ? get_query_var('page') : 1;   
						} else {
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
						}
						query_posts(array(
							'post_type'		=> 'post',
							'category__and' 		=> $loop_category,
							'paged'			=> $paged
						));
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							if ( $masonry === 'on' ) {
								get_template_part('content-masonry');
							} else {
								get_template_part('content');
							}
						endwhile; ?>
				<?php if ( $masonry === 'on' ) { ?></div><?php } ?>
				</div><!--/.posts-->
				<?php get_template_part('inc/pagination'); endif; wp_reset_query(); ?>
			</div><!--/posts -->
		<?php } ?>

		<?php if ( $page_comments === 'on' ) { comments_template('/comments.php',true); } ?>
	</div><!--/.grid -->

<?php 
	get_sidebar();
	get_footer(); 
?>