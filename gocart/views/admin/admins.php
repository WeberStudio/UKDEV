<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete');?>');
}
</script>

<?php define('ADMIN_FOLDER', $this->config->item('admin_folder'));

function sort_url($heading, $by, $sort, $sorder, $admin_folder)
{
		if ($sort == $by)
		{
			if ($sorder == 'asc')
			{
				$sort	= 'desc';
				$icon	= ' <i class="icon-chevron-up"></i>';
			}
			else
			{
				$sort	= 'asc';
				$icon	= ' <i class="icon-chevron-down"></i>';
			}
		}
		else
		{
			$sort	= 'asc';
			$icon	= '';
		}
			
	
		$return = site_url($admin_folder.'/admin/index/'.$by.'/'.$sort);
		
		echo '<a href="'.$return.'">'.$heading.$icon.'</a>';

}


function list_admin($admins, $current_admin_id) 
{ 
	foreach ($admins as $admin){
	?>
			<tr>
				<td><?php  echo $admin->firstname;?></td>
				<td><?php echo $admin->lastname; ?></td>
				<td><?php echo $admin->email; ?></td>
				<td><?php echo $admin->access; ?></td>             
				<td>
                    <div class="btn-group" style="float:left;">
                    	<a class="btn" href="<?php echo site_url(ADMIN_FOLDER.'/admin/form/'.$admin->id);?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>    
						<?php                                
                        if ($current_admin_id != $admin->id){ ?>
                        <a class="btn btn-danger" href="<?php echo site_url(ADMIN_FOLDER.'/admin/delete/'.$admin->id); ?>" onClick="return areyousure();"><i class="icon-trash"></i> <?php echo lang('delete');?></a>
                            <?php } ?>
                    </div> 
				</td>  
			</tr>
	<?php 
	  }            
}
?>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
     <div id="main_container">
     <div class="box paint color_0">
      <div class="title">
       <?php echo form_open($this->config->item('admin_folder').'/admin/index', 'class="form-horizontal row-fluid" ');?>
        <h4> <i class="icon-book"></i><span>Search Courses Provider<input type="submit"  class="btn" name="csv_call" value="Sales Report (CSV)" >
        
        </span> </h4>
      </div>
      <div class="content">
        <div class="form-row control-group row-fluid">
              <div class="controls span5">
                <input type="text" id="with-tooltip" rel="tooltip" data-placement="top" name="term" data-original-title="Search By Customer Name, Keyword" placeholder="Search Customer...." class="row-fluid">
              </div>
              <div class="controls span5">
                <?php
                        if(!empty($all_admin))
                        {
                            echo '<select name="admin_id"   data-placeholder="Filter By Customer Email..." class="chzn-select" id="default-select">';
                            echo '<option value="">Select Customer E-mail</option>';
                            foreach ($all_admin as $all_admins)
							{
								echo "<option value=".$all_admins->id.">$all_admins->email</option>";
							}
							echo '</select>';
                            
                        }
                ?>
              </div>
              <div class="controls span2">
                <button class="btn" rel="tooltip" data-placement="top" data-original-title="Search" name="submit" value="search"><?php echo lang('search')?></button>
                <a class="btn" rel="tooltip" data-placement="top" data-original-title="Reset" href="<?php echo site_url($this->config->item('admin_folder').'/products/index');?>">Reset</a> 	  </div>
          </div>
          </form>
        </div>
      </div>
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_18">
            <div class="title">                
            <h4> <i class=" icon-bar-chart"></i><span>Administrator 
                 <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/admin/form'); ?>" >
                        <i class="icon-plus-sign"></i> <?php echo lang('add_new_admin');?></a>
                       </span></h4>
                 </div>           <!-- End .title --> 
      <div class="content top">
     <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
     <thead>
         <tr>
            <th class="no_sort"><?php echo sort_url(lang('firstname'),'firstname', $order_by, $sort_order, $this->config->item('admin_folder'));?></th>
            <th class="no_sort to_hide_phone"><?php echo sort_url(lang('lastname'),'lastname', $order_by, $sort_order, $this->config->item('admin_folder'));?></th>
            <th class="ue no_sort"><?php echo sort_url(lang('email'),'email', $order_by, $sort_order, $this->config->item('admin_folder'));?></th>
            <th class="ue no_sort"><?php echo lang('access');?></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
		$current_admin    = $this->session->userdata('admin');
		$current_admin_id = $current_admin['id'];
		list_admin($admins, $current_admin_id);
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