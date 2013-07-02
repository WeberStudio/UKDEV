<div style="font-size:12px; font-family:arial, verdana, sans-serif;">
	<?php if ($this->config->item('site_logo')) :?>
	<div>
		<?php /*?><img src="<?php echo base_url($this->config->item('site_logo'));?>" /><?php */?>
		<h1>UK OPEN COLLEGE</h1>
	</div>
	<?php endif; ?>
	
	<table style="border:1px solid #000; width:100%; font-size:13px;" cellpadding="5" cellspacing="0">
		<tr>
			<td style="width:20%; vertical-align:top;" class="packing">
				<h2 style="margin:0px">*<?php echo $order->order_number;?>*</h2>
				<?php if(!empty($order->is_gift)):?>
					<h1 style="margin:0px; font-size:4em;"><?php echo lang('packing_is_gift');?></h1>
				<?php endif;?>
			</td>
			<td style="width:40%; vertical-align:top;">
				<strong><?php echo lang('bill_to_address');?></strong><br/>
				 <?php echo (!empty($order->bill_company))?$order->bill_company.'<br/>':'';?>
				<?php echo $order->bill_firstname.' '.$order->bill_lastname;?> <br/>
				<?php echo $order->bill_address1;?><br>
				<?php echo (!empty($order->bill_address2))?$order->bill_address2.'<br/>':'';?>
				<?php echo $order->bill_city.', '.$order->bill_zone.' '.$order->bill_zip;?><br/>
				<?php echo $order->bill_country;?><br/>

				<?php echo $order->bill_email;?><br/>
				<?php echo $order->bill_phone;?>

			</td>
			<?php /*?><td style="width:40%; vertical-align:top;" class="packing">
				<strong><?php echo lang('ship_to_address');?></strong><br/>		
				<?php echo (!empty($order->ship_company))?$order->ship_company.'<br/>':'';?>
				<?php echo $order->ship_firstname.' '.$order->ship_lastname;?> <br/>
				<?php echo $order->ship_address1;?><br>
				<?php echo (!empty($order->ship_address2))?$order->ship_address2.'<br/>':'';?>
				<?php echo $order->ship_city.', '.$order->ship_zone.' '.$order->ship_zip;?><br/>
				<?php echo $order->ship_country;?><br/>

				<?php echo $order->ship_email;?><br/>
				<?php echo $order->ship_phone;?>

			<br/>
			</td><?php */?>
			<td style="width:40%; vertical-align:top;" class="packing">				
				<strong><?php echo lang('status');?></strong>
				<?php echo $order->status; ?>
			</td>
		</tr>
		
		<tr>
			<td style="border-top:1px solid #000;"></td>
			<td style="border-top:1px solid #000;">
				<strong><?php echo lang('payment_method');?></strong>
				<?php echo $order->payment_info; ?>
			</td>
			<td style="border-top:1px solid #000;">
				<strong><?php echo lang('shipping_details');?></strong>
				<?php echo $order->shipping_method; ?>
			</td>
		</tr>
		
		<?php if(!empty($order->gift_message)):?>
		<tr>
			<td colspan="3" style="border-top:1px solid #000;">
				<strong><?php echo lang('gift_note');?></strong>
				<?php echo $order->gift_message;?>
			</td>
		</tr>
		<?php endif;?>
		
		<?php if(!empty($order->notes)):?>
			<tr>
				<td colspan="3" style="border-top:1px solid #000;">
					<strong><?php echo lang('notes');?></strong><br/><?php echo $order->notes;?>
				</td>
			</tr>
		<?php endif;?>
	</table>
	
	<table border="1" style="width:100%; margin-top:10px; border-color:#000; font-size:13px; border-collapse:collapse;" cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th width="5%" class="packing">
					<?php echo lang('qty');?>
				</th>
				<th width="20%" class="packing">
					<?php echo lang('name');?>
				</th>
				<th class="packing" >
					<?php echo lang('description');?>
				</th>
			</tr>
		</thead>
	<?php $items = $order->contents; ?>


<?php foreach($order->contents as $orderkey=>$product):
		$img_count = 1;
?>
		<tr>
			<td class="packing" style="font-size:20px; font-weight:bold;">
				<?php echo $product['quantity'];?>
			</td>
			<td class="packing">
				<?php echo $product['name'];?>
				<?php echo (trim($product['sku']) != '')?'<br/><small>sku: '.$product['sku'].'</small>':'';?>
			</td>
			<td class="packing">
				<?php
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

				?>
			</td>
		</tr>
<?php	endforeach;?>
	</table>
	<table border="1" style="width:100%; margin-top:10px; border-color:#000; font-size:13px; border-collapse:collapse;" cellpadding="5" cellspacing="0">
                <thead>
                  <tr>
                    <th><?php echo lang('name');?></th>
					<th><?php echo lang('description');?></th>
					<th><?php echo lang('price');?></th>
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


<br class="break"/>