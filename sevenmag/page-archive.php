<?php
	/* Template Name: Archives */
	get_header();

	$s_p = T20_sidebar_primary();
	wp_reset_postdata();
	global $post;
	$loop = get_post_meta($post->ID,'_loop',true);
	$loop_category = get_post_meta($post->ID,'_loop_category',true);
	$loop_num = get_post_meta($post->ID,'_loop_num',true);
	$page_title = get_post_meta($post->ID,'_page_title',true);
	$page_comments = get_post_meta($post->ID,'_page_comments',true);
	$meta = get_post_meta($post->ID,'_layout',true);

	if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) : 
		$layout = $meta; 
	else :
		$layout = ot_get_option('layout-global');
	endif; 
?>
	<div class="archive_page">
<?php
	if ( $layout == 'both-sidebar' ): 
?>
	<div class="grid_3 alpha">
		<?php dynamic_sidebar( $s_p ); ?>
	</div><!--/.grid_3-->

	<div class="grid_6">
<?php elseif ( $layout == 'both-sidebar-right' ):  ?>
	<div class="grid_6 alpha">
<?php elseif ( $layout == 'sidebar-right' ):  ?>
	<div class="grid_9 alpha">
<?php elseif ( $layout == 'both-sidebar-left' ):  ?>
	<div class="grid_6 righter omega">
<?php elseif ( $layout == 'sidebar-left' ):  ?>
	<div class="grid_9 righter omega">
<?php elseif ( $layout == 'without-sidebar' ):  ?>
	<div class="clearfix">
<?php endif; ?>

		<?php if ( $page_title != 'off' ) : ?>
			<div class="b_title"><h3><?php the_title(); ?></h3></div>
		<?php endif; ?>

		<div class="b_block introfx">
			<?php if (have_posts()) : while ( have_posts() ) : the_post();
				the_content();	
			endwhile; endif; ?>
			
			<div class="clearfix">
				<div class="alpha grid_3 widget_categories">
					<div class="b_title"><h4><?php echo ot_get_option('archive_latest_tr'); ?></h4></div>
					<ol>
						<?php $archive_10 = get_posts('numberposts=10');
						foreach($archive_10 as $post) : ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
						<?php endforeach; ?>
					</ol>					
				</div>
				
				<div class="grid_9 mbs tagcloud">
					<div class="b_title"><h4><?php echo ot_get_option('archive_tags_tr'); ?></h4></div>
						<?php wp_tag_cloud('number=20&topic_count_text_callback=default_topic_count_text&orderby=count&order=DESC'); ?>				
				</div>
						
				<div class="grid_3 widget_categories">
					<div class="b_title"><h4><?php echo ot_get_option('archive_cats_tr'); ?></h4></div>
					<ul>
						<?php wp_list_categories('show_count=1&title_li=') ?>
					</ul>
				</div>	
	
				<div class="grid_3 widget_categories">
					<div class="b_title"><h4><?php echo ot_get_option('archive_month_tr'); ?></h4></div>
					<ul>
						<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
					</ul>
				</div>
				
				<div class="grid_3 omega widget_categories">
					<div class="b_title"><h4><?php echo ot_get_option('archive_pages_tr'); ?></h4></div>
					<ul>
						<?php wp_list_pages("title_li=" ); ?>
					</ul>
				</div>
			</div>
		</div>
	</div><!--/.grid -->
	</div><!--/archivepage -->
<?php 
	get_sidebar();
	get_footer(); 
?>