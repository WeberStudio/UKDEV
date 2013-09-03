<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); 
?>
<div id="main" style="min-height:1000px">
<div class="container">
<? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
<div id="main_container">
  <div class="row-fluid">
    <div class="span12">
      <div class="box paint color_14">
        <div class="title">
          <h4> <i class=" icon-bar-chart"></i>Add Topic </h4>
        
        <!-- End .title -->
        <div class="content">
		<div class="tab-pane fade in active" id="form">
          <?php echo form_open($this->config->item('admin_folder').'/forums/topic_form/'.$forum_id.'/'.$id, array('class' => '', 'id' => 'validateForm')); ?>
 			<div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              Title
              <span class="help-block"></span></label>
            <div class="controls span7">
			<input type="text" class="span12" name="topic_title" value="<?=set_value('topic_title', $topic_title)?>">
            </div>
          </div>
		  <div class="form-row control-group row-fluid">
                  <label class="control-label span1" for="hint-field">Message: <span class="help-block"></span></label>
                  <div class="controls span7">
				  <textarea name="topic_message" class="redactor" ><?=set_value('topic_message', $topic_message)?></textarea>
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

