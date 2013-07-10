<div class="span3" style="margin-left:80px; width:245px;">
          <div class="title">
            <div class="row-fluid legend">
              <h1>
			  <?php
			  //
			  $user_info 		=  $this->session->userdata('cart_contents');
                //$this->show->pe($this->session->userdata('cart_contents'));
			  if(!empty($this->customer['tutor_id'])){
			  
			   //print_r($tutor_details);exit; 
			  	$get_address 	= $this->Tutor_model->get_address($user_info['customer']['tutor_id']);
				$get_address_cus  = "";                
			    echo  $user_info['customer']['firstname']." ". $user_info['customer']['lastname'];      
			  }
			  if($this->Customer_model->is_logged_in(false, false))
			  
			  {
				  
				  $get_address_cus  = $this->Customer_model->get_address_pro($user_info['customer']['id']);
				  $get_address = "";
				  echo  $user_info['customer']['firstname']." ". $user_info['customer']['lastname'];
			  }
			  
			  
			   ?>
                </h1>
            </div>
          </div>
          <!-- End .title -->
          <div class="content">
            <div class="row-fluid well well-small">
            
             <img class="row-fluid" src= "<?php
			  if(!empty($get_address) && $get_address[0]->avatar!="" ){ echo base_url().'uploads/images/full/'.$get_address[0]->avatar;}
			  if(!empty($get_address_cus) && $get_address_cus[0]->image!=""){ echo base_url().'uploads/images/full/'.$get_address_cus[0]->image;} 
			  if(!empty($get_address_cus))
			  {if($get_address_cus[0]->image==""){echo theme_img('avatar.png');}}
			  
			  if(!empty($get_address))
			  {if($get_address[0]->avatar==""){echo theme_img('avatar.png');}}
			?>"> </div>
            <ul class="nav1 nav-tabs dark nav-stacked">
            <?php if(!empty($this->customer['tutor_id'])){?>
			<li><a href="<?= base_url();?>dashboard/"><i class="gicon-dashboard"></i>Dashboard</a></li>
              <li><a href="<?= base_url();?>dashboard/my_profile"><i class="gicon-user"></i>Profile</a></li>
              <li><a href="<?= base_url();?>dashboard/course"><i class="gicon-course"></i>My Course</a></li>
              <li><a href="<?= base_url();?>dashboard/fourm"><i class="gicon-fourm"></i>Fourms</a></li>
              <li><a href="<?= base_url();?>dashboard/file_manager"><i class="gicon-filemanager"></i>File Manasger</a></li>
              <li><a href="<?= base_url();?>tutor_login/logout"><i class="gicon-logout"></i>Log Out</a></li>
              <?php }?>
              <?php if(!empty($this->customer['id'])){?>
             
              <li><a href="<?= base_url();?>dashboard/"><i class="gicon-dashboard"></i>Dashboard</a></li>
              <li><a href="<?= base_url();?>dashboard/my_account"><i class="gicon-user"></i>Profile</a></li>
              <li><a href="<?= base_url();?>dashboard/course"><i class="gicon-course"></i>My Course</a></li>
              <li><a href="<?= base_url();?>dashboard/fourm"><i class="gicon-fourm"></i>Fourms</a></li>
              <li><a href="<?= base_url();?>dashboard/file_manager"><i class="gicon-filemanager"></i>File Manasger</a></li>
               <li><a href="<?= base_url();?>secure/logout"><i class="gicon-logout"></i>Log Out</a></li>
              <?php }?>
              
            </ul>
          </div>
          <!-- End .content --> 
        </div>