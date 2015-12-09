<?php
/**
 * The author archive template file.
 * @package MineZine
 * @since MineZine 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php the_post(); ?>   
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php printf( __( 'Author Archive: %s', 'minezine' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></span></h1>
<?php minezine_get_breadcrumb(); ?>
    </div>
<?php rewind_posts(); ?>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
    <div class="archive-meta">
      <div class="author-info">
		    <div class="author-description">
          <div class="author-avatar">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'minezine_author_bio_avatar_size', 60 ) ); ?>
		      </div>
			    <p><?php the_author_meta( 'description' ); ?></p>
		    </div>
		  </div>
    </div>
<?php endif; ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?> 
<?php minezine_content_nav( 'nav-below' ); ?>  
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>