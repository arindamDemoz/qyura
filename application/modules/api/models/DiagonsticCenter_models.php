<?php
class DiagonsticCenter_models extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function diagonstic_Details ($diaUsrId) {
        
        $this->db->select('diagnostic_id,diagnostic_address, diagnostic_lat, diagnostic_long, diagnostic_aboutUs, diagnostic_mblNo, diagnostic_img');
        $this->db->from('qyura_diagnostic');
        $this->db->where(array('diagnostic_id'=>$diaUsrId,'diagnostic_deleted'=>0));
        return $this->db->get()->result();
        
    }
    
    function diagnosticsHasCat_Details (){
        
    }
    
    function diagnosticsCatTag_Details () {
        
    }
    function diagnosticsCat_Details () {
        
    }
    
    function diagnosticServices_Details () {
        
    }
    
    function diagnosticSpecialities_Details () {
         
        $this->db->select('qyura_specialities.specialities_id,qyura_specialities.specialities_name,');
        $this->db->from('qyura_diagnostic');
        $this->db->where(array('diagnostic_id'=>$diaUsrId,'diagnostic_deleted'=>0));
        return $this->db->get()->result();
    }
    
    function diagnosticsTest_Details () {
        
    }
}

