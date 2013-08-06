<?php
Class Report_model extends CI_Model
{
	
	function __construct()
	{
			parent::__construct();
	}
	
	function get_purchesed_product()
	{
		$result	= "SELECT order_id , product_id , COUNT(*) AS count_product FROM oc_order_items GROUP BY product_id HAVING 
    COUNT(*) > 0";
		$result	=$this->db->query($result);
		
		return $result->result();
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
	function viewed_product()
	{
		$result	= $this->db->get('products');
		return $result->result();
	}
		
	
	
}



?>