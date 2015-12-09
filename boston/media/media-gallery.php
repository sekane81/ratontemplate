<figure class="post-img clearfix">
	<?php
		$post_meta = get_post_custom();
		$gallery_images = boston_smeta_images( 'gallery_images', get_the_ID(), array() );
		if( !empty( $gallery_images ) ){
			?>
			<ul class="list-unstyled post-slider clearfix">
				<?php
				foreach( $gallery_images as $image_id ){
					echo '<li>'.wp_get_attachment_image( $image_id, $image_size ).'</li>';
				}
				?>
			</ul>
			<?php
		}
		else{
			?>
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail( $image_size, array( 'class' => 'embed-responsive-item' ) ); ?>
			</a>
			<?php
		}
	?>
</figure>