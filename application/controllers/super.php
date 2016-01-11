<?php

class Super extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('main_content_model');
    }
    
    function index(){
        $this->load->view('login/loginHeader');
        $this->load->view('login/login');
        $this->load->view('login/loginFooter');
    }
            
    function validate(){
        
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
        
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $query = $this->main_content_model->validate_s($email,$password); 
            
        if(is_array($query)){

            $this->session->set_userdata('email',$query[0]['email']);
            $this->session->set_userdata('role',$query[0]['fk_role_id']);
                
            if($query[0]['fk_role_id']==1){
                redirect('super/superServices');  
            }
        }else{
                $ad['error']='Invalid userid and password';
                $this->load->view('login/loginHeader');
                $this->load->view('login/login',$ad);
                $this->load->view('login/loginFooter');
             }
        }
    }
    
    function logout(){
        
        $this->session->sess_destroy();
        redirect(site_url('super'));
    }
    
    function header(){
        
//        $vendorId = $this->session->userdata('vendorId'); 
        $vendorId = 1;
        $option = array(
            'table' => 'vendorMaster',
            'select' => 'serviceNames',
            'where' => array('vendorId' => $vendorId),
            'single' => TRUE
        );
        $serviceArray = array();
        $serviceNames = $this->main_content_model->customGet($option);
        $serviceName =  unserialize($serviceNames->serviceNames);
        if(count($serviceName) && !empty($serviceName)){
            foreach($serviceName as $service){
                $option = array(
                    'table' => 'services',
                    'select' => 'serviceName',
                    'where' => array('serviceId' => $service),
                    'single' => TRUE
                );
                    $serviceName = $this->main_content_model->customGet($option);
                    array_push($serviceArray, $serviceName->serviceName);
                }
            }
//        $data['servicesArray'] = $serviceArray;
//        $this->load->view('partners/vendorHeader',$data);
        return $serviceArray;
    }
    
    function superServices(){
        
//        if(!$this->session->userdata('vendorEmail'))
//        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
//            redirect(site_url('partners')); }
        $head = $this->header();
        $data['servicesArray'] = $head;
        $this->load->view('super/superHeader',$data);
        $this->load->view('super/deshboard');
        $this->load->view('super/superFooter');
    }
    
    function listing(){ 
        
        if(!$this->session->userdata('email'))
        { redirect(base_url()); }

        $options = array('table' => 'carrier','order'=>array('createAt'=>'desc'));
        $data['carrierData'] = $this->main_content_model->customGet($options);
        
        $options = array('table' => 'callback','order'=>array('createAt'=>'desc'));
        $data['callbackList'] = $this->main_content_model->customGet($options);
        
        $options = array('table' => 'partner','order'=>array('createAt'=>'desc'));
        $data['partnerList'] = $this->main_content_model->customGet($options);

	$options = array('table' => 'emailList','order'=>array('createAt'=>'desc'));
        $data['emailList'] = $this->main_content_model->customGet($options);
       
        $this->load->view('careerList',$data);
    }
}
