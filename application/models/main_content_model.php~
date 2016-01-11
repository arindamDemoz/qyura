<?php

class Main_content_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function validate_m($email,$password){
        
        $login_check = $this->db->get_where('users',array("email"=>$email,"password"=>$password));
        
        if($login_check->num_rows()>0){
            return $login_check->result_array();
        }else{
            return 0;
        }
    }
    
    function validate_s($email,$password){
        
        $login_check = $this->db->get_where('super',array("email"=>$email,"password"=>$password));
        
        if($login_check->num_rows()>0){
            return $login_check->result_array();
        }else{
            return 0;
        }
    }
    
    function validate_sales($email,$password){
        
        $login_check = $this->db->get_where('sales',array("email"=>$email,"password"=>$password));
        
        if($login_check->num_rows()>0){
            return $login_check->result_array();
        }else{
            return 0;
        }
    }
    
    function validate_vendor($email,$password){
        
        $login_check = $this->db->get_where('vendormaster',array("centerEmail"=>$email,"password"=>$password));
        
        if($login_check->num_rows()>0){
            $active_check = $this->db->get_where('vendormaster',array("centerEmail"=>$email,"password"=>$password,"active"=>1));
            if($active_check->num_rows()>0){
                return $active_check->result_array();
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }
    
    public function customInsert($options)
    {
            $table  =   false;
            $data   =   false;

            extract($options);

            $this->db->insert($table, $data);

            return $this->db->insert_id();
    }
	 public function customInsertServices($data=array(),$table)
    {
		//echo "here";exit;
            $this->db->insert('tempory_service_hold', $data);

            $ids = $this->db->insert_id();
			$this->db->where('fkVendorId', $data['fkVendorId']);
			$this->db->update($table, array('updateStatus'=>1)); 
			return $ids;
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
//echo $this->db->last_query();//die();
                    return $query->result();
    }
    
    function getData($tbl=null, $select=null, $con=null,$orderBy=null,$limit=null,$join=null,$between=null,$multiple=TRUE)
    {
        if($select != null){
            $this->db->select($select);
        }else{
            $this->db->select('*');
        }
        
        $this->db->from($tbl);
        
        if($join != null){
            foreach($join as $j){
                $type = 'inner';
                if(isset($j['type']))
                 $type = $j['type'];
                    
                $this->db->join($j['table'], $j['relation'],$type);
            }
        }
        
        if($con != null)
            $this->db->where($con);
        
        if($between != null)
            $this->db->where($between);
        
        if($orderBy != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->order_by($orderBy);
        
        if($limit != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->limit($limit);
        
        $query=$this->db->get();
//        echo $this->db->last_query();
        if($query->num_rows() >0){
            if($multiple){
                return $query->result();
            }
            else {
                return $query->row();
            }
        }
        else
            return FALSE;
    }
    
    public function customQuery($query,$single=false,$updDelete=false,$noReturn=false)
    {
		$query = $this->db->query($query);
		
		if($single)
		{
			return $query->row();
		}
		elseif($updDelete)
		{
			return $this->db->affected_rows();
		}
		elseif(!$noReturn)
		{
			return $query->result();
		}
		else
		{
			return true;
		}
    }
    
    
    public function customQueryCount($query)
    {
        return $this->db->query($query)->num_rows();
    }
    
    public function getCountNotice($con=null,$between=null)
    {
        
        if($con != null)
        $this->db->where($con);
        
        if($between != null)
        $this->db->where($between);
        
        return $this->db->count_all_results('notice');
        
        
    }
}
