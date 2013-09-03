<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">
        <title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('company_name'); ?></title>
        <meta name="keywords" content="<?php echo (!empty($meta_key)) ? $meta_key .'' : ''; echo ""; ?>">
        <meta name="description" content="<?php echo (!empty($meta)) ? $meta .'' : ''; echo ""; ?>">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--<link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/font/stylesheet.css">
        
        <link rel="stylesheet" href="css/fractionslider.css">-->
        
        <?php echo theme_css('normalize.css', true); ?>
        <?php echo theme_css('main.css', true); ?>
        <?php echo theme_css('font/stylesheet.css', true); ?>
 <?php echo theme_css('stylesheet.css', true); ?>
        <?php echo theme_css('style.css', true); ?>
        <?php //echo theme_css('fractionslider.css', true); ?>
        <?php echo theme_css('jquery.jscrollpane.css', true); ?>
        <?php echo theme_css('fancy_dropdown.css', true); ?> 
        <?php echo theme_css('onepcssgrid.css', true); ?>
        <?php echo theme_css('global.css', true); ?>
        
      
        <!--<script src="js/vendor/modernizr-2.6.2.min.js"></script> -->
        <?php echo theme_js('js/vendor/modernizr-2.6.2.min.js' , true)?>
        
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        
        <!--<link rel="stylesheet" href="css/onepcssgrid.css" />
        <link rel="stylesheet" href="css/global.css" />-->
           <script type="text/javascript">
            function change_text_color()
            {
                $("h2.dull").hover(function() {
            
                    $(this).removeClass('dull');    
            }, function() {
            
                $(this).addClass('dull');    
            });
            return false;
            }                
        </script>
        
		<script type="text/javascript">
        
        function popup() {
        	window.open('http://www.ukopencollege.co.uk/popup_cvv_help.html?zenid=s5747igmgae6s7o546qsb5jgk5','1377677282521','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=0,left=0,top=0');	
			return false;
        }
        </script>
    </head>