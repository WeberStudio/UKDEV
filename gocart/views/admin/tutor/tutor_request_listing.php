<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_tutor');?>');
}
</script>
<div id="main" style="min-height:1000px">
  <!--<div class="container">-->
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_10">
            <div class="title">
             <h4><i class=" icon-bar-chart"></i><span>Tutor Request Listing</span></h4>                
				
                <div class="content">
				<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
					<thead>
						<tr>
							<th>Customer Name</th>			
							<th>Course Name</th>
							<th>Tutors</th>
							<th>Actions</th>
						</tr>
					</thead>					
					<tbody>
						
						<?php echo (count($tutor_requests) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_tutors').'</td></tr>':''?>
						<?php foreach ($tutor_requests as $tutor_request):?>
						<tr>
							<td>
							<?php 
								
								$customer_name  = $this->Customer_model->get_customer($tutor_request['customer_id']);
								if(!empty($customer_name))
								echo $customer_name->firstname.' '.$customer_name->lastname;
							?>
							</td>
							<td>
							<?php 
								$course_name 	= $this->Product_model->get_product($tutor_request['subject_id'], $related=false);				
								echo $course_name->name;
							?>
							</td>			
							<td><?php echo  $tutor_request['request_status']; ?></td>
							
							<td><select data-placeholder="Choose Multiple Courses" class="chzn-select" name="tutor[]"  tabindex="5" onChange="ajex_tutor_for_course('<?=$tutor_request['request_id']?>',this.value, '<?=$tutor_request['customer_id']?>', '<?=$tutor_request['subject_id']?>')">
							    <option value="0">Select Tutor</option>
                             <?php  
							 foreach ($tutors as $tutor)
							 {
							 ?>
									<option  value="<?=$tutor->tutor_id?>"><?=$tutor->firstname?></option>
							<? } ?>
							</select>
							</td>
						</tr>
				<?php endforeach;
						?>
					</tbody>
				</table>
                </div>
				<div class="row-fluid control-group">
								<div class="span6">
								  <div class="pagination pull-right "> <?php //echo $this->pagination->create_links();?> &nbsp; </div>
								  
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
  <!--</div>-->
<script>
function ajex_tutor_for_course(request_id, object, customer_id, subject_id)
{
	var path =  "<?=base_url().$this->config->item('admin_folder')?>/tutor/ajex_tutor_for_course/";		
	var dataString = 'request_id='+request_id+'&tutor_id='+object+'&customer_id='+customer_id+'&subject_id='+subject_id;
	//alert( dataString);
	$.ajax({
		url: path, 
		data: dataString,
		type:'POST', 
		success: function(data)
		{
			/*$("#dyn-fropdonw").html('');
			$("#dyn-fropdonw").html(data);*/		
			//alert(data);			
		}
	});
		
}
</script>