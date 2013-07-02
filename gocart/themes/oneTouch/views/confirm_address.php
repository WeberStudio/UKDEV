<?php include('mainHeader.php'); ?> 
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">

<div id="body-wrapper" >
<div id="body-wrapper-padding">
<?php include('header.php'); ?>
<? //Content Area Start ?>
 
<?php if($this->Customer_model->is_logged_in(false, false)):?>
 <?php else: ?>
<script>
window.location="<?=base_url();?>secure/process_checkout";
</script>
<?php endif; ?>

<!--<div class="page-header">
	<h2><?php //echo lang('form_checkout');?></h2>
</div>-->
<div class="row">
<div class="line"> </div>
</div>
<?php if (validation_errors()):?>
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo validation_errors();?>
	</div>
<?php endif;?>

<script type="text/javascript">
    var j = jQuery.noConflict();
	j(document).ready(function(){
		
		//if we support placeholder text, remove all the labels
		if(!supports_placeholder())
		{
			j('.placeholder').show(); 
		}
        
        j('#country_id').change(function(){
        populate_zone_menu();
         });    
		
	});
	
	function supports_placeholder()
	{
		return 'placeholder' in document.createElement('input');
	}
</script>

<!--<script>
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
function toggle1() {

	var el = document.getElementById('obj1');

	if ( el.style.display != 'none' ) {

		el.style.display = 'none';

	}

	else {

		el.style.display = '';

	}

}

</script>-->

<script type="text/javascript">

// context is ship or bill
function populate_zone_menu(value)
{
	j.post('<?php echo site_url('locations/get_zone_menu');?>',{id:j('#country_id').val()}, function(data) {
		j('#zone_id').html(data);
	});
}

function show_block()
{
     
      j('#card_info_block').show();
}

function hide_block()
{
    j('#card_info_block').hide();   
}
</script>
<?php /* Only show this javascript if the user is logged in */ ?>
<?php if($this->Customer_model->is_logged_in(false, false)) : ?>
<script type="text/javascript">	
	<?php
	$add_list = array();
	foreach($customer_addresses as $row) {
		// build a new array
		$add_list[$row['id']] = $row['field_data'];
	}
	$add_list = json_encode($add_list);
	echo "eval(addresses=$add_list);";
	?>
		
	function populate_address(address_id)
	{
		if(address_id == '')
		{
			return;
		}
		
		// - populate the fields
		$.each(addresses[address_id], function(key, value){
			
			$('.address[name='+key+']').val(value);

			// repopulate the zone menu and set the right value if we change the country
			if(key=='zone_id')
			{
				zone_id = value;
			}
		});
		
		// repopulate the zone list, set the right value, then copy all to billing
		$.post('<?php echo site_url('locations/get_zone_menu');?>',{id:$('#country_id').val()}, function(data) {
			$('#zone_id').html(data);
			$('#zone_id').val(zone_id);
		});		
	}
	
</script>
<?php endif;?>

<?php
$countries = $this->Location_model->get_countries_menu();

if(!empty($customer[$address_form_prefix.'_address']['country_id']))
{
	$zone_menu	= $this->Location_model->get_zones_menu($customer[$address_form_prefix.'_address']['country_id']);
}
else
{
	$zone_menu = array(''=>'')+$this->Location_model->get_zones_menu(array_shift(array_keys($countries)));
}

//form elements

//$company	= array('placeholder'=>lang('address_company'),'class'=>'address span8', 'name'=>'company', 'value'=> set_value('company', @$customer[$address_form_prefix.'_address']['company']));

