<?php
class Reports extends Admin_Controller {    

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
		$this->load->helper('form');		
        /*** Get User Info***/
		
		/*** Left Menu Selection ***/
		$this->session->set_userdata('active_module', 'report');
		/*** Left Menu Selection ***/
		
		$this->auth->check_access($this->admin_access, true);  
        
		if($this->admin_access=='Admin')
		{
			redirect($this->config->item('admin_folder'));
		}
		
		$this->load->model(array('Customer_model', 'Product_model', 'Product_model', 'Category_model'));
		$this->load->model('Commission_model');
		
    }
	
	function product_purchased()
	{
		
		//echo "i am in the function"; exit;
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/product_purchased');
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	

    /*function index($page=0)
    {
		$rows = 5;
		$order_by='comm_level';
		$direction='ASC';
       	$data['category'] 		= $this->Category_model->get_all_categories();
		$data['courses'] 		= $this->Product_model->get_all_products_array();
		$data['admins']			= $this->auth->get_admin_list();
		
		
		$data['commissions'] = $this->Commission_model->get_commissions($rows, $page, $order_by='comm_level', $direction='ASC');
		//$count = $this->Commission_model->commission_count();
		//echo $count; exit;
		$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/commission/index/';
		$config['total_rows']		= $this->Commission_model->commission_count();
		
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
		//$data['sort_order']		= $sort_order;
		
        $this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/commission_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');

    }
	
	function form($id = false)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['id'] 				= $id;
		$data['comm_level_id'] 		= '';
		$data['comm_level'] 		= '';
		$data['comm_rate']			= '';
		$data['comm_rate_mode']		= '';
		$data['comm_active']		= '';
		
		
				
		if($id)
		{
			
			$commission				= $this->Commission_model->get_commission($id);
			//print_r($message);exit;
			
			if(!$commission)
			{
				//forum does not exist
				$this->session->set_flashdata('error', lang('error_forum_not_found'));
				redirect($this->config->item('admin_folder').'/commission_form/'.$topic_id);
			}
			
			
			//set values to db values
			$data['id']					= $commission->comm_id;
			$data['comm_level_id']		= $commission->comm_level_id;			
			$data['comm_level']			= $commission->comm_level;
			$data['comm_rate_mode']		= $commission->comm_rate_mode;
			$data['comm_rate']			= $commission->comm_rate;
				
		}
		//echo '--'.$message_mode;exit;
		
		
		
		$this->form_validation->set_rules('comm_rate', 'Commission Rate', 'required');
		
		
		if($this->form_validation->run() == false)
		{
				
			$this->load->view($this->config->item('admin_folder').'/includes/header');
			$this->load->view($this->config->item('admin_folder').'/includes/leftbar');
			$this->load->view($this->config->item('admin_folder').'/commission_form', $data);
			$this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		}
		else
		{
			$save['comm_id']			= $data['id'];
			$save['comm_level_id']		= $this->input->post('comm_level_id');
			$save['comm_level'] 		= $this->input->post('comm_level');
			$save['comm_rate_mode'] 	= $this->input->post('comm_rate_mode');
			$save['comm_rate']			= $this->input->post('comm_rate');
			$save['comm_active']		= 'Yes';	
			
			//save the forum
			$commission	= $this->Commission_model->save($save);
			$this->session->set_flashdata('message', lang('message_saved_forum'));
			
			//go back to the forum list
			redirect($this->config->item('admin_folder').'/commission/');
		}
	}
	
	function ajax_commission_levels()
	{
		//echo $_POST['level_value'];
		if($_POST['level_value'] == 'course_provider')
		{
			$admins		= $this->auth->get_admin_list();
		
			echo '<select data-placeholder="Choose Multiple Categories" class="chzn-select span12" name="comm_level_id"  tabindex="5"><option>Select Option</option>';
			foreach($admins as $admin){
		
			?>	
				<option value="<?=$admin->id?>"><?=$admin->firstname.' '.$admin->lastname?></option>
			<?	
			
			}
			echo  '</select>';		
		}
		else if($_POST['level_value'] == 'cat_level')
		{
			$categories	= $this->Category_model->get_all_categories();
			
			echo '<select data-placeholder="Choose Multiple Categories" class="chzn-select span12" name="comm_level_id"  tabindex="5"><option>Select Option</option>';
			foreach($categories as $categorie){
		
			?>	
				<option value="<?=$categorie['id']?>"><?=$categorie['name']?></option>
			<?	
			
			}
			echo  '</select>';		
		}		
		else if($_POST['level_value'] == 'course_level')
		{
			$products	= $this->Product_model->get_products();
			echo '<select data-placeholder="Choose Multiple Categories" class="chzn-select span12" name="comm_level_id"  tabindex="5"><option>Select Option</option>';
			foreach($products as $product){
		
			?>	
				<option value="<?=$product->id?>"><?=$product->name?></option>
			<?	
			
			}
			echo  '</select>';	
		}
		else
		{
			echo '<select data-placeholder="Choose Multiple Categories" class="chzn-select span12" name="comm_level_id"  tabindex="5">
			<option>Select Option</option>
			</select>';
		
		}
	}
	
	function delete($id)
	{			
		$this->Commission_model->delete($id);
		//go back to the commission list
		redirect($this->config->item('admin_folder').'/commission/');
	}
	function search_commisssion()
	{
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
		
		$data['commissions']  = $this->Commission_model->search_commission($search);
		
		
		//$this->show->pe($data['commissions']);
		//exit;
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/commission_listing', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
		
		//$this->show->pe($search);
		
		// exit;
		
	}*/
}
?>