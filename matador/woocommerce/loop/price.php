<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if(ts_option_vs_default('show_shop_prices_on_results', 1) != 1)
    return;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo ts_escape($price_html); ?></span>
<?php endif; ?>