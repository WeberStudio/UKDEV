<?php 
//require_once('geoiploc.php');
class Cart extends Front_Controller {



	function __construct()

	{

		parent::__construct();	

		//make sure we're not always behind ssl

		remove_ssl();

	}



	/*function index()

	{

       	$this->load->helper('directory');
		$data['homepage']			= true;
        $data['allProduct']         = $this->Product_model->get_products_catogery_wise();
		$data['pages']				= $this->Page_model->get_pages_by_position('grid-page');
	   // echo '<pre>';print_r($data['allProduct']);

       $this->load->view('index', $data);

	}*/
    
    function index()

    {
            
			
		$data['menu_blue'] = 'home';
       //$parent                      	= 0;
       $position                    	= 'grid-page';
       $data['special_pages']       	= $this->Page_model->get_page('12'); 
	   $data['page_on_video']       	= $this->Page_model->get_page('13'); 
       //$random_array                = $this->Category_model->get_categories_tierd($parent);
       //$test                        =  $this->shuffle_assoc($random_array);
       $ids = array(2,5,6,60,11,4);
       $data['menu_categories']     = $this->Category_model->get_main_category($ids);
       //$this->show->pe($data['menu_categories']); 
       $data['grid_pages']          = $this->Page_model->get_pages_by_position($position);
 
      //$this->show->pe($test);

       $this->load->view('index', $data);

    }
    
	
	function shuffle_assoc($list) 
    { 
      if (!is_array($list)) return $list; 

      $keys = array_keys($list); 
      shuffle($keys); 
      $random = array(); 
      foreach ($keys as $key) 
        $random[$key] = $list[$key]; 

      return $random; 
      }

    function   allcourses($page=0,$row=12)
    {
        $data['menu_blue'] = 'allcourses';
        
         $count =   count($this->Category_model->get_all_categories());
         
           
            
         $data['categories']     = $this->Category_model->get_all_categories($page , $row); 
         
         //$this->show->pe($data['categories']);   
          //$data['allProduct']             = $this->Product_model->get_products_catogery_wise();
          //$this->show->pe($data['categories']);
		//$this->load->helper('directory');       
        //$data['homepage']            	= true;
        //$count =   count($this->Product_model->count_all_published_products());
         //$data['allProduct']         	= $this->Product_model->get_products_catogery_wise($row,$page);
         $this->load->library('pagination');

        $config['base_url']             = base_url().'/cart/allcourses/';
        $config['total_rows']           = $count;
          
        $config['per_page']             = $row;
        $config['uri_segment']          = 3;
        
        $config['first_link']           = 'First';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';
        $config['last_link']            = 'Last';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['full_tag_open']        = '<ul class="">';
        $config['full_tag_close']       = '</ul>';
        $config['cur_tag_open']         = '<li class=""><a href="#">';
        $config['cur_tag_close']        = '</a></li>';
        
        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';
        
        $config['prev_link']            = 'Prev';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = 'Next';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';
        
        $this->pagination->initialize($config);

	   $this->load->view('allCourses' , $data);  

    }

	function page($id = false)
	{

		//if there is no page id provided redirect to the homepage.
		$data['page']		= $this->Page_model->get_page($id);
		if(!$data['page'])
		{
			show_404();
		}
		$this->load->model('Page_model');
        $data['menu_blue']          = $data['page']->slug;
        //$this->show->pe($data['menu_blue']); 
		$data['base_url']			= $this->uri->segment_array();
		$data['fb_like']			= true;
		$data['page_title']			= $data['page']->title;
		$data['meta']				= $data['page']->meta;
		$data['meta_key']			= $data['page']->meta_key;
		$data['seo_title']			= (!empty($data['page']->seo_title))?$data['page']->seo_title:$data['page']->title;
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		$this->load->view('page', $data);

	}

	

	function search($code=false, $page = 0)

