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
     <div class="box paint color_0">
      <div class="title">
        <h4> <i class="icon-book"></i><span>Search Orders</span> </h4>
      </div>
      <div class="content"> <?php echo form_open($this->config->item('admin_folder').'/commission/search_commisssion', 'class="" ');?>
      
         <div class="form-row control-group row-fluid">
        
              <!--<div class="controls span3">
                <?php 
					$option = array( ''=>'select frequently','per_week'=>'Per Week', 'per_month'=>'Per Month','per_year'=>'Per Year');
					echo form_dropdown('date',$option,set_value('someValue'),'class="chzn-select"','id="default-select"', 'placeholder="select frequently"');
				?>
              </div>-->
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
         
         <!--<div class="controls span3">
         <label class="control-label "><h3> Form </h3></label>
                <?php 
					$data = array('id'=>'datepicker1','name'=>'start_date','placeholder'=>'Start Date','style'=>'margin-bottom: 0px;');
					echo form_input($data);
				?>
              </div>-->
            
             
            
             
              <!--<div class="controls span3">
               <label class="control-label"> <h3> To </h3></label>
                <?php 
				$data = array('id'=>'datepicker2','name'=>'end_date','placeholder'=>'End Date','style'=>'margin-bottom: 0px;');
					echo form_input($data);
				?>
              </div>-->
              </div>
         <div class="form-row control-group row-fluid">
              <div class="controls span12" align="right">
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
             <h4> <i class=" icon-bar-chart"></i><span>Commission Listing 
             
	            <a class="btn" href="<?php echo site_url($this->config->item('admin_folder')."/commission/form/"); ?>"><i class="icon-plus-sign"></i>Add New Commision <?php //echo lang('add_new_customer');?></a>
                     </span></h4>
                
<div class="content top">
<div class="content"> 
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
			
			<th><a href=""> Commision Level</a></th>
			
			<th><a href="">Commision Rate</a></th>
			
			<th><a href=""> Persentage</a></th>
			<th> Active</th>
			<th>Actions</th>
			
		</tr>
	</thead>
	
	<tbody>
		<?php //$name =  $this->auth->get_admin($commission->comm_level_id);
		//$this->show->pe($this->auth->get_admin(21));
		 //echo $name->name; exit;
		
		
		?>
		<?php echo (count($commissions) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_customers').'</td></tr>':''?>
<?php foreach ($commissions as $commission):?>
		<tr>
			<?php if($commission->comm_level=='cat_level'){
				$name = $this->Category_model->get_category($commission->comm_level_id);
			 	echo '<td>'.ucwords(str_replace('_',' ',$commission->comm_level)).' ('.$name->name.')'. '</td>';
			}?>
            
            <?php if($commission->comm_level=='course_level'){ 
					//$name = $this->Product_model->get_product($commission->comm_level_id);
					$name = mysql_query("SELECT * FROM oc_products WHERE id= '".$commission->comm_level_id."'");
					$name = mysql_fetch_array($name);
					//$this->show->pe( $name['name']) ; exit;
			 		echo '<td>'.ucwords(str_replace('_',' ',$commission->comm_level)).' ('.$name['name'].')'. '</td>';
				}?>
             
            <?php  if($commission->comm_level=='course_provider'){
				$name = $this->auth->get_admin($commission->comm_level_id);
			 	echo '<td>'.ucwords(str_replace('_',' ',$commission->comm_level)).' ('.$name->firstname.' '.$name->lastname.')'. '</td>';
				}?>
            <?php  if($commission->comm_level=='universal'){
				  echo '<td>'.ucwords($commission->comm_level). '</td>';
				}?>
			<!--<td><?php //echo  $commission->comm_level; ?><?php //echo $name->name;?> </td>-->
			<td class="gc_cell_left"> <?php echo  $commission->comm_rate; ?></td>
			<td><?php if($commission->comm_rate_mode == ''){ echo 'Fix'; }else{ echo  $commission->comm_rate_mode;} ?></td>
			<td><?php echo  $commission->comm_active; ?></td>
			<td>
				<div class="btn-group" >
					<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/commission/form/'.$commission->comm_id); ?>"><i class="icon-pencil"></i> Edit </a>	
                    			
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/commission/delete/'.$commission->comm_id); ?>" onclick="return areyousure();"><i class="icon-trash"></i> Delete</a>
				</div>
			</td>
		</tr>
<?php endforeach;
		//if($page_links != ''):?>
		<tr><td colspan="5" style="text-align:center"><?php //echo $page_links;?></td></tr>
		<?php //endif;?>
	</tbody>
</table>
</div>
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