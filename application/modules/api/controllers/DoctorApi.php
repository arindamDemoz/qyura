<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DoctorApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->helper('common_helper');
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

            
            $aoClumns = array("id","name","exp","imUrl","rating", "consFee", "speciality","degree", "lat", "long");

            $this->db->select('qyura_users.users_id as id, CONCAT(qyura_doctors.doctors_fName, "",  qyura_doctors.doctors_lName) AS name, qyura_professionalExp.professionalExp_start startDate, qyura_professionalExp.professionalExp_end endDate, qyura_doctors.doctors_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( qyura_doctors.doctors_lat ) ) * cos( radians( qyura_doctors.doctors_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( qyura_doctors.doctors_lat ) ) )
                ) AS distance, qyura_doctors.doctors_deleted as rating , qyura_doctors.doctors_consultaionFee as consFee, qyura_specialitiesCat.specialitiesCat_name as specialityCat, qyura_degree.degree_SName as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long')

                    ->from('qyura_users')
                    
                    ->join('qyura_doctors', 'qyura_users.users_id=qyura_doctors.doctors_userId', 'left')

                    ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_userId=qyura_users.users_id', 'left')

                    ->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_users.users_id', 'left')

                    ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')

                    ->join('qyura_specialitiesCat', 'qyura_specialitiesCat.specialitiesCat_id=qyura_doctorAcademic.doctorSpecialities_specialitiesCatId', 'left')

                    ->where(array('qyura_doctors.doctors_deleted' => 0, 'qyura_specialitiesCat.specialitiesCat_id' => $specialitycatid))
                    ->having(array('distance <' => 10))
                    
                    ->where_not_in('qyura_users.users_id', $notIn)
                    
                    ->order_by('distance' , 'ASC')
                    
                    ->limit(DATA_LIMIT);

            $response = $this->db->get()->result();
            //echo $this->db->last_query(); die();

            //  print_r($response); die();
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->startDate) && isset($row->endDate) ? getYearBtTwoDate($row->startDate,$row->endDate) : "";
                    $finalTemp[] = isset($row->imUrl) ? base_url().'assets/doctorsImages/'.$row->imUrl : "";
                    $finalTemp[] = isset($row->rating) ? $row->rating : "";
                    $finalTemp[] = isset($row->consFee) ? $row->consFee : "";
                    $finalTemp[] = isset($row->specialityCat) ? $row->specialityCat : "";
                    $finalTemp[] = isset($row->degree) ? $row->degree : "";
                    $finalTemp[] = isset($row->lat) ? $row->lat : "";
                    $finalTemp[] = isset($row->long) ? $row->long : "";
                    $finalResult[] = $finalTemp;
                    
                }
            }

            if (!empty($finalResult)) {
                $finalStatus['msg'] = 'success';
                $finalStatus['status'] = TRUE;
                $finalStatus['colName'] = $aoClumns;
                $finalStatus['data'] = $finalResult;
                $this->response($finalStatus, 200); // 200 being the HTTP response code
            } else {
                $finalStatus['msg'] = 'Doctor  does not exist in this specialty!';
                $finalStatus['status'] = FALSE;
                $this->response($finalStatus, 404);
            }
        }
    }

}
