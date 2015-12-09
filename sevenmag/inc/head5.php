			<div class="head head5 <?php if ( ot_get_option( 'sticky' ) === 'on' ): ?>my_sticky<?php endif; ?>">
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
				</div><!-- /row -->
			</div><!-- /head -->