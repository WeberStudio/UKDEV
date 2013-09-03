<div id="main" style="min-height:1000px">
<div class="container">
  <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
  <!--========  velidation error start    ==========-->
<script type="text/javascript">
function showStuff() {
    document.getElementById('closee').style.display = 'none';
}
</script>
       <?php 
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	if($this->session->flashdata('error'))
	{
		$error	= $this->session->flashdata('error');
	}
	if(validation_errors() != '')
	{
		$error	= validation_errors();
	}
	?>
    
   
   
    <?php if (!empty($error)): ?>
          <div class="alert alert-error" id="closee"> <a href="javascript:void(0)"  class="close" data-dismiss="alert" onClick="showStuff(); return false;">x</a> <?php echo"<div style='margin-left: 70px;'>". $error. "</div>"; ?> </div>
          <?php endif; ?>
          
      
          <?php if (!empty($message)): ?>
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $message; ?>
		</div>
	<?php endif; ?>
<!--========  velidation error end   ==========-->
  <div id="main_container">
    <div class="row-fluid">
      <div class="span12">
        <div class="box paint color_5">
          <div class="title">
            <div class="row-fluid">
              <h4><?php echo lang('tax_title');?></h4>
            </div>
          </div>
          <div class="content">
		  <?php echo form_open_multipart($this->config->item('admin_folder').'/tax/form/'.$id); ?>
            <div class="control-group">
              <label class="control-label"><?php echo lang('name'); ?>: </label>
              <div class="controls">
                <input type="text" class="span8" name="tax_rate_name" id="tax_rate_name"  value="<?php echo set_value('tax_rate_name', $tax_rate_name); ?>">
              </div>
            </div>            
			<fieldset>
			<div class="control-group">
              <label class="control-label"><?php echo lang('tax'); ?>: </label>
              <div class="controls">
                <input type="text" class="span8" name="tax_rate_percent" id="tax_rate_percent" value="<?php echo set_value('tax_rate_percent', $tax_rate_percent); ?>">
              </div>
            </div>			
			
			<?php /*?><div class="form-row control-group row-fluid">
                  <label class="control-label">Tax For</label>
                  <div class="controls span7">
                    <label class="inline radio"><input type="radio" name="tax_for" value="customer" checked="checked"  /> Students </label>                    
                    <label class="inline radio"><input type="radio" name="tax_for" value="cprovider" />Course Providers </label>
                  </div>
            </div><?php */?>
						
			<div class="control-group">
              <label for="date"><?php echo lang('tax_level'); ?>: </label>              
			  <div class="controls">
                <input type="checkbox" name="tax_level"  <? if($tax_level=='Universal'){ echo "checked"; } ?> class="span12" />
              </div>
            </div>
			<br />
			
            <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
			</fieldset>
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