<?php

class Forgot extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('main_content_model');
    }
    
    function index(){
        $this->load->view('login/loginHeader');
        $this->load->view('login/forgotPassword');
        $this->load->view('login/loginFooter');
    }
            
    function forgotPassword(){
        
        $this->form_validation->set_rules('forgotEmail','Email','trim|required|valid_email');
        
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
        
            $email = $this->input->post('forgotEmail');
            if($email){
                $query = "SELECT * FROM (`vendorMaster`) WHERE `centerEmail` =  '$email'";
                $users = $this->main_content_model->customQuery($query);
                
                
                if($users){
                    if($users[0]->active == 1){
                        $length = 10;                
                        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, strlen($characters) - 1)];
                        }
                        $password = md5($randomString);
                        
                        $arrayData = array(
                            'password' => $password
                        );
                        $updateOptions = array(
                            'where'=> array('centerEmail'=>$users[0]->centerEmail),
                            'data' => $arrayData,
                            'table'=> 'vendorMaster'
                        ); 
                        
                        $passwordUpdate = $this->main_content_model->customUpdate($updateOptions);
                        if($passwordUpdate){
                        $this->email->from('forgot@froyofit.com', 'Team Froyofit');
                        $this->email->to($email);
                //        $this->email->bcc('them@their-example.com');

                        $this->email->subject("Froyofit");
                        $this->email->message("Dear {$users[0]->contactPerson},
                            Kindly note down your new Password to log on to our website :
                            Password : $randomString
                            Thank you
                            Team Froyofit.");
                        $send = $this->email->send();
                        }
                        if($passwordUpdate && $send){
                            $this->session->set_flashdata('succ_msg', 'A new password has been sent to your e-mail address..');
                            redirect(site_url('partners'));
                        }else{
                            $ad['error']="Password is not send";
                            $this->load->view('login/loginHeader');
                            $this->load->view('login/forgotPassword',$ad);
                            $this->load->view('login/loginFooter');
                        }
                    }else{
                        $ad['error']="Your account is not active";
                        $this->load->view('login/loginHeader');
                        $this->load->view('login/forgotPassword',$ad);
                        $this->load->view('login/loginFooter'); }
                }else{
                    $ad['error']="Email id does'nt exist";
                    $this->load->view('login/loginHeader');
                    $this->load->view('login/forgotPassword',$ad);
                    $this->load->view('login/loginFooter');
                }
            }
        }
    }
}
