<?php
    
	$active_catalog		= '';
	$active_cat			= ''; 
    $active_dash		= '';
    $active_invoice		= '';
	$invoice_links		= '';
	$active_sales		= '';
	$sales_links		= '';
	$active_contents 	= '';
	$content_links		= '';
	$active_commisions	= '';
	$commisioin_links	= '';
	$active_price		= '';
	$price_link			= '';
	$active_report		= '';
	$report_link		= '';
	$system_templates	= '';
	$active_template	= '';	
	$user_management	 = '';
	$active_promotions	 = '';
	$coupons_links		 = '';
	$active_template_link			= '';
	$active_assignment_management	= '';
	$assignment_management_links	= '';
	$student_invoices				= '';
	$active_student_invoices_link	= '';
	$course_provider_invoices 		= '';
	$active_cprovider_invoices_link	= '';
	
	
	$active = $this->session->userdata('active_module');
	//print_r($active);
    if($active=='dashboard')
    {
        $active_dash			= 'active';
		
    }
    else if($active == 'categories')
    {
        $active_catalog			= 'opened';
		$active_cat				= 'in collapse';		
		//$this->session->unset_userdata('active_module');
		
    }  
    else if($active == 'contents')
   {
            $active_contents		= 'opened';
			$content_links		= 'in collapse';
    }
    else if($active == 'invoice')
    {
            $active_invoice		= 'opened';
			$invoice_links		= 'in collapse';
    }
	 else if($active == 'sales')
    {
            $active_sales		= 'opened';
			$sales_links		= 'in collapse';
    }
	 else if($active == 'commisions')
    {
            $active_commisions		= 'opened';
			$commisioin_links		= 'in collapse';
    }
	 else if($active == 'price')
    {
            $active_price		= 'opened';
			$price_link			= 'in collapse';
    }
	else if($active == 'report')
	{
		 	$active_report		= 'opened';
			$report_link		= 'in collapse';
	}
	else if($active == 'system_templates')
	{
		$active_template		= 'opened';
		$active_template_link	= 'in collapse';
	}
	else if($active == 'user_management')
	{
		 $user_management		= 'active';
	}
	else if($active == 'promotions')
	{
		 $active_promotions		= 'opened';
		 $coupons_links			= 'in collapse';
	}
	else if($active == 'tutors')
	{
		 $active_assignment_management	= 'opened';
		 $assignment_management_links	= 'in collapse';
	}	
	
	else if($active == 'student_invoices')
	{
		 $student_invoices						= 'opened';
		 $active_student_invoices_link			= 'in collapse';
	}
	else if($active == 'course_provider_invoices')
	{
		 $course_provider_invoices			= 'opened';
		 $active_cprovider_invoices_link	= 'in collapse';
	}	
	
