<?php include('mainHeader.php'); ?>
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
<!--
--><div id="body-wrapper" >
<div id="body-wrapper-padding">
<?php include('header.php'); ?>
<? //Content Area Start ?>
<div class="page-header">
	<h2><?php echo lang('order_number');?>: <?php echo $order_id;?></h2>
</div>

<?php
// content defined in canned messages
echo $download_section;
?>

<div class="row">
	<div class="span4">
		<h3><?php echo lang('account_information');?></h3>
		<?php echo (!empty($customer['company']))?$customer['company'].'<br/>':'';?>
		<?php echo $customer['firstname'];?> <?php echo $customer['lastname'];?><br/>
		<?php echo $customer['email'];?> <br/>
		<?php echo $customer['phone'];?>
	</div>
	<?php
	$ship = $customer['ship_address'];
	$bill = $customer['bill_address'];
	?>

</div>



<table class="table table-bordered table-striped" style="margin-top:20px; width:100%;">
	
	
	<tfoot>
		<?php if($go_cart['group_discount'] > 0)  : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('group_discount');?></strong></td>
			<td align="left"><?php echo format_currency(0-$go_cart['group_discount']); ?></td>
		</tr>
		<?php endif; ?>

		<tr>
			<td colspan="5"><strong><?php echo lang('subtotal');?></strong></td>
			<td align="left"><?php echo format_currency($go_cart['subtotal']); ?></td>
		</tr>
		
		<?php if($go_cart['coupon_discount'] > 0)  : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('coupon_discount');?></strong></td>
			<td align="left"><?php echo format_currency(0-$go_cart['coupon_discount']); ?></td>
		</tr>

		<?php if($go_cart['order_tax'] != 0) : // Only show a discount subtotal if we still have taxes to add (to show what the tax is calculated from) ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('discounted_subtotal');?></strong></td>
			<td align="left"><?php echo format_currency($go_cart['discounted_subtotal']); ?></td>
		</tr>
		<?php endif;

		endif; ?>
		<?php // Show shipping cost if added before taxes
		if($this->config->item('tax_shipping') && $go_cart['shipping_cost']>0) : ?>
		<tr>
			<td colspan="5"><strong><?php echo lang('shipping');?></strong></td>
			<td align="left"><?php echo format_currency($go_cart['shipping_cost']); ?></td>
		</tr>
		<?php endif ?>
		
		<?php if($go_cart['order_tax'] != 0) : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('taxes');?></strong></td>
			<td align="left"><?php echo format_currency($go_cart['order_tax']); ?></td>
		</tr>
		<?php endif;?>
		
		<?php // Show shipping cost if added after taxes
		if(!$this->config->item('tax_shipping') && $go_cart['shipping_cost']>0) : ?>
		<tr>
			<td colspan="5"><strong><?php echo lang('shipping');?></strong></td>
			<td align="left"><?php echo format_currency($go_cart['shipping_cost']); ?></td>
		</tr>
		<?php endif;?>
		
		<?php if($go_cart['gift_card_discount'] != 0) : ?> 
		<tr>
			<td colspan="5"><strong><?php echo lang('gift_card');?></strong></td>
			<td><?php echo format_currency(0-$go_cart['gift_card_discount']); ?></td>
		</tr>
		<?php endif;?>
		<tr>
			<td colspan="5"><strong><?php echo "Zone Rate:";?></strong></td>
			<td align="left"><?php echo " "; ?></td>
		</tr>
		<tr> 
			<td colspan="5"><strong><?php echo lang('grand_total');?></strong></td>
			<td align="left"><?php echo format_currency($go_cart['total']); ?></td>
		</tr>
	</tfoot>

	
</table>
</div>
</div>
<!------------------------- pay pal info div   ------------------->
				<style>
				input#paypal{height:33px; width:255px; margin:-22px 0 0 250px;}
				input#paypal1{height:33px; width:95px; margin:-22px 0 0 250px;}
				select#paypal{height:33px; width:250px; margin:-22px 0 0 173px;}
				select#month{height:33px; width:120px; margin:-22px 0 0 126px;}
				select#month1{height:33px; width:120px; margin:-22px 0 0 61px;}
				select#year{height:33px; width:110px; margin:-22px 0 0 20px;}
				</style>
				<?php 
$r_checkout = array('id'=>'', 'calss'=>'', 'checked' => TRUE, 'name'=>'name');
$r_checkout1 = array('id'=>'', 'calss'=>'', 'checked' => FALSE, 'name'=>'name1');
$options = array('small'  => 'Small Shirt','med'    => 'Medium Shirt','large'   => 'Large Shirt','xlarge' => 'Extra Large Shirt');
?>
<div class="row">
	<h2>Payment Method</h2>
	<h4> Please Select The Payment Method For This Order</h4>
	<div>
		<?php echo form_radio($r_checkout)." ";?> <img src="paypal.jpg" /> <?php echo "<i>Checkout With PayPal</i>";?>
	</div>
	<div style="padding-top: 10px"> </div>
	<div>
		<?php echo form_radio($r_checkout1)." "."<b>Crebit/Debit Card (Secured by Protx)</b>";?>
	</div>
	<div style="padding-top: 10px"> </div>
	<div style="margin-left: 49px;">
		<div>
			<i style='font-size:16px;'>Card Accepted:</i>
		</div>
		<div style="padding-top: 10px"> </div>
		<div>
			<i style='font-size:16px;'>Card Owner:</i>
			 <input name="email" class="input-text" id="paypal" type="text">
		</div>
		<div style="padding-top: 10px"> </div>
		<div>
			<i style='font-size:16px;'>Card Type:</i>
			<select id="paypal">
				<option> select card type</option>
				<option> select card type1</option>
				<option> select card type2</option>
			</select>
		</div>
		<div style="padding-top: 30px"> </div>
		<div>
			<i style='font-size:16px;'>Card Number:</i>
			<input name="email" class="input-text" id="paypal" type="text">
		</div>
		<div style="padding-top: 10px"> </div>
		<div>
			<i style='font-size:16px;'>Card Ecpiry Date:</i>
			<select id="month">
				<option> Month</option>
				<option> 1</option>
				<option> 2</option>
			</select>
			<select id="year">
				<option> Year</option>
				<option>1</option>
				<option>2</option>
			</select>
		</div>
		<div style="padding-top: 30px"> </div>
		<div>
			<i style='font-size:16px;'>CVV Number(More info):</i>
			<input name="email" class="input-text" id="paypal1" type="text">
		</div>
	</div>
	<div style="padding-top: 10px"> </div>
	<i style="margin-left: 300px;">you need to fill in the follwoing fields ONLY if the information is on your card.</i><br/>
	<b>NOTE:</b><font>Halifax, Bank of Scotland and Abbey customer do not need  to enter an issue number.</font>
	<div style="padding-top: 10px"> </div>
	<div style="margin-left: 49px;">
		<div>
			<i style='font-size:16px;'>Card Start Date(If on card):</i>
			<select id="month1">
				<option> Month</option>
				<option> 1</option>
				<option> 2</option>
			</select>
			<select id="year">
				<option> Year</option>
				<option>1</option>
				<option>2</option>
			</select>
		</div>
		<div style="padding-top: 30px"> </div>
		<div>
			<i style='font-size:16px;'>Card Issue No.(If on card):</i>
			<input type="text" name="" id="paypal1" class="">
		</div>
	</div>
	
</div>
<div style="padding-top: 30px"> </div>
<?php include_once('footer.php'); ?>
</body>
</html>
