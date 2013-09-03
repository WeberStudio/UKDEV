<?php
class dashboard extends Front_Controller {
	

	
	function __construct()
	{
		parent::__construct(); 
		if($this->Tutor_model->is_logged_in(false, false)!=1 && $this->Customer_model->is_logged_in(false, false)!=1)
{
	 redirect('cart'); 
	
	}
		force_ssl();
		
		$this->load->model('Search_model');
		$this->load->model(array('location_model')); 
		$this->load->model(array('Forum_model', 'Topic_model', 'Message_Forum_model'));
        $this->load->model('Order_model');
        $this->load->model('tutor_model');        
		$this->load->helper(array('formatting'));
		$this->lang->load('order');
                 
        $this->customer = $this->go_cart->customer();
        //echo '<pre>';print_r($this->customer); 
		
	}
	
	function index()
		{
           //DebugBreak();
           
          
			/*if($this->Tutor_model->is_logged_in(false, false))
			{
				$this->load->view('dashboard');
			}     
			else if($this->Customer_model->is_logged_in(false, false)) */
             if(isset($this->customer) && !empty($this->customer))
			{
				
				//echo 'elseif';
				$this->load->view('dashboard');
			}
			else
			{
		 		//echo 'else';
				redirect('cart/');
			}
		}
	
	function course()
	{
		//DebugBreak();
        if(!empty($this->customer['id']))
		{		
		    $data['orderss']	= $this->Order_model->get_customer_orders($this->customer['id']);
            //$this->show->pe($data['orderss']);
		    $this->load->view('dashboard_course',$data);
		//print_r($data['orderss']);exit;
		} 
		else if(!empty($this->customer['tutor_id']))
		{ 		
		    $data['orderss']	= $this->Order_model->get_customer_orders($this->customer['tutor_id']);
            $this->load->view('dashboard_course',$data);
		}
		else
		{
		    redirect('cart/');
		}
		
		
	}
	
     /*********************************************************/
    
    // Forum Area Start
    
    /********************************************************/
	
	function fourm()
	{
		
		//DebugBreak()   ;
        if($this->Tutor_model->is_logged_in(false, false))
        {
            
           
            $data['forums']       = $this->Forum_model->get_forum_for_tutors($this->customer['tutor_id']);        
            $this->load->view('dashboard_fourm',$data);
        }
        else if($this->Customer_model->is_logged_in(false, false))
        {              
          // echo "i am in the student check";exit;
            $data['forums']       = $this->Forum_model->get_forum_customer($this->customer['id']);
            
            //$this->show->pe($this->db->last_query());
                   
            //$this->show->pe($data['forums']);       
            $this->load->view('dashboard_fourm',$data);
        }
        else
        {               
            redirect('cart/');     
        }		    	
	}
	
    /*********************************************************/
    
     // Forum Area End   
    
    // Topic Area Start
    
    /********************************************************/
    
    function topic_view($forum_id)
    {
        $data['form_id']     = $forum_id;    
        $data['topics']        = $this->Topic_model->get_topic_by_form_id($forum_id);    
        //echo "<pre>"; print_r($data['topics']);exit;
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
         $this->load->view('topics_listing',$data);
    }
    
    function topic_delete($forum_id, $topic_id)
    {
        $data['topic_id'] = $this->Topic_model->topic_delete($topic_id);
        redirect($this->config->item('admin_folder').'/forums/topic_view/'.$forum_id);
    }
    
    /*********************************************************/
    
    // Topic Area End
    
