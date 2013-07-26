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
	<a class="black" href="javascript:void(0)">STEP 2 OF 4 - DELIVERY INFORMATION</a>
	</h1>
   
</div>
<div class="row">
<div class="forteen columns delivery_information">
  <h3>Delivery Information:</h3>
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
  <input type="button" class="button" value="Change Address"/>
  </div>
  <div class="six columns" style="margin-right: 120px;"><p> <b>Your order will be delivered to the address at the left or you may change the delivery address by clicking the Change Address button.</b></p>
  </div>
  </div>
  <div class="fifteen columns" style="float: left;">
  <div class="col2-set" id="customer_details">
  
  
  
  
  
  <?php echo form_open('Shipping_order/shiping_order_step2'); ?>
  <h3>Delivery Method:</h3>
  <p style="margin-left: -10px; margin-top: -15px;">
  <b>This is currently the only delivery method available to use on this order.</b>
  </p>
  
  <h4>Zone Rates</h4>
  
  <?php
  if(!empty($delivery_price)){ 
  $i=1;
  foreach($delivery_price as $d_price){?>
  <div>
  <p class="form-row form-row-first" id="billing_last_name_field">
         <input type="radio" checked/> Delivery to GB of product <?php echo $i?> 
         <b>
		 <?php
		 if($d_price['delivery_price']=="" &&empty($d_price['delivery_price']))
		 {
			 echo "0";
		}
		 else{echo $d_price['delivery_price'];}
		 ?>
         </b>
          </p>
   </div>
   <?php
   $i++;
    }}?>
 
  <br/>
  <div>
  		<h4>Special Instructions or Comments About Your Order</h4>
        <textarea rows="5" cols="5"></textarea>
  </div>
  <input type="submit" name="" value="continue">
  </form>
  </div>
</div>

                <!--===================main content start=======================-->
            </div>
        </div>
        

        <?php include_once('footer.php'); ?> 
        
       
  
