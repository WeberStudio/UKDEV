<?php
class Dashboard extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		remove_ssl();
		
		/*** Get User Info***/
		//$admin_info = $this->admin_session->userdata('admin');
		$user_info = $this->auth->admin_info();
		$this->admin_id = $user_info['id'];
		$this->admin_email = $user_info['email'];
		$this->admin_access = $user_info['access'];
		$this->first_name = $user_info['firstname'];
		$this->last_name = $user_info['lastname'];
		$this->image = $user_info['image'];
		/*** Get User Info***/
		
		/*** Left Menu Selection ***/
		$this->session->set_userdata('active_module', 'dashboard');
		/*** Left Menu Selection ***/
		
		if($this->auth->check_access('Orders'))
		{
			redirect($this->config->item('admin_folder').'/orders');
		}
		
		$this->load->model('Order_model');
		$this->load->model('Customer_model');
		$this->load->model('Product_model');
		$this->load->helper('date');		
		$this->lang->load('dashboard');
		$this->load->model('dashboard_model');
		
		
	}
	
	function index()
	{
		//check to see if shipping and payment modules are installed
		//$data['payment_module_installed']	= (bool)count($this->Settings_model->get_settings('payment_modules'));
		//$data['shipping_module_installed']	= (bool)count($this->Settings_model->get_settings('shipping_modules'));
		
		
		$data['page_title']					=  lang('dashboard');
		
		// get 5 latest orders
		$data['orders']						= $this->Order_model->get_orders(false, 'id' , 'DESC', 5);
		
		
		// All order 
		$data['enrolment_received']			= $this->Order_model->get_orders_count();
		
		// All Processing Order
		$data['enrolment_processing']		= $this->Order_model->get_processing_order();
		$data['enrolment_processing']		= count($data['enrolment_processing']);
		
		
		// All Delivered Order
		$data['payment_received']			= $this->Order_model->get_delivered_oder();
		$data['payment_received']			= count($data['payment_received']);
		
		
		// All Cancelled Order
		$data['cancelled_order']			= $this->Order_model->get_cancelled_order();
		$data['cancelled_order']			= count($data['cancelled_order']);
		
		
		// get 5 latest customers
		$data['customers'] 					= $this->Customer_model->get_customers(5,"","DESC");
		
		
		// total customer
		$data['customers_t'] 				= $this->Customer_model->count_customers();
		 
		 
		 // Deactive Customer
		$data['customers_d'] 				= $this->Customer_model->get_deactive_customers();
		$data['customers_d']				= count($data['customers_d']);
		
		
		// Newsletter subscribers Customer
		$data['customers_n'] 				= $this->Customer_model->get_newsletter_customers();
		$data['customers_n']				= count($data['customers_n']);
		
		// all Porducts
		$data['products'] 					= $this->Product_model->count_all_products();
		
		// all deactive peoduct
		$data['products_d'] 				= $this->Product_model->get_deactive_products_array();
		$data['products_d']					= count($data['products_d']);
		
		
		
		
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
		$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
		$this->load->view($this->config->item('admin_folder').'/dashboard', $data);
		$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');		
		
	}

}