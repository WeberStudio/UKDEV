<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
    <!-- End top-right -->
	
	<!--========  velidation error start    ==========-->
<?php include('error.php');?>
<!--========  velidation error end   ==========-->
	
	
  <div id="main_container">
    <div class="row-fluid">
      <div class="span12">
        <div class="box paint color_5">
          <div class="title">
            <div class="row-fluid">
              <h4>Create New Email</h4>
            </div>
          </div>
          <div class="content"> <?php echo form_open_multipart($this->config->item('admin_folder').'/default_emails/form/'.$id); ?>
            <div class="tab-content">
			
              <div class="tab-pane active" id="description_tab">
                <fieldset>
               <label for="name">Email Title</label>
				<?php 
				$data    = array('name'=>'email_type', 'id'=>'email_type', 'value'=>set_value('email_type', $email_type), 'class'=>'span12');
				echo form_input($data);
				?>
				<div class="control-group row-fluid">
				<label class="control-label span2">Select Email Template<?php echo lang('group');?><span class="help-block"></span></label>
				<div class="controls span7">
				  <select data-placeholder="Choose Multiple Categories" class="chzn-select span12" name="email_template" id="levels"   >
					<? foreach($all_email_temp as $email_temp){ ?>
					
					<option <?=($email_temp->email_id == $email_template ? 'selected' : '');?> value="<?=$email_temp->email_id?>"><?=$email_temp->email_type?></option>				
					<? } ?>
				  </select>
				</div>
			  </div>			
				
				<label for="description"><?php echo lang('middle_content');?></label>
				<?php
					$data    = array('name'=>'middle_content', 	'id'=>'middle_content', 	'class'=>'redactor', 'value'=>set_value('middle_content', stripslashes($middle_content)));
					echo form_textarea($data);
				?>
			
				</fieldset>
              </div>
            </div>
            <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $('form').submit(function() {
        $('.btn').attr('disabled', true).addClass('disabled');
    });
</script>