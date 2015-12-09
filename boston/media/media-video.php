<figure class="post-img">
	<?php
	$post_meta = get_post_custom();
	$post_id = get_the_ID();
	$video = get_post_meta( $post_id, 'video', true );
	$video_type = get_post_meta( $post_id, 'video_type', true );
	if( !empty( $video ) ){
		echo '<div class="embed-responsive embed-responsive-'.( is_single() ? '16by9' : '4by3' ).'">';
		if( $video_type == 'self'){
			?>
			<video controls class="embed-responsive-item">
				<source src="<?php echo esc_url( $video ); ?>" type="video/ogg">
				<?php _e( 'Your browser does not support the video tag.', 'boston' ) ?>;
			</video>
			<?php
		}
		else{
			?>
			<iframe src="<?php echo esc_url( boston_parse_url( $video ) ); ?>" class="embed-responsive-item"></iframe>
			<?php
		}
		echo '<div>';
	}
	else{
		?>
		<a href="<?php the_permalink() ?>">
			<?php the_post_thumbnail( $image, array( 'class' => 'embed-responsive-item' ) ); ?>
		<a href="<?php the_permalink() ?>">
		<?php
	}
	?>
</figure>