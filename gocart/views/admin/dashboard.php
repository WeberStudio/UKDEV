<div id="main">
<div class="container">
  <?php /*?><div class="header row-fluid">
      <div class="logo"> <a href="index.html"><span>Start</span><span class="icon"></span></a> </div>
      <div class="top_right">
        <ul class="nav nav_menu">
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="../../page.html">
            <div class="title"><span class="name">George</span><span class="subtitle">Future Buyer</span></div>
            <span class="icon"><img src="<?=base_url().ASSETS_PATH?>img/thumbnail_george.jpg"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <li><a href="profile.html"><i class=" icon-user"></i> My Profile</a></li>
              <li><a href="forms_general.html"><i class=" icon-cog"></i>Settings</a></li>
              <li><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><i class=" icon-unlock"></i><?php echo lang('common_log_out') ?></a></li>
              <li><a href="search.html"><i class=" icon-flag"></i>Help</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- End top-right --> 
    </div><?php */?>
  <? include_once('includes/admin_profile.php');?>
  <div id="main_container">
    <div class="row-fluid">
      <!-- Start Notifications-->
      <?  if($this->admin_access != 'Course Provider'): ?>
      <div class="span6 box color_3">
        <div class="title">
          <div class="row-fluid">
            <div class="span12">
              <h1> </i><span>Notifications</span> </h1>
            </div>
            <!-- End .span12 -->
          </div>
          <!-- End .row-fluid -->
        </div>
        <!-- End .title -->
        <div class="span8 box color_3" >
          <div class="content numbers">
            <h1 class="value">
              <?=$orders_notifi?>
            </h1>
            <div class="description mb5"><a style=" font-size:14px; font-weight:bold; color:#fff;" href="<?php echo site_url($this->config->item('admin_folder')."/order/"); ?>">New Order</a></div>
            <h1 class="value">
              <?=$customer_notifi?>
            </h1>
            <div class="description mb5"><a style=" font-size:14px; font-weight:bold; color:#fff;" href="<?php echo site_url($this->config->item('admin_folder')."/customers/"); ?>">New Customers</a></div>
            <h1 class="value">
              <?=$users_notifi?>
            </h1>
            <div class="description mb5"><a style=" font-size:14px; font-weight:bold; color:#fff;" href="<?php echo site_url($this->config->item('admin_folder')."/admin/"); ?>">New Users</a></div>
            <h1 class="value">
              <?=$tutors_notifi?>
            </h1>
            <div class="description mb5"><a style=" font-size:14px; font-weight:bold; color:#fff;" href="<?php echo site_url($this->config->item('admin_folder')."/tutor/"); ?>">New Tutors</a></div>
          </div>
        </div>
      </div>
      <? endif; ?>
      <!-- Start Notifications-->
      <div class="span6">
        <div class="row-fluid fluid">
          <!-- Start Total Courses-->
          <?  if($this->admin_access != 'Course Provider'): ?>
          <div class="span6">
            <div class=" box color_2 height_medium paint_hover">
              <div class="content numbers">
                <h3 class="value">
                  <?php if($products!=""){echo $products;}else{echo"0";}?>
                </h3>
                <div class="description mb5">Total Courses</div>
                <h3 class="value">
                  <?php  echo $products_d;?>
                </h3>
                <div class="description">Deactivated Courses</div>
              </div>
            </div>
          </div>
          <? endif; ?>
          <!-- End Total Courses-->
          <div class="span6">
            <div class="box color_25 height_medium paint_hover">
              <div class="content numbers">
                <h3 class="value">7.147</h3>
                <div class="description mb5">Total Clicks</div>
                <h1 class="value">718.862</h1>
                <div class="description">Total Impressions</div>
              </div>
            </div>
          </div>
          <!-- End .span6 -->
        </div>
        <!-- End .row-fluid -->
        <div class="row-fluid fluid">
          <!-- Start Total Customer-->
          <?  if($this->admin_access != 'Course Provider'): ?>
          <div class="span6">
            <div class=" box color_22 height_medium paint_hover">
              <div class="content numbers">
                <h3 class="value"><?php echo $customers_t;?></h3>
                <div class="description mb5">Total Customer</div>
                <h3 class="value"><?php echo $customers_d;?></h3>
                <div class="description">Deactivated Customer</div>
              </div>
            </div>
          </div>
          <? endif; ?>
          <!-- End Total Customer-->
          <!-- Start Total Newsletter-->
          <?  if($this->admin_access != 'Course Provider'): ?>
          <div class="span6">
            <div class=" box color_19 height_medium paint_hover">
              <div class="content numbers">
                <h3 class="value"><?php echo $customers_n;?></h3>
                <div class="description mb5">Newsletter subscribers</div>
                <h3 class="value"></h3>
                <div class="description"></div>
              </div>
            </div>
          </div>
          <? endif; ?>
          <!-- End Total Newsletter-->
        </div>
        <!-- End .row-fluid -->
      </div>
      <!-- End.span6-->
    </div>
    <!-- End .row-fluid -->
    <div class="row-fluid">
      <!-- Start  LATEST ORDER -->
      <?  if($this->admin_access != 'Course Provider'): ?>
      <div class="span7">
        <div class="box paint color_17">
          <div class="title">
            <h4> <span>Latest Order</span> </h4>
          </div>
          <!-- End .title -->
          <div class="content full">
            <table id="datatable_example" class="responsive table table-hover full" height="100%" width="100%">
              <thead>
                <tr>
                  <th class="jv no_sort"> No </th>
                  <th class="ue"> Order No </th>
                  <th> User</th>
                  <!--<th>Date</th>-->
                  <th> </th>
                  <th class="Yy to_hide_phone">Subtotal </th>
                </tr>
              </thead>
              <tbody>
                <?php
				$i = 0;
				 foreach($orders as $order):
				$i++;
				
				?>
                <tr>
                  <td><?php echo $i;?> </td>
                  <td><a  href="<?=base_url().'admin/order/view/'.$order->id?>"> <?php echo  $order->order_number;?> </a></td>
                  <td><?php echo $order->firstname." ".$order->lastname;?></td>
                  <td><?php 
					$date = $order->ordered_on;
					$exp = explode(" ", $date);
					$exp[0];
					$exp1 = explode("-",$exp[0]);
					//echo $exp1[2]."/".$exp1[1]."/".$exp1[0];
					?>
                  </td>
                  <td class="to_hide_phone"><?php echo "£".$order->subtotal;?></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
          <!-- End .content -->
          <div class="description">LATEST ORDER (click on order number to view details) <i class="gicon-info-sign icon-white"></i></div>
        </div>
        <!-- End .box -->
      </div>
      <? endif; ?>
      <!-- End  LATEST ORDER-->
      <!-- Start  LATEST Customers -->
      <?  if($this->admin_access != 'Course Provider'): ?>
      <div class="span5">
        <div class="box paint color_2">
          <div class="title">
            <h4> <span>NEW CUSTOMERS</span> </h4>
          </div>
          <!-- End .title -->
          <div class="content full">
            <table id="datatable_example" class="responsive table table-hover full" >
              <tbody>
                <?php
				$i = 0;
				foreach($customers as $customer): 
				$i++;
				?>
                <tr>
                  <td><?=$i?></td>
                  <td><a  href="<?php echo site_url($this->config->item('admin_folder').'/customers/form/'.$customer->id); ?>"><?php echo $customer->firstname;?></a> </td>
                  <td></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
          <!-- End .content -->
          <div class="description">LATEST CUSTOMERS (click on order number to view details) <i class="gicon-info-sign icon-white"></i></div>
        </div>
        <!-- End .box -->
      </div>
      <? endif; ?>
      <!-- End  LATEST Customers-->
    </div>
    <!-- End .row-fluid -->
    <div class="row-fluid">
      <div class="span7">
        <div class="box paint color_5">
          <div class="title">
            <h4> <span>History</span> </h4>
          </div>
          <!-- End .title -->
          <div class="content full">
            <table id="datatable_example" class="responsive table table-hover full" height="100%" width="100%">
              <thead>
                <tr>
                  <th>Counter History for last 10 recorded days </th>
                  <th>Session - Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>30/05/2013</td>
                  <td>958 -1394</td>
                </tr>
                <tr>
                  <td> 30/05/2013</td>
                  <td>958 -1394</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- End .content -->
          <div class="description">LATEST CUSTOMER HISTORY<i class="gicon-info-sign icon-white"></i></div>
        </div>
        <!-- End .box -->
      </div>
      <!-- Start  TOTAL ORDER Details -->
      <?  if($this->admin_access != 'Course Provider'): ?>
      <div class="span5">
          <div class="box paint color_13">
            <div class="title">
              <h4> <span>Orders</span> </h4>
            </div>
            <!-- End .title -->
            <div class="content full">
              <table id="datatable_example" class="responsive table table-hover full" height="100%" width="100%">
              
                <tbody>                  
                  <tr>
				  	<td>1</td>
                  	<td><a style="color:#FFFFFF;"  href="<?php echo site_url($this->config->item('admin_folder')."/order");?>">Enrolment Received</a></td>
					<td><?php echo $enrolment_received;?></td>
				  </tr>
				  
				  <tr>
				  	<td>2</td>
				  	<td><a style="color:#FFFFFF;" href="<?php echo site_url($this->config->item('admin_folder')."/order/index/2");?>">Payment Received</a></td>
					<td><?php echo $payment_received;?></td>
				  </tr>
                  
				  <tr>
				  	<td>3</td>
				  	 <td><a style="color:#FFFFFF;" href="<?php echo site_url($this->config->item('admin_folder')."/order/index/3");?>">Enrolment Processing</a></td>
					 <td><?php echo $enrolment_processing;?></td>
				  </tr>
				  <tr>
				  	<td>4</td>
				  	<td>Despatched</td>
					<td>3434</td>
				  </tr>
				  <tr>
				  	<td>5</td>
				  	<td>Invoiced</td>
					<td>3434</td>
				  </tr>
				  <tr>
				  	<td>6</td>
				  	<td><a style="color:#FFFFFF;"  href="<?php echo site_url($this->config->item('admin_folder')."/order/index/6");?>">Cancelled</a></td>
					<td><?php echo $cancelled_order;?></td>
				  </tr>	               
               </tbody>
              </table>
            </div>
            <!-- End .content -->
            <div class="description">LATEST ORDER (click on order number to view details) <i class="gicon-info-sign icon-white"></i></div>
          </div>
          
          <!-- End .box --> 
        </div>
      <? endif; ?>
      <!-- End  TOTAL ORDER Details -->
    </div>
    <!-- End .row-fluid -->
  </div>
  <!-- End #container -->
</div>
