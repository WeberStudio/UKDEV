<?php
class Topics extends Front_Controller {    
             
    function __construct()
    {        
        parent::__construct(); 
if($this->Tutor_model->is_logged_in(false, false)!=1 && $this->Customer_model->is_logged_in(false, false)!=1)
{
	 redirect('cart');
	
	}
        remove_ssl();        
        $this->load->model(array('Customer_model', 'Product_model', 'Tutor_model', 'Forum_model', 'Topic_model', 'Message_Forum_model'));
        $this->load->library('email');
        $customer_details           = $this->go_cart->customer();
        $this->customer = $this->go_cart->customer();
       // echo "<pre>";print_r($customer_details);  exit;
	   if($this->Tutor_model->is_logged_in(false, false))
	   {
		 $this->login_id             = $customer_details['tutor_id'];
		 $this->first_name           = $customer_details['firstname'];   
		}
		else{
        $this->login_id             = $customer_details['id'];
        $this->first_name           = $customer_details['firstname']; 
		}
    }   
    
    function topic_form($forum_id, $id = false)
    {        
       
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $data['id']                 = '';
        $data['forum_id']           = '';
        $data['topic_login_id']     = '';
        $data['topic_user_role']    = '';
        $data['topic_title']        = '';
        $data['topic_message']      = '';
        $data['forum_id']           = $forum_id;  
       
               
        
        if($id)
        {
            
            $topic                = $this->Topic_model->get_topic($id);
            if(!$topic)
            {
                //forum does not exist
                $this->session->set_flashdata('error', lang('error_forum_not_found'));
                redirect('dashboard/dashboard_topic/'.$forum_id);
            }
                       
            //set values to db values
            $data['id']                = $topic->topic_id;            
            $data['topic_title']       = $topic->topic_title;
            $data['topic_message']     = $topic->topic_message;        
        }
        
        $this->form_validation->set_rules('topic_title', 'Topic Title', 'required');
        $this->form_validation->set_rules('topic_message', 'Topic Message', 'required');
        if($this->form_validation->run() == false)
        {
			
			
            //echo validation_errors('<div class="error">', '</div>'); exit;
		if($id)
		{	 
				if($this->Tutor_model->is_logged_in(false, false))
				{
					$tutor_details 		= $this->go_cart->customer();
					$data['user_id']	= $tutor_details['tutor_id'];
				}
				if($this->Customer_model->is_logged_in(false, false))
				{
					 $customer_details 	= $this->go_cart->customer();
					 $data['user_id']	= $customer_details['id'];
				}
				
				
				if($topic->topic_login_id ==  $data['user_id'] )
				{            
					$this->load->view('topics_form',$data); 
				}
				else
				{
					 redirect('dashboard/topic_view/'.$forum_id);
				}
		}
		else
		{
			$this->load->view('topics_form',$data);
		}
		
        }
        else
        {
			
			if($this->Tutor_model->is_logged_in(false, false)==1)
			{$topic_user_role	= 'tutor';}
			if($this->Customer_model->is_logged_in(false, false)==1)
			{$topic_user_role	='customer';}
            $save['topic_id']            = $id;
            $save['topic_login_id']      = $this->login_id;
            $save['topic_user_role']     = $topic_user_role;    
            $save['topic_title']         = $this->input->post('topic_title');
            $save['topic_message']       = $this->input->post('topic_message');            
            $save['forum_id']            = $data['forum_id'];
            //$save['topic_time']        = date('Y-m-d H:i:s');
            //save the forum
			//t$this->show->pe($save);exit;
            $topic_id                    = $this->Topic_model->save($save);
			
            $this->session->set_flashdata('message', lang('message_saved_forum'));
            
            //go back to the forum list
            redirect('dashboard/topic_view/'.$forum_id);
           
        }
        
    }
    
            
    function topic_view($forum_id)
    {
        $data['form_id']        = $forum_id;    
        $data['topics']         = $this->Topic_model->get_topics();    
        //echo "<pre>"; print_r($data['topics']);exit;
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/topic_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
    }
    
    function topic_delete($forum_id, $topic_id)
    {
		$topic                = $this->Topic_model->get_topic($topic_id);
		
		if($this->Tutor_model->is_logged_in(false, false))
				{
					$tutor_details 		= $this->go_cart->customer();
					$data['user_id']	= $tutor_details['tutor_id'];
				}
				if($this->Customer_model->is_logged_in(false, false))
				{
					 $customer_details 	= $this->go_cart->customer();
					 $data['user_id']	= $customer_details['id'];
				}
				
				
				if($topic->topic_login_id ==  $data['user_id'] )
				{            
					 $data['topic_id'] = $this->Topic_model->topic_delete($topic_id);
					 redirect('dashboard/topic_view/'.$forum_id);
				}
				else
				{
					 redirect('dashboard/topic_view/'.$forum_id);
				}
        }
    
