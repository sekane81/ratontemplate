<?php

define("TT_THEME_NAME", "T20");
define("TT_THEME_NAME_URL", "T20");
define("TT_THEME_VERSION", "1.0");
define("TT_FEATURED_CAT", "Featured"); //featured cat name
define("TT_FEATURED_CAT_SLUG", "featured"); //featured cat slug
define("TT_THEME_OPTIONS_NAME", "tt_008"); //where to store our options
define("TT_THEME_WP_CAKE_VER", "1"); //used by plugins to determine if they can run ok or not.

class tt_global_blocks {
	private static $global_instances = array();

	static function add_instance($block_name, $block_instance) {
		self::$global_instances[$block_instance->block_id] = array (
			'id' => $block_instance->block_id,
			'name' => $block_name,
			'instance' => $block_instance
		);
	}

	static function get_instance($block_id) {
		return self::$global_instances[$block_id]['instance'];
	}

	static function wpb_map_all() {
		foreach (self::$global_instances as $block_array) {
			wpb_map($block_array['instance']->get_map());
		}
	}

	static function debug_get_all_instances() {
		return self::$global_instances;
	}
}





class tt_util {
    static $tt_customizer_settings; //we keep a instance of tt_customizer_settings here


    //returns the $class if the variable is not empty or false
    static function if_show($variable, $class) {
        if ($variable !== false and !empty($variable)) {
            return ' ' . $class;
        } else {
            return '';
        }
    }

    //returns the class if the variable is empty or false
    static function if_not_show($variable, $class){
        if ($variable === false or empty($variable)) {
            return ' ' . $class;
        } else {
            return '';
        }
    }







    //reads a theme option from wp
    static function get_option($optionName) {
        $theme_options = get_option(TT_THEME_OPTIONS_NAME);
        if (!empty($theme_options[$optionName])) {
            return $theme_options[$optionName];
        } else {
            return;
        }
    }

    //updates a theme option
    static function update_option($optionName, $newValue) {
        $theme_options = get_option(TT_THEME_OPTIONS_NAME);
        //print_r($optionName);
        $theme_options[$optionName] = $newValue;
        update_option(TT_THEME_OPTIONS_NAME, $theme_options);
    }



    static function cut_title($cut_parms, $title) {
        //trim and get the excerpt
        $title = trim($title);
        $title = tt_excerpt($title,$cut_parms['excerpt']);

        //get an array of chars
        $title_chars = str_split($title);


        $buffy = '';
        $current_char_on_line = 0;
        $has_to_cut = false; //when true, the string will be cut

        foreach ($title_chars as $title_char) {
            //check if we reached the limit
            if ($cut_parms['char_per_line'] == $current_char_on_line) {
                $has_to_cut = true;
                $current_char_on_line = 0;
            } else {
                $current_char_on_line++;
            }

            if ($title_char == ' ' and $has_to_cut === true) {
                //we have to cut, it's a white space so we ignore it (not added to buffy)
                $buffy .= $cut_parms['line_wrap_end'] . $cut_parms['line_wrap_start'];
                $has_to_cut = false;
            } else {
                //normal loop
                $buffy .= $title_char;
            }

        }

        //wrap the string
        return $cut_parms['line_wrap_start'] . $buffy . $cut_parms['line_wrap_end'];
    }


    /*
     * gets the blog page url (only if the blog page is configured in theme customizer)
     */
    static function get_home_url() {
        if( get_option('show_on_front') == 'page') {
            $posts_page_id = get_option( 'page_for_posts');
            return get_permalink($posts_page_id);
        } else {
            return false;
        }
    }


    //gets the sidebar setting or default if no sidebar is selected for a specific setting id
    static function show_sidebar($template_id) {
        $tts_cur_sidebar = tt_util::get_option('tts_' . $template_id . '_sidebar');
        if (!empty($tts_cur_sidebar)) {
            dynamic_sidebar($tts_cur_sidebar);
        } else {
            //show default
            if (!dynamic_sidebar(TT_THEME_NAME . ' default')) {
                ?>
                <!-- .no sidebar -->
            <?php
            }
        }
    }


