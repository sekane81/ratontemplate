<?php
global $ts_page_id;

$ts_slider_source      = get_post_meta($ts_page_id, '_page_slider_source', true);
$ts_slider_type        = get_post_meta($ts_page_id, '_page_slider_type', true);
$ts_rev_slider         = get_post_meta($ts_page_id, '_page_rev_slider', true);

if(in_array($ts_slider_type, array('carousel', 'flex')) && $ts_slider_source) :

    get_template_part('includes/_sliders/carousel-flex-slider');
    
endif;

if($ts_slider_type == 'rev' && $ts_rev_slider) :

    get_template_part('includes/_sliders/rev-slider');
    
endif;
?>

                            
                            <!-- ticker: slider -->
                            <?php //echo ts_get_ticker('slider');?>
                            <!-- /ticker: slider -->