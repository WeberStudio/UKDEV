<?php
Class System_Template_model extends CI_Model
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

		$result	= $this->db->get('oc_system_emails');
		return $result->result();
	}
	
	function get_templates_count()
	{
		return $this->db->count_all_results('oc_system_emails');
	}
	
	
	
	function get_templates_by_id($id)
	{
		$result	= $this->db->get_where('oc_system_emails', array('email_id'=>$id));
		return $result->row();
	}
	
	function get_templates_by_for_invoice($id)
	{
		$result	= $this->db->get_where('oc_system_emails', array('invoice_template_level'=>'Universal'));
		$data = $result->row();
		if(count($result->row())>0)
		{
			return $result->row();
		}
		else
		{
			$result	= $this->db->get_where('oc_system_emails', array('email_id'=>$id));
			return $result->row();
		}
	}
	
		
	function save($template)
	{
		if(isset($template['invoice_template_level']) && $template['invoice_template_level'] == 'Universal')
		{
			$this->db->where('invoice_template_level', 'Universal');
			$this->db->update('oc_system_emails',  array('invoice_template_level' => 'Normal'));
		}
		
		if ($template['email_id'])
		{
			$this->db->where('email_id', $template['email_id']);
			$this->db->update('oc_system_emails', $template);
			return $template['email_id'];
		}
		else
		{
			$this->db->insert('oc_system_emails', $template);
			return $this->db->insert_id();
		}
	}
	
	function delete($id)
	{
		//this deletes the invoice template record
		$this->db->where('email_id', $id);
		$this->db->delete('oc_system_emails');
	
	}
	
	
} 