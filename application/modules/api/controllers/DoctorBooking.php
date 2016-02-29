<?php

require APPPATH . 'modules/api/controllers/MyRest.php';

class DoctorBooking extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('doctorBooking_model'));
    }
    
    function doctorAppointment_post() {

        $this->bf_form_validation->set_rules('specialitiesId','Specialities Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('session','Session','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('memberId','Member Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('doctorUserId','Doctor Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('parentId','Mi Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('remark','Remark','xss_clean|required|trim|max_length[100]');
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('preferedDate', 'Prefered Date', 'xss_clean|required|trim|max_length[11]|valid_date[y-m-d,-]|callback__check_date');
        $this->bf_form_validation->set_rules('preferedTimeId', 'Prefered time', 'xss_clean|required|trim|numeric');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $specialitiesId = isset($_POST['specialitiesId'])   ? $this->input->post('specialitiesId')  : '';
            $doctorUserId   = isset($_POST['doctorUserId'])     ? $this->input->post('doctorUserId')    : '';
            $parentId       = isset($_POST['parentId'])         ? $this->input->post('parentId')        : 0; // 0=indi Doctor
            $userId         = isset($_POST['userId'])           ? $this->input->post('userId')          : '';
            $memberId       = isset($_POST['memberId'])         ? $this->input->post('memberId')        : 0;// 0 =Self as patient
            $session        = isset($_POST['session'])          ? $this->input->post('session')         : '';
            $preferedDate   = isset($_POST['preferedDate'])     ? $this->input->post('preferedDate')    : '';
            $preferedTimeId = isset($_POST['preferedTimeId'])   ? $this->input->post('preferedTimeId')  : '';
            $remark         = isset($_POST['remark'])           ? $this->input->post('remark')          : '';
            
            $correctSlot = 1;
            
//            if($parentId)
//                $correctSlot = $this->doctorBooking_model->getDocTimeSlot($parentId,$doctorUserId,$preferedTimeId);
//            else
//                $correctSlot = $this->doctorBooking_model->getDocTimeSlot($parentId,$doctorUserId,$preferedTimeId);
//            
            if($correctSlot){
                $unique_id = 'doc'. $userId . time();
                $data = array(
                    'doctorAppointment_unqId' => $unique_id,
                    'doctorAppointment_specialitiesId' => $specialitiesId,
                    'doctorAppointment_date' => $preferedDate,
                    'doctorAppointment_session' => $session,
                    'doctorAppointment_pntUserId' => $userId,
                    'doctorAppointment_memberId' => $memberId,
                    'doctorAppointment_doctorUserId' => $doctorUserId,
                    'doctorAppointment_doctorParentId' => $parentId,
                    'doctorAppointment_ptRmk' => $remark,
                    'doctorAppointment_finalTiming' => $preferedTimeId,
                    'creationTime' => time(),
                    'status' => 1
                );
                $response = $this->doctorBooking_model->bookAppointment('qyura_doctorAppointment',$data);
                
                if ($response) {
                    $response = array('status' => TRUE, 'message' => 'Your Doctor Appointment request has been received. You will receive a confirmation email or SMS shortly. You can also call the Medical Institution directly to know its status.');
                    $this->response($response, 200);
                } else {
                    $response = array('status' => FALSE,'message'=>'Something went wrong, please re-try for your appointment!');
                    $this->response($response, 400);
                }
            }
        }
    }
    
    function healthPkgBookList_post(){
        $this->bf_form_validation->set_rules('userId','User Id','xss_clean|numeric|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            
            $where = array(
                      'healthPkgBooking_userId' => $userId,
                      'healthPkgBooking_deleted' => 0
                     );
            
            $response = $this->healthpkgBooking_model->getMyBookedHealthPkg($where);
            
            if (!empty($response) && $response != NULL ) {
                
                $response = array('status' => TRUE, 'message' => 'Booked health package list!', 'data' => $response);
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'There is no health package booked yet!' );
                $this->response($response, 400);

            }
        }
    }
    
    function cancleAppointment_post(){
         
        $this->bf_form_validation->set_rules('appointmentId','Appointment Id','xss_clean|numeric|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $appointmentId = isset($_POST['appointmentId']) ? $this->input->post('appointmentId') : '';
            
            $where = array('doctorAppointment_id' => $appointmentId);
            $data = array('doctorAppointment_deleted' => 1,"modifyTime"=>time());
            
            $response = $this->doctorBooking_model->editAppointment("qyura_doctorAppointment",$data,$where);
            
            if (!empty($response) && $response != NULL ) {
                $response = array('status' => TRUE, 'message' => 'Booked health package list!', 'data' => $response);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'There is no health package booked yet!' );
                $this->response($response, 400);
            }
        }
    }
    
    function _check_date($str_in = '')
    {
       $currentDate = strtotime(date("y-m-d"));
        $prfDate = strtotime($str_in);
        if ($prfDate >= $currentDate) {
            return true;
        } else {
            dump($prfDate >= $currentDate);
            $this->bf_form_validation->set_message('_check_date', 'date should be equal or greater then today');
            return false;
        }
    }

    
}   