<?php
global $ts_style_selector_default_primary_color;
$ts_style_selector_default_primary_color = ts_option_vs_default('primary_color', '#ee4643');
global $ts_style_selector_colors;
$ts_style_selector_colors = array(
    __('Coral', 'ThemeStockyard') => '#ee4643',
    __('Faded Rose', 'ThemeStockyard') => '#E2A8A8',
    __('Peach', 'ThemeStockyard') => '#F28D7B',
    __('Purple', 'ThemeStockyard') => '#8e587a',
    __('Navy', 'ThemeStockyard') => '#134063',
    __('Blue', 'ThemeStockyard') => '#365d95',
    __('Teal', 'ThemeStockyard') => '#1E7775',
    __('Sea Green', 'ThemeStockyard') => '#67a788',
    __('Sage', 'ThemeStockyard') => '#3ab54b',
    __('Green', 'ThemeStockyard') => '#7F9614',
    __('Mustard Yellow', 'ThemeStockyard') => '#E8B71A',
    __('Orange', 'ThemeStockyard') => '#F28707',
    __('Brown', 'ThemeStockyard') => '#9b7c56',
    __('Gold', 'ThemeStockyard') => '#D9B753',
    __('Gray', 'ThemeStockyard') => '#3b3b3b',
);
global $ts_style_selector_bg_options;
$ts_style_selector_bg_options = array(
    __('Grunge Wall', 'ThemeStockyard') => 'grunge-wall',
    __('Bright Squares', 'ThemeStockyard') => 'bright-squares',
    __('Retina Wood', 'ThemeStockyard') => 'retina_wood',
    __('Sneaker Mesh', 'ThemeStockyard') => 'sneaker_mesh_fabric',
    __('Arches', 'ThemeStockyard') => 'arches',
    //__('Cartographer', 'ThemeStockyard') => 'cartographer',
    __('Dark Wood', 'ThemeStockyard') => 'dark_wood',
    //__('Diagmonds', 'ThemeStockyard') => 'diagmonds',
    __('Escheresque 1', 'ThemeStockyard') => 'escheresque_ste',
    __('Escheresque 2', 'ThemeStockyard') => 'escheresque',
    __('Google Play pattern', 'ThemeStockyard') => 'gplaypattern',
    __('Graphy', 'ThemeStockyard') => 'graphy',
    __('3 pixel squares', 'ThemeStockyard') => 'px_by_Gr3g',
    //__('Shattered', 'ThemeStockyard') => 'shattered',
    __('Stresses Linen', 'ThemeStockyard') => 'stressed_linen',
    __('Tileable Wood', 'ThemeStockyard') => 'tileable_wood_texture',
    __('Type', 'ThemeStockyard') => 'type',
    __('Food', 'ThemeStockyard') => 'food',
    __('Green Cup', 'ThemeStockyard') => 'green_cup',
    __('School', 'ThemeStockyard') => 'school',
    __('Skulls', 'ThemeStockyard') => 'skulls',
    __('Swirl Pattern', 'ThemeStockyard') => 'swirl_pattern',
    __('Symphony', 'ThemeStockyard') => 'symphony',
);

function ts_print_style_selector_colors()
{
    global $ts_style_selector_colors, $ts_style_selector_default_primary_color;
    
    $current_color = strtolower($ts_style_selector_default_primary_color);
    
    foreach($ts_style_selector_colors AS $key => $value)
    {
        $value = strtolower($value);
        $active = ('#'.$current_color == $value || $current_color == $value) ? 'active' : '';
        $_value = (substr($value, 0, 1) == '#') ? strtolower(substr($value, 1)) : strtolower($value);
        echo '<a title="'.esc_attr($key).'" data-color="'.esc_attr($value).'" class="'.esc_attr($active).' ts-demo-test-color ts-demo-test-color-'.esc_attr($_value).'">&nbsp;</a>';
    }
}
function ts_print_style_selector_bg_options()
{
    global $ts_style_selector_bg_options;
    
    $current_bg = '';
    
    foreach($ts_style_selector_bg_options AS $key => $value)
    {
        $active = ($current_bg == $value) ? 'active border-primary' : '';
        echo '<a title="'.esc_attr($key).'" data-bg="'.esc_attr($value).'" class="'.esc_attr($active).'">&nbsp;</a>';
    }
}
function ts_print_style_selector_skin_options()
{
    $ts_style_selector_skins = array(
        'Light' => 'light',
        'Dark' => 'dark'
    );
    
    $current_skin = 'light';
    
    foreach($ts_style_selector_skins AS $key => $value)
    {
        echo '<option value="'.esc_attr($value).'" '.selected( $current_skin, $value, false ).'>'.esc_attr($key).'</option>';
    }
}
if(function_exists('woocommerce_get_page_id')) :
    $shop_page = get_post(woocommerce_get_page_id('shop'));
    $shop_page = (is_object($shop_page) && isset($shop_page->ID)) ? get_permalink($shop_page->ID) : '';
