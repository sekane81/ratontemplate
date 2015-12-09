<?php
function boston_label_func( $atts, $content ){
	extract( shortcode_atts( array(
		'text' => '',
		'bg_color' => '',
		'font_color' => '',
	), $atts ) );

	return '<span class="label label-default" style="color: '.$font_color.'; background-color: '.$bg_color.'">'.$text.'</span>';
}

add_shortcode( 'label', 'boston_label_func' );

function boston_label_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text","boston"),
			"param_name" => "text",
			"value" => '',
			"description" => __("Input label text.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color Color","boston"),
			"param_name" => "bg_color",
			"value" => '',
			"description" => __("Select background color of the label.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text Color","boston"),
			"param_name" => "font_color",
			"value" => '',
			"description" => __("Select font color for the label text.","boston")
		),

	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Label", 'boston'),
	   "base" => "label",
	   "category" => __('Content', 'boston'),
	   "params" => boston_label_params()
	) );
}

?>