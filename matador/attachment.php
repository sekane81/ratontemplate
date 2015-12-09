<?php
global $smof_data, $ts_page_id;

$ts_page_object = get_queried_object();
$ts_page_id     = (is_single()) ? $post->ID : get_queried_object_id();

$ts_show_top_ticker_option = (ts_option_vs_default('show_page_top_ticker', 0) == 1) ? 'yes' : 'no';
$ts_show_top_ticker = ts_postmeta_vs_default($ts_page_id, '_page_top_ticker', $ts_show_top_ticker_option);

$crop_width = ts_option_vs_default('cropped_featured_image_width_full', 1040, true);
$crop_height = 0;

get_header(); 
get_template_part('top');
get_template_part('title-page');
?>
            <div id="main-container-wrap" class="<?php echo esc_attr(ts_main_container_wrap_class('page'));?>">
                <?php                                       
                if (have_posts()) : 
                    while (have_posts()) : the_post(); 
                ?>
                <div id="main-container" class="container clearfix">
                    <div id="main" class="no-sidebar clearfix">
                        <div class="entry single-entry clearfix">                     
                            <div id="ts-post-content-sidebar-wrap" class="clearfix">
                                <div id="ts-post-wrap">
                                    <div id="ts-post-featured-media-wrap">
                                        <div class="featured-photo text-center"><a href="'.esc_url(get_permalink()).'">
                                            <p><?php echo wp_get_attachment_image( $post->ID, 'large');?></p>
                                        </a></div>
                                    </div> 
                                    <div id="ts-post" <?php post_class('post clearfix'); ?>>                                        
                                        <div id="ts-post-the-content-wrap">                                            
                                            <div id="ts-post-the-content">
                                                <?php
                                                the_content();
                                                
                                                wp_link_pages('before=<div class="page-links">'.__('Pages: ', 'ThemeStockyard').'<span class="wp-link-pages">&after=</span></div>&link_before=<span>&link_after=</span>'); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="ts-comments-wrap-wrap" class="clearfix">
                                        <?php
                                        if(get_comments_number() < 1) :
                                            echo '<div id="comments">';
                                            echo do_shortcode('[divider height="0"]');
                                            echo '</div>';
                                        endif;
                                        ?>
                                        <div id="ts-comments-wrap">
                                            <?php comments_template(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div><!-- #main-container -->
                            
                <?php                        
                    endwhile; 
                else :
                ?>
                <div id="main-container" class="container clearfix">
                    <div id="main" class="no-sidebar clearfix">
                        <div class="entry single-entry clearfix">
                            <div class="post"><p><?php _e('Sorry, the post you are looking for does not exist.', 'ThemeStockyard');?></p></div>
                        </div>
                    </div>
                </div><!-- #main-container -->
                <?php
                endif;
                ?>
            </div><!-- #main-container-wrap -->
            
<?php get_footer(); ?>
