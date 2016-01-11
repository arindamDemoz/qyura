<?php

class Service_content_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function GetServiceDetails($options=array()) {
    	 $select     =   array();
         $table      =   false;
         $where      =   false;
          extract($options);
         // echo $table.'fsfsdfsd';
          //exit;
          $select[] = $table.'.*';
          $select[] = 'vendormaster.centerName';
         $select[] = 'vendormaster.centerEmail';
         $select[] = 'vendormaster.contactPerson';
         $select[] = 'vendormaster.vendorId';
         $this->db->select(implode(',',$select),false);
         if($table!=false)
            $this->db->from($table);
          $this->db->join('vendormaster','vendormaster.vendorId ='. $table.'.fkVendorId','left');
            if($where!=false)
            $this->db->where($where);
         $query  = $this->db->get();
         return $query->result();
    }
	
	function fetchColoumName($tableName) {
		/*echo "SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='froyofit' 
    AND `TABLE_NAME`='$tableName'";exit;*/
$return =$this->db->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='froyofit' AND `TABLE_NAME`='$tableName'");
return $return->result();
	}
	
 public function customGet($options)
    {

            $select     =   false;
            $table      =   false;
            $join       =   false;
            $order      =   false;
            $limit      =   false;
            $offset     =   false;
            $where      =   false;
            $or_where   =   false;
            $single     =   false;
            $where_not_in = false;

            extract($options);

                    if($select!=false)
                            $this->db->select($select);

                    if($table!=false)
                            $this->db->from($table);

                    if($where!=false)
                            $this->db->where($where);
                    
                    if($where_not_in!=false){
                        foreach($where_not_in as $key => $value){
                        if(count($value) > 0)    
                        $this->db->where_not_in($key,$value);
                        }
                    }

                    if($or_where!=false)
                            $this->db->or_where($or_where);

                    if($limit!=false){

                            if(!is_array($limit))
                            {
                                    $this->db->limit($limit);
                            }
                            else
                            {
                                    foreach($limit as $limitval => $offset){
                                            $this->db->limit($limitval, $offset);
                                    }
                            }
                    }


                    if($order!=false){

                            foreach($order as $key => $value){
                                
                                    if(is_array($value))
                                    {
                                            foreach($order as $orderby => $orderval)
                                            {
                                                    $this->db->order_by($orderby, $orderval);
                                            }
                                    }
                                    else
                                    {
                                            $this->db->order_by($key, $value);
                                    }
                            }
                    }

                    
                    if($join!=false){
                        
                        foreach($join as $key => $value){

                            if(is_array($value))
                            {
                                if(count($value)==3)
                                {
                                    $this->db->join($value[0], $value[1],$value[2]);
                                }
                                else
                                {
                                    foreach($value as $key1 => $value1)
                                    {
                                        $this->db->join($key1, $value1);
                                    }
                                }
                            }
                            else
                            {
                                $this->db->join($key, $value);
                            }

                        }
                            
                    }


                    $query  = $this->db->get();

                    if($single)
                    {
                            return $query->row();
                    }

                    return $query->result();
    }
	 public function customUpdate($options)
    {
        $table      =   false;
        $where      =   false;
        $orwhere    =   false; 
        $data       =   false;

            extract($options);

            if(!empty($where))
            {
                $this->db->where($where);
            }
            
            // using or condition in where  
            if(!empty($orwhere)){
                            $this->db->or_where($orwhere);
                            }
            $this->db->update($table, $data);

            return $this->db->affected_rows();
    }
	
}    