<?php

class KopaIcon {

    public static function getIconPostFormat($post_format, $icon_tag = 'i', $image_src = NULL) {
        switch ($post_format) {
            case 'gallery':
                $classes = "entypo-pictures";
                break;
            case 'image':
                $classes = "eco-pictures";
                break;
            case 'status':
                $classes = "eco-chat";
                break;
            case 'quote':
                $classes = "entypo-quote";
                break;
            case 'video':
                $classes = "entypo-play";
                break;
            case 'audio':
                $classes = "entypo-music";
                break;
            case 'chat':
                $classes = "eco-chat";
                break;
            default:
                $classes = 'entypo-newspaper';
                break;
        }
        $html = self::createHtml($classes, $icon_tag, $image_src);
        return apply_filters('kopa_icon_get_icon_post_format', $html, $post_format, $image_src);
    }

    public static function getIconComment($icon_tag = 'i', $image_src = NULL) {
        $html = self::createHtml('fa fa-comment-o', $icon_tag, $image_src);
        return apply_filters('kopa_icon_get_icon_comment', $html, $icon_tag, $image_src);
    }

    public static function getIconDatetime($icon_tag = 'i', $image_src = NULL) {
        $html = self::createHtml('fa fa-calendar-o', $icon_tag, $image_src);
        return apply_filters('kopa_icon_get_icon_datetime', $html, $icon_tag, $image_src);
    }

    public static function getIconView($icon_tag = 'i', $image_src = NULL) {
        $html = self::createHtml('fa fa-eye', $icon_tag, $image_src);
        return apply_filters('kopa_icon_get_icon_view', $html, $icon_tag, $image_src);
    }

    public static function getIconLike($icon_tag = 'i', $image_src = NULL) {
        $html = self::createHtml('fa fa-heart', $icon_tag, $image_src);
        return apply_filters('kopa_icon_get_icon_like', $html, $icon_tag, $image_src);
    }

    public static function getIconShare($icon_tag = 'i', $image_src = NULL) {
        $html = self::createHtml('fa fa-share', $icon_tag, $image_src);
        return apply_filters('kopa_icon_get_icon_share', $html, $icon_tag, $image_src);
    }

    public static function createHtml($icon_class = '', $icon_tag = 'i', $image_src = NULL) {
        $html = '';
        if (empty($image_src)) {
            $html = sprintf('<%1$s class="%2$s"></%1$s>', $icon_tag, $icon_class);
        } else {
            $html = sprintf('<img src="%s" class="post_format_image">', $image_src);
        }
        return apply_filters('kopa_icon_create_html', $html, $icon_class, $icon_tag, $image_src);
    }

    public static function getIcon($icon_class = '', $icon_tag = 'i', $image_src = NULL) {
        $html = self::createHtml($icon_class, $icon_tag, $image_src);
        return apply_filters('kopa_icon_get_icon', $html, $icon_class, $icon_tag, $image_src);        
    }
    
    
    
    public static function getIconList() {
        $icons = array();
        $icons['fa'] = array(
            'facebook',
            'download',
            'chat',
            'archive',
            'user',
            'users',
            'archive2',
            'earth',
            'location',
            'contract',
            'mobile',
            'screen',
            'mail',
            'support',
            'help',
            'videos',
            'pictures',
            'link',
            'search',
            'cog',
            'trashcan',
            'pencil',
            'info',
            'article',
            'clock',
            'photoshop',
            'illustrator',
            'star',
            'heart',
            'bookmark',
            'file',
            'feed',
            'locked',
            'unlocked',
            'refresh',
            'list',
            'share',
            'archive3',
            'images',
            'images2',
            'pencil2'
        );
        return apply_filters('kopa_icon_get_icon_list', $icons);
    }

}
