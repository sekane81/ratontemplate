<?php
/*
	DEFAULT BLOG LSITING WITH THE MASONRY
*/	
get_header();
global $wp_query;
$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page

$page_links_total =  $wp_query->max_num_pages;
$page_links = paginate_links( 
	array(
		'prev_next' => true,
		'end_size' => 2,
		'mid_size' => 2,
		'total' => $page_links_total,
		'current' => $cur_page,	
		'prev_next' => false,
		'type' => 'array'
	)
);

$pagination = boston_format_pagination( $page_links );
$blog_listing_layout = boston_get_option( 'blog_listing_layout' );
?>

<!-- main content -->
<main class="<?php echo esc_attr( $blog_listing_layout ) ?>">

    <div class="container">
        <div class="row">

            <!-- post listing -->
            <?php if( $blog_listing_layout == 'left_sidebar' ): ?>
				<div class="col-md-3 no-padding">
					<aside class="sidebar">
						<?php get_sidebar(); ?>
					</aside>
				</div>            	
            <?php endif; ?>
            <div class="col-md-<?php echo $blog_listing_layout == 'full_width' ? esc_attr( '12' ) : esc_attr( '9' ); ?> no-padding">
                <section class="post-listing clearfix">
					<?php
					if( have_posts() ){
						while( have_posts() ){
							the_post();
							$has_media = boston_has_media();
							$post_format = get_post_format();
							?>
							<?php if( $post_format !== 'quote' && $post_format !== 'link' ): ?>
		                        <!-- post -->	                        
		                        <article <?php post_class( 'post clearfix'.( $has_media ? ' has-media' : '' ).''  ) ?>>
		                        	<?php
										if( is_sticky() ){
											?>
											<div class="sticky">
												<i class="fa fa-paperclip"></i>
											</div>
											<?php
										}
		                        	?>
		                            <!-- post image -->
									<?php if( $has_media ): ?>
										<div class="col-md-5 no-padding">
										<?php
										$image_size = 'listing-box';
										include( locate_template( 'media/media'.( $post_format ? '-'.$post_format : '' ).'.php' ) );
										?>
										</div>
									<?php endif; ?>
		                            <!-- #post image -->

		                            <!-- post content -->
		                            <div class="col-md-<?php echo $has_media ? esc_attr( '7' ) : esc_attr( '12' ); ?> no-padding">
		                                <div class="post-content">

		                                	<?php if( $post_format == 'audio' && !has_post_thumbnail() ){
												$audio_type = get_post_meta( get_the_ID(), 'audio_type', true );			                                		
												$iframe_audio = get_post_meta( get_the_ID(), 'iframe_audio', true );
												if( $audio_type !== 'embed' ){
													echo do_shortcode( '[audio mp3="'.$iframe_audio.'"]' );
												}
		                                	}
		                                	?>

		                                    <h2>
			                                    <a href="<?php the_permalink() ?>">
				                                    <?php 
				                                    $blog_title_max_length = boston_get_option( 'blog_title_max_length' );
				                                    $title = get_the_title();
				                                    if( !empty( $blog_title_max_length ) && strlen( $title ) > $blog_title_max_length ){
				                                    	$title = mb_substr( $title, 0, $blog_title_max_length ).'...';
				                                    }
				                                    echo esc_html( $title );
				                                    ?>
			                                    </a>
		                                    </h2>

		                                    <?php
		                                    $blog_excerpt_max_length = boston_get_option( 'blog_excerpt_max_length' );
		                                    $excerpt = get_the_excerpt();
		                                    if( !empty( $blog_excerpt_max_length ) && strlen( $excerpt ) > $blog_excerpt_max_length ){
		                                    	$excerpt = mb_substr( $excerpt, 0, $blog_excerpt_max_length ).'...';
		                                    }
		                                    echo '<p>'.$excerpt.'</p>';
		                                    ?>

		                                </div>
		                            </div>
		                            <!-- #post content -->

		                        </article>
		                        <!-- #post -->
		                    <?php else: ?>
		                        <!-- post -->	                        
		                        <article <?php post_class( 'post clearfix'  ) ?>>

			                            <!-- post image -->
										<?php 
										$image_size = 'full-width-box';
										include( locate_template( 'media/media'.( $post_format ? '-'.$post_format : '' ).'.php' ) );
										?>
			                            <!-- #post image -->


		                        </article>
		                        <!-- #post -->
		                   	<?php endif; ?>

							<?php
						}
					}
					?>

					<?php
					if( !empty( $pagination ) )	{
						?>
						<div class="theme-pagination">
						    <div class="container">
						        <div class="row">
						            <div class="col-md-12 no-padding">
						                <nav>
						                    <ul class="pagination">
						                        <?php echo  $pagination; ?>
						                    </ul>
						                </nav>
						            </div>
						        </div>
						    </div>
						</div>
						<?php
					}
					?>

                </section>
            </div>
            
            <?php if( $blog_listing_layout == 'right_sidebar' ): ?>
				<div class="col-md-3 no-padding">
					<aside class="sidebar">
						<?php get_sidebar(); ?>
					</aside>
				</div>
			<?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>