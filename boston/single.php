<?php
/*==================
 SINGLE BLOG POST
==================*/

get_header();
the_post();


$blog_listing_single_layout = boston_get_option( 'blog_listing_single_layout' );
?>

<main class="<?php echo esc_attr( $blog_listing_single_layout ) ?>">

        <div class="container">
            <div class="row">

                <?php if( $blog_listing_single_layout == 'left_sidebar' ): ?>
                    <!-- sidebar -->
                    <div class="col-md-3 no-padding">
                        <aside class="sidebar">

                           <?php get_sidebar(); ?>

                        </aside>
                    </div>
                    <!-- #sidebar -->                    
                <?php endif; ?>
                <!-- single -->
                <div class="col-md-9 no-padding">

                    <!-- post single -->
                    <div class="col-md-12">
                        <section class="post-single clearfix">

                            <!-- post -->
                            <article class="post clearfix">

                                <!-- post image -->
                                <?php if( boston_has_media() ){
                                    $post_format = get_post_format();
                                    $image_size = 'post-thumbnail';
                                    include( locate_template( 'media/media'.( $post_format ? '-'.$post_format : '' ).'.php' ) );
                                }?>
                                <!-- #post image -->

                                <div class="row">
                                    <?php 
                                    if( $blog_listing_single_layout == 'right_sidebar' ){
                                        include( locate_template( 'includes/single-author-sidebar.php' ) );
                                    }
                                    ?>

                                    <!-- post content -->
                                    <div class="col-md-9 no-padding">
                                        <div class="post-content">

                                            <h1><?php the_title(); ?></h1>
                                            <ul class="list-unstyled list-inline post-meta">
                                                <li><i class="fa fa-clock-o"></i><?php the_time( 'F j, Y' ); ?></li>
                                                <li><i class="fa fa-folder-o"></i><?php echo boston_categories_list() ?></li>
                                            </ul>
                                            <?php the_content(); ?>
                                            <!-- inner widget share post -->
                                            <div class="widget iw-share-post clearfix">

                                                <ul class="list-unstyled list-inline">
                                                    <li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    <li><a class="twitter" href="http://twitter.com/intent/tweet?text=<?php echo rawurlencode( get_permalink() ); ?>"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li><a class="google" href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>"><i class="fa fa-google-plus"></i></a>
                                                    </li>
                                                    <li>
                                                    <?php
                                                    $image = '';
                                                    if( has_post_thumbnail() ){
                                                        $image =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                                        $image = $image[0];
                                                    }
                                                    ?>
                                                    <a class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;media=<?php echo esc_url( $image ); ?>"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a class="tumblr" href="http://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>"><i class="fa fa-tumblr"></i></a></li>
                                                </ul>

                                            </div>
                                            <!-- #inner widget share post -->                                            
                                        </div>
                                        <div class="single-tags">
                                            <i class="fa fa-tag"></i><?php echo boston_tags_list() ?>
                                        </div>                                        
                                        <!-- #post content -->

                                    </div>

                                    <?php 
                                    if( $blog_listing_single_layout == 'left_sidebar' ){
                                        include( locate_template( 'includes/single-author-sidebar.php' ) );
                                    }
                                    ?>

                                </div>

                            </article>
                            <!-- #post -->

                        </section>
                        <!-- #post single  -->

                    </div>
                    <?php
                    $similar_cats = wp_get_post_categories( get_the_ID() );
                    $similar_posts = new WP_Query(array(
                        'post_status' => 'publish',
                        'posts_per_page' => '4',
                        'post_type' => 'post',
                        'ignore_sticky_posts' => true,
                        'category__in' => $similar_cats
                    ));
                    if( $similar_posts->have_posts() ){
                        echo '<div class="col-md-12 similar_posts"><h3 class="related-posts-title">'.__( 'Related Posts', 'boston' ).'</h3><div class="row">';
                        while( $similar_posts->have_posts() ){
                            $similar_posts->the_post();
                            ?>
                            <div class="col-md-3 no-padding">
                                <div class="popular-post">
                                    <div class="pp-image">
                                        <?php the_post_thumbnail( 'slider-box-5', array( 'class' => 'img-responsive' ) ) ?>
                                    </div>

                                    <a href="javascript:;" class="overlay"></a>

                                    <div class="pp-header">
                                        <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                        <span class="author"><?php _e( 'by ', 'boston' ) ?>
                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                                <?php 
                                                $name = get_the_author_meta( 'display_name' );
                                                if( strlen( $name ) > 15 ){
                                                    $name = substr( $name, 0, 15 );
                                                    $name .= '...';
                                                }
                                                echo esc_html( $name );
                                                ?>
                                            </a>
                                        </span>
                                        <span class="comments">
                                            <a href="<?php the_permalink() ?>#comments">
                                                <i class="fa fa-comment-o"></i><?php comments_number( 0, 1, '%' ); ?>
                                            </a>
                                        </span>
                                        <span class="favourites">
                                            <a href="javascript:;" class="favourites-click" data-post_id="<?php the_ID() ?>">
                                                <i class="fa fa-<?php echo boston_favourited_class(); ?>"></i><?php echo boston_get_favourites_count(); ?>
                                            </a>
                                        </span>
                                    </div>
                                </div>                                
                            </div>
                            <?php
                        }
                        echo '</div></div>';
                    }
                    wp_reset_postdata();
                    ?>
                    <?php comments_template( '', true ) ?>

                </div>
                <!-- #single -->

                <?php if( $blog_listing_single_layout == 'right_sidebar' ): ?>
                    <!-- sidebar -->
                    <div class="col-md-3 no-padding">
                        <aside class="sidebar">

                           <?php get_sidebar(); ?>

                        </aside>
                    </div>
                    <!-- #sidebar -->
                <?php endif; ?>

            </div>
        </div>

    </main>
    <!-- #main content -->

<?php
get_footer();
?>