	{

		$this->load->model('Search_model');

		

		//check to see if we have a search term

		if(!$code)

		{

			//if the term is in post, save it to the db and give me a reference

			$term		= $this->input->post('term', true);

			$code		= $this->Search_model->record_term($term);

			

			// no code? redirect so we can have the code in place for the sorting.

			// I know this isn't the best way...

			redirect('cart/search/'.$code.'/'.$page);

		}

		else

		{

			//if we have the md5 string, get the term

			$term	= $this->Search_model->get_term($code);

		}

		

		if(empty($term))

		{

			//if there is still no search term throw an error

			//if there is still no search term throw an error

			$this->session->set_flashdata('error', lang('search_error'));

			redirect('cart');

		}

		$data['page_title']			= lang('search');

		$data['gift_cards_enabled']	= $this->gift_cards_enabled;

		

		//fix for the category view page.

		$data['base_url']			= array();

		

		$sort_array = array(

							'name/asc' => array('by' => 'name', 'sort'=>'ASC'),

							'name/desc' => array('by' => 'name', 'sort'=>'DESC'),

							'price/asc' => array('by' => 'price', 'sort'=>'ASC'),

							'price/desc' => array('by' => 'price', 'sort'=>'DESC'),

							);

		$sort_by	= array('by'=>false, 'sort'=>false);

	

		if(isset($_GET['by']))

		{

			if(isset($sort_array[$_GET['by']]))

			{

				$sort_by	= $sort_array[$_GET['by']];

			}

		}

		



		if(empty($term))

		{

			//if there is still no search term throw an error

			$this->load->view('search_error', $data);

		}

		else

		{

	

			$data['page_title']	= lang('search');

			$data['gift_cards_enabled'] = $this->gift_cards_enabled;

		

			//set up pagination

			$this->load->library('pagination');

			$config['base_url']		= base_url().'cart/search/'.$code.'/';

			$config['uri_segment']	= 4;

			$config['per_page']		= 20;

			

			$config['first_link'] = 'First';

			$config['first_tag_open'] = '<li>';

			$config['first_tag_close'] = '</li>';

			$config['last_link'] = 'Last';

			$config['last_tag_open'] = '<li>';

			$config['last_tag_close'] = '</li>';



			$config['full_tag_open'] = '<div class="pagination"><ul>';

			$config['full_tag_close'] = '</ul></div>';

			$config['cur_tag_open'] = '<li class="active"><a href="#">';

			$config['cur_tag_close'] = '</a></li>';



			$config['num_tag_open'] = '<li>';

			$config['num_tag_close'] = '</li>';



			$config['prev_link'] = '&laquo;';

			$config['prev_tag_open'] = '<li>';

			$config['prev_tag_close'] = '</li>';



			$config['next_link'] = '&raquo;';

			$config['next_tag_open'] = '<li>';

			$config['next_tag_close'] = '</li>';

			

			$result					= $this->Product_model->search_products($term, $config['per_page'], $page, $sort_by['by'], $sort_by['sort']);

			$config['total_rows']	= $result['count'];

			$this->pagination->initialize($config);

	

			$data['products']		= $result['products'];

			foreach ($data['products'] as &$p)

			{

				$p->images	= (array)json_decode($p->images);

				$p->options	= $this->Option_model->get_product_options($p->id);

			}

			$this->load->view('category', $data);

		}

	}

	

	function category($id)

