<?php
Class Page_model extends CI_Model
{

	/********************************************************************
	Page functions
	********************************************************************/
	function get_pages($parent = 0, $limit=0, $offset=0)
	{
		$this->db->order_by('sequence', 'ASC');
		$this->db->where('parent_id', $parent);
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		$result = $this->db->get('pages')->result();
		$return	= array();
		foreach($result as $page)
		{
			$return[$page->id]				= $page;
			$return[$page->id]->children	= $this->get_pages($page->id);
		}
		
		return $return;
	}
	
	function get_pages_top()
	{
		$this->db->order_by('id', 'ASC');
		$this->db->limit(5);
		$result = $this->db->get('pages')->result();
		//echo $this->db->last_query();exit;
		$return	= array();
		foreach($result as $page)
		{
			$return[$page->id]				= $page;
			$return[$page->id]->children	= $this->get_pages($page->id);
		}
		
		return $return;
	}
	
	function get_pages_by_position($position)
	{
		$this->db->order_by('id', 'ASC');
		$this->db->where('position', $position);
		$result = $this->db->get('pages')->result();
		//echo $this->db->last_query();exit;
		$return	= array();
		foreach($result as $page)
		{
			$return[$page->id]				= $page;
			$return[$page->id]->children	= $this->get_pages($page->id);
		}
		
		return $return;
	}
	
	function get_page($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('pages')->row();
		
		return $result;
	}
	
	function get_slug($id)
	{
		$page = $this->get_page($id);
		if($page) 
		{
			return $page->slug;
		}
	}
	
	function save($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id']);
			$this->db->update('pages', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('pages', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_page($id)
	{
		//delete the page
		$this->db->where('id', $id);
		$this->db->delete('pages');
	
	}
	
	function get_page_by_slug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('pages')->row();
		
		return $result;
	}
	//========== start ====this is for froentend home page text =========//
	function save_text($data)
	{
		if($data['id'])
		{
			
			$this->db->where('id', $data['id']);
			$this->db->update('page_text', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('page_text', $data);
			return $this->db->insert_id();
		}
	}
		function get_page_texts()
	{
		$result = $this->db->get('page_text')->result();
		return $result;
	}
	function get_page_text($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('page_text')->row();
		
		return $result;
	}
	function delete_page_text($id)
	{
		//delete the page
		$this->db->where('id', $id);
		$this->db->delete('page_text');
	
	}
	
	//========== end ====this is for froentend home page text =========//
	
	function get_homepage_link()
	{
		
		//print_r($ids); exit;
		//$restlt = mysql_query('SELECT * FROM oc_pages WHERE id IN (1,2)');
		$ids = array(1,2);
		$this->db->where_in('id',$ids);
		
		$result = $this->db->get('pages')->result();
		return $result;
	}
	
	function page_count()
	{
		return $this->db->count_all_results('pages');
	}
}