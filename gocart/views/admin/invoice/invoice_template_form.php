<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
    <!-- End top-right -->
	
	<!--========  velidation error start    ==========-->
<?php include('error.php');?>
<!--========  velidation error end   ==========-->
	
	
  <div id="main_container">
    <div class="row-fluid">
      <div class="span12">
        <div class="box paint color_5">
          <div class="title">
            <div class="row-fluid">
              <h4><?php echo lang('title');?></h4>
            </div>
          </div>
          <div class="content"> <?php echo form_open_multipart($this->config->item('admin_folder').'/invoice_templates/form/'.$id); ?>
            <div class="tab-content">
              <div class="tab-pane active" id="description_tab">
                <fieldset>
                <label for="name"><?php echo lang('template_title');?></label>
				<?php 
				$data    = array('name'=>'invoice_template_title', 'id'=>'invoice_template_title', 'value'=>set_value('invoice_template_title', $invoice_template_title), 'class'=>'span12');
				echo form_input($data);
				?>
				<label for="description"><?php echo lang('header_html');?></label>
				<?php
					$data    = array('name'=>'invoice_template_header', 'id'=>'invoice_template_header', 'class'=>'redactor', 'value'=>set_value('invoice_template_header', $invoice_template_header));
					echo form_textarea($data);
				?>
				<label for="description"><?php echo lang('footer_html');?></label>
				<?php
					$data    = array('name'=>'invoice_template_footer', 'id'=>'invoice_template_footer',  'class'=>'redactor', 'value'=>set_value('invoice_template_footer', $invoice_template_footer));
					echo form_textarea($data);
				?>
				<?php /*?><h2><?php echo lang('level');?></h2><?php */?>
				<label for="date"><?php echo lang('universal');?></label>

				<input type="checkbox" name="invoice_template_level"  <? if($invoice_template_level=='Universal'){ echo "checked"; } ?> class="span12" />
				</fieldset>
              </div>
            </div>
            <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
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
