<?php 
$site_style = boston_get_option( 'site_style' );
if( $site_style == 'dark' ){
	$site_logo = boston_get_option( 'site_logo_dark' );
}
else{
	$site_logo = boston_get_option( 'site_logo' );
}
if( !empty( $site_logo['url'] ) ): ?>
    <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-logo">    
        <img src="<?php echo esc_url( $site_logo['url'] ); ?>" title="" alt="" width="<?php echo esc_attr( $site_logo['width'] ) ?>" height="<?php echo esc_attr( $site_logo['height'] ) ?>">
    </a>
<?php endif; ?>