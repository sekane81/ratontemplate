<?php $meta = get_post_custom($post->ID); ?>

<?php if ( has_post_format( 'audio' ) ) { 
	$exaudio = get_post_meta($post->ID, '_audio_code', TRUE);
	if($exaudio != '') { ?>
		<div class="post-format mbf">
			<?php echo $meta['_audio_code'][0]; ?>
		</div>
	<?php } ?>
<?php } elseif ( has_post_format( 'gallery' ) ) { ?>
	<div class="post-format mbf">
		<?php $images = T20_post_images(); if ( !empty($images) ): ?>
			<div class="gallery_item gallery_<?php the_ID(); ?> owl-carousel owl-theme">
				<?php foreach ( $images as $image ): ?>
					<div class="item clearfix">
						<?php $imageid = wp_get_attachment_image_src($image->ID,'large'); ?>
						<img src="<?php echo $imageid[0]; ?>" title="<?php echo $image->post_title; ?>" alt="<?php echo $image->post_title; ?>">
								
						<?php if ( $image->post_excerpt ): ?>
							<div class="caption"><?php echo $image->post_excerpt; ?></div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>

<?php } elseif ( has_post_format( 'video' ) ) { 
	$exvid = get_post_meta($post->ID, '_video_embed_code', TRUE);
	if($exvid != '') { ?>
		<div class="post-format mbf">	
			<?php 
				if ( isset($meta['_video_url'][0]) && !empty($meta['_video_url'][0]) ) {
					global $wp_embed;
					$video = $wp_embed->run_shortcode('[embed]'.$meta['_video_url'][0].'[/embed]');
					echo $video;
				} elseif ( isset($meta['_video_embed_code'][0]) && !empty($meta['_video_embed_code'][0]) ) {
					echo '<div class="video-container">';
					echo $meta['_video_embed_code'][0];
					echo '</div>';
				}
			?>	
		</div>
	<?php } ?>
<?php } ?>