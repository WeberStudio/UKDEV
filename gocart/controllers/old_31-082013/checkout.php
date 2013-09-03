<?php 
/* Single page checkout controller*/

class Checkout extends Front_Controller {

	function __construct()
	{
		
        parent::__construct();

		force_ssl();
        //DebugBreak();
		/*make sure the cart isnt empty*/
		if($this->go_cart->total_items()==0)
		{
			redirect('cart/view_cart');
		}
		
		/*is the user required to be logged in?*/
		if (config_item('require_login'))
		{
			$this->Customer_model->is_logged_in('checkout');
		}

		if(!config_item('allow_os_purchase') && config_item('inventory_enabled'))
		{
			/*double check the inventory of each item before proceeding to checkout*/
			$inventory_check	= $this->go_cart->check_inventory();

			if($inventory_check)
			{
				/*
				OOPS we have an error. someone else has gotten the scoop on our customer and bought products out from under them!
				we need to redirect them to the view cart page and let them know that the inventory is no longer there.
				*/
				$this->session->set_flashdata('error', $inventory_check);
				redirect('cart/view_cart');
			}
		}
		/* Set no caching
	
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	
		*/
		$this->load->library('form_validation');
        $this->load->library('merchant');
        $this->load->model('Order_model');
		$this->lang->load('common');
	}

	function index()
	{
		/*show address first*/
		$this->step_1();
	}

	function step_1()
	{
		$data['customer']	= $this->go_cart->customer();

		if(isset($data['customer']['id']))
		{
			$data['customer_addresses'] = $this->Customer_model->get_address_list($data['customer']['id']);
		}

		/*require a billing address*/
		$this->form_validation->set_rules('address_id', 'Billing Address ID', 'numeric');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('company', 'Company', 'trim|max_length[128]');
		$this->form_validation->set_rules('address1', 'Address 1', 'trim|required|max_length[128]');
		$this->form_validation->set_rules('address2', 'Address 2', 'trim|max_length[128]');
		$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[128]');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required|numeric');
		$this->form_validation->set_rules('zone_id', 'State', 'trim|required|numeric');
		
		/*if there is post data, get the country info and see if the zip code is required*/
		if($this->input->post('country_id'))
		{
			$country = $this->Location_model->get_country($this->input->post('country_id'));
			if((bool)$country->postcode_required)
			{
				$this->form_validation->set_rules('zip', 'Zip', 'trim|required|max_length[10]');
			}
		}
		else
		{
			$this->form_validation->set_rules('zip', 'Zip', 'trim|max_length[10]');
		}

