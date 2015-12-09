<?php
$logo_padding = boston_get_option( 'logo_padding' );
?>
    <!-- header -->
    <header class="header-2">
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

                    <!-- logo -->
                    <div class="col-md-12">
                        <div class="logo" style="<?php echo !empty( $logo_padding ) ? 'padding: '.esc_attr( $logo_padding ).';' : '' ?>">
                            <?php require_once( locate_template( 'includes/headers/logo.php' ) ); ?>
                        </div>
                    </div>
                    <!-- #logo -->

                    <!-- navigation -->
                    <div class="col-md-12">
                        <?php require_once( locate_template( 'includes/headers/navigation.php' ) ) ?>
                    </div>
                    <!-- #navigation -->
                </div>

            </div>
        </div>
    </header>
    <!-- #header -->