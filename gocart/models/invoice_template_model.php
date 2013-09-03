<?php
Class Invoice_Template_model extends CI_Model
{

	function __construct()
	{
			parent::__construct();
	}
	
	/********************************************************************

	********************************************************************/
	
	function get_templates($limit=0, $offset=0, $order_by='id', $direction='DESC')
	{
		$this->db->order_by($order_by, $direction);
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		$result	= $this->db->get('oc_invoice_templates');
		return $result->result();
	}
	
	function get_templates_count()
	{
		return $this->db->count_all_results('oc_invoice_templates');
	}
	
	
	
	function get_templates_by_id($id)
	{
		$result	= $this->db->get_where('oc_invoice_templates', array('invoice_template_id'=>$id));
		return $result->row();
	}
	
	function get_templates_by_for_invoice($id)
	{
		$result	= $this->db->get_where('oc_invoice_templates', array('invoice_template_level'=>'Universal'));
		$data = $result->row();
		if(count($result->row())>0)
		{
			return $result->row();
		}
		else
		{
			$result	= $this->db->get_where('oc_invoice_templates', array('invoice_template_id'=>$id));
			return $result->row();
		}
	}
	
		
	function save($template)
	{
		if(isset($template['invoice_template_level']) && $template['invoice_template_level'] == 'Universal')
		{
			$this->db->where('invoice_template_level', 'Universal');
			$this->db->update('oc_invoice_templates',  array('invoice_template_level' => 'Normal'));
		}
		
		if ($template['invoice_template_id'])
		{
			$this->db->where('invoice_template_id', $template['invoice_template_id']);
			$this->db->update('oc_invoice_templates', $template);
			return $template['invoice_template_id'];
		}
		else
		{
			$this->db->insert('oc_invoice_templates', $template);
			return $this->db->insert_id();
		}
	}
	
	function delete($id)
	{
		//this deletes the invoice template record
		$this->db->where('invoice_template_id', $id);
		$this->db->delete('oc_invoice_templates');
	
	}
	
	
}