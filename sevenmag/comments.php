<?php if ( post_password_required() ) { return; } ?>
<?php if (comments_open()) : ?>
	<section id="comments" class="themeform introfx">
		<div class="b_title"><h3><i class="icon-conversation mi"></i>
			<?php printf( _n( ot_get_option('cm_one_tr').' &ldquo;%2$s&rdquo;', '%1$s '.ot_get_option('cm_two_tr').' &ldquo;%2$s&rdquo;', get_comments_number(), 'T20' ),
					number_format_i18n( get_comments_number() ), get_the_title() ); ?>
		</h3></div>
	
		<div class="b_block clearfix">
			<?php if ( have_comments() ) : global $wp_query; ?>
				<div id="commentlist-container">
					<ol class="commentlist">
						<?php wp_list_comments( 'avatar_size=80&type=comment' ); ?>	
					</ol><!--/.commentlist-->
					
					<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
						<nav class="comments-nav group">
							<div class="nav-previous"><?php previous_comments_link(); ?></div>
							<div class="nav-next"><?php next_comments_link(); ?></div>
						</nav><!--/.comments-nav-->
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( comments_open() ) { comment_form(); } ?>
		</div>
	</section><!--/comments-->
<?php else : ?>
	<div class="b_block clearfix">
		<p> <?php echo ot_get_option('cm_closed_tr'); ?> </p>
	</div>
<?php endif; ?>