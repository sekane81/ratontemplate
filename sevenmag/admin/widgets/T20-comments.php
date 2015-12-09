<?php
class T20_comments extends WP_Widget {

	function __construct() {
		$widget_ops = array('description' => 'Show recent comments widget.' );
		parent::__construct(false, __('T20 - Comments', 'T20'),$widget_ops);      
	}

	function widget($args, $instance) {  
		extract( $args );
			$title = $instance['title'];
			$postcount = $instance['postcount'];
		?>		
		<?php echo $before_widget; ?>
		<?php if ($title) { echo $before_title . esc_html($title ). $after_title; } else { echo $before_title .'T20_comments'. $after_title; } ?>
        	
		<div class="clearfix more_posts">
			<?php
            
            $comment_posts = get_option('comment_posts');
            if (empty($comment_posts) || $comment_posts < 1) $comment_posts = $postcount;
            
            global $wpdb;
             
            $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
            comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
            comment_type,comment_author_url,
            SUBSTRING(comment_content,1,50) AS com_excerpt
            FROM $wpdb->comments
            LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
            $wpdb->posts.ID)
            WHERE comment_approved = '1' AND comment_type = '' AND
            post_password = ''
            ORDER BY comment_date_gmt DESC LIMIT ".$comment_posts;
            
            $comments = $wpdb->get_results($sql);
            
            foreach ($comments as $comment) {
            
            
            ?>
			
					<div class="item_small">
						<div class="one_post">
							<div class="featured_thumb">
								<?php echo get_avatar( $comment, '80' ); ?>
							</div>
							<div class="item-details">
								<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->comment_author); ?> <small>says:</small></a>
								<div class="post_meta">
									<?php echo strip_tags($comment->com_excerpt); ?>...
								</div>
							</div>
						</div>
					</div>
            <?php 
            }
	echo '</div>';
	echo $after_widget;
   }


   function form($instance) {   
   
   		$defaults = array('title' => 'Recent Comments','postcount' => '4');
		$instance = wp_parse_args((array) $instance, $defaults);    
   
       $title = esc_attr($instance['title']);
	   $postcount = esc_attr($instance['postcount']);

       ?>
       	<p>
	   	   	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','T20'); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       	</p>
       
       	<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of comments', 'T20') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo esc_attr($instance['postcount']); ?>" />
		</p>
      <?php
   }

} 
?>