    static function get_image_attachment_data($post_id, $size = 'thumbnail', $count = 1 ) {
        $objMeta = array();
        $meta = '';// (sttClass)
        $args = array(
            'numberposts' => $count,
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'nopaging' => false,
            'post_mime_type' => 'image',
            'order' => 'ASC', // change this to reverse the order
            'orderby' => 'menu_order ID', // select which type of sorting
            'post_status' => 'any'
        );

        $attachments = get_children($args);

        if ($attachments) {
            foreach ($attachments as $attachment) {
                $meta = new sttClass();
                $meta->ID = $attachment->ID;
                $meta->title = $attachment->post_title;
                $meta->caption = $attachment->post_excerpt;
                $meta->description = $attachment->post_content;
                $meta->alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

                // Image properties
                $props = wp_get_attachment_image_src( $attachment->ID, $size, false );

                $meta->properties['url'] = $props[0];
                $meta->properties['width'] = $props[1];
                $meta->properties['height'] = $props[2];

                $objMeta[] = $meta;
            }

            return ( count( $attachments ) == 1 ) ? $meta : $objMeta;
        }
    }


    //converts a sidebar name to an id that can be used by word press
    static function sidebar_name_to_id($sidebar_name) {
        $clean_name = str_replace(array(' '), '-', trim($sidebar_name));
        $clean_name = str_replace(array("'", '"'), '', trim($clean_name));
        return strtolower($clean_name);
    }



    /*  ----------------------------------------------------------------------------
        used by the css compiler in /includes/app/tt_css_generator.php
     */
    static function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Format the hex color string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Get decimal values
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));

        // Adjust number of steps and keep it inside 0 to 255
        $r = max(0,min(255,$r + $steps));
        $g = max(0,min(255,$g + $steps));
        $b = max(0,min(255,$b + $steps));

        $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
        $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
        $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

        return '#'.$r_hex.$g_hex.$b_hex;
    }


    //converts a hex to rgba
    static function hex2rgba($hex, $opacity) {
        if ( $hex[0] == '#' ) {
            $hex = substr( $hex, 1 );
        }
        if ( strlen( $hex ) == 6 ) {
            list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[2] . $hex[3], $hex[4] . $hex[5] );
        } elseif ( strlen( $hex ) == 3 ) {
            list( $r, $g, $b ) = array( $hex[0] . $hex[0], $hex[1] . $hex[1], $hex[2] . $hex[2] );
        } else {
            return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return "rgba($r, $g, $b, $opacity)";
    }

}





function tt_excerpt($post_content, $limit, $show_shortcodes = '') {

    if ($show_shortcodes == '') {
        $post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
    }


    $excerpt = explode(' ', $post_content, $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }


    $excerpt = esc_attr(strip_tags($excerpt));



    if (trim($excerpt) == '...') {
        return '';
    }

    return $excerpt;
}




//used by page builder
function tt_get_category2id_array($add_all_category = true) {


    $categories = get_categories(array(
        'hide_empty' => 0
    ));
    $categories_parents = array();
    $categories_childs = array();

    if ($add_all_category) { //add all categories if necessary
        $categories_buffer['- All categories -'] = '';
    }


    foreach ($categories as $category) {
        if ($category->category_parent == 0) {
            $categories_parents[$category->name] =  $category->term_id;
        } else {
            $categories_childs[$category->category_parent][$category->name] = $category->term_id;
        }
    }
    ksort ($categories_parents);
    foreach ($categories_parents as $category_name => $category_id) {
        $categories_buffer[$category_name] = $category_id;
        if (!empty($categories_childs[$category_id])) {
            ksort ($categories_childs[$category_id]);
            foreach ($categories_childs[$category_id] as $child_name => $child_id) {
                $categories_buffer[' - ' . $child_name] = $child_id;
            }
        }
    }

    $tt_category_structure_buffer = $categories_buffer;


    return $categories_buffer;
}

//used in css include functions
function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}


function tt_parse_class_name($name) {
    return str_replace(' ', '_', $name);
}




/*  ----------------------------------------------------------------------------
    mbstring support
 */

if (!function_exists('mb_strlen')) {
    function mb_strlen ($string) {
        return strlen($string);
    }
}

