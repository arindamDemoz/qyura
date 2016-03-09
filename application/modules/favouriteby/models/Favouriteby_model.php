<?php
class Favouriteby_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    

  

    function getRows( $params = array()){
         
        $this->db->select('fav_id as favId, patientDetails_id as userId, concat(patientDetails_patientName,patientDetails_pLastName) as patientName, patientDetails_patientImg as img, users_email as email');
        $this->db->from('qyura_fav');
        $this->db->join('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_fav.fav_userId', 'left');
        $this->db->join('qyura_users', 'qyura_users.users_id = qyura_patientDetails.patientDetails_usersId', 'left');
        $this->db->join('qyura_doctors', 'qyura_doctors.doctors_userId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->where(array('fav_deleted' => 0));
        $this->db->group_by('fav_id');
        $this->db->order_by('qyura_fav.creationTime', 'desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
        
       // $this->db->get();
       // echo $this->db->last_query(); exit;
       
    }
     
}   

