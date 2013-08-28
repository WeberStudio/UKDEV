<?php include('main_header.php')?>   
    <body>
 
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        
        <!-- mail grid -->
        <div class="onepcssgrid-1200">
        
            <!-- header -->
            <?php include('header.php')?> 
            <!-- /header -->
            
            <section>
                <div class="onerow">
                  <?php include('dashboard_leftpanal.php')?>      
                        <div class="col8">
                        <div class="">
     <h3>My Course</h3>
    
    <table border="2" width="100%">
    <thead>
        <tr>
            <!--<th><input type="checkbox" id="gc_check_all" /> <button type="submit" class="btn btn-small btn-danger"><i class="icon-trash icon-white"></i></button></th>-->
            <th> Number</th>
            <th><?php echo lang('price');?></th>
            <th>Status</th>
            <th>Tutor</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    
    <?php foreach($orderss as $order): 
    
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
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
