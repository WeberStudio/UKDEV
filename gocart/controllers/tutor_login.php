<?php 
class Tutor_login extends Front_Controller {
	
	var $customer;
	
	function __construct()
	{
		parent::__construct();
		
		force_ssl();
		
		$this->load->model(array('location_model'));
		$this->load->model('tutor_model');
		$this->load->model('Category_model');
		$this->load->model('Product_model');
		//$this->customer = $this->go_cart->customer();
		$this->load->helper('formatting_helper');
		$this->load->helper('form');
		$this->lang->load('tutor');
	}
	
	
	function index()
	{
		if($this->Tutor_model->is_logged_in(false, false)):
		redirect('dashboard/');
		
		else:
		redirect('tutor_login/login');
		endif;
	}
	function logout()
	{
		$this->Tutor_model->logout();
		redirect('tutor_login');
	}
	
	function login()
	{
        if($this->Tutor_model->is_logged_in(false, false)){
        redirect('dashboard');
        }
		 
		//$data['seo_title']		= "Tutor Login";
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		if ($this->form_validation->run() == FALSE)
		{
            
		$this->load->view('tutor_login');
		}
		else{
		     
		//$submitted 		= $this->input->post('submitted');
		//if ($submitted)
		//{
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			//$remember   = $this->input->post('remember');
			//$redirect	= $this->input->post('redirect');
			//$review 	= $this->input->post('review_login');
			$login		= $this->tutor_model->login($email, $password);
                
			//echo print_r($login); exit;
			if ($login)
			{
                
				//if($review)
				//{
					//$open = array('open'=>'1');
					//$this->session->set_userdata($open);
					
					//redirect($this->input->post('slug'));
				//}
				redirect('dashboard');	
			}
			else
			{
				$this->session->set_flashdata('error', lang('login_failed'));
				redirect('tutor_login/login');
			}
			//$this->session->set_flashdata('error', 'You Are Not Registered');
		//}
		//$this->session->set_flashdata('error', 'You Are Not Registered');
		}
	}
	
	
	
