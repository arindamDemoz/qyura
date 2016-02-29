<?php
class Miappointment_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        //$this->load->helper(array());
    }
    
    function fetchStates() {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        $this->db->order_by("state_statename","asc");
        return $this->db->get()->result();
    }
    
    function fetchCity ($stateId=NULL){
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->where('city_stateid',$stateId);
        $this->db->order_by("city_name","asc");
        return $this->db->get()->result();
    }
    
    function fetchEmail($email,$usersId = NULL){
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        if($usersId) {
            $this->db->where('users_id !=',$usersId);
        }
         $this->db->where('users_email',$email); 
       $result = $this->db->get();
       //return $this->db->last_query();
       //exit;
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0; 
    }
    
    function insertBloodBankUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    function insertBloodBank($insertData){
        $this->db->insert('qyura_bloodBank', $insertData); 
      
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function fetchbloodBankData( $condition = NULL){
         $this->db->select('blood.bloodBank_id,blood.users_id,blood.bloodBank_name,blood.bloodBank_phn,blood.bloodBank_add,City.city_name,'
                 . 'blood.bloodBank_photo,usr.users_email,usr.users_password ,blood.bloodBank_cntPrsn,blood.bloodBank_lat,blood.bloodBank_long');
     $this->db->from('qyura_bloodBank AS blood');
     $this->db->join('qyura_city AS City','City.city_id = blood.cityId','left');
     $this->db->join('qyura_users AS usr','usr.users_id = blood.users_id','left');
     //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = blood.users_id','left'); // changed
     if($condition)
       $this->db->where(array('blood.bloodBank_id'=> $condition));   
        $this->db->where(array('blood.bloodBank_deleted'=> 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("blood.creationTime", "desc"); 
      $data= $this->db->get(); 
     //echo $this->db->last_query();exit;
     return $data->result();
    }
    
    function getDiagnostic( $condition = NULL){
        $now = time();
        $this->datatables->select("qyura_quotations.quotation_id, qyura_quotations.quotation_dateTime as date, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as MIname, qyura_diagnosticsCat.diagnosticsCat_catName AS diagCatName, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, qyura_quotationBooking.quotationBooking_orderId AS orderId, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge,qyura_quotationBooking.quotationBooking_bookStatus as bookStatus");
//        $this->datatables->select("qyura_quotations.quotation_id,qyura_quotationBooking.quotationBooking_reportTitle as title, qyura_quotations.quotation_dateTime as dateTime, CASE WHEN (qyura_hospital.hospital_usersId <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS address, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as MIname, qyura_quotationBooking.quotationBooking_orderId AS orderId,qyura_quotationBooking.quotationBooking_bookStatus as bookStatus, CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '0' THEN 'pending' WHEN '1' THEN 'confirmed' ELSE NULL END AS bookingStatus, CASE transactionInfo.payment_status WHEN '1' THEN 'Success' WHEN 4 THEN 'Aborted' WHEN 5 THEN 'Failure' ELSE NULL END AS paymentStatus, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, qyura_users.users_mobile AS usersMobile, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge, transactionInfo.payment_method AS paymentMethod, '' AS remark, qyura_diagnosticsCat.diagnosticsCat_catName AS diagCatName, '' AS speciality, 'Diagnostic' as type, (CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP ) THEN 'Upcoming' ELSE 'Completed' END) as upcomingStatus");
        
$this->datatables->from("qyura_quotationBooking");

$this->datatables->join("transactionInfo" , "transactionInfo.order_no = qyura_quotationBooking.quotationBooking_orderId","left");
$this->datatables->join("qyura_quotations "," qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId","left");
$this->datatables->join("qyura_users "," qyura_users.users_id=qyura_quotations.quotation_userId","left");
$this->datatables->join("qyura_patientDetails "," qyura_patientDetails.patientDetails_usersId=qyura_quotationBooking.quotationBooking_userId","left");
$this->datatables->join("qyura_usersFamily "," qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId","left");
$this->datatables->join("qyura_hospital "," qyura_hospital.hospital_usersId=qyura_quotations.quotation_MiId","left");
$this->datatables->join("qyura_diagnostic "," qyura_diagnostic.diagnostic_usersId=qyura_quotations.quotation_MiId","left");
$this->datatables->join("qyura_diagnosticsCat "," qyura_diagnosticsCat.diagnosticsCat_catId=qyura_quotations.quotation_diagnosticsCatId","left");

$this->datatables->where(array("qyura_quotationBooking.quotationBooking_deleted" => 0,"qyura_quotations.quotation_dateTime" <> 0));

$this->datatables->date_range($_POST['startDate'],$_POST['endDate']);


$this->datatables->edit_column('orderId', '<h6>$1</h6><p>$2</p>', 'orderId,dateFormate(date)');
//$this->datatables->add_column('orderId', '<h6>$1</h6><p>$2</p>', 'orderId,dateTime');
$this->datatables->add_column('userName', '<h6>$1</h6><p>$2|$3</p>', 'userName,userGender,userAge');
//$this->datatables->add_column('userNameView', '<h6>$1</h6><p>$2|$3</p>', 'userName,userGender,userAge');
$this->datatables->add_column('diagCatName', '<h6>$1</h6>', 'diagCatName');

//$this->datatables->add_column('userName', '<h6>$1</h6>', 'userName');
//$this->datatables->add_column('userName', '<h6>$1</h6>', 'userName');
//$this->datatables->add_column('diagCatName', '<h6>$1</h6>', 'diagCatName');

$this->datatables->add_column('MIname', '<h6>$1</h6>', 'MIname');
//$this->datatables->edit_column('', '<select class="form-control status-select"><option  value="1">Confirmed</option value="0"><option>Pending</option></select>', '');

$this->datatables->edit_column('bookStatus', '$1', 'getStatusDropDown(bookStatus)');
//$this->datatables->add_column('bookStatus', '$1', 'bookStatus');
$this->datatables->add_column('action', '<p><a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="#$1">View Detail</a></p><button type="button" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Change Timing</button>', 'quotation_id');



return $this->datatables->generate(); 
 
    }
    
    
        function getDiagnostic1( $condition = NULL){
        $now = time();
        $this->datatables->select("`qyura_quotations`.`quotation_id`, `qyura_quotations`.`quotation_dateTime` as `dateTime`, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `MIname`, `qyura_diagnosticsCat`.`diagnosticsCat_catName` AS `diagCatName`, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, `qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`, CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`, CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,qyura_quotationBooking.quotationBooking_bookStatus as `bookStatus`");
//        $this->datatables->select("`qyura_quotations`.`quotation_id`,`qyura_quotationBooking`.`quotationBooking_reportTitle` as title, `qyura_quotations`.`quotation_dateTime` as `dateTime`, CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `MIname`, `qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`,qyura_quotationBooking.quotationBooking_bookStatus as `bookStatus`, CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '0' THEN 'pending' WHEN '1' THEN 'confirmed' ELSE NULL END AS `bookingStatus`, CASE transactionInfo.payment_status WHEN '1' THEN 'Success' WHEN 4 THEN 'Aborted' WHEN 5 THEN 'Failure' ELSE NULL END AS `paymentStatus`, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`, `qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`, `transactionInfo`.`payment_method` AS `paymentMethod`, '' AS `remark`, `qyura_diagnosticsCat`.`diagnosticsCat_catName` AS `diagCatName`, '' AS `speciality`, 'Diagnostic' as `type`, (CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP ) THEN 'Upcoming' ELSE 'Completed' END) as `upcomingStatus`");
        
$this->datatables->from("`qyura_quotationBooking`");

$this->datatables->join("`transactionInfo`" , "`transactionInfo`.`order_no` = `qyura_quotationBooking`.`quotationBooking_orderId`","left");
$this->datatables->join("`qyura_quotations` "," `qyura_quotations`.`quotation_id`=`qyura_quotationBooking`.`quotationBooking_quotationId`","left");
$this->datatables->join("`qyura_users` "," `qyura_users`.`users_id`=`qyura_quotations`.`quotation_userId`","left");
$this->datatables->join("`qyura_patientDetails` "," `qyura_patientDetails`.`patientDetails_usersId`=`qyura_quotationBooking`.`quotationBooking_userId`","left");
$this->datatables->join("`qyura_usersFamily` "," `qyura_usersFamily`.`usersfamily_id`=`qyura_quotations`.`quotation_familyId`","left");
$this->datatables->join("`qyura_hospital` "," `qyura_hospital`.`hospital_usersId`=`qyura_quotations`.`quotation_MiId`","left");
$this->datatables->join("`qyura_diagnostic` "," `qyura_diagnostic`.`diagnostic_usersId`=`qyura_quotations`.`quotation_MiId`","left");
$this->datatables->join("`qyura_diagnosticsCat` "," `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_quotations`.`quotation_diagnosticsCatId`","left");

$this->datatables->where(array("`qyura_quotationBooking`.`quotationBooking_deleted`" => 0,"`qyura_quotations`.`quotation_dateTime`" <> 0));



$this->datatables->edit_column('orderId', '<h6>$1</h6><p>$2</p>', 'orderId,dateFormate(dateTime),');
//$this->datatables->add_column('orderId', '<h6>$1</h6><p>$2</p>', 'orderId,dateTime');
//$this->datatables->add_column('userNameView', '<h6>$1</h6><p>$2|$3</p>', 'userName,userGender,userAge');
//$this->datatables->add_column('userNameView', '<h6>$1</h6><p>$2|$3</p>', 'userName,userGender,userAge');
//$this->datatables->add_column('diagCatNameView', '<h6>$1</h6>', 'diagCatName');

//$this->datatables->add_column('userName', '<h6>$1</h6>', 'userName');
//$this->datatables->add_column('userName', '<h6>$1</h6>', 'userName');
//$this->datatables->add_column('diagCatName', '<h6>$1</h6>', 'diagCatName');

//$this->datatables->add_column('MIname', '<h6>$1</h6>', 'MIname');
//$this->datatables->edit_column('', '<select class="form-control status-select"><option  value="1">Confirmed</option value="0"><option>Pending</option></select>', '');

//$this->datatables->edit_column('bookStatus', '$1', 'getStatusDropDown(bookStatus)');
//$this->datatables->add_column('bookStatus', '$1', 'bookStatus');
$this->datatables->add_column('view', '<p><a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="#$1">View Detail</a></p><button type="button" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Change Timing</button>', 'quotation_id');



return $this->datatables->generate(); 
 
    }
    
    
    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return true;
    }
    
    function UpdateTableData($data=array(),$where=array(),$tableName = NULL){
        foreach($where as $key=>$val){
            $this->db->where($key, $val); 
        }
       
        $this->db->update($tableName, $data); 
       
        //echo $this->db->last_query();exit;
         return TRUE;
    }
     
}   

