<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Twitter Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that displays messages from twitter.com
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'CT_twitter_load_widgets' );

// Register widget
function CT_twitter_load_widgets() {
	register_widget( 'CT_Twitter_Widget' );
}

// Widget class
class CT_Twitter_Widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function CT_Twitter_Widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ct_twitter_widget' , 'description' => __( 'Twitter Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_twitter_widget' );
		
		/* Create the widget. */
		$this->WP_Widget('ct_twitter_widget', __( 'CT: Twitter Widget' , 'color-theme-framework' ) , $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	//$show_avatar = isset($instance['show_avatar']) ? 'true' : 'false';

	global $ct_options;

	$consumer_key = $ct_options['ct_consumer_key'];
	$consumer_secret = $ct_options['ct_consumer_secret'];
	$user_token = $ct_options['ct_user_token'];
	$user_secret = $ct_options['ct_user_secret'];

	/* Before widget (defined by themes). */
	echo $before_widget;

	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title ){
		echo $before_title.$title.$after_title;
	} 


	//check settings and die if not set
	if(empty($consumer_key) || empty($consumer_secret) || empty($user_token) || empty($user_secret) || empty($instance['cachetime']) || empty($instance['username'])){
		echo '<span class="tweet_info">Please fill all widget settings and Twitter Settings (menu Appearance -> Theme Options -> Twitter settings)</span>' . $after_widget;
		return;
	}


	//check if cache needs update
	$ct_twitter_last_cache_time = get_option('ct_twitter_last_cache_time'.$instance['username']);
	$diff = time() - $ct_twitter_last_cache_time;
	$crt = $instance['cachetime'] * 3600;

	// yes, it needs update
	if($diff >= $crt || empty($ct_twitter_last_cache_time)){

		if(!require_once('twitteroauth.php')){ 
			echo '<strong>Couldn\'t find twitteroauth.php!</strong>' . $after_widget;
			return;
		}

		if ( !function_exists( 'ct_getConnectionWithAccessToken' ) ) {
			function ct_getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
				$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
				return $connection;
			}
		}

		$connection = ct_getConnectionWithAccessToken($consumer_key, $consumer_secret, $user_token, $user_secret);
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$instance['username']."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');

		if(!empty($tweets->errors)){
			if($tweets->errors[0]->message == 'Invalid or expired token'){
				echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
			}else{
				echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
			}
			return;
		}

		for($i = 0;$i <= count($tweets); $i++){
			if(!empty($tweets[$i])){
				$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
				$tweets_array[$i]['text'] = $tweets[$i]->text;
				$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;
			}
		}

		//save tweets to wp option 		
		update_option('tp_twitter_plugin_tweets'.$instance['username'],serialize($tweets_array));
		update_option('ct_twitter_last_cache_time'.$instance['username'],time());

		echo '<!-- twitter cache has been updated! -->';
	}


	//convert links to clickable format
if ( !function_exists( 'ct_convert_links' ) ) {
	function ct_convert_links($status,$targetBlank=true,$linkMaxLen=250){

		// the target
		$target=$targetBlank ? " target=\"_blank\" " : "";

		// convert link to url
		$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',7,$linkMaxLen).'...':substr('$1',7,$linkMaxLen))).'</a>'", $status);

		// convert @ to follow
		$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

		// convert # to search
		$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

		// return the status
		return $status;
	}
}


	//convert dates to readable format