	function register($id = false)
	{
		//$data['seo_title']		= "Register";
		$data['id']			            = '';
		$data['company']	            = '';
		$data['firstname']	            = '';
		$data['lastname']	            = '';
		$data['email']		            = '';
		$data['phone']		            = '';
		$data['street_address']	        = '';
		$data['address_line_op']	    = '';
		$data['city']		            = '';
		$data['state']		            = '';
		$data['zip_code']		        = '';
		$data['country_id']	            = '';
		$data['zone_id']	            = '';
		$password			            = '';
		$password 			            = $this->input->post('password');
		
		$data['categories']			    = array();
		$data['courses']			    = array();	
		$data['all_categories']		    = $this->Category_model->get_categories_dropdown();
		$data['all_courses']		    = $this->Product_model->get_all_products_array();
		$data['countries_menu']		    = $this->Location_model->get_countries_menu();
		$data['zones_menu']			    = $this->Location_model->get_zones_menu('223');
		$data['country_id']			    = "";
		$data['zone_id']			    = "";
		//print_r($this->Product_model->get_all_products_array());exit;
		$config['upload_path']		    = 'uploads/images/full';
		$config['allowed_types']	    = 'gif|jpg|png';
		$config['max_size']			    = $this->config->item('size_limit');
		$config['max_width']		    = '1024';
		$config['max_height']		    = '768';
		//$config['file_name'] 		= "thumb_";
		$config['overwrite']		    = true;
		$config['remove_spaces']	    = true;
		$config['encrypt_name']		    = true;
		$this->load->library('upload', $config);
        
         
        
		
			
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('firstname', 'lang:firstname', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'lang:lastname', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('company', 'Company', 'trim');
		$this->form_validation->set_rules('street_address', 'Address', 'trim|required');
        $this->form_validation->set_rules('address_line_op', 'Address', 'trim');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('zip_code', 'zip_code', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[32]|numeric');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]|callback_check_email');
		if($id == "")
		{
		$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
		$this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
		$this->form_validation->set_rules('comment', 'lang:comments', 'trim|max_length[128]');
		}
		
		if ($this->form_validation->run() == FALSE)
		{    
            //echo "<pre>"; print_r($data['invoices']);exit;
			if($id!="")
			{
				redirect('dashboard/my_profile');
			}
			$this->load->view('tutor_register', $data);
			
		}
		else{
			if($id!=""){
			$uploaded	= $this->upload->do_upload('image');
			if($uploaded != "")
			{
			if($uploaded == "")
			{
				$error	= $this->upload->display_errors();
				echo $error;
				
			}
			if($uploaded != "")
			{
				$image			= $this->upload->data();
				$save['avatar']	= $image['file_name'];
			}
			}
			}
			//echo $this->input->post('about'); exit; 
			if($this->input->post('about')!="")
			{
			$save['about']				= $this->input->post('about');
			}
			$save['tutor_id']			= $id;
			$save['firstname']			= $this->input->post('firstname');
			$save['lastname']			= $this->input->post('lastname');
			$save['email']				= $this->input->post('email');
			$save['phone']				= $this->input->post('phone');
			$save['status']				= 1;
			$save['street_address']		= $this->input->post('street_address');
			$save['address_line_op']	= $this->input->post('address_line_op');
			$save['city']				= $this->input->post('city');
			$save['state']				= $this->input->post('state');
			$save['zip_code']			= $this->input->post('zip_code');
			$save['country']			= $this->input->post('country');
			
			if($id == "")
			{
			$save['short_description']	= $this->input->post('description');
			$save['comments']			= $this->input->post('comment');
			$save['email_subscribe'] 	= $this->input->post('email_subscribe');
			$save['password']			= $this->input->post('password');
			
			if($this->input->post('courses'))
			{
				$save['courses'] = json_encode($this->input->post('courses'));
			}
			else
			{
				$save['courses'] = '';
			}
			
			//save categories
			
			if($this->input->post('categories'))
			{
				$save['categories'] = json_encode($this->input->post('categories'));
			}
			else
			{
				$save['categories'] = '';
			}
			}
			 $save_tutor = $this->tutor_model->save($save);
             if($id==""){
			 if($save_tutor!="")
			 {
				 
				 	$email_attributes = $this->Settings_model->get_system_email($this->config->item('email_template'));
					$message = '';
					$message .= $email_attributes[0]['email_header'];
					
					$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"><singleline label="Title"> Dear '.$this->input->post('firstname').' '. $this->input->post('lastname').'!</singleline></p><div align="left" ><multiline label="Description"></multiline>Thank you for registering with UK Open College. This email is to certify that your account has been registered with us. Please save the login information.<br><br>Username: '.$this->input->post('email').' <br>Password: '.$password.' <br><br>as you would require that for future coordination.</div></td></tr><tr><td ><div align="left" >Tutor Support can be accessed via e-mail: <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';
					
					$message .= $email_attributes[0]['email_footer'];
					
					 
					$this->load->library('email');
					
					$config['mailtype'] = 'html';
					
					$this->email->initialize($config);
			
					$this->email->from($this->config->item('email'), $this->config->item('company_name'));
					//$this->email->from('info@ukopencollege.co.uk');
					$this->email->to($save['email']);
					$this->email->bcc($this->config->item('bcc_email'));
					//$this->email->subject($row['subject']);
					$this->email->subject('Tutor Registration');
					$this->email->message(html_entity_decode($message));
					
					$this->email->send();
					
				 redirect('dashboard');
				 //echo "found it"; exit;
				// redirect('tutor_login/login');
			 }
             }
			 redirect('tutor_login');
			
		}
		
	}
	
	function forgot_password()
	{
		$data['page_title']	= lang('forgot_password');		
		$submitted = $this->input->post('submitted');
		if ($submitted)
		{
			$this->load->helper('string');
			$email = $this->input->post('email');
			
			$reset = $this->Tutor_model->reset_password($email);
			
			if ($reset)
			{						
				$this->session->set_flashdata('message', lang('message_new_password'));
				$email_attributes = $this->Settings_model->get_system_email($this->config->item('email_template'));
			
				//print_r($email_attributes);exit;
				$message  = '';
				$message .= $email_attributes[0]['email_header'];			
				
				$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><b>Password has been generated successfully!</b><br>In order to set a new password, you need to provide your user name by clicking on the following link to rest your password. We will send you a new user name and password. If you have difficulty in resetting your password, Tutor Support can be accessed via e-mail: <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.</td></tr><tr><td ><div align="left" class="article-content"><b>New Password:</b>'.$reset.'</div></td></tr></tbody></table></td></tr>';
				
				$message .= $email_attributes[0]['email_footer'];
				$this->load->library('email');				
				$config['mailtype'] = 'html';				
				$this->email->initialize($config);		
				$this->email->from($this->config->item('email'), $this->config->item('company_name'));
				//$this->email->from('Uk Open College');
				$this->email->to($this->config->item('email'));
				$this->email->bcc($this->config->item('bcc_email'));
				//$this->email->subject($row['subject']);
				$this->email->subject('Tutor Forgot Password');
				$this->email->message(html_entity_decode($message));
				
				$this->email->send();
			}
			else
			{
				$this->session->set_flashdata('error', lang('error_no_account_record'));
			}
			
			
			redirect('tutor_login');
		}
		
		
		$this->load->helper('directory');	
		$data['categories']	= $this->Category_model->get_categories_tierd();
		$data['tutor_view'] = 'tutor_view';	
		$this->load->view('forgot_password', $data);
	}
	
	
	

}
?>