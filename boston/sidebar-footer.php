<?php if( is_active_sidebar( 'sidebar-bottom-1' ) || is_active_sidebar( 'sidebar-bottom-2' ) || is_active_sidebar( 'sidebar-bottom-3' ) || is_active_sidebar( 'sidebar-bottom-4' )): ?>
    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">

                <!-- footer widget about -->
                <div class="col-md-3">
                    <?php 
                    if( is_active_sidebar( 'sidebar-bottom-1' ) ){
                        dynamic_sidebar( 'sidebar-bottom-1' );
                    }
                    ?>
                </div>
                <!-- #footer widget about -->

                <!-- footer widget chosen posts -->
                <div class="col-md-3">
                    <?php 
                    if( is_active_sidebar( 'sidebar-bottom-2' ) ){
                        dynamic_sidebar( 'sidebar-bottom-2' );
                    }
                    ?>
                </div>
                <!-- #footer widget chosen posts -->

                <!-- footer widget instafeed -->
                <div class="col-md-3">
                    <?php 
                    if( is_active_sidebar( 'sidebar-bottom-3' ) ){
                        dynamic_sidebar( 'sidebar-bottom-3' );
                    }
                    ?>
                </div>
                <!-- #footer widet instafeed -->

                <!-- footer widget tagcloud & social share -->
                <div class="col-md-3">
                    <?php 
                    if( is_active_sidebar( 'sidebar-bottom-4' ) ){
                        dynamic_sidebar( 'sidebar-bottom-4' );
                    }
                    ?>
                </div>
                <!-- #footer widget tagcloud & social share -->

            </div>
        </div>
    </footer>
    <!-- #footer -->    
<?php endif; ?>