<?php
/******************************************************** 
BOSTON Categories Widget
********************************************************/

class Boston_Popular_Posts extends WP_Widget {

	function __construct() {
		parent::__construct('popular_posts', __('Boston Popular Posts','boston'), array('description' =>__('Display popular posts','boston') ));
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$text = esc_attr( $instance['text'] );		

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Posts', 'boston' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

		if ( ! $number ){
			$number = 5;
		}
		
		?>
		<?php echo  $before_widget; ?>
		<?php 
		if ( $title ){
			echo  $before_title . $title . $after_title; 
		}
		?>
		
		<?php
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'meta_key' 			  => 'wpb_post_views_count', 
			'orderby' 			  => 'meta_value_num',
			'ignore_sticky_posts' => true,
		) ) );

		if ($r->have_posts()):
		?>
			<ul class="list-unstyled">
			<?php 
			while ( $r->have_posts() ) : 
				$r->the_post();
				?>
				<div class="popular-post">
				    <div class="pp-image">
				    	<?php the_post_thumbnail( 'widget-box', array( 'class' => 'img-responsive' ) ) ?>
				    </div>

				    <a href="javascript:;" class="overlay"></a>

				    <div class="pp-header">
				        <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
				        <span class="author"><?php _e( 'by ', 'boston' ) ?>
				        	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				        		<?php 
				        		$name = get_the_author_meta( 'display_name' );
				        		if( strlen( $name ) > 15 ){
				        			$name = substr( $name, 0, 15 );
				        			$name .= '...';
				        		}
				        		echo esc_html( $name );
				        		?>
				        	</a>
				        </span>
				        <span class="comments">
				        	<a href="<?php the_permalink() ?>#comments">
				        		<i class="fa fa-comment-o"></i><?php comments_number( 0, 1, '%' ); ?>
				        	</a>
				        </span>
				        <span class="favourites">
				        	<a href="javascript:;" class="favourites-click" data-post_id="<?php the_ID() ?>">
				        		<i class="fa fa-<?php echo boston_favourited_class(); ?>"></i><?php echo boston_get_favourites_count(); ?>
				        	</a>
				        </span>
				    </div>
				</div>				
				<?php
			endwhile; ?>
			</ul>
		<?php
		endif;
		?>
		
		<?php echo  $after_widget; wp_reset_postdata(); ?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'boston' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'boston' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
<?php
	}
}


class Boston_Handpicked_Posts extends WP_Widget {

	function __construct() {
		parent::__construct('handpicked_posts', __('Boston Handpicked Posts','boston'), array('description' =>__('Display popular posts','boston') ));
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'posts' => array() ) );
	

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Posts', 'boston' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$posts = ( ! empty( $instance['posts'] ) ) ? $instance['posts'] : array();
		
		?>
		<?php echo  $before_widget; ?>
		<?php 
		if ( $title ){
			echo  $before_title . $title . $after_title; 
		}
		?>
		
		<?php
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'post__in'			  => $posts,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		) ) );

		if ($r->have_posts()):
		?>
			<ul class="list-unstyled">
			<?php 
			while ( $r->have_posts() ) : 
				$r->the_post();
				?>
				<div class="media">
				    <div class="media-left">
				        <a href="<?php the_permalink() ?>">
				        	<?php the_post_thumbnail( 'round-widget', array( 'class' => 'media-object' ) ); ?>
				        </a>
				    </div>
				    <div class="media-body">
				        <h4 class="media-heading"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
				        <span class="date"><?php the_time( 'F j, Y' ) ?></span>
				    </div>
				</div>
				<?php
			endwhile; ?>
			</ul>
		<?php
		endif;
		?>
		
		<?php echo  $after_widget; wp_reset_postdata(); ?>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts'] = $new_instance['posts'];

		return $instance;
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$posts    = isset( $instance['posts'] ) ? $instance['posts'] : array();
?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'boston' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>"><?php _e( 'Select posts to show:', 'boston' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts' ) ); ?>[]" multiple>
			<?php
			$posts_all = get_posts(array(
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'ignore_sticky_posts' => true
			));
			if( !empty( $posts_all ) ){
				foreach( $posts_all as $post ){
					echo '<option value="'.esc_attr( $post->ID ).'" '.( in_array( $post->ID, $posts ) ? 'selected="selected"' : '' ).'>'.$post->post_title.'</option>';
				}
			}
			?>
		</select>
<?php
	}
}
class Boston_Social extends WP_Widget{

	function __construct() {
		parent::__construct('widget_social', __('Boston Social Follow','bloger'), array('description' =>__('Adds list of the social icons.','bloger') ));
	}

