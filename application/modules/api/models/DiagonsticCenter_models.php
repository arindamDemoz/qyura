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
    function diagnosticsCat_Details ($diagnosticId,$limit=4) {
         $this->db->select('qyura_diagnosticsCat.diagnosticsCat_catName AS diagnosticsCatName,qyura_DiagnosticDiagCatTest.DiagCatTest_id');
        $this->db->from('qyura_DiagnosticDiagCatTest');
        $this->db->join('qyura_diagnosticsCat','qyura_diagnosticsCat.diagnosticsCat_catId = qyura_DiagnosticDiagCatTest.DiagCatTest_diagCatId','left');
        $this->db->where(array('qyura_DiagnosticDiagCatTest.DiagCatTest_DiagnosticId'=>$diagnosticId,'qyura_DiagnosticDiagCatTest.DiagCatTest_deleted'=>0));
        if($limit)
            $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
    
    function diagnosticServices_Details ($diagnosticId,$limit = 3) {
       $this->db->select('qyura_services.services_name AS servicesName,qyura_diagnosticServices.diagnosticServices_id');
        $this->db->from('qyura_diagnosticServices');
        $this->db->join('qyura_services','qyura_services.services_id = qyura_diagnosticServices.diagnosticServices_servicesId','left');
        $this->db->where(array('qyura_diagnosticServices.diagnosticServices_diagnosticId'=>$diagnosticId,'qyura_diagnosticServices.diagnosticServices_deleted'=>0,
            'qyura_services.services_deleted'=>0));
        if($limit)
            $this->db->limit(3);
        
        return $this->db->get()->result(); 
    }
    
    function diagnosticSpecialities_Details ($diagnosticId,$limit = 3) {
         
        $this->db->select('qyura_specialities.specialities_name AS specialitiesName,qyura_diagnosticSpecialities.diagnosticSpecialities_id');
        $this->db->from('qyura_diagnosticSpecialities');
        $this->db->join('qyura_specialities','qyura_specialities.specialities_id = qyura_diagnosticSpecialities.diagnosticSpecialities_specialitiesId','left');
        $this->db->where(array('qyura_diagnosticSpecialities.diagnosticSpecialities_diagnosticId'=>$diagnosticId,'qyura_diagnosticSpecialities.diagnosticSpecialities_deleted'=>0,
            'qyura_specialities.specialities_deleted'=>0));
        if($limit)
            $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
    
    function diagnosticsTest_Details () {
        
    }
    
    public function getDiagnosticsDoctors($diagnosticId,$limit=4)
    {
        $this->db->select('doctors_img,doctors_fName,doctors_lName,doctor_addr,doctors_phn,doctors_mobile,doctors_27Src,doctors_consultaionFee');
        $this->db->from('qyura_usersRoles');
        $this->db->join('qyura_doctors','qyura_doctors.doctors_userId=qyura_usersRoles.usersRoles_userId','left');
        $this->db->where(array('qyura_usersRoles.usersRoles_parentId'=>$diagnosticId,'qyura_usersRoles.usersRoles_roleId'=>ROLE_DOCTORE));
        if($limit)
        $this->db->limit($limit);
        return $this->db->get()->result();

    }
}

