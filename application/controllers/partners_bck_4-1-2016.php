<?php

class Partners extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('main_content_model');
    }

    function index(){
        $this->load->view('login/loginHeader');
        $this->load->view('login/login');
        $this->load->view('login/loginFooter');
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
            $this->session->set_userdata('contactPerson',$query[0]['contactPerson']);
            redirect('partners/vendorServices');  
        }else{
                if($query == 0){
                    $ad['error']='Invalid Username or Password';
                    $this->load->view('login/loginHeader');
                    $this->load->view('login/login',$ad);
                    $this->load->view('login/loginFooter');
                }else{
                    $ad['error']='Your account is not active, please check your mail';
                    $this->load->view('login/loginHeader');
                    $this->load->view('login/login',$ad);
                    $this->load->view('login/loginFooter');
                }
            }
        }
    }
    
    function changePassword(){
        
        $this->form_validation->set_rules('old', 'Old Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>ajax_validation_errors());
            echo json_encode($responce);
        } else {

            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                    
                    $vendorId = array( 'vendorId' => $this->input->post('vendorId'));
                    $vendor = $this->input->post('vendorId');
                    $old = md5($this->input->post('old'));
                    
                    $query = "SELECT * FROM (`vendorMaster`) WHERE `vendorId` =  '$vendor' AND `password` =  '$old' AND `active` =  '1'";
                    $users = $this->main_content_model->customQuery($query);
                    if($users){
                        
                        $data['password'] = md5($this->input->post('password'));
                        $updateOptions = array(
                            'where'=> $vendorId,
                            'data' => $data,
                            'table'=> 'vendorMaster'
                        ); 

                        $passwordChange = $this->main_content_model->customUpdate($updateOptions);
                        if ($passwordChange) {
                            $responce =  array('status'=>1,'msg'=>'Your password is successfully changed');
                        } else {
                            $error = array("TopError"=>"<strong>Your last password and new password are same.</strong>");
                            $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
                        }
                    }else{
                        $error = array("TopError"=>"<strong>Your old password is wrong.</strong>");
                        $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
                    }
                
                echo json_encode($responce);
            }
        }
    }
            
    function logout(){
        
        $this->session->sess_destroy();
        redirect(site_url('partners'));
    }
    
    function signUp() {
        $this->session->sess_destroy();
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
                $fbId = $this->input->post('fbId');
                $twitId = $this->input->post('twitId');
                $selectLanguage = $this->input->post('selectLanguage');
                $services = $this->input->post('services');
		$centerType = $this->input->post('centerType');
                $womenDays = $this->input->post('womenDays');
                $activation_code = md5(time());
                $records_array = array('createdAt' => date('Y-m-d'), 'centerName' => $centerName, 'centerAdd' => $centerAddress, 'centerEmail' => $centerEmail,'password' => $password, 'centerContact' => $centerContact, 'contactPerson' => $contactPersonName, 'contactMobile' => $contactMobile, 'contactEmail' => $contactEmail, 'fbId' => $fbId, 'twitId' => $twitId, 'language' => serialize($selectLanguage), 'serviceNames' => serialize($services), 'centerType' => $centerType, 'womenDays' => serialize($womenDays),'activation_code'=>$activation_code);

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
                        'lunchHours' => serialize($this->input->post('lunch')),
                        'shiftM' => serialize($this->input->post('shiftM')),
                        'shiftE' => serialize($this->input->post('shiftE'))
                    ),
                    'table' => 'vendorOpeningHours'
                );
                $this->main_content_model->customInsert($optionHours);  
                
                
                $videoUrl = $this->input->post('video');
                $files_array = array('createdAt' => date('Y-m-d'), 'centerVideo' => serialize($videoUrl), 'fkVendorId' => $vendorId, 'centerImage' => serialize($image_array), 'centerDocument' => serialize($doc_array));

                $options = array
                    (
                    'data' => $files_array,
                    'table' => 'vendorFiles'
                );
                $this->main_content_model->customInsert($options);
            } 
