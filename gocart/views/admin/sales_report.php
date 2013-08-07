<script type="text/javascript">
function areyousure()
{
	return confirm('Are you sure to delete the record?');
}

function toggle_custom()
{
	$("#date_options").toggle("slow");
	$("#date_custom").toggle("slow");
}


function date_status_hide()
{
	$("#date_status_block").hide();
}

function date_status_show()
{
	$("#date_status_block").show();
}
</script>
<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
     <div class="box paint color_11">
      <div class="title">
        <h4> <i class="icon-book"></i><span>Sales Report</span></h4>
      </div>
      <div class="content"> 
	  	<form action="<?php echo site_url($this->config->item('admin_folder').'/reports/get_sales_report');?>" method="post">
      	<label class="control-label">Preset Date Range</label>
		<div class="form-row control-group row-fluid" style="font-style:oblique; font-weight:bold;" ><input type="checkbox" name="search_custom"  onClick="toggle_custom()"/><label>Custom</label></div>
         <div class="form-row control-group row-fluid">
        	
			
			<div class="control-group" id="date_options">
              <div class="controls" style="padding-top:5px;" >
                <input type="radio" class="span8" name="date_preset" id="yesterday"  value="yesterday"> (Yesterday)
				</div>
				<div class="controls">
                <input type="radio" class="span8" name="date_preset" id="last_month"  value="last_month"> (Last Month)
				</div>
				<div class="controls">
                <input type="radio" class="span8" name="date_preset" id="this_month"  value="this_month"> (This Month)
				</div>
            </div>
			
			<div class="control-group" id="date_custom" style="display:none;">
              <div class="controls span3">
				<label class="control-label ">
				<h3> Form </h3>
				</label>
				<?php 
					$data = array('id'=>'datepicker1','name'=>'start_date','placeholder'=>'Start Date','style'=>'margin-bottom: 0px;');
					echo form_input($data);
				?>
			  </div>
			  <div class="controls span3">
				<label class="control-label">
				<h3> To </h3>
				</label>
				<?php 
					$data = array('id'=>'datepicker2','name'=>'end_date','placeholder'=>'End Date','style'=>'margin-bottom: 0px;');
						echo form_input($data);
					?>
			  </div>			
            </div>
             <br>
			 
              <div class="controls span3">
                <select class="chzn-select"  name="date_status" id="date_status">                
					<option value="Enrolment Received">Enrolment Received</option>
					<option value="Payment Received">Payment Received</option>
					<option value="Enrolment Processing">Enrolment Processing</option>
					<option value="Dispatched">Despatched</option>
					<option value="Invoiced">Invoiced</option>
					<option value="Cancelled">Cancelled</option>
                </select>
              </div>
              <div class="controls span5">
				<select class="chzn-select" name="payment_method" id="payment_method">				
					<option value="" selected="selected">(doesn't matter)</option>
					<option value="protx_direct">Credit/Debit Card (Secured by Protx) [protx_direct]</option>
					<option value="paypal">PayPal [paypal]</option>
					<option value="moneyorder">Cheque/Money Order [moneyorder]</option>
					<option value="paypalwpp">PayPal [paypalwpp]</option>
				</select>
                
              </div>
              <div class="controls span3">
               <select class="chzn-select" id="" name="courses_provider">
                <option value=""> Courses Provider</option>                 
                	<?php
					
					foreach($admins as $admin){?>
                    <option value="<?php echo $admin->id;?>"> <?php echo $admin->firstname;?></option>
                    <?php }?>
                </select>
              </div>
			  <br>
			  <br>
			<!--  <div class="control-group" >
			 	<label class="control-label">Search date of...<br>	 
				<br>
				<div class="controls" >
				<input type="radio" class="span8" name="date_target"   value="purchased" checked="checked" 	onClick="date_status_hide()"> Order purchase
				</div>
				<div class="controls" >
				<input type="radio" class="span8" name="date_target"   value="status" 		onClick="date_status_show()"> Assigned status (select below)
				</div>				
              </div>
			  
			  <div class="controls span5" style="display:none;" id="date_status_block">
                <select class="chzn-select"  name="date_status_search" id="date_status_search">                
					<option value="Enrolment Received">Enrolment Received</option>
					<option value="Payment Received">Payment Received</option>
					<option value="Enrolment Processing">Enrolment Processing</option>
					<option value="Dispatched">Despatched</option>
					<option value="Invoiced">Invoiced</option>
					<option value="Cancelled">Cancelled</option>
                </select>
              </div>-->
            
         </div>         
         <div class="form-row control-group row-fluid">
			<div class="controls span12" align="right">      
				<input type="submit"  class="btn" name="print_call" value="Sales Report (Print)" >             
				<input type="submit"  class="btn" name="csv_call" value="Sales Report (CSV)" > 
			</div>
          </div>
          </form>
        </div>
      </div>
      
    <!-- End .row-fluid -->
  </div>
  </div>