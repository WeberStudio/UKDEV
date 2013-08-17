<?php
class Products extends Admin_Controller {	
	
	private $use_inventory = false;
	
	function __construct()
	{		
		parent::__construct();
		remove_ssl();

		/*** Get User Info***/
		//$admin_info = $this->admin_session->userdata('admin');
		$user_info = $this->auth->admin_info();
		$this->admin_id = $user_info['id'];
		$this->admin_email = $user_info['email'];
		$this->admin_access = $user_info['access'];
		$this->first_name = $user_info['firstname'];
		$this->last_name = $user_info['lastname'];
		$this->image = $user_info['image'];
		/*** Get User Info***/
		
		// checking admin access start\\
		if($user_info['access'] == "Superadmin")
		{
			$this->auth->check_access('Superadmin', true);
		}
		elseif($user_info['access'] == "Site Admin")
		{
			$this->auth->check_access('Site Admin', true);
		}
		else
		{
			$this->auth->check_access('Course Provider', true);
		}
		// checking admin access end\\
		
		
		/*** Left Menu Selection ***/
		$this->session->set_userdata('active_module', 'categories');
		/*** Left Menu Selection ***/
		
		$this->auth->check_access($this->admin_access, true);	
		$this->load->model('Product_model');
		$this->load->model('Routes_model');
		$this->load->helper('form');
		$this->lang->load('product');
		
		
	}

	function index($order_by="name", $sort_order="ASC", $code=0, $page=0, $rows=30)
	{
        $csv = '';
	    $data['csv_call']             = $this->input->post('csv_call');
        if(!empty($data['csv_call']))
        {
            $csv = '1';
        }
        
		$data['page_title']	= lang('products');
		
		$data['code']		= $code;
		$term				= false;
		$category_id		= false;
		
		//get the category list for the drop menu
		$data['categories']	= $this->Category_model->get_categories_tierd();
		
		$data['admins']			= $this->auth->get_admin_list();
		
		$post				= $this->input->post(null, false);
		$this->load->model('Search_model');
		if($post)
		{
			$term			= json_encode($post);
			$code			= $this->Search_model->record_term($term);
			$data['code']	= $code;
		}
		elseif ($code)
		{
			$term			= $this->Search_model->get_term($code);
		}
		
		//store the search term
		$data['term']		= $term;
		$data['order_by']	= $order_by;
		$data['sort_order']	= $sort_order;		
		$data['products']	= $this->Product_model->products(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order, 'rows'=>$rows, 'page'=>$page) , false , $csv);
		
