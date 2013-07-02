<?php include('mainHeader.php'); ?>

<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">


<div id="body-wrapper" >

<div id="body-wrapper-padding">

<?php include('header.php'); ?>

<? //Content Area Start ?>

<div class="row">
<div class="page-header">

  <h1><?php echo $page_title; ?></h1>

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
                                    <div class="pic"><img title="Watchers" alt="Watchers" src="<?=base_url('uploads/images/medium/'.$subcategory->image)?>"></div>
                                    <div class="description">
                                           <div class="title">
                                                    
                                                    <h4><?=$subcategory->name?></h4>
                                                    <p><?php echo substr($subcategory->excerpt,0,100)?></p> 
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
                                    <div class="pic"><img title="Watchers" alt="Watchers" src="<?=base_url('uploads/images/medium/'.$product->images)?>"></div>
                                    <div class="description">
                                           <div class="title">
                                                    
                                                    <h4><?=$product->name?></h4>
                                                    <p><?php echo substr($product->excerpt,0,100)?></p> 
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
    
    </div>

    <? //Content Area End ?>

  </div>

</div>



</div>

</div>

<?php include_once('footer.php'); ?>

</body>

</html>