	{

		//get the category		

		$data['category'] = $this->Category_model->get_category($id);
         // echo $this->show->pe($data['category']); 
		

		if (!$data['category'])

		{

			show_404();

		}

		

		//set up pagination

		$segments	= $this->uri->total_segments();
         
		$base_url	= $this->uri->segment_array();

		

		if($data['category']->slug == $base_url[count($base_url)])

		{

			$page	= 0;

			$segments++;

		}

		else

		{

			$page	= array_splice($base_url, -1, 1);

			$page	= $page[0];

		}

		

		$data['base_url']	= $base_url;

		$base_url			= implode('/', $base_url);

		

		$data['subcategories']		= $this->Category_model->get_categories($data['category']->id);
        //$this->show->

		$data['product_columns']	= $this->config->item('product_columns');

		$data['gift_cards_enabled'] = $this->gift_cards_enabled;

		

		$data['meta']		= $data['category']->meta;
		
		$data['meta_key']	= $data['category']->meta_key;
		
		$data['seo_title']	= (!empty($data['category']->seo_title))?$data['category']->seo_title:$data['category']->name;

		$data['page_title']	= $data['category']->name;

		

		$sort_array = array(

							'name/asc' => array('by' => 'products.name', 'sort'=>'ASC'),

							'name/desc' => array('by' => 'products.name', 'sort'=>'DESC'),

							'price/asc' => array('by' => 'products.price', 'sort'=>'ASC'),

							'price/desc' => array('by' => 'products.price', 'sort'=>'DESC'),

							);

		$sort_by	= array('by'=>'sequence', 'sort'=>'ASC');

	

		if(isset($_GET['by']))

		{

			if(isset($sort_array[$_GET['by']]))

			{

				$sort_by	= $sort_array[$_GET['by']];

			}

		}

		

		//set up pagination
        $row = 9;
        $data['products']    = $this->Product_model->get_products($data['category']->id, $row, $page, $sort_by['by'], $sort_by['sort']);
		$this->load->library('pagination');

		$config['base_url']		= site_url($base_url);

		$config['uri_segment']	= $segments;

		$config['per_page']		= $row;

		$config['total_rows']	= $this->Product_model->count_products($data['category']->id);

		

		 $config['first_link']           = 'First';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';
        $config['last_link']            = 'Last';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['full_tag_open']        = '<nav class="page-nav"><div class=""><ul class="menu1">';
        $config['full_tag_close']       = '</ul></div></nav>';
        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';
        
        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';
        
        $config['prev_link']            = 'Prev';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = 'Next';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';

		

		$this->pagination->initialize($config);

		

		//grab the products using the pagination lib

		

		foreach ($data['products'] as &$p)

		{

			//$p->images	= (array)json_decode($p->images);

			$p->options	= $this->Option_model->get_product_options($p->id);

		}
        
        /*$count =   count($this->Product_model->count_all_published_products());
        $data['products']    = $this->Product_model->get_products($data['category']->id, $config['per_page'], $page, $sort_by['by'], $sort_by['sort']);
         
         $this->load->library('pagination');

        $config['base_url']             = base_url();
        $config['total_rows']           = $count;
          
       $config['per_page']             = $row;
        $config['uri_segment']          = 2;
        
        $config['first_link']           = 'First';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';
        $config['last_link']            = 'Last';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';

        $config['full_tag_open']        = '<nav class="page-nav"><div class=""><ul class="menu1">';
        $config['full_tag_close']       = '</ul></div></nav>';
        $config['cur_tag_open']         = '<li class="active"><a href="#">';
        $config['cur_tag_close']        = '</a></li>';
        
        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';
        
        $config['prev_link']            = 'Prev';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';

        $config['next_link']            = 'Next';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';
        
        $this->pagination->initialize($config); */

		//$this->show->pe($data);


		$this->load->view('category', $data);

	}

	

	function product($id)
	{
        $data['special_pages']          = $this->Page_model->get_page('9'); 

        ////////////////product view section start/////////////
        if(isset($_POST['productID']))
        {
        $product 			            = $this->Product_model->get_product($id);
        $viewed 			            = $product->viewed;
        $save['id'] 		            = $id;
        $save['viewed']		            = $viewed + 1;
        $this->Product_model->save($save);
        }
		////////////////product view section end///////////// 
		
		//get the product
         
        $data['product']		        = $this->Product_model->get_product($id);
        //$this->show->pe($data['product']);
		

		$data['product_tabs']	        = $this->Product_model->get_all_products_tabs($id);

		//echo $id;exit;

		

		

		if(!$data['product'] || $data['product']->enabled==0)

		{

			show_404();

		}

		

		$data['base_url']			= $this->uri->segment_array();

		

		// load the digital language stuff

		$this->lang->load('digital_product');

		

		$data['options']	= $this->Option_model->get_product_options($data['product']->id);

		

		//$related			= 
         $data['related']    = $data['product']->related_products; 
          //$this->show->pe($data['related']);
		

		



				

		$data['posted_options']	= $this->session->flashdata('option_values');



		$data['page_title']			= $data['product']->name;

		$data['meta']				= $data['product']->meta;
		
		$data['meta_key']			= $data['product']->meta_key;
		
		$data['seo_title']			= (!empty($data['product']->seo_title))?$data['product']->seo_title:$data['product']->name;
        

		//$this->show->pe($data);
		
		
		//$data['quantities'] 		= $this->session->userdata('quantitty');
		//$data['open'] 				= $this->session->userdata('open');
		

		$this->load->view('courseDetails', $data);

	}
	
	

	

