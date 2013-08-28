<?php include('main_header.php')?>   
    <body>
<?php
$address_form_prefix ="";


$company    = array('id'=>'company', 'class'=>'input-text', 'name'=>'company', 'value'=> set_value('company', $customer['company']));
$first        = array('id'=>'firstname', 'class'=>'input-text', 'name'=>'firstname', 'value'=> set_value('firstname', $customer['firstname']));
$f_city        = array('id'=>'f_city', 'class'=>'input-text', 'name'=>'city', 'value'=>set_value('city',$customer['city']));
$f_zip        = array('id'=>'f_zip', 'maxlength'=>'10', 'class'=>'input-text', 'name'=>'zip', 'value'=> set_value('zip', $customer['post_code']));
$f_address1    = array('id'=>'f_address1', 'class'=>'input-text', 'name'=>'address1', 'value'=>set_value('address1', $customer['address_street']));
$f_address2    = array('id'=>'f_address2', 'class'=>'input-text', 'name'=>'address2', 'value'=> set_value('address2', $customer['address_line']));
$last        = array('id'=>'lastname', 'class'=>'input-text', 'name'=>'lastname', 'value'=> set_value('lastname', $customer['lastname']));
$email        = array('id'=>'email', 'class'=>'input-text', 'name'=>'email', 'value'=> set_value('email', $customer['email']));
$phone        = array('id'=>'phone', 'class'=>'input-text', 'name'=>'phone', 'value'=> set_value('phone', $customer['phone']));
$password     = array('id'=>'password','name'=>'password','class'=>'input-text','placeholder'=>'Password'); 
$con_password     = array('id'=>'confirm','name'=>'confirm','class'=>'input-text','placeholder'=>'Confirm'); 
$address_form_prefix ="";
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
                  <?php include('dashboard_leftpanal.php')?> 
                       
                        <div class="col8">
                         <?php echo form_open_multipart(base_url().'dashboard/my_account/0/'.$customer['id']); ?>
                         <div class="">
                <h3>My Account</h3>
                       <div class="col6"> 
                         <p class=""><?php echo lang('account_firstname');?></p>
                         <?php echo form_input($first);?>
                        </div>
                        <div class="col6"> 
                         <p class=""><?php echo lang('account_lastname');?></p>
                         <?php echo form_input($last);?>
                        </div>
                        <div class="col12"> 
                         <p class=""><?php echo lang('account_company');?></p>
                         <?php echo form_input($company);?>
                        </div>
                     <div class="col6"> 
                        <p class=""><?php echo lang('address');?></p>
                        <?php echo form_input($f_address1);?>
                        
                      </div>
                      <div class="col6"> 
                        <p class=""><?php echo lang('address');?></p>
                        
                        <?php echo form_input($f_address2);?>
                      </div>
                        
                        <div class="col6"> 
                         <p class=""><?php echo lang('address_city');?></p>
                         <?php echo form_input($f_city);?>
                        </div><br /><div class="col6"> 
                         <p class=""><?php echo lang('address_postcode');?></p>
                         <?php echo form_input($f_zip);?>
                        </div>
                        <div class="col6">
                            <p class="username"> Country</p>
                             <?php echo form_dropdown('country_id',$countries_menu, @$tutor['country'], 'onchange="get_county()" id="country_id" class="select-country-state"');?>   
                          </div>
                        
                            <div class="col6">
                            <p class="username"> State</p>
                            <?php echo form_dropdown('zone_id',$zones_menu, @$tutor['state'], 'id="f_zone_id" class="select-country-state"');?>
                        </div>
                        <div class="col6"> 
                         <p class=""><?php echo lang('account_phone');?></p>
                         <?php echo form_input($phone);?>
                        </div>
                        <div class="col6"> 
                         <p class=""><?php echo lang('account_email');?></p>
                         <?php echo form_input($email);?>
                        </div>


                     <h3>About You</h3>
                     <div class="col6">
                    <p class="" id="">File upload</p>
                     <input type="file" class="spa1n6 fileinput" id="search-input" name="image">
                    
                    </div>
                    <div class="col12">
                    <p class="" id="">About</p>
                        
                        <textarea rows="6" cols="150" name="about"> <?php echo $customer['about'];?></textarea>
                    
                    </div>
                    
                    <div class="clear"></div>
                    <input style="float: right;" type="submit" value="<?php echo lang('form_submit');?>" class="button" />
                </div> 
                         <form>
                        </div>
                      
                </div> 
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
