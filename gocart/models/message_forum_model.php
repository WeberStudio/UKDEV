<?php
Class Message_Forum_model extends CI_Model
{

	//this is the expiration for a non-remember session
	//var $session_expire	= 7200;
	
	function __construct()
	{
			parent::__construct();
	}
	
	
	
	
	
	function get_messages($limit=0, $offset=0, $order_by='message_title', $direction='ASC')
	{
		$this->db->order_by($order_by, $direction);
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		$result	= $this->db->get('messages');
		return $result->result();
	}
	
	function count_message()
	{
		return $this->db->count_all_results('topics');
	}
	
	function get_message($id)
	{
		$result	= $this->db->get_where('oc_messages', array('message_id'=>$id));
		return $result->row();
	}
	
	function get_messages_by_topic_id($id)
    {
        $result    = $this->db->get_where('oc_messages', array('topic_id'=>$id, 'message_status'=>'Yes'));
        return $result->result();
    }
	
	function save($data)
	{
		if($data['message_id'])
		{
			$this->db->where('message_id', $data['message_id']);
			$this->db->update('oc_messages', $data);
			return $data['message_id'];
		}
		else
		{
			$this->db->insert('oc_messages', $data);
			return $this->db->insert_id();
		}
	}
	
	function message_delete($message_id)
	{			
		$this->db->delete('oc_messages', array('message_id' => $message_id));
		return true;	
	}
	
}
