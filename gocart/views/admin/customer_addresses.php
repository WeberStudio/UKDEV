<?php //include('header.php'); ?>
<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_address');?>');
}
</script>
<div id="main" style="min-height:1000px">
  <div class="container">
    <div class="header row-fluid">
      <div class="logo"> <a href="index.html"><span>Start</span><span class="icon"></span></a> </div>
      <div class="top_right">
        <ul class="nav nav_menu">
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="../../page.html">
            <div class="title"><span class="name">George</span><span class="subtitle">Future Buyer</span></div>
            <span class="icon"><img src="<?=base_url().ASSETS_PATH?>img/thumbnail_george.jpg"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <li><a href="profile.html"><i class=" icon-user"></i> My Profile</a></li>
              <li><a href="forms_general.html"><i class=" icon-cog"></i>Settings</a></li>
              <li><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><i class=" icon-unlock"></i><?php echo lang('common_log_out') ?></a></li>
              <li><a href="search.html"><i class=" icon-flag"></i>Help</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- End top-right -->
    </div>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_18">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span><?php echo  $page_title; ?> 
<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/customers/address_form/'.$customer->id);?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_address');?></a>
</span></h4> 
<div class="content top">   
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">   
	<thead>
		<tr>
			<th><?php echo lang('name');?></th>
			<th><?php echo lang('contact');?></th>
			<th><?php echo lang('address');?></th>
			<th><?php echo lang('locality');?></th>
			<th><?php echo lang('country');?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($addresses) < 1)?'<tr><td style="text-align:center;" colspan="6">'.lang('no_addresses').'</td></tr>':''?>
<?php foreach ($addresses as $address):
		$f = $address['field_data'];
?>
		<tr>
			<td>
				<?php echo $f['lastname']; ?>, <?php echo $f['firstname']; ?>
				<?php echo (!empty($f['company']))?'<br/>'.$f['company']:'';?>
			</td>
			
			<td>
				<?php echo  $f['phone']; ?><br/>
			<?php echo  $f['email']; ?>
            			</td>
			
			<td>
				<?php echo $f['address1'];?>
				<?php echo (!empty($f['address2']))?'<br/>'.$f['address2']:'';?>
			</td>
			
			<td>
				<?php echo $f['city'];?>, <?php echo $f['zone'];?> <?php echo $f['zip'];?> 
			</td>
			
			<td><?php echo $f['country'];?></td>
			
			<td>
				<div class="btn-group" style="float:right">
				
					<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/customers/address_form/'.$customer->id.'/'.$address['id']);?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/customers/delete_address/'.$customer->id.'/'.$address['id']);?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
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
<?php //include('footer.php');