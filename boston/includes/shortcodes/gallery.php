<?php
function boston_bg_gallery_func( $atts, $content ){
	extract( shortcode_atts( array(
		'images' => '',
		'thumb_image_size' => 'post-thumbnail',
		'columns' => '3',
	), $atts ) );

	ob_start();
	echo do_shortcode( '[gallery columns="'.$columns.'" ids="'.$images.'" size="'.$thumb_image_size.'"]' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

add_shortcode( 'bg_gallery', 'boston_bg_gallery_func' );

function boston_bg_gallery_params(){
	return array(
		array(
			"type" => "attach_images",
			"holder" => "div",
			"class" => "",
			"heading" => __("Select Images","boston"),
			"param_name" => "images",
			"value" => '',
			"description" => __("Select images for the gallery.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Thumbnail Image Size","boston"),
			"param_name" => "thumb_image_size",
			"value" => boston_get_image_sizes(),
			"description" => __("Select image size you want to display for the thumbnails.","boston")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Columns","boston"),
			"param_name" => "columns",
			"value" => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
			),
			"description" => __("Select number of columns for the thumbnails.","boston")
		),
	);
}
if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Gallery", 'boston'),
	   "base" => "bg_gallery",
	   "category" => __('Content', 'boston'),
	   "params" => boston_bg_gallery_params()
	) );
}

?>