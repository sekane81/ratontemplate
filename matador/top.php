<?php
global $smof_data, $ts_top_ad, $woocommerce, $ts_page_id;
?>
                <div id="top-wrap" class="<?php echo ts_top_class();?>">                      
                    <!-- Top -->
                    <div id="top-container" class="top-default">
                        <div id="top" class="ts-top">
                            
                            <!-- top-bar -->
                            <?php echo ts_get_top_bar();?>
                            <!-- /top-bar -->
                            
                            <!-- ticker: top -->
                            <?php echo ts_get_ticker('top');?>
                            <!-- /ticker: top -->
                            
                            <div id="logo-nav-wrap">
                                <div id="logo-tagline-wrap" class="container logo-tagline-wrap">
                                    <div id="logo" class="main-logo">
                                        <?php 
                                        echo ts_theme_logo();
                                        echo ts_theme_logo_tagline();
                                        ?>
                                    </div>                                
                                </div>
                                
                                <div id="nav" class="main-nav-wrap ts-main-nav-wrap container">
                                    <div id="ts-main-nav-inner-wrap">
                                        <div id="main-nav-mobile" class="mobile-nav"><a id="ts-top-mobile-menu" class="mobile-menu"><strong class="mobile-menu-icon"></strong><span class="mobile-menu-sep"></span><?php _e('Menu','ThemeStockyard');?></a></div>
                                        <div id="main-nav" class="main-nav normal">
                                            <?php
                                            $nav_menu_options = array(
                                                'container'         => false, 
                                                'theme_location'    => 'main_nav', 
                                                'menu_class'        => 'sf-menu clearfix', 
                                                'depth'             => 3, 
                                                'menu_id'           => 'main-nav-links',
                                                'link_before'       => '<span>', 
                                                'link_after'        => '</span>',
                                                'items_wrap'        => '<ul class="sf-menu clearfix">%3$s</ul>'
                                            );
                                            if( function_exists( 'uberMenu_direct' ) ) {
                                                echo uberMenu_direct( 'main_nav', false, false);
                                            } else {
                                                wp_nav_menu($nav_menu_options);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- ticker: nav -->
                            <?php echo ts_get_ticker('nav');?>
                            <!-- /ticker: nav -->
                        </div>
                    </div>
                    <!-- / #top -->
                </div>
                <!-- / #top-wrap -->
