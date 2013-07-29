<?php

class Shipping_order extends Front_Controller {    

    public $status; 
    function __construct()
    {        
        parent::__construct();

        remove_ssl();
        //$this->auth->check_access('Superadmin', true);
        //$this->load->model('Order_model');
        //$this->load->model('Search_model');
        $this->load->model('location_model');
        //$this->load->helper(array('formatting'));
        //$this->lang->load('order');

        /*** Left Menu Selection ***/
        //$this->session->set_userdata('active_module', 'sales');
        /*** Left Menu Selection ***/
        $this->load->library('session');
        $this->load->library('cart');
		$this->load->library('form_validation');
		 $this->load->library('merchant');
        //$this->status = 0;


    }
    function shiping_order_step1()
    {
		//$this->show->pe($this->session->all_userdata(''));
              
        $data['id']                    	= '';
        $data['company']            	= '';
        $data['firstname']            	= '';
        $data['lastname']           	= '';
        $data['email']               	= '';
        $data['phone']                	= '';
        $data['street_address']       	= '';
        $data['address_line2']        	= '';
        $data['city']               	= '';
        $data['state']               	= '';
        $data['post_code']            	= '';
        $data['country_id']            	= '222';
        $data['zone_id']            	= '';
       

        $data['zones_menu']            	= $this->Location_model->get_zones_menu('222');
        $data['countries_menu']        	= $this->Location_model->get_countries_menu();
		$data['country']				= $this->Location_model->get_country($this->input->post('country_id'));
		$data['zone']					= $this->Location_model->get_zone($this->input->post('zone_id'));
		
		
        $get_user_info 					= $this->session->userdata('unregister_user');
        $data['customer']    			= $get_user_info;
		
		
		$this->form_validation->set_rules('gender', 'Gender', 'trim| required');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('street_address', 'Street Address', 'trim|required');
		$this->form_validation->set_rules('address_line2', 'Address Line 2', 'trim');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('post_code', 'Post Code', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required|numeric');
		$this->form_validation->set_rules('zone_id', 'State', 'trim|required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_check_email');
		$this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|max_length[32]|numeric');
		//$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|sha1');
		//$this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
		//$this->form_validation->set_rules('email_subscribe', 'Subscribe', 'trim|numeric|max_length[1]');
		
		if ($this->form_validation->run() == FALSE)
		{
			 $this->load->view('fast_checkout_step1' , $data);
		}
		else{
	

        if($this->input->post('continue')!=""){        
            $unregister_array = array(
            'gender'            	=> $this->input->post('gender'),
            'firstname'            	=> $this->input->post('firstname'),
            'lastname'            	=> $this->input->post('lastname'),
            'street_address'    	=> $this->input->post('street_address'),
            'address_line2'        	=> $this->input->post('address_line2'),
            'city'                	=> $this->input->post('city'),
            'state'                	=> $data['zone']->name,
            'post_code'            	=> $this->input->post('post_code'),
            'country_id'        	=> $data['country']->name,
            'email'                	=> $this->input->post('email'),
            'type'                	=> $this->input->post('type'),
            'telephone'            	=> $this->input->post('telephone')
            );
            $unregister_checkout 	= array('unregister_user' => $unregister_array);    
            $unregister_info 		= $this->session->set_userdata($unregister_checkout);


            redirect('shipping_order/shiping_order_step2');
        }   
		}

       
    }
    function shiping_order_step2()
    {
        //$this->show->pe($this->session->all_userdata(''));
        //$this->show->pe($this->cart->contents());
        //$this->show->pe($this->session->all_userdata());
        $data['instraction'] 			= $this->session->userdata('instructions');
        //echo $data['instraction']; exit;
        $datatt 						= $this->session->userdata('cart_contents');
        //$this->show->pe($datatt['items']);
        $data['delivery_price'] 		= $datatt['items'];
       // $get_user_info = $this->session->userdata('unregister_user');   
        //$this->show->pe($this->session->userdata('deliveryadd'));     
        // echo empty();
         $status = $this->session->userdata('delivrey_info');
		// $this->show->pe($status);
       if($status=="active")
        {
            $get_user_info 				= $this->session->userdata('deliveryadd');   

        }

       else{
            $get_user_info 				= $this->session->userdata('unregister_user');   

        }

        $data['firstname']            	= $get_user_info['firstname'];
        $data['lastname']             	= $get_user_info['lastname'];
        $data['street_address']     	= $get_user_info['street_address'];
        $data['address_line2']        	= $get_user_info['address_line2'];
        $data['city']                 	= $get_user_info['city'];
        $data['post_code']            	= $get_user_info['post_code'];
        $data['state']                 	= $get_user_info['state'];
        $data['country_id']         	= $get_user_info['country_id'];
		
        if($this->input->post('continue')!="")
        {


            $unregister_checkout 		= array('instructions' => $this->input->post('instructions'));

            $unregister_info 			= $this->session->set_userdata($unregister_checkout);
            //$this->show->pe($this->session->all_userdata());
            redirect('shipping_order/shiping_order_step3');
        }
        //$this->show->pe($this->session->all_userdata(''));
        $this->load->view('fast_checkout_step2' ,$data );
    }
	
	function delivery_address()
    {
        //$this->load->library('session');        
        $data['id']                    	= '';
        $data['company']            	= '';
        $data['firstname']            	= '';
        $data['lastname']            	= '';
        $data['email']                	= '';
        $data['phone']                	= '';
        $data['street_address']        	= '';
        $data['address_line2']        	= '';
        $data['city']                	= '';
        $data['state']                	= '';
        $data['post_code']            	= '';
        $data['country_id']            	= '222';
        $data['zone_id']            	= '';
        $password                    	= '';

        $data['zones_menu']            	= $this->Location_model->get_zones_menu('222');
        $data['countries_menu']        	= $this->Location_model->get_countries_menu();
		
		$data['country']				= $this->Location_model->get_country($this->input->post('country_id'));
		$data['zone']					= $this->Location_model->get_zone($this->input->post('zone_id'));
		
		$status = $this->session->userdata('delivrey_info');
        if($status != '' && !empty($status))
		{
			 $get_user_info 				= $this->session->userdata('deliveryadd');
		} 
		else
		{
			$get_user_info 					= $this->session->userdata('unregister_user');
		}
        

        $data['firstname']             	= $get_user_info['firstname'];
        $data['lastname']             	= $get_user_info['lastname'];
        $data['street_address']     	= $get_user_info['street_address'];
        $data['address_line2']        	= $get_user_info['address_line2'];
        $data['city']                 	= $get_user_info['city'];
        $data['post_code']            	= $get_user_info['post_code'];
        $data['state']                	= $get_user_info['state'];
        $data['country_id']        		= $get_user_info['country_id'];

        $data['customer']    			= $get_user_info;
		//$this->show->pe($data['customer']);


        if($this->input->post('continue')!=""){        

            $unregister_array = array(
            'gender'            	=> $this->input->post('gender'),
            'firstname'            	=> $this->input->post('firstname'),
            'lastname'            	=> $this->input->post('lastname'),
            'street_address'    	=> $this->input->post('street_address'),
            'address_line2'        	=> $this->input->post('address_line2'),
            'city'                	=> $this->input->post('city'),
            'state'                	=> $data['zone']->name,
            'post_code'            	=> $this->input->post('post_code'),
            'country_id'        	=> $data['country']->name,
            'email'                	=> $this->input->post('email'),
            'type'                	=> $this->input->post('type'),
            'telephone'            	=> $this->input->post('phone')
            );
            $unregister_checkout 	= array('deliveryadd' => $unregister_array);    
            $unregister_info 		= $this->session->set_userdata($unregister_checkout);
            //$unregister_checkout = array('unregister_user' => $unregister_array);    
            //$unregister_info = $this->session->set_userdata($unregister_checkout);

            //$this->show->pe($unregister_info);
            //exit();
            $delivrey_info 			= array('delivrey_info'=>'active');
			$delivrey_infos 		= $this->session->set_userdata($delivrey_info);
			//$this->show->pe($this->session->all_userdata());
            redirect('shipping_order/shiping_order_step2');
        }   
        $this->load->view('delivery_address' , $data);
    }


    function shiping_order_step3()
    {
		
        $data['instraction'] = $this->session->userdata('instructions');
        $get_user_info = $this->session->userdata('unregister_user');
        //echo $get_user_info['firstname']; exit;
        $data['firstname']             	= $get_user_info['firstname'];
        $data['lastname']             	= $get_user_info['lastname'];
        $data['street_address']     	= $get_user_info['street_address'];
        $data['address_line2']        	= $get_user_info['address_line2'];
        $data['city']                 	= $get_user_info['city'];
        $data['post_code']            	= $get_user_info['post_code'];
        $data['state']                 	= $get_user_info['state'];
        $data['country_id']         	= $get_user_info['country_id'];
		$data['customer']	=$get_user_info;

        //$get_user_info = $this->session->userdata('unregister_user');
        //$data['customer']    = $get_user_info;
        //$this->show->pe($get_user_info);
		
		if($this->input->post('pay_pal')!="")
		{
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('select_card', 'Select Card', 'trim|required');
			$this->form_validation->set_rules('card_num', 'Card Number', 'trim|required');
			$this->form_validation->set_rules('select_month', 'Select Month', 'trim|required');
			$this->form_validation->set_rules('select_year', 'Select Year', 'trim|required');
			$this->form_validation->set_rules('cvv_num', 'CVV Number', 'trim|required');
				
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('fast_checkout_setp3' , $data);
			}
		else{
		
    
         //echo "<pre>";print_r($_POST);exit;
            $firstname      =   $this->input->post('firstname');
            $select_card    =   $this->input->post('select_card'); 
            $card_num       =   $this->input->post('card_num'); 
            $select_month   =   $this->input->post('select_month'); 
            $select_year    =   $this->input->post('select_year');                    
            $cvv_num        =   $this->input->post('cvv_num');
                      
          
        $customer            = $this->go_cart->customer(); 
        $this->merchant->load('paypal_pro');      
        $action = array(
                        'card_type'     => $select_card, 
                        'card_no'       => $card_num, 
                        'first_name'    => 'firstname',
                        'last_name'     => ' ',                      
                        'amount'        => $this->go_cart->total(), 
                        'currency'      => 'GBP', 
                        'country'       => 'GB',  
                        'exp_month'     => $select_month, 
                        'exp_year'      => $select_year, 
                        'csc'           => $cvv_num
                        ); 
        $settings = array(
               'username' => 'j.khalil_api1.weprosolutions.co.uk',
               'password' => '1370608609',
               'signature' => 'A7JgWk4uZhO1rqjMVjT4K9TltcFFAfOAFFulZRA.BaXpmcgm0L1DZ3sX',
               'test_mode' => true,            
        );
        
        $return = $this->merchant->initialize($settings);
        
        
      
       $order_id = $this->go_cart->save_order();
       $response = $this->merchant->purchase($action);           
       $update_array = array(    
               'order_number'   => $order_id,           
               'status'         => $response->_status,
               'transaction_id' => $response->_reference,               
               'card_type'      => $select_card,
               'card_no'        => $card_num,            
        );
        
        $this->Order_model->save_order($update_array, $contents = false);         
        
        $email_attributes     = $this->Settings_model->get_system_email('login');
        $order_info           = $this->Order_model->get_order_by_order_number($order_id);
        $slip_html            = $this->create_slip($order_info);
        $message  = '';
        $message .= $email_attributes[0]['email_header'];        
        $message .= '<tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td class="w30" width="30"></td><td class="w580" width="580"><repeater><layout label="Text only"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td class="w580" width="580"><p align="left" class="article-title"><singleline label="Title"> Order has been placed successfully!</singleline></p><div align="left" class="article-content">  <multiline label="Description"></multiline>We are pleased to tell you that your order has been placed with us under the details you provided. Any course/order related information would be directed to you on your registered ID. We wish you good luck for your study plan with UK Open College.</div></td></tr><tr><td class="w580" width="100%" height="10">'.$slip_html.'<br><br></td></tr><tr><td class="w580" width="580" height="10"><div align="left" class="article-content">Regards,<br><br>Student support office<br>UK Open College Limited<br> 4, Copthall House<br> The Meridian<br> Station Square<br> Coventry<br> West Midlands<br> CV1 2FL<br>Tell: 0121 288 0181<br>Fax: 01827 288298</div></td></tr></tbody></table></layout></repeater></td><td class="w30" width="30"></td></tr></tbody></table></td></tr>';
        $message .= $email_attributes[0]['email_footer'];
        $this->load->library('email');                
        $config['mailtype'] = 'html';
        // Send the user a confirmation email        
       
        $this->email->initialize($config);        
        $this->email->from($this->config->item('email'), $this->config->item('company_name'));                
        if($this->Customer_model->is_logged_in(false, false))
        {
            $to =           $data['customer']['email'];
            $this->email->to($to);
        }
        else if(!empty($data['customer']['ship_address']['email']))
        {
            $to =           $data['customer']['ship_address']['email'];  
            $this->email->to($to);
        }              
        
        $this->email->bcc($this->config->item('bcc_email'));                
        $this->email->subject('Student Order Placement E-mail');
        $this->email->message(html_entity_decode($message));            
        $this->email->send();
        //echo $this->email->print_debugger(); exit; 
          
      $this->session->set_flashdata('message', "<div  class='woocommerce_message'>Your Order Have Been Submitted Successfully!</div>");
       $this->go_cart->destroy();
       redirect('cart/view_cart');
		}
				
		}
		if($this->input->post('pay_pal')=="")
		{
			$this->load->view('fast_checkout_setp3' , $data);
		}
		
	 }
	
	

