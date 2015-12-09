<?php
function boston_row_func( $atts, $content ){

	return '<div class="row">'.do_shortcode( $content ).'</div>';
}

add_shortcode( 'row', 'boston_row_func' );

function boston_row_params(){
	return array();
}
?>