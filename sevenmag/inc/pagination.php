<nav class="pagination introfx clearfix">
	<?php if ( function_exists('wp_pagenavi') ): ?>
		<?php wp_pagenavi(); ?>
	<?php else: ?>
		<ul class="pagination_default clearfix">
			<li class="newer righter"><?php previous_posts_link( ot_get_option('nav_newer_tr') ); ?></li>
			<li class="older lefter"><?php next_posts_link( ot_get_option('nav_older_tr') ); ?></li>
		</ul>
	<?php endif; ?>
</nav><!--/.pagination-->
