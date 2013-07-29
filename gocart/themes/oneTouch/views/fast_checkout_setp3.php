<?php include('mainHeader.php'); ?> 
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">

<div id="body-wrapper" >
<div id="body-wrapper-padding">
<?php include('header.php'); ?>
<? //Content Area Start ?>


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
//$company	= array('id'=>'company', 'class'=>'input-text', 'name'=>'company', 'value'=> set_value('company', $customer['company']));
/*$first		= array('id'=>'firstname', 'class'=>'input-text', 'name'=>'firstname', 'value'=> set_value('firstname', $customer['firstname']));
$f_city		= array('id'=>'f_city', 'class'=>'input-text', 'name'=>'city', 'value'=>set_value('city',$customer['city']));
$f_zip		= array('id'=>'f_zip', 'maxlength'=>'10', 'class'=>'input-text', 'name'=>'zip', 'value'=> set_value('zip', $customer['post_code']));
$f_address1	= array('id'=>'f_address1', 'class'=>'input-text', 'name'=>'address1', 'value'=>set_value('address1', $customer['street_address']));
$f_address2	= array('id'=>'f_address2', 'class'=>'input-text', 'name'=>'address2', 'value'=> set_value('address2', $customer['address_line2']));
$last		= array('id'=>'lastname', 'class'=>'input-text', 'name'=>'lastname', 'value'=> set_value('lastname', $customer['lastname']));
$email		= array('id'=>'email', 'class'=>'input-text', 'name'=>'email', 'value'=> set_value('email', $customer['email']));
$phone		= array('id'=>'phone', 'class'=>'input-text', 'name'=>'phone', 'value'=> set_value('phone', $customer['telephone']));
$password 	= array('id'=>'password','name'=>'password','class'=>'input-text','placeholder'=>'Password'); 
$con_password 	= array('id'=>'confirm','name'=>'confirm','class'=>'input-text','placeholder'=>'Confirm'); */

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
	
	<div class="row">
    <div class="forteen columns delivery_information">
  <h3>Billing Address:</h3>
  <div class="five columns">
  <br/>
 <p><?php echo $firstname." ".$lastname;?></p>
 
<p style="margin-top:-15px  !important;"> <?php echo $street_address;?></p>
 <p style="margin-top:-15px !important;"><?php echo $address_line2;?></p>
 <p style="margin-top:-15px !important;"><?php echo $city." ".$post_code;?></p>
<p style="margin-top:-15px !important;"> <?php echo $state." ".$country_id;?></p>
  </div>
  <div class="one columns">
  <br/>
  <a href="<?php echo base_url()."shipping_order/shiping_order_step1";?>"><input type="button" class="button" value="Change Address"/></a>
  </div>
  <div class="six columns" style="margin-right: 120px;"><p> <b>Your order will be delivered to the address at the left or you may change the delivery address by clicking the Change Address button.</b></p>
  </div>
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
            <tr class="cart-subtotal">
				<th colspan="2"><strong>Zone Rates (Delivery to GB)</strong></th>
				<td><?php echo format_currency(0.00); ?></td>
			</tr>
            <tr class="cart-subtotal">
				<th colspan="2"><strong>VAT + Export</strong></th>
				<td><?php echo format_currency($this->go_cart->subtotal()-($this->go_cart->subtotal()/1.2)); ?></td>
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
        <a href="<?php echo base_url()."shipping_order/shiping_order_step4";?>"><input type="button" class="button" value="Countnue"></a>    
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
<div class="row">
 <div>
  		<h4>Special Instructions or Comments About Your Order</h4>
        <?php $instructions	= array('id'=>'', 'class'=>'input-text', 'name'=>'instructions', 'value'=>set_value('instructions',$instraction));
		
		echo form_textarea($instructions);
		?>
       
  </div>
  
  <!--<p class="form-row " id="billing_company_field">
        <input type="submit" value="Continue " class="button" name="continue" style="height: 34px; width: 74px;" />
		</p>-->
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
<?php include_once('footer.php'); ?>
</body>
</html>