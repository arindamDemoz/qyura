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
        $response = (array) json_decode($response);
        // print_r($response);exit;
        $this->response($response, 200);
    }

    function bloodBankList_post() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('bloodCat_id', 'Blood category Id', 'xss_clean|numeric');
        $this->form_validation->set_rules('lat', 'Lat', 'xss_clean|decimal');
        $this->form_validation->set_rules('long', 'Long', 'xss_clean|decimal');

        if ($this->form_validation->run() == FALSE) {
            $message = 'something wrong';
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        } else {
            $_POST['columns'] = array();

            $_POST['order'][] = array('column' => 0, 'dir' => 'asc');

            $_POST['search'] = array
                (
                'value' => isset($_POST['search_value']) ? $_POST['search_value'] : '',
                'regex' => false
            );
            $aoClumns = array("bloodBank_id", "bloodBank_name", "bloodBank_add", "lat", "long", "bloodBank_photo", "bloodBank_mblNo");
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
            $userId = isset($_POST['bloodCat_id']) ? $_POST['bloodCat_id'] : '';

            // last updated date 16/01/2016
            $lastUpdatedDate = isset($_POST['lastUpdatedDate']) ? $_POST['lastUpdatedDate'] : '1452951625';
            $notIn = isset($_POST['notin']) ? $_POST['notin'] : '';

            $notIn = explode(',', $notIn);

            if (isset($_POST['start']))
                $con = array('bloodBank_id >' => $_POST['start']);
            else
                $con = array();
            $where = array('qyura_bloodCatBank.bloodCats_id=' => $_POST["bloodCat_id"], 'qyura_bloodBank.bloodBank_deleted' => 0,
                'qyura_bloodCatBank.bloodCatBank_deleted' => 0);
            $this->db
                    ->select('`qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_name`, `qyura_bloodBank`.`bloodBank_add`,`qyura_bloodBank`.`bloodBank_lat`,`qyura_bloodBank`.`bloodBank_long`,
                    `qyura_bloodBank`.`bloodBank_photo`,
                        `qyura_bloodBank`.`bloodBank_mblNo`,(
                    6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( bloodBank_lat ) ) * cos( radians( bloodBank_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( bloodBank_lat ) ) )
                    ) AS distance')
                    ->from('qyura_bloodBank')
                    ->join('qyura_bloodCatBank', 'qyura_bloodCatBank.bloodBank_id = qyura_bloodBank.bloodBank_id', 'left')
                    ->join('qyura_bloodCat', 'qyura_bloodCat.bloodCat_id = qyura_bloodCatBank.bloodCats_id', 'left')
                   // ->join('qyura_users', 'qyura_users.users_id = qyura_bloodBank.users_id', 'inner')
                    ->where($where)
                    ->having(array('distance <=' => USER_DISTANCE));
            $this->db->where_not_in('qyura_bloodBank.bloodBank_id', $notIn)
                    ->limit(DATA_LIMIT);
            $data = $this->db->get()->result();
            //echo $this->db->last_query(); die();
            $array_data = array();

            $response = '';
            foreach ($data as $row) {

                $array_data[] = isset($row->bloodBank_id) ? $row->bloodBank_id : "";
                $array_data[] = isset($row->bloodBank_name) ? $row->bloodBank_name : "";
                $array_data[] = isset($row->bloodBank_add) ? $row->bloodBank_add : "";
                $array_data[] = isset($row->bloodBank_lat) ? $row->bloodBank_lat : "";
                $array_data[] = isset($row->bloodBank_long) ? $row->bloodBank_long : "";
                $array_data[] = isset($row->bloodBank_photo) ? base_url() . 'assets/BloodBank/' . $row->bloodBank_photo : "";

                $array_data[] = isset($row->bloodBank_mblNo) ? $row->bloodBank_mblNo : "";
                $array_data[] = isset($row->distance) ? $row->distance : "";
                $finalResult[] = $array_data;
                $array_data = '';
            }


            $option = array('table' => 'bloodBank', 'select' => 'bloodBank_id');
            $deleted = $this->singleDelList($option);
            $response['bloodBank_deleted'] = $deleted;

            if (!empty($finalResult)) {
                $response1['msg'] = 'success';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response['msg'] = 'No Blood bank is available at this range. ';
                $response['status'] = FALSE;
                $this->response($response, 401);
            }
        }
    }

}
