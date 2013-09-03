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
        <div class="box paint color_0">
          <div class="title">
            <h4> <i class=" icon-bar-chart"></i>Tutor Details </h4>
          </div>
          <!-- End .title -->
          <div class="content">
          <br /><br />
          	<div class="row-fluid">
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> Personal Details </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-left">
                <ul id="tabExample2" class="nav nav-tabs">
                  <li class="active"><a href="#First_Name" data-toggle="tab">First Name</a></li>
                  <li><a href="#Last_Name" data-toggle="tab">Last Name</a></li>
                  <li class="dropdown"> <a href="#Street_Address" data-toggle="tab">Street Address </a> </li>
                  <li class="dropdown"> <a href="#Address" data-toggle="tab">Address (Optional) </a> </li>
                  <li class="dropdown"> <a href="#City" data-toggle="tab">City </a> </li>
                  <li class="dropdown"> <a href="#Post_Code" data-toggle="tab">Post Code</a> </li>
                  <li class="dropdown"> <a href="#Country" data-toggle="tab"> Country </a> </li>
                  <li class="dropdown"> <a href="#Telephone" data-toggle="tab">Telephone </a> </li>
                  <li class="dropdown"> <a href="#Phone" data-toggle="tab">Phone </a> </li>
                  <li class="dropdown"> <a href="#Email" data-toggle="tab">Email </a> </li>
                  <li class="dropdown"> <a href="#Description" data-toggle="tab">Description </a> </li>
                  <li class="dropdown"> <a href="#Comment" data-toggle="tab">Comment </a> </li>
                  <li class="dropdown"> <a href="#Status" data-toggle="tab">Status </a> </li>
                  
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="First_Name">
                    <p><?php if(empty($tutor->firstname)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->firstname)); } ?></p>
                  </div>
                  <div class="tab-pane fade" id="Last_Name">
                    <p><?php if(empty($tutor->lastname)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->lastname)); } ?></p>
                  </div>
                  <div class="tab-pane fade" id="Street_Address">
                    <p><?php if(empty($tutor->street_address)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->street_address));} ?></p>
                  </div>
                  <div class="tab-pane fade" id="Address">
                    <p><?php if(empty($tutor->address_line_op)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->address_line_op));} ?></p>
                  </div>
                  <div class="tab-pane fade" id="City">
                    <p><?php if(empty($tutor->city)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->city)); } ?></p>
                  </div>
                  <div class="tab-pane fade" id="Post_Code">
                    <p><?php if(empty($tutor->zip_code)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->zip_code));} ?></p>
                  </div>
                  <div class="tab-pane fade" id="Country">
                    <p><?php if(empty($tutor->country)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->country)); } ?></p>
                  </div>
                  <div class="tab-pane fade" id="Telephone">
                    <p><?php if(empty($tutor->telephone)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->telephone)); } ?></p>
                  </div>
                  <div class="tab-pane fade" id="Phone">
                    <p><?php if(empty($tutor->phone)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->phone));} ?></p>
                  </div>
                  <div class="tab-pane fade" id="Email">
                    <p><?php if(empty($tutor->email)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->email));} ?></p>
                  </div>
                  <div class="tab-pane fade" id="Description">
                    <p><?php if(empty($tutor->short_description)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->short_description));} ?></p>
                  </div>
                  <div class="tab-pane fade" id="Comment">
                    <p><?php if(empty($tutor->comments)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->comments));} ?></p>
                  </div>
                  <div class="tab-pane fade" id="Status">
                    <p><?php if($tutor->status > 0) {echo "Currently Active";} else { echo "Currently Inactive";} ?></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End  .box --> 
        </div>
        <!-- End .span6 -->
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> <i class=" icon-bar-chart"></i> Qualification </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-right">
                <ul id="tabExample4" class="nav nav-tabs">
                
                  <li class="active"><a href="#Degree_Title" data-toggle="tab">Degree Title</a></li>
                  <li><a href="#Degree_Start_Date" data-toggle="tab">Degree Start Date</a></li>
                  <li class="dropdown"> <a href="#Degree_End_Date" data-toggle="tab">Degree End Date </a> </li>
                  <li class="dropdown"> <a href="#Degree_Description" data-toggle="tab">Degree Description </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="Degree_Title">
                    <p>		
						<?php 
						
						$z = 1;
						if(empty($tutor_q)) {
								
								echo "No record available";
						}
						else {
							if(count($tutor_q) > 1) {                
								
								for($i = 0; $i < count($tutor_q); $i++) {
										
										echo $z++." - ". $tutor_q[$i]->degree_title."<br />";	
								}
							}
							else {
								
								echo "1 - " . $tutor_q[0]->degree_title."<br />";		
							}
						}
						?>
					</p>
                  </div>
                  <div class="tab-pane fade" id="Degree_Start_Date">
                    <p><?php 
						
						$z = 1;
						if(empty($tutor_q)) {
								
								echo "No record available";
						}
						else {
							if(count($tutor_q) > 1) {                
								
								for($i = 0; $i < count($tutor_q); $i++) {
										
										echo $z++." - ". $tutor_q[$i]->degree_title." : ".$tutor_q[$i]->degree_start . "<br />";	
								}
							}
							else {
								
								echo "1 - " . $tutor_q[0]->degree_title." : ".$tutor_q[0]->degree_start . "<br />";		
							}
						}
						
						?></p>
                  </div>
                  <div class="tab-pane fade" id="Degree_End_Date">
                    <p>
						<?php 
                        
							$z = 1;
							if(empty($tutor_q)) {
								
								echo "No record available";
							}
							else {
								if(count($tutor_q) > 1) {                
									
									for($i = 0; $i < count($tutor_q); $i++) {
										
										echo $z++." - ". $tutor_q[$i]->degree_title." : ".$tutor_q[$i]->degree_end . "<br />";	
									}
								}
								else {
									
									echo "1 - " . $tutor_q[0]->degree_title." : ".$tutor_q[0]->degree_end . "<br />";	
								}
							}
                        
                        ?>
                      </p>
                  </div>
                  <div class="tab-pane fade" id="Degree_Description">
                    <p>
                    	<?php 
							
							$z = 1;
							
							if(empty($tutor_q)) {
								
								echo "No record available";
							}
							else {
								
								if(count($tutor_q) > 1) {
													
									for($i = 0; $i < count($tutor_q); $i++) {
										
										echo $z++." - ". $tutor_q[$i]->degree_title." : ".$tutor_q[$i]->degree_description . "<br /><br />";	
									}
								}
								else {
									
									echo "1 - " . $tutor_q[0]->degree_title." : ".$tutor_q[0]->degree_description . "<br /><br />";	
								}
							}
                        
                        ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End .box --> 
        </div>
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> <i class=" icon-bar-chart"></i> Experience </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-right">
                <ul id="tabExample4" class="nav nav-tabs">
                
                  <li class="active"><a href="#Designation_Title" data-toggle="tab">Designation Title</a></li>
                  <li><a href="#Designation_Start_Date" data-toggle="tab">Designation Start Date</a></li>
                  <li class="dropdown"> <a href="#Designation_End_Date" data-toggle="tab">Designation End Date </a> </li>
                  <li class="dropdown"> <a href="#Designation_Description" data-toggle="tab">Designation Description </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="Designation_Title">
                    <p>		
						<?php 
						
						$z = 1;
						if(empty($tutor_d)) {
								
								echo "No record available";
						}
						else {
							if(count($tutor_d) > 1) {                
								
								for($i = 0; $i < count($tutor_d); $i++) {
										
										echo $z++." - ". $tutor_d[$i]->desig_title."<br />";	
								}
							}
							else {
								
								echo "1 - " . $tutor_d[0]->desig_title."<br />";		
							}
						}
						?>
					</p>
                  </div>
                  <div class="tab-pane fade" id="Designation_Start_Date">
                    <p><?php 
						
						$z = 1;
						if(empty($tutor_d)) {
								
								echo "No record available";
						}
						else {
							if(count($tutor_d) > 1) {                
								
								for($i = 0; $i < count($tutor_d); $i++) {
										
										echo $z++." - ". $tutor_d[$i]->desig_title." : ".$tutor_d[$i]->desig_start . "<br />";	
								}
							}
							else {
								
								echo "1 - " . $tutor_d[0]->desig_title." : ".$tutor_d[0]->desig_start . "<br />";		
							}
						}
						
						?></p>
                  </div>
                  <div class="tab-pane fade" id="Designation_End_Date">
                    <p>
						<?php 
                        
							$z = 1;
							if(empty($tutor_d)) {
								
								echo "No record available";
							}
							else {
								if(count($tutor_d) > 1) {                
									
									for($i = 0; $i < count($tutor_d); $i++) {
										
										echo $z++." - ". $tutor_d[$i]->desig_title." : ".$tutor_d[$i]->desig_end . "<br />";	
									}
								}
								else {
									
									echo "1 - " . $tutor_d[0]->desig_title." : ".$tutor_d[0]->desig_end . "<br />";	
								}
							}
                        
                        ?>
                      </p>
                  </div>
                  <div class="tab-pane fade" id="Designation_Description">
                    <p>
                    	<?php 
							
							$z = 1;
							
							if(empty($tutor_d)) {
								
								echo "No record available";
							}
							else {
								
								if(count($tutor_d) > 1) {
													
									for($i = 0; $i < count($tutor_d); $i++) {
										
										echo $z++." - ". $tutor_d[$i]->desig_title." : ".$tutor_d[$i]->desig_description . "<br /><br />";	
									}
								}
								else {
									
									echo "1 - " . $tutor_d[0]->desig_title." : ".$tutor_d[0]->desig_description . "<br /><br />";	
								}
							}
                        
                        ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End .box --> 
        </div>
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> <i class=" icon-bar-chart"></i> Achievements </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-right">
                <ul id="tabExample4" class="nav nav-tabs">
                
                  <li class="active"><a href="#Achievement_Title" data-toggle="tab">Achievement Title</a></li>
                  <li><a href="#Achievement_Start_Date" data-toggle="tab">Achievement Start Date</a></li>
                  <li class="dropdown"> <a href="#Achievement_End_Date" data-toggle="tab">Achievement End Date </a> </li>
                  <li class="dropdown"> <a href="#Achievement_Description" data-toggle="tab">Achievement Description </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="Achievement_Title">
                    <p>		
						<?php 
						
						$z = 1;
						if(empty($tutor_a)) {
								
								echo "No record available";
						}
						else {
							if(count($tutor_a) > 1) {                
								
								for($i = 0; $i < count($tutor_a); $i++) {
										
										echo $z++." - ". $tutor_a[$i]->achiev_title."<br />";	
								}
							}
							else {
								
								echo "1 - " . $tutor_a[0]->achiev_title."<br />";		
							}
						}
						?>
					</p>
                  </div>
                  <div class="tab-pane fade" id="Achievement_Start_Date">
                    <p><?php 
						
						$z = 1;
						if(empty($tutor_a)) {
								
								echo "No record available";
						}
						else {
							if(count($tutor_a) > 1) {                
								
								for($i = 0; $i < count($tutor_a); $i++) {
										
										echo $z++." - ". $tutor_a[$i]->achiev_title." : ".$tutor_a[$i]->achiev_start . "<br />";	
								}
							}
							else {
								
								echo "1 - " . $tutor_a[0]->achiev_title." : ".$tutor_a[0]->achiev_start . "<br />";		
							}
						}
						
						?></p>
                  </div>
                  <div class="tab-pane fade" id="Achievement_End_Date">
                    <p>
						<?php 
                        
							$z = 1;
							if(empty($tutor_a)) {
								
								echo "No record available";
							}
							else {
								if(count($tutor_a) > 1) {                
									
									for($i = 0; $i < count($tutor_a); $i++) {
										
										echo $z++." - ". $tutor_a[$i]->achiev_title." : ".$tutor_a[$i]->achiev_end . "<br />";	
									}
								}
								else {
									
									echo "1 - " . $tutor_a[0]->achiev_title." : ".$tutor_a[0]->achiev_end . "<br />";	
								}
							}
                        
                        ?>
                      </p>
                  </div>
                  <div class="tab-pane fade" id="Achievement_Description">
                    <p>
                    	<?php 
							
							$z = 1;
							
							if(empty($tutor_a)) {
								
								echo "No record available";
							}
							else {
								
								if(count($tutor_a) > 1) {
													
									for($i = 0; $i < count($tutor_a); $i++) {
										
										echo $z++." - ". $tutor_a[$i]->achiev_title." : ".$tutor_a[$i]->achiev_description . "<br /><br />";	
									}
								}
								else {
									
									echo "1 - " . $tutor_a[0]->achiev_title." : ".$tutor_a[0]->achiev_description . "<br /><br />";	
								}
							}
                        
                        ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End .box --> 
        </div>
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> Extra </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-left">
                <ul id="tabExample2" class="nav nav-tabs">
                  <li class="active"><a href="#Extra_info" data-toggle="tab">Extra Info</a></li>
                  <li ><a href="#Courses" data-toggle="tab">Courses</a></li>
                  <li ><a href="#Categories" data-toggle="tab">Categories</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="Extra_info">
                    <p><?php if(empty($tutor->extra_info)) { echo "Not Available"; } else { echo ucwords(strtolower($tutor->extra_info)); } ?></p>
                  </div>
                  <div class="tab-pane fade" id="Courses">
                    <p>
						
					<?php 
                    if(!empty($categories)){
                    
						$categories_item = str_replace(array("[", "]",  '"'),'',$categories);						
						$categories_item = explode(',',$categories_item);
                    }
                    if(isset($all_categories)){ 
                    	foreach ($all_categories as $file){
                    		
							if(in_array($file['id'], $categories_item)){ 									
                    
                    			echo $file['name']."<br />";
                    		} 
                    
                    	}
                    } 
                    ?>
                    </p>
                      </div>
                  <div class="tab-pane fade" id="Categories">
                    <p>
						<?php
                        if(!empty($courses)){
                            
							$courses_item = str_replace(array("[", "]",  '"'),'',$courses);					
                            $courses_item = explode(',',$courses_item);
                        }			  
						
                        if(isset($all_courses)){  
                            
                            foreach ($all_courses as $course){
                                
                                if(in_array($course['id'], $courses_item)){ 									
                        
                                    echo " - " .$course['name']."<br /><br />";
                                } 
                            }
                        } 
                        ?>
                       </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End  .box --> 
        </div>
        
        <!-- End .span6  --> 
      </div>
          </div>
          <!-------end content------>
          <!-- End .row-fluid -->
        </div>
        <!-- End #container -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var j = jQuery.noConflict();
