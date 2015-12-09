<?php

class tt_module {
	var $post;

	var $title_attribute;
	var $title;
	var $href;

	//constructor
	function __construct($post) {
		$this->post = $post;
		
		$this->title = get_the_title($post->ID);
		$this->title_attribute = esc_attr(strip_tags($this->title));
		$this->href = get_permalink($post->ID);
	
		if (has_post_thumbnail($this->post->ID)) {
			$this->post_has_thumb = true;
		} else {
			$this->post_has_thumb = false;
		}

		global $post;
		$this->heading	= get_post_meta( $post->ID, 'wp_review_heading', true );
		$this->type	= get_post_meta( $post->ID, 'wp_review_type', true );
		$this->total	= get_post_meta( $post->ID, 'wp_review_total', true );
	}

	function get_author() {
		$buffy = '';
		$buffy .= '<a href="' . get_author_posts_url($this->post->post_author) . '" class="toptip" title="';
		$buffy .= get_the_author_meta('display_name', $this->post->post_author);
		$buffy .= '"><i class="icon-user"></i></a>';
		return $buffy;
	}

	function get_author_o() {
		$buffy = '';
		$buffy .= '<a href="' . get_author_posts_url($this->post->post_author) . '"><i class="icon-user mi"></i>';
		$buffy .= get_the_author_meta('display_name', $this->post->post_author);
		$buffy .= '</a>';
		return $buffy;
	}

	function get_date() {
		$buffy = '';
		$post_link = $this->href;
		$buffy .= '<a href="' . $post_link . '" class="toptip" title="';
		$buffy .= get_the_time(get_option('date_format'), $this->post->ID);
		$buffy .= '"><i class="icon-calendar"></i></a>';
		return $buffy;
	}

	function get_date_o() {
		$buffy = '';
		$post_link = $this->href;
		$buffy .= '<a class="date_c" href="' . $post_link . '"><i class="icon-calendar mi"></i>';
		$buffy .= get_the_time(get_option('date_format'), $this->post->ID);
		$buffy .= '</a>';
		return $buffy;
	}

	function get_review() {
		$buffy = '';
		if ( $this->total ) {
			$buffy .= '<div class="tt_review">';
			if ( 'star' == $this->type ) {
				$result = $this->total * 20;
				$bestresult = '<meta itemprop="best" content="5"/>';
				$best = '5';
			} elseif( 'point' == $this->type ) {
				$result = $this->total * 10;
				$bestresult = '<meta itemprop="best" content="10"/>';
				$best = '10';
			} else {
				$result = $this->total * 100 / 100;
				$bestresult = '<meta itemprop="best" content="100"/>';
				$best = '100';
			}

			if ( 'star' == $this->type ) {
				$buffy .= '<div class="tt_star" title="' . $this->heading . '">';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<div class="review_w_out" style="width:' . $result . '%;">';
				$buffy .= '<div class="review_w">';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '<i class="fa fa-star"></i>';
				$buffy .= '</div></div></div>';
			} elseif ( 'point' == $this->type ) {
				$buffy .= '<div class="tt_point">';
				$buffy .= '<div class="tt_val">' . $this->total . '</div>';
				if( $this->heading != '' ){
					$buffy .= '<span class="tt_title">' . $this->heading . '</span>';
				}
				$buffy .= '</div>';
			} else {
				$buffy .= '<div class="tt_percentage">';
				$buffy .= '<div class="tt_val">' . $result . '%</div>';
				if( $this->heading != '' ){
					$buffy .= '<span class="tt_title">' . $this->heading . '</span>';
				}
				$buffy .= '</div>';
			}
			$buffy .= '</div>';
		}
		return $buffy;
	}

	function get_comments() {
		$buffy = '';
		$buffy .= '<a href="' . get_comments_link($this->post->ID) . '" class="toptip" title="';
		$buffy .= get_comments_number($this->post->ID);
		$buffy .= '"><i class="icon-message"></i></a>';
		return $buffy;
	}

	function get_comments_o() {
		$buffy = '';
		$buffy .= '<a href="' . get_comments_link($this->post->ID) . '"><i class="icon-message mi"></i>';
		$buffy .= get_comments_number($this->post->ID);
		$buffy .= '</a>';
		return $buffy;
	}