	function add_to_cart()

	{

		// Get our inputs
            // DebugBreak();
		$product_id		= $this->input->post('id');
		$quantity 		= $this->input->post('quantity');
		$post_options 	= $this->input->post('option');
		$slug 			= $this->input->post('slug');
		$option_prices 	= $this->input->post('price_option');
		$option_prices_text	= $this->input->post('price_text');
		$position 			= strpos(strtolower($option_prices_text), 'full');
		if ($position === false)
		{			
			$is_partial = 1;
			
		} else {
			
			$is_partial = 0;
		}
		/*$ip = $_SERVER["REMOTE_ADDR"]; 
   		$country_code = getCountryFromIP($ip);
  
		if(isset($country_code) && $country_code == 'US')
		{
			$option_prices = $this->input->post('price_option') + $this->input->post('price_option')*(0.3);
		}
		else if(isset($country_code) && $country_code == 'GB')
		{
			$option_prices = $this->input->post('price_option') + $this->input->post('price_option')*(0.2);
		}*/
		
		// Get a cart-ready product array

		$product = $this->Product_model->get_cart_ready_product($product_id, $quantity);
		if($product['price_options']!="" && !empty($product['price_options'])){
		//$this->show->pe($product['price_options']);
		unset($product['price']);
		$product['price'] 	= $option_prices;
		$product['on0'] 	= $is_partial;
		
		}
		

		//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.

		if(!$this->config->item('allow_os_purchase') && (bool)$product['track_stock'])
		{
			$stock		= $this->Product_model->get_product($product_id);
			//loop through the products in the cart and make sure we don't have this in there already. If we do get those quantities as well
			$items		= $this->go_cart->contents();
			$qty_count	= $quantity;

			foreach($items as $item)

			{

				if(intval($item['id']) == intval($product_id))

				{

					$qty_count = $qty_count + $item['quantity'];

				}

			}

			

			if($stock->quantity < $qty_count)

			{

				//we don't have this much in stock

				$this->session->set_flashdata('error', sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity));

				$this->session->set_flashdata('quantity', $quantity);

				$this->session->set_flashdata('option_values', $post_options);



				redirect($this->Product_model->get_slug($product_id));

			}

		}



		// Validate Options 

		// this returns a status array, with product item array automatically modified and options added

		//  Warning: this method receives the product by reference

		$status = $this->Option_model->validate_product_options($product, $post_options);

		

		// don't add the product if we are missing required option values

