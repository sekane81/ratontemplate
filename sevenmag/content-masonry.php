<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ): ?>
			<div class="b_block introfx clearfix">
				<div class="post_thumbnail fully">
					<div class="item wgr">
						<?php edit_post_link('edit'); ?>
	
						<div class="featured_thumb mb">
							<a class="first_A" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'masonry', false, '' ); echo $src[0]; ?>" alt="<?php the_title(); ?>">
								<?php format_icon(); ?>
								<h3 class="post-title entry-title"><?php the_title(); ?></h3>
							</a>
							<?php get_review(); ?>
							<div class="details">
								<span class="s_category">
									<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" rel="date"><i class="icon-calendar mi"></i><?php the_time('j M, Y'); ?></a>
									<a rel="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="icon-user mi"></i><?php echo get_the_author(); ?></a>
									<?php if(function_exists('the_views')) { ?><span class="mid"><i class="fa fa-eye mi"></i><?php the_views(); ?></span><?php } ?>
								</span>
								<?php if ( comments_open() ): ?>
									<span class="more_meta">
										<a class="post-comments" href="<?php comments_link(); ?>"><span><i class="icon-message mi"></i><?php comments_number( '0', '1', '%' ); ?></span></a>
									</span>
								<?php endif; ?>
							</div><!-- /details -->
						</div>
					</div><!-- /item -->
				</div><!-- /thumbnail -->
		
				<?php if (ot_get_option('excerpt-length') != '0'): ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div><!--/b block -->
	<?php else : ?>
		<div class="b_title"><h3 class="post-title entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3></div>
		<div class="b_block r_post clearfix">
			<div class="details clearfix">
				<span class="s_category">
					<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" rel="date"><i class="icon-calendar mi"></i><?php the_time('j M, Y'); ?></a>
					<a rel="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="icon-user mi"></i><?php echo get_the_author(); ?></a>
					<?php if(function_exists('the_views')) { ?><span class="mid"><i class="fa fa-eye mi"></i><?php the_views(); ?></span><?php } ?>
				</span>
				<?php if ( comments_open() ): ?>
					<span class="more_meta">
						<a href="<?php comments_link(); ?>"><span><i class="icon-message mi"></i><?php comments_number( '0', '1', '%' ); ?></span></a>
					</span>
				<?php endif; ?>
			</div><!-- /details -->
	
			<?php if (ot_get_option('excerpt-length') != '0'): ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		</div><!--/b block -->
	<?php endif; ?>
</article><!--/.post-->	