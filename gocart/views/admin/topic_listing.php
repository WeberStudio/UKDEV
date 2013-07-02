<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_1">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i>
			 <span>Topic Listing
			<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/forums/topic_form/'.$form_id); ?>"><i class="icon-plus-sign"></i>Add New Topic </a>		
			 </span></h4>
               
<div class="content">
<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
	<thead>
		<tr>
			<th>Topic</th>
			<th>Message</th>
			<th>Last post</th>
			<th>status</th>
			<th>oprations</th>
		</tr>
	</thead>
	
	<tbody>
	<?php echo (count($topics) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_forums') .'</td></tr>':''?>
	<?php foreach($topics as $topic){ ?>
		<tr>
			
			<td><a style="text-decoration:underline;" href="<?php echo site_url($this->config->item('admin_folder').'/forums/message_converstion/'.$topic->topic_id); ?>" ><?=$topic->topic_title?></a></td>
			<td><?=substr($topic->topic_message, 0, 15).'...'?></td>
			<td><?=$topic->topic_time?></td>
			<td><?=$topic->topic_status?></td>
			<td>
			<div class="btn-group">					
			<a class="btn"  href="<?=base_url().'admin/forums/topic_form/'.$form_id.'/'.$topic->topic_id?>"><i class="icon-pencil"></i> Edit </a>
			<a class="btn btn-danger" onclick="return confirm('If you delete this order you will not be able to recover it later. Are you sure you want to permanently delete this order?');"  href="<?=base_url().'admin/forums/topic_delete/'.$form_id.'/'.$topic->topic_id?>"><i class="icon-trash"></i> Remove </a>
			</div>
			</td>
		</tr>

	<? } ?>
		
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
