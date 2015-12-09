<?php
/*
	SHORTCODES
*/



/*
==============================================================================================
						COLUMNS
==============================================================================================
*/

/*
=================================================================
* 
* Bootstrap Columns
*
=================================================================
*/

/* 
*
* Row - This Container for All Spans. For example:
* [row][span1] content here[/span1][/row]	
*/
function colortheme_row( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="row-fluid clearfix">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('row', 'colortheme_row');


/* Span1 */
function colortheme_span1( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span1 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span1', 'colortheme_span1');

/* Span2 */
function colortheme_span2( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span2 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span2', 'colortheme_span2');

/* Span3 */
function colortheme_span3( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span3 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span3', 'colortheme_span3');

/* Span4 */
function colortheme_span4( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span4 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span4', 'colortheme_span4');

/* Span5 */
function colortheme_span5( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span5 margin-30b">'.do_shortcode($content).'</div>';
		
	return $code;
}
add_shortcode('span5', 'colortheme_span5');

/* Span6 */
function colortheme_span6( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span6 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span6', 'colortheme_span6');

/* Span7 */
function colortheme_span7( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span7 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span7', 'colortheme_span7');

/* Span8 */
function colortheme_span8( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span8 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span8', 'colortheme_span8');

/* Span9 */
function colortheme_span9( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span9 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span9', 'colortheme_span9');

/* Span10 */
function colortheme_span10( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span10 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span10', 'colortheme_span10');

/* Span11 */
function colortheme_span11( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span11 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span11', 'colortheme_span11');

/* Span12 */
function colortheme_span12( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="span12 margin-30b">' . do_shortcode( $content ) . '</div>';
		
	return $code;
}
add_shortcode('span12', 'colortheme_span12');







/*
==============================================================================================
						MARGINS
==============================================================================================
*/

/*
-------------------------------------
	Top Margins
-------------------------------------	
*/

/* margin top 5px  */
function colortheme_margin_5t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-5t"></div>';
}
add_shortcode('margin_5t', 'colortheme_margin_5t');

/* margin top 10px  */
function colortheme_margin_10t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-10t"></div>';
}
add_shortcode('margin_10t', 'colortheme_margin_10t');

/* margin top 15px  */
function colortheme_margin_15t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-15t"></div>';
}
add_shortcode('margin_15t', 'colortheme_margin_15t');

/* margin top 20px  */
function colortheme_margin_20t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-20t"></div>';
}
add_shortcode('margin_20t', 'colortheme_margin_20t');

/* margin top 25px  */
function colortheme_margin_25t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-25t"></div>';
}
add_shortcode('margin_25t', 'colortheme_margin_25t');

/* margin top 30px  */
function colortheme_margin_30t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-30t"></div>';
}
add_shortcode('margin_30t', 'colortheme_margin_30t');

/* margin top 35px  */
function colortheme_margin_35t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-35t"></div>';
}
add_shortcode('margin_35t', 'colortheme_margin_35t');

/* margin top 40px  */
function colortheme_margin_40t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-40t"></div>';
}
add_shortcode('margin_40t', 'colortheme_margin_40t');

/* margin top 45px  */
function colortheme_margin_45t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-45t"></div>';
}
add_shortcode('margin_45t', 'colortheme_margin_45t');

/* margin top 50px  */
function colortheme_margin_50t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-50t"></div>';
}
add_shortcode('margin_50t', 'colortheme_margin_50t');

/* margin top 55px  */
function colortheme_margin_55t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-55t"></div>';
}
add_shortcode('margin_55t', 'colortheme_margin_55t');

/* margin top 60px  */
function colortheme_margin_60t($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-60t"></div>';
}
add_shortcode('margin_60t', 'colortheme_margin_60t');



/*
-------------------------------------
	Bottom Margins
-------------------------------------	
*/

/* margin botom 5px  */
function colortheme_margin_5b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-5b"></div>';
}
add_shortcode('margin_5b', 'colortheme_margin_5b');

/* margin bottom 10px  */
function colortheme_margin_10b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-10b"></div>';
}
add_shortcode('margin_10b', 'colortheme_margin_10b');

