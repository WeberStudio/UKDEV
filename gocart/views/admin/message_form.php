<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); 
?>
<div id="main" style="min-height:1000px">
<div class="container">
<? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
<div id="main_container">
  <div class="row-fluid">
    <div class="span12">
      <div class="box paint color_8">
        <div class="title">
          <h4> <i class=" icon-bar-chart"></i>Add Message </h4>
        
        <!-- End .title -->
        <div class="content">
		<div class="tab-pane fade in active" id="form">
		
		
          <?php 
		 
		  if(empty($reply))
		  {
		  		  
			echo form_open($this->config->item('admin_folder').'/forums/message_form/'.$topic_id.'/'.$id, array('class' => '', 'id' => 'validateForm')); 
		  }
		  else
		  {		  	
			echo form_open($this->config->item('admin_folder').'/forums/message_form/'.$topic_id, array('class' => '', 'id' => 'validateForm'));
		  }
		  ?>
 			<div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              Title
              <span class="help-block"></span></label>
            <div class="controls span7">
			<input type="text" class="span12" name="message_title" value="<?=set_value('message_title', $message_title)?>">
            </div>
          </div>
		  <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field">Message: <span class="help-block"></span></label>
                  <div class="controls span7">
				  <textarea name="message_message" class="redactor" ><?=set_value('message_message', $message_message)?></textarea>
                  </div>
                </div>
          
		</div>
		
		<button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
		
		</form>  
        </div>
        <!-- End .span4 -->
		
      </div>
	  <!-------end content------>
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>
</div>
</div>
</div>

