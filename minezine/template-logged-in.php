<?php
/**
 * Template Name: Logged In
 * The template file for displaying the page content only for logged in users.
 * @package MineZine
 * @since MineZine 1.1.5
*/
get_header(); ?>
<?php if ( is_user_logged_in() ) { ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php the_title(); ?></span></h1>
<?php minezine_get_breadcrumb(); ?>
    </div>
<?php minezine_get_display_image_page(); ?>
    <div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'minezine' ) . '</span>', 'after' => '</p>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'minezine' ), '<p>', '</p>' ); ?>
<?php endwhile; endif; ?>
<?php comments_template( '', true ); ?>
    </div>
<?php } else { ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php the_title(); ?></span></h1>
<?php minezine_get_breadcrumb(); ?>
    </div>
    <div class="entry-content">
      <p class="logged-in-message"><?php _e( 'You must be logged in to view this page.', 'minezine' ); ?></p>
<?php wp_login_form(); ?>
    </div>
<?php } ?>   
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>