    function shiping_order_step4()
    {
        $data['instraction'] = $this->session->userdata('instructions');
        $get_user_info = $this->session->userdata('unregister_user');
        $get_user_info_del = $this->session->userdata('deliveryadd'); 
        //echo $get_user_info['firstname']; exit;
        $data['firstname']             = $get_user_info['firstname'];
        $data['lastname']             = $get_user_info['lastname'];
        $data['street_address']     = $get_user_info['street_address'];
        $data['address_line2']        = $get_user_info['address_line2'];
        $data['city']                 = $get_user_info['city'];
        $data['post_code']            = $get_user_info['post_code'];
        $data['state']                 = $get_user_info['state'];
        $data['country_id']         = $get_user_info['country_id'];

        /////delivery

        $data['dfirstname']             = $get_user_info_del['firstname'];
        $data['dlastname']             = $get_user_info_del['lastname'];
        $data['dstreet_address']     = $get_user_info_del['street_address'];
        $data['daddress_line2']        = $get_user_info_del['address_line2'];
        $data['dcity']                 = $get_user_info_del['city'];
        $data['dpost_code']            = $get_user_info_del['post_code'];
        $data['dstate']                 = $get_user_info_del['state'];
        $data['dcountry_id']         = $get_user_info_del['country_id'];

        $this->load->view('fast_checkout_step4' , $data);
    }

    

