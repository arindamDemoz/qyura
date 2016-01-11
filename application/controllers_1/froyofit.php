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

                    $data['emailList'] = $this->input->post('EMAIL');
                    $data['createAt'] = date('Y-m-d H:i:s');

                    $options = array
                        (
                        'data'  => $data,
                        'table' => 'emailList'
                    );
                    
                    $id = $this->main_content_model->customInsert($options);
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
