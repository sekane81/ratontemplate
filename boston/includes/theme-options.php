<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: https://docs.reduxframework.com
 * */

global $boston_opts;

if (!class_exists('Boston_Options')) {

    class Boston_Options
    {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct()
        {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array(
                    $this,
                    'initSettings'
                ), 10);
            }

        }

        public function initSettings()
        {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo()
        {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(
                    ReduxFrameworkPlugin::instance(),
                    'admin_notices'
                ));
            }
        }

        public function setSections()
        {

            /**
             * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns      = array();

            if (is_dir($sample_patterns_path)):
                if ($sample_patterns_dir = opendir($sample_patterns_path)):
                    $sample_patterns = array();
                    while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name              = explode('.', $sample_patterns_file);
                            $name              = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array(
                                'alt' => $name,
                                'img' => $sample_patterns_url . $sample_patterns_file
                            );
                        }
                    }
                endif;
            endif;

            /////////////////////////////////////////////////////////////////////////////// 1. OVERALL //

            $this->sections[] = array(
                'title' => __('Overall Setup', 'boston'),
                'desc' => __('Here in overall setup section you can edit basic settings related to overall website.', 'boston'),
                'icon' => '',
                'indent' => true,
                'fields' => array(

                    array(
                        'id' => 'site_favicon',
                        'type' => 'media',
                        'title' => __('Site Favicon', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Upload site favicon.', 'boston')
                    ),


                    array(
                        'id' => 'site_logo',
                        'type' => 'media',
                        'title' => __('Site Logo', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Upload site logo', 'boston')
                    ),

                    array(
                        'id' => 'site_logo_dark',
                        'type' => 'media',
                        'title' => __('Site Logo Dark', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Upload site logo for dark version of the site', 'boston')
                    ),

                    array(
                        'id' => 'logo_padding',
                        'type' => 'text',
                        'title' => __('Logo Padding', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Add logo padding in the format TOP RIGHT BOTTOM LEFT for example 10px 10px 10px 10px', 'boston')
                    ),

                    array(
                        'id' => 'enable_sticky',
                        'type' => 'select',
                        'title' => __( 'Enable Sticky Navigation', 'boston' ),
                        'compiler' => 'true',
                        'options' => array(
                            'yes' => __( 'Yes', 'boston' ),
                            'no' => __( 'No', 'boston' ),
                        ),
                        'desc' => __( 'Show or hide sticky navigation', 'boston' ),
                        'default' => 'no'
                    )                     

                )
            );


            // Appearance //
            $this->sections[] = array(
                'title' => __('Header', 'boston'),
                'desc' => __('Set visual feel of the header.', 'boston'),
                'icon' => '',
                'fields' => array(
                    array(
                        'id' => 'header_style',
                        'type' => 'select',
                        'options' => array(
                            'style1' => __( 'Left Logo Right Navigation', 'boston' ),
                            'style2' => __( 'Top Logo Centered Navigation', 'boston' ),
                            'style3' => __( 'Total Overlay Navigation', 'boston' ),
                        ),
                        'title' => __('Site Header Style', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Select header style for the site.', 'boston'),
                        'default' => 'style1'
                    ),
                    array(
                        'id' => 'featured_visible_items',
                        'type' => 'select',
                        'options' => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ),
                        'title' => __('Input number of item you want to initially display', 'boston'),
                        'compiler' => 'true',
                        'default' => '3'
                    ),
                )
            ); 

            // Appearance //
            $this->sections[] = array(
                'title' => __('Appearance', 'boston'),
                'desc' => __('Set visual feel of the site.', 'boston'),
                'icon' => '',
                'fields' => array(
                    array(
                        'id' => 'site_style',
                        'type' => 'select',
                        'title' => __( 'Site Style', 'boston' ),
                        'compiler' => 'true',
                        'options' => array(
                            'light' => __( 'Light Version', 'boston' ),
                            'dark' => __( 'Dark Version', 'boston' ),
                        ),
                        'desc' => __( 'Select site style', 'boston' ),
                        'default' => 'light'
                    ),

                    array(
                        'id' => 'main_font',
                        'type' => 'select',
                        'options' => boston_google_fonts(),
                        'title' => __('Main Font', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Font for the site', 'boston'),
                        'default' => 'Open Sans'
                    ),

                    array(
                        'id' => 'secondary_color',
                        'type' => 'color',
                        'title' => __('Secondary Color', 'boston'),
                        'compiler' => 'true',
                        'transparent' => false,
                        'desc' => __('Select color for the hover elements', 'boston'),
                        'default' => '#6bbafd;'
                    ),                      
                )
            );            

            // Copyrights //
            $this->sections[] = array(
                'title' => __('Copyrights', 'boston'),
                'desc' => __('Copyrights content.', 'boston'),
                'icon' => '',
                'fields' => array(
                    array(
                        'id' => 'footer_text',
                        'type' => 'text',
                        'title' => __('Copyrights', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Input copyrights', 'boston')
                    )

                )
            );

            // Copyrights //
            $this->sections[] = array(
                'title' => __('Blog Options', 'boston'),
                'desc' => __('Blog settings.', 'boston'),
                'icon' => '',
                'fields' => array(
                    array(
                        'id' => 'blog_listing_layout',
                        'type' => 'select',
                        'options' => array(
                            'right_sidebar' => __( 'Right Sidebar', 'boston' ),
                            'left_sidebar' => __( 'Left Sidebar', 'boston' ),
                            'full_width' => __( 'Full Width', 'boston' )
                        ),
                        'title' => __('Blog Listing Layout', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Select blog listing layout', 'boston'),
                        'default' => 'right_sidebar'
                    ),
                    array(
                        'id' => 'blog_listing_single_layout',
                        'type' => 'select',
                        'options' => array(
                            'right_sidebar' => __( 'Right Sidebar', 'boston' ),
                            'left_sidebar' => __( 'Left Sidebar', 'boston' ),
                        ),
                        'title' => __('Blog Single Layout', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Select blog single layout', 'boston'),
                        'default' => 'right_sidebar'
                    ),
                    array(
                        'id' => 'blog_single_author_desc_length',
                        'type' => 'text',
                        'title' => __('Blog Single Author Excerpt', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Input number of letters to be visible for the author description or leave empty for all.', 'boston'),
                        'default' => '100'
                    ),
                    array(
                        'id' => 'blog_title_max_length',
                        'type' => 'text',
                        'title' => __('Blog Title Max Length On Listing', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Input number of characters for the title on the blog listing or leave empty to display complete title.', 'boston'),
                        'default' => '60'
                    ),
                    array(
                        'id' => 'blog_excerpt_max_length',
                        'type' => 'text',
                        'title' => __('Blog Excerpt Max Length On Listing', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Input number of characters for the excerpt on the blog listing or leave empty to display complete title.', 'boston'),
                        'default' => '180'
                    ),
                )
            );            

            $this->sections[] = array(
                'title' => __('Contact Page', 'boston'),
                'desc' => __('Contact page settings.', 'boston'),
                'icon' => '',
                'fields' => array(

                    array(
                        'id' => 'contact_mail',
                        'type' => 'text',
                        'title' => __('Mail', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Input email where sent messages will arrive', 'boston')
                    ),
                    array(
                        'id' => 'contact_form_subject',
                        'type' => 'text',
                        'title' => __('Mail Subject', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Input subject for the message.', 'boston')
                    ),
                    array(
                        'id' => 'contact_map',
                        'type' => 'multi_text',
                        'title' => __('Google Map Markers', 'boston'),
                        'compiler' => 'true',
                        'desc' => __('Input longitudes and latitudes separated by comma for example 92.3123,-105.54353 (longitude,latitude). <a href="http://www.latlong.net/" target="_blank">Find Long/Lat</a>', 'boston')
                    ),
                )
            );

            // Twitter API //

            $this->sections[] = array(
                'title' => __('Twitter API', 'boston'),
                'desc' => __('Twitter API Settings.', 'boston'),
                'icon' => '',
                'fields' => array(

                    //Username
                    array(
                        'id' => 'twitter-username',
                        'type' => 'text',
                        'title' => __('Twitter Username', 'boston'),
                        'desc' => __('Input your twitter username.', 'boston')
                    ),
                    //Access Token 
                    array(
                        'id' => 'twitter-oauth_access_token',
                        'type' => 'text',
                        'title' => __('OAuth Access Token', 'boston'),
                        'desc' => __('Input your oauth access token.', 'boston')
                    ),
                    //Access Token Secret
                    array(
                        'id' => 'twitter-oauth_access_token_secret',
                        'type' => 'text',
                        'title' => __('OAuth Access Token Secret', 'boston'),
                        'desc' => __('Input your oauth access token secret.', 'boston')
                    ),

                    //Consumer Key 
                    array(
                        'id' => 'twitter-consumer_key',
                        'type' => 'text',
                        'title' => __('Consumer Key', 'boston'),
                        'desc' => __('Input your consumer key.', 'boston')
                    ),

                    //Consumer Key Secret
                    array(
                        'id' => 'twitter-consumer_secret',
                        'type' => 'text',
                        'title' => __('Consumer Secret', 'boston'),
                        'desc' => __('Input your consumer secret.', 'boston')
                    )

                )
            );


        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'boston_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => __('Boston', 'redux-framework-demo'),
                'page_title' => __('Boston', 'redux-framework-demo'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                //'menu_icon'            => get_template_directory_uri().'/images/icon.png',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE

                // HINTS
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => ''
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right'
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover'
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave'
                        )
                    )
                )
            );


        }

    }

    global $boston_opts;
    $boston_opts = new Boston_Options();
} else {
    echo "The class named Boston_Options has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
}