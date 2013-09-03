<?php include('main_header.php')?>
<?php echo theme_css('stylesheet', true); ?>  
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
                 
                 <div class="seperator">
                     <div class="col6">
                        <h1 class="sep">Open the Door of oppurtunity</h1>
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
                    <div class="col12 remove-padding">
                        <div class="col6 remove-padding">
                            <div class="bread">
                                <p><a style="color:#000;" href="<?=base_url();?>">Home</a>  /  <a style="color:#000;" href="<?=base_url().'cart/allcourses/';?>">Courses</a> </p>
                            </div>
                        </div>
                        
                    </div>
                       
                    
                    <div id="courses">
                            <?php 
                            if(isset($product)){
                              
                             ?>
                                  
                                <?php
                                  if(!empty($search_results)){ 
                                 foreach($search_results as $search_result){?>
                                <div class="col4">
                                <a href="<?=base_url().$search_result->slug;?>" class="c-hover">
                                <img style="height: 231px;" alt="<?=$search_result->img_alt?>"  src="<?=base_url().'uploads/images/small/'.$search_result->images;?>" alt="" />
                                <p class="course-name"><?=$search_result->name;?></p>
                                 </a>
                                 </div>
                                 <?php }}else{?>
                                        <div align="center" class="col12"><h2>Error - No such Record Found Please Try again</h2></div>
                                 <?php }?>  
                                
                           <?php }else{
                                
                               ?>
                    
                            <?php 
                            
                             if(!empty($search_results)){ 
                            foreach($search_results as $search_result){?>
                             <div class="col4">
                            <a href="<?=base_url().$search_result->slug;?>" class="c-hover">
                              <img style="height: 231px;" alt="<?=$search_result->img_alt?>"  src="<?=base_url().'uploads/images/small/'.$search_result->image;?>" alt="" />
                              <p class="course-name"><?=$search_result->name;?></p>
                            </a>
                        </div>
                        <?php }}else{?> 
                        
                                        <div align="center" class="col12"><h2>Error - No such Record Found Please Try again</h2></div>
                                 <?php }?> 
                        <?php }?>
                        
                   
                           <div class="onerow">
                            <div class="col12 pagination-all">
                                
                                <div class="pages">
                                <a>
                                <?php //echo $this->pagination->create_links();?>
                                </a>
                                    <!--<a href="#" class="p_btn">Previous</a>
                                        
                                        <ul>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">...</a></li>
                                        </ul>
                                    
                                    
                                    <a href="#" class="n_btn">Next</a>-->
                                </div>
                                
                            </div>
                         </div>
                   
                   
                   </div>
                   
                   
                   

                   
                    
                 </div>
                    
                 
          </section>
            
            <div class="clear"></div>
  <?php include('footer.php')?>
