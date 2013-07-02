<?php //include('header.php');
$f_company	= array('name'=>'company','class'=>'span12', 'value'=> set_value('company',$company));
$f_address1	= array('name'=>'address1', 'class'=>'span12','value'=>set_value('address1',$address1));
$f_address2	= array('name'=>'address2', 'class'=>'span12','value'=> set_value('address2',$address2));
$f_first	= array('name'=>'firstname', 'class'=>'span12','value'=> set_value('firstname',$firstname));
$f_last		= array('name'=>'lastname', 'class'=>'span12','value'=> set_value('lastname',$lastname));
$f_email	= array('name'=>'email', 'class'=>'span12','value'=>set_value('email',$email));
$f_phone	= array('name'=>'phone', 'class'=>'span12','value'=> set_value('phone',$phone));
$f_city		= array('name'=>'city','class'=>'span12', 'value'=>set_value('city',$city));
$f_zip		= array('maxlength'=>'10', 'class'=>'span12', 'name'=>'zip', 'value'=> set_value('zip',$zip));
?>
<div id="main" style="min-height:1000px">
  <div class="container">
    <div class="header row-fluid">
      <div class="logo"> <a href="index.html"><span>Start</span><span class="icon"></span></a> </div>
      <div class="top_right">
        <ul class="nav nav_menu">
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="../../page.html">
            <div class="title"><span class="name">George</span><span class="subtitle">Future Buyer</span></div>
            <span class="icon"><img src="<?=base_url().ASSETS_PATH?>img/thumbnail_george.jpg"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <li><a href="profile.html"><i class=" icon-user"></i> My Profile</a></li>
              <li><a href="forms_general.html"><i class=" icon-cog"></i>Settings</a></li>
              <li><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><i class=" icon-unlock"></i><?php echo lang('common_log_out') ?></a></li>
              <li><a href="search.html"><i class=" icon-flag"></i>Help</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- End top-right -->
      </div>
    <div id="main_container">
      <div class="row-fluid">
        <div class="span7">
          <div class="box paint color_4">
            <div class="title">
            <h4> <i class=" icon-bar-chart"></i><?php echo  $page_title; ?> </h4>  
            </div>           <!-- End .title --> 
<div class="content"> 

<?php echo form_open($this->config->item('admin_folder').'/customers/address_form/'.$customer_id.'/'.$id, array('class' => 'form-horizontal cmxform', 'id' => 'validateForm'));?>

	  <div class="form-row control-group row-fluid">    
      <label class="control-label span3" for="hint-field"><?php echo lang('company');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_company);?>  </div>
	</div>

<div class="form-row control-group row-fluid"> 
					<label class="control-label span3" for="hint-field"><?php echo lang('firstname');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_first);?>
		</div>       </div>
        <div class="form-row control-group row-fluid"> 
			<label class="control-label span3" for="hint-field"><?php echo lang('lastname');?><span class="help-block"></span></label>
			            <div class="controls span7"><?php echo form_input($f_last);?>
		</div>
	</div>

<div class="form-row control-group row-fluid">  
			<label class="control-label span3" for="hint-field"><?php echo lang('email');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_email);?>
		</div> 
   </div>
		<div class="form-row control-group row-fluid">
			<label class="control-label span3" for="hint-field"><?php echo lang('phone');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_phone);?>
		</div>
	</div>

<div class="form-row control-group row-fluid">  
			<label class="control-label span3" for="hint-field"><?php echo lang('country');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_dropdown('country_id', $countries_menu, set_value('country_id', $country_id), 'id="f_country_id" class="span6"');?>
		</div>
	</div>

<div class="form-row control-group row-fluid"> 
			<label class="control-label span3" for="hint-field"><?php echo lang('address');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_address1);?>
		</div>
	</div>

<div class="form-row control-group row-fluid">  
		      <label class="control-label span3" for="hint-field"><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_address2);?>
		</div>
	</div>

<div class="form-row control-group row-fluid"> 

			<label class="control-label span3" for="hint-field"><?php echo lang('city');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_city);?>
		</div>  </div>
<div class="form-row control-group row-fluid">   
			<label class="control-label span3" for="hint-field"><?php echo lang('state');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_dropdown('zone_id', $zones_menu, set_value('zone_id', $zone_id), 'id="f_zone_id" class="span12"');?>
		</div>  </div>
<div class="form-row control-group row-fluid">  
			<label class="control-label span3" for="hint-field"><?php echo lang('postcode');?><span class="help-block"></span></label>
			<div class="controls span7"><?php echo form_input($f_zip);?>
		</div>
	</div>

<div class="form-actions row-fluid">   
		<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.button').button();
	
		$('#f_country_id').change(function(){
			$.post('<?php echo site_url($this->config->item('admin_folder').'/locations/get_zone_menu');?>',{id:$('#f_country_id').val()}, function(data) {
			  $('#f_zone_id').html(data);
			});
	
		});
	});
	</script>
</form>
</div>
        <!-- End .span4 --> 
      </div>
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>
  </div>

<?php // include('footer.php');