/* margin bottom 15px  */
function colortheme_margin_15b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-15b"></div>';
}
add_shortcode('margin_15b', 'colortheme_margin_15b');

/* margin bottom 20px  */
function colortheme_margin_20b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-20b"></div>';
}
add_shortcode('margin_20b', 'colortheme_margin_20b');

/* margin bottom 25px  */
function colortheme_margin_25b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-25b"></div>';
}
add_shortcode('margin_25b', 'colortheme_margin_25b');

/* margin bottom 30px  */
function colortheme_margin_30b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-30b"></div>';
}
add_shortcode('margin_30b', 'colortheme_margin_30b');

/* margin bottom 35px  */
function colortheme_margin_35b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-35b"></div>';
}
add_shortcode('margin_35b', 'colortheme_margin_35b');

/* margin bottom 40px  */
function colortheme_margin_40b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-40b"></div>';
}
add_shortcode('margin_40b', 'colortheme_margin_40b');

/* margin bottom 45px  */
function colortheme_margin_45b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-45b"></div>';
}
add_shortcode('margin_45b', 'colortheme_margin_45b');

/* margin bottom 50px  */
function colortheme_margin_50b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-50b"></div>';
}
add_shortcode('margin_50b', 'colortheme_margin_50b');

/* margin bottom 55px  */
function colortheme_margin_55b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-55b"></div>';
}
add_shortcode('margin_55b', 'colortheme_margin_55b');

/* margin bottom 60px  */
function colortheme_margin_60b($atts, $content = null) {
	return '<div class="clear"></div><div class="margin-60b"></div>';
}
add_shortcode('margin_60b', 'colortheme_margin_60b');


/*
-------------------------------------
	No Bottom Margin
-------------------------------------	
*/
function colortheme_no_margin_b($atts, $content = null) {
	return '<div class="no-margin-b"></div>';
}
add_shortcode('no_margin_b', 'colortheme_no_margin_b');


/*
-------------------------------------
	No Top Margin
-------------------------------------	
*/

function colortheme_no_margin_t($atts, $content = null) {
	return '<div class="no-margin-t"></div>';
}
add_shortcode('no_margin_t', 'colortheme_no_margin_t');




/*
==============================================================================================
						Highlights
==============================================================================================
*/

/* standard Highlights  */
function colortheme_stdHLight($atts, $content = null) {
	return '<span class="highlight">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight', 'colortheme_stdHLight');

/* pink Highlights  */
function colortheme_pinkHLight($atts, $content = null) {
	return '<span class="highlight pink">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_pink', 'colortheme_pinkHLight');

/* green Highlights  */
function colortheme_greenHLight($atts, $content = null) {
	return '<span class="highlight green">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_green', 'colortheme_greenHLight');

/* red Highlights  */
function colortheme_redHLight($atts, $content = null) {
	return '<span class="highlight red">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_red', 'colortheme_redHLight');

/* orange Highlights  */
function colortheme_orangeHLight($atts, $content = null) {
	return '<span class="highlight orange">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_orange', 'colortheme_orangeHLight');

/* blue Highlights  */
function colortheme_blueHLight($atts, $content = null) {
	return '<span class="highlight blue">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_blue', 'colortheme_blueHLight');

