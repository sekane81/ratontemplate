<?php
class T20_Facebook_Widget extends WP_Widget {
	
	function __construct()
	{
		$widget_ops = array( 'classname' => 'facebook_like', 'description' => __('Adds support for Facebook Like Box.', 'T20') );
		$control_ops = array('id_base' => 'facebook-like-widget');
		parent::__construct('facebook-like-widget', __('T20 - Facebook Box', 'T20'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$page_url = $instance['page_url'];
		$width = $instance['width'];
		$color_scheme = $instance['color_scheme'];
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$show_stream = isset($instance['show_stream']) ? 'true' : 'false';
		$show_header = isset($instance['show_header']) ? 'true' : 'false';
		$height = '65';
		
		if($show_faces == 'true') {
			$height = '260';
		}
		
		if($show_stream == 'true') {
			$height = '600';
		}
		
		echo $before_widget; ?>
		<?php if($title) {
			echo $before_title.$title.$after_title;
		} else {
			?> <div class="widget clearfix"> <?php  
		}
		
		if($page_url): ?>
		<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($page_url); ?>&amp;width=<?php echo $width; ?>&amp;colorscheme=<?php echo $color_scheme; ?>&amp;show_faces=<?php echo $show_faces; ?>&amp;border_color=%23dddddd&amp;stream=<?php echo $show_stream; ?>&amp;header=<?php echo $show_header; ?>&amp;height=<?php echo $height; ?>" scrolling="no" frameborder="0" style="border:none; padding:0; overflow:hidden; width:100%; height: <?php echo $height; ?>px;" allowTransparency="true"></iframe>

		<?php endif;
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['page_url'] = $new_instance['page_url'];
		$instance['width'] = $new_instance['width'];
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['show_stream'] = $new_instance['show_stream'];
		$instance['show_header'] = $new_instance['show_header'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Find us on Facebook', 'page_url' => '', 'width' => '260', 'color_scheme' => 'light', 'show_faces' => 'on', 'show_stream' => false, 'show_header' => false);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'T20'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('page_url'); ?>"><?php _e('Facebook Page URL:', 'T20'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" value="<?php echo esc_attr($instance['page_url']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Color Scheme:', 'T20'); ?></label> 
			<select id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>" class="widefat" style="width:100%;">
				<option <?php if ('light' == $instance['color_scheme']) echo 'selected="selected"'; ?>><?php _e('light', 'T20'); ?></option>
				<option <?php if ('dark' == $instance['color_scheme']) echo 'selected="selected"'; ?>><?php _e('dark', 'T20'); ?></option>
			</select>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e('Show faces', 'T20'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_stream'], 'on'); ?> id="<?php echo $this->get_field_id('show_stream'); ?>" name="<?php echo $this->get_field_name('show_stream'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_stream'); ?>"><?php _e('Show stream', 'T20'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_header'], 'on'); ?> id="<?php echo $this->get_field_id('show_header'); ?>" name="<?php echo $this->get_field_name('show_header'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_header'); ?>"><?php _e('Show facebook header', 'T20'); ?></label>
		</p>
	<?php
	}
}
?>