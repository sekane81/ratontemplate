<?php 
	get_header(); 

	$s_p = ot_get_option('_woo_primary');
	$s_s = ot_get_option('_woo_secondary');
	$layout = ot_get_option('layout-woo');
	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $s_p ); ?>
	</div>
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

		<?php if ( is_shop() ) : ?>
			<div class="b_title"><h3><?php woocommerce_page_title(); ?></h3></div>
		<?php else : ?>
			<div class="b_title"><h3><?php single_post_title(); ?></h3></div>
		<?php endif; ?>

		<div class="b_block clearfix">
			<div class="post introfx clearfix">
				<?php if (have_posts()) : 
					woocommerce_content();
				endif; ?>
			</div><!--/post -->
		</div><!--/block -->
	</div><!--/.grid -->


<?php if ( $layout == 'both-sidebar' ): ?>
	<div class="grid_3 righter omega">
		<?php dynamic_sidebar( $s_s ); ?>
	</div>
<?php elseif ( $layout == 'both-sidebar-right' ):  ?>
	<div class="grid_3">
		<?php dynamic_sidebar( $s_s ); ?>
	</div>
	<div class="grid_3 omega">
		<?php dynamic_sidebar( $s_p ); ?>
	</div>
<?php elseif ( $layout == 'sidebar-right' ):  ?>
	<div class="grid_3 omega">
		<?php dynamic_sidebar( $s_p ); ?>
	</div>
<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $s_p ); ?>
	</div>
	<div class="grid_3">
		<?php dynamic_sidebar( $s_s ); ?>
	</div>
<?php elseif ( $layout == 'sidebar-left' ):  ?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $s_p ); ?>
	</div>
<?php elseif ( $layout == 'without-sidebar' ):  ?>
<?php 
	endif; 
	get_footer(); 
?>