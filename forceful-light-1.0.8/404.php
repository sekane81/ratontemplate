<?php get_header(); ?>

<?php get_template_part( 'library/templates/template', 'headline' ); ?>

<div id="main-content">

    <div class="wrapper">
        <div class="row-fluid">
            <div class="span12 clearfix">
                   
                <?php kopa_breadcrumb(); ?>
                <!-- breadcrumb -->
                            
                <section class="error-404 clearfix">
                    <div class="left-col">
                        <p><?php _e( '404', kopa_get_domain() ); ?></p>
                    </div><!--left-col-->
                    <div class="right-col">
                        <h1><?php _e( 'Page not found...', kopa_get_domain() ); ?></h1>
                        <p><?php _e( "We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of this options:", kopa_get_domain() ); ?></p>
                        <ul class="arrow-list">
                            <?php if ( isset( $_SERVER['HTTP_REFERER'] ) ) { ?>
                            <li><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><?php _e( 'Go back to previous page', kopa_get_domain() ); ?></a></li>
                            <?php } ?>
                            <li><a href="<?php echo home_url(); ?>"><?php _e( 'Go to homepage', kopa_get_domain() ); ?></a></li>
                        </ul>
                    </div><!--right-col-->
                </section><!--error-404-->
                
            </div>
            <!-- span12 -->
        </div>
        <!-- row-fluid -->
    </div>
    <!-- wrapper -->
</div>
<!-- main-content -->

<?php get_footer(); ?>