	function widget($args, $instance) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$facebook = !empty( $instance['facebook'] ) ? '<li><a href="'.esc_url( $instance['facebook'] ).'" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>' : '';
		$twitter = !empty( $instance['twitter'] ) ? '<li><a href="'.esc_url( $instance['twitter'] ).'" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>' : '';
		$google = !empty( $instance['google'] ) ? '<li><a href="'.esc_url( $instance['google'] ).'" target="_blank" class="google"><i class="fa fa-google"></i></a></li>' : '';
		$pinterest = !empty( $instance['pinterest'] ) ? '<li><a href="'.esc_url( $instance['pinterest'] ).'" target="_blank" class="pinterest"><i class="fa fa-pinterest"></i></a></li>' : '';
		$tumblr = !empty( $instance['tumblr'] ) ? '<li><a href="'.esc_url( $instance['tumblr'] ).'" target="_blank" class="tumblr"><i class="fa fa-tumblr"></i></a></li>' : '';

		echo  $args['before_widget'];
		
		if ( !empty($instance['title']) ){
			echo  $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		echo '<div class="widget-social">';
			echo '<div class="social-share">
			    <ul class="list-unstyled list-inline">
			        '.$facebook.$twitter.$google.$pinterest.$tumblr.'
			    </ul>
			</div>';
		echo '</div>';
		echo  $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['facebook'] = strip_tags( stripslashes($new_instance['facebook']) );
		$instance['twitter'] = strip_tags( stripslashes($new_instance['twitter']) );
		$instance['google'] = strip_tags( stripslashes($new_instance['google']) );
		$instance['pinterest'] = strip_tags( stripslashes($new_instance['pinterest']) );
		$instance['tumblr'] = strip_tags( stripslashes($new_instance['tumblr']) );
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$facebook = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
		$google = isset( $instance['google'] ) ? $instance['google'] : '';
		$pinterest = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
		$tumblr = isset( $instance['tumblr'] ) ? $instance['tumblr'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'bloger') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>"><?php _e('Facebook:', 'bloger') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" value="<?php echo esc_url( $facebook ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>"><?php _e('Twitter:', 'bloger') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" value="<?php echo esc_url( $twitter ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('google') ); ?>"><?php _e('Google +:', 'bloger') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('google') ); ?>" name="<?php echo esc_attr( $this->get_field_name('google') ); ?>" value="<?php echo esc_url( $google ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>"><?php _e('Pinterest:', 'bloger') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest') ); ?>" value="<?php echo esc_url( $pinterest ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('tumblr') ); ?>"><?php _e('Tumblr:', 'bloger') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('tumblr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tumblr') ); ?>" value="<?php echo esc_url( $tumblr ); ?>" />
		</p>		
		<?php
	}
}

class Boston_Instagram extends WP_Widget {
	public function __construct() {
		parent::__construct('boston_instagram', 'Boston Instagram', array( 'description' => "Boston Instagram Widget" ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Follow Us On Instagram', 'boston' ) : $instance['title'], $instance, $this->id_base);
		$count = esc_attr( $instance['count'] );
		$username = esc_attr( $instance['username'] );
		$columns = esc_attr( $instance['columns'] );

		if( empty( $count ) ){
			$count = 9;
		}

		if( empty( $columns ) ){
			$columns = 3;
		}		
		
		$width = 100 / $columns;

		$boston_random_string = boston_random_string();

		$return = '';

		if ( $username ) {
			$username_response = wp_remote_get( 'https://api.instagram.com/v1/users/search?q=' . $username . '&client_id=972fed4ff0d5444aa21645789adb0eb0' );
			$username_response_data = json_decode( $username_response['body'], true );
			
			$username_converted = '';
			foreach ( $username_response_data['data'] as $data ) {
				if ( $data['username'] == $username ) {
					$username_converted = $data['id'];
				}
			}

			$return = '<script>' . "\n" ;
			$return .= 		'jQuery(function($) {' . "\n" ;

			$return .=			'$(".instagram-feed-' . $boston_random_string . '").on(\'didLoadInstagram\', function(event, response) {' . "\n" ;

			$return .=				'var data = response.data;' . "\n" ;

			$return .=				'for( var key in data ) {' . "\n" ;
			$return .=					'var image_src = data[key][\'images\'][\'standard_resolution\'][\'url\'];' . "\n" ;
			$return .=					'var image_link = data[key][\'link\'];' . "\n" ;
			$return .=					'var caption = ""' . "\n" ;
			$return .=					'if( image_caption = data[key][\'caption\'] ){' . "\n" ;
			$return .=					'caption = data[key][\'caption\'][\'text\'];' . "\n" ;
			$return .=					'}' . "\n" ;

			$return .=					'var output = \'<div class="instagram-image" style="width: calc('.$width.'% - 2px); margin-left: 2px;"><a href="\'+image_link+\'" target="_blank" class="no-preloader"><img src="\'+image_src+\'" alt="\'+caption+\'"></a></div>\';' . "\n" ;

			$return .=					'$(".instagram-feed-' . $boston_random_string . '").append(output);' . "\n" ;
			$return .=				'}' . "\n" ;

			$return .=			'});' . "\n" ;

			$return .=			'$(".instagram-feed-' . $boston_random_string . '").instagram({' . "\n" ;
			$return .=				'clientId: \'972fed4ff0d5444aa21645789adb0eb0\',' . "\n" ;
			$return .=				'count: \'' . $count . '\',' . "\n" ;
			if ( $username != '' ) {
				$return .=					'userId: \'' . $username_converted . '\'' . "\n" ;
			}
			$return .=			'});' . "\n" ;
			$return .=		'});' . "\n" ;
			$return .=	'</script>' . "\n" ;
			
			$return .= '<div class="instagram-feed-' . $boston_random_string . ' clearfix"></div>' . "\n" ;			
		}
	

		echo  $before_widget.$before_title.$title.$after_title.$return.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 9, 'username' => '', 'columns' => '' ) );
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );
		$username = esc_attr( $instance['username'] );
		$columns = esc_attr( $instance['columns'] );

