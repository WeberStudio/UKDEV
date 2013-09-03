<?php
class Invoice_Groups extends Admin_Controller {

	//this is used when editing or adding a customer
	//var $customer_id	= false;	
	
	
	function __construct()
	{		
		parent::__construct();
		//$this->auth->check_access('Superadmin', true);
		
		/*** Get User Info***/
		//$admin_info = $this->admin_session->userdata('admin');
		$user_info 			= $this->auth->admin_info();
		$this->admin_id 	= $user_info['id'];
		$this->admin_email  = $user_info['email'];
		$this->admin_access = $user_info['access'];
		$this->first_name 	= $user_info['firstname'];
		$this->last_name 	= $user_info['lastname'];
		$this->image 		= $user_info['image'];
		/*** Get User Info***/
		
		// checking admin access start\\
		if($user_info['access'] == "Superadmin")
		{
			$this->auth->check_access('Superadmin', true);
		}
		else
		{
			$this->auth->check_access('Invoice Admin', true);
		}
		
		// checking admin access end\\
		
		/*** Left Menu Selection ***/
		$this->session->set_userdata('active_module', 'invoice');
		/*** Left Menu Selection ***/
		
		
		$this->lang->load('invoice');		
		$this->load->model(array('Invoice_Groups_Model', 'Location_model'));
		$this->load->helper('formatting_helper');
		
	}
	
	function index($field='invoice_group_id', $by='ASC', $page=0)
	{
		
		$data['groups']	= $this->Invoice_Groups_Model->get_groups(50,$page, $field, $by);
		
		 //echo "<pre>";print_r($data['templates']);exit;
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
		$this->load->view($this->config->item('admin_folder').'/groups/invoice_group_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer'); 
	}
	
	
	function form($id = false)
	{
		force_ssl();
		$this->load->helper('form');
		$this->load->library('form_validation');
		//echo "<pre>";print_r($_POST);exit;
		//default values are empty if the customer is new
		$data['id']							= '';
		$data['admin_id']					= '';
		$data['invoice_group_name']			= '';
		$data['invoice_group_prefix']		= '';		
		$data['invoice_group_next_id']		= '';		
		$data['invoice_group_left_pad']		= '0';
		$data['invoice_group_prefix_year']	= '';
		$data['invoice_group_prefix_month']	= '';
		$data['invoice_group_for']			= '';
		
		
						
		if ($id)
		{	
			$this->invoice_group_id	= $id;
			$groups	= $this->Invoice_Groups_Model->get_groups_by_id($id);
			//if the groups does not exist, redirect them to the groups list with an error
			if (!$groups)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/invoice_groups/form');
			}
			//echo "<pre>";print_r($groups);exit;
			//set values to db values
			$data['id']							= $groups->invoice_group_id;
			$data['admin_id']					= $groups->admin_id;
			$data['invoice_group_name']			= $groups->invoice_group_name;
			$data['invoice_group_prefix']		= $groups->invoice_group_prefix;
			$data['invoice_group_next_id']		= $groups->invoice_group_next_id;
			$data['invoice_group_left_pad']		= $groups->invoice_group_left_pad;
			$data['invoice_group_prefix_year']	= $groups->invoice_group_prefix_year;
			$data['invoice_group_prefix_month']	= $groups->invoice_group_prefix_month;
			$data['invoice_group_for']			= $groups->invoice_group_for;
			
		}
		
		$this->form_validation->set_rules('invoice_group_name',  'Name', 'trim|required');
		$this->form_validation->set_rules('invoice_group_prefix', 'Prefix', 'trim|required');
		
		
		 //echo "<pre>";print_r($_POST);exit;
		// echo validation_errors();exit;
		if ($this->form_validation->run() == FALSE)
		{    
            //echo "<pre>";print_r($_POST);exit;
			$this->load->view($this->config->item('admin_folder').'/includes/header');
            $this->load->view($this->config->item('admin_folder').'/includes/leftbar');  
			$this->load->view($this->config->item('admin_folder').'/groups/invoice_group_form', $data);
            $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$save['invoice_group_id']			= $id;
			$save['admin_id'] 					= $this->admin_access;
			$save['invoice_group_name']			= $this->input->post('invoice_group_name');
			$save['invoice_group_prefix']		= $this->input->post('invoice_group_prefix');
			$save['invoice_group_next_id']		= $this->input->post('invoice_group_next_id');
			$save['invoice_group_left_pad']		= $this->input->post('invoice_group_left_pad');
			$save['invoice_group_prefix_year']	= $this->input->post('invoice_group_prefix_year');
			$save['invoice_group_prefix_month']	= $this->input->post('invoice_group_prefix_month');
			$save['invoice_group_for']			= $this->input->post('invoice_group_for');
			
			$id = $this->Invoice_Groups_Model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_group_template'));
			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/invoice_groups/form/'.$id);
		}
	}
	
	
	
	function delete($id = false)
	{
		if ($id)
		{	
			$group	= $this->Invoice_Groups_Model->get_groups_by_id($id);
			
			//if the group does not exist, redirect them to the group list with an error
			if (!$group)
			{
				
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/invoice_groups');
			}
			else
			{
				
				//if the customer is legit, delete them
				$delete	= $this->Invoice_Groups_Model->delete($id);
				
				$this->session->set_flashdata('message', lang('message_deleted'));
				redirect($this->config->item('admin_folder').'/invoice_groups');
			}
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/invoice_groups');
		}
	}
	
	
	
}