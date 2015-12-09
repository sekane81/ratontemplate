<?php
$ts_query = (isset($atts) && ($atts['default_query'] === false)) ? new WP_Query($atts) : $wp_query;
$atts = (isset($atts)) ? $atts : array();

$slider_type = 'flexslider';

if($slider_type == 'flexslider') :
    $wrap_class = 'flexslider';
    $container_class = 'slides';
    $container_el = 'ul';
    $item_class = 'flex-item';
    $item_el = 'li';
    
    $image_size = (isset($atts['image_size'])) ? $atts['image_size'] : '';
    
    if($image_size == 'medium' || (ts_attr_is_true($ts_show_sidebar) && (!$image_size || $image_size == 'large'))) :
        $img_width = 720;
        $img_height = 480;
    elseif($image_size == 'small') :
        $img_width = 400;
        $img_height = 267;
    else :
        $img_width = 1040;
        $img_height = 540;
    endif;
endif;
?> 
            <div class="ts-slider-wrapx">
                <div class="ts-slider-wrap loop-slider-wrap <?php echo esc_attr($wrap_class);?> <?php echo esc_attr(ts_loop_wrap_class($atts));?>">
                    <<?php echo tag_escape($container_el);?> class="<?php echo esc_attr($container_class);?>" data-slide-width="<?php echo absint($img_width);?>" data-desired-slide-width="<?php echo absint($img_width);?>">
                        <?php
                        $excerpt_length = (isset($atts['excerpt_length']) && $atts['excerpt_length'] != '') ? $atts['excerpt_length'] : 150;
                        
                        $ts_show = ts_maybe_show_blog_elements($atts);
                        
                        $show_excerpt = ($excerpt_length == '0' || !$ts_show->excerpt) ? false : true;
                        
                        $title_size = ts_get_blog_loop_title_size($atts, 2);
                        
                        $text_align = ts_get_blog_loop_text_align($atts);
                        
                        if($ts_query->have_posts()) : 
                            while($ts_query->have_posts()) :
                                $ts_query->the_post();
                                $atts['exclude_these_later'] = (isset($atts['exclude_these_later'])) ? $atts['exclude_these_later'] : '';
                                if(!ts_attr_is_false($atts['exclude_these_later'])) $ts_previous_posts[] = $ts_query->post->ID;
                                
                                $descr = (has_excerpt()) ? strip_tags(get_the_excerpt()) : apply_filters('the_content', get_the_content());
                                $descr = ts_trim_text($descr, $excerpt_length);
                                $show_excerpt = (count(trim($descr)) < 1) ? false : $show_excerpt;
                                
                                $url        = get_permalink();
                                $date       = get_the_date('M j, Y');
                                $category   = ts_get_the_category('category', 'big_array:1', '', $ts_query->post->ID);
                                
                                $cat_name   = $category[0]['name'];
                                $cat_color  = ($category[0]['color']) ? $category[0]['color'] : 'primary';
                                
                                $alt_cat_name = get_post_meta( $ts_query->post->ID, '_p_alt_category_text', true );
                    
                                $cat_name   = (trim($alt_cat_name)) ? $alt_cat_name : $cat_name;
                                
                                $allow_vids = (isset($atts['allow_videos'])) ? $atts['allow_videos'] : '';
                                $media = ts_get_featured_media(array('allow_videos'=>$allow_vids,'allow_video_embed_code'=>'no','allow_galleries'=>'no','within_slider'=>true,'slider_type'=>$slider_type, 'media_width'=>$img_width, 'media_height'=>$img_height, 'return'=>'big_array'));
                                $media = ts_array2object($media);
                        ?>                        
                        <<?php echo tag_escape($item_el);?> class="<?php echo esc_attr($item_class);?> ts-slider-item" data-width="<?php echo absint($img_width);?>" data-height="<?php echo absint($img_height);?>">
                            <?php
                            if($media->format == 'video') :
                                echo balanceTags($media->html); // sanitized more extensively in /includes/theme-functions.php
                            else :
                            ?>
                            <a href="<?php echo esc_url($url);?>" class="ts-item-link">
                                <?php
                                echo strip_tags($media->html, '<img>');
                                ?>
                                <div class="ts-item-details">
                                    <div class="ts-item-details-inner">
                                        <?php                                    
                                        if(strpos($media->html, '<img') !== false) :   
                                        ?>
                                            <p class="blog-meta <?php echo esc_attr($text_align);?>"><span class="mimic-smaller color-white uppercase bold slider-meta-item slider-meta-item-category"><?php echo esc_html($cat_name);?></span></p>
                                        <?php
                                        
                                            if($ts_show->title) :
                                        ?>
                                            <h<?php echo absint($title_size->h).' '.$title_size->style;?> class="blog-title title title-h <?php echo esc_attr($text_align);?> color-white"><?php echo ts_sticky_badge();?><?php the_title();?></h<?php echo absint($title_size->h);?>>
                                        <?php
                                            endif;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </a>
                            <?php
                            endif;
                            ?>
                        </<?php echo tag_escape($item_el);?>>
                        
                        <?php
                            endwhile;
                        endif;
                        ?>                        
                    </<?php echo tag_escape($container_el);?>>
                    
                    <?php
                    if($slider_type == 'carousel') :
                    ?>
                    <span class="pause-slider smaller uppercase bg-primary"><i class="fa fa-pause"></i> <?php _e('Pause','ThemeStockyard');?></span>
                    <span class="play-slider smaller uppercase bg-primary"><i class="fa fa-play"></i> <?php _e('Resume','ThemeStockyard');?></span>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
