<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Doctors_model extends My_model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
    public function getDoctorsDetails($doctorId)
    {
        $this->db->select('doctors_id as id, doctors_userId userId,  CONCAT(qyura_doctors.doctors_fName, "",  qyura_doctors.doctors_lName) AS name, qyura_professionalExp.professionalExp_start startDate, qyura_professionalExp.professionalExp_end endDate, qyura_doctors.doctors_img imUrl, qyura_doctors.doctors_deleted as rating, doctors_deleted as review, doctors_deleted as fav, qyura_doctors.doctors_consultaionFee as consFee, qyura_specialitiesCat.specialitiesCat_name as specialityCat, Group_concat(qyura_degree.degree_SName) as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long,doctors_phn')
                
         ->from('qyura_doctors')
                
         ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_doctorsId=qyura_doctors.doctors_id', 'left')

         ->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_doctors.doctors_id', 'left')

         ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')

         ->join('qyura_specialitiesCat', 'qyura_specialitiesCat.specialitiesCat_id=qyura_doctorAcademic.doctorSpecialities_specialitiesCatId', 'left')
        ->where(array('doctors_id'=>$doctorId,'doctors_deleted'=>0));
        
            $row = $this->db->get()->row();
            $finalResult = array();
            $finalTemp = array();
            
            $finalTemp['id'] = isset($row->id) ? $row->id : "";
            $finalTemp['userId'] = isset($row->userId) ? $row->userId : "";
            $finalTemp['name'] = isset($row->name) ? $row->name : "";
            $finalTemp['phn'] = isset($row->doctors_phn) ? $row->doctors_phn : "";
            $finalTemp['exp'] = isset($row->startDate) && isset($row->endDate) ? getYearBtTwoDate($row->startDate,$row->endDate) : "";
            $finalTemp['imUrl'] = isset($row->imUrl) ? 'assets/doctorsImages/'.$row->imUrl : "";
            $finalTemp['rating'] = isset($row->rating) ? $row->rating : "";
            $finalTemp['fav'] = isset($row->fav) ? $row->fav : "";
            $finalTemp['consFee'] = isset($row->consFee) ? $row->consFee : "";
            $finalTemp['specialityCat'] = isset($row->specialityCat) ? $row->specialityCat : "";
            $finalTemp['degree'] = isset($row->degree) ? $row->degree : "";
            $finalTemp['lat'] = isset($row->lat) ? $row->lat : "";
            $finalTemp['long'] = isset($row->long) ? $row->long : "";
            
            
            
        return  $finalResult[] = $finalTemp;
    }
    
    public function getDoctorServices($doctorId)
    {
        $this->db->select('Group_concat(qyura_services.services_name) as services,qyura_services.services_deleted,qyura_services.modifyTime,qyura_services.services_id');
        $this->db->from('qyura_services');
        $this->db->join('qyura_doctorServices','qyura_doctorServices.doctorServices_servicesId=qyura_services.services_id','left');
        $this->db->where(array('qyura_doctorServices.doctorServices_doctorId'=>$doctorId,'qyura_services.services_deleted'=>0));
        
        $row = $this->db->get()->row();
        $finalTemp = array();
      //  $finalResult = array(); 
       return $finalTemp['services'] = isset($row->services) ? $row->services : "";
        //return  $finalResult[] = $finalTemp;
    }
    
    public function getHosDiagonDetail($doctorUserId)
    {
        $todayWeek =  getDay(date("l"));
        $this->db->select('hospital_name as hName, hospital_id hId, diagnostic_name as dName, diagnostic_id dId,  doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session, hospital_lat hLat, hospital_long hLong, diagnostic_lat dLat, diagnostic_long dLong')
                  ->from('qyura_doctorAvailability')
                  ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id=qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId','right')
                   ->join('qyura_hospital','qyura_hospital.hospital_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                   ->join('qyura_diagnostic','qyura_diagnostic.diagnostic_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                   ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'qyura_doctorAvailability.doctorAvailability_day' => $todayWeek));
                  // $row = $this->db->get()->row();
                   $response = $this->db->get()->result();
                  // echo $this->db->last_query(); die();
                   $finalResult = array();
                   if (!empty($response)) {                
                    foreach ($response as $row) {
                        $finalTemp = array();
                        $finalTemp['id'] = isset($row->hId) && $row->hId ? $row->hId : $row->dId;
                        $finalTemp['type'] = isset($row->hId) && $row->hId ? 'hos' : 'diagon';
                        $finalTemp['name'] = isset($row->hName) && $row->hName !=''  ? $row->hName : $row->dName;
                        $finalTemp['start'] = isset($row->start) ? $row->start : "";
                        $finalTemp['end'] = isset($row->end) ? $row->end : "";
                        $finalTemp['lat'] = isset($row->hLat) && $row->hLat !='' ? $row->hLat : $row->dLat;
                        $finalTemp['long'] = isset($row->hLong) && $row->hLong !='' ? $row->hLong : $row->dLong;
                        $finalTemp['session'] = isset($row->session) ?  getDoctorAvailibilitySession($row->session) : "";
                        $finalResult[] = $finalTemp;
                     }
                     return $finalResult;

                   }else{
                      return $finalResult[] = '';
                   }
                   
                   
    }
    
    public function getDoctorNumReviews($docUserId)
    {
        $sql = "SELECT COUNT('reviews_id') as reviews
                FROM `qyura_reviews`
                WHERE `reviews_deleted` = '0' and `reviews_userId` = $docUserId "; 
        $query = $this->db->query($sql)->row();
        return $query->reviews;
        
    }
    
    
    public function getDoctorReviews($docUserId)
    {
        $this->db->select('reviews_details as reviews');
        $this->db->from('qyura_reviews');
        $this->db->where(array('reviews_deleted' => 0, 'reviews_userId' => $docUserId));
       // echo $this->db->last_query();
        $response = $this->db->get()->result();
        $finalResult = array();
        if(!empty($response)){
             foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp['name'] = isset($row->reviews)  ? $row->reviews : '';
                    $finalResult[] = $finalTemp;
                 }
             return $finalResult;
        }else{
           return $finalResult = ''; 
        }
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
