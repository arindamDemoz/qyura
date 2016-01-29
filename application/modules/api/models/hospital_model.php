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
        $this->db->from();
        $this->db->where();
        $this->db->get();
    }
    
    public function getHosServices()
    {
        $this->db->select();
        $this->db->from();
        $this->db->where();
        $this->db->get();
    }
    
    public function getHosSpecialities()
    {
        $this->db->select();
        $this->db->from();
        $this->db->where();
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
    
    
}
?>
