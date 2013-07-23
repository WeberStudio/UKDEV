<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php
    if(isset($category)) {
    if($category->google_follow==1)
    {
    echo '<meta name="robots" content="noindex,nofollow">';   
    }
    } if(isset($product)){
    if($product->google_follow==1)
    {
    echo '<meta name="robots" content="noindex,nofollow">';   
    } }
    ?>
    <meta charset="utf-8">
    <title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('company_name'); ?></title>
    <meta name="keywords" content="<?php echo (!empty($meta_key)) ? $meta_key .'' : ''; echo ""; ?>">
    <meta name="description" content="<?php echo (!empty($meta)) ? $meta .'' : ''; echo ""; ?>">
    <link rel="icon" type="image/png" href="">
    <link rel="alternate" type="application/rss+xml" title="UK Open College" href="">
	<?php echo theme_css('google-font.css', true); ?>	
	<?php echo theme_css('aqpb-view.css', true); ?>
	<?php echo theme_css('bootstrap.css', true); ?>
	<?php echo theme_css('js_composer_front.css', true); ?>
	<?php echo theme_css('revslider-settings.css', true); ?>
	<?php echo theme_css('revslider-captions.css', true); ?>
	<?php echo theme_css('frontend.css', true); ?>
	<?php echo theme_css('foundation.min.css', true); ?>
	<?php echo theme_css('app.css', true); ?>
	<?php echo theme_css('shortcodes.css', true); ?>
	<?php echo theme_css('responsive.css', true); ?>	
	<?php echo theme_css('options.css', true); ?>
    <?php echo theme_css('menu.css', true); ?>
	<?php echo theme_css('woocommerce.css', true); ?>
    <?php echo theme_css('chosen.css', true); ?>    
	<?php echo theme_css('fancy_dropdown.css', true); ?>
     
    <!--add the serach classess-->
    <?php echo theme_css('jquery.fancybox-1.3.1.css?c-v=24739', true); ?>
   
    
    <script type="text/javascript">
        // needed to check if the LoginConflictModal popup is displayed.
        var isLoginConflited = 'False'
    </script>
     
    <!--   End search     -->
    <?php echo theme_js('js/jquery-1-8-3.js?c-v=24739', true);?>
    <?php //echo theme_js('js/ready2.js?c-v=24739', true);?>
    <?php echo theme_js('js/jquery.plugins.min.js', true);?>
    <?php echo theme_js('js/jquery.themepunch.plugins.min.js', true);?>
    <?php echo theme_js('js/jquery.themepunch.revolution.min.js', true);?>
    <?php echo theme_js('js/modernizr.foundation.js', true);?>
    <?php echo theme_js('js/app.js', true);?>
    <?php echo theme_js('js/modernizr.foundation.js', true);?> 
	<?php echo theme_js('js/simpletabs_1.3.js', true);?>
    <?php echo theme_js('js/chosen.js', true);?>  
    

    <style>
        #body-wrapper {
            background-attachment:fixed!important;
            background-repeat:repeat;
        }
    </style>

    <style type="text/css">
        .facebookOuter {
            background-color: transparent;
            padding-bottom: 1px;
            border: 1px solid #687f8e;
        }
        .facebookInner {
            height:275px;
            border:none;
            background: transparent;
        }
    </style>
</head>