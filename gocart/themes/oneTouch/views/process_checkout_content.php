<div class="row">
    <h1 class="page-title" style="margin-left:85px;">
	<a class="" href="javascript:void(0)">you can login here</a>
	</h1>
</div>
<div class="row">
    <div class="line"> </div>
</div>
	
		
	<div class="row">
        <h3>Welcome, Please Sign In</h3>
<div id="content" class="fifteen columns">
<div class="col2-set" id="customer_details">
				<div class="col-1" >
            
				
    <div>
    <p>
	<b>Checkout Without An Account</b>
	<p>
	<i>For a faster checkout experience, we offer the option to checkout without creating an account.</i>
	</p>
	</p>
	<p align="right">
	<!--<input class="submitbutton" name="submitted" id="wp-submit" value="Continue" type="submit">--> 
    <a class="button" href="<?php echo base_url()."shipping_order/shiping_order_step1";?>">Continue →</a> 
	</p>
	</div>
		
	<div class="clear"></div>
    <div class="nine columns">
	 <div class="widget-inner">
        <h3>Customer Login</h3>
        
        <?php echo form_open('secure/login', 'class=""'); ?>
        <form class="bs-docs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url()?>secure/process_checkout">
          <p>
            <label for="user_login">Username or email</label>
            <input name="email" class="input-text" id="user_login" type="text">
          </p>
          <p>
            <label for="user_pass">Password</label>
            <input name="password" class="input-text" id="user_pass" type="password">
          </p>
          <p>
            <input class="submitbutton" name="submitted" id="wp-submit" value="Login ?" type="submit">
            <a href="<?php echo site_url('secure/forgot_password');?>">Lost password?</a></p>
          <div>
            <input name="redirect_to" class="redirect_to" value="" type="hidden">
            <input name="testcookie" value="1" type="hidden">
            <input name="woocommerce_login" value="1" type="hidden">
            <input name="rememberme" value="forever" type="hidden">
            <input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
			<input type="hidden" value="submitted" name="submitted"/>
          </div>
        </form>
       
      </div>
   
	</div>
	</div>
	
	<div class="col-2">
	<p class="form-row" id="shiptobilling">
		<b>Create Account</b>
	</p>
	<p>
		<i>Have a PayPal account? Want to pay quickly with a credit card? Use the PayPal button below to use the Express Checkout option.</i>
	</p>
	<p align="right">
		<!--<input class="submitbutton" name="submitted" id="wp-submit" value="PayPal" type="submit">  -->
        <a class="button" target="_blank" href="https://www.paypal.com">PayPal </a>
	</p>
	<div class="line"> </div>
	<p>
		<b>Or</b>
	</p>
	<p>
		<i>Create a Customer Profile with <b>UK Open College</b> which allows you to shop faster, track the status of your current orders, review your previous orders and take advantage of our other member's benefits.</i>
	</p>
	<p align="right">
		<input class="submitbutton" name="submitted" id="wp-submit" value="Sign Up" type="submit" onclick='window.location="<?=base_url();?>secure/register"'>
	</p>
	</div>
	
    	</div>
	</div>
  </div>
 