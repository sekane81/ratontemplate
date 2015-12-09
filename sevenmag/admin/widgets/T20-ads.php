<?php

// Widget class
	class tt_125ad_widget extends WP_Widget {
	
		function __construct() {
		
			/* General widget settings */
			$widget_ops = array( 'classname' => 'tt_125ad_widget', 'description' => __('A widget that displays ads in sidebar.', 'T20') );
	
			/* Widget control settings */
			$control_ops = array( 'height' => 350, 'id_base' => 'tt_125ad_widget' );
	
			/* Create widget */
			parent::__construct( 'tt_125ad_widget', __('T20 - Ads', 'T20'), $widget_ops, $control_ops );
		}

/* Display The Widget ----------------------------------------------------------*/
	
		function widget( $args, $instance ) {
			extract( $args );
			
			$title = apply_filters('widget_title', $instance['title'] );
	
			/* Variables from settings. */
			$ad1 = $instance['ad1'];
			$adlink1 = $instance['adlink1'];
			$ad2 = $instance['ad2'];
			$adlink2 = $instance['adlink2'];
			$ad3 = $instance['ad3'];
			$adlink3 = $instance['adlink3'];
			$ad4 = $instance['ad4'];
			$adlink4 = $instance['adlink4'];
			$ad5 = $instance['ad5'];
			$adlink5 = $instance['adlink5'];
			$ad6 = $instance['ad6'];
			$adlink6 = $instance['adlink6'];
	
			/* Display The Widget */
			?>
	        
		<?php 
			if ( is_rtl() ) { 
				$righter = 'lefter';
			} else {
				$righter = 'righter';
			}
		$allads = array(); ?>

		<div class="ads_widget introfx clearfix">
			<?php if ( $title ) echo '<span>'.$title.'</span>' ?>

				<?php if ( $adlink1 && $ad1 )
					$ads[] = '<a href="' . $adlink1 . '" target="_blank"><img src="'. $ad1 .'" width="260" height="125" alt="" /></a>';
				
				// Display Ad 2
				if ( $adlink2 && $ad2 )
					$ads[] = '<a href="' . $adlink2 . '" target="_blank"><img src="'. $ad2 .'" width="260" height="125" alt="" /></a>';
					
				// Display Ad 3
				if ( $adlink3 && $ad3 )
					$ads[] = '<a href="' . $adlink3 . '" target="_blank"><img src="' . $ad3 . '" width="125" height="125" alt="" /></a>';
					
				// Display Ad 4
				if ( $adlink4 && $ad4)
					$ads[] = '<a href="' . $adlink4 . '" target="_blank" class="'.$righter.'"><img src="' . $ad4 . '" width="125" height="125" alt="" /></a>';
					
				// Display Ad 5
				if ( $adlink5 && $ad5)
					$ads[] = '<a href="' . $adlink5 . '" target="_blank"><img src="' . $ad5 . '" width="125" height="125" alt="" /></a>';
					
				// Display Ad 6
				if ( $adlink6 && $ad6)
					$ads[] = '<a href="' . $adlink6 . '" target="_blank" class="'.$righter.'"><img src="' . $ad6 . '" width="125" height="125" alt="" /></a>';
				
				//Display ads
				foreach($ads as $ad){
					echo $ad;
				} ?>
		</div>

<?php
	}

/*----------------------------------------------------------*/
/*	Update the Widget
/*----------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Remove HTML: */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* Variables from settings. */
		$instance['ad1'] = $new_instance['ad1'] ;
		$instance['adlink1'] = $new_instance['adlink1'];
		$instance['ad2'] = $new_instance['ad2'];
		$instance['adlink2'] = $new_instance['adlink2'];
		$instance['ad3'] = $new_instance['ad3'] ;
		$instance['adlink3'] = $new_instance['adlink3'];
		$instance['ad4'] = $new_instance['ad4'] ;
		$instance['adlink4'] = $new_instance['adlink4'];
		$instance['ad5'] = $new_instance['ad5'] ;
		$instance['adlink5'] = $new_instance['adlink5'];
		$instance['ad6'] = $new_instance['ad6'] ;
		$instance['adlink6'] = $new_instance['adlink6'];				
	
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
		'title' => 'SPONSORS',
		'random' => false,
		'ad1' => get_template_directory_uri()."/images/260x125.jpg",
		'adlink1' => 'http://themeforest.net/user/T20/portfolio?ref=T20',
		'ad2' => '',
		'adlink2' => '',
		'ad3' => get_template_directory_uri()."/images/125x125.jpg",
		'adlink3' => 'http://themeforest.net/user/T20/portfolio?ref=T20',
		'ad4' => get_template_directory_uri()."/images/125x125.jpg",
		'adlink4' => 'http://themeforest.net/user/T20/portfolio?ref=T20',
		'ad5' => '',
		'adlink5' => '',
		'ad6' => '',
		'adlink6' => ''
		
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Ads Title (Optional):', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ad1' ); ?>">
        <?php _e('Ad 1 Image URL: 260x125', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>" value="<?php echo $instance['ad1']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'adlink1' ); ?>">
        <?php _e('Ad 1 Link:', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'adlink1' ); ?>" name="<?php echo $this->get_field_name( 'adlink1' ); ?>" value="<?php echo $instance['adlink1']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ad2' ); ?>">
        <?php _e('Ad 2 Image URL: 260x125', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>" value="<?php echo $instance['ad2']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'adlink2' ); ?>">
        <?php _e('Ad 2 Link:', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'adlink2' ); ?>" name="<?php echo $this->get_field_name( 'adlink2' ); ?>" value="<?php echo $instance['adlink2']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ad3' ); ?>">
        <?php _e('Ad 3 Image URL: 125x125', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>" value="<?php echo $instance['ad3']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'adlink3' ); ?>">
        <?php _e('Ad 3 Link:', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'adlink3' ); ?>" name="<?php echo $this->get_field_name( 'adlink3' ); ?>" value="<?php echo $instance['adlink3']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ad4' ); ?>">
        <?php _e('Ad 4 Image URL: 125x125', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>" value="<?php echo $instance['ad4']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'adlink4' ); ?>">
        <?php _e('Ad 4 Link:', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'adlink4' ); ?>" name="<?php echo $this->get_field_name( 'adlink4' ); ?>" value="<?php echo $instance['adlink4']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ad5' ); ?>">
        <?php _e('Ad 5 Image URL: 125x125', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'ad5' ); ?>" name="<?php echo $this->get_field_name( 'ad5' ); ?>" value="<?php echo $instance['ad5']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'adlink5' ); ?>">
        <?php _e('Ad 5 Link:', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'adlink5' ); ?>" name="<?php echo $this->get_field_name( 'adlink5' ); ?>" value="<?php echo $instance['adlink5']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'ad6' ); ?>">
        <?php _e('Ad 6 Image URL: 125x125', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'ad6' ); ?>" name="<?php echo $this->get_field_name( 'ad6' ); ?>" value="<?php echo $instance['ad6']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'adlink6' ); ?>">
        <?php _e('Ad 6 Link:', 'T20') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'adlink6' ); ?>" name="<?php echo $this->get_field_name( 'adlink6' ); ?>" value="<?php echo $instance['adlink6']; ?>" />
</p>
<?php
	}
}
?>