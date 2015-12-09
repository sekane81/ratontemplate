<?php
global $smof_data, $ts_page_id, $ts_page_title;

$ts_page_id             = get_option('page_for_posts');
$ts_show_sidebar = (ts_option_vs_default('show_archive_sidebar', 1) != 1) ? 'no' : 'yes';

$ts_sidebar_position = ts_option_vs_default('page_sidebar_position', 'right');

$post                   = $posts[0];
$ts_queried_object      = get_query_var('author');
$ts_page_title          = __('Posts by:', 'ThemeStockyard').' '.get_the_author_meta('display_name', get_query_var('author'));
$ts_caption             = (trim($ts_caption)) ? $ts_caption : '';

get_header(); 
get_template_part('top');
get_template_part('title-page');
?>
            <div id="main-container-wrap" class="<?php echo esc_attr(ts_main_container_wrap_class('page'));?>">
                <div id="main-container" class="container clearfix">            
                    <div id="main" class="<?php echo esc_attr(ts_main_div_class());?> clearfix">
                        <div class="entry single-entry clearfix">
                            <div class="post">
                                <?php
                                /* 
                                 * Run the loop to output the posts.
                                 */
                                $ts_loop = (isset($smof_data['archive_layout'])) ? $smof_data['archive_layout'] : '';
                                ts_blog($ts_loop, array('default_query' => true));
                                ?>
                            </div>
                        </div>
                    </div>

    <?php ts_get_sidebar(); ?>

                </div><!-- #main-container -->
            </div><!-- #main-container-wrap -->
            
<?php get_footer(); ?>