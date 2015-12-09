<?php
/*
Template Name: Sitemap
*/
global $smof_data, $ts_previous_posts, $ts_page_id, $ts_show_top_ticker;

$ts_page_object = get_queried_object();
$ts_page_id     = (is_single()) ? $post->ID : get_queried_object_id();
$ts_custom_css  = get_post_meta($ts_page_id, '_page_css', true);

$ts_show_top_ticker_option = (ts_option_vs_default('show_page_top_ticker', 0) == 1) ? 'yes' : 'no';
$ts_show_top_ticker = ts_postmeta_vs_default($ts_page_id, '_page_top_ticker', $ts_show_top_ticker_option);

$ts_show_sidebar_option = (ts_option_vs_default('show_page_sidebar', 1) != 1) ? 'no' : 'yes';
$ts_show_sidebar = ts_postmeta_vs_default($ts_page_id, '_page_sidebar', $ts_show_sidebar_option);

$ts_sidebar_position_option = ts_option_vs_default('page_sidebar_position', 'right');
$ts_sidebar_position = ts_postmeta_vs_default($ts_page_id, '_page_sidebar_position', $ts_sidebar_position_option);

$ts_page_comments = (ts_option_vs_default('page_comments',0) == 1) ? true : false;

get_header(); 
get_template_part('top');
get_template_part('title-page');
?>
            <div id="main-container-wrap" class="<?php echo esc_attr(ts_main_container_wrap_class('page'));?>">
            
                <?php get_template_part('slider');?>
                
                <div id="main-container" class="container clearfix">
                    <div id="main" class="<?php echo esc_attr(ts_main_div_class());?> clearfix">
                        <div class="entry single-entry clearfix">
                            <div class="post">
                                <?php 
                                if (have_posts()) : while (have_posts()) : the_post();
                                    the_content();
                                endwhile; endif;
                                
                                wp_link_pages('before=<div class="page-links">'.__('Pages: ', 'ThemeStockyard').'&after=</div>&link_before=<span>&link_after=</span>'); 
                                
                                if(trim(strip_tags(get_the_content()))) :
                                    echo do_shortcode('[divider style="line" padding_top="30px" padding_bottom="30px"]');
                                endif;
                                ?>
                            </div>
                            <div class="mimic-post">
                                    <div class="container">
                                        <div class="ts-row">
                                            <div class="span4">
                                                <h3><?php _e('Pages','ThemeStockyard');?></h3>
                                                <ul><?php wp_list_pages(array('title_li'=>''));?></ul>
                                            </div>
                                            <div class="span4">
                                                <h3><?php _e('Categories','ThemeStockyard');?></h3>
                                                <ul><?php wp_list_categories(array('title_li'=>''));?></ul>
                                            </div>
                                            <div class="span4">
                                                <h3><?php _e('Authors','ThemeStockyard');?></h3>
                                                <ul><?php wp_list_authors();?></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

<?php ts_get_sidebar(); ?>

                </div><!-- #main-container -->
            </div><!-- #main-container-wrap -->
            
<?php get_footer(); ?>
