<div id="tab-social-links" class="kopa-content-box tab-content tab-content-1">    

    <?php 
    /**
     * Social Links Target
     */
    ?> 
    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Social Links Target', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Social Links Target', kopa_get_domain()); ?></span>            
            <?php
            $kopa_social_link_targets = array(
                '_self'  => __('Opens the linked document in the same frame as it was clicked', kopa_get_domain()),
                '_blank' => __('Opens the linked document in a new window or tab', kopa_get_domain()),
            );
            $kopa_social_link_target_name = "kopa_theme_options_social_link_target";
            foreach ($kopa_social_link_targets as $value => $label) {
                $kopa_target_id = $kopa_social_link_target_name . "_{$value}";
                ?>
                <label  for="<?php echo $kopa_target_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $kopa_target_id; ?>" name="<?php echo $kopa_social_link_target_name; ?>" <?php echo ($value == get_option($kopa_social_link_target_name, '_self')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            } // end foreach
            ?>
        </div>
    </div>

    <?php 
    /**
     * Social Links
     */
    ?> 
    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Social Links', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <!-- RSS -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('RSS URL', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Display the RSS feed button with the default RSS feed or enter a custom feed below. <br><code>Enter <b>"HIDE"</b> if you want to hide it</code>', kopa_get_domain()); ?></p>    
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_rss_url')); ?>" id="kopa_theme_options_social_links_rss_url" name="kopa_theme_options[kopa_theme_options_social_links_rss_url]">                                                     
        </div><!--kopa-element-box-->

        <!-- Dribbble -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Dribbble URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_dribbble_url')); ?>" id="kopa_theme_options_social_links_dribbble_url" name="kopa_theme_options[kopa_theme_options_social_links_dribbble_url]">
        </div>

        <!-- Google plus -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Google Plus URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_gplus_url')); ?>" id="kopa_theme_options_social_links_gplus_url" name="kopa_theme_options[kopa_theme_options_social_links_gplus_url]">
        </div>

        <!-- FACEBOOK -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Facebook_URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_facebook_url')); ?>" id="kopa_theme_options_social_links_facebook_url" name="kopa_theme_options[kopa_theme_options_social_links_facebook_url]">
        </div>

        <!-- TWITTER -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Twitter URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_twitter_url')); ?>" id="kopa_theme_options_social_links_twitter_url" name="kopa_theme_options[kopa_theme_options_social_links_twitter_url]">
        </div>

        <!-- Flickr -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Flickr URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_flickr_url')); ?>" id="kopa_theme_options_social_links_flickr_url" name="kopa_theme_options[kopa_theme_options_social_links_flickr_url]">
        </div> 

        <!-- Youtube -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Youtube URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_youtube_url')); ?>" id="kopa_theme_options_social_links_youtube_url" name="kopa_theme_options[kopa_theme_options_social_links_youtube_url]">
        </div>
    </div>
</div>
