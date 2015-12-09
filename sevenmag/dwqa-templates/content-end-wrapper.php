<?php  

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	echo '</div></div></div><!--/.grid -->';

	$dwqa_p = dwqa_primary();
	$dwqa_s = dwqa_secondary();
	$layout = ot_get_option('layout-dwqa');
	if ( $layout == 'both-sidebar' ): ?>

		<div class="grid_3 righter omega">
			<?php dynamic_sidebar( $dwqa_s ); ?>
		</div>
	
	<?php elseif ( $layout == 'both-sidebar-right' ):  ?>
	
		<div class="grid_3">
			<?php dynamic_sidebar( $dwqa_s ); ?>
		</div>
	
		<div class="grid_3 omega">
			<?php dynamic_sidebar( $dwqa_p ); ?>
		</div>
	
	<?php elseif ( $layout == 'sidebar-right' ):  ?>
	
		<div class="grid_3 omega">
			<?php dynamic_sidebar( $dwqa_p ); ?>
		</div>
	
	<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
		<div class="grid_3 alpha">
			<?php dynamic_sidebar( $dwqa_p ); ?>
		</div>
	
		<div class="grid_3">
			<?php dynamic_sidebar( $dwqa_s ); ?>
		</div>
	
	<?php elseif ( $layout == 'sidebar-left' ):  ?>
	
		<div class="grid_3 alpha">
			<?php dynamic_sidebar( $dwqa_p ); ?>
		</div>
	
	<?php elseif ( $layout == 'without-sidebar' ):  endif; 

get_footer(); ?>
