<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Medicart extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('medicart_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    function index() {
        $option = array(
            'select'=>'city_id,city_name',
            'table'=> 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $data['title'] = 'Medicart';
        $this->load->super_admin_template('medicartOfferListing', $data, 'medicartScript');
    }

    function getMedicartDl() {

        echo $this->medicart_model->fetchMedicartDataTables();
    }
    
    function getMedicartEnquiriesDl() {

        echo $this->medicart_model->fetchMedicartEnquiriesDataTables();
    }
    
     function getMedicartBookingDl() {

        echo $this->medicart_model->fetchMedicartBookingDataTables();
    }
    
    function bookingRequest(){
        $option = array(
            'select'=>'city_id,city_name',
            'table'=> 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $data['title'] = 'Medicart booking';
        $this->load->super_admin_template('bookingRequestListing', $data, 'medicartScript');
    }
    
    function enquiries(){
        $option = array(
            'select'=>'city_id,city_name',
            'table'=> 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $data['title'] = 'Medicart enquiries';
        $this->load->super_admin_template('enquiryListing', $data, 'medicartScript');
    }
    
    
    function addOffer(){
        $option = array(
            'select'=>'city_id,city_name',
            'table'=> 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $data['title'] = 'add Offer';
        $this->load->super_admin_template('addOffer', $data, 'medicartScript'); 
    }
    
      function getHospital(){
        //echo "fdadas";exit;
        $cityId = $this->input->post('cityId');
        $hosData = $this->Healthcare_model->fetchHospital($cityId);
        $hosOption = '';
        $hosOption .='<option value=>Select Hospital</option>';
        if(!empty($hosData)){
            foreach($hosData as $key=>$val ) {
                $hosOption .= '<option value='.$val->hospital_usersId.'>'. strtoupper($val->hospital_name).'</option>';
            }
        }
       echo $hosOption;
        exit;
    }
    
     function getDiagno(){
        //echo "fdadas";exit;
        $cityId = $this->input->post('cityId');
        $diagnoData = $this->Healthcare_model->fetchDiagnostic($cityId);
        $diOption = '';
        $diOption .='<option value=>Select Diagnostic</option>';
        if(!empty($diagnoData)){
            foreach($diagnoData as $key=>$val ) {
                $diOption .= '<option value='.$val->diagnostic_usersId.'>'. strtoupper($val->diagnostic_name).'</option>';
            }
        }
       echo $diOption;
        exit;
    }
    
    
    
    
    

    function detailAmbulance($ambulanceId) {
        $data = array();
        $data['ambulanceData'] = $this->Ambulance_model->fetchambulanceData($ambulanceId);
        $data['ambulanceId'] = $ambulanceId;
        $data['editdetail'] = 'none';
        $data['detail'] = 'block';
        $data['title'] = (!empty($data['ambulanceData'][0]->ambulance_name)) ? $data['ambulanceData'][0]->ambulance_name: "Ambulance Details";
        
        $option = array(
            'table' => 'qyura_ambulance',
            'select' => 'ambulance_background_img',
            'where' => array('ambulance_id' => $ambulanceId)
        );
        $data['backgroundImage'] = $this->Ambulance_model->customGet($option);
        
        $this->load->super_admin_template('ambulanceDetail', $data, 'ambulanceScript');
    }

    function saveDetailAmbulance($ambulanceId) {

        $this->bf_form_validation->set_rules('ambulance_name', 'Ambulance Name', 'required|trim');

        $this->bf_form_validation->set_rules('ambulanceType', 'Ambulance Type', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_address', 'Ambulance Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_mobile', 'Ambulance Mobile', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_cntPrsn', 'Ambulance Cantact Person', 'required|trim');
        if ($this->bf_form_validation->run() === False) {
            $data = array();
            $data['ambulanceData'] = $this->Ambulance_model->fetchambulanceData($ambulanceId);
            $data['ambulanceId'] = $ambulanceId;
            $data['editdetail'] = 'block';
            $data['detail'] = 'none';
            $this->load->view('ambulanceDetail', $data);
        } else {
            $ambulance_phn = $this->input->post('ambulance_phn');
            $pre_number = $this->input->post('pre_number');

            $finalNumber = '';
            for ($i = 0; $i < count($ambulance_phn); $i++) {
                if ($ambulance_phn[$i] != '' && $pre_number[$i] != '') {
                    $finalNumber .= $pre_number[$i] . ' ' . $ambulance_phn[$i] . '|';
                }
            }

            $updateAmbulance = array(
                'ambulance_name' => $this->input->post('ambulance_name'),
                'ambulanceType' => $this->input->post('ambulanceType'),
                'ambulance_phn' => $finalNumber,
                'ambulance_address' => $this->input->post('ambulance_address'),
                'ambulance_cntPrsn' => $this->input->post('ambulance_cntPrsn'),
                'ambulance_27Src' => $this->input->post('ambulance_27Src'),
                'ambulance_lat' => $this->input->post('lat'),
                'ambulance_long' => $this->input->post('lng'),
                'modifyTime' => strtotime(date("Y-m-d H:i:s"))
            );

            $where = array(
                'ambulance_id' => $ambulanceId
            );
            $response = '';
            $response = $this->Ambulance_model->UpdateTableData($updateAmbulance, $where, 'qyura_ambulance');
            if ($response) {
                $updateUserdata = array(
                    //'users_email' => $this->input->post('users_email'),
                    'users_mobile' => $this->input->post('users_mobile'),
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')
                );
                $response = $this->Ambulance_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_users');
                if ($response) {
                    $this->session->set_flashdata('message', 'Data updated successfully !');
                    redirect("ambulance/detailAmbulance/$ambulanceId");
                }
            }
        }
    }

    function addAmbulance() {
        $data = array();
        $data['allStates'] = $this->Ambulance_model->fetchStates();
        $data['title'] = "Add Ambulance";
        $this->load->super_admin_template('addAmbulance', $data, 'ambulanceScript');
    }

    function fetchCity() {
        //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Ambulance_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function SaveAmbulance() {
        // print_r($_POST);exit;
        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('ambulance_name', 'Ambulance Name', 'required|trim');

        $this->bf_form_validation->set_rules('ambulance_countryId', 'Ambulance Country', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_stateId', 'Ambulance StateId', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_cityId', 'Ambulance City', 'required|trim');

        //$this->bf_form_validation->set_rules('pharmacy_phn[]', 'Pharmacy Mobile No', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_zip', 'Ambulance Zip', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_address', 'Ambulance Address', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_mmbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_mobile', 'User Mobile', 'required|trim|numeric');
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run() === FALSE) {

            $data = array();
            $data['allStates'] = $this->Ambulance_model->fetchStates();
            $data['title'] = 'Add Ambulance';
            $this->load->super_admin_template('addAmbulance', $data, 'ambulanceScript');
        } else {

            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/ambulanceImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->Ambulance_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('addAmbulance', $data, 'ambulanceScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            //echo $imagesname;exit;
            $ambulance_phn = $this->input->post('ambulance_phn');
            $pre_number = $this->input->post('pre_number');
            //$countPnone = $this->input->post('countPnone');

            $finalNumber = '';
            for ($i = 0; $i < count($ambulance_phn); $i++) {
                if ($ambulance_phn[$i] != '' && $pre_number[$i] != '') {
                    $finalNumber .= $pre_number[$i] . ' ' . $ambulance_phn[$i] . '|';
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
                'ambulance_name' => $ambulance_name,
                'ambulance_countryId' => $countryId,
                'ambulance_stateId' => $stateId,
                'ambulance_cityId' => $cityId,
                'ambulance_address' => $ambulance_address,
                'ambulance_cntPrsn' => $ambulance_cntPrsn,
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
            if ($ambulance_usersId) {

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
                $this->session->set_flashdata('message', 'Data inserted successfully !');
            }
            redirect('ambulance/addAmbulance');
        }
    }

    /*function uploadImages($imageName, $folderName, $newName) {
        $path = realpath(FCPATH . 'assets/' . $folderName . '/');
        $config['upload_path'] = $path;
        //echo $config['upload_path']; 
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = $newName;


        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($imageName);
        return TRUE;
    }*/

    function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

    function check_email() {

        $users_email = $this->input->post('users_email');
        //echo $users_email;exit;
        $email = $this->Ambulance_model->fetchEmail($users_email);
        echo $email;
        exit;
    }

    /**
     * @project Qyura
     * @method editUploadImage
     * @description update details page image profile
     * @access public
     * @return boolean
     */
    function editUploadImage() {
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/ambulanceImages/');
            $upload_data = $this->input->post('avatar_data');
            $upload_data = json_decode($upload_data);

            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

            if (empty($original_imagesname)) {
                $response = array('state' => 400, 'message' => $this->error_message);
            } else {

                $option = array(
                    'ambulance_img' => $original_imagesname,
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $where = array(
                    'ambulance_id' => $this->input->post('avatar_id')
                );
                $response = $this->Ambulance_model->UpdateTableData($option, $where, 'qyura_ambulance');
                if ($response) {
                    $response = array('state' => 200, 'message' => 'Successfully update avtar');
                } else {
                    $response = array('state' => 400, 'message' => 'Failed to update avtar');
                }
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }

    function getUpdateAvtar($id) {
        if (!empty($id)) {
            $option = array(
                'table'=>'qyura_ambulance',
                'where'=> array('ambulance_id' => $id)
            );
            $data = $this->Ambulance_model->customGet($option);
            echo "<img src='" . base_url() . "assets/ambulanceImages/thumb/original/" . $data[0]->ambulance_img . "'alt='' class='logo-img' />";
            exit();
        }
    }
    
      function createCSV(){
       
        $stateId ='';
        $cityId ='';
       if(isset($_POST['ambulance_stateId']))
        $stateId = $this->input->post('ambulance_stateId');
       if(isset($_POST['ambulance_cityId']))
        $cityId = $this->input->post('ambulance_cityId');
       
        $where=array('ambulance_deleted'=> 0,'ambulance_cityId'=> $cityId,'ambulance_stateId'=>$stateId);
        $array[]= array('Image Name','Ambulance Name','City','Phone Number','Address');
        $data = $this->Ambulance_model->createCSVdata($where);
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'AmbulanceDetail.csv');
        return True;
        exit;
    }
    
      function uploadImages($imageName, $folderName, $newName) {
        $path = realpath(FCPATH . 'assets/' . $folderName . '/');
        $config['upload_path'] = $path;
        //echo $config['upload_path']; 
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '540';
        $config['file_name'] = $newName;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($imageName)) {

            $data ['error'] = $this->upload->display_errors();
            $data ['status'] = 0;
            return $data;
        } else {
            $data['imageData'] = $this->upload->data();
            $data ['status'] = 1;
            return $data;
        }
    }
    
    function setBackgroundUpload($id) {

        if (isset($_FILES["file"]["name"])) {

            $temp = explode(".", $_FILES['file']["name"]);
            $microtime = round(microtime(true));
            $imageName = "ambulance";
            $newfilename = "" . $imageName . "_" . $microtime . '.' . end($temp);
            $uploadData = $this->uploadImages('file', 'ambulanceImages', $newfilename);
            if ($uploadData['status']) {
                $imageName = $uploadData['imageData']['file_name'];

                $option = array(
                    'table' => 'qyura_ambulance',
                    'data' => array('ambulance_background_img' => $imageName),
                    'where' => array('ambulance_id' => $id)
                );
                $response = $this->Ambulance_model->customUpdate($option);
                if ($response) {
                    $result = array('status' => 200, 'messsage' => "successfully update image");
                    echo json_encode($result);
                }
            } else {
                $result = array('status' => 400, 'messsage' => $uploadData['error']);
                echo json_encode($result);
            }
        }
    }

    function getBackgroundImage($id) {
        $option = array(
            'table' => 'qyura_ambulance',
            'select' => 'ambulance_background_img',
            'where' => array('ambulance_id' => $id)
        );
        $response = $this->Ambulance_model->customGet($option);
        if ($response) {
          echo  $image = base_url().'assets/ambulanceImages/'.$response[0]->ambulance_background_img;
        

        }
    }

}