    /********************************************************/
    
    
	function file_manager()
	{
		
        //$data['file_directory']        = $this->Tutor_model->get_tutor_requests_by_id('customer_id', $customer_details['id']);
        //print_r($data['file_directory']);
        
        //$this->session->set_userdata('file_data',$data['file_directory']);
        //DebugBreak();        
        
        if($this->Tutor_model->is_logged_in(false, false))
        {
            $data['file_directory']        = $this->Tutor_model->get_tutor_requests_by_id('tutor_id', $this->customer['tutor_id'],'',''); 
            $this->load->view('dashboard_file_manager', $data);       
        }else if($this->Customer_model->is_logged_in(false, false))
        {
            $data['file_directory']        = $this->Tutor_model->get_tutor_requests_by_id('customer_id', $this->customer['id'],'','');
            $this->load->view('dashboard_file_manager', $data);            
        }else
        {
            redirect('cart/');    
        }
		
        
	}
	
    
    function my_account($offset=0,$id = false)
    {
        
           //DebugBreak();
        //$this->show->pe($_REQUEST);
        //make sure they're logged in
       // $this->Customer_model->is_logged_in(false, false);
    	$this->load->helper('directory');
        $this->load->helper('date');
        
		//$data['gift_cards_enabled']    = $this->gift_cards_enabled;
        $data['customer']          = (array)$this->Customer_model->get_customer($this->customer['id']);
        
        //$this->show->pe($_REQUEST);                             
        $data['addresses']             	= $this->Customer_model->get_address_list($this->customer['id']);        
        //$data['page_title']            	= 'Welcome '.$data['customer']['firstname'].' '.$data['customer']['lastname'];
		$data['zones_menu']         	= $this->Location_model->get_zones_menu($data['customer']['country']);
		$data['countries_menu']     	= $this->Location_model->get_countries_menu();     
        
       
                
                
        $config['upload_path']      = 'uploads/images/full';
        $config['allowed_types']	= 'gif|jpg|png';
        $config['max_size']         = $this->config->item('size_limit');
        $config['max_width']       	= '1024';
        $config['max_height']       = '768';      
        $config['overwrite']        = true;
        $config['remove_spaces']    = true;
        $config['encrypt_name']     = true;
        $this->load->library('upload', $config);
        
        
        
        
        $this->load->library('form_validation');    
        $this->form_validation->set_rules('company', 'Company', 'trim|max_length[128]');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_check_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('email_subscribe', 'Subscribe', 'trim|numeric|max_length[1]');


        /*if($this->input->post('password') != '' || $this->input->post('confirm') != '')
        {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|sha1');
            $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
        }
        else
        {
            $this->form_validation->set_rules('password', 'Password');
            $this->form_validation->set_rules('confirm', 'Confirm Password');
        }*/


        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('my_account', $data);
        }
        else
        {
            
            $customer                             = array();
            //$customer['id']                        = $this->customer['id'];
            if($id!="")
			{
				$uploaded    = $this->upload->do_upload('image');
				if($uploaded != "")
				{
					if($uploaded == "")
					{
						$error    = $this->upload->display_errors();
						echo $error;
						
					}
					if($uploaded != "")
					{
						$image            	= $this->upload->data();
						$customer['image']  = $image['file_name'];
					}
            	}
      		}

            $customer['id']                        	= $id;
            $customer['company']                	= $this->input->post('company');
            $customer['firstname']                	= $this->input->post('firstname');
            $customer['lastname']                	= $this->input->post('lastname');
            $customer['email']                    	= $this->input->post('email');
            $customer['phone']                    	= $this->input->post('phone');
            $customer['post_code']                	= $this->input->post('zip');
            $customer['address_street']            	= $this->input->post('address1');
            $customer['address_line']            	= $this->input->post('address2');
            $customer['city']                    	= $this->input->post('city');
            $customer['email_subscribe']        	= intval((bool)$this->input->post('email_subscribe'));
            $customer['country']                	= $this->input->post('country_id');
            $customer['state']                    	= $this->input->post('zone_id');
            if($this->input->post('about')!="")
			{
            	$customer['about']                	= $this->input->post('about');
            }
            
            /*if($this->input->post('password') != '')
            {
                $customer['password']            = $this->input->post('password');
            }*/
                       
            $this->go_cart->save_customer($this->customer);
            $this->Customer_model->save($customer);            
            $this->session->set_flashdata('message', lang('message_account_updated'));    
            redirect('dashboard');        
            //redirect('secure/my_account');
        }
    
    }
    
    
	function my_profile($offset=0)
	{
		
		//$this->show->pe($_REQUEST);
		//make sure they're logged in
		if($this->Tutor_model->is_logged_in(false, false)):
	    $this->load->helper('directory');
        $this->load->helper('date');
		
		
		
		$data['tutor']				    = (array)$this->Tutor_model->get_tutor($this->customer['tutor_id']);
		$data['zones_menu']             = $this->Location_model->get_zones_menu($data['tutor']['country']);        
        $data['countries_menu']         = $this->Location_model->get_countries_menu();		
		//$data['page_title']			    = 'Welcome '.$data['customer']['firstname'].' '.$data['customer']['lastname'];
		
		$this->load->view('my_profile', $data);   
		
	 	else:
		redirect('cart/');
		endif;
	}
	
	function request_for_tutor($customer_id, $product_id, $order_id)
    {
        //echo $customer_id.'---------'.$course_id; exit;
        if(!empty($customer_id) && !empty($product_id))
        {
            $data 			= array('customer_id' => $customer_id, 'subject_id' => $product_id, 'request_status' => 'Requested','order_id'=>$order_id);
            $result 		= $this->Order_model->request_for_tutor($data);
			$customer_data 	= $this->Customer_model->get_customer($customer_id);
			//print_r($customer_data);
			$this->session->set_flashdata('message', lang('message_new_password'));
			$email_attributes = $this->Settings_model->get_system_email($this->config->item('email_template'));
			$message  = '';
			$message .= $email_attributes[0]['email_header'];			
			
			/*$message .= '<tr> <td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"> <singleline label="Title"> Student has requested for tutor!</singleline></p><div align="left" ><multiline label="Description"></multiline> Name: '.$customer_data->firstname.' '. $customer_data->lastname.'<br> E-mail: '.$customer_data->email.'<br> Phone: '.$customer_data->phone.'<br></div></td></tr><tr><td ><div align="left" > This email is to let you know that we have received your request for tutor support and we are working on it to find you an experienced tutor in accordance with your needs. The next step is to decide what features you need in your tutor support. Do you need a 24/7 online support or require partial support?</a>.</div></td></tr><tr><td ><div align="left" >For further communication, you can contact us at our email ID which is <a href="mailto:info@ukopencollege.co.uk">info@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';*/		
			
			$message .= '<tr> <td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"> <singleline label="Title"> Student has requested for tutor!</singleline></p><div align="left" ><multiline label="Description"></multiline> Name: '.$customer_data->firstname.' '. $customer_data->lastname.'<br> E-mail: '.$customer_data->email.'<br> Phone: '.$customer_data->phone.'<br></div></td></tr><tr><td ><div align="left" ><p>This email is to let you know that we have received your request for tutor support and we are working on it to find you an experienced tutor in accordance with your needs. The next step is to decide what features you need in your tutor support. Do you need a 24/7 online support or require partial support?</p><p>One of the Student support officer will get in touch with you to assist you with your enquiry in next 48 hours.</p></div></td></tr><tr><td ><div align="left" >Student Supoort can be accessed via e-mail: <a href="mailto:info@ukopencollege.co.uk">info@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';
			
			$message .= $email_attributes[0]['email_footer'];
			$this->load->library('email');				
			$config['mailtype'] = 'html';				
			$this->email->initialize($config);		
			$this->email->from($this->config->item('email'), $this->config->item('company_name'));			
			$this->email->to($this->config->item('email'));
			$this->email->bcc($this->config->item('bcc_email'));			
			$this->email->subject('Student request for tutor to admin');
			$this->email->message(html_entity_decode($message));			
			$this->email->send();			
        }
        
        redirect(base_url().'dashboard/course');
    }
	
	
}
