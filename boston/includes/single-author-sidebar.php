<!-- inner sidebar -->
<div class="col-md-3 no-padding">
    <aside class="inner-widget text-center">

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

                <p><?php 
                $blog_single_author_desc_length = boston_get_option( 'blog_single_author_desc_length' );
                $desc = get_the_author_meta( 'description' );
                if( strlen( $desc ) > $blog_single_author_desc_length && !empty( $blog_single_author_desc_length ) ){
                    $desc = mb_substr( $desc, 0, $blog_single_author_desc_length ).'...';
                }

                echo wp_kses_post( $desc );

                ?></p>
            </div>
        </div>
        <!-- #inner widget author -->
    </aside>
</div>
<!-- #inner sidebar -->