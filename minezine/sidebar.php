<?php
/**
 * The sidebar template file.
 * @package MineZine
 * @since MineZine 1.0.0
*/
?>
<?php global $minezine_options_db; ?>
<?php if ($minezine_options_db['minezine_display_sidebar'] != 'Hide') { ?>
<aside id="sidebar">
<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
<?php endif; ?>
</aside> <!-- end of sidebar -->
<?php } ?>