		if( ! $status['validated'])
		{	

			$this->session->set_flashdata('quantity', $quantity);
			$this->session->set_flashdata('error', $status['message']);
			$this->session->set_flashdata('option_values', $post_options);
			redirect($this->Product_model->get_slug($product_id));	

		} else {	

			//Add the original option vars to the array so we can edit it later
			$product['post_options']	= $post_options;

			//is giftcard
			$product['is_gc']			= false;		

			// Add the product item to the cart, also updates coupon discounts automatically
			$this->go_cart->insert($product);
			
			
			// this variable is to view the div of "view cart"			
			$show_things = array('quantitty'=>'1');
			$this->session->set_userdata($show_things);		
			
			// go go gadget cart!
			//echo $this->uri->segment(1);
			redirect('cart/view_cart');

		}

	}

	

	function view_cart()

	{

		

		$data['page_title']	= 'View Cart';

		$data['gift_cards_enabled'] = $this->gift_cards_enabled;

		

		$this->load->view('view_cart', $data);

	}

	

	function remove_item($key)

	{

		//drop quantity to 0

		$this->go_cart->update_cart(array($key=>0));

		

		redirect('cart/view_cart');

	}

	

	function update_cart($redirect = false)

	{
		

		//if redirect isn't provided in the URL check for it in a form field

		if(!$redirect)

		{

			$redirect = $this->input->post('redirect');

		}

		

		// see if we have an update for the cart

		$item_keys		= $this->input->post('cartkey');

		$coupon_code	= $this->input->post('coupon_code');

		$gc_code		= $this->input->post('gc_code');

			

			

		//get the items in the cart and test their quantities

		$items			= $this->go_cart->contents();
		
		$new_key_list	= array();

		//first find out if we're deleting any products

		foreach($item_keys as $key=>$quantity)

		{

			if(intval($quantity) === 0)

			{

				//this item is being removed we can remove it before processing quantities.

				//this will ensure that any items out of order will not throw errors based on the incorrect values of another item in the cart

				$this->go_cart->update_cart(array($key=>$quantity));

			}

			else

			{

				//create a new list of relevant items

				$new_key_list[$key]	= $quantity;

			}

		}

		$response	= array();

		foreach($new_key_list as $key=>$quantity)

		{

			$product	= $this->go_cart->item($key);
			
			//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.

			if(!$this->config->item('allow_os_purchase') && (bool)$product['track_stock'])

			{

				$stock	= $this->Product_model->get_product($product['id']);

			

				//loop through the new quantities and tabluate any products with the same product id

				$qty_count	= $quantity;

				foreach($new_key_list as $item_key=>$item_quantity)

				{

					if($key != $item_key)

					{

						$item	= $this->go_cart->item($item_key);

						//look for other instances of the same product (this can occur if they have different options) and tabulate the total quantity

						if($item['id'] == $stock->id)

						{

							$qty_count = $qty_count + $item_quantity;

						}

					}

				}

				if($stock->quantity < $qty_count)

				{

					if(isset($response['error']))

					{

						$response['error'] .= '<p>'.sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity).'</p>';

					}

					else

					{

						$response['error'] = '<p>'.sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity).'</p>';

					}

				}

				else

				{

					//this one works, we can update it!

					//don't update the coupons yet

					$this->go_cart->update_cart(array($key=>$quantity));

				}

			}

			else

			{

				$this->go_cart->update_cart(array($key=>$quantity));

			}

		}

		

		//if we don't have a quantity error, run the update

		if(!isset($response['error']))

		{

			//update the coupons and gift card code
			
//echo "i ma in the error less section";
			$response = $this->go_cart->update_cart(false, $coupon_code, $gc_code);

			// set any messages that need to be displayed

		}

		else

		{

			$response['error'] = '<p>'.lang('error_updating_cart').'</p>'.$response['error'];

		}

		

		

		//check for errors again, there could have been a new error from the update cart function

		if(isset($response['error']))

		{

			$this->session->set_flashdata('error', $response['error']);

		}

		if(isset($response['message']))

		{

			$this->session->set_flashdata('message', $response['message']);

		}

		

		if($redirect)

		{

			redirect($redirect);

		}

		else

		{

			redirect('cart/view_cart');

		}

	}



	

	/***********************************************************

			Gift Cards

			 - this function handles adding gift cards to the cart

	***********************************************************/

	

	function giftcard()

	{

		if(!$this->gift_cards_enabled) redirect('/');

		

		// Load giftcard settings

		$gc_settings = $this->Settings_model->get_settings("gift_cards");

				

		$this->load->library('form_validation');

		

		$data['allow_custom_amount']	= (bool) $gc_settings['allow_custom_amount'];

		$data['preset_values']			= explode(",",$gc_settings['predefined_card_amounts']);

		

		if($data['allow_custom_amount'])

		{

			$this->form_validation->set_rules('custom_amount', 'lang:custom_amount', 'numeric');

		}

		

		$this->form_validation->set_rules('amount', 'lang:amount', 'required');

		$this->form_validation->set_rules('preset_amount', 'lang:preset_amount', 'numeric');

		$this->form_validation->set_rules('gc_to_name', 'lang:recipient_name', 'trim|required');

		$this->form_validation->set_rules('gc_to_email', 'lang:recipient_email', 'trim|required|valid_email');

		$this->form_validation->set_rules('gc_from', 'lang:sender_email', 'trim|required');

		$this->form_validation->set_rules('message', 'lang:custom_greeting', 'trim|required');

		

		if ($this->form_validation->run() == FALSE)

		{

			$data['error']				= validation_errors();

			$data['page_title']			= lang('giftcard');

			$data['gift_cards_enabled']	= $this->gift_cards_enabled;

			$this->load->view('giftcards', $data);

		}

		else

		{

			

			// add to cart

			

			$card['price'] = set_value(set_value('amount'));

			

			$card['id']				= -1; // just a placeholder

			$card['sku']			= lang('giftcard');

			$card['base_price']		= $card['price']; // price gets modified by options, show the baseline still...

			$card['name']			= lang('giftcard');

			$card['code']			= generate_code(); // from the string helper

			$card['excerpt']		= sprintf(lang('giftcard_excerpt'), set_value('gc_to_name'));

			$card['weight']			= 0;

			$card['quantity']		= 1;

			$card['shippable']		= false;

			$card['taxable']		= 0;

			$card['fixed_quantity'] = true;

			$card['is_gc']			= true; // !Important

			$card['track_stock']	= false; // !Imporortant

			

			$card['gc_info'] = array("to_name"	=> set_value('gc_to_name'),

									 "to_email"	=> set_value('gc_to_email'),

									 "from"		=> set_value('gc_from'),

									 "personal_message"	=> set_value('message')

									 );

			

			// add the card data like a product

			$this->go_cart->insert($card);

			

			redirect('cart/view_cart');

		}

	}
	
	
	function review()
	{
		$this->load->model('Product_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		//$this->form_validation->set_rules('rating', 'Rating', 'trim|required');
		$this->form_validation->set_rules('review', 'Review', 'trim|required');
		if($this->form_validation->run() == false)
		{
			//echo "i am in there"; exit;
					$open = array('open'=>'1');
					$this->session->set_userdata($open);
			redirect($this->input->post('slug'));
		}
		else
		{
			$save['name']			= $this->input->post('name');
			$save['email']			= $this->input->post('email');
			$save['product_id']		= $this->input->post('product_id');
			$save['review']			= $this->input->post('review');
			$save['rating']			= $this->input->post('rating');
			$this->Product_model->save_rating($save);
					$open = array('open'=>'1');
					$this->session->set_userdata($open);
			redirect($this->input->post('slug'));
			
		}
		
		
	}
	
	function question()
	{
		//echo $this->input->post('product_id')."<br/>";
		//echo $this->input->post('question'); exit;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		if($this->form_validation->run() == false)
		{
			$open = array('open'=>'1');
			$this->session->set_userdata($open);
			redirect($this->input->post('slug'));
		}
		else
		{
			$save['product_id']			= $this->input->post('product_id');
			$save['question']			= $this->input->post('question');
			$this->Product_model->save_question($save);
			
			$open = array('open'=>'1');
			$this->session->set_userdata($open);
			redirect($this->input->post('slug'));
			
		}
		
	}
	
	function send_request_mail() {
		
		
		//echo '<pre>';print_r($_REQUEST);exit;
		if(!empty($_REQUEST['Name']) && !empty($_REQUEST['Email']) && !empty($_REQUEST['Telephone'])) 
		{
		
			$message .= '<tr><td>Dear Admin! There is a Query regarding Course information for '.str_replace("%20", " ", $_REQUEST['course']).' from:  <br><br>Name: '.$_REQUEST['Name'].'<br>Email: '.$_REQUEST['Email'].'<br>Tel: '.$_REQUEST['Telephone'].'</td></tr>';
			$this->load->library('email');			
			$config['mailtype'] = 'html';			
			$this->email->initialize($config);	
			$this->email->from($_REQUEST['Email'].': UK-OPEN-COLLEGE');			
			$this->email->to('info@ukopencollege.co.uk');
			$this->email->bcc($this->config->item('bcc_email'));			
			$this->email->subject('Course Info Inquiry');
			$this->email->message(html_entity_decode($message));			
			$this->email->send();
			//$hh = $this->email->print_debugger();
			//echo '<pre>'; print_r($hh);exit;
			$this->session->set_flashdata('message', sprintf( lang('registration_thanks'), $this->input->post('firstname') ) );				
		}
		
		
		 redirect($_SERVER['HTTP_REFERER']);	
	}
	
	function cvv_page()
	{
		$this->load->view('cvv_info');
	}

}
