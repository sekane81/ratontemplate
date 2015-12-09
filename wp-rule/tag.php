<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */

get_header(); ?>

<?php 
	global $ct_options , $ct_post_class;

	$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );
	$category_columns = stripslashes( $ct_options['ct_categorypage_columns'] );
	$category_sidebar = stripslashes( $ct_options['ct_categorypage_sidebar'] );


	if( $category_columns == '3 Columns' ) $post_class = 'three_columns'; else
	if( $category_columns == '4 Columns' ) $post_class = 'four_columns'; else
	if( $category_columns == '5 Columns' ) $post_class = 'five_columns'; else
	if( $category_columns == '1 Column + Sidebar' ) $post_class = 'one_columns_sidebar'; else
	if( $category_columns == '2 Columns + Sidebar' ) $post_class = 'two_columns_sidebar'; else
	if( $category_columns == '3 Columns + Sidebar' ) $post_class = 'three_columns_sidebar'; else $post_class = 'four_columns';
?>

<div id="content" class="container" role="main">

<?php if ( have_posts() ) : ?>

	<header class="archive-header padding-15">
		<div class="row-fluid">
			<div class="span12">
					<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'color-theme-framework' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

					<?php if ( tag_description() ) : // Show an optional tag description ?>
						<div class="archive-meta"><?php echo tag_description(); ?></div>
					<?php endif; ?>
			</div> <!-- /span12 -->
		</div> <!-- /row-fluid -->
	</header><!-- /archive-header -->

	
	<div class="row-fluid">		

		<?php if( ($category_columns == '2 Columns + Sidebar') or ($category_columns == '3 Columns + Sidebar') or ($category_columns == '1 Column + Sidebar') ) : ?>
			<?php if ( $category_sidebar == 'Right' ) : ?>
		<div class="span8">
			<?php else : ?>
		<div class="span8 pull-right">
			<?php endif; // $category_sidebar ?>
		<?php else : ?>
		<div class="span12">
		<?php endif; // $category_columns ?>

	
		<?php /* Start the Loop */ ?>
			<div id="blog-entry">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					$format = get_post_format();

					if ( false === $format ) {
						get_template_part( 'content', 'standard' ); 
					} else {	
						get_template_part( 'content', get_post_format() ); 
					}
					?>
					<?php endwhile; ?>
			</div> <!-- .blog-entry -->
			<div class="clear"></div>
		</div> <!-- /span12 -->

		<?php if( ($category_columns == '2 Columns + Sidebar') or ($category_columns == '3 Columns + Sidebar') or ($category_columns == '1 Column + Sidebar') ) : ?>
			<!-- START SIDEBAR -->
			<?php if ( is_active_sidebar( 'ct_category_sidebar' ) ) : ?>
				<?php if ( $category_sidebar == 'Right' ) : ?>
				<div id="secondary" class="sidebar span4" role="complementary">
				<?php else : ?>
				<div id="secondary" class="sidebar span4 pull-left" role="complementary">
				<?php endif; // $category_sidebar ?>
					<?php dynamic_sidebar( 'ct_category_sidebar' ); ?>
				</div> <!-- /span4 -->
			<?php endif; ?>
			<!-- END SIDEBAR -->
		<?php endif; ?>
	</div> <!-- /row-fluid -->

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

</div> <!-- /content -->

<?php 
if ( $pagination_type != 'Infinite Scroll') { ?>
				<div class="container">
					<div class="container-pagination clearfix">
						<div class="row-fluid">
							<div class="span12">					
								<!-- Begin Navigation -->
								<?php if (function_exists("ct_pagination")) {
									ct_pagination();
								} ?>
								<!-- End Navigation -->
							</div> <!-- /span12 -->
						</div> <!-- /row-fluid -->
					</div> <!-- /container-pagination -->
				</div> <!-- /container -->
<?php } else { // if infinite scroll ?>
	<!-- Begin Navigation -->
	<?php if (function_exists("ct_pagination")) {
		ct_pagination();
	} ?>
	<!-- End Navigation -->	
<?php } ?>

<?php
	// Restor original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();
?>

<?php get_footer(); ?>