<?php

class Partners extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('main_content_model');
    }

    function index(){
        $this->load->view('login1');
    }
    
    function validate(){
        
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
        
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $query = $this->main_content_model->validate_vendor($email,$password); 
            
        if(is_array($query)){

            $this->session->set_userdata('vendorId',$query[0]['vendorId']);
            $this->session->set_userdata('vendorEmail',$query[0]['centerEmail']);
            redirect('partners/vendorServices');  
        }else{
                $ad['error']='Invalid userid and password';
                $this->load->view('login1',$ad);
             }
        }
    }
    
    function logout(){
        
        $this->session->sess_destroy();
        redirect(site_url('partners'));
    }
    
    function signUp() {

        $options = array('table' => 'services',);
        $data['services'] = $this->main_content_model->customGet($options);

        $this->load->view('partners/vendorHeader');
        $this->load->view('partners/vendorView', $data);
        $this->load->view('partners/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    }
    
    function editProfile() {
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
            
        $options = array('table' => 'services',);
        $data['services'] = $this->main_content_model->customGet($options);
        
        $vendorId = $this->session->userdata('vendorId'); 
        
        $tbl = "vendorMaster";
        $con = array('vendorId' => $vendorId);
        $join[0] = array('table' => "vendorOpeningHours", 'relation' => "vendorOpeningHours.fkVendorId=vendorMaster.vendorId", 'type' => 'LEFT');
        $join[1] = array('table' => "vendorFiles", 'relation' => "vendorFiles.fkVendorId=vendorMaster.vendorId", 'type' => 'LEFT');
        
        $data['userDatas'] = $this->main_content_model->getData($tbl, null, $con, NULL, null, $join);
        
        
        $this->load->view('partners/vendorHeader');
        $this->load->view('partners/vendorEditView', $data);
        $this->load->view('partners/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    }
    
    function vendorSaveFn() {

        $this->form_validation->set_rules('centerName', 'Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerAddress', 'Email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerEmail', 'Phone', 'required|xss_clean|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerContact', 'Position', 'required|xss_clean|trim');
        $this->form_validation->set_rules('contactPersonName', 'City', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {

            $options = array('table' => 'services');
            $data['services'] = $this->main_content_model->customGet($options);

            $this->load->view('partners/vendorHeader');
            $this->load->view('partners/vendorView', $data);
            $this->load->view('partners/vendorFooter');
            $this->load->view('scriptPage/vendorScript');
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $image_array = array();
                $doc_array = array();
                $services = array();
                $centerName = $this->input->post('centerName');
                $centerAddress = $this->input->post('centerAddress');
                $centerEmail = $this->input->post('centerEmail');
                $password = md5($this->input->post('password'));
                $centerContact = $this->input->post('centerContact');
                $contactPersonName = $this->input->post('contactPersonName');
                $contactMobile = $this->input->post('contactMobile');
                $contactEmail = $this->input->post('contactEmail');
                $selectLanguage = $this->input->post('selectLanguage');
                $services = $this->input->post('services');
                
                $records_array = array('createdAt' => date('Y-m-d'), 'centerName' => $centerName, 'centerAdd' => $centerAddress, 'centerEmail' => $centerEmail,'password' => $password, 'centerContact' => $centerContact, 'contactPerson' => $contactPersonName, 'contactMobile' => $contactMobile, 'contactEmail' => $contactEmail, 'language' => serialize($selectLanguage), 'serviceNames' => serialize($services));

                $options = array
                    (
                    'data' => $records_array,
                    'table' => 'vendorMaster'
                );

                $vendorId = $this->main_content_model->customInsert($options);

          if(count($services) && !empty($services)){
                foreach($services as $service){
                    
                    $option = array(
                        'table' => 'services',
                        'select' => 'serviceName,serviceId',
                        'where' => array('serviceId' => $service),
                        'single' => TRUE
                    );

                    $serviceName = $this->main_content_model->customGet($option);
                    
                    $tableName = strtolower($serviceName->serviceName);
                    $tableName = str_replace('/', '', $tableName);
                    $tableName = str_replace(' ', '', $tableName);
                    $tableName = trim($tableName);
                    
                    $service_array = array('createAt' => date('Y-m-d'),'fkServiceId' => $serviceName->serviceId,'fkVendorId' => $vendorId);
                    $options = array
                        (
                        'data'  => $service_array,
                        'table' => $tableName
                    );
                    
                    $this->main_content_model->customInsert($options);
                }
            }
                
                if(isset($vendorId)){
                    $optionHours = array
                    (
                    'data' => array(
                        'fkVendorId' => $vendorId,
                        'mon' => serialize($this->input->post('mon')),
                        'tue' => serialize($this->input->post('tue')),
                        'wed' => serialize($this->input->post('wed')),
                        'thu' => serialize($this->input->post('thu')),
                        'fri' => serialize($this->input->post('fri')),
                        'sat' => serialize($this->input->post('sat')),
                        'sun' => serialize($this->input->post('sun')),
                        'lunchHours' => serialize($this->input->post('lunch'))
                    ),
                    'table' => 'vendorOpeningHours'
                );
                $this->main_content_model->customInsert($optionHours);  
                
                if ($_FILES['photoList']['name'] || $_FILES['documents']['name']) {

                    $valid_formats = array("jpg", "png", "gif");
                    $max_file_size = 1024 * 100; //100 kb
                    $path = "assest/vendor/image/"; // Upload directory
                    $count = 0;

                    // Loop $_FILES to exeicute all files
                    foreach ($_FILES['photoList']['name'] as $f => $name) {

                        if ($_FILES['photoList']['error'][$f] == 4) {
                            continue; // Skip file if any error found
                        }
                        if ($_FILES['photoList']['error'][$f] == 0) {
                            if ($_FILES['photoList']['size'][$f] > $max_file_size) {
                                $message[] = "$name is too large!.";
                                continue; // Skip large files
                            } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {
                                $message[] = "$name is not a valid format";
                                continue; // Skip invalid file formats
                            } else { // No error found! Move uploaded files 
                                if (move_uploaded_file($_FILES["photoList"]["tmp_name"][$f], $path . time() . $name))
                                    $image_array[$count] = base_url ().$path . time() . $name;
                                $count++; // Number of successfully uploaded file
                            }
                        }
                    }

                    $valid_formats = array("doc", "pdf");
                    $max_file_size = 1024 * 1000; //100 kb
                    $path = "assest/vendor/documents/"; // Upload directory
                    $count = 0;

                    // Loop $_FILES to exeicute all files
                    foreach ($_FILES['documents']['name'] as $f => $name) {

                        if ($_FILES['documents']['error'][$f] == 4) {
                            continue; // Skip file if any error found
                        }
                        if ($_FILES['documents']['error'][$f] == 0) {
                            if ($_FILES['documents']['size'][$f] > $max_file_size) {
                                $message[] = "$name is too large!.";
                                continue; // Skip large files
                            } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {
                                $message[] = "$name is not a valid format";
                                continue; // Skip invalid file formats
                            } else { // No error found! Move uploaded files 
                                if (move_uploaded_file($_FILES["documents"]["tmp_name"][$f], $path . time() . $name))
                                    $doc_array[$count] = base_url ().$path . time() . $name;
                                $count++; // Number of successfully uploaded file
                            }
                        }
                    }
                }
                $videoUrl = $this->input->post('video');
                $files_array = array('createdAt' => date('Y-m-d'), 'centerVideo' => serialize($videoUrl), 'fkVendorId' => $vendorId, 'centerImage' => serialize($image_array), 'centerDocument' => serialize($doc_array));

                $options = array
                    (
                    'data' => $files_array,
                    'table' => 'vendorFiles'
                );
                $this->main_content_model->customInsert($options);
            } 
                if ($vendorId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners'));
                } else {
                    $error = array("TopError" => "<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                }
                echo json_encode($responce);
            }
        }
    }
    
    function vendorEditFn() {

        $this->form_validation->set_rules('centerName', 'Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerAddress', 'Email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerEmail', 'Phone', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerContact', 'Position', 'required|xss_clean|trim');
        $this->form_validation->set_rules('contactPersonName', 'City', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {

            $options = array('table' => 'services',);
            $data['services'] = $this->main_content_model->customGet($options);

            $this->load->view('partners/vendorHeader');
            $this->load->view('partners/vendorView', $data);
            $this->load->view('partners/vendorFooter');
            $this->load->view('scriptPage/vendorScript');
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $vendorId = array('vendorId' => $this->input->post('vendorId'));
                $image_array = array();
                $doc_array = array();
                $centerName = $this->input->post('centerName');
                $centerAddress = $this->input->post('centerAddress');
                $centerEmail = $this->input->post('centerEmail');
                $centerContact = $this->input->post('centerContact');
                $contactPersonName = $this->input->post('contactPersonName');
                $contactMobile = $this->input->post('contactMobile');
                $contactEmail = $this->input->post('contactEmail');
                $selectLanguage = $this->input->post('selectLanguage');
                $newServices = $this->input->post('services');
                
                $option = array(
                    'table' => 'vendorMaster',
                    'select' => 'serviceNames',
                    'where' => $vendorId,
                    'single' => TRUE
                );
                $serviceNames = $this->main_content_model->customGet($option);
                $oldServices =  unserialize($serviceNames->serviceNames);
                
            if(count($newServices) && !empty($newServices) && count($oldServices) && !empty($oldServices)){
                foreach($newServices as $service){
                    
                    if (!in_array($service, $oldServices)){
                        
                        $option = array(
                            'table' => 'services',
                            'select' => 'serviceName,serviceId',
                            'where' => array('serviceId' => $service),
                            'single' => TRUE
                        );

                        $serviceName = $this->main_content_model->customGet($option);

                        $tableName = strtolower($serviceName->serviceName);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        
                        $option = array(
                            'table' => $tableName,
                            'select' => '*',
                            'where' => array('fkServiceId' => $service,'fkVendorId' => $this->input->post('vendorId')),
                            'single' => TRUE
                        );

                        $oldData = $this->main_content_model->customGet($option);
                        
                        if(isset($oldData) && $oldData != NULL){
                            
                            $vendorId = array('fkVendorId' => $this->input->post('vendorId'));
                            $arrayData = array('deleted' => 0);
                            $result = $this->commonInsertData($arrayData,$vendorId,$tableName);
                            
                        }else{
                            
                            $service_array = array('createAt' => date('Y-m-d'),'fkServiceId' => $serviceName->serviceId,'fkVendorId' => $this->input->post('vendorId'));
                            $options = array
                                (
                                'data'  => $service_array,
                                'table' => $tableName
                            );

                            $this->main_content_model->customInsert($options);
                        }
                    }
                }
            }
        
        if(count($oldServices ) && !empty($oldServices) && count($newServices ) && !empty($newServices)){
                foreach($oldServices as $service){
                    if (!in_array($service, $newServices)){
                        
                        $option = array(
                            'table' => 'services',
                            'select' => 'serviceName,serviceId',
                            'where' => array('serviceId' => $service),
                            'single' => TRUE
                        );

                        $serviceName = $this->main_content_model->customGet($option);

                        $tableName = strtolower($serviceName->serviceName);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $vendorId = array('fkVendorId' => $this->input->post('vendorId'));
                        $arrayData = array('deleted' => 1);
                        $result = $this->commonInsertData($arrayData,$vendorId,$tableName);
                    }
                }
            }    
                $records_array = array('createdAt' => date('Y-m-d'), 'centerName' => $centerName, 'centerAdd' => $centerAddress, 'centerEmail' => $centerEmail, 'centerContact' => $centerContact, 'contactPerson' => $contactPersonName, 'contactMobile' => $contactMobile, 'contactEmail' => $contactEmail, 'language' => serialize($selectLanguage), 'serviceNames' => serialize($newServices));
                if($this->input->post('password') != ''){
                    $records_array['password'] = md5($this->input->post('password'));
                }
                $vendorId = array('vendorId' => $this->input->post('vendorId'));
                $options = array
                    (
                    'data' => $records_array,
                    'table' => 'vendorMaster'
                );

                $vendorId = $this->commonInsertData($records_array,$vendorId,'vendorMaster');
                
                $optionHours = array(
                    'mon' => serialize($this->input->post('mon')),
                    'tue' => serialize($this->input->post('tue')),
                    'wed' => serialize($this->input->post('wed')),
                    'thu' => serialize($this->input->post('thu')),
                    'fri' => serialize($this->input->post('fri')),
                    'sat' => serialize($this->input->post('sat')),
                    'sun' => serialize($this->input->post('sun')),
                    'lunchHours' => serialize($this->input->post('lunch'))
                );
                $vendorId = array('fkVendorId' => $this->input->post('vendorId'));
                $this->commonInsertData($optionHours,$vendorId,'vendorOpeningHours');

                if ($_FILES['photoList']['name'] || $_FILES['documents']['name']) {

                    $valid_formats = array("jpg", "png", "gif");
                    $max_file_size = 1024 * 100; //100 kb
                    $path = "assest/vendor/image/"; // Upload directory
                    $count = 0;

                    // Loop $_FILES to exeicute all files
                    foreach ($_FILES['photoList']['name'] as $f => $name) {

                        if ($_FILES['photoList']['error'][$f] == 4) {
                            continue; // Skip file if any error found
                        }
                        if ($_FILES['photoList']['error'][$f] == 0) {
                            if ($_FILES['photoList']['size'][$f] > $max_file_size) {
                                $message[] = "$name is too large!.";
                                continue; // Skip large files
                            } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {
                                $message[] = "$name is not a valid format";
                                continue; // Skip invalid file formats
                            } else { // No error found! Move uploaded files 
                                if (move_uploaded_file($_FILES["photoList"]["tmp_name"][$f], $path . time() . $name))
                                    $image_array[$count] = base_url ().$path . time() . $name;
                                $count++; // Number of successfully uploaded file
                            }
                        }
                    }

                    $valid_formats = array("doc", "pdf");
                    $max_file_size = 1024 * 1000; //100 kb
                    $path = "assest/vendor/documents/"; // Upload directory
                    $count = 0;

                    // Loop $_FILES to exeicute all files
                    foreach ($_FILES['documents']['name'] as $f => $name) {

                        if ($_FILES['documents']['error'][$f] == 4) {
                            continue; // Skip file if any error found
                        }
                        if ($_FILES['documents']['error'][$f] == 0) {
                            if ($_FILES['documents']['size'][$f] > $max_file_size) {
                                $message[] = "$name is too large!.";
                                continue; // Skip large files
                            } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {
                                $message[] = "$name is not a valid format";
                                continue; // Skip invalid file formats
                            } else { // No error found! Move uploaded files 
                                if (move_uploaded_file($_FILES["documents"]["tmp_name"][$f], $path . time() . $name))
                                    $doc_array[$count] = base_url ().$path . time() . $name;
                                $count++; // Number of successfully uploaded file
                            }
                        }
                    }
                }
                
                $videoUrl = $this->input->post('video');
                
                $vendorId = array('fkVendorId' => $this->input->post('vendorId'));
                
                $option = array(
                    'table' => 'vendorFiles',
                    'select' => '*',
                    'where' => $vendorId,
                    'single' => TRUE
                );
                $vendorFiles = $this->main_content_model->customGet($option);
                $centerImage =  unserialize($vendorFiles->centerImage);
                $centerDocument =  unserialize($vendorFiles->centerDocument);
                $centerVideo =  unserialize($vendorFiles->centerVideo);
                
                if($image_array != NULL){ 
                    foreach ($image_array as $image){
                        array_push($centerImage, $image); 
                    }
                }
                
                if($doc_array != NULL){ 
                    foreach ($doc_array as $doc){
                        array_push($centerDocument, $doc); 
                    }
                }
                if(is_array($videoUrl)){ 
                    if(!empty($videoUrl[0])){ 
                        foreach ($videoUrl as $video){
                            array_push($centerVideo, $video); 
                        }
                    }
                }
                
                
                $files_array = array('centerVideo' => serialize($centerVideo), 'centerImage' => serialize($centerImage), 'centerDocument' => serialize($centerDocument));

                $id = $this->commonInsertData($files_array,$vendorId,'vendorFiles');
                
                if ($vendorId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $error = array("TopError" => "<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                }
                echo json_encode($responce);
            }
        }
    }
    
    function header(){
        
        $vendorId = $this->session->userdata('vendorId'); 
        $option = array(
            'table' => 'vendorMaster',
            'select' => 'serviceNames',
            'where' => array('vendorId' => $vendorId),
            'single' => TRUE
        );
        $serviceArray = array();
        $serviceNames = $this->main_content_model->customGet($option);
        $serviceName =  unserialize($serviceNames->serviceNames);
        if(count($serviceName) && !empty($serviceName)){
        foreach($serviceName as $service){

            $option = array(
                'table' => 'services',
                'select' => 'serviceName',
                'where' => array('serviceId' => $service),
                'single' => TRUE
            );

            $serviceName = $this->main_content_model->customGet($option);
            array_push($serviceArray, $serviceName->serviceName);
        }
    }
        $data['servicesArray'] = $serviceArray;
        
        $this->load->view('partners/vendorHeader',$data);
    }
    
    function vendorServices(){
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        $this->header();
        $this->load->view('partnerServices/deshboard');
        $this->load->view('partners/vendorFooter');
    }
     
    function vendorCustomView() {
       
        $vendorId = '';
        $table = '';
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
            $table = $this->uri->segment(4);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => $table,
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view("partnerServices/$table",$data);
        $this->load->view('partners/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    }
    
    function commonInsertData($arrayData, $Id, $table) {

        if (!empty($table) && !empty($arrayData)) {

            $updateOptions = array(
                'where'=> $Id,
                'data' => $arrayData,
                'table'=> $table
            ); 

            $vendorId = $this->main_content_model->customUpdate($updateOptions);
            
            if ($vendorId) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function saveAerobics() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/vendorServices');
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $certification =$this->input->post('certification');
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j = 0;
                    
                if(count($chargeType) && count($chargeAmount) && !empty($chargeType) && !empty($chargeAmount)){
                   
                   foreach($arrayFilter as $am){
                       $amtArray[$j] = $am;
                       $j++;
                   }
                   
                   for($i=0;$i < count($chargeType);$i++){
                        $amount[$chargeType[$i]] = $amtArray[$i];
                    }
            }
                
                $aeroId = array('aeroId' => $this->input->post('aeroId'));
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'certification' => serialize($certification),
                    'moreCertification' => $this->input->post('moreCertification'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                
                $result = $this->commonInsertData($arrayData,$aeroId,'aerobics');
                echo $result; die();
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function saveDance() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $danceId = array('danceId' => $this->input->post('danceId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$danceId,'dance');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function saveGym() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
//                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $danceId = array('gymId' => $this->input->post('gymId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
//                    'personalTrainer' => $this->input->post('personalTrainer'),
//                    'provideService' => serialize($provideServices),
//                    'travelling' => $this->input->post('travelling'),
//                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$danceId,'gym');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function saveYoga() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $yogaId = array('yogaId' => $this->input->post('yogaId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$yogaId,'yoga');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function saveZumba() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $zumbaId = array('zumbaId' => $this->input->post('zumbaId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$zumbaId,'zumba');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }


 function saveDietician() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $amenities = $this->input->post('dieticianType');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $dieticianId = array('dietId' => $this->input->post('dieticianId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'degre' => $this->input->post('degre'),
                    'institute' => $this->input->post('institute'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'recognizedYesNo' => $this->input->post('recognizedYesNo'),
                    'recognizedDetail' => $this->input->post('recognizedDetail'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$dieticianId,'dietician');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }


function savePilates() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $pilaId = array('pilaId' => $this->input->post('pilaId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'recognizedYesNo' => $this->input->post('recognizedYesNo'),
                    'aboutOrganised' => $this->input->post('aboutOrganised'),
                    'experience' => $this->input->post('experience'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$pilaId,'pilates');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

function saveSwimming() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $categories =$this->input->post('categories');
                $amenities = $this->input->post('amenities');
                $male =$this->input->post('male');
                $female = $this->input->post('female');
                $kids = $this->input->post('kids');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }

                $swimId = array('swimId' => $this->input->post('swimId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'categories' => serialize($categories),
                    'amenities' => serialize($amenities),
                    'male' => serialize($male),
                    'female' => serialize($female),
                    'kids' => serialize($kids),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'changeWaterPool' => $this->input->post('changeWaterPool'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$swimId,'swimming');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

function saveSpinning() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveSpinning');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                //$provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                //$amenities = $this->input->post('amenities');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $spinId = array('spinId' => $this->input->post('spinId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    //'provideService' => serialize($provideServices),
                    //'travelling' => $this->input->post('travelling'),
                    //'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    //'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$spinId,'spinning');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

function karateMartialart() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveDance');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $categories =$this->input->post('categories');
                $amenities = $this->input->post('amenities');
                $amount = array();
                $amtArray= array();
                $arrayFilter = array_filter($chargeAmount);
                $j=0;
                foreach($arrayFilter as $am){
                    $amtArray[$j] = $am;
                    $j++;
                }
                for($i=0;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $karaId = array('karaId' => $this->input->post('karaId'));


                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'categories' => serialize($categories),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'ageGroup' => serialize($this->input->post('ageGroup')),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'createAt' => date('Y-m-d')
                );
                $result = $this->commonInsertData($arrayData,$karaId,'karatemartialart');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No request for change .');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
}
//ALTER TABLE `dance` ADD `ageGroup` VARCHAR( 255 ) NOT NULL AFTER `vehicle` ,
//ADD `amenities` VARCHAR( 255 ) NOT NULL AFTER `ageGroup` ;