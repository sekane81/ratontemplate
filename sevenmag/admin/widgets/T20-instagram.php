<?php
class T20_instagram extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_instagram', 'description' => __('Displays photos from Instagram', 'T20') );
		parent::__construct( 'instagram', __('T20 - Instagram', 'T20'), $widget_ops );


	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Photos on Instagram' : $instance['title'], $instance, $this->id_base );
		$user_id = $instance['user_id'];
		$show = (int)$instance['show'];
		if ( $show < 1 ) {
			$show = 1;
		}
		if ( !empty( $user_id ) ) {
			echo $before_widget;
			if($title) {
				echo $before_title.$title.$after_title;
			} else {
				?> <div class="widget clearfix"> <?php  
			}

		$id = mt_rand(99, 999);	
?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#instagram_feed_<?php echo $id; ?>").photostream_widget({
				  	user: "<?php echo $user_id; ?>",
				  	limit:<?php echo $show; ?>,
					social_network: "instagram"
				});
			});
		</script>
		<div id="instagram_feed_<?php echo $id; ?>" class="instagram_widget clearfix"></div>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['user_id'] = $new_instance['user_id'];
		$instance['show'] = (int) $new_instance['show'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$user_id = isset( $instance['user_id'] ) ? esc_attr( $instance['user_id'] ) : '';
		$show = isset( $instance['show'] ) ? absint( $instance['show'] ) : 5;
		
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'T20'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('Username :', 'T20'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" type="text" value="<?php echo $user_id; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php _e('Number of Photos :', 'T20'); ?></label>
		<input size="6" id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" type="text" value="<?php echo $show; ?>" /></p>
	

<?php
	}
}
        
/***************************************************/