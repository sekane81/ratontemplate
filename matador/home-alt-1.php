<?php
/*
Template Name: Home - Alternative 1
*/

$ts_page_object = get_queried_object();
$ts_page_id     = (is_single()) ? $post->ID : get_queried_object_id();

global $ts_template_content;

$ts_template_content = '[blog layout="2column" limit="2" infinite_scroll="no" infinite_scroll_button_text="" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="yes" show_meta="yes" show_read_more="yes" allow_videos="yes" allow_galleries="yes"][/blog]

[blog layout="3column" limit="6" infinite_scroll="yes_button" infinite_scroll_button_text="" category_name="" include="" exclude="" exclude_previous_posts="yes" exclude_these_later="yes" excerpt_length="" title_size="" text_align="" show_pagination="no" show_excerpt="yes" show_meta="yes" show_read_more="yes" allow_videos="yes" allow_galleries="yes"][/blog]';

get_template_part('page');