endif;

$shop_page = ($shop_page) ? $shop_page : '#';
?>
<!-- for demo purposes only -->
<div id="ts-style-selector-wrap" class="closed">
    <a id="ts-style-selector-toggle"><span><i class="fa fa-cog"></i></span></a>
    <div id="ts-style-selector">
        <h4><?php _e('Style Switcher', 'ThemeStockyard');?></h4>
        <!--<div class="ts-style-selector-pocket">
            <h4><?php _e('Skin:', 'ThemeStockyard');?></h4>
            <p><select name="ts_style_skin" id="ts_style_skin"><?php ts_print_style_selector_skin_options();?></select></p>
        </div>-->
        <div class="ts-style-selector-pocket">
            <h5 class="smallx uppercasex bold"><?php _e('Highlight Color:', 'ThemeStockyard');?></h5>
            <p id="ts-style-selector-color-options" class="ts-style-color-options clearfix"><?php ts_print_style_selector_colors();?></p>
            <p class="mimic-small subtle-text-color hidden"><?php echo sprintf(__('Best viewed within <a href="%s"><u>the shop</u></a>.', 'ThemeStockyard'), $shop_page);?></p>
            <p class="small hidden"><?php _e('You can also create your own highlight color from the Admin Panel.', 'ThemeStockyard');?></p>
        </div>
        <div class="ts-style-selector-pocket">
            <h5 class="smallx uppercasex bold"><?php _e('Backgrounds:', 'ThemeStockyard');?></h5>
            <p id="ts-style-selector-bg-options" class="ts-style-bg-options clearfix"><?php ts_print_style_selector_bg_options();?></p>
            <p class="small hidden"><?php _e('You can also upload your own background from the Admin Panel.', 'ThemeStockyard');?></p>
        </div>
        <div class="ts-style-selector-pocket">
            <p class="small"><?php _e('You can also set your own colors or background from the Admin Panel.', 'ThemeStockyard');?></p>
        </div>
        <div class="ts-style-selector-pocket">
            <p class="mimic-small uppercase"><a id="ts-style-selector-reset-button"><u><?php echo _e('Reset Styles', 'ThemeStockyard');?></u></a></p>
        </div>
    </div>
</div>
<!-- for demo purposes only -->
<div id="dev-style-div" class="hidden" data-color="<?php echo esc_attr($ts_style_selector_default_primary_color);?>" data-bg-classes="bg_<?php echo esc_attr(implode(' bg_', $ts_style_selector_bg_options));?>" data-orig-color="<?php echo esc_attr($ts_style_selector_default_primary_color);?>">
.main-nav > ul > li.menu-item-has-children:hover > a:after, 
.main-nav > div > ul > li.menu-item-has-children:hover > a:after,
.main-nav.normal > ul > li.current_page_item > a:after, 
.main-nav.normal > ul > li.current-menu-item > a:after,
.main-nav.normal > div > ul > li.current_page_item > a:after, 
.main-nav.normal > div > ul > li.current-menu-item > a:after,
.main-nav > ul > li.inuse > a:after,
.main-nav > div > ul > li.inuse > a:after,
.main-nav > ul > li.current_page_parent > a:after,
.main-nav > div > ul > li.current_page_ancestor > a:after,
#top-bar .ts-searchform.form-in-use input,
.widget_calendar table td#today,
#ts-news-ticker-nav .flex-direction-nav a,
.vertical-tabs ul.tab-header li.active:before,
.horizontal-tabs ul.tab-header li.active:before,
button,
.button,
.wpcf7-submit,
#button,
.spinner > div,
.woocommerce input[type="submit"], 
.woocommerce input[type="button"], 
.woocommerce .product-remove a.remove,
.loop .ts-meta-wrap .meta-item-date,
#copyright-nav-wrap { background-color: <?php echo esc_attr($ts_style_selector_default_primary_color);?>; }

