<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Healthcare extends MY_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('Healthcare_model');
       $this->load->library('datatables');
       $this->load->helper('common_helper');
   }
   function index(){

       $data = array();
      // $data['healthcareData'] = $this->Healthcare_model->fetchHealthcareData();
      // echo 'test'; exit;
       //print_r($data['pharmacyData']);
       //exit;
        $data['allCities'] = $this->Healthcare_model->fetchCity();
       // print_r($data);exit;
       // $this->load->view('pharmacyListing',$data);
        $data['title'] = 'Healthcare Packages';

        $this->load->super_admin_template('listHealthpkg', $data, 'scriptHealthpkg');
   }
   
   function getBookingHealthPkgDl(){
       
        echo $this->Healthcare_model->fetchBookingHealthpkgDataTables();
   }
   
    function getHealthPkgDl(){

       
        echo $this->Healthcare_model->fetchHealthpkgDataTables();
 
   }
   function addHealthpkg(){
    $data = array();
        $data['allCities'] = $this->Healthcare_model->fetchCity();
        $data['title'] = 'Add Healthpkg';
        $this->load->super_admin_template('addHealthpkg', $data,'scriptHealthpkg');
       //$this->load->view('addPharmacy',$data);
   }
   function detailHealthpkg($healthPackage_id=''){
       $data = array();
       // echo $healthPackage_id; exit;
        $data['healthcareData'] = $this->Healthcare_model->fetchHealthcareData($healthPackage_id);
        $data['healthPackage_id'] = $healthPackage_id;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $data['title'] = 'Health Package Detail';
        $this->load->super_admin_template('detailHealthpkg', $data,'scriptHealthpkg');
   }
   function fetchCity(){
       //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Healthcare_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
    
    function fetchHospital(){
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
    
     function fetchDiagno(){
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
    
  function SaveHealthcare(){
     // print_r($_POST);exit;
        $this->load->library('form_validation');
      
        $this->bf_form_validation->set_rules('miType', 'Mi Type', 'xss_clean|required|trim');
        $this->bf_form_validation->set_rules('city', 'Health Package City', 'xss_clean|required|trim');
       $this->bf_form_validation->set_rules('miName','Mi Name', 'xss_clean|required|trim');
       
       $this->bf_form_validation->set_rules('packageId','Package Id','xss_clean|required|trim');
       $this->bf_form_validation->set_rules('packagetitle','Package Title','xss_clean|required|trim');
   
        $this->bf_form_validation->set_rules('bestPrice', 'Best Price', 'xss_clean|required|trim');
       $this->bf_form_validation->set_rules('discountPrice','Discount Price','required|xss_clean|trim');
       //$this->bf_form_validation->set_rules('testIncluded','Test Includes','required|xss_clean|trim');
       
        if ($this->bf_form_validation->run() === FALSE) {
         $data = array();
            $data['allCities'] = $this->Healthcare_model->fetchCity();
            $data['title'] = 'Add Healthpkg';
            $this->load->super_admin_template('addHealthpkg', $data, 'scriptHealthpkg');
         }
         else {
                $packageId = $this->input->post('packageId');
                $packagetitle = $this->input->post('packagetitle');
                $bestPrice = $this->input->post('bestPrice');
                $discountPrice = $this->input->post('discountPrice');
                $city = $this->input->post('city');
                $miName=$this->input->post('miName');
                $testIncluded=implode('|',$this->input->post('testIncluded'));
                    $insertData = array(
                     'healthPackage_packageId'=> $packageId,
                     'healthPackage_packageTitle' => $packagetitle,
                     'healthPackage_bestPrice' => $bestPrice,
                     'healthPackage_discountedPrice'=> $discountPrice,
                     'healthPackage_cityId'=>$city,
                     'healthPackage_MIuserId'=>$miName,
                     'healthPackage_includesTest'=>$testIncluded,
                     'status'=>1,
                     'creationTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                   // print_r($insertData);
                 //   exit;
                     $insertId = $this->Healthcare_model->insertHealthpkg($insertData);
                     if($insertId){
                       $this->session->set_flashdata('message','Data inserted successfully !');
                     }else{
                      $this->session->set_flashdata('message','Data insertion unsuccessful !');
                     }
                   redirect('healthcare/addHealthpkg');
         }
  }  
    function check_pkgId(){
        $user_table_id = '';
        $packageId = $this->input->post('packageId');
        if($packageId != ''){
          $pkg = $this->Healthcare_model->fetchPackgid($packageId);
        }
        echo $pkg;
        exit;
    }
    
    
   function bookingHealthpkgList(){
    $data = array();
    $data['allCities'] = $this->Healthcare_model->fetchCity();
    $data['title'] = 'Booking Healthpkg List';
    $this->load->super_admin_template('bookingHealthpkgList', $data,'scriptHealthpkg');
   }
   
   function bookingDetailHealthpkg($healthPkgBooking_id=''){
       $data = array();
     //  echo $healthPkgBooking_id;exit;
        $data['bookinghealthcareData'] = $this->Healthcare_model->fetchHealthcarebookingData($healthPkgBooking_id);
        if(empty($data['bookinghealthcareData'])){
                $this->session->set_flashdata('message','No record found for this id!');
                redirect('healthcare/bookingHealthpkgList');
        }
        $data['healthPkgBooking_id'] = $healthPkgBooking_id;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $data['title'] = 'Health Package Booking Detail';
        $this->load->super_admin_template('bookingDetailHealthpkg', $data,'scriptHealthpkg');
   }
   
   function createCSV(){
       
        $mi ='';
        $helathpkg_cityId ='';
       if(isset($_POST['mi']))
        $mi = $this->input->post('mi');
      // if(isset($_POST['diagnostic_cityId']))
       $helathpkg_cityId = $this->input->post('helathpkg_cityId');
       
        $where=array('healthPackage_deleted'=> 0,'healthPackage_cityId'=> $helathpkg_cityId);
       // $or_where = array(['hospital_name'=>$mi, 'diagnostic_name' => $mi]);
        $or_where = "(`hospital_name` LIKE '%$mi%' OR `diagnostic_name` LIKE '%$mi%')";
        $array[]= array('Mi Name','Package id','title','Pricing','Status');
        $data = $this->Healthcare_model->createCSVdata($where,$or_where);
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'HealtpkgDetail.csv');
        return True;
        exit;
    }
    
    
            /**
     * @method status
     * @description 	update  status enable or disable
     * @access public
     * @param int
     * @return boolean
     */
    function status() {
        $enable_id = $this->input->post('enable_id'); //status id
        $status_value = $this->input->post('status'); // status value
        $table_name = $this->input->post('table'); //table name
        $id_name = $this->input->post('id_name'); //field name

        if (!empty($enable_id) && !empty($table_name) && !empty($id_name)) {
            //where
            $where = array($id_name => $enable_id);
            if ($status_value == 0) {
                $update_data['status'] = 1;
            } else {
                $update_data['status'] = 0;
            }

            $options = array(
                'table' => $table_name,
                'where' => $where,
                'data' => $update_data
            );
            $update = $this->Healthcare_model->customUpdate($options);
            if ($update) {
                echo $update;
            } else
                echo 0;
        }else {
            echo 0;
        }
    }
}  