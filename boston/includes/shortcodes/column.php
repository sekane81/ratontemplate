<?php
function boston_column_func( $atts, $content ){
	extract( shortcode_atts( array(
		'md' => '12'
	), $atts ) );

	return '<div class="col-md-'.$md.'">'.do_shortcode( $content ).'</div>';
}

add_shortcode( 'column', 'boston_column_func' );

function boston_column_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Column Size","boston"),
			"param_name" => "md",
			"value" => '12',
			"description" => __("Input column size. min 1 max 12. Sum of these numbers in a row must be 12.","boston")
		),
	);
}
?>