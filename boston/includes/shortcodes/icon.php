<?php
function boston_icon_func( $atts, $content ){
	extract( shortcode_atts( array(
		'icon' => '',
		'color' => '',
		'size' => '',
	), $atts ) );

	return '<span class="fa fa-'.$icon.'" style="color: '.$color.'; font-size: '.$size.'; margin: 0px 2px;"></span>';
}

add_shortcode( 'icon', 'boston_icon_func' );

function boston_icon_params(){
	return array(
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Select Icon","boston"),
			"param_name" => "icon",
			"value" => boston_awesome_icons_list(),
			"description" => __("Select an icon you want to display.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Icon Color","boston"),
			"param_name" => "color",
			"value" => '',
			"description" => __("Select color of the icon.","boston")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Icon Size","boston"),
			"param_name" => "size",
			"value" => '',
			"description" => __("Input size of the icon.","boston")
		),

	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Icon", 'boston'),
	   "base" => "icon",
	   "category" => __('Content', 'boston'),
	   "params" => boston_icon_params()
	) );
}

?>