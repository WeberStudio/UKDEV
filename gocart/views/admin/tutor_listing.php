<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_customer');?>');
}
</script>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_18">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span>Tutor Listing 
             
	            <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/tutor/form'); ?>"><i class="icon-plus-sign"></i>Add New Tutor <?php //echo lang('add_new_customer');?></a>
                     </span></h4>
                
<div class="content top"> 
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			<?php
			$by ="";
			if($by=='ASC')
			{
				$by='DESC';
			}
			else
			{
				$by='ASC';
			}
			?>
			
			<th><a href="<?php //echo site_url($this->config->item('admin_folder').'/customers/index/lastname/');?>/<?php //echo ($field == 'lastname')?$by:'';?>"><?php //echo lang('lastname');?>
				<?php //if($field == 'lastname'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?>Last Name </a></th>
			
			<th><a href="<?php //echo site_url($this->config->item('admin_folder').'/customers/index/firstname/');?>/<?php //echo ($field == 'firstname')?$by:'';?>"><?php //echo lang('firstname');?>
				<?php //if($field == 'firstname'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?>First Name</a></th>
			
			<th><a href="<?php //echo site_url($this->config->item('admin_folder').'/customers/index/email/');?>/<?php //echo ($field == 'email')?$by:'';?>"><?php //echo lang('email');?>
				<?php //if($field == 'email'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?> Email</a></th>
			<th> Active<?php //echo lang('active');?></th>
			<th></th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		//$page_links	= $this->pagination->create_links();
		$page_links = "";
		$customers ="";
		$customer = "";
		if($page_links != ''):?>
		<tr><td colspan="5" style="text-align:center"><?php echo $page_links;?></td></tr>
		<?php endif;?>
		<?php echo (count($customers) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_customers').'</td></tr>':''?>
<?php //foreach ($customers as $customer):?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td>rafique<?php //echo  $customer->lastname; ?></td>
			<td class="gc_cell_left">qasim <?php //echo  $customer->firstname; ?></td>
			<td>qasim@yahoo.com<?php //echo  $customer->email; ?></td>
			<td> yes
				<?php //if($customer->active == 1)
				{
					//echo 'Yes';
				}
				//else
				{
					//echo 'No';
				}
				?>
			</td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn" href="<?php //echo site_url('/tutor/edit');  ?>"><i class="icon-pencil"></i> Edit <?php //echo lang('edit');?></a>
					
					
					
					<a class="btn btn-danger" href="<?php //echo site_url($this->config->item('admin_folder').'/customers/delete/'.$customer->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php //echo lang('delete');?> Delete</a>
				</div>
			</td>
		</tr>
<?php //endforeach;
		//if($page_links != ''):?>
		<tr><td colspan="5" style="text-align:center"><?php //echo $page_links;?></td></tr>
		<?php //endif;?>
	</tbody>
</table>
<div class="row-fluid control-group">
                <div class="pull-left span6 " action="#"> </div>
                <div class="span6">
                  <div class="pagination pull-right ">
                    <ul>
                      <li><a href="#">Prev</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">Next</a></li>
                    </ul>
                  </div >
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
  </div>