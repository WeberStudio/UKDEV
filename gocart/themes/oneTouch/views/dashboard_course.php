 <?php include('mainHeader.php'); ?>
  <?php  echo theme_css('basee.css', true); ?> 
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
        <script> var customStyleImgUrl = "images/custom-slider-img";</script>
          <?php //include('leftPanel.php'); ?>
<!--        
-->		
        <div id="body-wrapper" >		
            <div id="body-wrapper-padding">			
                <!--[if lt IE 7]>
                <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
                browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
                experience this site.
                </div><![endif]-->
                 <?php include('header.php'); ?> 
                 <div class="row">
					<div class="line"></div>
				</div>
               
<div id="main">
  <div class="container">
        
    <div id="main_container">
      <div class="row-fluid">
        <?php include('dashboard_leftpanal.php');?>
        <!-- End .span3 -->
        
        <div class="span9" style="width: 960px;">
          
          <!-- End .legend -->
          
         
	<!--<div class="span12" style="border-bottom:1px solid #f5f5f5;">
		<div class="row">
			
				
			
			<div class="span11">
				<?php //echo form_open($this->config->item('admin_folder').'/orders/index', 'class="form-inline" style="float:right"');?>
					<fieldset>
						<input id="start_top"  value="" class="span3" type="text" placeholder="Start Date"/>
						<input id="start_top_alt" type="hidden" name="start_date" />
						<input id="end_top" value="" class="span3" type="text"  placeholder="End Date"/>
						<input id="end_top_alt" type="hidden" name="end_date" />
				
						<input id="top" type="text" class="span3" name="term" placeholder=" term<?php //echo lang('term')?>" /> 
						
						<input type="button" class="button" name="" value="search"/><?php ////echo lang('search')?>
						<input type="button" class="button" name="" value="export"/><?php ////echo lang('xml_export')?>
					</fieldset>
				</form>
			</div>
		</div>
	</div>-->


<div class="row">
<div id="content" class="fifteen columns">
<div class="col-1">
 	<h3>My Course</h3>
	
	<table width="100%">
    <thead>
		<tr>
			<!--<th><input type="checkbox" id="gc_check_all" /> <button type="submit" class="btn btn-small btn-danger"><i class="icon-trash icon-white"></i></button></th>-->
			<th><?php //echo lang('name');?> Number</th>
			<th><?php echo lang('price');?></th>
			<th>Status</th>
            <th>Tutor</th>
			<th>Action</th>
	    </tr>
	</thead>

    <tbody>
	<?php //echo (count($orders) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_orders') .'</td></tr>':''
	 // echo  $this->show->pe( $this->Tutor_model->get_tutor_requests_by_id('customer_id',3991));
	   //$get_request =  $this->Tutor_model->get_tutor_requests_by_id('customer_id',3991,'subject_id',1);
           // echo $get_request[0]['request_status']; 
          //$this->show->pe($orderss); 
          //$get_tutor =  $this->Tutor_model->get_tutor_attributes('tutors',30);
          //echo $get_tutor[0]->lastname; 
           //$this->show->pe($get_tutor);
             
	?>
    
    <?php foreach($orderss as $order): 
	//$this->show->pe(unserialize($order->contents));
	$product_id = unserialize($order->contents);
	?>
	<tr>
    
		<!--<td><input type="checkbox" id="gc_check_all" /></td>-->
		<td style="white-space:nowrap"><?php echo $order->order_number;?></td>
		<td style="white-space:nowrap"><?php echo $order->total;?></td>
        <?php
          $get_request =  $this->Tutor_model->get_tutor_requests_by_id('customer_id', $order->customer_id,'subject_id', $order->product_id);
             //$this->show->pe($get_request); 
         ?>
          
             
              
               <td style="white-space:nowrap"><?php echo $order->status;?></td>
              
              <td>
                  <?php
                     if(isset($get_request[0]['tutor_id'])){
                    if(is_numeric($get_request[0]['tutor_id'])){  
                   $get_tutor =  $this->Tutor_model->get_tutor_attributes('tutors',$get_request[0]['tutor_id']);
                   if(!empty($get_tutor)){echo ucwords(strtolower($get_tutor[0]->lastname.' '.$get_tutor[0]->firstname));}
                    } 
                     }
                     else{echo 'No Tutor Assigned';}
                    ?>

                  
               </td>
		<td style="white-space:nowrap" >
        <a class="button"<?php 
         if($get_request[0]['request_status']==""){echo ' href="'. base_url().'dashboard/request_for_tutor/'.$order->customer_id.'/'.$order->product_id.'"'; }
         else{echo 'href="javascript:void(0);"';}
         ?>>
        <?php
        if(isset($get_request[0]['request_status'])){ 
        if($get_request[0]['request_status']==""){echo 'Request Tutor';}
        elseif($get_request[0]['request_status']=='Tutor Assigned'){echo 'Tutor Assigned';}
         else{echo 'Wait for Approval';}
         }
         else{echo 'Request Tutor';}
        ?>
         
        </a>
        </td>
        
        
	</tr>
     
    <?php endforeach; ?>
    
    </tbody>
</table>

</div>
</div>
</div>

          <!-- End .content --> 
        </div>
        <!-- End .span9 --> 
      </div>
      <!-- End .row-fluid --> 
      
    </div>
    <!-- End #container --> 
  </div>
 
</div>
            </div>
        </div>
        <?php include_once('footer.php'); ?> 
        
       
    </body>
</html>

