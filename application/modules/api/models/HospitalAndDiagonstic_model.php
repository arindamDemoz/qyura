<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HospitalAndDiagonstic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   public function getHosDiagonList($lat, $long, $notIn, $specialityid) {
         $notIn = isset($notIn) && !empty($notIn) ? $notIn : ''; 
         $sql = "SELECT 'Hospital' AS `type`, `isEmergency` AS `isEmergency`, `hospital_id` as `id`, `hospital_usersId` `userId`, `hospital_deleted` as `fav`, `hospital_address` as `adr`, `hospital_name` `name`, `hospital_phn` `phn`, `hospital_lat` `lat`, `hospital_long` `long`, `qyura_hospital`.`modifyTime` `upTm`, CONCAT('assets/hospitalsImages','/',hospital_img) as imUrl, (
                6371 * acos( cos( radians( $lat ) ) * cos( radians( hospital_lat ) ) * cos( radians( hospital_long ) - radians( $long ) ) + sin( radians( $lat ) ) * sin( radians( hospital_lat ) ) )
                ) AS distance, Group_concat(qyura_specialities.specialities_name order by specialities_name) as facility, (
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
 AS `rat`,
 CASE 
 WHEN (`usersRoles_roleId` IS  NULL ) 
 THEN
      '0'
 ELSE '1'
 END AS `isAmbulance` , (SELECT count(hospitalPackage_id) from qyura_hospitalPackage where hospitalPackage_hospitalId = hospital_id) as totalHealtPkg ,  (SELECT count(hospitalInsurance_id) from qyura_hospitalInsurance where hospitalInsurance_hospitalId = hospital_id) as totalInsurance
FROM `qyura_specialities`
LEFT JOIN `qyura_hospitalSpecialities` ON `qyura_hospitalSpecialities`.`hospitalSpecialities_specialitiesId` = `qyura_specialities`.`specialities_id`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_id` = `qyura_hospitalSpecialities`.`hospitalSpecialities_hospitalId`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_hospital`.`hospital_usersId` AND usersRoles_roleId = 5 AND usersRoles_parentId = qyura_hospital.hospital_usersId
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_hospital`.`hospital_usersId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_hospital`.`hospital_usersId`

WHERE `hospital_deleted` = 0
AND `specialities_id` = $specialityid
AND `hospital_usersId` NOT IN( '" . implode($notIn, "', '") . "' )
GROUP BY `hospital_id`
HAVING `distance` <= 10

union all

SELECT 'Diagon' AS `type`, '0' AS `isEmergency`, `qyura_diagnostic`.`diagnostic_id` as `id`, `diagnostic_usersId` `userId`, `diagnostic_deleted` as `fav`, `diagnostic_address` `adr`, `diagnostic_name` `name`, `diagnostic_phn` `phn`, `diagnostic_lat` `lat`, `diagnostic_long` `long`, `qyura_diagnostic`.`modifyTime` `upTm`, CONCAT('assets/diagnosticsImage','/',diagnostic_img) as imUrl, (
     6371 * acos( cos( radians( $lat ) ) * cos( radians( diagnostic_lat ) ) * cos( radians( diagnostic_long ) - radians( $long ) ) + sin( radians( $lat ) ) * sin( radians( diagnostic_lat ) ) )
     ) AS distance, Group_concat(distinct qyura_diagnosticsCat.diagnosticsCat_catName order by diagnosticsCat_catName) as facility, (
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
 AS `rat` ,'0'  AS `isAmbulance`, (SELECT count(diagonsticPackage_id) from qyura_diagonsticPackage where diagonsticPackage_diagnosticId = diagnostic_id) as totalHealtPkg , '0' as totalInsurance
FROM `qyura_specialities`
LEFT JOIN `qyura_diagnosticSpecialities` ON `qyura_diagnosticSpecialities`.`diagnosticSpecialities_specialitiesId`=`qyura_specialities`.`specialities_id`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_id`=`qyura_diagnosticSpecialities`.`diagnosticSpecialities_diagnosticId`
LEFT JOIN `qyura_diagnosticsHasCat` ON `qyura_diagnosticsHasCat`.`diagnosticsHasCat_diagnosticId`=`qyura_diagnostic`.`diagnostic_id`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_diagnosticsHasCat`.`diagnosticsHasCat_diagnosticsCatId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_diagnostic`.`diagnostic_usersId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_diagnostic`.`diagnostic_usersId`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_diagnostic`.`diagnostic_usersId`

WHERE `diagnostic_deleted` = 0
AND `specialities_id` = $specialityid
AND `usersRoles_roleId` = ".ROLE_DIAGNOSTICS." 
AND `diagnostic_usersId` NOT IN( '" . implode($notIn, "', '") . "' )
GROUP BY `diagnostic_id`


HAVING `distance` <= ".USER_DISTANCE."


ORDER BY `distance` ASC

 LIMIT ".DATA_LIMIT."  ";  
       
            $queryResult = $this->db->query($sql);
         
            
            $response = $queryResult->result();
           //echo $this->db->last_query(); die();
           // $aoClumns = array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","facility");
            //  print_r($response); die();
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->isAmbulance) ? $row->isAmbulance : "";
                    $finalTemp[] = isset($row->totalHealtPkg) ? $row->totalHealtPkg : "";
                    $finalTemp[] = isset($row->totalInsurance) ? $row->totalInsurance : "";
                    $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "";
                    
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->userId) ? $row->userId : "";
                    $finalTemp[] = isset($row->type) ? $row->type : "";
                    $finalTemp[] = isset($row->fav) ? $row->fav : "";
                    $finalTemp[] = isset($row->rat) ? $row->rat : "";
                    $finalTemp[] = isset($row->adr) ? $row->adr : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->phn) ? $row->phn : "";
                    $finalTemp[] = isset($row->lat) ? $row->lat : "";
                    $finalTemp[] = isset($row->long) ? $row->long : "";
                    $finalTemp[] = isset($row->upTm) ? $row->upTm : "";
                    $finalTemp[] = isset($row->imUrl) ? $row->imUrl : "";
                    $finalTemp[] = isset($row->facility) ? $row->facility : "";
                    $finalResult[] = $finalTemp;
                    
                }
              return $finalResult;
        } else {
            return $finalResult;
        }
        
        
     }
}
?>
