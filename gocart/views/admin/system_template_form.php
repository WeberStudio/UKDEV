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
              <h4><?php echo lang('title');?></h4>
            </div>
          </div>
          <div class="content"> <?php echo form_open_multipart($this->config->item('admin_folder').'/system_templates/form/'.$id); ?>
            <div class="tab-content">
              <div class="tab-pane active" id="description_tab">
                <fieldset>
               <label for="name"><?php echo lang('template_title');?></label>
				<?php 
				$data    = array('name'=>'email_type', 'id'=>'email_type', 'value'=>set_value('email_type', $email_type), 'class'=>'span12');
				echo form_input($data);
				?>
				<label for="description"><?php echo lang('header_html');?></label>
				<?php
					$data    = array('name'=>'email_header', 	'id'=>'email_header', 	'class'=>'redactor', 'value'=>set_value('email_header', stripslashes($email_header)));
					echo form_textarea($data);
				?>
				<label for="description"><?php echo lang('middle_content');?></label>
				<?php
					$data    = array('name'=>'middle_content', 	'id'=>'middle_content',  'style' => 'width:100%','value'=>set_value('middle_content', $middle_content));
					echo form_textarea($data);
				?>
				<label for="description"><?php echo lang('footer_html');?></label>
				<?php
					$data    = array('name'=>'email_footer',   'class'=>'redactor', 'value'=>set_value('invoice_template_footer', stripslashes($email_footer)));
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
