<?php
/**
 * The template for displaying search forms in Theme
 *
 * @package WordPress
 * @subpackage Rule
 * @since Rule 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search this site', 'color-theme-framework' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search this site', 'color-theme-framework' ); ?>" />
		<i class="icon-search"></i>
	</form>
