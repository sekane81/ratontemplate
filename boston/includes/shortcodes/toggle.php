<?php
function boston_toggle_func( $atts, $content ){
	extract( shortcode_atts( array(
		'title' => '',
		'toggle_content' => '',
		'state' => '',
	), $atts ) );

	$rnd = boston_random_string();

	return '
		<div class="panel-group" id="accordion_'.$rnd.'" role="tablist" aria-multiselectable="true">
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="heading_'.$rnd.'">
		      <div class="panel-title">
		        <a class="'.( $state == 'in' ? '' : 'collapsed' ).'" data-toggle="collapse" data-parent="#accordion_'.$rnd.'" href="#coll_'.$rnd.'" aria-expanded="true" aria-controls="coll_'.$rnd.'">
		        	'.$title.'
		        	<i class="fa fa-chevron-circle-down animation"></i>
		        </a>
		      </div>
		    </div>
		    <div id="coll_'.$rnd.'" class="panel-collapse collapse '.$state.'" role="tabpanel" aria-labelledby="heading_'.$rnd.'">
		      <div class="panel-body">
		        '.apply_filters( 'the_content', $toggle_content ).'
		      </div>
		    </div>
		  </div>
		</div>';
}

add_shortcode( 'toggle', 'boston_toggle_func' );

function boston_toggle_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title","boston"),
			"param_name" => "title",
			"value" => '',
			"description" => __("Input toggle title.","boston")
		),
		array(
			"type" => "textarea_raw_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content","boston"),
			"param_name" => "toggle_content",
			"value" => '',
			"description" => __("Input toggle title.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Default State","boston"),
			"param_name" => "state",
			"value" => array(
				__( 'Closed', 'boston' ) => '',
				__( 'Opened', 'boston' ) => 'in',
			),
			"description" => __("Select default toggle state.","boston")
		),

	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Toggle", 'boston'),
	   "base" => "toggle",
	   "category" => __('Content', 'boston'),
	   "params" => boston_toggle_params()
	) );
}

?>