if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack,$needle,$offset=0) {
        return strpos($haystack,$needle,$offset);
    }
}
if (!function_exists('mb_strrpos')) {
    function mb_strrpos ($haystack,$needle,$offset=0) {
        return strrpos($haystack,$needle,$offset);
    }
}
if (!function_exists('mb_strtolower')) {
    function mb_strtolower($string) {
        return strtolower($string);
    }
}
if (!function_exists('mb_strtoupper')) {
    function mb_strtoupper($string){
        return strtoupper($string);
    }
}
if (!function_exists('mb_substr')) {
    function mb_substr($string,$start,$length) {
        return substr($string,$start,$length);
    }
}





class tt_block_layout {
	var $row_is_open = false;

	function open_row() {
		if ($this->row_is_open) {
			//open row only onece
			return;
		}
		$this->row_is_open = true;
		return "\n\n\t" . '<div class="clearfix">';
	}

	function close_row() {
		$this->row_is_open = false;
		return '</div><!--./clearfix-->';
	}

	function is_row_open() {
		return $this->row_is_open;
	}

	function close_all_tags() {
		$buffy = '';
		if ($this->row_is_open) {
			$buffy .= $this->close_row();
		}
		return $buffy;
	}

	function get_column_number() {
		global $tt_row_count, $tt_column_count;

		if ($tt_row_count == 1) {
			//first row
			switch ($tt_column_count) {
				case '1/1':
					return 3;
				break;
		
				case '2/3' :
					return 2;
				break;
			
				case '1/3' :
					return 1;
				break;
			
				case '1/2': //half a row + sidebar
					return 2;
				break;
			}
		} else {
			//row in row
			if ($tt_column_count == '1/2') {
				return 1;
			}

			if ($tt_column_count == '1/3') {
				// works if parent is empty (1/1)
				return 1;
			}
		}

		return 1;
	}
}




class tt_data_source {
    var $block_name; //used by block title
    var $block_link;

    function tt_data_source() {
        $this->block_name = '';
        $this->block_link = '';
    }

    //$paged is used by ajax
    function &get_wp_query ($atts = '', $paged = '') { //by ref
        extract(shortcode_atts(
                array(
                    'category_ids' => '',
                    'tag_slug' => '',
                    'sort' => '',
                    'limit' => 5
                ),
                $atts
            )
        );

	$args = array(
		'showposts' => $limit,
		'ignore_sticky_posts' => 1
	);


        if (!empty($paged)) {
            $args['paged'] = $paged;
        } else {
            $args['paged'] = 1;
        }

        if (!empty($category_ids)) {
            $args['cat'] = $category_ids;
        }

        if (!empty($category_ids)) {
            //@todo fix this / make this faster
            $cat_id_array = explode (',', $category_ids);
            foreach ($cat_id_array as &$cat_id) {
                $cat_id = trim($cat_id);
                //get the category object
                $tt_tmp_cat_obj =  get_category($cat_id);
                if (empty($this->block_name)) {
                    //print_r($tt_tmp_cat_obj);
                    if (!empty($tt_tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $this->block_link = get_category_link($tt_tmp_cat_obj->cat_ID);
                        $this->block_name = mb_strtoupper($tt_tmp_cat_obj->name);
                    }
                } else {
                    $this->block_name = $this->block_name . ' - ' . mb_strtoupper($tt_tmp_cat_obj->name);
                }
                unset($tt_tmp_cat_obj);
            }
        }


        if (!empty($tag_slug)) {
            $args['tag'] = $tag_slug;
        }

        switch ($sort) {
            case 'featured':
                if (!empty($category_ids)) {
                    //for each category, get the object and compose the slug
                    $cat_id_array = explode (',', $category_ids);

                    foreach ($cat_id_array as &$cat_id) {
                        $cat_id = trim($cat_id);

                        //get the category object
                        $tt_tmp_cat_obj =  get_category($cat_id);

                        //make the $args
                        if (empty($args['category_name'])) {
                            $args['category_name'] = $tt_tmp_cat_obj->slug; //get by slug (we get the children categories too)
                        } else {
                            $args['category_name'] .= ',' . $tt_tmp_cat_obj->slug; //get by slug (we get the children categories too)
                        }
                        unset($tt_tmp_cat_obj);
                    }
                }

                $args['cat'] = get_cat_ID(TT_FEATURED_CAT); //add the fetured cat
                break;
            case 'popular':
                $args['meta_key'] = 'post_views_count';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';

                break;
        }

        //print_r($args);

        //only show published posts
        $args['post_status'] = 'publish';

        $tt_query = new WP_Query($args);
        wp_reset_query();
        return $tt_query;
    }



    function &get_wp_query_search($search_string) {
        $args = array(
            's' => $search_string,
            'post_type' => array('post'),
            'posts_per_page' => 4
        );

        $tt_query = new WP_Query($args);
        wp_reset_query();
        return $tt_query;
    }
}










class tt_block {
	var $block_id; // the block type
	var $block_uid; // the block unique id, it changes on every render