/* yellow Highlights  */
function colortheme_yellowHLight($atts, $content = null) {
	return '<span class="highlight yellow">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('highlight_yellow', 'colortheme_yellowHLight');


/*
==============================================================================================
						TEXT ALIGNS
==============================================================================================
*/

/* align: Left  */
function colortheme_alignLeft($atts, $content = null) {
	return '<p class="text-left">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_left', 'colortheme_alignLeft');

/* align: Right  */
function colortheme_alignRight($atts, $content = null) {
	return '<p class="text-right">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_right', 'colortheme_alignRight');

/* align: Center  */
function colortheme_alignCenter($atts, $content = null) {
	return '<p class="text-center">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_center', 'colortheme_alignCenter');

/* align: Justify  */
function colortheme_alignJustify($atts, $content = null) {
	return '<p class="text-justify">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('text_justify', 'colortheme_alignJustify');


/*
==============================================================================================
						TEXT Italic/Bold
==============================================================================================
*/
/* style: Italic  */
function colortheme_fontItalic($atts, $content = null) {
	return '<p class="italic">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('font_italic', 'colortheme_fontItalic');

/* style: Bold  */
function colortheme_fontBold($atts, $content = null) {
	return '<p class="bold">' . do_shortcode ( $content ) . '</p>';
}
add_shortcode('font_bold', 'colortheme_fontBold');


/*
==============================================================================================
						DROPCAPS
==============================================================================================
*/

/* standard dropcap  */
function colortheme_stdDrop($atts, $content = null) {
	return '<span class="dropcap">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap', 'colortheme_stdDrop');

/* pink dropcap  */
function colortheme_pinkDrop($atts, $content = null) {
	return '<span class="dropcap pink">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_pink', 'colortheme_pinkDrop');

/* green dropcap  */
function colortheme_greenDrop($atts, $content = null) {
	return '<span class="dropcap green">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_green', 'colortheme_greenDrop');

/* red dropcap  */
function colortheme_redDrop($atts, $content = null) {
	return '<span class="dropcap red">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_red', 'colortheme_redDrop');

/* orange dropcap  */
function colortheme_orangeDrop($atts, $content = null) {
	return '<span class="dropcap orange">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_orange', 'colortheme_orangeDrop');

/* blue dropcap  */
function colortheme_blueDrop($atts, $content = null) {
	return '<span class="dropcap blue">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_blue', 'colortheme_blueDrop');

/* blue dropcap  */
function colortheme_yellowDrop($atts, $content = null) {
	return '<span class="dropcap yellow">' . do_shortcode ( $content ) . '</span>';
}
add_shortcode('dropcap_yellow', 'colortheme_yellowDrop');




/*
==============================================================================================
						Clear Float Blocks
==============================================================================================
*/
function colortheme_floatClear($atts, $content = null) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'colortheme_floatClear');



/*
==============================================================================================
						Lists
==============================================================================================
*/

/*
	style: unordered / ordered / square / circle / disc / arrow
*/
function crumble_list_shortcode($atts, $content = null) {
	extract( shortcode_atts( 
		array( 
			"style" => '1',
			"underline" => '1' 
		), $atts));
	
	$code = '';
	$list_type = '';
	
	switch ($style) {
	 case 1:
			$list_type = 'unordered';
			break;
	 case 2:
	 		$list_type = 'ordered';
			break;

	 case 3:
	 		$list_type = 'square';
			break;
			
	 case 4:
	 		$list_type = 'circle';
			break;

	 case 5:
	 		$list_type = 'bullets';
			break;
			
	 case 6:
	 		$list_type = 'arrow';
			break;

	 case 7:
	 		$list_type = 'arrow2';
			break;
		
	}
	
	if( $underline == "1" ) {
		$code = '<ul class="list '.$list_type.' underline">' . do_shortcode ( $content ) . '</ul>';
	} else {
		$code = '<ul class="list '.$list_type.'">' . do_shortcode ( $content ) . '</ul>';
	}
	
	return $code;
	
}
add_shortcode('list', 'crumble_list_shortcode' );	


/*
==============================================================================================
						SEPARATORS
==============================================================================================
*/

/* divider full width 1px  */
function colortheme_divider_1px($atts, $content = null) {
	return '<div class="divider-1px"></div>';
}
add_shortcode('divider_1px', 'colortheme_divider_1px');


/* divider full width 1px dotted  */
function colortheme_divider_1px_dashed($atts, $content = null) {
	return '<div class="divider-1px-dashed"></div><div class="clear"></div>';
}
add_shortcode('divider_1px_dashed', 'colortheme_divider_1px_dashed');




/*
==============================================================================================
						Video Shortcode
==============================================================================================
*/
/* 
	id: video id from video services(Support: Youtube , Vimeo , Dialymotion )
	type: video type: youtube/vimeo/dailymotion
	width: Video Width
	height: Video Height

*/
	function colortheme_video($atts, $content = null) {
		extract ( shortcode_atts(
			array(
				'id' => '',
				'type' => '',
				'width' => '',
				'height' => '220'
			), $atts ) );
		



			if( $type == 'youtube' ) { 
				$code = '<iframe width="' . $width . '" height="' .$height . '" src="http://www.youtube.com/embed/'. $id . '" frameborder="0" allowfullscreen></iframe>';
			} 
			
			if( $type == 'vimeo') { 
				$code = '<iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="' . $width . '" height="' . $height . '"></iframe>';
			} 
			
			if($type == 'dailymotion') { 
				$code = '<iframe width="' . $width . '" height="' . $height . '" src="http://www.dailymotion.com/embed/video/'. $id . '?logo=0"></iframe>';
			 } 
			 
		$code = '<div class="video-frame">' . $code . '</div>';

			
		return $code;
	}
add_shortcode('video', 'colortheme_video');



/*
==============================================================================================
						Collapse
==============================================================================================
*/

function colortheme_collapse( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Collapse Title',
		'collapseid' => 'UniqueID'

	), $atts ) );
	
	$code =  '<div class="accordion"><div class="accordion-group"><div class="accordion-heading">';
	$code .= '<a class="accordion-toggle" data-toggle="collapse" href="#' . $collapseid . '">' . $title . '</a>';
	$code .= '</div><div id="' . $collapseid .'" class="accordion-body collapse"><div class="accordion-inner">';
	$code .= do_shortcode( $content ) . '</div></div></div></div>';
		
	return $code;
}
add_shortcode('collapse', 'colortheme_collapse');




