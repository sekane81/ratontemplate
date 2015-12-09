<?php if ( has_post_thumbnail() ): ?>
<div class="mb">
	<div class="image-container">
		<?php the_post_thumbnail('full'); ?>
		<?php 
			$caption = get_post(get_post_thumbnail_id())->post_excerpt;
			$description = get_post(get_post_thumbnail_id())->post_content;
			if ( isset($caption) && $caption ) echo '<div class="caption">'.$caption.'</div>';
		?>
	</div>
	<?php if ( isset($description) && $description ) echo '<div class="description mt"><i>'.$description.'</i></div>'; ?>
</div>
<?php endif; ?>	