//                    $emailOptions = array
//                        (
//                        'mails' => array($email => FALSE),
//                        'subject' => "Activation link",
//                        'message' => "Dear {$contactPersonName},
//                            Welcome to Froyofit 
//                            Kindly note down your credentials to log on to our website:
//                            User Name :  {$centerEmail}
//                            with
//                            Password  :  {$this->input->post('password')}
//                            Kindly click on the link below to activate your account :
//                            Link : http://froyofit.com/partners/$activation_code/$vendorId"
//                                    . "Thank you"
//                                    . "Team Froyofit."
//
//// Location Url: {$_SERVER['SERVER_NAME']} "
//                        . "",
//                        'from' => $this->lang->line("from")
//                    );
//
//                    $this->sendMail($emailOptions);
                    $this->email->from('activate@froyofit.com', 'Team Froyofit');
                    $this->email->to($centerEmail);
            //        $this->email->bcc('them@their-example.com');

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear {$contactPersonName},
                            Welcome to Froyofit.Thank you for registering with us. Kindly note down your credentials which will be used to further log in to our website:
                            User Name :  {$centerEmail}
                            Password  :  {$this->input->post('password')}
                            Kindly click on the link below to activate your account :
                            Link : http://froyofit.com/partners/activateEmail/$activation_code/$vendorId
                            Post verification you can login to our system and complete your registration process
                            Thank you
                            Team Froyofit.");
                    $this->email->send();
                    
                    $this->email->from('support@froyofit.com', 'Team Froyofit');
                    $this->email->to('admin@froyofit.com');

                    $this->email->subject("Froyofit");
                    $this->email->message("Dear admin, 
                        
                        {$contactPersonName},You have been registered successfully with Froyofit. Kindly check mail for further procedure and other details.  ");
                    $this->email->send();
                    
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
//        $this->form_validation->set_rules('centerEmail', 'Phone', 'required|xss_clean|trim');
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
                $fbId = $this->input->post('fbId');
                $twitId = $this->input->post('twitId');
                $selectLanguage = $this->input->post('selectLanguage');
                $newServices = $this->input->post('services');
		$centerType = $this->input->post('centerType');
		$subscription = $this->input->post('subscription');
                $badge = $this->input->post('badge');
                $womenDays = $this->input->post('womenDays');
                
                $option = array(
                    'table' => 'vendorMaster',
                    'select' => 'serviceNames',
                    'where' => $vendorId,
                    'single' => TRUE
                );
                $serviceNames = $this->main_content_model->customGet($option);
                $oldServices =  unserialize($serviceNames->serviceNames);
                
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

                $records_array = array('createdAt' => date('Y-m-d'), 'centerName' => $centerName, 'centerAdd' => $centerAddress, 'centerEmail' => $centerEmail, 'centerContact' => $centerContact, 'contactPerson' => $contactPersonName, 'contactMobile' => $contactMobile, 'contactEmail' => $contactEmail, 'fbId' => $fbId, 'twitId' => $twitId, 'language' => serialize($selectLanguage), 'serviceNames' => serialize($newServices), 'centerType' => $centerType, 'subscription' => $subscription, 'badge' => $badge, 'womenDays' => serialize($womenDays));
                
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
                    'lunchHours' => serialize($this->input->post('lunch')),
                    'shiftM' => serialize($this->input->post('shiftM')),
                    'shiftE' => serialize($this->input->post('shiftE'))
                );
                $vendorId = array('fkVendorId' => $this->input->post('vendorId'));
                $this->commonInsertData($optionHours,$vendorId,'vendorOpeningHours');
                
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
//        $data['servicesArray'] = $serviceArray;
//        $this->load->view('partners/vendorHeader',$data);
        return $serviceArray;
    }
    
    function vendorServices(){
        
        if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); }
        $head = $this->header();
        $data['servicesArray'] = $head;
        $this->load->view('partners/vendorHeader',$data);
        $this->load->view('partnerServices/deshboard');
        $this->load->view('partners/vendorFooter');
    }
     
    function vendorCustomView() {
       
        $vendorId = '';
        $table = '';
        if( $this->uri->segment(3) == '' ){
            $vendorId = $this->session->userdata('vendorId');
        }if($this->uri->segment(4)  == '' ){
            $vendorId = $this->session->userdata('vendorId');
            $table = $this->uri->segment(2);
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
		$data['messages'] =$this->session->flashdata('messages');
        $head = $this->header();
        $data['servicesArray'] = $head;
        $this->load->view('partners/vendorHeader',$data);
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
    
    function completeService(){
        
        $this->email->from('serviceInfo@froyofit.com', 'Team Froyofit');
        $this->email->to($this->session->userdata('vendorEmail'));

        $this->email->subject("Froyofit");
        $this->email->message("Dear {$this->session->userdata('contactPerson')},
            
                Thank you for providing all required details. Our team will soon verify it , and inform you as it goes live. Meanwhile please follow us on our social media channels below to stay updated with the latest happenings at froyofit.com

                Facebook : https://www.facebook.com/froyofit
                Twitter : https://twitter.com/FroyoFit
                Linkedin : https://www.linkedin.com/company/froyofit

                Thank you
                Team Froyofit.");
        $this->email->send();
        
        $this->email->from('customersupport@froyofit.com', 'Team Froyofit');
        $this->email->to('admin@froyofit.com');

        $this->email->subject("Froyofit");
        $this->email->message("Dear admin, 

            {$this->session->userdata('contactPerson')} with Email id: {$this->input->post('vendorEmail')} has completed his profile.Kindly verify and approve .

            ");
        $this->email->send();
                    
        redirect(site_url('partners/vendorServices'));
    }
	/* this function is write for the availability checking users
		are currently submit there changes or not.If a changes request made,
		first superadmin approve it,then another changes request is acceptable.
		return boolean
	*/	
    private function checkAvailability($data=array()){
		$fkVendorId = $data['fkVendorId'];
		$tableName = $data['tableName'];
		$options = array(
            'table' => 'tempory_service_hold',
            'where' => array('fkVendorId'=> $fkVendorId,'status'=> 0,'tableName'=> $tableName),
			'select' => 'status'
            );
			$result = $this->main_content_model->customGet($options);
			if(!empty($result)){
				$this->session->set_flashdata('messages', "<strong><span style=color:red>Your updatation not yet approved by superadmin.</span></strong>");
				redirect(site_url("partners/vendorCustomView/$fkVendorId/$tableName"));
			}
			else 
				return true;
	}
    function aerobics() {
		$Availability_option = array(
		'fkVendorId'=> $this->input->post('fkVendorId'),
		'tableName'=> 'aerobics'
		);
		$this->checkAvailability($Availability_option);
        $this->form_validation->set_rules('experience', 'Experience field', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
			
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
                    'currency' => $this->input->post('currency'),
                    'createAt' => date('Y-m-d'),
                    'updateFlag' => 1,//chages are made by Arindam below
					'tableName' => 'aerobics',
					'tableAutoincrementId' => $this->input->post('aeroId'),
					'requestCreationTime' => strtotime(date('Y-m-d H:i:s'))
                );
                
               // $result = $this->commonInsertData($arrayData,$aeroId,'aerobics');
				$result = $this->main_content_model->customInsertServices($arrayData,'aerobics');
                if ($result) {
                    $this->session->set_flashdata('messages', '<strong><span style="color:green">Your Information submited successfully.Wait for superadmin approval</span></strong>');
                    $head = $this->header();
                    $update = 0;
                    $serviceCount = count($head);
                    foreach ($head as $service){
                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $option = array(
                            'table' => $tableName,
                            'select' => 'updateFlag',
                            'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                            'single' => TRUE
                        );
                        $serviceName = $this->main_content_model->customGet($option);
                        $vendorId = $this->session->userdata('vendorId');
						//echo $serviceName->updateFlag,$tableName;exit;
                        if($serviceName->updateFlag == 1){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}
						else{ $update++; continue; }
                    }
                    
                    if($update == $serviceCount){ $this->completeService(); }
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function crossfunctional() {

        $Availability_option = array(
        'fkVendorId'=> $this->input->post('fkVendorId'),
        'tableName'=> 'crossfunctional'
        );
        $this->checkAvailability($Availability_option);

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $crossId = array('crossId' => $this->input->post('crossId'));
                $arrayData = array(
                    'fkServiceId' => $this->input->post('fkServiceId'),
                    'fkVendorId' => $this->input->post('fkVendorId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'createAt' => date('Y-m-d'),                    
                    'updateFlag' => 1,
                    'tableName' => 'crossfunctional',
                    'tableAutoincrementId' => $this->input->post('crossId'),
                    'requestCreationTime' => strtotime(date('Y-m-d H:i:s'))
                );
                
               // $result = $this->commonInsertData($arrayData,$crossId,'crossfunctional');
                $result = $this->main_content_model->customInsertServices($arrayData,'crossfunctional');
                if ($result) {
                   // $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                     $this->session->set_flashdata('messages', '<strong><span style="color:green">Your Information submited successfully.Wait for superadmin approval</span></strong>');
                    $head = $this->header();
                    $update = 0;
                    $serviceCount = count($head);
                    foreach ($head as $service){
                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $option = array(
                            'table' => $tableName,
                            'select' => 'updateFlag',
                            'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                            'single' => TRUE
                        );
                        $serviceName = $this->main_content_model->customGet($option);
                        $vendorId = $this->session->userdata('vendorId');
                        if($serviceName->updateFlag == 1){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                    }
                    
                    if($update == $serviceCount){ $this->completeService(); }
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function fitnessstudio() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
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

                $fitId = array('fitId' => $this->input->post('fitId'));
                
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
                    'currency' => $this->input->post('currency'),
                    'createAt' => date('Y-m-d'),                    
                    'updateFlag' => 1
                );
                $result = $this->commonInsertData($arrayData,$fitId,'fitnessstudio');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $head = $this->header();
                    $update = 0;
                    $serviceCount = count($head);
                    foreach ($head as $service){
                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $option = array(
                            'table' => $tableName,
                            'select' => 'updateFlag',
                            'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                            'single' => TRUE
                        );
                        $serviceName = $this->main_content_model->customGet($option);
                        $vendorId = $this->session->userdata('vendorId');
                        if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                    }
                    
                    if($update == $serviceCount){ $this->completeService(); }
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function dance() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');
        $this->form_validation->set_rules('experience', 'Experience field', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Categories ', 'required|xss_clean|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
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
                    'degree' => $this->input->post('degree'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'currency' => $this->input->post('currency'),
                    'createAt' => date('Y-m-d'),                    
                    'updateFlag' => 1
                );
                $result = $this->commonInsertData($arrayData,$danceId,'dance');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $head = $this->header();
                    $update = 0;
                    $serviceCount = count($head);
                    foreach ($head as $service){
                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $option = array(
                            'table' => $tableName,
                            'select' => 'updateFlag',
                            'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                            'single' => TRUE
                        );
                        $serviceName = $this->main_content_model->customGet($option);
                        $vendorId = $this->session->userdata('vendorId');
                        if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                    }
                    
                    if($update == $serviceCount){ $this->completeService(); }
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function dietitiannutritionist() {

           $this->form_validation->set_rules('degre', 'About your degre', 'required|xss_clean|trim');
           $this->form_validation->set_rules('institute', 'Institute', 'required|xss_clean|trim');
           $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
           $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
           $this->form_validation->set_rules('dieticianType[]', 'Dietitian Type', 'required|xss_clean|trim');

           if ($this->form_validation->run() == FALSE) {
               $this->vendorCustomView();
           } else {
               if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                   $provideServices =$this->input->post('provideService');
                   $chargeType = $this->input->post('chargeType');
                   $chargeAmount = $this->input->post('chargeAmount');
                   $amenities = $this->input->post('dieticianType');

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
                       'chargeAmountText' => $this->input->post('chargeAmountText'),
                       'currency' => $this->input->post('currency'),
                       'createAt' => date('Y-m-d'),                    
                       'updateFlag' => 1
                   );
                   $result = $this->commonInsertData($arrayData,$dieticianId,'dietitiannutritionist');
                   if ($result) {
                        $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                        $head = $this->header();
                        $update = 0;
                        $serviceCount = count($head);
                        foreach ($head as $service){
                            $tableName = strtolower($service);
                            $tableName = str_replace('/', '', $tableName);
                            $tableName = str_replace(' ', '', $tableName);
                            $tableName = trim($tableName);
                            $option = array(
                                'table' => $tableName,
                                'select' => 'updateFlag',
                                'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                                'single' => TRUE
                            );
                            $serviceName = $this->main_content_model->customGet($option);
                            $vendorId = $this->session->userdata('vendorId');
                            if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                        }

                        if($update == $serviceCount){ $this->completeService(); }
                   } else {
                       $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                       redirect(site_url('partners/vendorServices'));
                   }
                   echo json_encode($responce);
               }
           }
       }
    
    function gym() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
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
                    'currency' => $this->input->post('currency'),
                    'createAt' => date('Y-m-d'),                    
                    'updateFlag' => 1
                );
                $result = $this->commonInsertData($arrayData,$danceId,'gym');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $head = $this->header();
                    $update = 0;
                    $serviceCount = count($head);
                    foreach ($head as $service){
                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $option = array(
                            'table' => $tableName,
                            'select' => 'updateFlag',
                            'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                            'single' => TRUE
                        );
                        $serviceName = $this->main_content_model->customGet($option);
                        $vendorId = $this->session->userdata('vendorId');
                        if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                    }
                    
                    if($update == $serviceCount){ $this->completeService(); }
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function karateMartialart() {

            $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
            $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
            $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
            $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
            $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->vendorCustomView();
            } else {
                if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                    $chargeType = $this->input->post('chargeType');
                    $chargeAmount = $this->input->post('chargeAmount');
                    $categories =$this->input->post('categories');
                    $amenities = $this->input->post('amenities');


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
                        'currency' => $this->input->post('currency'),
                        'createAt' => date('Y-m-d'),                    
                        'updateFlag' => 1
                    );
                    $result = $this->commonInsertData($arrayData,$karaId,'karatemartialart');
                    if ($result) {
                        $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                        $head = $this->header();
                        $update = 0;
                        $serviceCount = count($head);
                        foreach ($head as $service){
                            $tableName = strtolower($service);
                            $tableName = str_replace('/', '', $tableName);
                            $tableName = str_replace(' ', '', $tableName);
                            $tableName = trim($tableName);
                            $option = array(
                                'table' => $tableName,
                                'select' => 'updateFlag',
                                'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                                'single' => TRUE
                            );
                            $serviceName = $this->main_content_model->customGet($option);
                            $vendorId = $this->session->userdata('vendorId');
                            if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                        }

                        if($update == $serviceCount){ $this->completeService(); }
                    } else {
                        $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                        redirect(site_url('partners/vendorServices'));
                    }
                    echo json_encode($responce);
                }
            }
        }
    
    function massages() {

           $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
           $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');

           if ($this->form_validation->run() == FALSE) {
               $this->vendorCustomView();
           } else {
               if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

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


                   $massId = array('massId' => $this->input->post('massId'));

                   $arrayData = array(
                       'fkServiceId' => $this->input->post('fkServiceId'),
                       'fkVendorId' => $this->input->post('fkVendorId'),
                       'adoutService' => $this->input->post('adoutService'),
                       'experience' => $this->input->post('experience'),
                       'provideService' => serialize($provideServices),
                       'travelling' => $this->input->post('travelling'),
                       'vehicle' => $this->input->post('vehicle'),
                       'item' => $this->input->post('item'),
                       'aboutUs' => $this->input->post('aboutUs'),
                       'typeMass' => $this->input->post('typeMass'),
                       'chargeType' => serialize($chargeType),
                       'chargeAmount' => serialize($amount),
                       'chargeAmountText' => $this->input->post('chargeAmountText'),
                       'currency' => $this->input->post('currency'),
                       'createAt' => date('Y-m-d'),                    
                       'updateFlag' => 1
                   );
                   $result = $this->commonInsertData($arrayData,$massId,'massages');
                   if ($result) {
                        $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                        $head = $this->header();
                        $update = 0;
                        $serviceCount = count($head);
                        foreach ($head as $service){
                            $tableName = strtolower($service);
                            $tableName = str_replace('/', '', $tableName);
                            $tableName = str_replace(' ', '', $tableName);
                            $tableName = trim($tableName);
                            $option = array(
                                'table' => $tableName,
                                'select' => 'updateFlag',
                                'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                                'single' => TRUE
                            );
                            $serviceName = $this->main_content_model->customGet($option);
                            $vendorId = $this->session->userdata('vendorId');
                            if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                        }

                        if($update == $serviceCount){ $this->completeService(); }
                   } else {
                       $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                       redirect(site_url('partners/vendorServices'));
                   }
                   echo json_encode($responce);
               }
           }
       }
        
    function pilates() {

            $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
            $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
            $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
            $this->form_validation->set_rules('amenities[]', 'Categories', 'required|xss_clean|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->vendorCustomView();
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
                        'currency' => $this->input->post('currency'),
                        'createAt' => date('Y-m-d'),                    
                        'updateFlag' => 1
                    );
                    $result = $this->commonInsertData($arrayData,$pilaId,'pilates');
                    if ($result) {
                        $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                        $head = $this->header();
                        $update = 0;
                        $serviceCount = count($head);
                        foreach ($head as $service){
                            $tableName = strtolower($service);
                            $tableName = str_replace('/', '', $tableName);
                            $tableName = str_replace(' ', '', $tableName);
                            $tableName = trim($tableName);
                            $option = array(
                                'table' => $tableName,
                                'select' => 'updateFlag',
                                'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                                'single' => TRUE
                            );
                            $serviceName = $this->main_content_model->customGet($option);
                            $vendorId = $this->session->userdata('vendorId');
                            if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                        }

                        if($update == $serviceCount){ $this->completeService(); }
                    } else {
                        $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                        redirect(site_url('partners/vendorServices'));
                    }
                    echo json_encode($responce);
                }
            }
        }

    function swimming() {

            $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
            $this->form_validation->set_rules('adoutService', 'Description', 'required|xss_clean|trim');
            $this->form_validation->set_rules('trainer', 'Trainer', 'required|xss_clean|trim');
            $this->form_validation->set_rules('changeWaterPool', 'Change Water Pool', 'required|xss_clean|trim');
            $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
            $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->vendorCustomView();
            } else {
                
                if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                    $chargeType = $this->input->post('chargeType');
                    $chargeAmount = $this->input->post('chargeAmount');
                    $categories =$this->input->post('categories');
                    $amenities = $this->input->post('amenities');
                    $male =$this->input->post('male');
                    $female = $this->input->post('female');
                    $kids = $this->input->post('kids');
                    $common = $this->input->post('common');
                    $dimensions = $this->input->post('dimensions');

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


                    $swimId = array('swimId' => $this->input->post('swimId'));

                    $arrayData = array(
                        'fkServiceId' => $this->input->post('fkServiceId'),
                        'fkVendorId' => $this->input->post('fkVendorId'),
                        'adoutService' => $this->input->post('adoutService'),
                        'trainer' => $this->input->post('trainer'),
                        'awards' => $this->input->post('awards'),
                        'experience' => $this->input->post('experience'),
                        'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                        'categories' => serialize($categories),
                        'amenities' => serialize($amenities),
                        'male' => serialize($male),
                        'female' => serialize($female),
                        'kids' => serialize($kids),
                        'common' => serialize($common),
                        'dimensions' => serialize($dimensions),
                        'changeWaterPool' => $this->input->post('changeWaterPool'),
                        'chargeType' => serialize($chargeType),
                        'chargeAmount' => serialize($amount),
                        'currency' => $this->input->post('currency'),
                        'createAt' => date('Y-m-d'),                    
                        'updateFlag' => 1
                    );
                    $result = $this->commonInsertData($arrayData,$swimId,'swimming');
                    if ($result) {
                        $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                        $head = $this->header();
                        $update = 0;
                        $serviceCount = count($head);
                        foreach ($head as $service){
                            $tableName = strtolower($service);
                            $tableName = str_replace('/', '', $tableName);
                            $tableName = str_replace(' ', '', $tableName);
                            $tableName = trim($tableName);
                            $option = array(
                                'table' => $tableName,
                                'select' => 'updateFlag',
                                'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                                'single' => TRUE
                            );
                            $serviceName = $this->main_content_model->customGet($option);
                            $vendorId = $this->session->userdata('vendorId');
                            if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                        }

                        if($update == $serviceCount){ $this->completeService(); }
                    } else {
                        $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                        redirect(site_url('partners/vendorServices'));
                    }
                    echo json_encode($responce);
                }
            }
        }

    function spinning() {

            $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
            $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
            $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
            $this->form_validation->set_rules('amenities[]', 'Categories', 'required|xss_clean|trim');

            if ($this->form_validation->run() == FALSE) {
                redirect('partners/saveSpinning');
            } else {
                if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                    //$provideServices =$this->input->post('provideService');
                    $chargeType = $this->input->post('chargeType');
                    $chargeAmount = $this->input->post('chargeAmount');
                    $ageGroup = $this->input->post('ageGroup');
                    $amenities = $this->input->post('amenities');

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
                        'amenities' => serialize($amenities),
                        'aboutUs' => $this->input->post('aboutUs'),
                        'chargeType' => serialize($chargeType),
                        'chargeAmount' => serialize($amount),
                        'currency' => $this->input->post('currency'),
                        'createAt' => date('Y-m-d'),                    
                        'updateFlag' => 1
                    );
                    $result = $this->commonInsertData($arrayData,$spinId,'spinning');
                    if ($result) {
                        $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                        $head = $this->header();
                        $update = 0;
                        $serviceCount = count($head);
                        foreach ($head as $service){
                            $tableName = strtolower($service);
                            $tableName = str_replace('/', '', $tableName);
                            $tableName = str_replace(' ', '', $tableName);
                            $tableName = trim($tableName);
                            $option = array(
                                'table' => $tableName,
                                'select' => 'updateFlag',
                                'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                                'single' => TRUE
                            );
                            $serviceName = $this->main_content_model->customGet($option);
                            $vendorId = $this->session->userdata('vendorId');
                            if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                        }

                        if($update == $serviceCount){ $this->completeService(); }
                    } else {
                        $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                        redirect(site_url('partners/vendorServices'));
                    }
                    echo json_encode($responce);
                }
            }
        }
    
    function yoga() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
        $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                $categories =$this->input->post('categories');
                $amenities = $this->input->post('amenities');


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
                    'categories' => serialize($categories),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'currency' => $this->input->post('currency'),
                    'createAt' => date('Y-m-d'),                    
                    'updateFlag' => 1
                );
                $result = $this->commonInsertData($arrayData,$yogaId,'yoga');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $head = $this->header();
                    $update = 0;
                    $serviceCount = count($head);
                    foreach ($head as $service){
                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $option = array(
                            'table' => $tableName,
                            'select' => 'updateFlag',
                            'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                            'single' => TRUE
                        );
                        $serviceName = $this->main_content_model->customGet($option);
                        $vendorId = $this->session->userdata('vendorId');
                        if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                    }
                    
                    if($update == $serviceCount){ $this->completeService(); }
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function zumba() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
        $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $provideServices =$this->input->post('provideService');
                $chargeType = $this->input->post('chargeType');
                $chargeAmount = $this->input->post('chargeAmount');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $categories = $this->input->post('categories');


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
                    'categories' => serialize($categories),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'chargeType' => serialize($chargeType),
                    'chargeAmount' => serialize($amount),
                    'currency' => $this->input->post('currency'),
                    'createAt' => date('Y-m-d'),                    
                    'updateFlag' => 1
                );
                $result = $this->commonInsertData($arrayData,$zumbaId,'zumba');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $head = $this->header();
                    $update = 0;
                    $serviceCount = count($head);
                    foreach ($head as $service){
                        $tableName = strtolower($service);
                        $tableName = str_replace('/', '', $tableName);
                        $tableName = str_replace(' ', '', $tableName);
                        $tableName = trim($tableName);
                        $option = array(
                            'table' => $tableName,
                            'select' => 'updateFlag',
                            'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                            'single' => TRUE
                        );
                        $serviceName = $this->main_content_model->customGet($option);
                        $vendorId = $this->session->userdata('vendorId');
                        if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                    }
                    
                    if($update == $serviceCount){ $this->completeService(); }
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
    function others() {

            $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');

            if ($this->form_validation->run() == FALSE) {
                redirect('partners/saveSpinning');
            } else {
                if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                    //$provideServices =$this->input->post('provideService');
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


                    $otherId = array('otherId' => $this->input->post('otherId'));

                    $arrayData = array(
                        'fkServiceId' => $this->input->post('fkServiceId'),
                        'fkVendorId' => $this->input->post('fkVendorId'),
                        'adoutService' => $this->input->post('adoutService'),
                        'aboutUs' => $this->input->post('aboutUs'),
                        'chargeType' => serialize($chargeType),
                        'chargeAmount' => serialize($amount),
                        'currency' => $this->input->post('currency'),
                        'createAt' => date('Y-m-d'),                    
                        'updateFlag' => 1
                    );
                    $result = $this->commonInsertData($arrayData,$otherId,'others');
                    if ($result) {
                        $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                        $head = $this->header();
                        $update = 0;
                        $serviceCount = count($head);
                        foreach ($head as $service){
                            $tableName = strtolower($service);
                            $tableName = str_replace('/', '', $tableName);
                            $tableName = str_replace(' ', '', $tableName);
                            $tableName = trim($tableName);
                            $option = array(
                                'table' => $tableName,
                                'select' => 'updateFlag',
                                'where' => array('fkVendorId' => $this->input->post('fkVendorId')),
                                'single' => TRUE
                            );
                            $serviceName = $this->main_content_model->customGet($option);
                            $vendorId = $this->session->userdata('vendorId');
                            if($serviceName->updateFlag == 0){ redirect(site_url("partners/vendorCustomView/$vendorId/$tableName"));}else{ $update++; continue; }
                        }

                        if($update == $serviceCount){ $this->completeService(); }
                    } else {
                        $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                        redirect(site_url('partners/vendorServices'));
                    }
                    echo json_encode($responce);
                }
            }
        }
    
    function checkEmailExist() {
        
        $email = $this->input->post('email');
        $column = $this->input->post('column');
        
        $query = "SELECT * FROM (`vendorMaster`) WHERE `$column` =  '$email'";
        
        $users = $this->main_content_model->customQuery($query);
 
        if (isset($users) && $users != NULL) {
            echo  "1";
        } else {
            echo  "0";
        }
    }
    
    function activateEmail(){
        
        $code = $this->uri->segment(3);
        $vendorId = $this->uri->segment(4);
        
        if($vendorId){
            $query = "SELECT * FROM (`vendorMaster`) WHERE `vendorId` =  '$vendorId' AND `activation_code` =  '$code' AND `active` =  '0'";
            $users = $this->main_content_model->customQuery($query);
            
            $id = array('vendorId'=>$vendorId);
            if($users){
                $arrayData = array(
                    'active' => 1
                );
                $result = $this->commonInsertData($arrayData,$id,'vendorMaster');
                if($result){
                    $this->session->set_flashdata('succ_msg', 'Your Account is activated successfully.');
                    redirect(site_url('partners'));
                }else{
                    $this->session->set_flashdata('err_msg', 'Your Account is already active.');
                    redirect(site_url('partners'));
                }
            }else{
                $this->session->set_flashdata('err_msg', 'Your Account is already active.');
                redirect(site_url('partners'));
            }
        }
    }
}