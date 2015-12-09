<?php
class T20_subscribe_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_subscribe', 'description' => __('Displays RSS Email Subscription Form', 'T20') );
		parent::__construct( 't20_subscribe_feed_widget', __('T20 - RSS Email Subscription', 'T20'), $widget_ops);
	}
	function form($instance) {	
		$instance = wp_parse_args( (array) $instance, array('title' => 'Subscribe to RSS Feeds', 'subscribe_text' => 'Get all latest content delivered to your email a few times a month.', 'feedid' => '', 'placeholder' => 'Your Email', 'feedbtn' => 'Sign Up') );
		$title = esc_attr($instance['title']);
		$feedid = $instance['feedid'];
		$feedbtn = $instance['feedbtn'];
		$placeholder = $instance['placeholder'];
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">
			<?php _e('Title', 'T20'); ?>
		</label>			
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
		
	<p>
		<label for="<?php echo $this->get_field_id( 'subscribe_text' ); ?>"><?php _e('Text:', 'T20'); ?></label>
		<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'subscribe_text' ); ?>" name="<?php echo $this->get_field_name( 'subscribe_text' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['subscribe_text'] ), ENT_QUOTES)); ?></textarea>
	</p>
		
	<p>
		<label for="<?php echo $this->get_field_id('feedbtn'); ?>"><?php _e('Button title:', 'T20'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedbtn'); ?>" name="<?php echo $this->get_field_name('feedbtn'); ?>" type="text" value="<?php echo $feedbtn; ?>" />
	</p>
		
	<p>
		<label for="<?php echo $this->get_field_id('placeholder'); ?>"><?php _e('Placeholder:', 'T20'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo $placeholder; ?>" />
	</p>
		
	<p>
		<label for="<?php echo $this->get_field_id('feedid'); ?>"><?php _e('Feedburner ID:', 'T20'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedid'); ?>" name="<?php echo $this->get_field_name('feedid'); ?>" type="text" value="<?php echo $feedid; ?>" />
	</p>
<?php
    }

	function update($new_instance, $old_instance) {
		$instance=$old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['feedid'] = $new_instance['feedid'];
		$instance['feedbtn'] = $new_instance['feedbtn'];
		$instance['placeholder'] = $new_instance['placeholder'];
		$instance['subscribe_text'] = $new_instance['subscribe_text'];
		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;
		$feedid = $instance['feedid'];	
		$feedbtn = $instance['feedbtn'];	
		$placeholder = $instance['placeholder'];	
		$subscribe_text = $instance['subscribe_text'];	
		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		} else {
			?> <div class="widget clearfix"> <?php  
		}
	?>
		<p><?php echo $subscribe_text; ?></p>
		<form class="widget_rss_subscription" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedid; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input type="text" placeholder="<?php echo $placeholder; ?>" name="email" required />
			<input type="hidden" value="<?php echo $feedid; ?>" name="uri"/>
			<input type="hidden" name="loc" value="en_US"/>
			<button type="submit" id="submit" value="Subscribe"><span><?php echo $feedbtn; ?></span></button>
		</form>
        
	<?php
		echo $after_widget;
	}
}
?>