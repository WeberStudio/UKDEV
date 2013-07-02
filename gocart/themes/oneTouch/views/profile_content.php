<?php
$address_form_prefix ="";


//$company	= array('id'=>'company', 'class'=>'input-text', 'name'=>'company', 'value'=> set_value('company', $tutor['company']));
$first		= array('id'=>'firstname', 'class'=>'input-text', 'name'=>'firstname', 'value'=> set_value('firstname', $tutor['firstname']));
$f_city		= array('id'=>'f_city', 'class'=>'input-text', 'name'=>'city', 'value'=>set_value('city',$tutor['city']));
$f_zip		= array('id'=>'f_zip', 'maxlength'=>'10', 'class'=>'input-text', 'name'=>'zip_code', 'value'=> set_value('zip_code', $tutor['zip_code']));
$f_address1	= array('id'=>'f_address1', 'class'=>'input-text', 'name'=>'street_address', 'value'=>set_value('street_address', $tutor['street_address']));
$f_address2	= array('id'=>'f_address2', 'class'=>'input-text', 'name'=>'address_line_op', 'value'=> set_value('address_line_op', $tutor['address_line_op']));
$last		= array('id'=>'lastname', 'class'=>'input-text', 'name'=>'lastname', 'value'=> set_value('lastname', $tutor['lastname']));
$email		= array('id'=>'email', 'class'=>'input-text', 'name'=>'email', 'value'=> set_value('email', $tutor['email']));
$phone		= array('id'=>'phone', 'class'=>'input-text', 'name'=>'phone', 'value'=> set_value('phone', $tutor['phone']));
$password 	= array('id'=>'password','name'=>'password','class'=>'input-text','placeholder'=>'Password'); 
$con_password 	= array('id'=>'confirm','name'=>'confirm','class'=>'input-text','placeholder'=>'Confirm'); 
$address_form_prefix ="";
?>
<div id="main">
  <div class="container">
        
    <div id="main_container">
      <div class="row-fluid">
        <?php include('dashboard_leftpanal.php');?>
        <!-- End .span3 -->
        
        <div class="span9"  style="width: 960px;">
          <?php echo form_open_multipart(base_url().'tutor_login/register/'.$tutor['tutor_id']); ?>
          <!-- End .legend -->
         <div class="row">
		<div id="content" class="fifteen columns">
		
		
		<div class="col-1">
				<h3>My Account</h3>
			
					<p class="form-row form-row-first" id="billing_first_name_field">
						<label for="billing_first_name" class=""><?php echo lang('account_firstname');?><abbr class="required" title="required">*</abbr>
						</label>
						
						<?php echo form_input($first);?>
					</p>
	
					<p class="form-row form-row-last" id="billing_last_name_field">
						<label for="billing_last_name" class=""><?php echo lang('account_lastname');?> <abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_input($last);?>
					</p>
					<div class="clear"></div>
					<!--<p class="form-row " id="billing_company_field">
						<label for="billing_company" class=""><?php echo lang('account_company');?></label>
						<?php echo form_input($company);?>
					</p>-->
					<div class="clear"></div>
					<p class="form-row form-row-first" id="billing_address_1_field">
						<label for="billing_address_1" class=""><?php echo lang('address');?><abbr class="required" title="required">*</abbr></label>
						<?php echo form_input($f_address1);?>
					</p>
					<p class="form-row form-row-last" id="billing_address_2_field">
						<label for="billing_address_2" class="hidden"><?php echo lang('address');?> 2</label>
						<?php echo form_input($f_address2);?>
					</p>
					<div class="clear"></div>
					<p class="form-row form-row-first" id="billing_city_field">
						<label for="billing_city" class=""><?php echo lang('address_city');?><abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_input($f_city);?>
					</p>
					<p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
						<label for="billing_postcode" class=""><?php echo lang('address_postcode');?> <abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_input($f_zip);?>
					</p>
					<div class="clear"></div>
					
					<p class="form-row form-row-first" id="billing_city_field">
						<label for="billing_city" class=""><?php echo lang('address_country');?><abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_dropdown('country',$countries_menu, @$tutor['country'], 'id="country_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?>
						
					</p>
					<p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
						<label for="billing_postcode" class=""><?php echo lang('address_state');?><abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_dropdown('state',$zones_menu, @$tutor['state'], 'id="f_zone_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?>
						
					</p>
					<div class="clear"></div>
				
					
					<p class="form-row form-row-first" id="billing_city_field">
						<label for="billing_city" class=""><?php echo lang('account_phone');?><abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_input($phone);?>
					</p>
					<p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
						<label for="billing_postcode" class=""><?php echo lang('account_email');?> <abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_input($email);?>
					</p>
                    <h3>About You</h3>
                    <p class="form-row " id="billing_company_field">
                          <label for="billing_postcode" class="">File upload</label>
                           <input type="file" class="spa1n6 fileinput" id="search-input" name="image">
                    </p>
                    <p class="form-row " id="billing_company_field">
						<label for="billing_company" class="">About</label>
						<textarea name="about"></textarea>
					</p>
					<div class="clear"></div>
					<input type="submit" value="<?php echo lang('form_submit');?>" class="button"  style="height: 34px; width: 74px;" />
				</div>
		
		</form>
		</div>
		</div>
          
          <!-- End .content --> 
        </div>
        <!-- End .span9 --> 
      </div>
      <!-- End .row-fluid --> 
      
    </div>
    <!-- End #container --> 
  </div>
 
</div>
<script type="text/javascript">
  var j = jQuery.noConflict();
	j(function(){
		j('#country_id').change(function(){
				j.post('<?php echo site_url('locations/get_zone_menu');?>',{id:j('#country_id').val()}, function(data) {
				  j('#f_zone_id').html(data);
				});
				
			});
			
	});
</script>