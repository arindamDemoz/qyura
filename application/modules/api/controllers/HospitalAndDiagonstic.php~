<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HospitalAndDiagonstic extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('hospitalAndDiagonstic_model'));
    }

    function hosDiagonList_post() {
        $this->form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'xss_clean|trim|required|decimal');
        $this->form_validation->set_rules('specialityid', 'Speciality Id', 'xss_clean|trim|numeric');

        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';

            $notIn = isset($_POST['notin']) ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);

            $specialityid = isset($_POST['specialityid']) ? $this->input->post('specialityid') : NULL;
            
            $hosDiagonList = $this->hospitalAndDiagonstic_model->getHosDiagonList($lat, $long, $notIn, $specialityid);
            $aoClumns = array("isAmbulance","totalHealtPkg","totalInsurance","isEmergency","id", "userId", "type", "fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","facility");
            // print_r($diagonList); exit;
            if ($hosDiagonList) {
                $response['hosDiagonList'] = $hosDiagonList;
                $response['column'] = $aoClumns;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'There is no hospital or diagonstic center at this speciality!';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

}
