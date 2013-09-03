<?php

class Categories extends Admin_Controller {
	
	
		
	
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
		$this->lang->load('category');
		$this->load->model('Category_model');		
		
		
	}
	
	function index($order_by="name", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		
		//Store the sort term
		$data['order_by']	= $order_by;
		$data['sort_order']	= $sort_order;
		$data['code']		= $code;
		$term				= false;
		//we're going to use flash data and redirect() after form submissions to stop people from refreshing and duplicating submissions
		//$this->session->set_flashdata('message', 'this is our message');
		$data['page_title']	= lang('categories');   
		$data['categories']	= $this->Category_model->get_categories_tierd($parent = false, array('order_by'=>$order_by, 'sort_order'=>$sort_order, 'rows'=>$rows, 'page'=>$page));
		 
		$data['total']		= count($this->Category_model->get_all_categories());
		
		$this->load->library('pagination');		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/categories/index/'.$order_by.'/'.$sort_order.'/'.$code.'/');
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
		$this->load->view($this->config->item('admin_folder').'/categories', $data);
		$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		
	}
	
	//basic category search
	function category_autocomplete()
	{
		$name	= trim($this->input->post('name'));
		$limit	= $this->input->post('limit');
		
		if(empty($name))
		{
			echo json_encode(array());
		}
		else
		{
			$results	= $this->Category_model->category_autocomplete($name, $limit);
			
			$return		= array();
			foreach($results as $r)
			{
				$return[$r->id]	= $r->name;
			}
			echo json_encode($return);
		}
		
	}
	
	function organize($id = false)
	{
		$this->load->helper('form');
		$this->load->helper('formatting');
		
		if (!$id)
		{
			$this->session->set_flashdata('error', lang('error_must_select'));
			redirect($this->config->item('admin_folder').'/categories');
		}
		
		$data['category']		= $this->Category_model->get_category($id);
		//if the category does not exist, redirect them to the category list with an error
		if (!$data['category'])
		{
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/categories');
		}
			
		$data['page_title']		= sprintf(lang('organize_category'), $data['category']->name);
		
		$data['category_products']	= $this->Category_model->get_category_products_admin($id);
		
		$this->load->view($this->config->item('admin_folder').'/organize_category', $data);
	}
	
	function process_organization($id)
	{
		$products	= $this->input->post('product');
		$this->Category_model->organize_contents($id, $products);
	}
	
	function form($id = false)
	{
       //echo $this->input->post('google_follow'); exit;
		
		/*$this->show->pe($_FILES);
        exit;  */
		$config['upload_path']		= 'uploads/images/full';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['max_width']		= '2048';
		$config['max_height']		= '2048';
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		
		
		$this->category_id	= $id;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['categories']		= $this->Category_model->get_categories();
		$data['page_title']		= lang('category_form');
		
		//default values are empty if the customer is new
		$data['id']				        = '';
		$data['admin_id']		        = '';
		$data['publish_by_admin']		= '0';
		$data['publish_by_super']		= '0';
		$data['name']			        = '';
		$data['old_slug']		        = '';
		$data['slug']			        = '';
		$data['description']	        = '';
		$data['excerpt']		        = '';
		$data['sequence']		        = '';
		$data['image']			        = '';
		$data['img_title']			    = '';
		$data['img_alt']			    = '';
		$data['img_url']			    = '';
		$data['img_des']			    = '';
		$data['seo_title']		        = '';
		$data['meta']			        = '';
		$data['meta_key']		        = '';
		$data['parent_id']		        = 0;
		$data['error']			        = '';
		$data['publish_date']	        = '';
        $data['google_follow']          = '0';
		$data['delete']			        = '';
		
		
		//create the photos array for later use
		$data['photos']		= array();
		
		if ($id)
		{	
			$category		= $this->Category_model->get_category($id);

			//if the category does not exist, redirect them to the category list with an error
			if (!$category)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/categories');
			}
			
			//if the category does not belong to the user, redirect them to the category list with an error
			if($this->admin_access == 'Admin')
			{
				if($category->admin_id!=$this->admin_id)
				{
					$this->session->set_flashdata('error', lang('error_not_found'));
					redirect($this->config->item('admin_folder').'/categories');
				}
			}
			//helps us with the slug generation
			$this->category_name	= $this->input->post('slug', $category->slug);
			
			//set values to db values
			$data['id']				        = $category->id;
			$data['name']			        = $category->name;
			$data['publish_by_admin']		= $category->publish_by_admin;
			$data['publish_by_super']		= $category->publish_by_super;
			if(isset($category->admin_id) && $category->admin_id!='')
			{
				$data['admin_id']		= $category->admin_id;
			}		
			else
			{
				$data['admin_id']		= $this->admin_id;
			}
			$data['old_slug']		= $category->old_route;
			$data['slug']			= $category->slug;
			$data['description']	= $category->description;
			$data['excerpt']		= $category->excerpt;
			$data['sequence']		= $category->sequence;
			$data['parent_id']		= $category->parent_id;
			$data['image']			= $category->image;
			$data['img_title']		= $category->img_title;
			$data['img_alt']		= $category->img_alt;
			$data['img_url']		= $category->img_url;
			$data['img_des']		= $category->img_des;
			$data['seo_title']		= $category->seo_title;
			$data['meta']			= $category->meta;
			$data['meta_key']		= $category->meta_key;
			$data['publish_date']	= date('Y-m-d H:h:i');	
            $data['google_follow']  = $category->google_follow;
			$data['delete']			= $category->delete;	
			
		}
		
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('old_slug', 'old_slug', 'trim');
		$this->form_validation->set_rules('slug', 'lang:slug', 'trim');
		$this->form_validation->set_rules('description', 'lang:description', 'trim');
		$this->form_validation->set_rules('excerpt', 'lang:excerpt', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'parent_id', 'trim');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('img_title', 'Image Title', 'trim');
		$this->form_validation->set_rules('img_alt', 'Image Alt', 'trim');
		$this->form_validation->set_rules('img_url', 'Image URL', 'trim');
		$this->form_validation->set_rules('img_des', 'Image Description', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('meta_key', 'meta_key', 'trim');
		
		
		// validate the form
		if ($this->form_validation->run() == FALSE)
		{
			
			
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/category_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$uploaded	= $this->upload->do_upload('image');
			
			if ($id)
			{
				//delete the original file if another is uploaded
				if($uploaded)
				{
					
					if($data['image'] != '')
					{
						$file = array();
						$file[] = 'uploads/images/full/'.$data['image'];
						$file[] = 'uploads/images/medium/'.$data['image'];
						$file[] = 'uploads/images/small/'.$data['image'];
						$file[] = 'uploads/images/thumbnails/'.$data['image'];
						
						foreach($file as $f)
						{
							//delete the existing file if needed
							if(file_exists($f))
							{
								unlink($f);
							}
						}
					}
				}
				
			}
			else
			{
				if(!$uploaded)
				{
					$error	= $this->upload->display_errors();
					if($error != lang('error_file_upload'))
					{
						$data['error']	.= $this->upload->display_errors();
						$this->load->view($this->config->item('admin_folder').'/category_form', $data);
						return; //end script here if there is an error
					}
				}
			}
          
			 $uploaded = $_POST['media_image'];
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $uploaded;//$image['file_name'];
				  
				$this->load->library('image_lib');
                 // DebugBreak();
				//this is the larger image
				$config['image_library']    = 'gd2';
               // $config['source_image']     = 'uploads/wysiwyg/images/full/'.$save['image'];
				$config['source_image']     = 'uploads/wysiwyg/'.$_POST['image_path'];
				$config['new_image']	    = 'uploads/images/medium/'.$save['image'];
				$config['maintain_ratio']   = TRUE;
				$config['width']            = 600;
				$config['height']           = 500;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				//small image
				$config['image_library']    = 'gd2';
				$config['source_image']     = 'uploads/images/medium/'.$save['image'];
				$config['new_image']	    = 'uploads/images/small/'.$save['image'];
				$config['maintain_ratio']   = FALSE;
				$config['width']            = 356;
				$config['height']           = 240;
				$this->image_lib->initialize($config); 
				$this->image_lib->resize();
				$this->image_lib->clear();

				//cropped thumbnail
				$config['image_library']    = 'gd2';
				$config['source_image']     = 'uploads/images/small/'.$save['image'];
				$config['new_image']	    = 'uploads/images/thumbnails/'.$save['image'];
				$config['maintain_ratio']   = FALSE;
				$config['width']            = 275;
				$config['height']           = 130;
				$this->image_lib->initialize($config); 	
				$this->image_lib->resize();	
				$this->image_lib->clear();
			}
			
			$this->load->helper('text');
			
			//first check the slug field
			$slug 		= $this->input->post('slug');
			$old_slug	= $this->input->post('old_slug');
			
			//if it's empty assign the name field
			if(empty($slug) || $slug=='')
			{
				$slug = $this->input->post('name');
			}
			
			$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
			
			//validate the slug
			$this->load->model('Routes_model');
			if($id)
			{
				$slug	= $this->Routes_model->validate_slug($slug, $category->route_id);
				$route_id	= $category->route_id;
			}
			else
			{
				$slug	= $this->Routes_model->validate_slug($slug);
				
				$route['slug']			= $slug;
				$route['old_route']		= $old_slug;
				$route_id	= $this->Routes_model->save($route);
			}
			
			$save['id']				= $id;			
			$save['name']			= $this->input->post('name');
			if(isset($category->admin_id) && $category->admin_id!='')
			{
				$save['admin_id']		= $category->admin_id;
			}		
			else
			{
				$save['admin_id']		= $this->admin_id;
			}
			/*$save['publish_by_admin']		= '0';
			$save['publish_by_super']		= '0';*/
             if($this->input->post('google_follow')==""){$google ='0';}
             else{$google = trim($this->input->post('google_follow'));}
               
			$save['description']	= $this->input->post('description');
			$save['excerpt']		= $this->input->post('excerpt');
			$save['parent_id']		= intval($this->input->post('parent_id'));
			$save['sequence']		= intval($this->input->post('sequence'));
			$save['img_title']		= $this->input->post('img_title');
			$save['img_alt']		= $this->input->post('img_alt');
			$save['img_url']		= $this->input->post('img_url');
			$save['img_des']		= $this->input->post('img_des');
			$save['seo_title']		= $this->input->post('seo_title');
			$save['meta']			= $this->input->post('meta');
			$save['meta_key']		= $this->input->post('meta_key');
			$save['route_id']		= intval($route_id);
			$save['slug']			= $slug;
			$save['old_route']		= $old_slug;
			$save['publish_date']	= date('Y-m-d H:h:i');
            $save['google_follow']  =  $google;
			$save['delete']			= '0';
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
			
			$category_id	= $this->Category_model->save($save);
			
			//save the route
			$route['id']			= $route_id;
			$route['slug']			= $slug;
			$route['old_route']		= $old_slug;
			$route['route']	= 'cart/category/'.$category_id.'';
			
			$this->Routes_model->save($route);
			
			$this->session->set_flashdata('message', lang('message_category_saved'));
			
			//go back to the category list
			redirect($this->config->item('admin_folder').'/categories');
		}
	}

	function delete($id)
	{
		
		$category	= $this->Category_model->get_category($id);
		//if the category does not exist, redirect them to the customer list with an error
		if ($category)
		{
			$this->load->model('Routes_model');
			
			$this->Routes_model->delete($category->route_id);
			$this->Category_model->delete($id);
			
			$this->session->set_flashdata('message', lang('message_delete_category'));
			redirect($this->config->item('admin_folder').'/categories');
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_not_found'));
		}
	}
	
	
	function trash($id)
	{
		
		$category	= $this->Category_model->get_category($id);
		//if the category does not exist, redirect them to the category list with an error
		if (!$category)
		{
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/categories');
		}
		
		//if the category does not belong to the user, redirect them to the category list with an error
		if($this->admin_access == 'Admin')
		{
			if($category->admin_id!=$this->admin_id)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/categories');
			}
		}
		$trash_status = $this->Category_model->trash($id);
		if($trash_status)
		{
			$this->session->set_flashdata('message', lang('message_trash_category'));
			redirect($this->config->item('admin_folder').'/categories');
			
		}
		
	}
	
	function change_cat_status()
	{
		
		$status 			= $_POST['status'];
		$id 				= $_POST['id'];
		$category 			= array();
		$category['id']		= $id;
		$category_data		= $this->Category_model->get_category($id);
		$email_attributes 	= $this->Settings_model->get_system_email($this->config->item('email_template'));
		
		if($this->admin_access=='Superadmin')
		{
			$category['publish_by_super']	= $status;
			if($status  == '1')
			{
					
					$send_status 			= 'Published and Approved';	
			}
			else
			{
					
					$send_status 			= 'Unpublished';
			}
			
			$this->load->library('email');		
			$config['mailtype'] 		= 'html';		
			$this->email->initialize($config);
			
			$message_category_status .= '<tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;padding-bottom:16px;"><br><p align="left" class="article-title"><singleline label="Title"> Tutor Assigned!</singleline></p><div align="left" ><multiline label="Description"></multiline><br>Category Name: '.$category_data->name.'<br></div></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;" ><div align="left" > This email is to let you know that we have received your request for tutor support and we are working on it to find you an experienced tutor in accordance with your needs. The next step is to decide what features you need in your tutor support. Do you need a 24/7 online support or require partial support?</a>.</div></td></tr><tr><td style="font:12px Normal Arial, Helvetica, sans-serif; color:#3e3f40; line-height:18px;" ><div align="left" >This email is to notify you that your requested course categories have been '.$send_status.' by the site admin.<br>Student Support can be accessed via e-mail: <a href="mailto:info@ukopencollege.co.uk">info@ukopencollege.co.uk</a>.</div></td></tr></tbody></table></td></tr>';
			
			$this->email->from($this->config->item('email'), $this->config->item('company_name'));		
			$this->email->to($this->admin_email);
			$this->email->bcc($this->config->item('bcc_email'));		
			$this->email->subject('Category Approval Status');
			$this->email->message(html_entity_decode($email_attributes[0]['email_header'].$message_category_status.$email_attributes[0]['email_footer']));		
			$this->email->send();	
		}
		else
		{
			$category['publish_by_admin']	= $status;			
		
		}
		
		$this->session->set_flashdata('message', lang('message_category_saved'));
		$category_id						= $this->Category_model->save($category);
		return true;
		
	}
	
}
