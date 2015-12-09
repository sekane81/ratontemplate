<?php 
/**
 * Library of Theme options functions.
 * @package MineZine
 * @since MineZine 1.0.0
*/

// Display Breadcrumb navigation
function minezine_get_breadcrumb() { 
global $minezine_options_db;
		if ($minezine_options_db['minezine_display_breadcrumb'] != 'Hide') { ?>
<?php if (function_exists( 'bcn_display' ) && !is_front_page()){ _e('<p class="breadcrumb-navigation">', 'minezine'); ?><?php bcn_display(); ?><?php _e('</p>', 'minezine');} ?>
<?php } 
} 

// Display featured images on single posts
function minezine_get_display_image_post() { 
global $minezine_options_db;
		if ($minezine_options_db['minezine_display_image_post'] == '' || $minezine_options_db['minezine_display_image_post'] == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
}

// Display featured images on pages
function minezine_get_display_image_page() { 
global $minezine_options_db;
		if ($minezine_options_db['minezine_display_image_page'] == '' || $minezine_options_db['minezine_display_image_page'] == 'Display') { ?>
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail(); ?>
<?php endif; ?>
<?php } 
} ?>