		echo '<p><label for="'.esc_attr( $this->get_field_id('title')).'">'.__( 'Title:', 'boston' ).'</label>';
		echo '<input class="widefat" id="'.esc_attr( $this->get_field_id('title')).'"  name="'.esc_attr( $this->get_field_name('title')).'" type="text" value="'.esc_attr( $title ).'" /></p>';		

		echo '<p><label for="'.esc_attr( $this->get_field_id('username')).'">'.__( 'Username:', 'boston' ).'</label>';
		echo '<input class="widefat" id="'.esc_attr( $this->get_field_id('username')).'"  name="'.esc_attr( $this->get_field_name('username')).'" type="text" value="'.esc_attr( $username ).'" /></p>';
		
		echo '<p><label for="'.esc_attr( $this->get_field_id('count')).'">'.__( 'Count:', 'boston' ).'</label>';
		echo '<input class="widefat" id="'.esc_attr( $this->get_field_id('count')).'"  name="'.esc_attr( $this->get_field_name('count')).'" type="text" value="'.esc_attr( $count ).'" /></p>';

		echo '<p><label for="'.esc_attr( $this->get_field_id('columns')).'">'.__( 'Columns:', 'boston' ).'</label>';
		echo '<input class="widefat" id="'.esc_attr( $this->get_field_id('columns')).'"  name="'.esc_attr( $this->get_field_name('columns')).'" type="text" value="'.esc_attr( $columns ).'" /></p>';		

	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['columns'] = strip_tags($new_instance['columns']);
		return $instance;	
	}	
}

/******************************************************** 
Boston Tweets
********************************************************/
class Boston_Tweets extends WP_Widget {
	public function __construct() {
		parent::__construct('boston_tweets', 'Boston Tweets', array( 'description' => "Boston Tweets Widget" ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Latest Tweets', 'boston' ) : $instance['title'], $instance, $this->id_base);
		$count = esc_attr( $instance['count'] );
		
		$list = '';
		
		$tweets = boston_return_tweets( $count );
		if( !empty( $tweets['error'] ) ){
			$list = '<li class="api_error">API Is Not Set</li>';
		}
		else{
			if( !empty( $tweets ) && empty( $tweets['errors'] ) ){
				$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
				$twitter_username = boston_get_option( 'twitter-username' );
				foreach( $tweets as $tweet ){
					$text = $tweet['text'];
					if( preg_match( $reg_exUrl, $text, $url ) ) {
					       $text =  preg_replace( $reg_exUrl, '<a href="'.$url[0].'">'.$url[0].'</a> ', $text );
					}
					$list .= '
						<li>
							<div class="tweet-bird">
								<i class="fa fa-twitter"></i>
							</div>
							<p>'.$text.'</p>
							<ul class="list-unstyled list-inline tweet-meta">
								<li>
									<a href="http://twitter.com/'.$twitter_username.'/status/'.$tweet['id_str'].'" target="_blank">
										<i class="fa fa-reply"></i>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'" target="_blank">
										<i class="fa fa-retweet"></i>
									</a>
								</li>
								<li>
									<p>'.human_time_diff( strtotime( $tweet['created_at'] ), current_time( 'timestamp' ) ).' '.__( 'ago', 'boston' ).'</p>
								</li>
							</ul>
						</li>';
					
				}
			}
		}
		echo  $before_widget.$before_title.$title.$after_title.'
				<div class="news twitter">
					<ul class="list-unstyled">
						'.$list.'
					</ul>
				</div>'.$after_widget;	
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 1 ) );
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );

		echo '<p><label for="'.($this->get_field_id('title')).'">'.__( 'Title:', 'boston' ).'</label>';
		echo '<input class="widefat" id="'.($this->get_field_id('title')).'"  name="'.($this->get_field_name('title')).'" type="text" value="'.esc_attr( $title ).'" /></p>';		
		
		echo '<p><label for="'.($this->get_field_id('count')).'">'.__( 'Count:', 'boston' ).'</label>';
		echo '<input class="widefat" id="'.($this->get_field_id('count')).'"  name="'.($this->get_field_name('count')).'" type="text" value="'.esc_attr( $count ).'" /></p>';

	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;	
	}	
}

/********************************************************
Add Boston Widgets
********************************************************/
function boston_widgets_load(){
	register_widget( 'Boston_Popular_Posts' );
	register_widget( 'Boston_Handpicked_Posts' );
	register_widget( 'Boston_Social' );
	register_widget( 'Boston_Instagram' );
	register_widget( 'Boston_Tweets' );
}
add_action( 'widgets_init', 'boston_widgets_load' );
?>