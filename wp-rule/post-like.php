<?php
$wp_scripts = new WP_Scripts();

$timebeforerevote = 744; // = 30 days

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', 1 );
wp_localize_script('like_post', 'ajax_var', array(
	'url' => admin_url('admin-ajax.php'),
	'nonce' => wp_create_nonce('ajax-nonce')
));

function post_like()
{
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
		
	if(isset($_POST['post_like']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];
		
		$meta_IP = get_post_meta($post_id, "voted_IP");

	if(isset($meta_IP[0]))
	{
		$voted_IP = $meta_IP[0]; 
		if(!is_array($voted_IP))
			$voted_IP = array();}
		
		$meta_count = get_post_meta($post_id, "votes_count", true);

		if(!hasAlreadyVoted($post_id))
		{
			$voted_IP[$ip] = time();

			update_post_meta($post_id, "voted_IP", $voted_IP);
			update_post_meta($post_id, "votes_count", ++$meta_count);
			
			echo $meta_count;
		}
		else
			echo "already";
	}
	exit;
}

function hasAlreadyVoted($post_id)
{
	global $timebeforerevote;

	$meta_IP = get_post_meta($post_id, "voted_IP");
	if(isset($meta_IP[0]))
	{
		$voted_IP = $meta_IP[0];
	
	if(!is_array($voted_IP))
		$voted_IP = array();
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(in_array($ip, array_keys($voted_IP)))
	{
		$time = $voted_IP[$ip];
		$now = time();
		
		if(round(($now - $time) / 3600 ) > $timebeforerevote)
			return false;
			
		return true;
	}}
	return false;
}

function getPostLikeLink($post_id)
{

	$vote_count = get_post_meta($post_id, "votes_count", true);
	if ( empty($vote_count)) $vote_count = 0;

	echo '<span class="post-like">'."\n";
	if(hasAlreadyVoted($post_id))
		echo '<span title="'.__('I like this article', 'color-theme-framework').'" class="qtip like icon-heart alreadyvoted"></span>'."\n";
	else
		echo '<a href="#" data-post_id="'.$post_id.'">' ."\n".'<span  title="'.__('I like this article', 'color-theme-framework').'" class="qtip like icon-heart"></span></a>'."\n";
		echo '<span class="count">'.$vote_count.'</span><!-- .count -->' ."\n".'</span><!-- .post-like -->'."\n";
	
//	return $output;
}