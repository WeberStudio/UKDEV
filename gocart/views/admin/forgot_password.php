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
  <div id="main_container">
	 <div class="row-fluid fluid"><h1>Forgot Password</h1></div>
    <div class="row-fluid fluid">
      <div class="span7">      
        <? $attributes = array('class' => 'bs-docs-example form-horizontal');?>
        <?php echo form_open($this->config->item('admin_folder').'/login/forgot_password',$attributes) ?>
        <div class="input-append row-fluid"> <?php echo form_input(array('name'=>'email', 'class'=>'row-fluid search-query', 'placeholder'=>lang('email'))); ?> </div>
            <div class="input-append row-fluid">
                <input type="hidden" value="submitted" name="submitted">
                <button type="submit" name="submit" class="btn btn-primary">Reset Password</button>
                <button type="button" class="btn btn-secondary" onClick="history.go(-1)">Back</button>
            </div>  
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End #login -->
  <!-- <img src="img/ajax-loader.gif"> -->
</div>
</div>