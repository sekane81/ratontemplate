<?php

add_action('after_setup_theme', 'kopa_after_setup_theme');

function kopa_after_setup_theme() {
   
    load_theme_textdomain(kopa_get_domain(), get_template_directory() . '/languages');
    add_action('admin_menu', 'kopa_admin_menu');
    
    add_action('init', 'kopa_add_exceprt_page');
    
    
    require trailingslashit(get_template_directory()) . '/library/includes/widgets.php';
    require trailingslashit(get_template_directory()) . '/library/icon.class.php';
    add_filter('get_avatar', 'kopa_get_avatar');
}
function kopa_add_exceprt_page() {
	add_post_type_support( 'page', 'excerpt' );
}
function kopa_admin_menu() {
    
    //General Setting Page
    $page_kopa_cpanel_theme_options = add_theme_page(
            __('Theme Options', kopa_get_domain()), __('Theme Options', kopa_get_domain()), 'edit_theme_options', 'kopa_cpanel_theme_options', 'kopa_cpanel_theme_options'
    );

    //call register settings function
    add_action( 'admin_init', 'kopa_register_settings' );

    add_action('admin_print_scripts-' . $page_kopa_cpanel_theme_options, 'kopa_admin_print_scripts');
    add_action('admin_print_styles-' . $page_kopa_cpanel_theme_options, 'kopa_admin_print_styles');

}
function kopa_get_options_args() {
    //register our settings
    return array(
        /* General */
        array(
            'id'       => 'kopa_theme_options_logo_margin_top', // option name
            'type' => 'number' //  A callback function that sanitizes the option's value.
        ),
        array(
            'id'       => 'kopa_theme_options_logo_margin_left',
            'type' => 'number'
        ),
        array(
            'id'       => 'kopa_theme_options_logo_margin_right',
            'type' => 'number'
        ),
        array(
            'id'       => 'kopa_theme_options_logo_margin_bottom',
            'type' => 'number'
        ),
        
        array(
            'id'       => 'kopa_theme_options_favicon_url',
            'type' => 'upload'
        ),
        array(
            'id'       => 'kopa_theme_options_apple_iphone_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'       => 'kopa_theme_options_apple_iphone_retina_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'       => 'kopa_theme_options_apple_ipad_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'       => 'kopa_theme_options_apple_ipad_retina_icon_url',
            'type' => 'upload'
        ),
        array(
            'id'       => 'kopa_theme_options_responsive_status',
            'type' => 'radio',
            'std'  => 'enable'
        ),
        array(
            'id'       => 'kopa_theme_options_display_headline_status',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'       => 'kopa_theme_options_headline_title',
            'type' => 'text',
            'std'  => sprintf( __( 'BREAKING', kopa_get_domain() ) )
        ),
        array(
            'id'       => 'kopa_theme_options_headline_light_title',
            'type' => 'text',
            'std'  => sprintf( __( 'News', kopa_get_domain() ) )
        ),
        array(
            'id'       => 'kopa_theme_options_headline_category_id',
            'type' => 'select',
            
        ),
        array(
            'id'       => 'kopa_theme_options_headline_posts_number',
            'type' => 'number',
            'std'  => 10
        ),
        array(
            'id'       => 'kopa_theme_options_breadcrumb_status',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'       => 'kopa_theme_options_home_menu_item_status',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'       => 'kopa_theme_options_top_banner_code',
            'type' => 'textarea'
        ),
        array(
            'id'       => 'kopa_theme_options_copyright',
            'type' => 'textarea',
            'std'  => sprintf( __( 'Copyrights. &copy; %s by KOPASOFT', kopa_get_domain() ), date( 'Y' ) )
        ),

        /* Post */
       
        array(
            'id'   => 'kopa_theme_options_featured_image_status',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'   => 'kopa_theme_options_post_thumbnail_style',
            'type' => 'radio',
            'std'  => 'small'
        ),
        array(
            'id'       => 'kopa_theme_options_view_count_status',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'       => 'kopa_theme_options_post_about_author',
            'type' => 'radio',
            'std'  => 'show'
        ),
        array(
            'id'       => 'kopa_theme_options_post_related_get_by',
            'type' => 'select',
            'std'  => 'hide'
        ),
        array(
            'id'       => 'kopa_theme_options_post_related_limit',
            'type' => 'abs_number',
            'std'  => 3
        ),

        /* Social Link */
        array(
            'id'  =>  'kopa_theme_options_social_link_target',
            'type'=> 'radio',
            'std' => '_blank'
        ),
        array(
            'id'       => 'kopa_theme_options_social_links_rss_url',
            'type' => 'esc_url'
        ),
        array(
            'id'       => 'kopa_theme_options_social_links_facebook_url',
            'type' => 'esc_url'
        ),
        array(
            'id'       => 'kopa_theme_options_social_links_twitter_url',
            'type' => 'esc_url'
        ),
        array(
            'id'       => 'kopa_theme_options_social_links_gplus_url',
            'type' => 'esc_url'
        ),
        array(
            'id'       => 'kopa_theme_options_social_links_dribbble_url',
            'type' => 'esc_url'
        ),
        array(
            'id'       => 'kopa_theme_options_social_links_flickr_url',
            'type' => 'esc_url'
        ),
        array(
            'id'       => 'kopa_theme_options_social_links_youtube_url',
            'type' => 'esc_url'
        ),

        /* Custom CSS */
        array(
            'id'       => 'kopa_theme_options_custom_css',
            'type' => 'textarea'
        ),
    );

    
}