		//echo $this->db->last_query();exit;
//ho $this->show->pe($data['products']);
		//$this->show->pe($data['products']);
		//total number of products
		$data['total']		= $this->Product_model->products(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order), true);

		
		$this->load->library('pagination');
		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/products/index/'.$order_by.'/'.$sort_order.'/'.$code.'/');
		$config['total_rows']		= $data['total'];
		$config['per_page']			= $rows;
		$config['uri_segment']		= 7;
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
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
		$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
		$this->load->view($this->config->item('admin_folder').'/products', $data);
		$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	
	//basic category search
	function product_autocomplete()
	{
		$name	= trim($this->input->post('name'));
		$limit	= $this->input->post('limit');
		
		if(empty($name))
		{
			echo json_encode(array());
		}
		else
		{
			$results	= $this->Product_model->product_autocomplete($name, $limit);
			
			$return		= array();
			
			foreach($results as $r)
			{
				$return[$r->id]	= $r->name;
			}
			echo json_encode($return);
		}
		
	}
	
	function bulk_save()
	{
		
		
		$products	= $this->input->post('product');
		$remove_products	= $this->input->post('remove_products');
		$courses = $this->input->post('courses');
		
		/*if($remove_products)
		{*/
			if(!empty($courses) && count($courses)>0)
			{
				
				//if the product does not exist, redirect them to the customer list with an error
				foreach($courses as $course)
				{
				
					$product	= $this->Product_model->get_product($course);
					//echo "<pre>";print_r($product);exit;
					if ($product)
					{
		
						// remove the slug
						$this->Routes_model->remove('('.$product->slug.')');
		
						//if the product is legit, delete them
						$this->Product_model->delete_product($course);
		
					}
				}
				redirect($this->config->item('admin_folder').'/products');
			}/*
			else
			{
				$this->session->set_flashdata('remove_product_err',  'Please select atleast one product to remove.');
				redirect($this->config->item('admin_folder').'/products');
			}*/
		//}
		
		if(!$products)
		{
			$this->session->set_flashdata('error',  lang('error_bulk_no_products'));
			redirect($this->config->item('admin_folder').'/products');
		}
				
		foreach($products as $id=>$product)
		{
			$product['id']	= $id;
			
			// Check Admin Enabled
			if($this->admin_access=='Admin')
			{
					
				if($product['enabled'] =='1')
				{
						$product['publish_by_admin']	= '1';
				}
				else
				{
						$product['publish_by_admin']	= '0';
				}		
					
			}		
				
			// Check Superadmin Enabled			
			if($this->admin_access=='Superadmin')
			{
				//echo $this->admin_access.'------'.$product['enabled'];
				if($product['enabled'] =='1')
				{
						$product['publish_by_super']	= '1';	
				}
				else
				{
						$product['publish_by_super']	= '0';
				}
			}
			
			
			$this->Product_model->save($product);
		}
		//exit;
		$this->session->set_flashdata('message', lang('message_bulk_update'));
		redirect($this->config->item('admin_folder').'/products');
	}
	
	function form($id = false, $duplicate = false, $tab_id = false)
	{
		
        //echo $this->input->post('delivery_price'); exit; 
		$data['active_tabid'] = $tab_id; 
		
		//echo"<pre>";print_r($_POST);exit;
		$this->product_id	= $id;		
		$this->load->library('form_validation');
		$this->load->model(array('Option_model', 'Category_model', 'Digital_Product_model'));
		$this->lang->load('digital_product');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$data['all_categories']		= $this->Category_model->get_all_categories();
		$data['all_products']		= $this->Product_model->get_all_products_array();
		$data['all_price_options']	= $this->Product_model->get_price_options();
		$data['all_delivery_option']= $this->Product_model->get_delivery_options();
		
		
		//echo "<pre>";print_r($data['all_categories']);exit;
		//$data['file_list']		= $this->Digital_Product_model->get_list();

		$data['page_title']		= lang('product_form');

		//default values are empty if the product is new
		$data['id']					= '';
		$data['tab_id']				= '';
		$data['admin_id']			= '';
		$data['sku']				= '';
		$data['name']				= '';
		$data['publish_by_admin']	= '0';
		$data['publish_by_super']	= '0';
		$data['old_slug']			= '';
		$data['slug']				= '';
		$data['description']		= '';
		$data['excerpt']			= '';
		$data['price']				= '';
		$data['price_options']		= '';
		$data['delivery_p']			= '';
		$data['saleprice']			= '';
		$data['weight']				= '';
		$data['track_stock'] 		= '';
		$data['seo_title']			= '';
		$data['meta']				= '';
		$data['meta_key']			= '';
		$data['shippable']			= '';
		$data['taxable']			= '';
		$data['fixed_quantity']		= '';
		$data['quantity']			= '';
		$data['enabled']			= '';
        $data['google_follow']      = '0';
		$data['related_products']	= array();
		$data['product_categories']	= array();
		$data['images']				= '';
		$data['img_title']			= '';
		$data['img_alt']			= '';
		$data['img_url']			= '';
		$data['img_des']			= '';

		$data['product_files']		= array();
		$data['prelated']			= '';
		$data['tab_title']			= '';
		$data['tab_content']		= '';
		$data['all_tabs']			= array();

		//create the photos array for later use
		$data['photos']		= array();

		if ($id)
		{	
			// get the existing file associations and create a format we can read from the form to set the checkboxes
			$pr_files 		= $this->Digital_Product_model->get_associations_by_product($id);
			foreach($pr_files as $f)
			{
				$data['product_files'][]  = $f->file_id;
			}
			
			// get product & options data
			
			$data['product_options']	= $this->Option_model->get_product_options($id);			
			$data['all_tabs']			= $this->Product_model->get_all_products_tabs($id);
			$product					= $this->Product_model->get_product($id);
			//echo"<pre>";print_r($data['all_tabs']);exit;
			//if the product does not exist, redirect them to the product list with an error
			if (!$product)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/products');
			}
			
			//if the product does not belong to the user, redirect them to the products list with an error
			if($this->admin_access == 'Admin')
			{
				if($product->admin_id!=$this->admin_id)
				{
					$this->session->set_flashdata('error', lang('error_not_found'));
					redirect($this->config->item('admin_folder').'/products');
				}
			}
			// If tab is edit
			///echo $tab_id;exit;
			if($tab_id)
			{
				$one_tab = $this->Product_model->get_product_tab($tab_id);
				//$this->show->pe($data['one_tab']);
				$data['tab_title']			= $one_tab->tab_title;
				$data['tab_content']		= $one_tab->tab_content;
				$data['tab_id']				= $tab_id;
				
				
			}
			//helps us with the slug generation
			$this->product_name	= $this->input->post('slug', $product->slug);
			
			//set values to db values
			$data['id']					= $id;
			if(isset($product->admin_id) && $product->admin_id!='')
			{
				$data['admin_id']		= $product->admin_id;
			}		
			else
			{
				$data['admin_id']		= $this->admin_id;
			}
			$data['sku']				= $product->sku;
			$data['name']				= $product->name;
			$data['seo_title']			= $product->seo_title;
			$data['meta']				= $product->meta;
			$data['meta_key']			= $product->meta_key;
			$data['old_slug']			= $product->old_route;
			$data['slug']				= $product->slug;
			$data['description']		= $product->description;
			$data['excerpt']			= $product->excerpt;
			$data['price']				= $product->price;
			$data['price_options']		= $product->json_price;
			$data['delivery_p']			= $product->delivery_price;
			 
			$data['saleprice']			= $product->saleprice;
			$data['weight']				= $product->weight;
			$data['track_stock'] 		= $product->track_stock;
			$data['shippable']			= $product->shippable;
			$data['quantity']			= $product->quantity;
			$data['taxable']			= $product->taxable;
			$data['fixed_quantity']		= $product->fixed_quantity;
			$data['enabled']			= $product->enabled;
            $data['google_follow']      = $product->google_follow;
			$data['images']				= $product->images;
			$data['img_title']			= $product->img_title;
			$data['img_alt']			= $product->img_alt;
			$data['img_url']			= $product->img_url;
			$data['img_des']			= $product->img_des;
			$data['publish_by_admin']	= $product->publish_by_admin;
			$data['publish_by_super']	= $product->publish_by_super;
			
			//make sure we haven't submitted the form yet before we pull in the images/related products from the database
			if(!$this->input->post('submit'))
			{
				$data['product_categories']	= $product->categories;
				$data['related_products']	= $product->related_products;
				$data['prelated']			= $product->prelated;
				//$data['images']				= (array)json_decode($product->images);
			}
		}
		
		//if $data['related_products'] is not an array, make it one.
		if(!is_array($data['related_products']))
		{
			$data['related_products']	= array();
		}
		if(!is_array($data['product_categories']))
		{
			$data['product_categories']	= array();
		}
		
		//no error checking on these
		$this->form_validation->set_rules('caption', 'Caption');
		$this->form_validation->set_rules('primary_photo', 'Primary');

		//$this->form_validation->set_rules('sku', 'lang:sku', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta_data', 'trim');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('old_slug', 'old_slug', 'trim');
		$this->form_validation->set_rules('slug', 'lang:slug', 'trim');
		$this->form_validation->set_rules('description', 'lang:description', 'trim');
		$this->form_validation->set_rules('excerpt', 'lang:excerpt', 'trim');
		$this->form_validation->set_rules('price_options', 'lang:price', 'required');
		$this->form_validation->set_rules('enabled', 'lang:enabled', 'trim');
		$this->form_validation->set_rules('meta_key', 'meta_key', 'trim');
		$this->form_validation->set_rules('img_title', 'Image Title', 'trim');
		$this->form_validation->set_rules('img_alt', 'Image Alt', 'trim');
		$this->form_validation->set_rules('img_url', 'Image URL', 'trim');
		$this->form_validation->set_rules('img_des', 'Image Description', 'trim');
		/*
		if we've posted already, get the photo stuff and organize it
		if validation comes back negative, we feed this info back into the system
		if it comes back good, then we send it with the save item
		
		submit button has a value, so we can see when it's posted
		*/
		
		if($duplicate)
		{
			$data['id']	= false;
		}
		if($this->input->post('submit'))
		{
			//reset the product options that were submitted in the post
			$data['product_options']	= $this->input->post('option');
			$data['related_products']	= $this->input->post('related_products');
			$data['product_categories']	= $this->input->post('categories');
			$data['images']				= $this->input->post('images');
			$data['product_files']		= $this->input->post('downloads');
			
		}
		
		//$this->show->pe($_POST);
		if ($this->form_validation->run() == FALSE)
		{
			//$this->show->pe($data['product_categories']);
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/product_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
			
			
		}
		else
		{
			$this->load->helper('text');
			
			//first check the slug field
			$slug = $this->input->post('slug');
			$old_slug	= $this->input->post('old_slug');
			//if it's empty assign the name field
			if(empty($slug) || $slug=='')
			{
				$slug = $this->input->post('name');
			}
			
			$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
			
			//validate the slug
			if($id)
			{
				$slug		= $this->Routes_model->validate_slug($slug, $product->route_id);
				$route_id	= $product->route_id;
			}
			else
			{
				$slug	= $this->Routes_model->validate_slug($slug);
				
				$route['slug']	= $slug;
				$route['old_route']		= $old_slug;	
				$route_id	= $this->Routes_model->save($route);
			}
			
			// Upload Image
			//if(!empty($_FILES['image']['name']))
            $uploaded = $_POST['media_image'];
            if($uploaded)
			{
				
				$save['images']	 = $this->product_image_upload($_POST['image_path'], $uploaded);
                $save['images']  = $uploaded;
			}

			$save['id']					= $id;
			if(isset($product->admin_id) && $product->admin_id!='')
			{
				$save['admin_id']		= $product->admin_id;
			}		
			else
			{
				$save['admin_id']		= $this->admin_id;
			}
			
			// Check Admin Enabled
			if($this->admin_access=='Admin')
			{
					
				if($this->input->post('enabled')=='on')
				{
						$save['publish_by_admin']	= '1';
				}
				else
				{
						$save['publish_by_admin']	= '0';
				}		
					
			}		
				
			// Check Superadmin Enabled
			
			if($this->admin_access=='Superadmin')
			{
				if($this->input->post('enabled')=='on')
				{
						$save['publish_by_super']	= '1';	
				}
				else
				{
						$save['publish_by_super']	= '0';
				}
			}
            
            if($this->input->post('google_follow')==""){$google ='0';}
             else{$google = trim($this->input->post('google_follow'));}
			 
			$save['sku']				= $this->input->post('sku');
			$save['name']				= $this->input->post('name');
			$save['img_title']			= $this->input->post('img_title');
			$save['img_alt']			= $this->input->post('img_alt');
			$save['img_url']			= $this->input->post('img_url');
			$save['img_des']			= $this->input->post('img_des');
			$save['seo_title']			= $this->input->post('seo_title');
			$save['meta']				= $this->input->post('meta');
			$save['meta_key']			= $this->input->post('meta_key');
			$save['description']		= $this->input->post('description');
			$save['excerpt']			= $this->input->post('excerpt');
			//$save['price']				= $this->input->post('price');
			$save['saleprice']			= $this->input->post('saleprice');
			$save['delivery_price']		= $this->input->post('delivery_price');
			$save['weight']				= $this->input->post('weight');
			$save['track_stock']		= $this->input->post('track_stock');
			$save['fixed_quantity']		= $this->input->post('fixed_quantity');
			$save['quantity']			= $this->input->post('quantity');
			$save['shippable']			= $this->input->post('shippable');
			$save['taxable']			= $this->input->post('taxable');
            $save['google_follow']      = $google;
			$save['old_route']			= $old_slug;
			$post_images				= $this->input->post('images');
			
			if(!empty($post_images))
			{
			
			}
			
			$save['slug']				= $slug;
			$save['route_id']			= $route_id;
			//echo '<pre>';print_r($save);exit;
			
			
			if($this->input->post('related_products'))
			{
				$save['related_products'] = json_encode($this->input->post('related_products'));
			}
			else
			{
				$save['related_products'] = '';
			}
			
			if($this->input->post('price_options'))
			{
				$save['price_options'] = json_encode($this->input->post('price_options'));
			}
			else
			{
				$save['price_options'] = '';
			}
			
			//save categories
			$categories			= $this->input->post('categories');
			if(!$categories)
			{
				$categories	= array();
			}
			
			// format options
			$options	= array();
			if($this->input->post('option'))
			{
				foreach ($this->input->post('option') as $option)
				{
					$options[]	= $option;
				}

			}
			
			$tab_title			= $this->input->post('tab_title');
			$tab_content		= $this->input->post('tab_content');
			$tab_id				= $this->input->post('tab_id');
			$tabs = array();
			if(!empty($tab_title))
			{
				
				if(!empty($tab_id))
				{
					
					$tabs = array('tab_id'=>$tab_id, 'product_id'=>$id, 'admin_id'=>$save['admin_id'], 'tab_title'=>$tab_title,'tab_content'=>$tab_content);
				}
				else
				{
					$tabs = array('product_id'=>$id, 'admin_id'=>$save['admin_id'], 'tab_title'=>$tab_title,'tab_content'=>$tab_content);
				}
			}
			//$this->show->pe($tabs);
			//echo '<pre>';print_r($tabs);exit;
			//save product 
			//$this->show->pe($_POST);
			$product_id	= $this->Product_model->save($save, $options, $categories, $tabs);
			
				

			//save the route
			$route['id']	= $route_id;
			$route['slug']	= $slug;
			$route['old_route']		= $old_slug;
			$route['route']	= 'cart/product/'.$product_id;
			
			$this->Routes_model->save($route);
			
			$this->session->set_flashdata('message', lang('message_saved_product'));

			//go back to the product list
			if($id!="")
			{
				redirect($this->config->item('admin_folder').'/products/form/'.$id);
			}
			if($id=="")
			{
				redirect($this->config->item('admin_folder').'/products/form/');
			}
			
		}
	}
	
	function product_image_form()
	{
		$data['file_name'] = false;
		$data['error']	= false;
		$this->load->view($this->config->item('admin_folder').'/iframe/product_image_uploader', $data);
	}
	
	function product_image_upload($path_image, $image_name)
	{
		
		//$this->show->pe($_FILES);
		$file_name = '';
		$config['upload_path']		= 'uploads/images/full';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['max_width']		= '2048';
		$config['max_height']		= '2048';
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		
		if ($path_image)
		{
			
			$upload_data	= $this->upload->data();
			
			$this->load->library('image_lib');
			/*
			
			I find that ImageMagick is more efficient that GD2 but not everyone has it
			if your server has ImageMagick then you can change out the line
			
			$config['image_library'] = 'gd2';
			
			with
			
			$config['library_path']		= '/usr/bin/convert'; //make sure you use the correct path to ImageMagic
			$config['image_library']	= 'ImageMagick';
			*/			
			
			//this is the larger image
			$config['image_library'] = 'gd2';
			$config['source_image'] = 'uploads/wysiwyg/'.$path_image;
			$config['new_image']	= 'uploads/images/medium/'.$image_name;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 600;
			$config['height'] = 500;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

			//small image
			$config['image_library'] = 'gd2';
			$config['source_image'] = 'uploads/images/medium/'.$image_name;
			$config['new_image']	= 'uploads/images/small/'.$image_name;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 300;
			$config['height'] = 300;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();

			//cropped thumbnail
			$config['image_library'] = 'gd2';
			$config['source_image'] = 'uploads/images/small/'.$image_name;
			$config['new_image']	= 'uploads/images/thumbnails/'.$image_name;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 70;
			$config['height'] = 70;
			$this->image_lib->initialize($config); 	
			$this->image_lib->resize();	
			$this->image_lib->clear();

			$file_name	= $upload_data['file_name'];
		}
		
		if($this->upload->display_errors() != '')
		{
			 $data['error'] = $this->upload->display_errors();
		}
		return $file_name;
		
		//$this->load->view($this->config->item('admin_folder').'/iframe/product_image_uploader', $data);
	}
	
	function download_csv_template()
	{
		$this->load->helper('download_helper');
		//echo realpath('.');exit;
		$donwload_path = realpath('.').'/downloads/oc_courses.csv';
		$data = file_get_contents($donwload_path); // Read the file's contents
		$name = 'courses_upload_template.csv';
		force_download_content($name, $data);
		//redirect($this->config->item('admin_folder').'/products');
	}
	
	function save_bulk_products()
	{
		$status = "";
		$msg = "";
		$data = array();
		$array_missing_field = array();
		$filename = $_FILES['product_file']['name'];
		$filename = $this->admin_id.'_'.time().preg_replace('/\s/', '_', $filename);
		
	   	$this->load->library('upload');
		$this->load->library('getcsv');
		$config['file_name'] = $filename; 
		$config['upload_path'] = 'uploads'; 
		$config['allowed_types'] = 'csv';
		$config['max_size']  = 1024 * 8;
		//$config['encrypt_name'] = TRUE;
		$this->upload->initialize($config);
		$name = 'product_file';
		$retrive_data = $this->upload->do_upload($name);
		if (!$retrive_data)
		{
			
			$this->session->set_flashdata('file_error', $this->upload->display_errors());
			redirect($this->config->item('admin_folder').'/products');
		}
		else
		{
			$data = $this->upload->data();
			$data = $this->getcsv->set_file_path(realpath(".").'/uploads/'.$filename)->get_array();
			if(!isset($data) || empty($data)) // IF File Is Empty
			{
					$this->session->set_flashdata('file_error', 'There is no product in uploaded template.');
					redirect($this->config->item('admin_folder').'/products');
			}
			else // IF File Is Not Empty
			{
				 
				 
				 if($this->is_asso($data)=='0') //IF File Does Not Mach With Template
				 {
					$this->session->set_flashdata('file_error', 'File does not match with given template.');
					redirect($this->config->item('admin_folder').'/products');
				 }
				 else // IF File Have Correct Data
				 {
					$count_products = count($data);
					
					for($i = 0; $i<$count_products; $i++)
					{
						if(empty($data[$i]['name']) || empty($data[$i]['price'])) // IF Two Fields Empty
						{
							$j = $i;
							$array_missing_field[] = 'Product number '.($j+1). ' please check either product name or price is missing.';
							$j = 0;
						}		
						else
						{
							$this->save_bulk_products_each($data[$i]);
						}					
					}
					if(!empty($array_missing_field))
					{
						$this->session->set_flashdata('upload_error', $array_missing_field);					
					}
					//echo '<pre>';print_r($array_missing_field);exit;
				 }
			}		
			//echo '<pre>';print_r($data);exit;
			//echo  'good';
		} 
		redirect($this->config->item('admin_folder').'/products');      
	}
	
	
	
	function is_asso($array){
    	
		$default_array = array(
								"0" => "name",								
								"1" => "slug",
								"2" => "description",
								"3" => "excerpt",
								"4" => "price",
								"5" => "seo_title",
								"6" => "meta",
								"7" => "enabled",
								"8" => "category_id");
		
		foreach($array as $key => $val)
		 {
		 	$values = array_keys($val);
			//echo '<pre>';print_r($values);
			if(!array_diff($values, $default_array) && !array_diff($default_array, $values)) 
			{
				return '1';
			}
			else
			{
				return '0';	
			}
		 }
    	
	}
	
	function  save_bulk_products_each($course_data)
	{
		
			$this->load->helper('text');
			
			//first check the slug field
			$slug = $course_data['slug'];
			//echo '<pre>';print_r($course_data);
			if(empty($slug) || $slug=='')
			{
				$slug = $course_data['name'];
			}
			
			$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
			
			//validate the slug
			

			$slug	= $this->Routes_model->validate_slug($slug);
			$route['slug']	= $slug;	
			$route_id	= $this->Routes_model->save($route);
			
			
			$save['name']				=  $course_data['name'];
			$save['slug']				=  $slug;
			$save['description']		=  $course_data['description'];
			$save['excerpt']			=  $course_data['excerpt'];
			$save['price']				=  $course_data['price'];
			//$save['saleprice']			=  $course_data['saleprice'];
			//$save['publish_by']			=  $this->admin_access;
			// Check Admin Enabled
			if($this->admin_access=='Admin')
			{
				if(isset($course_data['enabled']) && !empty($course_data['enabled']))
				{
						$save['publish_by_admin']	= $course_data['enabled'];
				}	
			}		
				
			// Check Superadmin Enabled
			
			if($this->admin_access=='Superadmin')
			{
				if(isset($course_data['enabled']) && !empty($course_data['enabled']))
				{
						$save['publish_by_super']	= $course_data['enabled'];
				}
			}
			$save['seo_title']			=  $course_data['seo_title'];
			$save['meta']				=  $course_data['meta'];
			$save['admin_id']			=  $this->admin_id;
			$save['route_id']			=  $route_id;
			//echo '<pre>';print_r($save);exit;
			
			
			//save categories
			
			$categories = array();
			$categories	= $course_data['category_id'];
			if(!$categories)
			{
				$categories	= array();
			}
			
			// save product 
			$product_id	= $this->Product_model->save_uploaded_bulk_courses($save,'', $categories);
			
			//save the route
			$route['id']	= $route_id;
			$route['slug']	= $slug;
			$route['route']	= 'cart/product/'.$product_id;
			
			$this->Routes_model->save($route);
			
			return true;
	
	}
	
	// SOFT DELETE PRODUCT
	function delete($id = false)
	{
		if ($id)
		{	
			$product	= $this->Product_model->get_product($id);
			//if the product does not exist, redirect them to the customer list with an error
			if (!$product)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/products');
			}
			else
			{

				//if the product is legit, SOFT delete them
				$this->Product_model->soft_delete_product($id);

				$this->session->set_flashdata('message', lang('message_deleted_product'));
				redirect($this->config->item('admin_folder').'/products');
			}
		}
		else
		{
			//if they do not provide an id send them to the product list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/products');
		}
	}
		
	
	function delete_tab($product_id, $tab_id)
	{
	
		$this->Product_model->delete_product_tab($tab_id);
		redirect($this->config->item('admin_folder').'/products/form/'.$product_id);
	}
	
	/*****************************************************
	*	Product Price Options
	*
	*/
	
	function price_options_form($page=0 , $id = false)
	{
		
		
		$rows = 5;		
		$this->session->set_userdata('active_module', 'price');	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$data['all_price_options']	= $this->Product_model->get_price_options($rows , $page);
		
		//$count = $this->Product_model->price_count();
		//echo $count; exit;
		
		
		$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/products/price_options_form/';
		$config['total_rows']		= $this->Product_model->price_count();
		
		$config['per_page']			= $rows;
		
		$config['uri_segment']		= 4;
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
		//$data['sort_by']		= $sort_by;
		//$data['sort_order']	= $sort_order;
		
		
		
		
		//print_r($data['all_price_options']);exit;
		$data['id'] 				= $id;
		$data['option_text'] 		= '';
		$data['option_price'] 		= '';
				
		if($id)
		{
			
			$price_options				= $this->Product_model->get_price_option($id);
			//print_r($price_options);exit;
			
			if(!$price_options)
			{
				//forum does not exist
				$this->session->set_flashdata('error', lang('error_forum_not_found'));
				redirect($this->config->item('admin_folder').'/products/price_options_form/'.$page.'/'.$id);
			}
			
			
			//set values to db values
			$data['id'] 				= $id;
			$data['option_text'] 		= $price_options->p_option_title;
			$data['option_price'] 		= $price_options->p_option_price;
			
		}
		//echo '--'.$message_mode;exit;
		
		
		
		$this->form_validation->set_rules('option_text', 'Option Text', 'required');
		$this->form_validation->set_rules('option_price','Option Trice', 'required');
		
		if($this->form_validation->run() == false)
		{
				
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/price_options_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$save['p_option_id']		= $data['id'];
			$save['admin_id']			= $this->admin_id;
			$save['p_option_title']		= $this->input->post('option_text');
			$save['p_option_price'] 	= $this->input->post('option_price');
			
			
			//save the forum
			$price_options	= $this->Product_model->product_options_save($save);
			$this->session->set_flashdata('message', lang('message_saved_forum'));
			
			//go back to the forum list
			redirect($this->config->item('admin_folder').'/products/price_options_form/');
		}
	
		
	
	}
	
	function delete_price_option($id)
	{
	
		if ($id)
		{			
			$this->Product_model->delete_price_option($id);
			$this->session->set_flashdata('message', 'Deleted Successfully!');
			redirect($this->config->item('admin_folder').'/products/price_options_form/');
		}
			
	}
	
	
	/*****************************************************
	*	Product Delivery Options
	*
	*/
	
	function product_delivery_form($id = false)
	{
				
		$this->session->set_userdata('active_module', 'price');	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$data['all_product_delivery']	= $this->Product_model->get_delivery_options();
		//print_r($data['all_product_delivery']);exit;
		$data['id'] 				= $id;
		$data['d_option_title'] 	= '';
		$data['d_option_price'] 	= '';
				
		if($id)
		{
			
			$product_delivery				= $this->Product_model->get_delivery_option($id);
			//print_r($product_delivery);exit;
			
			if(!$product_delivery)
			{
				//forum does not exist
				$this->session->set_flashdata('error', lang('error_forum_not_found'));
				redirect($this->config->item('admin_folder').'/products/product_delivery_form/'.$id);
			}
			
			
			//set values to db values
			$data['id'] 				= $id;
			$data['d_option_title'] 	= $product_delivery->d_option_title;
			$data['d_option_price'] 	= $product_delivery->d_option_price;
			
		}
		//echo '--'.$message_mode;exit;
		
		
		
		$this->form_validation->set_rules('d_option_title', 'Delivery Text',  'required');
		$this->form_validation->set_rules('d_option_price', 'Delivery Price', 'required');
		
		if($this->form_validation->run() == false)
		{
				
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/product_delivery_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$save['d_option_id']		= $data['id'];
			$save['admin_id']			= $this->admin_id;
			$save['d_option_title']		= $this->input->post('d_option_title');
			$save['d_option_price'] 	= $this->input->post('d_option_price');
			
			
			//save the forum
			$product_delivery	= $this->Product_model->product_delivery_save($save);
			$this->session->set_flashdata('message', lang('message_saved_forum'));
			
			//go back to the forum list
			redirect($this->config->item('admin_folder').'/products/product_delivery_form/');
		}
	
		
	
	}
	
	function delete_delivery_option($id)
	{
	
		if ($id)
		{			
			$this->Product_model->delete_delivery_option($id);
			$this->session->set_flashdata('message', 'Deleted Successfully!');
			redirect($this->config->item('admin_folder').'/products/product_delivery_form/');
		}
			
	}
	
	
	
	
	// HARD DELETE PRODUCT
	
	/*function delete($id = false)
	{
		if ($id)
		{	
			$product	= $this->Product_model->get_product($id);
			//if the product does not exist, redirect them to the customer list with an error
			if (!$product)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/products');
			}
			else
			{

				// remove the slug
				
				$this->Routes_model->remove('('.$product->slug.')');

				//if the product is legit, delete them
				$this->Product_model->delete_product($id);

				$this->session->set_flashdata('message', lang('message_deleted_product'));
				redirect($this->config->item('admin_folder').'/products');
			}
		}
		else
		{
			//if they do not provide an id send them to the product list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/products');
		}
	}*/
}