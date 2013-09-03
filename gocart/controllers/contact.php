<?php
  class Contact extends Front_Controller {

    function __construct()
    {
        parent::__construct();
        
        //make sure we're not always behind ssl
        remove_ssl();
    }
    function index()
    {
        //DebugBreak();
        $this->load->model(array('Banner_model', 'box_model'));
        $this->load->helper('directory');

        $data['gift_cards_enabled'] = $this->gift_cards_enabled;
        $data['banners']            = $this->Banner_model->get_homepage_banners(5);
        $data['boxes']                = $this->box_model->get_homepage_boxes(4);
        $data['homepage']            = true;
        
        //$this->load->view('homepage', $data);
        $this->load->view('index');
    }
  }
?>
