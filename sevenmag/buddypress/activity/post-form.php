<?php

/**
 * BuddyPress - Activity Post Form
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<form action="<?php bp_activity_post_form_action(); ?>" method="post" id="whats-new-form" name="whats-new-form" role="complementary">

	<?php do_action( 'bp_before_activity_post_form' ); ?>

	<?php 
	if ( bp_is_group() ){
		$greetings = sprintf( __( "What's new in %s, %s?", 'T20' ), bp_get_group_name(), bp_get_user_firstname() );
	}else{
		$greetings = sprintf( __( "What's new, %s?", 'T20' ), bp_get_user_firstname() );
	}
	?>

	<div  id="whats-new-content">
		<div  id="whats-new-textarea">
			<textarea name="whats-new" placeholder="<?php echo $greetings; ?>" id="whats-new" cols="50" rows="2"><?php if ( isset( $_GET['r'] ) ) : ?>@<?php echo esc_attr( $_GET['r'] ); ?> <?php endif; ?></textarea>
		</div>

		<div class="clearfix row" id="whats-new-options">
			
			<div class="col-md-6">
				<div id="whats-new-submit" class="pull-left">
					<input class="btn btn-primary" type="submit" name="aw-whats-new-submit" id="aw-whats-new-submit" value="<?php _e( 'Post Update', 'T20' ); ?>" />
				</div>
			</div>

			<?php if ( bp_is_active( 'groups' ) && !bp_is_my_profile() && !bp_is_group() ) : ?>
			<div class="col-md-6">
				<div class="pull-right" id="whats-new-post-in-box">
					<div class="col-md-3">
						<div class="pull-right" id="post-in-label">
							<strong><?php _e( 'In', 'T20' ); ?>:</strong> 
						</div>
					</div>
					
					<div class="col-md-9 what-new-post-in-container">
						<div class="row">
						<select id="whats-new-post-in" name="whats-new-post-in">
							<option selected="selected" value="0"><?php _e( 'My Profile', 'T20' ); ?></option>
		
							<?php if ( bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100&populate_extras=0' ) ) :
								while ( bp_groups() ) : bp_the_group(); ?>
		
									<option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>
		
								<?php endwhile;
							endif; ?>
						</select>
						</div>
					</div>
					
				</div>
				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
			</div>
			<?php elseif ( bp_is_group_home() ) : ?>

				<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
				<input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

			<?php endif; ?>
			<div class="clear">
				<?php do_action( 'bp_activity_post_form_options' ); ?>
			</div>
		</div><!-- #whats-new-options -->
	</div><!-- #whats-new-content -->

	<?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
	<?php do_action( 'bp_after_activity_post_form' ); ?>

</form><!-- #whats-new-form -->
