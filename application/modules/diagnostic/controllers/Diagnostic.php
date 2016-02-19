<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostic extends CI_Controller {
    
   public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('diagnostic_model');
   }
   
   function index(){
       $data = array();
       $data['allStates'] = $this->diagnostic_model->fetchStates();
       $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData();
       //print_r($data['diagnosticData'] );exit;
       $this->load->view('diagnosticlisting',$data);
       
   }
   
   function addDiagnostic(){
    $data = array();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
        $this->load->view('addDiagcenter',$data);
   }
   function detailDiagnostic($diagnosticId=''){
       $data = array();
      // echo $diagnosticId;exit;
        $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
       //print_r($data);exit;
        $data['allCountry'] = $this->diagnostic_model->fetchCountry();
        $data['diagnosticId'] = $diagnosticId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $this->load->view('diagnosticDetail',$data);
   }
   function fetchStates(){
      $stateId = $this->input->post('stateId');
      $countryId = $this->input->post('countryId');
     $statesdata = $this->diagnostic_model->fetchStates($countryId);
     $statesOption = '';
      $statesOption .='<option value=>Select Your States</option>';
      foreach($statesdata as $key=>$val ) {
        if($val->state_id == $stateId)
           $statesOption .= '<option value='.$val->state_id.' selected >'. strtoupper($val->state_statename).'</option>';
         else
       $statesOption .= '<option value='.$val->state_id.'>'. strtoupper($val->state_statename).'</option>';
    }
    echo $statesOption;
    exit;
   }
   function fetchCityOnload()
   {
      $stateId = $this->input->post('stateId');
      $cityId = $this->input->post('cityId');
       $cityData = $this->diagnostic_model->fetchCity($stateId);
       $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
          if($val->city_id == $cityId)
           $cityOption .= '<option value='.$val->city_id.' selected>'. strtoupper($val->city_name).'</option>';
           else
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
   }
   function fetchCity (){
        $stateId = $this->input->post('stateId');
        $cityData = $this->diagnostic_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='. $val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
     
    function SaveDiagnostic(){
        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('diagnostic_name', 'Diagnostic Name', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_countryId', 'Diagnostic Country', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_stateId', 'Diagnostic StateId', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_cityId', 'Diagnostic City', 'required|trim');
        
        $this->bf_form_validation->set_rules('diagnostic_address', 'Diagnostic Address', 'required|trim');
       //$this->bf_form_validation->set_rules('diagnostic_phn', 'Diagnostic Phone', 'required|trim');
       
        $this->bf_form_validation->set_rules('diagnostic_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_mbrTyp', 'Membership Type', 'required|trim');
        
        
        $this->bf_form_validation->set_rules('diagnostic_mblNo', 'Diagnostic Mobile No', 'required|trim');
      
       $this->bf_form_validation->set_rules('diagnostic_zip','Diagnostic Zip', 'required|trim');
       $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
       $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
        
        if (empty($_FILES['diagnostic_img']['name']))
         {
             $this->bf_form_validation->set_rules('diagnostic_img', 'File', 'required');
        }
       if ($this->bf_form_validation->run() === FALSE) {
           $data = array();
                $data['allStates'] = $this->diagnostic_model->fetchStates();
             $this->load->view('addDiagcenter',$data);
         }
         else {
        
             $imagesname='';
              if ($_FILES['diagnostic_img']['name'] ) {
             $path = realpath(FCPATH.'assets/diagnosticsImage/');
             $temp = explode(".", $_FILES["diagnostic_img"]["name"]);
                $newfilename = 'Diag_'.round(microtime(true)) . '.' . end($temp);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '5000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['file_name'] = $newfilename;
              
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('diagnostic_img'))
                {
                    $data = array();
                    $data['allStates'] = $this->diagnostic_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->upload->display_errors());
                    $this->load->view('addDiagcenter',$data);
                    return false;
                 }
                else
                {
                    $imagesname = $newfilename;

                }
                
              } 
              //echo "i am here";
               
                $diagnostic_phn = $this->input->post('diagnostic_phn');
                $pre_number = $this->input->post('pre_number');
                 $countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($countPnone) ;$i++) {
                    if($diagnostic_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$diagnostic_phn[$i].'|'; 
                    }
                    
                }
                
                $diagnostic_name = $this->input->post('diagnostic_name');
               
                $diagnostic_address = $this->input->post('diagnostic_address');
                 $diagnostic_phn = $this->input->post('diagnostic_phn');
                $diagnostic_cntPrsn = $this->input->post('diagnostic_cntPrsn');
               // $diagnostic_dsgn = $this->input->post('diagnostic_dsgn');
                $diagnostic_mmbrTyp = $this->input->post('diagnostic_mbrTyp');
                 $diagnostic_countryId = $this->input->post('diagnostic_countryId');
                $diagnostic_stateId = $this->input->post('diagnostic_stateId');
                $diagnostic_cityId = $this->input->post('diagnostic_cityId');
                $diagnostic_mblNo = $this->input->post('diagnostic_mblNo');
                $diagnostic_zip = $this->input->post('diagnostic_zip');
                
                
                $users_email = $this->input->post('users_email');
                $users_password = md5($this->input->post('users_password'));
                $diagnosticInsert = array(
                   'users_email' => $users_email,
                    'users_password'=> $users_password,
                   'users_ip_address' => $this->input->ip_address(),
                   'users_mobile'=> $this->input->post('diagnostic_mblNo'),
                );
                 
               $diagnostic_usersId = $this->diagnostic_model->insertDiagnosticUser($diagnosticInsert);
               //echo $diagnostic_usersId;exit;
               if($diagnostic_usersId) {
                   
                   $insertusersRoles = array(
                      'usersRoles_userId' => $diagnostic_usersId,
                      'usersRoles_roleId' => 3,
                      'usersRoles_parentId' => 0,
                      'creationTime' => strtotime(date("Y-m-d H:i:s"))
                  );
                  $this->diagnostic_model->insertUsersRoles($insertusersRoles);
                  
                   $insertData['diagnostic_usersId'] = $diagnostic_usersId;
                   $insertData = array(
                  'diagnostic_name'=> $diagnostic_name,
                   'diagnostic_address' => $diagnostic_address, 
                   'diagnostic_cntPrsn' => $diagnostic_cntPrsn, 
                   'diagnostic_phn' => $finalNumber,
                   //'diagnostic_dsgn'=> $diagnostic_dsgn,
                  'diagnostic_mbrTyp' => $diagnostic_mmbrTyp,
                   'diagnostic_countryId' => $diagnostic_countryId,
                   'diagnostic_stateId' => $diagnostic_stateId,
                   'diagnostic_cityId' => $diagnostic_cityId,
                    'diagnostic_mblNo' => $diagnostic_mblNo,
                    'diagnostic_zip' => $diagnostic_zip,   
                   'diagnostic_img' => $imagesname,
                   'creationTime' => strtotime(date("Y-m-d H:i:s")),
                   'diagnostic_mblNo' => $diagnostic_mblNo,
                    'diagnostic_lat' => $this->input->post('lat'),
                    'diagnostic_long' => $this->input->post('lng'),
                    'inherit_status' => 1
                );
                  // print_r($insertData);exit;
                  $diagnosticId = $this->diagnostic_model->insertDiagnostic($insertData);
                  
                   }
                  $this->session->set_flashdata('message','Data inserted successfully !');
                  redirect('diagnostic/addDiagnostic');
               }
               
            }
         function uploadImages ($imageName,$folderName,$newName){
             $path = realpath(FCPATH.'assets/'.$folderName.'/');
                 $config['upload_path'] = $path;
            //echo $config['upload_path']; 
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '5000';
    $config['max_width']  = '1024';
    $config['max_height']  = '768';
                $config['file_name'] = $newName;
                //$field_name = $_FILES['hospital_photo']['name'];
               
    $this->load->library('upload', $config);
               $this->upload->initialize($config);
               $this->upload->do_upload($imageName);
               return TRUE;

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
       $user_table_id = '';
        $users_email = $this->input->post('users_email');
        if(isset($_POST['user_table_id'])){
          $user_table_id = $this->input->post('user_table_id');
        }
        $email = $this->diagnostic_model->fetchEmail($users_email,$user_table_id);
        echo $email;
        exit;
    }

    function saveDetailDiagnostic($diagnosticId){
        //echo $diagnosticId;exit;
        $this->bf_form_validation->set_rules('diagnostic_name', 'Diagnostic Name', 'required|trim');
      
        $this->bf_form_validation->set_rules('diagnostic_address', 'Diagnostic Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->bf_form_validation->set_rules('diagnostic_cntPrsn', 'Diagnostic Contact Person', 'required|trim');
        if ($this->bf_form_validation->run() === FALSE) {
             $data = array();
             $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
               $data['diagnosticId'] = $diagnosticId;
               $data['showStatus'] = 'block';
               $data['detailShow'] = 'none';
             $this->load->view('diagnosticDetail',$data);
             
         }
         else{
              $diagnostic_phn = $this->input->post('diagnostic_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($diagnostic_phn) ;$i++) {
                    if($diagnostic_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$diagnostic_phn[$i].'|'; 
                    }
                } 
                
                $updateDiagnostic = array(
                  'diagnostic_name'=>  $this->input->post('diagnostic_name'),
                  //'hospital_type'=> $this->input->post('hospital_type'),
                  'diagnostic_countryId'=> $this->input->post('diagnostic_countryId'),
                  'diagnostic_stateId'=> $this->input->post('diagnostic_stateId'),
                  'diagnostic_cityId'=> $this->input->post('diagnostic_cityId'),
                     'diagnostic_address' =>  $this->input->post('diagnostic_address'),
                     'diagnostic_phn' => $finalNumber,
                      'diagnostic_cntPrsn'=> $this->input->post('diagnostic_cntPrsn'),
                      //'hospital_mmbrTyp'=> $this->input->post('hospital_mmbrTyp'),
                     // 'hospital_27Src'=> $this->input->post('isEmergency'),
                     'diagnostic_lat'=> $this->input->post('lat'), 
                    'diagnostic_long'=> $this->input->post('lng'),  
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'diagnostic_id' => $diagnosticId
                );
                $response = '';
               $response = $this->diagnostic_model->UpdateTableData($updateDiagnostic,$where,'qyura_diagnostic');
               if($response){
                   $updateUserdata = array(
                       'users_email' => $this->input->post('users_email'),
                      'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                  );
                  $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')  
                  ); 
                 $response = $this->diagnostic_model->UpdateTableData($updateUserdata,$whereUser,'qyura_users'); 
                 if($response) {
                 $this->session->set_flashdata('message','Data updated successfully !');
                 //echo $diagnosticId;exit;
                  redirect("diagnostic/detailDiagnostic/$diagnosticId");
                 }
               }
         }
    }
      
       // print_r($imageUrl);exit;
    }
    
      
   

