<?php

if (!function_exists('save_general_setting')) {

    function save_general_setting() {
        if (!wp_verify_nonce($_POST['wpnonce_save_theme_options'], 'save_general_setting'))
            exit();
        $data = $_POST;
        foreach ($data as $key => $value) {
            if (strpos($key, 'kopa_theme_options_') === 0) {
                update_option($key, $value);
            }
        }
        exit();
    }

    add_action('wp_ajax_save_general_setting', 'save_general_setting');
}
/* ==============================================================================
 * Remove Sidebar
  =============================================================================== */
if (!function_exists('kopa_remove_sidebar')) {

    function kopa_remove_sidebar() {
        
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_sidebar_setting'))
            exit();
        
        if (!empty($_POST['removed_sidebar_id'])) {
            $removed_sidebar_id = ($_POST['removed_sidebar_id']);
            if ($removed_sidebar_id === 'sidebar_hide') {
                echo json_encode(array("is_exist" => true, "error_message" => "You can not remove this sidebar!"));
            } else {
                $kopa_sidebar = get_option("kopa_sidebar",  unserialize(KOPA_DEFAULT_SIDEBAR));
                $found_sidebar = false;
                foreach ($kopa_sidebar as $e_sidebar_id => $e_sidebar_name) {
                    if ($removed_sidebar_id == $e_sidebar_id) {
                        $found_sidebar = true;
                    }
                } 
                if ($found_sidebar) {
                    $kopa_setting = get_option('kopa_setting', unserialize(KOPA_DEFAULT_SETTING));
                    $found_setting = false;
                    foreach ($kopa_setting as $kopa_setting_key => $kopa_setting_value) {
                        foreach ($kopa_setting_value['sidebars'] as $key => $value) {
                            if ($removed_sidebar_id == $value) {
                                $found_setting = true;
                                $layout_id = $kopa_setting_key;
                            }
                        }
                    }
                    if ($found_setting) {
                        $kopa_template_hierarchy = unserialize(KOPA_TEMPLATE_HIERARCHY);
                        echo json_encode(array("is_exist" => true, "error_message" => "You can not remove this sidebar. It is in used for " . $kopa_template_hierarchy[$layout_id]['title'] . ' page'));
                    } else {
                        unset($kopa_sidebar[$removed_sidebar_id]);
                        update_option("kopa_sidebar", $kopa_sidebar);
                        echo json_encode(array("is_exist" => false, "error_message" => "successfull"));
                    }
                }
            }
        }
        exit();
    }

    add_action('wp_ajax_kopa_remove_sidebar', 'kopa_remove_sidebar');
}
////////////////////////////////////////////////////////
if (!function_exists('kopa_add_sidebar')) {

    function kopa_add_sidebar() {
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_sidebar_setting'))
            exit();
        if (!empty($_POST['new_sidebar_name'])) {
            $kopa_sidebar_name = ($_POST['new_sidebar_name']);
            $kopa_sidebar = get_option("kopa_sidebar", unserialize(KOPA_DEFAULT_SIDEBAR));
            $sidebar_id = strtolower(trim(str_replace(" ", "_", $kopa_sidebar_name)));
            $found_sidebar = false;
            foreach ($kopa_sidebar as $e_sidebar_id => $e_sidebar_name) {
                if ($sidebar_id === $e_sidebar_id) {
                    $found_sidebar = true;
                }
            }
            if ($found_sidebar) {
                $error_message = 'The sidebar name "' . $kopa_sidebar_name . '" already exist!';
                echo json_encode(array("is_exist" => true, "error_message" => $error_message, "sidebar_id" => $sidebar_id));
            } else {
                echo json_encode(array("is_exist" => false, "error_message" => "", "sidebar_id" => $sidebar_id));
                $kopa_sidebar[$sidebar_id] = $kopa_sidebar_name;
                update_option("kopa_sidebar", $kopa_sidebar);
            }
        }
        exit();
    }

    add_action('wp_ajax_kopa_add_sidebar', 'kopa_add_sidebar');
}
////////////////////////////////////////////////////////
if (!function_exists('save_sidebar_setting')) {

    function save_sidebar_setting() {
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_sidebar_setting'))
            exit();
        if (!empty($_POST[kopa_sidebar])) {
            $kopa_sidebar_name_arr = ($_POST[kopa_sidebar]);
            $kopa_sidebar_existing = get_option("kopa_sidebar",  unserialize(KOPA_DEFAULT_SIDEBAR));

            foreach ($kopa_sidebar_name_arr as $key => $value) {
                $sidebar_id = trim(str_replace(" ", "_", $value)) . $key;
                if (in_array($sidebar_id, $kopa_sidebar_existing)) {
                    $sidebar_id = $sidebar_id . 'kopa';
                }
                $kopa_sidebar[$sidebar_id] = $value;
            }
            update_option("kopa_sidebar", $kopa_sidebar);
        }
        exit();
    }

    add_action('wp_ajax_save_sidebar_setting', 'save_sidebar_setting');
}
////////////////////////////////////////////////////////
if (!function_exists('save_layout')) {

    function save_layout() {
        $kopa_setting = get_option('kopa_setting',  unserialize(KOPA_DEFAULT_SETTING));
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_layout_setting'))
            exit();
        if (!empty($_POST)) {
            $new_kopa_setting = $_POST['kopa_setting'];
            $template_id = $_POST['template_id'];

            $kopa_setting[$template_id] = $new_kopa_setting[0];
            update_option("kopa_setting", $kopa_setting);
        }
        exit();
    }

    add_action('wp_ajax_save_layout', 'save_layout');
}