    function index($sort_by='order_number',$sort_order='desc', $code=0, $page=0, $rows=15)
    {/*


        //if they submitted an export form do the export
        if($this->input->post('submit') == 'export')
        {
        $this->load->model('customer_model');
        $this->load->helper('download_helper');
        $post    = $this->input->post(null, false);
        $term    = (object)$post;

        $data['orders']    = $this->Order_model->get_orders($term);        

        foreach($data['orders'] as &$o)
        {
        $o->items    = $this->Order_model->get_items($o->id);
        }

        force_download_content('orders.xml', $this->load->view($this->config->item('admin_folder').'/orders_xml', $data, true));

        //kill the script from here
        die;
        }

        $this->load->helper('form');
        $this->load->helper('date');
        $data['message']    = $this->session->flashdata('message');
        $data['page_title']    = lang('orders');
        $data['code']        = $code;
        $term                = false;

        $post    = $this->input->post(null, false);
        if($post)
        {
        //if the term is in post, save it to the db and give me a reference
        $term            = json_encode($post);
        $code            = $this->Search_model->record_term($term);
        $data['code']    = $code;
        //reset the term to an object for use
        $term    = (object)$post;
        }
        elseif ($code)
        {
        $term    = $this->Search_model->get_term($code);
        $term    = json_decode($term);
        } 

        $data['term']    = $term;
        $data['orders']    = $this->Order_model->get_orders($term, $sort_by, $sort_order, $rows, $page);
        $data['total']    = $this->Order_model->get_orders_count($term);

        $this->load->library('pagination');

        $config['base_url']            = site_url($this->config->item('admin_folder').'/orders/index/'.$sort_by.'/'.$sort_order.'/'.$code.'/');
        $config['total_rows']        = $data['total'];
        $config['per_page']            = $rows;
        $config['uri_segment']        = 7;
        $config['first_link']        = 'First';
        $config['first_tag_open']    = '<li>';
        $config['first_tag_close']    = '</li>';
        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']    = '</li>';

        $config['full_tag_open']    = '<div class="pagination"><ul>';
        $config['full_tag_close']    = '</ul></div>';
        $config['cur_tag_open']        = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';

        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']    = '</li>';

        $config['prev_link']        = '&laquo;';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']    = '</li>';

        $config['next_link']        = '&raquo;';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $data['sort_by']    = $sort_by;
        $data['sort_order']    = $sort_order;

        //$this->load->view($this->config->item('admin_folder').'/orders', $data);
    */}

