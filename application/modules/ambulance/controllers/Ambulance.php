<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ambulance extends CI_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->model('Ambulance_model');
       $this->load->library('form_validation');
       $this->load->library('datatables');
   }
   function index(){
        $data = array();
       $data['allStates'] = $this->Ambulance_model->fetchStates();
       $data['ambulanceData'] = $this->Ambulance_model->fetchambulanceData();
       //print_r($data['pharmacyData']);
       //exit;
       
        $this->load->view('ambulanceListing',$data);
   }
      function getAmbulanceDl(){

       
        echo $this->Ambulance_model->fetchAmbulanceDataTables();
 
   }
   function detailAmbulance($ambulanceId){
       $data = array();
       $data['ambulanceData'] = $this->Ambulance_model->fetchambulanceData($ambulanceId);
        $data['ambulanceId'] = $ambulanceId;
        $data['editdetail'] = 'none';
        $data['detail'] = 'block';
       $this->load->view('ambulanceDetail',$data);
   }
   function saveDetailAmbulance($ambulanceId){
      
        $this->bf_form_validation->set_rules('ambulance_name', 'Ambulance Name', 'required|trim');
      
        $this->bf_form_validation->set_rules('ambulanceType', 'Ambulance Type', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_address', 'Ambulance Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_mobile', 'Ambulance Mobile', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_cntPrsn', 'Ambulance Cantact Person', 'required|trim');
        if($this->bf_form_validation->run() === False){
            $data = array();
            $data['ambulanceData'] = $this->Ambulance_model->fetchambulanceData($ambulanceId);
            $data['ambulanceId'] = $ambulanceId;
            $data['editdetail'] = 'block';
            $data['detail'] = 'none';
            $this->load->view('ambulanceDetail',$data);
        }
        else {
                $ambulance_phn = $this->input->post('ambulance_phn');
                $pre_number = $this->input->post('pre_number');
               
                  $finalNumber = '';
                for($i= 0;$i < count($ambulance_phn) ;$i++) {
                    if($ambulance_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$ambulance_phn[$i].'|'; 
                    }
                } 
                
                $updateAmbulance = array(
                  'ambulance_name'=>  $this->input->post('ambulance_name'),
                     'ambulanceType' =>  $this->input->post('ambulanceType'),
                     'ambulance_phn' => $finalNumber,
                      'ambulance_address'=> $this->input->post('ambulance_address'),
                       'ambulance_cntPrsn'=> $this->input->post('ambulance_cntPrsn'),
                    'ambulance_27Src'=> $this->input->post('ambulance_27Src'),
                     'ambulance_lat'=> $this->input->post('lat'), 
                    'ambulance_long'=> $this->input->post('lng'),  
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'ambulance_id' => $ambulanceId
                );
                $response = '';
               $response = $this->Ambulance_model->UpdateTableData($updateAmbulance,$where,'qyura_ambulance');
               if($response){
                   $updateUserdata = array(
                       //'users_email' => $this->input->post('users_email'),
                       'users_mobile' => $this->input->post('users_mobile'),
                      'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                  );
                  $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')  
                  ); 
                 $response = $this->Ambulance_model->UpdateTableData($updateUserdata,$whereUser,'qyura_users'); 
                 if($response) {
                 $this->session->set_flashdata('message','Data updated successfully !');
                  redirect("ambulance/detailAmbulance/$ambulanceId");
                 }
               }
        }
   }
   function addAmbulance(){
        $data = array();
        $data['allStates'] = $this->Ambulance_model->fetchStates();
        $this->load->view('addAmbulance',$data);
   }
   function fetchCity(){
       //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Ambulance_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
    
  function SaveAmbulance(){
     // print_r($_POST);exit;
      	$this->load->library('form_validation');
        $this->bf_form_validation->set_rules('ambulance_name', 'Ambulance Name', 'required|trim');
      
        $this->bf_form_validation->set_rules('ambulance_countryId', 'Ambulance Country', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_stateId', 'Ambulance StateId', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_cityId', 'Ambulance City', 'required|trim');
        
        //$this->bf_form_validation->set_rules('pharmacy_phn[]', 'Pharmacy Mobile No', 'required|trim');
       $this->bf_form_validation->set_rules('ambulance_zip','Ambulance Zip', 'required|trim');
       $this->bf_form_validation->set_rules('ambulance_address','Ambulance Address','required|trim');
        $this->bf_form_validation->set_rules('ambulance_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_mmbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_mobile','User Mobile','required|trim|numeric');
        if (empty($_FILES['ambulance_img']['name']))
         {
             $this->bf_form_validation->set_rules('ambulance_img', 'File', 'required');
        }
        if ($this->bf_form_validation->run() === FALSE) {
         //echo validation_errors();
         // exit;
             $data = array();
             $data['allStates'] = $this->Ambulance_model->fetchStates();
            $this->load->view('addAmbulance',$data);
         }
         else {
             
             $imagesname='';
              if ($_FILES['ambulance_img']['name'] ) {
             $path = realpath(FCPATH.'assets/ambulanceImages/');
             $temp = explode(".", $_FILES["ambulance_img"]["name"]);
                $newfilename = 'Ambulance_'.round(microtime(true)) . '.' . end($temp);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '5000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['file_name'] = $newfilename;
              
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('ambulance_img'))
                {
                    $data = array();
                    $data['allStates'] = $this->Ambulance_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->upload->display_errors());
                    $this->load->view('addAmbulance',$data);
                    return false;
                 }
                else
                {
                    $imagesname = $newfilename;

                }
                
              } 
              
               //echo $imagesname;exit;
                $ambulance_phn = $this->input->post('ambulance_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($ambulance_phn) ;$i++) {
                    if($ambulance_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$ambulance_phn[$i].'|'; 
                    }
                    
                }
                
                $ambulance_name = $this->input->post('ambulance_name');
                $countryId = $this->input->post('ambulance_countryId');
                $stateId = $this->input->post('ambulance_stateId');
                $cityId = $this->input->post('ambulance_cityId');
                $ambulance_address = $this->input->post('ambulance_address'); 
                $ambulance_cntPrsn = $this->input->post('ambulance_cntPrsn');
                $ambulance_mmbrTyp = $this->input->post('ambulance_mmbrTyp');
                $isEmergency = $this->input->post('isEmergency');
                $ambulance_zip = $this->input->post('ambulance_zip');
                
                    $insertData = array(

                     'ambulance_name'=> $ambulance_name,
                     'ambulance_countryId' => $countryId,
                     'ambulance_stateId' => $stateId,
                     'ambulance_cityId'=> $cityId,
                     'ambulance_address'=>$ambulance_address,
                     'ambulance_cntPrsn'=> $ambulance_cntPrsn,
                     'ambulance_mmbrTyp' => $ambulance_mmbrTyp,
                     'ambulance_zip' => $ambulance_zip,
                     'ambulance_27Src' => $isEmergency,
                     'ambulance_img' => $imagesname,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'ambulance_phn' => $finalNumber,
                    'ambulance_lat' => $this->input->post('lat'),
                    'ambulance_long' => $this->input->post('lng'),
                     'ambulanceType' => $this->input->post('ambulanceType')
                        
                    );
                    //print_r($insertData);
                    //exit;
                    $users_email = $this->input->post('users_email');
                    $ambulanceInsert = array(
                   'users_email' => $users_email,
                   'users_ip_address' => $this->input->ip_address(),
                   'users_mobile' => $this->input->post('users_mobile')    
                );
                    $ambulance_usersId = $this->Ambulance_model->insertAmbulanceUser($ambulanceInsert);
                //echo $ambulance_usersId;
                //echo "here";
               // exit;
                if($ambulance_usersId) {
                   
                  $insertusersRoles = array(
                      'usersRoles_userId' => $ambulance_usersId,
                      'usersRoles_roleId' => 8,
                      'usersRoles_parentId' => 0,
                      'creationTime' => strtotime(date("Y-m-d H:i:s"))
                  );

                  $this->Ambulance_model->insertUsersRoles($insertusersRoles);
                  

                   $insertData['ambulance_usersId'] = $ambulance_usersId;
                   //print_r($insertData);
                  //exit;
                  $ambulanceId = $this->Ambulance_model->insertAmbulance($insertData);
                  $this->session->set_flashdata('message','Data inserted successfully !');
                }
                  redirect('ambulance/addAmbulance');
         }
  }  
  function uploadImages ($imageName,$folderName,$newName){
             $path = realpath(FCPATH.'assets/'.$folderName.'/');
                 $config['upload_path'] = $path;
            //echo $config['upload_path']; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                $config['file_name'] = $newName;
                
               
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

        $users_email = $this->input->post('users_email');
        //echo $users_email;exit;
        $email = $this->Ambulance_model->fetchEmail($users_email);
        echo $email;
        exit;
    }
    
    
}  