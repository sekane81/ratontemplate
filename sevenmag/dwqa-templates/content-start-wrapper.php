<?php  

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	wp_reset_postdata();
	$dwqa_p = dwqa_primary();
	$dwqa_s = dwqa_secondary();
	global $post;
	$page_title = get_post_meta($post->ID,'_page_title',true);
	$layout = ot_get_option('layout-dwqa');
	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $dwqa_p ); ?>
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
	<div id="container"><div id="content" role="main">
	<?php if( is_page() ) { ?>
		<header class="dwqa-page-header">
			<?php if ( $page_title != 'off' ) : ?><div class="b_title"><h3><?php the_title(); ?></h3></div><?php endif; ?>
		</header>
	<?php } ?>
