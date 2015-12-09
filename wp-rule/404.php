<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */

get_header(); ?>
<?php 
	global $ct_options , $ct_post_class;
?>

<div id="content" class="container" role="main">

	<header class="page-title-bar">
		<div class="row-fluid">
			<div class="span12">
				<h1 class="archive-title"><?php printf( __( '404 Error', 'color-theme-framework' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
			</div> <!-- /span12 -->
		</div> <!-- /row-fluid -->
	</header><!-- /archive-header -->

	<div class="row-fluid">		

		<div class="span8">
	
			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'color-theme-framework' ); ?></h1>
				</header>

				<div class="entry-content clearfix">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'color-theme-framework' ); ?></p>
					<div class="clear"></div>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<div class="clear"></div>
	</div> <!-- /span8 -->

			<!-- START SIDEBAR -->
			<?php if ( is_active_sidebar( 'ct_category_sidebar' ) ) : ?>
				<div id="secondary" class="sidebar span4" role="complementary">
					<?php dynamic_sidebar( 'ct_category_sidebar' ); ?>
				</div> <!-- .span4 -->
			<?php endif; ?>
			<!-- END SIDEBAR -->
	</div> <!-- .row-fluid -->

</div><!-- #content -->

<?php get_footer(); ?>