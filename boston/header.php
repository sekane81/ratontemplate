<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="keywords" content="<?php echo esc_attr( boston_get_option( 'seo_keywords' ) ) ?>" />
<meta name="description" content="<?php echo esc_attr( boston_get_option( 'seo_description' ) ) ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<!-- Favicon -->
<?php 
$site_favicon = boston_get_option( 'site_favicon' );
if( !empty( $site_favicon ) ):
 ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_attr( $site_favicon['url'] ); ?>">
<?php endif; ?>
<?php 
if( is_single() ){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );    
    if( is_singular( 'offer' ) && !has_post_thumbnail() ){
        $store_id = get_post_meta( get_the_ID(), 'offer_store', true ); 
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $store_id ), 'post-thumbnail' );
    }
}
?>

<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php the_excerpt(); ?>" />

<meta name="twitter:title" content="<?php the_title(); ?>" />
<meta name="twitter:description" content="<?php the_excerpt(); ?>" />
<meta name="twitter:image" content="<?php echo !empty( $image ) ? esc_url( $image[0] ) : '' ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="preloader">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
</div>
<input type="hidden" class="enable_sticky" value="<?php echo esc_attr( boston_get_option( 'enable_sticky' ) ) ?>">
<div class="site-wrapper">
<?php 


$header_style = boston_get_option( 'header_style' );
switch( $header_style ){
    case 'style1': include( locate_template( 'includes/headers/header1.php' ) ); break;
    case 'style2': include( locate_template( 'includes/headers/header2.php' ) ); break;
    case 'style3': include( locate_template( 'includes/headers/header3.php' ) ); break;
    default: include( locate_template( 'includes/headers/header1.php' ) ); break;
}

if( is_home() ):
    $featured_posts = new WP_Query(array(
        'posts_per_page' => '-1',
        'post_status' => 'publish',
        'ignore_sticky_posts' => true,
        'post_type' => 'post',
        'meta_query' => array(
            array(
                'key' => 'fetured_post',
                'value' => 'yes',
                'compare' => '='
            )
        )
    ));
    $featured_visible_items = boston_get_option( 'featured_visible_items' );
    if( $featured_posts->have_posts() ):
    ?>
        <!-- slider -->
        <figure class="slider">
            <div id="main-slider" class="main-slider" data-featured_visible_items="<?php echo esc_attr( $featured_visible_items ) ?>">
                <?php while( $featured_posts->have_posts() ): $featured_posts->the_post(); ?>
                    <!-- slider item -->
                    <div class="item">
                        <div class="item-image">
                            <?php 
                            switch( $featured_visible_items ){
                                case '2' : $slider_size = 'slider-box-2'; break;
                                case '3' : $slider_size = 'slider-box-3'; break;
                                case '4' : $slider_size = 'slider-box-4'; break;
                                case '5' : $slider_size = 'slider-box-5'; break;
                                default : $slider_size = 'slider-box-3'; break;
                            }
                            the_post_thumbnail( $slider_size, array( 'class' => 'img-responsive' ) ) ?>
                        </div>

                        <a class="overlay" href="#"></a>

                        <div class="item-content <?php echo esc_attr( $slider_size ); ?>">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>

                            <div class="meta">
                                <a class="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                    <?php _e( 'by ', 'boston' ); echo get_the_author_meta( 'display_name' ); ?> 
                                </a>
                                <a class="date" href="<?php the_permalink() ?>#comments">
                                    <i class="fa fa-comment-o"></i><?php comments_number( 0, 1, '%' ); ?>
                                </a>
                                <a class="favourites-click" href="javascript:;" data-post_id="<?php the_ID(); ?>">
                                    <i class="fa fa-<?php echo boston_favourited_class(); ?>"></i><?php echo boston_get_favourites_count(); ?>
                                </a>  
                            </div>
                        </div>
                    </div>
                    <!-- #slider item -->                
                <?php endwhile; ?>

            </div>
        </figure>
        <!-- #slider -->
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php if( is_category() || is_tag() || is_author() || is_archive() || is_search() ): ?>
<h3 class="archive-title">
    <?php 
        if ( is_category() ){
            echo __('Category: ', 'timeliner');
            single_cat_title();
        }
        else if( is_tag() ){
            echo __('Search by tag: ', 'timeliner'). get_query_var('tag'); 
        }
        else if( is_author() ){
            ?>
                <div class="inner-widget text-center">

                    <!-- inner widget author -->
                    <div class="widget iw-author">
                        <div class="iw-image">
                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                <?php $avatar_url = boston_get_avatar_url( get_avatar( get_the_author_meta('ID'), 140 ) ); ?>
                                <img class="img-circle" src="<?php echo esc_url( $avatar_url ); ?>" alt="author"/>
                            </a>
                        </div>
                        <div class="iw-author-header">
                            <h5><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></h5>

                            <p><?php the_author_meta( 'description' ) ?></p>
                        </div>
                    </div>
                    <!-- #inner widget author -->

                    <?php
                    $user_id = get_the_author_meta('ID');
                    $facebook = get_user_meta( $user_id, 'facebook', true );
                    $twitter = get_user_meta( $user_id, 'twitter', true );
                    $google = get_user_meta( $user_id, 'google', true );
                    $pinterest = get_user_meta( $user_id, 'pinterest', true );
                    $tumblr = get_user_meta( $user_id, 'tumblr', true );
                    ?>
                    <!-- inner widget share post -->
                    <?php if( !empty( $facebook ) || !empty( $twitter ) || !empty( $google ) || !empty( $pinterest ) || !empty( $tumblr ) ): ?>
                    <div class="widget iw-share-post clearfix">

                        <ul class="list-unstyled list-inline"> 
                            <?php if( !empty( $facebook ) ): ?>
                                <li>
                                    <a class="facebook" href="<?php echo esc_url( $facebook ) ?>"><i class="fa fa-facebook"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty( $twitter ) ): ?>
                                <li>
                                    <a class="twitter" href="<?php echo esc_url( $twitter ) ?>"><i class="fa fa-twitter"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty( $google ) ): ?>
                                <li>
                                    <a class="google" href="<?php echo esc_url( $google ) ?>"><i class="fa fa-google-plus"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty( $pinterest ) ): ?>
                                <li>
                                    <a class="pinterest" href="<?php echo esc_url( $pinterest ) ?>"><i class="fa fa-pinterest"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty( $tumblr ) ): ?>
                                <li>
                                    <a class="tumblr" href="<?php echo esc_url( $tumblr ) ?>"><i class="fa fa-tumblr"></i></a>
                                </li>
                            <?php endif; ?>
                        </ul>

                    </div>
                    <?php endif; ?>
                    <!-- #inner widget share post -->

                </div>      
            <?php
        }
        else if( is_archive() ){
            echo __('Archive for ', 'timeliner'). single_month_title(' ',false); 
        }
        else if( is_search() ){ 
            echo __('Search results for: ', 'timeliner').' '. get_search_query();
        }
    ?>
</h3>
<?php endif; ?>