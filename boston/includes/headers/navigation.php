<button class="navbar-toggle button-white menu" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only"><?php _e( 'Toggle navigation', 'bloger' ) ?></span>
    <i class="fa fa-bars"></i>
</button>
<a href="javascript" class="search-trigger">
    <i class="fa fa-search"></i>
</a>
<div class="navbar navbar-default" role="navigation">
    <div class="collapse navbar-collapse">
        <?php
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'top-navigation' ] ) ) {
            wp_nav_menu( array(
                'theme_location'    => 'top-navigation',
                'menu_class'        => 'nav navbar-nav clearfix',
                'container'         => false,
                'echo'              => true,
                'items_wrap'        => '<ul class="%2$s">%3$s<li class="search"><a href="javascript:;"><i class="fa fa-search"></i></a></li></ul>',
                'depth'             => 10,
                'walker'            => new boston_walker,
            ) );
        }
        ?>
    </div>
</div>