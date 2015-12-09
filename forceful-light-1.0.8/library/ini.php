<?php

$kopa_layout = array(
    'blog' => array(
        'title' => __('Blog Right Sidebar', kopa_get_domain()),
        'thumbnails' => 'blog.jpg',
        'positions' => array(
            'position_1',
            'position_2',
            'position_8',
            'position_7',
            'position_3',
            'position_4',
            'position_5',
            'position_6'
        )
    ),
    
    'page-right-sidebar' => array(
        'title' => __('Page Right Sidebar', kopa_get_domain()),
        'thumbnails' => 'page.jpg',
        'positions' => array(
            'position_1',
            'position_7',
            'position_3',
            'position_4',
            'position_5',
            'position_6'
        )
    ),
    'single-right-sidebar' => array(
        'title' => __('Single Right Sidebar', kopa_get_domain()),
        'thumbnails' => 'single.jpg',
        'positions' => array(
            'position_1',
            'position_7',
            'position_3',
            'position_4',
            'position_5',
            'position_6'
        )
    ),
    'error-404' => array(
        'title' => __('404 Page', kopa_get_domain()),
        'thumbnails' => 'error-404.jpg',
        'positions' => array(
            'position_1',
            'position_3',
            'position_4',
            'position_5',
            'position_6',
        ),
    ),
);

$kopa_sidebar_position = array(
    'position_1' => array('title' => 'Widget Area 1'),
    'position_2' => array('title' => 'Widget Area 2'),
    'position_3' => array('title' => 'Widget Area 3'),
    'position_4' => array('title' => 'Widget Area 4'),
    'position_5' => array('title' => 'Widget Area 5'),
    'position_6' => array('title' => 'Widget Area 6'),
    'position_7' => array('title' => 'Widget Area 7'),
    'position_8' => array('title' => 'Widget Area 8'),
);

$kopa_template_hierarchy = array(
   
    'home' =>array(
        'title' => __('Home', kopa_get_domain()),
        'layout' => array('blog')
    ),
    'post' => array(
        'title' => __('Post', kopa_get_domain()),
        'layout' => array('single-right-sidebar')
    ),
    'page' => array(
        'title' => __('Page', kopa_get_domain()),
        'layout' => array('page-right-sidebar')
    ),
    'taxonomy' => array(
        'title' => __('Taxonomy', kopa_get_domain()),
        'layout' => array('blog')
    ),
    'search' => array(
        'title' => __('Search', kopa_get_domain()),
        'layout' => array('blog')
    ),
    'archive' => array(
        'title' => __('Archive', kopa_get_domain()),
        'layout' => array('blog')
    ),
    '_404' => array(
        'title' => __('404', kopa_get_domain()),
        'layout' => array('error-404')
    )
);
$kopa_setting = array(
   
    'home' => array(
        'layout_id' => 'blog',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_2',
            'sidebar_8',
            'sidebar_7',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6'
        )
    ),
    'post' => array(
        'layout_id' => 'single-right-sidebar',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_7',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6'
        )
    ),
    'page' => array(
        'layout_id' => 'page-right-sidebar',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_7',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6'
        )
    ),
    'taxonomy' => array(
        'layout_id' => 'blog',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_hide',
            'sidebar_hide',
            'sidebar_7',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6'
        )
    ),
    'search' => array(
        'layout_id' => 'blog',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_hide',
            'sidebar_hide',
            'sidebar_7',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6'
        )
    ),
    'archive' => array(
        'layout_id' => 'blog',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_hide',
            'sidebar_hide',
            'sidebar_7',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6'
        )
    ),
    '_404' => array(
        'layout_id' => 'error-404',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6'
        )
    ),
);

$kopa_sidebar = array(
            'sidebar_hide' => '-- None --',
            'sidebar_1' => 'Sidebar 1',
            'sidebar_2' => 'Sidebar 2',
            'sidebar_3' => 'Sidebar 3',
            'sidebar_4' => 'Sidebar 4',
            'sidebar_5' => 'Sidebar 5',
            'sidebar_6' => 'Sidebar 6',
            'sidebar_7' => 'Sidebar 7',
            'sidebar_8' => 'Sidebar 8',
        );
define('KOPA_INIT_VERSION', 'forceful-setting-version-10');
define('KOPA_LAYOUT', serialize($kopa_layout));
define('KOPA_SIDEBAR_POSITION', serialize($kopa_sidebar_position));
define('KOPA_TEMPLATE_HIERARCHY', serialize($kopa_template_hierarchy));
define('KOPA_DEFAULT_SETTING', serialize($kopa_setting) );
define('KOPA_DEFAULT_SIDEBAR', serialize($kopa_sidebar));



add_action('widgets_init', 'kopa_register_sidebar');

function kopa_register_sidebar() {
    $kopa_sidebar = get_option('kopa_sidebar',  unserialize(KOPA_DEFAULT_SIDEBAR) );

    foreach ($kopa_sidebar as $key => $value) {
        if ('sidebar_hide' != $key) {
            register_sidebar(array(
                'name' => $value,
                'id' => $key,
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
        }
    }
}