a, 
a:hover,
a:visited, 
a:active,
a:focus,
#logo a,
.top-stuff-side a:active,
.top-stuff-side a:focus,
.top-stuff-side a:hover,
#top-bar .side a:active,
#top-bar .side a:focus,
#top-bar .side a:hover,
#top-bar .middle-area a,
.woocommerce p.stars span a:hover, 
.woocommerce-page p.stars span a:hover,
.woocommerce p.stars span a.active, 
.woocommerce-page p.stars span a.active,
.ts-tabs-widget .tab-header li.active,
.main-nav-wrap #header-social ul li:before,
.main-nav-wrap #header-social ul li a:hover,
.main-nav ul > li.menu-item > a:hover,
.main-nav > ul > li > a:hover, 
.main-nav > div > ul > li > a:hover, 
.main-nav > ul > li.current_page_item > a, 
.main-nav > ul > li.current-menu-item > a,
.main-nav > div > ul > li.current_page_item > a, 
.main-nav > div > ul > li.current-menu-item > a,
.main-nav > ul > li.inuse > a,
.main-nav > div > ul > li.inuse > a,
.main-nav > ul > li.current_page_parent > a,
.main-nav > ul > li.current_page_ancestor > a,
.main-nav > div > ul > li.current_page_parent > a,
.main-nav > div > ul > li.current_page_ancestor > a,
.main-nav > ul > li.current_page_parent > a > .sf-sub-indicator,
.main-nav > div > ul > li.current_page_ancestor > a > .sf-sub-indicator,
.main-nav ul ul li.menu-item > a:hover,
.main-nav ul ul li.current_page_item > a, 
.main-nav ul ul li.current-menu-item > a { color: <?php echo esc_attr($ts_style_selector_default_primary_color);?>; }
.highlight { background-color: rgba(<?php echo ts_hex2rgb($ts_style_selector_default_primary_color, 'string');?>, .1); color: <?php echo esc_attr($ts_style_selector_default_primary_color);?>; }

.main-nav ul ul li.menu-item-has-children > a:hover:after { border-color: transparent transparent transparent <?php echo esc_attr($ts_style_selector_default_primary_color);?>; }

#footer a,
#footer a:active,
#footer a:focus,
#footer a:hover,
#footer .ts-tabs-widget .tab-header li.active { color: <?php echo esc_attr($ts_style_selector_default_primary_color);?>; }

.ts-pricing-column.featured,
button.outline,
.button.outline,
#button.outline,
.loop .post-category-heading a,
#ts-moon-comment-bubble:hover { border-color: <?php echo esc_attr($ts_style_selector_default_primary_color);?>; }
.loop-slider-wrap .ts-item-details .comment-bubble:after,
#ts-moon-comment-bubble:hover:after { border-top-color: <?php echo esc_attr($ts_style_selector_default_primary_color);?>; }

.border-primary { border-color: <?php echo esc_attr($ts_style_selector_default_primary_color);?> !important; }
.bg-primary { background-color: <?php echo esc_attr($ts_style_selector_default_primary_color);?> !important; }
.primary-color, 
.color-shortcode.primary,
.color-primary { color: <?php echo esc_attr($ts_style_selector_default_primary_color);?> !important; }
.button.default,
.button.primary { background-color: <?php echo esc_attr($ts_style_selector_default_primary_color);?> !important; }
</div>