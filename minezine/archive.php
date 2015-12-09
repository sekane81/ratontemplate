<?php
/**
 * The archive template file.
 * @package MineZine
 * @since MineZine 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>   
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php if ( is_day() ) :
						printf( __( 'Daily Archive: %s', 'minezine' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archive: %s', 'minezine' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'minezine' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archive: %s', 'minezine' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'minezine' ) ) . '</span>' );
					else :
						_e( 'Archive', 'minezine' );
					endif ;?></span></h1>
<?php minezine_get_breadcrumb(); ?>
    </div>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?> 
<?php minezine_content_nav( 'nav-below' ); ?>  
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>