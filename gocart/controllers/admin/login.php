<?php

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		force_ssl();
		
		$this->load->library('Auth');
		$this->lang->load('login');
	}

	function index()
	{
		//we check if they are logged in, generally this would be done in the constructor, but we want to allow customers to log out still
		//or still be able to either retrieve their password or anything else this controller may be extended to do
		//$this->show->pe($_REQUEST);
		$redirect	= $this->auth->is_logged_in(false, false);
		//if they are logged in, we send them back to the dashboard by default, if they are not logging in
		if ($redirect)
		{
			redirect($this->config->item('admin_folder').'/dashboard');
		}
		
		
		$this->load->helper('form');
		$data['redirect']	= $this->session->flashdata('redirect');
		$submitted 			= $this->input->post('submitted');
		if ($submitted)
		{
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			$remember   = $this->input->post('remember');
			$redirect	= $this->input->post('redirect');
			$login		= $this->auth->login_admin($email, $password, $remember);
			if ($login)
			{
				if ($redirect == '')
				{
					$redirect = $this->config->item('admin_folder').'/dashboard';
				}
				redirect($redirect);
			}
			else
			{
				//this adds the redirect back to flash data if they provide an incorrect credentials
				
				$this->session->set_flashdata('redirect', $redirect);
				$this->session->set_flashdata('error', lang('error_authentication_failed'));
				redirect($this->config->item('admin_folder').'/login');
			}
		}
		$this->load->view($this->config->item('admin_folder').'/includes/header');
		$this->load->view($this->config->item('admin_folder').'/login', $data);
		$this->load->view($this->config->item('admin_folder').'/includes/footer');
	}
	
	function logout()
	{
		$this->auth->logout();
		
		//when someone logs out, automatically redirect them to the login page.
		$this->session->set_flashdata('message', lang('message_logged_out'));
		redirect($this->config->item('admin_folder').'/login');
	}
	
	function admin_signup()
	{
		
		force_ssl();
		//$this->show->pe($_POST);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['page_title']		= lang('admin_form');
		
		//default values are empty if the customer is new
		$data['company']	= '';
		$data['firstname']	= '';
		$data['lastname']	= '';
		$data['email']		= '';
		$data['access']		= '';	
		$data['phone']		= '';
		$data['password']	= '';
		$data['confirm']	= '';
		$data['url']		= '';
		$password			= '';
		$password 			= $this->input->post('password');
		
		$this->form_validation->set_rules('company', 'Company', 'trim|max_length[128]');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_check_email');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|sha1');
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('email_subscribe', 'Subscribe', 'trim|numeric|max_length[1]');
		
		
		//if this is a new account require a password, or if they have entered either a password or a password confirmation
		if ($this->input->post('password') != '' || $this->input->post('confirm') != '')
		{
			$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
			$this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
		}
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/admin_signup', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/footer');
			
		}
		else
		{
			
			$save['firstname']	= $this->input->post('firstname');
			$save['lastname']	= $this->input->post('lastname');
			$save['email']		= $this->input->post('email');
			$save['access']		= 'Course Provider';
			$save['phone']		= $this->input->post('phone');
			$save['company']	= $this->input->post('company');
			$save['password']	= $this->input->post('password');
			$save['status']		= '1';
			
			
			
			if ($this->input->post('password') != '')
			{
				$save['password']	= $this->input->post('password');
			}
			
			$insert_id = $this->auth->save($save);
			if(!empty($insert_id))
			{
					$admin_data = $this->auth->get_admin($insert_id);			
					$email_attributes = $this->Settings_model->get_system_email($this->config->item('email_template'));
					$message = '';
					$message .= $email_attributes[0]['email_header'];
					$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"> <singleline label="Title"> Dear '.$admin_data->firstname.' '.$admin_data->lastname.'!</singleline></p><div align="left" ><multiline label="Description"></multiline>Thank you for registering with UK Open College. This email is to certify that your account has been registered with us. Please save the login information.<br><br>Username: '.$admin_data->email.' <br>Password: '.$password.' <br><br>as you would require that for future coordination.</div></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><div align="left" >Student Support can be accessed via e-mail:  <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';
					
					$message .= $email_attributes[0]['email_footer'];					 
					$this->load->library('email');					
					$config['mailtype'] = 'html';					
					$this->email->initialize($config);			
					$this->email->from($this->config->item('email'), $this->config->item('company_name'));
					//$this->email->from('info@ukopencollege.co.uk');
					$this->email->to($admin_data->email);
					$this->email->bcc($this->config->item('bcc_email'));
					//$this->email->subject($row['subject']);
					$this->email->subject('Admin Registration');
					$this->email->message(html_entity_decode($message));					
					$this->email->send();
			}
			
			$this->session->set_flashdata('message', 'You have Signup Successfully.');
			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/login');
		}
	
	
	
	}
	
	function check_email($email)
	{
	
		$email_result = $this->auth->check_email($email);
		if ($email_result)
       	{
			$this->form_validation->set_message('check_email', lang('error_email'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function forgot_password()
	{
		//$this->show->pe($_POST);
		$this->load->helper('form');
		$data['page_title']	= lang('forgot_password');
		$submitted = $this->input->post('submitted');
		$email = $this->input->post('email');
		$data = array();
		if (isset($submitted) && !empty($email))
		{
			$reset = $this->auth->reset_password($email);
			if (isset($reset))
			{						
				$email_attributes = $this->Settings_model->get_system_email('login');				
				$message  = '';
				$message .= $email_attributes[0]['email_header'];		
				
				$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><b>Password has been generated successfully!</b><br>If you have difficulty in using your password,<br/>Student Support can be accessed via e-mail: <a href="mailto:support@ukopencollege.co.uk
"> support@ukopencollege.co.uk</a>.</td>
</tr><tr><td ><div align="left" class="article-content"><b>New Password:</b>'.$reset.'</div></td></tr></tbody></table></td></tr>';
				
				$message .= $email_attributes[0]['email_footer'];
				$this->load->library('email');				
				$config['mailtype'] = 'html';				
				$this->email->initialize($config);		
				$this->email->from($this->config->item('email'), $this->config->item('company_name'));				
				$this->email->to($this->config->item('email'));
				$this->email->bcc($this->config->item('bcc_email'));				
				$this->email->subject('Admin Forgot Password');
				$this->email->message(html_entity_decode($message));				
				$this->email->send();
								
				$this->session->set_flashdata('message', lang('message_new_password'));
				redirect($this->config->item('admin_folder').'/login');
			}
			else
			{
				$this->session->set_flashdata('error', lang('error_no_account_record'));
				$this->load->view($this->config->item('admin_folder').'/includes/header');
				$this->load->view($this->config->item('admin_folder').'/forgot_password',$data);
				$this->load->view($this->config->item('admin_folder').'/includes/footer');
			}
			
		}
		else
		{
			if (isset($submitted) && !empty($submitted))
			{
				$this->session->set_flashdata('error', lang('error_no_account_record'));
			}
			
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/forgot_password',$data);
			$this->load->view($this->config->item('admin_folder').'/includes/footer');
			
			
		}
	}
	
}