/*$address1	= array('placeholder'=>lang('address1'), 'class'=>'address span8', 'name'=>'address1', 'value'=> set_value('address1', @$customer[$address_form_prefix.'_address']['address1']));
$address2	= array('placeholder'=>lang('address2'), 'class'=>'address span8', 'name'=>'address2', 'value'=>  set_value('address2', @$customer[$address_form_prefix.'_address']['address2']));
$first		= array('placeholder'=>lang('address_firstname'), 'class'=>'address span4', 'name'=>'firstname', 'value'=>  set_value('firstname', @$customer[$address_form_prefix.'_address']['firstname']));
$last		= array('placeholder'=>lang('address_lastname'), 'class'=>'address span4', 'name'=>'lastname', 'value'=>  set_value('lastname', @$customer[$address_form_prefix.'_address']['lastname']));
$email		= array('placeholder'=>lang('address_email'), 'class'=>'address span4', 'name'=>'email', 'value'=> set_value('email', @$customer[$address_form_prefix.'_address']['email']));
$phone		= array('placeholder'=>lang('address_phone'), 'class'=>'address span4', 'name'=>'phone', 'value'=> set_value('phone', @$customer[$address_form_prefix.'_address']['phone']));
$city		= array('placeholder'=>lang('address_city'), 'class'=>'address span3', 'name'=>'city', 'value'=> set_value('city', @$customer[$address_form_prefix.'_address']['city']));
$zip		= array('placeholder'=>lang('address_postcode'), 'maxlength'=>'10', 'class'=>'address span2', 'name'=>'zip', 'value'=> set_value('zip', @$customer[$address_form_prefix.'_address']['zip']));
*/
$company	= array('id'=>'company', 'class'=>'input-text', 'name'=>'company', 'value'=> set_value('company', $customer['company']));
$first		= array('id'=>'firstname', 'class'=>'input-text', 'name'=>'firstname', 'value'=> set_value('firstname', $customer['firstname']));
$f_city		= array('id'=>'f_city', 'class'=>'input-text', 'name'=>'city', 'value'=>set_value('city',$customer['city']));
$f_zip		= array('id'=>'f_zip', 'maxlength'=>'10', 'class'=>'input-text', 'name'=>'zip', 'value'=> set_value('zip', $customer['post_code']));
$f_address1	= array('id'=>'f_address1', 'class'=>'input-text', 'name'=>'address1', 'value'=>set_value('address1', $customer['address_street']));
$f_address2	= array('id'=>'f_address2', 'class'=>'input-text', 'name'=>'address2', 'value'=> set_value('address2', $customer['address_line']));
$last		= array('id'=>'lastname', 'class'=>'input-text', 'name'=>'lastname', 'value'=> set_value('lastname', $customer['lastname']));
$email		= array('id'=>'email', 'class'=>'input-text', 'name'=>'email', 'value'=> set_value('email', $customer['email']));
$phone		= array('id'=>'phone', 'class'=>'input-text', 'name'=>'phone', 'value'=> set_value('phone', $customer['phone']));
$password 	= array('id'=>'password','name'=>'password','class'=>'input-text','placeholder'=>'Password'); 
$con_password 	= array('id'=>'confirm','name'=>'confirm','class'=>'input-text','placeholder'=>'Confirm'); 

?>
	
	<?php
	//post to the correct place.
	//echo ($address_form_prefix == 'bill')?form_open('checkout/step_1'):form_open('checkout/shipping_address');?>
<div class="row">
<div id="content" class="fifteen columns">
<!--<p class="woocommerce_info">Already registered? <a href="" class="" onClick="return toggle()">Click here to login</a></p>-->
<!--<form style="display:none;" id="obj" method="post" class="login">
	<p>If you have shopped with us before, please enter your details in the
 boxes below. If you are a new customer please proceed to the Billing 
&amp; Shipping section.</p>

	<p class="form-row form-row-first">
		<label for="username">Username or email <span class="required">*</span></label>
		<input class="input-text" name="username" id="username" type="text">
	</p>
	<p class="form-row form-row-last">
		<label for="password">Password <span class="required">*</span></label>
		<input class="input-text" name="password" id="password" type="password">
	</p>
	<div class="clear"></div>

	<p class="form-row">
		<input id="_n" name="_n" value="23b8c2c5f1" type="hidden"><input name="_wp_http_referer" value="/onetouch/checkout/" type="hidden">		<input class="button" name="login" value="Login" type="submit">
		<input name="redirect" value="http://theme.crumina.net/onetouch/checkout/" type="hidden">
		<a class="lost_password" href="http://theme.crumina.net/onetouch/wp-login.php?action=lostpassword&amp;redirect_to=http://theme.crumina.net/onetouch">Lost Password?</a>
	</p>

	<div class="clear"></div>
