<?php
class T20_Video extends WP_Widget {
	function __construct() {
		parent::__construct( false, __('T20 - Video', 'T20'), array('description' => __('Display a responsive video by adding a link or embed code.', 'T20'), 'classname' => 'widget_T20_video') );;	
	}
	public function widget($args, $instance) {
		extract( $args );
		$instance['title']?NULL:$instance['title']='';
		$title = apply_filters('widget_title',$instance['title']);
		$output = $before_widget."\n";
		if($title) {
			$output .= $before_title.$title.$after_title;
		} else {
			$output .= '<div class="widget clearfix">';
		}
		ob_start();	

		if ( !empty($instance['video_url']) ) {
			// echo '<div class="video-container">'; - We have a filter adding this to embed shortcode
			global $wp_embed;
			$video = $wp_embed->run_shortcode('[embed]'.$instance['video_url'].'[/embed]');
			// echo '</div>';
		} 
		elseif ( !empty($instance['video_embed_code']) ) {
			echo '<div class="video-container introfx">';
			$video = $instance['video_embed_code'];
			echo '</div>';
		} else {
			$video = '';
		}
		echo $video; 

		
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = esc_attr($new['title']);
		$instance['video_url'] = esc_url($new['video_url']);
		$instance['video_embed_code'] = $new['video_embed_code'];
		return $instance;
	}

	public function form($instance) {
		$defaults = array(
			'title' 			=> 'Video Widget',
			'video_url' 		=> '',
			'video_embed_code' 	=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
	
	<div class="T20-options-video">
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'T20'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("video_url"); ?>"><?php _e('Video URL', 'T20'); ?></label>
			<input style="width:100%;" id="<?php echo $this->get_field_id("video_url"); ?>" name="<?php echo $this->get_field_name("video_url"); ?>" type="text" value="<?php echo esc_url($instance["video_url"]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("video_embed_code"); ?>"><?php _e('Video Embed Code', 'T20'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('video_embed_code'); ?>" name="<?php echo $this->get_field_name('video_embed_code'); ?>"><?php echo $instance["video_embed_code"]; ?></textarea>
		</p>
	</div>
<?php
}
}
