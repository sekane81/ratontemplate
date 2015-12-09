<?php
add_action('widgets_init', 'kopa_widgets_init');

function kopa_widgets_init() {
    
    register_widget('Kopa_Widget_Flexslider');
    register_widget('Kopa_Widget_Articles_List');
    register_widget('Kopa_Widget_Articles_List_Thumbnails');
    register_widget('Kopa_Widget_Twitter');
    register_widget('Kopa_Widget_Advertising');
    register_widget('Kopa_Widget_Gallery');
    register_widget('Kopa_Widget_Mailchimp_Subscribe');
    register_widget('Kopa_Widget_Feedburner_Subscribe');
    register_widget('Kopa_Widget_Combo');
    register_widget('Kopa_Widget_Lastest_Comments');
    register_widget('Kopa_Widget_Flickr');
    register_widget('Kopa_Widget_Socials');
    
}

add_action('admin_enqueue_scripts', 'kopa_widget_admin_enqueue_scripts');

function kopa_widget_admin_enqueue_scripts($hook) {
    if ('widgets.php' === $hook) {
        $dir = get_template_directory_uri() . '/library';
        wp_enqueue_style('kopa_widget_admin', "{$dir}/css/widget.css");
        wp_enqueue_script('kopa_widget_admin', "{$dir}/js/widget.js", array('jquery'));
    }
}

function kopa_widget_article_build_query($query_args = array()) {
    $args = array(
        'post_type' => array('post'),
        'posts_per_page' => $query_args['number_of_article']
    );

    $tax_query = array();

    if ($query_args['categories']) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $query_args['categories']
        );
    }
    if ($query_args['tags']) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => $query_args['tags']
        );
    }
    if ($query_args['relation'] && count($tax_query) == 2) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ($tax_query) {
        $args['tax_query'] = $tax_query;
    }

    switch ($query_args['orderby']) {
        case 'popular':
            $args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
            $args['orderby'] = 'meta_value_num';
            break;
        case 'most_comment':
            $args['orderby'] = 'comment_count';
            break;
        case 'random':
            $args['orderby'] = 'rand';
            break;
        default:
            $args['orderby'] = 'date';
            break;
    }
    if (isset($query_args['post__not_in']) && $query_args['post__not_in']) {
        $args['post__not_in'] = $query_args['post__not_in'];
    }
    return new WP_Query($args);
}

function kopa_widget_posttype_build_query( $query_args = array() ) {
    $default_query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post__not_in'   => array(),
        'ignore_sticky_posts' => 1,
        'categories'     => array(),
        'tags'           => array(),
        'relation'       => 'OR',
        'orderby'        => 'lastest',
        'cat_name'       => 'category',
        'tag_name'       => 'post_tag'
    );

    $query_args = wp_parse_args( $query_args, $default_query_args );

    $args = array(
        'post_type'           => $query_args['post_type'],
        'posts_per_page'      => $query_args['posts_per_page'],
        'post__not_in'        => $query_args['post__not_in'],
        'ignore_sticky_posts' => $query_args['ignore_sticky_posts']
    );

    $tax_query = array();

    if ( $query_args['categories'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['cat_name'],
            'field'    => 'id',
            'terms'    => $query_args['categories']
        );
    }
    if ( $query_args['tags'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['tag_name'],
            'field'    => 'id',
            'terms'    => $query_args['tags']
        );
    }
    if ( $query_args['relation'] && count( $tax_query ) == 2 ) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ( $tax_query ) {
        $args['tax_query'] = $tax_query;
    }

    switch ( $query_args['orderby'] ) {
    case 'popular':
        $args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
        $args['orderby'] = 'meta_value_num';
        break;
    case 'most_comment':
        $args['orderby'] = 'comment_count';
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    default:
        $args['orderby'] = 'date';
        break;
    }

    return new WP_Query( $args );
}


/**
 * Flexslider Widget Class
 * @since Forceful 1.0
 */
