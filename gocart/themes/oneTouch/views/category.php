<?php include('mainHeader.php'); ?>

<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">


<div id="body-wrapper" >

<div id="body-wrapper-padding">

<?php include('header.php'); ?>

<? //Content Area Start ?>
<?php //echo $category->google_follow; exit;?>
<style>
ul.menu1 li{
    display:inline;
     margin-right: 5px;
}
ul.menu1 li a{
    font-size:17px;
    padding-top: 15px;
}
</style>
<div class="row">
<div class="page-header">

  <h1>
 <style>
  .bread_trems
{
	color: #565759 !important;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
}

</style>
  <img src="<?php echo theme_img("icons/slider-home-icon.png");?>" style="margin-right:15px;"/>
  <a class="all_courses" href="javascript:void(0)"><?php echo $page_title; ?></a>
  <span style="float: right;"> 
                    <div class="sort-panel">  
                   <ul class="filter clearfix">
                   <li>
                   <a class="bread_trems" href="<?=base_url()?>" rel="nofollow" data-product_id="868"> Home  </a>
                   <span  class="bread_trems"> > </span>
                   <a class="bread_trems" href="<?=base_url()?>cart/allcourses/"> All Courses</a>
                   <span  class="bread_trems"> > </span>
                   <a class="bread_trems" href="<?=base_url()?><?php echo $category->slug; ?>"><?php echo $page_title; ?></a>
                    </li>
                   </ul>
                   </div>
                   </span>
  </h1>

</div>
</div>

<?php if(!empty($category->description)): ?>
    <div class="row">
        <div class="span12"><?php echo $category->description; ?></div>
    </div>
    <?php endif; ?>
    
    
    <?php if((!isset($subcategories) || count($subcategories)==0) && (count($products) == 0)):?>
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo lang('no_products');?>
        </div>
    <?php endif;?>

<div class="row">

  <div class="fifteen columns">

    <div id="main">

      <? $photo    = theme_img('no_picture.png', lang('no_image_available')); ?> 
            
     <div class="row"> 
         <div class="works-list boxstyle1">
            <ul class="filterable-grid">
            
            <!--Category Listing Start -->
            
            <?php if(isset($subcategories) && count($subcategories) > 0){ ?>
             <?php foreach($subcategories as $subcategory):?>

                
                <a class="all" href="<?php echo base_url().$subcategory->slug; //echo site_url(implode('/', $base_url).'/'.$subcategory->slug); ?>">
                            <li data-type="1" data-id="id-1" class="item">
                             
                                <div class="half even">
                                    <div class="pic"><img alt="<?=$subcategory->img_alt?>" title="<?=$subcategory->img_title?>" src="<?=base_url('uploads/images/medium/'.$subcategory->image)?>"></div>
                                    <div class="description">
                                           <div class="title">
                                                    
                                                    <h4><?=$subcategory->name?></h4>
                                                    <p><?php  echo word_limiter($subcategory->excerpt,15);?></p> 
                                                    <p><span class="button" style="margin:0px auto 0px 90px;">Read More</span></p>
                                                    <div class="row">
                                                    <div class="line"> </div>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                             
                            </li>                                      
                </a>     
               <?php endforeach?>
               
               
               
              <!--Product Listing Start-->
             <?php } else if(isset($products) && count($products) > 0){ ?>
             <?php foreach($products as $product):?>

                <a class="all" href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>">
                            <li data-type="1" data-id="id-1" class="item">
                             
                                <div class="half even">
                                    <div class="pic"><img alt="<?=$product->img_alt?>" title="<?=$product->img_title?>" src="<?=base_url('uploads/images/medium/'.$product->images)?>"></div>
                                    <div class="description">
                                           <div class="title">
                                                    
                                                    <h4><?=$product->name?></h4>
                                                    <p><?php echo word_limiter($product->excerpt,15);?></p> 
                                                    <p><span class="button" style="margin:0px auto 0px 90px;">Read More</span></p>
                                                    <div class="row">
                                                    <div class="line"> </div>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                             
                            </li>
                            
                </a> 
               <?php endforeach?>
               <?php }?>                
            </ul>
            <div class="category-bottom-gap" ></div>
         </div>  
     </div> 
     <?php $page_links    = $this->pagination->create_links(); ?> 
    <div align="center" style="margin-top: 17px; margin-bottom: 24px;">
    
     <?php if($page_links != ''):?>
     <?php echo $page_links;?>
     <?php endif;?>
    </div>
    </div>

    <? //Content Area End ?>
    
    
  </div>

</div>



</div>

</div>

<?php include_once('footer.php'); ?>

</body>

</html>