<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); ?>
<div id="main" style="min-height:1000px">
<div class="container">
<? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>

<!--========  velidation error end   ==========-->
<div id="main_container">
  <div class="row-fluid">
    <div class="span12">
      <div class="box paint color_18">
        <div class="title">
          <h4> <i class=" icon-bar-chart"></i>Add Product Price Options</h4>        
        <!-- End .title -->
        <div class="content">		
		<div class="tab-pane fade in active" id="form">
          <?php echo form_open($this->config->item('admin_folder').'/products/price_options_form/'.$page.'/'.$id, array('class' => '', 'id' => 'validateForm')); ?>
 
          <div class="control-group row-fluid">
            <label class="control-label span2">Price Option Text <?php echo lang('group');?><span class="help-block"></span></label>
            <div class="controls span7">
              e.g <input type="text" name="option_text" value="<?=set_value('option_text', $option_text)?>"  placeholder ="Course Price Only In UK"/>
            </div>
          </div>          
		  <div class="control-group row-fluid">
            <label class="control-label span2">Price Option Rate<?php echo lang('group');?><span class="help-block"></span></label>
            <div class="controls span7">
             e.g <input type="text" name="option_price" value="<?=set_value('option_price', $option_price)?>" placeholder ="99"/>
            </div>
          </div>
		            
		</div>		
		<button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
        </div>
		
		<div class="content"> 
		<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
			<thead>
				<tr>
					<th>Option Name</th>
					<th>Option Price</th>
					<th align="right">Action</th>			
				</tr>
			</thead>	
			<tbody>
			<?php echo (count($all_price_options) < 1)?'<tr><td style="text-align:center;" colspan="3">'.lang('no_coupons').'</td></tr>':''?>
		<?php foreach ($all_price_options as $all_price):?>
				<tr>			
					<td><?php echo  $all_price['p_option_title']; ?></td>
					<td class="gc_cell_left"><?php echo  $all_price['p_option_price']; ?></td>
					<td>
						<div class="btn-group" align="right">
							<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/products/price_options_form/'.$page.'/'.$all_price['p_option_id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
							&nbsp;
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/products/delete_price_option/'.$page.'/'.$all_price['p_option_id']); ?>" onclick="return areyousure();"><i class="icon-trash"></i>   <?php echo lang('delete');?></a>
						</div>
					</td>
				</tr>
		<?php endforeach; ?>
				
				
			</tbody>
		</table>
		</div>
        <!-- End .span4 -->		  
      </div>
      <div class="row-fluid control-group">
               
                <div class="span6">
                  <div class="pagination pull-right "><?php echo $this->pagination->create_links();?> &nbsp; </div
                ></div>
              </div>
	  <!-------end content------>
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>
</div>
</div>
</div>
<script>
function get_all_site_customers()
{
		
		
		
		var path =  "<?=base_url().$this->config->item('admin_folder')?>/commission/ajax_commission_levels/";
		//alert($('#levels').val());
		var level_value = $('#levels').val();
		var dataString = 'level_value='+level_value;
		//alert( path);
		$.ajax({
			url: path, 
			data: dataString,
			type:'POST', 
			success: function(data){
			$("#dyn-fropdonw").html('');
				$("#dyn-fropdonw").html(data);			
				//alert(data);
			}
		});
		
}
</script>