<ul class="entry-list">
    <?php 
    if ( have_posts() ) { 
        while( have_posts() ) { 
            the_post(); 

            if ( 'video' == get_post_format() ) {
                $kopa_data_icon = 'video'; // icon-film-2
            } elseif ( 'gallery' == get_post_format() ) {
                $kopa_data_icon = 'images'; // icon-images
            } elseif ( 'audio' == get_post_format() ) {
                $kopa_data_icon = 'music'; // icon-music
            } else {
                $kopa_data_icon = 'pencil'; // icon-pencil
            }
    ?>
    <li id="li-post-<?php the_ID(); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class('entry-item clearfix'); ?>>
            <div class="entry-thumb">
                <?php 
                // flag to determine whether or not display arrow button
                $kopa_has_printed_thumbnail = false;

                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'kopa-image-size-6' ); // 496 x 346
                    $kopa_has_printed_thumbnail = true;
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
                        $kopa_has_printed_thumbnail = true;
                    }
                } elseif ( 'gallery' == get_post_format() ) {
                    $gallery_ids = kopa_content_get_gallery_attachment_ids( get_the_content() );

                    if ( ! empty( $gallery_ids ) ) {
                        foreach ( $gallery_ids as $id ) {
                            if ( wp_attachment_is_image( $id ) ) {
                                echo wp_get_attachment_image( $id, 'kopa-image-size-6' ); // 496 x 346
                                $kopa_has_printed_thumbnail = true;
                                break;
                            }
                        }
                    }
                } // endif has_post_thumbnail
                ?>

                <?php if ( $kopa_has_printed_thumbnail  ) { ?>
                    <a href="<?php the_permalink(); ?>"><?php echo KopaIcon::getIcon('long-arrow-right'); ?></a>
                <?php } // endif ?>
            </div>
            <!-- entry-thumb -->
            <div class="entry-content">
                <header>

                    <?php // show categories only for post  
                    if ( 'post' == $post->post_type ) { ?>
                        <span class="entry-categories"><?php echo KopaIcon::getIcon('star', 'span'); ?><?php the_category(', '); ?></span>
                    <?php } // endif ?>

                    <h4 class="entry-title clearfix">

                        <?php if ( 'post' == $post->post_type ) { ?>
                            <?php echo KopaIcon::getIcon($kopa_data_icon , 'span'); ?>
                        <?php } // endif ?>

                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <div class="meta-box">
                        <span class="entry-date"><a href="<?php echo get_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>

                        <?php if ( 'post' == $post->post_type ) { ?>
                            <span class="entry-author"><?php _e( 'By', kopa_get_domain() ); ?> <?php the_author_posts_link(); ?></span>
                        <?php } // endif ?>
                        
                        <?php if(comments_open()){ ?>
                    <span class="entry-comments"><?php echo KopaIcon::getIcon('comment', 'span'); ?><?php ?><?php comments_popup_link( '0', '1', '%'); ?></span>
                    <?php } ?>

                        <?php $kopa_total_view_count = get_post_meta( get_the_ID(), 'kopa_' . kopa_get_domain() . '_total_view', true );

                        if ( 'show' == kopa_get_option('kopa_theme_options_view_count_status') && $kopa_total_view_count ) { ?>

                        <span class="entry-view"><?php echo KopaIcon::getIcon('view', 'span'); ?><?php echo $kopa_total_view_count; ?></span>

                        <?php } ?>
                    </div>
                    <!-- meta-box -->
                    
                    <div class="clear"></div>
                </header>
                <?php the_excerpt(); ?>
            </div>
            <!-- entry-content -->
        </article>
        <!-- entry-item -->
    </li>
    <?php 
        } // endwhile
    } // endif
    ?>
</ul>
<!-- entry-list -->

<!-- pagination -->
<?php get_template_part('library/templates/template', 'pagination'); ?>