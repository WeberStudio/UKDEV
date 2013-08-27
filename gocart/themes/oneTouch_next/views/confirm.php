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
                 
                 <div class="seperator">
                     <div class="col6">
                        <h1 class="sep">Open the doors of Opportunity</h1>
                        <p class="sep"><a href="<?=base_url().'cart/allcourses/'?>">view all of our courses</a></p>
                    </div>
                    
                    
                     <div class="col6 social-icons">
                        <a href="https://twitter.com/UKOpen" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/twiter-logo.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.linkedin.com/company/uk-open-college/products?trk=tabs_biz_product" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/link-in.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.youtube.com/watch?v=4dabsHc8yNE&feature=youtube" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/youtube.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="https://www.facebook.com/pages/UK-Open-College/411574175557181" target="_blank"><img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/face-book.png" style="margin-left: 10px; margin-top: 5px"></img></a>
                     </div>
                     
                   </div>
                 </div><!-- end seperator row -->
                 
                 
                 
                 <div class="onerow">
                     <div class="col12">
                        
                        
                        <div class="col3">
                        <h2 class="dull">1. Personal Details</h2>
                        </div>
                        
                        <div class="col3">
                        <h2 align="right" class="dull">2. Address Details</h2>
                        </div>
                        
                        <div class="col3">
                        <h2 align="right">3. Confirm</h2>
                        </div>
                        
                        <div class="col3">
                        <h2 align="right" class="dull">4. Payment</h2>
                        </div>
                        
                        <div class="col6">
                        
                          <div class="col12">
                         <div class="col12">
                            <div class="col5">
                              <h3>Personal Address</h3>
                            
                            <p><?=$firstname;?></p>
                            <p><?=$lastname;?></p> 
                            <p><?=$company;?></p> 
                            <p><?=$address1;?></p> 
                            <p><?=$address2;?></p> 
                             <p><?=$city;?></p>
                            </div>
                             <div class="col5" style="padding-top: 50px;">
                             
                            <p><?=$zip;?></p> 
                            <p><?=$country_id;?></p> 
                            <p><?=$zone_id;?></p> 
                            <p><?=$phone;?></p>
                            <p><?=$email;?></p>
                            <p style="float: right;" class=""><a href="<?=base_url().'checkout/step2'?>">Edit</a></p>  
                            </div>
                             </div>
                             
                            <div class="col12">
                            <div class="col5"> 
                            <h3>Card Billing Address</h3>
                            
                            <p><?=$b_firstname;?></p>
                            <p><?=$b_lastname;?></p> 
                            <p><?=$b_company;?></p> 
                            <p><?=$b_address1;?></p> 
                            <p><?=$b_address2;?></p> 
                            <p><?=$b_city;?></p>
                            </div>
                             <div class="col5" style="padding-top: 50px;"> 
                            <p><?=$b_zip;?></p> 
                            <p><?=$b_country_id;?></p> 
                            <p><?=$b_zone_id;?></p> 
                            <p><?=$b_phone;?></p>
                            <p><?=$b_email;?></p>
                             <p style="float: right;" class=""><a href="<?=base_url().'checkout/step2'?>">Edit</a></p>
                             </div>
                             </div>

                            <div class="col12">
                            <div class="col5">
                            
                            <h3>Delivery Address</h3>
                            
                            <p><?=$d_first;?></p>
                            <p><?=$d_last;?></p> 
                            <p><?=$d_company;?></p> 
                            <p><?=$d_address;?></p> 
                            <p><?=$d_address_op;?></p> 
                            <p><?=$d_city;?></p>
                             </div>
                             <div class="col5" style="padding-top: 50px;">
                            <p><?=$d_post_code;?></p> 
                            <p><?=$d_country_id;?></p> 
                            <p><?=$d_zone_id;?></p> 
                            <p><?=$d_phone;?></p>
                            <p><?=$d_email;?></p>
                            <p style="float: right;" class=""><a href="<?=base_url().'checkout/step2'?>">Edit</a></p> 
                            </div>
                            </div>
                               
                            
                            <p class="button"><a href="<?=base_url().'checkout/step2'?>">Go Back</a></p>
                            
                            <p class="button" style="float:right"><a href="<?=base_url().'checkout/step4';?>">Next Step</a></p>
                            
                                                   
                          </div>
                           
                        </div> <!-- end col6 -->
                        <div class="col6">
                        <div class="col12">
                                      <span style="color:#666; font-size:11px; margin-left: 245px;" > We accept the following Sage Pay, PayPal, All Debit and Credit Cards. </span>
                                    <div class = "payment_options">
                                      
                                           <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/maestro.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/mc.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/PayPal_mark.gif')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/solo.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa.png')?>" alt="">
                                         <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa_debit.png')?>" alt="">
                                          <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa_electron.png')?>" alt="">
                                    </div>
                           </div><!-- end col12 -->
                        </div>
                        
                        
                    </div><!-- end col12 -->
                   
                 </div><!-- end one row -->
                 
                 
                                   
                 
                 
                 
          </section>           
            <div class="clear"></div>
            

  <?php include('footer.php')?>
