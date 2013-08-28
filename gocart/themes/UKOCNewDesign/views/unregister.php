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
                        <h1 class="sep">Open the Door of Opportunity</h1>
                        <p class="sep"><a href="#">view all of our courses</a></p>
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
                        <h2>Thank You for choosing UK Open College!</h2>
                        <p>Please choose one of the following checkout methods</p>
                        <div class="col6" style="padding:10px; margin-left: 1px; height: 360px;" id="customer_login">
                        
                          <div class="col12" >
                            <h2 id="heading">Customer Login</h2>
                                <form class="bs-docs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url()?>secure/login">   
                                  <p class="username">
                                  User Email Address
                                  </p>
                                    <input type="text" name="email" id="name" placeholder="" required /> 
                                    <!--<label for="name">Name</label>-->
                                  
                                  <p class="password">
                                  Password</p>
                                    <input type="password" name="password" id="password"  placeholder="" autocomplete="off" required /> 
                                    <!--<label for="email">Email</label>-->
                                  <p class="submit" style="margin-right:25px;">
                                    <input type="submit" name="submitted" value="Submit" class="button" />  
                                  </p>
                                  
                                  <a class="align-left" href="#">Forget password?</a>
                                </form>
                           </div><!-- end col12 -->
                              
                        </div> <!-- end col6 -->
                        
                        
                        <div class="col6" style="padding:10px; width: 500px; height:160px;" id="checkout_account">
                            <h2 class="without">Checkout without Account</h2>
                            
                            <p class="button center-btn" style="margin-left:208px;"><a href="<?=base_url().'checkout';?>">Checkout</a></p>
                        </div>
                        <div class="col6" style="padding:10px; width: 500px; margin-top:15px; height:160px;" id="customer_signup">
                            <h2 class="without">Customer Signup</h2>
                            <p class="button center-btn" style="margin-left:208px;"><a href="<?=base_url().'secure/register';?>"> Sign Up here!</a></p>
                        </div>
                    </div><!-- end col12 -->
                 </div><!-- end one row -->
          </section>         
            <div class="clear"></div>
            

  <?php include('footer.php')?>
