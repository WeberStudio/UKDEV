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
		

		$this->load->model(array('Customer_model', 'Product_model', 'order_model', 'Report_model'));
		
		
    }
	
	function index()
	{
		$data['page_title']		= lang('reports');
		$data['admins']			= $this->auth->get_admin_list();		
		//$data['years']		= $this->Order_model->get_sales_years();
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/sales_report', $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}	
	
	function get_sales_report()
	{
	
		//echo '<pre>'; print_r($_POST);exit;
		$output_html 				= '';
		$data['search_custom'] 		= '';
		$data['start_date']			= '';
		$data['end_date']			= '';
		$data['date_status']		= '';
		$data['payment_method'] 	= '';
		$data['courses_provider'] 	= '';
		$data['date_target'] 		= '';
		$data['print_call'] 		= '';
		$data['csv_call'] 			= '';
		$data['date_status_search'] = '';
		
		
		if(!empty($_POST))
		{
			$data['search_custom'] 		= $this->input->post('search_custom');
			$data['start_date']			= $this->input->post('start_date');
			$data['end_date']			= $this->input->post('end_date');
			$data['date_status']		= $this->input->post('date_status');
			$data['payment_method'] 	= $this->input->post('payment_method');
			$data['courses_provider'] 	= $this->input->post('courses_provider');
			$data['date_target'] 		= $this->input->post('date_target');
			$data['date_status_search'] = $this->input->post('date_status_search');
			$data['print_call'] 		= $this->input->post('print_call');
			$data['csv_call'] 			= $this->input->post('csv_call');
		}
		
		$records = $this->order_model->get_sales_record($data);
		//echo '<pre>'; print_r($records);exit;
		if(!empty($data['csv_call']))
		{
			$this->load->helper('csv');
			query_to_csv($records, TRUE, 'sales_report.csv'); 
		}
		else if(!empty($data['print_call']))
		{
			//echo '<pre>'; print_r($records->result_array());
			$this->load->library('mpdf/mpdf');
			$this->load->library('cezpdf');
			$this->load->helper('pdf');	
			prep_pdf();
			$invoice_footer 	= '';
			$invoice_header 	= '';
			$html_output 		= '';	
			$this->mpdf->SetHeader('{DATE d-m-Y}|{PAGENO}|Sales Record');			 
			$output_array = $records->result_array();			
			$output_html .= '<table width="0" border="0" cellspacing="10" cellpadding="10">
			  <tr>
				<th>Order Number</th>
				<th>Customer Id</th>
				<th>Status</th>
				<th>Tax</th>
				<th>Total</th>
				<th>Subtotal</th>
				<th>Status Message</th>
				<th>Payment Info</th>
				<th>Product Name</th>
			  </tr>';
			  
			  foreach($output_array as $output)
			  {
			  	$output_html .= '<tr>
					<td>'.$output['order_number'].'</td>
					<td>'.$output['customer_id'].'</td>
					<td>'.$output['status'].'</td>
					<td>'.format_currency($output['tax']).'</td>
					<td>'.format_currency($output['total']).'</td>
					<td>'.format_currency($output['subtotal']).'</td>
					<td>'.$output['status_message'].'</td>
					<td>'.$output['payment_info'].'</td>
					<td>'.$output['product_name'].'</td>
				  </tr>';
			  }
			  		  
			$output_html .= '</table>';
			$this->mpdf->SetWatermarkText('UKOPENCOLLEGE', 0.1);
			$this->mpdf->showWatermarkText = true;
			$this->mpdf->WriteHTML($output_html);
			$this->mpdf->Output('sales_report.pdf', 'I');			
		}
		exit;
		//$this->load->view($this->config->item('admin_folder').'/sales_csv', $csv_data);
		
	
	}
	
	

		
		
		
    
	
	function stats_product_viewed($page = 0)
	{
		$rows = 25;
		$data['products'] = $this->Report_model->viewed_product($rows, $page);
		//$this->show->pe($data['products']);
		
		$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/reports/stats_product_viewed';
		$config['total_rows']		= count($this->Report_model->viewed_product());
		
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
		
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/stats_product_viewed' , $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	
	function product_purchased($page = 0)
	{
		$rows = 5;
		$data['product_purchased'] = $this->Report_model->get_purchesed_product($rows, $page);
		
		$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/reports/product_purchased';
		$config['total_rows']		= count($this->Report_model->get_purchesed_product());
		
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
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/product_purchased' , $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
	
	function stats_customer($page = 0)
	{	
		$rows = 25;
		$data['customer_stats'] = $this->Report_model->customer_state($rows, $page);
		
		
		$this->load->library('pagination');	
		
		$config['base_url']			= base_url().'/'.$this->config->item('admin_folder').'/reports/stats_customer';
		$config['total_rows']		= count($this->Report_model->customer_state());
		
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
		
		$this->load->view($this->config->item('admin_folder').'/includes/header');
        $this->load->view($this->config->item('admin_folder').'/includes/leftbar');
        $this->load->view($this->config->item('admin_folder').'/stats_customer' , $data);
        $this->load->view($this->config->item('admin_folder').'/includes/inner_footer');
	}
}
?>