<?php 

class Search extends Front_Controller {



    function __construct()

    {

        parent::__construct();
        //make sure we're not always behind ssl
        remove_ssl();

    }
    
    
    function index()
    {
        
        $data['search_results']                     = $this->Category_model->fornt_ent_search_cat();
        
        
        if($this->input->post('sear')!="")
        {
            
            $search_field                           = $this->input->post('search_field');
            $data['search_results']                 = $this->Category_model->fornt_ent_search($search_field);
            //$this->show->pe($data['search_results']);
        }
        if($this->input->post('search_by')!="")
        {
                
            $post                                   = $this->input->post(null,false);
            $critaria                               = $this->input->post('search_by');
           
            
            if($critaria == 'category')
            {
                $search_field                       = $this->input->post('search_field');
                $data['search_results']             = $this->Category_model->fornt_ent_search_cat($search_field);
                //$this->show->pe($data['search_results']);
            }
            
            if($critaria == 'sub_cat')
            {
                $search_field                       = $this->input->post('search_field'); 
                $data['search_results']             = $this->Category_model->fornt_ent_search_subcat($search_field);
                
                //$this->show->pe($this->db->last_query() );
            }
            
            if($critaria == 'keyword')
            {
               $search_field                        = $this->input->post('search_field'); 
               $data['search_results']              = $this->Category_model->fornt_ent_search_keywords($search_field);
               //$this->show->pe($this->db->last_query() );  
            }
            
            if($critaria == 'price')
            {
                $data['product'] = 'product';
               $search_field                        = $this->input->post('search_field'); 
               $data['search_results']              = $this->Category_model->fornt_ent_search_price($search_field);
               
               //$this->show->pe($data['search_results']); 
            }
        }
        
     $this->load->view('search_result' , $data);     
    }

}