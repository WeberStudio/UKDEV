<?php
class Pages extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		remove_ssl();
		
		$user_info = $this->auth->admin_info();
        $this->admin_id = $user_info['id'];
        $this->admin_email = $user_info['email'];
        $this->admin_access = $user_info['access'];
		$this->first_name = $user_info['firstname'];
		$this->last_name = $user_info['lastname'];
		$this->image = $user_info['image'];	
		
		// checking admin access start\\
		if($user_info['access'] == "Superadmin")
		{
			$this->auth->check_access('Superadmin', true);
		}
		else
		{
			$this->auth->check_access('Site Admin', true);
		}
		
		// checking admin access end\\
		
			
		$this->load->helper('formatting_helper');
		//$this->auth->check_access('Admin', true);
		$this->load->model('Page_model');
		$this->lang->load('page');
		$this->session->set_userdata('active_module', 'contents');
	}
		
	function index($page=0)
	{
		$rows = 5;
		$data['pages']		= '';
		$this->load->helper('form');
		$data['page_title']	= lang('pages');
		$data['pages']		= $this->Page_model->get_pages($parent = 0,$rows,$page);
		
		//$count = $this->Page_model->page_count();
		//echo $count; exit;
			$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/pages/index/';
		$config['total_rows']		= $this->Page_model->page_count();
		
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
		//$data['page']			= $page;
		//$data['sort_by']		= $sort_by;
		//$data['sort_order']		= $sort_order;
		
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/pages', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	
	/********************************************************************
	edit page
	********************************************************************/
	function form($id = false)
	{
		
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['pages']			= '';
		$data['id']				= '';
		$data['title']			= '';
		$data['menu_title']		= '';
		$data['old_slug']		= '';
		$data['slug']			= '';
		$data['sequence']		= 0;
		$data['parent_id']		= 0;
		$data['content']		= '';
		$data['image']			= '';
		$data['seo_title']		= '';
		$data['meta']			= '';
		$data['meta_key']		= '';
		
		
		$config['upload_path']		= 'uploads/images/full';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['max_width']		= '1024';
		$config['max_height']		= '768';
		//$config['file_name'] 		= "thumb_";
		$config['overwrite']		= true;
		$config['remove_spaces']	= true;
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);  
		
		
		$data['page_title']	= lang('page_form');
		$data['pages']		= $this->Page_model->get_pages();
		
		if($id)
		{
			
			$page			= $this->Page_model->get_page($id);

			if(!$page)
			{
				//page does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/pages');
			}
			
			
			//set values to db values
			$data['id']				= $page->id;
			$data['parent_id']		= $page->parent_id;
			$data['title']			= $page->title;
			$data['menu_title']		= $page->menu_title;
			$data['sequence']		= $page->sequence;
			$data['content']		= $page->content;
			$data['image']			= $page->image;
			$data['seo_title']		= $page->seo_title;
			$data['meta']			= $page->meta;
			$data['meta_key']		= $page->meta_key;
			$data['old_slug']		= $page->old_route;
			$data['slug']			= $page->slug;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('menu_title', 'lang:menu_title', 'trim');
		$this->form_validation->set_rules('old_slug', 'old_slug', 'trim');
		$this->form_validation->set_rules('slug', 'lang:slug', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('meta_key', 'meta_key', 'trim');
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/page_form', $data);
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
				$slug = $this->input->post('title');
			}
			
			$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
			
			//validate the slug
			$this->load->model('Routes_model');
			if($id)
			{
				$slug		= $this->Routes_model->validate_slug($slug, $page->route_id);
				$route_id	= $page->route_id;
			}
			else
			{
				$slug					= $this->Routes_model->validate_slug($slug);
				$route['slug']			= $slug;
				$route['old_route']		= $old_slug;	
				$route_id		= $this->Routes_model->save($route);
			}
			//==== start image uplode section=====\\
			$save = array();
			$uploaded	= $this->upload->do_upload('image');
			
			if($uploaded != ""){
			if($uploaded == "")
			{
				$error	= $this->upload->display_errors();
				echo $error;
				
			}
			if($uploaded != "")
			{
				$image			= $this->upload->data();
				$save['image']			= $image['file_name'];
			}
			}
			//==== end image uplode section=====\\
			
			
			$save['id']				= $id;
			$save['parent_id']		= $this->input->post('parent_id');
			$save['title']			= $this->input->post('title');
			$save['menu_title']		= $this->input->post('menu_title'); 
			$save['sequence']		= $this->input->post('sequence');
			$save['content']		= $this->input->post('content');
			$save['seo_title']		= $this->input->post('seo_title');
			$save['meta']			= $this->input->post('meta');
			$save['route_id']		= $route_id;
			$save['slug']			= $slug;
			$save['old_route']		= $old_slug;
			$save['meta_key']		= $this->input->post('meta_key');
			//set the menu title to the page title if if is empty
			if ($save['menu_title'] == '')
			{
				$save['menu_title']	= $this->input->post('title');
			}
			
			//save the page
			$page_id	= $this->Page_model->save($save);
			
			//save the route
			$route['id']			= $route_id;
			$route['slug']			= $slug;
			$route['old_route']		= $old_slug;
			$route['route']	= 'cart/page/'.$page_id;
			
			$this->Routes_model->save($route);
			
			$this->session->set_flashdata('message', lang('message_saved_page'));
			
			//go back to the page list
			redirect($this->config->item('admin_folder').'/pages');
		}
	}
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['url']		= '';
		$data['new_window']	= false;
		$data['sequence']	= 0;
		$data['parent_id']	= 0;

		
		$data['page_title']	= lang('link_form');
		$data['pages']		= $this->Page_model->get_pages();
		if($id)
		{
			$page			= $this->Page_model->get_page($id);

			if(!$page)
			{
				//page does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/pages');
			}
			
			
			//set values to db values
			$data['id']			= $page->id;
			$data['parent_id']	= $page->parent_id;
			$data['title']		= $page->title;
			$data['url']		= $page->url;
			$data['new_window']	= (bool)$page->new_window;
			$data['sequence']	= $page->sequence;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->load->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['parent_id']	= $this->input->post('parent_id');
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('title'); 
			$save['url']		= $this->input->post('url');
			$save['sequence']	= $this->input->post('sequence');
			$save['new_window']	= $this->input->post('new_window');
			
			//save the page
			$this->Page_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the page list
			redirect($this->config->item('admin_folder').'/pages');
		}
	}
	
	/********************************************************************
	delete page
	********************************************************************/
	function delete($id)
	{
		
		$page	= $this->Page_model->get_page($id);
		
		if($page)
		{
			$this->load->model('Routes_model');
			
			$this->Routes_model->delete($page->route_id);
			$this->Page_model->delete_page($id);
			$this->session->set_flashdata('message', lang('message_deleted_page'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/pages');
	}
	
	//========== start ====this is for froentend home page text =========//
	function page_text()
	{
		$data['pages']		= '';
		$this->load->helper('form');
		$data['page_title']	= lang('pages');
		$data['pages']		= $this->Page_model->get_page_texts();
		//print_r($this->Page_model->get_page_text()); exit;
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/page_text',$data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	function page_text_form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		
		$data['id']			= '';
		$data['title']		= '';
		$data['content']	= '';
		$data['image']		= '';
		
		$config['upload_path']		= 'uploads/images/full';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['max_width']		= '1024';
		$config['max_height']		= '768';
		//$config['file_name'] 		= "thumb_";
		$config['overwrite']		= true;
		$config['remove_spaces']	= true;
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		
		if($id){
			
		$page		= $this->Page_model->get_page_text($id);
		if($page == "")
		{
			echo "Your Record not found";exit;
		}
		$data['id']				= $page->id;
		$data['title']			= $page->title;
		$data['content']		= $page->content;
		$data['image']			= $page->image;
		}
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('content', 'lang:content', 'trim|required');
		
		if($this->form_validation->run() == false)
		{
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/page_text_form',$data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		
		else
		{
			$uploaded	= $this->upload->do_upload('image');
			
			if($uploaded != "")
			{
			if($uploaded == "")
			{
				$error	= $this->upload->display_errors();
				echo $error;
				
			}
			if($uploaded != "")
			{
				$image			= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			}
			$save['id']			= $id;
			$save['title']		= $this->input->post('title');
			$save['content']	= $this->input->post('content');
			$page_id	= $this->Page_model->save_text($save);
			redirect($this->config->item('admin_folder').'/pages/page_text');
		}
	}
	
	
	function page_text_delete($id)
	{
		if($id!="")
		{
		$this->Page_model->delete_page_text($id);
		redirect($this->config->item('admin_folder').'/pages/page_text');
		}
	}
	//========== end ====this is for froentend home page text =========//
}	