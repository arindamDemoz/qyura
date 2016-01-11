<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Test controller
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
         $this->load->model('main_content_model');
    }

    /**
     * Display a list of test data.
     *
     * @return void
     */
    public function index()
    {
        
    
        if(!$this->session->userdata('email'))
        { redirect(base_url()); }

        $options = array('table' => 'carrier','order'=>array('createAt'=>'desc'));
        $data['carrierData'] = $this->main_content_model->customGet($options);
        
        $options = array('table' => 'callback','order'=>array('createAt'=>'desc'));
        $data['callbackList'] = $this->main_content_model->customGet($options);
        
//        $options = array('table' => 'partner','order'=>array('createAt'=>'desc'));
//        $data['partnerList'] = $this->main_content_model->customGet($options);

    $options = array('table' => 'emailList','order'=>array('createAt'=>'desc'));
        $data['emailList'] = $this->main_content_model->customGet($options);
        
        $this->load->view('data/listHeader',$data);
        $this->load->view('data/careerList',$data);
        $this->load->view('data/listFooter',$data);
    
    }


     function logout(){
       
       $this->session->sess_destroy();
        redirect(site_url('admin'));
    }
    
}