	function get_category() {
		$buffy = '';
		$buffy .= '<ul class="tt-category">';
		$categories = get_the_category($this->post->ID);
		$cat_array = array();

		if($categories){
			foreach($categories as $category) {
				if ($category->name != TT_FEATURED_CAT) { //ignore the featured category name
					//get the parent of this cat
					$tt_parent_cat_obj = get_category($category->category_parent);
					//show the category, only if we didn't already showed the parent
					$cat_array[$category->name] = array(
						'link' => get_category_link($category->cat_ID)
					);
				}
			}
		}

		foreach ($cat_array as $tt_cat_name => $tt_cat_parms) {
			$buffy .= '<li class="entry-category"><a href="' . $tt_cat_parms['link'] . '">' . $tt_cat_name . '</a></li>';
		}
		$buffy .=  '</ul>';
	
		return $buffy;
	}

	function get_image($thumbType, $image_link = '') {
		$buffy = ''; //the output buffer

		if ($this->post_has_thumb) {
			if ($image_link == '') {
				$image_link = $this->href;
			} else {}

			$attachment_id = get_post_thumbnail_id($this->post->ID);
			$tt_temp_image_url = wp_get_attachment_image_src($attachment_id, $thumbType);

			$attachment_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true );
			$attachment_alt = 'alt="' . esc_attr(strip_tags($attachment_alt)) . '"';

			$attachment_title = ' title="' . $this->title . '"';
			if (empty($tt_temp_image_url[0])) {
				$tt_temp_image_url[0] = '';
			}

			if (empty($tt_temp_image_url[1])) {
				$tt_temp_image_url[1] = '';
		            }
		
			if (empty($tt_temp_image_url[2])) {
				$tt_temp_image_url[2] = '';
		            }

			$buffy .= '<div class="featured_thumb">';
			if (current_user_can('edit_posts')) {
				$buffy .= '<a class="post-edit-link" href="' . get_edit_post_link($this->post->ID) . '">edit</a>';
			}
			$buffy .='<a href="' . $image_link . '" rel="bookmark" title="' . $this->title_attribute . '">';
			$buffy .= '<img src="' . $tt_temp_image_url[0] . '" ' . $attachment_alt . $attachment_title . ' width="' . $tt_temp_image_url[1] . '" height="' . $tt_temp_image_url[2] . '" />';

			if ( has_post_format('video') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-media-play"></i></span>';
			} elseif ( has_post_format('audio') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-music"></i></span>';
			} elseif ( has_post_format('gallery') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-camera"></i></span>';
			} elseif ( is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-star"></i></span>';
			} else {
				$buffy .='<span class="thumb-icon small"><i class="icon-forward"></i></span>';
			}

			$buffy .= '</a>';
			$buffy .= '</div>';

			return $buffy;
		}
	}

	function get_image_news($thumbType, $image_link = '') {
		$buffy = ''; //the output buffer

		if ($this->post_has_thumb) {
			if ($image_link == '') {
				$image_link = $this->href;
			} else {}

			$attachment_id = get_post_thumbnail_id($this->post->ID);
			$tt_temp_image_url = wp_get_attachment_image_src($attachment_id, $thumbType);

			$attachment_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true );
			$attachment_alt = 'alt="' . esc_attr(strip_tags($attachment_alt)) . '"';

			$attachment_title = ' title="' . $this->title . '"';
			if (empty($tt_temp_image_url[0])) {
				$tt_temp_image_url[0] = '';
			}

			if (empty($tt_temp_image_url[1])) {
				$tt_temp_image_url[1] = '';
		            }
		
			if (empty($tt_temp_image_url[2])) {
				$tt_temp_image_url[2] = '';
		            }

			$buffy .= '<div class="more_news_pic featured_thumb">';
			if (current_user_can('edit_posts')) {
				$buffy .= '<a class="post-edit-link" href="' . get_edit_post_link($this->post->ID) . '">edit</a>';
			}
			$buffy .='<a href="' . $image_link . '" rel="bookmark">';
			$buffy .= '<img class="toptip" src="' . $tt_temp_image_url[0] . '" ' . $attachment_alt . $attachment_title . ' width="' . $tt_temp_image_url[1] . '" height="' . $tt_temp_image_url[2] . '" />';

			if ( has_post_format('video') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small toptip" ' . $attachment_title . '><i class="icon-media-play"></i></span>';
			} elseif ( has_post_format('audio') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small toptip" ' . $attachment_title . '><i class="icon-music"></i></span>';
			} elseif ( has_post_format('gallery') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small toptip" ' . $attachment_title . '><i class="icon-camera"></i></span>';
			} elseif ( is_sticky() ) {
				$buffy .='<span class="thumb-icon small toptip" ' . $attachment_title . '><i class="icon-star"></i></span>';
			} else {
				$buffy .='<span class="thumb-icon small toptip" ' . $attachment_title . '><i class="icon-forward"></i></span>';
			}

			$buffy .= '</a>';
			$buffy .= '</div>';

			return $buffy;
		}
	}

	function get_image_wgr($thumbType, $image_link = '') {
		$buffy = ''; //the output buffer

			if ($image_link == '') {
				$image_link = $this->href;
			} else {}

			$attachment_id = get_post_thumbnail_id($this->post->ID);
			$tt_temp_image_url = wp_get_attachment_image_src($attachment_id, $thumbType);

			$attachment_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true );
			$attachment_alt = 'alt="' . esc_attr(strip_tags($attachment_alt)) . '"';

			$attachment_title = ' title="' . $this->title . '"';
			if (empty($tt_temp_image_url[0])) {
				$tt_temp_image_url[0] = '';
			}

			if (empty($tt_temp_image_url[1])) {
				$tt_temp_image_url[1] = '';
		            }
		
			if (empty($tt_temp_image_url[2])) {
				$tt_temp_image_url[2] = '';
		            }

		if ($this->post_has_thumb) {

			$buffy .= '<div class="featured_thumb">';
			if (current_user_can('edit_posts')) {
				$buffy .= '<a class="post-edit-link" href="' . get_edit_post_link($this->post->ID) . '">edit</a>';
			}
			$buffy .='<a class="first_A" href="' . $image_link . '" rel="bookmark" title="' . $this->title_attribute . '">';
			$buffy .= '<img src="' . $tt_temp_image_url[0] . '" ' . $attachment_alt . $attachment_title . ' width="' . $tt_temp_image_url[1] . '" height="' . $tt_temp_image_url[2] . '" />';

			if ( has_post_format('video') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-media-play"></i></span>';
			} elseif ( has_post_format('audio') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-music"></i></span>';
			} elseif ( has_post_format('gallery') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-camera"></i></span>';
			} elseif ( is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-star"></i></span>';
			} else {
				$buffy .='<span class="thumb-icon small"><i class="icon-forward"></i></span>';
			}

			$buffy .= '<h3>';
			if (!empty($excerpt_lenght)) {
				$buffy .= tt_excerpt($this->title, $excerpt_lenght, 'show_shortcodes');
			} else {
				$buffy .= $this->title;
			}
			$buffy .= '</h3>';
			$buffy .= '</a>';
			$buffy .= '</div>';

			return $buffy;
		} else {
			$buffy .= '<div class="featured_thumb">';
			if (current_user_can('edit_posts')) {
				$buffy .= '<a class="post-edit-link" href="' . get_edit_post_link($this->post->ID) . '">edit</a>';
			}
			$buffy .='<a class="first_A" href="' . $image_link . '" rel="bookmark" title="' . $this->title_attribute . '">';
			$buffy .= '<img src="'.get_template_directory_uri().'/images/empty.png" />';

			if ( has_post_format('video') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-media-play"></i></span>';
			} elseif ( has_post_format('audio') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-music"></i></span>';
			} elseif ( has_post_format('gallery') && !is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-camera"></i></span>';
			} elseif ( is_sticky() ) {
				$buffy .='<span class="thumb-icon small"><i class="icon-star"></i></span>';
			} else {
				$buffy .='<span class="thumb-icon small"><i class="icon-forward"></i></span>';
			}

			$buffy .= '<h3>';
			if (!empty($excerpt_lenght)) {
				$buffy .= tt_excerpt($this->title, $excerpt_lenght, 'show_shortcodes');
			} else {
				$buffy .= $this->title;
			}
			$buffy .= '</h3>';
			$buffy .= '</a>';
			$buffy .= '</div>';

			return $buffy;
		}
	}

	function get_title($excerpt_lenght = '') {
		$buffy = '';
		$buffy .= '<h3>';
		$buffy .='<a href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
		if (!empty($excerpt_lenght)) {
			$buffy .= tt_excerpt($this->title, $excerpt_lenght, 'show_shortcodes');
		} else {
			$buffy .= $this->title;
		}
		$buffy .='</a>';
		$buffy .= '</h3>';
		return $buffy;
	}

	function get_title_a($excerpt_lenght = '') {
		$buffy = '';
		$buffy .='<a href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
		if (!empty($excerpt_lenght)) {
			$buffy .= tt_excerpt($this->title, $excerpt_lenght, 'show_shortcodes');
		} else {
			$buffy .= $this->title;
		}
		$buffy .='</a>';
		return $buffy;
	}

	function get_excerpt($lenght = 25, $show_shortcodes = '') {
		if ($this->post->post_excerpt != '') {
			return $this->post->post_excerpt;
		}
	
		if (empty($lenght)) {
			$lenght = 25;
		}
	
		$buffy = '';
		//print_r($this->post);
		$buffy .= tt_excerpt($this->post->post_content, $lenght, $show_shortcodes);
		return $buffy;
	}
}

?>