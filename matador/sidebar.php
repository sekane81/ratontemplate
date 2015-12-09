<?php
/*
 * The Sidebar containing the primary and secondary widget areas.
 */
global $smof_data, $ts_page_id, $post, $ts_grab_home_sidebar, $ts_show_sidebar, $ts_sidebar_position, $ts_sidebar_instance;

if(!isset($ts_show_sidebar) || ts_is_woo_shop()) :
    if(is_single()) :
        $ts_show_sidebar = ts_postmeta_vs_default($ts_page_id, '_p_sidebar', 'yes');
    else :
        $ts_show_sidebar = ts_postmeta_vs_default($ts_page_id, '_page_sidebar', 'yes');
    endif;
endif;
if($ts_show_sidebar == 'yes') :
    $ts_sbs = $ts_sidebar_selection_id = '';
    $ts_sidebar_selection = get_post_meta($ts_page_id, '_sbg_selected_sidebar_replacement', true);
    $ts_sidebar_selection = (is_array($ts_sidebar_selection)) ? $ts_sidebar_selection[0] : $ts_sidebar_selection;
    
    if($ts_sidebar_selection && class_exists('sidebar_generator')) :
        $ts_sidebar_selection_options = sidebar_generator::get_sidebars();
        $ts_sidebar_selection_name = $ts_sbs = str_replace(array("\n","\r","\t", ' '),'',$ts_sidebar_selection);
        $ts_sidebar_selection_id = sidebar_generator::name_to_class($ts_sidebar_selection_name);
        if(!isset($ts_sidebar_selection_options[$ts_sidebar_selection_id])) :
            $ts_sidebar_selection = 0;
        endif;    
    endif;
?>

		<div id="sidebar" class="<?php echo esc_attr($ts_sbs);?> sidebar <?php echo esc_attr('sidebar-'.$ts_sidebar_position);?>">
            <?php
                if($ts_sidebar_selection && class_exists('sidebar_generator') 
                    && (is_active_sidebar('ts-custom-sidebar-'.strtolower($ts_sidebar_selection_id)))) :
                    generated_dynamic_sidebar($ts_sidebar_selection);
                elseif(is_active_sidebar('ts-primary-sidebar')) :
                    dynamic_sidebar('ts-primary-sidebar');
                endif;
            ?>
        </div>
<?php
endif;
?>