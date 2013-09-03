<div id="main" style="min-height:1000px">
<div class="container">
  <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
  
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
	
	?>

  <div id="js_error_container" class="alert alert-error" style="display:none;">
    <p id="js_error"></p>
  </div>
  <div id="js_note_container" class="alert alert-note" style="display:none;"> </div>
  <?php if (!empty($message)): ?>
  <div class="alert alert-success"> <a class="close" data-dismiss="alert">*</a> <?php echo $message; ?> </div>
  <?php endif; ?>
  <?php if (!empty($error)): ?>
  <div class="alert alert-error"> <a class="close" data-dismiss="alert">*</a> <?php echo $error; ?> </div>
  <?php endif;    ?>
  
  
  
  <!-- End top-right -->
  <div id="main_container">
    <div class="row-fluid">
      <div class="span12">
        <div class="box paint color_5">
          <div class="title">
            <div class="row-fluid">
              <h4>Invoice form</h4>
            </div>
          </div>
		  
          <div class="content"> <?php echo form_open_multipart($this->config->item('admin_folder').'/invoices/form/'); ?>
            <div class="tab-content">
              <div class="tab-pane active" id="description_tab">
                <fieldset>
				<? //echo '<pre>';print_r($users);exit;  ?>
                <select data-placeholder="Choose client and search for invoice" class="chzn-select" name="users"  tabindex="5">
                  <option value="">Choose client and search for invoice</option>
                  <? if(!empty($users)){  ?>
                  <?php  foreach ($users as $user){
				  			
				  ?>
                  	<option  value="<?=$user['id']?>"><?=$user['company']?></option>
                  <?
				  		
					}
				} 
				 ?>
                </select>
                <br />
                <label for="description"><?php echo lang('terms_conditions');?></label>
                <?php
					$data = array('name'=>'invoice_terms', 'class'=>'redactor', 'value'=>set_value('invoice_terms', $invoice_terms));
					echo form_textarea($data);
				?>
				 <br />
				 
				 <select data-placeholder="Choose Invoice Template" class="chzn-select" name="invoice_template"  tabindex="5">
                  <option value="">Choose Template For Invoice</option>
                  <? if(isset($templates)){  ?>
                  <?php  foreach ($templates as $template){?>
                  	<option  value="<?=$template->invoice_template_id?>"><?=$template->invoice_template_title?></option>
                  <?
					}
				} 
				 ?>
                </select>			
               <br />
				
				 <br />           
                <select data-placeholder="Choose Group" class="chzn-select" name="invoice_group_id"  tabindex="5">
                  <option value="">Choose group and search for group</option>
                  <? if(isset($groups)){  ?>
                  <?php  foreach ($groups as $group){?>
                  	<option  value="<?=$group['invoice_group_id']?>"><?=$group['invoice_group_name']?></option>
                  <?
					}
				} 
				 ?>
                </select>
                <br />
                <label for="date"> Date (M-D-Y) </label>
                <?php
					$data    = array('name'=>'invoice_date_created', 'id'=>'datepicker1', 'value'=>date('Y-m-d'), 'class'=>'span12');
					echo form_input($data);					
				?>
                </fieldset>
              </div>
            </div>
            <button type="submit" value="conform" name="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

 $(document).ready(function () {
    $('form').submit(function() {
        $('.btn').attr('disabled', true).addClass('disabled');
    });
		
  	$('#datepicker1').datepicker({
	  format: 'mm-dd-yyyy'
	});
</script>