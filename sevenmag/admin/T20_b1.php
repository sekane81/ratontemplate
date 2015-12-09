<?php
class T20_first extends tt_module {
	function __construct($post) {
		//run the parrent constructor
		parent::__construct($post);
	}
	function render() {
		$buffy = '';
		$buffy .= '<div class="item wgr T_post introfx">';
		$buffy .= $this->get_image_wgr('first-post');
		$buffy .= $this->get_review();
		$buffy .= '<div class="details">';
		$buffy .= '<span class="s_category">';
		$buffy .= $this->get_date_o();
		$buffy .= $this->get_author_o();
		$buffy .= '</span><span class="more_meta">';
		$buffy .= $this->get_comments_o();
		$buffy .= '</span></div></div>';
		return $buffy;
	}
}

class T20_more extends tt_module {
	function __construct($post) {
		//run the parrent constructor
		parent::__construct($post);
	}
	function render() {
		$buffy = '';
		$buffy .= '<div class="item_small T_post">';
		$buffy .= $this->get_image('thumbnail');
		$buffy .= '<div class="item-details">';
		$buffy .= $this->get_title();
		$buffy .= '<div class="post_meta">';
		$buffy .= $this->get_date_o();
		$buffy .= $this->get_comments_o();
		$buffy .= '</div>';
		$buffy .= '</div>';
		$buffy .= '</div>';
		return $buffy;
	}
}
class T20_a_1 extends tt_block {

	function __construct() {
		$this->block_id = 1;
		add_shortcode('tt_block1', array($this, 'render'));
	}

	function render($atts) {
		$this->block_uid = uniqid(); //update unique id on each render

		global $post;
		extract(shortcode_atts(
		array(
			'limit' 		=> 5,
			'sort' 		=> '',
			'category_id' 	=> '',
			'category_ids' 	=> '',
			'custom_title' 	=> '',
			'custom_url' 	=> '',
			'hide_title' 	=> '',
			'show_child_cat' 	=> '',
			'tag_slug' 	=> '',
			'header_color' 	=> ''
		),$atts));

		$buffy = ''; //output buffer

		//go only on one category that was selected from drop down
		if (!empty($category_id) and empty($category_ids)) {
			$atts['category_ids'] = $category_id;
		}

		//do the query
		$tt_data_source = new tt_data_source(); //new data source
		$tt_query = &$tt_data_source->get_wp_query($atts); //by ref  do the query

		// Block Title
		$buffy .= $this->get_block_title($atts, $tt_data_source);

		$buffy .= '<div class="b_block b_1 clearfix">';

		//inner content of the block
		$buffy .= $this->inner($tt_query->posts);

		$buffy .= '</div> <!-- ./block1 -->';
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

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$T20_first = new T20_first($post);
				$T20_more = new T20_more($post);
	
				switch ($tt_column_number) {
					case '1': 
						if ($tt_post_count == 0) {
							if ( is_rtl() ) { 
								$first_rtl = 'grid_6 omega righter';
								$sec_rtl = 'grid_6 alpha lefter';
							} else {
								$first_rtl = 'grid_6 alpha';
								$sec_rtl = 'grid_6 omega';
							}
							$buffy .= '<div class="first_post '.$first_rtl.'">';
							$buffy .= $T20_first->render();
							$buffy .= '</div><div class="more_posts introfxo '.$sec_rtl.'">';
						} else {
							$buffy .= $T20_more->render();
						}
					break;
				}
				$tt_post_count++;
			}
			$buffy .= '</div>';
		}
		$buffy .= $tt_block_layout->close_all_tags();
		return $buffy;
	}

	function get_map() {
		return array(
            "name" => __("Block 1", TT_THEME_NAME),
            "base" => "tt_block1",
            "class" => "tt_block1",
            "controls" => "full",
            "category" => __('Blocks', TT_THEME_NAME),
            'icon' => 'icon-pagebuilder-block1',
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

tt_global_blocks::add_instance('Block 1', new T20_a_1());

?>