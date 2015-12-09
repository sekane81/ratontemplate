<?php
class T20_soundcloud extends WP_Widget {
function __construct() {
	$widget_ops = array('classname' => 'tt-soundcloud', 'description' => '');
	$control_ops = array('id_base' => 'tt-soundcloud');
	parent::__construct('tt-soundcloud', __('T20 - Soundcloud', 'T20'), $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
	extract( $args );
	$title = apply_filters('widget_title', $instance['title'] );
	$url = $instance['url'];
	$autoplay = $instance['autoplay'];
	$play = 'false';
	if( !empty( $autoplay )) $play = 'true';

	echo $before_widget;
	if($title) {
		echo $before_title.$title.$after_title;
	} else {
		?> <div class="widget clearfix"> <?php  
	}
?>
	<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $url; ?>&amp;auto_play=<?php echo $play; ?>&amp;show_artwork=true"></iframe>
<?php
	echo $after_widget;
}
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['url'] = $new_instance['url'] ;
	$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
	return $instance;
}
function form( $instance ) {
	$defaults = array( 
		'title' => 'SoundCloud', 
		'url' => '', 
		'play' => '', 
		'autoplay' => ''  
	);
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'T20'); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e('URL :', 'T20'); ?></label>
		<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" type="text" class="widefat" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e('Autoplay :', 'T20'); ?></label>
		<input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( $instance['autoplay'] ) echo 'checked="checked"'; ?> type="checkbox" />
	</p>
<?php
}

}