    function message_converstion($topic_id)
    {
        $data                     = array();
        $data['topic_id']         = $topic_id;
        $data['messages']         = $this->Message_Forum_model->get_messages_by_topic_id($topic_id);
		
		if($this->Tutor_model->is_logged_in(false, false))
		{   
			$tutor_details 		= $this->go_cart->customer();
			$data['user_id']	= $tutor_details['tutor_id'];
		}
		if($this->Customer_model->is_logged_in(false, false))
		{
			 $customer_details 	= $this->go_cart->customer();
			 $data['user_id']	= $customer_details['id'];
		}
        //echo "<pre>"; print_r($data['messages']);exit;
         $this->load->view('messages_listing',$data);   
    }
    
    
        
    function message_form($topic_id, $id = false, $message_mode = false)
    {
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $data['id']                   = '';
        $data['topic_id']             = $topic_id;
        $data['message_login_id']     = '';
        $data['message_user_role']    = '';
        $data['message_title']        = '';
        $data['message_message']      = '';    
                
        if($id)
        {
            
            $message                = $this->Message_Forum_model->get_message($id);
            //print_r($message);exit;
            
            if(!$message)
            {
                //forum does not exist
                $this->session->set_flashdata('error', lang('error_forum_not_found'));
                redirect('/topics/message_converstion/'.$topic_id);
            }
            
            
            //set values to db values
            $data['id']                    = $message->message_id;
            $data['topic_id']              = $message->topic_id;            
            $data['message_title']         = $message->message_title;
            $data['message_message']       = $message->message_message;        
        }
        //echo '--'.$message_mode;exit;
        
        if(!empty($message_mode) && $message_mode = 'reply')
        {
            $data['message_title']         = 'Re: '.$message->message_title;
            $data['reply']                 = 'reply';
            $data['message_message']       = '';    
        }
        
        $this->form_validation->set_rules('message_title', 'Message Title', 'required');
        $this->form_validation->set_rules('message_message', 'Message Message', 'required');
        
        if($this->form_validation->run() == false)
        {
                    
            //echo validation_errors('<div class="error">', '</div>'); exit;
		if($id)
		{	
				if($this->Tutor_model->is_logged_in(false, false))
				{
					$tutor_details 		= $this->go_cart->customer();
					$data['user_id']	= $tutor_details['tutor_id'];
				}
				if($this->Customer_model->is_logged_in(false, false))
				{
					 $customer_details 	= $this->go_cart->customer();
					 $data['user_id']	= $customer_details['id'];
				}
				
				
				if($message->message_login_id ==  $data['user_id'] )
				{            
				   $this->load->view('message_form',$data);
				}
				elseif(!empty($message_mode) && $message_mode = 'reply')
				{
					$this->load->view('message_form',$data);
				}
				else
				{
					redirect('/topics/message_converstion/'.$topic_id);
				}
		}
		else
		{
			$this->load->view('message_form',$data);
		}
            
            
        }
        else
        {
			if($this->Tutor_model->is_logged_in(false, false)==1)
			{$message_user_role	= 'tutor';}
			if($this->Customer_model->is_logged_in(false, false)==1)
			{$message_user_role	='student';}
            $save['message_id']            = $id;
            $save['topic_id']              = $topic_id;
            $save['message_login_id']      = $this->login_id;
            $save['message_user_role']     = $message_user_role;
            $save['message_title']         = $this->input->post('message_title');
            $save['message_message']       = $this->input->post('message_message');            
            
            //$save['topic_time']        = date('Y-m-d H:i:s');
            //save the forum
            $message_id                    = $this->Message_Forum_model->save($save);
            $this->session->set_flashdata('message', lang('message_saved_forum'));
            
            //go back to the forum list
            redirect('/topics/message_converstion/'.$topic_id);
        }
        
    
    }
    
    function message_delete($topic_id, $message_id)
    {
		 $message                = $this->Message_Forum_model->get_message($message_id);
		 if($this->Tutor_model->is_logged_in(false, false))
				{
					$tutor_details 		= $this->go_cart->customer();
					$data['user_id']	= $tutor_details['tutor_id'];
				}
				if($this->Customer_model->is_logged_in(false, false))
				{
					 $customer_details 	= $this->go_cart->customer();
					 $data['user_id']	= $customer_details['id'];
				}
				
				
				if($message->message_login_id ==  $data['user_id'] )
				{            
				   $data['message_id'] = $this->Message_Forum_model->message_delete($message_id);
        redirect('topics/message_converstion/'.$topic_id);
				}
				else
				{
					 redirect('topics/message_converstion/'.$topic_id);
				}
		 
       
    }
}
?>