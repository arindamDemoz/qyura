<?php

require APPPATH . 'modules/api/controllers/MyRest.php';

class BloodCatApi extends MyRest {

    function __construct() {
        // Construct our parent class
       
        parent::__construct();
        $this->methods['bloodCat_post']['limit'] = 1; //500 requests per hour per user/key
        $this->methods['bloodDetails_post']['limit'] = 1; //500 requests per hour per user/key
    }
    
    function bloodCat_post() {
          $this->datatables
        ->select('qyura_bloodCat.bloodCat_name')
        ->from('qyura_bloodCat')
        ->where('qyura_bloodCat.bloodCat_deleted = 0');
        
        $response = $this->datatables->generate();
        
        //echo $this->datatables->last_query(); die();
         $response = (array)json_decode($response);
       // print_r($response);exit;
        $this->response($response, 200);
    }
    
    function bloodBankList_post(){
     
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('userId','User Id','xss_clean|numeric');
            $this->form_validation->set_rules('lat','Lat','xss_clean|decimal');
            $this->form_validation->set_rules('long','Long','xss_clean|decimal');
           
             if($this->form_validation->run() == FALSE) {
                 $message = 'something wrong';
                  $response =  array('status'=>FALSE,'message'=>$message);
                  $this->response($response, 400);
             }else {
                 $_POST['columns'] = array();

                $_POST['order'][] = array('column' => 0, 'dir' => 'asc');

                 $_POST['search'] = array
                (
             'value' => isset($_POST['search_value']) ? $_POST['search_value'] : '',
                'regex' => false
            );
                 $aoClumns = array("id","bloodBank_name","bloodBank_add","distance","bloodBank_photo");
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

            if (isset($_POST['start']))
                $con = array('bloodBank_id >' => $_POST['start']);
            else
                $con = array();

            $this->datatables
                    ->select('bloodBank_id, bloodBank_name, bloodBank_add,bloodBank_lat,bloodBank_long,modifyTime,bloodBank_photo, (
                    6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( bloodBank_lat ) ) * cos( radians( bloodBank_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( bloodBank_lat ) ) )
                    ) AS distance')
                    ->from('qyura_bloodBank')
                    ->loadwhere($con)
                    ->where('qyura_bloodBank.bloodBank_deleted = 0')
                    ->having(array('distance <' => 100));
            $this->datatables->where_not_in('bloodBank_id', $notIn);
            $this->datatables->edit_column('bloodBank_photo', base_url().'assets/BloodBank/$1', 'bloodBank_photo');

            $response = $this->datatables->generate();
          //echo $this->db->last_query(); die();
             $response = (array)json_decode($response);
            $option = array('table'=>'bloodBank','select'=>'bloodBank_id');
            $deleted = $this->singleDelList($option);
            $response['bloodBank_deleted']= $deleted;

            if (!empty($response['data'])) {
                $response['msg']= 'success';
                $response['status']= TRUE;
                $response['colName'] = $aoClumns;
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['msg']= 'fail';
                 $response['status']= FALSE;
                $this->response($response, 401);
            }
    
          }
    }
}   