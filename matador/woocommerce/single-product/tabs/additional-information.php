<?php
/**
 * Additional Information tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;

return; // we include attributes under the description/details tab

// leaving this stuff here just in case someone wants to revert back to traditional behavior...

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'woocommerce' ) );
?>

<h2><?php echo esc_html($heading); ?></h2>

<?php $product->list_attributes(); ?>