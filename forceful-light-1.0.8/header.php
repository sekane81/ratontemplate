<?php 
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
$kopa_logo = kopa_get_option( 'kopa_theme_options_logo_url' );
$kopa_top_banner_code = kopa_get_option( 'kopa_theme_options_top_banner_code' );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">                   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php kopa_print_page_title(); ?></title>     
    <link rel="profile" href="http://gmpg.org/xfn/11">           
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    
    <?php if ( kopa_get_option('kopa_theme_options_favicon_url') ) { ?>       
        <link rel="shortcut icon" type="image/x-icon"  href="<?php echo kopa_get_option('kopa_theme_options_favicon_url'); ?>">
    <?php } ?>
    
    <?php if ( kopa_get_option('kopa_theme_options_apple_iphone_icon_url') ) { ?>
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo kopa_get_option('kopa_theme_options_apple_iphone_icon_url'); ?>">
    <?php } ?>

    <?php if ( kopa_get_option('kopa_theme_options_apple_ipad_icon_url') ) { ?>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo kopa_get_option('kopa_theme_options_apple_ipad_icon_url'); ?>">
    <?php } ?>

    <?php if ( kopa_get_option('kopa_theme_options_apple_iphone_retina_icon_url') ) { ?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo kopa_get_option('kopa_theme_options_apple_iphone_retina_icon_url'); ?>">
    <?php } ?>

    <?php if ( kopa_get_option('kopa_theme_options_apple_ipad_retina_icon_url') ) { ?>
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo kopa_get_option('kopa_theme_options_apple_ipad_retina_icon_url'); ?>">        
    <?php } ?>
    

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/PIE_IE678.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
</head>   
<body <?php body_class(); ?>>
<header id="page-header">
    <div id="header-top" class="clearfix">
        
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col">
                        <div class="r-color-container"><div class="r-color"></div></div>
                        <nav id="main-nav">
                            <?php 
                            if ( has_nav_menu( 'main-nav' ) ) {
                                wp_nav_menu( array(
                                    'theme_location' => 'main-nav',
                                    'container'      => '',
                                    'menu_id'        => 'main-menu',
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'
                                ) );

                                $mobile_menu_walker = new kopa_mobile_menu();
                                wp_nav_menu( array(
                                    'theme_location' => 'main-nav',
                                    'container'      => 'div',
                                    'container_id'   => 'mobile-menu',
                                    'menu_id'        => 'toggle-view-menu',
                                    'items_wrap'     => '<span>'.__( 'Menu', kopa_get_domain() ).'</span><ul id="%1$s">%3$s</ul>',
                                    'walker'         => $mobile_menu_walker
                                ) );
                            } ?>
                        </nav>
                        <!-- main-nav -->
                    </div>
                    <!-- l-col -->
                    <div class="r-col">                    
                        <?php get_search_form(); ?>
                    </div>
                    <!-- r-col -->
                </div>                
                <!-- span12 -->
            </div>
            <!-- row-fluid -->
        </div>
        <!-- wrapper -->
    </div>
    <!-- header-top -->
    <div id="header-bottom">
        
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col clearfix">
                        <div class="r-color"></div>
                        <div id="logo-image">
                            <?php if (get_header_image()) { ?>
                            <a href="<?php echo esc_url(home_url()); ?>">
                                <img src="<?php header_image(); ?>" width="217" height="70" alt="<?php bloginfo('name'); ?> <?php _e('Logo', kopa_get_domain()); ?>">
                            </a>
                        <?php } ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a></h1>
                        </div>
                        <!-- logo-image -->
                        <div class="top-banner">
                            <?php echo htmlspecialchars_decode( stripslashes( $kopa_top_banner_code ) ); ?>
                        </div>
                        <!-- top-banner -->
                    </div>
                    <!-- l-col -->
                    <div class="r-col">
                        <div class="widget-area-1">
                            <?php if ( is_active_sidebar( $sidebars[0] ) ) {
                                dynamic_sidebar( $sidebars[0] );
                            } ?>
                        </div>
                        <!-- widget-area-1 -->
                    </div>
                    <!-- r-col -->
                </div>
                <!-- span12 -->
            </div>
            <!-- row-fluid -->
        </div>
        <!-- wrapper -->
    </div>
    <!-- header-bottom -->
</header>
<!-- page-header -->