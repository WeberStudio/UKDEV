<?php include('main_header.php')?>
    <body>
<?php

$company        = array('id'=>'company', 'class'=>'input-text', 'name'=>'company', 'value'=> set_value('company', $customer['company']));
$first          = array('id'=>'firstname', 'class'=>'input-text', 'name'=>'firstname', 'value'=> set_value('firstname', $customer['firstname']));
$f_city         = array('id'=>'f_city', 'class'=>'input-text', 'name'=>'city', 'value'=>set_value('city',$customer['city']));
$f_post_code    = array('id'=>'f_zip', 'maxlength'=>'10', 'class'=>'input-text', 'name'=>'zip', 'value'=> set_value('zip', $customer['post_code']));
$f_address1     = array('id'=>'f_address1', 'class'=>'input-text', 'name'=>'address1', 'value'=>set_value('address1', $customer['address_street']));
$f_address2     = array('id'=>'f_address2', 'class'=>'input-text', 'name'=>'address2', 'value'=> set_value('address2', $customer['address_line']));
$last           = array('id'=>'lastname', 'class'=>'input-text', 'name'=>'lastname', 'value'=> set_value('lastname', $customer['lastname']));
$email          = array('id'=>'email', 'class'=>'input-text', 'name'=>'email', 'value'=> set_value('email', $customer['email']));
$phone          = array('id'=>'phone', 'class'=>'input-text', 'name'=>'phone', 'value'=> set_value('phone', $customer['phone']));
$b_company      = array('id'=>'b_company', 'class'=>'input-text', 'name'=>'b_company', 'value'=> set_value('company', $customer['bill_address']['company']));
$b_first        = array('id'=>'b_firstname', 'class'=>'input-text', 'name'=>'b_firstname', 'value'=> $customer['bill_address']['firstname']);
$b_city         = array('id'=>'b_city', 'class'=>'input-text', 'name'=>'b_city', 'value'=>set_value('city',$customer['bill_address']['city']));
$b_post_code    = array('id'=>'b_zip', 'maxlength'=>'10', 'class'=>'input-text', 'name'=>'b_zip', 'value'=> set_value('zip', $customer['bill_address']['zip']));
$b_address1     = array('id'=>'b_address1', 'class'=>'input-text', 'name'=>'b_address1', 'value'=>set_value('address1', $customer['bill_address']['address1']));
$b_address2     = array('id'=>'b_address2', 'class'=>'input-text', 'name'=>'b_address2', 'value'=> set_value('address2', $customer['bill_address']['address2']));
$b_last         = array('id'=>'b_lastname', 'class'=>'input-text', 'name'=>'b_lastname', 'value'=> set_value('lastname', $customer['bill_address']['lastname']));
$b_email        = array('id'=>'b_email', 'class'=>'input-text', 'name'=>'b_email', 'value'=> set_value('email', $customer['bill_address']['email']));
$b_phone        = array('id'=>'b_phone', 'class'=>'input-text', 'name'=>'b_phone', 'value'=> set_value('phone', $customer['bill_address']['phone']));
?>
<script type="text/javascript">
 function fill_address()
 {
     var first_name         = $('#firstname').val();
     var last_name          = $('#lastname').val();
     var company            = $('#company').val();
     var address1           = $('#f_address1').val();
     var address2           = $('#f_address2').val();
     var city               = $('#f_city').val();
     var post_code          = $('#f_zip').val();
     var country            = $('[name=country_id]').val();
     var state              = $('[name=zone_id]').val();
     var phone              = $('#phone').val();
     var email              = $('#email').val();
     
     $('#b_firstname').val(first_name);
     $('#b_lastname').val(last_name);
     $('#b_company').val(company);
     $('#b_address1').val(address1);
     $('#b_address2').val(address2);
     $('#b_city').val(city);
     $('#b_zip').val(post_code);
     $('[name=b_country_id]').val(country);
     $('[name=b_zone_id]').val(state);
     $('#b_email').val(email);
     $('#b_phone').val(phone);
     return false;
 
 }

</script>
<script type="text/javascript">
 function fill_address_d()
 {
     var first_name         = $('#b_firstname').val();
     var last_name          = $('#b_lastname').val();
     var company            = $('#b_company').val();
     var address1           = $('#b_address1').val();
     var address2           = $('#b_address2').val();
     var city               = $('#b_city').val();
     var post_code          = $('#b_zip').val();
     var country            = $('[name=b_country_id]').val();
     var state              = $('[name=b_zone_id]').val();
     var phone              = $('#b_phone').val();
     var email              = $('#b_email').val(); 
     
     $('#Name3').val(first_name);
     $('#LastName3').val(last_name);
     $('#Company3').val(company);
     $('#Address5').val(address1);
     $('#Address6').val(address2);
     $('#City3').val(city);
     $('#PostalCode3').val(post_code);
     $('[name=d_country_id]').val(country);
     $('[name=d_zone_id]').val(state); 
     $('#Phone3').val(phone); 
     $('#Email3').val(email); 

     
     return false;
 
 }

