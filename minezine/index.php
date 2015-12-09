<?php
/**
 * The main template file.
 * @package MineZine
 * @since MineZine 1.0.0
*/
get_header(); ?>
<?php if ($minezine_options_db['minezine_display_latest_posts'] != 'Hide') { ?>    
    <section class="home-latest-posts">
      <h2 class="entry-headline"><span class="entry-headline-text"><?php if($minezine_options_db['minezine_latest_posts_headline'] == '') { ?><?php _e( 'Latest Posts' , 'minezine' ); ?><?php } else { echo esc_attr($minezine_options_db['minezine_latest_posts_headline']); } ?></span></h2>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?>
<?php minezine_content_nav( 'nav-below' ); ?>
   </section> 
<?php } ?> 
<?php if ( dynamic_sidebar( 'sidebar-6' ) ) : else : ?>
<?php endif; ?> 
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>