if ( !function_exists( 'ct_relative_time' ) ) {
	function ct_relative_time($a) {
		//get current timestampt
		$b = strtotime("now"); 
		//get timestamp when tweet created
		$c = strtotime($a);
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour = $minute * 60;
		$day = $hour * 24;
		$week = $day * 7;

		if(is_numeric($d) && $d > 0) {
			//if less then 3 seconds
			if($d < 3) return "right now";
			//if less then minute
			if($d < $minute) return floor($d) . __(' seconds ago', 'color-theme-framework');
			//if less then 2 minutes
			if($d < $minute * 2) return __('about 1 minute ago', 'color-theme-framework');
			//if less then hour
			if($d < $hour) return floor($d / $minute) . __(' minutes ago', 'color-theme-framework');
			//if less then 2 hours
			if($d < $hour * 2) return __('about 1 hour ago', 'color-theme-framework');
			//if less then day
			if($d < $day) return floor($d / $hour) . __(' hours ago', 'color-theme-framework');
			//if more then day, but less then 2 days
			if($d > $day && $d < $day * 2) return __('yesterday', 'color-theme-framework');
			//if less then year
			if($d < $day * 365) return floor($d / $day) . __(' days ago', 'color-theme-framework');
			//else return more than a year
			return __('over a year ago', 'color-theme-framework');
		}
	}	
}


	$tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'.$instance['username']));
	if(!empty($tp_twitter_plugin_tweets)){

		echo '<div class="tweet">' . "\n". '<ul class="tweet_list">';
		$fctr = '1';
		foreach($tp_twitter_plugin_tweets as $tweet){
			print '<li>';
			//echo '<div class="twitter_logo"><a target="_blank" href="https://twitter.com/' . $instance['username'] .'"><i class="icon-twitter"></i></a></div><!-- .twitter_logo -->';
			print '<span class="tweet_time"><a target="_blank" href="http://twitter.com/'.$instance['username'].'/statuses/'.$tweet['status_id'].'">'.ct_relative_time($tweet['created_at']).'</a></span><span class="tweet_text">'.ct_convert_links($tweet['text']).'</span></li>';
			if($fctr == $instance['tweetstoshow']){ break; }
			$fctr++;
		}

		echo "</ul>\n</div>\n";

	} ?>

	<?php 
	// After widget (defined by theme functions file)
	echo $after_widget;
	echo "\n<!-- END TWITTER WIDGET -->\n";
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance = array();
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['cachetime'] = strip_tags( $new_instance['cachetime'] );
	$instance['username'] = strip_tags( $new_instance['username'] );
	$instance['tweetstoshow'] = strip_tags( $new_instance['tweetstoshow'] );

	//$instance['show_avatar'] = $new_instance['show_avatar'];

	if($old_instance['username'] != $new_instance['username']){
		delete_option('ct_twitter_last_cache_time' . $instance['username']);
	}
				
	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 
		'title'			=> __( 'Twitter' , 'color-theme-framework' ),
		'username'		=> 'envato',
		'cachetime'		=> '1',
		'tweetstoshow'	=> '3'
	);
	
	$instance = wp_parse_args((array) $instance, $defaults); ?>

	<p style=" background: #fff2bf; padding: 7px; border: 1px solid #c0c0c0; font-size: 11px; ">
		<?php _e('Also, be sure to fill the Twitter Settings (menu Appearance -> Theme Options -> Twitter settings)','color-theme-framework'); ?>
	</p>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'color-theme-framework' ); ?></label>
		<input style=" width: 96%; " class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- User Name For Twitter Service Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter Username:' , 'color-theme-framework'); ?></label>
		<input style=" width: 96%; " class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['username'] ), ENT_QUOTES)); ?>" />
	</p>

	<!-- Count Messages: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'tweetstoshow' ); ?>"><?php _e( 'Tweets to display' , 'color-theme-framework' ); ?></label>
		<input style="width: 150px; margin-right: 5px;" type="number" min="1" max="30" class="widefat" id="<?php echo $this->get_field_id( 'tweetstoshow' ); ?>" name="<?php echo $this->get_field_name( 'tweetstoshow' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['tweetstoshow'] ), ENT_QUOTES)); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'cachetime' ); ?>"><?php _e( 'Cache Tweets in every:' , 'color-theme-framework' ); ?></label>
		<input style="width: 150px; margin-right: 5px;" type="number" min="1" max="24" class="widefat" id="<?php echo $this->get_field_id( 'cachetime' ); ?>" name="<?php echo $this->get_field_name( 'cachetime' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['cachetime'] ), ENT_QUOTES)); ?>" />
		<?php _e('hours', 'color-theme-framework'); ?>
	</p>

	<?php
	}
}
?>