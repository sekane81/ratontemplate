<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Flickr Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays your projects from flickr.com
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'CT_load_flickr_widgets');

function CT_load_flickr_widgets()
{
	register_widget('CT_Flickr_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Flickr_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_Flickr_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'ct_flickr_widget', 'description' => __( 'CT: Flickr Widget', 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_flickr_widget' );

		/* Create the widget. */		
		$this->WP_Widget( 'ct_flickr_widget', 'CT: Flickr Widget ', $widget_ops);
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		if ( !is_admin() ) {
			/* Flickr */
			wp_register_script('jquery-flickr',get_template_directory_uri().'/js/jflickrfeed.min.js',false, null , true);
			wp_enqueue_script('jquery-flickr',array('jquery'));
		}

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$user_id = $instance['user_id'];
		$num_images = $instance['num_images'];
		$image_size = $instance['image_size'];
		$feed_type = $instance['feed_type'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START FLICKR WIDGET -->\n";
			echo $before_title.$title.$after_title;
		} else {
			echo "\n<!-- START FLICKR WIDGET -->\n";
		}

		// Display widget
		$time_id = rand();	
		?>

		<!-- <style>
			[class^="ct-flickr-"] li a img { width: <?php echo $image_size . 'px'; ?>; height: <?php echo $image_size . 'px'; ?>; }
		</style> -->

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery.noConflict()(function($){
			$(document).ready(function() {
				$(".ct-flickr-<?php echo $time_id; ?>").jflickrfeed({
					limit: <?php echo $instance['num_images']; ?>,
					feedapi:"<?php echo $instance['feed_type']; ?>",
					qstrings: {
						id: "<?php echo $instance['user_id']; ?>"
					},
					itemTemplate: '<li>'+
								'<a rel="prettyPhoto[flickr]" href="{{image_b}}" title="{{title}}">' +
								'<img src="{{image_s}}" alt="{{title}}" />' +
								'</a>' +
								'</li>'
				},  function(data) {
						$('.ct-flickr-<?php echo $time_id; ?> a').prettyPhoto({
							animationSpeed: 'normal', /* fast/slow/normal */
							opacity: 0.80, /* Value between 0 and 1 */
							showTitle: true, /* true/false */
							deeplinking: false,
							theme:'light_square'
						});
				});

				$('[class^="ct-flickr-"] li a img').css("width",<?php echo '"'.$image_size.'px'.'"'; ?>);
				$('[class^="ct-flickr-"] li a img').css("height",<?php echo '"'.$image_size.'px'.'"'; ?>);
			});
		});
		/* ]]> */
		</script>		

		<ul class="ct-flickr-<?php echo $time_id; ?> thumbs clearfix"></ul>

	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	echo "\n<!-- END FLICKR WIDGET -->\n";
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['user_id'] = stripslashes( $new_instance['user_id']);
	$instance['num_images'] = stripslashes( $new_instance['num_images']);
	$instance['image_size'] = stripslashes( $new_instance['image_size']);
	$instance['feed_type'] = $new_instance['feed_type'];

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => __( 'Flickr' , 'color-theme-framework' ),
		'user_id' => '52617155@N08',
		'num_images' => '8',
		'image_size' => '75',
		'feed_type' => 'photos_public.gne'
	);
	
	$instance = wp_parse_args((array) $instance, $defaults); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'color-theme-framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('User ID:', 'color-theme-framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['user_id'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'num_images' ); ?>"><?php _e('The number of displayed images:', 'color-theme-framework') ?></label>
		<input type="number" min="1" max="50" class="widefat" id="<?php echo $this->get_field_id( 'num_images' ); ?>" name="<?php echo $this->get_field_name( 'num_images' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['num_images'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e('Image size (height/width):', 'color-theme-framework') ?></label>
		<input type="number" min="1" max="75" class="widefat" id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['image_size'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'feed_type' ); ?>"><?php _e('Feed type:', 'color-theme-framework'); ?></label> 
		<select id="<?php echo $this->get_field_id( 'feed_type' ); ?>" name="<?php echo $this->get_field_name( 'feed_type' ); ?>" class="widefat" style="width:100%;">
			<option <?php if ( 'photos_public.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>photos_public.gne</option>
			<option <?php if ( 'photos_friends.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>photos_friends.gne</option>
			<option <?php if ( 'photos_faves.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>photos_faves.gne</option>
			<option <?php if ( 'groups_pool.gne' == $instance['feed_type'] ) echo 'selected="selected"'; ?>>groups_pool.gne</option>				
		</select>
	</p>
	<?php
	}
}
?>