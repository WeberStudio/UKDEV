<div id="main" style="min-height:1000px">
<div class="container">
  <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
  <!-- End top-right -->
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
              <h4><?php echo lang('group_title');?></h4>
            </div>
          </div>
          <div class="content">
		  <?php echo form_open_multipart($this->config->item('admin_folder').'/invoice_groups/form/'.$id); ?>
            <div class="control-group">
              <label class="control-label"><?php echo lang('name'); ?>: </label>
              <div class="controls">
                <input type="text" class="span8" name="invoice_group_name" id="invoice_group_name"  value="<?php echo set_value('invoice_group_name', $invoice_group_name); ?>">
              </div>
            </div>            
			<fieldset>
			<div class="control-group">
              <label class="control-label"><?php echo lang('prefix'); ?>: </label>
              <div class="controls">
                <input type="text" class="span8" name="invoice_group_prefix" id="invoice_group_prefix" value="<?php echo set_value('invoice_group_prefix', $invoice_group_prefix); ?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><?php echo lang('next_id'); ?>: </label>
              <div class="controls">
                <input type="text" class="span8" name="invoice_group_next_id" id="invoice_group_next_id" value="<?php echo set_value('invoice_group_next_id', $invoice_group_next_id); ?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><?php echo lang('left_pad'); ?>: </label>
              <div class="controls">
                <input type="text" class="span8" name="invoice_group_left_pad" id="invoice_group_left_pad" value="<?php echo set_value('invoice_group_left_pad', $invoice_group_left_pad); ?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><?php echo lang('year_prefix'); ?>: </label>
              <div class="controls">
                <select name="invoice_group_prefix_year" id="invoice_group_prefix_year">
                  <option value="0" <?php if ($invoice_group_prefix_year == 0) { ?>selected="selected"<?php } ?>><?php echo lang('no'); ?></option>
                  <option value="1" <?php if ($invoice_group_prefix_year == 1) { ?>selected="selected"<?php } ?>><?php echo lang('yes'); ?></option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><?php echo lang('month_prefix'); ?>: </label>
              <div class="controls">
                <select name="invoice_group_prefix_month" id="invoice_group_prefix_month">
                  <option value="0" <?php if ($invoice_group_prefix_month == 0) { ?>selected="selected"<?php } ?>><?php echo lang('no'); ?></option>
                  <option value="1" <?php if ($invoice_group_prefix_month == 1) { ?>selected="selected"<?php } ?>><?php echo lang('yes'); ?></option>
                </select>
              </div>
            </div>
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
