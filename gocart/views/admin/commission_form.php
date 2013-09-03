<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); ?>
<div id="main" style="min-height:1000px">
<div class="container">
<? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>
<!--========  velidation error end   ==========-->
<div id="main_container">
  <div class="row-fluid">
    <div class="span12">
      <div class="box paint color_18">
        <div class="title">
          <h4> <i class=" icon-bar-chart"></i>Add Commision</h4>        
        <!-- End .title -->
        <div class="content">		
		<div class="tab-pane fade in active" id="form">
          <?php echo form_open($this->config->item('admin_folder').'/commission/form/'.$id, array('class' => '', 'id' => 'validateForm')); ?>
 
          <div class="control-group row-fluid">
            <label class="control-label span1">Commission Level<?php echo lang('group');?><span class="help-block"></span></label>
            <div class="controls span7">
              <select data-placeholder="Choose Multiple Categories" class="chzn-select span12" name="comm_level" id="levels"  onchange="get_all_site_customers()" >
                <option value="universal">Universal Level</option>				
				<option value="cat_level">Category Level</option>
				<option value="course_level">Course Level</option>
				<option value="course_provider">Courses Providor Level</option>
              </select>
            </div>
          </div>
          <div class="control-group row-fluid">
            <label class="control-label span1">Options<?php echo lang('group');?><span class="help-block"></span></label>
            <div class="controls span7" id="dyn-fropdonw">
              <select data-placeholder="Choose Multiple Categories" class="chzn-select span12" name="comm_level_id"  tabindex="5">
                <option>Select Option</option>
              </select>			  
            </div>
		 </div>
		  <div class="control-group row-fluid">
            <label class="control-label span1">Commission Rate<?php echo lang('group');?><span class="help-block"></span></label>
            <div class="controls span7">
             <input type="text" name="comm_rate" value="<?=set_value('comm_rate', $comm_rate)?>" />
            </div>
          </div>
		  <div class="control-group row-fluid">
            <label class="control-label span1">Ammount<?php echo lang('group');?><span class="help-block"></span></label>
            <div class="controls span6">
				<label class="control-label span3">
              <input type="radio" name="comm_rate_mode" value="%" <? if($comm_rate_mode=='%'){ echo 'checked';} ?>  >
			  Persentage
			  </label>
			  <label class="control-label span3">
              <input type="radio" name="comm_rate_mode" value="Fix"  <? if($comm_rate_mode==''){ echo 'checked';} ?> >
			  Fixed
			  </label>
            </div>
          </div>          
		</div>		
		<button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
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
<script>
function get_all_site_customers()
{
		
		
		
		var path =  "<?=base_url().$this->config->item('admin_folder')?>/commission/ajax_commission_levels/";
		//alert($('#levels').val());
		var level_value = $('#levels').val();
		var dataString = 'level_value='+level_value;
		//alert( path);
		$.ajax({
			url: path, 
			data: dataString,
			type:'POST', 
			success: function(data){
			$("#dyn-fropdonw").html('');
				$("#dyn-fropdonw").html(data);			
				//alert(data);
			}
		});
		
}
</script>