<!doctype html>
<!--[if IE 8 ]><html class="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="//w3.org/1999/xhtml" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' );?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php 
		wp_head();

		if ( ot_get_option( 'meta_desc' ) !== '' ) {
			if ( is_single() ) { ?>
				<meta name="description" content='<?php echo gen_meta_desc(); ?>' />
			<?php } else { ?>
				<meta name="description" content="<?php echo ot_get_option( 'meta_desc' ); ?>">
			<?php }
		}

		if ( ot_get_option( 'meta_key' ) !== '' ) {
			global $post; 
			if ( is_single() ) {
				$tags = get_the_tags($post->ID);
				$keywords = '';
				if($tags) {
					foreach($tags as $tag) :
						$sep = (empty($keywords)) ? '' : ', ';
						$keywords .= $sep . $tag->name;
					endforeach;
				?>
					<meta name="keywords" content="<?php echo $keywords; ?>" />
				<?php }
			} else { ?>
				<meta name="keywords" content="<?php echo ot_get_option( 'meta_key' ); ?>">
			<?php }
		} 
	?>

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
		.masonry_T {margin: 0 0 0 -<?php echo ot_get_option('masonry_margin') ?>px !important} .masonry_T .mosaicflow__item {margin: 0 0 0 <?php echo ot_get_option('masonry_margin') ?>px !important} 
		.masonry_T .b_block {margin: 0 0 <?php echo ot_get_option('masonry_margin') ?>px 0 !important}<?php if ( ot_get_option('responsive') != 'on' ): ?>#layout {min-width: 1210px}<?php endif; ?>
	</style>
</head>

