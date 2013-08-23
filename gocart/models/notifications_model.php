<?php
Class Notifications_model extends CI_Model
{

	//this is the expiration for a non-remember session
	//var $session_expire	= 7200;
	
	
	function __construct()
	{
			parent::__construct();
			
	}
	
	
	/********************************************************************
		Customer Notifications Area Starts
	********************************************************************/
	
	function get_customer_viewed()
	{
		
		$result	= $this->db->get_where('customers', array('viewed'=>'1'));
		return $result->result_array();
	}
	
	function set_customer_viewed()
	{
		$data = array('viewed' => '0');
		$this->db->update('customers', $data, "viewed = 1");
	}
	
	
	
	/********************************************************************
		Customer Notifications Area Ends
	********************************************************************/
	
	/********************************************************************
		Users Notifications Area Starts
	********************************************************************/
	
	function get_users_viewed()
	{
		
		$result	= $this->db->get_where('admin', array('viewed'=>'1'));
		return $result->result_array();
	}
	
	function set_users_viewed()
	{
		$data = array('viewed' => '0');
		$this->db->update('admin', $data, "viewed = 1");
	}
	
	
	
	/********************************************************************
		Users Notifications Area Ends
	********************************************************************/
	
	/********************************************************************
		Tutors Notifications Area Starts
	********************************************************************/
	
	function get_tutors_viewed()
	{
		
		$result	= $this->db->get_where('tutors', array('viewed'=>'1'));
		return $result->result_array();
	}
	
	function set_tutors_viewed()
	{
		$data = array('viewed' => '0');
		$this->db->update('tutors', $data, "viewed = 1");
	}
		
	/********************************************************************
		Tutors Notifications Area Ends
	********************************************************************/
	
	/********************************************************************
		Orders Notifications Area Starts
	********************************************************************/
	
	function get_orders_viewed()
	{
		
		$result	= $this->db->get_where('orders', array('viewed'=>'1'));
		return $result->result_array();
	}
	
	function set_orders_viewed()
	{
		$data = array('viewed' => '0');
		$this->db->update('orders', $data, "viewed = 1");
	}
		
	/********************************************************************
		Tutors Notifications Area Ends
	********************************************************************/
	
	
}