<?php include('main_header.php')?>   
<body>
    <?php
    //$company    = array('id'=>'company', 'class'=>'input-text', 'name'=>'company', 'value'=> set_value('company', $tutor['company']));
    $first        = array('id'=>'firstname', 'class'=>'', 'name'=>'firstname', 'value'=> set_value('firstname', $tutor['firstname']));
    $f_city        = array('id'=>'f_city', 'class'=>'', 'name'=>'city', 'value'=>set_value('city',$tutor['city']));
    $f_zip        = array('id'=>'f_zip', 'maxlength'=>'10', 'class'=>'', 'name'=>'zip_code', 'value'=> set_value('zip_code', $tutor['zip_code']));
    $f_address1    = array('id'=>'f_address1', 'class'=>'', 'name'=>'street_address', 'value'=>set_value('street_address', $tutor['street_address']));
    $f_address2    = array('id'=>'f_address2', 'class'=>'', 'name'=>'address_line_op', 'value'=> set_value('address_line_op', $tutor['address_line_op']));
    $last        = array('id'=>'lastname', 'class'=>'', 'name'=>'lastname', 'value'=> set_value('lastname', $tutor['lastname']));
    $email        = array('id'=>'email', 'class'=>'', 'name'=>'email', 'value'=> set_value('email', $tutor['email']));
    $phone        = array('id'=>'phone', 'class'=>'', 'name'=>'phone', 'value'=> set_value('phone', $tutor['phone']));
    

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
                            <?php echo form_open_multipart(base_url().'tutor_login/register/'.$tutor['tutor_id']); ?>
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
                                          </div>
                                          <div class="col6"> 
                                            <p class=""><?php echo lang('address_postcode');?></p>
                                            <?php echo form_input($f_zip);?>
                                          </div>
                                          <div class="col6">
                                            <p class="username"> Country</p>
                                             <?php echo form_dropdown('country',$countries_menu, @$tutor['country'], 'id="country_id" class="select-country-state"');?>   
                                          </div>
                                        
                                            <div class="col6">
                                            <p class="username"> State</p>
                                            <?php echo form_dropdown('state',$zones_menu, @$tutor['state'], 'id="f_zone_id" class="select-country-state"');?>
                                            </div>
                                          <div class="col6"> 
                                            <p class=""><?php echo lang('account_phone');?></p>
                                            <?php echo form_input($phone);?>
                                          </div>
                                          <div class="col6"> 
                                            <p class=""><?php echo lang('account_email');?></p>
                                            <?php echo form_input($email);?>
                                          </div>
                                          <div class="col6"> 
                                            <p class=""><?php echo lang('account_lastname');?></p>
                                            <?php echo form_input($last);?>
                                          </div>
                                          

                                        <div class="clear"></div>
                                        <!--<p class="form-row " id="billing_company_field">
                                            <label for="billing_company" class=""><?php echo lang('account_company');?></label>
                                            <?php echo form_input($company);?>
                                        </p>-->
                                        
                                        
                                        
                                        
                                    

                                   
                                        <h3>About You</h3>
                                        <p class="form-row " id="billing_company_field">
                                              <label for="billing_postcode" class="">File upload</label>
                                               <input type="file" class="spa1n6 fileinput" id="search-input" name="image">
                                        </p>
                                        <p class="form-row " id="billing_company_field">
                                            <label for="billing_company" class="">About</label>
                                            <textarea name="about" > <?php echo  $tutor['about'];?></textarea>
                                        </p>
                                        <div class="clear"></div>
                                        <input type="submit" value="<?php echo lang('form_submit');?>" class="button"  style="height: 34px; width: 74px;" />
                                    </div>
                            </form> 
                        </div>
                    
                </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
