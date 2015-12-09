	<?php if ( ot_get_option( 'breaking-or-menu' ) !== '3' ) { ?>
			<div class="sec_head">
				<div class="row clearfix">

					<?php if ( ot_get_option( 'breaking-or-menu' ) === '1' ): ?>
						<script type="text/javascript">	
							/* <![CDATA[ */
								jQuery(document).ready(function() {
									jQuery("#ticker").liScroll({travelocity: 0.0<?php echo ot_get_option( 'news-speed' ); ?>});
								});
							/* ]]> */
						</script>
						<?php if ( ot_get_option('news-category-title') ) { ?><span class="breaking"> <?php echo ot_get_option('news-category-title'); ?> </span><?php } ?>
						<ul id="ticker">
						<?php
							$newscategory = ot_get_option('news-category');
							$categorynum = ot_get_option('news-category-num');
							$queryObject = new WP_query( array(
								'category__and' => $newscategory,
								'posts_per_page' => $categorynum
							) );
							if ($queryObject->have_posts()) {
								while ($queryObject->have_posts()) {
									$queryObject->the_post();
							?>
								<li><a href="<?php the_permalink(); ?>"><span><time class="post_date date updated" datetime="<?php the_time('j M, Y'); ?>"><?php echo time_ago(); ?></time></span> <b class="post-title entry-title"><?php the_title(); ?></b> </a></li>
							<?php
								}
							} wp_reset_query();
						?>
						</ul><!-- /ticker -->
					<?php elseif ( ot_get_option( 'breaking-or-menu' ) === '2' ): ?>
						<nav id="mymenutwo">
							<?php if ( ot_get_option('responsive') != 'off' ) { $responsivemode = 'res_mode'; } else { $responsivemode = 'res_off'; }
							wp_nav_menu( array(
								'theme_location' => 'secondary',
								'container' =>false,
								'fallback_cb' => '',
								'items_wrap' => '<ul class="sf-menu ' . $responsivemode . '">%3$s</ul>',
								'echo' => true,
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'walker' => new vw_main_menu_walker(),
								'depth' => 0,)
							); ?>
						</nav><!-- /nav -->
					<?php endif; ?>

					<div class="right_bar">
						<?php T20_social_links() ; ?>

						<?php if ( ot_get_option( 'random-posts' ) != 'off' ): ?>
							<div class="social r_post"><a href="<?php home_url('/'); ?>?random=1" class="bottomtip" title="<?php echo ot_get_option('random-posts-title'); ?>"><i class="fa fa-random"></i></a></div>
						<?php endif; ?>

						<?php if ( ot_get_option( 'header-search' ) != 'off' ): ?>
						<div class="search">
							<div class="search_icon bottomtip" title="<?php echo ot_get_option('header-search-tooltip'); ?>"><i class="fa fa-search"></i></div>
							<div id="popup">
								<div class="search_place">
									<h4> <?php echo ot_get_option( 'search_title' ); ?> </h4>
									<div class="s_form">
										<form action="<?php echo home_url( '/' ); ?>" id="search" class="searchform" method="get">
											<input id="inputhead" name="s" type="text" onfocus="if (this.value=='<?php echo ot_get_option('header-search-placeholder'); ?>') this.value = '';" onblur="if (this.value=='') this.value = '<?php echo ot_get_option('header-search-placeholder'); ?>';" value="<?php echo get_search_query(); ?>" placeholder="<?php echo ot_get_option('header-search-placeholder'); ?>">
											<button type="submit"><i class="fa fa-search"></i></button>
										</form><!-- /form -->
									</div><!-- /form -->

									<?php if ( ot_get_option( 'header-search-tags' ) === 'on' ) { ?>
										<div class="pop_tags tagcloud mtf">
											<?php wp_tag_cloud('number=20&topic_count_text_callback=default_topic_count_text&orderby=count&order=DESC'); ?>
										</div>
								<?php } ?>

								</div><!-- /search place -->
								<!-- <div id="popupLoginClose">x</div> -->
							</div><!-- /popup -->
							<div id="SearchBackgroundPopup"></div>
						</div><!-- /search -->
						<?php endif; ?>
					</div><!-- /rightbar -->
				</div><!-- /row -->
			</div><!-- /sec head -->
	<?php } ?>