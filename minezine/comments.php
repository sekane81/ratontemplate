<?php
/**
 * The template for displaying Comments.
 * @package MineZine
 * @since MineZine 1.0.0
*/
if ( post_password_required() )
	return;
?>
<?php global $minezine_options_db; ?>

<div id="comments" class="comments-area<?php if ( $minezine_options_db['minezine_next_preview_post'] == 'Display' || $minezine_options_db['minezine_next_preview_post'] == '' ) { ?> comments-area-post<?php } ?>">

	<?php if ( have_comments() ) : ?>
    <h2 class="entry-headline"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'minezine' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'minezine_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-wrapper">
      <p class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'minezine' ) ); ?> </p>
			<p class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'minezine' ) ); ?></p>
      </div>
		</div>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'minezine' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php $placeholder_name = __( 'Your name' , 'minezine' );
   $placeholder_web = __( 'Website' , 'minezine' );
   $placeholder_comment = __( 'Comment...' , 'minezine' );
   $aria_req = ( $req ? " aria-required='true'" : '' );
   $field_req = ( $req ? " *" : '' );
   $comment_args = array(
'title_reply'=>__( 'Leave a Comment' , 'minezine' ),
'fields' => apply_filters( 'comment_form_default_fields', array(
'author' => '<p class="comment-form-author">' . '<label for="author">' . __( '', 'minezine' ) . '</label> ' . '<input id="author" name="author" type="text" placeholder="' . $placeholder_name . $field_req . '" value=""  size="30"' . $aria_req . ' /></p>',   
'email'  => '<p class="comment-form-email">' .
'<label for="email">' . __( '', 'minezine' ) . '</label> ' .
'<input id="email" name="email" type="text" placeholder="E-mail' . $field_req .'" value="" size="30"' . $aria_req . ' />'.'</p>',
'url'    => '<p class="comment-form-url">' .
'<label for="url">' . __( '', 'minezine' ) . '</label> ' .
'<input id="url" name="url" type="text" placeholder="' . $placeholder_web . '" value="" size="30" />'.'</p>' ) ),
'comment_field' => '<p>' .
'<label for="comment">' . __( '', 'minezine' ) . '</label>' .
'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . $placeholder_comment . '"></textarea>' .
'</p>',);
comment_form($comment_args); ?>

</div><!-- #comments .comments-area -->