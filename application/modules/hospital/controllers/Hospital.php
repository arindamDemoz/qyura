<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends CI_Controller {
    
   public function __construct() {
       parent:: __construct();
       $this->load->model('hospital_model');
   }
   
   function addHospital (){
       $data = array();
        $data['allStates'] = $this->hospital_model->fetchStates();
       $this->load->view('AddHospital',$data);
   }
   
    function fetchCity (){
        $stateId = $this->input->post('stateId');
        $cityData = $this->hospital_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value= " ">Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='. $val->city_id.'>'. $val->city_name.'</option>';
        }
       echo $cityOption;
        exit;
    }
    
    function SaveHospital(){
       // $ip = $this->input->ip_address();
        //echo $ip;exit;
       //print_r($_POST);exit;
        
         //$imageUrl = $this->input->post('imageData');
        // $imageName = 'user_' . time() . '.png';
        //$imageUrl = $this->getImageBase64Code($imageUrl);
       $this->load->library('form_validation');
         $this->form_validation->set_rules('hospital_name', 'Hospital Name', 'required|trim');
        $this->form_validation->set_rules('hospital_type', 'Hospital Type', 'required|trim');
        $this->form_validation->set_rules('hospital_address', 'Hospital Address', 'required|trim');
       //$this->form_validation->set_rules('hospital_phn', 'Hospital Phone', 'required|trim');
        $this->form_validation->set_rules('hospital_cntPrsn', 'Contact Person', 'required|trim');
        $this->form_validation->set_rules('hospital_mmbrTyp', 'Membership Type', 'required|trim');
        
        $this->form_validation->set_rules('hospital_countryId', 'Hospital Country', 'required|trim');
        $this->form_validation->set_rules('hospital_stateId', 'Hospital StateId', 'required|trim');
        $this->form_validation->set_rules('hospital_cityId', 'hospital City', 'required|trim');
        
        $this->form_validation->set_rules('hospital_mblNo', 'Hospital Mobile No', 'required|trim');
       // $this->form_validation->set_rules('hospital_phn', 'Hospital Phone', 'required|trim');
       // $this->form_validation->set_rules('hospital_phn', 'Hospital Phone', 'required|trim');
       $this->form_validation->set_rules('hospital_zip','Hospital Zip', 'required|trim');
       $this->form_validation->set_rules('hospital_dsgn','Hospital Designation','required|trim');
       $this->form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
       $this->form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
       
         // exit;
       // $this->form_validation->set_rules('hospital_mmbrTyp', 'Membership Type', 'required|xss_clean|trim');
         if ($this->form_validation->run() === FALSE) {
             //echo "sdfsdfsdfs";
             //
            // echo validation_errors();
            // exit;
              $data = array();
                $data['allStates'] = $this->hospital_model->fetchStates();
             $this->load->view('AddHospital',$data);
         }
         else {
        
             $imagesname='';
              if ($_FILES['hospital_photo']['name'] ) {
             $path = realpath(FCPATH.'assets/hospitalsImages/');
                 $config['upload_path'] = $path;
            //echo $config['upload_path']; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                //$field_name = $_FILES['hospital_photo']['name'];
               
		$this->load->library('upload', $config);
               $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('hospital_photo'))
		{
			$error = array('error' => $this->upload->display_errors());
 
                        $data = array();
                        $data['allStates'] = $this->hospital_model->fetchStates();
                        $data['error'] = $error;
                        $this->load->view('AddHospital',$data);
                      
		}
		else
		{
			$imagesname = $_FILES['hospital_photo']['name'];
                       
		}
                
              } 
              //echo "i am here";
                $hospital_phn = $this->input->post('hospital_phn');
                $pre_number = $this->input->post('pre_number');
                 $countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < $countPnone ;$i++) {
                    if($hospital_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].$hospital_phn[$i].'|'; 
                    }
                    
                }
                
                $hospital_name = $this->input->post('hospital_name');
                $hospital_type = $this->input->post('hospital_type');
                $hospital_address = $this->input->post('hospital_address');
                 $hospital_phn = $this->input->post('hospital_phn');
                $hospital_cntPrsn = $this->input->post('hospital_cntPrsn');
                $hospital_dsgn = $this->input->post('hospital_dsgn');
                $hospital_mmbrTyp = $this->input->post('hospital_mmbrTyp');
                 $hospital_countryId = $this->input->post('hospital_countryId');
                $hospital_stateId = $this->input->post('hospital_stateId');
                $hospital_cityId = $this->input->post('hospital_cityId');
                $hospital_mblNo = $this->input->post('hospital_mblNo');
        
                $inserData = array(
                  'hospital_name'=> $hospital_name,
                   'hospital_type' => $hospital_type, 
                   'hospital_address' => $hospital_address, 
                   'hospital_phn' => $finalNumber,
                   'hospital_cntPrsn'=> $hospital_cntPrsn,
                   'hospital_dsgn' => $hospital_dsgn,
                   'hospital_mmbrTyp' => $hospital_mmbrTyp,
                   'hospital_countryId' => $hospital_countryId,
                   'hospital_stateId' => $hospital_stateId,
                   'hospital_cityId' => $hospital_cityId,
                    'hospital_aboutUs' => '',
                   'hospital_photo' => $imagesname,
                   'creationTime' => strtotime(date("Y-m-d H:i:s")),
                   'hospital_mblNo' => $hospital_mblNo,
                    'hospital_lat' => $this->input->post('lat'),
                    'hospital_long' => $this->input->post('lng')
                );
                
                $users_email = $this->input->post('users_email');
                $users_password = md5($this->input->post('users_password'));
                $hospitalInsert = array(
                   'users_email' => $users_email,
                    'users_password'=> $users_password,
                   'users_ip_address' => $this->input->ip_address(),
                );
               $hospital_usersId = $this->hospital_model->inserHospitalUser($hospitalInsert);
               if($hospital_usersId) {
                   
                   $inserData['hospital_usersId'] = $hospital_usersId;
                    $this->hospital_model->insertHospita($inserData);
                    redirect('hospital/addHospital');
                    redirect('hospital/addHospital');
               }
               
            }
         
      
       // print_r($imageUrl);exit;
    }
    
    function getImageBase64Code($img)
    {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }
    
    function check_email(){
        $users_email = $this->input->post('users_email');
        $email = $this->hospital_model->fetchEmail($users_email);
        echo $email;
        exit;
    }
}
