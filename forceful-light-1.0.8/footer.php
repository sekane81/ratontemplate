<?php 
$kopa_setting = kopa_get_template_setting(); 
$sidebars = $kopa_setting['sidebars'];

$total = count( $sidebars );

$footer_sidebar[0] = ($kopa_setting) ? $sidebars[$total - 4] : 'sidebar_3';
$footer_sidebar[1] = ($kopa_setting) ? $sidebars[$total - 3] : 'sidebar_4';
$footer_sidebar[2] = ($kopa_setting) ? $sidebars[$total - 2] : 'sidebar_5';
$footer_sidebar[3] = ($kopa_setting) ? $sidebars[$total - 1] : 'sidebar_6';

$kopa_custom_footer_description = kopa_get_option( 'kopa_theme_options_copyright' );
?>

<?php if ( is_active_sidebar( $footer_sidebar[0] ) || is_active_sidebar( $footer_sidebar[1] ) || is_active_sidebar( $footer_sidebar[2] ) || is_active_sidebar( $footer_sidebar[3] ) ) { ?>
    <div id="bottom-sidebar">
        
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col">
                        <div class="r-color"></div>
                        <div class="row-fluid">
                            <div class="span4 widget-area-8">
                                <?php if ( is_active_sidebar( $footer_sidebar[0] ) ) {
                                    dynamic_sidebar( $footer_sidebar[0] );
                                } ?>
                            </div><!--span4-->
                            <div class="span4 widget-area-9">
                                <?php if ( is_active_sidebar( $footer_sidebar[1] ) ) {
                                    dynamic_sidebar( $footer_sidebar[1] );
                                } ?>
                            </div><!--span4-->
                            <div class="span4 widget-area-10">
                                <?php if ( is_active_sidebar( $footer_sidebar[2] ) ) {
                                    dynamic_sidebar( $footer_sidebar[2] );
                                } ?>
                            </div><!--span4-->
                        </div><!--row-fluid-->
                    </div><!--l-col-->
                    <div class="r-col widget-area-11">
                        <?php if ( is_active_sidebar( $footer_sidebar[3] ) ) {
                            dynamic_sidebar( $footer_sidebar[3] );
                        } ?>                    
                    </div><!--r-col-->
                </div><!--span12-->
            </div><!--row-fluid-->
        </div><!--wrapper-->
    </div><!--bottom-sidebar-->
<?php } ?>

<footer id="page-footer">
    
    <div class="wrapper clearfix">
        <div class="l-col clearfix">
            <div class="r-color"></div>
            <p id="copyright"><?php echo htmlspecialchars_decode( stripslashes( $kopa_custom_footer_description ) ); ?></p>
        </div>
        <div class="r-col clearfix">
            <?php 
            if ( has_nav_menu( 'footer-nav' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer-nav',
                    'container'      => '',
                    'menu_id'        => 'footer-menu',
                    'items_wrap'     => '<ul id="%1$s" class="clearfix">%3$s</ul>',
                    'depth'          => -1
                ) );
            }
            ?>
        </div>
        
    </div><!--wrapper-->
</footer><!--page-footer-->

<?php wp_footer(); ?>
</body>

</html>