if (!function_exists('load_layout')) {

    function load_layout() {
        if (!wp_verify_nonce($_POST['wpnonce'], 'load_layout_setting'))
            exit();
        if (!empty($_POST)) {
            echo kopa_layout_page($_POST['kopa_template_id']);
        }
        exit();
    }

    add_action('wp_ajax_load_layout', 'load_layout');
}

function kopa_layout_page($_kopa_template_id) {
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_template_hierarchy = unserialize(KOPA_TEMPLATE_HIERARCHY);
    $kopa_sidebar_position = unserialize(KOPA_SIDEBAR_POSITION);
    $kopa_setting = get_option('kopa_setting',  unserialize(KOPA_DEFAULT_SETTING));
    $kopa_sidebar = get_option('kopa_sidebar', unserialize(KOPA_DEFAULT_SIDEBAR));
    wp_nonce_field("load_layout_setting", "nonce_id");
    wp_nonce_field("save_layout_setting", "nonce_id_save");
    ?>
    <div id="kopa-admin-wrapper" class="clearfix">
        <div id="kopa-loading-gif"></div>
        <input type="hidden" id="kopa_template_id" value="<?php echo $_kopa_template_id; ?>">
        <?php
        if ($kopa_template_hierarchy) {
            echo '<div class="kopa-nav list-container">
                <ul class="tabs clearfix">';
            foreach ($kopa_template_hierarchy as $kopa_template_key => $kopa_template_value) {
                if ($kopa_template_key === $_kopa_template_id)
                    $_active = "class='active'";
                else {
                    $_active = '';
                }
                echo '<li ' . $_active . '><span title="' . $kopa_template_key . '" onclick="load_layout_setting(jQuery(this))">' . $kopa_template_value['title'] . '</span></li>';
            }
            echo '</ul><!--tabs--->
             </div><!--kopa-nav-->';
        }
        ?>
        <div class="kopa-content">
            <div class="kopa-page-header clearfix">
                <div class="pull-left">
                    <h4><?php echo KopaIcon::getIcon('cog'); ?>Layout And Sidebar Manager</h4>
                </div>
                <div class="pull-right">
                    <div class="kopa-copyrights">
                        <span>Visit author URL: </span><a href="http://kopatheme.com" target="_blank">http://kopatheme.com</a>
                    </div><!--="kopa-copyrights-->
                </div>
            </div><!--kopa-page-header-->
            <div class="tab-container">
                <div class="kopa-content-box tab-content kopa-content-main-box" id="<?php echo $_kopa_template_id; ?>">
                    <div class="kopa-actions clearfix">
                        <div class="kopa-button">
                            <span class="btn btn-primary" onclick="save_layout_setting(jQuery(this))"><?php echo KopaIcon::getIcon('check-circle'); ?>Save</span>
                        </div>
                    </div><!--kopa-actions-->
                    <div class="kopa-box-head">
                        <?php echo KopaIcon::getIcon('hand-right'); ?>
                        <span class="kopa-section-title"><?php echo $kopa_template_hierarchy[$_kopa_template_id]['title'] ?></span>
                    </div><!--kopa-box-head-->
                    <div class="kopa-box-body clearfix"> 
                        <div class="kopa-layout-box pull-left">
                            <div class="kopa-select-layout-box kopa-element-box">
                                <span class="kopa-component-title">Select the layout</span>
                                <select class="kopa-layout-select"  onchange="show_onchange(jQuery(this));" autocomplete="off">
                                    <?php
                                    foreach ($kopa_template_hierarchy[$_kopa_template_id]['layout'] as $keys => $value) {
                                        echo '<option value="' . $value . '"';
                                        /* foreach ($kopa_setting as $kopa_setting_key => $kopa_setting_value) {
                                          if ($kopa_setting_key == $_kopa_template_id && $kopa_setting_value[layout_id] == $value) {
                                          echo 'selected="selected"';
                                          }
                                          } */
                                        if ($value === $kopa_setting[$_kopa_template_id]['layout_id']) {
                                            echo 'selected="selected"';
                                        }
                                        echo '>' . $kopa_layout[$value]['title'] . '</option>';
                                    }
                                    ?>
                                </select>                          
                            </div><!--kopa-select-layout-box-->
                            <?php
                            foreach ($kopa_template_hierarchy[$_kopa_template_id]['layout'] as $keys => $value) {
                                foreach ($kopa_layout as $layout_key => $layout_value) {
                                    if ($layout_key == $value) {
                                        ?>
                                        <div class="<?php echo 'kopa-sidebar-box-wrapper sidebar-position-' . $layout_key; ?>">
                                            <?php
                                            foreach ($layout_value['positions'] as $postion_key => $postion_id) {
                                                ?>
                                                <div class="kopa-sidebar-box kopa-element-box">
                                                    <span class="kopa-component-title"><?php echo $kopa_sidebar_position[$postion_id]['title']; ?></span>
                                                    <label class="kopa-label">Select sidebars</label>
                                                    <?php
                                                    echo '<select class="kopa-sidebar-select" autocomplete="off">';
                                                    foreach ($kopa_sidebar as $sidebar_list_key => $sidebar_list_value) {
                                                        $__selected_sidebar = '';
                                                        if ($layout_key === $kopa_setting[$_kopa_template_id]['layout_id']) {
                                                            if ($sidebar_list_key === $kopa_setting[$_kopa_template_id]['sidebars'][$postion_key]) {
                                                                $__selected_sidebar = 'selected="selected"';
                                                            }
                                                        }
                                                        echo '<option value="' . $sidebar_list_key . '" ' . $__selected_sidebar . '>' . $sidebar_list_value . '</option>';
                                                        $__selected_sidebar = '';
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div><!--kopa-sidebar-box-->
                                            <?php } ?>
                                        </div><!--kopa-sidebar-box-wrapper-->
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div><!--kopa-layout-box-->
                        <div class="kopa-thumbnails-box pull-right">
                            <?php
                            foreach ($kopa_template_hierarchy[$_kopa_template_id]['layout'] as $thumbnails_key => $thumbnails_value) {
                                ?>
                                <image class="responsive-img <?php echo ' kopa-cpanel-thumbnails kopa-cpanel-thumbnails-' . $thumbnails_value; ?>" src="<?php echo KOPA_CPANEL_IMAGE_DIR . $kopa_layout[$thumbnails_value]['thumbnails']; ?>" class="img-polaroid" alt="">
                                <?php
                            }
                            ?>
                        </div><!--kopa-thumbnails-box-->
                    </div><!--kopa-box-body-->
                    <div class="kopa-actions kopa-bottom-action-bar clearfix">
                        <div class="kopa-button">
                            <span class="btn btn-primary" onclick="save_layout_setting(jQuery(this))"><?php echo KopaIcon::getIcon('check-circle'); ?>Save</span>
                        </div>
                    </div>

                </div><!--kopa-content-box-->
            </div><!--tab-container-->
        </div><!--kopa-content-->
    </div><!--kopa-admin-wrapper-->
    <?php
}

if (!function_exists('kopa_ajax_send_contact')) {

    function kopa_ajax_send_contact() {
        check_ajax_referer('kopa_send_contact_nicole_kidman', 'kopa_send_contact_nonce');

        foreach ($_POST as $key => $value) {
            if (ini_get('magic_quotes_gpc')) {
                $_POST[$key] = stripslashes($_POST[$key]);
            }
            $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
        }

        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        $message_body = "Name: {$name}" . PHP_EOL . "Message: {$message}";

        $to = get_bloginfo('admin_email');
        if ( isset( $_POST["subject"] ) && $_POST["subject"] != '' ) {
            $subject = "Contact Form: $name - {$_POST['subject']}";
        } else {
            $subject = "Contact Form: $name";
        }

        if ( isset( $_POST['url'] ) && $_POST['url'] != '' ) {
            $message_body .= PHP_EOL . __('Website:', kopa_get_domain()) . $_POST['url'];
        }

        $headers[] = 'From: ' . $name . ' <' . $email . '>';
        $headers[] = 'Cc: ' . $name . ' <' . $email . '>';

        $result = '<span class="failure">' . __('Oops! errors occured.', kopa_get_domain()) . '</span>';
        if (wp_mail($to, $subject, $message_body, $headers)) {
            $result = '<span class="success">' . __('Success! Your email has been sent.', kopa_get_domain()) . '</span>';
        }

        die($result);
    }

    add_action('wp_ajax_kopa_send_contact', 'kopa_ajax_send_contact');
    add_action('wp_ajax_nopriv_kopa_send_contact', 'kopa_ajax_send_contact');
}

if (!function_exists('kopa_ajax_set_view_count')) {

    function kopa_ajax_set_view_count() {
        check_ajax_referer('kopa_set_view_count', 'wpnonce');
        if (!empty($_POST['post_id'])) {
            $post_id = (int) $_POST['post_id'];
            $data['count'] = kopa_set_view_count($post_id);
            echo json_encode($data);
        }
        die();
    }

    add_action('wp_ajax_kopa_set_view_count', 'kopa_ajax_set_view_count');
    add_action('wp_ajax_nopriv_kopa_set_view_count', 'kopa_ajax_set_view_count');
}



/**
 * Ajax load more articles for quicksort widget
 */
if ( ! function_exists( 'kopa_ajax_load_quick_sort_articles' ) ) {

    add_action('wp_ajax_kopa_load_quick_sort_articles', 'kopa_ajax_load_quick_sort_articles');
    add_action('wp_ajax_nopriv_kopa_load_quick_sort_articles', 'kopa_ajax_load_quick_sort_articles');

    function kopa_ajax_load_quick_sort_articles() {
        if ( ! wp_verify_nonce($_POST['wpnonce'], 'kopa_load_quick_sort_articles')) {
            echo null;
            die();
        }

        $output = '';
        $offset = $_POST['offset'];
        $categories = $_POST['categories'];
        $categories = explode(',', $categories);
        $posts_per_page = $_POST['posts_per_page'];
        $orderby = $_POST['orderby'];
        $post__not_in = explode( ',', $_POST['post__not_in'] );

        $query_args = array(
            'category__in'   => $categories,
            'posts_per_page' => $posts_per_page,
        );

        if ( $orderby != 'random' ) {
            $query_args['offset'] = $offset;
        }

        switch ( $orderby ) {
            case 'popular':
                $query_args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
                $query_args['orderby'] = 'meta_value_num';
                break;
            case 'most_comment':
                $query_args['orderby'] = 'comment_count';
                break;
            case 'random':
                $query_args['orderby'] = 'rand';
                $query_args['post__not_in'] = $post__not_in;
                break;
            default:
                $query_args['orderby'] = 'date';
                break;
        }

        $posts = new WP_Query( $query_args );

        if ( $posts->have_posts() ) {
            while ( $posts->have_posts() ) {
                $posts->the_post();

                array_push( $post__not_in, get_the_ID() );

                $post_terms = get_the_terms( get_the_ID(), 'category' );
                $data_category = array();
                $has_printed_thumbnail = false;

                if ( 'video' == get_post_format() ) {
                    $data_icon = 'video'; // icon-film-2
                } elseif ( 'gallery' == get_post_format() ) {
                    $data_icon = 'images'; // icon-images
                } elseif ( 'audio' == get_post_format() ) {
                    $data_icon = 'music'; // icon-music
                } else {
                    $data_icon = 'pencil'; // icon-pencil
                }

                foreach ( $post_terms as $post_term ) {
                    if ( in_array( $post_term->term_id, $categories )  ) {
                        array_push( $data_category , $post_term->slug );
                    }
                }

                if ( ! empty( $data_category )  ) {
                    $data_category = implode( ' ', $data_category );
                } else {
                    $data_category = '';
                }

                $output .= '<article class="element '.$data_category.'" data-category="'.$data_category.'">';
                $output .= '<div class=top-line>';
                $output .= '</div><div class=entry-thumb>';
                
                if ( has_post_thumbnail() ) {
                    $output .= wp_get_attachment_image( get_post_thumbnail_id(), 'kopa-image-size-6' ); // 496 x 346
                    $has_printed_thumbnail = true;
                } elseif ( 'video' == get_post_format() ) {
                    $video = kopa_content_get_video( get_the_content() );

                    if ( isset( $video[0] ) ) {
                        $video = $video[0];
                    } else {
                        $video = '';
                    }

                    if ( isset( $video['type'] ) && isset( $video['url'] ) ) {
                        $video_thumbnail_url = kopa_get_video_thumbnails_url( $video['type'], $video['url'] );
                        $output .= '<img src="'.esc_url( $video_thumbnail_url ).'" alt="'.get_the_title().'">';

                        $has_printed_thumbnail = true;
                    }
                } elseif ( 'gallery' == get_post_format() ) {
                    $gallery_ids = kopa_content_get_gallery_attachment_ids( get_the_content() );

                    if ( ! empty( $gallery_ids ) ) {
                        foreach ( $gallery_ids as $id ) {
                            if ( wp_attachment_is_image( $id ) ) {
                                $output .= wp_get_attachment_image( $id, 'kopa-image-size-6' ); // 496 x 346
                                $has_printed_thumbnail = true;
                                break;
                            }
                        }
                    }
                } // endif has_post_thumbnail

                if ( $has_printed_thumbnail ) {
                    $output .= '<a href="'.get_permalink().'">'.KopaIcon::getIcon('long-arrow-right').'</a>';
                }

                $output .= '</div>';

                $output .= '<div class=entry-content><header>';
                $output .= '<h4 class="entry-title clearfix">'.KopaIcon::getIcon($data_icon, 'span').'<a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
                $output .= '<div class="meta-box">';
                $output .= '<span class="entry-date">'.get_the_time( get_option( 'date_format' ) ).'</span> ';
                $output .= '<span class="entry entry-author">'.__( 'By', kopa_get_domain() ).' <a href="'.get_author_posts_url( get_the_author_meta('ID') ).'" title="'.__('Posts by', kopa_get_domain()).' '.get_the_author().'" rel="author">'.get_the_author().'</a></span>';
                $output .= '</div></header>';

                $output .= '<p>'.get_the_excerpt().'</p>';
                $output .= '<footer class=clearfix>';
                $output .= '<div class=meta-box>';
                $output .= '<span class=entry-comments>'.KopaIcon::getIcon('comment', 'span');
                if ( comments_open() ) {
                    $output .= '<a href="'.get_comments_link().'" title="'.__('Comment on').' '. get_the_title().'">'.get_comments_number().'</a>';
                } else {
                    $output .= '<span>' . __('Off', kopa_get_domain()) . '</span>';
                }
                $output .= '</span> ';

                if ( 'show' == get_option('kopa_theme_options_view_count_status', 'show') && true == get_post_meta( get_the_ID(), 'kopa_' . kopa_get_domain() . '_total_view', true ) ) {
                    $output .= '<span class=entry-view>'.KopaIcon::getIcon('view', 'span').get_post_meta( get_the_ID(), 'kopa_' . kopa_get_domain() . '_total_view', true ).'</span>';
                }
                $output .= '</div> <!-- .meta-box -->';

                $post_rating = round( get_post_meta( get_the_ID(), 'kopa_editor_user_total_all_rating_' . kopa_get_domain(), true ) );
                if ( ! empty( $post_rating ) ) {
                    $output .= '<ul class="kopa-rating clearfix">';
                    for ( $i = 0; $i < $post_rating; $i++ ) {
                        $output .= '<li>'.KopaIcon::getIcon('star', 'span').'</li>';
                    }
                    for ( $i = 0; $i < 5 - $post_rating; $i++ ) {
                        $output .= '<li>'.KopaIcon::getIcon('star2', 'span').'</li>';
                    }
                    $output .= '</ul>';
                }

                $output .= '</footer>';
                $output .= '</div> <!-- entry-content -->';
                $output .= '<div class=bottom-line></div>';
                $output .= '</article>';
            }

            wp_reset_postdata();
        } else {
            echo null;
            die();
        }

        $responses_data = array(
            'output'       => $output,
            'post__not_in' => implode(',', $post__not_in),
        );

        echo json_encode( $responses_data );
        die();
    }

}