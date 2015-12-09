<?php
/**
 * The template for displaying content in the widgets for gallery
 *
 * @package WordPress
 * @subpackage Pravda
 * @since Pravda 1.0
 */
?>

<?php
global $ct_data, $post, $wpdb;

$time_id = rand();
$meta_gallery = get_post_meta(get_the_ID(), 'ct_mb_gallery', false);

if (!is_array($meta_gallery)) $meta_gallery = (array) $meta_gallery; ?>

<?php
if (!empty($meta_gallery)) {

	if ( !is_admin() ) {
		/* Flex Slider */
		wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
		wp_enqueue_script('flex-min-jquery',array('jquery'));
	} ?>

	<script type="text/javascript">
	/* <![CDATA[ */
		jQuery.noConflict()(function($){
			$(window).load(function () {

				$('#slider-<?php echo $post->ID . '-' . $time_id; ?>').flexslider({
						animation: "fade",
						directionNav: true,
						controlNav: false,
						slideshow: false,
						smoothHeight: true
				});
			});
		});
	/* ]]> */
	</script>

	<!-- Start FlexSlider -->
<div class="entry-thumb">
	<div id="slider-<?php echo $post->ID . '-' . $time_id; ?>" class="flexslider clearfix">
		<ul class="slides clearfix">

			<?php
			$meta_gallery = implode(',', $meta_gallery);

			$images = $wpdb->get_col("
					SELECT ID FROM $wpdb->posts
					WHERE post_type = 'attachment'
					AND ID in ($meta_gallery)
					ORDER BY menu_order ASC
			");

			foreach ($images as $att) {
				$src = wp_get_attachment_image_src($att, 'single-post-thumb-crop');
				$src_full = wp_get_attachment_image_src($att, 'full');
				$src = $src[0];
				$src_full = $src_full[0]; ?>

				<?php
				echo '<li><a href="' . $src_full . '" data-rel="prettyPhoto[gal]">';
				echo '<img src="' . $src . '" alt="' . the_title('','',false) . '">';
				echo '</a></li>';
			} // end foreach ?>
		</ul><!-- .slides -->
	</div><!-- .flexSlider -->
</div> <!-- .entry-thumb -->
<?php } ?>