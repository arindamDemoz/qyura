<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class DoctorBooking_model extends Common_model {

    public function __construct() {
        parent::__construct();
    }

    public function bookAppointment($table, $data) {

        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();

        return $id;
    }
    
    public function editAppointment($table,$data,$where) {
        
        $data = $this->_filter_data($table, $data);

        $id = $this->db->update($table, $data,$where);
        
        return $id;
    }
    
    public function getMyBookedAppointment($where) {
        $this->db->select('healthPackage_id as pkgId, healthPackage_packageTitle as title, healthPackage_discountedPrice as price, ( CASE WHEN(healthPkgBooking_bkStatus = 0) THEN "Pending" WHEN(healthPkgBooking_bkStatus = 1) THEN "Completed" END) as status, qyura_healthPkgBooking.creationTime as bookingDate');
        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->where($where);
        $this->db->group_by('healthPackage_id');
        $this->db->order_by('qyura_healthPkgBooking.creationTime', 'desc');
        return $this->db->get()->result();
    }
    
    public function getDocTimeSlotForhospital($hospitalId, $doctorUserId,$slotId) {
       
        $todayWeek = getDay(date("l"));
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0, 'doctorAvailability_refferalId' => $hospitalId,"id"=>$slotId))
                ->order_by('day', 'ASC');

        $response = $this->db->get()->result();
        
        if (count($response)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getDocTimeSlot($miId, $doctorUserId) {
        $this->db->select('doctorAvailabilitySession_id as id, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session ')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId = qyura_doctorAvailability.doctorAvailability_id')
                ->where(array('doctorAvailability_deleted' => 0, 'doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_refferalId' => $miId));

        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                $finalTemp['start'] = isset($row->start) ? $row->start : "";
                $finalTemp['end'] = isset($row->end) ? $row->end : "";
                $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

}

?>
