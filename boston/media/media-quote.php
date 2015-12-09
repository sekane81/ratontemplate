<figure class="post-img">
	<?php
	$post_meta = get_post_custom();
	$post_id = get_the_ID();
	$blockquote = get_post_meta( $post_id, 'blockquote', true );
	$cite = get_post_meta( $post_id, 'cite', true );
	?>
	<?php the_post_thumbnail( $image_size ) ?>
	<div class="link-overlay"></div>
	<div class="media-text-overlay">
		<?php if( !empty( $blockquote ) ): ?>
			<blockquote>
				<h2><?php echo esc_html( $blockquote ); ?></h2>
			</blockquote>
		<?php endif; ?>
		<?php if( !empty( $cite ) ): ?>
			<cite>
				<?php echo esc_html( $cite ); ?>
			</cite>
			<div class="clearfix"></div>
		<?php endif; ?>
	</div>
</figure>