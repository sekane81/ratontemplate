<?php 
$kopa_display_header_headline = kopa_get_option( 'kopa_theme_options_display_headline_status' );
if ( 'show' == $kopa_display_header_headline ) { ?>
    <!-- top-sidebar -->
    <div class="kp-headline-wrapper">
        
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col widget-area-4">
                        <div class="r-color"></div>
                        <h4 class="kp-headline-title"><?php echo kopa_get_option( 'kopa_theme_options_headline_title' ); ?> <span><?php echo kopa_get_option( 'kopa_theme_options_headline_light_title' ) ?></span></h4>
                        <div class="kp-headline clearfix">                        
                            <dl class="ticker-1 clearfix">
                                <?php 
                                $kopa_headline_category_id = (int) kopa_get_option( 'kopa_theme_options_headline_category_id' );
                                $kopa_theme_options_headline_posts_number = (int) kopa_get_option( 'kopa_theme_options_headline_posts_number' );

                                if ( $kopa_theme_options_headline_posts_number <= 1 ) {
                                    $kopa_theme_options_headline_posts_number = 10;
                                }

                                $kopa_headline_posts = new WP_Query( array(
                                    'cat'            => $kopa_headline_category_id,
                                    'posts_per_page' => $kopa_theme_options_headline_posts_number,
                                ) );

                                if ( $kopa_headline_posts->have_posts() ) {
                                    while ( $kopa_headline_posts->have_posts() )  {
                                        $kopa_headline_posts->the_post();
                                        echo '<dd><a href="'.get_permalink().'">'.get_the_title().'</a></dd>';
                                    }
                                }

                                wp_reset_postdata();
                                ?>
                            </dl>
                            <!--ticker-1-->
                        </div>
                        <!--kp-headline-->
                    </div>
                    <!-- widget-area-4 -->
                    <div class="r-col widget-area-5">
                        <?php the_widget( 'Kopa_Widget_Socials' ) ?>
                    </div>
                    <!-- widget-area-5 -->
                </div>
                <!-- span12 -->
            </div>
            <!-- row-fluid -->
        </div>
        <!-- wrapper -->
    </div>
    <!--kp-headline-wrapper-->
<?php
} // endif
?>