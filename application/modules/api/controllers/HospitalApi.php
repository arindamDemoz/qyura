<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HospitalApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('hospital_model'));
    }

    function hospitallist_post() {


        $this->bf_form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('long', 'Long', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('isemergency', 'Is Emergency', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('radius', 'Radius', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('isAmbulance', 'Is Ambulance', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('isInsurance', 'Is Insurance', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('isHealtPkg', 'Is Health Package', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('rating', 'Rating', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('notin', 'Not In', 'xss_clean|trim|required');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {


            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';      

            $notIn = isset($_POST['notin']) && $_POST['notin'] != 0 ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);
            
            $isemergency = isset($_POST['isemergency'])  ? $this->input->post('isemergency') : NULL; 
            
            // filtration parameter
            $radius = isset($_POST['radius']) ? $this->input->post('radius') : 5;
            $rating = isset($_POST['rating']) ? $this->input->post('rating') : NULL;
            $isAmbulance = isset($_POST['isAmbulance'])  ? $this->input->post('isAmbulance') : NULL; 
            $isInsurance = isset($_POST['isInsurance'])  ? $this->input->post('isInsurance') : NULL; 
            $isHealtPkg = isset($_POST['isHealtPkg'])  ? $this->input->post('isHealtPkg') : NULL; 
            
            $response['data'] = $this->hospital_model->getHospitalList($lat,$long,$notIn,$isemergency,$radius,$isAmbulance,$isInsurance,  $isHealtPkg, $rating);
            
            $option = array('table'=>'hospital','select'=>'hospital_id');
            $deleted = $this->singleDelList($option);
            $response['hos_deleted']= $deleted;
            

           
            $response['colName'] =  array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","specialities","isEmergency", "isAmbulance", "healpkgCount", "insuranceCount","userId");
           
              if($response['data']){
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
              }else{
                $response['status'] = False;
                $response['msg'] = 'There is no hospital at this range!';
                $this->response($response, 400);
           }
      }
   }  
    
    function hospitaldetail_post() {
     $this->bf_form_validation->set_rules('hospitalId','Hospital Id','xss_clean|numeric|required|trim');
     
      if($this->bf_form_validation->run($this) == FALSE)
      { 
        // setup the input
         $response =  array('status'=>FALSE,'message'=>$this->validation_post_warning());
         $this->response($response, 400);
      }
      else 
      {  
        $hospitalId = $this->input->post('hospitalId');
        $hospitalDetails = $this->hospital_model->getHosDetails($hospitalId);
        
        if($hospitalDetails)
        {
            $response['hosDetails'] = $hospitalDetails;
            
            $response['hosGallary'] = $gallary =  $this->hospital_model->getHosGallery($hospitalId);

            $response['isAmbulance'] = $isAmbulance =  $this->hospital_model->isAmbulance($hospitalId);
            
            $response['services'] = $services =  $this->hospital_model->getHosServices($hospitalId);
            
            $response['specialities'] = $specialities =  $this->hospital_model->getHosSpecialities($hospitalId);
            
            $response['hosHelthPkg'] = $hosHelthPkg =  $this->hospital_model->getHosHelthPkg($hospitalId);
            
            $response['reviewCount'] = $reviewCount = $this->hospital_model->getHosReviewCount($hospitalId);
            
            $response['rating'] = $this->hospital_model->getHosAvgRating($hospitalDetails->hospital_usersId);
            
            $response['hosDoctors'] = $hosDoctors = $this->hospital_model->getHosDoctors($hospitalId,$hospitalDetails->hospital_usersId);
            
            $response['hosDiagnosticsCat'] = $hosDiagnostics = $this->hospital_model->getDiagnosticsCat($hospitalId);
            
            
            $response['awards'] = $hosAwards = $this->hospital_model->getHosAwards($hospitalId);
            
            $response['hosInsurance'] = $osInsurance = $this->hospital_model->getHosInsurance($hospitalId);
            
            $response['status'] = TRUE;
            $response['msg'] = 'success';
            $this->response($response, 200); // 200 being the HTTP response code
        }
        else
        {
            $response['status'] = false;
            $response['msg'] = 'No Hospital is available at this Id';
            $this->response($response, 400); // 200 being the HTTP response code
        }
        
      }

  } 
  
}
