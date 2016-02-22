<?php

class Hospital_model extends CI_Model {
    
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
    
    function inserHospitalUser($insertData){
        
        $this->db->insert('qyura_users', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    function insertHospital($insertData){
        
        $this->db->insert('qyura_hospital', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    function insertBloodbank($insertData){
        
        $this->db->insert('qyura_bloodBank', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    function insertPharmacy($insertData){
        $this->db->insert('qyura_pharmacy', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    function insertAmbulance($insertData){
        $this->db->insert('qyura_ambulance', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
        
    }
    
    function insertHospitalServiceName($insertData){
        $this->db->insert('qyura_hospitalServices', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
        
    }
    
    function fetchHospitalData($condition = NULL){
       $this->db->select('Hos.hospital_id,Hos.hospital_zip,Hos.hospital_usersId,Hos.hospital_name,Hos.hospital_phn,Hos.hospital_address,City.city_name,Hos.hospital_img,Hos.hospital_cntPrsn,usr.users_email,Hos.hospital_lat,Hos.hospital_long,usr.users_id,
        Hos.hospital_countryId,Hos.hospital_stateId,Hos.hospital_cityId');
     $this->db->from('qyura_hospital AS Hos');
     $this->db->join('qyura_city AS City','City.city_id = Hos.hospital_cityId','left');
      $this->db->join('qyura_users AS usr','usr.users_id = Hos.hospital_usersId','left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = Hos.hospital_usersid','left'); // changed
         if($condition)
            $this->db->where(array('Hos.hospital_id'=> $condition));
    $this->db->where(array('Hos.hospital_deleted'=> 0));
    //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("Hos.creationTime", "desc"); 
      $data= $this->db->get(); 
     return $data->result();
      //echo $this->db->last_query(); exit;
      //echo "<pre>";print_r($data);echo "</pre>";
      //exit;
    }
    
    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function UpdateTableData($data=array(),$where=array(),$tableName = NULL){
        foreach($where as $key=>$val){
            $this->db->where($key, $val); 
        }
       
        $this->db->update($tableName, $data); 
       
        //echo $this->db->last_query();exit;
         return TRUE;
    }
        function fetchHospitalDataTables( $condition = NULL){
            
         $imgUrl = base_url().'assets/hospitalsImages/$1';    
         
       $this->datatables->select('Hos.hospital_id,Hos.hospital_zip,Hos.hospital_usersId,Hos.hospital_name,Hos.hospital_phn,Hos.hospital_address,City.city_name,Hos.hospital_img,Hos.hospital_cntPrsn,usr.users_email,Hos.hospital_lat,Hos.hospital_long,usr.users_id,
        Hos.hospital_countryId,Hos.hospital_stateId,Hos.hospital_cityId');
     $this->datatables->from('qyura_hospital AS Hos');
     $this->datatables->join('qyura_city AS City','City.city_id = Hos.hospital_cityId','left');
      $this->datatables->join('qyura_users AS usr','usr.users_id = Hos.hospital_usersId','left');

 
        $search = $this->input->post('name');
        if($search){
            $this->db->or_like('Hos.hospital_name',$search);
            $this->db->or_like('Hos.hospital_phn',$search);
           $this->db->or_like('Hos.hospital_address',$search);
            
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('hospital_cityId', $city) : '';
        
        $states = $this->input->post('hosStateId');
        isset($states) && $states != '' ? $this->datatables->where('hospital_stateId', $states) : '';
        
      
        
         if($condition)
          $this->datatables->where(array('Hos.hospital_id'=> $condition));
          $this->datatables->where(array('Hos.hospital_deleted'=> 0));
        
       $this->datatables->add_column('hospital_img', '<img class="img-responsive" height="80px;" width="80px;" src='.$imgUrl.'>', 'hospital_img');
       
              $this->datatables->add_column('hospital_address', '$1 </br><a  href="view-map.html" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'hospital_address');
       
         $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="hospital/detailHospital/$1">View Detail</a>', 'hospital_id');

        return $this->datatables->generate(); 
        // echo $this->datatables->last_query();

    }
}
