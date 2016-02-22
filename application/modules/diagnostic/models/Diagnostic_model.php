<?php

class Diagnostic_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    function fetchCountry(){
         $this->db->select('country_id,country');
        $this->db->from('qyura_country');
        $this->db->order_by("country","asc");
        return $this->db->get()->result();
    }
    function fetchStates($countryId = NULL) {
       $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        if(!empty($countryId))
         $this->db->where('state_countryid',$countryId);
            
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
    function fetchEmail($email,$usersId = NULL){
         $this->db->select('users_email');
        $this->db->from('qyura_users');
        if($usersId) {
            $this->db->where('users_id !=',$usersId);
        }
         $this->db->where('users_email',$email); 
       $result = $this->db->get();
       // return $this->db->last_query();
       
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0; 
    } 
    
    function insertDiagnosticUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    function insertDiagnostic($insertData){
        $this->db->insert('qyura_diagnostic', $insertData); 
      
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function fetchdiagnosticData($condition = NULL){
    $this->db->select('diag.diagnostic_id,diag.diagnostic_zip,diag.diagnostic_usersId,diag.diagnostic_name,diag.diagnostic_phn,diag.diagnostic_address,City.city_name,diag.diagnostic_img,diag.diagnostic_cntPrsn,usr.users_email,diag.diagnostic_lat,diag.diagnostic_long,usr.users_id,diag.diagnostic_countryId,diag.diagnostic_stateId,diag.diagnostic_cityId');
    $this->db->from('qyura_diagnostic AS diag');
    $this->db->join('qyura_city AS City','City.city_id = diag.diagnostic_cityId','left');
    $this->db->join('qyura_users AS usr','usr.users_id = diag.diagnostic_usersId','left');
    //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = diag.diagnostic_usersid','left'); // changed
    if($condition)
    $this->db->where(array('diag.diagnostic_id'=> $condition));
    $this->db->where(array('diag.diagnostic_deleted'=> 0));
    //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("diag.creationTime", "desc"); 
      $data= $this->db->get(); 
     //echo $this->db->last_query();exit;
     return $data->result();
      //echo $this->db->last_query(); exit;
      //echo "<pre>";print_r($data);echo "</pre>";
      //exit;
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
    
    function fetchDiagnosticDataTables( $condition = NULL){
            
         $imgUrl = base_url().'assets/diagnosticsImage/$1';    
         
    $this->datatables->select('diag.diagnostic_id,diag.diagnostic_zip,diag.diagnostic_usersId,diag.diagnostic_name,diag.diagnostic_phn,diag.diagnostic_address,City.city_name,diag.diagnostic_img,diag.diagnostic_cntPrsn,usr.users_email,diag.diagnostic_lat,diag.diagnostic_long,usr.users_id,diag.diagnostic_countryId,diag.diagnostic_stateId,diag.diagnostic_cityId');
    $this->datatables->from('qyura_diagnostic AS diag');
    $this->datatables->join('qyura_city AS City','City.city_id = diag.diagnostic_cityId','left');
    $this->datatables->join('qyura_users AS usr','usr.users_id = diag.diagnostic_usersId','left');

 
        $search = $this->input->post('bloodBank_name');
        if($search){
            $this->db->or_like('diag.diagnostic_name',$search);
            $this->db->or_like('diag.diagnostic_phn',$search);
           $this->db->or_like('diag.diagnostic_address',$search);
            
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('diagnostic_cityId', $city) : '';
        
        $states = $this->input->post('hosStateId');
        isset($states) && $states != '' ? $this->datatables->where('diagnostic_stateId', $states) : '';
        
      
        
    if($condition)
    $this->datatables->where(array('diag.diagnostic_id'=> $condition));
    $this->datatables->where(array('diag.diagnostic_deleted'=> 0));
        
       $this->datatables->add_column('diagnostic_img', '<img class="img-responsive" height="80px;" width="80px;" src='.$imgUrl.'>', 'diagnostic_img');
       
         $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="diagnostic/detailDiagnostic/$1">View Detail</a>', 'diagnostic_id');

        return $this->datatables->generate(); 


    }
}   

