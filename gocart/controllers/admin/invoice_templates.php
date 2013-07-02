<?php
class Invoice_Templates extends Admin_Controller {

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
		$this->load->model(array('Invoice_Template_model', 'Location_model'));
		$this->load->helper('formatting_helper');
		
	}
	
	function index($field='invoice_template_id', $by='ASC', $page=0, $rows = 5)
	{
		
		$data['templates']	= $this->Invoice_Template_model->get_templates($rows, $page, $field, $by);
		$data['count']		= $this->Invoice_Template_model->get_templates_count();
		 //echo "<pre>";print_r($data['templates']);exit;
		$this->load->library('pagination');
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/invoice_templates/index/'.$field.'/'.$by.'/';
		$config['total_rows']		= $data['count'];
		$config['per_page']			= $rows;
		$config['uri_segment']		= 6;
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';

		$config['full_tag_open']	= '<div class="pagination"><ul>';
		$config['full_tag_close']	= '</ul></div>';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close']	= '</a></li>';
		
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		
		$config['prev_link']		= 'Prev';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';

		$config['next_link']		= 'Next';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';		
		$this->pagination->initialize($config);
		
		
		
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
		$this->load->view($this->config->item('admin_folder').'/invoice/invoice_template_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer'); 
	}
	
	
	function form($id = false)
	{
		force_ssl();
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//default values are empty if the customer is new
		$data['id']							= '';
		$data['admin_id']					= '';
		$data['invoice_template_title']		= '';
		$data['invoice_template_header']	= '';		
		$data['invoice_template_footer']	= '';		
		$data['invoice_template_level']		= '0';
		$data['invoice_template_logo']		= '';
						
		if ($id)
		{	
			$this->invoice_template_id	= $id;
			$templates	= $this->Invoice_Template_model->get_templates_by_id($id);
			//if the templates does not exist, redirect them to the templates list with an error
			if (!$templates)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/invoice_templates/form');
			}
			//echo "<pre>";print_r($templates);exit;
			//set values to db values
			$data['id']							= $templates->invoice_template_id;
			$data['admin_id']					= $templates->admin_id;
			$data['invoice_template_title']		= $templates->invoice_template_title;
			$data['invoice_template_header']	= $templates->invoice_template_header;
			$data['invoice_template_footer']	= $templates->invoice_template_footer;
			$data['invoice_template_level']		= $templates->invoice_template_level;
			$data['invoice_template_logo']		= $templates->invoice_template_logo;
			
		}
		
		$this->form_validation->set_rules('invoice_template_title',  'Template Titile', 'trim|required');
		$this->form_validation->set_rules('invoice_template_header', 'Header html', 'trim|required');
		$this->form_validation->set_rules('invoice_template_footer', 'Footer html', 'trim|required');
		//$this->form_validation->set_rules('invoice_template_level', 'lang:invoice_template_level', 'trim|required');
		
		 //echo "<pre>";print_r($_POST);exit;
		// echo validation_errors();exit;
		if ($this->form_validation->run() == FALSE)
		{    
            //echo "<pre>";print_r($_POST);exit;
			$this->load->view($this->config->item('admin_folder').'/includes/header');
            $this->load->view($this->config->item('admin_folder').'/includes/leftbar');  
			$this->load->view($this->config->item('admin_folder').'/invoice/invoice_template_form', $data);
            $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$save['invoice_template_id']		= $id;
			$save['admin_id'] 					= $this->admin_access;
			$save['invoice_template_title']		= $this->input->post('invoice_template_title');
			$save['invoice_template_header']	= addslashes($this->input->post('invoice_template_header'));
			$save['invoice_template_footer']	= addslashes($this->input->post('invoice_template_footer'));
			$save['invoice_template_level']		= $this->input->post('invoice_template_level');
			if(empty($save['invoice_template_level']))
			{
				$save['invoice_template_level']		= 'Normal';
			}
			else
			{
				$save['invoice_template_level']		= 'Universal';
				
			}
			
			$save['invoice_template_logo']		= $this->input->post('invoice_template_logo');
			
			$id = $this->Invoice_Template_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_invoice_template'));
			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/invoice_templates/form/'.$id);
		}
	}
	
	
	
	function delete($id = false)
	{
		if ($id)
		{	
			$template	= $this->Invoice_Template_model->get_templates_by_id($id);
			
			//if the customer does not exist, redirect them to the customer list with an error
			if (!$template)
			{
				
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/invoice_templates');
			}
			else
			{
				
				//if the customer is legit, delete them
				$delete	= $this->Invoice_Template_model->delete($id);
				
				$this->session->set_flashdata('message', lang('message_deleted'));
				redirect($this->config->item('admin_folder').'/invoice_templates');
			}
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/invoice_templates');
		}
	}
	
	//this is a callback to make sure that customers are not sharing an email address
	function check_email($str)
	{
		$email = $this->Customer_model->check_email($str, $this->customer_id);
		if ($email)
		{
			$this->form_validation->set_message('check_email', lang('error_email_in_use'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
}