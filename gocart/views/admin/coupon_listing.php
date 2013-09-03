<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_18">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span>Coupon Listing 
             
	            <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/coupons/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_coupon');?></a>
                     </span></h4>
                
<div class="content top">
<div class="content"> 
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			
			
			<th><?php echo lang('code');?></th>
			<th><?php echo lang('usage');?></th>
			<th align="right"><?php echo lang('active');?></th>
			
		</tr>
	</thead>
	
	<tbody>
	<?php echo (count($coupons) < 1)?'<tr><td style="text-align:center;" colspan="3">'.lang('no_coupons').'</td></tr>':''?>
<?php foreach ($coupons as $coupon):?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $coupon->code; ?></td>
			<td class="gc_cell_left"><?php echo  $coupon->num_uses ." / ". $coupon->max_uses; ?></td>
			<td>
				<div class="btn-group" align="right">
					<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/coupons/form/'.$coupon->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					
					
					
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/coupons/delete/'.$coupon->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i>   <?php echo lang('delete');?></a>
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