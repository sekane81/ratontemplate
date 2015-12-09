<?php
global $smof_data, $ts_options;
?>
            <?php
            echo ts_get_ticker('above-footer');
            ?>
            <div id="footer-copyright-wrap">
                <?php
                echo ts_get_bottom_ad();
                
                echo ts_bottom_ad_widgets_sep(false);
                
                ts_footer_widgets();
                ?>
                
                <?php
                if(ts_option_vs_default('show_copyright', 1) == 1) :
                ?>
                <div id="copyright-nav-wrap">
                    <div id="copyright-nav" class="container">
                        <div class="row">
                            <div class="nav mimic-smaller uppercase span6">
                                <?php
                                wp_nav_menu(array('container' => false, 'theme_location' => 'footer_nav', 'echo' => 1, 'depth' => 1));
                                ?>
                            </div>
                            <div class="copyright span6">
                                <p><?php echo do_shortcode(ts_option_vs_default('copyright_text'));?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endif;
                ?>
                
                <?php
                if(ts_option_vs_default('show_back_to_top', 0) == 1) :
                ?>
                <div id="ts-back-to-top-wrap">
                    <a href="#wrap" id="ts-back-to-top" class="smoothscroll-up"><i class="fa fa-arrow-up"></i></a>
                </div>
                <?php
                endif;
                ?>
                
            </div>
        </div>
    </div>
<?php 
$ts_disqus_shortname = ts_option_vs_default('disqus_shortname', '');
if((ts_option_vs_default('use_disqus', 1) == 1) && trim($ts_disqus_shortname)) :
?>
<script type="text/javascript">
/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
var disqus_shortname = '<?php echo esc_js($ts_disqus_shortname);?>'; // required: replace example with your forum shortname
(function($) {
    $(window).load(function() {
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = '//<?php echo esc_js($ts_disqus_shortname);?>.disqus.com/count.js';
            (document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    });
})(jQuery);
</script>
<?php
endif;
if(ts_enable_style_selector()) :
    get_template_part('style_selector');
endif;
wp_footer();



$post = get_post(0);
    
    if(is_object($post) && isset($post->ID))
    {
        echo '<!-- postid: '.$post->ID.' -->';
    }
    else
    {
        echo '<!-- no post -->';
    }
?>
</body>
</html>