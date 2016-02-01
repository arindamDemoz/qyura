<?php
class DiagonsticCenter_models extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function diagonstic_Details ($diaUsrId) {
        
        $this->db->select('diagnostic_id,diagnostic_usersId,diagnostic_address, diagnostic_lat, diagnostic_long, diagnostic_aboutUs, diagnostic_mblNo, diagnostic_img');
        $this->db->from('qyura_diagnostic');
        $this->db->where(array('diagnostic_id'=>$diaUsrId,'diagnostic_deleted'=>0));
        return $this->db->get()->row();
        
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
    
    public function getDiagnosticsDoctors($diagnosticId,$diagnosticUsersId,$limit=4)
    {
        $this->db->select('doctors_id,doctors_userId,doctors_img,doctors_fName,doctors_lName,doctor_addr,doctors_phn,doctors_mobile,doctors_27Src,doctors_consultaionFee,doctors_lat,doctors_long');
        $this->db->from('qyura_usersRoles');
        $this->db->join('qyura_doctors','qyura_doctors.doctors_userId=qyura_usersRoles.usersRoles_userId','left');
        $this->db->where(array('qyura_usersRoles.usersRoles_parentId'=>$diagnosticId,'qyura_usersRoles.usersRoles_roleId'=>ROLE_DOCTORE));
        if($limit)
        $this->db->limit($limit);
        $doctors = $this->db->get()->result();
        
        $doctorResult = array();
        if(!empty($doctors)){
            foreach($doctors as $doctor)
            {
                $doctorTemp = array();
                $doctorTemp['doctors_id'] = $doctor->doctors_id;
                $doctorTemp['userId'] = $doctor->doctors_userId;
                $doctorTemp['img'] = $doctor->doctors_img;
                $doctorTemp['fName'] = $doctor->doctors_fName;
                $doctorTemp['lName'] = $doctor->doctors_lName;
                $doctorTemp['addr'] = $doctor->doctor_addr;
                $doctorTemp['phn'] = $doctor->doctors_phn;
                $doctorTemp['mobile'] = $doctor->doctors_mobile;
                $doctorTemp['Src27'] = $doctor->doctors_27Src;
                $doctorTemp['consultaionFee'] = $doctor->doctors_consultaionFee;
                $doctorTemp['parents'] = $this->getDoctorsRole($doctor->doctors_userId);
                $doctorResult[] = $doctorTemp;
            }
            return $doctorResult;
        }
        
        return $doctorResult;

    }
    
    public function getDiagnosticsReviewCount($diagnosticId)
    {
        $sql = "SELECT COUNT('reviews_id') as reviews
                FROM `qyura_reviews`
                WHERE `reviews_deleted` = '0' and `reviews_userId` = '1' "; 
        $query = $this->db->query($sql)->row();
        return $query->reviews;
        
    }
    
    public function getDiagnosticsAvgRating($diagonsticId)
    {
       return '';
    }
    
    public function getDiagnosticsPkg($diagonsticId)
    {
        $this->db->select('healthPackage_id,healthPackage_packageTitle,healthPackage_packageId,healthPackage_packageTitle,healthPackage_expiryDateStatus,healthPackage_date,healthPackage_bestPrice,healthPackage_discountedPrice,healthPackage_description,healthPackage_deleted,modifyTime');
        $this->db->from('qyura_healthPackage');
        $this->db->where(array('healthPackage_MIuserId'=>$diagonsticId,'healthPackage_deleted'=>0));
        return $this->db->get()->result();
    }
    
    function getDiagnosticsCat ($diagonsticId,$limit=4) {
         $this->db->select('qyura_diagnosticsCat.diagnosticsCat_catName AS diagnosticsCatName,qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagTestId');
        $this->db->from('qyura_hospitalDiagCatTest');
        $this->db->join('qyura_diagnosticsCat','qyura_diagnosticsCat.diagnosticsCat_catId = qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagCatId','left');
        $this->db->where(array('qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagCatId'=>$diagonsticId,'qyura_hospitalDiagCatTest.hospitalDiagCatTest_deleted'=>0));
        if($limit)
            $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
    
    /*public function getDiagnosticsds($diagonsticId,$limit=3)
    {
        $this->db->select('hospitalAwards_id,hospitalAwards_awardsName,modifyTime');
        $this->db->from('qyura_hospitalAwards');
        $this->db->where(array('qyura_hospitalAwards.hospitalAwards_hospitalId'=>$diagonsticId,'qyura_hospitalAwards.hospitalAwards_deleted'=>0));
        if($limit)
        $this->db->limit($limit);
        return $this->db->get()->result();
    }*/
    
    public function getDoctorsRole($userId)
    {
        $this->db->select('qyura_doctors.doctors_id,qyura_usersRoles.usersRoles_userId,qyura_usersRoles.usersRoles_roleId,qyura_usersRoles.usersRoles_parentId');
        $this->db->from('qyura_usersRoles');
        $this->db->join('qyura_doctors','qyura_doctors.doctors_userId=qyura_usersRoles.usersRoles_userId','left');
        $this->db->where(array('qyura_usersRoles.usersRoles_userId'=>$userId,'qyura_usersRoles.usersRoles_deleted'=>0));
        return $this->db->get()->result();
    }
}

