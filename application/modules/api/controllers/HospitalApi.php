<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HospitalApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        //$this->methods['hospital_post']['limit'] = 1; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function hospitallist_post() {

         $this->form_validation->set_rules('draw','Draw','xss_clean|numeric');
         $this->form_validation->set_rules('length','Length','required|xss_clean|numeric');
         $this->form_validation->set_rules('start','Start','required|xss_clean|numeric');
         $this->form_validation->set_rules('search_value','Search Value','xss_clean|alpha_numeric');
         $this->form_validation->set_rules('userId','User Id','xss_clean|numeric');
         $this->form_validation->set_rules('lat','Lat','decimal');
         $this->form_validation->set_rules('long','Long','decimal');
         $this->form_validation->set_rules('lastupdatedtime','Last update time','xss_clean|numeric');
      
      if($this->form_validation->run() == FALSE)
      { 
        // setup the input
         $message = 'something wrong';
         $response =  array('status'=>FALSE,'message'=>$message);
         $this->response($response, 400);
      }
      else 
      {        

        $_POST['columns'] = array();

        $_POST['order'][] = array('column' => 0, 'dir' => 'asc');

        $_POST['search'] = array
            (
            'value' => isset($_POST['search_value']) ? $_POST['search_value'] : '',
            'regex' => false
        );

        $aoClumns = array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","distance","specialities");
        for ($i = 0; $i < 5; $i++) {
            $_POST['columns'][] = array
                (
                'data' => $i,
                'name' => '',
                'searchable' => true,
                'orderable' => true,
                'search' => array
                    (
                    'value' => '',
                    'regex' => false
                )
            );
        }
   
        $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
        $long = isset($_POST['long']) ? $_POST['long'] : '';
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';

        // last updated date 16/01/2016
        $lastUpdatedDate = isset($_POST['lastUpdatedDate']) ? $_POST['lastUpdatedDate'] : '1452951625';
        $notIn = isset($_POST['notIn']) ? $_POST['notIn'] : '';

        $notIn = explode(',', $notIn);

        if ($_POST['start'])
            $con = array('hospital_id >' => $_POST['start']);
        else
            $con = array();

        $this->datatables
                ->select('hospital_id, hospital_deleted as fav, hospital_deleted as rat, hospital_address,hospital_name,hospital_phn,hospital_lat,hospital_long,qyura_hospital.modifyTime, hospital_img, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( hospital_lat ) ) * cos( radians( hospital_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( hospital_lat ) ) )
                ) AS distance, Group_concat(qyura_specialities.specialities_name order by specialities_name) as specialities')
                ->from('qyura_hospital')
                ->loadwhere($con)
                
                ->join('qyura_hospitalSpecialities', 'qyura_hospitalSpecialities.hospitalSpecialities_hosUsersId=qyura_hospital.hospital_id','left')
                ->join('qyura_specialities', 'qyura_specialities.specialities_id=qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId','left')
                
                ->where('qyura_hospital.hospital_deleted = 0')
                ->group_by('qyura_hospital.hospital_id')
                ->having(array('distance <' => 100));
        $this->datatables->where_not_in('hospital_id', $notIn);
        $this->datatables->edit_column('hospital_img', base_url().'assets/hospitalsImages/$1', 'hospital_img');

        $response = $this->datatables->generate();
       // echo $this->db->last_query(); die();
         $response = (array)json_decode($response);
       // echo '</pre>';
      //  print_r($response); die();
        $option = array('table'=>'hospital','select'=>'hospital_id');
        $deleted = $this->singleDelList($option);
        $response['hospital_deleted']= $deleted;
        
        if (!empty($response['data'])) {
            $response['msg']= 'success';
            $response['status']= TRUE;
            $response['colName'] = $aoClumns;
            $this->response($response, 200); // 200 being the HTTP response code
        } else {
           $response['msg'] = 'No Hospital  is available at this range!';
           $response['status'] = 0;
           $this->response($response, 404);
        }
    }
}



}
