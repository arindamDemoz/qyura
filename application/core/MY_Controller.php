<?php  if(!defined('BASEPATH')){    exit('No direct script access allowed');}

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
         $this->load->model(array('main_content_model','vendorview/service_content_model')); 
           if ( ! $this->session->userdata('superadminemail'))
            {   
             redirect(site_url('admin'));
            } 
    }

     protected function header(){
        
	 $vendorId = 1;
        $option = array(
            'table' => 'vendormaster',
            'select' => 'serviceNames',
            'where' => array('vendorId' => $vendorId),
            'single' => TRUE
        );
        $serviceArray = array();
        $serviceNames = $this->main_content_model->customGet($option);
        $serviceName =  unserialize($serviceNames->serviceNames);
        if(count($serviceName) && !empty($serviceName)){
            foreach($serviceName as $service){
                $option = array(
                    'table' => 'services',
                    'select' => 'serviceName',
                    'where' => array('serviceId' => $service),
                    'single' => TRUE
                );
                    $serviceName = $this->main_content_model->customGet($option);
                    array_push($serviceArray, $serviceName->serviceName);
                }
            }

        return $serviceArray;
    }

    /* this function is write for the availability checking users
      are currently submit there changes or not.If a changes request made,
      first superadmin approve it,then another changes request is acceptable.
      return boolean
     */

    protected function checkAvailability($data = array()) {
       // echo "i am here";exit;
        $fkVendorId = $data['fkVendorId'];
        $tableName = $data['tableName'];
        $options = array(
            'table' => 'tempory_service_hold',
            'where' => array('fkVendorId' => $fkVendorId, 'status' => 0, 'tableName' => $tableName),
            'select' => 'status'
        );
        $result = $this->service_content_model->customGet($options);
        if (empty($result)) {
            $this->session->set_flashdata('messages', "<strong><span style=color:red>No fields for update! .</span></strong>");
           redirect(site_url("vendorview/vendorCustomView/$tableName/$fkVendorId"));
        } else
            return true;
    }
}
