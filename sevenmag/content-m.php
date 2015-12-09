<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
	<div class="inner_p">
	<?php if ( has_post_thumbnail() ): ?>
			<div class="medium_thumb clearfix">
				<div class="post_thumbnail">
					<div class="item">
						<div class="featured_thumb">
							<a class="first_A" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'carousel-block', false, '' ); echo $src[0]; ?>" alt="<?php the_title(); ?>">
								<?php format_icon(); ?>
							</a>
							<?php get_review(); ?>
						</div>
					</div><!-- /item -->
				</div><!-- /thumbnail -->
				<h3 class="post-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div style="display: none">
					<time class="post_date date updated" datetime="<?php the_time('j M, Y'); ?>"><?php the_time('j M, Y'); ?></time>
					<b class="vcard author"><b class="fn"><?php the_author(); ?></b></b>
				</div>
			</div>
	<?php else : ?>
		<h3 class="post-title entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<div style="display: none">
			<time class="post_date date updated" datetime="<?php the_time('j M, Y'); ?>"><?php the_time('j M, Y'); ?></time>
			<b class="vcard author"><b class="fn"><?php the_author(); ?></b></b>
		</div>
	<?php endif; ?>
	</div>
</article><!--/.post-->	