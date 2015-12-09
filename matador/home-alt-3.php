<?php
/*
Template Name: Home - Alternative 3
*/

$ts_page_object = get_queried_object();
$ts_page_id     = (is_single()) ? $post->ID : get_queried_object_id();

$ts_home_alt_3_cat = ts_postmeta_vs_default($ts_page_id, '_page_home_alt_3_cat', '');

global $ts_template_content;

$ts_template_content = '[columns_row margin_top="0px" margin_bottom="0px"]
[column size="two_third" last="no"]
[blog_slider limit="3" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" title_size="" text_align="center" allow_videos="yes" image_size="medium" ignore_sticky_posts="0"][/blog_slider]
[/column]
[column size="one_third" last="yes"]
[blog_widget widget_heading="" widget_layout="vertical" limit="2" cat="'.esc_attr($ts_home_alt_3_cat).'" override_widget_heading="yes" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_excerpt="no" show_meta="yes" show_media="first" allow_videos="yes" allow_galleries="yes" ignore_sticky_posts="0"][/blog_widget]
[/column]
[/columns_row]

[divider height="40"]

[blog_banner columns="2" limit="6" fullwidth="no" infinite_scroll="no" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" show_pagination="no" ignore_sticky_posts="0"][/blog_banner]

[blog layout="3-column-grid" limit="3" infinite_scroll="no" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="yes" show_meta="yes" show_read_more="no" allow_videos="yes" allow_galleries="yes" ignore_sticky_posts="0"][/blog]';

get_template_part('page');