			<div class="head <?php if ( ot_get_option( 'sticky' ) === 'on' ): ?>my_sticky<?php endif; ?>">
				<div class="row clearfix">
					<div class="logo">
						<?php echo T20_site_title(); ?>
					</div><!-- /logo -->

					<nav id="mymenuone">
						<?php if ( ot_get_option('responsive') != 'off' ) { $responsivemode = 'res_mode'; } else { $responsivemode = 'res_off'; } ?>
						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
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

					<?php if ( ot_get_option('header-ads-code') ) { ?>
						<div class="banner">
							<?php echo ot_get_option('header-ads-code'); ?>
						</div><!-- /banner ads -->
					<?php } elseif ( ot_get_option('header-ads-img') ) { ?>
						<div class="banner">
							<?php if ( ot_get_option('header-ads-link') ) { ?>
								<a href="<?php echo ot_get_option('header-ads-link'); ?>" title="<?php echo ot_get_option('header-ads-description'); ?>"><?php } ?>
									<img src="<?php echo ot_get_option('header-ads-img'); ?>" alt="<?php echo ot_get_option('header-ads-description'); ?>">
							<?php if ( ot_get_option('header-ads-link') ) { ?></a><?php } ?>
						</div><!-- /banner ads -->
					<?php } ?>
				</div><!-- /row -->
			</div><!-- /head -->