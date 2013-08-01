<?php 
class Order extends Admin_Controller {    

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
		
		$this->load->model('Order_model');
		$this->load->model('Search_model');
		$this->load->model('location_model');
		$this->load->model('Category_model');
		$this->load->model('Product_model');
		//$this->load->model('Product_model');		
		$this->lang->load('order');
		$this->load->helper('form');
		

    }
	
	 function index($id = false , $rows=5, $page=0 , $search = false)
	 {
		$sort_by='order_number';
		$sort_order='ASC';
	 	$code=0;
	 	//$page=0;
	   $rows=25;
		//$search = false;
		
       	
		
        $data = array();
		
		$data['id'] 			= $id;
		//print_r($data['id']);exit;
		
		$data['category'] 		= $this->Category_model->get_all_categories();
		$data['courses'] 		= $this->Product_model->get_all_products_array();
		$data['admins']			= $this->auth->get_admin_list();
		
		
		if($id==2)
		{$data['orders']				= $this->Order_model->get_delivered_oder();}
		elseif($id==3)
		{$data['orders']				= $this->Order_model->get_processing_order();}
		elseif($id==6)
		{$data['orders']				= $this->Order_model->get_cancelled_order();}
		
		else
		{
		$data['orders']				= $this->Order_model->get_orders($search,$sort_by,$sort_order,$rows,$page);}
		//echo $this->db->last_query();exit;
		$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/order/index/'.$sort_by.'/'.$sort_order.'/';
		$config['total_rows']		= $this->Order_model->get_orders_count();
		
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
		$data['page']			= $page;
		$data['sort_by']		= $sort_by;
		$data['sort_order']		= $sort_order;
		
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/order_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');

    }
	
	function view($order_id)
    {
       	
		$this->load->helper(array('form', 'date'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('notes', 'lang:notes');
		$this->form_validation->set_rules('status', 'lang:status', 'required');
	
		$message	= $this->session->flashdata('message');
		
	
		if ($this->form_validation->run() == TRUE)
		{
			$save			= array();
			$save['id']		= $order_id;
			$save['notes']	= $this->input->post('notes');
			$save['status']	= $this->input->post('status');
			
			$data['message']	= lang('message_order_updated');
			
			$this->Order_model->save_order($save);
		}
		
		
		
		$data['order']		= $this->Order_model->get_order($order_id);
		
		//$this->show->pe($data['order']);
		//echo "<pre>"; print_r($data['invoices']);exit;
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/order_view', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');

    }
	function packing_slip($order_id)
	{
		$this->load->helper('date');
		$data['order']		= $this->Order_model->get_order($order_id);
		
		$this->load->view($this->config->item('admin_folder').'/packing_slip', $data);
	}
	
	function edit_status()
    {
    	$this->auth->is_logged_in();
    	$order['id']		= $this->input->post('id');
    	$order['status']	= $this->input->post('status');
    	
    	$this->Order_model->save_order($order);
    	
    	echo url_title($order['status']);
    }
    
    function send_notification($order_id='')
    {
			// send the message
   		$this->load->library('email');
		
		$config['mailtype'] = 'html';
		
		$this->email->initialize($config);

		$this->email->from($this->config->item('email'), $this->config->item('company_name'));
		$this->email->to($this->input->post('recipient'));
		
		$this->email->subject($this->input->post('subject'));
		$this->email->message(html_entity_decode($this->input->post('content')));
		
		$this->email->send();
		
		$this->session->set_flashdata('message', lang('sent_notification_message'));
		redirect($this->config->item('admin_folder').'/order/view/'.$order_id);
	}
	
	function bulk_delete()
    {
    	$orders	= $this->input->post('order');
    	
		if($orders)
		{
			foreach($orders as $order)
	   		{
	   			$this->Order_model->delete($order);
	   		}
			$this->session->set_flashdata('message', lang('message_orders_deleted'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_no_orders_selected'));
		}
   		//redirect as to change the url
		redirect($this->config->item('admin_folder').'/orders');	
    }
	
	function order_search($id = false , $rows=5, $page=0)
	{
		$sort_by='order_number';
		$sort_order='ASC';
	 	$code=0;
	 	$rows=25;
		$this->load->library('pagination');	
		
       	
		
        $data = array();
		$data['category'] 				= $this->Category_model->get_all_categories();
		$data['courses'] 				= $this->Product_model->get_all_products_array();
		$data['admins']					= $this->auth->get_admin_list();
		
		
		$search = array();
		
		
		$search['date'] 				= $this->input->post('date');
		$search['categories'] 			= $this->input->post('categories');
		$search['courses'] 				= $this->input->post('courses');
		$search['courses_provider'] 	= $this->input->post('courses_provider');
		$search['start_date'] 			= $this->input->post('start_date');
		$search['end_date'] 			= $this->input->post('end_date');
		//$this->show->pe($search);
		$data['orders']					= $this->Order_model->search_order($search);
		//if($search['categories']!="" || $search['courses']!="" || $search['courses_provider']!="" )
		//{
			
			
			
		//}
		
		//else
		//{
			
		if($id==2)
		{$data['orders']				= $this->Order_model->get_delivered_oder();}
		elseif($id==3)
		{$data['orders']				= $this->Order_model->get_processing_order();}
		elseif($id==6)
		{$data['orders']				= $this->Order_model->get_cancelled_order();}
		
		else
		{
		//$data['orders']				= $this->Order_model->get_orders($search,$sort_by,$sort_order,$rows,$page);
		}
		//}
		//echo $this->db->last_query();exit;
		$data['id'] 			= $id;
		$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/order/index/'.$sort_by.'/'.$sort_order.'/';
		$config['total_rows']		= $this->Order_model->get_orders_count();
		
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
		$data['page']			= $page;
		$data['sort_by']		= $sort_by;
		$data['sort_order']		= $sort_order;
		
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/order_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');

	}

}
?>