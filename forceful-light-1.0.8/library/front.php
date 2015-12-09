<?php
add_action('after_setup_theme', 'kopa_front_after_setup_theme');

function kopa_front_after_setup_theme() {
    add_theme_support('post-formats', array('gallery', 'audio', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('editor_style');
    add_editor_style('editor-style.css');

    global $content_width;
    if (!isset($content_width)) {
        $content_width = 795;
    }

    register_nav_menus(array(
        'main-nav' => __('Main Menu', kopa_get_domain()),
        'footer-nav' => __('Footer Menu', kopa_get_domain())
    ));

    if (!is_admin()) {
        add_action('wp_enqueue_scripts', 'kopa_front_enqueue_scripts');
        add_action('wp_footer', 'kopa_footer');
        add_action('wp_head', 'kopa_head');
        add_filter('widget_text', 'do_shortcode');
        add_filter('the_category', 'kopa_the_category');
        add_filter('get_the_excerpt', 'kopa_get_the_excerpt');
        add_filter('post_class', 'kopa_post_class');
        add_filter('body_class', 'kopa_body_class');
        add_filter('wp_nav_menu_items', 'kopa_add_icon_home_menu', 10, 2);
        // add_filter('comment_reply_link', 'kopa_comment_reply_link');
        // add_filter('edit_comment_link', 'kopa_edit_comment_link');
        add_filter('wp_tag_cloud', 'kopa_tag_cloud');
        add_filter('excerpt_length', 'kopa_custom_excerpt_length');
        add_filter('excerpt_more', 'kopa_custom_excerpt_more');
    } else {
        add_action('show_user_profile', 'kopa_edit_user_profile');
        add_action('edit_user_profile', 'kopa_edit_user_profile');
        add_action('personal_options_update', 'kopa_edit_user_profile_update');
        add_action('edit_user_profile_update', 'kopa_edit_user_profile_update');

    }

    $sizes = array(
        'kopa-image-size-0' => array(579, 382, TRUE, __('Flexslider Post Image (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-1' => array(247, 146, TRUE, __('Carousel Post Image (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-2' => array(451, 259, TRUE, __('Popular Widget Post Image (Kopatheme)', kopa_get_domain())),
        //'kopa-image-size-3' => array(783, 450, TRUE, __('Entry List Widget Post Image (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-4' => array(81, 81, TRUE, __('Entry List Widget Small Post Image (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-5' => array(276, 202, TRUE, __('Gallery Widget Post Image (Kopatheme)', kopa_get_domain())),
        //'kopa-image-size-6' => array(496, 346, TRUE, __('Quick Sort Widget Post Image (Kopatheme)', kopa_get_domain())),
        //'kopa-image-size-7' => array(199, 173, TRUE, __('Carousel Scroll Bar Widget Post Image (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-8' => array(648, 430, TRUE, __('Single Post Image (Kopatheme)', kopa_get_domain())),
    );

    apply_filters('kopa_get_image_sizes', $sizes);

    foreach ($sizes as $slug => $details) {
        add_image_size($slug, $details[0], $details[1], $details[2]);
    }
}

function kopa_tag_cloud($out) {

    $matches = array();
    $pattern = '/<a[^>]*?>([\\s\\S]*?)<\/a>/';
    preg_match_all($pattern, $out, $matches);

    $htmls = $matches[0];
    $texts = $matches[1];
    $new_html = '';
    for ($index = 0; $index < count($htmls); $index++) {

        $new_html.= preg_replace('#(<a.*?(href=\'.*?\').*?>).*?(</a>)#', '<a ' . '$2' . '>' . $texts[$index] . '$3' . ' ', $htmls[$index]);
    }

    return $new_html;
}

function kopa_comment_reply_link($link) {
    return str_replace('comment-reply-link', 'comment-reply-link small-button green-button', $link);
}

function kopa_edit_comment_link($link) {
    return str_replace('comment-edit-link', 'comment-edit-link small-button green-button', $link);
}

function kopa_post_class($classes) {
    if (is_single()) {
        $classes[] = 'entry-box';
        $classes[] = 'clearfix';
    }
    return $classes;
}

function kopa_body_class($classes) {
    $template_setting = kopa_get_template_setting();

    if (is_front_page()) {
        $classes[] = 'home-page';
    } else {
        $classes[] = 'sub-page';
    }

    if (is_404()) {
        $classes[] = 'kopa-404-page';
    }

    switch ($template_setting['layout_id']) {
        case 'single-right-sidebar':
            break;
    }

    return $classes;
}

function kopa_footer() {
    wp_nonce_field('kopa_set_view_count', 'kopa_set_view_count_wpnonce', false);
    wp_nonce_field('kopa_set_user_rating', 'kopa_set_user_rating_wpnonce', false);
}

function kopa_front_enqueue_scripts() {
    if (!is_admin()) {
        global $wp_styles, $is_IE;

        $dir = get_template_directory_uri();

        

        /* STYLESHEETs */
        wp_enqueue_style('kopa-google-font', 'http://fonts.googleapis.com/css?family=Open+Sans', array(), NULL);
        wp_enqueue_style('kopa-bootstrap', $dir . '/css/bootstrap.css');
        wp_enqueue_style('kopa-FontAwesome', $dir . '/css/font-awesome.css');
        wp_enqueue_style('kopa-superfish', $dir . '/css/superfish.css');
        wp_enqueue_style('kopa-prettyPhoto', $dir . '/css/prettyPhoto.css');
        wp_enqueue_style('kopa-flexlisder', $dir . '/css/flexslider.css');
        wp_enqueue_style('kopa-mCustomScrollbar', $dir . '/css/jquery.mCustomScrollbar.css');
        wp_enqueue_style('kopa-owlCarousel', $dir . '/css/owl.carousel.css');
        wp_enqueue_style('kopa-owltheme', $dir . '/css/owl.theme.css');
        
        wp_enqueue_style('kopa-style', get_stylesheet_uri());
        wp_enqueue_style('kopa-extra-style', $dir . '/css/extra.css');
        wp_enqueue_style('kopa-bootstrap-responsive', $dir . '/css/bootstrap-responsive.css');

        if ('enable' == kopa_get_option('kopa_theme_options_responsive_status')) {
            wp_enqueue_style('kopa-responsive', $dir . '/css/responsive.css');
        }

        if ($is_IE) {
            wp_register_style('kopa-ie', $dir . '/css/ie.css', array(), NULL);
            $wp_styles->add_data('kopa-ie', 'conditional', 'lt IE 9');
            wp_enqueue_style('kopa-ie');
        }

        /* JAVASCRIPTs */

        wp_enqueue_script('kopa-modernizr', $dir . '/js/modernizr.custom.js');

        wp_localize_script('jquery', 'kopa_front_variable', kopa_front_localize_script());

        /**
         * Fix: Superfish conflicts with WP admin bar for WordPress < 3.6
         * @author joeldbirch
         * @link https://github.com/joeldbirch/superfish/issues/14
         * @filesource https://github.com/briancherne/jquery-hoverIntent 
         */
        global $wp_version;
        if (version_compare($wp_version, '3.6', '<')) {
            wp_deregister_script('hoverIntent');
            wp_register_script('hoverIntent', $dir . '/js/jquery.hoverIntent.js', array('jquery'), 'r7');
        }

        wp_enqueue_script('kopa-superfish-js', $dir . '/js/superfish.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-retina', $dir . '/js/retina.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-bootstrap-js', $dir . '/js/bootstrap.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-flexlisder-js', $dir . '/js/jquery.flexslider-min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-carouFredSel', $dir . '/js/jquery.carouFredSel-6.0.4-packed.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-jflickrfeed', $dir . '/js/jflickrfeed.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-prettyPhoto-js', $dir . '/js/jquery.prettyPhoto.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-tweetable-js', $dir . '/js/tweetable.jquery.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-owlcarousel', $dir . '/js/owl.carousel.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-timeago-js', $dir . '/js/jquery.timeago.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-imagesloaded', $dir . '/js/imagesloaded.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-jquery-validate', $dir . '/js/jquery.validate.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-jquery-form', $dir . '/js/jquery.form.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-mCustomScrollbar', $dir . '/js/jquery.mCustomScrollbar.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-modernizr-transitions', $dir . '/js/modernizr-transitions.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-masonry', $dir . '/js/masonry.pkgd.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-filtermasonry', $dir . '/js/filtermasonry.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-set-view-count', $dir . '/js/set-view-count.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-custom-js', $dir . '/js/custom.js', array('jquery'), NULL, TRUE);
        // send localization to frontend
        wp_localize_script('kopa-custom-js', 'kopa_custom_front_localization', kopa_custom_front_localization());

        if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
        }

       
    }
}

function kopa_front_localize_script() {
    $kopa_variable = array(
        'ajax' => array(
            'url' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        )
    );
    return $kopa_variable;
}

/**
 * Send the translated texts to frontend
 * @package Circle
 * @since Circle 1.12
 */
function kopa_custom_front_localization() {
    $front_localization = array(
        'validate' => array(
            'form' => array(
                'submit' => __('Submit', kopa_get_domain()),
                'sending' => __('Sending...', kopa_get_domain())
            ),
            'name' => array(
                'required' => __('Please enter your name.', kopa_get_domain()),
                'minlength' => __('At least {0} characters required.', kopa_get_domain())
            ),
            'email' => array(
                'required' => __('Please enter your email.', kopa_get_domain()),
                'email' => __('Please enter a valid email.', kopa_get_domain())
            ),
            'url' => array(
                'required' => __('Please enter your url.', kopa_get_domain()),
                'url' => __('Please enter a valid url.', kopa_get_domain())
            ),
            'message' => array(
                'required' => __('Please enter a message.', kopa_get_domain()),
                'minlength' => __('At least {0} characters required.', kopa_get_domain())
            )
        ),
        'twitter' => array(
            'loading' => __('Loading...', kopa_get_domain()),
            'failed' => __('Sorry, twitter is currently unavailable for this user.', kopa_get_domain())
        )
    );

    return $front_localization;
}

function kopa_the_category($thelist) {
    return $thelist;
}

/* FUNCTION */

function kopa_print_page_title() {
    global $page, $paged;
    wp_title('|', TRUE, 'right');
    bloginfo('name');
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        echo " | $site_description";
    if ($paged >= 2 || $page >= 2)
        echo ' | ' . sprintf(__('Page %s', kopa_get_domain()), max($paged, $page));
}



function kopa_set_view_count($post_id) {
    $new_view_count = 0;
    $meta_key = 'kopa_' . kopa_get_domain() . '_total_view';

    $current_views = (int) get_post_meta($post_id, $meta_key, true);

    if ($current_views) {
        $new_view_count = $current_views + 1;
        update_post_meta($post_id, $meta_key, $new_view_count);
    } else {
        $new_view_count = 1;
        add_post_meta($post_id, $meta_key, $new_view_count);
    }
    return $new_view_count;
}

function kopa_get_view_count($post_id) {
    $key = 'kopa_' . kopa_get_domain() . '_total_view';
    return kopa_get_post_meta($post_id, $key, true, 'Int');
}

function kopa_breadcrumb() {
    // get show/hide option
    $kopa_breadcrumb_status = kopa_get_option('kopa_theme_options_breadcrumb_status');

    if ($kopa_breadcrumb_status != 'show') {
        return;
    }

    if (is_main_query()) {
        global $post, $wp_query;

        $prefix = '&nbsp;/&nbsp;';
        $current_class = 'current-page';
        $description = '';
        $breadcrumb_before = '<div class="row-fluid"><div class="span12"><div class="breadcrumb">';
        $breadcrumb_after = '</div></div></div>';
        $breadcrumb_home = '<span>' . __('You are here:', kopa_get_domain()) . '</span> <a href="' . esc_url(home_url( '/' )) . '">' . __('Home', kopa_get_domain()) . '</a>';
        $breadcrumb = '';
        ?>

        <?php
        if (is_home()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Blog', kopa_get_domain()));
        } else if (is_post_type_archive('product') && jigoshop_get_page_id('shop')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(jigoshop_get_page_id('shop')));
        } else if (is_tag()) {
            $breadcrumb.= $breadcrumb_home;

            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $term->name);
        } else if (is_category()) {
            $breadcrumb.= $breadcrumb_home;

            $category_id = get_queried_object_id();
            $terms_link = explode(',', substr(get_category_parents(get_queried_object_id(), TRUE, ','), 0, (strlen(',') * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb.= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_category_by_ID(get_queried_object_id()));
        } else if (is_tax('product_cat')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

            $parents = array();
            $parent = $term->parent;
            while ($parent):
                $parents[] = $parent;
                $new_parent = get_term_by('id', $parent, get_query_var('taxonomy'));
                $parent = $new_parent->parent;
            endwhile;
            if (!empty($parents)):
                $parents = array_reverse($parents);
                foreach ($parents as $parent):
                    $item = get_term_by('id', $parent, get_query_var('taxonomy'));
                    $breadcrumb .= '<a href="' . get_term_link($item->slug, 'product_cat') . '">' . $item->name . '</a>';
                endforeach;
            endif;

            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_tax('product_tag')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';
            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_single()) {
            $breadcrumb.= $breadcrumb_home;

            if (get_post_type() === 'product') :

                $breadcrumb .= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';

                if ($terms = get_the_terms($post->ID, 'product_cat')) :
                    $term = apply_filters('jigoshop_product_cat_breadcrumb_terms', current($terms), $terms);
                    $parents = array();
                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by('id', $parent, 'product_cat');
                        $parent = $new_parent->parent;
                    endwhile;
                    if (!empty($parents)):
                        $parents = array_reverse($parents);
                        foreach ($parents as $parent):
                            $item = get_term_by('id', $parent, 'product_cat');
                            $breadcrumb .= '<a href="' . get_term_link($item->slug, 'product_cat') . '">' . $item->name . '</a>';
                        endforeach;
                    endif;
                    $breadcrumb .= '<a href="' . get_term_link($term->slug, 'product_cat') . '">' . $term->name . '</a>';
                endif;

                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title());

            else :

                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_category_link($category->term_id), $category->name);
                    }
                }

                $post_id = get_queried_object_id();
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title($post_id));

            endif;
        } else if (is_page()) {
            if (!is_front_page()) {
                $post_id = get_queried_object_id();
                $breadcrumb.= $breadcrumb_home;
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_permalink($crumb), get_the_title($crumb));
                }
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(get_queried_object_id()));
            }
        } else if (is_year() || is_month() || is_day()) {
            $breadcrumb.= $breadcrumb_home;

            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);

            $date['y'] = get_the_time('Y');
            $date['m'] = get_the_time('m');
            $date['d'] = get_the_time('j');

            if (is_year()) {
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['y']);
            }

            if (is_month()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date('F', mktime(0, 0, 0, $date['m'])));
            }

            if (is_day()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_month_link($date['y'], $date['m']), date('F', mktime(0, 0, 0, $date['m'])));
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['d']);
            }
        } else if (is_search()) {
            $breadcrumb.= $breadcrumb_home;

            $s = get_search_query();
            $c = $wp_query->found_posts;

            $description = sprintf(__('<span class="%1$s">Your search for "%2$s"', kopa_get_domain()), $current_class, $s);
            $breadcrumb .= $prefix . $description;
        } else if (is_author()) {
            $breadcrumb.= $breadcrumb_home;
            $author_id = get_queried_object_id();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</a>', $current_class, sprintf(__('Posts created by %1$s', kopa_get_domain()), get_the_author_meta('display_name', $author_id)));
        } else if (is_404()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Error 404', kopa_get_domain()));
        }

        if ($breadcrumb)
            echo apply_filters('kopa_breadcrumb', $breadcrumb_before . $breadcrumb . $breadcrumb_after);
    }
}