j(function(){
	j('#country_id').change(function(){
			j.post('<?php echo site_url('locations/get_zone_menu');?>',{id:j('#country_id').val()}, function(data) {
			  j('#f_zone_id').html(data);
			});
			
		});
});
</script>
<script>
counter = <?=$degree_counter?>;
var $j = jQuery.noConflict();
function add_degree_clon()
{
	
	counter = counter + 1;
	id = $j('#degree_inner_row').attr('id');	
	html_div = '<div id="degree_inner_row_'+counter+'" ><div class="form-row control-group row-fluid"><label class="control-label span1" for="hint-field">Degree Title<span class="help-block"></span></label><div class="controls span7"><input type="text" name="degree_title[]" class="span12" /></div></div><div class="form-row control-group row-fluid"><label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label><div class="controls span7"><label for="date"> Date (M-D-Y) </label><input type="text" name="degree_start[]" id="degree_start_'+counter+'" class="span12" /><label for="date"> Date (M-D-Y) </label><input type="text" name="degree_end[]" id="degree_end_'+counter+'" class="span12" /></div></div><div class="form-row control-group row-fluid"><label class="control-label span1" for="text">Description</label><div class="controls span7"><textarea id="text" rows="3" class="row-fluid" name="degree_description[]"></textarea></div>  <a href="javascript:void(0)" class="btn btn-danger btn-mini"  onclick="remove_item(\'degree_inner_row_'+counter+'\')" style="margin-left:110px;"><i class="icon-remove"></i> Remove Item</a></div></div>';
	
	$j('#degree_inner_table').append(html_div);
	
}
counter_desig = <?=$desig_counter?>;

