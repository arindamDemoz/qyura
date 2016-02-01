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
        $this->db->select('hospital_id, hospital_address, hospital_name, hospital_phn, hospital_lat, hospital_long, modifyTime, hospital_img');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_id'=>$hospitalId,'hospital_deleted'=>0));
        return $this->db->get()->row();
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
    
    public function getHosDoctors($hospitalId,$limit=4)
    {
        $this->db->select('doctors_img,doctors_fName,doctors_lName,doctor_addr,doctors_phn,doctors_mobile,doctors_27Src,doctors_consultaionFee');
        $this->db->from('qyura_usersRoles');
        $this->db->join('qyura_doctors','qyura_doctors.doctors_userId=qyura_usersRoles.usersRoles_userId','left');
        $this->db->where(array('qyura_usersRoles.usersRoles_parentId'=>$hospitalId,'qyura_usersRoles.usersRoles_roleId'=>ROLE_DOCTORE));
        if($limit)
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    
}
?>
