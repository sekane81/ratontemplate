<?php
function boston_button_func( $atts, $content ){
	extract( shortcode_atts( array(
		'text' => '',
		'link' => '',
		'target' => '',
		'bg_color' => '',
		'bg_color_hvr' => '',
		'border_radius' => '',
		'icon' => '',
		'font_color' => '',
		'font_color_hvr' => '',
		'size' => 'normal',
		'align' => '',
		'btn_width' => 'normal',
		'inline' => 'no',
		'margin' => ''
	), $atts ) );

	$rnd = boston_random_string();

	$style_css = '
	<style>
		a.'.$rnd.', a.'.$rnd.':active, a.'.$rnd.':visited, a.'.$rnd.':focus{
			display: '.( $btn_width == 'normal' ? 'inline-block' : 'block' ).';
			'.( !empty( $bg_color ) ? 'background-color: '.$bg_color.';' : '' ).'
			'.( !empty( $font_color ) ? 'color: '.$font_color.';' : '' ).'
			'.( !empty( $border_radius ) ? 'border-radius: '.$border_radius : '' ).'
		}
		a.'.$rnd.':hover{
			display: '.( $btn_width == 'normal' ? 'inline-block' : 'block' ).';
			'.( !empty( $bg_color_hvr ) ? 'background-color: '.$bg_color_hvr.';' : '' ).'
			'.( !empty( $font_color_hvr ) ? 'color: '.$font_color_hvr.';' : '' ).'
		}		
	</style>
	';

	return boston_shortcode_style( $style_css ).'
	<div class="btn-wrap" style="margin: '.esc_attr( $margin ).'; text-align: '.$align.'; '.( $inline == 'yes' ? 'display: inline-block;' : '' ).' '.( $inline == 'yes' && $align == 'right' ? 'float: right;' : '' ).'">
		<a href="'.esc_url( $link ).'" class="btn btn-default '.$size.' '.$rnd.' '.( $link != '#' && $link[0] == '#' ? 'slideTo' : '' ).'" target="'.esc_attr( $target ).'">
			'.( $icon != 'No Icon' && $icon != '' ? '<i class="fa fa-'.$icon.' '.( empty( $text ) ? 'no-margin' : '' ).'"></i>' : '' ).'
			'.$text.'
		</a>
	</div>';
}

add_shortcode( 'button', 'boston_button_func' );

function boston_button_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Text","boston"),
			"param_name" => "text",
			"value" => '',
			"description" => __("Input button text.","boston")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Link","boston"),
			"param_name" => "link",
			"value" => '',
			"description" => __("Input button link.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Select Window","boston"),
			"param_name" => "target",
			"value" => array(
				__( 'Same Window', 'boston' ) => '_self',
				__( 'New Window', 'boston' ) => '_blank',
			),
			"description" => __("Select window where to open the link.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color","boston"),
			"param_name" => "bg_color",
			"value" => '',
			"description" => __("Select button background color.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color On Hover","boston"),
			"param_name" => "bg_color_hvr",
			"value" => '',
			"description" => __("Select button background color on hover.","boston")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Border Radius","boston"),
			"param_name" => "border_radius",
			"value" => '',
			"description" => __("Input button border radius. For example 5px or 5ox 9px 0px 0px or 50% or 50% 50% 20% 10%.","boston")
		),
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
			"heading" => __("Font Color","boston"),
			"param_name" => "font_color",
			"value" => '',
			"description" => __("Select button font color.","boston")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Font Color On Hover","boston"),
			"param_name" => "font_color_hvr",
			"value" => '',
			"description" => __("Select button font color on hover.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Size","boston"),
			"param_name" => "size",
			"value" => array(
				__( 'Normal', 'boston' ) => '',
				__( 'Medium', 'boston' ) => 'medium',
				__( 'Large', 'boston' ) => 'large',
			),
			"description" => __("Select button size.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Align","boston"),
			"param_name" => "align",
			"value" => array(
				__( 'Left', 'boston' ) => 'left',
				__( 'Center', 'boston' ) => 'center',
				__( 'Right', 'boston' ) => 'right',
			),
			"description" => __("Select button align.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Select Button Width","boston"),
			"param_name" => "btn_width",
			"value" => array(
				__( 'Normal', 'boston' ) => 'normal',
				__( 'Full Width', 'boston' ) => 'full',
			),
			"description" => __("Select button alwidthign.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Display Inline","boston"),
			"param_name" => "inline",
			"value" => array(
				__( 'No', 'boston' ) => 'no',
				__( 'Yes', 'boston' ) => 'yes',
			),
			"description" => __("Display button inline.","boston")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Margins","boston"),
			"param_name" => "margin",
			"value" => '',
			"description" => __("Add button margins.","boston")
		),
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Button", 'boston'),
	   "base" => "button",
	   "category" => __('Content', 'boston'),
	   "params" => boston_button_params()
	) );
}

?>