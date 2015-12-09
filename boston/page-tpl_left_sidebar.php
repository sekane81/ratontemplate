<?php
/*
    Template Name: Page Left Sidebar
*/
get_header();
the_post();
?>
<main>

    <div class="container">
        <div class="row">

            <!-- sidebar -->
            <div class="col-md-3 no-padding">
                <aside class="sidebar">

                   <?php get_sidebar( 'left' ); ?>

                </aside>
            </div>
            <!-- #sidebar -->                    

           <!-- single -->
            <div class="col-md-9 no-padding">

                <!-- post single -->
                    <section class="post-single clearfix">

                        <!-- post -->
                        <article class="post clearfix no-margin">

                            <?php 
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( 'post-thumbnail' );
                            }
                            ?>


                            <div class="row">

                                <div class="col-md-12 no-padding">
                                    <div class="post-content">                                   
                                        <h1><?php the_title(); ?></h1>
                                        <?php the_content() ?>
                                </div>

                            </div>

                        </article>
                        <!-- #post -->

                    </section>
                    <!-- #post single  -->

                <?php comments_template( '', true ) ?>

            </div>
            <!-- #single -->

        </div>
    </div>

</main>
<?php get_footer(); ?>