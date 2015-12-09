<?php 
/**
 * Buddypress Wrapper
 *
 * @package sevenmag
 */

	get_header(); 
	$bp_p = bp_primary();
	$bp_s = bp_secondary();

	$layout = ot_get_option('layout-bp');
	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $bp_p ); ?>
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

		<div class="b_block clearfix">
			<?php if (have_posts()) { 
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			} ?>
		</div>

	</div>

<?php if ( $layout == 'both-sidebar' ): ?>

	<div class="grid_3 righter omega">
		<?php dynamic_sidebar( $bp_s ); ?>
	</div>

<?php elseif ( $layout == 'both-sidebar-right' ):  ?>

	<div class="grid_3">
		<?php dynamic_sidebar( $bp_s ); ?>
	</div>

	<div class="grid_3 omega">
		<?php dynamic_sidebar( $bp_p ); ?>
	</div>

<?php elseif ( $layout == 'sidebar-right' ):  ?>

	<div class="grid_3 omega">
		<?php dynamic_sidebar( $bp_p ); ?>
	</div>

<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $bp_p ); ?>
	</div>

	<div class="grid_3">
		<?php dynamic_sidebar( $bp_s ); ?>
	</div>

<?php elseif ( $layout == 'sidebar-left' ):  ?>

	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $bp_p ); ?>
	</div>

<?php elseif ( $layout == 'without-sidebar' ):  endif; get_footer(); ?>