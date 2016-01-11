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

            $options = array('table' => 'services',);
            $data['services'] = $this->main_content_model->customGet($options);

            $this->load->view('partners/vendorHeader');
            $this->load->view('partners/vendorView', $data);
            $this->load->view('partners/vendorFooter');
            $this->load->view('scriptPage/vendorScript');
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $image_array = array();
                $doc_array = array();
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

                $vendorId = $this->commonInsertData($records_array,$vendorId,'vendorMaster');

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
                $files_array = array('createdAt' => date('Y-m-d'), 'centerVideo' => serialize($videoUrl), 'fkVendorId' => $vendorId, 'centerImage' => serialize($image_array), 'centerDocument' => serialize($doc_array));

                $options = array
                    (
                    'data' => $files_array,
                    'table' => 'vendorFiles'
                );
                $this->main_content_model->customInsert($options);

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
    }
    
    function vendorCross() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'crossfunctional',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorDance(){
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'dance',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/dance',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorDietician() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'dietician',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorFitness() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'fitnessstudio',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorGym(){
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'gym',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/gym',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorKarate() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'karatemartialart',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorKickBoxing() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'kickboxing',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorNutritionist() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'nutritionist',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorPilates() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'pilates',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorSpinning() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'spinning',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorSwimming() {
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'swimming',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/comingSoon',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorYoga(){
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'yoga',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/yoga',$data);
        $this->load->view('partners/vendorFooter');
    }
    
    function vendorZumba(){
        
        $vendorId = '';
        
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }else{
            $vendorId =  $this->uri->segment(3);
        }
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        
        $options = array(
            'table' => 'zumba',
            'where' => array('fkVendorId'=> $vendorId,'enabled'=> 1,'deleted'=> 0)
            );
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
        $this->header();
        $this->load->view('partnerServices/zumba',$data);
        $this->load->view('partners/vendorFooter');
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
            redirect('partners/vendorAerobics');
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
                
               foreach($arrayFilter as $am){
                   $amtArray[$j] = $am;
                   $j++;
               }
               
               for($i=1;$i < count($chargeType);$i++){
                    $amount[$chargeType[$i]] = $amtArray[$i];
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
                for($i=1;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $danceId = array('danceId' => $this->input->post('danceId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
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
                for($i=1;$i < count($chargeType);$i++){
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
                for($i=1;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $yogaId = array('yogaId' => $this->input->post('yogaId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
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
                for($i=1;$i < count($chargeType);$i++){
                  $amount[$chargeType[$i]] = $amtArray[$i];
                }
                $zumbaId = array('zumbaId' => $this->input->post('zumbaId'));
                
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
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
}
//ALTER TABLE `dance` ADD `ageGroup` VARCHAR( 255 ) NOT NULL AFTER `vehicle` ,
//ADD `amenities` VARCHAR( 255 ) NOT NULL AFTER `ageGroup` ;