class Kopa_Widget_Flexslider extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-home-slider-widget', 'description' => __('A Posts Slider Widget', kopa_get_domain()));
        $control_ops = array('width' => '500', 'height' => 'auto');
        parent::__construct('kopa_widget_flexslider', __('Kopa Flexslider', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle = $instance['subtitle'];
        $query_args['categories'] = $instance['categories'];
        $query_args['relation'] = $instance['relation'];
        $query_args['tags'] = $instance['tags'];
        $query_args['posts_per_page'] = $instance['number_of_article'];
        $query_args['orderby'] = $instance['orderby'];

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . ' <span>' . $subtitle . '</span><span class="arrow"></span>' . $after_title;
        }

        $posts = kopa_widget_posttype_build_query( $query_args );

        if ( $posts->have_posts() ) : ?>

            <div class="home-slider flexslider loading" data-animation="<?php echo $instance['animation']; ?>" data-direction="<?php echo $instance['direction'] ?>" data-slideshow_speed="<?php echo $instance['slideshow_speed']; ?>" data-animation_speed="<?php echo $instance['animation_speed']; ?>" data-autoplay="<?php echo $instance['is_auto_play']; ?>">
                <ul class="slides">
                    <?php while ( $posts->have_posts() ) : $posts->the_post(); 
                        if ( 'video' == get_post_format() ) {
                            $data_icon = 'film'; // icon-film-2
                        } elseif ( 'gallery' == get_post_format() ) {
                            $data_icon = 'images'; // icon-images
                        } elseif ( 'audio' == get_post_format() ) {
                            $data_icon = 'music'; // icon-music
                        } else {
                            $data_icon = 'pencil'; // icon-pencil
                        }
                    ?>
                    <li>
                        <article class="entry-item standard-post">
                            <div class="entry-thumb">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'kopa-image-size-0' ); // 579x 382
                            } elseif ( 'video' == get_post_format() ) {
                                $video = kopa_content_get_video( get_the_content() );

                                if ( isset( $video[0] ) ) {
                                    $video = $video[0];
                                } else {
                                    $video = '';
                                }

                                if ( isset( $video['type'] ) && isset( $video['url'] ) ) {
                                    $video_thumbnail_url = kopa_get_video_thumbnails_url( $video['type'], $video['url'] );
                                    echo '<img src="'.esc_url( $video_thumbnail_url ).'" alt="'.get_the_title().'">';
                                }
                            } elseif ( 'gallery' == get_post_format() ) {
                                $gallery_ids = kopa_content_get_gallery_attachment_ids( get_the_content() );

                                if ( ! empty( $gallery_ids ) ) {
                                    foreach ( $gallery_ids as $id ) {
                                        if ( wp_attachment_is_image( $id ) ) {
                                            echo wp_get_attachment_image( $id, 'kopa-image-size-0' ); // 579 x 382
                                            break;
                                        }
                                    }
                                }
                            } // endif has_post_thumbnail
                            ?>

                                <a href="<?php the_permalink(); ?>"><?php echo KopaIcon::getIcon('long-arrow-right'); ?></a>
                            </div>
                            <div class="entry-content">
                                <header>
                                    <span class="entry-categories"><?php echo KopaIcon::getIcon('star', 'span'); ?><?php the_category(', '); ?></span>
                                    <h4 class="entry-title clearfix"><?php echo KopaIcon::getIcon($data_icon, 'span'); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="meta-box">
                                        <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                        <?php if(comments_open()){ ?>
                                        <span class="entry-comments"><?php echo KopaIcon::getIcon('comment', 'span'); ?><?php comments_popup_link( '0', '1', '%' ); ?></span>
                                        <?php } ?>
                                        <?php if ( 'show' == kopa_get_option('kopa_theme_options_view_count_status') && true == get_post_meta( get_the_ID(), 'kopa_' . kopa_get_domain() . '_total_view', true ) ) { ?>
                                        <span class="entry-view"><?php echo KopaIcon::getIcon('view', 'span'); ?><?php echo get_post_meta( get_the_ID(), 'kopa_' . kopa_get_domain() . '_total_view', true ); ?></span>
                                        <?php } ?>
                                    </div>
                                    <!-- meta-box -->
                                    <?php 
                                    $post_rating = round( get_post_meta( get_the_ID(), 'kopa_editor_user_total_all_rating_' . kopa_get_domain(), true ) );

                                    if ( ! empty( $post_rating ) ) {
                                    ?>
                                        <ul class="kopa-rating clearfix">
                                            <?php
                                            for ( $i = 0; $i < $post_rating; $i++ ) {
                                                echo '<li>'.KopaIcon::getIcon('star', 'span').'</li>';
                                            }
                                            for ( $i = 0; $i < 5 - $post_rating; $i++ ) {
                                                echo '<li>'.KopaIcon::getIcon('star2', 'span').'</li>';
                                            }
                                            ?>
                                        </ul>
                                    <?php } ?>
                                    <div class="clear"></div>
                                </header>
                                <?php the_excerpt(); ?>
                            </div>                                        
                        </article>
                        <!-- entry-item -->
                    </li>
                    <?php endwhile; ?>
                </ul><!--slides-->
            </div><!--home-slider-->

        <?php
        endif; // endif $posts->have_posts()

        wp_reset_postdata();
        
        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title' => __( 'Hot', kopa_get_domain() ),
            'subtitle' => __( 'News', kopa_get_domain() ),
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 10,
            'orderby' => 'lastest',
            'animation' => 'slide',
            'direction' => 'horizontal',
            'slideshow_speed' => '7000',
            'animation_speed' => '600',
            'is_auto_play' => 'true'
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $subtitle = strip_tags( $instance['subtitle'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        $form['animation'] = $instance['animation'];
        $form['direction'] = $instance['direction'];
        $form['slideshow_speed'] = (int) $instance['slideshow_speed'];
        $form['animation_speed'] = (int) $instance['animation_speed'];
        $form['is_auto_play'] = $instance['is_auto_play'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
        </p>
        <div class="kopa-one-half">
            <p>
                <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                    <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>

            </p>
            <p>
                <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                    <?php
                    $relation = array(
                        'AND' => __('And', kopa_get_domain()),
                        'OR' => __('Or', kopa_get_domain())
                    );
                    foreach ($relation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                    <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                    <?php
                    $tags = get_tags();
                    foreach ($tags as $tag) {
                        printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
                <input class="widefat" type="number" min="2" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                    <?php
                    $orderby = array(
                        'lastest' => __('Latest', kopa_get_domain()),
                        'popular' => __('Popular by View Count', kopa_get_domain()),
                        'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                        'random' => __('Random', kopa_get_domain()),
                    );
                    foreach ($orderby as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
        </div>
        <div class="kopa-one-half last">
            <p>
                <label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Animation:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>" autocomplete="off">
                    <?php
                    $animation = array(
                        'slide' => __('Slide', kopa_get_domain())
                    );
                    foreach ($animation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['animation']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('direction'); ?>"><?php _e('Direction:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('direction'); ?>" name="<?php echo $this->get_field_name('direction'); ?>" autocomplete="off">
                    <?php
                    $direction = array(
                        'horizontal' => __('Horizontal', kopa_get_domain())
                    );
                    foreach ($direction as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['direction']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('slideshow_speed'); ?>"><?php _e('Speed of the slideshow cycling:', kopa_get_domain()); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('slideshow_speed'); ?>" name="<?php echo $this->get_field_name('slideshow_speed'); ?>" type="number" value="<?php echo $form['slideshow_speed']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('animation_speed'); ?>"><?php _e('Speed of animations:', kopa_get_domain()); ?></label>                
                <input class="widefat" id="<?php echo $this->get_field_id('animation_speed'); ?>" name="<?php echo $this->get_field_name('animation_speed'); ?>" type="number" value="<?php echo $form['animation_speed']; ?>" />
            </p>

            <p>
                <input class="" id="<?php echo $this->get_field_id('is_auto_play'); ?>" name="<?php echo $this->get_field_name('is_auto_play'); ?>" type="checkbox" value="true" <?php echo ('true' === $form['is_auto_play']) ? 'checked="checked"' : ''; ?> />
                <label for="<?php echo $this->get_field_id('is_auto_play'); ?>"><?php _e('Auto Play', kopa_get_domain()); ?></label>                                
            </p>
        </div>
        <div class="kopa-clear"></div>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = (int) $new_instance['number_of_article'];
        if ( 0 >= $instance['number_of_article'] ) {
            $instance['number_of_article'] = 10;
        }
        $instance['orderby'] = $new_instance['orderby'];
        $instance['animation'] = $new_instance['animation'];
        $instance['direction'] = $new_instance['direction'];
        $instance['slideshow_speed'] = (int) $new_instance['slideshow_speed'];
        $instance['animation_speed'] = (int) $new_instance['animation_speed'];
        $instance['is_auto_play'] = isset($new_instance['is_auto_play']) ? $new_instance['is_auto_play'] : 'false';

        return $instance;
    }
} // end Kopa_Widget_Flexslider

/**
 * Articles List Widget Class
 * @since Forceful 1.0
 */
class Kopa_Widget_Articles_List extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-latest-post-widget', 'description' => __('Display Latest Articles Widget', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_articles_list', __('Kopa Articles List', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle = $instance['subtitle'];
        $query_args['categories'] = $instance['categories'];
        $query_args['relation'] = $instance['relation'];
        $query_args['tags'] = $instance['tags'];
        $query_args['posts_per_page'] = $instance['number_of_article'];
        $query_args['orderby'] = $instance['orderby'];

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . ' <span>' . $subtitle . '</span>' . $after_title;
        }

        $posts = kopa_widget_posttype_build_query( $query_args );
        ?>

        <ul>
            <?php if ( $posts->have_posts() ) {
                while ( $posts->have_posts() ) { 
                    $posts->the_post();
            ?>
                <li>
                    <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php } 
            } ?>
        </ul>

        <?php
        wp_reset_postdata();

        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title'             => '',
            'subtitle'          => '',
            'categories'        => array(),
            'relation'          => 'OR',
            'tags'              => array(),
            'number_of_article' => 3,
            'orderby'           => 'lastest',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $subtitle = strip_tags( $instance['subtitle'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                <?php
                $relation = array(
                    'AND' => __('And', kopa_get_domain()),
                    'OR' => __('Or', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $tags = get_tags();
                foreach ($tags as $tag) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'lastest' => __('Latest', kopa_get_domain()),
                    'popular' => __('Popular by View Count', kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                    'random' => __('Random', kopa_get_domain()),
                );
                foreach ($orderby as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = (int) $new_instance['number_of_article'];
        // validate number of article
        if ( 0 >= $instance['number_of_article'] ) {
            $instance['number_of_article'] = 3;
        }
        $instance['orderby'] = $new_instance['orderby'];

        return $instance;
    }
}

/**
 * Articles List Thumbnails Widget Class
 * @since Forceful 1.0
 */
class Kopa_Widget_Articles_List_Thumbnails extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-popular-post-widget', 'description' => __('Display Latest Articles with Thumbnails', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_articles_list_thumbnails', __('Kopa Articles List With Thumbnails', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle = $instance['subtitle'];
        $query_args['categories'] = $instance['categories'];
        $query_args['relation'] = $instance['relation'];
        $query_args['tags'] = $instance['tags'];
        $query_args['posts_per_page'] = $instance['number_of_article'];
        $query_args['orderby'] = $instance['orderby'];

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . ' <span>' . $subtitle . '</span>' . $after_title;
        }

        $posts = kopa_widget_posttype_build_query( $query_args );
        ?>

        <ul>
            
            <?php if ( $posts->have_posts() ) {
                while ( $posts->have_posts() ) { 
                    $posts->the_post();

                    if ( 'video' == get_post_format() ) {
                        $data_icon = 'video'; // icon-film-2
                    } elseif ( 'gallery' == get_post_format() ) {
                        $data_icon = 'images'; // icon-images
                    } elseif ( 'audio' == get_post_format() ) {
                        $data_icon = 'music'; // icon-music
                    } else {
                        $data_icon = 'pencil'; // icon-pencil
                    }

                    $has_printed_thumbnail = false;
            ?>
                <li>
                    <article class="entry-item clearfix">
                        <div class="entry-thumb">
                        <?php 
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'kopa-image-size-2' ); // 451x259
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
                                echo '<img src="'.esc_url( $video_thumbnail_url ).'" alt="'.get_the_title().'">';

                                $has_printed_thumbnail = true;
                            }
                        } elseif ( 'gallery' == get_post_format() ) {
                            $gallery_ids = kopa_content_get_gallery_attachment_ids( get_the_content() );

                            if ( ! empty( $gallery_ids ) ) {
                                foreach ( $gallery_ids as $id ) {
                                    if ( wp_attachment_is_image( $id ) ) {
                                        echo wp_get_attachment_image( $id, 'kopa-image-size-2' ); // 451 x 259
                                        $has_printed_thumbnail = true;
                                        break;
                                    }
                                }
                            }
                        } // endif has_post_thumbnail
                        ?>

                        <?php if ( $has_printed_thumbnail ) { ?>
                            <a href="<?php the_permalink(); ?>" ><?php echo KopaIcon::getIcon('long-arrow-right'); ?></a>
                        <?php } // endif ?>
                        </div>
                        <div class="entry-content">
                            <header>
                                <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                <h4 class="entry-title clearfix"><?php echo KopaIcon::getIcon($data_icon, 'span'); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php the_excerpt(); ?>
                            </header>
                        </div>
                    </article>
                </li>
            <?php } 
            } ?>
        </ul>

        <?php
        wp_reset_postdata();

        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title'             => '',
            'subtitle'          => '',
            'categories'        => array(),
            'relation'          => 'OR',
            'tags'              => array(),
            'number_of_article' => 3,
            'orderby'           => 'lastest',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $subtitle = strip_tags( $instance['subtitle'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                <?php
                $relation = array(
                    'AND' => __('And', kopa_get_domain()),
                    'OR' => __('Or', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $tags = get_tags();
                foreach ($tags as $tag) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'lastest' => __('Latest', kopa_get_domain()),
                    'popular' => __('Popular by View Count', kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                    'random' => __('Random', kopa_get_domain()),
                );
                foreach ($orderby as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = (int) $new_instance['number_of_article'];
        // validate number of article
        if ( 0 >= $instance['number_of_article'] ) {
            $instance['number_of_article'] = 3;
        }
        $instance['orderby'] = $new_instance['orderby'];

        return $instance;
    }
}





/**
 * Twitter Widget Class
 * @since News Mix 1.0
 */
class Kopa_Widget_Twitter extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-twitter-widget', 'description' => __('Display your latest twitter status', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_twitter', __('Kopa Twitter', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $number_of_tweets = $instance['number_of_tweets'];

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        if ( ! empty ( $instance['twitter_username'] ) ) {
        ?>
        <p class="twitter-loading"><?php _e('Loading...',  kopa_get_domain());  ?></p>
            <div class="tweets clearfix" data-username="<?php echo esc_attr( $instance['twitter_username'] ); ?>" data-limit="<?php echo esc_attr( $number_of_tweets ); ?>"></div>
            
        <?php 
        }

        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title' => '',
            'twitter_username' => 'kopasoft',
            'number_of_tweets' => 2,
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $form['twitter_username'] = $instance['twitter_username'];
        $form['number_of_tweets'] = $instance['number_of_tweets'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter Username:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($form['twitter_username']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_tweets'); ?>"><?php _e('Number of tweets:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_tweets'); ?>" name="<?php echo $this->get_field_name('number_of_tweets'); ?>" type="number" min="1" value="<?php echo esc_attr($form['number_of_tweets']); ?>" />
        </p>

        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
        $instance['number_of_tweets'] = (int) $new_instance['number_of_tweets'];

        if ( 0 >= $instance['number_of_tweets'] ) {
            $instance['number_of_tweets'] = 2;
        }

        return $instance;
    }
}

/**
 * Advertising Widget Class
 * @since News Mix 1.0
 */
class Kopa_Widget_Advertising extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-adv-widget', 'description' => __('Display one 300x300 advertising image', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_advertising', __('Kopa Advertising', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $image_url = $instance['image_url'];
        $image_src = $instance['image_src'];

        if ( empty( $image_src ) ) {
            $image_src = get_template_directory_uri() . '/images/placeholders/banner300.jpg';
        }

        echo $before_widget;

        if ( ! empty( $title ) ) {
           echo $before_title . $title . $after_title;
        }
        ?>

        <div class="kopa-banner-300">
            <?php if ( $image_url ) { ?>
                <a href="<?php echo esc_url($image_url) ?>"><img src="<?php echo esc_url($image_src); ?>" alt=""></a>
            <?php } else { ?>
                <img src="<?php echo esc_url($image_src); ?>" alt="kopa-advertising-<?php echo $title; ?>">
            <?php } ?>
        </div><!--kopa-banner-300-->

        <?php
        
        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title'     => '',
            'image_src' => '',
            'image_url' => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $form['image_src'] = $instance['image_src'];
        $form['image_url'] = $instance['image_url'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_src'); ?>"><?php _e('Image Source:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('image_src'); ?>" name="<?php echo $this->get_field_name('image_src'); ?>" type="text" value="<?php echo esc_attr($form['image_src']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Url:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo esc_attr($form['image_url']); ?>">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image_src'] = $new_instance['image_src'];
        $instance['image_url'] = $new_instance['image_url'];

        return $instance;
    }
}

/**
 * Mailchimp Subscribe Widget Class
 * @since Forceful 1.0
 */
class Kopa_Widget_Mailchimp_Subscribe extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-newsletter-widget', 'description' => __('Display mailchimp newsletter subscription form', kopa_get_domain()));
        $control_ops = array('width' => '400', 'height' => 'auto');
        parent::__construct('kopa_widget_mailchimp_subscribe', __('Kopa Mailchimp Subscribe', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $mailchimp_form_action = $instance['mailchimp_form_action'];
        $mailchimp_enable_popup = $instance['mailchimp_enable_popup'];
        $description = $instance['description'];

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        if ( ! empty( $mailchimp_form_action ) ) :

        ?>

        <form action="<?php echo esc_url( $mailchimp_form_action ); ?>" method="post" class="newsletter-form clearfix" <?php echo $mailchimp_enable_popup ? 'target="_blank"' : ''; ?>>
            <p class="input-email clearfix">
                <input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="EMAIL" value="<?php _e( 'Your email here...', kopa_get_domain() ); ?>" class="email" size="40">
                <input type="submit" value="" class="submit">
            </p>
        </form>
        <p><?php echo $description; ?></p>

        <?php
        endif;
        
        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title'                  => '',
            'mailchimp_form_action'  => '',
            'mailchimp_enable_popup' => false,
            'description'            => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $form['mailchimp_form_action'] = $instance['mailchimp_form_action'];
        $form['mailchimp_enable_popup'] = $instance['mailchimp_enable_popup'];
        $form['description'] = $instance['description'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_form_action'); ?>"><?php _e('Mailchimp Form Action:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('mailchimp_form_action'); ?>" name="<?php echo $this->get_field_name('mailchimp_form_action'); ?>" type="text" value="<?php echo esc_attr($form['mailchimp_form_action']); ?>">
        </p>
        <p>
            <input type="checkbox" value="true" id="<?php echo $this->get_field_id( 'mailchimp_enable_popup' ); ?>" name="<?php echo $this->get_field_name( 'mailchimp_enable_popup' ); ?>" <?php checked( true, $form['mailchimp_enable_popup'] ); ?>>
            <label for="<?php echo $this->get_field_id( 'mailchimp_enable_popup' ); ?>"><?php _e( 'Enable <strong>evil</strong> popup mode', kopa_get_domain() ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', kopa_get_domain() ); ?></label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" rows="5"><?php echo esc_textarea( $form['description'] ); ?></textarea>
        </p>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['mailchimp_form_action'] = $new_instance['mailchimp_form_action'];
        $instance['mailchimp_enable_popup'] = (bool) $new_instance['mailchimp_enable_popup'] ? true : false;
        $instance['description'] = strip_tags( $new_instance['description'] );

        return $instance;
    }
}

/**
 * FeedBurner Subscribe Widget Class
 * @since Forceful 1.0
 */
class Kopa_Widget_Feedburner_Subscribe extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-newsletter-widget', 'description' => __('Display Feedburner subscription form', kopa_get_domain()));
        $control_ops = array('width' => '400', 'height' => 'auto');
        parent::__construct('kopa_widget_feedburner_subscribe', __('Kopa Feedburner Subscribe', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $feedburner_id = $instance['feedburner_id'];
        $description = $instance['description'];

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        if ( ! empty( $feedburner_id ) ) {

        ?>

        <form action="http://feedburner.google.com/fb/a/mailverify" method="post" class="newsletter-form clearfix" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( $feedburner_id ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">

            <input type="hidden" value="<?php echo esc_attr( $feedburner_id ); ?>" name="uri">

            <p class="input-email clearfix">
                <input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" value="<?php _e( 'Your email here...', kopa_get_domain() ); ?>" class="email" size="40">
                <input type="submit" value="" class="submit">
            </p>
        </form>

        <p><?php echo $description; ?></p>

        <?php
        } // endif
        
        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title'         => '',
            'feedburner_id' => '',
            'description'   => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $form['feedburner_id'] = $instance['feedburner_id'];
        $form['description'] = $instance['description'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Feedburner ID (http://feeds.feedburner.com/<strong>wordpress/kopatheme</strong>):', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo esc_attr($form['feedburner_id']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', kopa_get_domain() ); ?></label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" rows="5"><?php echo esc_textarea( $form['description'] ); ?></textarea>
        </p>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['feedburner_id'] = strip_tags( $new_instance['feedburner_id'] );
        $instance['description'] = strip_tags( $new_instance['description'] );

        return $instance;
    }
}

/**
 * Kopa Gallery Widget Class
 * @since Forceful 1.0
 */
class Kopa_Widget_Gallery extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-gallery-widget', 'description' => __('Display a carousel slider of all images in one gallery format post', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_gallery', __('Kopa Gallery', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle = $instance['subtitle'];
        $post_id = $instance['post_id'];

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . ' <span>' . $subtitle . '</span>' . $after_title;
        }

        $gallery_post = get_post( $post_id );

        $gallery_ids = kopa_content_get_gallery_attachment_ids( $gallery_post->post_content );
        
        if ( ! empty( $gallery_ids ) ) { 
        ?>

        <div class="list-carousel responsive">
            <ul class="kopa-gallery-carousel owl-carousel" data-scroll-items="<?php echo $instance['scroll_items'] ?>">
                <?php foreach ( $gallery_ids as $id ) { 
     
                    if ( ! wp_attachment_is_image( $id ) ) {
                        continue;
                    }

                    $full_image_src = wp_get_attachment_image_src( $id, 'full' );
                    $thumbnail_image = wp_get_attachment_image( $id, 'kopa-image-size-5' ); // 276 x 202
                    
                ?>
                    <li class="item">
                        <a rel="prettyPhoto[<?php echo $this->get_field_id( 'kp-gallery' ); ?>]" href="<?php echo $full_image_src[0]; ?>" title="<?php echo get_post_field( 'post_excerpt', $id ); ?>"><?php echo $thumbnail_image; ?></a>
                    </li>
                <?php } ?>
            </ul><!--kopa-featured-news-carousel-->
            
        </div><!--list-carousel-->

        <?php
        } // endif 
        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title'        => '',
            'subtitle'     => '',
            'post_id'      => null,
            'scroll_items' => 1
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $subtitle = strip_tags( $instance['subtitle'] );
        $form['post_id'] = $instance['post_id'];
        $form['scroll_items'] = $instance['scroll_items'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_id'); ?>"><?php _e('Select one gallery post:', kopa_get_domain()); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>">
                <?php 
                $gallery_posts = new WP_Query( array(
                    'tax_query' => array(
                        array(
                          'taxonomy' => 'post_format',
                          'field' => 'slug',
                          'terms' => 'post-format-gallery'
                        )
                    )
                ) );

                if ( $gallery_posts->have_posts() ) {
                    while ( $gallery_posts->have_posts() ) {
                        $gallery_posts->the_post();
                        ?>

                        <option value="<?php the_ID(); ?>" <?php selected( get_the_ID(), $form['post_id'] ); ?>><?php the_title(); ?></option>

                        <?php
                    }
                }

                wp_reset_postdata();
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('scroll_items'); ?>"><?php _e('Scroll Items:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('scroll_items'); ?>" name="<?php echo $this->get_field_name('scroll_items'); ?>" value="<?php echo esc_attr( $form['scroll_items'] ); ?>">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['post_id'] = $new_instance['post_id'];
        $instance['scroll_items'] = (int) $new_instance['scroll_items'];

        if ( 0 >= $instance['scroll_items'] ) {
            $instance['scroll_items'] = 1;
        }

        return $instance;
    }
}

/**
 * Combo widget class
 * @since Forceful 1.0
 */
class Kopa_Widget_Combo extends WP_Widget {
    function __construct() {
        $widget_ops = array( 'classname' => 'kopa-article-tab-widget', 'description' => __( 'Display your latest posts, popular view posts and popular comment posts', kopa_get_domain() ) );
        $control_ops = array( 'width' => 'auto', 'height' => 'auto' );
        parent::__construct( 'kopa_widget_combo', __( 'Kopa Combo Widget', kopa_get_domain() ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $query_args['posts_per_page'] = $instance['number_of_article'];
        $orderbys = array( 'lastest', 'popular', 'most_comment' );

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }
        ?>

        <div class="list-container-2">
            <ul class="tabs-2 clearfix">
                <li class="active"><a href="#<?php echo $this->get_field_id( 'tab' ) . '-lastest'; ?>"><?php _e( 'Latest', kopa_get_domain() ); ?></a></li>
                <li><a href="#<?php echo $this->get_field_id( 'tab' ) . '-popular'; ?>"><?php _e( 'Popular', kopa_get_domain() ); ?></a></li>
                <li><a href="#<?php echo $this->get_field_id( 'tab' ) . '-most_comment'; ?>"><?php _e( 'Comments', kopa_get_domain() ); ?></a></li>
            </ul><!--tabs-2-->
        </div>

        <div class="tab-container-2">

        <?php
        foreach ( $orderbys as $orderby ) {
            $query_args['orderby'] = $orderby;

            $posts = kopa_widget_posttype_build_query( $query_args );
            ?>

            <div class="tab-content-2" id="<?php echo $this->get_field_id( 'tab' ) . '-' . $orderby; ?>">                        
                <ul>
                <?php
                if ( $posts->have_posts() ) {
                    while ( $posts->have_posts() ) {
                        $posts->the_post();
                        ?>

                        <li>
                            <article class="entry-item clearfix">
                                <div class="entry-thumb">
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'kopa-image-size-4' ); // 81 x 81
                                    } elseif ( 'video' == get_post_format() ) {
                                        $video = kopa_content_get_video( get_the_content() );

                                        if ( isset( $video[0] ) ) {
                                            $video = $video[0];
                                        } else {
                                            $video = '';
                                        }

                                        if ( isset( $video['type'] ) && isset( $video['url'] ) ) {
                                            $video_thumbnail_url = kopa_get_video_thumbnails_url( $video['type'], $video['url'] );
                                            echo '<img src="'.esc_url( $video_thumbnail_url ).'" alt="'.get_the_title().'">';
                                        }
                                    } elseif ( 'gallery' == get_post_format() ) {
                                        $gallery_ids = kopa_content_get_gallery_attachment_ids( get_the_content() );

                                        if ( ! empty( $gallery_ids ) ) {
                                            foreach ( $gallery_ids as $id ) {
                                                if ( wp_attachment_is_image( $id ) ) {
                                                    echo wp_get_attachment_image( $id, 'kopa-image-size-4' ); // 81 x 81
                                                    break;
                                                }
                                            }
                                        }
                                    } // endif has_post_thumbnail
                                    ?>
                                </div>
                                <div class="entry-content">
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="meta-box">
                                        <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                                        <span class="entry-author"><?php _e( 'By', kopa_get_domain() ); ?> <?php the_author_posts_link(); ?></span>
                                    </div>
                                </div>
                            </article>
                        </li>

                        <?php
                    } // endwhile
                } // endif
                ?>
                </ul>
            </div>

            <?php
            wp_reset_postdata();
        } // endforeach
        ?>

        </div>

        <?php
        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title'             => '',
            'number_of_article' => 3,
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        $form['number_of_article'] = $instance['number_of_article'];
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', kopa_get_domain() ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'number_of_article' ); ?>"><?php _e( 'Number of articles', kopa_get_domain() ); ?></label>
            <input type="number" class="widefat" min="1" name="<?php echo $this->get_field_name( 'number_of_article' ); ?>" id="<?php echo $this->get_field_id( 'number_of_article' ); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>"> 
        </p>

        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['number_of_article'] = (int) $new_instance['number_of_article'];

        if ( 0 >= $instance['number_of_article'] ) {
            $instance['number_of_article'] = 3;
        }

        return $instance;
    }
}

/**
 * Lastest Comments Widget Class
 * Inherits from default recent comments widget class 
 * @since Forceful 1.0
 */
class Kopa_Widget_Lastest_Comments extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-latest-comments', 'description' => __( 'The most recent comments', kopa_get_domain() ) );
        parent::__construct('kopa_widget_lastest_comments', __( 'Kopa Recent Comments', kopa_get_domain() ), $widget_ops);
        $this->alt_option_name = 'kopa_widget_lastest_comments';

        add_action( 'comment_post', array($this, 'flush_widget_cache') );
        add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_recent_comments', 'widget');
    }

    function widget( $args, $instance ) {
        global $comments, $comment;

        $cache = wp_cache_get('kopa_widget_lastest_comments', 'widget');

        if ( ! is_array( $cache ) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        extract($args, EXTR_SKIP);
        $output = '';

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments', kopa_get_domain() );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 2;

        $comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
        $output .= $before_widget;
        if ( $title )
            $output .= $before_title . $title . $after_title;

        $output .= '<ul id="recentcomments">';
        if ( $comments ) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
            _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

            foreach ( (array) $comments as $comment) {
                $output .= '<li>
                                <article class="entry-item">
                                    <header>
                                        <a href="'.esc_url( get_comment_author_url($comment->comment_ID) ).'" class="commenter-name">'.get_comment_author().'</a>
                                        <a href="'.esc_url( get_comment_link($comment->comment_ID) ).'" class="entry-title">'.get_the_title($comment->comment_post_ID).'</a>
                                    </header>
                                    <div class="entry-thumb">
                                        <a href="'.esc_url( get_comment_link($comment->comment_ID) ).'">'.get_avatar( $comment, 50 ).'</a>
                                    </div>
                                    <div class="entry-content">
                                        '.get_comment_excerpt().'
                                    </div>
                                    <div class="clear"></div>
                                </article>
                            </li>';
            }
        }
        $output .= '</ul>';
        $output .= $after_widget;

        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('kopa_widget_lastest_comments', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = absint( $new_instance['number'] );
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_comments']) )
            delete_option('widget_recent_comments');

        return $instance;
    }

    function form( $instance ) {
        $title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
    ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', kopa_get_domain() ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:', kopa_get_domain() ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
    <?php
    }
} 

/**
 * Flickr widget class
 * @since Forceful 1.0
 */
class Kopa_Widget_Flickr extends WP_Widget {
    function __construct() {
        $widget_ops = array( 'classname' => 'kopa-widget-flickr', 'description' => __( 'Display your latest photos on Flickr', kopa_get_domain() ) );
        $control_ops = array( 'width' => 'auto', 'height' => 'auto' );
        parent::__construct( 'kopa_widget_flickr', __( 'Kopa Flickr Widget', kopa_get_domain() ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        
        ?>

        <div class="flickr-wrap clearfix" data-flickr_id="<?php echo $instance['flickr_id'] ?>" data-limit="<?php echo $instance['limit']; ?>">                    
            <ul class="kopa-flickr-widget clearfix"></ul>
        </div><!--flickr-wrap-->

        <?php
       

        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title'           => 'Flickr',
            'flickr_id' => '',
            'limit'           => 9,
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        $form['flickr_id'] = $instance['flickr_id'];
        $form['limit'] = $instance['limit'];
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', kopa_get_domain() ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e( 'Flickr ID', kopa_get_domain() ); ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" value="<?php echo esc_attr( $form['flickr_id'] ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of articles', kopa_get_domain() ); ?></label>
            <input type="number" min="1" class="widefat" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_id( 'limit' ); ?>" value="<?php echo esc_attr( $form['limit'] ); ?>">
        </p>

        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] ); 
        $instance['limit'] = (int) $new_instance['limit'];

        if ( 0 >= $instance['limit'] ) {
            $instance['limit'] = 9;
        }

        return $instance;
    }
}

/**
 * Socials widget class
 * @since Forceful 1.0
 */
class Kopa_Widget_Socials extends WP_Widget {
    function __construct() {
        $widget_ops = array( 'classname' => 'kopa-social-widget', 'description' => __( 'Display socials widget', kopa_get_domain() ) );
        $control_ops = array( 'width' => 'auto', 'height' => 'auto' );
        parent::__construct( 'kopa_widget_socials', __( 'Kopa Socials Widget', kopa_get_domain() ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        $dribbble_url = esc_url( kopa_get_option( 'kopa_theme_options_social_links_dribbble_url' ) );
        $gplus_url    = esc_url( kopa_get_option( 'kopa_theme_options_social_links_gplus_url' ) );
        $facebook_url = esc_url( kopa_get_option( 'kopa_theme_options_social_links_facebook_url' ) );
        $twitter_url  = esc_url( kopa_get_option( 'kopa_theme_options_social_links_twitter_url' ) );
        $rss_url      = kopa_get_option( 'kopa_theme_options_social_links_rss_url' );
        $flickr_url   = esc_url( kopa_get_option( 'kopa_theme_options_social_links_flickr_url' ) );
        $youtube_url  = esc_url( kopa_get_option( 'kopa_theme_options_social_links_youtube_url' ) );
        $social_link_target = kopa_get_option( 'kopa_theme_options_social_link_target' );
        ?>

        <ul class="clearfix">
            <!-- dribbble -->
            <?php if ( ! empty ( $dribbble_url ) ) { ?>
            <li><a href="<?php echo $dribbble_url; ?>" target="<?php echo $social_link_target; ?>"><?php echo KopaIcon::getIcon('dribbble'); ?></a></li>
            <?php } ?>

            <!-- google plus -->
            <?php if ( ! empty ( $gplus_url ) ) { ?>
                <li><a href="<?php echo $gplus_url; ?>" target="<?php echo $social_link_target; ?>"><?php echo KopaIcon::getIcon('google-plus'); ?></a></li>
            <?php } ?>

            <!-- facebook -->
            <?php if ( ! empty ( $facebook_url ) ) { ?>
                <li><a href="<?php echo $facebook_url; ?>" target="<?php echo $social_link_target; ?>"><?php echo KopaIcon::getIcon('facebook'); ?></a></li>
            <?php } ?>

            <!-- twitter -->
            <?php if ( ! empty ( $twitter_url ) ) { ?>
            <li><a href="<?php echo $twitter_url; ?>" target="<?php echo $social_link_target; ?>"><?php echo KopaIcon::getIcon('twitter'); ?></a></li>
            <?php } ?>

            <!-- rss -->
            <?php if ( $rss_url != 'HIDE' ) { 
                if ( empty( $rss_url ) ) {
                    $rss_url = get_bloginfo( 'rss2_url' );
                } else {
                    $rss_url = esc_url( $rss_url );
                }
            ?>
                <li><a href="<?php echo $rss_url; ?>" target="<?php echo $social_link_target; ?>"><?php echo KopaIcon::getIcon('rss'); ?></a></li>
            <?php } // endif ?>
            
            <!-- flickr -->
            <?php if ( ! empty ( $flickr_url ) ) { ?>
                <li><a href="<?php echo $flickr_url; ?>" target="<?php echo $social_link_target; ?>"><?php echo KopaIcon::getIcon('flickr'); ?></a></li>
            <?php } ?>

            <!-- youtube -->
            <?php if ( ! empty ( $youtube_url ) ) { ?>
                <li><a href="<?php echo $youtube_url; ?>" target="<?php echo $social_link_target; ?>"><?php echo KopaIcon::getIcon('youtube'); ?></a></li>
            <?php } ?>
        </ul>

        <?php
        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title'           => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', kopa_get_domain() ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
            <p><?php $theme_options_url = admin_url( 'admin.php?page=kopa_cpanel_theme_options' );
            echo sprintf( __( 'Go to your <a href="%1$s">Theme Options</a> &gt; <strong>Social Links</strong> to customize social urls', kopa_get_domain() ), $theme_options_url ); ?></p>
        </p>

        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }
}

