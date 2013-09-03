

<?php if ($this->go_cart->total_items()==0):?>
    <div class="alert alert-info">
        <a class="close" data-dismiss="alert">*</a>
        <?php echo lang('empty_view_cart');?>
    </div>
    <?php else: ?>


    <div class="row">
        <div class="fifteen columns" id="page-title" style="">
            <a class="back" href="javascript:history.back()"></a>
            <div class="subtitle">
            </div>

            <h1 class="page-title" style="margin-left: 10px;">
                Cart 
               <span style="float: right;"> 
                    <div class="sort-panel">  
                   <ul class="filter clearfix">
                   <li>
                   <a href="<?=base_url()?>cart/allcourses/" rel="nofollow" data-product_id="868" class="button" style=" width:180px;">  All Courses </a>
                    </li>
                   </ul>
                   </div>
                   </span> 
           </h1>
      
            <div class="breadcrumbs"><!-- <span class="delim">/ </span>Cart--> </div>


        </div>

        <div class="fifteen columns"><div class="line"> </div></div>

    </div>
<!--===============validation start=======-->
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
<!--===============validation end=========-->
    <div class="row">

        <div id="content" class="fifteen columns">

            <div class="row-fluid">
                <div class="wpb_content_element span12 wpb_text_column">
                    <div class="wpb_wrapper">



                        <?php echo form_open('cart/update_cart', array('id'=>'update_cart_form'));?>   
                        <table class="shop_table cart" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>   
                                </tr>
                            </thead>
                            <tbody>


                                <?php

                                    $subtotal = 0;

                                    foreach ($this->go_cart->contents() as $cartkey=>$product):?>
                                    <tr class="cart_table_item">
                                        <!-- Remove from cart link -->
                                        <td class="product-remove">
                                        <a href="#" onclick="if(confirm('<?php echo lang('remove_item');?>')){window.location='<?php echo site_url('cart/remove_item/'.$cartkey);?>';}" class="remove" title="Remove this item">×</a>                        </td>

                                        <!-- The thumbnail -->
                                        <td class="product-thumbnail">
                                        <a href="#"><img width="200" height="200" src="<?=base_url('uploads/images/thumbnails/'.$product['images'])?>" class="attachment-shop_thumbnail wp-post-image" alt="746868-1"></a>                        </td>

                                        <!-- Product Name -->
                                        <td class="product-name">
                                            <a href="#"><?php echo $product['name']; ?></a>     
                                        </td>

                                        <!-- Product price -->
                                        <td class="product-price">
                                        <span class="amount"><?php echo format_currency($product['price']);?></span>                        </td>

                                        <!-- Quantity inputs -->
                                        <td class="product-quantity">
                                        <div class="quantity buttons_added"><input type="button" value="-" class="minus"><input name="cartkey[<?php echo $cartkey;?>]" data-min="" data-max="0" value="<?php echo $product['quantity'] ?>" size="4" title="Qty" class="input-text qty text" maxlength="12"><input type="button" value="+" class="plus"></div>                        </td>

                                        <!-- Product subtotal -->
                                        <td class="product-subtotal">
                                        <span class="amount"><?php echo format_currency($product['price']*$product['quantity']); ?></span>                        </td>
                                    </tr>
                                    <?php endforeach;?>    
                                <tr>

                                    <td colspan="6" class="actions">

                                        <div class="two columns bottomPad10"><div class="coupon">

                                            <label for="coupon_code">Coupon:</label> <input name="coupon_code" class="input-text" id="coupon_code" value=""> <input type="submit" class="button" name="apply_coupon" value="Apply Coupon">


                                        </div></div>
										<div class="eleven columns buttons-style1">
                                        <div class="row">
                                        
                                        <div class="two columns bottomPad10"><a class="button" name="proceed" href="<?=base_url()?>cart/allcourses/" > Continue to Shopping</a></div>
                                          
                                      <!--<input type="button" class="button" name="proceed" onclick ="window.location='<?=base_url()?>cart/allcourses/'" value="Continue to Shopping">--> 
									   <div class="two columns bottomPad10"><input type="submit" class="button" name="update_cart" value="Update Cart"></div> 
									    <!--<input type="button" class="checkout-button button alt" name="proceed" value="Proceed to Checkout →"  onclick='window.location="<?=base_url()?>checkout";'>-->
                                        <div class="two columns bottomPad10"><a class="checkout-button button alt" name="proceed" href="<?=base_url()?>checkout"  >Proceed to Checkout →</a></div> 
                                        <div class="two columns bottomPad10"><img src="<?php echo theme_img('pay_cards/btn_xpressCheckout.gif');?>"   alt="Click here to pay via PayPal Express Checkout" style="cursor: pointer; width:145px;"  onclick='window.location="<?=base_url()?>checkout/place_order";'> </div>
										<!--<input type="button" class="button" name="proceed" onclick ="window.location='<?=base_url()?>checkout/place_order'" value="PayPal">-->     


                                    <input type="hidden" id="_n" name="_n" value="727f0214be"><input type="hidden" name="_wp_http_referer" value="/onetouch/cart/"></div></div>            </td>
                                </tr>

                            </tbody>

                        </table>
                        </form>
                        <div class="cart-collaterals">


                            <div class="cart_totals calculated_shipping">



                                <h2>Cart Totals</h2>
                                <table cellspacing="0" cellpadding="0">
                                    <tbody>

                                        <tr class="cart-subtotal">
                                            <th colspan="5"><strong>Cart Subtotal</strong></th>
                                            <td><strong><span class="amount"><?php echo format_currency($this->go_cart->subtotal()); ?></span></strong></td>
                                        </tr>
                                        <?php if($this->go_cart->coupon_discount() > 0) {?>
                                            <tr>
                                                <td colspan="5"><strong><?php echo lang('coupon_discount');?></strong></td>
                                                <td id="gc_coupon_discount"><strong><span class="amount">-<?php echo format_currency($this->go_cart->coupon_discount());?></span></strong></td>
                                            </tr>
                                            <?php if($this->go_cart->order_tax() != 0) { // Only show a discount subtotal if we still have taxes to add (to show what the tax is calculated from)?> 
                                                <tr>
                                                    <td colspan="5"><strong><?php echo lang('discounted_subtotal');?></strong></td>
                                                    <td id="gc_coupon_discount"><?php echo format_currency($this->go_cart->discounted_subtotal());?></td>
                                                </tr>
                                                <?php
                                                }
                                        } 
                                    ?>

                                    <tr class="total">
                                        <th colspan="5"><strong>Order Total</strong></th>
                                        <td><strong><span class="amount"><?php echo format_currency($this->go_cart->total()); ?></span></strong></td>
                                    </tr>

                                </tbody>
                            </table>




                        </div>





                    </div>
                </div> 
            </div> 
        </div>
    </div>
</div>  

<!--	<div class="row">

<div class="span7" style="text-align:right; width:1000px;">
<input id="redirect_path" type="hidden" name="redirect" value=""/>

<?php if(!$this->Customer_model->is_logged_in(false,false)): ?>
    <input class="add_to_cart_button button product_type_simple" type="button" onclick='window.location="http://localhost/UKOpenColleges/secure/login";' value="<?php echo lang('login');?>"/>
    <input class="add_to_cart_button button product_type_simple" type="button" onclick='window.location="http://localhost/UKOpenColleges/secure/register";' value="<?php echo lang('register_now');?>"/>
    <?php endif; ?>
<input class="add_to_cart_button button product_type_simple" type="submit" value="<?php echo lang('form_update_cart');?>"/>

<?php if ($this->Customer_model->is_logged_in(false,false) || !$this->config->item('require_login')): ?>
    <input class="single_add_to_cart_button button alt" type="button"  onclick='window.location="http://localhost/UKOpenColleges/checkout";' value="<?php echo lang('form_checkout');?>"/>
    <?php endif; ?>
			
		</div>
	</div>     -->      

<?php endif; ?>