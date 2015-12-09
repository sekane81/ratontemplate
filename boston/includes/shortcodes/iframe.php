<?php
function boston_iframe_func( $atts, $content ){
	extract( shortcode_atts( array(
		'link' => '',
		'proportion' => '',
	), $atts ) );

	$random = boston_random_string();

	return '
		<div class="embed-responsive embed-responsive-'.$proportion.'">
		  <iframe class="embed-responsive-item" src="'.esc_url( $link ).'"></iframe>
		</div>';
}

add_shortcode( 'iframe', 'boston_iframe_func' );

function boston_iframe_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Iframe link","boston"),
			"param_name" => "link",
			"value" => '',
			"description" => __("Input link you want to embed.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Iframe Proportion","boston"),
			"param_name" => "proportion",
			"value" => array(
				__( '4 by 3', 'boston' ) => '4by3',
				__( '16 by 9', 'boston' ) => '16by9',
			),
			"description" => __("Select iframe proportion.","boston")
		),

	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Iframe", 'boston'),
	   "base" => "iframe",
	   "category" => __('Content', 'boston'),
	   "params" => boston_iframe_params()
	) );
}

?>