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


        $this->form_validation->set_rules('lat', 'Lat', 'required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'required|decimal');


        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {


            $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
            $long = isset($_POST['long']) ? $_POST['long'] : '';      
            $specialitycatid = isset($_POST['specialitycatid']) ? $_POST['specialitycatid'] : '';
            $search = isset($_POST['q']) ? $_POST['q'] : '';

            $notIn = isset($_POST['notin']) ? $_POST['notin'] : '';
            $notIn = explode(',', $notIn);

            $aoClumns = array("id","name","exp","imUrl","rating", "consFee", "speciality","degree", "lat", "long");
            
             $this->db->select('hospital_id as id, hospital_deleted as fav, hospital_deleted as rat, hospital_address as adr ,hospital_name name, hospital_phn phn, hospital_lat lat, hospital_long long, qyura_hospital.modifyTime upTm, hospital_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( hospital_lat ) ) * cos( radians( hospital_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( hospital_lat ) ) )
                ) AS distance, Group_concat(qyura_specialities.specialities_name order by specialities_name) as specialities')

                    ->from('qyura_hospital')

                    ->join('qyura_hospitalSpecialities', 'qyura_hospitalSpecialities.hospitalSpecialities_hospitalId=qyura_hospital.hospital_id','left')
                    
                    ->join('qyura_specialities', 'qyura_specialities.specialities_id=qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId','left')

                    ->where(array('hospital_deleted' => 0))
                    
                    ->having(array('distance <' => USER_DISTANCE))
                    
                    ->where_not_in('qyura_hospital.hospital_id', $notIn)
                    
                    ->order_by('distance' , 'ASC')
                    
                    ->group_by('hospital_id')
                    
                    ->limit(DATA_LIMIT);


           $response = $this->db->get()->result();
          // echo $this->db->last_query(); die();
           $aoClumns = array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","specialities");
             
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    
                    $finalTemp = array();
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->fav) ? $row->fav : "";
                    $finalTemp[] = isset($row->rat) ? $row->rat : "";
                    $finalTemp[] = isset($row->adr) ? $row->adr : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->phn) ? $row->phn : "";
                    $finalTemp[] = isset($row->lat) ? $row->lat : "";
                    $finalTemp[] = isset($row->long) ? $row->long : "";
                    $finalTemp[] = isset($row->upTm) ? $row->upTm : "";
                    $finalTemp[] = isset($row->imUrl) ? base_url().'assets/hospitalsImages/'.$row->imUrl : "";
                    $finalTemp[] = isset($row->specialities) ? $row->specialities : "";
                    $finalResult[] = $finalTemp;
                    
                }
            }

     // $finalResult = $this->jsonify($finalResult);
      
            
            if (!empty($finalResult)) {
                $response1['msg'] = 'Hospital found';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response1['msg'] = 'No Hospital  is available at this range!';
                $response1['status'] = FALSE;
                $this->response($response1, 404);
            }
        }
    }
    
    function hospitaldetail_post() {
     $this->form_validation->set_rules('hospitalId','Hospital Id','xss_clean|numeric|required|trim');
      if($this->form_validation->run($this) == FALSE)
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
            
            $response['services'] = $services =  $this->hospital_model->getHosServices($hospitalId);
            
            $response['specialities'] = $specialities =  $this->hospital_model->getHosSpecialities($hospitalId);
            
            $response['reviewCount'] = $reviewCount =  $this->hospital_model->getHosHelthPkg($hospitalId);
            
            $response['reviewCount'] = $reviewCount = $this->hospital_model->getHosReviewCount($hospitalId);
            
            $response['rating'] = $this->hospital_model->getHosAvgRating($hospitalId);
            
            $response['hosDoctors'] = $hosDoctors = $this->hospital_model->getHosDoctors($hospitalId);
            
            $response['hosDiagnosticsCat'] = $hosDiagnostics = $this->hospital_model->getDiagnosticsCat($hospitalId);
            
            $response['awards'] = array();
            
            $response['status'] = TRUE;
            $response['msg'] = 'success';
            $this->response($response, 200); // 200 being the HTTP response code
        }
        else
        {
            $response['status'] = false;
            $response['msg'] = 'No Hospital  is available at this Id';
            $this->response($response, 400); // 200 being the HTTP response code
        }
        
      }

  } 
  
}
