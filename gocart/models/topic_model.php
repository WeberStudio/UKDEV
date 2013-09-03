<?php
Class Topic_model extends CI_Model
{

	//this is the expiration for a non-remember session
	//var $session_expire	= 7200;
	
	
	
	function __construct()
	{
			parent::__construct();
	}
	
	
	
	function get_topics($limit=0, $offset=0, $order_by='topic_title', $direction='ASC')
	{
		$this->db->order_by($order_by, $direction);
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		$result	= $this->db->get('topics');
		return $result->result();
	}
	
	function count_topics()
	{
		return $this->db->count_all_results('topics');
	}
	
	function get_topic($id)
	{
		$result	= $this->db->get_where('topics', array('topic_id'=>$id));
		return $result->row();
	}
	
    function get_topic_by_form_id($id)
    {
        $result    = $this->db->get_where('topics', array('forum_id'=>$id, 'topic_status'=>'Yes'));
        return $result->result();
    }
    
	function save($data)
	{
		if($data['topic_id'])
		{
			$this->db->where('topic_id', $data['topic_id']);
			$this->db->update('oc_topics', $data);
			return $data['topic_id'];
		}
		else
		{
			$this->db->insert('oc_topics', $data);
			return $this->db->insert_id();
		}
	}
	
	function topic_delete($topic_id)
	{			
		$this->db->delete('oc_topics', array('topic_id' => $topic_id));
		return true;	
	}
	
	
}