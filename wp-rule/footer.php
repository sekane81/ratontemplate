<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */
?>

<?php
	global $ct_options;
	
	$copyright_info = stripslashes( $ct_options['ct_copyright_info'] );
	$add_info = stripslashes( $ct_options['ct_add_info'] );
	$footer_columns = $ct_options['ct_footer_columns'];
?>

<div id="footer" role="contentinfo">
	<div class="transparent-bg"></div>
	
	<div class="container clearfix">

	<?php if ( $footer_columns != 0  ) : ?>
		<div class="row-fluid">
				<?php									

				switch( $footer_columns ) {
					// 1 Column
					case 1:
					echo '<div class="row-fluid">';
						echo '<div class="span12">';

							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #1") ) :
							endif;
						echo '</div>';					
					echo '</div>';
					break;
					// 2 Columns
					case 2:
					echo '<div class="row-fluid">';
						echo '<div class="span6">';

							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #1") ) :
							endif;
						echo '</div>';	
						echo '<div class="span6">';

							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #2") ) :
							endif;
						echo '</div>';										
					echo '</div>';
					break;		
					// 3 Columns
					case 3:
					echo '<div class="row-fluid">';
						echo '<div class="span4">';

							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #1") ) :
							endif;
						echo '</div>';	
						echo '<div class="span4">';

							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #2") ) :
							endif;
						echo '</div>';	
						echo '<div class="span4">';

							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #3") ) :
							endif;
						echo '</div>';																
					echo '</div>';
					break;	
					// 4 Columns
					case 4:
					echo '<div class="row-fluid">';
						echo '<div class="span3">';
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #1") ) :
							endif;
						echo '</div>';	
						echo '<div class="span3">';
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #2") ) :
							endif;
						echo '</div>';	
						echo '<div class="span3">';
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #3") ) :
							endif;
						echo '</div>';	
						echo '<div class="span3">';
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column #4") ) :
							endif;
						echo '</div>';																						
					echo '</div>';
					break;	
																		
				}
			?>				
			</div> <!-- /row-fluid -->
	<?php endif; ?>		
			<?php if ( $footer_columns != 0 ) : ?>
				<div class="divider-1px"></div>
				<div class="clear"></div>
				<div class="margin-40b"></div>
			<?php endif; ?>	
			<div class="row-fluid">
				<div class="span6">
					<div class="copyright-info">
						<?php echo $copyright_info; ?>
					</div><!-- /copyright-info -->
				</div> <!-- /span6 -->
				<div class="span6">
					<div class="add-info">
						<?php echo $add_info; ?>
					</div><!-- /add-info -->
				</div> <!-- /span6 -->
			</div> <!-- /row-fluid -->

	</div><!-- /container -->
</div><!-- /footer -->

<?php wp_footer(); ?>

</body>
</html>