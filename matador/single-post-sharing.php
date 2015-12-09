
                                            <div id="ts-post-comments-share-wrap" class="clearfix <?php echo esc_attr(ts_post_sharing_class());?>">
                                                <?php
                                                $comment_number = get_comments_number();
                                                $ts_using_recommended_disqus_settings = ts_option_vs_default('using_recommended_disqus_settings', 'no');
                                                ?>
                                                <a href="<?php echo get_permalink().ts_link2comments();?>" class="to-comments-link small-size smoothscroll" id="ts-moon-comment-bubble"><strong><?php 
                                                    echo '<span  class="disqus-comment-count" data-disqus-url="'.get_permalink().'">';
                                                    echo intval($comment_number);
                                                    echo ($ts_using_recommended_disqus_settings == 'yes') ? '</span> ' : ' ';
                                                    echo ($comment_number == 1) ? __( 'Comment', 'ThemeStockyard') : __('Comments', 'ThemeStockyard');
                                                    echo ($ts_using_recommended_disqus_settings == 'yes') ? '' : '</span>';
                                                    ?></strong></a>
                                                <?php
                                                $ts_sharing_options = ts_sharing_options_on_posts();
                                                if($ts_sharing_options->show) :
                                                ?>            
                                                <div id="page-share" class="not-pulled small">
                                                    <?php echo ts_social_sharing(); ?>
                                                </div>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                            