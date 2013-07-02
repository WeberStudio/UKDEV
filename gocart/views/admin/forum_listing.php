<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_1">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i>
			 <span>Forums Listing
			<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/forums/form'); ?>"><i class="icon-plus-sign"></i>Add New Forum </a>
			<?php /*?><a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/forums/topic'); ?>"><i class="icon-plus-sign"></i>GO To Topic </a><?php */?>
			 </span></h4>
               
<div class="content">
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			<th>Title</th>			
			<th>Course</th>
			<th>User</th>
			<th>Tuter</th>
			<th>Status</th>
			<th>Oprations</th>
		</tr>
	</thead>
	
	<tbody>
	
	<?php echo (count($forums) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_forums') .'</td></tr>':''?>
	<?php foreach($forums as $forum){ ?>
		<tr>			
			<td><a style="text-decoration:underline;" href="<?=base_url().'admin/forums/topic_view/'.$forum->forum_id?>" ><?=$forum->forum_title?></a></td>			
			<td>
			<?
				$course_name 	= $this->Product_model->get_product($forum->product_id, $related=false);				
				echo $course_name->name;		
			?>			
			</td>
			<td>
			<?
				$customer_name  = $this->Customer_model->get_customer($forum->customer_id);
				echo $customer_name->firstname.' '.$customer_name->lastname;		
			?>
			</td>
			<td>
			<?
				$tutor_name 	= $this->Tutor_model->get_tutor($forum->tutor_id);
				 if(!empty($tutor_name)){ echo $tutor_name->firstname.' '.$tutor_name->lastname;}		
			?>
			</td>
			<td><?=$forum->forum_status?></td>
			<td>
				<div class="btn-group">
						<a class="btn"  href="<?=base_url().'admin/forums/form/'.$forum->forum_id?>"><i class="icon-pencil"></i> Edit </a>
						<a class="btn btn-danger" onclick="return confirm('If you delete this order you will not be able to recover it later. Are you sure you want to permanently delete this order?');"  href="<?=base_url().'admin/forums/delete_forum/'.$forum->forum_id?>"><i class="icon-trash"></i> Remove </a>
				</div>
			</td>
		</tr>
	<? } ?>
		
		
	</tbody>
</table>
</div>
<div class="row-fluid control-group">
                
                <div class="span6">
                  <div class="pagination pull-right ">
                    <?php echo $this->pagination->create_links();?> &nbsp; 
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