<?php $related = T20_related_posts(); ?>
<?php if ( $related->have_posts() ): ?>

	<div class="b_title"><h3><?php echo ot_get_option('related_post_tr'); ?></h3></div>
	<div class="b_block introfx b_4 clearfix">
	<div id="block_carousel" class="carousel_posts_related owl-carousel">
		<?php while ( $related->have_posts() ) : $related->the_post(); ?>
			<div class="item T_post">
				<article <?php post_class(); ?>>
					<div class="featured_thumb">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php if ( has_post_thumbnail() ): ?>
								<?php the_post_thumbnail('carousel-block'); ?>
								<?php format_icon(); ?>
							<?php endif; ?>
						</a>
					</div>
					<?php get_review(); ?>
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<div class="details">
						<a class="date_c" href="<?php the_permalink(); ?>"><i class="icon-calendar mi"></i> <?php the_time('j M, Y'); ?></a>
					</div>
				</article>
			</div>
		<?php endwhile; ?>
	</div><!--/carousel-->
	</div><!--/b block-->

<?php endif; ?>
<?php wp_reset_query(); ?>
