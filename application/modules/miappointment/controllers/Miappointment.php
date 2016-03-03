<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Miappointment extends MY_Controller {

    public $error_message = '';

    public function __construct() {
        parent:: __construct();
        $this->load->model('miappointment_model', 'miappointment', 'common_model');
    }

    /**
     * @project Qyura
     * @method index
     * @description listing templeat
     * @access public
     * @return html
     */
    public function index() {
        $data = array();
        $this->load->super_admin_template('miAppList', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method getDignostiData
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    public function getDignostiData() {
        echo $this->miappointment->getDiagnostic();
    }

    /**
     * @project Qyura
     * @method getConsultingList
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    public function getConsultingList() {
        echo $this->miappointment->getConsultingList();
    }

    /**
     * @project Qyura
     * @method getBloodBankDl
     * @description get records in listing using datatables
     * @access public
     * @return array
     */
    function getBloodBankDl() {
        echo $this->miappointment->fetchbloodBankDataTables();
    }

    /**
     * @project Qyura
     * @method detail
     * @description detail mi appointment
     * @access public
     * @param qtnId
     * @return html
     */
    public function detail($qtnId = '') {
        $data = array();
        $data['qtnDetail'] = $this->miappointment->getDetail($qtnId);
        $data['quotationTests'] = $this->miappointment->getQuotationTests($qtnId);
        $data['userDetail'] = $this->miappointment->getQuotationUserDetail($qtnId);
        $data['qtnAmount'] = $this->miappointment->qtTestTotalAmount($qtnId);
        $data['qtnId'] = $qtnId;
        $this->load->super_admin_template('miAppDetail', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method detail
     * @description detail consulting appointment
     * @access public
     * @param appointmentId
     * @return html
     */
    public function consultingDetail($appointmentId = '') {
        $data = array();
        $data['conDetail'] = $this->miappointment->getConsultingData($appointmentId);
        $data['reports'] = $this->miappointment->getConsultingReport($appointmentId);
        $this->load->super_admin_template('miConAppDetail', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method add
     * @description detail consulting appointment
     * @access public
     * @param appointmentId
     * @return html
     */
    function add_appointment() {
        $data = array();
        $options = array('table' => 'qyura_city', 'order' => array('city_name' => 'asc'));
        $data['qyura_city'] = $this->common_model->customGet($options);
        $this->load->super_admin_template('addappointment', $data, 'miAppScript');
    }

    function getpatient() {
        $patient_email = $this->input->post("patient_email");

        $options = array(
            'table' => 'qyura_users',
            'where' => array('qyura_users.users_deleted' => 0, 'qyura_users.users_email' => $patient_email),
            'join' => array(
                array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left'),
                array('qyura_country', 'qyura_country.country_id = qyura_patientDetails.patientDetails_countryId', 'left'),
                array('qyura_state', 'qyura_state.state_id = qyura_patientDetails.patientDetails_stateId', 'left'),
                array('qyura_city', 'qyura_city.city_id = qyura_patientDetails.patientDetails_cityId', 'left'),
            ),
        );
        $data = $this->common_model->customGet($options);
        print_r($data);
    }

    function getHospital() {
        $city_id = $this->input->post('city_id');
        $appointment_type = $this->input->post('appointment_type');
        $option = array();
        if ($appointment_type == 0) {
            $options = array(
                'table' => 'qyura_hospital',
                'where' => array('qyura_hospital.hospital_deleted' => 0, 'qyura_hospital.hospital_cityId' => $city_id),
            );
            $hospital = $this->common_model->customGet($options);

            if (isset($hospital) && $hospital != NULL) {
                $option .= '<option value="">Select Hospital</option>';
                foreach ($hospital as $hospi) {
                    $option .= '<option value="' . $hospi->hospital_id . '">' . $hospi->hospital_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Hospital not available. </option>';
            }
        } else {
            $options = array(
                'table' => 'qyura_diagnostic',
                'where' => array('qyura_diagnostic.diagnostic_deleted' => 0, 'qyura_diagnostic.diagnostic_cityId' => $city_id),
            );
            $diagnostic = $this->common_model->customGet($options);
            if (isset($diagnostic) && $diagnostic != NULL) {
                $option .= '<option value="">Select Hospital</option>';
                foreach ($diagnostic as $diagno) {
                    $option .= '<option value="' . $diagno->diagnostic_id . '">' . $diagno->diagnostic_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Diagnostic not available. </option>';
            }
        }
        echo $options;
    }

    public function get_timeSlot() {
        $mId = $this->input->post('miId');
        $timeSlotId = $this->input->post('timeSlotId');
        $data['timeSlots'] = $this->miappointment->getTimeSlot($mId);
        dump($this->db->last_query());
        $data['timeSlotId']=$timeSlotId;
        
        if($data['timeSlots'])
        $dateTime = $data['timeSlots'][0]->quotation_dateTime;
        
        $data['date'] = date('Y-m-d', $dateTime);
        $data['time'] = date('h:i A', $dateTime);
        $this->load->view('changetimeSlot', $data);
    }

    public function Save_timeSlot() {

        $mId = $this->input->post('miId');
        $appointmentDate = $this->input->post('appointmentDate');
        $session = $this->input->post('session');
        $finalTime = $this->input->post('finalTime');
        $timeSlotArray = array(
            'quotation_timeSlotId' => $session,
            'quotation_dateTime' => strtotime("$appointmentDate $finalTime")
        );
        $this->db->where('quotation_MiId', $mId);
        $this->db->update('qyura_quotations', $timeSlotArray);
    }

}
