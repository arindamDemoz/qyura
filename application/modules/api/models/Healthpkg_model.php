<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Healthpkg_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getHealpkgDetail($hospitalId,$healthPkgId) {
        $healthPkgId = isset($healthPkgId) ? $healthPkgId : '';
        $this->db->select('diagnostics_id testId,diagnostics_name testName');
        $this->db->from('qyura_hospitalPackage');
        $this->db->join('qyura_healthPackageIncludes', 'qyura_healthPackageIncludes.healthPackageIncludes_healthPackageId = qyura_hospitalPackage.hospitalPackage_healthPackageId', 'left');
        $this->db->join('qyura_diagnosticsTest', 'qyura_diagnosticsTest.diagnostics_id = qyura_healthPackageIncludes.HealthPackageIncludes_test', 'left');
        $this->db->where(array('hospitalPackage_hospitalId' => $hospitalId, 'hospitalPackage_healthPackageId' =>$healthPkgId, 'hospitalPackage_deleted' => 0, 'healthPackageIncludes_deleted' => 0));
        return $this->db->get()->result();
    }
    
    
    public function getHosHelthPkg($hospitalId,$healthPkgId)
    {
        $this->db->select('healthPackage_id,healthPackage_packageTitle,healthPackage_packageId,healthPackage_packageTitle,healthPackage_expiryDateStatus,healthPackage_date,healthPackage_bestPrice,healthPackage_discountedPrice,healthPackage_description,healthPackage_deleted,qyura_healthPackage.modifyTime');
        $this->db->from('qyura_healthPackage');
        $this->db->join('qyura_hospitalPackage','qyura_hospitalPackage.hospitalPackage_healthPackageId = qyura_healthPackage.healthPackage_id', 'left');
        $this->db->where(array('hospitalPackage_hospitalId'=>$hospitalId, 'hospitalPackage_healthPackageId' =>$healthPkgId, 'healthPackage_deleted'=>0));
        $this->db->group_by('healthPackage_id');
        return $this->db->get()->result();
    }

}

?>
