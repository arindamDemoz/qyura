<?php

class Doctor_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function fetchStates() {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        $this->db->order_by("state_statename","asc");
        return $this->db->get()->result();
    }
    
    function fetchCity ($stateId=NULL){
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->where('city_stateid',$stateId);
        $this->db->order_by("city_name","asc");
        return $this->db->get()->result();
    }
    
    function fetchSpeciality(){
        /*$this->db->select('specialitiesCat_id,specialitiesCat_name');
        $this->db->from('qyura_specialitiesCat');
         * this table is disable for the time being
         */
          $this->db->select('specialities_id,specialities_name');
        $this->db->from('qyura_specialities');
        $this->db->where(array('specialities_deleted'=>0));
        $this->db->order_by("specialities_name","asc");
        return $this->db->get()->result(); 
    }
    function fetchDegree(){
        $this->db->select('degree_id,degree_SName');
        $this->db->from('qyura_degree');
        $this->db->where(array('degree_deleted'=> 0));
        $this->db->order_by("degree_SName","asc");
        return $this->db->get()->result(); 
    }
   function fetchHospital(){
        $this->db->select('hospital_id,hospital_name');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_deleted'=> 0));
        $this->db->order_by("hospital_name","asc");
        return $this->db->get()->result(); 
    }
    function fetchEmail($email,$usersId = NULL){
        $this->db->select('qyura_users.users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles','qyura_usersRoles.usersRoles_userId = qyura_users.users_id','left');
        if($usersId) {
            $this->db->where(array('qyura_users.users_id !='=> $usersId,));
        }
        // $this->db->where('users_email',$email); 
          $this->db->where(array('qyura_users.users_email'=> $email,'qyura_usersRoles.usersRoles_roleId' => 4));
       $result = $this->db->get();
       // return $this->db->last_query();
       
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0; 
    }
    
    function fetchHospitalSpeciality($hospitalId){ //
        $this->db->select('hospitalSpecialities_hospitalId,specialities_id,specialities_name');
         $this->db->from('qyura_hospitalSpecialities');
         $this->db->join('qyura_specialities','qyura_specialities.specialities_id = qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId','left');
         $this->db->where(array('qyura_hospitalSpecialities.hospitalSpecialities_hospitalId'=> $hospitalId,'qyura_specialities.specialities_deleted' => 0));
          $result = $this->db->get();
          return $result->result();
        //return $this->db->last_query();
    }
    
    function insertDoctorUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return true;
    }
    function insertDoctorData($insertData,$tableName = NULL){
        $this->db->insert($tableName, $insertData); 
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
}    