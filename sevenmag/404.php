<?php 
	get_header(); 
	$layout = ot_get_option('layout-global');
	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( 'primary' ); ?>
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

		<?php get_template_part('inc/page-title'); ?>
		<div class="b_block">
			<h1 class="mbt mt"><?php echo ot_get_option('error_tr'); ?></h1>
			<p><?php echo ot_get_option('error_info_tr'); ?></p>
			<?php get_search_form(); ?>
		</div><!--/block-->
	</div><!--/grid-->

<?php 
	get_sidebar();
	get_footer(); 
?>