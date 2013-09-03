<?php
Class Invoice_Tax_Model extends CI_Model
{

	function __construct()
	{
			parent::__construct();
	}
	
	/********************************************************************

	********************************************************************/
	
	
	function get_taxes($field='tax_rate_id', $by='ASC', $page=0, $rows=5)
	{
		$this->db->order_by($field, $by);
		if($rows>0)
		{
			$this->db->limit($rows, $page);
		}

		$result	= $this->db->get('oc_tax_rates');
		return $result->result();
	}
	
	function get_count_taxes()
	{
		return $this->db->count_all_results('customers');
	}
	
	
	
	function get_tax_by_id($id)
	{
		$result	= $this->db->get_where('oc_tax_rates', array('tax_rate_id'=>$id));
		return $result->row();
	}
		
	function save($tax)
	{
		if ($tax['tax_rate_id'])
		{
			$this->db->where('tax_rate_id', $tax['tax_rate_id']);
			$this->db->update('oc_tax_rates', $tax);
			return $tax['tax_rate_id'];
		}
		else
		{
			$this->db->insert('oc_tax_rates', $tax);
			return $this->db->insert_id();
		}
	}
	
	function delete($id)
	{
		//this deletes the invoice template record
		$this->db->where('tax_rate_id', $id);
		$this->db->delete('oc_tax_rates');
	
	}
	
	
}