		if ($this->form_validation->run() == false)
		{
			$data['address_form_prefix']	= 'bill';
			$this->load->view('confirm_address', $data);
		}
		else
		{
			/*load any customer data to get their ID (if logged in)*/
			$customer				= $this->go_cart->customer();

			$customer['bill_address']['company']		= $this->input->post('company');
			$customer['bill_address']['firstname']	= $this->input->post('firstname');
			$customer['bill_address']['lastname']		= $this->input->post('lastname');
			$customer['bill_address']['email']		= $this->input->post('email');
			$customer['bill_address']['phone']		= $this->input->post('phone');
			$customer['bill_address']['address1']		= $this->input->post('address1');
			$customer['bill_address']['address2']	= $this->input->post('address2');
			$customer['bill_address']['city']			= $this->input->post('city');
			$customer['bill_address']['zip']			= $this->input->post('zip');

			/* get zone / country data using the zone id submitted as state*/
			$country								= $this->Location_model->get_country(set_value('country_id'));
			$zone									= $this->Location_model->get_zone(set_value('zone_id'));

			$customer['bill_address']['zone']			= $zone->code;  /*  save the state for output formatted addresses */
			$customer['bill_address']['country']		= $country->name; /*  some shipping libraries require country name */
			$customer['bill_address']['country_code']   = $country->iso_code_2; /*  some shipping libraries require the code */ 
			$customer['bill_address']['zone_id']		= $this->input->post('zone_id');  /*  use the zone id to populate address state field value */
			$customer['bill_address']['country_id']		= $this->input->post('country_id');

			/* for guest customers, load the billing address data as their base info as well */
			if(empty($customer['id']))
			{
				$customer['company']	= $customer['bill_address']['company'];
				$customer['firstname']	= $customer['bill_address']['firstname'];
				$customer['lastname']	= $customer['bill_address']['lastname'];
				$customer['phone']		= $customer['bill_address']['phone'];
				$customer['email']		= $customer['bill_address']['email'];
			}

			if(!isset($customer['group_id']))
			{
				$customer['group_id'] = 1; /* default group */
			}

			/*if there is no address set then return blank*/
			if(empty($customer['ship_address']))
			{
				$customer['ship_address']	= $customer['bill_address'];
			}
			
			/* save customer details*/
			$this->go_cart->save_customer($customer);

			/*send to the next form*/
			redirect('checkout/step_2');
		}
	}

	function shipping_address()
	{
		$data['customer']	= $this->go_cart->customer();

		if(isset($data['customer']['id']))
		{
			$data['customer_addresses'] = $this->Customer_model->get_address_list($data['customer']['id']);
		}

		/*require a shipping address*/
		$this->form_validation->set_rules('address_id', 'Billing Address ID', 'numeric');
		$this->form_validation->set_rules('firstname', 'lang:address_firstname', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('lastname', 'lang:address_lastname', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('email', 'lang:address_email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('phone', 'lang:address_phone', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('company', 'lang:address_company', 'trim|max_length[128]');
		$this->form_validation->set_rules('address1', 'lang:address1', 'trim|required|max_length[128]');
		$this->form_validation->set_rules('address2', 'lang:address2', 'trim|max_length[128]');
		$this->form_validation->set_rules('city', 'lang:address_city', 'trim|required|max_length[128]');
		$this->form_validation->set_rules('country_id', 'lang:address_country', 'trim|required|numeric');
		$this->form_validation->set_rules('zone_id', 'lang:address_state', 'trim|required|numeric');
		
		/* if there is post data, get the country info and see if the zip code is required */
		if($this->input->post('country_id'))
		{
			$country = $this->Location_model->get_country($this->input->post('country_id'));
			if((bool)$country->postcode_required)
			{
				$this->form_validation->set_rules('zip', 'lang:address_postcode', 'trim|required|max_length[10]');
			}
		}
		else
		{
			$this->form_validation->set_rules('zip', 'lang:address_postcode', 'trim|max_length[10]');
		}

		if ($this->form_validation->run() == false)
		{
			/* show the address form but change it to be for shipping */
			$data['address_form_prefix']	= 'ship';
			$this->view('checkout/address_form', $data);
		}
		else
		{
			/* load any customer data to get their ID (if logged in) */
			$customer				= $this->go_cart->customer();

			$customer['ship_address']['company']		= $this->input->post('company');
			$customer['ship_address']['firstname']		= $this->input->post('firstname');
			$customer['ship_address']['lastname']		= $this->input->post('lastname');
			$customer['ship_address']['email']			= $this->input->post('email');
			$customer['ship_address']['phone']			= $this->input->post('phone');
			$customer['ship_address']['address1']		= $this->input->post('address1');
			$customer['ship_address']['address2']		= $this->input->post('address2');
			$customer['ship_address']['city']			= $this->input->post('city');
			$customer['ship_address']['zip']			= $this->input->post('zip');

			/* get zone / country data using the zone id submitted as state */
			$country								= $this->Location_model->get_country(set_value('country_id'));
			$zone									= $this->Location_model->get_zone(set_value('zone_id'));

			$customer['ship_address']['zone']			= $zone->code;
			$customer['ship_address']['country']		= $country->name;
			$customer['ship_address']['country_code']   = $country->iso_code_2;
			$customer['ship_address']['zone_id']		= $this->input->post('zone_id');
			$customer['ship_address']['country_id']		= $this->input->post('country_id');

			/* for guest customers, load the shipping address data as their base info as well */
			if(empty($customer['id']))
			{
				$customer['company']	= $customer['ship_address']['company'];
				$customer['firstname']	= $customer['ship_address']['firstname'];
				$customer['lastname']	= $customer['ship_address']['lastname'];
				$customer['phone']		= $customer['ship_address']['phone'];
				$customer['email']		= $customer['ship_address']['email'];
			}

			if(!isset($customer['group_id']))
			{
				$customer['group_id'] = 1; /* default group */
			}

			/*  save customer details */
			$this->go_cart->save_customer($customer);

			/* send to the next form */
			redirect('checkout/step_2');
		}
	}

	function step_2()
	{
		/* where to next? Shipping? */
		$shipping_methods = $this->_get_shipping_methods();

		if($shipping_methods)
		{
			$this->shipping_form($shipping_methods);
		}
		/* now where? continue to step 3 */
		else
		{
			$this->step_3();
		}
	}

	protected function shipping_form($shipping_methods)
	{
		$data['customer']			= $this->go_cart->customer();

		/* do we have a selected shipping method already? */
		$shipping					= $this->go_cart->shipping_method();
		$data['shipping_code']		= $shipping['code'];
		$data['shipping_methods']	= $shipping_methods;

		$this->form_validation->set_rules('shipping_notes', 'lang:shipping_information', 'trim|xss_clean');
		$this->form_validation->set_rules('shipping_method', 'lang:shipping_method', 'trim|callback_validate_shipping_option');

		if($this->form_validation->run() == false)
		{
			$this->view('checkout/shipping_form', $data);
		}
		else
		{
			/* we have shipping details! */
			$this->go_cart->set_additional_detail('shipping_notes', $this->input->post('shipping_notes'));

			/* parse out the shipping information */
			$shipping_method	= json_decode($this->input->post('shipping_method'));
			$shipping_code		= md5($this->input->post('shipping_method'));

			/* set shipping info */
			$this->go_cart->set_shipping($shipping_method[0], $shipping_method[1]->num, $shipping_code);

			redirect('checkout/step_3');
		}
	}

	/*
		callback for shipping form 
		if callback is true then it's being called for form_Validation
		In that case, set the message otherwise just return true or false
	*/
	function validate_shipping_option($str, $callback=true)
	{
		$shipping_methods	= $this->_get_shipping_methods();

		if($shipping_methods)
		{
			foreach($shipping_methods as $key=>$val)
			{
				$check	= json_encode(array($key, $val));
				if($str	== md5($check))
				{
					return $check;
				}
			}
		}

		/* if we get there there is no match and they have submitted an invalid option */
		$this->form_validation->set_message('validate_shipping_option', lang('error_invalid_shipping_method'));
		return FALSE;

	}

	private function _get_shipping_methods()
	{
		$shipping_methods	= array();
		/* do we need shipping? */

		if(config_item('require_shipping'))
		{
			/* do the cart contents require shipping? */
			if($this->go_cart->requires_shipping())
			{
				/* ok so lets grab some shipping methods. If none exists, then we know that shipping isn't going to happen! */
				foreach ($this->Settings_model->get_settings('shipping_modules') as $shipping_method=>$order)
				{
					$this->load->add_package_path(APPPATH.'packages/shipping/'.$shipping_method.'/');
					/* eventually, we will sort by order, but I'm not concerned with that at the moment */
					$this->load->library($shipping_method);

					$shipping_methods	= array_merge($shipping_methods, $this->$shipping_method->rates());
				}

				/*  Free shipping coupon applied ? */
				if($this->go_cart->is_free_shipping()) 
				{
					/*  add free shipping as an option, but leave other options in case they want to upgrade */
					$shipping_methods[lang('free_shipping_basic')] = "0.00";
				}

				/*  format the values for currency display */
				foreach($shipping_methods as &$method)
				{
					/*  convert numeric values into an array containing numeric & formatted values */
					$method = array('num'=>$method,'str'=>format_currency($method));
				}
			}
		}
		if(!empty($shipping_methods))
		{
			/* everything says that shipping is required! */
			return $shipping_methods;
		}
		else
		{
			return false;
		}
	}

	function step_3()
	{
		/*
		Some error checking
		see if we have the billing address
		*/
		$customer	= $this->go_cart->customer();
		if(empty($customer['bill_address']))
		{
			redirect('checkout/step_1');
		}

		/* see if shipping is required and set. */
		if(config_item('require_shipping') && $this->go_cart->requires_shipping() && $this->_get_shipping_methods())
		{
			$code	= $this->validate_shipping_option($this->go_cart->shipping_code());

			if(!$code)
			{
				redirect('checkout/step_2');
			}
		}


		if($payment_methods = $this->_get_payment_methods())
		{
			$this->payment_form($payment_methods);
		}
		/* now where? continue to step 4 */
		else
		{
			$this->step_4();
		}
	}

	protected function payment_form($payment_methods)
	{
		/* find out if we need to display the shipping */
		$data['customer']			= $this->go_cart->customer();
		$data['shipping_method']	= $this->go_cart->shipping_method();

		/* are the being bounced back? */
		$data['payment_method']		= $this->go_cart->payment_method();

		/* pass in the payment methods */
		$data['payment_methods']	= $payment_methods;
		
		/* require that a payment method is selected */
		$this->form_validation->set_rules('module', 'lang:payment_method', 'trim|required|xss_clean|callback_check_payment');

		$module = $this->input->post('module');
		if($module)
		{
			$this->load->add_package_path(APPPATH.'packages/payment/'.$module.'/');
			$this->load->library($module);
		}

		if($this->form_validation->run() == false)
		{
			$this->view('checkout/payment_form', $data);
		}
		else
		{
			$this->go_cart->set_payment( $module, $this->$module->description() );
			redirect('checkout/step_4');
		}
	}
	/* callback that lets the payment method return an error if invalid */
	function check_payment($module)
	{
		$check	= $this->$module->checkout_check();

		if(!$check)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_payment', $check);
		}
	}

	private function _get_payment_methods()
	{
		$payment_methods	= array();
		if($this->go_cart->total() != 0)
		{
			foreach ($this->Settings_model->get_settings('payment_modules') as $payment_method=>$order)
			{
				$this->load->add_package_path(APPPATH.'packages/payment/'.$payment_method.'/');
				$this->load->library($payment_method);

				$payment_form = $this->$payment_method->checkout_form();

				if(!empty($payment_form))
				{
					$payment_methods[$payment_method] = $payment_form;
				}
			}
		}
		if(!empty($payment_methods))
		{
			return $payment_methods;
		}
		else
		{
			return false;
		}
	}

	function step_4()
	{
		/* get addresses */
                 
		$data['customer']		    = $this->go_cart->customer();

		$data['shipping_method']	= $this->go_cart->shipping_method();

		$data['payment_method']		= $this->go_cart->payment_method();


		/* Confirm the sale */
		$this->load->view('confirm', $data);
	}

	function login()
	{
		$this->Customer_model->is_logged_in('checkout');
	}

	function register()
	{
		$this->Customer_model->is_logged_in('checkout', 'secure/register');
	}

    function place_order_paypal_pro()
    { 
		$data['address_form_prefix']	= 'bill';
		$data['customer']	= $this->go_cart->customer();
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('select_card', 'Select Card', 'trim|required');
		$this->form_validation->set_rules('card_num', 'Card Number', 'trim|required');
		$this->form_validation->set_rules('select_month', 'Select Month', 'trim|required');
		$this->form_validation->set_rules('select_year', 'Select Year', 'trim|required');
		$this->form_validation->set_rules('cvv_num', 'CVV Number', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('confirm_address', $data);
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
       /* $settings = array(
               'username' => 'j.khalil_api1.weprosolutions.co.uk',
               'password' => '1370608609',
               'signature' => 'A7JgWk4uZhO1rqjMVjT4K9TltcFFAfOAFFulZRA.BaXpmcgm0L1DZ3sX',
               'test_mode' => true,            
        );*/
		
		
		$settings = array(
               'username' => 'accounts_api1.ukopencollege.co.uk',
               'password' => 'XVPKXGVGBMB7KSAE',
               'signature' => 'ADrvt-oQ4IwKnFsOFQLtS3l4BuTYA2T8VODekRJgOqmvoufiDF8aUivH',
               'test_mode' => false,            
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
       	$message .= '<tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td class="w30" width="30"></td><td class="w580" width="580"><repeater><layout label="Text only"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td class="w580" width="580"><p align="left" class="article-title"><singleline label="Title"> Order has been placed successfully!</singleline></p><div align="left" class="article-content">  <multiline label="Description"></multiline><p>We are pleased to inform you that your order has been successfully placed with us under the details you provided. Any course/order related information would be directed to you on your registered e-mail ID. We wish you good luck for your study plan with the UK Open College.</p></div></td></tr><tr><td class="w580" width="100%" height="10">'.$slip_html.'<br><br></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><div align="left" >Student Support can be accessed via e-mail :  <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.<br><br>Or<br><br>Get in touch via</div></td></tr></tbody></table></layout></repeater></td><td class="w30" width="30"></td></tr></tbody></table></td></tr>';
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
		$this->session->unset_userdata('unregister_user'); 
		$this->session->unset_userdata('instructions');
		$this->session->unset_userdata('deliveryadd');
		$this->session->unset_userdata('delivrey_info');
       redirect('cart/view_cart');
		}
       
    }   
    
	function place_order()
	{		
            
		// retrieve the payment method
        //DebugBreak();
		
		$this->session->unset_userdata('unregister_user'); 
		$this->session->unset_userdata('instructions');
		$this->session->unset_userdata('deliveryadd');
		$this->session->unset_userdata('delivrey_info');
		
		
        $payment['module']                  = "paypal_express";
        $payment['description']             = "PayPal Express";		
        $paypal_express['name']             = "PayPal Express";
        $paypal_express['form']             = "<table width=\"100%\" border=\"0\" cellpadding=\"5\">\n  <tr>\n    <td><img  src=\"https://www.paypal.com/en_US/i/logo/PayPal_mark_180x113.gif\" border=\"0\" alt=\"Acceptance Mark\"></td>\n  </tr>\n  <tr>\n    <td>You will be directed to the Paypal website to verify your payment. Once your payment is authorized, you will be directed back to our website and your order will be complete.</td>\n  </tr>\n</table>\n";
        $payment_methods['paypal_express']  = $paypal_express ;
		
		
		//make sure they're logged in if the config file requires it
		/*if($this->config->item('require_login'))
		{
			$customer_data = $this->Customer_model->is_logged_in(false, false);           
		}     */
        
        
        
		
		// are we processing an empty cart?
		$contents = $this->go_cart->contents();
		if(empty($contents))
		{
			redirect('cart/view_cart');
		}
        
		  // save the order
       
        
       if(!$this->go_cart->_cart_contents['payment']['confirmed'])
       {
           if(!empty($payment) && (bool)$payment_methods == true)
            {
                //load the payment module
                $this->load->add_package_path(APPPATH.'packages/payment/'.$payment['module'].'/');
                $this->load->library($payment['module']);
            
                // Is payment bypassed? (total is zero, or processed flag is set)
                if($this->go_cart->total() > 0 && ! isset($payment['confirmed'])) {
                    //run the payment    
                    $error_status    = $this->$payment['module']->process_payment();
                  
                    if($error_status !== false)
                    {
                        // send them back to the payment page with the error
                        $this->session->set_flashdata('error', $error_status);
                        redirect('checkout/step_3');
                    }
                }
            }             
       }
      
		
			                 
	   $order_id = $this->go_cart->save_order();
	   $this->session->set_flashdata('message', "<div  class='woocommerce_message'>Your Order Have Been Submitted Successfully!</div>");
       
       $data['order_id']           = $order_id;           
       $data['payment']            = $this->go_cart->payment_method();
       $data['customer']           = $this->go_cart->customer(); 
       
       
        
        $email_attributes     = $this->Settings_model->get_system_email('login');
        $order_info           = $this->Order_model->get_order_by_order_number($order_id);
        $slip_html            = $this->create_slip($order_info);
        $message  = '';
        $message .= $email_attributes[0]['email_header'];        
        $message .= '<tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td class="w30" width="30"></td><td class="w580" width="580"><repeater><layout label="Text only"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td class="w580" width="580"><p align="left" class="article-title"><singleline label="Title"> Order has been placed successfully!</singleline></p><div align="left" class="article-content">  <multiline label="Description"></multiline>We are pleased to inform you that your order has been successfully placed with us under the details you provided. Any course/order related information would be directed to you on your registered e-mail ID. We wish you good luck for your study plan with the UK Open College.</div></td></tr><tr><td class="w580" width="100%" height="10">'.$slip_html.'<br><br></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><div align="left" >Student Support can be accessed via e-mail :  <a href="mailto:support@ukopencollege.co.uk"> support@ukopencollege.co.uk</a>.<br><br>Or<br><br>Get in touch via</div></td></tr></tbody></table></layout></repeater></td><td class="w30" width="30"></td></tr></tbody></table></td></tr>';
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
       
       $this->go_cart->destroy();
       redirect('cart/view_cart');
		
		
		
		// run the complete payment module method once order has been saved
		if(!empty($payment))
		{
			        
            if(method_exists($this->$payment['module'], 'complete_payment'))
			{
				$this->$payment['module']->complete_payment($data);
			}
		}
	
		
		
		$data['page_title'] = 'Thanks for shopping with '.$this->config->item('company_name');
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		$data['download_section']	= $download_section;
		
		
		/*  get all cart information before destroying the cart session info */
		$data['go_cart']['group_discount']      = $this->go_cart->group_discount();
		$data['go_cart']['subtotal']            = $this->go_cart->subtotal();
		$data['go_cart']['coupon_discount']     = $this->go_cart->coupon_discount();
		$data['go_cart']['order_tax']           = $this->go_cart->order_tax();
		$data['go_cart']['discounted_subtotal'] = $this->go_cart->discounted_subtotal(); 		
		$data['go_cart']['total']               = $this->go_cart->total();
		$data['go_cart']['contents']            = $this->go_cart->contents();

		/* remove the cart from the session */
		//$this->go_cart->destroy();

		/*  show final confirmation page */
		$this->load->view('order_placed', $data); 
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
