<div id="login_page">
<!-- Login page -->
<div id="login">

  <?php
	//lets have the flashdata overright "$message" if it exists
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	if($this->session->flashdata('error'))
	{
		$error	= $this->session->flashdata('error');
	}
	
	if(function_exists('validation_errors') && validation_errors() != '')
	{
		$error	= validation_errors();
	}
	?>
  <div id="js_error_container" class="alert alert-error" style="display:none;">
    <p id="js_error"></p>
  </div>
  <div id="js_note_container" class="alert alert-note" style="display:none;"> </div>
  <?php if (!empty($message)): ?>
  <div class="alert alert-success"> <a class="close" data-dismiss="alert">×</a> <?php echo $message; ?> </div>
  <?php endif; ?>
  <?php if (!empty($error)): ?>
  <div class="alert alert-error"> <a class="close" data-dismiss="alert">×</a> <?php echo $error; ?> </div>
  <?php endif; ?>

  <div class="row-fluid fluid">
    <div class="span5"><img src="<?=base_url().ASSETS_PATH?>img/thumbnail_george2.jpg"/></div>
    <div class="span7">
      <div class="title"><span class="name">Login</span><span class="subtitle"></span></div>
      <?php echo form_open($this->config->item('admin_folder').'/login') ?>
      <div class="input-append row-fluid"> <?php echo form_input(array('name'=>'email', 'class'=>'row-fluid search-query', 'placeholder'=>lang('email'))); ?> </div>
      <div>
        <div class="input-append row-fluid"> <?php echo form_password(array('name'=>'password', 'class'=>'row-fluid search-query', 'placeholder'=>lang('password'))); ?>
          <input class="btn color_4" id="submit_btn" type="submit" value="<?php echo lang('login');?>"/>Go
        </div>
        <div>
          <div class="form-row control-group row-fluid ">
            <div class="controls span8">
              <label class="checkbox"> <?php echo form_checkbox(array('name'=>'remember', 'value'=>'true', 'id'=>'inlineCheckbox1'))?> <?php echo lang('stay_logged_in');?> </label>
            </div>
          </div>
          <input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
          <input type="hidden" value="submitted" name="submitted"/>
          <b></b> </div>
        <div>
          <a class="btn btn-secondary"   href="<?=base_url().$this->config->item('admin_folder').'/admin_signup';?>">Sign Up</a>
          <button type="button" class="btn btn-secondary">Forget Password</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End #login -->
  <!-- <img src="img/ajax-loader.gif"> -->
</div>
