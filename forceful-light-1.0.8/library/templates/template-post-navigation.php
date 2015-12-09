<?php 
$prev_post = get_previous_post(); 

if ( ! empty( $prev_post ) ) { ?>
    <div class="prev-post">
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><span>&laquo;</span>&nbsp;<?php _e( 'Previous Article', kopa_get_domain() ); ?></a>
        <p>
            <a class="article-title" href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a>
            <span class="entry-date"><?php echo get_the_time( get_option( 'date_format' ), $prev_post->ID ); ?></span>
            <span class="entry-author"><?php _e( 'By', kopa_get_domain() ); ?> <a href="<?php echo get_author_posts_url( $prev_post->post_author ); ?>"><?php the_author_meta( 'display_name', $prev_post->post_author ); ?></a></span>
        </p>
    </div>
<?php } // endif ?>

<?php
$next_post = get_next_post();
if ( ! empty( $next_post ) ) { ?>
    <div class="next-post">
        <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php _e( 'Next Article', kopa_get_domain() ); ?>&nbsp;<span>&raquo;</span></a>
        <p>
            <a class="article-title" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
            <span class="entry-date"><?php echo get_the_time( get_option( 'date_format' ), $next_post->ID ); ?></span>
            <span class="entry-author"><?php _e( 'By', kopa_get_domain() ); ?> <a href="<?php echo get_author_posts_url( $next_post->post_author ); ?>"><?php the_author_meta( 'display_name', $next_post->post_author ); ?></a></span>
        </p>
    </div>
<?php } // endif ?>