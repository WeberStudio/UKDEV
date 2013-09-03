<?php
Class Forum_model extends CI_Model
{

	//this is the expiration for a non-remember session
	//var $session_expire	= 7200;
	
	
	function __construct()
	{
			parent::__construct();
	}
	
	
	
	function get_forums($limit=0, $offset=0, $order_by='forum_title', $direction='')
	{
		$this->db->order_by($order_by, $direction);
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		$this->db->where('forum_status', '1');
		$result	= $this->db->get('forums');
		//echo $this->db->last_query(); exit;
		return $result->result();
	}
	
	function count_forums()
	{
		return $this->db->count_all_results('forums');
	}
	
	function get_forum($id)
	{
		$result	= $this->db->get_where('forums', array('forum_id'=>$id));
		return $result->row();
	}
    
	function get_forum_customer($id)  
    {	
		$result = $this->db->query("SELECT * FROM oc_forums 
		JOIN oc_tutors 
		ON oc_forums.tutor_id = oc_tutors.tutor_id 
		JOIN oc_products
		ON oc_forums.product_id = oc_products.id  
		AND oc_forums.customer_id =".$id." AND oc_forums.forum_status='1'");
		//$result = $this->db->get_where('forums',array('customer_id'=>$id,'forum_status'=>'1'));
        //echo $this->db->last_query(); exit;
		return $result->result();
	}
	
	function get_forum_for_tutors($id)
     {       
        $result = $this->db->query("SELECT * FROM oc_forums 
        JOIN oc_tutors 
        ON oc_forums.tutor_id = oc_tutors.tutor_id 
        JOIN oc_products
        ON oc_forums.product_id = oc_products.id  
        AND oc_forums.tutor_id =".$id." AND oc_forums.forum_status='1'");
        //$result = $this->db->get_where('forums',array('customer_id'=>$id,'forum_status'=>'1'));
        return $result->result();
    } 
	
	function save($data)
	{
		if(!empty($data['forum_id']))
		{
			$this->db->where('forum_id', $data['forum_id']);
			$this->db->update('oc_forums', $data);
			return $data['forum_id'];
		}
		else
		{
			$this->db->insert('oc_forums', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_forum($forum_id)
	{
	
		$this->db->where('forum_id', $forum_id);
		$this->db->update('oc_forums', array('forum_status' => '0'));
		return true;
	
	}
	
	
}