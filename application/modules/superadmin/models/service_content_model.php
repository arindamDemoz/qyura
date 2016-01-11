<?php

class Service_content_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function GetServiceDetails($options=array()) {
    		print_r($options);exit;
    		/*$select     =   array();
            $table      =   false;
            $where      =   false;

             extract($options);

            if($table!=false)
                $this->db->from($table);

            if($where!=false)
                $this->db->where($where);*/
    }
}    