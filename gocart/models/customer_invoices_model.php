<?php
Class Customer_Invoices_model extends CI_Model
{

    function get_all_invoices($field='invoice_id', $by='ASC', $page=0, $rows=5 , $term =false , $csv = '')
    {
         //$query  = $this->db->query('SELECT i.*, ia.invoice_item_subtotal, ia.invoice_item_tax_total, ia.invoice_total  FROM oc_customer_invoices i LEFT JOIN oc_customer_invoice_amounts ia ON i.invoice_id = ia.invoice_id ORDER BY i.'.$field.' '.$by.' LIMIT '.$page.', '.$rows);  
            if(!empty($term))
            {
                $search    = json_decode($term);
            }
          if(empty($search->date)) {
          $this->db->select('i.*, ia.invoice_item_subtotal, ia.invoice_item_tax_total, ia.invoice_total');
          $this->db->from('oc_customer_invoices i');
          $this->db->join('oc_customer_invoice_amounts ia' , 'i.invoice_id = ia.invoice_id','left');
          $this->db->order_by('i.'.$field.'' , $by);
          $this->db->limit($rows,$page);
            }
          if(!empty($term))
            {
                $search    = json_decode($term);
                //if we are searching dig through some basic fields
                if(!empty($search->term))
                {
                    $this->db->like('i.invoice_id', $search->term);
                   // $this->db->or_like('lastname', $search->term);
                   // $this->db->or_like('email', $search->term);
                   // $this->db->or_like('phone', $search->term);
                    
                    //$this->db->or_like('city', $search->term);
                    //$this->db->or_like('state', $search->term);
                    //$this->db->or_like('country', $search->term);
                    
                }
                
                if(!empty($search->date))
                {
                     if($search->date == 'month')
                     {
                         $query =  $this->db->query('select * from oc_customer_invoices  where oc_customer_invoices.invoice_date_created >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)') ;
                     }
                     if($search->date == 'quarter')
                     {
                          $query =  $this->db->query('select * from oc_customer_invoices  where oc_customer_invoices.invoice_date_created >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)') ;  
                     }
                     if($search->date == 'year')
                     {
                         $query =  $this->db->query('select * from oc_customer_invoices  where oc_customer_invoices.invoice_date_created >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)') ; 
                     } 
                }
                
                if(!empty($search->admin_id))
                {
                    //lets do some joins to get the proper category products
                    
                    $this->db->where('i.admin_id', $search->admin_id);
                    //$this->db->order_by('firstname', 'ASC');
                }
            }
         if(empty($search->date))
         {  
        $query = $this->db->get();
         }
        //$this->show->pe($this->db->last_query());
        if($csv !="")
        {
            
            $this->load->helper('csv');
            query_to_csv($query, TRUE, 'sales_report.csv'); 
            exit;
        }
        else
        {
            $result = $query->result_array();
            if(count($result)>0)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }    
    }

    
	function get_count_invoices()
	{
		return $this->db->count_all_results('customer_invoices');	
	}
	
    function get_invoice($id)
    {
        return $this->db->get_where('customer_invoices', array('invoice_id'=>$id))->row();
    }    
        
    function save($invoice)
    {
        $this->db->insert('customer_invoices', $invoice);
		return $this->db->insert_id();      
    }
    
    function delete($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('oc_customer_invoices');
		return true;    
    }	
	
	function get_all_customer($customer_id = '')
	{
		$this->db->select('*');		
		$this->db->where('active', '1');
		
		if(!empty($admin_id))
		$this->db->where('id', $customer_id);
		
		$result	= $this->db->get('customers');
		$result	= $result->result_array();
		//print_r($this->db->last_query());
		//$this->show->pe($result);
		return $result;
	}	
	
	function get_all_groups($group_id = '')
	{
		$this->db->select('*');		
		
		if(!empty($group_id))
		{
			$this->db->where('invoice_group_id', $group_id);
		}
		$this->db->where('invoice_group_for', 'customer');
		$result	= $this->db->get('invoice_groups');
		$result	= $result->result_array();		
		return $result;
	}
				
	function insert_invoice_items($data)
	{
			
		$this->db->insert('customer_invoice_items', $data);
		return $this->db->insert_id();  
	}	
	
	function insert_invoice_items_totals($data)
	{
		
		$this->db->insert('customer_invoice_item_amounts', $data);
		return $this->db->insert_id();
	}
	
	function get_invoice_items_by_invoice_id($invoice_id)
	{
		$invoice_items = $this->db->query("SELECT * FROM oc_customer_invoice_items it LEFT JOIN oc_customer_invoice_item_amounts iia ON it.item_id = iia.item_id WHERE it.invoice_id = ".$invoice_id." ORDER BY  it.item_id ASC ");
		$result 	   = $invoice_items->result_array($invoice_items);
		//$this->show->pe($result);
		return $result;
	}
	
	function save_invoice_totals($data)
	{
			$this->db->query("DELETE FROM oc_customer_invoice_amounts WHERE invoice_id =".$data['invoice_id']);
			$this->db->insert('oc_customer_invoice_amounts', $data);
			return $this->db->insert_id();
	}
	
	function get_invoice_totals($invoice_id)
	{
			$invoice_items = $this->db->query("SELECT * FROM oc_customer_invoice_amounts  WHERE invoice_id = ".$invoice_id);
			$result 	   = $invoice_items->result_array($invoice_items);
			return $result;
	}
		
	function delete_all_items($invoice_id)
	{
	
		$this->db->query("DELETE FROM oc_customer_invoice_item_amounts  WHERE EXISTS (SELECT item_id FROM oc_customer_invoice_items  WHERE oc_customer_invoice_items.invoice_id =".$invoice_id." AND oc_customer_invoice_items.item_id = oc_customer_invoice_item_amounts.item_id)");
		$this->db->query("DELETE FROM  oc_customer_invoice_items  WHERE invoice_id =".$invoice_id);		
		return true;
		
	}
	
	function invoice_paid_status($invoice_id, $status)
	{
		//echo $status.'-----'.$invoice_id;
		if(!empty($invoice_id))
		{
			$this->db->query("UPDATE oc_customer_invoices SET invoice_paid_status = '".strtoupper($status)."' WHERE invoice_id = ".$invoice_id);
		}
		return true;
	}
	
	
	function get_invoice_customer($invoice_id)
	{
		$invoice_items = $this->db->query("SELECT customer_id FROM oc_customer_invoices  WHERE invoice_id = ".$invoice_id);
		$result 	   = $invoice_items->row();
		//$this->show->pe($result);
		$result_admin	= $this->db->get_where('admin', array('id'=>$result->admin_id, 'status'=>'1'));
		
		return $result_admin->row();
		
	}
	
    function get_invoice_customerss($invoice_id)
    {
        $invoice_items = $this->db->query("SELECT customer_id FROM oc_customer_invoices  WHERE invoice_id = ".$invoice_id);
        $result        = $invoice_items->row();
        //$this->show->pe($result);
        $result_admin    = $this->db->get_where('customers', array('id'=>$result->customer_id));
        
        return $result_admin->row();
        
    }
	function save_recurring_invoice($data)
	{
			$this->db->query("DELETE FROM oc_customer_invoices_recurring WHERE invoice_id =".$data['invoice_id']);
			$this->db->insert('oc_customer_invoices_recurring', $data);
			return $this->db->insert_id();
	}
	
	function get_recurring_invoices()
	{
	
		//$invoice_items = $this->db->query("SELECT * FROM oc_customer_invoices JOIN oc_customer_invoices_recurring ON oc_customer_invoices.invoice_id  = oc_customer_invoices_recurring.invoice_id  WHERE oc_customer_invoices_recurring.recur_flag = 'yes'");
		
		 $invoice_items  = $this->db->query('SELECT i.*, ia.invoice_item_subtotal, ia.invoice_item_tax_total, ia.invoice_total  FROM oc_customer_invoices i LEFT JOIN oc_customer_invoice_amounts ia ON i.invoice_id = ia.invoice_id JOIN oc_customer_invoices_recurring  irec ON irec.invoice_id = i.invoice_id WHERE irec.recur_flag = "yes"  ORDER BY i.invoice_id ASC');  
		return $result 	   = $invoice_items->result_array();
		//$this->show->pe($result);
	}
}
?>