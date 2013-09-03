<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>	
	
	
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_25">
            <div class="title">
             <h4> <i class=" icon-bar-chart"></i><span>User Details
             	
	         
                     </span></h4>
                
<div class="content top"> 

<table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">	
	
	<tbody>
		<? if(!empty($admin->image)): ?>
		<tr><td>User Image</td><td><?=$admin->image?></td></tr>
		<? endif ?>
		
				
		<? if(!empty($admin->firstname) || !empty($admin->lastname)): ?>
		<tr><td>User Name</td><td><?=$admin->firstname.' '.$admin->lastname?></td></tr>
		<? endif ?>
		
		<? if(!empty($admin->company)): ?>
		<tr><td>User Job</td><td><?=$admin->company?></td></tr>
		<? endif ?>
		
		<? if(!empty($admin->email)): ?>
		<tr><td>User Email</td><td><?=$admin->email?></td></tr>
		<? endif ?>
		
		<? if(!empty($admin->phone)): ?>
		<tr><td>User Phone</td><td><?=$admin->phone?></td></tr>
		<? endif ?>
		
		
		<tr><td>Address</td><td><?=$admin->street_address."<br>".$admin->address_line_op."<br>".$admin->city."<br>".$admin->state."<br>".$admin->zip_code."<br>".$admin->country?></td></tr>
		
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