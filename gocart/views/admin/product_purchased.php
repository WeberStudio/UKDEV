<script type="text/javascript">
function areyousure()
{
	return confirm('Are you sure to delete the record?');
}

</script>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
     <!--<div class="box paint color_0">
      <div class="title">
        <h4> <i class="icon-book"></i><span>Search Orders</span> </h4>
      </div>
      <div class="content">
       <?php //echo form_open($this->config->item('admin_folder').'/commission/search_commisssion', 'class="" ');?>
      
         <div class="form-row control-group row-fluid">
        
              <div class="controls span3">
                <?php 
					$option = array( ''=>'select frequently','per_week'=>'Per Week', 'per_month'=>'Per Month','per_year'=>'Per Year');
					echo form_dropdown('date',$option,set_value('someValue'),'class="chzn-select"','id="default-select"', 'placeholder="select frequently"');
				?>
              </div>
              <div class="controls span3">
                <select class="chzn-select" id="" name="categories">
                <option value=""> All Categories</option>
                <?php foreach($category as $cat){?>
                	
                    <option value="<?php echo $cat['id'];?>"> <?php echo $cat['name'];?></option>
                    <?php }?>
                </select>
              </div>
              <div class="controls span3">
               <select class="chzn-select" id="" name="courses">
                <option value=""> All Courses</option>
                <?php foreach($courses as $cour){?>
                	
                    <option value="<?php echo $cour['id'];?>"> <?php echo $cour['name'];?></option>
                    <?php }?>
                </select>
              </div>
              <div class="controls span3">
               <select class="chzn-select" id="" name="courses_provider">
                <option value=""> Courses Provider</option>
                 
                	<?php
					foreach($admins as $admin){?>
                    <option value="<?php echo $admin->id;?>"> <?php echo $admin->firstname;?></option>
                    <?php }?>
                </select>
              </div>
            
         </div>
         <div class="form-row control-group row-fluid">
         
         <div class="controls span3">
         <label class="control-label "><h3> Form </h3></label>
                <?php 
					$data = array('id'=>'datepicker1','name'=>'start_date','placeholder'=>'Start Date','style'=>'margin-bottom: 0px;');
					echo form_input($data);
				?>
              </div>
            
             
            
             
              <div class="controls span3">
               <label class="control-label"> <h3> To </h3></label>
                <?php 
				$data = array('id'=>'datepicker2','name'=>'end_date','placeholder'=>'End Date','style'=>'margin-bottom: 0px;');
					echo form_input($data);
				?>
              </div>
              </div>
         <div class="form-row control-group row-fluid">
              <div class="controls span12" align="right">
                <button class="btn" rel="tooltip" data-placement="top" data-original-title="Search" name="submit" value="search"><?php echo lang('search')?></button>
                <a class="btn" rel="tooltip" data-placement="top" data-original-title="Reset" href="<?php echo site_url($this->config->item('admin_folder').'/products/index');?>">Reset</a> 	  </div>
          </div>
          </form>
        </div>
      </div>-->
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_18">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span>BEST Purchased Courses  
             
	            <!--<a class="btn" href="<?php echo site_url($this->config->item('admin_folder')."/commission/form/"); ?>"><i class="icon-plus-sign"></i>Add New Commision <?php //echo lang('add_new_customer');?></a>-->
                     </span></h4>
                
<div class="content top">
<div class="content"> 
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			
			
			<th><a href="">ID</a></th>
			
			<th><a href="">Products</a></th>
			
			<th><a href="">Purchased </a></th>
			<!--<th> Active</th>-->
			<!--<th>Actions</th>-->
			
		</tr>
	</thead>
	
	<tbody>
		
		<?php //echo (count($commissions) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_customers').'</td></tr>':''?>
<?php foreach ($product_purchased as $product_purchaseds):?>
		<tr>
			
			
		
			<td><?php echo $product_purchaseds->product_id; ?></td>
			<td><a href="<?=base_url().ADMIN_PATH?>products">
			<?php 
			
			//echo $product_purchaseds->product_id; 
			$product_name = $this->Product_model->get_product($product_purchaseds->product_id);
			if(!empty($product_name))
			{
				echo $product_name->name;
				echo '</a>';
			}
			
			
            
			else
			{
				echo "product is deleted";
			}
			
			?>
            </td>
			<td><a href="<?=base_url().ADMIN_PATH?>products"><?php echo $product_purchaseds->count_product; ?></a></td>
		</tr>
<?php endforeach;
		//if($page_links != ''):?>
		<!--<tr><td colspan="5" style="text-align:center"><?php //echo $page_links;?></td></tr>-->
		<?php //endif;?>
	</tbody>
</table>
</div>
<div class="row-fluid control-group">
                
                <div class="span6">
                  <div class="pagination pull-right "><?php echo $this->pagination->create_links();?> &nbsp; </div
                ></div>
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