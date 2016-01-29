<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DiagonsticCenterApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        //echo 'hemant'; die();
        //$this->methods['hospital_post']['limit'] = 1; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function diagonsticlist_post() {

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

        $aoClumns = array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","distance","diaCat");
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
            $con = array('diagnostic_id >' => $_POST['start']);
        else
            $con = array();

        $this->datatables
                ->select('diagnostic_id, diagnostic_deleted as fav, diagnostic_deleted as rat, diagnostic_address,diagnostic_name,diagnostic_phn,diagnostic_lat,diagnostic_long,qyura_diagnostic.modifyTime, diagnostic_img, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( diagnostic_lat ) ) * cos( radians( diagnostic_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( diagnostic_lat ) ) )
                ) AS distance, Group_concat(qyura_diagnosticsCat.diagnosticsCat_catName order by diagnosticsCat_catName) as diaCat')
                ->from('qyura_diagnostic')
                ->loadwhere($con)
                ->join('qyura_diagnostics', 'qyura_diagnostics.diagnostics_name=qyura_diagnostic.diagnostic_id','left')
                ->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_diagnostics.diagnostics_diagnosticsCatCatId','left')
                ->where('qyura_diagnostic.diagnostic_deleted = 0')
                ->group_by('qyura_diagnostic.diagnostic_id')
                ->having(array('distance <' => 5));
        $this->datatables->where_not_in('diagnostic_id', $notIn);
        $this->datatables->edit_column('diagnostic_img', base_url().'assets/diagnosticsImage/$1', 'diagnostic_img');

        $response = $this->datatables->generate();
       // echo $this->db->last_query(); die();
         $response = (array)json_decode($response);
       // echo '</pre>';
      //  print_r($response); die();
        $option = array('table'=>'diagnostic','select'=>'diagnostic_id');
        $deleted = $this->singleDelList($option);
        $response['diagnostic_deleted']= $deleted;
        
        if (!empty($response['data'])) {
            $response['msg']= 'success';
            $response['status']= TRUE;
            $response['colName'] = $aoClumns;
            $this->response($response, 200); // 200 being the HTTP response code
        } else {
           $response['msg'] = 'No diagnostic centres is available at this range!';
           $response['status'] = 0;
           $this->response($response, 404);
        }
    }
}


}
