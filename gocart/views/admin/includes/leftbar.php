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
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Catalogue</span></a>
                    <ul id="collapse0" class="accordion-body collapse <?php echo $active_cat; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>categories">Categories</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>products">Courses</a></li>
                        <!--<li><a href="<?=base_url().ADMIN_PATH?>digital_products">Digital Products</a></li>-->						
						<!--<li><a href="<?=base_url().ADMIN_PATH?>products/price_options_form">Price Options</a></li>-->
                    </ul>
                </li>
                
                <li class="accordion-group color_9 <?php echo $active_price ; ?>" onclick="set_module('price')" >
                    <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Attribute</span></a>
                    <ul id="collapse1" class="accordion-body collapse <?php echo $price_link; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>products/price_options_form">Price Options</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>products/product_delivery_form">Delivery Charges</a></li>
                    </ul>
                </li>
                
                <li class="accordion-group color_25 <?php echo $active_report ; ?>" onclick="set_module('report')" >
                    <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse11">
                        <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/forms.png"><span>Reports</span></a>
                    <ul id="collapse11" class="accordion-body collapse <?php echo $report_link; ?>">
                        <li><a href="<?=base_url().ADMIN_PATH?>reports/stats_product_viewed">Products Viewed</a></li>
                        <li><a href="<?=base_url().ADMIN_PATH?>reports/product_purchased">Products Purchased</a></li>
<<<<<<< HEAD
                        <!--<li><a href="<?=base_url().ADMIN_PATH?>products/product_delivery_form">Customer Orders-Total</a></li>-->
						<li><a href="<?=base_url().ADMIN_PATH?>reports/">Sales Report</a></li>
=======
                        <li><a href="<?=base_url().ADMIN_PATH?>reports/stats_customer">Customer Orders-Total</a></li>
>>>>>>> ebbfc799f50b028d6792030d7632ff12456ae56f
                    </ul>
                </li>
                
                	<li class="accordion-group color_3 <?php echo $active_sales; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2" onclick="set_module('sales')">
                            <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Sales</span></a>
                        <ul id="collapse2" class="accordion-body collapse <?php echo$sales_links; ?>">
                            <!--<li><a href="<?=base_url().ADMIN_PATH?>orders">Orders</a></li>-->
                            <li><a href="<?=base_url().ADMIN_PATH?>customers">Customers</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>admin">Course Providers</a></li>
							<li><a href="<?=base_url().ADMIN_PATH?>tutor">Tutors</a></li>
							<li><a href="<?=base_url().ADMIN_PATH?>tutor/requested_tutor">Requested Tutors</a></li>
							<li><a href="<?=base_url().ADMIN_PATH?>order">Orders</a></li>
							 <li><a href="<?=base_url().ADMIN_PATH?>coupons">Coupons</a></li>
							 <li><a href="<?=base_url().ADMIN_PATH?>forums">Forums</a></li>
                            <!-- <li><a href="<?=base_url().ADMIN_PATH?>customers/groups">Groups</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>reports">Reports</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>coupons">Coupons</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>giftcards">Giftcards</a></li>-->
                        </ul>
                    </li>
                    
					<li class="accordion-group color_2 <?php echo $active_contents; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse3" onclick="set_module('contents')">
                            <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Contents</span></a>
                        <ul id="collapse3" class="accordion-body collapse <?php echo  $content_links; ?>">

                            <li><a href="<?=base_url().ADMIN_PATH?>pages">Pages</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>pages/page_text">Home Page Content</a></li>

                        </ul>
                    </li>
				
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
                    
					<li class="accordion-group color_14 <?php echo $active_commisions; ?>"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse5" onclick="set_module('commisions')">
                            <img src="<?=base_url().ASSETS_PATH?>img/menu_icons/widgets.png"><span>Commission</span></a>
                        <ul id="collapse5" class="accordion-body collapse <?php echo  $commisioin_links; ?>">
                            <!--<li><a href="<?=base_url().ADMIN_PATH?>orders">Orders</a></li>-->
                            <li><a href="<?=base_url().ADMIN_PATH?>commission">Commission</a></li>
						    <!-- <li><a href="<?=base_url().ADMIN_PATH?>customers/groups">Groups</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>reports">Reports</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>coupons">Coupons</a></li>
                            <li><a href="<?=base_url().ADMIN_PATH?>giftcards">Giftcards</a></li>-->
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