/**
 * Register settings 
 */
function kopa_register_settings() {
    //register our settings
    register_setting( 'kopa_theme_options_group', 'kopa_theme_options', 'kopa_validate_options' );
}

/**
 * Validate/Sanitize options
 */
function kopa_validate_options( $input ) {
    $args = kopa_get_options_args();

    foreach ( $args as $index => $option ) {
        $id = $option['id'];

        if ( isset( $input[ $id ] ) ) {
            switch ( $option['type'] ) {
                case 'text':
                    $input[ $id ] = sanitize_text_field( $input[ $id ] );
                    break;
                case 'url':
                    $input[ $id ] = esc_url( $input[ $id ] );
                    break;
                case 'email':
                    $input[ $id ] = sanitize_email( $input[ $id ] );
                    break;
                case 'number':
                    $input[ $id ] = kopa_sanitize_number( $input[ $id ] );
                    break;
                case 'abs_number':
                    $input[ $id ] = absint( $input[ $id ] );
                    break;
                case 'textarea':
                    $input[ $id ] = kopa_sanitize_textarea( $input[ $id ] );
                    break;
                case 'upload':
                    $input[ $id ] = kopa_sanitize_upload( $input[ $id ] );
                default:
                    break;
            }
        }
    }

    return $input;
}

/**
 * Get singular option in setting array
 * @param $key, option name (index)
 * @param $default, default value
 * @return option value, if option is available
 * @return $default value, if option is not available and user puts second parameter value
 * @return standard value in kopa_get_option_args(), when user does not put second parameter $default 
 * @return null, if the option index is not available, $default is empty and standard value is not available 
 * @package: Resolution
 * @since: 1.0.4
 */
function kopa_get_option( $key = null, $default = null ) {
    $args = kopa_get_options_args();
    $kopa_options = get_option( 'kopa_theme_options' );

    if ( isset( $kopa_options[ $key ] ) ) {
        return $kopa_options[ $key ];
    } elseif ( $default ) {
        return $default;
    } else {
        foreach ( $args as $index => $option ) {
            if ( $key === $option['id'] && isset( $option['std'] ) ) {
                return $option['std'];
            }
        }
    }

    return null;
}

/**

/**
 * Sanitize number in theme options
 */
function kopa_sanitize_number( $value ) {
    if ( $value == '' ) {
        return null;
    } 

    return intval( $value );
}

/**
 * Sanitize textarea in theme options
 */
function kopa_sanitize_textarea( $value ) {
    global $allowedposttags;
    $output = wp_kses( $value, $allowedposttags);
    return $output;
}

/**
 * Sanitize textarea in theme options
 */
function kopa_sanitize_upload( $input ) {
    $output = '';
    $filetype = wp_check_filetype($input);
    if ( $filetype["ext"] ) {
        $output = $input;
    }
    return $output;
}

function kopa_cpanel_theme_options() {
    include trailingslashit(get_template_directory()) . '/library/includes/cpanel/theme-options.php';
}

