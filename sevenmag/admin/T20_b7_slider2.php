<?php
class T20_slider_22 extends tt_module {
	function __construct($post) {
		parent::__construct($post);
	}
	function render() {
		$buffy = '';
		$buffy .= '<li><article class="item wgr T_post introfx" id="post-'.$this->post->ID.'">';
		$buffy .= $this->get_image_wgr('post-big-default');
		$buffy .= $this->get_review();
		$buffy .= '<div class="details">';
		$buffy .= '<span class="s_category">';
		$buffy .= $this->get_date_o();
		$buffy .= $this->get_author_o();
		$buffy .= '</span><span class="more_meta">';
		$buffy .= $this->get_comments_o();
		$buffy .= '</span></div>';
		$buffy .= '</article></li>';
		return $buffy;
	}
}

class T20_slider2_7 extends tt_block {
	function __construct() {
		$this->block_id = 7;
		add_shortcode('tt_block7', array($this, 'render'));
	}

	function render($atts){
		$this->block_uid = uniqid(); //update unique id on each render
		global $post;

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
			'tag_slug' => '',
			'header_color' => ''
		),$atts));

		$buffy = ''; //output buffer
		$tt_unique_id = uniqid();


		//go only on one category that was selected from drop down
		if (!empty($category_id) and empty($category_ids)) {
			$atts['category_ids'] = $category_id;
		}

		$tt_data_source = new tt_data_source(); //new data source
		$tt_query = &$tt_data_source->get_wp_query($atts); //by ref  do the query
	
		$buffy .= '<div class="b_5 mbf"><div id="slideshowt"><div id="Flexslidert" class="slider_content flexslider" ><ul class="slides">';	
		$buffy .= $this->inner($tt_query->posts);
		$buffy .= '</ul></div><div class="slider_tabs"><ul class="tabs" id="slider_nav">';
		$buffy .= $this->inner($tt_query->posts);
		$buffy .= '</ul></div></div></div>';
		return $buffy;
	}

	function inner($posts, $tt_column_number = '') {
		global $post;

		$buffy = '';

		$tt_block_layout = new tt_block_layout();
		if (empty($tt_column_number)) {
			$tt_column_number = $tt_block_layout->get_column_number(); // get the column width of the block
		}
		$tt_post_count = 0; // the number of posts rendered
		$tt_current_column = 1; //the current column

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$T20_slider_22 = new T20_slider_22($post);
				switch ($tt_column_number) {
					case '1':
						$buffy .= $T20_slider_22->render($post);
					break;
				}

				//current column
				if ($tt_current_column == $tt_column_number) {
					$tt_current_column = 1;
				} else {
					$tt_current_column++;
				}
			
			
				$tt_post_count++;
			}
		}
		$buffy .= $tt_block_layout->close_all_tags();
		return $buffy;
	}


    function get_map () {
        return array(
            "name" => __("Slideshow 2", TT_THEME_NAME),
            "base" => "tt_block7",
            "class" => "tt_block7",
            "controls" => "full",
            "category" => __('Blocks', TT_THEME_NAME),
            'icon' => 'icon-pagebuilder-block7',
            "params" => array(
                array(
                    "param_name" => "category_id",
	        "admin_label" => true,
                    "type" => "dropdown",
                    "value" => tt_get_category2id_array(),
                    "heading" => __("Category filter:", TT_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "category_ids",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Multiple categories filter:", TT_THEME_NAME),
                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 13,23,18)",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "tag_slug",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Filter by tag slug:", TT_THEME_NAME),
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "limit",
                    "type" => "textfield",
                    "value" => __("5", TT_THEME_NAME),
                    "heading" => __("Limit post number:", TT_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "sort",
                    "type" => "dropdown",
                    "value" => array('- Latest -' => '', 'Popular' => 'popular'),
                    "heading" => __("Sort order:", TT_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                )
            )
        );
    }

}

tt_global_blocks::add_instance('Block 7', new T20_slider2_7());

?>