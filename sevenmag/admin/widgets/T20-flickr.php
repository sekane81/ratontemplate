<?php

class T20_flickr extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'T20_flickr_widgets', 'description' => 'Displays Flickr gallery' );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'T20_flickr_widgets' );
		parent::__construct('T20_flickr_widgets', 'T20 - Flickr Widget', $widget_ops);
	}
	
	function form($instance) {
	$defaults = array(
		'title' => 'Flickr Photostream',
		'id' => '7388060@N08',
		'type' => 'user',
		'number' => '9',
		'shorting' => 'latest',
	);
	$instance = wp_parse_args( (array) $instance, $defaults );

	$title = $instance['title']; 
	$id = $instance['id']; 
	$type = $instance['type']; 
	$number = $instance['number'];
	$shorting = $instance['shorting']; ?>
	
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('id'); ?>">Flikr ID: ( idgettr.com ) </label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('type'); ?>">Type: </label>
		<select class="widefat" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" >
			<option value="user" <?php if($type == 'user' || $type == ''){echo 'selected="selected"';} ?> >User</option>
			<option value="group" <?php if($type == 'group'){echo 'selected="selected"';} ?> >Group</option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('shorting'); ?>">Sorting: </label>
		<select class="widefat" id="<?php echo $this->get_field_id('shorting'); ?>" name="<?php echo $this->get_field_name('shorting'); ?>" >
			<option value="latest" <?php if($shorting == 'latest' || $shorting == ''){echo 'selected="selected"';} ?> >Latest Photos</option>
			<option value="random" <?php if($shorting == 'random'){echo 'selected="selected"';} ?> >Random</option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('number'); ?>">Flickr Count: </label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
	</p>
	<?php
	}
  
/*-----------------------------------------------------------------------------------*/
/*	Update The Widget With New Options
/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['shorting'] = strip_tags( $new_instance['shorting'] );
		return $instance;
	}
	
/*-----------------------------------------------------------------------------------*/
/*	Display The Widget To The Front End
/*-----------------------------------------------------------------------------------*/
	function widget($args, $instance) {
	global $wpdb;
		extract($args, EXTR_SKIP);
 			
		//Widget title, entered in the widget settings
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		
		/* Custom Options */
		$number = $instance['number'];
		$shorting = $instance['shorting'];
		$type = $instance['type'];
		$id = $instance['id'];
		
		// Before widget - as defined in your specific theme. */
		echo $before_widget;
		
		/* Display The Widget */
		// Widget code goes here (Edit if you want)
		if (!empty($title))
		
		echo $before_title . $title . $after_title;
				
		/* Create a new query */
		$query = "SELECT * from $wpdb->comments WHERE comment_approved= '1'
		ORDER BY comment_date DESC LIMIT 0, $number";
		$comments = $wpdb->get_results($query);

		//Send our widget options to the query
			if( $id ) : ?>
				<div class="flickr-widget">
					<script type="text/javascript" src="<?php echo '//www.flickr.com/badge_code_v2.gne?count=' . $number . '&amp;display=' . $shorting . '&amp;&amp;layout=x&amp;source=' . $type . '&amp;' . $type . '=' . $id . '&amp;size=s'; ?>"></script> 
				</div>
				<div class="clearfix"></div>
			<?php endif;
		echo $after_widget;
	}
 
}
?>