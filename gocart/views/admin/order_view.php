<div id="main" style="min-height:1000px">
<div class="container">
  <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
  <div id="main_container">
    <div class="row-fluid ">
      <div class="span12">
        <div class="box paint color_6">
          <div class="title">
            <h4> <i class=" icon-bar-chart"></i><span>Order View 
			<a class="btn" title="<?php echo lang('send_email_notification');?>" onclick="$('#notification_form').slideToggle();"><i class="icon-envelope"></i> <?php echo lang('send_email_notification');?></a>
			<a class="btn" href="<?php echo site_url('admin/order/packing_slip/'.$order->id);?>" target="_blank"><i class="icon-file"></i><?php echo lang('packing_slip');?></a>
			
			</span></h4>
            <div class="content top">
              <div class="row-fluid">
                <div class="span6">
                  <div class="box paint_hover color_12">
                    <div class="title">
                      <h3> <i class="icon-sitemap"></i> <span><?php echo lang('account_info');?></span> </h3>
                    </div>
                      <div class="content"> <?php echo (!empty($order->company))?$order->company.'<br>':'';?> <?php echo $order->firstname;?> <?php echo $order->lastname;?> <br/>
                      <?php echo $order->email;?> <br/>
                      <?php echo $order->phone;?> 
					 </div>
                  </div>
                  <!-- End .box -->
                </div>
                <div class="span6">
                  <div class="box paint_hover color_15">
                    <div class="title">
                      <h3> <i class="icon-sitemap"></i> <span><?php echo lang('billing_address');?></span> </h3>
                    </div>
                    <div class="content"> <?php echo (!empty($order->bill_company))?$order->bill_company.'<br/>':'';?> <?php echo $order->bill_firstname.' '.$order->bill_lastname;?> <br/>
                      <?php echo $order->bill_address1;?><br>
                      <?php echo (!empty($order->bill_address2))?$order->bill_address2.'<br/>':'';?> <?php echo $order->bill_city.', '.$order->bill_zone.' '.$order->bill_zip;?><br/>
                      <?php echo $order->bill_country;?><br/>
                      <?php echo $order->bill_email;?><br/>
                      <?php echo $order->bill_phone;?> </div>
                  </div>
                  <!-- End .box -->
                </div>
              </div>
			  <div class="row-fluid">
					<div class="span4">
						<h2><?php echo lang('order_details');?></h2>					
					</div>
					<div class="span4">
						<h2><?php echo lang('payment_method');?></h2>
						<p><?php echo $order->payment_info; ?></p>
					</div>					
				</div>
              <div class="row-fluid">
                <label class="control-label span1" for="text" style="width: 355px;">
                 <h3><?php echo lang('admin_notes');?></h3>
                <span class="help-block"></span>
                </label>
                <label class="control-label span1" for="hint-field" style="width: 328px;">
                <h3><?php echo lang('status');?></h3>
                <span class="help-block"></span>
                </label>
              </div>
			  <?php echo form_open($this->config->item('admin_folder').'/order/view/'.$order->id, 'class="form-inline"');?>
              <div class="row-fluid">
                <div class="controls span4">
                  <textarea id="text" rows="3" cols="5" class="row-fluid" name="notes"><?php echo $order->notes;?></textarea>
                </div>
                <div class="controls span4">
                  <?php
					echo form_dropdown('status', $this->config->item('order_statuses'), ucfirst($order->status), 'class="chzn-select"');
					?>
                </div>				
              </div>
			   <br />
				<input type="submit" class="btn btn-primary" value="<?php echo lang('update_order');?>"/>
			 
			  </form>
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th><?php echo lang('name');?></th>
					<th><?php echo lang('description');?></th>
                    <th><?php echo "Tax";?></th> 
					<th><?php echo lang('price')."(ex)";?></th>
					<th><?php echo lang('quantity');?></th>
					<th><?php echo lang('total');?></th>
                  </tr>
                </thead>
                <tbody>
				<?php foreach($order->contents as $orderkey=>$product):?>
				<tr>
					<td>
						<?php echo $product['name'];?>
						<?php echo (trim($product['sku']) != '')?'<br/><small>'.lang('sku').': '.$product['sku'].'</small>':'';?>
					</td>
					<td>
						<?php //echo $product['excerpt'];?>
						<?php
						
						// Print options
						if(isset($product['options']))
						{
							foreach($product['options'] as $name=>$value)
							{
								$name = explode('-', $name);
								$name = trim($name[0]);
								if(is_array($value))
								{
									echo '<div>'.$name.':<br/>';
									foreach($value as $item)
									{
										echo '- '.$item.'<br/>';
									}	
									echo "</div>";
								}
								else
								{
									echo '<div>'.$name.': '.$value.'</div>';
								}
							}
						}
						
						if(isset($product['gc_status'])) echo $product['gc_status'];
						?>
					</td>
                    <td><?php echo $order->tax.'%';?></td>
					<td><?php echo format_currency($product['price']);?></td>
					<td><?php echo $product['quantity'];?></td>
					<td><?php echo format_currency($product['price']*$product['quantity']);?></td>
				</tr>
				<?php endforeach;?>
			  </tbody>
			  <tfoot>
				<?php if($order->coupon_discount > 0):?>
				<tr>
					<td><strong><?php echo lang('coupon_discount');?></strong></td>
					<td colspan="3"></td>
					<td><?php echo format_currency(0-$order->coupon_discount); ?></td>
				</tr>
				<?php endif;?>
				
				<tr>
					<td><strong><?php echo lang('subtotal');?></strong></td>
					<td colspan="3"></td>
					<td><?php echo format_currency($order->subtotal); ?></td>
				</tr>
				 <tr>
                    <td><strong><?php echo 'Zone Rates (Delivery to GB):';?></strong></td>
                    <td colspan="3"></td>
                    <td><?php  ?></td>
                </tr>
                 <tr>
                    <td><strong><?php echo 'VAT + Export:';?></strong></td>
                    <td colspan="3"></td>
                    <td><?php  ?></td>
                </tr>
				<?php 
				$charges = @$order->custom_charges;
				if(!empty($charges))
				{
					foreach($charges as $name=>$price) : ?>
						
				<tr>
					<td><strong><?php echo $name?></strong></td>
					<td colspan="3"></td>
					<td><?php echo format_currency($price); ?></td>
				</tr>	
						
				<?php endforeach;
				}
				?>
				
				<tr>
					<td><h3><?php echo lang('total');?></h3></td>
					<td colspan="3"></td>
					<td><strong><?php echo format_currency($order->total); ?></strong></td>
				</tr>
			  </tfoot>
            </table>
              
            </div>
            <!-- End row-fluid -->
          </div>
          <!-- End .content -->
        </div>
        <!-- End box -->
      </div>
      <!-- End .span12 -->
    </div>
    <!-- End .row-fluid -->
  </div>
</div>
