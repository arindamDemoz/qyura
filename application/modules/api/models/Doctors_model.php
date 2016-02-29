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
    
  public function getDoctorsList($lat, $long, $notIn, $isemergency,$specialityid,$radius,$rating,$exp) {
       
            $lat = isset($lat) ? $lat : '';
            $long = isset($long) ? $long : '';
            $notIn = isset($notIn) ? $notIn : '';
            
            // where array
            $where = array('doctors_deleted' => 0, 'usersRoles_roleId' => ROLE_DOCTORE, 'usersRoles_parentId'=> 0);
            if($isemergency != '' && $isemergency != NULL && $isemergency != 0){
                unset($where['usersRoles_parentId']);
                if($specialityid != '' && $specialityid != NULL){
                    unset($where['qyura_specialities.specialities_id']);
                }
                $where['qyura_doctors.doctors_27Src'] = $isemergency;
            }elseif($specialityid != '' && $specialityid != NULL){
                $where['qyura_specialities.specialities_id'] = $specialityid;
            }
            
            // having array
            $having = array('distance <=' => $radius);
            if($exp != '' && $exp != NULL && $exp != 0){
                if($exp == 1){
                    $having['exp <= '] = 5;
                }elseif($exp == 2){
                    $having['exp >= '] = 5;
                    $having['exp <= '] = 10;
                }elseif($exp == 3){
                    $having['exp >= '] = 10;
                }
                
            }
            
            if($rating != '' && $rating != NULL && $rating != 0 ){
                $having['rating'] = number_format($rating,1);
            }
            
            $this->db->select('qyura_doctors.doctors_mobile,qyura_doctors.doctors_id as id,qyura_doctors.doctors_userId as userId, CONCAT(qyura_doctors.doctors_fName, " ",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance , qyura_doctors.doctors_consultaionFee as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName) as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long,qyura_doctors.doctors_27Src as isEmergency, ( FROM_UNIXTIME(qyura_professionalExp.professionalExp_end,"%Y") - FROM_UNIXTIME(qyura_professionalExp.professionalExp_start,"%Y"))  AS exp ,(
CASE 
 WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
 WHEN (reviews_rating is not null) 
 THEN 
      ROUND( (AVG(reviews_rating)), 1)
 WHEN (qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(qyura_ratings.rating)), 1)
 END)
 AS `rating` ')

                    ->from('qyura_doctors')
                    
                    ->join('qyura_usersRoles','qyura_usersRoles.usersRoles_userId=qyura_doctors.doctors_userId','left')
                    
                    ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_doctorsId=qyura_doctors.doctors_id', 'left')

                    ->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_doctors.doctors_id', 'left')

                    ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')
                    
                    ->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left')
                    ->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left')
 
                    ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_doctors.doctors_userId', 'left')
                    
                    ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_doctors.doctors_userId', 'left')

                    ->where($where)
                    
                    ->having($having)
                    
                    ->where_not_in('doctors_id', $notIn)
                    
                    ->order_by('distance' , 'ASC')
                    
                    ->group_by('doctors_id')
                    
                    ->limit(DATA_LIMIT);

            $response = $this->db->get()->result();
            //echo $this->db->last_query(); exit;
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    $finalTemp = array();
		    
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->exp) ? $row->exp : "";
                    $finalTemp[] = isset($row->imUrl) && $row->imUrl != '' ? 'assets/doctorsImages/'.$row->imUrl : "";
                    $finalTemp[] = isset($row->rating) ? $row->rating : "";
                    $finalTemp[] = isset($row->consFee) ? $row->consFee : "";
                    $finalTemp[] = isset($row->specialityName) ? $row->specialityName : "";
                    $finalTemp[] = isset($row->degree) ? $row->degree : "";
                    $finalTemp[] = isset($row->lat) ? $row->lat : "";
                    $finalTemp[] = isset($row->long) ? $row->long : "";
                    $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "";
		    $finalTemp[] = isset($row->doctors_mobile) ? $row->doctors_mobile : "";
                    $finalTemp[] = isset($row->userId) ? $row->userId : "";
                    $finalResult[] = $finalTemp;
                    
                }
             return $finalResult;
          } else {
            return $finalResult;
        }
    }
    
    public function getDoctorsDetails($doctorId)
    {
        $this->db->select('doctors_id as id, doctors_userId userId,  CONCAT(qyura_doctors.doctors_fName, "",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl , doctors_deleted as review, doctors_deleted as fav, qyura_doctors.doctors_consultaionFee as consFee, qyura_specialities.specialities_name as specialityName, Group_concat(distinct qyura_degree.degree_SName) as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long,doctors_phn, ( FROM_UNIXTIME(qyura_professionalExp.professionalExp_end,"%Y") - FROM_UNIXTIME(qyura_professionalExp.professionalExp_start,"%Y"))  AS exp,(
CASE 
 WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
 WHEN (reviews_rating is not null) 
 THEN 
      ROUND( (AVG(reviews_rating)), 1)
 WHEN (qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(qyura_ratings.rating)), 1)
 END)
 AS `rating` ')
                
         ->from('qyura_doctors')
                
         ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_doctorsId=qyura_doctors.doctors_id', 'left')

         ->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_doctors.doctors_id', 'left')

         ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')
                
         ->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left')
          ->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left')

          ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_doctors.doctors_userId', 'left')
                    
          ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_doctors.doctors_userId', 'left')
                
        ->where(array('doctors_id'=>$doctorId,'doctors_deleted'=>0));
        
            $row = $this->db->get()->row();
            $finalResult = array();
            $finalTemp = array();
            
            $finalTemp['id'] = isset($row->id) ? $row->id : "";
            $finalTemp['userId'] = isset($row->userId) ? $row->userId : "";
            $finalTemp['name'] = isset($row->name) ? $row->name : "";
            $finalTemp['phn'] = isset($row->doctors_phn) ? $row->doctors_phn : "";
            $finalTemp['exp'] = isset($row->exp) ? $row->exp : "";
            $finalTemp['imUrl'] = isset($row->imUrl) ? 'assets/doctorsImages/'.$row->imUrl : "";
            $finalTemp['rating'] = isset($row->rating) ? $row->rating : "";
            $finalTemp['fav'] = isset($row->fav) ? $row->fav : "";
            $finalTemp['consFee'] = isset($row->consFee) ? $row->consFee : "";
            $finalTemp['specialityCat'] = isset($row->specialityName) ? $row->specialityName : "";
            $finalTemp['degree'] = isset($row->degree) ? $row->degree : "";
            $finalTemp['lat'] = isset($row->lat) ? $row->lat : "";
            $finalTemp['long'] = isset($row->long) ? $row->long : "";
        return  $finalResult[] = $finalTemp;
    }
    
    public function getDoctorServices($doctorId)
    {
        $this->db->select('doctorServices_serviceName as services,modifyTime,doctorServices_id id');
        $this->db->from('qyura_doctorServices');
        $this->db->where(array('qyura_doctorServices.doctorServices_doctorId'=>$doctorId,'doctorServicess_deleted'=>0));
        
        $response = $this->db->get()->result();
        $finalResult = array();
        if (!empty($response)) {                
         foreach ($response as $row) {
             $finalTemp = array();
             $finalTemp['id'] = isset($row->id) ? $row->id : "";
             $finalTemp['modifyTime'] = isset($row->modifyTime) ? $row->modifyTime : "";
             $finalTemp['services'] = isset($row->services) ? $row->services : "";
             $finalResult[] = $finalTemp;
          }
          return $finalResult;

        }else{
           return $finalResult;
        }
    }
    
    public function getHosDiagonDetail($doctorUserId)
    {
       // echo $this->getDoctorSession(1); exit;
        $todayWeek =  getDay(date("l"));
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                  ->from('qyura_doctorAvailability')
                  // ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'qyura_doctorAvailability.doctorAvailability_day' => $todayWeek));
                ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0))
                ->order_by('day' , 'ASC');
                 
                // $row = $this->db->get()->row();
                   $response = $this->db->get()->result();
                  // echo $this->db->last_query(); die();
                   $finalResult = array();
                   if (!empty($response)) {                
                    foreach ($response as $row) {
                        $finalTemp = array();
                        $day = convertNumberToDay(date($row->id));
                        $finalResult[$day] = $this->getDoctorSession($row->id);
                     }
                     return $finalResult;

                   }else{
                      return (object)$finalResult;
                   }
                   
                   
    }
    
    public function getDoctorNumReviews($docUserId)
    {
        $sql = "SELECT COUNT('reviews_id') as reviews
                FROM `qyura_reviews`
                WHERE `reviews_deleted` = '0' and `reviews_relateId` = $docUserId "; 
        $query = $this->db->query($sql)->row();
        return $query->reviews;
        
    }
    
    
    public function getDoctorReviews($docUserId)
    {
        //echo $docUserId; exit;
        $this->db->select('reviews_id as id, reviews_rating rating,reviews_details as reviews, patientDetails_patientName as name, patientDetails_patientImg as img');
        $this->db->from('qyura_reviews');
        $this->db->join('qyura_patientDetails', 'qyura_reviews.reviews_userId = qyura_patientDetails.patientDetails_usersId', 'left');
        $this->db->where(array('reviews_deleted' => 0, 'qyura_reviews.reviews_relateId ' => $docUserId));
        $response = $this->db->get()->result();
        
        //echo $this->db->last_query(); exit;
        $finalResult = array();
        if(!empty($response)){
             foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp['id'] = isset($row->id)  ? $row->id : '';
                    $finalTemp['rating'] = isset($row->rating)  ? $row->rating : '';
                    $finalTemp['name'] = isset($row->name)  && $row->name !='' ? $row->name : '';
                    $finalTemp['img'] = isset($row->img)  ? 'assets/patientImages/'.$row->img : '';
                    $finalTemp['detail'] = isset($row->reviews) && $row->reviews !=''  ? substr($row->reviews,0,200) : '';
                    $finalResult[] = $finalTemp;
                 }
             return $finalResult;
        }else{
           return $finalResult; 
        }
    }
    
     public function getDoctorSession($id)
    {
         
        $this->db->select('doctorAvailabilitySession_id,hospital_name as hName, hospital_id hId, diagnostic_name as dName, diagnostic_id dId,  doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session, hospital_lat hLat, hospital_long hLong, diagnostic_lat dLat, diagnostic_long dLong')
                  ->from('qyura_doctorAvailabilitySession')
                   ->join('qyura_hospital','qyura_hospital.hospital_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                   ->join('qyura_diagnostic','qyura_diagnostic.diagnostic_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                  // ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'qyura_doctorAvailability.doctorAvailability_day' => $todayWeek));
                ->where(array('doctorAvailability_doctorAvailabilityId' => $id));
                 
                // $row = $this->db->get()->row();
                   $response = $this->db->get()->result();
                  // echo $this->db->last_query(); die();
                   $finalResult = array();
                   if (!empty($response)) {                
                    foreach ($response as $row) {
                        $finalTemp = array();
                        $finalTemp['sessionid'] = isset($row->doctorAvailabilitySession_id) ? $row->doctorAvailabilitySession_id : "";
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
                      return $finalResult;
                   }
    }
    
    
   public function getDocGallery($id)
    {
        $this->db->select('doctorImages_id, CONCAT("assets/doctorsImages","/",doctorImages_ImagesName) as docImage');
        $this->db->from('qyura_doctorImages');
        $this->db->where(array('doctorImages_doctorId'=>$id,'doctorImages_deleted'=>0));
        return $this->db->get()->result();
    }
    
   public function getFavList($docUserId)
    {
        $this->db->select('doctorImages_id, CONCAT("assets/doctorsImages","/",doctorImages_ImagesName) as docImage');
        $this->db->from('qyura_doctorImages');
        $this->db->where(array('doctorImages_doctorId'=>$id,'doctorImages_deleted'=>0));
        return $this->db->get()->result();
    }
    
    
    public function getHosTimeSlot($hospitalId, $doctorUserId) {
                   $this->db->select('hospitalTimeSlot_id id,hospitalTimeSlot_startTime start,hospitalTimeSlot_endTime end, hospitalTimeSlot_sessionType session')
                 ->from('qyura_hospitalTimeSlot')
                 ->where(array('hospitalTimeSlot_deleted' => 0, 'hospitalTimeSlot_hospitalId' => $hospitalId));
        
                    $response = $this->db->get()->result();
                    // echo $this->db->last_query(); die();
                    $finalResult = array();
                    if (!empty($response)) {
                        foreach ($response as $row) {
                            $finalTemp = array();
                            $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                            $finalTemp['start'] = isset($row->start) ? $row->start : "";
                            $finalTemp['end'] = isset($row->end) ? $row->end : "";
                            $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                            $finalResult[] = $finalTemp;
                        }
                        return $finalResult;
                    } else {
                        return $finalResult;
                    }
        }
        
        
     public function getDiagnoTimeSlot($diagonsticId, $doctorUserId) {
                  
                  $this->db->select('diagnosticCenterTimeSlot_id id, diagnosticCenterTimeSlot_startTime start, diagnosticCenterTimeSlot_endTime end, diagnosticCenterTimeSlot_sessionType session')
                 ->from('qyura_diagnosticCenterTimeSlot')
                 ->where(array('diagnosticCenterTimeSlot_deleted' => 0, 'diagnosticCenterTimeSlot_diagnosticId' => $diagonsticId));
        
                    $response = $this->db->get()->result();
                    // echo $this->db->last_query(); die();
                    $finalResult = array();
                    if (!empty($response)) {
                        foreach ($response as $row) {
                            $finalTemp = array();
                            $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                            $finalTemp['start'] = isset($row->start) ? $row->start : "";
                            $finalTemp['end'] = isset($row->end) ? $row->end : "";
                            $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                            $finalResult[] = $finalTemp;
                        }
                        return $finalResult;
                    } else {
                        return $finalResult;
                    }
        }
        
    public function getDocTimeSlotForDiagon($diagonsticId, $doctorUserId) {
        // echo $this->getDoctorSession(1); exit;
        $todayWeek = getDay(date("l"));
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id=qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId', 'left')
                ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0, 'diagnostic_id' => $diagonsticId))
                ->order_by('day', 'ASC');

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $day = convertNumberToDay(date($row->id));
                $finalResult[$day] = $this->getDoctorSessionForDiagon($row->id, $diagonsticId);
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }
    
  public function getDoctorSessionForDiagon($id, $diagonsticId) {

        $this->db->select('doctorAvailabilitySession_id, diagnostic_name as dName, diagnostic_id dId, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session')
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where(array('doctorAvailability_doctorAvailabilityId' => $id, 'diagnostic_id' => $diagonsticId));

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['sessionid'] = isset($row->doctorAvailabilitySession_id) ? $row->doctorAvailabilitySession_id : "";
                $finalTemp['id'] = isset($row->dId) && $row->dId ? $row->dId : '';
                $finalTemp['name'] = isset($row->dName) && $row->dName != '' ? $row->dName : '';
                $finalTemp['start'] = isset($row->start) ? $row->start : "";
                $finalTemp['end'] = isset($row->end) ? $row->end : "";
                $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }
    
    
   public function getDocTimeSlotForhospital($hospitalId, $doctorUserId) {
        // echo $this->getDoctorSession(1); exit;
        $todayWeek = getDay(date("l"));
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0, 'doctorAvailability_refferalId' => $hospitalId))
                ->order_by('day', 'ASC');

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $day = convertNumberToDay(date($row->id));
                $finalResult[$day] = $this->getDoctorSessionForHospital($row->id, $hospitalId);
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }

    public function getDoctorSessionForHospital($id, $hospitalId) {

        $this->db->select('doctorAvailabilitySession_id,hospital_name as hName, hospital_id hId, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session')
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where(array('doctorAvailability_doctorAvailabilityId' => $id, 'hospital_id' => $hospitalId));

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['sessionid'] = isset($row->doctorAvailabilitySession_id) ? $row->doctorAvailabilitySession_id : "";
                $finalTemp['id'] = isset($row->hId) && $row->hId ? $row->hId : '';
                $finalTemp['name'] = isset($row->hName) && $row->hName != '' ? $row->hName : '';
                $finalTemp['start'] = isset($row->start) ? $row->start : "";
                $finalTemp['end'] = isset($row->end) ? $row->end : "";
                $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

 /*   public function getHosTimeSlot($hospitalId) {
        $this->db->select('hospitalTimeSlot_id id,hospitalTimeSlot_startTime start,hospitalTimeSlot_endTime end, hospitalTimeSlot_sessionType session')
                 ->from('qyura_hospitalTimeSlot')
                 ->where(array('hospitalTimeSlot_deleted' => 0, 'hospitalTimeSlot_hospitalId' => $hospitalId));
        
                    $response = $this->db->get()->result();
                    // echo $this->db->last_query(); die();
                    $finalResult = array();
                    if (!empty($response)) {
                        foreach ($response as $row) {
                            $finalTemp = array();
                            $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                            $finalTemp['start'] = isset($row->start) ? $row->start : "";
                            $finalTemp['end'] = isset($row->end) ? $row->end : "";
                            $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                            $finalResult[] = $finalTemp;
                        }
                        return $finalResult;
                    } else {
                        return $finalResult;
                    }
        } */
    
    
    
    public function getDocAllTimeSlot($doctorUserId) {
        
           
             $this->db->select('doctorAvailability_refferalId as MiId, IFNULL(hospital_name, diagnostic_name) AS name, IF(usersRoles_roleId = 1,"Hos","Diagno") as type,  IFNULL(hospital_id, diagnostic_id) as id')
            ->from('qyura_doctorAvailability')
            ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId = qyura_doctorAvailability.doctorAvailability_id', 'left')
            ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
             ->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
            ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
            ->where(array('doctorAvailability_docUsersId' => $doctorUserId))
            ->group_by('doctorAvailability_refferalId');
             $response = $this->db->get()->result();
            // echo $this->db->last_query(); die();
              $finalResult = array();
                if (!empty($response)) {
                    foreach ($response as $row) {
                        $finalTemp = array();
                        $finalTemp['id'] = isset($row->id) ? $row->id : "";
                        $finalTemp['name'] = isset($row->name) ? $row->name : "";
                        $finalTemp['type'] = isset($row->type) ? $row->type : "";
                        $finalTemp['timeslot'] = isset($row->id) && isset($row->type) && $row->type == 'Hos' ? $this->getHosTimeSlotForDoc($row->id) : $this->getDiagnoTimeSlotForDoc($row->id);
                        $finalTemp['docTimeSlot'] = isset($row->MiId) ? $this->getDocTimeSlot($row->MiId, $doctorUserId) : "";
                        $finalResult[] = $finalTemp;
                    }
                    return $finalResult;
                } else {
                    return $finalResult;
                }
    }
    
    
     public function getHosTimeSlotForDoc($hospitalId) {
        $this->db->select('hospitalTimeSlot_id id,hospitalTimeSlot_startTime start,hospitalTimeSlot_endTime end, hospitalTimeSlot_sessionType session')
                 ->from('qyura_hospitalTimeSlot')
                 ->where(array('hospitalTimeSlot_deleted' => 0, 'hospitalTimeSlot_hospitalId' => $hospitalId));
        
                    $response = $this->db->get()->result();
                    // echo $this->db->last_query(); die();
                    $finalResult = array();
                    if (!empty($response)) {
                        foreach ($response as $row) {
                            $finalTemp = array();
                            $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                            $finalTemp['start'] = isset($row->start) ? $row->start : "";
                            $finalTemp['end'] = isset($row->end) ? $row->end : "";
                            $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                            $finalResult[] = $finalTemp;
                        }
                        return $finalResult;
                    } else {
                        return $finalResult;
                    }
        }
        
        
            public function getDiagnoTimeSlotForDoc($diagonsticId) {
        
                  $this->db->select('diagnosticCenterTimeSlot_id id, diagnosticCenterTimeSlot_startTime start, diagnosticCenterTimeSlot_endTime end, diagnosticCenterTimeSlot_sessionType session')
                 ->from('qyura_diagnosticCenterTimeSlot')
                 ->where(array('diagnosticCenterTimeSlot_deleted' => 0, 'diagnosticCenterTimeSlot_diagnosticId' => $diagonsticId));
        
                    $response = $this->db->get()->result();
                    //echo $this->db->last_query(); die();
                    $finalResult = array();
                    if (!empty($response)) {
                        foreach ($response as $row) {
                            $finalTemp = array();
                            $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                            $finalTemp['start'] = isset($row->start) ? $row->start : "";
                            $finalTemp['end'] = isset($row->end) ? $row->end : "";
                            $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                            $finalResult[] = $finalTemp;
                        }
                        return $finalResult;
                    } else {
                        return $finalResult;
                    }
    }
        
        public function getDocTimeSlot($miId,$doctorUserId){
         $this->db->select('doctorAvailabilitySession_id as id, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session ')
                 ->from('qyura_doctorAvailability')
                 ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId = qyura_doctorAvailability.doctorAvailability_id')
                 ->where(array('doctorAvailability_deleted' => 0, 'doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_refferalId' => $miId));
         
                  $response = $this->db->get()->result();
                    // echo $this->db->last_query(); die();
                    $finalResult = array();
                    if (!empty($response)) {
                        foreach ($response as $row) {
                            $finalTemp = array();
                            $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                            $finalTemp['start'] = isset($row->start) ? $row->start : "";
                            $finalTemp['end'] = isset($row->end) ? $row->end : "";
                            $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                            $finalResult[] = $finalTemp;
                        }
                        return $finalResult;
                    } else {
                        return $finalResult;
                    }
     }
}
?>
