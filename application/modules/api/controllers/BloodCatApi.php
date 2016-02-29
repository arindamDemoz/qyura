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
        
            $this->form_validation->set_rules('bloodCat_id','Blood category Id','required|xss_clean|trim|numeric');
            $this->form_validation->set_rules('long','Long','xss_clean|trim|decimal');
            $this->form_validation->set_rules('long','Long','xss_clean|trim|decimal');
           
             if($this->form_validation->run() == FALSE) {
                  $response =  array('status'=>FALSE,'message'=>$this->validation_post_warning());
                  $this->response($response, 400);
             }else {
                 
                 $aoClumns = array("bloodBank_id","bloodBank_name","bloodBank_add","lat","long","bloodBank_photo","bloodBank_mblNo");
          

            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';  
            $catId = isset($_POST['bloodCat_id']) ? $this->input->post('bloodCat_id') : '';
            $lastUpdatedDate = isset($_POST['lastUpdatedDate']) ? $_POST['lastUpdatedDate'] : '1452951625';
            
            $notIn = isset($_POST['notin']) ? $_POST['notin'] : '';
            $notIn = explode(',', $notIn);

           
            $where = array('quera_bloodCatBank.bloodCats_id='=> $catId,'qyura_bloodBank.bloodBank_deleted'=>0);
            $this->db
                    ->select('`qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_name`, `qyura_bloodBank`.`bloodBank_add`,`qyura_bloodBank`.`bloodBank_lat`,`qyura_bloodBank`.`bloodBank_long`,
                    `qyura_bloodBank`.`bloodBank_photo`,
                        `qyura_bloodBank`.`bloodBank_mblNo`, IFNULL(hospital_lat, bloodBank_lat) as lat, IFNULL(hospital_long, bloodBank_long) as lng, IFNULL(hospital_address,bloodBank_add) as adr, (
                    6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( IFNULL(hospital_lat, bloodBank_lat) ) ) * cos( radians( IFNULL(hospital_long, bloodBank_long) ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( IFNULL(hospital_lat, bloodBank_lat) ) ) )
                    ) AS distance')
                    ->from('qyura_bloodBank')
                    ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_bloodBank.users_id','left')
                    ->join('qyura_hospital', 'qyura_usersRoles.usersRoles_parentId=qyura_hospital.hospital_usersId','left')
                    ->join('quera_bloodCatBank', 'quera_bloodCatBank.bloodBank_id=qyura_bloodBank.bloodBank_id','left')
                    ->join('qyura_bloodCat', 'qyura_bloodCat.bloodCat_id=quera_bloodCatBank.bloodCats_id','left')
                     ->where($where)
                    ->limit(DATA_LIMIT)
                    ->having(array('distance <=' => 5));
            $this->db->where_not_in('qyura_bloodBank.bloodBank_id', $notIn);
           //$this->datatables->edit_column('qyura_bloodBank.bloodBank_photo', base_url().'assets/BloodBank/$1', 'bloodBank_photo');
            $data = $this->db->get()->result();
           // echo $this->db->last_query(); die();
            $array_data=array();
            
            $option = array('table'=>'bloodCatBank','select'=>'bloodBank_id');
            $deleted = $this->singleDelList($option);
           
            
            $response = '';
            foreach ($data as $row){
                
                    $array_data[] =   isset($row->bloodBank_id) ? $row->bloodBank_id : "";
                    $array_data[] = isset($row->bloodBank_name) ? $row->bloodBank_name : "";
                    $array_data[] = isset($row->adr) ? $row->adr : "";
                     $array_data[] = isset($row->lat) ? $row->lat : "";
                    $array_data[] = isset($row->lng) ? $row->lng : "";
                    $array_data[] = isset($row->bloodBank_photo) ? 'assets/BloodBank/'.$row->bloodBank_photo : "";
                       
                    $array_data[] = isset($row->bloodBank_mblNo) ? $row->bloodBank_mblNo : "";
                    $finalResult[]= $array_data;
                    $array_data='';
            }
            
          
            $option = array('table'=>'bloodBank','select'=>'bloodBank_id');
            $deleted = $this->singleDelList($option);
            $response['bloodBank_deleted']= $deleted;

            if (!empty($finalResult)) {
                $response1['msg']= 'success';
                $response1['status']= TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $response1['bloodBank_deleted']= $deleted;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response['msg']= 'No Blood bank is available at this range. ';
                 $response['status']= FALSE;
                $this->response($response, 401);
            }
    
          }
    }
}   