    function export()
    {
        $this->load->model('customer_model');
        $this->load->helper('download_helper');
        $post    = $this->input->post(null, false);
        $term    = (object)$post;

        $data['orders']    = $this->Order_model->get_orders($term);        

        foreach($data['orders'] as &$o)
        {
            $o->items    = $this->Order_model->get_items($o->id);
        }

        force_download_content('orders.xml', $this->load->view($this->config->item('admin_folder').'/orders_xml', $data, true));

    }

    function view($id)
    {
        $this->load->helper(array('form', 'date'));
        $this->load->library('form_validation');
        $this->load->model('Gift_card_model');

        $this->form_validation->set_rules('notes', 'lang:notes');
        $this->form_validation->set_rules('status', 'lang:status', 'required');

        $message    = $this->session->flashdata('message');


        if ($this->form_validation->run() == TRUE)
        {
            $save            = array();
            $save['id']        = $id;
            $save['notes']    = $this->input->post('notes');
            $save['status']    = $this->input->post('status');

            $data['message']    = lang('message_order_updated');

            $this->Order_model->save_order($save);
        }
        //get the order information, this way if something was posted before the new one gets queried here
        $data['page_title']    = lang('view_order');
        $data['order']        = $this->Order_model->get_order($id);

        /*****************************
        * Order Notification details *
        ******************************/
        // get the list of canned messages (order)
        $this->load->model('Messages_model');
        $msg_templates = $this->Messages_model->get_list('order');

        // replace template variables
        foreach($msg_templates as $msg)
        {
            // fix html
            $msg['content'] = str_replace("\n", '', html_entity_decode($msg['content']));

            // {order_number}
            $msg['subject'] = str_replace('{order_number}', $data['order']->order_number, $msg['subject']);
            $msg['content'] = str_replace('{order_number}', $data['order']->order_number, $msg['content']);

            // {url}
            $msg['subject'] = str_replace('{url}', $this->config->item('base_url'), $msg['subject']);
            $msg['content'] = str_replace('{url}', $this->config->item('base_url'), $msg['content']);

            // {site_name}
            $msg['subject'] = str_replace('{site_name}', $this->config->item('company_name'), $msg['subject']);
            $msg['content'] = str_replace('{site_name}', $this->config->item('company_name'), $msg['content']);

            $data['msg_templates'][]    = $msg;
        }

        // we need to see if any items are gift cards, so we can generate an activation link
        foreach($data['order']->contents as $orderkey=>$product)
        {
            if(isset($product['is_gc']) && (bool)$product['is_gc'])
            {
                if($this->Gift_card_model->is_active($product['sku']))
                {
                    $data['order']->contents[$orderkey]['gc_status'] = '[ '.lang('giftcard_is_active').' ]';
                } else {
                    $data['order']->contents[$orderkey]['gc_status'] = ' [ <a href="'. base_url() . $this->config->item('admin_folder').'/giftcards/activate/'. $product['code'].'">'.lang('activate').'</a> ]';
                }
            }
        }

        $this->load->view($this->config->item('admin_folder').'/order', $data);

    }

