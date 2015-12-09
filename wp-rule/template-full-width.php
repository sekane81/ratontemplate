<?php
/* 
	Template Name: Full Width Page
	
	* @package WordPress
	* @subpackage Rule
	* @since Rule 1.0
*/

get_header(); ?>

<div class="container">
	<header class="page-title-bar">
		<div class="row-fluid">
			<div class="span12">
				<h1 class="archive-title"><?php the_title(); ?></h1>
			</div> <!-- /span12 -->
		</div> <!-- /row-fluid -->
	</header><!-- /archive-header -->
</div>	

<div id="content" role="main">
	<div class="container">	
		<div class="entry-page clearfix">
	    	<div class="row-fluid">	    	
		    	<div class="span12">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content clearfix">
								<?php the_content(); ?>
								<?php ct_wp_link_pages(); ?>
							</div><!-- /entry-content -->
							
							<div class="entry-meta clearfix">
								<?php edit_post_link( __( 'Edit', 'color-theme-framework' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>
							</div><!-- /entry-meta -->

								<?php 
									global $post;
									$page_comments = get_post_meta($post->ID,'ct_mb_page_comments', true); 
								?>

									<?php if ( $page_comments == '1') : ?>
										<div class="divider-1px"></div>
										<div class="margin-30b"></div>
									
										<?php comments_template( '', true ); ?>
									<?php endif; ?>
						</article><!-- /post -->
									
					<?php endwhile; // end of the loop. ?>

				</div><!-- /span12 -->
			</div><!-- /row-fluid -->
		</div>	
	</div> <!-- /container -->
</div> <!-- /content -->
<!-- END PAGE CONTENT ENTRY -->

<?php get_footer(); ?>