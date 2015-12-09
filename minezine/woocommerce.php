<?php
/**
 * The WooCommerce pages template file.
 * @package MineZine
 * @since MineZine 1.1.0
*/
get_header(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php if ( !is_product() ) { woocommerce_page_title(); } else { the_title(); } ?></span></h1>
<?php minezine_get_breadcrumb(); ?>
    </div>
    <div class="entry-content">
<?php woocommerce_content(); ?>
    </div>   
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>