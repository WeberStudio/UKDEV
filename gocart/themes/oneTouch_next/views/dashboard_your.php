<?php include('main_header.php')?>   
<?php echo theme_css('basee.css', true); ?>
    <body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
    <script> var customStyleImgUrl = "images/custom-slider-img";</script>
    <?php //include('leftPanel.php'); ?>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        
        <!-- mail grid -->
        <!--<div class="onepcssgrid-1200">-->
        <div id="body-wrapper" >		
            <div id="body-wrapper-padding">
            <!-- header -->
            <?php include('header.php')?> 
            <?php include_once('dashboard_content.php'); ?> 
            <!-- /header -->
            <div class="clear"></div>
        	</div>
        </div>
   <?php include('footer.php')?> 
