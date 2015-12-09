<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */

get_header(); ?>

<?php 
	global $ct_options;

	$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );
	$home_columns = stripslashes( $ct_options['ct_homepage_columns'] );
	$home_sidebar = stripslashes( $ct_options['ct_homepage_sidebar'] );


	if( $home_columns == '3 Columns' ) $ct_post_class = 'three_columns'; else
	if( $home_columns == '4 Columns' ) $ct_post_class = 'four_columns'; else
	if( $home_columns == '5 Columns' ) $ct_post_class = 'five_columns'; else
	if( $home_columns == '1 Column + Sidebar' ) $ct_post_class = 'one_columns_sidebar'; else
	if( $home_columns == '2 Columns + Sidebar' ) $ct_post_class = 'two_columns_sidebar'; else
	if( $home_columns == '3 Columns + Sidebar' ) $ct_post_class = 'three_columns_sidebar'; else $ct_post_class = 'four_columns';
?>

<div id="content" class="container" role="main">
	<div class="row-fluid">		

		<?php if( ($home_columns == '2 Columns + Sidebar') or ($home_columns == '3 Columns + Sidebar') or ($home_columns == '1 Column + Sidebar') ) : ?>
			<?php if ( $home_sidebar == 'Right' ) : ?>
		<div class="span8">
			<?php else : ?>
		<div class="span8 pull-right">
			<?php endif; // $home_sidebar ?>
		<?php else : ?>
		<div class="span12">
		<?php endif; // $home_columns ?>

			
			<?php
			global $query_string;

			$homepage_category = stripslashes( $ct_options['ct_homepage_category'] );
			$idObj = get_category_by_slug( $homepage_category ); 

			if( !empty($idObj->term_id) ) $id = $idObj->term_id;
			else $id = '';

			query_posts( $query_string . '&cat=' . $id );
			?>

			<?php /* Start the Loop */ ?>
			<div id="blog-entry">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php
					$format = get_post_format();

					if ( false === $format ) {
						get_template_part( 'content', 'standard' ); 
					} else {	
						get_template_part( 'content', get_post_format() ); 
					}
					?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div> <!-- .blog-entry -->
			<div class="clear"></div>
		</div> <!-- .span12 -->

		<?php if( ($home_columns == '2 Columns + Sidebar') or ($home_columns == '3 Columns + Sidebar') or ($home_columns == '1 Column + Sidebar') ) : ?>
			<!-- START SIDEBAR -->
			<?php if ( is_active_sidebar( 'ct_home_sidebar' ) ) : ?>
				<?php if ( $home_sidebar == 'Right' ) : ?>
				<div id="secondary" class="sidebar span4" role="complementary">
				<?php else : ?>
				<div id="secondary" class="sidebar span4 pull-left" role="complementary">
				<?php endif; // $home_sidebar ?>
					<?php dynamic_sidebar( 'ct_home_sidebar' ); ?>
				</div> <!-- /span4 -->
			<?php endif; ?>
			<!-- END SIDEBAR -->
		<?php endif; ?>
	</div> <!-- /row-fluid -->
</div> <!-- /content -->

<?php 
if ( $pagination_type != 'Infinite Scroll') { ?>
				<div class="container clearfix">
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