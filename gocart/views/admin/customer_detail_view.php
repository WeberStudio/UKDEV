<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>	
	
	
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_25">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span>Customers Details
             	
	         
                     </span></h4>
                
<div class="content top"> 

<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">	
	
	<tbody>
		<? if(!empty($customer->image)): ?>
		<tr><td>Customer Image</td><td><?=$customer->image?></td></tr>
		<? endif ?>
		
		<? if(!empty($customer->gender)): ?>
		<tr><td>Customer Gender</td><td><?=$customer->gender?></td></tr>
		<? endif ?>
		
		<? if(!empty($customer->firstname) || !empty($customer->lastname)): ?>
		<tr><td>Customer Name</td><td><?=$customer->firstname.' '.$customer->lastname?></td></tr>
		<? endif ?>
		
		<? if(!empty($customer->customer_job)): ?>
		<tr><td>Customer Job</td><td><?=$customer->customer_job?></td></tr>
		<? endif ?>
		
		<? if(!empty($customer->email)): ?>
		<tr><td>Customer Email</td><td><?=$customer->email?></td></tr>
		<? endif ?>
		
		<? if(!empty($customer->phone)): ?>
		<tr><td>Customer Phone</td><td><?=$customer->phone?></td></tr>
		<? endif ?>
		
		<tr><td>Address 1</td><td><?=$customer->default_billing_address."<br>".$customer->billing_address2."<br>".$customer->billing_address3."<br>".$customer->billing_address4."<br>".$customer->billing_address5?></td></tr>		
		<tr><td>Address 2</td><td><?=$customer->address_street."<br>".$customer->address_line."<br>".$customer->city."<br>".$customer->state."<br>".$customer->post_code."<br>".$customer->country?></td></tr>
		
	</tbody>
</table>
			
            </div>
            <!-- End row-fluid -->
          </div>
          <!-- End .content -->
        </div>
        <!-- End box -->
      </div>
      <!-- End .span12 -->
    </div>
    <!-- End .row-fluid -->
  </div>