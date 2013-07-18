 <?php include('mainHeader.php'); ?>  
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
        <script> var customStyleImgUrl = "images/custom-slider-img";</script>
          <?php //include('leftPanel.php'); ?>
<!--        
-->		
        <div id="body-wrapper" >		
            <div id="body-wrapper-padding">			
                <!--[if lt IE 7]>
                <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
                browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
                experience this site.
                </div><![endif]-->
                 <?php include('header.php'); ?> 
                <?php include_once('content.php'); ?> 
            </div>
        </div>
        
<div class="topfooter">
  <div class="t_footer_contect"> <br/>
    <div class="t_footer_title"> why choose us </div>
    <div class="t_footer_img">
      img
    </div>
    <div class="block_inside">
	<? //echo '<pre>';print_r($pages); exit; 
		$counter = 0;
	?>
	<?php foreach($pages as $menu_page):?>
	<? $counter = $counter + 1; ?>
    <a href="<?php echo $menu_page->slug;?>" <?php if($menu_page->new_window ==1){echo 'target="_blank"';} ?>>
      
	  <? if($counter%4==0){ ?>
	  <div class="block_content lastone">
	  <? }else{ ?>
	  <div class="block_content">
	  <? } 
	 // echo $menu_page->image.'<br>';
	  ?>
	  	<span>
			<img class="icon" src="<?php echo theme_img('t_icons/'.$menu_page->image);?>"\> <b><?php echo $menu_page->menu_title;?></b>
		</span>
        <p><?php //echo word_limiter(strip_tags($menu_page->content),4);?></p>
      </div>
      </a>
      <?  endforeach;?>    
      
    </div>
  </div>
</div>
        <?php include_once('footer.php'); ?> 
        
       
    </body>
</html>

