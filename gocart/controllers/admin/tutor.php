<?php
class tutor extends Admin_Controller {    

    function __construct()
    {        
        parent::__construct();

        remove_ssl();
		
        /*** Get User Info***/
       //$admin_info = $this->admin_session->userdata('admin'); 
		$this->auth->check_access('Superadmin', true);
        $user_info = $this->auth->admin_info();
        $this->admin_id = $user_info['id'];
        $this->admin_email = $user_info['email'];
        $this->admin_access = $user_info['access'];
		$this->first_name = $user_info['firstname'];
		$this->last_name = $user_info['lastname'];
		$this->image = $user_info['image'];		
		$this->load->helper('formatting_helper');		
        /*** Get User Info***/
		
		/*** Left Menu Selection ***/
		$this->session->set_userdata('active_module', 'sales');
		/*** Left Menu Selection ***/
		
		$this->auth->check_access($this->admin_access, true);  
        
		if($this->admin_access=='Admin')
		{
			redirect($this->config->item('admin_folder'));
		}
		
		$this->load->model('Tutor_model');
		$this->load->model('Category_model');
		$this->load->model('Product_model');
		$this->load->model('Routes_model');
		$this->load->model('Forum_model');
		$this->load->model('location_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->lang->load('tutor');
		
    }
	

    function index($field='lastname', $by='ASC', $page=0, $row=5)
    {
       	
        $data                       = array();
        $csv                        = '';
        
        $term                       = false;
        $post                       = $this->input->post(null, false);
        $this->load->model('Search_model');
        if($post)
        {
            $term                   = json_encode($post);
            $code                   = $this->Search_model->record_term($term);
            $data['code']           = $code;
        }
        $data['csv_call']           = $this->input->post('csv_call');
        if(!empty($data['csv_call']))
        {
            $csv                    = '1';
        }
        
		$data['tutors']	            = $this->Tutor_model->get_tutors($row, $page, $field, $by , $term , $csv);
		//echo $this->db->last_query();exit;
		$this->load->library('pagination');
		//echo $this->db->last_query(); exit;
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/tutor/index/'.$field.'/'.$by.'/';
		$config['total_rows']		= $this->Tutor_model->count_tutors();
		$config['per_page']			= $row;
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
		
		$data['page']	            = $page;
		$data['field']	            = $field;
		$data['by']		            = $by;
		
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/tutor/tutor_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');

    }
	
	function form($id = false)
	{
		
		//$this->show->pe($_POST);
		
		/*** Start Image Upload Config******/		
		$config['upload_path']		= 'uploads/images/full';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['maintain_ratio'] 	= TRUE;
		$config['width'] 			= 150;
		$config['height'] 			= 150;
		//$config['file_name'] 		= "thumb_".$this->admin_id;
		//$config['overwrite']		= true;
		$config['remove_spaces']	= true;
		$config['encrypt_name']		= true;		
		$this->load->library('upload', $config);		
		/*** End Image Upload Config******/
				
		$data['zones_menu']	= $this->Location_model->get_zones_menu('223');
		$data['countries_menu']	= $this->Location_model->get_countries_menu();
		//default values are empty if the customer is new
		$data['id']					= '';
		$data['group_id']			= '';
		$data['firstname']			= '';
		$data['lastname']			= '';
		
		$data['street_address']		= '';
		$data['address_line_op']	= '';
		$data['city']				= '';
		$data['state']				= '';
		$data['zip_code']			= '';
		$data['country']			= '';
		$data['telephone']			= '';
		
		$data['email']				= '';
		$data['phone']				= '';		
		$data['description']		= '';
		$data['comments']			= '';		
		$data['email_subscribe']	= '';
		$data['sel_categories']		= '';		
		$data['sel_courses']		= '';
		$data['avatar']				= '';		
		$data['active']				= false;
		$data['categories']			= array();
		$data['courses']			= array();	
		$data['all_categories']		= $this->Category_model->get_categories_dropdown();
		$data['all_courses']		= $this->Product_model->get_all_products_array();
			
		$data['all_degree']			= array();
		$data['all_desig']			= array();
		$data['all_achiev']			= array();
		
		$data['degree_title']		= array();
		$data['degree_start']		= array();
		$data['degree_end']			= array();
		$data['degree_description']	= array();
		
		$data['desig_title']		= array();
		$data['desig_start']		= array();
		$data['desig_end']			= array();
		$data['desig_description']	= array();
		
		$data['achiev_title']		= array();
		$data['achiev_start']		= array();		
		$data['achiev_description']	= array();
		
		$data['extra_info']			= '';		
		$password					= '';
		$password 					= $this->input->post('password');	
		//$this->show->pe($data['courses']);
		
		if ($id)
		{	
			
			$tutor					= $this->Tutor_model->get_tutor($id);
			
			//if the tutor does not exist, redirect them to the customer list with an error
			if (!$tutor)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/tutor');
			}
			
			$data['all_degree']			= $this->Tutor_model->get_tutor_attributes('oc_tutor_qualification', $id);
			$data['all_desig']			= $this->Tutor_model->get_tutor_attributes('oc_tutor_designation', $id);
			$data['all_achiev']			= $this->Tutor_model->get_tutor_attributes('oc_tutor_achievement', $id);
			
			
			//set values to db values
			$data['id']					= $tutor->tutor_id;			
			$data['firstname']			= $tutor->firstname;
			$data['lastname']			= $tutor->lastname;
			$data['email']				= $tutor->email;
			$data['phone']				= $tutor->phone;
			$data['city']				= $tutor->city;
			$data['zip_code']			= $tutor->zip_code;
			$data['telephone']			= $tutor->telephone;
			$data['address_line_op']	= $tutor->address_line_op;
			$data['street_address']		= $tutor->street_address;
			$data['description']		= $tutor->short_description;
			$data['comments']			= $tutor->comments;
			$data['active']				= $tutor->status;
			$data['email_subscribe']	= $tutor->email_subscribe;	
			$data['avatar']				= $tutor->avatar;	
			$data['extra_info']			= $tutor->extra_info;
			$data['country']			= $tutor->country;
			$data['state']				= $tutor->state;
			if(!$this->input->post('submit'))
			{
				$data['categories']		= $tutor->categories;
				$data['courses']		= $tutor->courses;				
			}
		}
		
		
		
		$this->form_validation->set_rules('firstname', 'lang:firstname', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'lang:lastname', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]|callback_check_email');
		$this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('comments', 'lang:comments', 'trim|max_length[128]');
		$this->form_validation->set_rules('active', 'lang:active');
		//$this->form_validation->set_rules('group_id', 'group_id', 'numeric');
		$this->form_validation->set_rules('email_subscribe', 'email_subscribe', 'numeric|max_length[1]');
		
		//if this is a new account require a password, or if they have entered either a password or a password confirmation
		if ($this->input->post('password') != '' || $this->input->post('confirm') != '' || !$id)
		{
			$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
			$this->form_validation->set_rules('confirm', 'lang:confirm_password', 'required|matches[password]');
		}
		
				
		if ($this->form_validation->run() == FALSE)
		{    
            //echo "<pre>"; print_r($data['invoices']);exit;
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/tutor/tutor_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$uploaded	= $this->upload->do_upload('avatar');
			if($uploaded)
			{
				$image					= $this->upload->data();
				
				$save['avatar']			= $image['file_name'];
			}
			else			
			{
				
				 $data['error'] = $this->upload->display_errors();
					
			}
			
			$save['tutor_id']			= $id;			
			$save['firstname']			= $this->input->post('firstname');
			$save['lastname']			= $this->input->post('lastname');
			$save['email']				= $this->input->post('email');
			$save['phone']				= $this->input->post('phone');
			$save['short_description']	= $this->input->post('description');
			$save['comments']			= $this->input->post('comments');
			$save['status']				= $this->input->post('active');
			$save['email_subscribe'] 	= $this->input->post('email_subscribe');
			$save['street_address']		= $this->input->post('street_address');
			$save['address_line_op']	= $this->input->post('address_line_op');
			$save['city']				= $this->input->post('city');
			$save['state']				= $this->input->post('state');
			$save['zip_code']			= $this->input->post('zip_code');
			$save['country']			= $this->input->post('country');
			$save['telephone']			= $this->input->post('telephone');
			
			if ($this->input->post('password') != '' || !$id)
			{
				$save['password']	= $this->input->post('password');
				$this->load->library('email');
				$to		  = $save['email'];
				$message  = 'Welcome! '.$save['firstname'].' '.$save['lastname']."\n\n";
				$message .= 'E-mail: '.$save['email']."\n";
				$message .= 'Password: '.$password."\n\n";
				$message .= 'Thanks For Joining Ukopencollege.';			
				$this->email->from('support@ukopencollege.com', 'Ukopencollege');
				$this->email->to($to);
				$this->email->subject('Successfully Signup!');
				$this->email->message($message);
				$this->email->send();
			}
			
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
			
			$save['extra_info'] 	= $this->input->post('extra_info');
			
			$tutor_id = $this->Tutor_model->save($save);
			
			
			// Add Tutor Qualification (Degree) Information
			
			$count_degree 				= count($this->input->post('degree_title'));
			if(!empty($count_degree) && $count_degree>0)
			{
				$this->Tutor_model->delete_tutor_attributes('oc_tutor_qualification', $tutor_id);
				$data['degree_title']		= $this->input->post('degree_title');
				$data['degree_start']		= $this->input->post('degree_start');
				$data['degree_end']			= $this->input->post('degree_end');
				$data['degree_description']	= $this->input->post('degree_description');
				for($i = 0; $i< $count_degree; $i++)
				{
						
					$degree['tutor_id']				= $tutor_id;		
					$degree['degree_title'] 		= (empty($data['degree_title'][$i]) ? '' : $data['degree_title'][$i]);
					$degree['degree_start']			= (empty($data['degree_start'][$i]) ? '' : $data['degree_start'][$i]);
					$degree['degree_end']			= (empty($data['degree_end'][$i]) ? '' : $data['degree_end'][$i]);
					$degree['degree_description']	= (empty($data['degree_description'][$i]) ? '' : $data['degree_description'][$i]);				
					$this->Tutor_model->save_tutor_attributes('oc_tutor_qualification', $degree);
				}
			}
			// End Tutor Qualification (Degree) Information
			
			
			// Add Tutor Experience Information	
			$count_desig 				= count($this->input->post('desig_title'));
			if(!empty($count_desig) && $count_desig>0)
			{					
				$this->Tutor_model->delete_tutor_attributes('oc_tutor_designation', $tutor_id);
				$data['desig_title']		= $this->input->post('desig_title');
				$data['desig_start']		= $this->input->post('desig_start');
				$data['desig_end']			= $this->input->post('desig_end');
				$data['desig_description']	= $this->input->post('desig_description');
				for($i = 0; $i< $count_desig; $i++)
				{						
					$exp['tutor_id']				= $tutor_id;	
					$exp['desig_title'] 			= (empty($data['desig_title'][$i]) ? '' : $data['desig_title'][$i]);
					$exp['desig_start']				= (empty($data['desig_start'][$i]) ? '' : $data['desig_start'][$i]);
					$exp['desig_end']				= (empty($data['desig_end'][$i]) ? '' : $data['desig_end'][$i]);
					$exp['desig_description']		= (empty($data['desig_description'][$i]) ? '' : $data['desig_description'][$i]);				
					$this->Tutor_model->save_tutor_attributes('oc_tutor_designation', $exp);
				}
			}
			// End Tutor Experience Information
			
			
			// Add Tutor Achievement  Information			
			$count_achiev 				= count($this->input->post('achiev_title'));
			if(!empty($count_achiev) && $count_achiev>0)
			{
				$this->Tutor_model->delete_tutor_attributes('oc_tutor_achievement', $tutor_id);
				$data['achiev_title']		= $this->input->post('achiev_title');
				$data['achiev_start']		= $this->input->post('achiev_start');			
				$data['achiev_description']	= $this->input->post('achiev_description');
				for($i = 0; $i< $count_achiev; $i++)
				{
					$ach['tutor_id']				= $tutor_id;	
					$ach['achiev_title'] 			= (empty($data['achiev_title'][$i]) ? '' : $data['achiev_title'][$i]);
					$ach['achiev_start']			= (empty($data['achiev_start'][$i]) ? '' : $data['achiev_start'][$i]);				
					$ach['achiev_description']		= (empty($data['achiev_description'][$i]) ? '' : $data['achiev_description'][$i]);				
					$this->Tutor_model->save_tutor_attributes('oc_tutor_achievement', $ach);
				}
			}
			// End Tutor Achievement  Information
			
			
			$this->session->set_flashdata('message', lang('message_saved_customer'));
			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/tutor');
		}	
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$tutor	= $this->Tutor_model->get_tutor($id);
			//if the tutor does not exist, redirect them to the customer list with an error
			if (!$tutor)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/tutor');
			}
			else
			{
				//if the customer is legit, delete them
				$delete	= $this->Tutor_model->delete($id);
				
				$this->session->set_flashdata('message', lang('message_customer_deleted'));
				redirect($this->config->item('admin_folder').'/tutor');
			}
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/tutor');
		}
	}
	
	function requested_tutor()
	{
		$data['tutor_requests']	= $this->Tutor_model->get_tutor_requests();
		$data['tutors']			= $this->Tutor_model->get_tutors();		
		foreach ($data['tutors'] as $tutors)
		{
			$related			= json_decode($tutors->courses);
			$tutors->courses 	= $related;			
		}
		
		//$this->show->pe($data['tutors']);
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/tutor/tutor_request_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	
	function ajex_tutor_for_course()
	{
		
		$save = array();		
		$save['forum_admin']	= strtolower($this->admin_access);
		$save['product_id']		= $_POST['subject_id'];
		$save['customer_id']	= $_POST['customer_id']; 
		$save['tutor_id']		= $_POST['tutor_id'];
		$save['forum_title']	= 'Subject Forum';
		$save['forum_comments']	= 'Please use forum to communicat with tutors.';
		$save['forum_status']	= '1';
		$forum_id				= $this->Forum_model->save($save);
		
		
		$data['tutor_id'] 			= $_POST['tutor_id'];
		$data['request_id']  		= $_POST['request_id'];
		$data['admin_id'] 			= $this->admin_id;       
        $data['admin_access'] 		= $this->admin_access;		
		$data['request_status']		= 'Tutor Assigned';		
		$folder_name 				= realpath('.').'/files/'.$_POST['tutor_id'].'_'.$_POST['customer_id'];
		$data['folder_share']		= $_POST['tutor_id'].'_'.$_POST['customer_id'];
		$data['forum_id']			= $forum_id;
		
		$customer_data 				= $this->Customer_model->get_customer($_POST['customer_id']);
		$tutor_data					= $this->Tutor_model->get_tutor($_POST['tutor_id']);		
		$email_attributes 			= $this->Settings_model->get_system_email($this->config->item('email_template'));
		$message 					= '';
		
		
		$this->load->library('email');		
		$config['mailtype'] 		= 'html';		
		$this->email->initialize($config);
		
		$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"> <singleline label="Title"> Tutor Assigned!</singleline></p><div align="left" ><multiline label="Description"></multiline>We are glad to tell you that your request for tutor support has been granted and we have coordinated with one of our best tutors to assist you during your coursework. Further details will be addressed to you shortly.<br> Name: '.$tutor_data->firstname.' '. $tutor_data->lastname.'<br> E-mail: '.$tutor_data->email.'<br> Phone: '.$tutor_data->phone.'<br></div></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><div align="left" >Student Support can be accessed via e-mail: <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';
					
				

		$this->email->from($this->config->item('email'), $this->config->item('company_name'));		
		$this->email->to($customer_data->email);
		$this->email->bcc($this->config->item('bcc_email'));		
		$this->email->subject('Tutor Assigned');
		$this->email->message(html_entity_decode($email_attributes[0]['email_header'].$message_tutor_asseigned.$email_attributes[0]['email_footer']));		
		$this->email->send();
		
		$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"> <singleline label="Title"> Forum Assigned!</singleline></p><div align="left" ><multiline label="Description"></multiline>This email contains information regarding the forum where you and your prospective tutor will communicate. With the help of this forum, you can discuss your course material; you can ask questions and can build up a healthy study relationship.<br> Forum Name: '.$save['forum_title'].'<br></div></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><div align="left" >Student Support can be accessed via e-mail : <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';

		
		
		$this->email->from($this->config->item('email'), $this->config->item('company_name'));		
		$this->email->to($customer_data->email);
		$this->email->bcc($this->config->item('bcc_email'));		
		$this->email->subject('Forum Assigned');
		$this->email->message(html_entity_decode($email_attributes[0]['email_header'].$message_forum.$email_attributes[0]['email_footer']));		
		$this->email->send();
		
		$this->email->from($this->config->item('email'), $this->config->item('company_name'));		
		$this->email->to($tutor_data->email);
		$this->email->bcc($this->config->item('bcc_email'));		
		$this->email->subject('Forum Assigned');
		$this->email->message(html_entity_decode($email_attributes[0]['email_header'].$message_forum.$email_attributes[0]['email_footer']));		
		$this->email->send();
		
		
		$message .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"> <singleline label="Title"> Student Assigned!</singleline></p><div align="left" ><multiline label="Description"></multiline>We are glad to tell you that you have been assigned a student. You will assist this student during his/her coursework. Further details will be addressed to you shortly.<br>Name: '.$customer_data->firstname.' '. $customer_data->lastname.'<br> E-mail: '.$customer_data->email.'<br> Phone: '.$customer_data->phone.'<br></div></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><div align="left" >Tutor Support can be accessed via e-mail: <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';
		
		$this->email->from($this->config->item('email'), $this->config->item('company_name'));		
		$this->email->to($tutor_data->email);
		$this->email->bcc($this->config->item('bcc_email'));		
		$this->email->subject('Student Assigned');
		$this->email->message(html_entity_decode($email_attributes[0]['email_header'].$message_studnet_assigned.$email_attributes[0]['email_footer']));		
		$this->email->send();
					
		if(!is_dir($folder_name))
		{
			mkdir($folder_name,0777,true);
			$student 	= realpath('.').'/files/'.$_POST['tutor_id'].'_'.$_POST['customer_id'].'/student';
			$tutor 		= realpath('.').'/files/'.$_POST['tutor_id'].'_'.$_POST['customer_id'].'/tutor';
			mkdir($student,0777,true);
			mkdir($tutor,0777,true);
		}	
		
		$this->Tutor_model->save_tutor_requests($data);
	}
}
?>