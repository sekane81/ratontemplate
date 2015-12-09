<?php
function boston_gap_func( $atts, $content ){
	extract( shortcode_atts( array(
		'height' => '',
	), $atts ) );

	return '<span style="height: '.esc_attr( $height ).'; display: block;"></span>';
}

add_shortcode( 'gap', 'boston_gap_func' );

function boston_gap_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Gap Height","boston"),
			"param_name" => "height",
			"value" => '',
			"description" => __("Input gap height.","boston")
		),
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Gap", 'boston'),
	   "base" => "gap",
	   "category" => __('Content', 'boston'),
	   "params" => boston_gap_params()
	) );
}
?>