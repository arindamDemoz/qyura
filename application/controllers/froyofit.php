<?php

class Froyofit extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    
        $this->load->model('main_content_model');
        $this->load->library('form_validation');
        
    }
    
    function index(){
        $this->load->view('froyoHome/froyoHeader');
        $this->load->view('froyoHome/froyoView');
        $this->load->view('froyoHome/froyoFooter');
    }
    
    function carrierViewFn(){
        $this->load->view('carrierView');
    }
    
    function emailList(){
        
        $this->form_validation->set_rules('EMAIL', 'Email', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>ajax_validation_errors());
            echo json_encode($responce);
        } else {

            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                    $data['emailList'] = $email= $this->input->post('EMAIL');
                    $data['createAt'] = date('Y-m-d H:i:s');

                    $options = array
                        (
                        'data'  => $data,
                        'table' => 'emailList'
                    );
                    
                    $id = $this->main_content_model->customInsert($options);
                    
                    $this->email->from('userInfo@froyofit.com', 'Team Froyofit');
                    $this->email->to($email);
            //        $this->email->bcc('them@their-example.com');

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear User,
                        
                        Thank you for showing interest in our services.You will be the first to be notified as soon as we launch our services. Meanwhile please follow us on our social media channels below to stay updated with the latest happenings at froyofit.com ,
                        
                        Facebook : https://www.facebook.com/froyofit
                        Twitter : https://twitter.com/FroyoFit
                        Linkedin : https://www.linkedin.com/company/froyofit");
                    $this->email->send();
                        
                if ($id) {
                    $responce =  array('status'=>1,'msg'=>'Hey thanks for providing these details. We will come back to you. Ciao till then!');
                } else {
                    $error = array("TopError"=>"<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
                }
                echo json_encode($responce);
            }
        }
    
    }

    function carrierSaveFn(){

        $this->form_validation->set_rules('carrierName', 'Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('carrierEmail', 'Email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('carrierPhone', 'Phone', 'required|xss_clean|trim');
        $this->form_validation->set_rules('carrierPosition', 'Position', 'required|xss_clean|trim');
        $this->form_validation->set_rules('carrierCity', 'City', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                $data = $this->input->post();

                $path = "assest/resume/"; // Upload directory
                $name = $_FILES['carrierResume']['name'];

                // Loop $_FILES to exeicute all files

                if ($_FILES['carrierResume']['error'] == 4) {
                    $this->session->set_flashdata('err_msg', 'Please try another image!.');
                } else { // No error found! Move uploaded files 
                    $name = time() . $name;
                    $data["carrierResume"] = base_url().'assest/resume/'.$name;
                    $imdsucc = move_uploaded_file($_FILES["carrierResume"]["tmp_name"], $path . $name);
                }

                if ($imdsucc) {

                    chmod($path . $name, 0777);

                    $data['createAt'] = date('Y-m-d H:i:s');

                    $options = array
                        (
                        'data'  => $data,
                        'table' => 'carrier'
                    );
                    
                    $id = $this->main_content_model->customInsert($options);
                    
                    $this->email->from('career@froyofit.com', 'Team Froyofit');
                    $this->email->to($this->input->post('carrierEmail'));

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear Applicant,
                        
                        Thank you for providing your details and applying to froyofit.com. We will go through your application and get in touch with you soon if your profile is found suitable. Meanwhile, please follow us on our social media channels below to know more about us.
                        
                        Facebook : https://www.facebook.com/froyofit
                        Twitter : https://twitter.com/FroyoFit
                        Linkedin : https://www.linkedin.com/company/froyofit");
                    $this->email->send();
                    
//                  Admin Mail
                    
                    $this->email->from('customersupport@froyofit.com', 'Team Froyofit');
                    $this->email->to('admin@froyofit.com');

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear admin, 
                        
                        Applicant {$this->input->post('carrierName')} applied for the
post of {$this->input->post('carrierPosition')} with following details:
                        
                        Email id : {$this->input->post('carrierEmail')}
                        Number : {$this->input->post('carrierPhone')}
                        City : {$this->input->post('carrierCity')}
                        
                        ");
                    $this->email->send();
                    
                }
                if ($id) {
                    $responce =  array('status'=>1,'msg'=>'Your Information submited successfully');
                } else {
                    $error = array("TopError"=>"<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
                }
                echo json_encode($responce);
            }
        }
    }
    
    function requestCallback(){

        $this->form_validation->set_rules('callbackName', 'Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('callbackMobile', 'Email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('callbackEmail', 'Phone', 'required|xss_clean|trim');
        $this->form_validation->set_rules('callbackTime', 'Callback Time', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>ajax_validation_errors());
            echo json_encode($responce);
        } else {

            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                    $data = $this->input->post();
                    $data['createAt'] = date('Y-m-d H:i:s');

                    $options = array
                        (
                        'data'  => $data,
                        'table' => 'callback'
                    );
                    
                    $id = $this->main_content_model->customInsert($options);
                    
                    $this->email->from('customersupport@froyofit.com', 'Team Froyofit');
                    $this->email->to($this->input->post('callbackEmail'));

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear {$this->input->post('callbackName')},
                        
                        Thank you for the details you have provided. Our representative will soon get in touch with you. Meanwhile, please follow us on our social media channels below to know more about us.
                        
                        Facebook : https://www.facebook.com/froyofit
                        Twitter : https://twitter.com/FroyoFit
                        Linkedin : https://www.linkedin.com/company/froyofit");
                    $this->email->send();
                    
//                    Admin Mail
                    if($this->input->post('callbackTime') == 1){$time = "Before 10 AM";}
                    elseif($this->input->post('callbackTime') == 2){$time = "10 AM - 2 PM";}
                    elseif($this->input->post('callbackTime') == 3){$time = "2 PM - 6 PM";}
                    elseif($this->input->post('callbackTime') == 4){$time = "6 PM - 10 PM";}
                    
                    $this->email->from('customersupport@froyofit.com', 'Team Froyofit');
                    $this->email->to('admin@froyofit.com');

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear admin, 
                        
                        {$this->input->post('callbackName')} contacted you with following details:
                            
                        Name : {$this->input->post('callbackName')}
                        Email id : {$this->input->post('callbackEmail')}
                        Number : {$this->input->post('callbackMobile')}
                        Preferred time : {$time}
                        
                        ");
                    $this->email->send();
                    
                if ($id) {
                    $responce =  array('status'=>1,'msg'=>'Hey thanks for providing these details. We will come back to you. Ciao till then!');
                } else {
                    $error = array("TopError"=>"<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
                }
                echo json_encode($responce);
            }
        }
    }
    
    function partnerWithUs (){

        $this->form_validation->set_rules('partnerName', 'Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('partnerEmail', 'Email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('partnerMobile', 'Phone', 'required|xss_clean|trim');
        $this->form_validation->set_rules('partnerLocation', 'Location', 'required|xss_clean|trim');
        $this->form_validation->set_rules('partnerService', 'Service', 'required');

        if ($this->form_validation->run() == FALSE) {
            $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>ajax_validation_errors());
            echo json_encode($responce);
        } else {

            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                    $data = $this->input->post();
                    $services= $this->input->post('partnerService');
                    $servicesId = implode(",", $services);
                    unset($data['partnerService']);
                    
                    $data['partnerService'] = $servicesId;
                    $data['createAt'] = date('Y-m-d H:i:s');

                    $options = array
                        (
                        'data'  => $data,
                        'table' => 'partner'
                    );
                    
                    $id = $this->main_content_model->customInsert($options);
                    
                    $this->email->from('partners@froyofit.com', 'Team Froyofit');
                    $this->email->to($this->input->post('partnerEmail'));

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear {$this->input->post('partnerName')},
                        
                        Thank you for showing keen interest in joining us. To initiate further procedure of registration, our representative will soon get in touch with you. Meanwhile, you can follow us on below mentioned links
                        
                        Facebook : https://www.facebook.com/froyofit
                        Twitter : https://twitter.com/FroyoFit
                        Linkedin : https://www.linkedin.com/company/froyofit");
                    $this->email->send();
                    
//                    Admin Mail
                   
                    $this->email->from('partners@froyofit.com', 'Team Froyofit');
                    $this->email->to('admin@froyofit.com');

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear admin, 
                        
                        {$this->input->post('partnerName')} contacted you with following details:
                            
                        Name : {$this->input->post('partnerName')}
                        Email id : {$this->input->post('partnerEmail')}
                        Number : {$this->input->post('partnerMobile')}
                        Location: {$this->input->post('partnerLocation')}
                        Services: {$servicesId}
                        Any other fitness related activity : {$this->input->post('otherServiceText')}
                        
                        ");
                    $this->email->send();
                    
                if ($id) {
                    $responce =  array('status'=>1,'msg'=>'Hey thanks for providing these details. We will come back to you. Ciao till then!');
                } else {
                    $error = array("TopError"=>"<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
                }
                echo json_encode($responce);
            }
        }
    }
}