function add_desig_clon()
{
	
	counter_desig = counter_desig + 1;
	id = $j('#desig_inner_row').attr('id');	
	html_div = '<div id="desig_inner_row_'+counter_desig+'" ><div class="form-row control-group row-fluid"><label class="control-label span1" for="hint-field">Desig Title<span class="help-block"></span></label><div class="controls span7"><input type="text" name="desig_title[]" class="span12" /></div></div><div class="form-row control-group row-fluid"><label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label><div class="controls span7"><label for="date"> Date (M-D-Y) </label><input type="text" name="desig_start[]" id="desig_start_'+counter_desig+'" class="span12" /><label for="date"> Date (M-D-Y) </label><input type="text" name="desig_end[]" id="desig_end_'+counter_desig+'" class="span12" /></div></div><div class="form-row control-group row-fluid"><label class="control-label span1" for="text">Description</label><div class="controls span7"><textarea id="text" rows="3" class="row-fluid" name="desig_description[]"></textarea></div> <a href="javascript:void(0)" class="btn btn-danger btn-mini"  onclick="remove_item(\'desig_inner_row_'+counter_desig+'\')" style="margin-left:110px;"><i class="icon-remove"></i> Remove Item</a></div></div>';
	
	$j('#desig_inner_table').append(html_div);
	
}

