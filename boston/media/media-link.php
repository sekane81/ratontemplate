<figure class="post-img">
	<?php
	$post_meta = get_post_custom();
	$post_id = get_the_ID();
	$link = get_post_meta( $post_id, 'link', true );
	if( !empty( $link ) ){
		?>
		<?php the_post_thumbnail( $image_size ) ?>
		<div class="link-overlay"></div>
		<div class="media-text-overlay">
			<a href="<?php echo esc_url( $link ); ?>">
				<h1 class="break-word"><?php echo esc_url( $link ) ?></h1>
			</a>
		</div>
		<?php
	}
	?>
</figure>