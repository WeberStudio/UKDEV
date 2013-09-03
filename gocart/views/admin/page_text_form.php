<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); 
?>

<div id="main" style="min-height:1000px">
<div class="container">
<? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>
<!--========  velidation error end   ==========-->
<?php echo form_open_multipart($this->config->item('admin_folder').'/pages/page_text_form/'.$id); ?>
<div id="main_container">
  <div class="row-fluid">
    <div class="span12">
      <div class="box paint color_13">
        <div class="title">
          <h4> <i class=" icon-bar-chart"></i>Home Page Content Form </h4>
        </div>
        <!-- End .title -->
		
        <div class="content">
		
				<div class="tab-pane fade in active" id="content">
         

      
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              <?php echo lang('title');?><span class="help-block"></span></label>
            <div class="controls span7">
              <?php
			$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'span12');
			echo form_input($data); ?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field"><?php echo lang('content');?> <span class="help-block"></span></label>
            <div class="controls span7">
              <?php
					$data	= array('name'=>'content', 'class'=>'redactor', 'value'=>set_value('content', $content));
				echo form_textarea($data);
				?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">File upload</label>
                  <div class="controls span7">
                    <div class="input-append row-fluid">
                      <input type="file" class="spa1n6 fileinput" id="search-input" name="image">
                      > </div>
                  </div>
                </div>
          </div>
		
		
		
        
        <!-- End .span4 -->
		 <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button> 
      </div>
	  </form>
	  <!-------end content------>
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>
</div>
</div>
</div>