function kopa_admin_print_scripts() {
    $dir = get_template_directory_uri() . '/library/js';
    
   

    wp_localize_script('jquery', 'kopa_variable', kopa_localize_script());

    if (!wp_script_is('wp-color-picker'))
        wp_enqueue_script('wp-color-picker');
    if (!wp_script_is('kopa-uploader'))
        wp_enqueue_script('kopa-colorpicker', "{$dir}/colorpicker.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-utils'))
        wp_enqueue_script('kopa-admin-utils', "{$dir}/utils.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-jquery-form'))
        wp_enqueue_script('kopa-admin-jquery-form', "{$dir}/jquery.form.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-script'))
        wp_enqueue_script('kopa-admin-script', "{$dir}/script.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-admin-bootstrap'))
        wp_enqueue_script('kopa-admin-bootstrap', "{$dir}/bootstrap.min.js", array('jquery'), NULL, TRUE);

    if (!wp_script_is('thickbox'))
        wp_enqueue_script('thickbox', null, array('jquery'), NULL, TRUE);

    if (!wp_script_is('kopa-uploader'))
        wp_enqueue_script('kopa-uploader', "{$dir}/uploader.js", array('jquery'), NULL, TRUE);
}

function kopa_localize_script() {
    return array(
        'AjaxUrl' => admin_url('admin-ajax.php'),
        
    );
}

function kopa_admin_print_styles() {
    $dir = get_template_directory_uri() . '/library/css';
    wp_enqueue_style('kopa-admin-style', "{$dir}/style.css", array(), NULL);
    wp_enqueue_style('kopa-FontAwesome', get_template_directory_uri() . '/css/font-awesome.css');
    wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', array(), NULL);
    wp_enqueue_style('open-sans-font', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,600', array(), NULL);
    if (!wp_style_is('wp-color-picker'))
        wp_enqueue_style('wp-color-picker');



}

function kopa_get_domain() {
    return constant('KOPA_DOMAIN');
}


/* =====================================================================================
 * Add Style and script for categories and post edit page
  ==================================================================================== */
add_action('admin_enqueue_scripts', 'kopa_category_scripts', 10, 1);

function kopa_category_scripts($hook) {
    if ($hook == 'edit-tags.php' or $hook == 'post-new.php' or $hook == 'post.php' or $hook == 'widgets.php') {
        
        wp_localize_script('jquery', 'kopa_variable', kopa_localize_script());
        wp_enqueue_script('kopa-admin-script', get_template_directory_uri() . '/library/js/script.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-admin-bootstrap', get_template_directory_uri() . '/library/js/bootstrap.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_style('kopa-admin-style', get_template_directory_uri() . '/library/css/style.css', array(), NULL);
        wp_enqueue_style('kopa-icon-style', get_template_directory_uri() . '/css/font-awesome.css', array(), NULL);
    }

    
}

/* =====================================================================================
 * Add Style and script for Widget page
  ==================================================================================== */
add_action('admin_enqueue_scripts', 'kopa_widget_page_scripts', 10, 1);

function kopa_widget_page_scripts($hook) {
    if ($hook == 'widgets.php') {
        
        if (!wp_script_is('thickbox'))
            wp_enqueue_script('thickbox', null, array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-uploader'))
            wp_enqueue_script('kopa-uploader', get_template_directory_uri() ."/library/js/uploader.js", array('jquery'), NULL, TRUE);
        wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', array(), NULL);
        wp_enqueue_style('kopa-admin-style', get_template_directory_uri() . '/library/css/widget.css', array(), NULL);
        wp_enqueue_style('kopa-icon-style', get_template_directory_uri() . '/css/font-awesome.css', array(), NULL);
    }
}


function kopa_get_theme_info($interval) {
    $xml = new stdClass();
    $xml->version = '1.0';
    $xml->name = 'WP Forceful Theme';
    $xml->download = '';
    $xml->changelog = '';

    try {
        $db_cache_field = 'kopa-notifier-cache-' . kopa_get_domain();
        $db_cache_field_last_updated = 'kopa-notifier-last-updated-' . kopa_get_domain();
        $last = get_option($db_cache_field_last_updated);
        $now = time();

        if (!$last || (( $now - $last ) > $interval)) {
            /**
             * Update in 11/09/2013
             * @since Forceful 1.0
             */
            $cache = wp_remote_get( KOPA_UPDATE_URL );

            if ( ! is_wp_error( $cache ) && isset( $cache['body'] ) ) {
                $cache = $cache['body'];
            } else {
                $cache = '';
            }

            if ($cache) {
                update_option($db_cache_field, $cache);
                update_option($db_cache_field_last_updated, time());
            }
            $notifier_data = get_option($db_cache_field);
        } else {
            $notifier_data = get_option($db_cache_field);
        }

        $xml = simplexml_load_string($notifier_data);
    } catch (Exception $e) {
        error_log($e);
    }
    return $xml;
}

function kopa_get_avatar($avatar) {
    $avatar = str_replace('"', "'", $avatar);
    return str_replace("class='", "class='author-avatar ", $avatar);
}
