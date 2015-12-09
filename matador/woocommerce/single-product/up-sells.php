<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$related_posts_per_page = 5;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $related_posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= 4; //$columns;

if ( $products->have_posts() ) : ?>

    <?php echo do_shortcode('[divider style="line" padding_top="40" padding_bottom="40"]');?>

	<div class="upsells products">

		<h2><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php 
			$i = 1;
			while ( $products->have_posts() ) : $products->the_post(); 
			?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php
                $i++;
                if($i > 4) break;
			endwhile; // end of the loop. 
			?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
