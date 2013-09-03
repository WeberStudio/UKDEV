<table class="table table-striped table-bordered">
    <thead>
    <thead>
        <tr>
            <th style="width:10%;"><?php echo lang('sku');?></th>
            <th style="width:20%;"><?php echo lang('name');?></th>
            <th style="width:10%;"><?php echo lang('price');?></th>
            <th><?php echo lang('description');?></th>
            <th style="width:10%;"><?php echo lang('quantity');?></th>
            <th style="width:8%;"><?php echo lang('totals');?></th>
        </tr>
    </thead>
    </thead>

    <tfoot>
        <?php
            /**************************************************************
            Subtotal Calculations
            **************************************************************/
        ?>
        <?php if($this->go_cart->group_discount() > 0)  : ?> 
            <tr>
                <td colspan="5"><strong><?php echo lang('group_discount');?></strong></td>
                <td><?php echo format_currency(0-$this->go_cart->group_discount()); ?>                </td>
            </tr>
            <?php endif; ?>
        <tr>
            <td colspan="5"><strong><?php echo lang('subtotal');?></strong></td>
            <td id="gc_subtotal_price"><?php echo format_currency($this->go_cart->subtotal()); ?></td>
        </tr>


        <?php if($this->go_cart->coupon_discount() > 0) {?>
            <tr>
                <td colspan="5"><strong><?php echo lang('coupon_discount');?></strong></td>
                <td id="gc_coupon_discount">-<?php echo format_currency($this->go_cart->coupon_discount());?></td>
            </tr>
            <?php if($this->go_cart->order_tax() != 0) { // Only show a discount subtotal if we still have taxes to add (to show what the tax is calculated from)?> 
                <tr>
                    <td colspan="5"><strong><?php echo lang('discounted_subtotal');?></strong></td>
                    <td id="gc_coupon_discount"><?php echo format_currency($this->go_cart->discounted_subtotal());?></td>
                </tr>
                <?php
                }
            } 
            /**************************************************************
            Custom charges
            **************************************************************/
            $charges = $this->go_cart->get_custom_charges();
            if(!empty($charges))
            {
                foreach($charges as $name=>$price) : ?>

                <tr>
                    <td colspan="5"><strong><?php echo $name?></strong></td>
                    <td><?php echo format_currency($price); ?></td>
                </tr>	

                <?php endforeach;
            }	

            /**************************************************************
            Order Taxes
            **************************************************************/
            // Show shipping cost if added before taxes
            if($this->config->item('tax_shipping') && $this->go_cart->shipping_cost()>0) : ?>
            <tr>
                <td colspan="5"><strong><?php echo lang('shipping');?></strong></td>
                <td><?php echo format_currency($this->go_cart->shipping_cost()); ?></td>
            </tr>
            <?php endif;
            if($this->go_cart->order_tax() > 0) :  ?>
            <tr>
                <td colspan="5"><strong><?php echo lang('tax');?></strong></td>
                <td><?php echo format_currency($this->go_cart->order_tax());?></td>
            </tr>
            <?php endif; 
            // Show shipping cost if added after taxes
            if(!$this->config->item('tax_shipping') && $this->go_cart->shipping_cost()>0) : ?>
            <tr>
                <td colspan="5"><strong><?php echo lang('shipping');?></strong></td>
                <td><?php echo format_currency($this->go_cart->shipping_cost()); ?></td>
            </tr>
            <?php endif ?>

        <?php
            /**************************************************************
            Gift Cards
            **************************************************************/
            if($this->go_cart->gift_card_discount() > 0) : ?>
            <tr>
                <td colspan="5"><strong><?php echo lang('gift_card_discount');?></strong></td>
                <td>-<?php echo format_currency($this->go_cart->gift_card_discount()); ?></td>
            </tr>
            <?php endif; ?>

        <?php
            /**************************************************************
            Grand Total
            **************************************************************/
        ?>
        <tr>
            <td colspan="5"><strong><?php echo lang('grand_total');?></strong></td>
            <td><?php echo format_currency($this->go_cart->total()); ?></td>
        </tr>
    </tfoot>

    <tbody>
        <?php
            $subtotal = 0;

            foreach ($this->go_cart->contents() as $cartkey=>$product):?>
            <tr>
                <td><?php echo $product['sku']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo format_currency($product['price']);?></td>
                <td>
                    
                </td>

                <td style="white-space:nowrap">
                    <?php if($this->uri->segment(1) == 'cart'): ?>
                        <?php if(!(bool)$product['fixed_quantity']):?>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-append">
                                        <input class="span1" style="margin:0px;" name="cartkey[<?php echo $cartkey;?>]"  value="<?php echo $product['quantity'] ?>" size="3" type="text"><button class="btn btn-danger" type="button" onclick="if(confirm('<?php echo lang('remove_item');?>')){window.location='<?php echo site_url('cart/remove_item/'.$cartkey);?>';}"><i class="icon-remove icon-white"></i></button>
                                    </div>
                                </div>
                            </div>
                            <?php else:?>
                            <?php echo $product['quantity'] ?>
                            <input type="hidden" name="cartkey[<?php echo $cartkey;?>]" value="1"/>
                            <button class="btn btn-danger" type="button" ><i class="icon-remove icon-white"></i></button>
                            <?php endif;?>
                        <?php else: ?>
                        <?php echo $product['quantity'] ?>
                        <?php endif;?>
                </td>
                <td><?php echo format_currency($product['price']*$product['quantity']); ?></td>
            </tr>
            <?php endforeach;?>
    </tbody>
</table>

<div class="row">

    <div id="content" class="fifteen columns">

        <div class="row-fluid">
            <div class="wpb_content_element span12 wpb_text_column">
                <div class="wpb_wrapper">



                    <form action="./Cart   OneTouch_files/Cart   OneTouch.htm" method="post">
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
                                        <a href="#"  class="remove" title="Remove this item">×</a>                        </td>

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
                                        <div class="quantity buttons_added"><input type="button" value="-" class="minus"><input name="cart[1efa39bcaec6f3900149160693694536][qty]" data-min="" data-max="0" value="<?php echo $product['quantity'] ?>" size="4" title="Qty" class="input-text qty text" maxlength="12"><input type="button" value="+" class="plus"></div>                        </td>

                                        <!-- Product subtotal -->
                                        <td class="product-subtotal">
                                        <span class="amount"><?php echo format_currency($product['price']*$product['quantity']); ?></span>                        </td>
                                    </tr>
                                    <?php endforeach;?>    
                                <tr>

                                    <td colspan="6" class="actions">

                                        <div class="coupon">

                                            <label for="coupon_code">Coupon:</label> <input name="coupon_code" class="input-text" id="coupon_code" value=""> <input type="submit" class="button" name="apply_coupon" value="Apply Coupon">


                                        </div>

                                        <input type="submit" class="button" name="update_cart" value="Update Cart"> <input type="submit" class="checkout-button button alt" name="proceed" value="Proceed to Checkout →">


                                    <input type="hidden" id="_n" name="_n" value="727f0214be"><input type="hidden" name="_wp_http_referer" value="/onetouch/cart/">            </td>
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
                                        <th><strong>Cart Subtotal</strong></th>
                                        <td><strong><span class="amount"><?php echo format_currency($this->go_cart->subtotal()); ?></span></strong></td>
                                    </tr>
                                      

                                    <tr class="total">
                                        <th><strong>Order Total</strong></th>
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