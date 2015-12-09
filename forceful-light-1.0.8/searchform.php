<div class="search-box clearfix">
    <form action="<?php echo esc_url(home_url('/')); ?>" class="search-form clearfix" method="get">
        <input type="text" onBlur="if (this.value == '')
            this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
            this.value = '';" value="<?php echo get_query_var('s') ? get_query_var('s') : __( 'Type your search here', kopa_get_domain() ); ?>" name="s" class="search-text">
        <input type="submit" value="Search" class="search-submit">
    </form>
    <!-- search-form -->
</div>
<!--search-box-->