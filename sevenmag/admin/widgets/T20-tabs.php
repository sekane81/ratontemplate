<?php
class T20_Tabs extends WP_Widget {
	function __construct() {
		parent::__construct( false, __('T20 - Tabs', 'T20'), array('description' => __('List posts, comments, and/or tags with or without tabs.', 'T20'), 'classname' => 'widget_T20_tabs') );;	
	}

	private function _create_tabs($tabs,$count) {
		$titles = array(
			'recent'		=> ot_get_option('tab_recent'),
			'popular'	=> ot_get_option('tab_pop'),
			'comments'	=> ot_get_option('tab_cm'),
			'tags'		=> ot_get_option('tab_tags')
		);
		$icons = array(
			'recent'   => 'icon-folder-open',
			'popular'  => 'icon-heart',
			'comments' => 'icon-conversation',
			'tags'     => 'icon-tag'
		);
		$output = sprintf('<ul class="clearfix T20-tabs-nav group tab-count-%s">', $count);
		foreach ( $tabs as $tab ) {
			$output .= sprintf('<li class="T20-tab tab-%1$s"><a href="#tab-%2$s" title="%4$s"><i class="%3$s"></i><span>%4$s</span></a></li>',$tab, $tab, $icons[$tab], $titles[$tab]);
		}
		$output .= '</ul>';
		return $output;
	}
	
/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$instance['title']?NULL:$instance['title']='';
		$title = apply_filters('widget_title',$instance['title']);
		$output = "\n";
		ob_start();
		
/*  Set tabs-nav order & output it
/* ------------------------------------ */
	$tabs = array();
	$count = 0;
	$order = array(
		'recent'	=> $instance['order_recent'],
		'popular'	=> $instance['order_popular'],
		'comments'	=> $instance['order_comments'],
		'tags'		=> $instance['order_tags']
	);
	asort($order);
	foreach ( $order as $key => $value ) {
		if ( $instance[$key.'_enable'] ) {
			$tabs[] = $key;
			$count++;
		}
	}
	if ( $tabs && ($count > 1) ) { $output .= $this->_create_tabs($tabs,$count); }
?>

