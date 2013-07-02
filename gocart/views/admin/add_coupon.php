<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});

$(document).ready(function(){
	$("#gc_tabs").tabs();
	
	if($('#gc_coupon_type').val() == 'shipping')
	{
		$('#gc_coupon_price_fields').hide();
	}
	
	$('#gc_coupon_type').bind('change keyup', function(){
		if($(this).val() == 'price')
		{
			$('#gc_coupon_price_fields').show();
		}
		else
		{
			$('#gc_coupon_price_fields').hide();
		}
	});
	
	if($('#gc_coupon_appliesto_fields').val() == '1')
	{
		$('#gc_coupon_products').hide();
	}
	
	$('#gc_coupon_appliesto_fields').bind('change keyup', function(){
		if($(this).val() == 0)
		{
			$('#gc_coupon_products').show();
		}
		else
		{
			$('#gc_coupon_products').hide();
		}
	});
});

</script>
<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); 
?>
<?php echo form_open($this->config->item('admin_folder').'/coupons/form/'.$id); ?>
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
          <h4> <i class=" icon-bar-chart"></i>Add Coupon </h4>
        
        <!-- End .title -->
        <div class="content">
		
		
		<div class="tab-pane fade in active" id="form">
         <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              <?php echo lang('coupon_code');?>
              <span class="help-block"></span></label>
            <div class="controls span7">
              <?php
			$data	= array('name'=>'code', 'value'=>set_value('code', $code), 'class'=>'span12');
			echo form_input($data); ?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              <?php echo lang('max_uses');?>
              <span class="help-block"></span></label>
            <div class="controls span7">
              <?php
			$data	= array('name'=>'max_uses', 'value'=>set_value('max_uses', $max_uses), 'class'=>'span12');
			echo form_input($data); ?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              <?php echo lang('limit_per_order')?>
              <span class="help-block"></span></label>
            <div class="controls span7">
              <?php
			$data	= array('name'=>'max_product_instances', 'value'=>set_value('max_product_instances', $max_product_instances), 'class'=>'span12');
			echo form_input($data); ?>
            </div>
          </div>
           <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field"> <?php echo lang('enable_on');?><span class="help-block"></span></label>
            <div class="controls span7">
           <?php
              $data	= array('name'=>'start_date', 'id'=>'datepicker1', 'value'=>set_value('start_date', reverse_format($start_date)), 'class'=>'row-fluid span12');
			echo form_input($data);
			?>
			
            </div>
          </div>
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field"> <?php echo lang('disable_on');?><span class="help-block"></span></label>
            <div class="controls span7">
			<?php
              $data	= array('name'=>'end_date', 'id'=>'datepicker2', 'value'=>set_value('end_date', reverse_format($end_date)), 'class'=>'row-fluid span12');
			echo form_input($data);
			?>
			<input type="hidden" name="end_date" value="<?php echo set_value('end_date', $end_date) ?>" id="datepicker2_alt" />
            </div>
          </div>
           <div class="control-group row-fluid">
            <label class="control-label span1"><?php echo lang('coupon_type');?><span class="help-block"></span></label>
            <div class="controls span7">
			<?php
				$option = array('price'=>lang('price_discount'),'shiping'=>lang('free_shipping')); 
				echo form_dropdown('reduction_target', $option, $reduction_target,'id="gc_coupon_type" class="span12"');
			?>
              
            </div>
          </div>
           <div class="control-group row-fluid">
            <label class="control-label span1"><?php echo lang('reduction_amount')?><span class="help-block"></span></label>
            <div class="controls span3">
             <?php	$options = array(
	                  'percent'  => '%',
					  'fixed' => $this->config->item('currency_symbol')
	               	);
					echo ' '.form_dropdown('reduction_type', $options,  $reduction_type, 'class="span12"');
				?>
			  
            </div>
			<div class="controls span3">
			<?php
			$data	= array('name'=>'reduction_amount', 'value'=>set_value('reduction_amount', $reduction_amount), 'class'=>'span12');
			echo form_input($data); ?>
			</div>
          </div>
		  <div class="row-fluid">
          <div class="span4" >
          <div class="box paint color_10">
            
            <div class="content">
				<?php
	 		$options = array(
              '1' => lang('apply_to_whole_order'),
			  '0' => lang('apply_to_select_items')
           	);
			echo form_dropdown('whole_order_coupon', $options,  set_value(0, $whole_order_coupon), 'id="gc_coupon_appliesto_fields"');
		?>
				<div id="gc_coupon_products">
				 <table>
				 	<?php echo $product_rows; ?> 
				 </table>
				</div>
			</div>
          </div>
          <!-- End .box --> 
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

