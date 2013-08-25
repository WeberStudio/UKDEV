<?php
class Secure extends Front_Controller {
	
	var $customer;
	
	function __construct()
	{
		parent::__construct();
		
		force_ssl();
		
		$this->load->model(array('location_model'));
		
		$this->customer = $this->go_cart->customer();
	}
	
	function index()
	{
		//show_404();
		
	}
	//login2 content start
	function process_checkout($ajax = false)
	{
		//find out if they're already logged in, if they are redirect them to the my account page
		$redirect	= $this->Customer_model->is_logged_in(false, false);
		//if they are logged in, we send them back to the my_account by default, if they are not logging in
		if ($redirect)
		{
			redirect('dashboard/my_account/');
		}
		
		$data['page_title']	= 'Login';
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
		$this->load->helper('form');
		$data['redirect']	= $this->session->flashdata('redirect');
		$submitted 		= $this->input->post('submitted');
		if ($submitted)
		{
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			$remember   = $this->input->post('remember');
			$redirect	= $this->input->post('redirect');
			$login		= $this->Customer_model->login($email, $password, $remember);
			if ($login)
			{
				if ($redirect == '')
				{
					//if there is not a redirect link, send them to the my account page
					 
				//echo "<pre>"; print_r($this->go_cart->customer());exit;
    // $customer_details = $this->go_cart->customer();
    // echo $customer_details['firstname'];exit;
					$redirect = '';
				}
				//to login via ajax
				if($ajax)
				{
					die(json_encode(array('result'=>true)));
				}
				else
				{
					redirect($redirect);
				}
				
			}
			else
			{
				//this adds the redirect back to flash data if they provide an incorrect credentials
				
				
				//to login via ajax
				if($ajax)
				{
					die(json_encode(array('result'=>false)));
				}
				else
				{
					$this->session->set_flashdata('redirect', $redirect);
					$this->session->set_flashdata('error', lang('login_failed'));
					
					redirect('secure/process_checkout');
				}
			}
		}
		
		// load other page content 
		//$this->load->model('banner_model');
		$this->load->helper('directory');
	
		//if they want to limit to the top 5 banners and use the enable/disable on dates, add true to the get_banners function
		//$data['banners']	= $this->banner_model->get_banners();
		//$data['ads']		= $this->banner_model->get_banners(true);
		$data['categories']	= $this->Category_model->get_categories_tierd(0);
			
		$this->load->view('process_checkout', $data);
	}
	// login 2 content end
function login($ajax = false)
	{
		$redirect    = $this->Customer_model->is_logged_in(false, false);     
		
		//if they are logged in, we send them back to the my_account by default, if they are not logging in
		$this->load->library('form_validation');
		if ($redirect)
		{
			redirect('dashboard');
		}
		$data['page_title']	= 'Login';
		$this->load->helper('form');
		
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		
		if ($this->form_validation->run() == FALSE)
		{
		$this->load->view('login', $data);
		}
		
		else
		{
		$submitted 		= $this->input->post('submitted');
		if ($submitted)
		{
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			$remember   = $this->input->post('remember');
			$redirect	= $this->input->post('redirect');
			
			$login		= $this->Customer_model->login($email, $password);
			if ($login)
			{
                
              redirect('secure/login');  
            }
            else
				{
					$this->session->set_flashdata('redirect', $redirect);
					$this->session->set_flashdata('error', lang('login_failed'));
					
					redirect('secure/login');
				}
			
		}
		$this->load->view('login', $data);
	}
	} 
	
	function logout()
	{
		$this->Customer_model->logout();
		redirect('secure/login');
	}
	
