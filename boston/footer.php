<?php get_sidebar('footer'); ?>


<?php
$footer_text = boston_get_option( 'footer_text' );
if( !empty( $footer_text ) ):
?>
<footer class="copyrights">
    <div class="copyrights-inner text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                	<p>
                    <?php 
                        $allowed_html = wp_kses_allowed_html( 'post' );
                        echo wp_kses( $footer_text, $allowed_html );
                    ?>
                    </p>   
                </div>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>

<?php
wp_footer();
?>
</div>
</body>
</html>