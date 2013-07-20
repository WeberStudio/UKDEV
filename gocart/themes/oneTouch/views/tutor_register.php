 <?php include('mainHeader.php'); ?>  
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
        <script> var customStyleImgUrl = "images/custom-slider-img";</script>
          <?php //include('leftPanel.php'); ?>
		
        <div id="body-wrapper" >		
            <div id="body-wrapper-padding">			
                <!--[if lt IE 7]>
                <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
                browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
                experience this site.
                </div><![endif]-->
                 <?php include('header.php'); ?> 
               <!--===========inner content start========-->

<?php
$company	= array('id'=>'bill_company', 'class'=>'input-text', 'placeholder'=>'Company', 'name'=>'company', 'value'=> set_value('company'));
$first		= array('id'=>'billing_first_name','class'=>'input-text','placeholder'=>'First Name','name'=>'firstname','value'=> set_value('firstname'));
$last		= array('id'=>'billing_last_name','class'=>'input-text','placeholder'=>'Last Name','name'=>'lastname','value'=> set_value('lastname'));
$email		= array('id'=>'bill_email', 'class'=>'input-text', 'placeholder'=>'E-Mail', 'name'=>'email', 'value'=>set_value('email'));
$phone		= array('id'=>'bill_phone', 'class'=>'input-text', 'name'=>'phone', 'placeholder'=>'Phone', 'value'=> set_value('phone'));
$f_city		= array('id'=>'f_city', 'class'=>'input-text', 'placeholder'=>'City', 'name'=>'city', 'value'=>set_value('city',$city));
$f_zip		= array('id'=>'zip_code', 'maxlength'=>'10', 'class'=>'input-text', 'placeholder'=>'Post Code', 'name'=>'zip_code', 'value'=> set_value('zip',$zip));
$f_address1	= array('id'=>'street_address', 'placeholder'=>'Address', 'class'=>'input-text', 'name'=>'street_address', 'value'=>set_value('address1'));
$f_address2	= array('id'=>'address_line_op','class'=>'input-text','placeholder'=>'Address  (optional)','name'=>'address_line_op', 'value'=> set_value('address2'));
$password 	= array('id'=>'password','name'=>'password','class'=>'input-text','placeholder'=>'Password'); 
$con_password 	= array('id'=>'confirm','name'=>'confirm','class'=>'input-text','placeholder'=>'Confirm');
//$gender_m 	= array('id'=>'gender_m', 'class'=>'','name'=>'gender', 'value'=>'male' );
//$gender_f 	= array('id'=>'gender_f', 'class'=>'', 'name'=>'gender', 'value'=>'female' );
?>
<script>
function toggle() {

	var el = document.getElementById('obj');

	if ( el.style.display != 'none' ) {

		el.style.display = 'none';

	}

	else {

		el.style.display = '';

	}
return false;
}

</script>
<div class="row">
    <h1 class="page-title" style="margin-left:20px;">
	<a class="black" href="javascript:void(0)">you can login here</a>
	</h1>
</div>

   <script type="text/javascript">
function showStuff() {
    document.getElementById('closee').style.display = 'none';
}
</script>
       <?php 
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	if($this->session->flashdata('error'))
	{
		$error	= $this->session->flashdata('error');
	}
	if(validation_errors() != '')
	{
		$error	= validation_errors();
	}
	?>
    
   
   
    <?php if (!empty($error)): ?>
          <div class="alert alert-error" id="closee"> <a href="javascript:void(0)"  class="close" data-dismiss="alert" onClick="showStuff(); return false;">x</a> <?php echo"<div style='margin-left: 70px;'>". $error. "</div>"; ?> </div>
          <?php endif; ?>
          
      
          <?php if (!empty($message)): ?>
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $message; ?>
		</div>
	<?php endif; ?>
	<!----- main content section start---->
<div class="row">
<div id="content" class="fifteen columns">
<!---=======hidden form start--->
<!--<p class="woocommerce_info">Already registered? <a href="" class="" onClick="return toggle()">Click here to login</a></p>
<form style="display:none;" id="obj" method="post" class="login" action="<?=base_url()?>tutor_login/login">
	<p>If you have shopped with us before, please enter your details in the
 boxes below. If you are a new customer please proceed to the Billing 
&amp; Shipping section.</p>

	<p class="form-row form-row-first">
		<label for="username">Username or email <span class="required">*</span></label>
		<input class="input-text" name="email" id="username" type="text">
	</p>
	<p class="form-row form-row-last">
		<label for="password">Password <span class="required">*</span></label>
		<input class="input-text" name="password" id="password" type="password">
	</p>
	<div class="clear"></div>

	<p class="form-row">
		<input id="_n" name="_n" value="" type="hidden"><input name="_wp_http_referer" value="" type="hidden">	
        	<input class="button" name="submitted" value="Login" type="submit">
		<input name="redirect" value="" type="hidden">
		<a class="lost_password" href="<?php echo site_url('secure/forgot_password')?>">Lost Password?</a>
	</p>

	<div class="clear"></div>
