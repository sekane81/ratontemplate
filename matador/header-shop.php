<?php
global $smof_data, $post, $product, $ts_show_sidebar, $ts_sidebar_position, $ts_page_id;

$ts_page_object = get_queried_object();
$ts_page_id     = (ts_is_woo_shop()) ? $ts_page_id : ((is_single()) ? $post->ID : get_queried_object_id());
$ts_custom_css  = get_post_meta($ts_page_id, '_page_css', true);

if(is_product()) :
    $ts_show_sidebar = (ts_option_vs_default('show_woocommerce_product_sidebar', 0) == 1) ? 'yes' : 'no';
else :
    $ts_show_sidebar_option = (ts_option_vs_default('show_woocommerce_page_sidebar', 1) == 1) ? 'yes' : 'no';
    $ts_show_sidebar = ts_postmeta_vs_default($ts_page_id, '_page_sidebar', $ts_show_sidebar_option);
endif;

$ts_sidebar_position = ts_option_vs_default('woocommerce_sidebar_position', 'right');

if(ts_is_woo_shop()) :
    $ts_sidebar_position = ts_postmeta_vs_default($ts_page_id, '_page_sidebar_position', $ts_sidebar_position);
endif;

get_header(); 
get_template_part('top');
get_template_part('title-page');
get_template_part('slider');
?>
            <div id="main-container-wrap" class="<?php echo esc_attr(ts_main_container_wrap_class('page'));?>">
                <div id="main-container" class="container clearfix" data-pos="<?php echo esc_attr($ts_sidebar_position);?>">
                    <div id="main" class="<?php echo esc_attr(ts_main_div_class());?> clearfix">
                        <div class="entry single-entry clearfix">
                            <div class="post">