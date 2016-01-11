<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Test controller
 */
class Vendorview extends MY_Controller
{
   
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a list of service wise data data.
     *
     * @return void
     */
    function vendorCustomView() {
       
       $vendorId = '';
       $table = '';
       $head = '';
       $vendorId ='';
       $vendorId = $this->uri->segment(4);
       /* if(!$this->session->userdata('vendorEmail'))
        {   $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners')); } */
         $table = $this->uri->segment(3);
         //echo $table;exit;
         if($vendorId) {
             $options = array(
            'table' => $table,
            'where' => array($table.".".'enabled'=> 1,$table.".".'deleted'=> 0,$table.".".'fkVendorId'=> $vendorId)
            );
         }
         else {
             $options = array(
            'table' => $table,
            'where' => array($table.".".'enabled'=> 1,$table.".".'deleted'=> 0)
            );
         }
       
       
        $data['serviceData'] = $this->service_content_model->GetServiceDetails($options);
       
         $head = $this->header();
         
        $data['servicesArray'] = $head;
        $data['tablename'] = $table;
		$this->session->set_userdata('tablename', $table);
        $data['messages'] =$this->session->flashdata('messages');
        $this->load->view('superHeader',$data);
        if($vendorId) {
            $this->load->view('partners/vendorHeader',$data);
            //$this->load->view("requestChanges/partnerServices/$table",$data);
            $this->load->view("adminChanges/partnerServices/$table",$data);
            $this->load->view('partners/vendorFooter');
            $this->load->view('scriptPage/vendorScript');
        }
        else {
            $this->load->view('services/services');
        }
        
    }


	public function updateRequestedService() {
       
        
		$fkVendorId = $this->input->post('fkVendorId');
		$tableName = $this->session->userdata('tablename');

         $Availability_option = array(
            'fkVendorId' => $fkVendorId,
            'tableName' => $tableName
        );
        $this->checkAvailability($Availability_option);

		$fetch_coloum_name = $this->service_content_model->fetchColoumName($tableName);
		
		$options = array(
            'table' => 'tempory_service_hold',
            'where' => array('fkVendorId'=> $fkVendorId,'status'=> 0,'tableName'=> $tableName),
			'select' => '*'
            );
			$tempTableResult = $this->service_content_model->customGet($options);
			
		$data_array=array();
		
		for($i=3;$i<count($fetch_coloum_name);$i++) {
			$j=0;
			foreach($tempTableResult[0] as $key=>$val)
			{
				if($j > 4) {
					if($fetch_coloum_name[$i]->COLUMN_NAME== $key) {
						$data_array[$key] = $val;
						break;
						
					}
				}
				$j++;
			}
			
		}	
		$data_array = array_splice($data_array,0,-5);
		$data_array['updateStatus'] = 0;
		$updateOptions = array(
                'where'=> array('fkVendorId'=>$tempTableResult[0]->fkVendorId),
                'data' => $data_array,
                'table'=> $tableName
            ); 
		$this->service_content_model->customUpdate($updateOptions);

        $update_data = array('status' => 1,'requestConfirmTime' => strtotime(date('Y-m-d H:i:s')));
        $updateFurtherOptions = array(
                'where'=> array('Id'=>$tempTableResult[0]->Id),
                'data' => $update_data,
                'table'=> 'tempory_service_hold'
            );
            $this->service_content_model->customUpdate($updateFurtherOptions); 
		 $this->session->set_flashdata('messages', '<strong><span style="color:green">Request updated successfully!</span></strong>');
         redirect(site_url("vendorview/vendorCustomView/$tableName/$fkVendorId"));
		exit;
	}

    public function requestChangesData() {
        $fkVendorId = $this->input->post('fkVendorId');
       $tableName = $this->session->userdata('tablename');
       
        $options = array(
            'table' => 'tempory_service_hold' ,
            'where' => array('fkVendorId'=> $fkVendorId,'status'=> 0,'tableName'=> $tableName),
            'select' => '*'
            );
            $data['serviceData'] = $this->service_content_model->customGet($options);

           echo  $this->load->view("requestChanges/partnerServices/$tableName",$data,TRUE);
           exit;
            
    }
    
}