<?php

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header>
        <span class="entry-categories"><?php echo KopaIcon::getIcon('star', 'span'); ?><?php the_category( ', ' ); ?></span>
        <span class="entry-box-icon"><?php echo KopaIcon::getIcon('music', 'span'); ?></span>
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

    <div class="entry-thumb">
        <?php 
        $audio = kopa_content_get_audio( get_the_content() );
        
        if ( isset( $audio[0] ) ) {
            $audio = $audio[0];
        } else {
            $audio = '';
        }
        
        if ( isset( $audio['shortcode'] ) ) {
            echo do_shortcode( $audio['shortcode'] );
        }
        ?>
    </div>

    <div class="elements-box">
        <?php $content = get_the_content(); 
        $content = preg_replace( '/\[audio.*].*\[\/audio]/', '', $content );
        $content = preg_replace( '/\[audio.*]/', '', $content );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;
        ?>
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