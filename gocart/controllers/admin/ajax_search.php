<?php
 class ajax_search extends Admin_Controller {    
    function __construct()
    {        
        parent::__construct();
    }
    
   function get_courses_by_id()
    {
        $id             = $this->input->post('productid');
        $courses        = $this->Product_model->get_products($id);
        $i              = 0;
        foreach($courses as $course):
        
             if($i=='0')
             {?>
                 <option value="">Courses</option>
                 
            <?}
            
            ?>
                <option value="<?php echo $course->id;?>"><?php echo $course->name;?></option> 
            <? 
                $i     = 1;
        endforeach;
        
    }
   function get_courses_pro_by_id()
    {
        $id                 = $this->input->post('coursesid');
        $courses_pro        = $this->Product_model->get_product($id);
        $admin              = $this->auth->get_admin($courses_pro->admin_id);
         ?>
         <option value="">Courses Provider</option> 
          <option value="<?php echo $admin->id;?>"><?php echo $admin->firstname.' '.$admin->lastname;?></option>
         <?
    }
    
    function get_customer_email()
    {
        $id                 = $this->input->post('customer_id');
        $customer           = $this->Customer_model->get_customer($id);
        //$this->show->pe($customer);
         ?>
         <option value="">Customer E-mail</option> 
          <option value="<?php echo $customer->id;?>"><?php echo $customer->email;?></option>
         <?
    }
    function get_course_provider_email()
    {
        $id                 = $this->input->post('course_provider_id');
        $course_provider           = $this->auth->get_admin($id);
        //$this->show->pe($customer);
         ?>
         <option value="">Course Provider E-mail</option> 
          <option value="<?php echo $course_provider->id;?>"><?php echo $course_provider->email;?></option>
         <?
    }
}   

?>