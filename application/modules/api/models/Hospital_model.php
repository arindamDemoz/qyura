<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Hospital_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
    public function getHosDetails($hospitalId)
    {
        $this->db->select('hospital_id, hospital_usersId, hospital_address, hospital_name, hospital_phn, hospital_lat, hospital_long, modifyTime, hospital_img');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_id'=>$hospitalId,'hospital_deleted'=>0));
        return $this->db->get()->row();
    }
    
    function getDiagnosticsCat ($hospitalId,$limit=4) {
         $this->db->select('qyura_diagnosticsCat.diagnosticsCat_catName AS diagnosticsCatName,qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagTestId');
        $this->db->from('qyura_hospitalDiagCatTest');
        $this->db->join('qyura_diagnosticsCat','qyura_diagnosticsCat.diagnosticsCat_catId = qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagCatId','left');
        $this->db->where(array('qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagCatId'=>$hospitalId,'qyura_hospitalDiagCatTest.hospitalDiagCatTest_deleted'=>0));
        if($limit)
            $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
    
    public function getHosServices($hospitalId,$limit=3)
    {
        $this->db->select('qyura_services.services_name,qyura_services.services_deleted,qyura_services.modifyTime,qyura_services.services_id');
        $this->db->from('qyura_services');
        $this->db->join('qyura_hospitalServices','qyura_hospitalServices.hospitalServices_servicesId=qyura_services.services_id','left');
        $this->db->where(array('qyura_hospitalServices.hospitalServices_hospitalId'=>$hospitalId,'qyura_services.services_deleted'=>'0'));
        if($limit)
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    public function getHosSpecialities($hospitalId,$limit=3)
    {
        $this->db->select('qyura_specialities.specialities_name,qyura_specialities.specialities_id,qyura_specialities.specialities_specialitiesCatId,qyura_specialities.modifyTime,qyura_specialities.specialities_deleted');
        $this->db->from('qyura_specialities');
        $this->db->join('qyura_hospitalSpecialities','qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId=qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId','left');
        $this->db->where(array('qyura_hospitalSpecialities.hospitalSpecialities_hospitalId'=>$hospitalId,'qyura_hospitalSpecialities.hospitalSpecialities_deleted'=>0,'qyura_specialities.specialities_deleted'=>0));
        if($limit)
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    public function getHosHelthPkg($hospitalId)
    {
        $this->db->select('healthPackage_id,healthPackage_packageTitle,healthPackage_packageId,healthPackage_packageTitle,healthPackage_expiryDateStatus,healthPackage_date,healthPackage_bestPrice,healthPackage_discountedPrice,healthPackage_description,healthPackage_deleted,modifyTime');
        $this->db->from('qyura_healthPackage');
        $this->db->where(array('healthPackage_MIuserId'=>$hospitalId,'healthPackage_deleted'=>0));
        return $this->db->get()->result();
    }
    
    public function getHosReviewCount()
    {
        $sql = "SELECT COUNT('reviews_id') as reviews
                FROM `qyura_reviews`
                WHERE `reviews_deleted` = '0' and `reviews_userId` = '1' "; 
        $query = $this->db->query($sql)->row();
        return $query->reviews;
        
    }
    
    
    public function getHosAvgRating()
    {
       return '';
    }
    
    public function getHosDoctors($hospitalId,$hospitalUsersId,$limit=4)
    {
        $this->db->select('doctors_id,doctors_userId,doctors_img,doctors_fName,doctors_lName,doctor_addr,doctors_phn,doctors_mobile,doctors_27Src,doctors_consultaionFee');
        $this->db->from('qyura_usersRoles');
        $this->db->join('qyura_doctors','qyura_doctors.doctors_userId=qyura_usersRoles.usersRoles_userId','left');
        $this->db->where(array('qyura_usersRoles.usersRoles_parentId'=>$hospitalUsersId,'qyura_usersRoles.usersRoles_roleId'=>ROLE_DOCTORE));
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
    
    public function getDoctorsRole($userId)
    {
        $this->db->select('qyura_doctors.doctors_id,qyura_usersRoles.usersRoles_userId,qyura_usersRoles.usersRoles_roleId,qyura_usersRoles.usersRoles_parentId');
        $this->db->from('qyura_usersRoles');
        $this->db->join('qyura_doctors','qyura_doctors.doctors_userId=qyura_usersRoles.usersRoles_userId','left');
        $this->db->where(array('qyura_usersRoles.usersRoles_userId'=>$userId,'qyura_usersRoles.usersRoles_deleted'=>0));
        return $this->db->get()->result();
    }
    
    public function getHosInsurance($hospitalId,$limit=4)
    {
        $this->db->select('insurance_Name,insurance_id,insurance_img,qyura_insurance.modifyTime');
        $this->db->from('qyura_hospitalInsurance');
        $this->db->join('qyura_insurance','qyura_insurance.insurance_id=qyura_hospitalInsurance.hospitalInsurance_insuranceId','left');
        $this->db->where(array('qyura_hospitalInsurance.hospitalInsurance_hospitalId'=>$hospitalId,'qyura_hospitalInsurance.hospitalInsurance_deleted'=>0));
        if($limit)
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    public function getHosAwards($hospitalId,$limit=3)
    {
        $this->db->select('hospitalAwards_id,hospitalAwards_awardsName,modifyTime');
        $this->db->from('qyura_hospitalAwards');
        $this->db->where(array('qyura_hospitalAwards.hospitalAwards_hospitalId'=>$hospitalId,'qyura_hospitalAwards.hospitalAwards_deleted'=>0));
        if($limit)
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    
}
?>
