<?php
/*
Template Name: Home - Alternative 2
*/

$ts_page_object = get_queried_object();
$ts_page_id     = (is_single()) ? $post->ID : get_queried_object_id();

global $ts_template_content;

$ts_template_content = '[blog_banner limit="2" columns="2" fullwidth="yes" infinite_scroll="no" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" show_pagination="no" ignore_sticky_posts="0"][/blog_banner]

[blog layout="4column" limit="20" infinite_scroll="yes" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="yes" show_meta="yes" show_read_more="no" allow_videos="yes" allow_galleries="yes" ignore_sticky_posts="0"][/blog]';

get_template_part('page');