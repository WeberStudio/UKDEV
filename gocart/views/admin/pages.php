<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_2">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span>Pages Listing 
             
	            <a class="btn" href="<?=base_url().ADMIN_PATH?>pages/form"><i class="icon-plus-sign"></i>Add New Pages <?php //echo lang('add_new_customer');?></a>
                     </span></h4>
                
<div class="content top">
<div class="content"> 
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			
			<th><?php echo lang('title');?> </th>
			<th align="right"><?php echo lang('active');?></th>
			
		</tr>
	</thead>
	
	<?php echo (count($pages) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_pages_or_links').'</td></tr>':''?>
	<?php if($pages):?>
	<tbody>
			
			<?php
			$GLOBALS['admin_folder'] = $this->config->item('admin_folder');
			
			function page_loop($pages, $dash = '')
		{
				
					foreach($pages as $page)
				{?>
			<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo $page->title; ?><?php //echo  $customer->lastname; ?></td>
			
			<td>
				<div class="btn-group" align="right">
				
					<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/pages/form/'.$page->id); ?>"><i class="icon-pencil"></i><?php echo lang('edit');?></a>
					<!--<a class="btn" href="<?php echo site_url().'index.php/'.$page->slug; ?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('go_to_page');?></a>-->
					<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/pages/delete/'.$page->id); ?>" onclick="return areyousure();"><i class="icon-trash"></i> <?php echo lang('delete');?> </a>
				</div>
			</td>
		</tr>

		<?php
		
			page_loop($page->children, $dash.'-');
			}
		}
		page_loop($pages);
		?>
		
		
	</tbody>
	<?php endif;?>
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