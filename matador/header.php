<?php
global $page, $paged, $smof_data, $ts_custom_css;

if((ts_option_vs_default('catalog_mode', 0) == 1) && (ts_is_woo_cart() || ts_is_woo_checkout())) :
    $shop_page = get_post(woocommerce_get_page_id('shop'));
    $shop_page = get_permalink($shop_page->ID);
    wp_redirect($shop_page);
    exit;
endif;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo esc_attr(ts_html_class());?>">
<head>
<title><?php wp_title(' &#8212; ');?></title>
<?php
if(ts_option_vs_default('responsive', 1) == 1) :
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
endif;
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="all, index, follow" /> 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if(trim(ts_option_vs_default('custom_favicon', ''))) : ?>
<link rel="shortcut icon" href="<?php echo esc_url($smof_data['custom_favicon']);?>" />
<?php endif; ?>
<?php if(trim(ts_option_vs_default('iphone_icon', ''))) : ?>
<!-- For iPhone -->
<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($smof_data['iphone_icon']); ?>">
<?php endif; ?>
<?php if(trim(ts_option_vs_default('iphone_icon_retina', ''))) :?>
<!-- For iPhone 4 Retina display -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url($smof_data['iphone_icon_retina']); ?>">
<?php endif; ?>
<?php if(trim(ts_option_vs_default('ipad_icon', ''))) : ?>
<!-- For iPad -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($smof_data['ipad_icon']); ?>">
<?php endif; ?>
<?php
ts_grab_google_fonts(true);
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript">
theme_directory_uri = '<?php echo esc_js(get_template_directory_uri());?>';
</script>
<?php
wp_head();
?>
</head>        
<body <?php ts_body_class(); ?>>
    <div id="wrap">        
        <div class="wrap-inner">
