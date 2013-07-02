<?php 
Class Dashboard_model extends CI_Model
{
	function get_latest_order()
	{
		$field		= 'id';
		$sort		= 'DESC';
		$this->db->order_by($field, $sort);
		$result	= $this->db->get('orders');
		return $result->result();
		
	}
	
	function get_latest_customer()
	{
		$field		= "id";
		$sort		= 'DESC';
		$this->db->order_by($field, $sort);
		$result	= $this->db->get('customers');
		return $result->result();
		
	}
	
	
	
}
?>