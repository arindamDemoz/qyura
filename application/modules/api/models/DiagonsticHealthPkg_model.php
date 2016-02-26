<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class DiagonsticHealthPkg_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getHealpkgDetail($diagonsticId,$healthPkgId) {
        $healthPkgId = isset($healthPkgId) ? $healthPkgId : '';
        $this->db->select('diagnostics_id testId,diagnostics_name testName');
        $this->db->from('qyura_diagonsticPackage');
        $this->db->join('qyura_healthPackageIncludes', 'qyura_healthPackageIncludes.healthPackageIncludes_healthPackageId = qyura_diagonsticPackage.diagonsticPackage_healthPackageId', 'left');
        $this->db->join('qyura_diagnosticsTest', 'qyura_diagnosticsTest.diagnostics_id = qyura_healthPackageIncludes.HealthPackageIncludes_test', 'left');
        $this->db->where(array('diagonsticPackage_diagnosticId' => $diagonsticId, 'diagonsticPackage_healthPackageId' =>$healthPkgId, 'diagonsticPackage_deleted' => 0, 'healthPackageIncludes_deleted' => 0));
        return $this->db->get()->result();
    }
    
    
    public function getDiagonHelthPkg($diagonsticId,$healthPkgId)
    {
        $this->db->select('healthPackage_id,healthPackage_packageTitle,healthPackage_packageId,healthPackage_packageTitle,healthPackage_expiryDateStatus,healthPackage_date,healthPackage_bestPrice,healthPackage_discountedPrice,healthPackage_description,healthPackage_deleted,qyura_healthPackage.modifyTime');
        $this->db->from('qyura_healthPackage');
        $this->db->join('qyura_diagonsticPackage','qyura_diagonsticPackage.diagonsticPackage_healthPackageId = qyura_healthPackage.healthPackage_id');
        $this->db->where(array('diagonsticPackage_diagnosticId'=>$diagonsticId, 'diagonsticPackage_healthPackageId' => $diagonsticId, 'healthPackage_deleted'=>0));
        $this->db->group_by('healthPackage_id');
        return $this->db->get()->result();
    }

}

?>
