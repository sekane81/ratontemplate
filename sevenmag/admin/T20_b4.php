<?php
class T20_d_2 extends tt_module {
	function __construct($post) {
		parent::__construct($post);
	}
	function render() {
		$buffy = '';
		$buffy .= '<div class="item T_post introfx">';
		$buffy .= $this->get_image('carousel-block');
		$buffy .= $this->get_review();
		$buffy .= '<div class="details">';
		$buffy .= $this->get_title();
		$buffy .= $this->get_date_o();
		$buffy .= '</div></div>';
		return $buffy;
	}
}

class T20_d_4 extends tt_block {
	function __construct() {
		$this->block_id = 4;
		add_shortcode('tt_block4', array($this, 'render'));
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
	
		// Block title
		$buffy .= $this->get_block_title($atts, $tt_data_source);
	
		$buffy .= '<div class="b_block b_4"><div id="block_carousel" class="carousel_posts_block owl-carousel">';

		$buffy .= $this->inner($tt_query->posts);

		$buffy .= '</div></div>';
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

		$T20_d_2 = new T20_d_2($post);

		switch ($tt_column_number) {

			case '1':
				$buffy .= $T20_d_2->render($post);
			break;
		
			case '2': 
				$buffy .= $T20_d_2->render($post);
			break;
		
			case '3': 
				$buffy .= $T20_d_2->render($post);
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
            "name" => __("Carousel Posts", TT_THEME_NAME),
            "base" => "tt_block4",
            "class" => "tt_block4",
            "controls" => "full",
            "category" => __('Blocks', TT_THEME_NAME),
            'icon' => 'icon-pagebuilder-block4',
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
                    "value" => __("9", TT_THEME_NAME),
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
                ),
                array(
                    "param_name" => "custom_title",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Optional - custom title for this block:", TT_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "custom_url",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Optional - custom url for this block (when the module title is clicked):", TT_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "hide_title",
                    "type" => "dropdown",
                    "value" => array('- Show title -' => '', 'Hide title' => 'hide_title'),
                    "heading" => __("Hide block title:", TT_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                )
            )
        );
    }

}

tt_global_blocks::add_instance('Block 4', new T20_d_4());

?>