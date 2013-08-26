<?php
Class Category_model extends CI_Model
{

	function get_all_categories($page=false, $row=false)
	{
		
		$this->db->select('*');
		$this->db->order_by('name', 'ASC');
		$this->db->where('delete', '0');
		$this->db->where('publish_by_admin', '1');
		//$this->db->where('publish_by_super', '1');
        if($row!='')
        {
        $this->db->limit($row,$page);
        }
		$result	= $this->db->get('categories');
		if(count($result)>0)
		{
			return $result->result_array();
		}
		else
		{
			return false;
		}	
	}
	
	function get_categories_dropdown()
	{
		$this->db->select('id,name,slug,publish_by_super,google_follow');
		$this->db->order_by('name', 'ASC');
		$this->db->where('delete', '0');
		//$this->db->where('publish_by_admin', '1');
		$this->db->where('publish_by_super', '1');
        
		$result	= $this->db->get('categories');
		if(count($result)>0)
		{
			return $result->result_array();
		}
		else
		{
			return false;
		}	
	}
	
	function get_categories($parent = false, $data=array() , $term = false , $csv="")
	{
        if($csv !="")
        {
            $this->db->select('id, name, old_route, slug, description, excerpt, seo_title, meta, meta_key, publish_date, google_follow');
        }
		if(!empty($term))
        {
            $search    = json_decode($term);
            //if we are searching dig through some basic fields
            if(!empty($search->term))
            {
                $this->db->where('id' , $search->term);
                //$this->db->like('name', $search->term);
                //$this->db->or_like('publish_by_super', $search->term);
            }
            
            
        }
        else
        {
		    if ($parent !== false)
		    {
			    $this->db->where('parent_id', $parent);
		    }
		    
		    $this->db->select('id');	
        	    
		    
            if($this->admin_access!='Superadmin' && $this->admin_access !='')
            {
                $this->db->where('admin_id', $this->admin_id);            
            }
		    //$this->db->where('publish_by', 'Admin');
		    //$this->db->where('status', '1');
		    //$this->db->where('delete', '0');
		    if(!empty($data['rows']))
		    {
			    
			    $this->db->limit($data['rows']);
		    }
		   //grab the offset
		    if(!empty($data['page']))
		    {
			    $this->db->offset($data['page']);
		    }
		    
		    if(empty($data))
		    {
			    $this->db->order_by('categories.sequence', 'ASC');
			    $this->db->order_by('id', 'ASC');
		    }
		    else
		    {
			    if(!empty($data['order_by']))
			    {
				    //if we have an order_by then we must have a direction otherwise KABOOM
				    //$this->db->order_by($data['order_by'], $data['sort_order']);
			    }	
		    }
        }
		
		//this will alphabetize them if there is no sequence
		
		$this->db->where('delete', '0');
		
		$result	= $this->db->get('categories');
        //$this->show->pe($this->db->last_query());  
        if($csv !="")
        {
            
            $this->load->helper('csv');
            query_to_csv($result, TRUE, 'Categories_report.csv'); 
            exit;
        }
        
		//echo $this->db->last_query();exit;
		$categories	= array();
		foreach($result->result() as $cat)
		{
			$categories[]	= $this->get_category($cat->id);
		}
		 //echo $this->show->pe($categories);exit;
		return $categories;
	}
	
	//this is for building a menu
	function get_categories_tierd($parent=0, $data=array(), $term = false , $csv="")
	{
		$categories	        = array();
		if(!empty($data['rows']))
		{
			$this->db->limit($data['rows']);			
		}
		
		//do we order by something other than category_id?
		if(!empty($data['order_by']))
		{
			//if we have an order_by then we must have a direction otherwise KABOOM
			$this->db->order_by($data['order_by'], $data['sort_order']);
		}
		
		$result	        = $this->get_categories($parent, $data , $term , $csv);
          
		foreach ($result as $category)
		{
			$categories[$category->id]['category']	= $category;
			$categories[$category->id]['children']	= $this->get_categories_tierd($category->id);
		}
        //$this->show->pe($this->db->last_query());   
		return $categories;
	}
	
	function category_autocomplete($name, $limit)
	{
		return	$this->db->like('name', $name)->get('categories', $limit)->result();
	}
	
	function get_category($id)
	{
		return $this->db->get_where('categories', array('id'=>$id))->row();
	}
	
	function get_category_products_admin($id)
	{
		$this->db->order_by('sequence', 'ASC');
		$result	= $this->db->get_where('category_products', array('category_id'=>$id));
		$result	= $result->result();
		
		$contents	= array();
		foreach ($result as $product)
		{
			$result2	= $this->db->get_where('products', array('id'=>$product->product_id));
			$result2	= $result2->row();
			
			$contents[]	= $result2;	
		}
		
		return $contents;
	}
	
	function get_category_products($id, $limit, $offset)
	{
		$this->db->order_by('sequence', 'ASC');
		$result	= $this->db->get_where('category_products', array('category_id'=>$id), $limit, $offset);
		$result	= $result->result();
		
		$contents	= array();
		$count		= 1;
		foreach ($result as $product)
		{
			$result2	= $this->db->get_where('products', array('id'=>$product->product_id));
			$result2	= $result2->row();
			
			$contents[$count]	= $result2;
			$count++;
		}
		
		return $contents;
	}
	
	function organize_contents($id, $products)
	{
		//first clear out the contents of the category
		$this->db->where('category_id', $id);
		$this->db->delete('category_products');
		
		//now loop through the products we have and add them in
		$sequence = 0;
		foreach ($products as $product)
		{
			$this->db->insert('category_products', array('category_id'=>$id, 'product_id'=>$product, 'sequence'=>$sequence));
			$sequence++;
		}
	}
	
	function save($category)
	{
		if ($category['id'])
		{
			$this->db->where('id', $category['id']);
			$this->db->update('categories', $category);
			
			return $category['id'];
		}
		else
		{
			$this->db->insert('categories', $category);
			return $this->db->insert_id();
		}
	}
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('categories');
		
		//delete references to this category in the product to category table
		$this->db->where('category_id', $id);
		$this->db->delete('category_products');
	}
	
	function trash($id)
	{
		$user_info		= $this->auth->admin_info();
		  
		$get_cat 		= $this->get_category($id);
		
		if($get_cat->admin_id == $user_info['id'] || $user_info['access']=='Superadmin')
		{
			$data = array('publish_by_super' => '0' , 'publish_by_admin' => '0' , 'delete' => '1' );
		}
		else
		{
			$data = array('publish_by_admin' => '0' , 'delete' => '1' );
		}
		
		//$data = array('publish_by_admin' => '0');
		//if($this->admin_access!="" && $this->admin_access == 'Superadmin')
		//{//$data = array('publish_by_super' => '0');
			
		//}
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
		return true;
	}
    function get_blog_posts()
    {
        //return $this->db->get('wp_posts')->result(); 
        $sql    =  "SELECT * FROM wp_posts where post_status='publish' order by post_date DESC Limit 0,2";
        $result = $this->db->query($sql);
        //echo "<pre>";print_r($result->result());
        return $result->result();       
    }
    
    function fornt_ent_search_cat($cat_name =false)
    {   
        $this->db->select('*'); 
        $this->db->like('name', $cat_name);
        if($cat_name==false)
        {
            $this->db->limit(6); 
        }
        
        if($cat_name!=false)
        {
            $this->db->where('parent_id', '0');    
        }
        
        $result = $this->db->get('categories');
        return $result->result(); 
    }
    
    
    function fornt_ent_search_subcat($cat_name =false)
    {   
        $this->db->select('*'); 
        $this->db->like('name', $cat_name);
        $this->db->where('parent_id !=', '0');
        $result = $this->db->get('categories');
        return $result->result(); 
    }
    function fornt_ent_search_keywords($cat_name =false)
    {   
        $this->db->select('*'); 
        $this->db->like('name', $cat_name);
        $this->db->or_like('meta', $cat_name);
        $this->db->or_like('meta_key', $cat_name); 
        $this->db->or_like('seo_title', $cat_name);
        $result = $this->db->get('categories');
        return $result->result(); 
    }
    function fornt_ent_search_price($cat_name =false)
    {   
        $this->db->select('*'); 
        $this->db->like('price', $cat_name);
        
        $result = $this->db->get('products');
        return $result->result(); 
    }

    
	
	/*function course_count($id)
	{
		 $this->db->where('category_id',$id);
		 $result = $this->db->get('category_products');
		 return $result->count_all_results();
		
	}*/
    
    
    
}
