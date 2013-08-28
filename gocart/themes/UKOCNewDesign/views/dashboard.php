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
                            <div class="content spacer-big">
                                <h3><span>About Me</span></h3>
                                <hr>
                                <p><?php
                                
                                 if(!empty($get_address)){ echo  $get_address[0]->about;}
                                 
                                  if(!empty($get_address_cus)){ echo  $get_address_cus[0]->about;}
                                 ?></p>
                               
                              
                                <h3><span>Address</span></h3>
                                <hr>
                                <address>
                                <!--<strong>PixelGrade, Inc.</strong>-->
                                 <?php
                                  if(!empty($get_address)){ echo $get_address[0]->street_address." <b>,</b> ".$get_address[0]->address_line_op."<br>
                                ". $get_address[0]->city." <b>,</b> ". $get_address[0]->state_code."  ". $get_address[0]->country_name ."<br>
                                <abbr title='Phone'>P:</abbr> ". $get_address[0]->phone;}
                                
                                 if(!empty($get_address_cus))
                                 { echo $get_address_cus[0]->address_street." <b>,</b> ".$get_address_cus[0]->address_line."<br>
                                ". $get_address_cus[0]->city." <b>,</b> ". $get_address_cus[0]->state_code."  ". $get_address_cus[0]->country_name ."<br>
                                <abbr title='Phone'>P:</abbr> ". $get_address_cus[0]->phone;}
                                
                                ?>
                                </address>
                                <address>
                                <strong>E-Mail</strong>
                                <br>
                                <a href="mailto:#">
                                <?php 
                                if(!empty($get_address)){ echo  $get_address[0]->email;}
                                
                                if(!empty($get_address_cus)){ echo  $get_address_cus[0]->email;}
                                
                                ?></a>
                                </address>
                              </div>
                        </div>
                    
                </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