/*
==============================================================================================
						Google Adsense
==============================================================================================
*/

function colortheme_adsense( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'float' => 'left',
		'ad_client' => 'pub-XXXXXXXXXXX',
		'ad_slot' => 'XXXXXXXXXX',
		'ad_width' => '250',
		'ad_height' => '250'

	), $atts ) );
	
	$code = '<div class="adsense-'. $float . '">
		<script type="text/javascript"><!--
    		google_ad_client = "' . $ad_client . '";
    		google_ad_slot = "' . $ad_slot . '";
    		google_ad_width = ' . $ad_width . ';
    		google_ad_height = ' . $ad_height .';
    		//-->
    		</script>
    		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
		</div>';
					
	return $code;
}
add_shortcode('show_AdSense', 'colortheme_adsense');

/*
==============================================================================================
*
*	Badgets
*
==============================================================================================
*/
function colortheme_badgets( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style' => '1',

	), $atts ) );

	switch ($style) {
	 case 1:
			$badge_style = '';
			break;
	 case 2:
	 		$badge_style = 'badge-success';
			break;

	 case 3:
	 		$badge_style = 'badge-warning';
			break;
			
	 case 4:
	 		$badge_style = 'badge-important';
			break;

	 case 5:
	 		$badge_style = 'badge-info';
			break;
			
	 case 6:
	 		$badge_style = 'badge-inverse';
			break;

		
	}
	
	if ( $style == 1 ) { $code =  '<span class="badge">' . do_shortcode( $content ) . '</span>'; }
	else { $code =  '<span class="badge ' . $badge_style . '">' . do_shortcode( $content ) . '</span>'; }
			
	return $code;
}
add_shortcode('badge', 'colortheme_badgets');

/*
==============================================================================================
*
*	Labels
*
==============================================================================================
*/
function colortheme_labels( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style' => '1',

	), $atts ) );

	switch ($style) {
	 case 1:
			$label_style = '';
			break;
	 case 2:
	 		$label_style = 'label-success';
			break;

	 case 3:
	 		$label_style = 'label-warning';
			break;
			
	 case 4:
	 		$label_style = 'label-important';
			break;

	 case 5:
	 		$label_style = 'label-info';
			break;
			
	 case 6:
	 		$label_style = 'label-inverse';
			break;

		
	}
	
	
	if ( $style == 1 ) { $code =  '<span class="label">' . do_shortcode( $content ) . '</span>'; }
	else { $code =  '<span class="label ' . $label_style . '">' . do_shortcode( $content ) . '</span>'; }

			
	return $code;
}
add_shortcode('label', 'colortheme_labels');