	function register()
	{
		//$data['seo_title']		= "Register";
		$redirect	= $this->Customer_model->is_logged_in(false, false);
		//if they are logged in, we send them back to the my_account by default
		if ($redirect)
		{
			redirect('dashboard/my_account');
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		
		/*
		we're going to set this up early.
		we can set a redirect on this, if a customer is checking out, they need an account.
		this will allow them to register and then complete their checkout, or it will allow them
		to register at anytime and by default, redirect them to the homepage.
		*/
		$data['redirect']	= $this->session->flashdata('redirect');
		
		$data['page_title']	= lang('account_registration');
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
		//default values are empty if the customer is new

		$data['id']			= '';
		$data['company']	= '';
		$data['firstname']	= '';
		$data['lastname']	= '';
		$data['email']		= '';
		$data['phone']		= '';
		$data['address1']	= '';
		$data['address2']	= '';
		$data['city']		= '';
		$data['state']		= '';
		$data['zip']		= '';
		$data['country_id']	= '';
		$data['zone_id']	= '';
		$password			= '';
		$password 			= $this->input->post('password');

		$this->form_validation->set_rules('company', 'Company', 'trim| required |max_length[128]');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('address1', 'Address', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('zip', 'Post Code', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required|numeric');
		$this->form_validation->set_rules('zone_id', 'State', 'trim|required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_check_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[32]|numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|sha1');
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('email_subscribe', 'Subscribe', 'trim|numeric|max_length[1]');
		
		if ($this->form_validation->run() == FALSE)
		{
			//if they have submitted the form already and it has returned with errors, reset the redirect
			//if ($this->input->post('submitted'))
			//{
				//$data['redirect']	= $this->input->post('redirect');				
			//}
			
			// load other page content 
			//$this->load->model('banner_model');
			$this->load->helper('directory');
		
			$data['categories']	= $this->Category_model->get_categories_tierd(0);
			$data['zones_menu']	= $this->Location_model->get_zones_menu('223');
			$data['countries_menu']	= $this->Location_model->get_countries_menu();
			$data['error'] = validation_errors();
			
			$this->load->view('student_register', $data);
			
		}
		else
		{
			
			
			$save['id']		= false;
			
			$save['firstname']			= $this->input->post('firstname');
			$save['lastname']			= $this->input->post('lastname');
			$save['email']				= $this->input->post('email');
			$save['phone']				= $this->input->post('phone');
			$save['company']			= $this->input->post('company');
			$save['post_code']			= $this->input->post('zip');
			$save['city']				= $this->input->post('city');
			$save['address_street']		= $this->input->post('address1');
			$save['address_line']		= $this->input->post('address2');
			$save['country']		 	= $this->input->post('country_id');
			$save['state']		 	 	= $this->input->post('zone_id');
			$save['gender']				= $this->input->post('gender');
			$save['active']				= $this->config->item('new_customer_status');
			$save['email_subscribe']	= intval((bool)$this->input->post('email_subscribe'));
			
			$save['password']			= $this->input->post('password');
			
			$redirect					= $this->input->post('redirect');
			
			//if we don't have a value for redirect
			if ($redirect == '')
			{
				$redirect = 'cart';
			}
			
			// save the customer info and get their new id
			$id = $this->Customer_model->save($save);

			/* send an email */
			// get the email template
			/*$res = $this->db->where('id', '6')->get('canned_messages');
			$row = $res->row_array();*/
			
			// set replacement values for subject & body
			
			// {customer_name}
			
			
			/*$row['subject'] = str_replace('{customer_name}', $this->input->post('firstname').' '. $this->input->post('lastname'), $row['subject']);
			$row['content'] = str_replace('{customer_name}', $this->input->post('firstname').' '. $this->input->post('lastname'), $row['content']);
			
			// {url}
			$row['subject'] = str_replace('{url}', $this->config->item('base_url'), $row['subject']);
			$row['content'] = str_replace('{url}', $this->config->item('base_url'), $row['content']);
			
			// {site_name}
			$row['subject'] = str_replace('{site_name}', $this->config->item('company_name'), $row['subject']);
			$row['content'] = str_replace('{site_name}', $this->config->item('company_name'), $row['content']);*/
			
			$email_attributes = $this->Settings_model->get_system_email($this->config->item('email_template'));
			
			//print_r($email_attributes);exit;
			$message = '';
			$message .= $email_attributes[0]['email_header'];
			
			
			 $message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"><singleline label="Title"> Dear '.$this->input->post('firstname').' '. $this->input->post('lastname').'!</singleline></p><div align="left" ><multiline label="Description"></multiline>Thank you for registering with UK Open College. This email is to certify that your account has been registered with us. Please save the login information i.e. user name and password as you would require this in future when logging in at the UK OPEN COLLEGE website. <br><br>Username: '.$this->input->post('email').' <br>Password: '.$password.' <br></div></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><div align="left" >Student Support can be accessed via e-mail :  <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.<br><br>Or<br><br>Get in touch via</div></td></tr></tbody></table></td></tr>';
			
			$message .= $email_attributes[0]['email_footer'];
			
			 
			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
	
			$this->email->from($this->config->item('email'), $this->config->item('company_name'));
			//$this->email->from('Uk Open College');
			$this->email->to($save['email']);
			$this->email->bcc($this->config->item('bcc_email'));
			//$this->email->subject($row['subject']);
			$this->email->subject('Student Registration');
			$this->email->message(html_entity_decode($message));
			
			$this->email->send();
			//echo $this->email->print_debugger();exit;
			$this->session->set_flashdata('message', sprintf( lang('registration_thanks'), $this->input->post('firstname') ) );
			
			//lets automatically log them in
			$this->Customer_model->login($save['email'], $this->input->post('confirm'));
			
			//we're just going to make this secure regardless, because we don't know if they are
			//wanting to redirect to an insecure location, if it needs to be secured then we can use the secure redirect in the controller
			//to redirect them, if there is no redirect, the it should redirect to the homepage.
			redirect($redirect);
		}
	}
	
	function check_email($str)
	{
		if(!empty($this->customer['id']))
		{
			$email = $this->Customer_model->check_email($str, $this->customer['id']);
		}
		else
		{
			$email = $this->Customer_model->check_email($str);
		}
		
        if ($email)
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
		$data['page_title']	= lang('forgot_password');
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		$submitted = $this->input->post('submitted');
		if ($submitted)
		{
			$this->load->helper('string');
			$email = $this->input->post('email');			
			$reset = $this->Customer_model->reset_password($email);
			
			if ($reset)			
			{						
				$this->session->set_flashdata('message', lang('message_new_password'));
				$email_attributes = $this->Settings_model->get_system_email($this->config->item('email_template'));
				$message  = '';
				$message .= $email_attributes[0]['email_header'];				
				$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><b>Password has been generated successfully!</b><br>In order to set a new password, you need to provide your user name by clicking on the following link to rest your password. We will send you a new user name and password. please  get in touch via e-mail: <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.</td></tr><tr><td ><div align="left" class="article-content"><b>New Password:</b>'.$reset.'</div> <br/>Or<br/><br/>Call us<br/></td></tr></tbody></table></td></tr>';
				
				$message .= $email_attributes[0]['email_footer'];
				
				//echo $message;exit;
							
				$this->load->library('email');				
				$config['mailtype'] = 'html';				
				$this->email->initialize($config);		
				//$this->email->from($this->config->item('email'), $this->config->item('company_name'));
				$this->email->from('UkOpenCollege');
				$this->email->to($this->config->item('email'));
				//$this->email->bcc($this->config->item('bcc_email'));
				$this->email->bcc('khalil.junaid@gmail.com');
				//$this->email->subject($row['subject']);
				$this->email->subject('Student Forgot Password');
				$this->email->message(html_entity_decode($message));				
				$this->email->send();
				//echo $this->email->print_debugger();exit;
			}
			else
			{
				$this->session->set_flashdata('error', lang('error_no_account_record'));
			}
			
			
			redirect('secure/forgot_password');
		}
		
		// load other page content 
		//$this->load->model('banner_model');
		$this->load->helper('directory');
	
		//if they want to limit to the top 5 banners and use the enable/disable on dates, add true to the get_banners function
		//$data['banners']	= $this->banner_model->get_banners();
		//$data['ads']		= $this->banner_model->get_banners(true);
		$data['categories']	= $this->Category_model->get_categories_tierd();
		
		
		$this->load->view('forgot_password', $data);
	}
	
	
	function my_downloads($code=false)
	{
		
		if($code!==false)
		{
			$data['downloads'] = $this->Digital_Product_model->get_downloads_by_code($code);
		} else {
			$this->Customer_model->is_logged_in();
			
			$customer = $this->go_cart->customer();
			
			$data['downloads'] = $this->Digital_Product_model->get_user_downloads($customer['id']);
		}
		
		$data['gift_cards_enabled']	= $this->gift_cards_enabled;
		
		$data['page_title'] = lang('my_downloads');
		
		$this->load->view('my_downloads', $data);
	}
	
	
	function download($link)
	{
		$filedata = $this->Digital_Product_model->get_file_info_by_link($link);
		
		// missing file (bad link)
		if(!$filedata)
		{
			show_404();
		}
		
		// validate download counter
		if(intval($filedata->downloads) >= intval($filedata->max_downloads))
		{
			show_404();
		}
		
		// increment downloads counter
		$this->Digital_Product_model->touch_download($link);
		
		// Deliver file
		$this->load->helper('download');
		force_download('uploads/digital_uploads/', $filedata->filename);
	}
	
	
	function set_default_address()
	{
		$id = $this->input->post('id');
		$type = $this->input->post('type');
	
		$customer = $this->go_cart->customer();
		$save['id'] = $customer['id'];
		
		if($type=='bill')
		{
			$save['default_billing_address'] = $id;

			$customer['bill_address'] = $this->Customer_model->get_address($id);
			$customer['default_billing_address'] = $id;
		} else {

			$save['default_shipping_address'] = $id;

			$customer['ship_address'] = $this->Customer_model->get_address($id);
			$customer['default_shipping_address'] = $id;
		} 
		
		//update customer db record
		$this->Customer_model->save($save);
		
		//update customer session info
		$this->go_cart->save_customer($customer);
		
		echo "1";
	}
	
	
	// this is a form partial for the checkout page
	function checkout_address_manager()
	{
		$customer = $this->go_cart->customer();
		
		$data['customer_addresses'] = $this->Customer_model->get_address_list($customer['id']);
	
		$this->load->view('address_manager', $data);
	}
	
	// this is a partial partial, to refresh the address manager
	function address_manager_list_contents()
	{
		$customer = $this->go_cart->customer();
		
		$data['customer_addresses'] = $this->Customer_model->get_address_list($customer['id']);
	
		$this->load->view('address_manager_list_content', $data);
	}
	
	function address_form($id = 0)
	{
		
		$customer = $this->go_cart->customer();
		
		//grab the address if it's available
		$data['id']			= false;
		$data['company']	= $customer['company'];
		$data['firstname']	= $customer['firstname'];
		$data['lastname']	= $customer['lastname'];
		$data['email']		= $customer['email'];
		$data['phone']		= $customer['phone'];
		$data['address1']	= '';
		$data['address2']	= '';
		$data['city']		= '';
		$data['country_id'] = '';
		$data['zone_id']	= '';
		$data['zip']		= '';
		

		if($id != 0)
		{
			$a	= $this->Customer_model->get_address($id);
			if($a['customer_id'] == $this->customer['id'])
			{
				//notice that this is replacing all of the data array
				//if anything beyond this form data needs to be added to
				//the data array, do so after this portion of code
				$data		= $a['field_data'];
				$data['id']	= $id;
			} else {
				redirect('/'); // don't allow cross-customer editing
			}
			
			$data['zones_menu']	= $this->location_model->get_zones_menu($data['country_id']);
		}
		
		//get the countries list for the dropdown
		$data['countries_menu']	= $this->location_model->get_countries_menu();
		
		if($id==0)
		{
			//if there is no set ID, the get the zones of the first country in the countries menu
			$data['zones_menu']	= $this->location_model->get_zones_menu(array_shift(array_keys($data['countries_menu'])));
		} else {
			$data['zones_menu']	= $this->location_model->get_zones_menu($data['country_id']);
		}

		$this->load->library('form_validation');	
		$this->form_validation->set_rules('company', 'Company', 'trim|max_length[128]');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('address1', 'Address', 'trim|required|max_length[128]');
		$this->form_validation->set_rules('address2', 'Address', 'trim|max_length[128]');
		$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required|numeric');
		$this->form_validation->set_rules('zone_id', 'State', 'trim|required|numeric');
		$this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[32]');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			if(validation_errors() != '')
			{
				echo validation_errors();
			}
			else
			{
				$this->load->view('address_form', $data);
			}
		}
		else
		{
			$a = array();
			$a['id']						= ($id==0) ? '' : $id;
			$a['customer_id']				= $this->customer['id'];
			$a['field_data']['company']		= $this->input->post('company');
			$a['field_data']['firstname']	= $this->input->post('firstname');
			$a['field_data']['lastname']	= $this->input->post('lastname');
			$a['field_data']['email']		= $this->input->post('email');
			$a['field_data']['phone']		= $this->input->post('phone');
			$a['field_data']['address1']	= $this->input->post('address1');
			$a['field_data']['address2']	= $this->input->post('address2');
			$a['field_data']['city']		= $this->input->post('city');
			$a['field_data']['zip']			= $this->input->post('zip');
			
			// get zone / country data using the zone id submitted as state
			$country = $this->location_model->get_country(set_value('country_id'));	
			$zone    = $this->location_model->get_zone(set_value('zone_id'));		
			if(!empty($country))
			{
				$a['field_data']['zone']		= $zone->code;  // save the state for output formatted addresses
				$a['field_data']['country']		= $country->name; // some shipping libraries require country name
				$a['field_data']['country_code']   = $country->iso_code_2; // some shipping libraries require the code 
				$a['field_data']['country_id']  = $this->input->post('country_id');
				$a['field_data']['zone_id']		= $this->input->post('zone_id');  
			}
			
			$this->Customer_model->save_address($a);
			$this->session->set_flashdata('message', lang('message_address_saved'));
			//echo 1;
		}
	}
	
	function delete_address()
	{
		$id = $this->input->post('id');
		// use the customer id with the addr id to prevent a random number from being sent in and deleting an address
		$customer = $this->go_cart->customer();
		$this->Customer_model->delete_address($id, $customer['id']);
		echo $id;
	}
}