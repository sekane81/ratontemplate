<?php
class T20_posts_slideshow extends WP_Widget {
	function __construct() {
		parent::__construct( false, __('T20 - Slideshow Posts', 'T20'), array('description' => __('Display posts from a category in Slideshow', 'T20'), 'classname' => 'widget_T20_posts_slideshow') );
	}

	public function widget($args, $instance) {
		extract( $args );
		$instance['title']?NULL:$instance['title']='';
		$title = apply_filters('widget_title',$instance['title']);
		$output = $before_widget."\n";
		if($title) {
			$output .= $before_title.$title.$after_title;
		} else {
			$output .= '<div class="b_title"><h4> </h4></div><div class="widget clearfix">';
		}
		ob_start();
	
?>

	<?php
		$posts = new WP_Query( array(
			'post_type'		=> array( 'post' ),
			'showposts'		=> $instance['posts_num'],
			'cat'			=> $instance['posts_cat_id'],
			'ignore_sticky_posts'	=> true,
			'orderby'		=> $instance['posts_orderby'],
			'order'			=> 'dsc',
			'date_query' => array(
				array(
					'after' => $instance['posts_time'],
				),
			),
		) );
	?>
		
	<div class="gallery_widget gallery_widget_posts owl-carousel owl-theme">
		<?php while ($posts->have_posts()): $posts->the_post(); ?>

			<?php if ( has_post_thumbnail() ): ?>
				<div class="item wgr T_post">
					<div class="featured_thumb">
						<a class="first_A" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark" >
							<?php the_post_thumbnail('blocktwo'); ?>
							<?php format_icon(); ?>
							<h3><?php the_title(); ?></h3>
						</a>
					</div>
					<div class="details">
						<span class="s_category">
							<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" rel="date"><i class="icon-calendar mi"></i> <?php the_time('j M, Y'); ?></a>
							<a rel="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="icon-user mi"></i><?php echo get_the_author(); ?></a>
						</span>
						<span class="more_meta"><a href="<?php comments_link(); ?>"><i class="icon-message mi"></i> <?php comments_number( '0', '1', '%' ); ?></a></span>
					</div>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>
	</div><!--/slideshow-->

<?php
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = strip_tags($new['title']);
		$instance['posts_num'] = strip_tags($new['posts_num']);
		$instance['posts_cat_id'] = strip_tags($new['posts_cat_id']);
		$instance['posts_orderby'] = strip_tags($new['posts_orderby']);
		$instance['posts_time'] = strip_tags($new['posts_time']);
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> 'Slideshow',
			'posts_num' 		=> '4',
			'posts_cat_id' 		=> '0',
			'posts_orderby' 		=> 'date',
			'posts_time' 		=> '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
	
	<div class="T20-options-posts">
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'T20'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>

		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("posts_num"); ?>"><?php _e('Items to show', 'T20'); ?></label>
			<input style="width:20%;" id="<?php echo $this->get_field_id("posts_num"); ?>" name="<?php echo $this->get_field_name("posts_num"); ?>" type="text" value="<?php echo absint($instance["posts_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_cat_id"); ?>"><?php _e('Category:', 'T20'); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("posts_cat_id"), 'selected' => $instance["posts_cat_id"], 'show_option_all' => 'All', 'show_count' => true ) ); ?>		
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_orderby"); ?>"><?php _e('Order by:', 'T20'); ?></label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("posts_orderby"); ?>" name="<?php echo $this->get_field_name("posts_orderby"); ?>">
			  <option value="date"<?php selected( $instance["posts_orderby"], "date" ); ?>><?php _e('Most recent', 'T20'); ?></option>
			  <option value="comment_count"<?php selected( $instance["posts_orderby"], "comment_count" ); ?>><?php _e('Most commented', 'T20'); ?></option>
			  <option value="rand"<?php selected( $instance["posts_orderby"], "rand" ); ?>><?php _e('Random', 'T20'); ?></option>
			</select>	
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_time"); ?>"><?php _e('Posts from:', 'T20'); ?></label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("posts_time"); ?>" name="<?php echo $this->get_field_name("posts_time"); ?>">
			  <option value="0"<?php selected( $instance["posts_time"], "0" ); ?>><?php _e('All time', 'T20'); ?></option>
			  <option value="1 year ago"<?php selected( $instance["posts_time"], "1 year ago" ); ?>><?php _e('This year', 'T20'); ?></option>
			  <option value="1 month ago"<?php selected( $instance["posts_time"], "1 month ago" ); ?>><?php _e('This month', 'T20'); ?></option>
			  <option value="1 week ago"<?php selected( $instance["posts_time"], "1 week ago" ); ?>><?php _e('This week', 'T20'); ?></option>
			  <option value="1 day ago"<?php selected( $instance["posts_time"], "1 day ago" ); ?>><?php _e('Past 24 hours', 'T20'); ?></option>
			</select>	
		</p>
	</div>
<?php

}

}
