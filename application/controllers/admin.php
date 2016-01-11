
<?php

class Admin extends CI_Controller{
    
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
            $query = $this->main_content_model->validate_m($email,$password); 
            
        if(is_array($query)){
            $this->session->set_userdata('superadminemail',$query[0]['email']);
            $this->session->set_userdata('superadminrole',$query[0]['fk_role_id']);
                
            if($query[0]['fk_role_id']==1){
               // redirect('admin/listing');  
                redirect('superadmin'); 
            }
        }else{
                $ad['error']='Invalid userid and password';
                $this->load->view('login/loginHeader');
                $this->load->view('login/login',$ad);
                $this->load->view('login/loginFooter');
             }
        }
    }
    
  /*    function logout(){
        
        $this->session->sess_destroy();
        redirect(site_url('admin'));
    }
    
  function listing(){ 
        
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
        $this->load->view('careerList',$data);
        $this->load->view('data/listFooter',$data);
    }*/
}
