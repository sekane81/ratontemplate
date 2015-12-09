<?php
/*---------------------------------------------------------------------------------*/
/* Follow RSS Widget */
/*---------------------------------------------------------------------------------*/

class ts_facebook_twitter_widget extends WP_Widget {

	function ts_facebook_twitter_widget() {
		$widget_ops = array(
            'classname' => 'ts-facebook-twitter-widget',
            'description' => __('This widget shows how many followers you have on Facebook and Twitter.', 'ThemeStockyard') 
        );
		parent::WP_Widget(false, '(TS) '.__('Facebook & Twitter Followers', 'ThemeStockyard'),$widget_ops);      
	}

	function widget($args, $instance) 
	{
		$facebook       = $instance['facebook'];
		$title          = $instance['label'];
		$twitter        = $instance['twitter'];	
		$consumer_key = (isset($instance['consumer_key'])) ? $instance['consumer_key'] : '';
		$consumer_secret = (isset($instance['consumer_secret'])) ? $instance['consumer_secret'] : '';
		$access_token = (isset($instance['access_token'])) ? $instance['access_token'] : '';
		$access_token_secret = (isset($instance['access_token_secret'])) ? $instance['access_token_secret'] : '';
		
		$last_twitter_save = get_option('ts_last_twitter_follower_count_save_'.$twitter);
		$last_twitter_reponse = get_option('ts_last_twitter_follower_count_response_'.$twitter);
		$last_twitter_reponse = ($last_twitter_reponse) ? json_decode($last_twitter_reponse, true) : '';
		
		if($last_twitter_save && (time() - $last_twitter_save) < 600 && $last_twitter_reponse && count($last_twitter_reponse) > 0)
		{
            //$last_twitter_reponse = json_decode($last_twitter_reponse, true);
		}
		else
		{
            $twitter_config = array(
                'consumer_key'               => $consumer_key,
                'consumer_secret'            => $consumer_secret,
                'token'                      => $access_token,
                'secret'                     => $access_token_secret,
            );
            
            $tmhOAuth = new tmhOAuth($twitter_config);
            
            $params = array(
                'screen_name'  => $twitter
            );

            $code = $tmhOAuth->user_request(array(
                'method' => 'GET',
                'url' => $tmhOAuth->url("1.1/users/show"),
                'params' => $params
            ));

            if($code == 200) :
                $last_twitter_reponse = $tmhOAuth->response['response'];
                $last_twitter_reponse_error = $last_twitter_reponse;
                update_option('ts_last_twitter_follower_count_save_'.$twitter, time());
                update_option('ts_last_twitter_follower_count_response_'.$twitter, $last_twitter_reponse);
                $last_twitter_reponse = json_decode($last_twitter_reponse, true);
            endif;
		}

        echo ts_essentials_escape($args['before_widget']);
        
        echo '<div class="inner clearfix">';

		if ( ! empty( $title ) ) echo ts_essentials_escape($args['before_title'] . apply_filters( 'widget_title', $title ). $args['after_title']);
        
        if($facebook) :
            $data = wp_remote_get('https://api.facebook.com/method/links.getStats?urls='.urlencode('https://www.facebook.com/'.$facebook).'&format=json');
            $fb_error = (is_object($data) && get_class($data) == 'WP_Error') ? true : false;
            if(!$fb_error && isset($data['body'])) :
                $data = json_decode($data['body']);
                $data = (isset($data[0]) && is_object($data[0])) ? $data[0] : $data;
                if(isset($data->like_count)) :
                    echo '<div class="inline-block"><a href="https://facebook.com/'.esc_attr($facebook).'" class="facebook">';
                    echo '<i class="fa fa-facebook facebook-bg-color"></i>';
                    echo '<h4 class="sp1" title="'.esc_attr($data->like_count).'">'.ts_essentials_num2str($data->like_count).'</h4>';
                    echo '<span class="sp2 small">Likes</span>';
                    echo '</a></div>';
                endif;
            endif;
        endif;
        
        if($twitter && (is_array($last_twitter_reponse))) :
            $data = $last_twitter_reponse;
            if(isset($data['followers_count'])) :
                echo '<div class="inline-block"><a href="https://twitter.com/'.esc_attr($twitter).'" class="twitter">';
                echo '<i class="fa fa-twitter twitter-bg-color"></i>';
                echo '<h4 class="sp1" title="'.esc_attr($data['followers_count']).'">'.ts_essentials_num2str($data['followers_count']).'</h4>';
                echo '<span class="sp2 small">Followers</span>';
                echo '</a></div>';
            endif;
        endif;
		
		echo '</div>';
		
		echo ts_essentials_escape($args['after_widget']);

	}

	function update($new_instance, $old_instance) {                
		$new_instance = (array) $new_instance;

        $instance['facebook'] = strip_tags( $new_instance['facebook']);
        $instance['label']   = strip_tags( $new_instance['label']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];

        return $instance;
	}

	function form($instance) {        
		
		$defaults = array( 
            'label'         => __("We're Social!", 'ThemeStockyard'),
			'facebook'      => '', 
			'twitter'       => '',
			'consumer_key' => '',
			'consumer_secret' => '',
			'access_token' => '',
			'access_token_secret' => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('label')); ?>"><?php _e('Label (optional):', 'ThemeStockyard'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('label')); ?>" value="<?php echo esc_attr($instance['label']); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('label')); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php _e('Facebook Page Username/ID:', 'ThemeStockyard'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" value="<?php echo esc_attr($instance['facebook']); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php _e('Twitter Username:', 'ThemeStockyard'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" value="<?php echo esc_attr($instance['twitter']); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" />
        </p>
        <p><a href="http://dev.twitter.com/apps" target="_blank"><?php _e('Find or Create your Twitter App', 'ThemeStockyard');?></a></p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>"><?php _e('Consumer Key:', 'ThemeStockyard'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_key')); ?>" value="<?php echo esc_attr($instance['consumer_key']); ?>" />
		</p>
	     
	    <p>
	 		<label for="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>"><?php  _e('Consumer Secret:', 'ThemeStockyard'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_secret')); ?>" value="<?php echo esc_attr($instance['consumer_secret']); ?>" />
	    </p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('access_token')); ?>"><?php _e('Access Token:', 'ThemeStockyard'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('access_token')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token')); ?>" value="<?php echo esc_attr($instance['access_token']); ?>" />
		</p>
	     
	    <p>
	 		<label for="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>"><?php  _e('Access Token Secret:', 'ThemeStockyard'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token_secret')); ?>" value="<?php echo esc_attr($instance['access_token_secret']); ?>" />
	    </p>
	    <p><small><?php _e('<strong>Note:</strong> Twitter followers are cached for 10 minutes.', 'ThemeStockyard');?></small></p>
        <?php
	}
} 

add_action( 'widgets_init', create_function( '', 'register_widget( "ts_facebook_twitter_widget" );' ) );