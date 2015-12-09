<?php
if ( !defined('ABSPATH')) exit;

// check if post is pwd protected
if ( post_password_required() || !comments_open() ) {
    return;
} // endif check pwd

if ( have_comments() ) { ?>  
    <div id="comments">
        <h4><?php comments_number(__('No Comments', kopa_get_domain()), __('1 Comment', kopa_get_domain()), __('% Comments', kopa_get_domain())); ?></h4>
        <ol class="comments-list clearfix">
            <?php
            wp_list_comments(array(
                'walker' => null,
                'style' => 'ul',
                'callback' => 'kopa_comments_callback',
                'end-callback' => null,
                'type' => 'all'
            ));
            ?>
        </ol>
        <center class="pagination kopa-comment-pagination"><?php paginate_comments_links(); ?></center>
        <div class="clear"></div>
    </div>
<?php } elseif ( ! comments_open() && post_type_supports(get_post_type(), 'comments') ) {
    return;
} // endif
comment_form(kopa_comment_form_args());

/*
 * Comments call back function
 */
function kopa_comments_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ( 'pingback' == get_comment_type() || 'trackback' == get_comment_type() ) { ?>

        <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment-wrap clearfix">
                
                <div class="comment-body clearfix">
                    <header class="clearfix">
                        
                        <span class="author"><?php _e( 'Pingback', kopa_get_domain() ); ?></span>

                        <?php if ( current_user_can( 'moderate_comments' ) ) {
                            edit_comment_link( __( 'Edit', kopa_get_domain() ) );    
                        } ?>

                    </header>

                    <p><?php comment_author_link(); ?></p>

                </div><!--comment-body -->

            </article>
        </li>

    <?php } elseif ( 'comment' == get_comment_type() ) { ?>

        <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">   


            <article id="comment-<?php comment_ID(); ?>" class="comment-wrap clearfix">
                <div class="comment-avatar">
                    <?php echo get_avatar($comment->comment_author_email, 69); ?>
                </div>
                <div class="comment-body clearfix">
                    <header class="clearfix">
                        
                        <span class="author"><?php comment_author(); ?></span>
                        
                        <span class="date"><?php comment_time( get_option('date_format') ); ?> <?php _e( 'at', kopa_get_domain() ); ?> <?php comment_time( get_option('time_format') ); ?>&nbsp;-&nbsp;</span>

                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?> 

                        <?php if ( current_user_can( 'moderate_comments' ) ) { ?>
                            <span>/</span>   
                            <?php edit_comment_link( __( 'Edit', kopa_get_domain() ) );    
                        } ?>

                    </header>
                    
                    <?php comment_text(); ?>

                </div><!--comment-body -->
            </article>   
        </li>

    <?php
    } // endif check comment type
}

function kopa_comment_form_args() {
    global $user_identity;
    $commenter = wp_get_current_commenter();

    $fields = array(
        'author' => '<p class="input-block">               
                <label class="required" for="comment_name" >' . __("Name <span>(required):</span>", kopa_get_domain()) . '</label>
                <input type="text" name="author" id="comment_name"                 
                value="' . esc_attr($commenter['comment_author']) . '">                                               
                </p>',
        'email' => '<p class="input-block">   
                <label for="comment_email" class="required">' . __("Email <span>(required):</span>", kopa_get_domain()) . '</label>                                            
                <input type="email" name="email" id="comment_email"                                                                 
                value="' . esc_attr($commenter['comment_author_email']) . '" >
                </p>',
        'url' => '<p class="input-block">   
                <label for="comment_url" class="required">' . __("Website", kopa_get_domain()) . '</label>                                                            
                <input type="url" name="url" id="comment_url"                 
                value="' . esc_attr($commenter['comment_author_url']) . '" >
                </p>'
    );

    $comment_field = '<p class="textarea-block">
        <label class="required" for="comment_message">' . __('Your comment <span>(required):</span>', kopa_get_domain()) . '</label>        
        <textarea name="comment" id="comment_message"></textarea>
        </p>';

    $args = array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field' => $comment_field,
        'must_log_in' => '<p class="alert">' . sprintf(__('You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', kopa_get_domain()), wp_login_url(get_permalink())) . '</p><!-- .alert -->',
        'logged_in_as' => '<p class="log-in-out">' . sprintf(__('Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', kopa_get_domain()), admin_url('profile.php'), esc_attr($user_identity)) . ' <a href="' . wp_logout_url(get_permalink()) . '" title="' . esc_attr__('Log out of this account', kopa_get_domain()) . '">' . __('Log out &raquo;', kopa_get_domain()) . '</a></p><!-- .log-in-out -->',
        'comment_notes_before' => '<span class="c-note">'.__('Your email address will not be published. Required fields are marked', kopa_get_domain()).' <strong>*</strong></span>',
        'comment_notes_after' => '',
        'id_form' => 'comments-form',
        'id_submit' => 'submit-comment',
        'title_reply' => __('Leave a reply', kopa_get_domain()),
        'title_reply_to' => __('Reply', kopa_get_domain()),
        'cancel_reply_link' => __('<span class="title-text">Cancel</span>', kopa_get_domain()),
        'label_submit' => __('Post Comment', kopa_get_domain()),
    );

    return $args;
}