function kopa_get_related_articles() {
    if (is_single()) {
        $get_by = kopa_get_option('kopa_theme_options_post_related_get_by');
        if ('hide' != $get_by) {
            $limit = (int) kopa_get_option('kopa_theme_options_post_related_limit');
            if ($limit > 0) {
                global $post;
                $taxs = array();
                if ('category' == $get_by) {
                    $cats = get_the_category(($post->ID));
                    if ($cats) {
                        $ids = array();
                        foreach ($cats as $cat) {
                            $ids[] = $cat->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                } else {
                    $tags = get_the_tags($post->ID);
                    if ($tags) {
                        $ids = array();
                        foreach ($tags as $tag) {
                            $ids[] = $tag->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'post_tag',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                }

                if ($taxs) {
                    $related_args = array(
                        'tax_query' => $taxs,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => $limit
                    );
                    $related_posts = new WP_Query($related_args);
                    if ($related_posts->have_posts()) {
                        ?>
                        <div class="kopa-related-post">
                            <h4><?php _e('Related Posts', kopa_get_domain()); ?></h4>
                            <div class="list-carousel responsive" >
                                <ul class="kopa-featured-news-carousel" data-pagination-id="#single_related_posts_pager" data-scroll-items="1">
                        <?php
                        $post_index = 1;
                        while ($related_posts->have_posts()) {
                            $related_posts->the_post();

                            if ('video' == get_post_format()) {
                                $kopa_data_icon = 'film'; // icon-film-2
                            } elseif ('gallery' == get_post_format()) {
                                $kopa_data_icon = 'images'; // icon-images
                            } elseif ('audio' == get_post_format()) {
                                $kopa_data_icon = 'music'; // icon-music
                            } else {
                                $kopa_data_icon = 'pencil'; // icon-pencil
                            }
                            ?>
                                        <li>
                                            <article class="entry-item clearfix">
                                                <div class="entry-thumb">
                                        <?php
                                        // flag to determine whether or not display arrow button
                                        $kopa_has_printed_thumbnail = false;

                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('kopa-image-size-1'); // 247 x 146
                                            $kopa_has_printed_thumbnail = true;
                                        } elseif ('video' == get_post_format()) {
                                            $video = kopa_content_get_video(get_the_content());

                                            if (isset($video[0])) {
                                                $video = $video[0];
                                            } else {
                                                $video = '';
                                            }

                                            if (isset($video['type']) && isset($video['url'])) {
                                                $video_thumbnail_url = kopa_get_video_thumbnails_url($video['type'], $video['url']);
                                                echo '<img src="' . esc_url($video_thumbnail_url) . '" alt="' . get_the_title() . '">';
                                                $kopa_has_printed_thumbnail = true;
                                            }
                                        } elseif ('gallery' == get_post_format()) {
                                            $gallery_ids = kopa_content_get_gallery_attachment_ids(get_the_content());

                                            if (!empty($gallery_ids)) {
                                                foreach ($gallery_ids as $id) {
                                                    if (wp_attachment_is_image($id)) {
                                                        echo wp_get_attachment_image($id, 'kopa-image-size-1'); // 247 x 146
                                                        $kopa_has_printed_thumbnail = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        } // endif has_post_thumbnail
                                        ?>

                                                    <?php if ($kopa_has_printed_thumbnail) { ?>
                                                        <a href="<?php the_permalink(); ?>"><?php echo KopaIcon::getIcon('exit'); ?></a>
                                                    <?php } // endif ?>
                                                </div>
                                                <div class="entry-content">
                                                    <header class="clearfix">                                               
                                                        <span class="entry-date"><?php the_time(get_option('date_format')); ?></span>
                            <?php
                            $post_rating = round(get_post_meta(get_the_ID(), 'kopa_editor_user_total_all_rating_' . kopa_get_domain(), true));

                            if (!empty($post_rating)) {
                                ?>
                                                            <ul class="kopa-rating clearfix">
                                                            <?php
                                                            for ($i = 0; $i < $post_rating; $i++) {
                                                                echo '<li>' . KopaIcon::getIcon('star', 'span') . '</li>';
                                                            }
                                                            for ($i = 0; $i < 5 - $post_rating; $i++) {
                                                                echo '<li>' . KopaIcon::getIcon('star2', 'span') . '</li>';
                                                            }
                                                            ?>
                                                            </ul>
                                                            <?php } ?>
                                                    </header>
                                                    <h4 class="entry-title clearfix"><?php echo KopaIcon::getIcon($kopa_data_icon, 'span'); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                </div><!--entry-content-->
                                            </article><!--entry-item-->
                                        </li>
                        <?php } // endwhile  ?>
                                </ul>
                                <div class="clearfix"></div>
                                <div id="single_related_posts_pager" class="pager"></div>
                            </div> <!-- list-carousel -->                            
                        </div>
                        <?php
                    } // endif
                    wp_reset_postdata();
                }
            }
        }
    }
}

function kopa_get_socials_link() {

    $display_facebook_sharing_button = kopa_get_option('kopa_theme_options_post_sharing_button_facebook');
    $display_twitter_sharing_button = kopa_get_option('kopa_theme_options_post_sharing_button_twitter');
    $display_google_sharing_button = kopa_get_option('kopa_theme_options_post_sharing_button_google');
    $display_linkedin_sharing_button = kopa_get_option('kopa_theme_options_post_sharing_button_linkedin');
    $display_pinterest_sharing_button = kopa_get_option('kopa_theme_options_post_sharing_button_pinterest');
    $display_email_sharing_button = kopa_get_option('kopa_theme_options_post_sharing_button_email');

    if ($display_facebook_sharing_button == 'show' ||
            $display_twitter_sharing_button == 'show' ||
            $display_google_sharing_button == 'show' ||
            $display_linkedin_sharing_button == 'show' ||
            $display_pinterest_sharing_button == 'show' ||
            $display_email_sharing_button == 'show') :

        $title = htmlspecialchars(get_the_title());
        $email_subject = htmlspecialchars(get_bloginfo('name')) . ': ' . $title;
        $email_body = __('I recommend this page: ', kopa_get_domain()) . $title . __('. You can read it on: ', kopa_get_domain()) . get_permalink();

        if (has_post_thumbnail()) {
            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $thumbnail = wp_get_attachment_image_src($post_thumbnail_id);
        }
        ?>
        <ul class="social-link clearfix">
            <li><?php _e('Share this Post', kopa_get_domain()); ?>:</li>

        <?php if ($display_facebook_sharing_button == 'show') : ?>
                <li><a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_permalink()); ?>" title="Facebook" target="_blank"><?php echo KopaIcon::getIcon('facebook'); ?></a></li>
        <?php endif; ?>

            <?php if ($display_twitter_sharing_button == 'show') : ?>
                <li><a href="http://twitter.com/home?status=<?php echo get_the_title() . ':+' . urlencode(get_permalink()); ?>" title="Twitter" target="_blank"><?php echo KopaIcon::getIcon('twitter'); ?></a></li>
            <?php endif; ?>

            <?php if ($display_google_sharing_button == 'show') : ?>
                <li><a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" title="Google" target="_blank"><?php echo KopaIcon::getIcon('google-plus'); ?></a></li>
            <?php endif; ?>

            <?php if ($display_linkedin_sharing_button == 'show') : ?>
                <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>&amp;source=<?php echo urlencode(get_bloginfo('name')); ?>" title="Linkedin" target="_blank"><?php echo KopaIcon::getIcon('linkedin'); ?></a></li>
            <?php endif; ?>

            <?php if ($display_pinterest_sharing_button == 'show') : ?>
                <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo isset($thumbnail[0]) ? urlencode($thumbnail[0]) : ''; ?>&amp;description=<?php the_title(); ?>" title="Pinterest" target="_blank"><?php echo KopaIcon::getIcon('pinterest'); ?></a></li>
            <?php endif; ?>

            <?php if ($display_email_sharing_button == 'show') : ?>
                <li><a href="mailto:?subject=<?php echo rawurlencode($email_subject); ?>&amp;body=<?php echo rawurlencode($email_body); ?>" title="Email" target="_self"><?php echo KopaIcon::getIcon('email'); ?></a></li>
            <?php endif; ?>

        </ul>
            <?php
        endif;
    }

    function kopa_get_about_author() {
        if ('show' == kopa_get_option('kopa_theme_options_post_about_author')) {
            global $post;
            $user_id = $post->post_author;
            $description = get_the_author_meta('description', $user_id);
            $email = get_the_author_meta('user_email', $user_id);
            $name = get_the_author_meta('display_name', $user_id);
            $link = trim(get_the_author_meta('user_url', $user_id));
            ?>

        <div class="about-author clearfix">
            <a class="avatar-thumb" href="<?php echo $link; ?>"><?php echo get_avatar($email, 90); ?></a>                                            
            <div class="author-content">
                <header class="clearfix">
                    <h4><?php _e('Posted by:', kopa_get_domain()); ?></h4>                    
                    <a class="author-name" href="<?php echo $link; ?>"><?php echo $name; ?></a>
        <?php
        $social_links['facebook'] = get_user_meta($user_id, 'facebook', true);
        $social_links['twitter'] = get_user_meta($user_id, 'twitter', true);
        $social_links['google-plus'] = get_user_meta($user_id, 'google-plus', true);

        if ($social_links['facebook'] || $social_links['twitter'] || $social_links['google-plus']):
            ?>                  
                        <ul class="clearfix social-link">                      
                            <li><?php _e('Follow:', kopa_get_domain()); ?></li>

                        <?php if ($social_links['facebook']): ?>
                                <li class="facebook-icon"><a target="_blank" title="<?php _e('Facebook', kopa_get_domain()); ?>" href="<?php echo $social_links['facebook']; ?>"><?php echo KopaIcon::getIcon('facebook'); ?></a></li>
            <?php endif; ?>

                            <?php if ($social_links['twitter']): ?>
                                <li class="twitter-icon"><a target="_blank" title="<?php _e('Twitter', kopa_get_domain()); ?>" class="twitter" href="<?php echo $social_links['twitter']; ?>"><?php echo KopaIcon::getIcon('twitter'); ?></a></li>
                            <?php endif; ?>

                            <?php if ($social_links['google-plus']): ?>
                                <li class="gplus-icon"><a target="_blank" title="<?php _e('Google+', kopa_get_domain()); ?>" class="twitter" href="<?php echo $social_links['google-plus']; ?>"><?php echo KopaIcon::getIcon('google-plus'); ?></a></li>
                            <?php endif; ?>                            

                        </ul><!--social-link-->
                        <?php endif; ?>
                </header>
                <div><?php echo $description; ?></div>
            </div><!--author-content-->
        </div><!--about-author-->
                    <?php
                }
            }

            function kopa_edit_user_profile($user) {
                ?>   
    <table class="form-table">
        <tr>
            <th><label for="facebook"><?php _e('Facebook', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="facebook" id="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Facebook URL', kopa_get_domain()); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php _e('Twitter', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="twitter" id="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Twitter URL', kopa_get_domain()); ?></span>
            </td>
        </tr>  
        <tr>
            <th><label for="feedurl"><?php _e('Feed URL', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="feedurl" id="feedurl" value="<?php echo esc_attr(get_the_author_meta('feedurl', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Feed URL', kopa_get_domain()); ?></span>
            </td>
        </tr>      
        <tr>
            <th><label for="google-plus"><?php _e('Google Plus', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="google-plus" id="google-plus" value="<?php echo esc_attr(get_the_author_meta('google-plus', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Google Plus URL', kopa_get_domain()); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="flickr"><?php _e('Flickr', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="flickr" id="flickr" value="<?php echo esc_attr(get_the_author_meta('flickr', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter your Flickr URL', kopa_get_domain()); ?></span>
            </td>
        </tr>
    </table>
    <?php
}

function kopa_edit_user_profile_update($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    update_user_meta($user_id, 'facebook', $_POST['facebook']);
    update_user_meta($user_id, 'twitter', $_POST['twitter']);
    update_user_meta($user_id, 'feedurl', $_POST['feedurl']);
    update_user_meta($user_id, 'google-plus', $_POST['google-plus']);
    update_user_meta($user_id, 'flickr', $_POST['flickr']);
}

function kopa_get_the_excerpt($excerpt) {
    if (is_main_query()) {
        if (is_search()) {
            $keys = implode('|', explode(' ', get_search_query()));
            return preg_replace('/(' . $keys . ')/iu', '<span class="kopa-search-keyword">\0</span>', $excerpt);
        } else {
            return $excerpt;
        }
    }
}

function kopa_get_template_setting() {
    $kopa_setting = get_option('kopa_setting',  unserialize(KOPA_DEFAULT_SETTING));
    $setting = array();

    if (is_home()) {
        $setting = $kopa_setting['home'];
    } else if (is_archive()) {
        if (is_category() || is_tag()) {
            $setting = get_option("kopa_category_setting_" . get_queried_object_id(), $kopa_setting['taxonomy']);
        } else {
            $setting = get_option("kopa_category_setting_" . get_queried_object_id(), $kopa_setting['archive']);
        }
    } else if (is_singular()) {
        if (is_singular('post')) {
            $setting = get_option("kopa_post_setting_" . get_queried_object_id(), $kopa_setting['post']);
        } else if (is_page()) {

            $setting = get_option("kopa_page_setting_" . get_queried_object_id());
            if (!$setting) {
                if (is_front_page()) {
                    $setting = $kopa_setting['home'];
                } else {
                    $setting = $kopa_setting['page'];
                }
            }
        } else {
            $setting = $kopa_setting['post'];
        }
    } else if (is_404()) {
        $setting = $kopa_setting['_404'];
    } else if (is_search()) {
        $setting = $kopa_setting['search'];
    }

    return $setting;
}

function kopa_content_get_gallery($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('gallery'));
}

function kopa_content_get_video($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('vimeo', 'youtube'));
}

function kopa_content_get_audio($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function kopa_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $media;
}

function kopa_get_client_IP() {
    $IP = NULL;

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check if IP is from shared Internet
        $IP = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //check if IP is passed from proxy
        $ip_array = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
        $IP = trim($ip_array[count($ip_array) - 1]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        //standard IP check
        $IP = $_SERVER['REMOTE_ADDR'];
    }
    return $IP;
}

function kopa_get_post_meta($pid, $key = '', $single = false, $type = 'String', $default = '') {
    $data = get_post_meta($pid, $key, $single);
    switch ($type) {
        case 'Int':
            $data = (int) $data;
            return ($data >= 0) ? $data : $default;
            break;
        default:
            return ($data) ? $data : $default;
            break;
    }
}

function kopa_get_like_permission($pid) {
    $permission = 'disable';

    $key = 'kopa_' . kopa_get_domain() . '_like_by_' . kopa_get_client_IP();
    $is_voted = kopa_get_post_meta($pid, $key, true, 'Int');

    if (!$is_voted)
        $permission = 'enable';

    return $permission;
}

function kopa_get_like_count($pid) {
    $key = 'kopa_' . kopa_get_domain() . '_total_like';
    return kopa_get_post_meta($pid, $key, true, 'Int');
}

function kopa_total_post_count_by_month($month, $year) {
    $args = array(
        'monthnum' => (int) $month,
        'year' => (int) $year,
    );
    $the_query = new WP_Query($args);
    return $the_query->post_count;
    ;
}

function kopa_head() {
    $logo_margin_top = kopa_get_option('kopa_theme_options_logo_margin_top');
    $logo_margin_left = kopa_get_option('kopa_theme_options_logo_margin_left');
    $logo_margin_right = kopa_get_option('kopa_theme_options_logo_margin_right');
    $logo_margin_bottom = kopa_get_option('kopa_theme_options_logo_margin_bottom');




    echo "<style>
        #logo-image{
            margin-top:{$logo_margin_top}px;
            margin-left:{$logo_margin_left}px;
            margin-right:{$logo_margin_right}px;
            margin-bottom:{$logo_margin_bottom}px;
        } 
    </style>";

  
    /* ==================================================================================================
     * Custom CSS
     * ================================================================================================= */
    $kopa_theme_options_custom_css = htmlspecialchars_decode(stripslashes(kopa_get_option('kopa_theme_options_custom_css')));
    if ($kopa_theme_options_custom_css)
        echo "<style>{$kopa_theme_options_custom_css}</style>";

    /* ==================================================================================================
     * IE8 Fix CSS3
     * ================================================================================================= */
    echo "<style>
        .home-slider .entry-item .entry-thumb a,
        .search-box .search-form .search-text,
        .search-box .search-form .search-submit,
        .home-slider .flex-direction-nav a,
        .kopa-carousel-widget .list-carousel ul li .entry-thumb a, 
        .kopa-article-list-widget .tab-container-1 .entry-thumb a, 
        .kopa-related-post .list-carousel ul li .entry-thumb a,
        .kopa-social-widget ul li a,
        .kopa-popular-post-widget .entry-item .entry-thumb a,
        .play-icon,
        #pf-items .element .entry-thumb a,
        .kopa-social-static-widget ul li .social-icon,
        .entry-list li .entry-item .entry-thumb a,
        .kopa-carousel-widget .pager a, .kopa-related-post .pager a {
            behavior: url(" . get_template_directory_uri() . "/js/PIE.htc);
        }
    </style>";
}

/* ==============================================================================
 * Mobile Menu
  ============================================================================= */

class kopa_mobile_menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if ($depth == 0)
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' clearfix"' : 'class="clearfix"';
        else
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : 'class=""';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        if ($depth == 0) {
            $item_output = $args->before;
            $item_output .= '<h3><a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a></h3>';
            $item_output .= $args->after;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "\n$indent<span>+</span><div class='clear'></div><div class='menu-panel clearfix'><ul>";
        } else {
            $output .= '<ul>'; // indent for level 2, 3 ...
        }
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= '</ul>';
        }
    }

}

function kopa_add_icon_home_menu($items, $args) {

    if ('hide' == kopa_get_option('kopa_theme_options_home_menu_item_status')) {
        return $items;
    }

    if ($args->theme_location == 'main-nav') {
        if ($args->menu_id == 'toggle-view-menu') {
            $homelink = '<li class="clearfix"><h3><a href="' . esc_url(home_url( '/' )) . '">' . __('Home', kopa_get_domain()) . '</a></h3></li>';
            $items = $homelink . $items;
        } else if ($args->menu_id == 'main-menu') {
            $homelink = '<li class="menu-home-icon' . ( is_front_page() ? ' current-menu-item' : '') . '"><a href="' . esc_url(home_url( '/' )) . '">' . __('Home', kopa_get_domain()) . '</a><span></span></li>';
            $items = $homelink . $items;
        }
    }
    return $items;
}

function kopa_custom_excerpt_length($length) {
    $kopa_setting = kopa_get_template_setting();

    if ('home' == $kopa_setting['layout_id']) {
        return 25;
    }

    return $length;
}

function kopa_custom_excerpt_more($more) {
    return '...';
}

/**
 * Convert Hex Color to RGB using PHP
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
 */
function kopa_hex2rgba($hex, $alpha = false) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    if ($alpha) {
        return array($r, $g, $b, $alpha);
    }

    return array($r, $g, $b);
}

/**
 * Get gallery string ids after getting matched gallery array
 * @return array of attachment ids in gallery
 * @return empty if no gallery were found
 */
function kopa_content_get_gallery_attachment_ids($content) {
    $gallery = kopa_content_get_gallery($content);

    if (isset($gallery[0])) {
        $gallery = $gallery[0];
    } else {
        return '';
    }

    if (isset($gallery['shortcode'])) {
        $shortcode = $gallery['shortcode'];
    } else {
        return '';
    }

    // get gallery string ids
    preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
    if (isset($gallery_string_ids[0][0])) {
        $gallery_string_ids = $gallery_string_ids[0][0];
    } else {
        return '';
    }

    // get array of image id
    preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
    if (isset($gallery_ids[0])) {
        $gallery_ids = $gallery_ids[0];
    } else {
        return '';
    }

    return $gallery_ids;
}

/**
 * Color darken or lighten function
 * @author clearpixel
 * @link http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/
 * @since FastNews 1.0
 */
function kopa_color_brightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

/**
 * Template Tag: Facebook Comments Plugin
 */

add_filter('kopa_icon_get_icon', 'forceful_kopa_icon_get_icon', 10, 3);

function forceful_kopa_icon_get_icon($html, $icon_class, $icon_tag) {
    $classes = '';
    switch ($icon_class) {
        case 'facebook':
            $classes = 'fa fa-facebook';
            break;
        case 'facebook2':
            $classes = 'fa fa-facebook-square';
            break;
        case 'twitter':
            $classes = 'fa fa-twitter';
            break;
        case 'twitter2':
            $classes = 'fa fa-twitter-square';
            break;
        case 'google-plus':
            $classes = 'fa fa-google-plus';
            break;
        case 'google-plus2':
            $classes = 'fa fa-google-plus-square';
            break;
        case 'youtube':
            $classes = 'fa fa-youtube';
            break;
        case 'dribbble':
            $classes = 'fa fa-dribbble';
            break;
        case 'flickr':
            $classes = 'fa fa-flickr';
            break;
        case 'rss':
            $classes = 'fa fa-rss';
            break;
        case 'linkedin':
            $classes = 'fa fa-linkedin';
            break;
        case 'pinterest':
            $classes = 'fa fa-pinterest';
            break;
        case 'email':
            $classes = 'fa fa-envelope';
            break;
        case 'pencil':
            $classes = 'fa fa-pencil';
            break;
        case 'date':
            $classes = 'fa fa-clock-o';
            break;
        case 'comment':
            $classes = 'fa fa-comment';
            break;
        case 'view':
            $classes = 'fa fa-eye';
            break;
        case 'link':
            $classes = 'fa fa-link';
            break;
        case 'film':
            $classes = 'fa fa-film';
            break;
        case 'images':
            $classes = 'fa fa-picture-o';
            break;
        case 'music':
            $classes = 'fa fa-music';
            break;
        case 'long-arrow-right':
            $classes = 'fa fa-long-arrow-right';
            break;
        case 'apple':
            $classes = 'fa fa-apple';
            break;
        case 'star':
            $classes = 'fa fa-star';
            break;
        case 'star2':
            $classes = 'fa fa-star-o';
            break;
        case 'exit':
            $classes = 'fa fa-sign-out';
            break;
        case 'folder':
            $classes = 'fa fa-folder';
            break;
        case 'video':
            $classes = 'fa fa-video-camera';
            break;
        case 'play':
            $classes = 'fa fa-play';
            break;
        case 'spinner':
            $classes = 'fa fa-spinner';
            break;
        case 'bug':
            $classes = 'fa fa-bug';
            break;
        case 'tint':
            $classes = 'fa fa-tint';
            break;
        case 'pause':
            $classes = 'fa fa-pause';
            break;
        case 'crosshairs':
            $classes = 'fa fa-crosshairs';
            break;
        case 'cog':
            $classes = 'fa fa-cog';
            break;
        case 'check-circle':
            $classes = 'fa fa-check-circle-o';
            break;
        case 'hand-right':
            $classes = 'fa fa-hand-o-right';
            break;
        case 'plus-square':
            $classes = 'fa fa-plus-square';
            break;
        case 'trash':
            $classes = 'fa fa-trash-o';
            break;
        case 'arrow-circle-up':
            $classes = 'fa fa-arrow-circle-up';
            break;
    }
    return KopaIcon::createHtml($classes, $icon_tag);
}


/*
 * default title
 */
add_filter('the_title','kopa_get_the_title');
//add_filter('get_the_title', 'kopa_get_the_title');
function kopa_get_the_title($title){
    if($title == ''){
        $title = __('(no title)',kopa_get_domain());
    }
    return $title;
}