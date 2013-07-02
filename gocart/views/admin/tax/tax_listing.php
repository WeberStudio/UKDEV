<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
	  
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
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_11">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i>
			 	<span>Tax Rates <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/tax/form'); ?>">New Tax</a></span>
			 </h4>
             </div>  
<div class="content top">
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Rate</th>
			<th></th>
			<th></th>
			<th style="float:right;">Actions</th>			
		</tr>
	</thead>
	
	<tbody>
		<?php echo (count($taxes) < 1)?'<tr><td style="text-align:center;" colspan="5">No Taxes</td></tr>':''?>
		<?php  foreach ($taxes as $tax):?>
		<?  // echo "<pre>";print_r($tax);exit; ?>
		<tr>
			<td style="width:16px;"><?php  echo  $tax->tax_rate_id; ?></td>			
			<td class="gc_cell_left"><?php echo  $tax->tax_rate_name; ?></td>
			<td><?php echo  $tax->tax_rate_percent; ?></td>
			<td></td>
			<td></td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/tax/form/'.$tax->tax_rate_id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/tax/delete/'.$tax->tax_rate_id); ?>" onclick="return areyousure();"><i class="icon-trash"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
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