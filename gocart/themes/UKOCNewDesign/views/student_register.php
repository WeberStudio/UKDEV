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
                        
                        
                        
                        
                       <!-- <div class="col6">
                        
                          <div class="col12">
                            <h2>Customer Login</h2>
                                <form action="" method="POST" autocomplete="on" class="padding-left-right">
                                  <p class="username">
                                  User Email Address
                                  </p>
                                    <input type="text" name="name" id="name" placeholder="" required />
                                    
                                  
                                  <p class="password">
                                  Password</p>
                                    <input type="password" name="password" id="password"  placeholder="" autocomplete="off" required />
                                    
                                  <p class="submit" style="margin-right:25px;">
                                    <input type="submit" value="Login" class="button" />
                                  </p>
                                  
                                  <a class="align-left" href="#">forget password?</a>
                                </form>
                              </div>
                              
                              <div class="col12">
                                  
                                <h2>Checkout with PayPal</h2>
                                
                                <p class="paypal-img">
                                <a href="#"><img src="img/paypal.png" alt="Paypal" /></a>
                                </p>
                                
                              </div> 
                            
                          
                        </div>-->
                        
                        
                        <div class="col6">
                        <h2>Create an Account</h2>
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
<?php if (!empty($error)): ?>
<div class="alert alert-error" id="closee"> <a href="javascript:void(0)"  class="close" data-dismiss="alert" onClick="hide_error(); return false;">x</a> <?php echo"<div style='margin-left: 70px;'>". $error. "</div>"; ?> </div>
<?php endif; ?>
<?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo $message; ?>
        </div>
 <?php endif; ?>
                           <form action="<?= base_url().'secure/register'?>" method="post" class="personal-form-1" id="personal-form" name="personalDetails">
                                    <fieldset>
                                        
                                        
                                        <hr>   
                                        
                                        <div class="col6">
                                        <p class="username"> First Name</p>
                                        <input type="text" name="firstname" id="Name" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username">Last Name</p>
                                        <input type="text" name="lastname" id="LastName" value="" required />
                                        </div>
                                        
                                        <div class="col12 padding-left">
                                        <p class="username"> Company </p>
                                        <input type="text" name="company" id="Company" value="" required />
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> Address</p>
                                        <input type="text" name="address1" id="Address1" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Address (optional)</p>
                                        <input type="text" name="address2" id="Address2" value=""  />
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> City</p>
                                        <input type="text" name="city" id="City" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Postal Code</p>
                                        <input type="text" name="zip" id="PoastalCode" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Country</p>
                                            <?php echo form_dropdown('country_id',$countries_menu, @$customer['country'], ' onchange="get_county()" id="country_id" class="select-country-state" ');?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> State/County</p>
                                         <?php echo form_dropdown('zone_id',$zones_menu, @$customer['state'], 'id="f_zone_id" class="select-country-state"');?> 
                                        </div>
                                      
                                          <div class="col6">
                                        <p class="username"> Phone</p>
                                        <input type="text" name="phone" id="Phone" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> E-mail</p>
                                        <input type="email" name="email" id="Email" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Password</p>
                                        <input type="password" name="password" id="Password" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Confirm Password</p>
                                        <input type="password" name="confirm" id="ConfirmPassword" value="" required />
                                        </div>
                                      
                                           <p class="clear">
                                            <input type="submit" class="action primary submit" value="Register" />
                                            </p> 
                                    </fieldset>
                                </form>
                       
                        
                        </div>
                        
                        
                     
                    
                    </div><!-- end col12 -->
                   
                 </div><!-- end one row -->
                 
                 
                                   
                 
                 
                 
          </section>             
            <div class="clear"></div>
   <script type="text/javascript" language="javascript">
function get_county()
{
    
var id  = document.getElementById('country_id').value;
 j      = jQuery.noConflict();
 
 j.ajax({ 
                type: "POST",         //GET or POST or PUT or DELETE verb
                url:  '<?=base_url()?>locations/get_zone_menu',         // Location of the service
                data: 'id='+id,         //Data sent to server
                success: function (data) 
                {//On Successful service call
                 //alert(data);
                    j('#f_zone_id').html(data);
                },
                
       });
}

</script>
        
   <?php include('footer.php')?> 