counter_achiev = <?=$achiev_counter?>;
function add_achiev_clon()
{
	
	counter_achiev = counter_achiev + 1;
	id = $j('#achiev_inner_row').attr('id');	
	html_div = '<div id="achiev_inner_row_'+counter_achiev+'" ><div class="form-row control-group row-fluid"><label class="control-label span1" for="hint-field">Achievement Title<span class="help-block"></span></label><div class="controls span7"><input type="text" name="achiev_title[]" class="span12" /></div></div><div class="form-row control-group row-fluid"><label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label><div class="controls span7"><label for="date"> Date (M-D-Y) </label><input type="text" name="achiev_start[]" id="achiev_start_'+counter_achiev+'" class="span12" /></div></div><div class="form-row control-group row-fluid"><label class="control-label span1" for="text">Description</label><div class="controls span7"><textarea id="text" rows="3" class="row-fluid" name="achiev_description[]"></textarea></div><a href="javascript:void(0)" class="btn btn-danger btn-mini"  onclick="remove_item(\'achiev_inner_row_'+counter_achiev+'\')" style="margin-left:110px;"><i class="icon-remove"></i> Remove Item</a></div></div>';	
	$j('#achiev_inner_table').append(html_div);
	
}

function remove_item(item_id)
{
	//alert(item_id);
	$('#'+item_id).remove();
}


function show_date(id)
{
	//alert(id);
	$j('#'+id).datepicker({
	  format: 'mm-dd-yyyy'
	});
}
</script>