</form>-->
<!---=======hidden form end--->  
  
      
		
			<?php echo form_open('tutor_login/register'); ?>
			<input type="hidden" name="submitted" value="submitted" />
			<input type="hidden" name="redirect" value="<?php //echo $redirect; ?>" />
			<div class="col2-set" id="customer_details">
			<div class="col-1">
			<h3><?php echo "Register Tutor";?></h3>
			<p class="form-row form-row-first" id="billing_first_name_field">
					<label for="billing_first_name" class=""><?php echo "Categories";?><abbr class="required" title="required">*</abbr>
					</label>
					 <?
					/* echo $categories;
					 	$this->show->pe($categories);exit;*/
						/*if(!empty($categories)){
							$categories_item = str_replace(array("[", "]",  '"'),'',$categories);
							//print_r($categories_item);exit;						
							$categories_item = explode(',',$categories_item);
					  	}*/
					  ?>
                        <select data-placeholder="Choose Multiple Categories" class="chzn-select" name="categories[]" multiple="true" tabindex="5">
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
				</p>
			<p class="form-row form-row-last" id="billing_last_name_field">
					<label for="billing_last_name" class=""><?php echo "Courses";?> <abbr class="required" title="required">*</abbr>
					</label>
					 <select data-placeholder="Choose Multiple Courses" class="chzn-select" name="courses[]" multiple="true" tabindex="5">
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
				</p>
            <div class="clear"></div>
            
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
					<?php echo form_dropdown('country', $countries_menu, set_value('country_id', $country_id), 'id="country_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?>
				</p>
			<p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
					<label for="billing_postcode" class=""><?php echo lang('address_state');?><abbr class="required" title="required">*</abbr>
					</label>
					<?php echo form_dropdown('state', $zones_menu, set_value('zone_id', $zone_id), 'id="f_zone_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?>
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
			<div class="clear"></div>
			<p class="form-row form-row-first" id="billing_city_field">
					<label for="billing_city" class=""><?php echo lang('account_password');?><abbr class="required" title="required">*</abbr>
					</label>
					<?php echo form_password($password);?>
				</p>
			<p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
					<label for="billing_postcode" class=""><?php echo lang('account_confirm');?> <abbr class="required" title="required">*</abbr>
					</label>
					<?php echo form_password($con_password);?>
				</p>
            <div class="clear"></div>
                
			<p class="form-row " id="billing_company_field">
					<label for="billing_company" class=""><?php echo "Comment";?></label>
					<textarea name="comment"></textarea>
				</p>
            <div class="clear"></div>
            
			<p class="form-row " id="billing_company_field">
						<label class="checkbox">
							<input type="checkbox" name="email_subscribe" value="1" <?php echo set_radio('email_subscribe', '1', TRUE); ?>/> <?php echo lang('account_newsletter_subscribe');?>
						</label>
					</p>
            <p class="form-row " id="billing_company_field">
				<input type="submit" name="submit" value="<?php echo lang('form_register');?>" class="button" style="height: 34px; width: 74px;" />
                </p>
			
			</div>
			</div>
		</form>
	
		
	
    
    <section id="shopping_cart-2" class="widget-2 widget widget_shopping_cart">
      
    </section>
    </div>
  </div>
</div>
</div>
<!-----main content section end----->
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
  <!--<script type="text/javascript">
$(function(){
	$('#f_country_id').change(function(){
			$.post('<?php echo site_url('locations/get_zone_menu');?>',{id:$('#f_country_id').val()}, function(data) {
			  $('#f_zone_id').html(data);
			});
		});
});

function save_address()
{
	$.post("<?php echo site_url('secure/register');?>/"+$('#f_id').val(), {	company: $('#f_company').val(),
																				firstname: $('#f_firstname').val(),
																				lastname: $('#f_lastname').val(),
																				email: $('#f_email').val(),
																				phone: $('#f_phone').val(),
																				address1: $('#f_address1').val(),
																				address2: $('#f_address2').val(),
																				city: $('#f_city').val(),
																				country_id: $('#f_country_id').val(),
																				zone_id: $('#f_zone_id').val(),
																				zip: $('#f_zip').val()
																				},
		function(data){
			if(data == 1)
			{
				window.location = "<?php echo site_url('secure/register');?>";
			}
			else
			{
				$('#form-error').html(data).show();
			}
		});
}
</script>-->
 

               
               <!--===========inner content start========-->
            </div>
        </div>
        
        <?php include_once('footer.php'); ?> 
        
       
    
</html>

