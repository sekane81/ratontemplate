<?php
/**
 * Template Name: Archives
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */

get_header(); ?>

<?php
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
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

						<?php the_content(); ?>
							
						<div class="clear"></div>						
						<div class="margin-30b"></div>

						  <!-- /archive-lists -->
						  <div class="row-fluid entry-archives">
						    <div class="span4">
							  <h5><?php _e('Last 30 Posts', 'color-theme-framework') ?></h5>
							  <ul class="archives" style="">
							    <?php $archive_30 = get_posts('numberposts=30');
							    foreach($archive_30 as $post) : ?>
								  <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
							  	<?php endforeach; ?>
							  </ul>
							</div><!-- /span4 -->
								
							<div class="span4">
							  <h5><?php _e('Archives by Month:', 'color-theme-framework') ?></h5>
							  <ul class="archives" style="">
							    <?php wp_get_archives('type=monthly'); ?>
							  </ul>
							</div><!-- /span4 -->

						    <div class="span4">
							  <h5><?php _e('Archives by Subject:', 'color-theme-framework') ?></h5>
							  <ul class="archives">
							    <?php wp_list_categories( 'title_li=' ); ?>
							  </ul>
							</div><!-- /span4 -->					
						  <!-- /archive-lists -->
				  </div><!-- row-fluid -->
				<?php endwhile; endif; ?>
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