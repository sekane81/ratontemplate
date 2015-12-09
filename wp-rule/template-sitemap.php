<?php
/**
 * Template Name: Sitemap
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 *
 */

get_header(); ?>

<?php
	$page_comments = get_post_meta($post->ID,'ct_mb_page_comments', true);
	$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);

	if ( $mb_sidebar_position == '' ) $mb_sidebar_position = 'right';
?>
<div class="container">
	<header class="page-title-bar">
		<div class="row-fluid">
			<div class="span12">
				<h1 class="archive-title"><?php the_title(); ?></h1>
			</div> <!-- /span12 -->
		</div> <!-- /row-fluid -->
	</header><!-- /archive-header -->
</div>	

<div class="container">
	<div class="row-fluid">
		<?php if ( $mb_sidebar_position == 'right') :?>
			<div id="primary" class="span8">
		<?php else : ?>
			<div id="primary" class="span8 pull-right">
		<?php endif; ?>
			<div id="content" role="main">
				<div class="entry-page">
					<div class="entry-sitemap">
						<h4 id="posts"><?php _e('Posts','color-theme-framework'); ?></h4>
						<ul class="posts-name">
							<?php
						// Add categories seprated with comma (,) you'd like to hide to display on sitemap
					$cats = get_categories('exclude=');
					foreach ($cats as $cat) {
							echo "<li><h5>".$cat->cat_name."</h5>";
							echo "<ul>";
							query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
							while(have_posts()) {
							the_post();
							$category = get_the_category();
							// Only display a post link once, even if it's in multiple categories
							if ($category[0]->cat_ID == $cat->cat_ID) {
									echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
							}
							}
							echo "</ul>";
							echo "</li>";
					}
					?>
						</ul>

				<!-- Display Categories -->
						<h4><?php _e('Categories','color-theme-framework'); ?></h4>
						<ul class="category-name">
						<?php 
								$catrssimg = "/img/icons/rss16x16.png";
								$catrssurl = get_template_directory_uri() . $catrssimg;        
							wp_list_categories("sort_column=name&optioncount=1&hierarchical=0");
							//wp_list_categories("sort_column=name&feed_image=$catrssurl&optioncount=1&hierarchical=0");
						?>
						</ul>
			
				<!-- Display Pages -->
						<h4 id="pages"><?php _e('Pages','color-theme-framework'); ?></h4>
						<ul class="pages-name">
						<?php
					// Add pages seprated with comma[,] that you'd like to hide to display on sitemap
					wp_list_pages(
						array(
							'exclude' => '',
							'title_li' => '',
							 )
					);
				?>
						</ul>
				</div><!-- entry-sitemap -->
			<?php wp_reset_query();  ?>


				</div><!-- /entry-page -->
			</div><!-- /content -->
		</div><!-- /span8 #primary -->

		<?php if ( $mb_sidebar_position == 'right') :?>
		<div id="secondary" class="sidebar span4" role="complementary">
		<?php else : ?>
		<div id="secondary" class="sidebar span4 pull-left" role="complementary">
		<?php endif; ?>
			<?php
			global $wp_query; 
			$postid = $wp_query->post->ID; 
			$cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);

			if ($cus != '') {
				if ($cus[0] != '0') { if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])) : endif; }
				else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('ct_page_sidebar')) : endif; }
			}
			else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('ct_page_sidebar')) : endif; }
			?>
		</div><!-- /span4 -->
	</div><!-- /row-fluid -->
</div><!-- /container -->

<?php get_footer(); ?>