</script>
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
                        
                        
                        <div class="col3">
                        <h2 class="dull">1. Personal Details</h2>
                        </div>
                        
                        <div class="col3">
                        <h2>2. Address Details</h2>
                        </div>
                        
                        <div class="col3">
                        <h2 class="dull">3. Confirm</h2>
                        </div>
                        
                        <div class="col3">
                        <h2 class="dull">4. Payment</h2>
                        </div>
                        
                        <div class="col6">
                        
                          <div class="col12">
                            
                                <form action="<?=base_url().'checkout/step2'?>" method="post" class="personal-form-1" id="personal-form" name="personalDetails">
                                    <fieldset>
                                        <legend><h3>Personal Address</h3></legend>
                                        
                                        <hr>   
                                        
                                        <div class="col6">
                                        <p class="username">Name</p>
                                        <?php echo form_input($first);?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username">Last Name</p>
                                        <?php echo form_input($last);?>
                                        </div>
                                        
                                        <div class="col12 padding-left">
                                        <p class="username"> Company</p>
                                        <?php echo form_input($company);?>  
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> Address</p>
                                        <?php echo form_input($f_address1);?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Address (optional)</p>
                                        <?php echo form_input($f_address2);?>
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> City</p>
                                        <?php echo form_input($f_city);?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Post Code</p>
                                        <?php echo form_input($f_post_code);?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Country</p>
                                          <?php echo form_dropdown('country_id',$countries_menu, @$customer['country'], 'id="country_id" class="select-country-state"');?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> State/County</p>
                                        <?php echo form_dropdown('zone_id',$zones_menu, @$customer['state'], 'id="f_zone_id" class="select-country-state"');?> 
                                        </div>
                                      
                                          <div class="col6">
                                        <p class="username"> Phone</p>
                                        <?php echo form_input($phone);?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> E-mail</p>
                                        <?php echo form_input($email);?>
                                        </div>
                                           
                                    </fieldset>
                                
                           </div><!-- end col12 -->
                           
                           
                           <div class="col12">
                               
                                    <fieldset>
                                        <legend><h3>Card Billing Address</h3></legend>
                                        
                                        <hr>
                                         <div class="col12">
                                        <p class="button"><a href="javascript:void(0);" onclick="fill_address();"> Copy Above</a></p>
                                        
                                        </div>   
                                        
                                        <div class="col6">
                                        <p class="username">Name</p>
                                        <?php echo form_input($b_first);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username">Last Name</p>
                                        <?php echo form_input($b_last);?> 
                                        </div>
                                        
                                        <div class="col12 padding-left">
                                        <p class="username"> Company</p>
                                        <?php echo form_input($b_company);?> 
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> Address</p>
                                        <?php echo form_input($b_address1);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Address (optional)</p>
                                        <?php echo form_input($b_address2);?> 
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> City</p>
                                        <?php echo form_input($b_city);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Post Code</p>
                                        <?php echo form_input($b_post_code);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Country</p>
                                         <?php echo form_dropdown('b_country_id',$countries_menu, @$customer['country'], 'id="country_id" class="select-country-state"');?> 
                                          </div>
                                        
                                        <div class="col6">
                                        <p class="username"> State/County</p>
                                        <?php echo form_dropdown('b_zone_id',$zones_menu, @$customer['state'], 'id="f_zone_id" class="select-country-state"');?>
                                        </div>
                                      
                                          <div class="col6">
                                        <p class="username"> Phone</p>
                                        <?php echo form_input($b_phone);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> E-mail</p>
                                        <?php echo form_input($b_email);?> 
                                        </div>
                                        
                                      
                                           
                                    </fieldset>
                                
                           </div>
                           
                           
                           <div class="col12">
                               
                                    <fieldset>
                                        <legend><h3>Delivery Address</h3></legend>
                                        
                                        <hr>   
                                         <div class="col12">
                                        <p class="button"><a href="javascript:void(0);" onclick="fill_address_d();"> Copy Above</a></p>
                                        
                                        </div>
                                        <div class="col6">
                                        <p class="username">Name</p>
                                        <input type="text" value="<?=$d_first?>" name="d_first" id="Name3" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username">Last Name</p>
                                        <input type="text" value="<?=$d_last?>" name="d_last" id="LastName3" value="" required />
                                        </div>
                                        
                                        <div class="col12 padding-left">
                                        <p class="username"> Company</p>
                                        <input type="text" value="<?=$d_company?>" name="d_company" id="Company3" value="" required />
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> Address</p>
                                        <input type="text" value="<?=$d_address?>" name="d_address" id="Address5" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Address (optional)</p>
                                        <input type="text" value="<?=$d_address_op?>" name="d_address_op" id="Address6" value=""  />
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> City</p>
                                        <input type="text" value="<?=$d_city?>" name="d_city" id="City3" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Post Code</p>
                                        <input type="text" value="<?=$d_post_code?>" name="d_post_code" id="PostalCode3" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Country</p>
                                         <?php echo form_dropdown('d_country_id',$countries_menu, @$customer['country'], 'id="country_id" class="select-country-state"');?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> State/County</p>
                                        <?php echo form_dropdown('d_zone_id',$zones_menu, @$customer['state'], 'id="f_zone_id" class="select-country-state"');?>
                                        </div>
                                      
                                          <div class="col6">
                                        <p class="username"> Phone</p>
                                        <input type="text" value="<?=$d_phone?>" name="d_phone" id="Phone3" value="" required />
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> E-mail</p>
                                        <input type="email" value="<?=$d_email?>" name="d_email" id="Email3" value="" required />
                                        </div>
                                        
                                      <p class="button"><a href="#">Go Back</a></p>
                                      <input type="submit" name="confirm" class="action primary submit" value="Next Step" style="float:right;" />
                                             
                                    </fieldset>
                                </form>
                           </div>
                           
                           
                           
                        </div> <!-- end col6 -->
                        
                        
                    </div><!-- end col12 -->
                   
                 </div><!-- end one row -->
                 
                 
                                   
                 
                 
                 
          </section>           
            <div class="clear"></div>
<script type="text/javascript">
  /*var j = jQuery.noConflict();
    j(function(){
        j('#country_id').change(function(){
                j.post('<?php echo site_url('locations/get_zone_menu');?>',{id:j('#country_id').val()}, function(data) {
                  j('#f_zone_id').html(data);
                });
                
            });
            
    });*/
</script>

            

  <?php include('footer.php')?>
