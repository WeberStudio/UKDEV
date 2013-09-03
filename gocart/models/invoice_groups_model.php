<?php
Class Invoice_Groups_Model extends CI_Model
{

	function __construct()
	{
			parent::__construct();
	}
	
	/********************************************************************

	********************************************************************/
	
	function get_groups($limit=0, $offset=0, $order_by='id', $direction='DESC')
	{
		$this->db->order_by($order_by, $direction);
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		$result	= $this->db->get('oc_invoice_groups');
		return $result->result();
	}
	
	function get_groups_by_id($id)
	{
		$result	= $this->db->get_where('oc_invoice_groups', array('invoice_group_id'=>$id));
		return $result->row();
	}
		
	function save($group)
	{
		if ($group['invoice_group_id'])
		{
			$this->db->where('invoice_group_id', $group['invoice_group_id']);
			$this->db->update('oc_invoice_groups', $group);
			return $group['invoice_group_id'];
		}
		else
		{
			$this->db->insert('oc_invoice_groups', $group);
			return $this->db->insert_id();
		}
	}
	
	function delete($id)
	{
		//this deletes the invoice template record
		$this->db->where('invoice_group_id', $id);
		$this->db->delete('oc_invoice_groups');
	
	}
	
	
}