<?php

class T20_instagram2 extends WP_Widget {
	const VERSION = '1.1.0';
	protected static $instance = null;	
	public function __construct() {
		$widget_options = array(
			'classname'   => 'widget_instagram',
			'description' => __( 'A widget that displays a slider and thumbs with instagram images ', 'T20' )
		);
		parent::__construct( 'widget_instagram', __('T20 - Instagram Pro', 'T20'), $widget_options );
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
		
	public function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title        = apply_filters('widget_title', $instance['title'] );
		$username     = isset( $instance['username'] ) ? $instance['username'] : '';
		$link_to	  = isset( $instance['images_link'] ) ? $instance['images_link'] : 'image_url';
		$custom_url   = isset( $instance['custom_url'] ) ? $instance['custom_url'] : '';
		$randomise 	  = isset( $instance['randomise'] ) ? true : false;
		$images_nr    = isset( $instance['images_number'] ) ? $instance['images_number'] : 5;
		$refresh_hour = isset( $instance['refresh_hour'] ) ? $instance['refresh_hour'] : 5;
		$template	  = isset( $instance['template'] ) ? $instance['template'] : 'slider';
		$attachment   = isset( $instance['attachment'] ) ? true : false;

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$insta_data = $this->instagram_data( $username, $refresh_hour, $images_nr, $attachment );

		$insta_data = $this->randomise( $insta_data, $randomise );

		$this->template( $template, $insta_data, $link_to, $custom_url );
		
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['username']      = $new_instance['username'];
		$instance['template']      = $new_instance['template'];
		$instance['images_link']   = $new_instance['images_link'];	
		$instance['custom_url']    = $new_instance['custom_url'];		
		$instance['randomise']     = $new_instance['randomise'];
		$instance['images_number'] = $new_instance['images_number'];
		$instance['refresh_hour']  = $new_instance['refresh_hour'];
		$instance['attachment']    = $new_instance['attachment'];

		return $instance;
	}