	<div class="widget clearfix introfx more_posts">

	
		<?php if($instance['recent_enable']) { // Recent posts enabled? ?>
			
			<?php $recent=new WP_Query(); ?>
			<?php $recent->query('showposts='.$instance["recent_num"].'&cat='.$instance["recent_cat_id"].'&ignore_sticky_posts=1');?>
			
			<div id="tab-recent" class="T20-tab group">
				<?php while ($recent->have_posts()): $recent->the_post(); ?>
					<div class="item_small">
						<div class="one_post">
							<?php if($instance['recent_thumbs']) { // Thumbnails enabled? ?>
							<?php if ( has_post_thumbnail() ): ?>
							<div class="featured_thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail('thumbnail'); ?>

									<?php format_icon(); ?>
								</a>
							</div>
							<?php endif; ?>
							<?php } ?>
							<div class="item-details">
								<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<div class="post_meta">
									<?php if($instance['tabs_date']) { ?><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" rel="date" title="<?php the_title(); ?>"><i class="icon-calendar mi"></i><?php the_time('j M, Y'); ?></a>
									<a href="<?php comments_link(); ?>"><i class="icon-message mi"></i><?php comments_number( '0', '1', '%' ); ?></a><?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div><!--/.T20-tab-->

		<?php } ?>


		<?php if($instance['popular_enable']) { // Popular posts enabled? ?>
				
			<?php
				$popular = new WP_Query( array(
					'post_type'		=> array( 'post' ),
					'showposts'		=> $instance['popular_num'],
					'cat'			=> $instance['popular_cat_id'],
					'ignore_sticky_posts'	=> true,
					'orderby'		=> 'comment_count',
					'order'			=> 'dsc',
					'date_query' 		=> array(
						array(
							'after' => $instance['popular_time'],
						),
					),
				) );
			?>
			<div id="tab-popular" class="T20-tab group">
				
				<?php while ( $popular->have_posts() ): $popular->the_post(); ?>
					<div class="item_small">
						<div class="one_post">
							<?php if($instance['popular_thumbs']) { // Thumbnails enabled? ?>
							<?php if ( has_post_thumbnail() ): ?>
							<div class="featured_thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail('thumbnail'); ?>

									<?php format_icon(); ?>
								</a>
							</div>
							<?php endif; ?>
							<?php } ?>
							<div class="item-details">
								<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<div class="post_meta">
									<?php if($instance['tabs_date']) { ?><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" rel="date" title="<?php the_title(); ?>"><i class="icon-calendar mi"></i><?php the_time('j M, Y'); ?></a>
									<a href="<?php comments_link(); ?>"><i class="icon-message mi"></i><?php comments_number( '0', '1', '%' ); ?></a><?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div><!--/.T20-tab-->
			
		<?php } ?>
	

		<?php if($instance['comments_enable']) { // Recent comments enabled? ?>

			<?php $comments = get_comments(array('number'=>$instance["comments_num"],'status'=>'approve','post_status'=>'publish')); ?>
			
			<div id="tab-comments" class="T20-tab group">
				<?php foreach ($comments as $comment): ?>
					<div class="item_small">
						<div class="one_post">
							<?php if($instance['comments_avatars']) { // Avatars enabled? ?>
							<div class="featured_thumb">
								<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
									<?php echo get_avatar($comment->comment_author_email,$size='96'); ?>
								</a>
							</div>
							<?php } ?>
							<div class="item-details">
								<?php $str=explode(' ',get_comment_excerpt($comment->comment_ID)); $comment_excerpt=implode(' ',array_slice($str,0,11)); if(count($str) > 11 && substr($comment_excerpt,-1)!='.') $comment_excerpt.='...' ?>
								<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php echo $comment->comment_author; ?> <small><?php _e('says:','T20'); ?></small></a>
								<div class="post_meta">
									<?php echo $comment_excerpt; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div><!--/.T20-tab-->

		<?php } ?>

		<?php if($instance['tags_enable']) { // Tags enabled? ?>
			<div id="tab-tags" class="T20-tab tagcloud group">
				<?php wp_tag_cloud(); ?>
			</div><!--/tab-->
		<?php } ?>
	</div>

<?php
		$output .= ob_get_clean();
		$output .= "\n";
		echo $output;
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = strip_tags($new['title']);
		$instance['tabs_category'] = $new['tabs_category']?1:0;
		$instance['tabs_date'] = $new['tabs_date']?1:0;
	// Recent posts
		$instance['recent_enable'] = $new['recent_enable']?1:0;
		$instance['recent_thumbs'] = $new['recent_thumbs']?1:0;
		$instance['recent_cat_id'] = strip_tags($new['recent_cat_id']);
		$instance['recent_num'] = strip_tags($new['recent_num']);
	// Popular posts
		$instance['popular_enable'] = $new['popular_enable']?1:0;
		$instance['popular_thumbs'] = $new['popular_thumbs']?1:0;
		$instance['popular_cat_id'] = strip_tags($new['popular_cat_id']);
		$instance['popular_time'] = strip_tags($new['popular_time']);
		$instance['popular_num'] = strip_tags($new['popular_num']);
	// Recent comments
		$instance['comments_enable'] = $new['comments_enable']?1:0;
		$instance['comments_avatars'] = $new['comments_avatars']?1:0;
		$instance['comments_num'] = strip_tags($new['comments_num']);
	// Tags
		$instance['tags_enable'] = $new['tags_enable']?1:0;
	// Order
		$instance['order_recent'] = strip_tags($new['order_recent']);
		$instance['order_popular'] = strip_tags($new['order_popular']);
		$instance['order_comments'] = strip_tags($new['order_comments']);
		$instance['order_tags'] = strip_tags($new['order_tags']);
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
			'tabs_category' 	=> 1,
			'tabs_date' 		=> 1,
		// Recent posts
			'recent_enable' 	=> 1,
			'recent_thumbs' 	=> 1,
			'recent_cat_id' 	=> '0',
			'recent_num' 		=> '5',
		// Popular posts
			'popular_enable' 	=> 1,
			'popular_thumbs' 	=> 1,
			'popular_cat_id' 	=> '0',
			'popular_time' 		=> '0',
			'popular_num' 		=> '5',
		// Recent comments
			'comments_enable' 	=> 1,
			'comments_avatars' 	=> 1,
			'comments_num' 		=> '5',
		// Tags
			'tags_enable' 		=> 1,
		// Order
			'order_recent' 		=> '1',
			'order_popular' 	=> '2',
			'order_comments' 	=> '3',
			'order_tags' 		=> '4',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
	
	<div class="T20-options-tabs">
		<h4>Recent Posts</h4>
		
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('recent_enable'); ?>" name="<?php echo $this->get_field_name('recent_enable'); ?>" <?php checked( (bool) $instance["recent_enable"], true ); ?>>
			<label for="<?php echo $this->get_field_id('recent_enable'); ?>">Enable recent posts</label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('recent_thumbs'); ?>" name="<?php echo $this->get_field_name('recent_thumbs'); ?>" <?php checked( (bool) $instance["recent_thumbs"], true ); ?>>
			<label for="<?php echo $this->get_field_id('recent_thumbs'); ?>">Show thumbnails</label>
		</p>	
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("recent_num"); ?>">Items to show</label>
			<input style="width:20%;" id="<?php echo $this->get_field_id("recent_num"); ?>" name="<?php echo $this->get_field_name("recent_num"); ?>" type="text" value="<?php echo absint($instance["recent_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("recent_cat_id"); ?>">Category:</label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("recent_cat_id"), 'selected' => $instance["recent_cat_id"], 'show_option_all' => 'All', 'show_count' => true ) ); ?>		
		</p>
		
		<hr>
		<h4>Most Popular</h4>
		
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('popular_enable'); ?>" name="<?php echo $this->get_field_name('popular_enable'); ?>" <?php checked( (bool) $instance["popular_enable"], true ); ?>>
			<label for="<?php echo $this->get_field_id('popular_enable'); ?>">Enable most popular posts</label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('popular_thumbs'); ?>" name="<?php echo $this->get_field_name('popular_thumbs'); ?>" <?php checked( (bool) $instance["popular_thumbs"], true ); ?>>
			<label for="<?php echo $this->get_field_id('popular_thumbs'); ?>">Show thumbnails</label>
		</p>	
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("popular_num"); ?>">Items to show</label>
			<input style="width:20%;" id="<?php echo $this->get_field_id("popular_num"); ?>" name="<?php echo $this->get_field_name("popular_num"); ?>" type="text" value="<?php echo absint($instance["popular_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("popular_cat_id"); ?>">Category:</label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("popular_cat_id"), 'selected' => $instance["popular_cat_id"], 'show_option_all' => 'All', 'show_count' => true ) ); ?>		
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("popular_time"); ?>">Post with most comments from:</label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("popular_time"); ?>" name="<?php echo $this->get_field_name("popular_time"); ?>">
			  <option value="0"<?php selected( $instance["popular_time"], "0" ); ?>>All time</option>
			  <option value="1 year ago"<?php selected( $instance["popular_time"], "1 year ago" ); ?>>This year</option>
			  <option value="1 month ago"<?php selected( $instance["popular_time"], "1 month ago" ); ?>>This month</option>
			  <option value="1 week ago"<?php selected( $instance["popular_time"], "1 week ago" ); ?>>This week</option>
			  <option value="1 day ago"<?php selected( $instance["popular_time"], "1 day ago" ); ?>>Past 24 hours</option>
			</select>	
		</p>
		
		<hr>
		<h4>Recent Comments</h4>
		
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('comments_enable'); ?>" name="<?php echo $this->get_field_name('comments_enable'); ?>" <?php checked( (bool) $instance["comments_enable"], true ); ?>>
			<label for="<?php echo $this->get_field_id('comments_enable'); ?>">Enable recent comments</label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('comments_avatars'); ?>" name="<?php echo $this->get_field_name('comments_avatars'); ?>" <?php checked( (bool) $instance["comments_avatars"], true ); ?>>
			<label for="<?php echo $this->get_field_id('comments_avatars'); ?>">Show avatars</label>
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("comments_num"); ?>">Items to show</label>
			<input style="width:20%;" id="<?php echo $this->get_field_id("comments_num"); ?>" name="<?php echo $this->get_field_name("comments_num"); ?>" type="text" value="<?php echo absint($instance["comments_num"]); ?>" size='3' />
		</p>

		<hr>
		<h4>Tags</h4>
		
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('tags_enable'); ?>" name="<?php echo $this->get_field_name('tags_enable'); ?>" <?php checked( (bool) $instance["tags_enable"], true ); ?>>
			<label for="<?php echo $this->get_field_id('tags_enable'); ?>">Enable tags</label>
		</p>
	
		<hr>
		<h4>Tab Order</h4>
		
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("order_recent"); ?>"><?php _e('Recent posts', 'T20'); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo $this->get_field_id("order_recent"); ?>" name="<?php echo $this->get_field_name("order_recent"); ?>" value="<?php echo $instance["order_recent"]; ?>" />
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("order_popular"); ?>"><?php _e('Most popular', 'T20'); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo $this->get_field_id("order_popular"); ?>" name="<?php echo $this->get_field_name("order_popular"); ?>" value="<?php echo $instance["order_popular"]; ?>" />
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("order_comments"); ?>"><?php _e('Recent comments', 'T20'); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo $this->get_field_id("order_comments"); ?>" name="<?php echo $this->get_field_name("order_comments"); ?>" value="<?php echo $instance["order_comments"]; ?>" />
		</p>
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("order_tags"); ?>"><?php _e('Tags', 'T20'); ?></label>
			<input class="widefat" style="width:20%;" type="text" id="<?php echo $this->get_field_id("order_tags"); ?>" name="<?php echo $this->get_field_name("order_tags"); ?>" value="<?php echo $instance["order_tags"]; ?>" />
		</p>
		
		<hr>
		<h4><?php _e('Tab Info', 'T20'); ?></h4>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('tabs_date'); ?>" name="<?php echo $this->get_field_name('tabs_date'); ?>" <?php checked( (bool) $instance["tabs_date"], true ); ?>>
			<label for="<?php echo $this->get_field_id('tabs_date'); ?>"><?php _e('Show posts meta', 'T20'); ?></label>
		</p>
		
	</div>
<?php

}

}
