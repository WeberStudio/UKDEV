<?php include('main_header.php')?>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        
        <!-- mail grid -->
        <div class="onepcssgrid-1200">
        
            <!-- header -->
            <?php include('header.php')?>  
             <!-- /header -->
            
            <section>
                <div class="onerow">
 <div class="row"><h1><?php echo $page_title; ?></h1> 
<?php echo html_entity_decode($page->content); ?></div>
                 </div>
          </section>
            
            <div class="clear"></div>
  <?php include('footer.php')?>
