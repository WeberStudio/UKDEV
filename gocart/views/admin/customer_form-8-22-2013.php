<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); 
?>
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
            <h4> <i class=" icon-bar-chart"></i>Customer Form </h4>  
            </div>           <!-- End .title --> 
<div class="content"> 
<?php echo form_open($this->config->item('admin_folder').'/customers/form/'.$id, array('class' => '', 'id' => 'validateForm')); ?>

    		<div class="form-row control-group row-fluid"> 
	   			<label class="control-label span1" for="hint-field"><?php echo lang('company');?><span class="help-block"></span></label>
			       <div class="controls span7"> <?php
			$data	= array('name'=>'company', 'value'=>set_value('company', $company), 'class'=>'span12');
			echo form_input($data); ?>
		</div>
	</div>
            <div class="form-row control-group row-fluid">  
	   		<label class="control-label span1" for="hint-field"><?php echo lang('firstname');?><span class="help-block"></span></label>
			<div class="controls span7"><?php
			$data	= array('name'=>'firstname', 'value'=>set_value('firstname', $firstname), 'class'=>'span12');
			echo form_input($data); ?>
		</div>  </div>
			<div class="form-row control-group row-fluid">
			<label class="control-label span1" for="hint-field"><?php echo lang('lastname');?><span class="help-block"></span></label>
			<div class="controls span7"><?php
			$data	= array('name'=>'lastname', 'value'=>set_value('lastname', $lastname), 'class'=>'span12');
			echo form_input($data); ?>
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
              <label class="control-label span1" for="hint-field"><?php echo lang('postcode');?><span class="help-block"></span></label>
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
				 // print_r($countries_menu as $key => $name);
				 // $js = 'onchange="get_all_states();"';
				  //echo form_dropdown('country',$countries_menu,set_value('country', $country), 'class="chzn-select"',$js);
				   ?>
				   <select data-placeholder="Choose Multiple Categories" class="chzn-select" name="country" id="country_id"  onchange="get_zones()" >
				   <?  foreach($countries_menu as $key => $name){ ?>				   
						<option <? if(match_string($name,  $country)){ echo 'selected';} ?> <? if($country == $key){ echo 'selected';}?> value="<?=$key?>"><?=$name?></option>				
					<? } 
							
					?>
				
				  </select>
				  	
                  </div>
                </div>
            <div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field"><?php echo lang('state');?><span class="help-block"></span></label>
              <div class="controls span7" id="stat_div">
                <?php				
				//echo form_dropdown('state',$zones_menu,set_value('state', $state),'class="chzn-select"','id="f_zone_id"');
				?>
				<select data-placeholder="Choose Multiple Categories" class="chzn-select" name="state" id="f_zone_id"   >
				   <?  foreach($zones_menu as $key => $name){ ?>				   
						<option <? if(match_string($name,  $state)){ echo 'selected';} ?> <? if($state == $key){ echo 'selected';}?> value="<?=$key?>"><?=$name?></option>	
									
					<?
				
					 } ?>
				</select>
				
              </div>
            </div>
            <!--<div class="form-row control-group row-fluid">
              <label class="control-label span1" for="hint-field"><?php echo lang('telephone');?><span class="help-block"></span></label>
              <div class="controls span7">
                <?php
        $data    = array('name'=>'telephone', 'value'=>set_value('telephone', $telephone) ,'class' => 'span12');
        echo form_input($data);
        ?>
              </div>
            </div>-->
            <div class="form-row control-group row-fluid"> 
			<label class="control-label span1" for="hint-field"><?php echo lang('email');?><span class="help-block"></span></label>
			<div class="controls span7"><?php
			$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'span12');
			echo form_input($data); ?>
		</div> 
        </div>    
			<div class="form-row control-group row-fluid">   
			<label class="control-label span1" for="hint-field"><?php echo lang('phone');?><span class="help-block"></span></label>
			<div class="controls span7"><?php
			$data	= array('name'=>'phone', 'value'=>set_value('phone', $phone), 'class'=>'span12');
			echo form_input($data); ?>
		</div>
	</div>                                             
        	<div class="form-row control-group row-fluid">  
		<label class="control-label span1" for="hint-field"><?php echo lang('password');?><span class="help-block"></span></label>
	    <div class="controls span7"><?php
			$data	= array('name'=>'password', 'class'=>'span12');
			echo form_password($data); ?>
		</div> </div> 
			<div class="form-row control-group row-fluid">   
			<label class="control-label span1" for="hint-field"><?php echo lang('confirm');?><span class="help-block"></span></label>
			<div class="controls span7"><?php
			$data	= array('name'=>'confirm', 'class'=>'span12');
			echo form_password($data); ?>
		</div>
	</div>
			<div class="form-row control-group row-fluid">
		<label class="control-label span1" for="hint-field"><span class="help-block"></span></label>   
        <label class="checkbox">
<?php $data	= array('name'=>'email_subscribe', 'value'=>1, 'checked'=>(bool)$email_subscribe);
			echo form_checkbox($data).' '.lang('email_subscribed'); ?>
			</label>
		</div>
     		<div class="form-row control-group row-fluid"> 
        <label class="control-label span1" for="hint-field"><span class="help-block"></span></label>      
       <label class="checkbox">
				<?php
				$data	= array('name'=>'active', 'value'=>1, 'checked'=>$active);
				echo form_checkbox($data).' '.lang('active'); ?>
			</label>
		</div>

	         <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
   </form>
 </div>
        <!-- End .span4 --> 
      </div>
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>
</div>
</div>
<?
	function match_string($string,  $key)
	{
		
		$string 	= strtolower($string);
		$key 		= strtolower($key);
		if (strpos($string ,$key) !== false)
		{ 
			return true; 
		}
		else
		{ 
			return false; 
		}
			
	}
?>
<script type="text/javascript">
  var j = jQuery.noConflict();
j(function(){
	j('#country_id').change(function(){
	alert('dfsfs');
		/*	j.post('<?php echo site_url('locations/get_zone_menu');?>',{id:j('#country_id').val()}, function(data) {
			  j('#f_zone_id').html(data);
			});*/
			
		});
});
function get_zones()
{
		var level_value = $('#country_id').val();
		var path =  "<?php echo site_url('locations/get_zone_full_menu');?>";		
		var dataString = 'id='+level_value;
		$.ajax({
			url: path, 
			data: dataString,
			type:'POST', 
			success: function(data){
			$("#stat_div").html('');
				$("#stat_div").html(data);			
				//alert(data);
			}
		});
		
}
</script>