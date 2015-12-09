<?php
/*
Template Name: Home - Alternative 4
*/

$ts_page_object = get_queried_object();
$ts_page_id     = (is_single()) ? $post->ID : get_queried_object_id();

$ts_home_alt_4_cat_left = ts_postmeta_vs_default($ts_page_id, '_page_home_alt_4_cat_left', '');
$ts_home_alt_4_cat_right = ts_postmeta_vs_default($ts_page_id, '_page_home_alt_4_cat_right', '');

global $ts_template_content;

$ts_template_content = '[columns_row margin_top="0px" margin_bottom="0px"]
[column size="one_fifth" last="no"]
[blog_widget widget_heading="" widget_layout="vertical" limit="3" cat="'.esc_attr($ts_home_alt_4_cat_left).'" override_widget_heading="yes" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_excerpt="yes" show_meta="yes" show_media="yes" allow_videos="no" allow_galleries="no" ignore_sticky_posts="0"][/blog_widget]
[/column]
[column size="three_fifth" last="no"]
[blog layout="" limit="2" infinite_scroll="no" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="yes" show_meta="yes" show_read_more="no" allow_videos="no" allow_galleries="no" ignore_sticky_posts="0"][/blog]
[/column]
[column size="one_fifth" last="yes"]
[blog_widget widget_heading="" widget_layout="vertical" limit="3" cat="'.esc_attr($ts_home_alt_4_cat_right).'" override_widget_heading="yes" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_excerpt="yes" show_meta="yes" show_media="yes" allow_videos="no" allow_galleries="no" ignore_sticky_posts="0"][/blog_widget]
[/column]
[/columns_row]

[blog layout="4-column-grid" limit="4" infinite_scroll="no" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="yes" show_meta="yes" show_read_more="no" allow_videos="no" allow_galleries="yes" ignore_sticky_posts="0"][/blog]';

get_template_part('page');