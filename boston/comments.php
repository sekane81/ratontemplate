<?php
	/**********************************************************************
	***********************************************************************
	PROPERSHOP COMMENTS
	**********************************************************************/
	
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ( 'Please do not load this page directly. Thanks!' );
	if ( post_password_required() ) {
		return;
	}
?>
<?php if ( comments_open() ) :?>


    <!-- row -->
    <div class="comments" id="comments">
    	<?php if( have_comments() ): ?>	    
            <!-- post comments -->
            <section class="post-comments col-md-12 clearfix">

                <!-- section header -->
                <div class="section-header">
                    <h3><?php _e( 'Comments', 'boston' ) ?></h3>
                </div>
                <!-- #section header -->

                <!-- comments -->
                <div class="comments">

						<?php 
						wp_list_comments( array(
							'type' => 'comment',
							'callback' => 'boston_comments',
							'end-callback' => 'boston_end_comments',
							'style' => 'div'
						)); 
						?>

		                <!-- pagination -->
						<?php
							$comment_links = paginate_comments_links( 
								array(
									'echo' => false,
									'type' => 'array',
									'prev_text' => '<i class="fa fa-arrow-left"></i>',
									'next_text' => '<i class="fa fa-arrow-right"></i>'
								) 
							);
							if( !empty( $comment_links ) ):
						?>					
			                <div class="custom-pagination">
			                    <ul class="pagination">
									<?php echo  boston_format_pagination( $comment_links ); ?>
								</ul>
							</div>
						<?php endif; ?>
		                <!-- .pagination -->

                </div>
                <!-- #comments -->

            </section>
    	<?php endif; ?>
    
        <!-- leave comment -->
        <section class="leave-comment col-md-12 clearfix">

            <!-- section header -->
            <div class="section-header">
                <h3><?php _e( 'Leave comment', 'boston' ) ?></h3>
            </div>
            <!-- #section header -->

            <div class="comment-respond">
				<?php
					$comments_args = array(
						'label_submit'	=>	__( 'Send Comment', 'coupon' ),
						'title_reply'	=>	'',
						'fields'		=>	apply_filters( 'comment_form_default_fields', array(
												'author' => '<div class="input-group">
                          										<input type="text" class="form-control" placeholder="'.esc_attr__( 'NAME', 'boston' ).'" name="author">
                        									</div>',
												'email'	 => '<div class="input-group">
                          										<input type="text" class="form-control" placeholder="'.esc_attr__( 'EMAIL', 'boston' ).'" name="email">
                        									</div>'
											)),
						'comment_field'	=>	'<div class="input-group">
												<textarea class="form-control" placeholder="'.esc_attr__( 'MESSAGE', 'boston' ).'" name="comment"></textarea>
        									</div>',
						'cancel_reply_link' => __( 'or cancel reply', 'coupon' ),
						'comment_notes_after' => '',
						'comment_notes_before' => ''
					);
					comment_form( $comments_args );	
				?> 
            </div>

        </section>
        <!-- #leave comment -->

    </div>
    <!-- .row -->

<?php endif; ?>



