<?php
$logo_padding = boston_get_option( 'logo_padding' );
?>
<!-- header -->
    <header class="header-3">
        <div class="container">
            <div class="row">
                <div class="header clearfix">

                    <div class="search-query">
                        <form role="search" method="get" class="searchform" action="<?php echo esc_url( site_url('/') ) ?>">
                            <div class="input-group">
                                <input type="text" value="" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search blog...', 'boston' ) ?>">
                                <input type="hidden" name="post_type" value="post">
                            </div>
                        </form>
                    </div>

                    <div class="clearfix">

                        <!-- logo -->
                        <div class="pull-left">
                            <div class="logo" style="<?php echo !empty( $logo_padding ) ? 'padding: '.esc_attr( $logo_padding ).';' : '' ?>">
                                <?php require_once( locate_template( 'includes/headers/logo.php' ) ); ?>
                            </div>
                        </div>
                        <!-- #logo -->

                    
                        <!-- navigation -->
                        <div class="pull-right">
                            <ul class="list-inline list-unstyled total-overlay-nav navbar-nav nav">
                                <li>
                                    <a href="javascript:;" class="total-overlay-trigger">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                                <li class="search">
                                    <a href="javascript:;">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- #navigation -->
                        
                        <div class="total-overlay">
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
                            <a href="javascript:;" class="total-overlay-close">
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- #header -->