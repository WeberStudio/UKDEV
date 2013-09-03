<?php include('main_header.php')?>   
    <body>
<?php
$company        = array('id'=>'bill_company', 'class'=>'', 'placeholder'=>'Company', 'name'=>'company', 'value'=> set_value('company',$company));
$first          = array('id'=>'billing_first_name','class'=>'','placeholder'=>'First Name','name'=>'firstname','value'=> set_value('firstname',$firstname));
$last           = array('id'=>'billing_last_name','class'=>'','placeholder'=>'Last Name','name'=>'lastname','value'=> set_value('lastname',$lastname));
$email          = array('id'=>'bill_email', 'class'=>'', 'placeholder'=>'E-Mail', 'name'=>'email', 'value'=>set_value('email',$email));
$phone          = array('id'=>'bill_phone', 'class'=>'', 'name'=>'phone', 'placeholder'=>'Phone', 'value'=> set_value('phone',$phone));
$f_city         = array('id'=>'f_city', 'class'=>'', 'placeholder'=>'City', 'name'=>'city', 'value'=>set_value('city',$city));
$f_zip          = array('id'=>'zip_code', 'maxlength'=>'10', 'class'=>'', 'placeholder'=>'Post Code', 'name'=>'zip_code', 'value'=> set_value('zip_code',$zip_code));
$f_address1     = array('id'=>'street_address', 'placeholder'=>'Address', 'class'=>'', 'name'=>'street_address', 'value'=>set_value('street_address',$street_address));
$f_address2     = array('id'=>'address_line_op','class'=>'','placeholder'=>'Address  (optional)','name'=>'address_line_op', 'value'=> set_value('address_line_op',$address_line_op));
$password       = array('id'=>'password','name'=>'password','class'=>'','placeholder'=>'Password'); 
$con_password   = array('id'=>'confirm','name'=>'confirm','class'=>'','placeholder'=>'Confirm');

?>
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
                        <div class="col6">
                        
<?php

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
 <?php endif; ?>           <h2>Register Tutor</h2> 
                           <?php echo form_open('tutor_login/register'); ?> 
                                    <fieldset>
                                        
                                        
                                        <hr>   
                                        <div class="col6">
                                        <p class="username"> Categories</p>
                                         <select data-placeholder="Choose Multiple Categories" class="choose" name="categories[]" multiple="true" tabindex="5">
                                            <? if(isset($all_categories)){  ?>
                                            <?php  foreach ($all_categories as $file){
                                                if(in_array($file['id'], $categories_item)){                                     
                                                ?>
                                                        <option selected="selected" value="<?=$file['id']?>"><?=$file['name']?></option>
                                                <? } 
                                                else
                                                { ?>    
                                                        
                                                        <option value="<?=$file['id']?>"><?=$file['name']?></option>
                                                <? }
                                                 }
                                            } 
                                             ?>
                                         </select>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> Courses</p>
                                          <select style="width: 280px;" data-placeholder="Choose Multiple Courses" class="choose" name="courses[]" multiple="true" tabindex="5">
                                            <? if(isset($all_courses)){  ?>
                                            <?php  foreach ($all_courses as $course){
                                                if(in_array($course['id'], $courses_item)){                                     
                                                ?>
                                                        <option selected="selected" value="<?=$course['id']?>"><?=$course['name']?></option>
                                                <? } 
                                                else
                                                { ?>    
                                                        
                                                        <option value="<?=$course['id']?>"><?=$course['name']?></option>
                                                <? } 
                                                 }
                                            } 
                                             ?>
                                            </select>
                                        </div>
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> <?php echo lang('account_firstname');?></p>
                                        <?php echo form_input($first);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"><?php echo lang('account_lastname');?> </p>
                                        <?php echo form_input($last);?>  
                                        </div>
                                        
                                        <div class="col12 padding-left">
                                        <p class="username"> <?php echo lang('account_company');?></p>
                                        <?php echo form_input($company);?> 
                                        </div>
                                           <div class="col6">
                                        <p class="username"> <?php echo lang('address');?></p>
                                        <?php echo form_input($f_address1);?>
                                        </div>
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> <?php echo lang('address');?></p>
                                        <?php echo form_input($f_address2);?> 
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        <div class="col6">
                                        <p class="username"> <?php echo lang('address_city');?></p>
                                        <?php echo form_input($f_city);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> <?php echo lang('address_postcode');?></p>
                                        <?php echo form_input($f_zip);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> <?php echo lang('address_postcode');?></p>
                                        <?php echo form_dropdown('country', $countries_menu, set_value('country_id', $country_id), ' onchange="get_county()" id="country_id" class="select-country-state" ');?>
                                            
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"> State/County</p>
                                        <?php echo form_dropdown('state', $zones_menu, set_value('zone_id', $zone_id), 'id="f_zone_id" class="select-country-state"');?> 
                                         
                                        </div>
                                      
                                      <div class="col6">
                                        <p class="username"> <?php echo lang('account_phone');?> </p>
                                        <?php echo form_input($phone);?> 
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"><?php echo lang('account_email');?></p>
                                       <?php echo form_input($email);?>
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"><?php echo lang('account_password');?></p>
                                        <?php echo form_password($password);?>  
                                        </div>
                                        
                                        <div class="col6">
                                        <p class="username"><?php echo lang('account_confirm');?> </p>
                                        <?php echo form_password($con_password);?> 
                                        </div>
                                        <div class="col11">
                                        <p class="username"><?php echo "Comment";?> </p>
                                        <textarea rows="3" cols="95"  name="comment"></textarea>
                                        </div>
                                      
                                           <p class="clear">
                                           <input type="submit" name="submit" value="<?php echo lang('form_register');?>" class="action primary submit"  /> 
                                           
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
