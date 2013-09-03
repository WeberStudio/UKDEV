<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete_category');?>');
}
</script>
<?php 
define('ADMIN_FOLDER', $this->config->item('admin_folder'));
	function list_categories($partial_customer_order) {
    if(!empty($partial_customer_order)){            
		foreach ($partial_customer_order as $pco):?>
			<tr>
			  <td><?php echo  ucwords(strtolower($pco['status'])); ?></td>
			  <td><?php echo  ucwords(strtolower($pco['order_number'])); ?></td>
			  <td><?php echo  ucwords(strtolower($pco['ordered_on'])); ?></td>
              <td><?php echo  ucwords(strtolower($pco['subtotal'])); ?></td>
			  <td><?php echo  format_currency(ucwords(strtolower($pco['total']))); ?></td>
			  
			  <td class="ms" style="white-space:nowrap;">
			  	<div class="btn-group1">
                <div class="btn-group ">
                      <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                      <ul class="dropdown-menu" style="text-align:left;">
                        <li><a target="_blank"  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('pdf');?>" href="<?=base_url().'admin/customer_invoice/pdf_view/'.$invoice['invoice_id'].'/'.$invoice['template_id']?>" ><i class="icon-print"></i> Open PDF </a></li>
                        
                        <li><a  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('email');?>" href="<?= base_url().'admin/customer_invoice/invoice_detail/'.$invoice['invoice_id']?>" ><i class="icon-envelope"></i> Send Email </a></li>                        
                      </ul>
                    </div>	
                    <div class="btn-group inline">
                      <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">Status <span class="caret"></span></button>
                      <ul class="dropdown-menu" style="text-align:left;">
                        <li><a href="<?=base_url().'admin/customer_invoice/invoice_paid_status/open/'.$invoice['invoice_id']?>">Open</a></li>
                        <li><a href="<?=base_url().'admin/customer_invoice/invoice_paid_status/close/'.$invoice['invoice_id']?>">Close</a></li>
                        <li><a href="<?=base_url().'admin/customer_invoice/invoice_paid_status/overdue/'.$invoice['invoice_id']?>">Overdue</a></li>                        
                      </ul>
                    </div>				
					<a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title="<?php // echo lang('edit');?>" href="<?=base_url().'admin/customer_invoice/invoice_detail/'.$invoice['invoice_id']?>" ><i class="icon-pencil"></i> Edit </a>				
					<a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title="<?php // echo lang('delete');?>" href="<?=base_url().'admin/customer_invoice/delete/'.$invoice['invoice_id']?>" onclick="return confirm('If you delete this invoice you will not be able to recover it later. Are you sure you want to permanently delete this invoice?');"> Delete </a>
					
                                         
				   </div>				   
			  </td>
			</tr>
			<?php
            
            endforeach;
            }
        }
?>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
    <!-- End top-right -->
  
  <div id="main_container">
  
      <!--=======Search Panel Start=======-->
    <!--<div class="box paint color_0">
      <div class="title">
      
      
      <?php echo form_open($this->config->item('admin_folder').'/customer_invoice/index', 'class="form-horizontal row-fluid" ');?>
        <h4> <i class="icon-book"></i><span>Search  Invoice
        <input type="submit"  class="btn" name="csv_call" value="Invoice Report (CSV)" >
        <input type="submit" class="btn" name="print_call" value="Courses Report (Print)"> 
        
        </span> </h4>
      </div>
      <div class="content"> 
      
        <div class="form-row control-group row-fluid">
            <div class="controls span3">
                <input type="text" value="<?php echo $search_input;?>" id="with-tooltip" rel="tooltip" data-placement="top" name="term" data-original-title="Search By Invoice Id" placeholder="Search Invoice...." class="row-fluid">
              </div>
              <div class="controls span3">
                <?php 
                    //$option = array( ''=>'select Frequency','month'=>'Per Month', 'quarter'=>'Per Quarter','year'=>'Per Year');
                    //echo form_dropdown('date',$option,set_value($search_cat),'class="chzn-select"','id="default-select"', 'placeholder="select Frequency"');
                ?>
                 <select name="date" class="chzn-select" id="default-select1">
                        <option value="">Select Frequency</option>
                        <option value="month"<?php if($search_date == 'month'){echo 'selected';}?>>Per Month</option>
                        <option value="quarter" <?php if($search_date == 'quarter'){echo 'selected';}?>>Per Quarter</option>
                        <option value="year"<?php if($search_date == 'year'){echo 'selected';}?>>Per Year</option>
                    </select>   
              </div>
            <div class="controls span3">
              <?php
                        if(!empty($all_admin))
                        {
                            echo '<select name="admin_id"   data-placeholder="Filter By Customer Email..." class="chzn-select" id="default-select">';
                            echo '<option value="">Select Courses Provider Name</option>';
                            foreach ($all_admin as $all_admins)
                            {
                                ?>
                            <option value="<?php echo $all_admins->id;?>" <?if($all_admins->id==$search_courses){ echo 'selected';}?> ><?php echo $all_admins->firstname.' '. $all_admins->lastname;?></option>;
                             <?php
                            }
                            echo '</select>';
                            
                        }
                ?>
              </div>
              <div class="controls span2">
                <button class="btn" rel="tooltip" data-placement="top" data-original-title="Search" name="submit" value="search"><?php echo lang('search')?></button>
                <a class="btn" rel="tooltip" data-placement="top" data-original-title="Reset" href="<?php echo site_url($this->config->item('admin_folder').'/customer_invoice/index');?>">Reset</a>       </div>
          </div>
          </form>
          <?php
            $this->session->unset_userdata('post_session'); 
          ?>
        </div>
      </div>-->
  <!--=======Search Panel End=======-->
   <?php
	//lets have the flashdata overright "$message" if it exists
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	
	?>  
 
    <div class="row-fluid ">
      <div class="span12">
        <div class="box paint color_18">
          <div class="title">
          <!--<h4> <i class=" icon-bar-chart"></i><span>Invoices--> <!--<a class="btn" href=" <?php // echo site_url($this->config->item('admin_folder').'/customer_invoice/form'); ?>"><i class="icon-plus-sign"></i> <?php //echo 'NEW';?></a></span> </h4>-->
            <h4> <i class=" icon-bar-chart"></i><span>Invoices </span> </h4>
          </div>
          <!-- End .title -->
          <div class="content top">
            <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
              <thead>
                <tr>
                  <th class="no_sort">Status</th>
                  <th class="no_sort to_hide_phone">Invoice </th>
                  <th class="ue no_sort">Created</th>
                  <!--<th>Due Date</th>-->
                  <th>Amount</th>
                  <!--<th class="ue no_sort">Tax</th>-->
                  <th class="ue no_sort ">Total</th>
                  <!--<th class="ue no_sort">Options</th>-->
                </tr>
              </thead>
              <tbody>
                <?php
                  list_categories($partial_customer_order);
                ?>
				 <?php if (!empty($message)){ echo '<tr><td style="text-align:center;" colspan="7">'.$message.'</td></tr>'; }?>
              </tbody>
            </table>
			
            <div class="row-fluid control-group">
                <div class="span6">
                  <div class="pagination pull-right "> <?php //echo $this->pagination->create_links();?> &nbsp; </div>
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