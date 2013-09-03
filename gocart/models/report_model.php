<?php
Class Report_model extends CI_Model
{
	
	function __construct()
	{
			parent::__construct();
			$this->load->model('Product_model');
	}
	
	function get_purchesed_product($limit = 0 , $offset = 0)
	{
		$this->db->select('order_id , product_id , COUNT(*) AS count_product');
		$this->db->from('oc_order_items');
		$this->db->group_by('product_id');
		$this->db->having('COUNT(*) > 0');
		
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		$resutl_send = array();		
		$result = $this->db->get();		
		$product_purchased =  $result->result();		
		foreach ($product_purchased as $product_purchaseds){
		
			$product_name = $this->Product_model->get_product($product_purchaseds->product_id);			
			
			if(!empty($product_name->name))
			{
				$resutl_send[] = $product_purchaseds;
			
			}
		}
		/*echo "<pre>";print_r($resutl_send);
		exit;*/
		return $resutl_send;
	}
	
	function customer_state($limit = 0 , $offset = 0)
	{
		
		$this->db->select('oc_orders.customer_id , oc_customers.customer_job, SUM( oc_orders.subtotal ) AS sum_subtotal ,
			 		COUNT(oc_orders.customer_id) AS count_customer');
		 $this->db->from('oc_orders');
		 $this->db->join('oc_customers','oc_orders.customer_id = oc_customers.id');
		 $this->db->group_by('oc_orders.customer_id');
		 $this->db->order_by('oc_orders.customer_id','ASC');
		 
		 if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		 
		 
		 $result = $this->db->get();
		return $result->result();
		
	}
	function viewed_product($limit = 0 , $offset = 0)
	{
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		
		$result	= $this->db->get('products');
		return $result->result();
	}
		
	
	
}



?>