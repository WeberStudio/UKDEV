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
        <div class="box paint color_22">
          <div class="title">
            <h4> <i class=" icon-bar-chart"></i>Tutor Form </h4>
          </div>
          <!-- End .title -->
          <div class="content">
            <ul id="tabExample1" class="nav nav-tabs">
              <li class="active"><a href="#form" data-toggle="tab">Form</a></li>
              <li><a href="#qualification" data-toggle="tab">Qualification</a></li>
              <li><a href="#experience" data-toggle="tab">Experience</a></li>
              <li><a href="#achievement" data-toggle="tab">Achievement</a></li>
              <li><a href="#extra" data-toggle="tab">Extra</a></li>
            </ul>
			<form class="" id="validateForm" action="<?=base_url().$this->config->item('admin_folder').'/tutor/form/'.$id?>" enctype="multipart/form-data"  method="post">
            <div class="tab-content">
              <div class="tab-pane fade in active" id="form">
			 
                <?php //echo form_open_multipart($this->config->item('admin_folder').'/tutor/form/'.$id, array('class' => '', 'id' => 'validateForm')); ?>
               
                    <div class="form-row control-group row-fluid">
                      <label class="control-label span1"><span class="hint-field">Categories</span></label>
                      <div class="controls span7">
                      <?
						if(!empty($categories)){
							$categories_item = str_replace(array("[", "]",  '"'),'',$categories);						
							$categories_item = explode(',',$categories_item);
					  	}
					  ?>
                        <select data-placeholder="Choose Multiple Categories" class="chzn-select" name="categories[]" multiple="true" tabindex="5">
                        <? if(isset($all_categories)){  ?>
                        <?php  foreach ($all_categories as $file){
							if(in_array($file['id'], $categories_item)){ 									
							?>
									<option selected="selected" value="<?=$file['id']?>"><?=$file['name']?></option>
							<? } 
							else
							{ ?>	
									
									<option value="<?=$file['id']?>"><?=$file['name']?></option>
							<? }
						 	}
						} 
						 ?>
                        </select>
                      </div>
                    </div>
                
                <div class="form-row control-group row-fluid">
                      <label class="control-label span1"><span class="hint-field">Courses</span></label>
                      <div class="controls span7">
                      <?
						if(!empty($tutors)){
							$courses_item = str_replace(array("[", "]",  '"'),'',$tutors);					
							$courses_item = explode(',',$courses_item);
						}			  
					  ?>
                        <select data-placeholder="Choose Multiple Courses" class="chzn-select" name="courses[]" multiple="true" tabindex="5">
                        <? if(isset($all_courses)){  ?>
                        <?php  foreach ($all_courses as $course){
							if(in_array($course['id'], $courses_item)){ 									
							?>
									<option selected="selected" value="<?=$course['id']?>"><?=$course['name']?></option>
							<? } 
							else
							{ ?>	
									
									<option value="<?=$course['id']?>"><?=$course['name']?></option>
							<? } 
						 	}
						} 
						 ?>
                        </select>
                      </div>
                    </div>
                <!--<div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              <?php //echo lang('company');?>
              Company<span class="help-block"></span></label>
            <div class="controls span7">
              <?php
			$data	= array('name'=>'company', 'value'=>set_value('company', $company), 'class'=>'span12');
			echo form_input($data); ?>
            </div>
          </div>-->
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field">
                  <?php //echo lang('firstname');?>
                  First Name<span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
			$data	= array('name'=>'firstname', 'value'=>set_value('firstname', $firstname), 'class'=>'span12');
			echo form_input($data); ?>
                  </div>
                </div>				
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field">
                  <?php //echo lang('lastname');?>
                  Last Name<span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
			$data	= array('name'=>'lastname', 'value'=>set_value('lastname', $lastname), 'class'=>'span12');
			echo form_input($data); ?>
                  </div>
                </div>
                
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('street_address');?><span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
            $data    = array('name'=>'street_address', 'value'=>set_value('street_address', $street_address) ,'class' => 'span12');
            echo form_input($data);
            ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('address_line_op');?><span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
            $data    = array('name'=>'address_line_op', 'value'=>set_value('address_line_op', $address_line_op) ,'class' => 'span12');
            echo form_input($data);
            ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('city');?><span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
            $data    = array('name'=>'city', 'value'=>set_value('city', $city) ,'class' => 'span12');
            echo form_input($data);
            ?>
                  </div>
                </div>
                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('postcode');?><span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
            $data    = array('name'=>'zip_code', 'value'=>set_value('zip_code', $zip_code) ,'class' => 'span6', 'maxlength'=>'6');
            echo form_input($data);
            ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                      <label class="control-label span1" for="default-select"><?php echo lang('country');?> </label>
                      <div class="controls span7">
                      <?php
                      echo form_dropdown('country',$countries_menu,set_value('state', $state),'class="chzn-select"','id="country_id"');
                       ?>
                      </div>
                    </div>
                    <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('state');?><span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
                   
                    echo form_dropdown('state',$zones_menu,set_value('country', $country),'class="chzn-select"','id="f_zone_id"');
                    ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('telephone');?><span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
            $data    = array('name'=>'telephone', 'value'=>set_value('telephone', $telephone) ,'class' => 'span12');
            echo form_input($data);
            ?>
                  </div>
                </div>
                    
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field">
                  <?php //echo lang('phone');?>
                  Phone<span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
			$data	= array('name'=>'phone', 'value'=>set_value('phone', $phone), 'class'=>'span12');
			echo form_input($data); ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('email');?><span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
			$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'span12');
			echo form_input($data); ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field">
                  <?php //echo lang('password');?>
                  Password<span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
			$data	= array('name'=>'password', 'class'=>'row-fluid valid' , 'placeholder'=>'min 5 characters');
			echo form_password($data); ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field">
                  <?php //echo lang('confirm');?>
                  Confirm Password<span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
			$data	= array('name'=>'confirm', 'class'=>'row-fluid','placeholder'=>'Confirm');
			echo form_password($data); ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><?php echo lang('description');?> <span class="help-block"></span></label>
                  <div class="controls span7">
                    <?php
                                $data	= array('name'=>'description', 'class'=>'redactor', 'value'=>set_value('description', $description));
                                echo form_textarea($data);
                                ?>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="text">Comment</label>
                  <div class="controls span7">
                    <textarea id="text" rows="3"  name="comments" class="row-fluid"><? echo set_value('comments', $comments); ?></textarea>
					
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="search-input">File upload</label>
                  <div class="controls span7">
                    <div class="input-append row-fluid">
                      <input type="file" name="avatar" class="spa1n6 fileinput" id="search-input">
					</div>
                  </div>
                </div>                
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><span class="help-block"></span></label>
                  <label class="checkbox">
                  <?php $data	= array('name'=>'email_subscribe', 'value'=>1, 'checked'=>(bool)$email_subscribe);
				echo form_checkbox($data).' '.lang('email_subscribed'); ?>
                  Email Subscribed </label>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field"><span class="help-block"></span></label>
                  <label class="checkbox">
                  <?php
				$data	= array('name'=>'active', 'value'=>1, 'checked'=>$active);
				echo form_checkbox($data).' '.lang('active'); ?>
                  </label>
                </div>
              </div>
              <div class="tab-pane fade" id="qualification">
			  <div id="degree_inner_table" >
				<? 
				$degree_counter = 0;
				if(count($all_degree)>0) {					
					foreach($all_degree as $degree_data){
						$degree_counter = $degree_counter + 1;
				 ?>
						<div id="degree_inner_row_<?=$degree_counter?>" >
							<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="hint-field">Degree Title<span class="help-block"></span></label>
							  <div class="controls span7">					
							 <input type="text" name="degree_title[]"  class="span12" value="<?=$degree_data->degree_title?>"/>
							  </div>
							</div>
							<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label>
							  <div class="controls span7">
								<label for="date"> Date (M-D-Y) </label>
								<input type="text" name="degree_start[]" id="degree_start_<?=$degree_counter?>" class="span12" onclick="show_date('degree_start_<?=$degree_counter?>')"  value="<?=$degree_data->degree_start?>"/>
								<label for="date"> Date (M-D-Y) </label>
								<input type="text" name="degree_end[]" id="degree_end_<?=$degree_counter?>" class="span12" onclick="show_date('degree_end_<?=$degree_counter?>')" value="<?=$degree_data->degree_end?>"/>
							  </div>
							</div>
							<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="text">Description</label>
							  <div class="controls span7">
								<textarea id="text" rows="3" class="row-fluid" name="degree_description[]"><?=$degree_data->degree_description?></textarea>
							  </div>
							   <a href="javascript:void(0)" class="btn btn-danger btn-mini"  onclick="remove_item('degree_inner_row_<?=$degree_counter?>')" style="margin-left:110px;"><i class="icon-remove"></i> Remove Item</a>
							</div>					
						</div>
					<?
						}
					}
					else
					{?>
					
						<div id="degree_inner_row_1" >
						<div class="form-row control-group row-fluid">
						  <label class="control-label span1" for="hint-field">Degree Title<span class="help-block"></span></label>
						  <div class="controls span7">					
						 <input type="text" name="degree_title[]"  class="span12"/>
						  </div>
						</div>
						<div class="form-row control-group row-fluid">
						  <label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label>
						  <div class="controls span7">
							<label for="date"> Date (M-D-Y) </label>
							<input type="text" name="degree_start[]" id="degree_start_1" class="span12" onclick="show_date('degree_start_1')" />
							<label for="date"> Date (M-D-Y) </label>
							<input type="text" name="degree_end[]" id="degree_end_1" class="span12" onclick="show_date('degree_end_1')"/>
						  </div>
						</div>
						<div class="form-row control-group row-fluid">
						  <label class="control-label span1" for="text">Description</label>
						  <div class="controls span7">
							<textarea id="text" rows="3" class="row-fluid" name="degree_description[]"></textarea>
						  </div>
						</div>					
					  </div>
					
					
					<? }
					?>
				</div>
				
				<div id="addnew"></div>
					<div class="row-fluid" style="padding-left:110px;"> <a href="javascript:void(0)" class="btn" id="btn_add_item" onclick="add_degree_clon()" style="margin-right: 5px;"><i class="icon-plus-sign"></i> Add Item</a> </div>
              </div>
              <div class="tab-pane fade" id="experience">
			  	<div id="desig_inner_table" >
				<? 
				$desig_counter = 0;
				if(count($all_desig)>0) {					
					foreach($all_desig as $desig_data){
						$desig_counter = $desig_counter + 1;
				 ?>
					<div id="desig_inner_row_<?=$desig_counter?>" >
					<div class="form-row control-group row-fluid">
					  <label class="control-label span1" for="hint-field">Desig Title<span class="help-block"></span></label>
					  <div class="controls span7">						
						 <input type="text" name="desig_title[]" class="span12" value="<?=$desig_data->desig_title?>" />
					  </div>
					</div>
					<div class="form-row control-group row-fluid">
					  <label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label>
					  <div class="controls span7">
						<label for="date"> Date (M-D-Y) </label>
						<input type="text" name="desig_start[]" id="desig_start_<?=$desig_counter?>" class="span12" onclick="show_date('desig_start_<?=$desig_counter?>')" value="<?=$desig_data->desig_start?>" />
						<label for="date"> Date (M-D-Y) </label>
						<input type="text" name="desig_end[]" id="desig_end_<?=$desig_counter?>" class="span12" onclick="show_date('desig_end_<?=$desig_counter?>')" value="<?=$desig_data->desig_end?>"/>
					  </div>
					</div>                                
					<div class="form-row control-group row-fluid">
					  <label class="control-label span1" for="text">Description</label>
					  <div class="controls span7">
						<textarea id="text" rows="3" class="row-fluid" name="desig_description[]"><?=$desig_data->desig_description?></textarea>
					  </div>
					   <a href="javascript:void(0)" class="btn btn-danger btn-mini"  onclick="remove_item('desig_inner_row_<?=$desig_counter?>')" style="margin-left:110px;"><i class="icon-remove"></i> Remove Item</a>
					</div>
				</div>
				<?
						}
					}
					else
					{?>
						<div id="desig_inner_row_1" >
							<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="hint-field">Desig Title<span class="help-block"></span></label>
							  <div class="controls span7">
								<?php
								 $data	= array('name'=>'desig_title[]', 'class'=>'span12');
								 echo form_input($data); ?>
							  </div>
							</div>
							<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label>
							  <div class="controls span7">
								<label for="date"> Date (M-D-Y) </label>
								<input type="text" name="desig_start[]" id="desig_start_1" class="span12" onclick="show_date('desig_start_1')" />
								<label for="date"> Date (M-D-Y) </label>
								<input type="text" name="desig_end[]" id="desig_end_1" class="span12" onclick="show_date('desig_end_1')"/>
							  </div>
							</div>                                
							<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="text">Description</label>
							  <div class="controls span7">
								<textarea id="text" rows="3" class="row-fluid" name="desig_description[]"></textarea>
							  </div>
							</div>
						</div>
					<? } ?>
				</div>
				<div id="addnew"></div>
				<div class="row-fluid" style="padding-left:110px;"> <a href="javascript:void(0)" class="btn"  onclick="add_desig_clon()" style="margin-right: 5px;"><i class="icon-plus-sign"></i> Add Item</a> </div>
              </div>
              <div class="tab-pane fade" id="achievement">
			  	<div id="achiev_inner_table" >
				<? 
				$achiev_counter = 0;
				if(count($all_achiev)>0) {
					$achiev_counter = 0;
					foreach($all_achiev as $achiev_data){
					$achiev_counter = $achiev_counter + 1;	
				 ?>
					<div id="achiev_inner_row_<?=$achiev_counter?>" >
						<div class="form-row control-group row-fluid">
						  <label class="control-label span1" for="hint-field">Achievement Title<span class="help-block"></span></label>
						  <div class="controls span7">
						    <input type="text" name="achiev_title[]" class="span12" value="<?=$achiev_data->achiev_title?>" />
						  </div>
						</div>
						<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label>
							  <div class="controls span7">
								<label for="date"> Date (M-D-Y) </label>
								<input type="text" name="achiev_start[]" id="achiev_start_<?=$achiev_counter?>" class="span12" onclick="show_date('achiev_start_<?=$achiev_counter?>')" value="<?=$achiev_data->achiev_start?>" />								
							  </div>
						</div>
						<div class="form-row control-group row-fluid">
						  <label class="control-label span1" for="text">Description</label>
						  <div class="controls span7">
							<textarea id="text" rows="3" class="row-fluid" name="achiev_description[]" ><?=$achiev_data->achiev_description?></textarea>
						  </div>
						  <a href="javascript:void(0)" class="btn btn-danger btn-mini"  onclick="remove_item('achiev_inner_row_<?=$achiev_counter?>')" style="margin-left:110px;"><i class="icon-remove"></i> Remove Item</a>
						</div>
						
						 
						
					</div>
					<?
						}
					}
					else
					{?>
					 <div id="achiev_inner_row" >
						<div class="form-row control-group row-fluid">
						  <label class="control-label span1" for="hint-field">Achievement Title<span class="help-block"></span></label>
						  <div class="controls span7">
						  <?php
							$data	= array('name'=>'achiev_title[]', 'class'=>'span12');
							echo form_input($data); 
						  ?>
						  </div>
						</div>
						<div class="form-row control-group row-fluid">
							  <label class="control-label span1" for="hint-field"> Year <span class="help-block"></span></label>
							  <div class="controls span7">
								<label for="date"> Date (M-D-Y) </label>
								<input type="text" name="achiev_start[]" id="achiev_start_1" class="span12" onclick="show_date('achiev_start_1')" />								
							  </div>
						</div>
						<div class="form-row control-group row-fluid">
						  <label class="control-label span1" for="text">Description</label>
						  <div class="controls span7">
							<textarea id="text" rows="3" class="row-fluid" name="achiev_description[]" ></textarea>
						  </div>
						</div>
					</div>
					
				<? }
				 ?>	
				</div>
				
				<div id="addnew"></div>
				<div class="row-fluid" style="padding-left:110px;"> <a href="javascript:void(0)" class="btn"  onclick="add_achiev_clon()" style="margin-right: 5px;"><i class="icon-plus-sign"></i> Add Item</a> </div>
              </div>
              <div class="tab-pane fade" id="extra">
                <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="text">Description</label>
                  <div class="controls span7">
                    <textarea id="text" rows="3" class="row-fluid" name="extra_info"><?=set_value('extra_info', $extra_info)?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .span4 -->
            <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
			</form>
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


