<?php
/*
Template Name: Home - Alternative 5
*/

$ts_page_object = get_queried_object();
$ts_page_id     = (is_single()) ? $post->ID : get_queried_object_id();

global $ts_template_content;

$ts_template_content = '[blog_slider slider_type="flexslider" limit="5" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="center" show_excerpt="yes" show_meta="yes" allow_videos="yes" image_size="medium"][/blog_slider]

[divider height="50"]

[blog layout="2-column" limit="4" infinite_scroll="no" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="yes" show_meta="yes" show_read_more="yes" allow_videos="yes" allow_galleries="yes" ignore_sticky_posts="0"][/blog]

[blog layout="4-column" limit="4" infinite_scroll="no" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="no" show_meta="yes" show_read_more="no" allow_videos="yes" allow_galleries="yes" ignore_sticky_posts="0"][/blog]';

get_template_part('page');