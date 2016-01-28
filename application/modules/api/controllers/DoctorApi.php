<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DoctorApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
    }

    function doctorlist_post() {


        $this->form_validation->set_rules('lat', 'Lat', 'required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'required|decimal');
        $this->form_validation->set_rules('specialitycatid', 'Speciality category Id', 'required|xss_clean|numeric');


        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = 'something wrong';
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        } else {


            $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
            $long = isset($_POST['long']) ? $_POST['long'] : '';       // $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
            $specialitycatid = isset($_POST['specialitycatid']) ? $_POST['specialitycatid'] : '';

            $notIn = isset($_POST['notIn']) ? $_POST['notIn'] : '';
            $notIn = explode(',', $notIn);

            
            $aoClumns = array("id","name","dob","imUrl","rating","speciality","consFee");

            $this->db->select('qyura_doctors.doctors_id as id, CONCAT(qyura_doctors.doctors_lName,  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_dob dob, qyura_doctors.doctors_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( qyura_doctors.doctors_lat ) ) * cos( radians( qyura_doctors.doctors_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( qyura_doctors.doctors_lat ) ) )
                ) AS distance, qyura_doctors.doctors_deleted as rating , qyura_doctors.doctors_deleted as consFee, qyura_specialitiesCat.specialitiesCat_name as specialityCat')
                    ->from('qyura_users')
                    ->join('qyura_doctors', 'qyura_users.users_id=qyura_doctors.doctors_userId', 'left')
                    ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_userId=qyura_users.users_id', 'left')
                    ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')
                    ->join('qyura_specialitiesCat', 'qyura_specialitiesCat.specialitiesCat_id=qyura_doctorAcademic.doctorSpecialities_specialitiesCatId', 'left')
                    ->where(array('qyura_doctors.doctors_deleted' => 0, 'qyura_specialitiesCat.specialitiesCat_id' => $specialitycatid))
                    ->having(array('distance <' => 5))
                    ->where_not_in('qyura_doctors.doctors_id', $notIn);

            $response = $this->db->get()->result();

            //  print_r($response); die();
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->dob) ? $row->dob : "";
                    $finalTemp[] = isset($row->imUrl) ? base_url().'assets/doctorsImages/'.$row->imUrl : "";
                    $finalTemp[] = isset($row->rating) ? $row->rating : "";
                    $finalTemp[] = isset($row->specialityCat) ? $row->specialityCat : "";
                    $finalTemp[] = isset($row->consFee) ? $row->consFee : "";
                    $finalResult[] = $finalTemp;
                    
                }
            }



            if (!empty($finalResult)) {
                $finalResult['msg'] = 'success';
                $finalResult['status'] = TRUE;
                $finalResult['colName'] = $aoClumns;
                $this->response($finalResult, 200); // 200 being the HTTP response code
            } else {
               $response['msg'] = 'doctor not found!';
                $response['status'] = 0;
                $this->response($response, 404);
            }
        }
    }

}
