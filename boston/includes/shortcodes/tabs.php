<?php
function boston_tabs_func( $atts, $content ){
	extract( shortcode_atts( array(
		'titles' => '',
		'contents' => ''
	), $atts ) );

	$titles = explode( "/n/", $titles );
	$contents = explode( "/n/", $contents );

	$titles_html = '';
	$contents_html = '';

	$random = boston_random_string();

	if( !empty( $titles ) ){
		for( $i=0; $i<sizeof( $titles ); $i++ ){
			$titles_html .= '<li role="presentation" class="'.( $i == 0 ? 'active' : '' ).'"><a href="#tab_'.$i.'_'.$random.'" role="tab" data-toggle="tab">'.$titles[$i].'</a></li>';
			$contents_html .= '<div role="tabpanel" class="tab-pane fade '.( $i == 0 ? 'in active' : '' ).'" id="tab_'.$i.'_'.$random.'">'.( !empty( $contents[$i] ) ? apply_filters( 'the_content', $contents[$i] ) : '' ).'</div>';
		}
	}

	return '
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
	  '.$titles_html.'
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
	  '.$contents_html.'
	</div>';
}

add_shortcode( 'tabs', 'boston_tabs_func' );

function boston_tabs_params(){
	return array(
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __("Titles","boston"),
			"param_name" => "titles",
			"value" => '',
			"description" => __("Input tab titles separated by /n/.","boston")
		),
		array(
			"type" => "textarea_raw_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Contents","boston"),
			"param_name" => "contents",
			"value" => '',
			"description" => __("Input tab contents separated by /n/.","boston")
		),

	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Tabs", 'boston'),
	   "base" => "tabs",
	   "category" => __('Content', 'boston'),
	   "params" => boston_tabs_params()
	) );
}

?>