/*
==============================================================================================
*
*	Alerts
*
==============================================================================================
*/
function colortheme_alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style' => '1',

	), $atts ) );

	switch ($style) {
	 case 1:
			$alert_style = 'error';
			break;
	 case 2:
	 		$alert_style = 'success';
			break;

	 case 3:
	 		$alert_style = 'info';
			break;					
	}
	
	

	$code =  '<div class="alert alert-' . $alert_style . '"><button class="close" data-dismiss="alert" type="button">×</button>' . do_shortcode( $content ) . '</div>';

			
	return $code;
}
add_shortcode('alert', 'colortheme_alerts');

/*
==============================================================================================
*
*	Icons
*
==============================================================================================
*/
			
function colortheme_icons( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_name' => 'glass',

	), $atts ) );
	
	$code =  '<i class="icon-' . $icon_name . '"></i>';
			
	return $code;
}
add_shortcode('icon', 'colortheme_icons');
			
/*
==============================================================================================
*
*	Progress Bars
*
==============================================================================================
*/
			
function colortheme_progress( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'percent' => '30',
		'style' => '1'

	), $atts ) );

	switch ($style) {
	 case 1:
			$progress_style = '';
			break;
	 case 2:
	 		$progress_style = 'success';
			break;

	 case 3:
	 		$progress_style = 'warning';
			break;		
						
	 case 4:
	 		$progress_style = 'danger';
			break;					

	}

	if ( $style == 1 ) { $code = '<div class="progress progress-striped active"><div class="bar" style="width: ' . $percent . '%;"></div></div>'; }
	else { $code = '<div class="progress progress-striped active"><div class="bar bar-' . $progress_style . '" style="width: ' . $percent . '%;"></div></div>'; }
		
		
	return $code;
}
add_shortcode('progress', 'colortheme_progress');


/*
==============================================================================================
*
*	Buttons
*
==============================================================================================
*/
			
function colortheme_buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style' => '1',
		'link' => 'url',
		'caption' => 'Button'

	), $atts ) );

	switch ($style) {
	 case 1:
			$button_style = '';
			break;
	 case 2:
	 		$button_style = 'primary';
			break;

	 case 3:
	 		$button_style = 'info';
			break;		
						
	 case 4:
	 		$button_style = 'success';
			break;					

	 case 5:
	 		$button_style = 'warning';
			break;					

	 case 6:
	 		$button_style = 'danger';
			break;					

	 case 7:
	 		$button_style = 'inverse';
			break;					

	 case 8:
	 		$button_style = 'link';
			break;					

	}

	if ( $style == 1 ) { $code = '<div class="btn"><a href="' . $link . '">'. $caption .'</a></div>'; }
	else { $code = '<div class="btn btn-' . $button_style . '"><a href="' . $link . '">' . $caption . '</a></div>'; }
		
		
	return $code;
}
add_shortcode('button', 'colortheme_buttons');
	
			
/*
==============================================================================================
						Float Images
==============================================================================================
*/
/* 
	link: url for your image
	align: left/right/center
	alt: alternative text for your image

*/
function colortheme_imgalign($atts, $content = null) {
	extract( shortcode_atts( array(
		'link' => '',
		'align' => 'left',
		'alt' => '',
		'width' => '',
		'height' => ''
	), $atts ) );
	
	if( $align == "left") $code = '<div class="alignleft"><img src="' . $link . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" /><div class="clear"></div></div>';	
	if( $align == "right") $code = '<div class="alignright"><img src="' . $link . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '"  /><div class="clear"></div></div>';		
	if( $align == "center") $code = '<div class="aligncenter"><img src="' . $link . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '"  /><div class="clear"></div></div>';		
		
	return $code;
}
add_shortcode('image', 'colortheme_imgalign');




/*
	--------------------------------------------------------------------------------------------
						ADD SHORTCODES (LIST) TO THE WP EDITOR
	--------------------------------------------------------------------------------------------	
*/


