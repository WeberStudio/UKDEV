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
                    <div class="onerow">
                 
                 <div class="seperator">
                     <div class="col6">
                        <h1 class="sep">Open the Door of Oppurtunity</h1>
                        <p class="sep"><a href="<?php echo base_url().'cart/allcourses/';?>">view all of our courses</a></p>
                    </div>
                    
                    
                     <div class="col6 social-icons">
                        <a href="https://twitter.com/UKOpen" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/twiter-logo.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.linkedin.com/company/uk-open-college/products?trk=tabs_biz_product" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/link-in.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.youtube.com/watch?v=4dabsHc8yNE&feature=youtube" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/youtube.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="https://www.facebook.com/pages/UK-Open-College/411574175557181" target="_blank"><img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/face-book.png" style="margin-left: 10px; margin-top: 5px"></img></a>
                     </div>
                     
                   </div>
                 </div>
                    <div class="onerow" id="all-c">
                      <h1><a class="all_courses" href="javascript:void(0)"><?php echo $page_title; ?></a></h1>  
                      <?php 
                        //category description
                      if(!empty($category->description)): ?>
                      <div class="row">
                        <div class="span12"><?php echo $category->description; ?></div>
                      </div>
                      <?php endif; ?>
                      
                      <?php 
                      // if no sub-category
                      if((!isset($subcategories) || count($subcategories)==0) && (count($products) == 0)):?>
                          <div class="alert alert-info">
                          <a class="close" data-dismiss="alert">×</a>
                          <?php echo lang('no_products');?>
                          </div>
                      <?php endif;?>
                      
                       <?php
                       // sub categories
                       if(isset($subcategories) && count($subcategories) > 0){ ?>
                      <?php foreach($subcategories as $subcategory){?>
                       <div class="col4">
                            <a href="<?php echo base_url().$subcategory->slug;?>">
                            <img style="height: 231px;" alt="<?=$subcategory->img_alt?>" title="<?=$subcategory->img_title?>" src="<?=base_url('uploads/images/medium/'.$subcategory->image)?>"/>
                            <p class="course-name"><?=$subcategory->name?></p>
                            </a>
                        </div>
                      
                      
                      <?php 
                         //category products
                         }}elseif(isset($products) && count($products) > 0){ 
                      foreach($products as $product){?> 
                      
                        <div class="col4">
                            <a onClick="myFunction('<?=$product->id?>')"  href="<?php echo $product->slug;?>">
                              <img style="height: 231px;" alt="<?=$product->img_alt?>" title="<?=$product->img_title?>" src="<?=base_url('uploads/images/small/'.$product->images)?>" alt="" />
                              <p class="course-name"><?=$product->name?></p>
                            </a>
                        </div>
                      <?php
                      }
                       }
                      ?>
                    
                    <!--<div class="col4">
                        <a href="#">
                          <img src="img/images/image_course.png" alt="" />
                          <p class="course-name">Name of the Course</p>
                        </a>
                    </div> -->
                   
                 
                 </div>
                    
                 </div>
          </section>
            
            <div class="clear"></div>
            
<script type="text/javascript" language="javascript">
function myFunction(id)
{
 j = jQuery.noConflict();
 j.ajax({
                    type: "POST",         //GET or POST or PUT or DELETE verb
                    url: '<?=base_url()?>cart/product/'+id,         // Location of the service
                    data: 'productID='+id,         //Data sent to server
                    success: function (json) 
                    {//On Successful service call
                       var result = json.name;
                       $("#dvAjax").html(result);
                    }, 
                });
}
</script>
  <?php include('footer.php')?>
