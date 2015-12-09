<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
    <div class="clear"></div>
	<div class="ts-tabs-widget tabs-widget widget shortcode-tabs simple-tabs horizontal-tabs">
        <div class="tab-widget">
            <ul id="woo-product-tabs" class="tab-header clearfix">
                <li class="active details"><?php _e('Overview', 'ThemeStockyard');?></li>
                <?php 
                $i = 2;
                foreach ( $tabs as $key => $tab ) : 
                
                    if($key == 'additional_information') continue; // we include this under the description/details tab
                    
                    if(ts_option_vs_default('show_shop_reviews_on_single', 1) != 1 && $key == 'reviews') continue;
                    
                    $class = ($i == 1) ? 'active' : '';
                    $tab['title'] = ($key == 'description') ? __('Details', 'ThemeStockyard') : $tab['title'];
                ?>
                
                <li class="<?php echo esc_attr($class).' '.esc_attr($key);?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></li>
                
                <?php 
                    $i++;
                endforeach; 
                ?>
            </ul>
            <div class="tab-contents">
                <div class="tab-context tab-details">
                    <?php do_action( 'woocommerce_single_product_summary' ); ?>
                </div>
                
                <?php 
                $i = 1;
                foreach ( $tabs as $key => $tab ) : 
                    if($key == 'additional_information') continue; // we include this under the description/details tab
                    
                    if(ts_option_vs_default('show_shop_reviews_on_single', 1) != 1 && $key == 'reviews') continue;
                ?>
                
                <div class="tab-context tab-<?php echo esc_attr($key);?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>

                <?php 
                    $i++;
                endforeach; 
                ?>
            </div>
		</div>
	</div>

<?php endif; ?>