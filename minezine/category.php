<?php
/**
 * The category archive template file.
 * @package MineZine
 * @since MineZine 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>   
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php single_cat_title(); ?></span></h1>
<?php minezine_get_breadcrumb(); ?>
    </div>
<?php if ( category_description() ) : ?>
    <div class="archive-meta"><?php echo category_description(); ?></div>
<?php endif; ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?> 
<?php minezine_content_nav( 'nav-below' ); ?>  
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>