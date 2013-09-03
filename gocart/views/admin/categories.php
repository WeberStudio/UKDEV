<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_trash_category');?>');
}

function change_cat_status(cat_id)
{
		var path =  "<?=base_url().$this->config->item('admin_folder')?>/categories/change_cat_status/";
		//alert($('#levels').val());
		var status 		= $('#cat_id_'+cat_id).val();
		//alert(status);
		var dataString 	= 'status='+status+'&id='+cat_id;
		//alert( path);
		$.ajax({
			url: path, 
			data: dataString,
			type:'POST', 
			success: function(data){
				//$("#dyn-fropdonw").html('');
				//$("#dyn-fropdonw").html(data);			
				//alert(data);
				$('#message_status').show();
			}
		});

}
</script>
<?php
define('ADMIN_FOLDER', $this->config->item('admin_folder'));  
  function cat_dropwown($cats, $product_categories, $sub='' , $search_cat='') {

    foreach ($cats as $cat):?>

<option value="<?php echo $cat['category']->id;?>" <?php if($cat['category']->id == $search_cat){echo 'selected';}?> ><?php echo  $sub.$cat['category']->name; ?></option>
<?php
            if (sizeof($cat['children']) > 0)
            {
                $sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
                $sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
                list_categories($cat['children'], $product_categories, $sub2);
            }
            endforeach;
}
 


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
				
		
			$return = site_url($admin_folder.'/categories/index/'.$by.'/'.$sort);
			
			echo '<a href="'.$return.'">'.$heading.$icon.'</a>';
		
		}

		function list_categories($cats, $sub='') {
			
			foreach ($cats as $cat):?>
			<tr>
				<td><?php echo  $cat['category']->id; ?></td>
				<td><?php echo  $sub.$cat['category']->name; ?></td>
                <td>
                <?php 
					$query = "SELECT * FROM oc_category_products WHERE category_id='".$cat['category']->id."'";
					$exe = mysql_query($query);
					$count = mysql_num_rows($exe);
					echo $count
				?>
                </td>
                <td>
					<select name="publish_by_admin" id="cat_id_<?=$cat['category']->id?>" onchange="change_cat_status(<?=$cat['category']->id?>)">						
						<option <?php if($cat['category']->publish_by_super=='1'){ echo  'selected'; }?>  value="1">Published</option>
						<option <?php if($cat['category']->publish_by_super=='0'){ echo  'selected'; }?>  value="0">Unpublished</option>
					</select>				
				</td>
                <td></td>
                <td><?php echo  date("Y-m-d", strtotime($cat['category']->publish_date)); ?></td>
                <td>
					<div class="btn-group" style="float:right">

						<a class="btn" href="<?php echo site_url(ADMIN_FOLDER.'/categories/category_view/'.$cat['category']->id); ?>" rel="tooltip" data-placement="top" data-original-title="View Admin Details"><i class="icon-eye-open"></i>View</a>
						
						<a class="btn" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/form/'.$cat['category']->id);?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>

						<?php /*?><a class="btn" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/organize/'.$cat['category']->id);?>"><i class="icon-move"></i> <?php echo lang('organize');?></a><?php */?>
						
						<a class="btn btn-danger" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/trash/'.$cat['category']->id);?>" onClick="return areyousure();"><i class="icon-trash"></i> <?php echo lang('trash');?></a>
					</div>
				</td>
			</tr>
			<?php
			if (sizeof($cat['children']) > 0)
			{
				$sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
				$sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
				list_categories($cat['children'], $sub2);
			}
			endforeach;
		}
?>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
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
		
		if(function_exists('validation_errors') && validation_errors() != '')
		{
			$error	= validation_errors();
		}
		?>
	
          <div id="js_error_container" class="alert alert-error" style="display:none;">
            <p id="js_error"></p>
          </div>
          <div id="js_note_container" class="alert alert-note" style="display:none;"> </div>
          <?php if (!empty($message)): ?>
          <div id="message_status" class="alert alert-success"> <a class="close" data-dismiss="alert">x</a> <?php echo $message; ?> </div>
          <?php endif; ?>
          <?php if (!empty($error)): ?>
          <div class="alert alert-error"> <a class="close" data-dismiss="alert">x</a> <?php echo $error; ?> </div>
          <?php endif; ?>
    <div id="main_container">
    
    <div class="box paint color_0">
      <div class="title">
       <?php echo form_open($this->config->item('admin_folder').'/categories', 'class="form-horizontal row-fluid" ');?>
        <h4> <i class="icon-book"></i><span>Search Categories
        <input type="submit"  class="btn" name="csv_call" value="Categories  Report (CSV)" >
        <input type="submit" class="btn" name="print_call" value="Categories Report (Print)">
        
        </span> </h4>
      </div>
      <div class="content">
        <div class="form-row control-group row-fluid">
              <div class="controls span5">

              
                <!--<input type="text" value="<?php echo $search_input;?>" id="with-tooltip" rel="tooltip" data-placement="top" name="term" data-original-title="Search By Categories Name" placeholder="Search Categories...." class="row-fluid">-->
                 <select class="chzn-select" id="" name="term">
                <option value=""> Categories</option>
                 
                    <?php
                    foreach($search_cats as $search_cat){?>
                    <option value="<?php echo $search_cat['id'];?>" <?php if($search_cat['id'] == $search_input){echo 'selected';}?>> <?php echo  $search_cat['name'];?></option>
                    <?php }?>
                </select>
              </div>
             <div class="controls span2">
                <button class="btn" rel="tooltip" data-placement="top" data-original-title="Search" name="submit" value="search"><?php echo lang('search')?></button>
                <a class="btn" rel="tooltip" data-placement="top" data-original-title="Reset" href="<?php echo site_url($this->config->item('admin_folder').'/categories/index');?>">Reset</a>       </div>
          </div>
          </form> 
          <?php
          $this->session->unset_userdata('post_session'); 
           ?>
          
        </div>
      </div>
    
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_18">
            <div class="title">
              <h4> <i class=" icon-bar-chart"></i><span>Categories
                <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/categories/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_category');?></a>
                </span> </h4>
            </div>
            <!-- End .title -->
            <div class="content top">
              <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                <thead>
                  <tr>
                    <th><?php echo sort_url(lang('category_id'),'id', $order_by, $sort_order, $this->config->item('admin_folder'));?></th>
                    <th><?php echo sort_url(lang('name'),'name', $order_by, $sort_order, $this->config->item('admin_folder'));?></th>
                    <th class="ue no_sort">Courses Count</th>
                    <th>Status</th>
                    <th></th>
                    <th><?php echo sort_url(lang('publish_date'),'publish_date', $order_by, $sort_order, $this->config->item('admin_folder'));?></th>
                    <th class="ms no_sort ">Actions </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  list_categories($categories);
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