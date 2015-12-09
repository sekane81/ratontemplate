<?php 
$iframe_standard = get_post_meta( get_the_ID() , 'iframe_standard', true );
if( !empty( $iframe_standard ) ){
	?>
	<div class="embed-responsive embed-responsive-<?php echo is_single() ? '16by9' : '4by3' ?>">
		<iframe src="<?php echo esc_url( $iframe_standard ) ?>"></iframe>
	</div>
	<?php
}
else{
	echo '<figure class="post-img">';
	?>
	<a href="<?php the_permalink() ?>">
		<?php the_post_thumbnail( $image_size, array( 'class' => 'img-responsive' ) ); ?>
	</a>
	<?php
	echo '</figure>';
}
?>	