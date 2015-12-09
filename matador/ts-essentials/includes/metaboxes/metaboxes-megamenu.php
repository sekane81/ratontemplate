<?php
// currently dealing with an issue with this file loading at the appropriate time.
// will be fixed in an impending update.
/*-----------------------------------------------------------------------------------*/
/*  MEGA MENU METABOX */
/*-----------------------------------------------------------------------------------*/
add_filter ('cmb_meta_boxes', 'ts_megamenu_metaboxes', 506);
function ts_megamenu_metaboxes(array $meta_boxes) {
    
    $prefix = '_megamenu_';

    $meta_boxes[] = array(
        'id'         => 'megamenu_metaboxes',
        'title'      => __('Mega Menu Settings' , 'ThemeStockyard'),
        'pages'      => array('ts_mega_menu'),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields'     => array(
            
            array(
                'name' => __('General Settings' , 'ThemeStockyard'), 
                'desc' => '',
                'type' => 'title',
                'id'   => $prefix . 'title_general_setting'
            ),
            
            array(
                'name' => __('Mega Menu link' , 'ThemeStockyard'),
                'desc' => __('If you want the title/label of this Mega Menu to have a link, put it here.', 'ThemeStockyard'),
                'id'   => $prefix . 'url',
                'type' => 'text',
                'std'  => '#'
            ),
                    
            array(
                'name'    => __('Mega Menu Layout:' , 'ThemeStockyard'),
                'desc'    => __('Choose a layout type (width) for this mega menu.' , 'ThemeStockyard'),
                'id'      => $prefix . 'layout',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('Wide', 'ThemeStockyard'), 'value' => 'wide'), 
                    array('name' => __('Standard &times; 3', 'ThemeStockyard'), 'value' => 'standardx3'),
                    array('name' => __('Standard &times; 2', 'ThemeStockyard'), 'value' => 'standardx2'),
                    array('name' => __('Standard', 'ThemeStockyard'), 'value' => 'standard'),              
                )
            ),
            /*        
            array(
                'name'    => __('Hide on small devices? (eg. phones)' , 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'hide_on_mobile',
                'type'    => 'select',
                'options' => array(
                    array('name' => __('No', 'ThemeStockyard'), 'value' => 'no'),
                    array('name' => __('Yes', 'ThemeStockyard'), 'value' => 'gallery'),                
                )
            ),


            array(
                'name'    => __('Background Image', 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'bg_image',
                'type'    => 'file',
                'std'     => ''
            ),

            array(
                'name'    => __('Background Image Repeat', 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'bg_repeat',
                'type'    => 'select',
                'options' => array(
                                array("name"=>"repeat", "value"=>"repeat"),
                                array("name"=>"no-repeat", "value"=>"no-repeat"),
                                array("name"=>"repeat-x", "value"=>"repeat-x"),
                                array("name"=>"repeat-y", "value"=>"repeat-y"),
                            ),
                'std'     => 'repeat'
            ),

            array(
                'name'    => __('Background Image Position', 'ThemeStockyard'),
                'desc'    => '',
                'id'      => $prefix . 'bg_position',
                'type'    => 'select',
                'options' => array(
                                array("name"=>"top left", "value"=>"top left"),
                                array("name"=>"top center", "value"=>"top center"),
                                array("name"=>"top right", "value"=>"top right"),
                                array("name"=>"center left", "value"=>"center left"),
                                array("name"=>"center center", "value"=>"center center"),
                                array("name"=>"center right", "value"=>"center right"),
                                array("name"=>"bottom left", "value"=>"bottom left"),
                                array("name"=>"bottom center", "value"=>"bottom center"),
                                array("name"=>"bottom right", "value"=>"bottom right"),
                            ),
                'std'     => 'top left'
            ),
            */
            
            array(
                'name' => __('Need help?' , 'ThemeStockyard'), 
                'desc' => __('For tips and instructions on creating Mega Menus, please see our <a href="http://themestockyard.com/matador/documentation/#!/mega_menus" target="_blank">documentation</a>.' , 'ThemeStockyard'),
                'type' => 'title',
                'id'   => $prefix . 'title_need_help'
            ),
        ),
    );

    return $meta_boxes;
}