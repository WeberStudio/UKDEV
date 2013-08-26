<script type="text/javascript">

	$(function()
	{
		$('#btn_add_item').click(function() {
			$('#blank_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
		});
		
		
	});
	function recurring_block(flag)
	{
		var data = flag;
		
		if(data=='yes')
		{
			$('#recurring-block').show();
		}
		else
		{
			$('#recurring-block').hide();
		}
	}
</script>

<div id="main" style="min-height:1000px">
<div class="container">
  <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
  <!-- End top-right -->
  <?php
	//lets have the flashdata overright "$message" if it exists
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	if($this->session->flashdata('error'))
	{
		$error	= $this->session->flashdata('error');
	}
	
	?>
  <div id="js_error_container" class="alert alert-error" style="display:none;">
    <p id="js_error"></p>
  </div>
  <div id="js_note_container" class="alert alert-note" style="display:none;"> </div>
  <?php if (!empty($message)): ?>
  <div class="alert alert-success"> <a class="close" data-dismiss="alert">*</a> <?php echo $message; ?> </div>
  <?php endif; ?>
  <?php if (!empty($error)): ?>
  <div class="alert alert-error"> <a class="close" data-dismiss="alert">*</a> <?php echo $error; ?> </div>
  <?php endif; ?>
  <div class="row-fluid">
    <div class="span6">
      <div class="box paint color_24">
        <div class="title">
          <div class="row-fluid">
            <h4> <i class=" icon-bar-chart"></i> Client Info </h4>
          </div>
        </div>
        <!-- End .title -->
        <div class="accordion" id="accordion4">
          <div class="accordion-group">
            <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion4" href="#collapseOne2"> Recipient Details </a> </div>
            <div id="collapseOne2" class="accordion-body collapse in" >
              <div class="accordion-inner">
                <div class="pull-left">
                  <h2><a href="<?php echo site_url('clients/view/' . $user_info[0]['id']); ?>"></a></h2>
                  <span> <?php echo ($user_info[0]['firstname']) ? '<strong>'.lang('user_name').'</strong>: '.$user_info[0]['lastname'] . '<br/>' : ''; ?> </span> <span> <?php echo ($user_info[0]['company']) ? '<strong>'.lang('admin_name').'</strong>: '.$user_info[0]['company'] : '<br/>'; ?> </span> <br />
                  <?php if ($user_info[0]['phone']) { ?>
                  <span><strong><?php echo lang('invoice_phone'); ?>:</strong> <?php echo $user_info[0]['phone']; ?></span><br>
                  <?php } ?>
                  <?php if ($user_info[0]['email']) { ?>
                  <span><strong><?php echo lang('invoice_email'); ?>:</strong> <?php echo $user_info[0]['email']; ?></span>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End .content -->
      </div>
      <!-- End .box -->
    </div>
    <!-- End .span6 -->
    <div class="span6">
      <div class="box paint color_10">
        <div class="title">
          <div class="row-fluid">
            <h4> <i class=" icon-bar-chart"></i> Invoice Dates </h4>
          </div>
        </div>
        <!-- End .title -->
        <div class="accordion" id="accordion5">
          <div class="accordion-group">
            <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse"  href="#collapseOne5"> Invoice Date Info </a> </div>
            <div id="collapseOne5" class="accordion-body collapse in">
              <div class="accordion-inner">
                <label class="control-label"><?php echo lang('invoice_id'); ?> #</label>
                <input type="text" id="invoice_number" class="span10" value="<?php echo $invoice_data->invoice_id; ?>" />
                <label class="control-label"><?php echo lang('creation_date'); ?></label>
                <input type="text" id="invoice_date_created" class="span10" value="<?php echo date("Y-d-m", strtotime($invoice_data->invoice_date_created)); ?>" />
                <label class="control-label"><?php echo lang('due_date'); ?></label>
                <input type="text" id="invoice_date_due" class="span10" value="<?php echo date("Y-d-m", strtotime($invoice_data->invoice_date_due));  ?>"/>
              </div>
            </div>
          </div>
        </div>
        <!-- End .content -->
      </div>
      <!-- End .box -->
    </div>
    <!-- End .span6 -->
  </div>
  <div id="main_container">
    <div class="row-fluid">
      <div class="span12">
        <div class="box paint color_8">
          <div class="title">
            <div class="row-fluid">
              <h4>Invoice Details</h4>
            </div>
            <div class="row-fluid" style="padding-left:15px;"> <a href="javascript:void(0)" class="btn" id="btn_add_item" style="margin-right: 5px;"><i class="icon-plus-sign"></i> Add Item</a> </div>
            <div class="content">
              <form id="invoice_form" class="form-horizontal" action="<?=base_url().$this->config->item('admin_folder').'/customer_invoice/save_invoice_details/'.$invoice_data->invoice_id?>" method="post">
                <div class="invoice">
                  <table id="item_table" class="items table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th><?php echo lang('item'); ?></th>
                        <th style="min-width: 300px;"><?php echo lang('description'); ?></th>
                        <th style="width: 80px;"><?php echo lang('quantity'); ?></th>
                        <th style="width: 80px;"><?php echo lang('price'); ?></th>                     
                        <th><?php echo lang('subtotal'); ?></th>                     
                        <th><?php echo lang('total'); ?></th>
                       
                        <input type="hidden" id="invoice_id" value="<?php echo $invoice_data->invoice_id; ?>">
                      </tr>
                    </thead>
                    <tbody>
                      <? if(!empty($invoice_items)){
							foreach ($invoice_items as $invoice_item){ 
						?>
                      <tr id="new_item" >
                        <td style="vertical-align: top;"><input type="text" id="item_name" name="item_name[]" style="width: 100%;" value="<?=$invoice_item['item_name']?>">
                          <input type="hidden" id="item_id" value="<?=$invoice_item['item_id']?>">
						   <input type="hidden" name="product_id[]" value="<?=$invoice_item['product_id']?>">
                        </td>
                        <td><textarea id="item_description" name="item_description[]" rows="1"  cols="5"><?=$invoice_item['item_description']?>
</textarea></td>
                        <td style="vertical-align: top;"><input type="text" class="input-mini" id="item_quantity" name="item_quantity[]" style="width: 90%;" value="<?=$invoice_item['item_quantity']?>"></td>
                        <td style="vertical-align: top;"><input type="text" class="input-mini" id="item_price" name="item_price[]" style="width: 90%;" value="<?=$invoice_item['item_price']?>"></td>
                       				   		
                        <td style="vertical-align: top;"><?php echo format_currency($invoice_item['item_subtotal']); ?></td>                       
                        <td style="vertical-align: top;"><?php echo format_currency($invoice_item['item_total']); ?></td>
                        <td></td>
                      </tr>
                      <? } 
						}
						else if(!empty($invoice_products)){
							foreach ($invoice_products as $invoice_item){
							$item_content	= unserialize($invoice_item['contents']);
							
						?>
							<tr  >
								<td style="vertical-align: top;"><input type="text" id="item_name" name="item_name[]" style="width: 90%;" value="<?=$item_content['name']?>">
								 <input type="hidden" name="product_id[]" value="<?=$item_content['id']?>">
								</td>
								<td><textarea id="item_description" name="item_description[]" rows="1"  cols="5"><?=$item_content['excerpt']?>
		</textarea></td>
								<td style="vertical-align: top;"><input type="text" class="input-mini" id="item_quantity" name="item_quantity[]" style="width: 90%;" value="<?=$invoice_item['q_sum']?>"></td>
								<td style="vertical-align: top;"><input type="text" class="input-mini" id="item_price" name="item_price[]" style="width: 90%;" value="<?=$item_content['price']?>"></td>
								<td></td>
								<td style="vertical-align: top;"></td>
								<td></td>
								<td style="vertical-align: top;"><?php echo format_currency($invoice_item['item_subtotal']); ?></td>
								<td style="vertical-align: top;"><?php echo format_currency($invoice_item['item_tax_total']); ?></td>
								<td style="vertical-align: top;"><?php echo format_currency($invoice_item['comm_per_item']); ?></td>
								<td style="vertical-align: top;"><?php echo format_currency($invoice_item['item_total']); ?></td>
								<td></td>
                      		</tr>
						<? 
							}
						}
						else
						{
						?>
						  <tr id="blank_item">
							 <td style="vertical-align: top;">
								<input type="text" id="item_name" name="item_name[]" style="width: 90%;" value="">
								<input type="hidden" id="item_id" value="">
								</td>
								<td><textarea id="item_description" name="item_description[]" rows="1"  cols="5"></textarea></td>
								<td style="vertical-align: top;"><input type="text" class="input-mini" id="item_quantity" name="item_quantity[]" style="width: 90%;" value=""></td>
								<td style="vertical-align: top;"><input type="text" class="input-mini" id="item_price" name="item_price[]" style="width: 90%;" value=""></td>
								<td style="vertical-align: top;"></td>                       
								<td colspan="4"></td>
						  </tr>
                      <?php
						}						
						?>
                    </tbody>
                  </table>
				   <? if(!empty($invoice_totals)){?>
                  <table class="table table-striped table-bordered"  >
					<thead>
						<tr>
							<th><?php echo lang('subtotal'); ?></th>													
							<th><?php echo lang('total'); ?></th>							
						</tr>
					</thead>
					<tbody>					
						<tr>
							<td><?php echo format_currency($invoice_totals[0]['invoice_item_subtotal']); ?></td>
												
							<td><?php echo format_currency($invoice_totals[0]['invoice_total']); ?></td>							
						</tr>
					</tbody>
				</table>
				<? }?>
                  <br />
                  <br />
                  <p><strong><?php echo lang('invoice_terms'); ?></strong></p>
                  <textarea id="invoice_terms" name="invoice_terms" class="redactor" style="width: 100%;"><?php echo $invoice_data->invoice_terms; ?></textarea>
                </div>
                <br />
				
				<?php /*?><div class="form-row control-group row-fluid">
                  <label class="control-label">Recurring Invoice</label>
                  <div class="controls span7">
                    <label class="inline radio"><input type="radio" name="recur_flag" checked="checked"  value="no" onclick="recurring_block('no')"/> No </label>                    
                    <label class="inline radio"><input type="radio" name="recur_flag" value="yes" onclick="recurring_block('yes')"/>Yes </label>
                  </div>
                </div><?php */?>
				
				<div class="form-row control-group" id="recurring-block" style="display:none;" >
				
					<div class="controls span10">
					    <label class="label">Recurring Frequency</label>
						<select name="recur_frequency" id="recur_frequency" class="input-small">
							<option value="weekly">Weekly</option>
							<option value="bi-weekly">Bi-Monthly</option>
							<option value="monthly">Monthly</option>
							<option value="yearly">Yearly</option>
						</select>
					</div>				
					<div class="controls span10">
					   <label for="date"> Start Date (M-D-Y) </label>
						<?php
							$recur_start_date    = array('name'=>'recur_start_date', 'id'=>'recur_start_date', 'value'=>date('Y-m-d'), 'class'=>'span6');
							echo form_input($recur_start_date);					
						?>
					</div>
					<div class="controls span10">
						<label for="date"> End Date (M-D-Y) </label>
						<?php
							$recur_end_date    	= array('name'=>'recur_end_date', 'id'=>'recur_end_date', 'value'=>date('Y-m-d'), 'class'=>'span6');
							echo form_input($recur_end_date);					
						?>
					</div>
					               
                </div>
				<br />
                <button type="submit" value="conform" name="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

 $(document).ready(function () {
    $('form').submit(function() {
        $('.btn').attr('disabled', true).addClass('disabled');
    });
		
	$('#invoice_date_created').datepicker({
	  format: 'yyyy-mm-dd'
	});
	
	$('#invoice_date_due').datepicker({
	  format: 'yyyy-mm-dd'
	});	
	
	$('#recur_start_date').datepicker({
	  format: 'yyyy-mm-dd'
	});
	
	$('#recur_end_date').datepicker({
	  format: 'yyyy-mm-dd'
	});
	
});	
</script>