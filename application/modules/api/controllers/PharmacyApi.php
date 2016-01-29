<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class PharmacyApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        //echo 'hemant'; die();
        //$this->methods['hospital_post']['limit'] = 1; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function pharmacylist_post() {

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

        $aoClumns = array("id","name","adr","imUrl","distance","phn","lat","long");
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
            $con = array('pharmacy_id >' => $_POST['start']);
        else
            $con = array();

        $this->datatables
                ->select('pharmacy_id, pharmacy_name, pharmacy_address, pharmacy_img, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( pharmacy_lat ) ) * cos( radians( pharmacy_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( pharmacy_lat ) ) )
                ) AS distance, pharmacy_phn,pharmacy_lat,pharmacy_long')
                ->from('qyura_pharmacy')
                ->loadwhere($con)
                ->where('qyura_pharmacy.pharmacy_deleted = 0')
                ->having(array('distance <' => 5));
        $this->datatables->where_not_in('pharmacy_id', $notIn);
        $this->datatables->edit_column('pharmacy_img', base_url().'assets/pharmacyImages/$1', 'pharmacy_img');

        $response = $this->datatables->generate();
       // echo $this->db->last_query(); die();
         $response = (array)json_decode($response);
       // echo '</pre>';
      //  print_r($response); die();
        $option = array('table'=>'pharmacy','select'=>'pharmacy_id');
        $deleted = $this->singleDelList($option);
        $response['pharmacy_deleted']= $deleted;
        
        if (!empty($response['data'])) {
            $response['msg']= 'success';
            $response['status']= TRUE;
            $response['colName'] = $aoClumns;
            $this->response($response, 200); // 200 being the HTTP response code
        } else {
           $response['msg'] = 'No Pharmacy is available at this range!';
           $response['status'] = 0;
           $this->response($response, 404);
        }
    }
}


}
