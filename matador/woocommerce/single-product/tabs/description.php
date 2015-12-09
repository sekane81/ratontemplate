<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;

//$heading = esc_html( apply_filters('woocommerce_product_description_heading', __( 'More Details', 'woocommerce' ) ) );

// description/details
the_content(); 


// additional information
$product->list_attributes(); 
?>

