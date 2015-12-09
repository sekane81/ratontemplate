<?php 
/**
 * bbpress Wrapper
 *
 * @package sevenmag
 */

	get_header(); 
	$bbp_p = bbp_primary();
	$bbp_s = bbp_secondary();

	$layout = ot_get_option('layout-bbp');
	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $bbp_p ); ?>
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

		<?php if (have_posts()) { 
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
		} ?>
	</div>

<?php if ( $layout == 'both-sidebar' ): ?>

	<div class="grid_3 righter omega">
		<?php dynamic_sidebar( $bbp_s ); ?>
	</div>

<?php elseif ( $layout == 'both-sidebar-right' ):  ?>

	<div class="grid_3">
		<?php dynamic_sidebar( $bbp_s ); ?>
	</div>

	<div class="grid_3 omega">
		<?php dynamic_sidebar( $bbp_p ); ?>
	</div>

<?php elseif ( $layout == 'sidebar-right' ):  ?>

	<div class="grid_3 omega">
		<?php dynamic_sidebar( $bbp_p ); ?>
	</div>

<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $bbp_p ); ?>
	</div>

	<div class="grid_3">
		<?php dynamic_sidebar( $bbp_s ); ?>
	</div>

<?php elseif ( $layout == 'sidebar-left' ):  ?>

	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $bbp_p ); ?>
	</div>

<?php elseif ( $layout == 'without-sidebar' ):  endif; 
get_footer(); ?>
