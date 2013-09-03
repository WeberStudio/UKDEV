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
       <?php
	    if(empty($this->customer['id']))
	   {
	     $get_address = $this->Tutor_model->get_address($this->customer['tutor_id']);
	   }
	    if(empty($this->customer['tutor_id'])){
			
			$get_address_cus = $this->Customer_model->get_address_pro($this->customer['id']);
			//echo "<pre>" ;print_r($get_address_cus); exit;
	   }
		?>
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
			
			 if(!empty($get_address_cus)){ echo $get_address_cus[0]->address_street." <b>,</b> ".$get_address_cus[0]->address_line."<br>
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
           
          <!--  <h3><span>Other info</span></h3>
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit, dolor at molestie bibendum, diam est imperdiet libero, vel malesuada augue metus ultricies velit. In semper, neque vel luctus ullamcorper, lectus ligula faucibus risus, eget ultrices nisl magna eu ligula. Proin ipsum metus, varius sit amet dapibus id, dapibus vel felis. Duis eu odio mauris. Maecenas pulvinar dignissim arcu, quis elementum erat volutpat ac. Ut et neque a justo scelerisque pellentesque. Maecenas ut quam vitae mi condimentum iaculis at sed erat.</p>
            <p> In sit amet urna turpis, sit amet pretium nisi. Maecenas quam sem, aliquam nec vehicula sed, fringilla nec leo. Phasellus nec orci orci, vestibulum rutrum urna. Maecenas aliquam ipsum ut purus posuere suscipit. Vivamus posuere gravida metus. Aliquam erat volutpat. Suspendisse euismod pellentesque leo et imperdiet.</p>
            <p> In sit amet urna turpis, sit amet pretium nisi. Maecenas quam sem, aliquam nec vehicula sed, fringilla nec leo. Phasellus nec orci orci, vestibulum rutrum urna. Maecenas aliquam ipsum ut purus posuere suscipit. Vivamus posuere gravida metus. Aliquam erat volutpat. Suspendisse euismod pellentesque leo et imperdiet.</p>-->
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