<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed');

class Common_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
		
    }
    
    //Clear session data
    public function clearSessionData()
    {
        foreach($this->session->userdata as $sess_var)
        {
            unset($sess_var);
        }
    }
    
    //Make the ID encrypted
    public function id_encrypt($str)
    {
        return $str*55;
    }
    
    //Make the ID decrypted
    public function id_decrypt($str)
    {
            return $str/55;
    }
    
    //Password 
    public function password_encrip($str)
    {
        return $str*55;
    }
}