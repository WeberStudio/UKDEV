<?php include('main_header.php')?>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        
        <!-- mail grid -->
		<?php 
		if($this->session->flashdata('message'))
		{
			$message    = $this->session->flashdata('message');
		}
		
		if($this->session->flashdata('error'))
		{
			$error    = $this->session->flashdata('error');
		}
		if(validation_errors() != '')
		{
			$error    = validation_errors();
		}
		?>
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
							<?php if (!empty($error)): ?>
							<div class="alert-box error alert" onClick="hide_alert(); return false;"><span>error: </span><?php echo $error; ?> </div>
							<?php endif; ?>
							
							<?php if (!empty($message)): ?>
							<div class="alert-box success alert" onClick="hide_alert(); return false;"><span>success: </span><?php echo $message; ?> </div>
							<?php endif; ?>
                            <h2 id="heading" style="color:#FFFFFF !important">Customer Login</h2>
                                <form class="bs-docs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url()?>secure/login">   
                                  <p class="username">
                                  User Email Address
                                  </p>
                                    <input type="text" name="email" id="email" placeholder="" required /> 
                                    <!--<label for="name">Name</label>-->
                                  
                                  <p class="password">
                                  Password</p>
                                    <input type="password" name="password" id="password"  placeholder="" autocomplete="off" required /> 
                                    <!--<label for="email">Email</label>-->
                                  <p class="submit" style="margin-right:25px;">
                                    <input type="hidden" name="redirect" value="<?php echo end($this->uri->segment_array());?>" class="button" />
                                    <input type="submit" name="submitted" value="Submit" class="button" />  
                                  </p>
                                  
                                  <a class="align-left" href="#">Forget password?</a>
                                </form>
                           </div><!-- end col12 -->
                              
                        </div> <!-- end col6 -->
                        
                        
                        <div class="col6" style="padding:10px; width: 500px; height:160px;" id="checkout_account">
                            <h2 class="without" style="color:#FFFFFF !important">Checkout without Account</h2>
                            
                            <p class="button center-btn" style="margin-left:208px;"><a href="<?=base_url().'checkout';?>">Checkout</a></p>
                        </div>
                        <div class="col6" style="padding:10px; width: 500px; margin-top:15px; height:160px;" id="customer_signup">
                            <h2 class="without" style="color:#FFFFFF !important">Customer Signup</h2>
                            <p class="button center-btn" style="margin-left:208px;"><a href="<?=base_url().'secure/register';?>"> Sign Up here!</a></p>
                        </div>
                        
                        
                        
                        
                    </div><!-- end col12 -->
                   
                 </div><!-- end one row -->
                 
                 
                                   
                 
                 
                 
          </section>         
            <div class="clear"></div>
            

  <?php include('footer.php')?>
