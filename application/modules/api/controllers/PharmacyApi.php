<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class PharmacyApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
    }

    function pharmacylist_post() {


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
            $notIn = isset($_POST['notin']) ? $_POST['notin'] : '';
            $notIn = explode(',', $notIn);



            $this->db->select('qyura_pharmacy.pharmacy_id as id, pharmacy_name name, pharmacy_address adr, pharmacy_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( pharmacy_lat ) ) * cos( radians( pharmacy_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( pharmacy_lat ) ) )
                ) AS distance, pharmacy_phn phn, pharmacy_lat lat, pharmacy_long long')
                    
                    ->from('qyura_pharmacy')

                    ->where(array('qyura_pharmacy.pharmacy_deleted' => 0))
                    
                    ->having(array('distance <' => USER_DISTANCE))
                    
                    ->where_not_in('qyura_pharmacy.pharmacy_id', $notIn)
                    
                    ->order_by('distance' , 'ASC')
                    
                    ->group_by('pharmacy_id')
                    
                    ->limit(DATA_LIMIT);


            $response = $this->db->get()->result();
            // echo $this->db->last_query(); die();
            $aoClumns = array("id","name","adr","imUrl","phn","lat","long");
             
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    
                    $finalTemp = array();
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->adr) ? $row->adr : "";
                    $finalTemp[] = isset($row->imUrl) ? base_url().'assets/pharmacyImages/'.$row->imUrl : "";
                    $finalTemp[] = isset($row->phn) ? $row->phn : "";
                    $finalTemp[] = isset($row->lat) ? $row->lat : "";
                    $finalTemp[] = isset($row->long) ? $row->long : "";
                    $finalResult[] = $finalTemp;
                    
                }
            }

     // $finalResult = $this->jsonify($finalResult);
      
            
            if (!empty($finalResult)) {
                $response1['msg'] = 'Phramacy found';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response1['msg'] = 'No Pharmacy is available at this range!';
                $response1['status'] = FALSE;
                $this->response($response1, 404);
            }
        }
    }
    

}
