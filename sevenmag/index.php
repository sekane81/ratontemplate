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
	<div class="posts clearfix">
<?php endif; ?>
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
	</div><!--/grid posts -->
<?php 
	get_sidebar();
	get_footer(); 
?>