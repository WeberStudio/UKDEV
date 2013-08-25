<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_customer');?>');
}
</script>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
	
	<!--=======Search Panel Start=======-->
    <div class="box paint color_0">
      <div class="title">
      
      
      <?php echo form_open($this->config->item('admin_folder').'/customers/index', 'class="form-horizontal row-fluid" ');?>
        <h4> <i class="icon-book"></i><span>Search Customer
        <input type="submit"  class="btn" name="csv_call" value="Customer Report (CSV)" >
        <input type="submit" class="btn" name="print_call" value="Customer Report (Print)">  
        </span> </h4>
      </div>
      <div class="content"> 
      
        <div class="form-row control-group row-fluid">
              <div class="controls span5">
                <?php
                        if(!empty($all_customers))
                        {
                            echo '<select name="customer_name" onchange="get_customer_email()"   data-placeholder="Filter By Customer Name..." class="chzn-select" id="customer_id">';
                            echo '<option value="">Select Customer Name</option>';
                            foreach ($all_customers as $customer)
                            {
                  ?>
                                <option value="<?php echo  $customer->id;?>" <?php if($customer->id == $search_customer_name){echo 'selected';}?>><?php echo $customer->firstname.' '.$customer->lastname;?></option>;
                <?php 
                            }
                            echo '</select>';
                            
                        }
                ?>
              </div>
              <div class="controls span5">
                <?php
                        if(!empty($all_customers))
                        {
                            echo '<select name="customer_email"   data-placeholder="Filter By Customer Email..." class="" id="customer_email">';
                            echo '<option value="">Select Customer E-mail</option>';
                            foreach ($all_customers as $customer)
							{
                  ?>
								<option value="<?php echo  $customer->id;?>" <?php if($customer->id == $search_customer_email){echo 'selected';}?>><?php echo $customer->email;?></option>;
				<?php 
                            }
							echo '</select>';
                            
                        }
                ?>
              </div>
              <div class="controls span2">
                <button class="btn" rel="tooltip" data-placement="top" data-original-title="Search" name="submit" value="search"><?php echo lang('search')?></button>
                <a class="btn" rel="tooltip" data-placement="top" data-original-title="Reset" href="<?php echo site_url($this->config->item('admin_folder').'/customers/index');?>">Reset</a> 	  </div>
          </div>
          </form>
          <?php
            $this->session->unset_userdata('post_session'); 
          ?>
        </div>
      </div>
  <!--=======Search Panel End=======-->
	
	
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_18">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span>Customers 
             	
	         
	            <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/customers/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_customer');?></a>
                     </span></h4>
                
<div class="content top"> 

<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			<?php
			if($by=='ASC')
			{
				$by='DESC';
			}
			else
			{
				$by='ASC';
			}
			?>
			
			<th><a href="<?php echo site_url($this->config->item('admin_folder').'/customers/index/lastname/');?>/<?php echo ($field == 'lastname')?$by:'';?>"><?php echo lang('lastname');?>
				<?php if($field == 'lastname'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?> </a></th>
			
			<th><a href="<?php echo site_url($this->config->item('admin_folder').'/customers/index/firstname/');?>/<?php echo ($field == 'firstname')?$by:'';?>"><?php echo lang('firstname');?>
				<?php if($field == 'firstname'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
			
			<th><a href="<?php echo site_url($this->config->item('admin_folder').'/customers/index/email/');?>/<?php echo ($field == 'email')?$by:'';?>"><?php echo lang('email');?>
				<?php if($field == 'email'){ echo ($by == 'ASC')?'<i class="icon-chevron-up"></i>':'<i class="icon-chevron-down"></i>';} ?></a></th>
			<th><?php echo lang('active');?></th>
			<th></th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$page_links	= $this->pagination->create_links();
		echo (count($customers) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_customers').'</td></tr>':''?>
<?php foreach ($customers as $customer):?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $customer->lastname; ?></td>
			<td class="gc_cell_left"><?php echo  $customer->firstname; ?></td>
			<td><?php echo  $customer->email; ?></td>
			<td>
				<?php if($customer->active == 1)
				{
					echo 'Yes';
				}
				else
				{
					echo 'No';
				}
				?>
			</td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-small" href="<?php echo site_url($this->config->item('admin_folder').'/customers/customer_view/'.$customer->id); ?>" rel="tooltip" data-placement="top" data-original-title="View Customer Details"><i class="icon-eye-open"></i>View</a>
					<a class="btn"  href="<?php echo site_url($this->config->item('admin_folder').'/customers/form/'.$customer->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					
					<!--<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/customers/addresses/'.$customer->id); ?>"><i class="icon-envelope"></i> <?php echo lang('addresses');?></a>-->
					
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/customers/delete/'.$customer->id); ?>" onclick="return areyousure();"><i class="icon-trash"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
<?php endforeach;
		if($page_links != ''):?>
		<tr><td colspan="5" style="text-align:center"><?php echo $page_links;?></td></tr>
		<?php endif;?>
	</tbody>
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
<script type="text/javascript" language="javascript">
function get_customer_email()
{
  
var id  = document.getElementById('customer_id').value;
 j      = jQuery.noConflict();
 
 j.ajax({ 
                type: "POST",         //GET or POST or PUT or DELETE verb
                url:  '<?=base_url()?>admin/ajax_search/get_customer_email',         // Location of the service
                data: 'customer_id='+id,         //Data sent to server
                success: function (data)
                 {//On Successful service call
                    //alert(data);
                    j('#customer_email').html(data);
                 },
        });
}
</script>