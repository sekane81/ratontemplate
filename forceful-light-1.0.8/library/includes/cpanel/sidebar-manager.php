<div id="kopa-admin-wrapper" class=" kopa-sidebar-manager clearfix">    
    <div id="kopa-loading-gif"></div>
    <div class="kopa-content ">
        <div class="kopa-page-header clearfix">
            <div class="pull-left">
                <h4><?php echo KopaIcon::getIcon('cog'); ?><?php _e('Sidebar Manager',  kopa_get_domain()); ?></h4>
            </div>
            <div class="pull-right">
                <div class="kopa-copyrights">
                    <span><?php _e('Visit author URL: ',  kopa_get_domain()); ?> </span><a href="http://kopatheme.com" target="_blank">http://kopatheme.com</a>
                </div><!--="kopa-copyrights-->
            </div>
        </div><!--kopa-page-header-->
        <div class="kopa-content-box" id="template-home">
            <div class="kopa-box-head">
                <?php echo KopaIcon::getIcon('hand-right'); ?>
                <span class="kopa-section-title"><?php _e('Sidebar Manager',  kopa_get_domain()); ?></span>
            </div><!--kopa-box-head-->
            <div class="kopa-box-body clearfix"> 
                <div class="kopa-add-sidebar-box">
                    <div class="kopa-sidebar-box kopa-element-box">
                        <span class="kopa-component-title"><?php _e('Add Sidebar',  kopa_get_domain()); ?></span>
                        <label class="kopa-label"><?php  _e('Add your sidebars below and then you can assign one of these sidebars from the individual posts/pages.',  kopa_get_domain()); ?> </label>                        
                        <div class="clearfix mt5">
                            <input type="text" class="kopa-sidebar-input left" id="kopa-sidebar-new" >
                            <span title="Add" rel="tooltip" class="btn btn-primary left" data-original-title="Add" onclick="kopa_add_sidebar_clicked(jQuery(this))"><?php echo KopaIcon::getIcon('plus-square'); ?><?php _e('Add sidebar',  kopa_get_domain()); ?></span>
                        </div>
                    </div><!--kopa-sidebar-box-->
                </div><!--kopa-add-sidebar-box-->
                <div class="kopa-edit-sidebar-box">
                    <div class="kopa-sidebar-box kopa-element-box">
                        <span class="kopa-component-title"><?php  _e('Existing Sidebars',  kopa_get_domain());?> </span>
                        <?php
                        $kopa_sidebar = get_option("kopa_sidebar", unserialize(KOPA_DEFAULT_SIDEBAR));
                        $is_empty_array = true;
                        if ($kopa_sidebar) {
                            foreach ($kopa_sidebar as $elm) {
                                if (count($elm) > 0)
                                    $is_empty_array = false;
                                else
                                    $is_empty_array = true;
                            }
                        }
                        if (!$is_empty_array) {
                            ?>
                            <table class="table table-nomargin">
                                <thead>
                                    <tr>
                                        <th><?php _e('Sidebar Name',  kopa_get_domain()); ?> </th>
                                        <th><?php _e('Remove',  kopa_get_domain()); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="kopa-sidebar-list">
                                    <?php
                                    foreach ($kopa_sidebar as $kopa_sidebar_element_key => $kopa_sidebar_element_value) {
                                        if (!empty($kopa_sidebar_element_value)) {
                                            ?>
                                            <tr <?php if ($kopa_sidebar_element_key === "sidebar_hide") echo 'style ="display:none;"'; ?>>
                                                <td><?php echo $kopa_sidebar_element_value; ?></td>
                                                <td><a onclick="kopa_remove_sidebar_clicked(jQuery(this), '<?php echo $kopa_sidebar_element_key; ?>')" title="" lang="" rel="tooltip" class="button button-basic button-icon" data-original-title="Remove"><?php echo KopaIcon::getIcon('trash'); ?></a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } else {
                            ?>
                            <label id="kopa-nosidebar-label" class="kopa-label">No sidebar defined</label>
                            <table class="table table-nomargin hidden">
                                <thead>
                                    <tr>
                                        <th><?php _e('Sidebar Name',  kopa_get_domain()); ?> </th>
                                        <th><?php _e('Remove',  kopa_get_domain()); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="kopa-sidebar-list">

                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </div><!--kopa-sidebar-box-->
                </div><!--kopa-edit-sidebar-box-->
            </div><!--kopa-box-body-->           
        </div><!--kopa-content-box-->       
    </div><!--kopa-content-->
</div><!--kopa-admin-wrapper-->
<?php wp_nonce_field("save_sidebar_setting", "nonce_id_save_sidebar"); ?>

