<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class HealthpkgBooking_model extends Common_model
{
    
   public function __construct()
    {
        parent::__construct();
	
    }
    
   public function bookHealthPkg($table,$data) {
        
        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();
        
        return $id;
        
    }
    
   public function getMyBookedHealthPkg($where){
       $this->db->select('healthPackage_id as pkgId, healthPackage_packageTitle as title, healthPackage_discountedPrice as price, ( CASE WHEN(healthPkgBooking_bkStatus = 0) THEN "Pending" WHEN(healthPkgBooking_bkStatus = 1) THEN "Completed" END) as status, qyura_healthPkgBooking.creationTime as bookingDate');
        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->where($where);
        $this->db->group_by('healthPackage_id');
        $this->db->order_by('qyura_healthPkgBooking.creationTime', 'desc');
        return $this->db->get()->result();
     }
     
    public function getHealpkgDetail($healthPkgBookingId) {
        
        $healthPkgBookingId = isset($healthPkgBookingId) ? $healthPkgBookingId : '';
        
        $this->db->select('healthPackage_packageTitle name, healthPackage_discountedPrice price, ( CASE WHEN(healthPkgBooking_bkStatus = 0) THEN "Pending" WHEN(healthPkgBooking_bkStatus = 1) THEN "Completed" END) as status, qyura_healthPkgBooking.creationTime as bookingDate');
        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->where(array('healthPkgBooking_deleted' => 0, 'healthPackage_deleted' => 0, 'healthPkgBooking_id' => $healthPkgBookingId));
        return $this->db->get()->result();
    }
    
    
    public function getHealpkgTest($healthPkgBookingId) {
        
        $healthPkgBookingId = isset($healthPkgBookingId) ? $healthPkgBookingId : '';
        
        $this->db->select('diagnostics_id testId,diagnostics_name testName');
        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackageIncludes', 'qyura_healthPackageIncludes.healthPackageIncludes_healthPackageId = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->join('qyura_diagnosticsTest', 'qyura_diagnosticsTest.diagnostics_id = qyura_healthPackageIncludes.HealthPackageIncludes_test', 'left');
        $this->db->where(array('healthPkgBooking_deleted' => 0, 'healthPkgBooking_id' => $healthPkgBookingId, 'healthPackageIncludes_deleted' => 0));
        return $this->db->get()->result();
    }
    
}
?>