	public function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' 		=> __('Instagram', 'T20'),
			'username' 	=> '',
			'template' 	=> 'slider',
			'images_link' 	=> 'local_image_url',
			'custom_url'	=> '',
			'randomise'	=> 0,
			'images_number' => 5,
			'refresh_hour' 	=> 5,
			'attachment' 	=> 0,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'T20'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Instagram Username:', 'T20'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
        <p>
          <label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e( 'Images Layout', 'T20' ); ?>
          <select class="widefat" name="<?php echo $this->get_field_name( 'template' ); ?>">
          <option value="slider" <?php echo ($instance['template'] == 'slider') ? ' selected="selected"' : ''; ?>><?php _e( 'Slideshow', 'T20' ); ?></option>
          <option value="thumbs" <?php echo ($instance['template'] == 'thumbs') ? ' selected="selected"' : ''; ?>><?php _e( 'Thumbnails', 'T20' ); ?></option>
          </select>  
          </label>
       </p>
       <p>
            <?php _e('Link Images To:', 'T20'); ?><br>
            <label><input type="radio" id="<?php echo $this->get_field_id( 'images_link' ); ?>" name="<?php echo $this->get_field_name( 'images_link' ); ?>" value="image_url" <?php checked( 'image_url', $instance['images_link'] ); ?> /> <?php _e('Instagram Image', 'T20'); ?></label><br />         
            <label><input type="radio" id="<?php echo $this->get_field_id( 'images_link' ); ?>" name="<?php echo $this->get_field_name( 'images_link' ); ?>" value="user_url" <?php checked( 'user_url', $instance['images_link'] ); ?> /> <?php _e('Instagram Profile', 'T20'); ?></label><br />
            <label><input type="radio" id="<?php echo $this->get_field_id( 'images_link' ); ?>" name="<?php echo $this->get_field_name( 'images_link' ); ?>" value="local_image_url" <?php checked( 'local_image_url', $instance['images_link'] ); ?> /> <?php _e('Locally Saved Image', 'T20'); ?></label><br />
            <label><input type="radio" id="<?php echo $this->get_field_id( 'images_link' ); ?>" name="<?php echo $this->get_field_name( 'images_link' ); ?>" value="custom_url" <?php checked( 'custom_url', $instance['images_link'] ); ?> /> <?php _e('Custom Link', 'T20'); ?></label><br />
         </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_url' ); ?>"><?php _e('Custom Link for Images:', 'T20'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom_url' ); ?>" name="<?php echo $this->get_field_name( 'custom_url' ); ?>" value="<?php echo $instance['custom_url']; ?>" />
			<small><?php _e('* use this field only if the above option is set to <strong>Custom Link</strong>', 'T20'); ?></small>
		</p>
         <p>
            <label for="<?php echo $this->get_field_id( 'randomise' ); ?>"><?php _e( 'Randomise Images:', 'T20' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'randomise' ); ?>" name="<?php echo $this->get_field_name( 'randomise' ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['randomise'] ); ?> />
        </p>       
		<p>
			<label  for="<?php echo $this->get_field_id( 'images_number' ); ?>"><?php _e('Number of Images to Show:', 'T20'); ?>
			<input  class="small-text" id="<?php echo $this->get_field_id( 'images_number' ); ?>" name="<?php echo $this->get_field_name( 'images_number' ); ?>" value="<?php echo $instance['images_number']; ?>" />
			<small><?php _e('( max 20 )', 'T20'); ?></small>
            </label>
		</p>
		<p>
			<label  for="<?php echo $this->get_field_id( 'refresh_hour' ); ?>"><?php _e('Check for new images every:', 'T20'); ?>
			<input  class="small-text" id="<?php echo $this->get_field_id( 'refresh_hour' ); ?>" name="<?php echo $this->get_field_name( 'refresh_hour' ); ?>" value="<?php echo $instance['refresh_hour']; ?>" />
			<small><?php _e('hours', 'T20'); ?></small>
            </label>
		</p>
		<?php
	}

	/**
	 * Randomises an array using php shuffle() function
	 *	 
 	 * @param    array     $data    	    Instagram data array
 	 * @param    bolean    $randomise       True or false to randomise
	 *
	 * @return array of randomised data
	 */
	private function randomise( $data, $randomise = false ) {
	
		if ( true == $randomise )  {
			shuffle( $data );
		}
		return $data;
	}

	/**
	 * Stores the fetched data from instagram in WordPress DB using transients
	 *	 
 	 * @param    string    $username    	Instagram Username to fetch images from
 	 * @param    string    $cache_hours     Cache hours for transient
 	 * @param    string    $nr_images    	Nr of images to fetch from instagram		  	 
	 *
	 * @return array of localy saved instagram data
	 */
	private function instagram_data( $username, $cache_hours, $nr_images, $media_library = false ) {
		
		$opt_name    = 'jr_insta_'.md5( $username );
		$instaData 	 = get_transient( $opt_name );
		$user_opt    = get_option( $opt_name );
	
		if (
			false === $instaData
			|| $user_opt['username']    != $username
			|| $user_opt['cache_hours'] != $cache_hours
			|| $user_opt['nr_images']   != $nr_images
		   )
		{
			$instaData    = array();
			$insta_url    = 'http://instagram.com/';
			$user_profile = $insta_url.$username;
			$json     	  = wp_remote_get( $user_profile, array( 'sslverify' => false, 'timeout'=> 60 ) );
			$user_options = compact('username', 'cache_hours', 'nr_images');
			
			update_option( $opt_name, $user_options );
			
			if ( $json['response']['code'] == 200 ) {
	
				$json 	  = $json['body'];
				$json     = strstr( $json, '{"entry_data"' );

				// Compatibility for version of php where strstr() doesnt accept third parameter
				if ( version_compare( phpversion(), '5.3.10', '<' ) ) {
					$json = substr( $json, 0, strpos($json, '</script>' ) );
				} else {
					$json = strstr( $json, '</script>', true );
				}
				
				$json     = rtrim( $json, ';' );
				
				// Function json_last_error() is not available before PHP * 5.3.0 version
				if ( function_exists( 'json_last_error' ) ) {
				
					( $results = json_decode( $json, true ) ) && json_last_error() == JSON_ERROR_NONE;
				
				} else {
					
					$results = json_decode( $json, true );
				}
				 
				if ( ( $results ) && is_array( $results ) ) {
					foreach( $results['entry_data']['UserProfile'][0]['userMedia'] as $current => $result ) {
			
						if( $current >= $nr_images ) break;
						$caption      = $result['caption'];
						$image        = $result['images']['standard_resolution'];
						$id           = $result['id'];
						$image        = $image['url'];
						$link         = $result['link'];
						$created_time = $caption['created_time'];
						$text         = $this->utf8_4byte_to_3byte($caption['text']);
						$upload_dir   = wp_upload_dir();				
						$filename_data= explode( '.', $image );
		
						if ( is_array( $filename_data ) ) {
	
							$fileformat   = end( $filename_data );
	
							if ( $fileformat !== false ){
								
								
								$image = $this->download_insta_image( $image, md5( $id ) . '.' . $fileformat );
								
								array_push( $instaData, array(
									'id'           => $id,
									'user_name'	   => $username,
									'user_url'	   => $user_profile,
									'created_time' => $created_time,
									'text'         => $text,
									'image'        => $image,
									'image_path'   => $upload_dir['path'] . '/' . md5( $id ) . '.' . $fileformat,
									'link'         => $link
								));
								
							} // end -> if $fileformat !== false
						
						} // end -> is_array( $filename_data )
						
					} // end -> foreach
				
				} // end -> ( $results ) && is_array( $results ) )
			
			} // end -> $json['response']['code'] === 200 )
	
			if ( $instaData ) {
				set_transient( $opt_name, $instaData, $cache_hours * 60 * 60 );
			} // end -> true $instaData
		
		} // end -> false === $instaData
		
		// Insert into Media Library
		if ( true == $media_library ) {
			
			$media_library = array();
								
			foreach ( $instaData as $media_item ) { 
				
				$media_library['title'] = $media_item['text'];
				$media_library['path'] 	= $media_item['image_path'];
				$media_library['src'] 	= $media_item['image'];
			}
		}
		
		return $instaData;
	}

	/**
	 * Function to display Templates for widget
	 *
	 * @param    string    $template	The input to be sanitised
	 * @param    array	   $data_arr	The input to be sanitised
	 * @param    string    $link_to		The input to be sanitised	 	 
	 *
	 * @include file templates
	 *
	 * return void
	 */
	private function template( $template, $data_arr, $link_to, $custom_url ){
	
		if( $template === 'slider' ){ 
			echo '<div class="gallery_'.rand(1, 10000).'">';
			if ( isset( $data_arr ) && is_array( $data_arr ) ) {
				foreach ( $data_arr as $data ) {
					foreach ( $data as $k => $v ) {
						$$k = $v;
					}
					/* Set link to User Instagram Profile */
					if ( $link_to && 'user_url' == $link_to ) {
						$link = $user_url;
					}

					$lightboxer = '';
				
					/* Set link to Locally saved image */
					if ( $link_to && 'local_image_url' == $link_to ) {
						$link = $image;
						$lightboxer = 'data-gal="photo[instagram]"';
					}
					
					/* Set link to Custom URL */
					if ( ( $link_to && 'custom_url' == $link_to ) && ( isset( $custom_url ) && $custom_url != '' ) ) {
						$link = $custom_url;
					}
					echo '<a class="item" href="' . $link . '" title="' . $text . '" target="_blank" '.$lightboxer.'>';
					echo '<img src="' . $image . '" alt="' . $text . '">';
					echo '</a>';
				}
			}
			echo '</div>';
		} elseif( $template === 'thumbs' ){ 
			echo '<ul class="instagram-pics clearfix">';
			if ( isset( $data_arr ) && is_array( $data_arr ) ) {
				foreach ( $data_arr as $data ) {
					foreach ( $data as $k => $v ) {
						$$k = $v;
					}
					/* Set link to User Instagram Profile */
					if ( $link_to && 'user_url' == $link_to ) {
						$link = $user_url;
					}

					$lightboxer = '';
				
					/* Set link to Locally saved image */
					if ( $link_to && 'local_image_url' == $link_to ) {
						$link = $image;
						$lightboxer = 'data-gal="photo[instagram]"';
					}

					/* Set link to Custom URL */
					if ( ( $link_to && 'custom_url' == $link_to ) && ( isset( $custom_url ) && $custom_url != '' ) ) {
						$link = $custom_url;
					}
					echo '<li><a class="item" href="' . $link . '" title="' . $text . '" target="_blank" '.$lightboxer.'>';
					echo '<img src="' . $image . '" alt="' . $text . '">';
					echo '</a></li>';
				}
			}
			echo '</ul>';
		}

	}

	private function download_insta_image( $url, $file ){

		$upload_dir = wp_upload_dir();
		$local_file =  $upload_dir['path'] . '/' . $file; 
		
		if ( file_exists( $local_file ) ) {
			return $upload_dir['baseurl'] . $upload_dir['subdir'] . '/' . $file;
		}		
		
		$get 	   = wp_remote_get( $url, array( 'sslverify' => false ) );
		$body      = wp_remote_retrieve_body( $get );
		$upload	   = wp_upload_bits( $file, '', $body );

		if ( false === $upload['error'] ) {

			return $upload['url'];
		}
		
		return $url;
	}

	/**
	 * Sanitize 4-byte UTF8 chars; no full utf8mb4 support in drupal7+mysql stack.
	 * This solution runs in O(n) time BUT assumes that all incoming input is
	 * strictly UTF8.
	 *
	 * @param    string    $input 		The input to be sanitised
	 *
	 * @return the sanitized input
	 */
	private function utf8_4byte_to_3byte( $input ) {
	  
	  if (!empty($input)) {
		$utf8_2byte = 0xC0 /*1100 0000*/; $utf8_2byte_bmask = 0xE0 /*1110 0000*/;
		$utf8_3byte = 0xE0 /*1110 0000*/; $utf8_3byte_bmask = 0XF0 /*1111 0000*/;
		$utf8_4byte = 0xF0 /*1111 0000*/; $utf8_4byte_bmask = 0xF8 /*1111 1000*/;
	 
		$sanitized = "";
		$len = strlen($input);
		for ($i = 0; $i < $len; ++$i) {
		  $mb_char = $input[$i]; // Potentially a multibyte sequence
		  $byte = ord($mb_char);
		  if (($byte & $utf8_2byte_bmask) == $utf8_2byte) {
			$mb_char .= $input[++$i];
		  }
		  else if (($byte & $utf8_3byte_bmask) == $utf8_3byte) {
			$mb_char .= $input[++$i];
			$mb_char .= $input[++$i];
		  }
		  else if (($byte & $utf8_4byte_bmask) == $utf8_4byte) {
			// Replace with ? to avoid MySQL exception
			$mb_char = '?';
			$i += 3;
		  }
	 
		  $sanitized .=  $mb_char;
		}
	 
		$input= $sanitized;
	  }
	 
	  return $input;
	}

} // end of class T20_instagram
