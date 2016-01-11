<?php

class Sales extends CI_Controller{
    
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
            $query = $this->main_content_model->validate_sales($email,$password); 
            
        if(is_array($query)){

            $this->session->set_userdata('email',$query[0]['email']);
            $this->session->set_userdata('role',$query[0]['fk_role_id']);
                
            if($query[0]['fk_role_id']==1){
                redirect('sales/listing');  
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
        redirect(site_url('sales'));
    }
    
    function listing(){ 
        
        if(!$this->session->userdata('email'))
        { redirect(base_url()); }
        
        $options = array('table' => 'partner','order'=>array('createAt'=>'desc'));
        $data['partnerList'] = $this->main_content_model->customGet($options);
        
        $this->load->view('data/listHeader',$data);
        $this->load->view('data/salesList',$data);
        $this->load->view('data/listFooter',$data);
    }
}
