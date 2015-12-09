<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
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
			<header class="entry-header">
				 <h1 class="archive-title"><?php the_title(); ?></h1>
			</header>
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
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>

						<?php if ( $page_comments == '1') : ?>
							<div class="divider-1px"></div>
							<div class="margin-30b"></div>
							<?php comments_template( '', true ); ?>
						<?php endif; ?>
					<?php endwhile; // end of the loop. ?>
				</div><!-- .entry-page -->
			</div><!-- #content -->
		</div><!-- .span8 #primary -->


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
		</div><!-- .span4 -->
	</div><!-- .row-fluid -->
</div><!-- .container -->

<?php get_footer(); ?>