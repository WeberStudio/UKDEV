<?php
class Default_Emails extends Admin_Controller {


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
		
		
		// checking admin access end\\
		
		
		/*** Left Menu Selection ***/
		$this->session->set_userdata('active_module', 'emails');
		/*** Left Menu Selection ***/
		
		
		$this->lang->load('invoice');	
		$this->load->model(array('System_Template_model', 'Location_model'));
		$this->load->helper('formatting_helper');
		
	}
	
	function index($field='d_email_id', $by='ASC', $page=0, $rows = 25)
	{
		
		$data['templates']	= $this->System_Template_model->get_default_emails($rows, $page, $field, $by);
		$data['count']		= $this->System_Template_model->get_default_emails();
		 //echo "<pre>";print_r($data['templates']);exit;
		$this->load->library('pagination');
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/default_emails/index/'.$field.'/'.$by.'/';
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
		$this->load->view($this->config->item('admin_folder').'/default_emails_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer'); 
	}
	
	
	function form($id = false)
	{
		
		force_ssl();
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//default values are empty if the customer is new
		$data['id']					= '';
		$data['email_template']		= '';
		$data['email_type']			= '';
		$data['email_template']		= '';		
		$data['middle_content']		= '';	
		$data['all_email_temp']		=  $this->System_Template_model->get_templates();
		//echo "<pre>";print_r($data['all_email_temp']);exit;			
		if ($id)
		{	
			$this->email			= $id;
			$templates				= $this->System_Template_model->get_default_email_by_id($id);
			//if the templates does not exist, redirect them to the templates list with an error
			if (!$templates)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/default_emails/form');
			}
			//echo "<pre>";print_r($templates);exit;
			//set values to db values
			$data['id']							= $templates->d_email_id;			
			$data['email_type']					= $templates->d_email_title;
			$data['email_template']				= $templates->email_id;			
			$data['middle_content']				= $templates->middle_content;
						
		}
		
		$this->form_validation->set_rules('email_type',  'Template Titile', 'trim|required');		
		$this->form_validation->set_rules('middle_content', 'Middle html', 'trim|required');
		
		//echo "<pre>";print_r($data['middle_content']);exit;
		
		 //echo "<pre>";print_r($_POST);exit;
		// echo validation_errors();exit;
		if ($this->form_validation->run() == FALSE)
		{    
            //echo "<pre>";print_r($_POST);exit;
			
			$this->load->view($this->config->item('admin_folder').'/includes/header');
            $this->load->view($this->config->item('admin_folder').'/includes/leftbar');  
			$this->load->view($this->config->item('admin_folder').'/default_emails_form', $data);
            $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$save['d_email_id']					= $id;
			$save['d_email_title']				= $this->input->post('email_type');	
			$save['email_id']					= $this->input->post('email_template');		
			$save['middle_content']				= addslashes($this->input->post('middle_content'));
			
			
			$id = $this->System_Template_model->save_default_email($save);			
			$this->session->set_flashdata('message', 'Email Saved Successfully!');
			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/default_emails/form/'.$id);
		}
	}
	
	
	
	function delete($id = false)
	{
		if ($id)
		{	
			$template	= $this->System_Template_model->get_templates_by_id($id);
			
			//if the customer does not exist, redirect them to the customer list with an error
			if (!$template)
			{
				
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/default_emails');
			}
			else
			{
				
				//if the customer is legit, delete them
				$delete	= $this->System_Template_model->delete($id);
				
				$this->session->set_flashdata('message', lang('message_deleted'));
				redirect($this->config->item('admin_folder').'/default_emails');
			}
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/default_emails');
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