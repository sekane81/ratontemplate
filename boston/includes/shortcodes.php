<?php

class Shortcodes{
	
	function __construct(){
		add_action( 'init', array( $this, 'shortcode_buttons' ) );
		add_action('wp_ajax_shortcode_call', array( $this, 'shortcode_options' ) );
		add_action('wp_ajax_nopriv_shortcode_call', array( $this, 'shortcode_options' ) );
	}

	function shortcode_buttons(){
		add_filter( "mce_external_plugins", array( $this, "add_buttons" ) );
	    add_filter( 'mce_buttons', array( $this, 'register_buttons' ) );	
	}
	

	function add_buttons( $plugin_array ) {
	    $plugin_array['boston'] = get_template_directory_uri() . '/js/shortcodes.js';
	    return $plugin_array;
	}

	function register_buttons( $buttons ) {
	    array_push( $buttons, 'bostongrid', 'bostonelements' ); 
	    return $buttons;
	}

	function shortcode_options(){
		$shortcode = $_POST['shortcode'];
		echo  $this->$shortcode();
		die();
	}


	function render_options( $fields ){
		$fields_html = '';
		foreach( $fields as $field ){
			if( !in_array( $field['type'], array( 'css_editor', 'textarea_html' ) ) ){
				$fields_html .= '<div class="shortcode-option"><label>'.$field['heading'].'</label>';
				switch ( $field['type'] ){
					case 'textfield' : 
						$fields_html .= '<input type="text" class="shortcode-field" name="'.$field['param_name'].'" value="'.$field['value'].'">';
						break;
					case 'dropdown' :
						$options = '';
						if( !empty( $field['value'] ) ){
							foreach( $field['value'] as $option_name => $option_value ){
								$options .= '<option value="'.$option_value.'">'.$option_name.'</option>';
							}
						}
						$fields_html .= '<select name="'.$field['param_name'].'" class="shortcode-field">'.$options.'</select>';
						break;
					case 'multidropdown' :
						$options = '';
						if( !empty( $field['value'] ) ){
							foreach( $field['value'] as $option_name => $option_value ){
								$options .= '<option value="'.$option_value.'">'.$option_name.'</option>';
							}
						}
						$fields_html .= '<select name="'.$field['param_name'].'" class="shortcode-field" multiple>'.$options.'</select>';
						break;
					case 'colorpicker' :
						$fields_html .= '<input type="text" name="'.$field['param_name'].'" class="shortcode-field shortcode-colorpicker" value="'.$field['value'].'" />';
						break;
					case 'attach_image' :
						$fields_html .= '<div class="shortcode-image-holder"></div><div class="clearfix"></div>
										<a href="javascript:;" class="shortcode-add-image button">'.__( 'Add Image', 'boston' ).'</a>
										<input type="hidden" name="'.$field['param_name'].'" class="shortcode-field" valu="'.$field['value'].'">';
						break;	
					case 'attach_images' :
						$fields_html .= '<div class="shortcode-images-holder"></div><div class="clearfix"></div>
										<a href="javascript:;" class="shortcode-add-images button">'.__( 'Add Images', 'boston' ).'</a>
										<input type="hidden" name="'.$field['param_name'].'" class="shortcode-field" value="'.$field['value'].'">';
						break;
					case 'textarea' :					
						$fields_html .= '<textarea name="'.$field['param_name'].'" class="shortcode-field">'.$field['value'].'</textarea>';
						break;
					case 'textarea_raw_html' :					
						$fields_html .= '<textarea name="'.$field['param_name'].'" class="shortcode-field">'.$field['value'].'</textarea>';
						break;						
				}
				$fields_html .= '<div class="description">'.$field['description'].'</div></div>';
			}
		}


		echo  $fields_html.'<a href="javascript:;" class="shortcode-save-options button">'.__( 'Insert', 'boston' ).'</a>';
		die();

	}
	/* FUNCTIONS FOR THE boston GRID */
	function row(){
		echo '';
		die();
	}
	function column(){
		$fields = $this->render_options( boston_column_params() );
	}
	function accordion(){
		$fields = $this->render_options( boston_accordion_params() );
	}
	function alert(){
		$fields = $this->render_options( boston_alert_params() );
	}
	function button(){
		$fields = $this->render_options( boston_button_params() );
	}
	function gap(){
		$fields = $this->render_options( boston_gap_params() );
	}	
	function bg_gallery(){
		$fields = $this->render_options( boston_bg_gallery_params() );
	}
	function icon(){
		$fields = $this->render_options( boston_icon_params() );
	}
	function iframe(){
		$fields = $this->render_options( boston_iframe_params() );
	}
	function label(){
		$fields = $this->render_options( boston_label_params() );
	}
	function progress_bar(){
		$fields = $this->render_options( boston_progressbar_params() );
	}
	function tabs(){
		$fields = $this->render_options( boston_tabs_params() );
	}
	function toggle(){
		$fields = $this->render_options( boston_toggle_params() );
	}
}

new Shortcodes();

?>