?>
<div id="sidebar" class="">
    <div class="scrollbar">
        <div class="track">
            <div class="thumb">
                <div class="end"></div>
            </div>
        </div>
    </div>
    <div class="viewport ">
        <div class="overview collapse">
            <div class="search row-fluid container">
                <h2>Search</h2>
                <form class="form-search">
                    <div class="input-append">
                        <div class="form-row control-group row-fluid">
                            <div class="controls span12">
                                <select name="URL" data-placeholder="Choose a Module..." class="chzn-select" 
                                    onchange="window.location.href= this.form.URL.options[this.form.URL.selectedIndex].value">
                                    <option value=""></option>
                                    <? if(isset($this->admin_access) && $this->admin_access=='Superadmin'){ ?>
                                    <option value="<?=base_url().ADMIN_PATH?>dashboard">Dashboard</option>
                                    <option value="<?=base_url().ADMIN_PATH?>categories">Categories</option>
                                    <option value="<?=base_url().ADMIN_PATH?>products">Courses</option>
                                    <option value="<?=base_url().ADMIN_PATH?>products/price_options_form">Price Options</option>
                                    <option value="<?=base_url().ADMIN_PATH?>products/product_delivery_form">Delivery Charges</option>
                                    <option value="<?=base_url().ADMIN_PATH?>customers">Customer</option>
                                    <option value="<?=base_url().ADMIN_PATH?>admin">Course Provider</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoice_templates'); ?>">Invoice Template</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoice_groups'); ?>">Invoice Groups</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/tax'); ?>">Tax Rate</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoices/form'); ?>">Create Invoices</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoices/'); ?>">View Invoices</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoices/invoice_recursion'); ?>">View Recuring Invoices</option>
									<?php }?>
									<? if(isset($this->admin_access) && $this->admin_access=='Course Provider'){ ?>
                                   	<option value="<?=base_url().ADMIN_PATH?>categories">Categories</option>
                                    <option value="<?=base_url().ADMIN_PATH?>products">Courses</option>									
                                    <?php }?>
                                    <? if(isset($this->admin_access) && $this->admin_access=='Invoice Admin'){ ?>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoice_templates'); ?>">Invoice Template</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoice_groups'); ?>">Invoice Groups</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/tax'); ?>">Tax Rate</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoices/form'); ?>">Create Invoices</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoices/'); ?>">View Invoices</option>
                                    <option value="<?php echo site_url($this->config->item('admin_folder').'/invoices/invoice_recursion'); ?>">View Recuring Invoices</option>
                                    <?php }?>
                                    <? if(isset($this->admin_access) && $this->admin_access=='Site Admin'){ ?>
                                    <option value="<?=base_url().ADMIN_PATH?>categories">Categories</option>
                                    <option value="<?=base_url().ADMIN_PATH?>products">Courses</option>
                                    <option value="<?=base_url().ADMIN_PATH?>pages">Pages</option>
                                    <option value="<?=base_url().ADMIN_PATH?>pages/page_text">Home Page Content</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <ul id="sidebar_menu" class="navbar nav nav-list container full">
                <li class="accordion-group color_4 <?php echo $active_dash; ?>" onclick="set_module('dashboard')">
                    <a class="dashboard" href="<?=base_url().ADMIN_PATH?>dashboard">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/dashboard.png"><span>Dashboard</span></a> 
                </li>
                
                <? if(isset($this->admin_access) && $this->admin_access=='Superadmin'){ ?>
                 
               		<li class="accordion-group color_7 <?php echo $active_catalog; ?>" onclick="set_module('catalog')" >
                    <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse0">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Course Catalogue</span></a>
                    <ul id="collapse0" class="accordion-body collapse <?php echo $active_cat; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>categories">Categories</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>products">Courses</a></li>                       
                    </ul>
                </li>
                 <li class="accordion-group color_4 <?=$user_management?>" onclick="set_module('admin')">
                    <a href="<?=base_url().ADMIN_PATH?>admin">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/others.png"><span>User Management</span></a>						 
                </li>
                <li class="accordion-group color_9 <?php echo $active_price ; ?>" onclick="set_module('price')" >
                    <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Course Attributes</span></a>
                    <ul id="collapse1" class="accordion-body collapse <?php echo $price_link; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>products/price_options_form">Price Options</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>products/product_delivery_form">Delivery Charges</a></li>
                    </ul>
                </li>
                <small style="white-space:nowrap; color:#999999"></small>
                <li class="accordion-group color_25 <?php echo $active_report ; ?>" onclick="set_module('report')" >
                    <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse11">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>General Reports</span></a>
                    <ul id="collapse11" class="accordion-body collapse <?php echo $report_link; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>reports/stats_product_viewed">Courses Viewed</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>reports/product_purchased">Purchased Courses</a></li>                        
						<li><a href="<?=base_url().ADMIN_PATH?>reports/">General Sales Report</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>reports/stats_customer">Customer Orders-Total</a></li>
                    </ul>
                </li>
			
				<li class="accordion-group color_3 <?php echo $active_sales; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2" onclick="set_module('sales')">
					<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Sales Management</span></a>
					<ul id="collapse2" class="accordion-body collapse <?php echo $sales_links; ?>">
						<li><a href="<?=base_url().ADMIN_PATH?>customers">View Customers</a></li>
						<li><a href="<?=base_url().ADMIN_PATH?>order">Orders</a></li>
					</ul>
				</li>
				
				<li class="accordion-group color_12 <?php echo $active_assignment_management; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse9" onclick="set_module('assignment_management')">
					<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Assignment Management</span></a>
					<ul id="collapse9" class="accordion-body collapse <?php echo $assignment_management_links; ?>">						             
						<li><a href="<?=base_url().ADMIN_PATH?>tutor">Tutors</a></li>
						<li><a href="<?=base_url().ADMIN_PATH?>tutor/requested_tutor">Students Request for Tutors</a></li>
						<li><a href="<?=base_url().ADMIN_PATH?>forums">Forums</a></li> 						                           
					</ul>
				</li>
				
				
                <li class="accordion-group color_9 <?=$active_promotions?>" >
					<a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse8" onclick="set_module('promotions')">
					<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/others.png"><span>Promotions</span></a>
					<ul id="collapse8" class="accordion-body collapse <?php echo  $coupons_links; ?>">						
					<li><a href="<?=base_url().ADMIN_PATH?>coupons">Coupons</a></li>						
					</ul>					 
                </li>    
				<li class="accordion-group color_2 <?php echo $active_contents; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse3" onclick="set_module('contents')">
						<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Content Management</span></a>
					<ul id="collapse3" class="accordion-body collapse <?php echo  $content_links; ?>">

						<li><a href="<?=base_url().ADMIN_PATH?>pages">Pages</a></li>
						<li><a href="<?=base_url().ADMIN_PATH?>pages/page_text">Home Page Content</a></li>

					</ul>
				</li>
			
			
			
			
				<li class="accordion-group color_4 <?php echo $active_invoice; ?> " onclick="set_module('invoice')" >
					<a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse4"> 
						<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Invoice Settings</span></a>
					<ul id="collapse4" class="accordion-body collapse  <?=$invoice_links?>">						
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoice_groups'); ?>">Basic Invoice Settings</a></li>
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/tax'); ?>">Tax Rate</a></li>					
					</ul>
				</li>
				<li class="accordion-group color_25 <?php echo $student_invoices ; ?>" onclick="set_module('student_invoices')" >
					<a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse10" >
					<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Student Invoices</span></a>
					<ul id="collapse10" class="accordion-body collapse <?php echo $active_student_invoices_link; ?>">						
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/customer_invoice/form'); ?>">Create Invoice</a></li>
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/customer_invoice/'); ?>">View Invoices</a></li>
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/customer_invoice/view_recurring_invoices'); ?>">View Recuring Invoices</a></li> 							
					</ul>
				</li>
				
				<li class="accordion-group color_25 <?php echo $course_provider_invoices ; ?>" onclick="set_module('student_invoices')" >
					<a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse13" >
					<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Course Provider Invoices</span></a>
					<ul id="collapse13" class="accordion-body collapse <?php echo $active_cprovider_invoices_link; ?>">						
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoices/form'); ?>">Create Invoice</a></li>
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoices/'); ?>">View Invoices</a></li>												
					</ul>
				</li>
				
				
				
				
				
				<li class="accordion-group color_14 <?php echo $active_commisions; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse5" onclick="set_module('commisions')">
						<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Commission Structures</span></a>
					<ul id="collapse5" class="accordion-body collapse <?php echo  $commisioin_links; ?>">						
						<li><a href="<?=base_url().ADMIN_PATH?>commission">Commission</a></li>						
					</ul>
				</li>
				
				<li class="accordion-group color_25 <?php echo $active_template ; ?>" onclick="set_module('email_template')" >
					<a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse12" >
					<img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Templates</span></a>
					<ul id="collapse12" class="accordion-body collapse <?php echo $active_template_link; ?>">
						<li><a href="<?=base_url().ADMIN_PATH?>system_templates">Email Templates</a></li>
						<li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoice_templates'); ?>">Invoice Templates</a></li>							
					</ul>
				</li>
					
                    <? } ?>
                    <?php if(isset($this->admin_access) && $this->admin_access=='Course Provider'){ ?>
                    <li class="accordion-group color_7 <?php echo $active_catalog; ?>" onclick="set_module('catalog')" >
                    <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Catalog</span></a>
                    <ul id="collapse1" class="accordion-body collapse <?php echo $active_cat; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>categories">Categories</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>products">Courses</a></li>
                        <!--<li><a href="<?=base_url().ADMIN_PATH?>digital_products">Digital Products</a></li>-->
                    </ul>
                </li>
                     <? } ?>
                     <?php if(isset($this->admin_access) && $this->admin_access=='Invoice Admin'){ ?>
                    <li class="accordion-group color_4 <?php echo $active_invoice; ?> " onclick="set_module('invoice')" >
                        <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse4"> 
                            <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Invoice Management</span></a>
                        <ul id="collapse4" class="accordion-body collapse  <?=$invoice_links?>">
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoice_templates'); ?>">Invoice Templates</a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoice_groups'); ?>">Invoice Groups</a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/tax'); ?>">Tax Rate</a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoices/form'); ?>">Create Invoice</a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoices/'); ?>">View Invoices</a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/invoices/view_recurring_invoices'); ?>">View Recuring Invoices</a></li>  
                            <!--<li><a href="<?=base_url().ADMIN_PATH?>digital_products">Digital Products</a></li>-->
                        </ul>
                    </li>
                     <? } ?>
                     <?php if(isset($this->admin_access) && $this->admin_access=='Site Admin'){ ?>
                    <li class="accordion-group color_7 <?php echo $active_catalog; ?>" onclick="set_module('catalog')" >
                    <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Catalog</span></a>
                    <ul id="collapse1" class="accordion-body collapse <?php echo $active_cat; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>categories">Categories</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>products">Courses</a></li>
                        <!--<li><a href="<?=base_url().ADMIN_PATH?>digital_products">Digital Products</a></li>-->
                    </ul>
                </li>
                	<li class="accordion-group color_2 <?php echo $active_contents; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse3" onclick="set_module('contents')">
                            <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Contents</span></a>
                        <ul id="collapse3" class="accordion-body collapse <?php echo  $content_links; ?>">

                            <li><a href="<?=base_url().ADMIN_PATH?>pages">Pages</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>pages/page_text">Home Page Content</a></li>

                        </ul>
                    </li>
                     <? } ?>
                    
                    
            </ul>
            <div class="menu_states row-fluid container ">
                <h2 class="pull-left">Menu Settings</h2>
                <div class="options pull-right">
                    <button id="menu_state_1" class="color_4" rel="tooltip" data-state ="sidebar_icons" data-placement="top" data-original-title="Icon Menu">1</button>
                    <button id="menu_state_2" class="color_4 active" rel="tooltip" data-state ="sidebar_default" data-placement="top" data-original-title="Fixed Menu">2</button>
                    <button id="menu_state_3" class="color_4" rel="tooltip" data-placement="top" data-state ="sidebar_hover" data-original-title="Floating on Hover Menu">3</button>
                </div>
            </div>
            <!-- End sidebar_box --> 

        </div>
    </div>
</div> <br clear="all">