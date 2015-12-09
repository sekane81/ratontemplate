<?php
class ts_shortcodes
{
	var	$conf;
	var	$popup;
	var	$params;
	var	$shortcode;
	var $cparams;
	var $cshortcode;
	var $popup_title;
	var $no_preview;
	var $has_child;
	var $max_children;
	var	$output;
	var	$errors;

	// --------------------------------------------------------------------------

	function __construct( $popup )
	{
		if( ts_essentials_locate_plugin_file( 'includes/shortcodes/tinymce/config' ) )
		{
			$this->conf = ts_essentials_locate_plugin_file( 'includes/shortcodes/tinymce/config' );
			$this->popup = $popup;

			$this->formatt_shortcode();
		}
		else
		{
			$this->append_error('Config file does not exist');
		}
	}

	// --------------------------------------------------------------------------

	function formatt_shortcode()
	{
		global $ts_shortcodes;
		
		// get config file
		require_once( $this->conf );

		unset($ts_shortcodes['shortcode-generator']['params']['select_shortcode']);
		if( isset( $ts_shortcodes[$this->popup]['child_shortcode'] ) )
			$this->has_child = true;
        
        $this->max_children = (isset($ts_shortcodes[$this->popup]['max_children'])) ? $ts_shortcodes[$this->popup]['max_children'] : 50;

		if( isset( $ts_shortcodes ) && is_array( $ts_shortcodes ) )
		{
			// get shortcode config stuff
			$this->params = $ts_shortcodes[$this->popup]['params'];
			$this->shortcode = $ts_shortcodes[$this->popup]['shortcode'];
			$this->popup_title = $ts_shortcodes[$this->popup]['popup_title'];

			// adds stuff for js use
			$this->append_output( "\n" . '<div id="_ts_shortcode" class="hidden">' . $this->shortcode . '</div>' );
			$this->append_output( "\n" . '<div id="_ts_popup" class="hidden">' . $this->popup . '</div>' );

			if( isset( $ts_shortcodes[$this->popup]['no_preview'] ) && $ts_shortcodes[$this->popup]['no_preview'] )
			{
				//$this->append_output( "\n" . '<div id="_ts_preview" class="hidden">false</div>' );
				$this->no_preview = true;
			}

			// filters and excutes params
			foreach( $this->params as $pkey => $param )
			{
				// prefix the fields names and ids with ts_
				$pkey = 'ts_' . $pkey;

				if(!isset($param['std'])) {
					$param['std'] = '';
				}


				if(!isset($param['desc'])) {
					$param['desc'] = '';
				}
				
				$use_selection = (isset($param['use_selection']) && $param['use_selection'] === true) ? 'ts-use-selection' : '';

				// popup form row start
				$row_start  = '<tbody>' . "\n";
				$row_start .= '<tr class="form-row" class="' . esc_attr($pkey) . '">' . "\n";
				if($param['type'] != 'info') {
					$row_start .= '<td class="label">';
					$row_start .= '<span class="ts-form-label-title">' . $param['label'] . '</span>' . "\n";
					$row_start .= '<span class="ts-form-desc">' . $param['desc'] . '</span>' . "\n";
					$row_start .= '</td>' . "\n";
				}
				$row_start .= '<td class="field">' . "\n";

				// popup form row end
				$row_end   = '</td>' . "\n";
				$row_end   .= '</tr>' . "\n";
				$row_end   .= '</tbody>' . "\n";

				switch( $param['type'] )
				{
						
					case 'text' :

						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="ts-form-text ts-input '.esc_attr($use_selection).'" name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" value="' . esc_attr($param['std']) . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'textarea' :

						// prepare
						$output  = $row_start;

						// Turn on the output buffer
						ob_start();

						// Echo the editor to the buffer
						wp_editor( $param['std'], $pkey, array( 'editor_class' => 'ts_tinymce', 'media_buttons' => true ) );

						// Store the contents of the buffer in a variable
						$editor_contents = ob_get_clean();

						//$output .= $editor_contents;
						$output .= '<textarea rows="10" cols="30" name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" class="ts-form-textarea ts-input '.esc_attr($use_selection).'">' . esc_textarea($param['std']) . '</textarea>' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'select' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="ts-form-select-field">';
						$output .= '<div class="ts-shortcodes-arrow">&#xf107;</div>';
						$output .= '<select name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" class="ts-form-select ts-input">' . "\n";

						foreach( $param['options'] as $value => $option )
						{
							$selected = (isset($param['std']) && $param['std'] == $value) ? 'selected="selected"' : '';
							$output .= '<option value="' . esc_attr($value) . '"' . $selected . '>' . $option . '</option>' . "\n";
						}

						$output .= '</select>' . "\n";
						$output .= '</div>';
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

                    case 'radio' :

                        // prepare
                        $output  = $row_start;

                        foreach( $param['options'] as $value => $option )
                        {
                            $output .= '<label for="' . esc_attr($pkey) . '_'.ts_slugify($value).'" class="ts-form-checkbox">';
                            $output .= '<input type="radio" class="ts-input" name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '_'.ts_slugify($value) . '" value="'.esc_attr($value).'" ' . ( $param['std'] == $value ? 'checked' : '' ) . ' />';
                            $output .= ' ' . $option . '</label><br /> ' . "\n";
                        }

                        $output .= $row_end;

                        // append
                        $this->append_output( $output );

                        break;

                    case 'radio_inline' :

                        // prepare
                        $output  = $row_start;

                        foreach( $param['options'] as $value => $option )
                        {
                            $output .= '<label for="' . esc_attr($pkey) . '_'.ts_slugify($value).'" class="ts-form-checkbox">';
                            $output .= '<input type="radio" class="ts-input" name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '_'.ts_slugify($value) . '" value="'.esc_attr($value).'" ' . ( $param['std'] == $value ? 'checked' : '' ) . ' />';
                            $output .= ' ' . $option . '</label> &nbsp; &nbsp; ' . "\n";
                        }

                        $output .= $row_end;

                        // append
                        $this->append_output( $output );

                        break;

					case 'multiple_select' :

						// prepare
						$output  = $row_start;
						$output .= '<select name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" multiple="multiple" class="ts-form-multiple-select ts-input">' . "\n";

						if( $param['options'] && is_array($param['options']) ) {
							foreach( $param['options'] as $value => $option )
							{
								$output .= '<option value="' . esc_attr($value) . '">' . $option . '</option>' . "\n";
							}
						}

						$output .= '</select>' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'checkbox' :

						// prepare
						$checkbox_text = (isset($param['checkbox_text'])) ? $param['checkbox_text'] : '';
						$output  = $row_start;
						$output .= '<label for="' . esc_attr($pkey) . '" class="ts-form-checkbox">' . "\n";
						$output .= '<input type="checkbox" class="ts-input" name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" ' . ( $param['std'] ? 'checked' : '' ) . ' />' . "\n";
						$output .= ' ' . $checkbox_text . '</label>' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'uploader' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="ts-upload-container">';
						$output .= '<img src="" alt="Image" class="uploaded-image" />';
						$output .= '<input type="hidden" class="ts-form-text ts-form-upload ts-input" name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" value="' . esc_attr($param['std']) . '" />' . "\n";
						$output .= '<a href="' . esc_url($pkey) . '" class="ts-upload-button" data-upid="1">'.__('Upload','ThemeStockyard').'</a>';
						$output .= '</div>';
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'gallery' :

						if(!isset($cpkey)) {
							$cpkey = '';
						}
						
						// prepare
						$output  = $row_start;
						$output .= '<a href="' . esc_url($cpkey) . '" class="ts-gallery-button ts-shortcodes-button">'.__('Attach Images to Gallery','ThemeStockyard').'</a>';
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'iconpicker' :

						// prepare
						$output  = $row_start;

						$output .= '<div class="iconpicker">';
						foreach( $param['options'] as $value => $option ) {
							$output .= '<i class="fa ' . esc_attr($value) . '" data-name="' . esc_attr($value) . '"></i>';
						}
						$output .= '</div>';

						if(!isset($param['std'])) {
							$param['std'] = '';
						}

						$output .= '<input type="hidden" class="ts-form-text ts-input" name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" value="' . esc_attr($param['std']) . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'colorpicker' :

						if(!isset($param['std'])) {
							$param['std'] = '';
						}
                        
						// prepare
                        $output  = $row_start;
                        
                        $alt_suffix = '';
                        $hide_colorpicker = '';
                        
                        if(isset($param['options']) && is_array($param['options']) && count($param['options']) > 0) {
                            $alt_suffix = '_alt';
                            $hide_colorpicker = 'hidden';
                            $output .= '<div class="ts-form-select-field ts-default" style="padding-bottom:10px">';
                            $output .= '<div class="ts-shortcodes-arrow">&#xf107;</div>';
                            $output .= '<select name="' . esc_attr($pkey) . '" id="' . esc_attr($pkey) . '" class="ts-form-select ts-input">' . "\n";

                            foreach( $param['options'] as $value => $option )
                            {
                                $output .= '<option value="' . esc_attr($value) . '">' . $option . '</option>' . "\n";
                            }

                            $output .= '</select>' . "\n";
                            $output .= '</div>'."\n";
                            
                            $output .= '<div class="ts-form-checkbox-field pt10"><input type="checkbox" name="'.esc_attr($pkey).'_alt_check" id="'.esc_attr($pkey).'_alt_check" class="ts-form-checkbox ts-form-checkbox-alt" data-key="'.esc_attr($pkey).'"/> &nbsp; '. __('Use a hex color instead', 'ThemeStockyard').'</div>';
                        }
                        
                        $output .= '<div class="ts-form-colorpicker-field ts-alt '.esc_attr($hide_colorpicker).'" style="padding-top:10px">';
                        $output .= '<input type="text" class="ts-form-text ts-input wp-color-picker-field" name="' . esc_attr($pkey . $alt_suffix) .'" id="' . esc_attr($pkey . $alt_suffix) .'" value="' . esc_attr($param['std']) . '" />' . "\n";
                        $output .= '</div>';
                        $output .= $row_end;

                        // append
                        $this->append_output( $output );

                        break;

					case 'info' :

						// prepare
						$output  = $row_start;
						$output .= '<p>' . $param['std'] . "</p>\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'size' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="ts-form-group">' . "\n";
						$output .= '<label>Width</label>' . "\n";
						$output .= '<input type="text" class="ts-form-text ts-input" name="' . esc_attr($pkey) . '_width" id="' . esc_attr($pkey) . '_width" value="' . esc_attr($param['std']) . '" />' . "\n";
						$output  .= '</div>' . "\n";
						$output .= '<div class="ts-form-group last">' . "\n";
						$output .= '<label>Height</label>' . "\n";
						$output .= '<input type="text" class="ts-form-text ts-input" name="' . esc_attr($pkey) . '_height" id="' . esc_attr($pkey) . '_height" value="' . esc_attr($param['std']) . '" />' . "\n";
						$output .= '</div>' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;
				}
			}

			// checks if has a child shortcode
			if( isset( $ts_shortcodes[$this->popup]['child_shortcode'] ) )
			{
				// set child shortcode
				$this->cparams = $ts_shortcodes[$this->popup]['child_shortcode']['params'];
				$this->cshortcode = $ts_shortcodes[$this->popup]['child_shortcode']['shortcode'];

				// popup parent form row start
				$prow_start  = '<tbody>' . "\n";
				$prow_start .= '<tr class="form-row has-child">' . "\n";
				$prow_start .= '<td>' . "\n";
				$prow_start .= '<div class="child-clone-rows" data-max-rows="'.esc_attr($this->max_children).'">' . "\n";

				// for js use
				$prow_start .= '<div id="_ts_cshortcode" class="hidden">' . $this->cshortcode . '</div>' . "\n";

				// start the default row
				$prow_start .= '<div class="child-clone-row">' . "\n";
				$prow_start .= '<ul class="child-clone-row-form">' . "\n";

				// add $prow_start to output
				$this->append_output( $prow_start );

				foreach( $this->cparams as $cpkey => $cparam )
				{

					// prefix the fields names and ids with ts_
					$cpkey = 'ts_' . $cpkey;

					if(!isset($cparam['std'])) {
						$cparam['std'] = '';
					}
                    
                    $use_selection = (isset($cparam['use_selection']) && $cparam['use_selection'] === true) ? 'ts-use-selection' : '';

					if(!isset($cparam['desc'])) {
						$cparam['desc'] = '';
					}

					// popup form row start
					$crow_start  = '<li class="child-clone-row-form-row clearfix">' . "\n";
					$crow_start .= '<div class="child-clone-row-label-desc">' . "\n";
					$crow_start .= '<div class="child-clone-row-label">' . "\n";
					$crow_start .= '<label>' . $cparam['label'] . '</label>' . "\n";
					$crow_start .= '</div>' . "\n";
					$crow_start	.= '<span class="child-clone-row-desc">' . $cparam['desc'] . '</span>' . "\n";
					$crow_start .= '</div>' . "\n";
					$crow_start .= '<div class="child-clone-row-field">' . "\n";

					// popup form row end
					$crow_end    = '</div>' . "\n";
					$crow_end   .= '</li>' . "\n";

					switch( $cparam['type'] )
					{
						case 'text' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="ts-form-text ts-cinput '.esc_attr($use_selection).'" name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '" value="' . esc_attr($cparam['std']) . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'textarea' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<textarea rows="10" cols="30" name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '" class="ts-form-textarea ts-cinput '.esc_attr($use_selection).'">' . esc_textarea($cparam['std']) . '</textarea>' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'select' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="ts-form-select-field">';
							$coutput .= '<div class="ts-shortcodes-arrow">&#xf107;</div>';
							$coutput .= '<select name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '" class="ts-form-select ts-cinput">' . "\n";

							foreach( $cparam['options'] as $value => $option )
							{
								$coutput .= '<option value="' . esc_attr($value) . '">' . $option . '</option>' . "\n";
							}

							$coutput .= '</select>' . "\n";
							$coutput .= '</div>';
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'radio' :

							// prepare
							$coutput  = $crow_start;

							foreach( $cparam['options'] as $value => $option )
							{
								//$coutput .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
                                $coutput .= '<label for="' . esc_attr($cpkey) . '_'.ts_slugify($value).'" class="ts-form-checkbox">';
                                $coutput .= '<input type="radio" class="ts-cinput" name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '_'.ts_slugify($value) . '" value="'.esc_attr($value).'" ' . ( $cparam['std'] == $value ? 'checked' : '' ) . ' />';
                                $coutput .= ' ' . $option . '</label><br /> ' . "\n";
							}

							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'radio_inline' :

							// prepare
							$coutput  = $crow_start;

							foreach( $cparam['options'] as $value => $option )
							{
								//$coutput .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
                                $coutput .= '<label for="' . esc_attr($cpkey) . '_'.ts_slugify($value).'" class="ts-form-checkbox">';
                                $coutput .= '<input type="radio" class="ts-cinput" name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '_'.ts_slugify($value) . '" value="'.esc_attr($value).'" ' . ( $cparam['std'] == $value ? 'checked' : '' ) . ' />';
                                $coutput .= ' ' . $option . '</label> &nbsp; &nbsp; ' . "\n";
							}

							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'checkbox' :

							// prepare
							$checkbox_text = (isset($cparam['checkbox_text'])) ? $cparam['checkbox_text'] : '';
							$coutput  = $crow_start;
							$coutput .= '<label for="' . esc_attr($cpkey) . '" class="ts-form-checkbox">' . "\n";
							$coutput .= '<input type="checkbox" class="ts-cinput" name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '" ' . ( $cparam['std'] ? 'checked' : '' ) . ' />' . "\n";
							$coutput .= ' ' . $checkbox_text . '</label>' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'uploader' :

							if(!isset($cparam['std'])) {
								$cparam['std'] = '';
							}

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="ts-upload-container">';
							$coutput .= '<img src="" alt="Image" class="uploaded-image" />';
							$coutput .= '<input type="hidden" class="ts-form-text ts-form-upload ts-cinput" name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '" value="' . esc_attr($cparam['std']) . '" />' . "\n";
							$coutput .= '<a href="' . esc_url($cpkey) . '" class="ts-upload-button" data-upid="1">'.__('Upload','ThemeStockyard').'</a>';
							$coutput .= '</div>';
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'colorpicker' :
                            
                            // prepare
							$coutput  = $crow_start;
							
							$alt_suffix = '';
							$hide_colorpicker = '';
							
							if(isset($cparam['options']) && is_array($cparam['options']) && count($cparam['options']) > 0) {
                                $alt_suffix = '_alt';
                                $hide_colorpicker = 'hidden';
                                $coutput .= '<div class="ts-form-select-field ts-default" style="padding-bottom:10px">';
                                $coutput .= '<div class="ts-shortcodes-arrow">&#xf107;</div>';
                                $coutput .= '<select name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '" class="ts-form-select ts-cinput">' . "\n";

                                foreach( $cparam['options'] as $value => $option )
                                {
                                    $coutput .= '<option value="' . esc_attr($value) . '">' . $option . '</option>' . "\n";
                                }

                                $coutput .= '</select>' . "\n";
                                $coutput .= '</div>'."\n";
                                
                                $coutput .= '<div class="ts-form-checkbox-field"><input type="checkbox" name="'.esc_attr($cpkey).'_alt_check" id="'.esc_attr($cpkey).'_alt_check" class="ts-form-checkbox ts-form-checkbox-alt" data-key="'.esc_attr($cpkey).'"/> &nbsp; '. __('Use a hex color instead', 'ThemeStockyard').'</div>';
							}
                            
                            $coutput .= '<div class="ts-form-colorpicker-field ts-alt '.esc_attr($hide_colorpicker).'" style="padding-top:10px">';
							$coutput .= '<input type="text" class="ts-form-text ts-cinput wp-color-picker-field" name="' . esc_attr($cpkey . $alt_suffix) .'" id="' . esc_attr($cpkey . $alt_suffix)  . '" value="' . esc_attr($cparam['std']) . '" />' . "\n";
							$coutput .= '</div>';
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'iconpicker' :

							// prepare
							$coutput  = $crow_start;

							$coutput .= '<div class="iconpicker">';
							foreach( $cparam['options'] as $value => $option ) {
								$coutput .= '<i class="' . esc_attr($value) . '" data-name="' . esc_attr($value) . '"></i>';
							}
							$coutput .= '</div>';

							$coutput .= '<input type="hidden" class="ts-form-text ts-cinput" name="' . esc_attr($cpkey) . '" id="' . esc_attr($cpkey) . '" value="' . esc_attr($cparam['std']) . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'size' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="ts-form-group">' . "\n";
							$coutput .= '<label>Width</label>' . "\n";
							$coutput .= '<input type="text" class="ts-form-text ts-cinput" name="' . esc_attr($cpkey) . '_width" id="' . esc_attr($cpkey) . '_width" value="' . esc_attr($cparam['std']) . '" />' . "\n";
							$coutput  .= '</div>' . "\n";
							$coutput .= '<div class="ts-form-group last">' . "\n";
							$coutput .= '<label>Height</label>' . "\n";
							$coutput .= '<input type="text" class="ts-form-text ts-cinput" name="' . esc_attr($cpkey) . '_height" id="' . esc_attr($cpkey) . '_height" value="' . esc_attr($cparam['std']) . '" />' . "\n";
							$coutput .= '</div>' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;
					}
					
					
					/**************************************************************************/
					
					// checks if child has a child shortcode
					// will flesh this out later
                    if( isset( $ts_shortcodes[$this->popup]['child_shortcode']['child_child_shortcode'] ) )
                    {
                        // set child shortcode
                        $this->ccparams = $ts_shortcodes[$this->popup]['child_shortcode']['child_child_shortcode']['params'];
                        $this->ccshortcode = $ts_shortcodes[$this->popup]['child_shortcode']['child_child_shortcode']['shortcode'];

                        // popup parent form row start
                        $pprow_start  = '<tbody>' . "\n";
                        $pprow_start .= '<tr class="form-row has-child">' . "\n";
                        $pprow_start .= '<td>' . "\n";
                        $pprow_start .= '<div class="child-child-clone-rows">' . "\n";

                        // for js use
                        $pprow_start .= '<div id="_ts_ccshortcode" class="hidden">' . $this->ccshortcode . '</div>' . "\n";

                        // start the default row
                        $pprow_start .= '<div class="child-child-clone-row">' . "\n";
                        $pprow_start .= '<ul class="child-child-clone-row-form">' . "\n";

                        // add $prow_start to output
                        $this->append_output( $pprow_start );

                        foreach( $this->ccparams as $ccpkey => $ccparam )
                        {

                            // prefix the fields names and ids with ts_
                            $ccpkey = 'ts_' . $ccpkey;

                            if(!isset($ccparam['std'])) {
                                $ccparam['std'] = '';
                            }

                            if(!isset($ccparam['desc'])) {
                                $ccparam['desc'] = '';
                            }

                            // popup form row start
                            $ccrow_start  = '<li class="child-child-clone-row-form-row clearfix">' . "\n";
                            $ccrow_start .= '<div class="child-child-clone-row-label-desc">' . "\n";
                            $ccrow_start .= '<div class="child-child-clone-row-label">' . "\n";
                            $ccrow_start .= '<label>' . $ccparam['label'] . '</label>' . "\n";
                            $ccrow_start .= '</div>' . "\n";
                            $ccrow_start	.= '<span class="child-child-clone-row-desc">' . $ccparam['desc'] . '</span>' . "\n";
                            $ccrow_start .= '</div>' . "\n";
                            $ccrow_start .= '<div class="child-child-clone-row-field">' . "\n";

                            // popup form row end
                            $ccrow_end    = '</div>' . "\n";
                            $ccrow_end   .= '</li>' . "\n";

                            switch( $ccparam['type'] )
                            {
                                case 'text' :

                                    // prepare
                                    $ccoutput  = $ccrow_start;
                                    $ccoutput .= '<input type="text" class="ts-form-text ts-ccinput" name="' . esc_attr($ccpkey) . '" id="' . esc_attr($ccpkey) . '" value="' . esc_attr($ccparam['std']) . '" />' . "\n";
                                    $ccoutput .= $ccrow_end;

                                    // append
                                    $this->append_output( $ccoutput );

                                    break;
                            }
                        }
                        
                        

                        // popup parent form row end
                        $pprow_end    = '</ul>' . "\n";		// end .child-clone-row-form
                        $pprow_end   .= '<a href="#" class="child-child-clone-row-remove ts-shortcodes-button">'.__('Remove','ThemeStockyard').'</a>' . "\n";
                        $pprow_end   .= '</div>' . "\n";		// end .child-clone-row


                        $pprow_end   .= '</div>' . "\n";		// end .child-clone-rows
                        $pprow_end	.= '<a href="#" id="form-child-child-add">' . $ts_shortcodes[$this->popup]['child_shortcode']['child_child_shortcode']['clone_button'] . '</a>' . "\n";
                        $pprow_end   .= '</td>' . "\n";
                        $pprow_end   .= '</tr>' . "\n";
                        $pprow_end   .= '</tbody>' . "\n";

                        // add $prow_end to output
                        $this->append_output( $pprow_end );
                    }
					
					/***************************************************************************/
				}

				// popup parent form row end
				$prow_end    = '</ul>' . "\n";		// end .child-clone-row-form
				$prow_end   .= '<a href="#" class="child-clone-row-remove ts-shortcodes-button">'.__('Remove','ThemeStockyard').'</a>' . "\n";
				$prow_end   .= '</div>' . "\n";		// end .child-clone-row


				$prow_end   .= '</div>' . "\n";		// end .child-clone-rows
				$prow_end	.= '<a href="#" id="form-child-add">' . $ts_shortcodes[$this->popup]['child_shortcode']['clone_button'] . '</a>' . "\n";
				$prow_end   .= '</td>' . "\n";
				$prow_end   .= '</tr>' . "\n";
				$prow_end   .= '</tbody>' . "\n";

				// add $prow_end to output
				$this->append_output( $prow_end );
			}
		}
	}

	// --------------------------------------------------------------------------

	function append_output( $output )
	{
		$this->output = $this->output . "\n" . $output;
	}

	// --------------------------------------------------------------------------

	function reset_output( $output )
	{
		$this->output = '';
	}
	
	// --------------------------------------------------------------------------
	
	function get_the_output()
	{
        return $this->output;
    }

	// --------------------------------------------------------------------------

	function append_error( $error )
	{
		$this->errors = $this->errors . "\n" . $error;
	}
}