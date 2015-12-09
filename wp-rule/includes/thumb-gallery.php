<?php
/**
 * The template for get first image from the post with Gallery Post Format
 *
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */
?>

<?php
	global $ct_options, $post;
	global $wpdb;
?>

<?php
$meta = get_post_meta(get_the_ID(), 'ct_mb_gallery', false);

if (!is_array($meta)) $meta = (array) $meta;
					
if (!empty($meta)) {
	$meta = implode(',', $meta);

	$images = $wpdb->get_col("
		SELECT ID FROM $wpdb->posts
		WHERE post_type = 'attachment'
		AND ID in ($meta)
		ORDER BY menu_order ASC
	");

	$src = wp_get_attachment_image_src($images[0], 'single-post-thumb-crop');		    
?>

	<div class="entry-thumb">
		<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $src[0]; ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" /></a>					    
	</div> <!-- .entry-thumb -->
   <?php
	} 
?>
						