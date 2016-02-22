<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends CI_Controller {
    
   public function __construct() {
       parent:: __construct();
       $this->load->model('Hospital_model');
        $this->load->library('datatables');
   }
   
  function index(){
        $data = array();
        $data['allStates'] = $this->Hospital_model->fetchStates();
        $data['hospitalData'] = $this->Hospital_model->fetchHospitalData();
       // print_r($data['hospitalData'] );exit;
        $this->load->view('HospitalListing',$data);
   }
      function getHospitalDl(){

       
        echo $this->Hospital_model->fetchHospitalDataTables();
 
   }
   function addHospital(){
       $data = array();
       $data['allStates'] = $this->Hospital_model->fetchStates();
       $this->load->view('AddHospital',$data);
   }
   function detailHospital($hospitalId=''){
       $data = array();
      // echo $hospitalId;exit;
        $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);
       // print_r($data);exit;
        $data['allCountry'] = $this->Hospital_model->fetchCountry();
        $data['hospitalId'] = $hospitalId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $this->load->view('hospitalDetail',$data);
   }
   function fetchStates(){
      $stateId = $this->input->post('stateId');
      $countryId = $this->input->post('countryId');
     $statesdata = $this->Hospital_model->fetchStates($countryId);
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
       $cityData = $this->Hospital_model->fetchCity($stateId);
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
        $cityData = $this->Hospital_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
    
    function SaveHospital(){
         $this->bf_form_validation->set_rules('hospital_name', 'Hospital Name', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_type', 'Hospital Type', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_address', 'Hospital Address', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_mmbrTyp', 'Membership Type', 'required|trim');
        
        $this->bf_form_validation->set_rules('hospital_countryId', 'Hospital Country', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_stateId', 'Hospital StateId', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_cityId', 'hospital City', 'required|trim');
        
        $this->bf_form_validation->set_rules('hospital_mblNo', 'Hospital Mobile No', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_zip','Hospital Zip', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_dsgn','Hospital Designation','required|trim');
       $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
       $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
       
       // $this->bf_form_validation->set_rules('hospital_mmbrTyp', 'Membership Type', 'required|xss_clean|trim');
        if (empty($_FILES['hospital_img']['name']))
         {
             $this->bf_form_validation->set_rules('hospital_img', 'File', 'required');
        }
         if ($this->bf_form_validation->run() === FALSE) {
             $data = array();
                $data['allStates'] = $this->Hospital_model->fetchStates();
             $this->load->view('AddHospital',$data);
         }
         else {
        
             $imagesname='';
              if ($_FILES['hospital_img']['name'] ) {
             $path = realpath(FCPATH.'assets/hospitalsImages/');
             $temp = explode(".", $_FILES["hospital_img"]["name"]);
                $newfilename = 'Hos_'.round(microtime(true)) . '.' . end($temp);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                $config['file_name'] = $newfilename;
               
		$this->load->library('upload', $config);
               $this->upload->initialize($config);
              
                if ( ! $this->upload->do_upload('hospital_img'))
		{
			
                        $data = array();
                        $data['allStates'] = $this->Hospital_model->fetchStates();
                        $this->session->set_flashdata('valid_upload', $this->upload->display_errors());
                        $this->load->view('AddHospital',$data);
                      
		}
		else
		{
                     $imagesname = $newfilename;
                       
		}
                
              } 
          
                $hospital_phn = $this->input->post('hospital_phn');
                $pre_number = $this->input->post('pre_number');
                 $countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < $countPnone ;$i++) {
                    if($hospital_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$hospital_phn[$i].'|'; 
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
                $hospital_aboutUs = $this->input->post('hospital_aboutUs');
                $isEmergency =0;
                if(isset($_POST['isEmergency']))
                   $isEmergency  = $_POST['isEmergency'];
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
                    'hospital_aboutUs' => $hospital_aboutUs,
                   'hospital_img' => $imagesname,
                   'creationTime' => strtotime(date("Y-m-d H:i:s")),
                   'hospital_mblNo' => $hospital_mblNo,
                    'hospital_lat' => $this->input->post('lat'),
                    'hospital_long' => $this->input->post('lng'),
                    'isEmergency' => $isEmergency
                );
                
                $users_email = $this->input->post('users_email');
                $users_password = md5($this->input->post('users_password'));
                $hospitalInsert = array(
                   'users_email' => $users_email,
                    'users_password'=> $users_password,
                   'users_ip_address' => $this->input->ip_address(),
                   'users_mobile'=> $this->input->post('hospital_mblNo'),
                );
              
                 
               $hospital_usersId = $this->Hospital_model->inserHospitalUser($hospitalInsert);
               if($hospital_usersId) {
                   
                   $inserData['hospital_usersId'] = $hospital_usersId;
                  $hospitalId = $this->Hospital_model->insertHospital($inserData);
                  $insertusersRoles = array(
                      'usersRoles_userId' => $hospital_usersId,
                      'usersRoles_roleId' => 1,
                      'usersRoles_parentId' => 0,
                      'creationTime' => strtotime(date("Y-m-d H:i:s"))
                  );
                  $this->Hospital_model->insertUsersRoles($insertusersRoles);
                  unset($insertusersRoles);
                   if(isset($_POST['hospitalServices_serviceName']))
                   {
                        $finalNumber = '';
                       $countserviceName = $_POST['serviceName'];
                       $hospitalServices_serviceName = $_POST['hospitalServices_serviceName'];
                        for($i= 0;$i < $countserviceName ;$i++) {
                            if($hospitalServices_serviceName[$i] != '') {
                               $finalhospitalServices_serviceName = $hospitalServices_serviceName[$i]; 
                               $hospitalServicesData = array(
                                 'hospitalServices_hospitalId'=> $hospitalId,
                                 'hospitalServices_serviceName'=> $finalhospitalServices_serviceName,
                                  'hospitalServices_deleted' => 0, 
                                 'creationTime' => strtotime(date("Y-m-d H:i:s"))  
                               );
                               $this->Hospital_model->insertHospitalServiceName($hospitalServicesData);
                            }
                            $hospitalServicesData = '';
                        }  
                   }
                  if($_POST['bloodbank_chk']==1){
                      
                       $bloodBank_phn = $this->input->post('bloodBank_phn');
                        $preblbankNo = $this->input->post('preblbankNo');
                         $countbloodBank_phn = $this->input->post('countbloodBank_phn');

                          $finalBloodbnkNumber = '';
                        for($i= 0;$i < $countbloodBank_phn ;$i++) {
                            if($bloodBank_phn[$i] != '' && $pre_number[$i] !='') {
                               $finalBloodbnkNumber .= $preblbankNo[$i].' '.$bloodBank_phn[$i].'|'; 
                            }

                        }
                        $imageBloodbnkName = '';
                         if ($_FILES['bloodBank_photo']['name'] ) {
                              $tempblood = explode(".", $_FILES["hospital_img"]["name"]);
                               $newfilenameblood = 'Blood_'.round(microtime(true)) . '.' . end($tempblood);
                             $status = $this->uploadImages('hospital_img','BloodBank',$newfilenameblood);
                             if($status == TRUE)
                                 $imageBloodbnkName = $newfilenameblood;
                         }
                       $bloodBank_name = $this->input->post('bloodBank_name');
                       $bloodBank_photo = $this->input->post('bloodBank_photo');
                       $bloodBank_lat = $this->input->post('lat');
                       $bloodBank_long =$this->input->post('lng');
                       
                       $bloodBankDetail = array(
                           'bloodBank_name' => $bloodBank_name,
                           'bloodBank_photo' => $imageBloodbnkName,
                           'bloodBank_lat' => $bloodBank_lat,
                           'bloodBank_long' => $bloodBank_long,
                           'users_id' => $hospital_usersId,
                           'creationTime' => strtotime(date("Y-m-d H:i:s")),
                           'bloodBank_phn' => $finalBloodbnkNumber,
                           'countryId' => $hospital_countryId,
                            'stateId' => $hospital_stateId,
                            'cityId' => $hospital_cityId,
                           'bloodBank_add' => $hospital_address,
                           'inherit_status' => 1
                       );
                      $bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                      if($bloodBankId) {
                                $insertusersRoles = array(
                               'usersRoles_userId' => $bloodBankId,
                               'usersRoles_roleId' => 2,
                               'usersRoles_parentId' => $hospital_usersId,
                               'creationTime' => strtotime(date("Y-m-d H:i:s"))
                           );
                              
                           $this->Hospital_model->insertUsersRoles($insertusersRoles);
                         
                           unset($insertusersRoles);
                      }
                  }
                  
                   if($_POST['pharmacy_chk']==1){
                      
                       $pharmacy_phn = $this->input->post('pharmacy_phn');
                        $prePharmacy = $this->input->post('prePharmacy');
                         $countPharmacy_phn = $this->input->post('countPharmacy_phn');

                          $finalPharmacyNumber = '';
                        for($i= 0;$i < $countPharmacy_phn ;$i++) {
                            if($pharmacy_phn[$i] != '' && $prePharmacy[$i] !='') {
                               $finalPharmacyNumber .= $prePharmacy[$i].' '.$pharmacy_phn[$i].'|'; 
                            }

                        }
                        $imagePharmacyName = '';
                         if ($_FILES['pharmacy_img']['name'] ) {
                             $tempPharmacy = explode(".", $_FILES["pharmacy_img"]["name"]);
                               $newfilenamepharmacy_img = 'Pharmacy_'.round(microtime(true)) . '.' . end($tempPharmacy);
                             $status = $this->uploadImages('pharmacy_img','pharmacyImages',$newfilenamepharmacy_img);
                             
                             if($status == TRUE)
                                 $imagePharmacyName = $newfilenamepharmacy_img;
                         }
                       $pharmacy_name = $this->input->post('pharmacy_name');
                       $pharmacy_img = $this->input->post('pharmacy_img');
                       $pharmacy_lat = $this->input->post('lat');
                       $pharmacy_long =$this->input->post('lng');
                       
                       $pharmacyDetail = array(
                           'pharmacy_name' => $pharmacy_name,
                           'pharmacy_img' => $imagePharmacyName,
                           'pharmacy_lat' => $pharmacy_lat,
                           'pharmacy_long' => $pharmacy_long,
                           'pharmacy_usersId' => $hospital_usersId,
                           'creationTime' => strtotime(date("Y-m-d H:i:s")),
                           'pharmacy_phn' => $finalPharmacyNumber,
                            'pharmacy_countryId' => $hospital_countryId,
                            'pharmacy_stateId' => $hospital_stateId,
                            'pharmacy_cityId' => $hospital_cityId,
                            'pharmacy_address' => $hospital_address,
                            'inherit_status' => 1
                       );
                      $pharmacyId = $this->Hospital_model->insertPharmacy($pharmacyDetail);
                      
                       if($pharmacyId) {
                                $insertusersRoles2 = array(
                               'usersRoles_userId' => $pharmacyId,
                               'usersRoles_roleId' => 5,
                               'usersRoles_parentId' => $hospital_usersId,
                               'creationTime' => strtotime(date("Y-m-d H:i:s"))
                           );
                              
                           $this->Hospital_model->insertUsersRoles($insertusersRoles2);
                          
                           unset($insertusersRoles2);
                      }
                  }
                  
                  
                    if($_POST['ambulance_chk']==1){
                      
                       $ambulance_phn = $this->input->post('ambulance_phn');
                        $preAmbulance = $this->input->post('preAmbulance');
                         $countAmbulance_phn = $this->input->post('countAmbulance_phn');

                          $finalAmbulanceNumber = '';
                        for($i= 0;$i < $countAmbulance_phn ;$i++) {
                            if($ambulance_phn[$i] != '' && $preAmbulance[$i] !='') {
                               $finalAmbulanceNumber .= $preAmbulance[$i].' '.$ambulance_phn[$i].'|'; 
                            }

                        }
                        $imageAmbulanceName = '';
                         if ($_FILES['ambulance_img']['name'] ) {
                             $tempAmbulance = explode(".", $_FILES["ambulance_img"]["name"]);
                               $newfilenametempAmbulance = 'Ambulance_'.round(microtime(true)) . '.' . end($tempAmbulance);
                             $status = $this->uploadImages('ambulance_img','ambulanceImages',$newfilenametempAmbulance);
                             if($status == TRUE)
                                 $imageAmbulanceName = $newfilenametempAmbulance;
                         }
                       $ambulance_name = $this->input->post('ambulance_name');
                       $ambulance_img = $this->input->post('ambulance_img');
                       $ambulance_lat = $this->input->post('lat');
                       $ambulance_long =$this->input->post('lng');
                       
                       $ambulanceDetail = array(
                           'ambulance_name' => $ambulance_name,
                           'ambulance_img' => $imageAmbulanceName,
                           'ambulance_lat' => $ambulance_lat,
                           'ambulance_long' => $ambulance_long,
                           'ambulance_usersId' => $hospital_usersId,
                           'creationTime' => strtotime(date("Y-m-d H:i:s")),
                           'ambulance_phn' => $finalAmbulanceNumber,
                            'ambulance_countryId' => $hospital_countryId,
                            'ambulance_stateId' => $hospital_stateId,
                            'ambulance_cityId' => $hospital_cityId,
                           'ambulance_address' => $hospital_address,
                           'inherit_status' => 1
                       );
                      $ambulanceId = $this->Hospital_model->insertAmbulance($ambulanceDetail);
                      if($ambulanceId) {
                                $insertusersRoles3 = array(
                               'usersRoles_userId' => $ambulanceId,
                               'usersRoles_roleId' => 8,
                               'usersRoles_parentId' => $hospital_usersId,
                               'creationTime' => strtotime(date("Y-m-d H:i:s"))
                           );
                              
                           $this->Hospital_model->insertUsersRoles($insertusersRoles3);
                          
                           unset($insertusersRoles3);
                      }
                  }
                  $this->session->set_flashdata('message','Data inserted successfully !');
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
       $user_table_id = '';
        $users_email = $this->input->post('users_email');
        if(isset($_POST['user_table_id'])){
          $user_table_id = $this->input->post('user_table_id');
        }
        $email = $this->Hospital_model->fetchEmail($users_email,$user_table_id);
        echo $email;
        exit;
    }
    function saveDetailHospital($hospitalId){
        
        $this->bf_form_validation->set_rules('hospital_name', 'Pharmacy Name', 'required|trim');
      
        $this->bf_form_validation->set_rules('hospital_address', 'Pharmacy Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->bf_form_validation->set_rules('hospital_cntPrsn', 'Pharmacy Contact Person', 'required|trim');
        if ($this->bf_form_validation->run() === FALSE) {
             $data = array();
             $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);
               $data['hospitalId'] = $hospitalId;
               $data['showStatus'] = 'block';
               $data['detailShow'] = 'none';
             $this->load->view('hospitalDetail',$data);
             
         }
         else{
              $hospital_phn = $this->input->post('hospital_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($hospital_phn) ;$i++) {
                    if($hospital_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$hospital_phn[$i].'|'; 
                    }
                } 
                
                $updateHospital = array(
                  'hospital_name'=>  $this->input->post('hospital_name'),
                  //'hospital_type'=> $this->input->post('hospital_type'),
                  'hospital_countryId'=> $this->input->post('hospital_countryId'),

                  'hospital_stateId'=> $this->input->post('hospital_stateId'),
                  'hospital_cityId'=> $this->input->post('hospital_cityId'),
                     'hospital_address' =>  $this->input->post('hospital_address'),
                     'hospital_phn' => $finalNumber,
                      'hospital_cntPrsn'=> $this->input->post('hospital_cntPrsn'),
                      //'hospital_mmbrTyp'=> $this->input->post('hospital_mmbrTyp'),
                     // 'hospital_27Src'=> $this->input->post('isEmergency'),
                     'hospital_lat'=> $this->input->post('lat'), 
                    'hospital_long'=> $this->input->post('lng'),  
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'hospital_id' => $hospitalId
                );
                $response = '';
               $response = $this->Hospital_model->UpdateTableData($updateHospital,$where,'qyura_hospital');
               if($response){
                   $updateUserdata = array(
                       'users_email' => $this->input->post('users_email'),
                      'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                  );
                  $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')  
                  ); 
                 $response = $this->Hospital_model->UpdateTableData($updateUserdata,$whereUser,'qyura_users'); 
                 if($response) {
                 $this->session->set_flashdata('message','Data updated successfully !');
                  redirect("hospital/detailHospital/$hospitalId");
                 }
               }
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
                //$field_name = $_FILES['hospital_photo']['name'];
               
		$this->load->library('upload', $config);
               $this->upload->initialize($config);
               $this->upload->do_upload($imageName);
               return TRUE;

    }
    
    function PharmacyImage ($imageName){
             $path = realpath(FCPATH.'assets/pharmacyImages/');
                 $config['upload_path'] = $path;
            //echo $config['upload_path']; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                //$field_name = $_FILES['hospital_photo']['name'];
               
		$this->load->library('upload', $config);
               $this->upload->initialize($config);
               $this->upload->do_upload($imageName);
               return TRUE;

    }
    
    function ambulanceImage($imageName){
             $path = realpath(FCPATH.'assets/pharmacyImages/');
                 $config['upload_path'] = $path;
            //echo $config['upload_path']; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                //$field_name = $_FILES['hospital_photo']['name'];
               
		$this->load->library('upload', $config);
               $this->upload->initialize($config);
               $this->upload->do_upload($imageName);
               return TRUE;

    }
    function updatePassword(){
        //echo "here";exit;
        $currentPassword = $this->input->post('currentPassword');
        //$existingPassword = $this->input->post('existingPassword');
        $user_tables_id = $this->input->post('user_tables_id');
        
        $encrypted = md5($currentPassword);
        $return = 0;
       /* if($encrypted != $existingPassword){
            echo $return;
        }
         else {
                    $updateBloodBank = array(
                  'bloodBank_name'=>  $encrypted,
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'users_id' => $user_tables_id
                );
             $this->Bloodbank_model->UpdateTableData($updateBloodBank,$where,'qyura_users');
                     
             echo $return = '1'.'~'.$encrypted;
         }*/
        
         $updateHospital= array(
                  'users_password'=>  $encrypted,
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'users_id' => $user_tables_id
                );
            $return = $this->Hospital_model->UpdateTableData($updateHospital,$where,'qyura_users');
                     
             echo $return ;
        //echo $encrypted;
        exit;
        
    }
}
