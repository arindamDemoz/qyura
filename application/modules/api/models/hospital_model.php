<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Hospital_model extends My_model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
    public function getHospitalDetails($hosUsrId)
    {
        $this->db->select('hospital_id, hospital_address, hospital_name, hospital_phn, hospital_lat, hospital_long, modifyTime, hospital_img');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_usersId'=>$hosUsrId,'hospital_deleted'=>0));
        return $this->db->get()->row();
    }
    
    public function getHosServices($hosUsrId)
    {
        $this->db->select('qyura_services.services_name,qyura_services.services_deleted,qyura_services.modifyTime,qyura_services.services_id');
        $this->db->from('qyura_services');
        $this->db->join('qyura_hospitalServices','qyura_hospitalServices.hospitalServices_servicesId=qyura_services.services_id','left');
        $this->db->where(array('qyura_hospitalServices.hospitalServices_hosUserId'=>$hosUsrId,'qyura_services.services_deleted'=>0));
        $this->db->get()->result();
    }
    
    public function getHosSpecialities()
    {
        $this->db->select('qyura_specialities.specialities_name,qyura_specialities.specialities_id,qyura_specialities.specialities_specialitiesCatId,qyura_specialities.modifyTime,qyura_specialities.specialities_deleted');
        $this->db->from('qyura_specialities');
        $this->db->join('qyura_hospitalServices','qyura_hospitalServices.hospitalServices_servicesId=qyura_services.services_id','left');
        $this->db->where('');
        $this->db->get();
    }
    
    public function getHosHelthPkg()
    {
        $this->db->select();
        $this->db->from();
        $this->db->where();
        $this->db->get();
    }
    
    public function getHosReviewCount()
    {
        $this->db->select();
        $this->db->from();
        $this->db->where();
        $this->db->get();
    }
    
    
    public function getHosAvgRating()
    {
        $this->db->select();
        $this->db->from();
        $this->db->where();
        $this->db->get();
    }
    
     public function getHosDoctors()
    {
        $this->db->select();
        $this->db->from();
        $this->db->where();
        $this->db->get();
    }
    
    
}
?>
