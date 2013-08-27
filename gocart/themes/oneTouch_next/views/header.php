<header>
                
                <!-- responsive menu -->
                <nav class="onerow" id="nav-menu-res">
                
                    <div class="col12 top-res-menu">
                    MENU
                    </div>
                
                    <div class="col12 menu-responsive">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">All Courses</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Tutors</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">contact us</a></li>  
                        </ul>
                       
                    </div>
                </nav>
                
                
                <!-- main site nav -->
                <nav class="onerow" id="nav-menu">
                    <div class="col10" id="top-menu">
                        <ul>
                            <li <?php if(isset($menu_blue) && $menu_blue == 'home'){echo 'class="current-menu-item"';}?> ><a href="<?= base_url();?>cart">Home</a></li>
                            <li <?php if(isset($menu_blue) && $menu_blue == 'allcourses'){echo 'class="current-menu-item"';}?> id="all-courses" onmousemove="submenushow();" onmouseover="submenuhide();"><a href="#">All Courses</a></li>
                            <li><a href="<?=base_url()?>blog">Blog</a></li>
                            <li <?php if(isset($menu_blue) && $menu_blue == 'tutors'){ echo 'class="current-menu-item"';}?> ><a href="<?=base_url()?>tutors">Tutors</a></li>
                            <li <?php if(isset($menu_blue) && $menu_blue == 'faq'){echo 'class="current-menu-item"';}?> ><a href="<?=base_url()?>faq">FAQs</a></li>
                            <li><a class="contact-btn" href="<?=base_url()?>contact-us1">contact us</a></li> 
                        </ul>
                    </div>
                    
                    <div class="col2 font-sizing">
                    <?php 
                    if($this->Customer_model->is_logged_in(false, false)){                   
                    ?>
                       <a style="padding:5px;" class="contact-btn" href="<?php echo site_url('dashboard');?>">Dashboard</a>/
                      <a style="padding:5px;" class="contact-btn" href="<?php echo site_url('secure/logout');?>">logout</a> 
                    <?php }else{?>
                        <a style="padding:5px;" class="contact-btn" href="<?php echo site_url('secure/login');?>">login</a> 
                        / <a style="padding:5px;"  class="contact-btn" href="<?php echo site_url('secure/register'); ?>">Registration</a> 
                    <?php }?> 
                         
                    </div>
                 </nav><!-- end nav -->
                 
                 
                 <!-- sub menu all courses -->
                 <div class="onerow" id="sub-menu">
                      
                      <div class="arrow-up">
                      </div>
                      
                      
                      <div class="sub-menu-slider">
                      
                              <div id="ca-container" class="ca-container">
                                    <div class="ca-wrapper">
                                           <?php
                                           $parent                      = 0;
                                           $header_categories    = $this->Category_model->get_categories_tierd($parent); 
                                           
                                        foreach($header_categories as $menu_category)
                                        
                                        {
                                           
                                       ?>
                                        <div class="ca-item">
                                        <a href="<?php echo base_url().$menu_category['category']->slug?>">
                                        <?php
                                        $file_path =   realpath('.')."/uploads/images/small/".$menu_category['category']->image;
                                        if(file_exists($file_path))
                                        {?>
                                            <img style="height:90px" src="<?php echo catogery_img('images/small/'.$menu_category['category']->image); ?>"  alt="" />
                                            <?php  }
                                            else
                                           {?>
                                            <img src="<?php echo catogery_img('images/small/no_image.jpg'); ?>"  alt="" />
                                            <?php }?>
                                            <p class="sub-caption"><?php echo $menu_category['category']->name;?></p></a>
                                        </div>
                                         <?php
                                        }
                                        ?>
                                        <!-- course item end -->

                                       
                                        
                                     </div>
                              </div>
                                
                          </div><!-- end  subslider -->
                      
                 </div><!-- /sub menu -->
                 
                 
                 
                 
                 
                 
                 
                 <!-- section -->
                  <section class="onerow">
                      <article class="col4 logo">
                          <a href="<?= base_url();?>cart"><img src="<?php echo theme_assets('img/logo-ukoc.png');?>" width="244" alt="Uk Open College" /></a>
                      </article>
                      
                       <article class="col4 checkout-res">
                          <div class="cart">
                              <a href="<?= base_url().'cart/view_cart';?>">
                                <p class="cart_text">
                                    <span class="cart_img">
                                        <img src="<?=theme_assets('images/cart.png');?>" alt="" />
                                    </span>
                                    There are (<?=$this->go_cart->total_items();?>) item in your cart
                                </p>
                            </a>
                            
                            <p class="button checkout-btn"><a href="<?=base_url().'cart/view_cart';?>">checkout</a></p>
                          </div>
                          
                          
                              
                      </article>
<script type="">
function category_search(name)
{
    var search = name;
    var search_field = $('#search').val();
    //alert(search_field);
     if(search_field != '')
     {    
         $('#search_by').val(search); 
         $('#search-form').submit()
         //alert(search_field);
        
     }
     else
     {
       alert("search field is empty");  
     }
    return false;
}




</script>                      
                      <article class="col4 filters-res">
                          <form method="post" name="search_form" id="search-form" action="<?=base_url().'Search'?>">
                              <input name="search_field" type="text" id="search" value="" />
                              <input type="hidden" value="" name="search_by" class="" id="search_by">
                            <input type="submit"  class="button search-btn" value="filters" />
                            
                            <div class="arrow_down">
                            </div>
                          </form>
                          
                        
                           <div class="filters-menu round col4">
                          
                            <ul>
                                <li><a id="category" href="javascript:void(0);" onclick="category_search('category');" >Search by category</a></li>
                                <li><a id="sub_category" href="javascript:void(0);" onclick="category_search('sub_cat');">Search by sub-category</a></li>
                                <li><a id="keyword" href="javascript:void(0);" onclick="category_search('keyword');">Search by keyword</a></li>
                                <li><a id="price" href="javascript:void(0);" onclick="category_search('price');">Search by total price</a></li>
                                <!--<li><a href="#">Search by attributed price options</a>
                                    <ul>
                                        <li><a href="#">paper </a></li>
                                        <li><a href="#">online </a></li>
                                    </ul>
                                </li>-->
                            </ul>
                            
                          </div>
                          
                          <div class="call-us" >
                          <h3 style="color: red;" class="">Call us on <span style="color: red;" class="light-blue">0121 288 0181</span><br /> to talk to a course advisor</h3>
                          </div>
                          
                      </article>
                      
                     
                      
                  
                  </section>
                  <!-- /section -->
                   
                    
            </header>

            
