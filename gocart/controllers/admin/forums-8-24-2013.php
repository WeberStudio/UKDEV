<?php
class forums extends Admin_Controller {    

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
		
		
		$this->load->model(array('Customer_model', 'Product_model', 'Tutor_model', 'Forum_model', 'Topic_model', 'Message_Forum_model'));
		$this->load->library('email');
    }
	

    function index($field='forum_title', $by='ASC', $page='', $row=5)
    {
       	
        $data = array();
		$data['forums']			= $this->Forum_model->get_forums($row, $page, $field, $by);	
		
		$this->load->library('pagination');
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/forums/index/'.$field.'/'.$by.'/';
		$config['total_rows']		= $this->Forum_model->count_forums();
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
		
		$data['page']	= $page;
		$data['field']	= $field;
		$data['by']		= $by;
			
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/forum_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');

    }
	
	function form($id = false)
	{
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//$this->show->pe($_POST);
		$data['id']				= '';		
		$data['forum_admin']	= '';
		$data['product_id']		= '';
		$data['customer_id']	= '';
		$data['tutor_id']		= '';
		$data['forum_title']	= '';
		$data['forum_comments']	= '';
		$data['customers']		= array();
		$data['products']		= array();
		$data['tutors']			= array();
		$data['customers']		= $this->Customer_model->get_customers();
		$data['products']		= $this->Product_model->get_all_products_array();
		$data['tutors']			= $this->Tutor_model->get_tutors();
		
		if($id)
		{
			
			$forum				= $this->Forum_model->get_forum($id);

			if(!$forum)
			{
				//forum does not exist
				$this->session->set_flashdata('error', lang('error_forum_not_found'));
				redirect($this->config->item('admin_folder').'/forums');
			}
			
			
			//set values to db values
			$data['id']				= $forum->forum_id;
			$data['forum_admin']	= $forum->forum_admin;
			$data['product_id']		= $forum->product_id;
			$data['customer_id']	= $forum->customer_id;
			$data['tutor_id']		= $forum->tutor_id;
			$data['forum_title']	= $forum->forum_title;
			$data['forum_comments']	= $forum->forum_comments;		
		}
		
		$this->form_validation->set_rules('product_id', 'Course', 'required');
		$this->form_validation->set_rules('customer_id', 'Student', 'required');		
		$this->form_validation->set_rules('tutor_id', 'Tutor', 'required');
		$this->form_validation->set_rules('forum_title', 'Forum Title', 'trim|required');		
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			//$this->show->pe($data['tutors']);
			//echo validation_errors('<div class="error">', '</div>'); exit;
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/forum_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
			
		}
		else
		{
			
			$save = array();
			$save['forum_id']		= $id;
			$save['forum_admin']	= strtolower($this->admin_access);
			$save['product_id']		= $this->input->post('product_id');
			$save['customer_id']	= $this->input->post('customer_id'); 
			$save['tutor_id']		= $this->input->post('tutor_id');
			$save['forum_title']	= $this->input->post('forum_title');
			$save['forum_comments']	= $this->input->post('forum_comments');			
			
			//save the forum
			$forum_id				= $this->Forum_model->save($save);
			if(!$id)
			{
				
				/*$to		 = $save['email'];
				$message = 'Welcome! '.$save['firstname'].' '.$save['lastname']."\n\n";
				$message .= 'E-mail: '.$save['email']."\n";
				$message .= 'Password: '.$password."\n\n";
				$message .= 'Thanks For Joining Ukopencollege.';			
				$this->email->from('support@ukopencollege.com', 'Ukopencollege');
				$this->email->to($to);
				$this->email->subject('Successfully Signup!');
				$this->email->message($message);
				$this->email->send();*/	
			}
				
			$this->session->set_flashdata('message', lang('message_saved_forum'));
			
			//go back to the forum list
			redirect($this->config->item('admin_folder').'/forums');
			
		}
		
	}
	
	function delete_forum($forum_id)
	{
		
		$data['forum_id']		= $this->Forum_model->delete_forum($forum_id);
		redirect($this->config->item('admin_folder').'/forums');
	}
	
	function topic_form($forum_id, $id = false)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['id'] 				= '';
		$data['forum_id'] 			= '';
		$data['topic_login_id'] 	= '';
		$data['topic_user_role']	= '';
		$data['topic_title']		= '';
		$data['topic_message']		= '';
		$data['forum_id'] 			= $forum_id;
		
		
		if($id)
		{
			
			$topic				= $this->Topic_model->get_topic($id);

			if(!$topic)
			{
				//forum does not exist
				$this->session->set_flashdata('error', lang('error_forum_not_found'));
				redirect($this->config->item('admin_folder').'/topic_form');
			}
			
			
			//set values to db values
			$data['id']				= $topic->topic_id;			
			$data['topic_title']	= $topic->topic_title;
			$data['topic_message']	= $topic->topic_message;		
		}
		
		$this->form_validation->set_rules('topic_title', 'Topic Title', 'required');
		$this->form_validation->set_rules('topic_message', 'Topic Message', 'required');
		if($this->form_validation->run() == false)
		{
			//echo validation_errors('<div class="error">', '</div>'); exit;
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/topic_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
			
		}
		else
		{
			$save['topic_id']			= $id;
			$save['topic_login_id'] 	= $this->admin_id;
			$save['topic_user_role'] 	= strtolower($this->admin_access);	
			$save['topic_title']		= $this->input->post('topic_title');
			$save['topic_message']		= $this->input->post('topic_message');			
			$save['forum_id']			= $data['forum_id'];
			//$save['topic_time']		= date('Y-m-d H:i:s');
			//save the forum
			$topic_id	= $this->Topic_model->save($save);
			$this->session->set_flashdata('message', lang('message_saved_forum'));
			
			//go back to the forum list
			redirect($this->config->item('admin_folder').'/forums/topic_view/'.$forum_id);
		}
		
	}
	
			
	function topic_view($forum_id)
	{
		$data['form_id'] 	= $forum_id;	
		$data['topics']		= $this->Topic_model->get_topic_by_form_id($forum_id);	
		//echo "<pre>"; print_r($data['topics']);exit;
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/topic_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	
	function topic_delete($forum_id, $topic_id)
	{
		$data['topic_id'] = $this->Topic_model->topic_delete($topic_id);
		redirect($this->config->item('admin_folder').'/forums/topic_view/'.$forum_id);
	}
	
	function message_converstion($topoc_id)
	{
		$data 					= array();
		$data['topic_id'] 		= $topoc_id;
		$data['messages']		= $this->Message_Forum_model->get_messages_by_topic_id($topoc_id);
		//echo "<pre>"; print_r($data['messages']);exit;
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/message', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	
	
		
	function message_form($topic_id, $id = false, $message_mode = false)
	{
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['id'] 				= '';
		$data['topic_id'] 			= $topic_id;
		$data['message_login_id'] 	= '';
		$data['message_user_role']	= '';
		$data['message_title']		= '';
		$data['message_message']	= '';	
				
		if($id)
		{
			
			$message				= $this->Message_Forum_model->get_message($id);
			//print_r($message);exit;
			
			if(!$message)
			{
				//forum does not exist
				$this->session->set_flashdata('error', lang('error_forum_not_found'));
				redirect($this->config->item('admin_folder').'/forums/message_converstion/'.$topic_id);
			}
			
			
			//set values to db values
			$data['id']					= $message->message_id;
			$data['topic_id']			= $message->topic_id;			
			$data['message_title']		= $message->message_title;
			$data['message_message']	= $message->message_message;		
		}
		//echo '--'.$message_mode;exit;
		
		if(!empty($message_mode) && $message_mode = 'reply')
		{
			$data['message_title'] 		= 'Re: '.$message->message_title;
			$data['reply']				= 'reply';
			$data['message_message']	= '';	
		}
		
		$this->form_validation->set_rules('message_title', 'Message Title', 'required');
		$this->form_validation->set_rules('message_message', 'Message Message', 'required');
		
		if($this->form_validation->run() == false)
		{
					
			//echo validation_errors('<div class="error">', '</div>'); exit;
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/message_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
			
		}
		else
		{
			$save['message_id']			= $id;
			$save['topic_id']			= $topic_id;
			$save['message_login_id'] 	= $this->admin_id;
			$save['message_user_role'] 	= strtolower($this->admin_access);	
			$save['message_title']		= $this->input->post('message_title');
			$save['message_message']	= $this->input->post('message_message');			
			
			//$save['topic_time']		= date('Y-m-d H:i:s');
			//save the forum
			$message_id	= $this->Message_Forum_model->save($save);
			$this->session->set_flashdata('message', lang('message_saved_forum'));
			
			//go back to the forum list
			redirect($this->config->item('admin_folder').'/forums/message_converstion/'.$topic_id);
		}
		
	
	}
	
	function message_delete($topic_id, $message_id)
	{
		$data['message_id'] = $this->Message_Forum_model->message_delete($message_id);
		redirect($this->config->item('admin_folder').'/forums/message_converstion/'.$topic_id);
	}
}
?>