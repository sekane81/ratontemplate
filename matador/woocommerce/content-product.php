<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $ts_show_sidebar;

$classes = array();
if($ts_show_sidebar == 'yes') :
    $store_column_count = 3;
    //$classes[] = 'span4';
else :
    $store_column_count = 4;
    //$classes[] = 'span3';
endif;

$store_column_count = 3;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $store_column_count );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'ts-shop-first-of-'.$store_column_count;
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'ts-shop-last-of-'.$store_column_count;
if (($woocommerce_loop['loop'] % 2 == 0) === true) // ($woocommerce_loop['loop'] == 2)
	$classes[] = 'ts-shop-last-of-2';
if (($woocommerce_loop['loop'] % 2 == 0) === false)
	$classes[] = 'ts-shop-first-of-2';

if($woocommerce_loop['columns'] == 1)
    $classes[] = 'ts-boxed-one-whole';
elseif($woocommerce_loop['columns'] == 2)
    $classes[] = 'ts-boxed-one-half';
elseif($woocommerce_loop['columns'] == 3)
    $classes[] = 'ts-boxed-one-third';
elseif($woocommerce_loop['columns'] == 4)
    $classes[] = 'ts-boxed-one-fourth';
elseif($woocommerce_loop['columns'] == 5)
    $classes[] = 'ts-boxed-one-fifth';
elseif($woocommerce_loop['columns'] == 6)
    $classes[] = 'ts-boxed-one-sixth';
else
    $classes[] = 'ts-boxed-one-third';
?>
<div <?php post_class( $classes ); ?>>
    <div class="loop-product-inner">
        
        
        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        
        <div class="ts-loop-product-top">
            <a href="<?php the_permalink(); ?>" class="img-link"><?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );
            ?></a>
            <div class="ts-loop-button-wrap">
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            </div>
        </div>

        <div class="ts-loop-product-title">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        </div>
        
        <div class="ts-loop-product-bottom">
            
            <?php
            if(ts_option_vs_default('show_shop_reviews_on_results', 1) == 1 || ts_option_vs_default('show_shop_prices_on_results', 1) == 1) :
            ?>
            <div class="price-wrap">
                <?php
                    /**
                     * woocommerce_after_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                ?>
            </div>
            <?php
            endif;
            ?>
        </div>
	</div>

</div>