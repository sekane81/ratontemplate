<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
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

	if( $category_columns == '3 Columns' ) $ct_post_class = 'three_columns'; else
	if( $category_columns == '4 Columns' ) $ct_post_class = 'four_columns'; else
	if( $category_columns == '5 Columns' ) $ct_post_class = 'five_columns'; else
	if( $category_columns == '1 Column + Sidebar' ) $ct_post_class = 'one_columns_sidebar'; else
	if( $category_columns == '2 Columns + Sidebar' ) $ct_post_class = 'two_columns_sidebar'; else
	if( $category_columns == '3 Columns + Sidebar' ) $ct_post_class = 'three_columns_sidebar'; else $ct_post_class = 'four_columns';

?>

<div id="content" class="container" role="main">

<?php if ( have_posts() ) : ?>
	<?php 
		the_post();
	?>

	<header class="page-title-bar">
		<div class="row-fluid">
			<div class="span12">
				<h1 class="archive-title"><?php printf( __( 'Artículos por autor: %s', 'color-theme-framework' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info" itemscope="" itemtype="http://schema.org/Person">
					<div id="author-avatar" itemprop="image">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 100 ) ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<span style="display: block;"><strong><?php _e('Full Name: ', 'color-theme-framework') ?></strong><?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?></span>
						<meta itemprop="name" content="<?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?>">
						<span><strong><?php _e('Website: ', 'color-theme-framework') ?></strong><a href="<?php the_author_meta( 'user_url' ); ?>" itemprop="url"><?php the_author_meta( 'user_url' ); ?></a></span><br />
						<span><strong><?php _e('Info: ', 'color-theme-framework') ?></strong><?php the_author_meta( 'description' ); ?></span>
						<meta itemprop="description" content="<?php the_author_meta( 'description' ); ?>">
					</div><!-- #author-description	-->
				</div><!-- #author-info -->
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
		</div> <!-- .span12 -->

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