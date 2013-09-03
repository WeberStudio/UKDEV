<?php
Class order_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_gross_monthly_sales($year)
	{
		$this->db->select('SUM(coupon_discount) as coupon_discounts');
		$this->db->select('SUM(gift_card_discount) as gift_card_discounts');
		$this->db->select('SUM(subtotal) as product_totals');
		$this->db->select('SUM(shipping) as shipping');
		$this->db->select('SUM(tax) as tax');
		$this->db->select('SUM(total) as total');
		$this->db->select('YEAR(ordered_on) as year');
		$this->db->select('MONTH(ordered_on) as month');
		$this->db->group_by(array('MONTH(ordered_on)'));
		$this->db->order_by("ordered_on", "desc");
		$this->db->where('YEAR(ordered_on)', $year);
		
		return $this->db->get('orders')->result();
	}
	
	function get_sales_years()
	{
		$this->db->order_by("ordered_on", "desc");
		$this->db->select('YEAR(ordered_on) as year');
		$this->db->group_by('YEAR(ordered_on)');
		$records	= $this->db->get('orders')->result();
		$years		= array();
		foreach($records as $r)
		{
			$years[]	= $r->year;
		}
		return $years;
	}
	
	function get_orders($search=false,$sort_by='', $sort_order='DESC',$limit=0,$offset=0 , $csv = '')
	{	
			
		/*if ($search)
		{
			if(!empty($search->term))
			{
				//support multiple words
				$term = explode(' ', $search->term);

				foreach($term as $t)
				{
					$not		= '';
					$operator	= 'OR';
					if(substr($t,0,1) == '-')
					{
						$not		= 'NOT ';
						$operator	= 'AND';
						//trim the - sign off
						$t		= substr($t,1,strlen($t));
					}

					$like	= '';
					$like	.= "( `order_number` ".$not."LIKE '%".$t."%' " ;
					$like	.= $operator." `bill_firstname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `bill_lastname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `ship_firstname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `ship_lastname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `status` ".$not."LIKE '%".$t."%' ";
					$like	.= $operator." `notes` ".$not."LIKE '%".$t."%' )";

					$this->db->where($like);
				}	
			}
			if(!empty($search->start_date))
			{
				$this->db->where('ordered_on >=',$search->start_date);
			}
			if(!empty($search->end_date))
			{
				//increase by 1 day to make this include the final day
				//I tried <= but it did not function. Any ideas why?
				$search->end_date = date('Y-m-d', strtotime($search->end_date)+86400);
				$this->db->where('ordered_on <',$search->end_date);
			}
			
		}*/
		
		if($limit>0)
		{
			//echo $offset; exit;
			$this->db->limit($limit, $offset);
		}
		if(!empty($sort_by))
		{
			$this->db->order_by($sort_by, $sort_order);
		}
		$result = $this->db->get('orders');
		if($csv !="")
        {
            
            $this->load->helper('csv');
            query_to_csv($result, TRUE, 'order_report.csv'); 
            exit;
        }
        else
        {
             return $result->result();
        }
		
	}
	
	function get_orders_count($search=false)
	{			
		if ($search)
		{
			if(!empty($search->term))
			{
				//support multiple words
				$term = explode(' ', $search->term);

				foreach($term as $t)
				{
					$not		= '';
					$operator	= 'OR';
					if(substr($t,0,1) == '-')
					{
						$not		= 'NOT ';
						$operator	= 'AND';
						//trim the - sign off
						$t		= substr($t,1,strlen($t));
					}

					$like	= '';
					$like	.= "( `order_number` ".$not."LIKE '%".$t."%' " ;
					$like	.= $operator." `bill_firstname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `bill_lastname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `ship_firstname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `ship_lastname` ".$not."LIKE '%".$t."%'  ";
					$like	.= $operator." `status` ".$not."LIKE '%".$t."%' ";
					$like	.= $operator." `notes` ".$not."LIKE '%".$t."%' )";

					$this->db->where($like);
				}	
			}
			if(!empty($search->start_date))
			{
				$this->db->where('ordered_on >=',$search->start_date);
			}
			if(!empty($search->end_date))
			{
				$this->db->where('ordered_on <',$search->end_date);
			}
			
		}
		
		return $this->db->count_all_results('orders');
	}

	
	
	//get an individual customers orders
	function get_customer_orders($id)
	{
		$this->db->join('order_items', 'orders.id = order_items.order_id');
		$this->db->order_by('ordered_on', 'DESC');
		return $this->db->get_where('orders', array('customer_id'=>$id), 15)->result();
	}
	
	//get an old individual customers orders
	function get_old_customer_orders($id)	{
		
		$this->db->order_by('ordered_on', 'DESC');
		return $this->db->get_where('orders', array('customer_id'=>$id), 15)->result();
	}
	
	
	//get an individual customers orders
	function get_admin_related_orders($admin_id)
	{
		
		$result = $this->db->query('SELECT * , COUNT( oc_order_items.product_id ) items_count , SUM( oc_order_items.quantity ) q_sum
							FROM oc_orders 
							LEFT JOIN oc_order_items 
							ON oc_orders.id = oc_order_items.order_id
							LEFT JOIN oc_commission 
							ON oc_order_items.product_id = oc_commission.comm_level_id
							WHERE oc_orders.admin_id ='.$admin_id.'							
							GROUP BY oc_order_items.product_id');
							
		return $result->result_array();
	}
		function get_courses_commission($admin_id)
	{
		
		$result = $this->db->query('SELECT * , COUNT( oc_order_items.product_id ) items_count , SUM( oc_order_items.quantity ) q_sum
							FROM oc_orders 
							LEFT JOIN oc_order_items 
							ON oc_orders.id = oc_order_items.order_id
							LEFT JOIN oc_commission 
							ON oc_order_items.product_id = oc_commission.comm_level_id
							WHERE oc_commission.comm_level = "course_level"
							AND
							oc_orders.admin_id ='.$admin_id.'							
							GROUP BY oc_order_items.product_id');
							
		return $result->result_array();
	}
	
	function get_cat_commission($cat_id)
	{ 
		$result = $this->db->query('SELECT * FROM oc_commission
									WHERE comm_level="cat_level"
									 AND comm_level_id = '.$cat_id.'
									 AND comm_active = "Yes"
									 
									');
									//echo $this->db->last_query();exit;
									return $result->result_array();
	}
	
	function get_course_provider_commission($admin_id)
	{
		$result = $this->db->query('SELECT * 
									FROM oc_commission
									JOIN oc_admin ON oc_commission.comm_level_id = oc_admin.id
									WHERE oc_commission.comm_level = "course_provider"
									AND
									  oc_admin.id = '.$admin_id.'
									');
									//echo $this->db->last_query(); exit;
									return $result->result_array();
	}
	
		function get_universal_commission()
	{
		$result = $this->db->query('SELECT * 
									FROM oc_commission
									WHERE comm_level = "universal"
									AND
									 comm_active = "yes" 
									');
									//echo $this->db->last_query(); exit;
									return $result->result_array();
	}
	
	
	
	function count_customer_orders($id)
	{
		$this->db->where(array('customer_id'=>$id));
		return $this->db->count_all_results('orders');
	}
	
	function get_order($id)
	{
		$this->db->where('id', $id);
		$result 			= $this->db->get('orders');
		
		$order				= $result->row();
		$order->contents	= $this->get_items($order->id);
		
		return $order;
	}
	
	function get_items($id)
	{
		$this->db->select('order_id, contents');
		$this->db->where('order_id', $id);
		$result	= $this->db->get('order_items');
		
		$items	= $result->result_array();
		
		$return	= array();
		$count	= 0;
		foreach($items as $item)
		{

			$item_content	= unserialize($item['contents']);
			
			//remove contents from the item array
			unset($item['contents']);
			$return[$count]	= $item;
			
			//merge the unserialized contents with the item array
			$return[$count]	= array_merge($return[$count], $item_content);
			
			$count++;
		}
		return $return;
	}
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('orders');
		
		//now delete the order items
		$this->db->where('order_id', $id);
		$this->db->delete('order_items');
	}
	
	function save_order($data, $contents = false)
	{
		if (isset($data['id']))
		{
			$this->db->where('id', $data['id']);
			$this->db->update('orders', $data);
			$id = $data['id'];
			
			// we don't need the actual order number for an update
			$order_number = $id;
		}
        else if(!empty($data['order_number']))
        {
            
            $this->db->where('order_number', $data['order_number']);
            $this->db->update('orders', $data);
                        
            //return the order id we generated
            $order_number = $data['order_number'];
            
        }       
		else
		{
			$this->db->insert('orders', $data);
			$id = $this->db->insert_id();
			
			//create a unique order number
			//unix time stamp + unique id of the order just submitted.
			$order	= array('order_number'=> date('U').$id);
			
			//update the order with this order id
			$this->db->where('id', $id);
			$this->db->update('orders', $order);
						
			//return the order id we generated
			$order_number = $order['order_number'];
		}
		
		//if there are items being submitted with this order add them now
		if($contents)
		{
			// clear existing order items
			$this->db->where('order_id', $id)->delete('order_items');
			// update order items
			foreach($contents as $item)
			{
				$save				= array();
				$save['contents']	= $item;
				
				$item				= unserialize($item);
				$save['product_id'] = $item['id'];
				$save['quantity'] 	= $item['quantity'];
				$save['order_id']	= $id;
				$this->db->insert('order_items', $save);
			}
		}
		
		return $order_number;

	}
	
	function get_best_sellers($start, $end)
	{
		if(!empty($start))
		{
			$this->db->where('ordered_on >=', $start);
		}
		if(!empty($end))
		{
			$this->db->where('ordered_on <',  $end);
		}
		
		// just fetch a list of order id's
		$orders	= $this->db->select('id')->get('orders')->result();
		
		$items = array();
		foreach($orders as $order)
		{
			// get a list of product id's and quantities for each
			$order_items	= $this->db->select('product_id, quantity')->where('order_id', $order->id)->get('order_items')->result_array();
			
			foreach($order_items as $i)
			{
				
				if(isset($items[$i['product_id']]))
				{
					$items[$i['product_id']]	+= $i['quantity'];
				}
				else
				{
					$items[$i['product_id']]	= $i['quantity'];
				}
				
			}
		}
		arsort($items);
		
		// don't need this anymore
		unset($orders);
		
		$return	= array();
		foreach($items as $key=>$quantity)
		{
			$product				= $this->db->where('id', $key)->get('products')->row();
			if($product)
			{
				$product->quantity_sold	= $quantity;
			}
			else
			{
				$product = (object) array('sku'=>'Deleted', 'name'=>'Deleted', 'quantity_sold'=>$quantity);
			}
			
			$return[] = $product;
		}
		
		return $return;
	}
	
	function request_for_tutor($data)
	{
		
		$this->db->insert('for_tutor_request', $data);
		return $id = $this->db->insert_id();	
		
	}
	function get_processing_order()
	{	
		$this->db->where('status','Processing');
		$result	= $this->db->get('orders');
		return $result->result();
	}
	function get_delivered_oder()
	{
		$this->db->where('status','Delivered');
		$result = $this->db->get('orders');
		return $result->result();
	}
	function get_cancelled_order()
	{
		$this->db->where('status','Cancelled');
		$result = $this->db->get('orders');
		return $result->result();
		
	}
	
	function get_order_by_order_number($order_number)
	{
		$this->db->where('order_number', $order_number);
		$result 			= $this->db->get('orders');		
		$order				= $result->row();
		$order->contents	= $this->get_items($order->id);
		
		return $order;
	}
	
	function search_order ($search= array() , $csv = '')
	{
		if(!empty($search['categories']))
		{
             
			
			$result 	= $this->db->query("SELECT * FROM oc_orders 
						   JOIN oc_order_items
						   ON  oc_orders.id = oc_order_items.order_id 
						   JOIN oc_category_products
						   ON oc_order_items.product_id = oc_category_products.product_id
						   WHERE oc_category_products.category_id = '".$search['categories']."'");
			
			
			//return $result->result();
			
		}
		elseif(!empty($search['courses']))
		{
			
			$result 	= $this->db->query("SELECT * FROM oc_orders JOIN oc_order_items
						   ON  oc_orders.id = oc_order_items.order_id 
						   WHERE oc_order_items.product_id = '".$search['courses']."'");
			
			
			//return $result->result();
			
		}
		elseif(!empty($search['courses_provider']))
		{
			$this->db->where('admin_id', $search['courses_provider']);
			$result 	= $this->db->get('orders');
			
			//return $result->result();
			
		}
		elseif(!empty($search['start_date']) && !empty($search['end_date']))
		{
			$result = $this->db->query("SELECT * FROM oc_orders 
										WHERE ordered_on 
										BETWEEN '".$search['start_date']."' AND '".$search['end_date']."'
										");
				//return $result->result();
		}
		elseif(!empty($search['date']))
		{
			if($search['date']=="week")
			{
				$result = $this->db->query("select * from oc_orders where ordered_on >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
				//echo $this->db->last_query(); exit;
				//return $result->result();
			}
			if($search['date']=="month")
			{
				$result = $this->db->query("select * from oc_orders where ordered_on >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");
				//echo $this->db->last_query(); exit;
				//return $result->result();
			}
			if($search['date']=="year")
			{
				$result = $this->db->query("select * from oc_orders where ordered_on >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");
				//return $result->result();
			}
			
            
		}
        if($csv !="")
        {
            
            $this->load->helper('csv');
            query_to_csv($result, TRUE, 'order_report.csv'); 
            exit;
        }
        else
        {
            return $result->result();
        }
	}
	
	function get_sales_record($data)
	{
		
		$this->db->like('status', $data['date_status']);
		
		if(!empty($data['payment_method']))
		{
			$this->db->like('payment_info', $data['payment_method']); 
		}	
		
		if(empty($data['search_custom']) && $data['search_custom'] !='on')
		{
			if(!empty($data['date_preset']) && $data['date_preset'] == 'last_month')
			{
				$start_date = date('Y-m-d', strtotime('-1 months'));
				$end_date 	= date('Y-m-d');
				$this->db->where('ordered_on >=', $start_date);
				$this->db->where('ordered_on <=', $end_date);				
			}
			else if(!empty($data['date_preset']) && $data['date_preset'] == 'last_month')
			{
				$this->db->where('ordered_on <=', date('Y-m-d'));
			}
			else if(!empty($data['date_preset']) && $data['date_preset'] == 'this_month')
			{
				$this->db->where('ordered_on =', date('Y-m-d'));
			}
		}
		else if(!empty($data['start_date']) && !empty($data['end_date']))
		{
			$this->db->where('ordered_on >=', $data['start_date']);
			$this->db->where('ordered_on <=', $data['end_date']);    		
		}
		
		if(isset($data['courses_provider']) && !empty($data['courses_provider']))
		{		
			$this->db->where('admin_id', $data['courses_provider']); 
		}
		
		
		$this->db->select('order_number	, customer_id, status, tax,	total, subtotal, status_message, payment_info, product_name');
		$this->db->from('orders');
		$result = $this->db->get();		
		//echo '<pre>'; print_r($this->db->last_query());exit;
		//return $result->result_array();
		return $result;
	}
	
	function get_partial_customer_orders()
	{
		$query = $this->db->query("SELECT * FROM (`oc_orders`) JOIN `oc_customers` ON `oc_orders`.`customer_id` = `oc_customers`.`id` WHERE `is_partial` = '1'");		
		//echo '<pre>'; print_r($query->result_array());exit;
		return $query->result_array();
	}
	
	function order_paid_status($data)
	{
	
		$this->db->where('id', $data['id']);
		$this->db->update('oc_orders', $data);
		return true;
	}
}