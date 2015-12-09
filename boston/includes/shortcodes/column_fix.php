<?php
function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
	if($tag=='vc_column' || $tag=='vc_column_inner') {
		$old = array( 'vc_col-sm-1', 'vc_col-sm-2', 'vc_col-sm-3', 'vc_col-sm-4', 'vc_col-sm-5', 'vc_col-sm-6', 'vc_col-sm-7', 'vc_col-sm-8', 'vc_col-sm-9', 'vc_col-sm-10', 'vc_col-sm-11', 'vc_col-sm-12' );
		$new = array( 'col-md-1', 'col-md-2', 'col-md-3', 'col-md-4', 'col-md-5', 'col-md-6', 'col-md-7', 'col-md-8', 'col-md-9', 'col-md-10', 'col-md-11', 'col-md-12' );
		$class_string = str_replace($old, $new, $class_string);
	}
	return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);
?>