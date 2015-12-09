<?php if ( is_home() ) {
    get_template_part( 'library/templates/loop', 'blog' );
} elseif ( is_page() ) {
    get_template_part( 'library/templates/loop', 'page' );
} elseif ( is_single() ) {
    get_template_part( 'library/templates/loop', 'single' );
} else {
    get_template_part( 'library/templates/loop', 'blog' );
}