    function packing_slip($order_id)
    {
        $this->load->helper('date');
        $data['order']        = $this->Order_model->get_order($order_id);

        $this->load->view($this->config->item('admin_folder').'/packing_slip.php', $data);
    }

    function edit_status()
    {
        $this->auth->is_logged_in();
        $order['id']        = $this->input->post('id');
        $order['status']    = $this->input->post('status');

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
        redirect($this->config->item('admin_folder').'/orders/view/'.$order_id);
    }

    function bulk_delete()
    {
        $orders    = $this->input->post('order');

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
	
	  function create_slip($order)
    {
        
        
        $slip_html = '<div style="font-size:12px; font-family:arial, verdana, sans-serif;">';
        
        if ($this->config->item("site_logo")) : 
        $slip_html .= '<div class="article-title"><!--<img src="base_url($this->config->item("site_logo"))" />--><h2>Invoice Details</h2></div>';
        endif;
        
        $slip_html .= '<table style="border:1px solid #eee; width:100%; font-size:13px;" cellpadding="5" cellspacing="0"> <tr> <td style="width:20%; vertical-align:top;" class="packing"> <h2 style="margin:0px">*'.$order->order_number.'*</h2>';
                
                    
        
        
        $slip_html .= '</td><td style="width:40%; vertical-align:top;"><strong>Bill To Address</strong><br/>';                
        $slip_html .= (!empty($order->bill_company))?$order->bill_company.'<br/>':'';
        $slip_html .= $order->bill_firstname.' '.$order->bill_lastname.'<br/>'.$order->bill_address1.'<br>';
        $slip_html .= (!empty($order->bill_address2))?$order->bill_address2.'<br/>':'';
        $slip_html .= $order->bill_city.', '.$order->bill_zone.' '.$order->bill_zip.'<br/>'.$order->bill_country.'<br/>'.$order->bill_email.'<br/>'.$order->bill_phone.'</td><td style="width:40%; vertical-align:top;" class="packing"><strong>Status</strong>'.$order->status.'</td></tr><tr><td style="border-top:1px solid #eee;"></td><td style="border-top:1px solid #eee;"><strong>Payment Method</strong>'.$order->payment_info.'</td><td style="border-top:1px solid #eee;"><strong>Shipping Details</strong>'.$order->shipping_method.'</td></tr>';
                    
       
        
        if(!empty($order->notes)):
        $slip_html .= '<tr><td colspan="3" style="border-top:1px solid #eee;"><strong>Notes</strong><br/>'.$order->notes.'</td></tr>';
        endif;
            
        $slip_html .= '</table> <table border="1" style="width:100%; margin-top:10px; border-color:#eee; font-size:13px; border-collapse:collapse;" cellpadding="5" cellspacing="0"> <thead> <tr> <th width="5%" class="packing"> Quantity </th> <th width="20%" class="packing"> Name </th> <th class="packing" > Description </th> </tr> </thead>';
        $items = $order->contents ;
        foreach($order->contents as $orderkey=>$product):
            $img_count = 1;
        
            $slip_html .= '<tr><td class="packing" style="font-size:20px; font-weight:bold;">'.$product['quantity'].'</td><td class="packing">'.$product['name'];
            $slip_html .= (trim($product['sku']) != '')?'<br/><small>sku: '.$product['sku'].'</small>':''.'</td><td class="packing">';
            
                    if(isset($product['options']))
                    {
                        foreach($product['options'] as $name=>$value)
                        {
                            $name = explode('-', $name);
                            $name = trim($name[0]);
                            if(is_array($value))
                            {
                                $slip_html .= '<div>'.$name.':<br/>';
                                foreach($value as $item)
                                {
                                    $slip_html .= '- '.$item.'<br/>';
                                }    
                                $slip_html .="</div>";
                            }
                            else
                            {
                                $slip_html .='<div>'.$name.': '.$value.'</div>';
                            }
                        }
                    }
                    
            $slip_html .= '</td></tr>';
            
            endforeach;
            
            $slip_html .= '</table> <table border="1" style="width:100%; margin-top:10px; border-color:#eee; font-size:13px; border-collapse:collapse;" cellpadding="5" cellspacing="0"> <thead><tr><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Total</th></tr></thead><tbody>';
            
            foreach($order->contents as $orderkey=>$product):
            
            $slip_html .= '<tr><td>'.$product['name'];
            $slip_html .= (trim($product['sku']) != '')?'<br/><small>'.lang('sku').': '.$product['sku'].'</small>':'';
            
            $slip_html .= '</td><td>';
            
                   if(isset($product['options']))
                    {
                        foreach($product['options'] as $name=>$value)
                        {
                            $name = explode('-', $name);
                            $name = trim($name[0]);
                            if(is_array($value))
                            {
                                $slip_html .= '<div>'.$name.':<br/>';
                                foreach($value as $item)
                                {
                                    $slip_html .=  '- '.$item.'<br/>';
                                }    
                                $slip_html .=  "</div>";
                            }
                            else
                            {
                                $slip_html .=  '<div>'.$name.': '.$value.'</div>';
                            }
                        }
                    }
                    
                        if(isset($product['gc_status'])) $slip_html .=  $product['gc_status'];
                
                        $slip_html .=  '</td><td>'.format_currency($product['price']).'</td><td>'.$product['quantity'].'</td><td>'.format_currency($product['price']*$product['quantity']).'</td></tr>';
                
                    endforeach;
            
            $slip_html .=  '</tbody><tfoot>';
            
            if($order->coupon_discount > 0):
            $slip_html .=  '<tr> <td><strong>Coupon Discount</strong></td> <td colspan="3"></td> <td>'.format_currency(0-$order->coupon_discount).'</td></tr>';
            endif;
            
            $slip_html .=  '<tr><td><strong>Subtotal</strong></td><td colspan="3"></td><td>'.format_currency($order->subtotal).'</td></tr>';
            $charges = @$order->custom_charges; 
            if(!empty($charges)) 
            { 
                foreach($charges as $name=>$price) :
                $slip_html .=  '<tr><td><strong>'.$name.'</strong></td> <td colspan="3"></td><td>'.format_currency($price).'</td></tr>';
                endforeach;
            }
            $slip_html .=  '<tr><td><h3>Total</h3></td><td colspan="3"></td><td><strong>'.format_currency($order->total).'</strong></td></tr></tfoot></table></div>';
            
            return $slip_html;
        
    }

}
