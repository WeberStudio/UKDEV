<style>
.menu_simple ul {
margin: 0;
padding: 0;
width:250px;
list-style-type: none;
}
.menu_simple ul li{

border:1px solid #efefef;
    
}
.menu_simple ul li a {
text-decoration: none;
color:rgba(1,1,1,0.5);
padding: 10.5px 11px;
background-color: #FFF;
display:block;
}

.menu_simple ul li a:visited {
color: rgba(1,1,1,0.5);
}

.menu_simple ul li a:hover, .menu_simple ul li .current {
color: white;
background-color: #2D3291;
}

</style>
<div class="col3">            
                            <div class="menu_simple">
                                <ul>
                                    <li>
                                        <a href="#">
                                        <h2>
                                            <?php
                                              
                                              $user_info         =  $this->session->userdata('cart_contents');
                                                //$this->show->pe($this->session->userdata('cart_contents'));
                                              if(!empty($this->customer['tutor_id'])){
                                              
                                               //print_r($tutor_details);exit; 
                                                  $get_address     = $this->Tutor_model->get_address($user_info['customer']['tutor_id']);
                                                $get_address_cus  = "";                
                                                echo  $user_info['customer']['firstname']." ". $user_info['customer']['lastname'];      
                                              }
                                              if($this->Customer_model->is_logged_in(false, false))
                                              
                                              {
                                                  
                                                  $get_address_cus  = $this->Customer_model->get_address_pro($user_info['customer']['id']);
                                                   //$this->show->pe($get_address_cus); 
                                                  $get_address = "";
                                                  echo  $user_info['customer']['firstname']." ". $user_info['customer']['lastname'].$this->customer['id'];
                                              }
                  
                  
                                                ?>
                                        </h2>
                                        </a>
                                    </li>
                                </ul>
                                
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img style="height: 150px; width: 225px;" class="row-fluid" src= "<?php
                                                  if(!empty($get_address) && $get_address[0]->avatar!="" ){ echo base_url().'uploads/images/full/'.$get_address[0]->avatar;}
                                                  if(!empty($get_address_cus) && $get_address_cus[0]->image!=""){ echo base_url().'uploads/images/full/'.$get_address_cus[0]->image;} 
                                                  if(!empty($get_address_cus))
                                                  {if($get_address_cus[0]->image==""){echo theme_img('avatar.png');}}
                                                  
                                                  if(!empty($get_address))
                                                  {if($get_address[0]->avatar==""){echo theme_img('avatar.png');}}
                                            ?>">
                                        </a>
                                    </li>
                                </ul>
                                
                                <ul>
                                    <?php if(!empty($this->customer['tutor_id'])){?>
                                      <li><a href="<?= base_url();?>dashboard/"><i class="gicon-dashboard"></i>Dashboard</a></li>
                                      <li><a href="<?= base_url();?>dashboard/my_profile"><i class="gicon-user"></i>Profile</a></li>
                                      <li><a href="<?= base_url();?>dashboard/course"><i class="gicon-course"></i>My Course</a></li>
                                      <li><a href="<?= base_url();?>dashboard/fourm"><i class="gicon-fourm"></i>My Tutor(s)</a></li>
                                      <li><a href="<?= base_url();?>dashboard/file_manager"><i class="gicon-filemanager"></i>File Manasger</a></li>
                                      <li><a href="<?= base_url();?>tutor_login/logout"><i class="gicon-logout"></i>Log Out</a></li>
                                      <?php }?>
                                      <?php if(!empty($this->customer['id'])){?>
                                     
                                      <li><a href="<?= base_url();?>dashboard/"><i class="gicon-dashboard"></i>Dashboard</a></li>
                                      <li><a href="<?= base_url();?>dashboard/my_account"><i class="gicon-user"></i>Profile</a></li>
                                      <li><a href="<?= base_url();?>dashboard/course"><i class="gicon-course"></i>My Course</a></li>
                                      <li><a href="<?= base_url();?>dashboard/fourm"><i class="gicon-fourm"></i>My Tutor(s)</a></li>
                                      <li><a href="<?= base_url();?>dashboard/file_manager"><i class="gicon-filemanager"></i>File Manasger</a></li>
                                       <li><a href="<?= base_url();?>secure/logout"><i class="gicon-logout"></i>Log Out</a></li>
                                      <?php }?>
                                </ul>
                            </div>
                        </div>