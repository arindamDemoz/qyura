<?php
class Ambulance_model extends CI_Model {
    
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
    function fetchEmail($email){
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->where('users_email',$email);
        $result = $this->db->get();
       // return $this->db->last_query();
        if($result->num_rows() > 0)
            return 1;
        else             
        return 0; 
    } 
        
    function insertAmbulanceUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();
       // echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function insertAmbulance($insertData){
        //echo "hgfgh";exit;
        $this->db->insert('qyura_ambulance', $insertData); 
      
        $insert_id = $this->db->insert_id();
       //echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function fetchambulanceData($condition = NULL){
         $this->db->select('ambulance.ambulance_id,ambulance.ambulance_usersId,City.city_name,ambulance.ambulance_name,ambulance.ambulance_address,ambulance.ambulance_phn,ambulance.ambulance_img,'
                 . 'usr.users_email,usr.users_password ,ambulance.ambulance_cntPrsn,ambulance.ambulance_lat,ambulance.ambulance_long,usr.users_mobile'
                 . ',ambulance.ambulance_27Src,ambulance.ambulanceType,ambulance.ambulance_mmbrTyp');
        $this->db->from('qyura_ambulance AS ambulance');
        $this->db->join('qyura_city AS City','City.city_id = ambulance.ambulance_cityId','left');
        $this->db->join('qyura_users AS usr','usr.users_id = ambulance.ambulance_usersId','left');
       // $this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = ambulance.ambulance_usersId','left'); // closed because no data will go in user roll table changed
        if($condition)
        $this->db->where(array('ambulance.ambulance_id'=> $condition));

        $this->db->where(array('ambulance.ambulance_deleted'=> 0));
        // $this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("ambulance.creationTime", "desc"); 
      $data= $this->db->get(); 
     // echo $this->db->last_query();exit;
     return $data->result();
    }

    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return true;
    }
    
    function UpdateTableData($data=array(),$where=array(),$tableName = NULL){
        foreach($where as $key=>$val){
            $this->db->where($key, $val); 
        }
       
        $this->db->update($tableName, $data); 
       
        //echo $this->db->last_query();exit;
         return TRUE;
    }
}   

