<?php
Class Product_model extends CI_Model
{
		
	// we will store the group discount formula here
	// and apply it to product prices as they are fetched 
	var $group_discount_formula = false;
	
	function __construct()
	{
		parent::__construct();
		
		// check for possible group discount 
		$customer = $this->session->userdata('customer');
		if(isset($customer['group_discount_formula'])) 
		{
			$this->group_discount_formula = $customer['group_discount_formula'];
		}
	}
	
	function product_autocomplete($name, $limit)
	{
		return	$this->db->like('name', $name)->get('products', $limit)->result();
	}
	
	function products($data=array(), $return_count=false , $csv = "")
	{
        
        if($csv !="")
        {
            $this->db->select('id, name, old_route, slug, description, excerpt, price, saleprice, delivery_price, seo_title, meta, google_follow, viewed');
        }
		
		if(empty($data))
		{
			//if nothing is provided return the whole shabang
			$this->get_all_products();
			
		}
		else
		{
			if($this->admin_access!='Superadmin')
			{
				$this->db->where('admin_id', $this->admin_id);
			}
			
			
			//$this->db->where('enabled', '1');
			//$this->db->where('publish_by_admin', '1');
			$this->db->where('delete', '0');
			//grab the limit
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
			
			//grab the offset
			if(!empty($data['page']))
			{
				$this->db->offset($data['page']);
			}
			
			//do we order by something other than category_id?
			if(!empty($data['order_by']))
			{
				//if we have an order_by then we must have a direction otherwise KABOOM
				$this->db->order_by($data['order_by'], $data['sort_order']);
			}
			
			//do we have a search submitted?
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				//if we are searching dig through some basic fields
				/*if(!empty($search->categories))
				{
					$this->db->like('name', $search->term);
					$this->db->or_like('description', $search->term);
					$this->db->or_like('excerpt', $search->term);
					$this->db->or_like('sku', $search->term);
				} */
				
				if(!empty($search->courses))
				{
                    $this->db->where('id',$search->courses); 
					//lets do some joins to get the proper category products
					//$this->db->join('category_products', 'category_products.product_id=products.id', 'right');
					//$this->db->where('category_products.category_id', $search->category_id);
					//$this->db->order_by('sequence', 'ASC');
				}
				if(!empty($search->admin))
				{
					//echo $search->courses_provider; exit;
					$this->db->where('admin_id',$search->admin);
					
				}
			}
		
			if($return_count)
			{
				
				return $this->db->count_all_results('products');
				
			}
			else
			{
                
				$result =  $this->db->get('products');
                    if($csv !="")
                    {
                        
                        $this->load->helper('csv');
                        query_to_csv($result, TRUE, 'Course_report.csv'); 
                        exit;
                    }
                            
                
				return  $result->result();
			}
			
		}
	}
    function count_all_published_products()
    {
       //sort by alphabetically by default
        $this->db->join('category_products', 'category_products.product_id=products.id', 'right');
        $this->db->order_by('name', 'ASC');
        $this->db->group_by('id');
        $this->db->where('enabled', '1');
        $this->db->where('delete', '0');
          
        $result    = $this->db->get('products');
        $return = $result->result_array();
        //echo $this->show->pe($return);
       //echo $this->db->last_query();exit;
        if(count($return))
        {
            return $return;
        }
        return false;
    }
	
    function get_products_catogery_wise($pag_form=16 , $pag_to=0)
    {
       //sort by alphabetically by default
       
        $this->db->join('category_products', 'category_products.product_id=products.id', 'right');
        $this->db->order_by('name', 'ASC');
		$this->db->group_by('id');
        $this->db->where('enabled', '1');
        $this->db->where('delete', '0');
          if($pag_form>0) {
        $this->db->limit($pag_form , $pag_to);
          }
        $result    = $this->db->get('products');
        $return = $result->result_array();
        //echo $this->show->pe($return);
       //echo $this->db->last_query();exit;
        if(count($return))
        {
            return $return;
        }
        return false; 
    }
    
    
	function get_all_products_array()
	{
		//sort by alphabetically by default
		$this->db->order_by('name', 'ASC');
		$this->db->where('enabled', '1');
		$this->db->where('delete', '0');
		$result	= $this->db->get('products');
		$return = $result->result_array();
		if(count($return))
		{
			return $return;
		}
		return false;
	}
	function get_deactive_products_array()
	{
		//sort by alphabetically by default
		
		
		$this->db->where('delete', '1');
		$result	= $this->db->get('products');
		$return = $result->result_array();
		if(count($return))
		{
			return $return;
		}
		return false;
	}
	
	
	function get_all_products()
	{
		//sort by alphabetically by default
		
		$this->db->order_by('name', 'ASC');
		$this->db->where('admin_id', $this->admin_id);
		$this->db->where('delete', '0');
		//$this->db->where('enabled', '1');
		$this->db->where('publish_by_admin', '1');
		$result	= $this->db->get('products');
        
		//apply group discount
		$return = $result->result();
       // echo'<pre>'; print_r($return);echo'<br/>' ;
		if($this->group_discount_formula) 
		{
			foreach($return as &$product) {
				eval('$product->price=$product->price'.$this->group_discount_formula.';');
			}
		}
         //echo'<pre>'; print_r($return);exit; 
		return $return;
	}
	
	function get_products($category_id = false, $limit = false, $offset = false, $by=false, $sort=false)
	{
		//if we are provided a category_id, then get products according to category
		if ($category_id)
		{
			$this->db->select('category_products.*, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false)->from('category_products')->join('products', 'category_products.product_id=products.id')->where(array('category_id'=>$category_id, 'enabled'=>1));
			//$this->db->order_by($by, $sort);
			
			//$result	= $this->db->limit($limit)->offset($offset)->get()->result();
             $result    = $this->db->get()->result(); 
			$contents	= array();
			$count		= 0;
			foreach ($result as $product)
			{

				$contents[$count]	= $this->get_product($product->product_id);
				$count++;
			}
              //echo $this->db->last_query(); exit; 
			return $contents;
		}
		else
		{
			//sort by alphabetically by default
			$this->db->order_by('name', 'ASC');
			$result	= $this->db->get('products');
            //echo $this->db->last_query(); exit;
			//apply group discount
			$return = $result->result();
			if($this->group_discount_formula) 
			{
				foreach($return as &$product) {
					eval('$product->price=$product->price'.$this->group_discount_formula.';');
				}
			}
			return $return;
		}
	}
	
	function count_all_products()
	{
		return $this->db->count_all_results('products');
		
	}
    
	
	function count_products($id)
	{
		return $this->db->select('product_id')->from('category_products')->join('products', 'category_products.product_id=products.id')->where(array('category_id'=>$id, 'enabled'=>1))->count_all_results();
	}

	function get_product($id, $related=true)
	{
		$result	= $this->db->get_where('products', array('id'=>$id))->row();
		//echo"<pre>" ;print_r($result);
		if(!$result)
		{
			return false;
		}

		$related	= json_decode($result->related_products);
		$result->prelated = $result->related_products;
		if(!empty($related))
		{
			//build the where
			$where = false;
			foreach($related as $r)
			{
				if(!$where)
				{
					$this->db->where('id', $r);
				}
				else
				{
					$this->db->or_where('id', $r);
				}
				$where = true;
			}
		
			$result->related_products	= $this->db->get('products')->result();
		}
		else
		{
			$result->related_products	= array();
		}
		
		$p_option			= json_decode($result->price_options);
		$result->json_price = $result->price_options;
			if(!empty($p_option))
		{
			
			//build the where
			$where = false;
			foreach($p_option as $r)
			{
				if(!$where)
				{
					$this->db->where('p_option_id', $r);
				}
				else
				{
					$this->db->or_where('p_option_id', $r);
				}
				$where = true;
			}
		
			$result->price_options	= $this->db->get('product_price_options')->result();
		}
		else
		{
			$result->price_options	= array();
		}
		$result->categories			= $this->get_product_categories($result->id);
	
		// group discount?
		if($this->group_discount_formula) 
		{
			eval('$result->price=$result->price'.$this->group_discount_formula.';');
		}

		return $result;
	}

	function get_product_categories($id)
	{
		return $this->db->where('product_id', $id)->join('categories', 'category_id = categories.id')->get('category_products')->result();
	}

	function get_slug($id)
	{
		return $this->db->get_where('products', array('id'=>$id))->row()->slug;
	}

	function check_slug($str, $id=false)
	{
		$this->db->select('slug');
		$this->db->from('products');
		$this->db->where('slug', $str);
		if ($id)
		{
			$this->db->where('id !=', $id);
		}
		$count = $this->db->count_all_results();

		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function save($product, $options=false, $categories=false, $tabs=false)
	{
		if ($product['id'])
		{
			$this->db->where('id', $product['id']);
			$this->db->update('products', $product);

			$id	= $product['id'];
		}
		else
		{
			$this->db->insert('products', $product);
			$id	= $this->db->insert_id();
		}

		//loop through the product options and add them to the db
		if($options !== false)
		{
			$obj =& get_instance();
			$obj->load->model('Option_model');

			// wipe the slate
			$obj->Option_model->clear_options($id);

			// save edited values
			$count = 1;
			foreach ($options as $option)
			{
				if(empty($option['values']))
				{
					$values = '';
				}
				else
				{
					$values = $option['values'];
				}				
				unset($option['values']);
				$option['product_id'] = $id;
				$option['sequence'] = $count;
				$obj->Option_model->save_option($option, $values);
				$count++;
			}
		}
		
		if($categories !== false)
		{
			if($product['id'])
			{
				//get all the categories that the product is in
				$cats	= $this->get_product_categories($id);
				//$this->show->pe($categories);
				//generate cat_id array
				$ids	= array();
				foreach($cats as $c)
				{
					$ids[]	= $c->id;
				}

				//eliminate categories that products are no longer in
				foreach($ids as $c)
				{
					if(!in_array($c, $categories))
					{
						$this->db->delete('category_products', array('product_id'=>$id,'category_id'=>$c));
					}
				}
				
				//add products to new categories
				foreach($categories as $c)
				{
					if(!in_array($c, $ids))
					{
						$this->db->insert('category_products', array('product_id'=>$id,'category_id'=>$c));
					}
				}
			}
			else
			{
				//new product add them all
				foreach($categories as $c)
				{
					$this->db->insert('category_products', array('product_id'=>$id,'category_id'=>$c));
				}
			}
			//print_r($tabs);exit;
			if($tabs != false)
			{
				if(isset($tabs['tab_id']) && !empty($tabs['tab_id']))
				{
					$this->db->where('tab_id', $tabs['tab_id']);
					$this->db->update('oc_product_tabs', $tabs);
				}
				else
				{
					$tabs['product_id'] = $id;
					$this->db->insert('oc_product_tabs',$tabs);
				}
			}
			
			
			
		}
		
		//return the product id
		return $id;
	}
	
	function save_uploaded_bulk_courses($product, $options=false, $categories=false)
	{
		
		//echo '-----'.$categories;
		$this->db->insert('products', $product);
		$id	= $this->db->insert_id();
		if($categories !== false)
		{
			if(is_array($categories))
			{
				//new product add them all
				foreach($categories as $c)
				{
					$this->db->insert('category_products', array('product_id'=>$id,'category_id'=>$c));
				}
								
			}
			else
			{
				$this->db->insert('category_products', array('product_id'=>$id,'category_id'=>$categories));
			}
		}
		
		//return the product id
		return $id;
	}
	
	function delete_product($id)
	{
		// delete product 
		$this->db->where('id', $id);
		$this->db->delete('products');

		//delete references in the product to category table
		$this->db->where('product_id', $id);
		$this->db->delete('category_products');
		
		// delete coupon reference
		$this->db->where('product_id', $id);
		$this->db->delete('coupons_products');

	}
	
	function soft_delete_product($id)
	{
		$product =  array('delete' => '1');
		$this->db->where('id', $id);
		$this->db->update('products', $product);
		return true;
	}

	function add_product_to_category($product_id, $optionlist_id, $sequence)
	{
		$this->db->insert('product_categories', array('product_id'=>$product_id, 'category_id'=>$category_id, 'sequence'=>$sequence));
	}

	function search_products($term, $limit=false, $offset=false, $by=false, $sort=false)
	{
		$results		= array();
		
		$this->db->select('*, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false);
		//this one counts the total number for our pagination
		$this->db->where('enabled', 1);
		$this->db->where('(name LIKE "%'.$term.'%" OR description LIKE "%'.$term.'%" OR excerpt LIKE "%'.$term.'%" OR sku LIKE "%'.$term.'%")');
		$results['count']	= $this->db->count_all_results('products');


		$this->db->select('*, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false);
		//this one gets just the ones we need.
		$this->db->where('enabled', 1);
		$this->db->where('(name LIKE "%'.$term.'%" OR description LIKE "%'.$term.'%" OR excerpt LIKE "%'.$term.'%" OR sku LIKE "%'.$term.'%")');
		
		if($by && $sort)
		{
			$this->db->order_by($by, $sort);
		}
		
		$results['products']	= $this->db->get('products', $limit, $offset)->result();
		
		return $results;
	}

	// Build a cart-ready product array
	function get_cart_ready_product($id, $quantity=false)
	{
		$product	= $this->db->get_where('products', array('id'=>$id))->row();
		
		//unset some of the additional fields we don't need to keep
		if(!$product)
		{
			return false;
		}
		
		$product->base_price	= $product->price;
		
		if ($product->saleprice != 0.00)
		{ 
			$product->price	= $product->saleprice;
		}
		
		
		// Some products have n/a quantity, such as downloadables
		//overwrite quantity of the product with quantity requested
		if (!$quantity || $quantity <= 0 || $product->fixed_quantity==1)
		{
			$product->quantity = 1;
		}
		else
		{
			$product->quantity = $quantity;
		}
		
		
		// attach list of associated downloadables
		$product->file_list	= $this->Digital_Product_model->get_associations_by_product($id);
		
		return (array)$product;
	}
	
	
	/*****************************************************
	*	Product Tabs Part
	*
	*/
	
	function get_all_products_tabs($id)
	{
		return $product_tabs	= $this->db->get_where('product_tabs', array('product_id'=>$id))->result_array();
		//$this->show->pe($product_tabs);
		
	}
	
	function get_product_tab($tab_id)
	{
		return $product_tab	= $this->db->get_where('product_tabs', array('tab_id'=>$tab_id))->row();
	}
	
	function delete_product_tab($tab_id)
	{
		//Delete Product 
		$this->db->where('tab_id', $tab_id);
		$this->db->delete('product_tabs');
		return true;
	}
	
	/*****************************************************
	*	Product Rating F&Q Part
	*
	*/
	
	
	function save_rating($data)
	{
		$this->db->insert('course_rating', $data);
		
	}
	function get_reviews($product_id)
	{
		$this->db->where('product_id',$product_id);
		
		$result		= $this->db->get('course_rating');
		
		return $result->result();
	}
	function save_question($data)
	{
		$this->db->insert('course_question', $data);
		
	}
	
	function get_question($product_id)
	{
		$this->db->where('product_id',$product_id);
		
		$result		= $this->db->get('course_question');
		
		return $result->result();
	}
	
	/*****************************************************
	*	Product Price Options
	*
	*/
	
	
	function get_price_options($limit=0 ,$offset=0)
	{
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		$result	= $this->db->get('oc_product_price_options');
		$return = $result->result_array();
		if(count($return))
		{
			return $return;
		}
		return false;
		
	}
	function price_count()
	{
		return $this->db->count_all_results('product_price_options');
	}
	
	function get_price_option($id)
	{
		$result	= $this->db->get_where('oc_product_price_options', array('p_option_id'=>$id))->row();
		
		if(count($result))
		{
			return $result;
		}
		return false;
		
	}
	
	function delete_price_option($id)
	{
		// delete product 
		$this->db->where('p_option_id', $id);
		$this->db->delete('oc_product_price_options');
		
	}
	
	function product_options_save($product_price)
	{
		if ($product_price['p_option_id'])
		{
			$this->db->where('p_option_id', $product_price['p_option_id']);
			$this->db->update('oc_product_price_options', $product_price);

			$id	= $product_price['p_option_id'];
		}
		else
		{
			$this->db->insert('oc_product_price_options', $product_price);
			$id	= $this->db->insert_id();
		}
	}
	
	/*****************************************************
	*	Product Delivery Options
	*
	*/
	
	function get_delivery_options()
	{
	
		$result	= $this->db->get('oc_product_delivery_options');
		$return = $result->result_array();
		if(count($return))
		{
			return $return;
		}
		return false;
		
	}
	
	function get_delivery_option($id)
	{
		$result	= $this->db->get_where('oc_product_delivery_options', array('d_option_id'=>$id))->row();
		
		if(count($result))
		{
			return $result;
		}
		return false;
		
	}
	
	function delete_delivery_option($id)
	{
		// delete product 
		$this->db->where('d_option_id', $id);
		$this->db->delete('oc_product_delivery_options');
		
	}
	
	function product_delivery_save($product_price)
	{
		if ($product_price['d_option_id'])
		{
			$this->db->where('d_option_id', $product_price['d_option_id']);
			$this->db->update('oc_product_delivery_options', $product_price);

			$id	= $product_price['d_option_id'];
		}
		else
		{
			$this->db->insert('oc_product_delivery_options', $product_price);
			$id	= $this->db->insert_id();
		}
	}
	
}
