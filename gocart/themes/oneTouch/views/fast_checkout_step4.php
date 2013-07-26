 <?php include('mainHeader.php'); ?>  

        <script> var customStyleImgUrl = "images/custom-slider-img";</script>
          <?php //include('leftPanel.php'); ?>
<!--        
-->		
        <div id="body-wrapper" >		
            <div id="body-wrapper-padding">			
                <!--[if lt IE 7]>
                <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
                browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
                experience this site.
                </div><![endif]-->
                 <?php  include('header.php'); ?> 
                 <?php $last			= array('id'=>'billing_last_name','class'=>'input-text','placeholder'=>'Last Name','name'=>'lastname','value'=> set_value('lastname'));?>
                <!--===================main content start=======================-->
 <div class="row">
    <h1 class="page-title" style="margin-left:20px;">
	<a class="black" href="javascript:void(0)">STEP 4 OF 4 - DELIVERY INFORMATION</a>
	</h1>
   
</div>
<div class="row">
<div class="fifteen columns delivery_information">
  <h3></h3>
  <div class="six columns">
  <h4>Billing Information</h4>
  <br/>
 <p><?php echo $firstname." ".$lastname;?></p>
 
<p style="margin-top:-15px  !important;"> <?php echo $street_address;?></p>
 <p style="margin-top:-15px !important;"><?php echo $address_line2;?></p>
 <p style="margin-top:-15px !important;"><?php echo $city." ".$post_code;?></p>
<p style="margin-top:-15px !important;"> <?php echo $state." ".$country_id;?></p>
<a href="<?php echo base_url()."shipping_order/shiping_order_step3";?>"><input type="button" class="button" value="Change Address"/></a>
  </div>
  <!--<div class="one columns">
  <br/>
  <a href="<?php echo base_url()."shipping_order/shiping_order_step1";?>"><input type="button" class="button" value="Change Address"/></a>
  </div>-->
  <div class="six columns" style="margin-right: 120px;">
  <h4>Delivery Information</h4>
   <p><?php echo $firstname." ".$lastname;?></p>
 
<p style="margin-top:-15px  !important;"> <?php echo $street_address;?></p>
 <p style="margin-top:-15px !important;"><?php echo $address_line2;?></p>
 <p style="margin-top:-15px !important;"><?php echo $city." ".$post_code;?></p>
<p style="margin-top:-15px !important;"> <?php echo $state." ".$country_id;?></p>
<a href="<?php echo base_url()."shipping_order/shiping_order_step3";?>"><input type="button" class="button" value="Change Address"/></a>
  </div>
  </div>
 
  
  
  <div class="fifteen columns" style="float: left;">
  <div class="col2-set" id="customer_details">
   <br/>
  
  <div class="row">
 <div>
  		<h4>Special Instructions or Comments  Your Order</h4>
       <p><?php echo $instraction;?></p>
        <div align="right">
        <a class="button" href="<?php echo  base_url()."shipping_order/shiping_order_step2"; ?>">Edit</a>
        </div>
  </div>
  </div>
<div class="row">
<div id="content" class="fifteen columns">
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
            <tr class="total">
				<th colspan="2"><strong>Edit Cart</strong></th>
				<td><strong><span class=""><a href="<?php echo base_url()."cart/view_cart";?>" class="button">Edit Cart</a></span></strong></td>
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
    <p><b>Final Step</b> - continue to confirm your order. Thank you!</p>
    <div align="right" style="margin-bottom: 20px;">
    
    <a href="<?php echo base_url()."checkout/place_order";?>" class="button"> Confirm Address</a>
    
    </div>
</div>
</div>  
  
  

 
  
  

 
  </div>
</div>

                <!--===================main content start=======================-->
            </div>
        </div>
        

        <?php include_once('footer.php'); ?> 
        
       
  
