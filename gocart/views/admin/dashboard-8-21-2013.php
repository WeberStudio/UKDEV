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
        <div class="span6 box color_3 title_big height_big paint_hover">
          <div class="title">
            <div class="row-fluid">
              <div class="span12">
                <h4> </i><span>Campaigns</span> </h4>
              </div>
              <!-- End .span12 --> 
            </div>
            <!-- End .row-fluid --> 
            
          </div>
          <!-- End .title -->
          <div class="content"  style="padding-top:35px;">
            <div id="placeholder" style="width:100%;height:240px;"> </div>
          </div>
        </div>
        <!-- End .box .span6-->
        <div class="span6">
          <div class="row-fluid fluid">
            <div class="span6">
              <div class=" box color_2 height_medium paint_hover">
                <div class="content numbers">
                  <h3 class="value"><?php if($products!=""){echo $products;}else{echo"0";}?></h3>
                  <div class="description mb5">Total Courses</div>
                  <h3 class="value"><?php  echo $products_d;?></h3>
                  <div class="description">Deactivated Courses</div>
                </div>
              </div>
            </div>
            <!-- End .span6 -->
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
            <!-- End .span6 -->
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
            <!-- End .span6 --> 
          </div>
          <!-- End .row-fluid --> 
          
        </div>
        <!-- End.span6--> 
      </div>
      <!-- End .row-fluid -->
      
      <div class="row-fluid">
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
                    <th>Date</th>
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
                  
                  <td><?php echo $i;?>
                  </td>
                    <td><a href="<?=base_url().'admin/order/view/'.$order->id?>"> <?php echo  $order->order_number;?> </a></td>
                    <td> <?php echo $order->firstname." ".$order->lastname;?></td>
                    <td> <?php 
					$date = $order->ordered_on;
					$exp = explode(" ", $date);
					$exp[0];
					$exp1 = explode("-",$exp[0]);
					echo $exp1[2]."/".$exp1[1]."/".$exp1[0];
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
        <!-- End .span8 -->
        
        <div class="span5">
          <div class="box  paint color_2">
            <div class="title">
              <h4> <span>New customers</span> </h4>
            </div>
            <!-- End .title -->
            
            <ul class="users unstyled content">
            <?php
			$i = 0;
			foreach($customers as $customer): 
			$i++;
			?>
            	<a href="<?php echo site_url($this->config->item('admin_folder').'/customers/form/'.$customer->id); ?>">
              <li>
                <div class="info row-fluid"><span class="number pull-left text_color_0"><?php echo $i ?></span>
                  <h2 class="pull-left"><?php echo $customer->firstname;?></h2>
                  <div align="right">
                  <?php 
					$date = $customer->register_on;
					$exp = explode(" ", $date);
					$exp[0];
					$exp1 = explode("-",$exp[0]);
					echo $exp1[2]."/".$exp1[1]."/".$exp1[0];
					?>
                  </div>
                </div>
                <!--<div class="row-fluid">
                  <div class="value"><?php echo $customer->company;?></div>
                </div>-->
              </li>
              </a>
              <?php endforeach;?>
            </ul>
            <!-- End .content -->
            <div class="description">NEW CUSTOMERS (click on customer name to view details) <i class="gicon-info-sign icon-white"></i> </div>
          </div>
          <!-- End .box --> 
        </div>
        <!-- End .span4 --> 
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
      
       
        <!-- End .span8 -->
        
        <div class="span5">
          <div class="box  paint color_13">
            <div class="title">
              <h4> <span>Orders</span> </h4>
            </div>
            <!-- End .title -->
            
            <ul class="users unstyled content">
           
              <li>
                <div class="info row-fluid"><span class="number pull-left text_color_0">1</span>
                  <a href="<?php echo site_url($this->config->item('admin_folder')."/order");?>"><h3 class="pull-left" style="margin-left: 5px; margin-top: -6px;">Enrolment Received</h3></a>
                  <div align="right"><h3><?php echo $enrolment_received;?></h3></div>
                </div>
              </li>
              <li>
                <div class="info row-fluid"><span class="number pull-left text_color_0">2</span>
                  <a href="<?php echo site_url($this->config->item('admin_folder')."/order/index/2");?>"><h3 class="pull-left" style="margin-left: 5px; margin-top: -6px;">Payment Received</h3></a>
                  <div align="right"><h3><?php echo $payment_received;?></h3></div>
                </div>
              </li>
              <li>
                <div class="info row-fluid"><span class="number pull-left text_color_0">3</span>
                  <a href="<?php echo site_url($this->config->item('admin_folder')."/order/index/3");?>"><h3 class="pull-left" style="margin-left: 5px; margin-top: -6px;">Enrolment Processing</h3></a>
                  <div align="right"><h3><?php echo $enrolment_processing;?></h3></div>
                </div>
              </li>
              <li>
                <div class="info row-fluid"><span class="number pull-left text_color_0">4</span>
                  <h3 class="pull-left" style="margin-left: 5px; margin-top: -6px;">Despatched</h3>
                  <div align="right"><h3  >3434</h3></div>
                </div>
              </li>
              <li>
                <div class="info row-fluid"><span class="number pull-left text_color_0">5</span>
                  <h3 class="pull-left" style="margin-left: 5px; margin-top: -6px;">Invoiced</h3>
                  <div align="right"><h3  >3434</h3></div>
                </div>
              </li>
              <li>
                <div class="info row-fluid"><span class="number pull-left text_color_0">6</span>
                  <a href="<?php echo site_url($this->config->item('admin_folder')."/order/index/6");?>"><h3 class="pull-left" style="margin-left: 5px; margin-top: -6px;">Cancelled</h3></a>
                  <div align="right"><h3><?php echo $cancelled_order;?></h3></div>
                </div>
              </li>
              
              
            </ul>
            <!-- End .content -->
            <div class="description">ORDER HISTORY (click on order history to view details) <i class="gicon-info-sign icon-white"></i> </div>
          </div>
          <!-- End .box --> 
        </div>
        <!-- End .span4 --> 
      </div>
      <!--<div class="row-fluid">
        <div class="row-fluid box color_2 title_medium height_medium2 bar_stats paint_hover ">
          <div class="title">
            <h5><span>Envato</span></h5>
          </div>
          
          <div class="content row-fluid fluid numbers">
            <div class="span3 stats">
              <div id="placeholder3" style="width:100%;height:65px;margin-top:7px"></div>
            </div>
            <div class="span2 average_ctr">
              <h1 class="value">0.72<span class="percent">%</span></h1>
              <div class="description mt15" >AVERAGE CTR</div>
            </div>
            <div class="span3 shown_left hidden_phone">
              <div class="row-fluid fluid">
                <div class="span6">
                  <div class="description">SHOWN</div>
                  <h2 class="value">3.240</h2>
                  <div class="progress small">
                    <div class="bar white" style="width: 100%;"></div>
                  </div>
                  <div class="description" >IMPRESSIONS STATS</div>
                </div>
                <div class="span6 full">
                  <div class="description text_color_dark">LEFT</div>
                  <h2 class="value text_color_dark">16.760</h2>
                  <div class="progress small">
                    <div class="bar " style="width: 0%;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="span3 total_days">
              <div class="row-fluid">
                <div class="span6 total_clicks">
                  <h1 class="value">103</h1>
                  <div class="description mt15" >TOTAL CLICKS</div>
                </div>
                <div class="span6 days_left">
                  <h1 class="value text_color_dark">28</h1>
                  <div class="description mt15" >DAYS LEFT</div>
                </div>
              </div>
            </div>
            <div class="span1 stick top right result height_medium2"> <img src="<?=base_url().ASSETS_PATH?>img/arrows_up.png">
              <div class="description mt15" >Good</div>
            </div>
          </div>
           
        </div>
        
        
      </div>-->
      <!-- End .row-fluid -->
      
      <!--<div class="row-fluid">
        <div class="row-fluid box color_27 title_medium height_medium2 bar_stats paint_hover">
          <div class="title">
            <h5><span>Facebook</span></h5>
          </div>
          
          <div class="content row-fluid fluid numbers">
            <div class="span3 stats">
              <div id="placeholder4" style="width:100%;height:65px;margin-top:7px"></div>
            </div>
            <div class="span2 average_ctr">
              <h1 class="value">1.37<span class="percent">%</span></h1>
              <div class="description mt15" >AVERAGE CTR</div>
            </div>
            <div class="span3 shown_left">
              <div class="row-fluid fluid">
                <div class="span6">
                  <div class="description">SHOWN</div>
                  <h2 class="value">1.220</h2>
                  <div class="progress small"  >
                    <div class="bar white " style="width: 100%;"></div>
                  </div>
                  <div class="description" >IMPRESSIONS STATS</div>
                </div>
                <div class="span6 full">
                  <div class="description text_color_dark">LEFT</div>
                  <h2 class="value text_color_dark">12.420</h2>
                  <div class="progress small">
                    <div class="bar" style="width: 0%;"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="span3 total_days">
              <div class="row-fluid">
                <div class="span6 total_clicks">
                  <h1 class="value">67</h1>
                  <div class="description mt15" >TOTAL CLICKS</div>
                </div>
                <div class="span6 days_left">
                  <h1 class="value text_color_dark">30</h1>
                  <div class="description mt15" >DAYS LEFT</div>
                </div>
              </div>
            </div>
            <div class="span1 stick top right result height_medium2"> <img src="<?=base_url().ASSETS_PATH?>img/arrows_down.png">
              <div class="description mt15" > &nbsp;&nbsp;Bad</div>
            </div>
          </div>
          
        </div>
        
        
      </div>-->
      
      
      <!--<div class="row-fluid">
        <div class="span6">
          <div class="box gradient color_25 height_xbig paint_hover1">
            <div class="title row-fluid">
              <h4 class="pull-left"><span>Task List</span></h4>
              <div class="btn-toolbar pull-right ">
                <div class="btn-group"> <a class="btn">Add New +</a> <a class="btn change_color_outside"><i class="paint_bucket"></i></a> </div>
              </div>
            </div>
            
            <div class="content row-fluid">
              <div id="todoapp" class="row-fluid">
                <div class="todos">
                  <ul data-bind="foreach: tasks, visible: tasks().length > 0" id="todo-list" class="unstyled">
                    <li>
                      <div class="todo" data-bind="css: { editing: isEditing }, event: { dblclick: startEdit }">
                        <div class="display" data-bind="css: { done: isDone }">
                          <input type="checkbox" class="check" data-bind="checked: isDone" />
                          <div class="todo-text" data-bind="html: title"></div>
                          <a href="#" class="todo-destroy" data-bind="click: $parent.removeTask">&times;</a> </div>
                        <div class="edit">
                          <form data-bind="submit: updateTask" class="full">
                            <input data-bind="value: title" class="row-fluid"/>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div id="credits" class="description"> *Double-click to edit tasks. Enter to finish. </div>
            </div>
            
           <div class="description"> You have <b data-bind="text: incompleteTasks().length">&nbsp;</b> incomplete task(s) <span data-bind="visible: incompleteTasks().length == 0">- its beer time!</span> <a class="pull-right" data-bind="visible: completeTasks().length &gt; 0, click: removeCompleted" href="#" id="clear-completed">Clear Completed Tasks </a> </div>
          </div>
          
        </div>
        
        <div class="span6">
          <div class="box color_2 ">
            <div class="title row-fluid">
              <h4 class="pull-left"><span>Messages</span></h4>
              <div class="btn-toolbar pull-right ">
                <div class="btn-group"> <a class="btn">View All</a> <a class="btn change_color_outside"><i class="paint_bucket"></i></a> </div>
              </div>
            </div>
            
            <div class="content row-fluid">
              <ul class="messages_layout">
                <li class="from_user left"> <a href="#" class="avatar"><img src="<?=base_url().ASSETS_PATH?>img/message_avatar2.png"/></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name">Celeste Holm</a> <span class="time">1 hour ago</span>
                      <div class="options_arrow">
                        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="../../page.html"> <i class=" icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class=" icon-share-alt icon-large"></i>Reply</a></li>
                            <li><a href="#"><i class=" icon-trash icon-large"></i>Delete</a></li>
                            <li><a href="#"><i class=" icon-share icon-large"></i>Share</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text"> All I want is to be a monkey of moderate intelligence who wears a suit… that's why I'm transferring to business school! I had more, but you go ahead.  Dissect its brain! </div>
                  </div>
                </li>
                <li class="by_myself right"> <a href="#" class="avatar"><img src="<?=base_url().ASSETS_PATH?>img/message_avatar4.png"/></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name">Bender (myself) </a> <span class="time">4 hours ago</span>
                      <div class="options_arrow">
                        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="../../page.html"> <i class=" icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class=" icon-share-alt icon-large"></i>Reply</a></li>
                            <li><a href="#"><i class=" icon-trash icon-large"></i>Delete</a></li>
                            <li><a href="#"><i class=" icon-share icon-large"></i>Share</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text"> Man, I'm sore all over. </div>
                  </div>
                </li>
                <li class="from_user left"> <a href="#" class="avatar"><img src="<?=base_url().ASSETS_PATH?>img/message_avatar2.png"/></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name">Celeste Holm </a> <span class="time">1 Day ago</span>
                      <div class="options_arrow">
                        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="../../page.html"> <i class="icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class=" icon-share-alt icon-large"></i>Reply</a></li>
                            <li><a href="#"><i class=" icon-trash icon-large"></i>Delete</a></li>
                            <li><a href="#"><i class=" icon-share icon-large"></i>Share</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text"> Thank you! </div>
                  </div>
                </li>
              </ul>
            </div>
            
          </div>
          
        </div>
        
        
      </div>-->
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>