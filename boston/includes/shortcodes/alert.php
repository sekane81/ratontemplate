<?php
function boston_alert_func( $atts, $content ){
	extract( shortcode_atts( array(
		'text' => '',
		'border_color' => '',
		'bg_color' => '',
		'font_color' => '',
		'icon' => '',
		'closeable' => 'no',
		'close_icon_color' => '',
		'close_icon_color_hvr' => '',
	), $atts ) );

	$rnd = boston_random_string();

	$style_css = '
		<style>
			.'.$rnd.'.alert .close{
				color: '.$close_icon_color.';
			}
			.'.$rnd.'.alert .close:hover{
				color: '.$close_icon_color_hvr.';
			}
		</style>
	';

	return boston_shortcode_style( $style_css ).'
	<div class="alert '.$rnd.' alert-default '.( $closeable == 'yes' ? 'alert-dismissible' : '' ).'" role="alert" style=" color: '.$font_color.'; border-color: '.$border_color.'; background-color: '.$bg_color.';">
		'.( !empty( $icon ) && $icon !== 'No Icon' ? '<i class="fa fa-'.$icon.'"></i>' : '' ).'
		'.$text.'
		'.( $closeable == 'yes' ? '<button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> <span class="sr-only">'.__( 'Close', 'boston' ).'</span> </button>' : '' ).'
	</div>';
}

add_shortcode( 'alert', 'boston_alert_func' );

function boston_alert_params(){
	return array(
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text","boston"),
			"param_name" => "text",
			"value" => '',
			"description" => __("Input alert text.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Border Color","boston"),
			"param_name" => "border_color",
			"value" => '',
			"description" => __("Select border color for the alert box.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color Color","boston"),
			"param_name" => "bg_color",
			"value" => '',
			"description" => __("Select background color of the alert box.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text Color","boston"),
			"param_name" => "font_color",
			"value" => '',
			"description" => __("Select font color for the alert box text.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Icon","boston"),
			"param_name" => "icon",
			"value" => boston_awesome_icons_list(),
			"description" => __("Select icon.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Closeable","boston"),
			"param_name" => "closeable",
			"value" => array(
				__( 'No', 'boston' ) => 'no',
				__( 'Yes', 'boston' ) => 'yes'
			),
			"description" => __("Enable or disable alert closing.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Close Icon Color","boston"),
			"param_name" => "close_icon_color",
			"value" => '',
			"description" => __("Select color for the close icon.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Close Icon Color On Hover","boston"),
			"param_name" => "close_icon_color_hvr",
			"value" => '',
			"description" => __("Select color for the close icon on hover.","boston")
		),
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Alert", 'boston'),
	   "base" => "alert",
	   "category" => __('Content', 'boston'),
	   "params" => boston_alert_params()
	) );
}
?>