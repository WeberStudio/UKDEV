<div id="signup_page">
<!-- Login page -->
<div id="signup_fields">

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
    <div class="span7 box paint color_0">
    
              <form class="form-horizontal cmxform" id="validateForm" method="post" action="<?=base_url().ADMIN_PATH?>login/admin_signup" autocomplete="on">
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3">COMPANY <span class="help-block"></span> </label>
                  <div class="controls span7">
                    <input id="company" name="company" type="text" required class="span12" value="<?=set_value('company', $company)?>"/>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">First Name<span class="help-block"></span> </label>
                  <div class="controls span7">
                    <input id="firstname" name="firstname" minlength="3" type="text" required class="row-fluid" value="<?=set_value('firstname', $firstname)?>"/>
                  </div></div>
                  <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="hint-field">Last Name<span class="help-block"></span> </label>
                  <div class="controls span7">
                    <input id="lastname" name="lastname" minlength="3" type="text" required class="row-fluid" value="<?=set_value('lastname', $lastname)?>"/>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3">Email Address <span class="help-block">Enter a valid email address</span> </label>
                  <div class="controls span7">
                    <input id="email" type="email" name="email" required class="row-fluid" value="<?=set_value('email', $email)?>"/>
                  </div>
                </div>
                 <div class="form-row control-group row-fluid">
                  <label class="control-label span3">Phone <span class="help-block">Enter a valid email phone number</span> </label>
                  <div class="controls span7">
                    <input id="phone" type="text" name="phone" required class="row-fluid" value="<?=set_value('phone', $phone)?>"/>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3">URL Address <span class="help-block">http://www.envato.com</span> </label>
                  <div class="controls span7">
                    <input id="url" type="url" name="url" required class="row-fluid" value="<?=set_value('url', $url)?>"/>
                  </div>
                </div>
                <div class="form-row control-group row-fluid">
                  <label class="control-label span3">Password</label>
                  <div class="controls span7 ">
                    <div class="input-prepend row-fluid"> <span class="add-on"><i class="icon-lock"></i></span>
                      <input class="row-fluid" type="password" id="password" name="password" placeholder="min 6 characters" value="<?=set_value('password', $password)?>">
                    </div>
                  </div>
                </div>
                <div class="control-group row-fluid">
                  <label class="control-label span3">Confirm Password</label>
                  <div class="controls span7">
                    <div class="input-prepend row-fluid"> <span class="add-on"><i class="icon-lock"></i></span>
                      <input class="row-fluid" type="password" id="confirm" placeholder="confirm password" name="confirm" value="<?=set_value('confirm', $confirm)?>">
                    </div>
                  </div>
                </div>              
                <div class="form-actions row-fluid">
                  <div class="span7 offset3">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button type="button" class="btn btn-secondary" onClick="history.go(-1)">Back</button>
                  </div>
                </div>
              </form>
  </div>
  </div>
  <!-- End #login -->
  <!-- <img src="img/ajax-loader.gif"> -->
</div>
