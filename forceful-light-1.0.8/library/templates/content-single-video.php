<?php

$kopa_display_featured_image = kopa_get_option( 'kopa_theme_options_featured_image_status' );
$kopa_post_thumbnail_style = kopa_get_option( 'kopa_theme_options_post_thumbnail_style' );

if ( 'small' == $kopa_post_thumbnail_style && 'show' == $kopa_display_featured_image && has_post_thumbnail() ) {
    echo '<div class="kopa-single-2">';
} // endif
?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( 'show' == $kopa_display_featured_image && 'small' == $kopa_post_thumbnail_style && has_post_thumbnail() ) { ?>
            <div class="entry-thumb">
                <?php the_post_thumbnail( 'kopa-image-size-8' ); // 795 x 429 ?>
            </div>
        <?php } // endif ?>

        <header>
            <span class="entry-categories"><?php echo KopaIcon::getIcon('star', 'span'); ?><?php the_category( ', ' ); ?></span>
            <span class="entry-box-icon"><?php echo KopaIcon::getIcon('pencil', 'span'); ?></span>
            <div class="entry-box-title clearfix">
                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="meta-box">
                    <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                    <span class="entry-author"><?php _e( 'By', kopa_get_domain() ); ?> <?php the_author_posts_link(); ?></span>
                    <?php if(comments_open()){ ?>
                    <span class="entry-comments"><?php echo KopaIcon::getIcon('comment', 'span'); ?><?php ?><?php comments_popup_link( '0', '1', '%'); ?></span>
                    <?php } ?>
                    <?php 
                    $kopa_total_view = get_post_meta( get_the_ID(), 'kopa_' . kopa_get_domain() . '_total_view', true );

                    if ( 'show' == kopa_get_option('kopa_theme_options_view_count_status') && $kopa_total_view ) {
                    ?>
                        <span class="entry-view"><?php echo KopaIcon::getIcon('view', 'span'); ?><?php echo $kopa_total_view; ?></span>
                    <?php } // endif ?>
                </div>
                <!-- meta-box -->
               
                <div class="clear"></div>
            </div>
            <!-- entry-box-title -->
            <div class="clear"></div>
        </header>
        <?php if ( 'show' == $kopa_display_featured_image && 'large' == $kopa_post_thumbnail_style ) { ?>
            <div class="entry-thumb">
                <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large' ); // 795 x auto
                } ?>
            </div>
        <?php } // endif ?>

        <div class="elements-box">
            <?php the_content(); ?>
        </div>
        <div class="clear"></div>

        <div class="wp-link-pages clearfix">
            <?php wp_link_pages( array(
                'before'   => '<p>',
                'after'    => '</p>',
                'pagelink' => __( 'Page %', kopa_get_domain() )
            ) ); ?>
        </div> <!-- .wp-link-pages -->


        <?php kopa_get_socials_link(); ?>
        <!-- social-link -->
        
        <footer class="clearfix">
            <?php get_template_part( 'library/templates/template', 'post-navigation' ); ?>
        </footer>
    </div>
    <!-- entry-box -->

<?php 
if ( 'small' == $kopa_post_thumbnail_style && 'show' == $kopa_display_featured_image && has_post_thumbnail() ) {
    echo '</div> <!-- .kopa-single-2 -->';
} // endif
?>