	/**
	* Used by blocks that don't need auto generated titles. If default is empty and no title is set it will remove the title from the block
	*/
	function get_block_title_raw($atts, $default_title = '', $default_url = '') {
		extract(shortcode_atts(
		array(
			'custom_title' => '',
			'custom_url' => '',
			'hide_title' => '',
			'header_color' => '',
			'header_text_color' => ''
		),$atts));

		if (empty($custom_title) and empty($default_title)) {
			//no title selected, and no default title - do nothing
			return;
		}
		$buffy = '';

		$title = $default_title;
		$url = $default_url;
	
		if ($hide_title != 'hide_title') {
			// read the custom url and title from the shortcode
			if (!empty($custom_title)) {
				$title = $custom_title;
			}

			if (!empty($custom_url)) {
				$url = $custom_url;
			}

			$buffy .= '<div class="b_title"><h4>';
			if (!empty($url)) {
				$buffy .= '<a href="' . $url . '">' . $title . '</a>';
			} else {
				$buffy .= '<span>' . $title . '</span>';
			}
			$buffy .= '</h4></div>';

		}

		return $buffy;
	}

	/**
	* Used by blocks that need auto generated titles
	*/
	function get_block_title($atts, $tt_data_source) {
		extract(shortcode_atts(
		array(
			'limit' => 5,
			'sort' => '',
			'category_id' => '',
			'category_ids' => '',
			'custom_title' => '',
			'custom_url' => '',
			'hide_title' => '',
			'show_child_cat' => '',
			'header_color' => '',
			'header_text_color' => ''
		),$atts));

		$buffy = '';
		$css_buffer = '';
		if (!empty($show_child_cat) and !empty($category_id)) {
			$css_buffer = ' block-title-subcats';
		}

		//show the block title
		if ($hide_title != 'hide_title') {
			$buffy .= '<div class="b_title' . $css_buffer . '"><h4>';
			if (empty($custom_title)) {
				//@todo remove empty title space
				if (empty($custom_url)) {
					//all is autogenerated
					$buffy .= '<a href="' . $tt_data_source->block_link . '">' . $tt_data_source->block_name . '</a>';
				} else {
					//just custom url by user, the title is autogenerated
					$buffy .= '<a href="' . $custom_url . '">' . $tt_data_source->block_name . '</a>';
				}
			} else {
				if (empty($custom_url)) {
					//url is autogenerated
					if (empty($tt_data_source->block_link)) {
						//no url? - popular files for example dosn't have a url
						$buffy .= '<span>' . $custom_title . '</span>';
					} else {
						//url is present
						$buffy .= '<a href="' . $tt_data_source->block_link . '">' . $custom_title . '</a>';
					}
				} else {
					//url is custom + custom title
					$buffy .= '<a href="' . $custom_url . '">' . $custom_title . '</a>';
				}
			}
			$buffy .= '</h4></div>';
		}
		return $buffy;
	}
}


load_template( get_template_directory() . '/admin/T20_m.php' );
load_template( get_template_directory() . '/admin/T20_b1.php' );
load_template( get_template_directory() . '/admin/T20_b2.php' );
load_template( get_template_directory() . '/admin/T20_b3.php' );
load_template( get_template_directory() . '/admin/T20_b4.php' );
load_template( get_template_directory() . '/admin/T20_b5_slider.php' );
load_template( get_template_directory() . '/admin/T20_b7_slider2.php' );
load_template( get_template_directory() . '/admin/T20_b6.php' );
load_template( get_template_directory() . '/admin/T20_b8.php' );
load_template( get_template_directory() . '/admin/T20_b9.php' );

do_action('T20_wp_cake_loaded'); //used by our plugins

?>