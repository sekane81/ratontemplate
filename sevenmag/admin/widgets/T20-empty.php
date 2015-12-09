<?php

// Widget class
	class T20_empty extends WP_Widget {
		function __construct() {
			parent::__construct( false, __('T20 - Empty widget', 'T20'), array('description' => __('A empty widget area for content and codes.', 'T20'), 'classname' => 'tt_empty') );;	
		}

/* Display The Widget ----------------------------------------------------------*/
	
		function widget( $args, $instance ) {
			extract( $args );
			
			$content = apply_filters('widget_content', $instance['content'] );
	
			/* Variables from settings. */
			$content = $instance['content'];
	
			$allads = array(); ?>

			<div class="empty_widget introfx clearfix">
				<?php if ( $content )
					echo $content; 
				?>
			</div>

		<?php
	}

/*----------------------------------------------------------*/
/*	Update the Widget
/*----------------------------------------------------------*/
	public function update($new,$old) {
		$instance = $old;
		$instance['content'] = $new['content'] ;	
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	public function form($instance) {
		$defaults = array(
			'content' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
			<p>
			  <label for="<?php echo $this->get_field_id( 'content' ); ?>">
			        <?php _e('Content or Code', 'T20') ?>
			    </label>
			    <textarea id="<?php echo $this->get_field_id( 'content' ); ?>" style="width: 100%;height: 110px;" name="<?php echo $this->get_field_name( 'content' ); ?>"><?php echo $instance['content']; ?></textarea>
			</p>
		<?php
	}
}
?>