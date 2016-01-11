<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Dashboard controller
 */
class Dashboard extends MY_Controller
{
   
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a list of test data.
     *
     * @return void
     */
    public function index()
    {
        
      // echo $this->session->userdata('superadminemail')."test";
       //exit;
//        if(!$this->session->userdata('email'))
//        { redirect(base_url()); }

//        $options = array('table' => 'carrier','order'=>array('createAt'=>'desc'));
//        $data['carrierData'] = $this->main_content_model->customGet($options);
        
//        $options = array('table' => 'callback','order'=>array('createAt'=>'desc'));
//        $data['callbackList'] = $this->main_content_model->customGet($options);
        
//        $options = array('table' => 'partner','order'=>array('createAt'=>'desc'));
//        $data['partnerList'] = $this->main_content_model->customGet($options);

//        $options = array('table' => 'emailList','order'=>array('createAt'=>'desc'));
//        $data['emailList'] = $this->main_content_model->customGet($options);
//        $head = $this->header();
//        $data['servicesArray'] = $head;
        
        $options = array('table' => 'services');
        $data['servicesArray'] = $this->main_content_model->customGet($options);
        
        $this->load->view('data/superHeader',$data);
        $this->load->view('data/deshboard',$data);
        $this->load->view('data/superFooter',$data);
    
    }
    
 
     function logout(){
        
        $this->session->sess_destroy();
        redirect(site_url('admin'));
    }
    
}