<body <?php body_class() ?>>
	<div id="layout" class="<?php if ( ot_get_option( 'full-boxed' ) === '1' ): ?>full<?php elseif ( ot_get_option( 'full-boxed' ) === '2' ): ?>boxed<?php else: ?>boxed-margin<?php endif; ?> <?php if ( ot_get_option('introfx') != 'off' ) : ?>load_anim<?php endif; ?>">

		<?php
			wp_reset_postdata();
			global $post;
			$slideshow_pos = get_post_meta($post->ID,'_slideshow_pos',true);
			if ( $slideshow_pos !== 'on' ) : 
		?>
		<header id="header">
			<?php 
				if ( ot_get_option( 'head_img_above' ) ) {
					if ( ot_get_option( 'head_img_above_link' ) ) {
						echo '<a class="top_img" target="_blank" href="';
						echo ot_get_option( 'head_img_above_link' );
						echo '">';
					}
					echo '<img src="';
					echo ot_get_option( 'head_img_above' );
					echo '" />';
					if ( ot_get_option( 'head_img_above_link' ) ) {
						echo '</a>';
					}
				}

				if ( ot_get_option( 'head_pos' ) === 'head1' ) : 
					get_template_part('inc/head'); 
					get_template_part('inc/head_sec'); 
				elseif ( ot_get_option( 'head_pos' ) === 'head2' ) : 
					get_template_part('inc/head_sec'); 
					get_template_part('inc/head'); 
				elseif ( ot_get_option( 'head_pos' ) === 'head5' ) : 
					get_template_part('inc/head_sec'); 
					get_template_part('inc/head5'); 
				else : 
					get_template_part('inc/head_t'); 
				endif; 

				if ( ot_get_option( 'head_img_below' ) ) {
					if ( ot_get_option( 'head_img_below_link' ) ) {
						echo '<a class="top_img" target="_blank" href="';
						echo ot_get_option( 'head_img_below_link' );
						echo '">';
					}
					echo '<img src="';
					echo ot_get_option( 'head_img_below' );
					echo '" />';
					if ( ot_get_option( 'head_img_below_link' ) ) {
						echo '</a>';
					}
				}
			?>
		</header><!-- /header -->
		<?php endif; ?>

		<?php if ( is_page_template('page-home-slideshow.php') ) { ?>
			<?php
				wp_reset_postdata();
				global $post;
				$slideshow_tag = get_post_meta($post->ID,'_slideshow_tag',true);
				$slideshow_category = get_post_meta($post->ID,'_slideshow_category',true);
				$slideshow_num = get_post_meta($post->ID,'_slideshow_num',true);
				$slideshow_num_view = get_post_meta($post->ID,'_slideshow_num_view',true);
				$autoPlay = get_post_meta($post->ID,'_autoPlay',true);
				$stopOnHover = get_post_meta($post->ID,'_stopOnHover',true);
				$pagination = get_post_meta($post->ID,'_pagination',true);
				$navigation = get_post_meta($post->ID,'_navigation',true);
				$slideSpeed = get_post_meta($post->ID,'_slideSpeed',true);
				$paginationSpeed = get_post_meta($post->ID,'_paginationSpeed',true);
			?>
			<div class="big_carousel in-view-<?php echo $slideshow_num_view; ?> <?php if ( $slideshow_pos === 'on' ) { ?>ca_above<?php } ?>">
				<div id="big_carousel" class="owl-carousel">
					<?php
					$queryObjectslide = new WP_query( array(
						'category__and' => $slideshow_category,
						'tag__and' => $slideshow_tag,
						'posts_per_page' => $slideshow_num
					) );
					
					if ($queryObjectslide->have_posts()) {
						while ($queryObjectslide->have_posts()) {
							$queryObjectslide->the_post();
					?>
								<?php if ( has_post_thumbnail()) : ?>
									<div class="item wgr featured_thumb">
									<?php 
										edit_post_link('edit'); 
										if ( $slideshow_num_view === '2' ) {
											$img_corp = 'slidehalf';
										} elseif ( $slideshow_num_view === '3' ) {
											$img_corp = 'slidethree';
										} elseif ( $slideshow_num_view === '4' ) {
											$img_corp = 'slidefour';
										} elseif ( $slideshow_num_view === '5' ) {
											$img_corp = 'slide';
										} else {
											$img_corp = 'slidefull';
										}
										$thumb_id = get_post_thumbnail_id(); 
										$thumb_url_array = wp_get_attachment_image_src($thumb_id, $img_corp, true); 
										$thumb_url = $thumb_url_array[0]; 
									?>

										<a class="first_A" href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_url; ?>" alt="#"><?php format_icon(); ?><h3> <?php the_title(); ?> </h3></a>
										<?php get_review(); ?>
										<div class="details">
											<span class="s_category">
												<a href="<?php the_permalink(); ?>"><i class="icon-calendar mi"></i><?php the_time('M j, Y'); ?></a>
												<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="icon-user mi"></i><?php the_author(); ?></a>
											</span>
											<span class="more_meta">
												<a href="<?php comments_link(); ?>"><i class="icon-message mi"></i><?php comments_number( '0', '1', '%' ); ?></a>
											</span>
										</div><!-- /details -->
									</div><!-- /item -->
								<?php endif;
						}
					} wp_reset_query(); ?>
				</div><!-- /ID big carousel -->
			</div><!-- /big carousel -->
			<script type="text/javascript">	
				/* <![CDATA[ */
					jQuery(document).ready(function() {
						jQuery("#big_carousel").owlCarousel({
							slideSpeed : <?php echo $slideSpeed; ?>,
							paginationSpeed : <?php echo $paginationSpeed; ?>,
							<?php if ( $slideshow_num_view === '1' ): ?>
							singleItem: true,
							<?php else: ?>
							items : <?php echo $slideshow_num_view; ?>,
							<?php endif; ?>
							autoPlay: <?php if ( $autoPlay != 'off' ): ?>true<?php else: ?>false<?php endif; ?>,
							stopOnHover: <?php if ( $stopOnHover != 'off' ): ?>true<?php else: ?>false<?php endif; ?>,
							addClassActive: true,
							autoHeight: true,
							responsive: <?php if ( ot_get_option('responsive') != 'off' ): ?>true<?php else: ?>false<?php endif; ?>,
							navigation: <?php if ( $navigation != 'off' ): ?>true<?php else: ?>false<?php endif; ?>,
							navigationText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
							pagination : <?php if ( $pagination != 'off' ): ?>true<?php else: ?>false<?php endif; ?>,
							paginationNumbers: false
						});
					});
				/* ]]> */
			</script>
		<?php } ?>

		<?php if ( $slideshow_pos === 'on' ) : ?>
		<header id="header">
			<?php 
				if ( ot_get_option( 'head_img_above' ) ) {
					if ( ot_get_option( 'head_img_above_link' ) ) {
						echo '<a class="top_img" target="_blank" href="';
						echo ot_get_option( 'head_img_above_link' );
						echo '">';
					}
					echo '<img src="';
					echo ot_get_option( 'head_img_above' );
					echo '" />';
					if ( ot_get_option( 'head_img_above_link' ) ) {
						echo '</a>';
					}
				}

				if ( ot_get_option( 'head_pos' ) === 'head1' ) : 
					get_template_part('inc/head'); 
					get_template_part('inc/head_sec'); 
				elseif ( ot_get_option( 'head_pos' ) === 'head2' ) : 
					get_template_part('inc/head_sec'); 
					get_template_part('inc/head'); 
				elseif ( ot_get_option( 'head_pos' ) === 'head5' ) : 
					get_template_part('inc/head_sec'); 
					get_template_part('inc/head5'); 
				else : 
					get_template_part('inc/head_t'); 
				endif; 

				if ( ot_get_option( 'head_img_below' ) ) {
					if ( ot_get_option( 'head_img_below_link' ) ) {
						echo '<a class="top_img" target="_blank" href="';
						echo ot_get_option( 'head_img_below_link' );
						echo '">';
					}
					echo '<img src="';
					echo ot_get_option( 'head_img_below' );
					echo '" />';
					if ( ot_get_option( 'head_img_below_link' ) ) {
						echo '</a>';
					}
				}
			?>
		</header><!-- /header -->
		<?php endif; ?>

		<div id="T20_container" class="page-content">
			<div class="row clearfix">