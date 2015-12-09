<?php
/*
	Template Name: Contact Page
*/
get_header();
the_post();
?>
<main>

    <div class="container">
        <div class="row">

           <!-- single -->
            <div class="col-md-12 no-padding">

                <!-- post single -->
                    <section class="post-single clearfix">

                        <!-- post -->
                        <article class="post clearfix no-margin">

                            <div class="contact_map">
                                <?php
                                $contact_map = boston_get_option( 'contact_map' );
                                if( !empty( $contact_map ) ){
                                    foreach( $contact_map as $long_lat ){
                                        echo '<input type="hidden" value="'.esc_attr( $long_lat ).'" class="contact_map_marker">';
                                    }
                                    ?>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <div id="map" class="embed-responsive-item"></div>
                                    </div>                        
                                    <?php
                                }
                                ?>
                            </div>


                            <div class="row">

                                <div class="col-md-12 no-padding">
                                    <div class="post-content">                                   
                                        <h1><?php the_title(); ?></h1>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="send_result"></div>
                                                <form>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" name="name" placeholder="<?php esc_attr_e( 'NAME', 'boston' ) ?>">
                                                    </div>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" name="email" placeholder="<?php esc_attr_e( 'EMAIL', 'boston' ) ?>">
                                                    </div>
                                                    <div class="input-group">
                                                      <textarea class="form-control" name="message" placeholder="<?php esc_attr_e( 'MESSAGE', 'boston' ) ?>"></textarea>
                                                    </div>
                                                    <input type="checkbox" name="captcha" id="captcha">
                                                    <input type="hidden" name="action" value="contact">
                                                    <a class="btn submit-form-contact" href="javascript:;"><?php _e( 'SUBMIT MESSAGE', 'boston' ); ?></a>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="page-content clearfix">
                                                    <?php the_content(); ?>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                            </div>

                        </article>
                        <!-- #post -->

                    </section>
                    <!-- #post single  -->

            </div>
            <!-- #single -->

        </div>
    </div>

</main>

<?php get_footer(); ?>