</form>-->
	<?php echo form_open('secure/register'); ?>
	<div class="col2-set" id="customer_details">
				<div class="col-1">
				<h3>Billing Address</h3>
			
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
					<p class="form-row " id="billing_company_field">
						<label for="billing_company" class=""><?php echo lang('account_company');?></label>
						<?php echo form_input($company);?>
					</p>
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
						<?php echo form_dropdown('country_id',$countries, @$customer[$address_form_prefix.'_address']['country_id'], 'id="country_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?>
						
					</p>
					<p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
						<label for="billing_postcode" class=""><?php echo lang('address_state');?><abbr class="required" title="required">*</abbr>
						</label>
						<?php echo form_dropdown('zone_id',$zone_menu, @$customer[$address_form_prefix.'_address']['zone_id'], 'id="zone_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?>
						
					</p>
					<div class="clear"></div>
					<!--
					<div class="span12">
					<label><?php echo lang('address_country');?></label>
					<?php echo form_dropdown('country_id', $countries_menu, set_value('country_id', $country_id), 'id="f_country_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?>
				</div>
					<div class="span6">
					<label><?php echo lang('address_state');?></label>
					<?php echo form_dropdown('zone_id', $zones_menu, set_value('zone_id', $zone_id), 'id="f_zone_id" class="span12"');?>
					</div>-->
					
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
					<!--<p class="form-row">
			<input class="input-checkbox" id="createaccount" name="createaccount" value="1" type="checkbox" onClick="toggle1()"> <label for="createaccount" class="checkbox">Create an account?</label>
		</p>-->
					<!--<div  style="display: none;" class="create-account" id="obj1">
						<p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
						<p class="form-row form-row-first" id="account_password_field">
											<label for="account_password" class="">Account password</label>
											<?php echo form_password($password);?>
										</p>
						<p class="form-row form-row-last" id="account_password-2_field">
											<label for="account_password-2" class="hidden">Account password</label>
											<?php echo form_password($con_password);?>
										</p>
					</div>-->
					<div class="clear"></div>
				</div>
				</div>
	
	<h3 id="order_review_heading">Your order</h3>
	<div id="order_review">

	<table class="" style="width:100%;">
		<thead>
			<tr>
				<th class="product-name">Product</th>
				<th class="product-quantity">Qty</th>
				<th class="product-total">Totals</th>
			</tr>
		</thead>
		<tfoot>

			<tr class="cart-subtotal">
				<th colspan="2"><strong>Cart Subtotal</strong></th>
				<td><?php echo format_currency($this->go_cart->subtotal()); ?></td>
			</tr>

			<tr class="total">
				<th colspan="2"><strong>Order Total</strong></th>
				<td><strong><span class=""><?php echo format_currency($this->go_cart->total());?></span></strong></td>
			</tr>

			
		</tfoot>
		<tbody>
				 <?php

                                    $subtotal = 0;

             foreach ($this->go_cart->contents() as $cartkey=>$product):?>
                <tr class="checkout_table_item">
                    <td class="product-name"><?php echo $product['name']; ?></td>
                    <td class="product-quantity"><?php echo $product['quantity'] ?></td>
                    <td class="product-total"><span class="amount"><?php echo format_currency($product['price']*$product['quantity']);?></span></td>
                </tr>
                <?php endforeach;?>		
         </tbody>
	</table>

	

</div>

</form>
</div>
</div>

<div class="row">
<div id="content" class="fifteen columns">
<div class="col2-set" id="customer_details">
<div class="col-1">

	<h3>Payment Method</h3>
	<p><b><i>Please select a payment method for this order.</i></b></p>	
    <p>
	<?php
		$data = array('name'=>'pay_method', 'checked'=>'checked',  'onClick'=>'hide_block()');
		echo form_radio($data);
	?>
		<img src="<?php echo theme_img('pay_cards/PayPal_mark');?>"/>
		<b>Checkout with PayPal </b>
        <input type="button" class="button" name="proceed" onclick ="window.location='<?=base_url()?>checkout/place_order'" value="PayPal">    
     </p>
	     
     <p>
     <?php
	 		 if (validation_errors()){ $checked='checked';} else{$checked='';}
			$data = array('name'=>'pay_method',  'onClick'=>'show_block()', 'checked'=>$checked);
		 	echo form_radio($data);
	 ?>
    		<b>Checkout with PayPal </b>
            
     </p>
 <form action="<?=base_url()?>checkout/place_order_paypal_pro" method="post">        
     <div id="card_info_block" style="display:<?php if (validation_errors()){ echo "";} else{echo "none;";}?>">
    <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 120px;">
        <label for="billing_first_name" class="">Cards Accepted: 
        
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field"  style="width: 290px; margin-right: -14px;">
		<img src="<?php echo theme_img('pay_cards/visa');?>"/>
		<img src="<?php echo theme_img('pay_cards/mc');?>"/>
		<img src="<?php echo theme_img('pay_cards/visa_debit');?>"/>
		<img src="<?php echo theme_img('pay_cards/solo');?>"/>
		<img src="<?php echo theme_img('pay_cards/maestro');?>"/>
		<img src="<?php echo theme_img('pay_cards/visa_electron');?>"/>
	</p>
	<div class="clear"></div>
    
     <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 120px;">
        <label for="billing_first_name" class="">Card Owner:  
        
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field">
        <?php echo form_input($first);?>
	</p>
	<div class="clear"></div>
    
     <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 120px;">
        <label for="billing_first_name" class="">Cards Accepted: 
        
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field">
     	<?php 
			$option	= array(''=>'Select Card Type','VISA'=>'Visa','MC'=>'MasterCard' ,'DELTA'=>'Visa Debit' ,'SOLO'=>'Solo' ,'MAESTRO'=>'Maestro' ,'UKE'=>'Visa Electron (UKE)' );
			echo form_dropdown('select_card',$option);	
		?>
	</p>
	<div class="clear"></div>
    
     <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 120px;">
        <label for="billing_first_name" class="">Card Number:  
        
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field">
      <?php 
	  		$data = array('id'=>'card_num', 'class'=>'input-text', 'name'=>'card_num',);
			echo form_input($data)
	  ?>
     
	</p>
    
	<div class="clear"></div>
    
   <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 120px;">
        <label for="billing_first_name" class="">Card Expiry Date:  
        
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field">
     	<?php 
			$option	= array(''=>'Select Month','01'=>'January','02'=>'February' ,'03'=>' March' ,'04'=>'April' ,'05'=>'May' ,'06'=>'  June','07'=>'July' ,'08'=>'August' ,'09'=>'September' ,'10'=>'October' ,'11'=>'November' ,'12'=>'December');
			echo form_dropdown('select_month',$option,'', 'style="width: 100px;"');	
			echo " ";
			$option	= array(''=>'Select Year','2013'=>'2013','2014'=>'2014' ,'2015'=>' 2015' ,'2016'=>'2016' ,'2017'=>'2017' ,'2018'=>' 2018','2019'=>'2019' ,'2020'=>'2020' ,'2021'=>'2021' ,'2022'=>'2022');
			echo form_dropdown('select_year',$option, '', 'style="width: 100px;"');
		?>
	</p>
	<div class="clear"></div>
    
       <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 120px;">
        <label for="billing_first_name" class="">CVV Number (More Info): 
        
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field">
     	<?php 
			$data = array('id'=>'cvv_num', 'class'=>'input-text', 'name'=>'cvv_num','style'=>'width: 120px');
			echo form_input($data)
		?>
	</p>
    
	<div class="clear"></div>
    
    
   <p class="form-row form-row-last" id="billing_last_name_field" style="width: 464px;">
   	<i>You need to fill in the following fields <b>ONLY</b> if the information is on your card. <i/>
   </p> 
   <div class="clear"></div>
   <p>
   <b>NOTE:</b> Halifax, Bank of Scotland and Abbey customers do not need to enter an issue number.
   </p>
   <div class="clear"></div>
   <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 105px;">
        <label for="billing_first_name" class="">Card Start Date (If on card):  
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field">
     	<?php 
			$option	= array(''=>'Select Month','01'=>'January','02'=>'February' ,'03'=>' March' ,'04'=>'April' ,'05'=>'May' ,'06'=>'  June','07'=>'July' ,'08'=>'August' ,'09'=>'September' ,'10'=>'October' ,'11'=>'November' ,'12'=>'December');
			echo form_dropdown('select_month_if',$option,'', 'style="width: 100px;"');				
			$option	= array(''=>'Select Year','2013'=>'2013','2014'=>'2014' ,'2015'=>' 2015' ,'2016'=>'2016' ,'2017'=>'2017' ,'2018'=>' 2018','2019'=>'2019' ,'2020'=>'2020' ,'2021'=>'2021' ,'2022'=>'2022');
			echo form_dropdown('select_year_if',$option, '', 'style="width: 100px;"');
		?>
	</p>
   
   <div class="clear"></div>
     <p class="form-row form-row-first" id="billing_first_name_field" style="padding-left: 105px;">
        <label for="billing_first_name" class="">Card Issue No. (If on card):  
        
        </label>
	</p>
    
	<p class="form-row form-row-last" id="billing_last_name_field">
     	<?php 
			$data = array('id'=>'card_issu', 'class'=>'input-text', 'name'=>'card_issu','style'=>'width: 120px');
			echo form_input($data)
		?>
	</p>
   <div class="clear"></div>
 <input type="submit" value="<?php echo lang('form_continue');?>" class="btn btn-primary" style="height: 34px; width: 74px;" />  
 </div>    
 </form>
 </div>
</div>
</div>

</div>
	

<?php if($this->Customer_model->is_logged_in(false, false)) : ?>

<div class="modal hide" id="address_manager">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3><?php echo lang('your_addresses');?></h3>
	</div>
	<div class="modal-body">
		<p>
			<table class="table table-striped">
			<?php
			$c = 1;
			foreach($customer_addresses as $a):?>
				<tr>
					<td>
						<?php
						$b	= $a['field_data'];
						echo nl2br(format_address($b));
						?>
					</td>
					<td style="width:100px;"><input type="button" class="btn btn-primary choose_address pull-right" onClick="populate_address(<?php echo $a['id'];?>);" data-dismiss="modal" value="<?php echo lang('form_choose');?>" /></td>
				</tr>
			<?php endforeach;?>
			</table>
		</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Close</a>
	</div>
</div>
<?php endif;?>
</div>
</div>
</div>
</div>
<?php include_once('footer.php'); ?>
</body>
</html>