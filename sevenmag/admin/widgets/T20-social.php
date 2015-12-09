<?php
class T20_social_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_social', 'description' => __('Displays the social media links. Suitable for sidebar and footer.', 'T20') );
		parent::__construct( 't20_social_icons_widget', __('T20 - Social icons', 'T20'), $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$dribbble = $instance['dribbble'];
		$rss = $instance['rss'];
		$github = $instance['github'];
		$vimeo = $instance['vimeo'];
		$instagram = $instance['instagram'];
		$linkedin = $instance['linkedin'];
		$pinterest = $instance['pinterest'];
		$googleplus = $instance['googleplus'];
		$foursquare = $instance['foursquare'];
		$skype = $instance['skype'];
		$soundcloud = $instance['soundcloud'];
		$spotify = $instance['spotify'];
		$youtube = $instance['youtube'];
		$tumblr = $instance['tumblr'];
		$star = $instance['star'];
		$flickr = $instance['flickr'];
		$behance = $instance['behance'];
		$yahoo = $instance['yahoo'];
		$deviantart = $instance['deviantart'];
		$digg = $instance['digg'];
		$reddit = $instance['reddit'];
		$envelopeo = $instance['envelopeo'];

		echo $before_widget;
		if($title) {
			echo $before_title.$title.$after_title;
		} else {
			?> <div class="widget clearfix"> <?php  
		} ?>

		<div class="social with_color clearfix">
			<?php if(!empty($twitter)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $twitter; ?>" target="_blank" title="<?php _e( 'Follow us on twitter', 'T20' ); ?>"><i class="fa fa-twitter"></i></a>
			<?php } if(!empty($facebook)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $facebook; ?>" target="_blank" title="<?php _e( 'Like us on facebook', 'T20' ); ?>"><i class="fa fa-facebook"></i></a>
			<?php } if(!empty($dribbble)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $dribbble; ?>" target="_blank" title="<?php _e( 'Follow us on dribbble', 'T20' ); ?>"><i class="fa fa-dribbble"></i></a>
			<?php } if(!empty($rss)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $rss; ?>" target="_blank" title="<?php _e( 'RSS Feed', 'T20' ); ?>"><i class="fa fa-rss"></i></a>
			<?php } if(!empty($github)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $github; ?>" target="_blank" title="<?php _e( 'Github', 'T20' ); ?>"><i class="fa fa-github"></i></a>
			<?php } if(!empty($vimeo)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $vimeo; ?>" target="_blank" title="<?php _e( 'Vimeo', 'T20' ); ?>"><i class="fa fa-vimeo-square"></i></a>
			<?php } if(!empty($instagram)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $instagram; ?>" target="_blank" title="<?php _e( 'Follow us on Instagram', 'T20' ); ?>"><i class="fa fa-instagram"></i></a>
			<?php } if(!empty($linkedin)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $linkedin; ?>" target="_blank" title="<?php _e( 'Follow us on Linkedin', 'T20' ); ?>"><i class="fa fa-linkedin"></i></a>
			<?php } if(!empty($pinterest)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $pinterest; ?>" target="_blank" title="<?php _e( 'Follow us on Pinterest', 'T20' ); ?>"><i class="fa fa-pinterest"></i></a>
			<?php } if(!empty($googleplus)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $googleplus; ?>" target="_blank" title="<?php _e( 'Follow us on Google+', 'T20' ); ?>"><i class="fa fa-google-plus"></i></a>
			<?php } if(!empty($foursquare)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $foursquare; ?>" target="_blank" title="<?php _e( 'Foursquare', 'T20' ); ?>"><i class="fa fa-foursquare"></i></a>
			<?php } if(!empty($skype)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $skype; ?>" target="_blank" title="<?php _e( 'Skype', 'T20' ); ?>"><i class="fa fa-skype"></i></a>
			<?php } if(!empty($soundcloud)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $soundcloud; ?>" target="_blank" title="<?php _e( 'Follow us on Soundcloud', 'T20' ); ?>"><i class="fa fa-soundcloud"></i></a>
			<?php } if(!empty($spotify)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $spotify; ?>" target="_blank" title="<?php _e( 'Follow us on Spotify', 'T20' ); ?>"><i class="fa fa-spotify"></i></a>
			<?php } if(!empty($youtube)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $youtube; ?>" target="_blank" title="<?php _e( 'Youtube Subscribe', 'T20' ); ?>"><i class="fa fa-youtube"></i></a>
			<?php } if(!empty($tumblr)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $tumblr; ?>" target="_blank" title="<?php _e( 'Tumblr', 'T20' ); ?>"><i class="fa fa-tumblr"></i></a>
			<?php } if(!empty($star)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $star; ?>" target="_blank" title="<?php _e( 'Reverbnation', 'T20' ); ?>"><i class="fa fa-star"></i></a>
			<?php } if(!empty($flickr)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $flickr; ?>" target="_blank" title="<?php _e( 'Flickr', 'T20' ); ?>"><i class="fa fa-flickr"></i></a>
			<?php } if(!empty($behance)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $behance; ?>" target="_blank" title="<?php _e( 'Behance', 'T20' ); ?>"><i class="fa fa-behance"></i></a>
			<?php } if(!empty($yahoo)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $yahoo; ?>" target="_blank" title="<?php _e( 'Yahoo', 'T20' ); ?>"><i class="fa fa-yahoo"></i></a>
			<?php } if(!empty($deviantart)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $deviantart; ?>" target="_blank" title="<?php _e( 'Deviantart', 'T20' ); ?>"><i class="fa fa-deviantart"></i></a>
			<?php } if(!empty($digg)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $digg; ?>" target="_blank" title="<?php _e( 'Digg', 'T20' ); ?>"><i class="fa fa-digg"></i></a>
			<?php } if(!empty($reddit)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $reddit; ?>" target="_blank" title="<?php _e( 'Reddit', 'T20' ); ?>"><i class="fa fa-reddit"></i></a>
			<?php } if(!empty($envelopeo)){ ?>
				<a rel="nofollow" class="toptip" href="<?php echo $envelopeo; ?>" target="_blank" title="<?php _e( 'Contact Us', 'T20' ); ?>"><i class="fa fa-envelope-o"></i></a>
			<?php } ?>
			
		</div>
        <?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['dribbble'] = $new_instance['dribbble'];
		$instance['rss'] = $new_instance['rss'];
		$instance['github'] = $new_instance['github'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['googleplus'] = $new_instance['googleplus'];
		$instance['foursquare'] = $new_instance['foursquare'];
		$instance['skype'] = $new_instance['skype'];
		$instance['soundcloud'] = $new_instance['soundcloud'];
		$instance['spotify'] = $new_instance['spotify'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['star'] = $new_instance['star'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['behance'] = $new_instance['behance'];
		$instance['yahoo'] = $new_instance['yahoo'];
		$instance['deviantart'] = $new_instance['deviantart'];
		$instance['digg'] = $new_instance['digg'];
		$instance['reddit'] = $new_instance['reddit'];
		$instance['envelopeo'] = $new_instance['envelopeo'];

		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
			'title' => 'Follow Us',
			'twitter' => '',
			'facebook' => '',
			'dribbble' => '',
			'rss' => '',
			'github' => '',
			'vimeo' => '',
			'instagram' => '',
			'linkedin' => '',
			'pinterest' => '',
			'googleplus' => '',
			'foursquare' => '',
			'skype' => '',
			'soundcloud' => '',
			'spotify' => '',
			'youtube' => '',
			'tumblr' => '',
			'star' => '',
			'flickr' => '',
			'behance' => '',
			'yahoo' => '',
			'deviantart' => '',
			'digg' => '',
			'reddit' => '',
			'envelopeo' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e('Dribbble URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('Feedburner URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e('Github URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" value="<?php echo $instance['github']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('instagram URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('linkedin URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e('Google+ URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'foursquare' ); ?>"><?php _e('Foursquare URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'foursquare' ); ?>" name="<?php echo $this->get_field_name( 'foursquare' ); ?>" value="<?php echo $instance['foursquare']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('Skype URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'soundcloud' ); ?>"><?php _e('SoundCloud URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'soundcloud' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud' ); ?>" value="<?php echo $instance['soundcloud']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'spotify' ); ?>"><?php _e('Spotify URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'spotify' ); ?>" name="<?php echo $this->get_field_name( 'spotify' ); ?>" value="<?php echo $instance['spotify']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtube URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('Tumblr URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo $instance['tumblr']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'star' ); ?>"><?php _e('Reverbnation URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'star' ); ?>" name="<?php echo $this->get_field_name( 'star' ); ?>" value="<?php echo $instance['star']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e('behance URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo $instance['behance']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'yahoo' ); ?>"><?php _e('Yahoo URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'yahoo' ); ?>" name="<?php echo $this->get_field_name( 'yahoo' ); ?>" value="<?php echo $instance['yahoo']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'deviantart' ); ?>"><?php _e('Deviantart URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'deviantart' ); ?>" name="<?php echo $this->get_field_name( 'deviantart' ); ?>" value="<?php echo $instance['deviantart']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'digg' ); ?>"><?php _e('Digg URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'digg' ); ?>" name="<?php echo $this->get_field_name( 'digg' ); ?>" value="<?php echo $instance['digg']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'reddit' ); ?>"><?php _e('Reddit URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'reddit' ); ?>" name="<?php echo $this->get_field_name( 'reddit' ); ?>" value="<?php echo $instance['reddit']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'envelopeo' ); ?>"><?php _e('Contact URL:', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'envelopeo' ); ?>" name="<?php echo $this->get_field_name( 'envelopeo' ); ?>" value="<?php echo $instance['envelopeo']; ?>" />
		</p>
	<?php
	}
}

?>