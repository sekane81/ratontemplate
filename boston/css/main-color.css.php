<?php 
$main_font = boston_get_option( 'main_font' );
$secondary_color = boston_get_option( 'secondary_color' );
?>

body,
h1,
h2,
h3,
h4,
h5,
h6,
p,
.header .navbar {
    font-family: <?php echo esc_html( $main_font ) ?>, 'sans-serif';
}

.widget_rss .widget-header h3 a:hover,
.logged-in-as a:hover,
.logged-in-as a,
.slider .item .item-content h4 a:hover,
.copyrights .copyrights-inner p a:hover,
.copyrights .copyrights-inner p a,
.widget_handpicked_posts .media .media-body .media-heading a:hover,
footer .footer-widget ul li a:hover,
.leave-comment #reply-title a,
.post-comments .comments .comment .media .media-body .comment-meta .comment-reply:hover,
.post-comments .comments .comment .media .media-body .comment-meta .comment-reply ,
.post-single .post .post-content .iw-share-post ul li a:hover,
.inner-widget .iw-share-post ul li a:hover,
.post-single .single-tags a:hover,
.post-single .post .post-content .post-meta li a:hover,
.widget_boston_tweets .twitter p a:hover,
.widget_calendar tbody a,
.widget_popular_posts .popular-post .pp-header .comments a:hover,
.widget_popular_posts .popular-post .pp-header .favourites a:hover,
.similar_posts .popular-post .pp-header .comments a:hover,
.similar_posts .popular-post .pp-header .favourites a:hover,
.widget_popular_posts .popular-post .pp-header h4 a:hover,
.similar_posts .popular-post .pp-header h4 a:hover,
.sidebar .meta .author a:hover,
.sidebar .meta .categories a:hover,
.sidebar .meta .comments a:hover,
.sidebar .widget_handpicked_posts .media-heading a:hover,
.sidebar ul li a:hover,
.post.has-media .meta a:hover,
li.search i:hover,
.total-overlay-trigger:hover a,
.total-overlay-trigger:hover,
.header .navbar .dropdown-menu li a:hover,
.header .navbar .dropdown-menu li:first-child a:hover,
.header .navbar ul .dropdown.open a:hover,
.header .navbar ul li a:hover,
.header .navbar ul li a i,
.post.has-media .post-content h2 a:hover {
color: <?php echo esc_html( $secondary_color ) ?>;
}

.submit-form-contact,
.error404 .white-block.top-border .form-submit,
.pagination > .active > a,
.pagination > .active > a:focus,
.pagination > .active > a:hover,
.pagination > .active > span,
.pagination > .active > span:focus,
.pagination > .active > span:hover,
.theme-pagination nav .pagination li a:hover,
.footer-widget.widget_tag_cloud .tagcloud a:hover,
.leave-comment .comment-respond .form-submit input,
.post-comments .comments .comment .media .media-body .media-heading .author,
.sidebar .tagcloud a:hover,
.theme-pagination nav .pagination li.active a{
    background-color: <?php echo esc_html( $secondary_color ); ?>;
}

.submit-form-contact,
.error404 .white-block.top-border .form-submit,
.leave-comment .comment-respond .form-submit input {
    border-color: <?php echo esc_html( $secondary_color ) ?>;
}

.logged-in-as a:hover,
.post-single .single-tags a:hover,
.post-single .post .post-content .post-meta li a:hover,
.sidebar ul li a:hover {
    border-color: <?php echo esc_html( $secondary_color ) ?>;
}