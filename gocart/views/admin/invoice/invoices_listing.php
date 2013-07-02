<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_category');?>');
}
</script>
<?php 
define('ADMIN_FOLDER', $this->config->item('admin_folder'));
	function list_categories($invoices) {            
		foreach ($invoices as $invoice):?>
			<tr>
			  <td><?php echo  $invoice['invoice_paid_status']; ?></td>
			  <td><?php echo  $invoice['invoice_id']; ?></td>
			  <td><?php echo  $invoice['invoice_date_created']; ?></td>
			  <td><?php echo  $invoice['invoice_date_due']; ?></td>
			  <td><?php echo  format_currency($invoice['invoice_item_subtotal']); ?></td>
			  <td><?php echo  format_currency($invoice['invoice_item_tax_total']); ?></td>
			  <td><?php echo  format_currency($invoice['invoice_total']); ?></td>
			  
			  <td class="ms" style="white-space:nowrap;">
			  	<div class="btn-group1">
                <div class="btn-group ">
                      <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                      <ul class="dropdown-menu" style="text-align:left;">
                        <li><a target="_blank"  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('pdf');?>" href="<?=base_url().'admin/invoices/pdf_view/'.$invoice['invoice_id'].'/'.$invoice['template_id']?>" ><i class="icon-print"></i> Open PDF </a></li>
                        
                        <li><a  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('email');?>" href="<?=base_url().'admin/invoices/invoice_detail/'.$invoice['invoice_id']?>" ><i class="icon-envelope"></i> Send Email </a></li>                        
                      </ul>
                    </div>	
                    <div class="btn-group inline">
                      <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">Status <span class="caret"></span></button>
                      <ul class="dropdown-menu" style="text-align:left;">
                        <li><a href="<?=base_url().'admin/invoices/invoice_paid_status/open/'.$invoice['invoice_id']?>">Open</a></li>
                        <li><a href="<?=base_url().'admin/invoices/invoice_paid_status/close/'.$invoice['invoice_id']?>">Close</a></li>
                        <li><a href="<?=base_url().'admin/invoices/invoice_paid_status/overdue/'.$invoice['invoice_id']?>">Overdue</a></li>                        
                      </ul>
                    </div>				
					<a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('edit');?>" href="<?=base_url().'admin/invoices/invoice_detail/'.$invoice['invoice_id']?>" ><i class="icon-pencil"></i> Edit </a> 
					<!--<a target="_blank" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('pdf');?>" href="<?=base_url().'admin/invoices/pdf_view/'.$invoice['invoice_id'].'/'.$invoice['template_id']?>" ><i class="icon-print"></i> Open PDF </a>-->
					<!--<a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('email');?>" href="<?=base_url().'admin/invoices/invoice_detail/'.$invoice['invoice_id']?>" ><i class="icon-envelope"></i> Send Email </a>-->
					<a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('delete');?>" href="<?=base_url().'admin/invoices/delete/'.$invoice['invoice_id']?>" onclick="return confirm('If you delete this invoice you will not be able to recover it later. Are you sure you want to permanently delete this invoice?');">  Delete </a>
					
                                         
				   </div>				   
			  </td>
			</tr>
			<?php
            
            endforeach;
        }
?>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
    <!-- End top-right -->
  
  <div id="main_container">
    <div class="row-fluid ">
      <div class="span12">
        <div class="box paint color_18">
          <div class="title">
            <h4> <i class=" icon-bar-chart"></i><span>Invoices <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/invoices/form'); ?>"><i class="icon-plus-sign"></i> <?php echo 'NEW';?></a></span> </h4>
          </div>
          <!-- End .title -->
          <div class="content top">
            <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
              <thead>
                <tr>
                  <th class="no_sort">Status</th>
                  <th class="no_sort to_hide_phone">Invoice </th>
                  <th class="ue no_sort">Created</th>
                  <th>Due Date</th>
                  <th>Amount</th>
                  <th class="ue no_sort">Tax</th>
                  <th class="ue no_sort ">Total</th>
                  <th class="ue no_sort">Options</th>
                 
				 
                </tr>
              </thead>
              <tbody>
                <?php
                  list_categories($invoices);
                ?>
              </tbody>
            </table>
            <div class="row-fluid control-group">
                <div class="span6">
                  <div class="pagination pull-right "> <?php echo $this->pagination->create_links();?> &nbsp; </div>
				</div>
			</div>
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