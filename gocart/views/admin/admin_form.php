<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); ?>

<div id="main" style="min-height:1000px">
<div class="container">
  <? include_once('includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>
            
<!--========  velidation error end   ==========-->
  <div id="main_container">
    <div class="row-fluid">
      <div class="span12">
        <div class="box paint color_4">
          <div class="title">
            <h4> <i class=" icon-bar-chart"></i>Administrator Form </h4>
          </div>
          <!-- End .title -->
          <div class="content"> <?php echo form_open_multipart($this->config->item('admin_folder').'/admin/form/'.$id, array('class' => '', 'id' => 'validateForm')); ?>
          
          	<div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field">Admin Access<span class="help-block"></span></label>
              <div class="controls span7">
                <?php
        		$option    = array(''=>' Admin Access','Course Provider'=>'Course Provider','Invoice Admin'=>'Invoice Admin', 'Site Admin'=>'Site Admin');
        		echo form_dropdown('access',$option,set_value('access', $access),'class="chzn-select" id=""');
        		?>
              </div>
            </div>
         	<div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field">Company<span class="help-block"></span></label>
              <div class="controls span7">
                <?php
        $data    = array('name'=>'company', 'value'=>set_value('company', $company) ,'class' => 'span12');
        echo form_input($data);
        ?>
              </div>
            </div>
            <div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field"><?php echo lang('firstname');?><span class="help-block"></span></label>
              <div class="controls span7">
                <?php
        $data    = array('name'=>'firstname', 'value'=>set_value('firstname', $firstname) ,'class' => 'span12');
        echo form_input($data);
        ?>
              </div>
            </div>
            <div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field"><?php echo lang('lastname');?><span class="help-block"></span></label>
              <div class="controls span7">
                <?php
        $data    = array('name'=>'lastname', 'value'=>set_value('lastname', $lastname) ,'class' => 'span12');
        echo form_input($data);
        ?>
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
              <label class="control-label span1" for="hint-field"><?php echo lang('zip_code');?><span class="help-block"></span></label>
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
				  echo form_dropdown('country',$countries_menu,set_value('country', $country),'class="chzn-select"','id="country_id"');
				   ?>
                  </div>
                </div>
            <div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field"><?php echo lang('state');?><span class="help-block"></span></label>
              <div class="controls span7">
                <?php
				
				echo form_dropdown('state',$zones_menu,set_value('state', $state),'class="chzn-select"','id="f_zone_id"');
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
              <label class="control-label span1" for="hint-field"><?php echo lang('email');?><span class="help-block"></span> </label>
              <div class="controls span7">
                <?php
        $data    = array('name'=>'email', 'value'=>set_value('email', $email) ,'class' => 'span12');
        echo form_input($data);
        ?>
              </div>
            </div>
            <div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field">Phone<span class="help-block"></span></label>
              <div class="controls span7">
                <?php
        $data    = array('name'=>'phone', 'value'=>set_value('phone', $phone) ,'class' => 'span12');
        echo form_input($data);
        ?>
              </div>
            </div>
           <div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field">URL<span class="help-block"></span></label>
              <div class="controls span7">
                <?php
        $data    = array('name'=>'url', 'value'=>set_value('url', $url) ,'class' => 'span12');
        echo form_input($data);
        ?>
              </div>
            </div>
          
          <div class="form-row control-group row-fluid">
            <label class="control-label span1"><?php echo lang('password');?></label>
            <div class="controls span7">
              <?php
        $data    = array('name'=>'password' ,'class' => 'span12');
        echo form_password($data);
        ?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
            <label class="control-label span1"><?php echo lang('confirm_password');?></label>
            <div class="controls span7">
              <?php
					$data    = array('name'=>'confirm' ,'class' => 'span12');
					echo form_password($data);
        	  ?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="search-input">Profile Image</label>
            <div class="controls span7">
              <div class="input-append row-fluid">
                <input type="file" class="spa1n6 fileinput" name="image" id="search-input">
              </div>
            </div>
          </div>
          <?php
          	$imageurl = realpath('.')."/uploads/images/small/".$image;
		  	if(file_exists($imageurl))
			{
		  ?>          
			  <?php if(isset($id) && $image != ''):?>
              <div style="text-align:center; padding:5px; border:1px solid #ddd; margin-bottom:5px;"><img src="<?php echo base_url('uploads/images/small/'.$image);?>" alt="current"/><br/>
                <?php echo lang('current_file');?></div>
              <?php endif;?>
              
            <? }else{?>  
            	
                <?php if(isset($id) && $image != ''):?>
              <div style="text-align:center; padding:5px; border:1px solid #ddd; margin-bottom:5px;"><img src="<?php echo base_url('assets/opencollege/admin/img/no-person.png');?>" alt="current"/><br/>
                <?php echo lang('current_file');?></div>
              <?php endif;?>
                
                
            <? } ?>
        
        <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
        </div>
        </form>
        <!-- End .span4 -->
      </div>
      <!-- End .row-fluid -->
    </div>
    <!-- End #container -->
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
<!--<script type="text/javascript">
if ($.browser.webkit) {
    $('input').attr('autocomplete', 'off');
}
$('form').submit(function() {
    $('.btn').attr('disabled', true).addClass('disabled');
});
</script>-->
