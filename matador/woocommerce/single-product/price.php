<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

if(ts_option_vs_default('show_shop_prices_on_single', 1) != 1)
    return false;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p itemprop="price" class="price"><?php echo ts_escape($product->get_price_html()); ?></p>

	<meta itemprop="priceCurrency" content="<?php echo ts_escape(get_woocommerce_currency()); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo ($product->is_in_stock()) ? 'InStock' : 'OutOfStock'; ?>" />

</div>