add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
    echo '&nbsp;<select id="sc_select">';
            
            /* Columns */
            echo "<option value=''>List of shortcodes</option>";
            echo "<option value='[row]here must be shortcodes for spans[/row]'>Row ( Container for Spans )</option>";            
            echo "<option value='[span1]content here[/span1]'>1 Column</option>";
            echo "<option value='[span2]content here[/span2]'>2 Columns</option>";            
            echo "<option value='[span3]content here[/span3]'>3 Columns</option>";                        
            echo "<option value='[span4]content here[/span4]'>4 Columns</option>";                        
            echo "<option value='[span5]content here[/span5]'>5 Columns</option>";                        
            echo "<option value='[span6]content here[/span6]'>6 Columns</option>";                        
            echo "<option value='[span7]content here[/span7]'>7 Columns</option>";                        
            echo "<option value='[span8]content here[/span8]'>8 Columns</option>";                        
            echo "<option value='[span9]content here[/span9]'>9 Columns</option>";                        
            echo "<option value='[span10]content here[/span10]'>10 Columns</option>";                        
            echo "<option value='[span11]content here[/span11]'>11 Columns</option>";                                    
          
                      
            /* Margins */            
            echo "<option value='[margin_5t]'>Top Margin 5px</option>";            
            echo "<option value='[margin_10t]'>Top Margin 10px</option>";                        
            echo "<option value='[margin_15t]'>Top Margin 15px</option>";                                    
            echo "<option value='[margin_20t]'>Top Margin 20px</option>";                                    
            echo "<option value='[margin_25t]'>Top Margin 25px</option>";                        
            echo "<option value='[margin_30t]'>Top Margin 30px</option>";                                    
            echo "<option value='[margin_35t]'>Top Margin 35px</option>";                                                
            echo "<option value='[margin_40t]'>Top Margin 40px</option>";
            echo "<option value='[margin_45t]'>Top Margin 45px</option>";
            echo "<option value='[margin_50t]'>Top Margin 50px</option>";                                    
            echo "<option value='[margin_55t]'>Top Margin 55px</option>";            
            echo "<option value='[margin_60t]'>Top Margin 60px</option>";            

            echo "<option value='[margin_5b]'>Bottom Margin 5px</option>";            
            echo "<option value='[margin_10b]'>Bottom Margin 10px</option>";                        
            echo "<option value='[margin_15b]'>Bottom Margin 15px</option>";                                    
            echo "<option value='[margin_20b]'>Bottom Margin 20px</option>";                                    
            echo "<option value='[margin_25b]'>Bottom Margin 25px</option>";                        
            echo "<option value='[margin_30b]'>Bottom Margin 30px</option>";                                    
            echo "<option value='[margin_35b]'>Bottom Margin 35px</option>";                                                
            echo "<option value='[margin_40b]'>Bottom Margin 40px</option>";
            echo "<option value='[margin_45b]'>Bottom Margin 45px</option>";
            echo "<option value='[margin_50b]'>Bottom Margin 50px</option>";                                    
            echo "<option value='[margin_55b]'>Bottom Margin 55px</option>";            
            echo "<option value='[margin_60b]'>Bottom Margin 60px</option>";            

            echo "<option value='[no_margin_t]'>No Top Margin</option>";                        
            echo "<option value='[no_margin_b]'>No Bottom Margin</option>";                                    
           

           /* Highlights */            
		   echo "<option value='[highlight]content here[/highlight]'>Highlight</option>";           
		   echo "<option value='[highlight_pink]content here[/highlight_pink]'>Highlight Pink</option>";		   
		   echo "<option value='[highlight_green]content here[/highlight_green]'>Highlight Green</option>";		   
		   echo "<option value='[highlight_red]content here[/highlight_red]'>Highlight Red</option>";		   
		   echo "<option value='[highlight_orange]content here[/highlight_orange]'>Highlight Orange</option>";		   
		   echo "<option value='[highlight_blue]content here[/highlight_blue]'>Highlight Blue</option>";		   
		   echo "<option value='[highlight_yellow]content here[/highlight_yellow]'>Highlight Yellow</option>";		   		   		   		   		   		   


           /* Text Aligns */ 
           echo "<option value='[text_left]content here[/text_left]'>Text Align Left</option>";           
           echo "<option value='[text_right]content here[/text_right]'>Text Align Right</option>";           
           echo "<option value='[text_center]content here[/text_center]'>Text Align Center</option>";           
           echo "<option value='[text_justify]content here[/text_justify]'>Text Align Justify</option>";           

           /* Font Styles */ 
           echo "<option value='[font_italic]content here[/font_italic]'>Font Italic</option>";                                    
           echo "<option value='[font_bold]content here[/font_bold]'>Font Bold</option>";           

           /* Dropcaps */                       
		   echo "<option value='[dropcap]content here[/dropcap]'>Dropcap Standard</option>";		   		   		   		   		   		   		              
		   echo "<option value='[dropcap_pink]content here[/dropcap_pink]'>Dropcap Pink</option>";
		   echo "<option value='[dropcap_green]content here[/dropcap_green]'>Dropcap Green</option>";
		   echo "<option value='[dropcap_red]content here[/dropcap_red]'>Dropcap Red</option>";
		   echo "<option value='[dropcap_orange]content here[/dropcap_orange]'>Dropcap Orange</option>";
		   echo "<option value='[dropcap_yellow]content here[/dropcap_yellow]'>Dropcap Yellow</option>";		   
		   echo "<option value='[dropcap_blue]content here[/dropcap_blue]'>Dropcap Blue</option>";
        
           /* Clear Floats */   
           echo "<option value='[clear]'>Clear Floats</option>";		   		   		   		   		   		   

             /* Lists */              
		   echo "<option value='[list style=\"1\" underline=\"1\"]<li>content here</li><li>content here</li><li>content here</li>[/list]'>Lists</option>";		   		   		   		   		   		   
           

           /* Dividers */              
		   echo "<option value='[divider_1px]'>Divider 1px</option>";		   		   		   		   		   		   
		   echo "<option value='[divider_1px_dashed]'>Divider 1px Dashed</option>";		   		   		   		   		   		   		   
		   	   
           /* Images */              		   
		   echo "<option value='[image link=\"\" align=\"left\" alt=\"\"]' width=\"\" height=\"\">Image</option>";		   		   		   		   		   		   

	       /* Icons */              		   
		   echo "<option value='[icon icon_name=\"glass\"]'>Icons</option>";		   		   		   		   		   		   

           /* Title */                        
           echo "<option value='[title title=\"Your Title\"]'>Title</option>";		   		   		   		   		   		   

           /* Badge */                        
           echo "<option value='[badge style=\"1\"]1[/badge]'>Badges</option>";		   		   		   		   		   		   

           /* Label */                        
           echo "<option value='[label style=\"1\"]labels[/label]'>Labels</option>";

           /* Alert */                        
           echo "<option value='[alert style=\"1\"]content here[/alert]'>Alerts</option>";		   		   		   		   		   		   

           /* Progress Bars */                        
           echo "<option value='[progress percent=\"30\" style=\"1\"]'>Progress Bars</option>";		   		   		   		   		   		   

           /* Buttons */                        
           echo "<option value='[button style=\"1\" caption=\"Button\" link=\"button_url\"][/button]'>Buttons</option>";		   		   		   		   		   		   
            
           /* Video */              		   
		   echo "<option value='[video id=\"34162267\" type=\"vimeo\" width=\"\" height=\"320\"]'>Video</option>";		   		   		   		   		   		   

           /* Collapse */              		   
		   echo "<option value='[collapse title=\"Your Title\" collapseid=\"UniqueID\"]Content here[/collapse]'>Collapse</option>";		   		   		   		   		   		   

         /* AdSense */              		   
		   echo "<option value='[show_AdSense float=\"left\" ad_client=\"pub-XXXXXXXXXXX\" ad_slot=\"XXXXXXXXXX\" ad_width=\"250\" ad_height=\"250\" ]'>Google AdSense</option>";		   		   		   		   		   		   

           /* Contact Form */                        
//           echo "<option value='[contact-form]'>Contact Form</option>";

		              
   echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
    echo '<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery("#sc_select").change(function() {
              send_to_editor(jQuery("#sc_select :selected").val());
                  return false;
        });
    });
    </script>';
}

?>